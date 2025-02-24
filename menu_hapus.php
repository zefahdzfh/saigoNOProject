<?php
include 'koneksi.php';

$id = $_GET['id'];

// Hapus data terkait di tabel pesanan terlebih dahulu
mysqli_query($koneksi, "DELETE FROM pesanan WHERE idmenu = $id");

// Baru hapus dari tabel menu
$query = mysqli_query($koneksi, "DELETE FROM menu WHERE idmenu = $id");

if ($query) {
    echo "<script>
            alert('Hapus Data Berhasil'); location.href='?page=menu';
          </script>";
} else {
    echo "<script>
            alert('Hapus Data Gagal');
          </script>";
}
?>
