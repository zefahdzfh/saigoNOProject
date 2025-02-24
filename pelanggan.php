<?php
include 'koneksi.php'; // Pastikan koneksi database dimasukkan di awal
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pelanggan</li>
    </ol>
    <a href="?page=pelanggan_tambah" class="btn btn-primary mb-3">+ Tambah Data</a>
    <div class="row">
        <?php
        // Cek koneksi sebelum melakukan query
        if ($koneksi) {
            $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
            while ($data = mysqli_fetch_array($query)) {
        ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($data['namapelanggan']) ?></h5>
                    <p class="card-text">
                        <strong>Jenis Kelamin:</strong> <?= htmlspecialchars($data['jeniskelamin']) ?><br>
                        <strong>No Hp:</strong> <?= htmlspecialchars($data['nohp']) ?><br>
                        <strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']) ?>
                    </p>
                    <a href="?page=pelanggan_ubah&id=<?= $data['idpelanggan']; ?>" class="btn btn-secondary">Ubah</a>
                    <a href="?page=pelanggan_hapus&id=<?= $data['idpelanggan']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='col-12'><div class='alert alert-danger'>Koneksi database tidak tersedia!</div></div>";
        }
        ?>
    </div>
</div>
