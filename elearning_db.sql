-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2019 at 04:06 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `kd_guru` char(4) NOT NULL,
  `nm_guru` varchar(100) NOT NULL,
  `kelamin` char(1) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kd_guru`, `nm_guru`, `kelamin`, `alamat`, `no_telepon`, `username`, `password`) VALUES
('G001', 'Andikha Rahmat Indra Bayu', 'L', 'Bekasi Jaya Indah, Bekasi Timur', '085921664279', 'indrabyz', '21232f297a57a5a743894a0e4a801fc3'),
('G002', 'Aditya Nugroho', 'L', 'Buaran, Jakarta Timur', '081642596854', 'adit', '21232f297a57a5a743894a0e4a801fc3'),
('G003', 'M Prasetyo', 'L', 'Rawamangun, Jakarta Timur', '082123334445', 'tyotyo', '21232f297a57a5a743894a0e4a801fc3'),
('G004', 'Septianto Saputra', 'L', 'Buaran, Jakarta Timur', '082199229', 'septianto', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kd_kelas` char(3) NOT NULL,
  `nm_kelas` varchar(100) NOT NULL,
  `kd_guru` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nm_kelas`, `kd_guru`) VALUES
('K01', 'VII', 'G001'),
('K02', 'VIII', 'G002'),
('K03', 'IX', 'G003');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id` int(5) NOT NULL,
  `kd_kelas` char(3) NOT NULL,
  `kd_siswa` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id`, `kd_kelas`, `kd_siswa`) VALUES
(4, 'K01', 'S0002'),
(3, 'K01', 'S0001'),
(5, 'K02', 'S0003'),
(6, 'K02', 'S0004'),
(7, 'K03', 'S0005'),
(8, 'K03', 'S0006');

-- --------------------------------------------------------

--
-- Table structure for table `materi_belajar`
--

CREATE TABLE `materi_belajar` (
  `kd_materi` char(5) NOT NULL,
  `nm_materi` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `file_materi` varchar(200) NOT NULL,
  `kd_pelajaran` char(3) NOT NULL,
  `kd_guru` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi_belajar`
--

INSERT INTO `materi_belajar` (`kd_materi`, `nm_materi`, `keterangan`, `file_materi`, `kd_pelajaran`, `kd_guru`) VALUES
('M0001', 'Materi Pelajaran Bahasa Indonesia VII (7)', 'Pelajaran Bahasa Indonesia', 'M0001.Chomsky.pdf', 'P01', 'G001'),
('M0002', 'Materi Bahasa Indonesia VIII (8)', 'Materi Pelajaran bahasa indonesia kelas 2 SMP', 'M0002.IMG_20161203_065330.jpg', 'P01', 'G001'),
('M0003', 'Materi Belajar Bahasa Inggris VII (7)', 'Materi belajar Bahasa Inggris Kelas 1 SMP (VII)', '', 'P02', 'G002');

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `kd_mengajar` char(5) NOT NULL,
  `kd_kelas` char(3) NOT NULL,
  `kd_pelajaran` char(3) NOT NULL,
  `kd_guru` char(4) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `jam` varchar(5) NOT NULL,
  `ruang` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`kd_mengajar`, `kd_kelas`, `kd_pelajaran`, `kd_guru`, `hari`, `jam`, `ruang`) VALUES
('M0001', 'K01', 'P06', 'G001', 'Senin', '07.30', 'S11'),
('M0002', 'K01', 'P02', 'G002', 'Senin', '08.30', 'S12'),
('M0003', 'K01', 'P01', 'G004', 'Senin', '09:30', 'S14'),
('M0004', 'K01', 'P03', 'G003', 'Senin', '10.30', 'S13'),
('M0005', 'K01', 'P02', 'G001', 'Senin', '13.00', 'S14');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `kd_pelajaran` char(3) NOT NULL,
  `nm_pelajaran` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`kd_pelajaran`, `nm_pelajaran`) VALUES
('P01', 'Bahasa Indonesia'),
('P02', 'Bahasa Inggris'),
('P03', 'Agama'),
('P04', 'Matematika'),
('P05', 'Fisika'),
('P06', 'Biologi'),
('P07', 'PPKn'),
('P08', 'Olah Raga');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `kd_siswa` char(5) NOT NULL,
  `nm_siswa` varchar(100) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `kelamin` char(1) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`kd_siswa`, `nm_siswa`, `nis`, `kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `foto`, `username`, `password`) VALUES
('S0001', 'Rudi Nasrianto', '150001', 'L', 'Islam', 'Pekanbaru', '1997-09-03', 'Jl. Margayu, Labuhan Ratu Baru, Way Jepara', '0821334421', '', 'rudinasrianto', '21232f297a57a5a743894a0e4a801fc3'),
('S0002', 'Septian Nugroho', '150002', 'L', 'Islam', 'Lampung', '1997-09-05', 'Jl. Raman Aji, Raman Aji, Kec. Raman Utara', '08214445555', 'S0002.IMG_20161203_065330.jpg', 'septiannugroho', '21232f297a57a5a743894a0e4a801fc3'),
('S0003', 'Alfa Diyoni', '150003', 'L', 'Katolik', 'Tanjung Bintang', '1997-10-02', 'Jl. Suhada, Labuhan Ratu 1, Way Jepara', '0819334567', 'S0003.rompi.jpg', 'dion', '21232f297a57a5a743894a0e4a801fc3'),
('S0004', 'Indah Indriyanni', '150004', 'P', 'Islam', 'Way Jepara', '1997-09-05', 'Jl. Margahayu, Labuhan Ratu Baru, Kec. Way Jepara', '0819445333', 'S0004.septi.jpg', 'indah', '21232f297a57a5a743894a0e4a801fc3'),
('S0005', 'Sardi Sudrajad', '150005', 'L', 'Islam', 'Way Jepara', '1997-03-05', 'Jl. Margayu, Labuhan Ratu Baru, Way Jepara, Lampung Timur', '0829433324', 'S0005.kenong 2.jpg', 'sardi', '21232f297a57a5a743894a0e4a801fc3'),
('S0006', 'Fitria Prasetiyawati ', '150006', 'P', 'Islam', 'Raman Utara', '1997-04-02', 'Jl. Margayu, Labuhan Ratu Baru, Way Jepara, Lampung Timur', '08192333456', 'S0006.septi.jpg', 'fitria', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_kelas`
--

CREATE TABLE `tmp_kelas` (
  `id` int(5) NOT NULL,
  `kd_siswa` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_belajar`
--

CREATE TABLE `tugas_belajar` (
  `kd_tugas` char(5) NOT NULL,
  `nm_tugas` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `file_tugas` varchar(100) NOT NULL,
  `kd_pelajaran` char(3) NOT NULL,
  `kd_kelas` char(3) NOT NULL,
  `kd_guru` char(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas_belajar`
--

INSERT INTO `tugas_belajar` (`kd_tugas`, `nm_tugas`, `keterangan`, `file_tugas`, `kd_pelajaran`, `kd_kelas`, `kd_guru`) VALUES
('T0001', 'Tugas Bahasa Indonesia - VII', 'Tugasnya adalah membuat pantun seputar hari kemerdekaan Agustus 2019', '', 'P01', 'K01', 'G004'),
('T0002', 'Tugas Bahasa Indonesia - VII', 'Mengarang tentang desaku', '', 'P01', 'K01', 'G004'),
('T0003', 'Tugas Bahasa Indonesia - VII', 'Shalat Jenazah', '', 'P03', 'K01', 'G003');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kd_user` char(3) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kd_user`, `nm_user`, `username`, `password`) VALUES
('U02', 'Aditya Nugroho', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`kd_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi_belajar`
--
ALTER TABLE `materi_belajar`
  ADD PRIMARY KEY (`kd_materi`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`kd_mengajar`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`kd_pelajaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`kd_siswa`);

--
-- Indexes for table `tmp_kelas`
--
ALTER TABLE `tmp_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas_belajar`
--
ALTER TABLE `tugas_belajar`
  ADD PRIMARY KEY (`kd_tugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kd_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tmp_kelas`
--
ALTER TABLE `tmp_kelas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
