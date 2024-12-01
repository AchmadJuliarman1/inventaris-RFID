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

$_SESSION['tambah-aset'] = 0;
if(isset($_POST['submit'])){
	if($aset->tambahAset($_POST, $_FILES) == 1){
		$_SESSION['tambah-aset'] = 1;
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}
}
?>
<div class="container mt-4">
	<form action="" method="post" enctype="multipart/form-data">
		<div class="mt-4">
			<label for="nama-aset" class="form-label">Nama Aset</label>
			<input type="text" class="form-control nama-aset" name="nama-aset" required>
		</div>
		<div class="mt-4">
			<label for="kode-aset" class="form-label">Kode Aset</label> 
			<input type="text" class="form-control kode-aset" name="kode-aset" readonly required>
		</div>
		<div class="mt-4">
			<label for="stok" class="form-label">Stok</label>
			<input type="text" class="form-control stok input-number" name="stok" required>
		</div class="mt-4">
		<div class="mt-4">
			<label for="stok" class="form-label">Kategori</label>
			<select class="form-select form-select-lg mb-3" aria-label="Large select example" name="id-kategori" required>
			<?php foreach ($kategori as $k) : ?>
			  	<option value="<?= $k['id_kategori'] ?>" ><?= $k['nama_kategori'] ?></option>
			<?php endforeach; ?>
			</select>
		</div>
		<div class="mt-4 mb-2">
		  <label for="tanggal_perolehan" class="form-label">Tanggal Perolehan</label>
		  <div class="input-group">
		    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
		    <input type="date" id="tanggal_perolehan" name="tanggal-perolehan" class="form-control" required>
		  </div>
		</div>
		<div class="mt-4">
			<label for="nilai_ekonomis" class="form-label">Nilai Ekonomis</label>
			<input type="text" class="form-control nilai_ekonomis input-number" name="nilai-ekonomis" required>
		</div class="mt-4">
		<div class="mt-4">
			<label for="umur_ekonomis" class="form-label">Umur Ekonomis</label>
			<div class="input-group">
				<input type="text" class="form-control umur_ekonomis input-number" name="umur-ekonomis" required>
				<span class="input-group-text">Tahun</span>
			</div>
		</div class="mt-4">
		<div class="mt-4">
			<label for="nilai_residu" class="form-label">Nilai Residu</label>
			<input type="text" class="form-control nilai_residu input-number" name="nilai-residu" required>
		</div class="mt-4">

		<div class="mt-4 mb-2">
			<label for="formFileSm" class="form-label">Select image to upload</label>
  			<input class="form-control form-control-sm" id="formFileSm" type="file" name="gambar" required>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        setInterval(load, 1000); // Call the load function when the page loads
    });

    function load() {
        // Use jQuery's $.ajax() method to make the GET request
        $.ajax({
            url: 'data-rfid.php',   // URL to your PHP script
            type: 'GET',            // HTTP method
            success: function(response) {
                // On success, set the response data into the input field with id 'no_aset'
                if(response != ''){
                	$('.kode-aset').val('INV-'+response);
                }else{
                	$('.kode-aset').val('INV-');

                }
                console.log(response);
            },
            error: function(xhr, status, error) {
                // In case of error, log the error to the console
                console.error('AJAX request failed: ' + error);
            }
        });
    }

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