<div class="container-fluid px-4">
    <h1 class="mt-4">Pesanan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pesanan</li>
    </ol>
    <a href="?page=pesanan_tambah" class="btn btn-primary">+ Tambah Data</a>
    <hr>
    <table class="table">
        <tr>
            <th>Nama Pelanggan</th>
            <th>Nama Pesanan</th>
            <th>Jumlah Pesanan</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Query dengan JOIN untuk mengambil data dari tabel pesanan, pelanggan, dan menu
        $query = mysqli_query($koneksi, 
            "SELECT pelanggan.namapelanggan, menu.namamenu, pesanan.jumlah, pesanan.idpesanan 
            FROM pesanan 
            INNER JOIN pelanggan ON pesanan.idpelanggan = pelanggan.idpelanggan
            INNER JOIN menu ON pesanan.idmenu = menu.idmenu"
        );

        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?= htmlspecialchars($data['namapelanggan']) ?></td>
            <td><?= htmlspecialchars($data['namamenu']) ?></td>
            <td><?= htmlspecialchars($data['jumlah']) ?></td>
            <td>
                <a href="?page=pesanan_ubah&id=<?= $data['idpesanan']; ?>" class="btn btn-secondary">Ubah</a>
                <a href="?page=pesanan_hapus&id=<?= $data['idpesanan']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
