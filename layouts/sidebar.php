
<style>
    .sidebar {
      height: 100vh;
      width: 15vw;
      font-size: 0.7vw;
      font-family: "Roboto Mono", monospace;
      background-color: #f4f7fd;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }
    .sidebar .nav-link {
      color: #555;
      transition: background-color 0.3s, color 0.3s;
      border-radius: 5px;
    }
    .sidebar .nav-link:hover {
      background-color: #dce5ff;
      color: #007bff;
    }
    .upgrade-section {
      margin-top: auto;
      text-align: center;
      background-color: #e8f0ff;
      padding: 15px;
      border-radius: 5px;
    }
    .upgrade-section a {
      text-decoration: none;
      font-weight: bold;
      color: #007bff;
    }
    .nav-link.active{
      background-color: #dce5ff;
      color: #007bff;
    }
    .nav:hover> :not(:hover) {
      filter:blur(0.8px);
      opacity: 0.6;
    }
  </style>
</head>
<body>
  <?php 
    $folder_name = explode('\\', getcwd()); 
    if(!isset($folder_name[5])){
      $folder_name = "";
    }else{
      $folder_name = $folder_name[5];
    }
  ?>
  <div class="d-flex">  
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH; ?>" class="nav-link <?= $folder_name == "" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
                <img src="<?= ICONS_PATH ?>home.png" style="width: 2vw ;"> <div class="px-1">Halaman Utama</div>
            </div>
          </a>
        </li>
        <hr>
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH ?>aset/" class="nav-link <?= $folder_name == "aset" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
                <img src="<?= ICONS_PATH ?>aset.png" style="width: 2vw ;"> <div class="px-1">Pengadaan</div>
            </div>
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH ?>user/" class="nav-link <?= $folder_name == "user" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
                <img src="<?= ICONS_PATH ?>users.png" style="width: 2vw ;"> <div class="px-1">Kelola Data User</div>
            </div>
          </a>
        </li>
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH ?>kategori/" class="nav-link <?= $folder_name == "kategori" ? "active" : ""; ?>">
            <div class="d-flex align-items-center">
              <img src="<?= ICONS_PATH ?>category.png" style="width: 2vw ;"> <div class="px-1">Kelola Data Kategori</div>
            </div>
          </a>
        </li>
      </ul>
    </nav>
    
