<?php
include 'koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Pesanan tidak ditemukan.");
}

$id_pesanan = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data transaksi berdasarkan ID pesanan
$query = mysqli_query($koneksi, 
    "SELECT pesanan.idpesanan, pelanggan.namapelanggan, menu.namamenu, pesanan.jumlah, 
            menu.harga, (menu.harga * pesanan.jumlah) AS total_harga, pesanan.status
     FROM pesanan
     INNER JOIN pelanggan ON pesanan.idpelanggan = pelanggan.idpelanggan
     INNER JOIN menu ON pesanan.idmenu = menu.idmenu
     WHERE pesanan.idpesanan = '$id_pesanan'"
);

$data = mysqli_fetch_array($query);
if (!$data) {
    die("Transaksi tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <link href="css/styles.css" rel="stylesheet">
    <style>
        .struk {
            width: 300px;
            padding: 20px;
            border: 1px solid #000;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <div class="struk">
        <p><strong>ID Pesanan:</strong> <?= htmlspecialchars($data['idpesanan']) ?></p>
        <p><strong>Nama Pelanggan:</strong> <?= htmlspecialchars($data['namapelanggan']) ?></p>
        <p><strong>Nama Pesanan:</strong> <?= htmlspecialchars($data['namamenu']) ?></p>
        <p><strong>Harga Satuan:</strong> Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
        <p><strong>Jumlah:</strong> <?= htmlspecialchars($data['jumlah']) ?></p>
        <p><strong>Total Bayar:</strong> Rp <?= number_format($data['total_harga'], 0, ',', '.') ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($data['status']) ?></p>
        <hr>
        <p class="text-center">Terima Kasih!</p>
        <button onclick="window.print();">Cetak Struk</button>
    </div>
</body>
</html>
