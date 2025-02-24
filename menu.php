<div class="container-fluid px-4">
    <h1 class="mt-4">Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Menu</li>
    </ol>
    <a href="?page=menu_tambah" class="btn btn-primary mb-3">+ Tambah Data</a>
    <div class="row">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM menu");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($data['namamenu']) ?></h5>
                    <p class="card-text">
                        <strong>Harga:</strong> <?= htmlspecialchars($data['harga']) ?>
                    </p>
                    <a href="?page=menu_ubah&&id=<?= $data['idmenu']; ?>" class="btn btn-secondary">Ubah</a>
                    <a href="?page=menu_hapus&&id=<?= $data['idmenu']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
