-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2020 at 12:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beritaacara`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, '123456', '96dbc6d521658daf3d1bfc07e5cdec1bd7a6cfda2cbfc78f6e6d3ae1f6101fae2f63c4507ca478a1d1f64e0dc778b0073cc8b53ea5ec74db02d09f7ea88d6b57');

-- --------------------------------------------------------

--
-- Table structure for table `berita_acara`
--

CREATE TABLE `berita_acara` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `file` varchar(200) NOT NULL,
  `ttd_dosen_pembimbing` tinyint(4) DEFAULT NULL,
  `ttd_ketua_penguji` tinyint(4) DEFAULT NULL,
  `ttd_dosen_penguji` tinyint(4) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `id_dosen_pembimbing` int(11) DEFAULT NULL,
  `id_ketua_penguji` int(11) DEFAULT NULL,
  `id_dosen_penguji` int(11) DEFAULT NULL,
  `nilai` varchar(5) DEFAULT NULL,
  `nilai_final` varchar(5) DEFAULT NULL,
  `max_revisi` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(25) DEFAULT NULL,
  `comment_dosen_pembimbing` text DEFAULT NULL,
  `comment_ketua_penguji` text DEFAULT NULL,
  `comment_dosen_penguji` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `toefl_file` varchar(200) DEFAULT NULL,
  `toefl_file_verified` tinyint(4) DEFAULT NULL,
  `transkrip_file` varchar(200) DEFAULT NULL,
  `transkrip_file_verified` tinyint(4) DEFAULT NULL,
  `skripsi_file` varchar(200) DEFAULT NULL,
  `skripsi_file_verified_dosen_pembimbing` tinyint(4) DEFAULT NULL,
  `skripsi_file_verified_ketua_penguji` tinyint(4) DEFAULT NULL,
  `skripsi_file_verified_dosen_penguji` tinyint(4) DEFAULT NULL,
  `skripsi_file_revisi_dosen_pembimbing` varchar(200) DEFAULT NULL,
  `skripsi_file_revisi_ketua_penguji` varchar(200) DEFAULT NULL,
  `skripsi_file_revisi_dosen_penguji` varchar(200) DEFAULT NULL,
  `bimbingan_file` varchar(200) DEFAULT NULL,
  `bimbingan_file_verified` tinyint(4) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nomor`, `nama`, `password`) VALUES
(1, '195412191980031003', 'Drs. Djalal Er Riyanto, M.I.Komp', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604'),
(2, '195504071983031003', 'Drs. Suhartono, M.Kom', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604'),
(3, '196511071992031003', 'Drs. Eko Adi Sarwoko, M.Kom', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604'),
(4, '197007051997021001', 'Priyo Sidik Sasongko, S.Si, M.Kom', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604'),
(5, '197108111997021001', 'Aris Sugiharto, S.Si, M.Kom', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604');

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_berakhir` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `tanggal_mulai`, `tanggal_berakhir`) VALUES
(1, '2020-03-26', '2020-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `judul` text DEFAULT NULL,
  `id_dosen_pembimbing` int(11) DEFAULT NULL,
  `id_ketua_penguji` int(11) DEFAULT NULL,
  `id_dosen_penguji` int(11) DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen_pembimbing` (`id_dosen_pembimbing`),
  ADD KEY `id_ketua_penguji` (`id_ketua_penguji`),
  ADD KEY `id_dosen_penguji` (`id_dosen_penguji`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dosen_pembimbing` (`id_dosen_pembimbing`),
  ADD KEY `id_ketua_penguji` (`id_ketua_penguji`),
  ADD KEY `id_dosen_penguji` (`id_dosen_penguji`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita_acara`
--
ALTER TABLE `berita_acara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD CONSTRAINT `berita_acara_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `berita_acara_ibfk_2` FOREIGN KEY (`id_dosen_pembimbing`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `berita_acara_ibfk_3` FOREIGN KEY (`id_ketua_penguji`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `berita_acara_ibfk_4` FOREIGN KEY (`id_dosen_penguji`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `berkas`
--
ALTER TABLE `berkas`
  ADD CONSTRAINT `berkas_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_dosen_pembimbing`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_ketua_penguji`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_dosen_penguji`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
