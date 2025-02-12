<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."Aset.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$aset = new Aset($db);

$_SESSION['hapus-aset'] = 0;
$gambar = $aset->getAsetById($_GET['id'])[0]["gambar"];
var_dump($gambar);
// die();
if($aset->hapusAset($_GET['id'], $gambar) == 1){
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
