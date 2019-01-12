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

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $tagihan = false;

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == "datang") {
    	date_default_timezone_set('Asia/Jakarta');
    	$datex = date('Y-m-d H:i:s');
      $noplat = $_POST['no-kendaraan'];
      $result = $conn->query("
        INSERT INTO transaksimahasiswaumum(JamMasuk, NomorPlat, PetugasID)
        VALUES ('$datex', '$noplat', 1)
      ");
    } else if ($_POST['type'] == "keluar") {
    	date_default_timezone_set('Asia/Jakarta');
      $datex = date('Y-m-d H:i:s');
      $noplat = $_POST['no-kendaraan'];
      $waktudatang = $conn->query("
        SELECT JamMasuk
        FROM transaksimahasiswaumum
        WHERE NomorPlat = '$noplat'
        ORDER BY JamMasuk DESC
        LIMIT 1
      ")->fetch_array(MYSQLI_ASSOC)['JamMasuk'];
      $tagihan = (idate('d', strtotime($datex)) - idate('d',strtotime($waktudatang)) + 1) * 5000;
      $sql = "
        UPDATE transaksimahasiswaumum
        SET JamKeluar = '$datex', Tagihan = '$tagihan'
        WHERE NomorPlat = '$noplat' AND JamMasuk = '$waktudatang'
      ";
      if (mysqli_query($conn, $sql)) {
      } else {
          echo "Error updating record: " . mysqli_error($conn);
      }
    }

    $conn->close();
  }
?>

<!-- html section -->
<DOCTYPE! html>
<html>
  <header>
    <title> Parkir Umum </title>
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
          <li class="active"><a href="#">Umum</a></li>
          <li><a href="staff.php">Staff</a></li>
          <li><a href="tamu.php">Tamu</a></li>
          <li><a href="daftarpelanggaran.php">Pelanggaran</a></li>
        </ul>
      </div>
    </nav>

    <div class="row">
      <div class="col-md-6">
        <div class="form-input col-md-12">
          <h2>Masuk</h2>
          <br>
          <div class="form-datang">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group">
                <label for="no-kendaraan">No. Kendaraan</label>
                <input type="text" class="form-control" id="no-kendaraan" name="no-kendaraan">
              </div>
              <br>
              <input type="hidden" name="type" value="datang">
              <button type="submit" class="btn btn-default">Masuk</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-input col-md-12">
          <h2>Keluar</h2><br>
          <div class="form-datang">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group">
                <label for="no-kendaraan">No. Kendaraan</label>
                <input type="text" class="form-control" id="no-kendaraan" name="no-kendaraan">
              </div>
              <br>
              <input type="hidden" name="type" value="keluar">
              <button type="submit" class="btn btn-default">Keluar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <center class="tagihan">
      <?php
        if ($tagihan) {
      ?>
          <h2>Pembayaran: Rp <?php echo $tagihan ?></h2>
      <?php
        }
      ?>
    </center>
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
  .waktu-input {
    width: 100%;
    margin-left: -15px;
  }
  #logout {
    float: right;
    background-color: rgba(255,255,255,0.05);
  }
</style>

<!-- script section -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
