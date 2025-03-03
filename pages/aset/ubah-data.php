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



$kode_aset = $_GET['kode_aset'];
$nama_aset = $_GET['nama_aset'];
$jumlah = $_GET['jumlah'];
$id_kategori = $_GET['id_kategori'];
$tanggal_perolehan = $_GET['tanggal'];
$nilai_ekonomis = $_GET['nilai_ekonomis'];
$nilai_residu = $_GET['nilai_residu'];
$umur_ekonomis = $_GET['umur_ekonomis'];
$gambar_lama = $_GET['gambar'];
 ?>

<div class="container mt-4">

<?php 
if(isset($_POST['submit'])){
	if($_FILES["gambar"]["tmp_name"] == ""){
		$gambar = $gambar_lama;
	}else{
		$gambar = $_FILES;
	}
	if($aset->ubahAset($_POST, $gambar) == 1){
		$_SESSION['ubah-aset'] = 1;
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}else{
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}
}
 ?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="mt-4">
			<label for="nama-aset" class="form-label">Nama Aset</label>
			<input type="text" class="form-control nama-aset" name="nama-aset" value="<?= $nama_aset ?>">
		</div>
		<div class="mt-4">
			<label for="kode-aset" class="form-label">Kode Aset</label> 
			<input type="text" class="form-control kode-aset" name="kode-aset" value="<?= $kode_aset ?>" readonly>
		</div>
		<div class="mt-4">
			<label for="jumlah aset" class="form-label">Jumlah Aset</label>
			<input type="number" class="form-control jumlah_aset" name="jumlah-aset" value="<?= $jumlah ?>">
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
		<div class="mt-4 mb-2">
		  <label for="tanggal_perolehan" class="form-label">Tanggal Perolehan</label>
		  <div class="input-group">
		    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
		    <input type="date" id="tanggal_perolehan" name="tanggal-perolehan" class="form-control" required value="<?= $tanggal_perolehan ?>">
		  </div>
		</div>
		<div class="mt-4">
			<label for="nilai_ekonomis" class="form-label">Nilai Ekonomis</label>
			<input type="text" class="form-control nilai_ekonomis input-number" name="nilai-ekonomis" required value="<?= $nilai_ekonomis ?>">
		</div class="mt-4">
		<div class="mt-4">
			<label for="umur_ekonomis" class="form-label">Umur Ekonomis</label>
			<input type="text" class="form-control umur_ekonomis input-number" name="umur-ekonomis" required value="<?= $umur_ekonomis ?>">
		</div class="mt-4">
		<div class="mt-4">
			<label for="nilai_residu" class="form-label">Nilai Residu</label>
			<input type="text" class="form-control nilai_residu input-number" name="nilai-residu" required value="<?= $nilai_residu ?>">
		</div class="mt-4">
		<div class="mt-4">
			<label for="gambar_lama" class="form-label">Gambar lama aset</label>
			<input type="hidden" value="<?= $gambar_lama ?>" name="gambar-lama" value="<?= $gambar_lama ?>">
			<img src="../../layouts/gambar-aset/<?= $gambar_lama ?>" alt="gambar aset" style="width: 20vw;">
		</div>
		<div class="mt-4 mb-2">
			<label for="formFileSm" class="form-label">Gambar baru aset (optional)</label>
  			<input class="form-control form-control-sm" id="formFileSm" type="file" name="gambar">
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>
<script>

    flatpickr("#tanggal_perolehan", {});

    const inputs = document.querySelectorAll('.input-number');

	inputs.forEach(input => {
	    input.addEventListener('input', function() {
	      let value = input.value.replace(/\D/g, '');
	      value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
	      input.value = value;
	    });
	});
</script>

<?php include_once LAYOUTS_PATH."footer.php";?>