<?php
include 'koneksi.php';

// Proses tambah pelanggan
if (isset($_POST['namapelanggan'])) {
    $nama = $_POST['namapelanggan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $noHp = $_POST['nohp'];
    $alamat = $_POST['alamat'];

    // Query tambah data
    $query = mysqli_query($koneksi, "INSERT INTO pelanggan(namapelanggan, jeniskelamin, nohp, alamat) 
                                     VALUES ('$nama', '$jenis_kelamin', '$noHp', '$alamat')");
    if ($query) {
        echo "<script>alert('Tambah Data Berhasil');</script>";
    } else {
        echo "<script>alert('Tambah Data Gagal');</script>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="?page=pelanggan">Pelanggan</a></li>
        <li class="breadcrumb-item active">Tambah Data</li>
    </ol>
    <a href="?page=pelanggan" class="btn btn-primary mb-3">Kembali</a>
    
    <div class="card">
        <div class="card-header">
            Tambah Pelanggan
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="namapelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" placeholder="Masukkan nama pelanggan" required>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nohp" class="form-label">No Hp</label>
                    <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Masukkan nomor hp" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Masukkan alamat" required></textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-danger me-2">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
