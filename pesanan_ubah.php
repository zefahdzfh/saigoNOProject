<?php
include 'koneksi.php';

// Ambil ID pesanan dari parameter URL
$idpesanan = $_GET['id'];

// Ambil data pesanan berdasarkan ID
$query_pesanan = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE idpesanan = '$idpesanan'");
$data_pesanan = mysqli_fetch_assoc($query_pesanan);

// Jika pesanan tidak ditemukan, redirect ke halaman daftar pesanan
if (!$data_pesanan) {
    echo "<script>alert('Pesanan tidak ditemukan!'); window.location.href='?page=pesanan';</script>";
    exit;
}

// Proses Update Pesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['idpelanggan']);
    $id_menu = mysqli_real_escape_string($koneksi, $_POST['idmenu']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);

    // Query update data pesanan
    $query = mysqli_query($koneksi, "UPDATE pesanan SET 
                                     idpelanggan = '$id_pelanggan', 
                                     idmenu = '$id_menu', 
                                     jumlah = '$jumlah' 
                                     WHERE idpesanan = '$idpesanan'");

    if ($query) {
        echo "<script>alert('Pesanan Berhasil Diperbarui'); window.location.href='?page=pesanan';</script>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal Memperbarui Pesanan: " . mysqli_error($koneksi) . "</div>";
    }
}

// Ambil daftar pelanggan
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

// Ambil daftar menu
$menu = mysqli_query($koneksi, "SELECT * FROM menu");
?>

<div class="container mt-4">
    <h1 class="mb-4">Ubah Pesanan</h1>

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
                            <option value="<?= $row['idpelanggan']; ?>" 
                                <?= ($row['idpelanggan'] == $data_pesanan['idpelanggan']) ? 'selected' : ''; ?>>
                                <?= $row['namapelanggan']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="idmenu" class="form-label">Nama Menu</label>
                    <select class="form-control" id="idmenu" name="idmenu" required>
                        <option value="">-- Pilih Menu --</option>
                        <?php while ($row = mysqli_fetch_assoc($menu)) { ?>
                            <option value="<?= $row['idmenu']; ?>" 
                                <?= ($row['idmenu'] == $data_pesanan['idmenu']) ? 'selected' : ''; ?>>
                                <?= $row['namamenu']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Pesanan</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" 
                        value="<?= $data_pesanan['jumlah']; ?>" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="?page=pesanan" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
</div>
