<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php";
include_once CLASS_PATH."User.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$user = new User($db);
$users = $user->tampilDataUser();

if (isset($_POST["cari"])) {
  $users = $user->cariDataUser($_POST["keyword"]);
}


?>
<!-- Main Content -->
<div class="container">
  <div class="flex p-4">
    <div class="flex">
      <a href="<?= PAGES_PATH ?>user/tambah-data.php" type="button" class="btn btn-primary btn-lg my-2">Tambah user</a>
    </div>
    <!-- form search -->
    <form action="" method="post">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari Disini.." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="cari"><i class="bi bi-search"></i></button>
      </div>
    </form>
    <table class="table table-hover table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID user</th>
          <th scope="col">Username</th>
          <th scope="col">Nama</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $u) : ?>
        <tr>
          <th scope="row"><?= $u["id"] ?></th>
          <td><?= $u["username"] ?></td>
          <td><?= $u["nama"] ?></td>
          <td><?= $u["role"] ?></td>
          <?php if($u['id'] != $_SESSION['id']) : ?>
          <td>
            <a href="<?= PAGES_PATH ?>user/ubah-data.php?id=<?= $u['id'] ?>&nama=<?= $u['nama'] ?>&username=<?= $u['username'] ?>&role=<?= $u['role'] ?>" type="button" class="btn btn-success my-2">Ubah</a>
            <a href="" type="button" class="btn btn-danger my-2 hapus" data-id="<?= $u["id"] ?>">Hapus</a>
          </td>
          <?php else : ?>
          <td><span class="badge text-bg-info">Anda</span></td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php if(isset($_SESSION['tambah-user'])) : ?>
<?php if($_SESSION['tambah-user'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil ditambahkan!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['tambah-user'] = 0; } ?>
<?php endif; ?>

<?php if (isset($_SESSION['ubah-user'])) : ?>
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

<script>
  $(document).ready(function(){
    $('.hapus').on('click', function() {
      event.preventDefault();
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = 'hapus-data.php?id='+$(this).data('id');;
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }
      });
    });
  });
</script>
<?php include_once LAYOUTS_PATH."footer.php";?>