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
            <button type="button" class="btn btn-primary">Lihat</button>
            <a href="<?= PAGES_PATH ?>aset/ubah-data.php?kode_aset=<?= $a["kode_aset"]; ?>&nama_aset=<?= $a["nama_aset"]; ?>&stok=<?= $a["stok"]; ?>&created_at=<?= $a["created_at"]; ?>&id_aset=<?= $a['id'] ?>&id_kategori=<?= $a['id_kategori'] ?>" 
              type="button" class="btn btn-success my-2">Ubah</a>
            <a href="<?= PAGES_PATH ?>aset/hapus-data.php?id=<?= $a['id'] ?>" type="button" class="btn btn-danger my-2">Hapus</a>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php include_once LAYOUTS_PATH."footer.php";?>
