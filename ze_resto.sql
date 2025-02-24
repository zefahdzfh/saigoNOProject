-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 05:00 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ze_resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idmenu` int NOT NULL,
  `namamenu` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idmenu`, `namamenu`, `harga`) VALUES
(3, 'Indomie Rebus', 5000),
(4, 'Dimsum', 10000),
(7, 'Mie Bangladesh', 9000),
(8, 'Mie Bangladesh Spesial', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int NOT NULL,
  `namapelanggan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jeniskelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL,
  `nohp` varchar(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(95) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `namapelanggan`, `jeniskelamin`, `nohp`, `alamat`) VALUES
(5, 'Casey', 'Perempuan', '08317214312', 'kalbat'),
(6, 'Bocah punk', 'Perempuan', '0382374724', 'Jakarta'),
(7, 'Spongebob', 'Laki-laki', '0863123456', 'Laut\r\n'),
(8, 'zefa', 'Laki-laki', '021534452', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` int NOT NULL,
  `idmenu` int DEFAULT NULL,
  `idpelanggan` int DEFAULT NULL,
  `jumlah` int NOT NULL,
  `iduser` int DEFAULT NULL,
  `status` enum('Belum Dibayar','Sudah Dibayar') COLLATE utf8mb4_general_ci DEFAULT 'Belum Dibayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `idmenu`, `idpelanggan`, `jumlah`, `iduser`, `status`) VALUES
(6, 8, 7, 2, NULL, 'Sudah Dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int NOT NULL,
  `idpesanan` int DEFAULT NULL,
  `total` int NOT NULL,
  `bayar` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `namauser` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `namauser`) VALUES
(1, 'admin'),
(2, 'waiter'),
(3, 'kasir'),
(4, 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`),
  ADD KEY `idmenu` (`idmenu`),
  ADD KEY `idpelanggan` (`idpelanggan`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `idpesanan` (`idpesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idpelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idpesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`),
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idpesanan`) REFERENCES `pesanan` (`idpesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
