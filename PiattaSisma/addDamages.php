<html>
  <head>
    <title>PiattaSisma</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="homePage.php">PiattaSisma</a>
      </nav>
      <form class="form-signin" method="POST" action="damageCheck.php" enctype="multipart/form-data">
        <?php
        session_start();

        if(isset($_SESSION['address_not_found']) && $_SESSION['address_not_found'] == 1) {
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Indirizzo non trovato!';
            echo '</div>';

            unset($_SESSION['address_not_found']);
          }
        ?>

        <h2 class="h3 mb-3 font-weight-normal">Aggiungi una foto e una descrizione</h2>
        <label for="inputPhoto" class="sr-only">Foto</label>
        <input type="file" id="inputPhoto" name="photo" class="form-control m-2" placeholder="Foto" required autofocus>
        <label for="inputAddress" class="sr-only">Indirizzo e numero civico</label>
        <input type="text" id="inputAddress" name="address" class="form-control m-2" placeholder="Indirizzo e numero civico" required>
        <label for="inputCity" class="sr-only">Città</label>
        <input type="text" id="inputCity" name="city" class="form-control m-2" placeholder="Città" required>
        <label for="inputDescription" class="sr-only">Descrizione</label>
        <textarea type="text" id="inputDescription" name="description" class="form-control m-2" placeholder="Descrizione"></textarea>
        <button class="btn btn-lg btn-primary btn-block m-2" type="submit">Invia</button>
      </form>
      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>PDGT Project made with ❤️ by <a href="https://github.com/Andrea101288">Andrea101288</a> and <a href="https://github.com/Radeox">Radeox</a></p>
        </div>
      </footer>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  </body>
</html>
