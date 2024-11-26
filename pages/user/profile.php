<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php";
include_once CLASS_PATH."User.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$user = new User($db);
$loggedInUser = $user->getUserById($_SESSION['id'])[0];

$_SESSION['ubah-user'] = 0;
if(isset($_POST['submit'])){
  if($user->ubahUser($_POST) == 1){
    $_SESSION['ubah-user'] = 1;
    $loggedInUser = $user->getUserById($_SESSION['id'])[0];
  }
}

?>

<div class="container mt-4">

  <h1>Ubah Data Saya</h1>
  <form action="" method="post">
    <div class="mt-4">
      <label for="id" class="form-label">ID</label>
      <input type="text" class="form-control id" name="id" readonly value="<?= $loggedInUser["id"] ?>">
    </div>
    <div class="mt-4">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control nama" name="nama" required value="<?= $loggedInUser["nama"] ?>">
    </div>
    <div class="mt-4 mb-2">
      <label for="username" class="form-label">Username</label> 
      <input type="text" class="form-control username" name="username" required value="<?= $loggedInUser["username"] ?>">
    </div>
    <div class="mt-4">
      <label for="pass" class="form-label">Password</label>
      <input type="text" class="form-control pass" name="pass" required value="<?= $loggedInUser["password"] ?>">
    </div>
    <div class="mt-4 mb-2">
      <label for="role" class="form-label">Role</label> 
      <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="role" required>
      <option value="Admin" <?= $loggedInUser["role"] == 'Admin' ? "selected" : "" ?>>Admin</option>
      <option value="Pimpinan" <?= $loggedInUser["role"] == 'Pimpinan' ? "selected" : "" ?>>Pimpinan</option>
      </select>
    </div>
    <div class="d-flex justify-content-between align-middle">
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      <a href="<?= PAGES_PATH ?>/logout.php" type="button" class="btn btn-outline-danger badge text-bg-danger rounded-pill align-content-center">🔚 Log Out</a>
    </div>
  </form>
</div>

<?php if (isset($_SESSION['ubah-user'])) : ?>
<?php if($_SESSION['ubah-user'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Anda Berhasil diubah!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['ubah-user'] = 0;  } ?>
<?php endif; ?>

<?php include_once LAYOUTS_PATH."footer.php";?>