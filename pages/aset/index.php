<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";
include_once LAYOUTS_PATH."sidebar.php"; 
include_once CLASS_PATH."Database.php";
include_once CLASS_PATH."Aset.php"; 
include_once CLASS_PATH."Kategori.php"; 

$db = new Database("localhost", "root", "", "inventaris");
$aset = new Aset($db);
$kategori = new Kategori($db);
$asets = $aset->tampilDataAset();

if (isset($_POST["cari"])) {
  $asets = $aset->cariDataAset($_POST["keyword"]);
}

?>

<!-- Main Content -->
<div class="container">
  <div class="flex-grow-1 p-4">
    <div class="flex">
      <a href="<?= PAGES_PATH ?>aset/tambah-data.php" type="button" class="btn btn-primary btn-lg my-2">Tambah Aset</a>
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
          <th scope="col">Kode Aset</th>
          <th scope="col">Nama Aset</th>
          <th scope="col">Kategori Aset</th>
          <th scope="col">Jumlah Aset</th>
          <th scope="col">Tanggal Perolehan</th>
          <th scope="col">Nilai Ekonomis</th>
          <th scope="col">Nilai Residu</th>
          <th scope="col">Umur Ekonomis</th>
          <th scope="col">Sisa Umur Ekonomis</th>
          <th scope="col">Biaya Penyusutan</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($asets as $a) : ?>
        <tr>
          <th scope="row"><?= $a['kode_aset']; ?></th>
          <td><?= $a['nama_aset']; ?></td>
          <?php $nama_kategori =  $kategori->cariKategoriByID($a['id_kategori'])[0]["nama_kategori"];?>
          <td><?= $nama_kategori; ?></td>
          <td><?= $a['jumlah_aset']; ?></td>
          <td><?= $a['tanggal_perolehan']; ?></td>
          <td>Rp. <?= number_format($a['nilai_ekonomis'],0,",","."); ?></td>
          <td>Rp. <?= number_format($a['nilai_residu'],0,",","."); ?></td>
          <?php 
            $tanggal_perolehan = new DateTime($a['tanggal_perolehan']);

            $tgl_expired = clone $tanggal_perolehan;
            $umur_ekonomis = $a['umur_ekonomis'];
            $tgl_expired->modify("+$umur_ekonomis years");

            $hari_ini = new DateTime();
            $sisa_umur = $hari_ini->diff($tgl_expired);

          ?>
          <td><?= $a['umur_ekonomis'] ?> tahun</td>
          <td><?= "{$sisa_umur->y} tahun, {$sisa_umur->m} bulan, {$sisa_umur->d} hari." ?></td>
          <td>Rp. <?= number_format($a['biaya_penyusutan'],0,",",".") ?></td>
          <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-lihat" id="button-lihat"
            data-kode="<?= $a['kode_aset'] ?>" data-nama="<?= $a['nama_aset'] ?>"
            data-kategori="<?= $nama_kategori ?>" data-jumlah="<?= $a['jumlah_aset'] ?>"
            data-tanggal="<?= $a['tanggal_perolehan'] ?>" data-gambar="<?= $a['gambar'] ?>"
            data-nilai-ekonomis="<?= $a['nilai_ekonomis'] ?>" data-nilai-residu="<?= $a['nilai_residu'] ?>"
            data-biaya-penyusutan="<?= $a['biaya_penyusutan'] ?>" data-umur-ekonomis="<?= $a['umur_ekonomis'] ?>">
              lihat
            </button>
            <a href="<?= PAGES_PATH ?>aset/ubah-data.php?kode_aset=<?= $a["kode_aset"]; ?>&nama_aset=<?= $a["nama_aset"]; ?>&jumlah=<?= $a["jumlah_aset"]; ?>&tanggal=<?= $a["tanggal_perolehan"]; ?>&id_aset=<?= $a['id'] ?>&id_kategori=<?= $a['id_kategori'] ?>&nilai_ekonomis=<?= $a['nilai_ekonomis'] ?>&nilai_residu=<?= $a['nilai_residu'] ?>&umur_ekonomis=<?= $a['umur_ekonomis'] ?>&gambar=<?= $a['gambar'] ?>" 
            type="button" class="btn btn-success my-2">Ubah</a>
            <a href="" type="button" class="btn btn-danger my-2 hapus" data-id="<?= $a['id'] ?>" data-gambar="<?= $a['gambar'] ?>">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-lihat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Aset</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="" id="gambar" style="width:100%;" >
        <ul class="list-group mt-3">
          <li class="list-group-item active" aria-current="true" id="kode"></li>
          <li class="list-group-item" id="nama"></li>
          <li class="list-group-item" id="kategori"></li>
          <li class="list-group-item" id="jumlah"></li>
          <li class="list-group-item" id="tanggal"></li>
          <li class="list-group-item" id="nilai_ekonomis"></li>
          <li class="list-group-item" id="nilai_residu"></li>
          <li class="list-group-item" id="umur_ekonomis"></li>
          <li class="list-group-item" id="biaya_penyusutan"></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    const jumlah = $(this).data('jumlah');
    const tanggal = $(this).data('tanggal');
    const gambar = $(this).data('gambar');
    const umur_ekonomis = $(this).data('umur-ekonomis');
    const nilai_ekonomis = $(this).data('nilai-ekonomis');
    const nilai_residu = $(this).data('nilai-residu');
    const biaya_penyusutan = $(this).data('biaya-penyusutan');

    $('#modal-lihat #kode').html('<b>KODE ASET : </b>'+kode);
    $('#modal-lihat #nama').html('<b>Nama Aset : </b>'+nama);
    $('#modal-lihat #kategori').html('<b>Kategori : </b>'+kategori);
    $('#modal-lihat #jumlah').html('<b>Jumlah Aset : </b>'+jumlah);
    $('#modal-lihat #tanggal').html('<b>Tanggal Perolehan : </b>'+tanggal);
    $('#modal-lihat #nilai_ekonomis').html('<b>Nilai Ekonomis : </b>'+nilai_ekonomis);
    $('#modal-lihat #nilai_residu').html('<b>Nilai Residu : </b>'+nilai_residu);
    $('#modal-lihat #biaya_penyusutan').html('<b>Biaya : </b>'+biaya_penyusutan);
    $('#modal-lihat #umur_ekonomis').html('<b>Biaya : </b>'+umur_ekonomis);
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
