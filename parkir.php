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
  $message = '';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lokasi = $_POST["tempat-parkir"];
    $type = $_POST["type"];
    $res = $conn->query("
      SELECT * FROM lokasi WHERE Lokasi = '$lokasi'
    ");
    $slot = $res->fetch_array(MYSQLI_ASSOC)['Slot'];
    $capacity = $res->fetch_array(MYSQLI_ASSOC)['Kapasitas'];

    if ($type == 'datang') {
      if ($slot == 0) {
        $message = 'Error: Slot Parkir Habis';
      } else {
        $slot -= 1;
        $sql = "
          UPDATE Lokasi
          SET Slot = $slot
          WHERE Lokasi = '$lokasi'
        ";
        if (!mysqli_query($conn, $sql)) {
          echo "Error updating record: " . mysqli_error($conn);
        } else {
          $no_plat = $_POST['no-kendaraan'];
          $waktudatang = $conn->query("
            SELECT JamMasuk
            FROM TransaksiStaffTamu
            WHERE NomorPlat = '$no_plat'
            ORDER BY JamMasuk DESC
            LIMIT 1
          ")->fetch_array(MYSQLI_ASSOC)['JamMasuk'];

          $lokasi_id = $conn->query("
            SELECT LokasiID
            FROM lokasi
            WHERE Lokasi = '$lokasi'
          ")->fetch_array(MYSQLI_ASSOC)['LokasiID'];

          $sql = "
            UPDATE transaksistafftamu
            SET LokasiID = $lokasi_id
            WHERE NomorPlat = '$no_plat' AND JamMasuk = '$waktudatang'
          ";

          if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
          }
        }
        $message = 'Update Berhasil';
      }
    } else { // 'keluar'
      if ($slot == $capacity) {
        $message = 'Error: Slot Parkir = Kapasitas';
      } else {
        $slot += 1;
        $sql = "
          UPDATE Lokasi
          SET Slot = $slot
          WHERE Lokasi = '$lokasi'
        ";
        if (!mysqli_query($conn, $sql)) {
          echo "Error updating record: " . mysqli_error($conn);
        }
        $message = 'Update Berhasil';
      }
    }
  }
?>

<!-- html section -->
<DOCTYPE! html>
<html>
  <header>
    <title> Parkir Kendaraan </title>
    <meta charset = "UTF-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </header>
  <body>
    <!-- nav header -->
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Sistem Informasi Parkir</a>
        </div>
        <ul class="nav navbar-nav" id="logout">
          <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Parkir</a></li>
          <li><a href="pelanggaran.php">Pelanggaran</a></li>
        </ul>
      </div>
    </nav>

    <!-- masuk parkir -->
    <div class="row">
      <?php if ($message != '') { ?>
      <div class="form-input col-md-12 text-center" style="margin-bottom: 20px; padding-bottom: 10px">
        <h2><?php echo $message; ?></h2>
      </div>
      <?php } ?>
      <div class="form-input col-md-12">
        <h2>Masuk/Keluar Parkir</h2>
        <br>
        <div class="form-parkir">
          <form method="POST" action="parkir.php">
            <div class="form-group">
              <label for="no-kendaraan">No. Kendaraan</label>
              <input type="text" class="form-control" id="no-kendaraan" name="no-kendaraan">
            </div>
            <div class="form-group">
              <label for="tempat-parkir">Tempat Parkir</label>
              <select class="form-control" name="tempat-parkir" id="tempat-parkir">
                <?php
                  $result = $conn->query("SELECT * FROM lokasi ORDER BY Lokasi");
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<option value=\"" . $row['Lokasi'] . "\">" . $row['Lokasi'] . " | Slot: " . $row['Slot'] . " | Kapasitas: " . $row['Kapasitas'] . "</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label class="radio-inline"><input type="radio" value="datang" name="type" checked>Datang</label>
              <label class="radio-inline"><input type="radio" value="keluar" name="type">Keluar</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
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
    height: 25px;
  }
  .row {
    margin: 0 50px;
  }
  .form-input {
    border: 2px solid black;
    border-radius: 10px;
  }
  button {
    width: 100px;
  }
  #logout {
    float: right;
    background-color: rgba(255,255,255,0.05);
  }
</style>

<!-- script section -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
