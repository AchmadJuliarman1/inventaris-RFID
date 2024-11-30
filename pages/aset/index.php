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
          <th scope="col">Tanggal Perolehan</th>
          <th scope="col">Nilai Ekonomis</th>
          <th scope="col">Nilai Residu</th>
          <th scope="col">Umur Ekonomis</th>
          <th scope="col">Biaya Penyusutan</th>
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
          <td><?= $a['tanggal_perolehan']; ?></td>
          <td><?= $a['nilai_ekonomis']; ?></td>
          <td><?= $a['nilai_residu']; ?></td>
          <td><?= $a['umur_ekonomis']; ?></td>
          <td>(nilai ekonimis - nilai residu) ÷ umur ekonomis</td>
          <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-lihat" id="button-lihat"
            data-kode="<?= $a['kode_aset'] ?>" data-nama="<?= $a['nama_aset'] ?>"
            data-kategori="<?= $nama_kategori ?>" data-stok="<?= $a['stok'] ?>"
            data-tanggal="<?= $a['tanggal_perolehan'] ?>" data-gambar=<?= $a['gambar'] ?>>
              lihat
            </button>
            <a href="<?= PAGES_PATH ?>aset/ubah-data.php?kode_aset=<?= $a["kode_aset"]; ?>&nama_aset=<?= $a["nama_aset"]; ?>&stok=<?= $a["stok"]; ?>&tanggal=<?= $a["tanggal_perolehan"]; ?>&id_aset=<?= $a['id'] ?>&id_kategori=<?= $a['id_kategori'] ?>&nilai_ekonomis=<?= $a['nilai_ekonomis'] ?>&nilai_residu=<?= $a['nilai_residu'] ?>&umur_ekonomis=<?= $a['umur_ekonomis'] ?>&gambar=<?= $a['gambar'] ?>" 
              type="button" class="btn btn-success my-2">Ubah</a>
            <a href="" type="button" class="btn btn-danger my-2 hapus" data-id="<?= $a['id'] ?>" data-gambar="<?= $a['gambar'] ?>">Hapus</a>
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
        <ul class="list-group mt-3">
          <li class="list-group-item active" aria-current="true" id="kode"></li>
          <li class="list-group-item" id="nama"></li>
          <li class="list-group-item" id="kategori"></li>
          <li class="list-group-item" id="stok"></li>
          <li class="list-group-item" id="tanggal"></li>
        </ul>
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

    $('#modal-lihat #kode').html('<b>KODE ASET : </b>'+kode);
    $('#modal-lihat #nama').html('<b>Nama Aset : </b>'+nama);
    $('#modal-lihat #kategori').html('<b>Kategori : </b>'+kategori);
    $('#modal-lihat #stok').html('<b>Stok : </b>'+stok);
    $('#modal-lihat #tanggal').html('<b>Tanggal : </b>'+tanggal);
    $('#modal-lihat #gambar').attr("src", '../../layouts/gambar-aset/'+gambar);
  });
});

</script>
<?php if(isset($_SESSION['tambah-aset'])) : ?>
<?php if($_SESSION['tambah-aset'] == 1) { ?>
<script>
  Swal.fire({
    title: "Data Berhasil ditambahkan!",
    text: "You clicked the button!",
    icon: "success"
  });
</script>
<?php $_SESSION['tambah-aset'] = 0; } ?>
<?php endif; ?>

<?php if (isset($_SESSION['ubah-aset'])) : ?>
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
          window.location = 'hapus-data.php?id='+$(this).data('id');
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }
      });
    });
  });
</script>
<?php include_once LAYOUTS_PATH."footer.php";?>
