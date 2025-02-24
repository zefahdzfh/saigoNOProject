<?php
include 'koneksi.php';

// Periksa apakah ada ID pelanggan yang dikirim via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE idpelanggan = $id");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='?page=pelanggan';</script>";
        exit();
    }
}

// Proses update pelanggan
if (isset($_POST['update_pelanggan'])) {
    $id = $_POST['idpelanggan'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['namapelanggan']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $noHp = mysqli_real_escape_string($koneksi, $_POST['nohp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $query = mysqli_query($koneksi, "UPDATE pelanggan SET namapelanggan='$nama', jeniskelamin='$jenis_kelamin', nohp='$noHp', alamat='$alamat' WHERE idpelanggan='$id'");

    if ($query) {
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location.href='?page=pelanggan';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=pelanggan">Pelanggan</a></li>
        <li class="breadcrumb-item active">Edit Data Pelanggan</li>
    </ol>
    <a href="?page=pelanggan" class="btn btn-primary mb-3">Kembali</a>

    <div class="card">
        <div class="card-header">
            Edit Pelanggan
        </div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="idpelanggan" value="<?= htmlspecialchars($data['idpelanggan']); ?>">
                
                <div class="mb-3">
                    <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" value="<?= htmlspecialchars($data['namapelanggan']); ?>" placeholder="Masukkan nama pelanggan" required>
                </div>
                
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki" <?= ($data['jeniskelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?= ($data['jeniskelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="nohp" class="form-label">No Hp</label>
                    <input type="number" class="form-control" id="nohp" name="nohp" value="<?= htmlspecialchars($data['nohp']); ?>" placeholder="Masukkan nomor hp" required>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="Masukkan alamat" required><?= htmlspecialchars($data['alamat']); ?></textarea>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-danger me-2">Reset</button>
                    <button type="submit" name="update_pelanggan" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
