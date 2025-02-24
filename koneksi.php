<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$koneksi = mysqli_connect("localhost", "root", "root", "ze_resto");

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
