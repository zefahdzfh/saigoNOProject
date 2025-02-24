<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit();
}

// Ambil nama user dari session
$namauser = $_SESSION['namauser'] ?? '';

// Fungsi untuk mengecek akses berdasarkan namauser
function cekAkses($namauser, $aksesYangDiizinkan) {
    return in_array($namauser, $aksesYangDiizinkan);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ze Resto</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      background-color: #f7f7f7;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .navbar-brand {
      font-weight: bold;
      color: #333;
    }
    .nav-link {
      color: #555 !important;
    }
    main {
      flex: 1;
    }
    footer {
      background-color: #ffffff;
      border-top: 1px solid #eaeaea;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">Ze Resto</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Dashboard</a>
          </li>
          <?php if (cekAkses($namauser, ['admin'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=pelanggan">Pelanggan</a>
          </li>
          <?php endif; ?>
          <?php if (cekAkses($namauser, ['admin', 'waiter'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=menu">Menu</a>
          </li>
          <?php endif; ?>
          <?php if (cekAkses($namauser, ['waiter'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=pesanan">Pesanan</a>
          </li>
          <?php endif; ?>
          <?php if (cekAkses($namauser, ['waiter', 'kasir', 'owner'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=transaksi">Transaksi</a>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten Utama -->
  <main class="container my-5">
    <?php
      $page = isset($_GET['page']) ? $_GET['page'] : 'home';

      // Batasan akses halaman
      $aksesHalaman = [
        'pelanggan'      => ['admin'],
        'menu'      => ['admin', 'waiter'],
        'pesanan'   => ['waiter'],
        'transaksi' => ['waiter', 'kasir', 'owner']
      ];

      if (isset($aksesHalaman[$page]) && !cekAkses($namauser, $aksesHalaman[$page])) {
          echo "<div class='alert alert-danger'>Anda tidak memiliki akses ke halaman ini.</div>";
      } else {
          include $page . '.php';
      }
    ?>
  </main>

  <!-- Footer -->
  <footer class="py-3">
    <div class="container text-center">
      <span class="text-muted">&copy; Ze Resto 2025</span>
    </div>
  </footer>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
