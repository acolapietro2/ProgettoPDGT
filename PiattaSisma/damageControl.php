<?php
  include 'settings.php';

  session_start();
  if(!isset($_SESSION['username'])) {
    header("Location: login.php");
  }

  // Get datas
  $data['photo'] = $_REQUEST["photo"];
  $address = $_REQUEST["address"];
  $city = $_REQUEST["city"];
  $data['dsc'] = $_REQUEST["description"];

  // Connect to database
  $conn = mysqli_connect($server, $user, $password) or die("Problemi nello stabilire la connessione");
  mysqli_select_db($conn, $database) or die("Errore di accesso al data base utenti");

  // Check if user exists in db
  $sql = "SELECT * FROM api_user WHERE '".$_SESSION['username']."' = username;";
  $result = mysqli_query($conn, $sql);

  // Close connection to db
  mysqli_close($conn);

  if(mysqli_num_rows($result) > 0) {
    // Get coordinates from Google Maps API
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address).",".urlencode($city)."&key=AIzaSyCJfFfAiXYVz5GJyuiSU0ybWeq8bQuzvVE";
    $res = http_request($url);

    $data['user'] = $_SESSION['username'];

    $data['lat'] = $res->results[0]->geometry->location->lat;
    $data['lon'] = $res->results[0]->geometry->location->lng;

    $target = "http://localhost:8000/damages/";

    // Do POST request to API server
    http_request($target, $data, 'POST');

    // Redirect to home
    header("Location: paginaIniziale.php");
    die();
  }
  else {
    // Redirect to login
    header("Location: login.php");
    die();
  }


  function http_request($url, $data='', $method='GET') {
    // Init stuff
    $handle = curl_init();

    if($handle == false) {
        die("Ops, cURL non funziona\n");
    }

    if($method == 'POST') {
      // Encode data
      $jsonData = json_encode($data);
      curl_setopt($handle, CURLOPT_POSTFIELDS, $jsonData);
    }

    // Custom header
    $header = array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    );

    // Set stuff
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

    // Esecuzione della richiesta, $response = contenuto della risposta testuale
    $response = curl_exec($handle);

    $status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    if($status != 200) {
        die("Richiesta HTTP fallita, status {$status}\n");
    }

    curl_close($handle);

    // Decodifica della risposta JSON
    return json_decode($response);
  }
?>
