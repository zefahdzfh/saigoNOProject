<?php
include 'koneksi.php';

// Ambil data transaksi dari database
$query = mysqli_query($koneksi, 
    "SELECT pesanan.idpesanan, pelanggan.namapelanggan, menu.namamenu, pesanan.jumlah, 
            (menu.harga * pesanan.jumlah) AS total_harga, pesanan.status
     FROM pesanan
     INNER JOIN pelanggan ON pesanan.idpelanggan = pelanggan.idpelanggan
     INNER JOIN menu ON pesanan.idmenu = menu.idmenu"
);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Transaksi</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Daftar Transaksi</li>
    </ol>
    
    <table class="table">
        <tr>
            <th>Nama Pelanggan</th>
            <th>Nama Pesanan</th>
            <th>Jumlah Pesanan</th>
            <th>Total Harga</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
        </tr>

        <?php if (mysqli_num_rows($query) > 0) { ?>
            <?php while ($data = mysqli_fetch_array($query)) { ?>
            <tr>
                <td><?= htmlspecialchars($data['namapelanggan']) ?></td>
                <td><?= htmlspecialchars($data['namamenu']) ?></td>
                <td><?= htmlspecialchars($data['jumlah']) ?></td>
                <td>Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></td>
                <td>
                    <span class="badge <?= $data['status'] == 'Sudah Dibayar' ? 'bg-success' : 'bg-danger' ?>">
                        <?= htmlspecialchars($data['status']) ?>
                    </span>
                </td>
                <td>
                    <?php if ($data['status'] == 'Belum Dibayar') { ?>
                        <a href="?page=pesanan_bayar&id=<?= $data['idpesanan']; ?>" 
                           class="btn btn-success">Bayar</a>
                    <?php } ?>

                    <?php if ($data['status'] == 'Sudah Dibayar') { ?>
                        <a href="cetak_struk.php?id=<?= $data['idpesanan']; ?>" target="_blank"
                           class="btn btn-primary">Cetak Struk</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada transaksi.</td>
            </tr>
        <?php } ?>
    </table>
</div>
