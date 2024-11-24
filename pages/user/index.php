<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php";
include_once CLASS_PATH."User.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$user = new User($db);
$users = $user->tampilDataUser();

?>
<!-- Main Content -->
  <div class="flex p-4">
    <div class="flex">
      <a href="<?= PAGES_PATH ?>user/tambah-data.php" type="button" class="btn btn-primary btn-lg my-2">Tambah user</a>
    </div>
    <table class="table table-hover table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID user</th>
          <th scope="col">Username</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($user as $a) : ?>
        <tr>
          <th scope="row"></th>
          <td></td>
          <td>
            <button type="button" class="btn btn-primary">Lihat</button>
            <a href="<?= PAGES_PATH ?>user/ubah-data.php?" type="button" class="btn btn-success my-2">Ubah</a>
            <a href="<?= PAGES_PATH ?>user/hapus-data.php?" type="button" class="btn btn-danger my-2">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php if(isset($_SESSION['tambah-user']) || isset($_SESSION['ubah-user'])) : ?>
<?php if($_SESSION['tambah-user'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil ditambahkan!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['tambah-user'] = 0; } ?>

<?php if($_SESSION['ubah-user'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil diubah!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['ubah-user'] = 0;  } ?>
<?php endif; ?>
<?php include_once LAYOUTS_PATH."footer.php";?>