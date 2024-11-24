<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."Aset.php"; 
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$aset = new Aset($db);
$kategori = new Kategori($db);
$kategori = $kategori->tampilDataKategori();

$_SESSION['ubah-aset'] = 0;
if(isset($_POST['submit'])){
	if($aset->ubahAset($_POST) == 1){
		$_SESSION['ubah-aset'] = 1;
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}
}

$kode_aset = $_GET['kode_aset'];
$nama_aset = $_GET['nama_aset'];
$stok = $_GET['stok'];
$created_at = $_GET['created_at'];
$id_aset = $_GET['id_aset'];
$id_kategori = $_GET['id_kategori'];
 ?>

<div class="container mt-4">
	<form action="" method="post">
		<div class="mt-4">
			<label for="id-aset" class="form-label">ID Aset</label>
			<input type="text" class="form-control id-aset" name="id-aset" value="<?= $id_aset ?>" readonly>
		</div>
		<div class="mt-4">
			<label for="nama-aset" class="form-label">Nama Aset</label>
			<input type="text" class="form-control nama-aset" name="nama-aset" value="<?= $nama_aset ?>">
		</div>
		<div class="mt-4">
			<label for="kode-aset" class="form-label">Kode Aset</label> 
			<input type="text" class="form-control kode-aset" name="kode-aset" value="<?= $kode_aset ?>" readonly>
		</div>
		<div class="mt-4">
			<label for="stok" class="form-label">Stok</label>
			<input type="number" class="form-control stok" name="stok" value="<?= $stok ?>">
		</div class="mt-4">
		<div class="mt-4">
			<label for="stok" class="form-label">Kategori</label>
			<select class="form-select form-select-lg mb-3" aria-label="Large select example" name="id-kategori">
			<?php foreach ($kategori as $k) : ?>
			  	<option value="<?= $k['id_kategori'] ?>" 
			  		<?= ($k['id_kategori'] == $id_kategori) ? 'selected' : ''; ?> >
			  		<?= $k['nama_kategori'] ?>
			  	</option>
			<?php endforeach; ?>
			</select>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>


<?php include_once LAYOUTS_PATH."footer.php";?>