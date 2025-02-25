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
			<label for="Jumlah Aset" class="form-label">Jumlah Aset</label>
			<input type="text" class="form-control jumlah_aset input-number" name="jumlah-aset" required>
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
  			<input class="form-control form-control-sm" id="formFileSm" type="file" name="gambar">
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>



<script type="text/javascript">
	let alertTersedia = false; // Variabel flag tetap tersimpan
	let alertDetected = false;
	let lastRFID = "";

    $(document).ready(function() {
	    setInterval(load, 1000);
	});

	function load() {
	    $.ajax({
	        url: 'data-rfid.php',   
	        type: 'GET',            
	        success: function(response) {
	            if (response !== 'RFID tersebut sudah tersedia' && response != '') {
	            	if(lastRFID != response && response != ''){
	            		lastRFID = response;
	            	}
	            	
	                $('.kode-aset').val('INV-' + lastRFID);
	                if (alertDetected == false) { // Hanya jalankan Swal jika alert belum pernah muncul
	                    Swal.fire({
						  title: "RFID detected",
						  text: "You clicked the button!",
						  icon: "success"
						});
	                    alertDetected = true; // Set flag agar alert tidak muncul lagi
	                    alertTersedia = false;
	                }
	            } else {
	            	if(response != ''){
	            		$('.kode-aset').val('INV-');
		                if (alertTersedia == false) { // Hanya jalankan Swal jika alert belum pernah muncul
		                    Swal.fire({
		                        icon: "error",
		                        title: "RFID tersebut sudah tersedia",
		                        text: "Something went wrong!"
		                    });
		                    alertTersedia = true; // Set flag agar alert tidak muncul lagi
		                    alertDetected = false;
		                }
	            	}
	            	
	            }
	            console.log(response);
	        },
	        error: function(xhr, status, error) {
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