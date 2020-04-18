-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 03:56 AM
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

--
-- Dumping data for table `berita_acara`
--

INSERT INTO `berita_acara` (`id`, `id_mahasiswa`, `file`, `ttd_dosen_pembimbing`, `ttd_ketua_penguji`, `ttd_dosen_penguji`, `date`, `time`, `id_dosen_pembimbing`, `id_ketua_penguji`, `id_dosen_penguji`, `nilai`, `nilai_final`, `max_revisi`, `status`, `comment_dosen_pembimbing`, `comment_ketua_penguji`, `comment_dosen_penguji`) VALUES
(19, 11, 'http://192.168.100.5:8000/assets/beritaacara/24060117130048-BeritaAcara-17042020-082046.doc', 1, 1, 1, '2020-04-24', '15:20:00', 11, 12, 15, 'B', 'A', '2020-05-08', 'Lulus', '', '', NULL),
(20, 16, 'http://192.168.100.5:8000/assets/beritaacara/24050117130048-BeritaAcara-18042020-084011.docx', 1, 1, 1, '2020-04-24', '14:10:00', 11, 12, 15, 'B', 'A', '2020-05-08', 'Lulus', NULL, '', NULL),
(21, 12, 'http://192.168.100.5:8000/assets/beritaacara/24060117130050-BeritaAcara-18042020-085434.docx', NULL, NULL, NULL, '2020-04-23', '13:19:00', 12, 11, 15, NULL, NULL, '2020-05-07', NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id`, `id_mahasiswa`, `toefl_file`, `toefl_file_verified`, `transkrip_file`, `transkrip_file_verified`, `skripsi_file`, `skripsi_file_verified_dosen_pembimbing`, `skripsi_file_verified_ketua_penguji`, `skripsi_file_verified_dosen_penguji`, `skripsi_file_revisi_dosen_pembimbing`, `skripsi_file_revisi_ketua_penguji`, `skripsi_file_revisi_dosen_penguji`, `bimbingan_file`, `bimbingan_file_verified`, `time`) VALUES
(42, 11, 'http://192.168.100.5:8000/assets/berkas/24060117130048-TOEFL-17042020-082136.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24060117130048-transkrip-17042020-082145.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24060117130048-skripsi-17042020-082146.pdf', NULL, 0, NULL, NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130048-revisiKetuaPenguji-17042020-083730.pdf', NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130048-kartubimbingan-17042020-082154.pdf', 0, '2020-04-16 19:59:58'),
(43, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-04-16 19:59:58'),
(44, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-04-16 19:59:58'),
(47, 11, 'http://192.168.100.5:8000/assets/berkas/24060117130048-TOEFL-17042020-082136.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24060117130048-transkrip-17042020-082145.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24060117130048-skripsi-17042020-083855.pdf', NULL, 1, NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130048-revisiDosenPembimbing-17042020-083820.pdf', 'http://192.168.100.5:8000/assets/berkas/24060117130048-revisiKetuaPenguji-17042020-083730.pdf', NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130048-kartubimbingan-17042020-083855.pdf', 1, '2020-04-17 08:37:30'),
(48, 11, 'http://192.168.100.5:8000/assets/berkas/24060117130048-TOEFL-17042020-082136.pdf', 0, 'http://192.168.100.5:8000/assets/berkas/24060117130048-transkrip-17042020-082145.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24060117130048-skripsi-17042020-083855.pdf', 1, 0, NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130048-revisiDosenPembimbing-17042020-083820.pdf', 'http://192.168.100.5:8000/assets/berkas/24060117130048-revisiKetuaPenguji-17042020-083730.pdf', NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130048-kartubimbingan-17042020-083855.pdf', 1, '2020-04-17 08:39:50'),
(49, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-04-18 08:27:03'),
(50, 15, 'http://192.168.100.5:8000/assets/berkas/24060117130054-TOEFL-18042020-083222.pdf', NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130054-transkrip-18042020-083222.pdf', NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130054-skripsi-18042020-083223.pdf', NULL, NULL, NULL, NULL, NULL, NULL, 'http://192.168.100.5:8000/assets/berkas/24060117130054-kartubimbingan-18042020-083224.pdf', NULL, '2020-04-18 08:30:32'),
(51, 16, 'http://192.168.100.5:8000/assets/berkas/24050117130048-TOEFL-18042020-083935.pdf', 0, 'http://192.168.100.5:8000/assets/berkas/24050117130048-transkrip-18042020-083933.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24050117130048-skripsi-18042020-083934.pdf', NULL, 0, NULL, NULL, 'http://192.168.100.5:8000/assets/berkas/24050117130048-revisiKetuaPenguji-18042020-084432.pdf', NULL, 'http://192.168.100.5:8000/assets/berkas/24050117130048-kartubimbingan-18042020-083933.pdf', 1, '2020-04-18 08:37:56'),
(52, 16, 'http://192.168.100.5:8000/assets/berkas/24050117130048-TOEFL-18042020-084544.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24050117130048-transkrip-18042020-083933.pdf', 1, 'http://192.168.100.5:8000/assets/berkas/24050117130048-skripsi-18042020-084545.pdf', NULL, 1, NULL, NULL, 'http://192.168.100.5:8000/assets/berkas/24050117130048-revisiKetuaPenguji-18042020-084432.pdf', NULL, 'http://192.168.100.5:8000/assets/berkas/24050117130048-kartubimbingan-18042020-083933.pdf', 1, '2020-04-18 08:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `username`, `password`) VALUES
(1, '12344', '96dbc6d521658daf3d1bfc07e5cdec1bd7a6cfda2cbfc78f6e6d3ae1f6101fae2f63c4507ca478a1d1f64e0dc778b0073cc8b53ea5ec74db02d09f7ea88d6b57');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `file_jadwal` varchar(200) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nomor`, `nama`, `email`, `password`, `file_jadwal`, `last_update`) VALUES
(11, '198104212008121002', 'Panji Wisnu Wirawan, ST, M.T', 'anandaprabu.trityavijaya@gmail.com', '45176585c6e641a3699728ca49781b35c2928f7d1445d80ae60f12294d0e4de3c66ec430661250ae094d70e1ab4ba860c726a5edbd60bb039e1b985b4cd5501a', NULL, '2020-04-16 12:47:39'),
(12, '198104202005012001', 'Dr. Retno Kusumaningrum, S.Si, M.Kom', 'navi270499@gmail.com', '276b8e572f2de9e9352f645197f9718c384c5884e3d87528eb92fb8c5d385d6778c49bf87f4399ea58a9e7f6932af926e71b88df10ccf68a9baeef905fb087f6', NULL, '2020-04-16 12:47:58'),
(13, '198010212005011003', 'Ragil Saputra, S.Si, M.Cs', 'anandaprabu.trityavijaya@gmail.com', '0be8fd5e57b58010caa9e18cb74d82bff3dcefe26111a2f05a6390f3545602a0d5e66182105a2be5466c51bcf394ca9c4537b4a9ab351bfb8c325edc6a1b2a2b', NULL, '2020-04-16 12:56:56'),
(14, '198203092006041002', 'Dr. Eng. Adi Wibowo, S.Si, M.Kom', 'navi270499@gmail.com', '1d793e119247b49a06df5857d5e9a6fa596e558fab8628efe42d2af70887fecc1804f690aceff61fe1c13da0e708e3cef158924a0426ca7e7e5dec18d4d06d69', NULL, '2020-04-16 12:57:38'),
(15, '198511252018032001', 'Rismiyati, B.Eng, M.Cs', 'anandaprabu.trityavijaya@gmail.com', 'd71fdeb89c57d9b930df66be50821df2bf8497fecccba60fee54a7a4079fbe680417bed9b2180d5c7c72787ac0015add1970125c49d789307b49cbb540de0548', NULL, '2020-04-16 12:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_days` int(11) NOT NULL,
  `id_time` int(11) NOT NULL,
  `availability` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `id_dosen`, `id_days`, `id_time`, `availability`) VALUES
(1, 11, 1, 1, 1),
(2, 11, 1, 2, 0),
(3, 11, 1, 3, 0),
(4, 11, 1, 4, 0),
(5, 11, 1, 5, 0),
(6, 11, 1, 6, 0),
(7, 11, 1, 7, 0),
(8, 11, 2, 1, 0),
(9, 11, 2, 2, 0),
(10, 11, 2, 3, 0),
(11, 11, 2, 4, 0),
(12, 11, 2, 5, 0),
(13, 11, 2, 6, 0),
(14, 11, 2, 7, 0),
(15, 11, 3, 1, 0),
(16, 11, 3, 2, 0),
(17, 11, 3, 3, 0),
(18, 11, 3, 4, 0),
(19, 11, 3, 5, 0),
(20, 11, 3, 6, 0),
(21, 11, 3, 7, 0),
(22, 11, 4, 1, 0),
(23, 11, 4, 2, 0),
(24, 11, 4, 3, 1),
(25, 11, 4, 4, 0),
(26, 11, 4, 5, 0),
(27, 11, 4, 6, 0),
(28, 11, 4, 7, 0),
(29, 11, 5, 1, 1),
(30, 11, 5, 2, 1),
(31, 11, 5, 3, 1),
(32, 11, 5, 4, 0),
(33, 11, 5, 5, 1),
(34, 11, 5, 6, 1),
(35, 11, 5, 7, 1),
(36, 12, 1, 1, 1),
(37, 12, 1, 2, 1),
(38, 12, 1, 3, 0),
(39, 12, 1, 4, 0),
(40, 12, 1, 5, 1),
(41, 12, 1, 6, 0),
(42, 12, 1, 7, 0),
(43, 12, 2, 1, 1),
(44, 12, 2, 2, 1),
(45, 12, 2, 3, 0),
(46, 12, 2, 4, 1),
(47, 12, 2, 5, 0),
(48, 12, 2, 6, 0),
(49, 12, 2, 7, 1),
(50, 12, 3, 1, 1),
(51, 12, 3, 2, 0),
(52, 12, 3, 3, 0),
(53, 12, 3, 4, 1),
(54, 12, 3, 5, 0),
(55, 12, 3, 6, 0),
(56, 12, 3, 7, 1),
(57, 12, 4, 1, 0),
(58, 12, 4, 2, 0),
(59, 12, 4, 3, 0),
(60, 12, 4, 4, 0),
(61, 12, 4, 5, 0),
(62, 12, 4, 6, 0),
(63, 12, 4, 7, 0),
(64, 12, 5, 1, 0),
(65, 12, 5, 2, 0),
(66, 12, 5, 3, 0),
(67, 12, 5, 4, 0),
(68, 12, 5, 5, 0),
(69, 12, 5, 6, 0),
(70, 12, 5, 7, 0),
(71, 13, 1, 1, 0),
(72, 13, 1, 2, 0),
(73, 13, 1, 3, 0),
(74, 13, 1, 4, 0),
(75, 13, 1, 5, 0),
(76, 13, 1, 6, 0),
(77, 13, 1, 7, 0),
(78, 13, 2, 1, 0),
(79, 13, 2, 2, 0),
(80, 13, 2, 3, 0),
(81, 13, 2, 4, 0),
(82, 13, 2, 5, 0),
(83, 13, 2, 6, 0),
(84, 13, 2, 7, 0),
(85, 13, 3, 1, 0),
(86, 13, 3, 2, 0),
(87, 13, 3, 3, 0),
(88, 13, 3, 4, 0),
(89, 13, 3, 5, 0),
(90, 13, 3, 6, 0),
(91, 13, 3, 7, 0),
(92, 13, 4, 1, 0),
(93, 13, 4, 2, 0),
(94, 13, 4, 3, 0),
(95, 13, 4, 4, 0),
(96, 13, 4, 5, 0),
(97, 13, 4, 6, 0),
(98, 13, 4, 7, 0),
(99, 13, 5, 1, 0),
(100, 13, 5, 2, 0),
(101, 13, 5, 3, 0),
(102, 13, 5, 4, 0),
(103, 13, 5, 5, 0),
(104, 13, 5, 6, 0),
(105, 13, 5, 7, 0),
(106, 14, 1, 1, 0),
(107, 14, 1, 2, 0),
(108, 14, 1, 3, 0),
(109, 14, 1, 4, 0),
(110, 14, 1, 5, 0),
(111, 14, 1, 6, 0),
(112, 14, 1, 7, 0),
(113, 14, 2, 1, 0),
(114, 14, 2, 2, 0),
(115, 14, 2, 3, 0),
(116, 14, 2, 4, 0),
(117, 14, 2, 5, 0),
(118, 14, 2, 6, 0),
(119, 14, 2, 7, 0),
(120, 14, 3, 1, 0),
(121, 14, 3, 2, 0),
(122, 14, 3, 3, 0),
(123, 14, 3, 4, 0),
(124, 14, 3, 5, 0),
(125, 14, 3, 6, 0),
(126, 14, 3, 7, 0),
(127, 14, 4, 1, 0),
(128, 14, 4, 2, 0),
(129, 14, 4, 3, 0),
(130, 14, 4, 4, 0),
(131, 14, 4, 5, 0),
(132, 14, 4, 6, 0),
(133, 14, 4, 7, 0),
(134, 14, 5, 1, 0),
(135, 14, 5, 2, 0),
(136, 14, 5, 3, 0),
(137, 14, 5, 4, 0),
(138, 14, 5, 5, 0),
(139, 14, 5, 6, 0),
(140, 14, 5, 7, 0),
(141, 15, 1, 1, 0),
(142, 15, 1, 2, 0),
(143, 15, 1, 3, 0),
(144, 15, 1, 4, 0),
(145, 15, 1, 5, 0),
(146, 15, 1, 6, 0),
(147, 15, 1, 7, 0),
(148, 15, 2, 1, 0),
(149, 15, 2, 2, 0),
(150, 15, 2, 3, 0),
(151, 15, 2, 4, 0),
(152, 15, 2, 5, 0),
(153, 15, 2, 6, 0),
(154, 15, 2, 7, 0),
(155, 15, 3, 1, 1),
(156, 15, 3, 2, 0),
(157, 15, 3, 3, 0),
(158, 15, 3, 4, 0),
(159, 15, 3, 5, 0),
(160, 15, 3, 6, 0),
(161, 15, 3, 7, 0),
(162, 15, 4, 1, 0),
(163, 15, 4, 2, 0),
(164, 15, 4, 3, 0),
(165, 15, 4, 4, 0),
(166, 15, 4, 5, 0),
(167, 15, 4, 6, 0),
(168, 15, 4, 7, 0),
(169, 15, 5, 1, 0),
(170, 15, 5, 2, 0),
(171, 15, 5, 3, 0),
(172, 15, 5, 4, 0),
(173, 15, 5, 5, 0),
(174, 15, 5, 6, 1),
(175, 15, 5, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

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
(1, '2020-03-26', '2020-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `undangan`
--

CREATE TABLE `undangan` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_dosen_pembimbing` int(11) DEFAULT NULL,
  `id_ketua_penguji` int(11) DEFAULT NULL,
  `id_dosen_penguji` int(11) DEFAULT NULL,
  `file` varchar(200) NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `undangan`
--

INSERT INTO `undangan` (`id`, `id_mahasiswa`, `id_dosen_pembimbing`, `id_ketua_penguji`, `id_dosen_penguji`, `file`, `status`) VALUES
(9, 11, 11, 12, 15, 'http://192.168.100.5:8000/assets/undangan/24060117130048-undangan-17042020-082502.doc', 0),
(10, 15, 13, 11, 15, 'http://192.168.100.5:8000/assets/undangan/24060117130054-undangan-18042020-083239.pdf', NULL),
(11, 16, 11, 12, 15, 'http://192.168.100.5:8000/assets/undangan/24050117130048-undangan-18042020-084016.pdf', 1);

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nomor`, `nama`, `password`, `judul`, `id_dosen_pembimbing`, `id_ketua_penguji`, `id_dosen_penguji`, `verified`) VALUES
(11, '24060117130048', 'Ananda Prabu Tritya Vijaya', '49be806836a5e6da569a1448904ce32fef80937fc4ec8607d1b4e8ec5faff8de387311753a381eeb32d490eacee27d8fe140f2e49399f8660adfc767da40b48b', 'Analisis X Terhadap Y', 11, 12, 15, 1),
(12, '24060117130050', 'Satria Kemal Prawira', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604', 'Analisis Y Terhadap XX', 12, 11, 15, 1),
(13, '24060117120004', 'Fauzan Alfith', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604', 'Analisis Y Terhadap XXJ', 15, NULL, NULL, 1),
(14, '24060117130055', 'Aji Baskoro', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604', 'Pengaruh X Terhadap Y', 11, NULL, NULL, 1),
(15, '24060117130054', 'Zharfan A', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604', 'Pengaruh Y terhadap X', 13, 11, 15, 1),
(16, '24050117130048', 'Mahendra Fajar', 'b97068b5c7410d67a42fdded40cdc2d420053f2cb2448799fc9bfd65347efad4e686561806f5de2d9c53b072418578efc72ba26cca01ae69d4946f1548739604', 'Pengaruh X terhadap Y', 11, 12, 15, 1);

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
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_days` (`id_days`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_time` (`id_time`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undangan`
--
ALTER TABLE `undangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen_pembimbing` (`id_dosen_pembimbing`),
  ADD KEY `id_ketua_penguji` (`id_ketua_penguji`),
  ADD KEY `id_dosen_penguji` (`id_dosen_penguji`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `berkas`
--
ALTER TABLE `berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `undangan`
--
ALTER TABLE `undangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`id_days`) REFERENCES `days` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_3` FOREIGN KEY (`id_time`) REFERENCES `time` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `undangan`
--
ALTER TABLE `undangan`
  ADD CONSTRAINT `undangan_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `undangan_ibfk_2` FOREIGN KEY (`id_dosen_pembimbing`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `undangan_ibfk_3` FOREIGN KEY (`id_ketua_penguji`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `undangan_ibfk_4` FOREIGN KEY (`id_dosen_penguji`) REFERENCES `dosen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
