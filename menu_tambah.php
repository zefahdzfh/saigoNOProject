<?php
// Pastikan koneksi database sudah di-include
include 'koneksi.php';

// Proses tambah menu
if (isset($_POST['namamenu'])) {
    $nama = $_POST['namamenu'];
    $harga = $_POST['harga'];

    // Query tambah data
    $query = mysqli_query($koneksi, "INSERT INTO menu(namamenu, harga) VALUES('$nama', '$harga')");
    if ($query) {
        echo "<script>alert('Tambah Data Berhasil');</script>";
    } else {
        echo "<script>alert('Tambah Data Gagal');</script>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=menu">Menu</a></li>
        <li class="breadcrumb-item active">Tambah Data</li>
    </ol>
    <a href="?page=menu" class="btn btn-primary mb-3">Kembali</a>
    
    <div class="card">
        <div class="card-header">
            Tambah Menu
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="namamenu" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="namamenu" name="namamenu" placeholder="Masukkan nama menu" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" step="0" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-danger me-2">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
