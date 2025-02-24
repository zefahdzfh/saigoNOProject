<?php
include 'koneksi.php';

// Pastikan ada ID pesanan yang dikirim
if (isset($_GET['id'])) {
    $idpesanan = $_GET['id'];

    // Update status pembayaran menjadi "Sudah Dibayar"
    $query = mysqli_query($koneksi, "UPDATE pesanan SET status = 'Sudah Dibayar' WHERE idpesanan = '$idpesanan'");

    if ($query) {
        echo "<script>alert('Pembayaran berhasil!'); window.location.href='?page=transaksi';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui status pembayaran!'); window.location.href='?page=transaksi';</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid!'); window.location.href='?page=transaksi';</script>";
}
