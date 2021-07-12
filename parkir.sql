-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2021 at 04:13 PM
-- Server version: 10.1.34-MariaDB
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
  `id_card` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `waktu_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `waktu_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id_card`, `uid`, `waktu_in`, `waktu_out`) VALUES
(15, '1063748330094', '2021-07-02 03:27:29', '2021-07-06 15:38:08'),
(16, '1063748330094', '2021-07-06 14:57:05', '2021-07-06 15:38:08'),
(17, '938003602170', '2021-07-06 15:42:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `data_view`
--

CREATE TABLE `data_view` (
  `id_dataview` int(11) NOT NULL,
  `id_card` int(11) NOT NULL,
  `id_track` int(11) NOT NULL,
  `status` enum('in','out','','') NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `uid` varchar(255) NOT NULL,
  `nama_pengguna` varchar(15) NOT NULL,
  `nim` varchar(18) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`uid`, `nama_pengguna`, `nim`, `fakultas`, `angkatan`) VALUES
('1063748330094', 'Mirna K', '16/401040/SV/11544', 'Sekolah Vokasi', 2016),
('938003602170', 'Mazaya Hamdalla', '16/400630/SV/11134', 'Sekolah Vokasi', 2016),
('994442032135', 'Titis Nadela', '16/400637/SV/11141', 'Sekolah Vokasi', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `plat_nomor`
--

CREATE TABLE `plat_nomor` (
  `id_plat` int(11) NOT NULL,
  `text_plat` varchar(10) NOT NULL,
  `seri_motor` varchar(100) NOT NULL,
  `warna` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plat_nomor`
--

INSERT INTO `plat_nomor` (`id_plat`, `text_plat`, `seri_motor`, `warna`) VALUES
(1, 'AB1895KA', 'Honda Beat', 'Merah'),
(2, 'D5161JX', 'Honda Vario', 'Putih'),
(3, 'B9320VUA', 'Yamaha Mio', 'Hijau');

-- --------------------------------------------------------

--
-- Table structure for table `track_plat`
--

CREATE TABLE `track_plat` (
  `id_track` int(11) NOT NULL,
  `plat_no` varchar(10) NOT NULL,
  `waktu_datang` datetime DEFAULT CURRENT_TIMESTAMP,
  `waktu_pergi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_plat`
--

INSERT INTO `track_plat` (`id_track`, `plat_no`, `waktu_datang`, `waktu_pergi`) VALUES
(1, 'B9320VUA', '2021-07-08 17:39:04', '2021-07-08 17:43:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id_card`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `data_view`
--
ALTER TABLE `data_view`
  ADD KEY `id_card` (`id_card`),
  ADD KEY `id_track` (`id_track`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`uid`);

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
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id_card` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `plat_nomor`
--
ALTER TABLE `plat_nomor`
  MODIFY `id_plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `track_plat`
--
ALTER TABLE `track_plat`
  MODIFY `id_track` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `pengguna` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
