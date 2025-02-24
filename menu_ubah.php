<?php
include 'koneksi.php';

// Ambil data berdasarkan ID menu yang dipilih
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM menu WHERE idmenu = '$id'");
    $data = mysqli_fetch_array($query);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='?page=menu';</script>";
        exit;
    }
}

// Proses update menu
if (isset($_POST['namamenu'])) {
    $id = $_POST['idmenu'];
    $nama = $_POST['namamenu'];
    $harga = $_POST['harga'];

    // Query update
    $query = mysqli_query($koneksi, "UPDATE menu SET namamenu = '$nama', harga = '$harga' WHERE idmenu = '$id'");

    if ($query) {
        echo "<script>alert('Update Data Berhasil'); window.location.href='?page=menu';</script>";
    } else {
        echo "<script>alert('Update Data Gagal');</script>";
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Ubah Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Menu</li>
    </ol>
    <a href="?page=menu" class="btn btn-primary">Kembali</a>
    <hr>

    <form method="post">
        <input type="hidden" name="idmenu" value="<?= $data['idmenu']; ?>">
        <table>
            <tr>
                <td width="200">Nama Menu</td>
                <td width="1">:</td>
                <td><input class="form-control" type="text" name="namamenu" value="<?= htmlspecialchars($data['namamenu']); ?>" required></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input class="form-control" type="number" step="0" name="harga" value="<?= $data['harga']; ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</div>
