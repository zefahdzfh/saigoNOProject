<?php
session_start();
include "koneksi.php";

// Cek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input user
    $namaUser = mysqli_real_escape_string($koneksi, $_POST['namauser']);

    // Query ke database untuk mencari user berdasarkan namauser
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE namauser = '$namaUser'");
    $data = mysqli_fetch_assoc($query);

    // Cek apakah user ditemukan
    if ($data) {
        $_SESSION['user'] = $data['iduser']; // Simpan ID user
        $_SESSION['namauser'] = $data['namauser']; // Simpan namauser untuk multi-role
        
        echo '<script>alert("Selamat Datang!"); location.href="index.php";</script>';
        exit();
    } else {
        echo '<script>alert("Username tidak ditemukan!");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login Ze Resto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f1f1f1;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    .login-form {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }
    .login-form h3 {
      margin-bottom: 1.5rem;
      text-align: center;
      font-weight: 300;
    }
  </style>
</head>
<body>
  <div class="login-form">
    <h3>Login Ze Resto</h3>
    <form method="post">
      <div class="mb-3">
        <label for="inputUsername" class="form-label">Username</label>
        <input type="text" class="form-control" id="inputUsername" name="namauser" placeholder="Masukkan Username" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
