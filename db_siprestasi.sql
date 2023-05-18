-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2023 at 08:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siprestasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `aid` int NOT NULL,
  `ausername` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apassword` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `anama` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ajabatan` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`aid`, `ausername`, `apassword`, `anama`, `ajabatan`) VALUES
(1, 'admin', 'admin', 'Pande Made Mahendri Pramadewi', 'TPPTIK Bidang Web');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `gid` int NOT NULL,
  `gnama` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gmapel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gkontak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gstatus` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`gid`, `gnama`, `gmapel`, `gkontak`, `gstatus`) VALUES
(1, 'Ida Bagus Redy Santiawan, S.Pd.', NULL, '+62816285791', '1'),
(2, 'Pande Made Mahendri Pramadewi, S.Pd.', NULL, '+6285739098890', '1'),
(3, 'Dewa Ayu Putri Suharsiki, S.Kom.', NULL, '+6281338494771', '1'),
(4, 'I Wayan Sudiatmika, S.Pd.', NULL, '+6281338645303', '1'),
(5, 'I Kadek Ary Yuliana, A.Md.', NULL, '+6281353379930', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kid` int NOT NULL,
  `knama` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ktingkat` enum('10','11','12') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kid`, `knama`, `ktingkat`, `tid`) VALUES
(1, 'XII RPL 1', '12', 5),
(2, 'XII RPL 2', '12', 5),
(4, 'XII TPTU', '12', 5),
(5, 'XII DPIB 1', '12', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lomba`
--

CREATE TABLE `tb_lomba` (
  `lid` int NOT NULL,
  `ljenis` enum('1','2') NOT NULL DEFAULT '2',
  `lnama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ltingkat` enum('kota/kabupaten','provinsi','nasional','regional','internasional','lainnya') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lpenyelenggara` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ltahun` int NOT NULL,
  `tid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_lomba`
--

INSERT INTO `tb_lomba` (`lid`, `ljenis`, `lnama`, `ltingkat`, `lpenyelenggara`, `ltahun`, `tid`) VALUES
(1, '2', 'Cerdas Cermat Pengetahuan Umum SMA/SMK', 'provinsi', 'Universitas Pendidikan Nasional', 2023, 5),
(2, '2', 'Cerdas Cermat IT SMA/SMK', 'provinsi', 'Institut Desain Bali ', 2023, 5),
(3, '2', 'Lomba Keterampilan Siswa (LKS) Bidang Lomba IT Software Solution for Business', 'nasional', 'Pusat Prestasi Nasional Kemdikbud', 2022, 5),
(4, '2', 'Lomba Keterampilan Siswa (LKS) Bidang Lomba Web Technology', 'nasional', 'Pusat Prestasi Nasional Kemdikbud', 2022, 5),
(5, '2', 'Lomba Keterampilan Siswa (LKS) Bidang Lomba Refregeration', 'nasional', 'Pusat Prestasi Nasional Kemdikbud', 2022, 5),
(6, '2', 'Lomba Keterampilan Siswa (LKS) Bidang Lomba CADD Building', 'nasional', 'Pusat Prestasi Nasional Kemdikbud', 2022, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_prestasi`
--

CREATE TABLE `tb_prestasi` (
  `pid` int NOT NULL,
  `lid` int NOT NULL,
  `pperingkat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pdokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_prestasi`
--

INSERT INTO `tb_prestasi` (`pid`, `lid`, `pperingkat`, `pdokumen`) VALUES
(1, 1, 'Juara I', ''),
(2, 2, 'Juara I', NULL),
(3, 2, 'Juara II', NULL),
(4, 3, 'Juara II', NULL),
(5, 4, 'Juara I', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_kelas_siswa`
--

CREATE TABLE `tb_ref_kelas_siswa` (
  `kid` int NOT NULL,
  `sid` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ref_kelas_siswa`
--

INSERT INTO `tb_ref_kelas_siswa` (`kid`, `sid`) VALUES
(1, '28833'),
(1, '28842'),
(1, '28847'),
(1, '28872'),
(1, '28853'),
(1, '28861'),
(2, '28888'),
(2, '28890'),
(4, '28489');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_prestasi_guru`
--

CREATE TABLE `tb_ref_prestasi_guru` (
  `pid` int NOT NULL,
  `gid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_prestasi_pemb`
--

CREATE TABLE `tb_ref_prestasi_pemb` (
  `pid` int NOT NULL,
  `gid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ref_prestasi_pemb`
--

INSERT INTO `tb_ref_prestasi_pemb` (`pid`, `gid`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 3),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ref_prestasi_siswa`
--

CREATE TABLE `tb_ref_prestasi_siswa` (
  `pid` int NOT NULL,
  `sid` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ref_prestasi_siswa`
--

INSERT INTO `tb_ref_prestasi_siswa` (`pid`, `sid`) VALUES
(1, '28833'),
(1, '28847'),
(1, '28872'),
(2, '28842'),
(2, '28853'),
(2, '28861'),
(3, '28833'),
(3, '28847'),
(3, '28872'),
(4, '28888'),
(5, '28890');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `sid` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `snama` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sgender` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`sid`, `snama`, `sgender`) VALUES
('28489', 'I KADEK DWIKI ANDIKA PUTRA', 'L'),
('28833', 'A.A. ISTRI CANDRA MANIKA DEWI', 'P'),
('28842', 'I KOMANG WAHYU PRANATA', 'L'),
('28847', 'I MADE WISNU ADI SANJAYA', 'L'),
('28853', 'IDA PUTU SUCITA DANUARTHA ', 'L'),
('28861', 'MOCH. RIFKY SULTON AKBAR', 'L'),
('28872', 'PUTU WIDYA RUSMANANDA YASA', 'L'),
('28888', 'I MADE ADNYA SUTHA WIRYA', 'L'),
('28890', 'I MADE GAUTAMA ', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tapel`
--

CREATE TABLE `tb_tapel` (
  `tid` int NOT NULL,
  `ttapel` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_tapel`
--

INSERT INTO `tb_tapel` (`tid`, `ttapel`) VALUES
(1, '2018/2019'),
(2, '2019/2020'),
(3, '2020/2021'),
(4, '2021/2022'),
(5, '2022/2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kid`),
  ADD KEY `tb_kelas_ibfk_1` (`tid`);

--
-- Indexes for table `tb_lomba`
--
ALTER TABLE `tb_lomba`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `id_tapel` (`tid`);

--
-- Indexes for table `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `id_lomba` (`lid`);

--
-- Indexes for table `tb_ref_kelas_siswa`
--
ALTER TABLE `tb_ref_kelas_siswa`
  ADD KEY `id_kelas` (`kid`),
  ADD KEY `nis` (`sid`);

--
-- Indexes for table `tb_ref_prestasi_guru`
--
ALTER TABLE `tb_ref_prestasi_guru`
  ADD KEY `pid` (`pid`),
  ADD KEY `gid` (`gid`);

--
-- Indexes for table `tb_ref_prestasi_pemb`
--
ALTER TABLE `tb_ref_prestasi_pemb`
  ADD KEY `id_prestasi` (`pid`),
  ADD KEY `id_pemb` (`gid`);

--
-- Indexes for table `tb_ref_prestasi_siswa`
--
ALTER TABLE `tb_ref_prestasi_siswa`
  ADD KEY `id_prestasi` (`pid`),
  ADD KEY `nis` (`sid`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tb_tapel`
--
ALTER TABLE `tb_tapel`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `aid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `gid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `kid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_lomba`
--
ALTER TABLE `tb_lomba`
  MODIFY `lid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_tapel`
--
ALTER TABLE `tb_tapel`
  MODIFY `tid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tb_tapel` (`tid`);

--
-- Constraints for table `tb_lomba`
--
ALTER TABLE `tb_lomba`
  ADD CONSTRAINT `tb_lomba_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `tb_tapel` (`tid`);

--
-- Constraints for table `tb_prestasi`
--
ALTER TABLE `tb_prestasi`
  ADD CONSTRAINT `tb_prestasi_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `tb_lomba` (`lid`);

--
-- Constraints for table `tb_ref_kelas_siswa`
--
ALTER TABLE `tb_ref_kelas_siswa`
  ADD CONSTRAINT `tb_ref_kelas_siswa_ibfk_1` FOREIGN KEY (`kid`) REFERENCES `tb_kelas` (`kid`),
  ADD CONSTRAINT `tb_ref_kelas_siswa_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `tb_siswa` (`sid`);

--
-- Constraints for table `tb_ref_prestasi_guru`
--
ALTER TABLE `tb_ref_prestasi_guru`
  ADD CONSTRAINT `tb_ref_prestasi_guru_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `tb_prestasi` (`pid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tb_ref_prestasi_guru_ibfk_2` FOREIGN KEY (`gid`) REFERENCES `tb_guru` (`gid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_ref_prestasi_pemb`
--
ALTER TABLE `tb_ref_prestasi_pemb`
  ADD CONSTRAINT `tb_ref_prestasi_pemb_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `tb_prestasi` (`pid`),
  ADD CONSTRAINT `tb_ref_prestasi_pemb_ibfk_2` FOREIGN KEY (`gid`) REFERENCES `tb_guru` (`gid`);

--
-- Constraints for table `tb_ref_prestasi_siswa`
--
ALTER TABLE `tb_ref_prestasi_siswa`
  ADD CONSTRAINT `tb_ref_prestasi_siswa_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `tb_prestasi` (`pid`),
  ADD CONSTRAINT `tb_ref_prestasi_siswa_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `tb_siswa` (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
