<?php
  session_start();

  // CREATE USER 'parkir'@'localhost' IDENTIFIED BY 'parkir';
  // CREATE DATBASE parkir;
  // GRANT ALL PRIVILEGES ON parkir.* TO 'parkir'@'localhost' WITH GRANT OPTION;
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "parkir1";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $error = '';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if (isset($_SESSION['username'])) { // already logged in
    header('Location: parkir.php');
    $conn->close();
    die();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'admin') {
      header('Location: umum.php');
    } else if ($username == 'operator' && $password == 'operator') {
      header('Location: parkir.php');
    } else {
      $error = 'Username/Password Salah';
    }
  }
?>

<!-- html section -->
<DOCTYPE! html>
<html>
  <header>
    <title> Login </title>
    <meta charset = "UTF-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </header>
  <body>
    <!-- nav header -->
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <h1>WELCOME</h1>
      </div>
    </nav>

    <!-- logo -->
    <img src="img/cintaque.jpg">

    <!-- login -->
    <div class="login">
      <form method="POST" action="index.php">
        <?php
          if ($error != '') {
            echo '<h4 class="text-center" style="color: red;">' . $error . '</h4>';
          }
        ?>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group center-button">
          <button class="btn btn-lg btn-primary text-right">Login</button>
        </div>
      </form>
    </div>
  </body>
</html>

<!-- style section -->
<style type="text/css">
  body {
    background-color: rgba(0,0,0,0.35);
  }
  nav h1 {
    text-align: center;
    color: white;
  }
  img {
    display: block;
    margin: 2em auto 0 auto;
    width: 250px;
    height: 250px;
  }
  .login {
    margin: 2.5em 25em 0 25em;
  }
  .form-group {
    padding: 0.5em 0 0.5em 0;
  }
  form label {
    display: block;
    text-align: center;
    font-size: 1.5em;
  }
  form input {
    text-align: center;
  }
  button {
    width: 100px;
  }
  .center-button {
    display: block;
    text-align: center;
  }
</style>

<!-- script section -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
