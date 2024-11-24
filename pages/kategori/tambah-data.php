<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$kategori = new Kategori($db);

$_SESSION['tambah-kategori'] = 0;
if(isset($_POST['submit'])){
	if($kategori->tambahKategori($_POST) == 1){
		$_SESSION['tambah-kategori'] = 1;
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}
}
?>

<div class="container mt-4">
	<h1>Tambah Data Kategori</h1>
	<form action="" method="post">
		<div class="mt-4 mb-2">
			<label for="nama" class="form-label">Nama Kategori</label>
			<input type="text" class="form-control nama" name="nama" required>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>





<?php include_once LAYOUTS_PATH."footer.php";?>