<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."Aset.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$aset = new Aset($db);

$_SESSION['hapus-aset'] = 0;

$kode = $_GET['kode'];
$parts = explode("-", $kode);
$part_kode = $parts[1]; // Output: hanya angka dibelakang -, agar INV - tidak diambil karna sudah ditangani di function getAsetByKode()

$gambar = $aset->getAsetByKode($part_kode)[0]["gambar"];
if($aset->hapusAset($kode, $gambar) == 1){ // hapusAset() tetap menggunakan kode full dengan INV - nya
	$_SESSION['hapus-aset'] = 1;
}

if($_SESSION['hapus-aset'] == 1) { 
?>
<script>
	Swal.fire({
	  title: "Data Berhasil dihapus!",
	  text: "You clicked the button!",
	  icon: "success"
	});
</script>
<?php 
	$_SESSION['hapus-aset'] = 0;  
	header('Refresh: 1.5; URL=index.php');
} ?>
