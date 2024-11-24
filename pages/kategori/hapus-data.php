<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$kategori = new Kategori($db);

$_SESSION['hapus-kategori'] = 0;
if($kategori->hapusKategori($_GET['id']) == 1){
	$_SESSION['hapus-kategori'] = 1;
}

if($_SESSION['hapus-kategori'] == 1) { 
?>
<script>
	Swal.fire({
	  title: "Data Berhasil dihapus!",
	  text: "You clicked the button!",
	  icon: "success"
	});
</script>
<?php 
	$_SESSION['hapus-kategori'] = 0;  
	header('Refresh: 1.5; URL=index.php');
} ?>
