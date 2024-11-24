<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php"; 
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php"; 
include_once CLASS_PATH."User.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$user = new User($db);
$data = $_GET;
$id = $data["id"];
$nama = $data["nama"];
$role = $data["role"];
$username = $data["username"];

$_SESSION['ubah-user'] = 0;
if(isset($_POST['submit'])){
	if($user->ubahUser($_POST) == 1){
		$_SESSION['ubah-user'] = 1;
		echo '
		<script>
			window.location.href = "index.php"
		</script> ';
	}
}
?>

<div class="container mt-4">
	<h1>Ubah Data User</h1>
	<form action="" method="post">
		<div class="mt-4">
			<label for="id" class="form-label">ID</label>
			<input type="text" class="form-control id" name="id" readonly value="<?= $id ?>">
		</div>
		<div class="mt-4">
			<label for="nama" class="form-label">Nama</label>
			<input type="text" class="form-control nama" name="nama" required value="<?= $nama ?>">
		</div>
		<div class="mt-4 mb-2">
			<label for="username" class="form-label">Username</label> 
			<input type="text" class="form-control username" name="username" required value="<?= $username ?>">
		</div>
		<div class="mt-4 mb-2">
			<label for="role" class="form-label">Role</label> 
			<select class="form-select form-select-lg mb-3" aria-label="Large select example" name="role" required>
			<option value="Admin" <?= $role == 'Admin' ? "selected" : "" ?>>Admin</option>
			<option value="Pimpinan" <?= $role == 'Pimpinan' ? "selected" : "" ?>>Pimpinan</option>
			</select>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
	</form>
</div>





<?php include_once LAYOUTS_PATH."footer.php";?>