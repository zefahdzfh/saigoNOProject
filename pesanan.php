<div class="container-fluid px-4">
    <h1 class="mt-4">Pesanan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pesanan</li>
    </ol>
    <a href="?page=pesanan_tambah" class="btn btn-primary mb-3">+ Tambah Data</a>
    
    <div class="row">
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
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($data['namapelanggan']); ?></h5>
                    <p class="card-text">
                        <strong>Nama Pesanan:</strong> <?= htmlspecialchars($data['namamenu']); ?><br>
                        <strong>Jumlah Pesanan:</strong> <?= htmlspecialchars($data['jumlah']); ?>
                    </p>
                    <a href="?page=pesanan_ubah&id=<?= $data['idpesanan']; ?>" class="btn btn-secondary">Ubah</a>
                    <a href="?page=pesanan_hapus&id=<?= $data['idpesanan']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
