<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php";
include_once CLASS_PATH."Aset.php"; 
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$aset = new Aset($db);
$kategori = new Kategori($db);
$aset = $aset->tampilDataAset();
?>

<!-- Main Content -->
  <div class="flex-grow-1 p-4">
    <div class="flex">
      <a href="<?= PAGES_PATH ?>aset/tambah-data.php" type="button" class="btn btn-primary btn-lg my-2">Tambah Aset</a>
    </div>
    <table class="table table-hover table-bordered">
      <thead class="table-dark">
        <tr>
          <th scope="col">Kode Aset</th>
          <th scope="col">Nama Aset</th>
          <th scope="col">Kategori Aset</th>
          <th scope="col">Stok</th>
          <th scope="col">Tanggal</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($aset as $a) : ?>
        <tr>
          <th scope="row"><?= $a['kode_aset']; ?></th>
          <td><?= $a['nama_aset']; ?></td>
          <?php $nama_kategori =  $kategori->cariKategoriByID($a['id_kategori'])[0]["nama_kategori"];?>
          <td><?= $nama_kategori; ?></td>
          <td><?= $a['stok']; ?></td>
          <td><?= $a['created_at']; ?></td>
          <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-lihat" id="button-lihat"
            data-kode="<?= $a['kode_aset'] ?>" data-nama="<?= $a['nama_aset'] ?>"
            data-kategori="<?= $nama_kategori ?>" data-stok="<?= $a['stok'] ?>"
            data-tanggal="<?= $a['created_at'] ?>" data-gambar=<?= $a['gambar'] ?>>
              lihat
            </button>
            <a href="<?= PAGES_PATH ?>aset/ubah-data.php?kode_aset=<?= $a["kode_aset"]; ?>&nama_aset=<?= $a["nama_aset"]; ?>&stok=<?= $a["stok"]; ?>&created_at=<?= $a["created_at"]; ?>&id_aset=<?= $a['id'] ?>&id_kategori=<?= $a['id_kategori'] ?>" 
              type="button" class="btn btn-success my-2">Ubah</a>
            <a href="<?= PAGES_PATH ?>aset/hapus-data.php?id=<?= $a['id'] ?>" type="button" class="btn btn-danger my-2">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modal-lihat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="gambar" style="width:20vw;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
  
$(document).ready(function(){
  $(document).on("click", "#button-lihat", function(){

    const kode = $(this).data('kode');
    const nama = $(this).data('nama');
    const kategori = $(this).data('kategori');
    const stok = $(this).data('stok');
    const tanggal = $(this).data('tanggal');
    const gambar = $(this).data('gambar');

    $('#modal-lihat .modal-body #kode').val(kode);
    $('#modal-lihat .modal-body #nama').val(nama);
    $('#modal-lihat .modal-body #kategori').val(kategori);
    $('#modal-lihat .modal-body #stok').val(stok);
    $('#modal-lihat .modal-body #tanggal').val(tanggal);
    $('#modal-lihat .modal-body #gambar').attr("src", '../../layouts/gambar-aset/'+gambar);
  });
});

</script>
<?php if(isset($_SESSION['tambah-aset']) || isset($_SESSION['ubah-aset'])) : ?>
<?php if($_SESSION['tambah-aset'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil ditambahkan!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['tambah-aset'] = 0; } ?>

<?php if($_SESSION['ubah-aset'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil diubah!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['ubah-aset'] = 0;  } ?>
<?php endif; ?>
<?php include_once LAYOUTS_PATH."footer.php";?>
