<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php";
include_once CLASS_PATH."Aset.php"; 
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$aset = new Aset($db);
$kode = $_GET['kode'];
$kategori = new Kategori($db);
$asets = $aset->tampilDataAset();

if (isset($_POST["submit"])) {
  if($aset->monitoringAset($_POST) == 1){
    $_SESSION['monitoring-aset'] = 1;
    echo '
    <script>
      window.location.href = "index.php"
    </script> ';
  }
}

?>
<div class="container mt-4">
  <h2>Monitoring Aset</h2>
  <form action="" method="post">
    
    <div class="mt-4">
      <label for="kode-aset" class="form-label">Kode Aset</label> 
      <input type="text" class="form-control kode-aset" name="kode-aset" readonly required value="<?= $_GET['kode'] ?>">
    </div>
    <div class="mt-4 mb-2">
      <label for="tanggal-monitoring" class="form-label">Tanggal Perolehan</label>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
        <input type="date" id="tanggal-monitoring" name="tanggal-monitoring" class="form-control" required>
      </div>
    </div>
    <div class="mt-4">
      <label for="umur-ekonomis" class="form-label">Umur Ekonomis</label>
      <input type="number" class="form-control umur-ekonomis" name="umur-ekonomis" required>
    </div>
    <button type="submit" class="btn btn-primary mt-4" name="submit">Submit</button>
  </form>
</div>

<script>
  flatpickr("#tanggal-monitoring", {});
</script>