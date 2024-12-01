<?php 

include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
?>
<?php ?>
<div class="container d-flex justify-content-center">
	
</div>

<script>
	$(document).ready(function() {
        setInterval(load, 1000); // Call the load function when the page loads
    });

    function load() {
        // Use jQuery's $.ajax() method to make the GET request
        $.ajax({
            url: 'data-cari-rfid.php',   // URL to your PHP script
            type: 'GET',            // HTTP method
            success: function(response) {
                // On success, set the response data into the input field with id 'no_aset'
                if(response != ''){
                	const data = response.split(',');
                	console.log(response);
                	const id = data[0];
                	const gambar = data[1];
                	const kode_aset = data[2];
                	const nama_aset = data[3];
                	const stok = data[4];
                	const id_kategori = data[5];
                	const tanggal_perolehan = data[6];
                	const nilai_ekonomis = data[7];
                	const nilai_residu = data[8];
                	const umur_ekonomis = data[9];
                	const nama_kategori = data[10];
					const biaya_penyusutan = (nilai_ekonomis-nilai_residu)/umur_ekonomis;
					console.log(biaya_penyusutan);
                	$('.container').html(`<div class="card mt-4" style="width: 40vw;"><img src="../../layouts/gambar-aset/${gambar}" class="card-img-top" alt="..."><div class="card-body"><h5 class="card-title"><span class="badge rounded-pill text-bg-info">ID : ${id}</span></h5><ul class="list-group mt-3"><li class="list-group-item active" aria-current="true" id="kode">Kode Aset : ${kode_aset}</li><li class="list-group-item">Nama Aset : ${nama_aset}</li><li class="list-group-item">Stok : ${stok}</li><li class="list-group-item">Kategori : ${nama_kategori}</li><li class="list-group-item">Tanggal Perolehan : ${tanggal_perolehan}</li><li class="list-group-item">Nilai Ekonomis : ${nilai_ekonomis}</li><li class="list-group-item">Nilai Residu : ${nilai_residu}</li><li class="list-group-item">Umur Ekonomis : ${umur_ekonomis}</li><li class="list-group-item">Biaya Penyusutan : ${biaya_penyusutan}<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
    <span class="visually-hidden">New alerts</span>
  </span></li></ul></div></div>`);
                }else{
                	$('.container').html('<div class="d-flex flex-column mt-4"><img src="<?= ICONS_PATH ?>rfid.png" class="card-img-top" style="width: 25vw;"><div class=" badge text-bg-primary align-items-center"><h3>Silahkan Tap RFID anda</h3></div></div>');
                }
            },
            error: function(xhr, status, error) {
                // In case of error, log the error to the console
                console.error('AJAX request failed: ' + error);
            }
        });
    }
</script>
<?php include_once LAYOUTS_PATH."footer.php";?>