<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."User.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$user = new User($db);

$_SESSION['hapus-user'] = 0;
if($user->hapusUser($_GET['id']) == 1){
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
