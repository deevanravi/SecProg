-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 04:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prg5_20221`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_mobil`
--

CREATE TABLE `jenis_mobil` (
  `id_jenis_Mobil` varchar(5) NOT NULL,
  `nama_jenis_Mobil` varchar(50) NOT NULL,
  `status_jenis_Mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_mobil`
--

INSERT INTO `jenis_mobil` (`id_jenis_Mobil`, `nama_jenis_Mobil`, `status_jenis_Mobil`) VALUES
('JM001', 'Sedan', 1),
('JM002', 'MPV', 1),
('JM003', 'SUV', 1),
('JM004', 'Sport', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id_Mobil` varchar(5) NOT NULL,
  `id_jenis_Mobil` varchar(5) NOT NULL,
  `nama_Mobil` varchar(50) NOT NULL,
  `stok_Mobil` int(11) NOT NULL,
  `harga_Mobil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id_Mobil`, `id_jenis_Mobil`, `nama_Mobil`, `stok_Mobil`, `harga_Mobil`) VALUES
('RM001', 'JM001', 'Honda City', 8, 210000000),
('RM004', 'JM002', 'Suzuki APV', 11, 135000000),
('RM006', 'JM002', 'Toyota Avanza', 1, 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(5) NOT NULL,
  `id_Mobil` varchar(5) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `diskon_penjualan` int(11) NOT NULL,
  `harga_penjualan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_Mobil`, `tanggal_penjualan`, `diskon_penjualan`, `harga_penjualan`) VALUES
('PJ001', 'RM001', '2022-11-10', 0, 210000000),
('PJ002', 'RM001', '2022-11-10', 0, 210000000),
('PJ003', 'RM004', '2022-11-10', 5, 128250000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(6) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `email`, `telepon`) VALUES
('US001', 'admin', 'admin', 'Admin', 'admin123@gmai.com', 81319021),
('US002', 'kasir', 'kasir', 'Kasir', 'kasir123@gmail.com', 1293123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_mobil`
--
ALTER TABLE `jenis_mobil`
  ADD PRIMARY KEY (`id_jenis_Mobil`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_Mobil`),
  ADD KEY `id_jenis_Mobil` (`id_jenis_Mobil`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `FK_id_mobil` (`id_Mobil`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `FK_id_jenis` FOREIGN KEY (`id_jenis_Mobil`) REFERENCES `jenis_mobil` (`id_jenis_Mobil`) ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `FK_id_mobil` FOREIGN KEY (`id_Mobil`) REFERENCES `mobil` (`id_Mobil`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
