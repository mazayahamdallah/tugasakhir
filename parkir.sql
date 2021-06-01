-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: kantong-parkir.cnfp38hsrtd7.us-east-1.rds.amazonaws.com
-- Generation Time: Jun 01, 2021 at 03:38 PM
-- Server version: 8.0.20
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `uid` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`uid`, `time`) VALUES
('938003602170', '2021-05-07 21:20:47'),
('1063748330094', '2021-05-07 22:18:47'),
('167922053858', '2021-05-17 21:05:57'),
('994442032135', '2021-05-17 21:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `nama_pengguna` varchar(15) NOT NULL,
  `nip` int NOT NULL,
  `unit` varchar(10) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tanda_aktif` enum('1','0','','') NOT NULL,
  `tanda_dihapus` enum('1','0','','') NOT NULL,
  `tanggal_dibuat` datetime NOT NULL,
  `tanggal_dihapus` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `nip`, `unit`, `jenis_kelamin`, `tanda_aktif`, `tanda_dihapus`, `tanggal_dibuat`, `tanggal_dihapus`) VALUES
(1, 'jarwo', 12345, 'IT', 'L', '1', '0', '2018-01-15 00:00:00', '0000-00-00 00:00:00'),
(2, 'sodron', 12345, 'IT', 'L', '1', '0', '2018-01-15 00:00:00', '2018-01-15 00:00:00'),
(3, 'gondes', 54321, 'IT', 'L', '1', '0', '2018-01-16 00:00:00', '2018-01-16 09:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `plat_nomor`
--

CREATE TABLE `plat_nomor` (
  `id_plat` int NOT NULL,
  `text_plat` varchar(10) NOT NULL,
  `kepunyaan` int NOT NULL,
  `tanggal_dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plat_nomor`
--

INSERT INTO `plat_nomor` (`id_plat`, `text_plat`, `kepunyaan`, `tanggal_dibuat`) VALUES
(1, 'AB1895KA', 1, '2018-01-15 00:00:00'),
(2, 'D5161JX', 2, '2018-01-15 00:00:00'),
(3, 'B9320VUA', 3, '2018-01-16 09:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `track_plat`
--

CREATE TABLE `track_plat` (
  `id_track` int NOT NULL,
  `plat_no` varchar(10) NOT NULL,
  `waktu_datang` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_pergi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_plat`
--

INSERT INTO `track_plat` (`id_track`, `plat_no`, `waktu_pergi`) VALUES
(27, 'B9320VUA', '2020-12-08 10:53:38'),
(28, 'B9320VUA', '2020-12-08 10:53:38'),
(29, 'B9320VUA', '2020-12-08 10:53:38'),
(32, 'B9320VUA', NULL),
(33, 'B9320VUA', NULL),
(34, 'D5161JX', NULL),
(35, 'D5161JX', NULL),
(36, 'B9320VUA', NULL),
(37, 'B9320VUA', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `plat_nomor`
--
ALTER TABLE `plat_nomor`
  ADD PRIMARY KEY (`id_plat`);

--
-- Indexes for table `track_plat`
--
ALTER TABLE `track_plat`
  ADD PRIMARY KEY (`id_track`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plat_nomor`
--
ALTER TABLE `plat_nomor`
  MODIFY `id_plat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `track_plat`
--
ALTER TABLE `track_plat`
  MODIFY `id_track` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
