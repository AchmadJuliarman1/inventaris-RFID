<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."User.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$user = new User($db);

$_SESSION['tambah-user'] = 0;
if(isset($_POST['submit'])){
	if($user->tambahUser($_POST) == 1){
		$_SESSION['tambah-user'] = 1;
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}
}
?>

<div class="container mt-4">
	<h1>Tambah Data User</h1>
	<form action="" method="post">
		<div class="mt-4">
			<label for="nama" class="form-label">Nama</label>
			<input type="text" class="form-control nama" name="nama" required>
		</div>
		<div class="mt-4 mb-2">
			<label for="username" class="form-label">Username</label> 
			<input type="text" class="form-control username" name="username" required>
		</div>
		<div class="mt-4 mb-2">
			<label for="pass" class="form-label">Password</label> 
			<input type="text" class="form-control pass" name="pass" required>
		</div>
		<div class="mt-4 mb-2">
			<label for="role" class="form-label">Role</label> 
			<select class="form-select form-select-lg mb-3" aria-label="Large select example" name="role" required>
			<option value="Admin" >Admin</option>
			<option value="Pimpinan" >Pimpinan</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>





<?php include_once LAYOUTS_PATH."footer.php";?>