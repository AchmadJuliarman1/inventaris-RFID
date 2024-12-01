<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php";
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$kategori = new Kategori($db);
$categories = $kategori->tampilDataKategori();
if (isset($_POST["cari"])) {
  $categories = $kategori->cariDataKategori($_POST["keyword"]);
}
?>
<!-- Main Content -->
<div class="container">
  <div class="flex p-4">
    <div class="flex">
      <a href="<?= PAGES_PATH ?>kategori/tambah-data.php" type="button" class="btn btn-primary btn-lg my-2">Tambah Kategori</a>
    </div>
    <form action="" method="post">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari Disini.." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="cari"><i class="bi bi-search"></i></button>
      </div>
    </form>
    <table class="table table-hover table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID kategori</th>
          <th scope="col">Nama Kategori</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($categories as $k) : ?>
        <tr>
          <th scope="row"><?= $k["id_kategori"] ?></th>
          <td><?= $k["nama_kategori"] ?></td>
          <td>
            <a href="<?= PAGES_PATH ?>kategori/ubah-data.php?id=<?= $k['id_kategori'] ?>&nama=<?= $k['nama_kategori'] ?>" type="button" class="btn btn-success my-2">Ubah</a>
            <a href="" type="button" class="btn btn-danger my-2 hapus" data-id="<?= $k['id_kategori'] ?>">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php if(isset($_SESSION['tambah-kategori'])) : ?>
<?php if($_SESSION['tambah-kategori'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil ditambahkan!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['tambah-kategori'] = 0; } ?>
<?php endif; ?>

<?php if (isset($_SESSION['ubah-kategori'])) : ?>
<?php if($_SESSION['ubah-kategori'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil diubah!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['ubah-kategori'] = 0;  } ?>
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