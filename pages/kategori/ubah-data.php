<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$kategori = new Kategori($db);
$_SESSION['ubah-kategori'] = 0;
if(isset($_POST['submit'])){
	if($kategori->ubahKategori($_POST) == 1){
		$_SESSION['ubah-kategori'] = 1;
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}
}
?>

<div class="container mt-4">
	<h1>Ubah Data Kategori</h1>
	<form action="" method="post">
		<div class="mt-4 mb-2">
			<label for="id" class="form-label">id Kategori</label>
			<input type="text" class="form-control id" name="id" readonly value="<?= $_GET["id"] ?>">
		</div>
		<div class="mt-4 mb-2">
			<label for="nama" class="form-label">Nama Kategori</label>
			<input type="text" class="form-control nama" name="nama" required value="<?= $_GET["nama"] ?>">
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>





<?php include_once LAYOUTS_PATH."footer.php";?>