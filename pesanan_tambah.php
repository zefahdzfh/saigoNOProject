<?php
include 'koneksi.php';

// Proses Tambah Pesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['idpelanggan']);
    $id_menu = mysqli_real_escape_string($koneksi, $_POST['idmenu']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);

    // Query tambah data ke database
    $query = mysqli_query($koneksi, "INSERT INTO pesanan (idpelanggan, idmenu, jumlah) 
                                     VALUES ('$id_pelanggan', '$id_menu', '$jumlah')");

    if ($query) {
        $pesan = "<div class='alert alert-success'>Pesanan Berhasil Ditambahkan</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal Menambahkan Pesanan: " . mysqli_error($koneksi) . "</div>";
    }
}

// Ambil daftar pelanggan
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

// Ambil daftar menu
$menu = mysqli_query($koneksi, "SELECT * FROM menu");
?>

<div class="container mt-4">
    <h1 class="mb-4">Tambah Pesanan</h1>

    <?php if (isset($pesan)) echo $pesan; ?>

    <a href="?page=pesanan" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="idpelanggan" class="form-label">Nama Pelanggan</label>
                    <select class="form-control" id="idpelanggan" name="idpelanggan" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php while ($row = mysqli_fetch_assoc($pelanggan)) { ?>
                            <option value="<?= $row['idpelanggan']; ?>"><?= $row['namapelanggan']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="idmenu" class="form-label">Nama Menu</label>
                    <select class="form-control" id="idmenu" name="idmenu" required>
                        <option value="">-- Pilih Menu --</option>
                        <?php while ($row = mysqli_fetch_assoc($menu)) { ?>
                            <option value="<?= $row['idmenu']; ?>"><?= $row['namamenu']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Pesanan</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
</div>
