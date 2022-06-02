-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2022 at 07:14 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian_ptsp_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `layanan` varchar(32) NOT NULL,
  `no` int(11) NOT NULL,
  `ke` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `tanggal` date NOT NULL,
  `diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `layanan`, `no`, `ke`, `status`, `tanggal`, `diperbarui`) VALUES
(1, 'pengaduan', 1, 'pengaduan', 'menunggu', '2022-06-01', '2022-06-01 04:53:50'),
(2, 'produk', 2, 'produk', 'menunggu', '2022-06-01', '2022-06-01 04:53:58'),
(3, 'produk', 3, 'produk', 'menunggu', '2022-06-01', '2022-06-01 04:54:59'),
(4, 'pengaduan', 4, 'pengaduan', 'menunggu', '2022-06-01', '2022-06-01 04:59:48'),
(5, 'produk', 5, 'produk', 'menunggu', '2022-06-01', '2022-06-01 05:01:28'),
(6, 'pengaduan', 6, 'pengaduan', 'menunggu', '2022-06-01', '2022-06-01 05:08:48'),
(7, 'pengaduan', 7, 'pengaduan', 'menunggu', '2022-06-01', '2022-06-01 05:10:58'),
(8, 'produk', 8, 'produk', 'menunggu', '2022-06-01', '2022-06-01 05:11:40'),
(9, 'ecourt', 9, 'ecourt', 'menunggu', '2022-06-01', '2022-06-01 05:12:53'),
(10, 'kasir', 10, 'kasir', 'menunggu', '2022-06-01', '2022-06-01 05:15:01'),
(11, 'kasir', 11, 'kasir', 'menunggu', '2022-06-01', '2022-06-01 05:16:02'),
(12, 'pengaduan', 12, 'pengaduan', 'menunggu', '2022-06-01', '2022-06-01 05:16:09'),
(13, 'pengaduan', 13, 'pengaduan', 'menunggu', '2022-06-01', '2022-06-01 05:32:53'),
(14, 'produk', 14, 'produk', 'menunggu', '2022-06-01', '2022-06-01 05:43:21'),
(15, 'kasir', 15, 'kasir', 'menunggu', '2022-06-01', '2022-06-01 05:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `panggil`
--

CREATE TABLE `panggil` (
  `id` int(11) NOT NULL,
  `no` int(3) DEFAULT NULL,
  `layanan` varchar(32) NOT NULL,
  `pengumuman` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` int(11) NOT NULL,
  `kode` varchar(2) NOT NULL,
  `layanan` varchar(16) NOT NULL,
  `nama_layanan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `kode`, `layanan`, `nama_layanan`) VALUES
(1, 'A', 'pengaduan', 'Pengaduan dan Informasi'),
(2, 'B', 'pendaftaran', 'Pendaftaran'),
(3, 'C', 'produk', 'Pengambilan Produk'),
(4, 'D', 'ecourt', 'E-Court'),
(5, 'E', 'kasir', 'Kasir'),
(6, 'F', 'posbakum', 'Posbakum'),
(7, 'G', 'bank', 'Bank'),
(8, 'H', 'pos', 'POS'),
(9, 'Z', 'semua', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `token` text NOT NULL,
  `nama_pa` varchar(255) NOT NULL,
  `nama_pa_pendek` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`token`, `nama_pa`, `nama_pa_pendek`) VALUES
('a167ac3f-0aff-3d49-a730-e159bf185fa0', 'Tenggarong', 'PA.Tgr');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `layanan` varchar(32) NOT NULL,
  `role` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `layanan`, `role`) VALUES
(1, 'Administrator', 'admin', '7dc7e4f139a47bc76fa2e37dc75365d937820d6af24be64fe4cdd51d48809795771dec69b15bfe1f59da4d0ed4dca30338911303973b2a2ecb87ac7599b6c47f', 'Administrator', 'admin'),
(2, 'wa', 'su', 'wasu', 'Pengaduan dan Informasi', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panggil`
--
ALTER TABLE `panggil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`),
  ADD UNIQUE KEY `layanan` (`nama_layanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `layanan` (`layanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `panggil`
--
ALTER TABLE `panggil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`layanan`) REFERENCES `ruang` (`nama_layanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
