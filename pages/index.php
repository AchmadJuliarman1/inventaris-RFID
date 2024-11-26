<?php include_once $_SERVER['DOCUMENT_ROOT']."/inventaris RFID/layouts/header.php";?>
<?php include_once LAYOUTS_PATH."sidebar.php"; ?>

<div class="container d-flex flex-row align-items-start justify-content-between">
  <div class="card mt-4 text-center text-white" 
  style="width: 15vw; background-image: url('<?= ICONS_PATH ?>/bg1.png'); background-repeat: no-repeat; background-size: cover;" >
    <div class="container">
      <img src="<?= ICONS_PATH ?>/users.png" class="card-img-top" style="width: 10vw;">
    </div>
    <div class="card-body">
      <h5 class="card-title"><span class="badge rounded-pill text-bg-info">Data User</span></h5>
      <p class="card-text"></p>
      <a href="<?= PAGES_PATH ?>/user" class="btn btn-primary">Lihat</a>
    </div>
  </div>
  <div class="card mt-4 text-center text-white" 
  style="width: 15vw; background-image: url('<?= ICONS_PATH ?>/bg1.png'); background-repeat: no-repeat; background-size: cover;" >
    <div class="container">
      <img src="<?= ICONS_PATH ?>/pengadaan.png" class="card-img-top" style="width: 10vw;">
    </div>
    <div class="card-body">
      <h5 class="card-title"><span class="badge rounded-pill text-bg-info">Data Pengadaan</span></h5>
      <p class="card-text"></p>
      <a href="<?= PAGES_PATH ?>/aset" class="btn btn-primary">Lihat</a>
    </div>
  </div>
  <div class="card mt-4 text-center text-white" 
  style="width: 15vw; background-image: url('<?= ICONS_PATH ?>/bg1.png'); background-repeat: no-repeat; background-size: cover;" >
    <div class="container">
      <img src="<?= ICONS_PATH ?>/categories.png" class="card-img-top" style="width: 10vw;">
    </div>
    <div class="card-body">
      <h5 class="card-title"><span class="badge rounded-pill text-bg-info">Data Kategori</span></h5>
      <p class="card-text"></p>
      <a href="<?= PAGES_PATH ?>/kategori" class="btn btn-primary">Lihat</a>
    </div>
  </div>
</div>


<?php include_once LAYOUTS_PATH."footer.php";?>
