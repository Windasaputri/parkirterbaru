<?php
  session_start();

  // CREATE USER 'parkir'@'localhost' IDENTIFIED BY 'parkir';
  // CREATE DATBASE parkir;
  // GRANT ALL PRIVILEGES ON parkir.* TO 'parkir'@'localhost' WITH GRANT OPTION;
  $servername = "localhost";
  $username = "root";
  $status = '';
  $password = "";
  $dbname = "parkir1";
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == "datang") {
    	date_default_timezone_set('Asia/Jakarta');
    	$datex = date('Y-m-d H:i:s');
      $status = 'datang';
      $no_plat = $_POST['no-kendaraan'];
      $tamu_id = $_POST['id-tamu'];
      $nama = $_POST['nama'];
      $instansi = $_POST['instansi'];
      $kepentingan = $_POST['kepentingan'];
      $no_telp = $_POST['no-telp'];

      $res_tamu = $conn->query("
        INSERT INTO Tamu(TamuID, Nama, Instansi, Telepon)
        VALUES ('$tamu_id', '$nama', '$instansi', '$no_telp')
      ");
      if ($res_tamu) {
        $last_id = $conn->insert_id;
        $res_tamu_transaksi = $conn->query("
          INSERT INTO TransaksiStaffTamu(JamMasuk, TamuID, Kepentingan, PetugasID, NomorPlat)
          VALUES ('$datex', $last_id, '$kepentingan', 1, '$no_plat')
        ");
      }

      $result = $conn->prepare("
        SELECT *
        FROM lokasi
        ORDER BY Slot DESC
      ");
      $result->execute();
      $result->bind_result($lokasi_id, $lokasi, $kapasitas, $slot, $satpam_id);
      $result->store_result();
    } else if ($_POST['type'] == "keluar") {
    	date_default_timezone_set('Asia/Jakarta');
      $datex = date('Y-m-d H:i:s');
      $no_plat = $_POST['no-kendaraan'];
      $status = 'keluar';

      $waktudatang = $conn->query("
        SELECT JamMasuk
        FROM TransaksiStaffTamu
        WHERE NomorPlat = '$no_plat'
        ORDER BY JamMasuk DESC
        LIMIT 1
      ")->fetch_array(MYSQLI_ASSOC)['JamMasuk'];

      $sql = "
        UPDATE TransaksiStaffTamu
        SET JamKeluar = '$datex'
        WHERE JamMasuk = '$waktudatang'
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
    <title> Parkir Tamu </title>
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
          <li><a href="umum.php">Umum</a></li>
          <li><a href="staff.php">Staff</a></li>
          <li class="active"><a href="#">Tamu</a></li>
          <li><a href="daftarpelanggaran.php">Pelanggaran</a></li>
        </ul>
      </div>
    </nav>

    <div class="row">
      <?php
        if ($status == 'datang') {
      ?>
      <div class="form-input col-md-12 text-center" style="margin-bottom: 20px; padding-bottom: 10px">
        <h2>Input Diterima</h2>
        <p class="lead">Rekomendasi Tempat Parkir</p>
        <table border="1" style="margin: auto" class="table-condensed table-hover">
          <tbody>
            <tr>
              <th>Nama</th>
              <th>Slot</th>
              <th>Kapasistas</th>
            </tr>
            <?php
              while ($result->fetch()) {
                echo "<tr>";
                echo "<td>$lokasi</td>";
                echo "<td>$slot</td>";
                echo "<td>$kapasitas</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
      <?php } else if ($status == 'keluar') { ?>
        <div class="form-input col-md-12 text-center" style="margin-bottom: 20px; padding-bottom: 10px">
          <h2>Berhasil Keluar</h2>
        </div>
      <?php } ?>
      <div class="col-md-6">
        <div class="form-input col-md-12">
          <h2>Datang</h2>
          <br>
          <div class="form-datang">
            <form method="POST" action="tamu.php">
              <div class="form-group">
                <label for="no-kendaraan">No. Kendaraan</label>
                <input type="text" class="form-control" id="no-kendaraan" name="no-kendaraan">
              </div>
              <div class="form-group">
                <label for="id-tamu">Tamu ID</label>
                <input type="text" class="form-control" id="id-tamu" name="id-tamu">
              </div>
              <div class="form-group">
                <label for="instansi">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
              </div>
              <div class="form-group">
                <label for="instansi">Instansi</label>
                <input type="text" class="form-control" id="instansi" name="instansi">
              </div>
              <div class="form-group">
                <label for="kepentingan">Kepentingan</label>
                <input type="text" class="form-control" id="kepentingan" name="kepentingan">
              </div>
              <div class="form-group">
                <label for="no-telp">No. Telp</label>
                <input type="text" class="form-control" id="no-telp" name="no-telp">
              </div>
              <input type="hidden" name="type" value="datang">
              <br>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-input col-md-12">
          <h2>Keluar</h2><br>
          <div class="form-datang">
            <form method="POST" action="tamu.php">
              <div class="form-group">
                <label for="no-kendaraan">No. Kendaraan</label>
                <input type="text" class="form-control" id="no-kendaraan" name="no-kendaraan">
              </div>
              <input type="hidden" name="type" value="keluar">
              <br>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
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
