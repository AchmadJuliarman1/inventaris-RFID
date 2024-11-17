
<style>
    .sidebar {
      height: 100vh;
      width: 15vw;
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
  </style>
</head>
<body>
  <div class="d-flex">  
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
      <ul class="nav flex-column">
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH; ?>" class="nav-link"><i class="fas fa-home me-2"></i> Halaman Utama</a>
        </li>
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH ?>aset/" class="nav-link"><i class="fas fa-font me-2"></i> Pengadaan</a>
        </li>
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH ?>" class="nav-link"><i class="fas fa-palette me-2"></i> Kelola Data User</a>
        </li>
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH ?>" class="nav-link"><i class="fas fa-icons me-2"></i> Kelola Data Kategori</a>
        </li>
        <li class="nav-item mb-2">
          <a href="<?= PAGES_PATH ?>" class="nav-link"><i class="fas fa-sign-in-alt me-2"></i> Kelola Data RFID</a>
        </li>
      </ul>
    </nav>
    
