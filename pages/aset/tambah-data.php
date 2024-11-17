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
	if($aset->tambahAset($_POST) == 1){
		$_SESSION['tambah-aset'] = 1;
	}
}
?>

<div class="container mt-4">
	<form action="" method="post">
		<div class="mt-4">
			<label for="nama-aset" class="form-label">Nama Aset</label>
			<input type="text" class="form-control nama-aset" name="nama-aset">
		</div>
		<div class="mt-4">
			<label for="kode-aset" class="form-label">Kode Aset</label> 
			<input type="text" class="form-control kode-aset" name="kode-aset" readonly>
		</div>
		<div class="mt-4">
			<label for="stok" class="form-label">Stok</label>
			<input type="text" class="form-control stok" name="stok">
		</div class="mt-4">
		<div class="mt-4">
			<label for="stok" class="form-label">Kategori</label>
			<select class="form-select form-select-lg mb-3" aria-label="Large select example" name="id-kategori">
			<?php foreach ($kategori as $k) : ?>
			  	<option value="<?= $k['id_kategori'] ?>" ><?= $k['nama_kategori'] ?></option>
			<?php endforeach; ?>
			</select>
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
</script>

<?php if($_SESSION['tambah-aset'] == 1) { ?>
<script>
	Swal.fire({
	  title: "Data Berhasil ditambahkan!",
	  text: "You clicked the button!",
	  icon: "success"
	});
</script>
<?php $_SESSION['tambah-aset'] = 0;  ?>
<script>
	setTimeout(function() {
	  window.location.href = "index.php";
	}, 1500); 
</script>
<?php } ?>

<?php include_once LAYOUTS_PATH."footer.php";?>