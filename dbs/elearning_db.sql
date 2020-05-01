-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2017 at 03:49 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

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
('G001', 'Indah Indriyanna', 'P', 'Margahayu, Labuhan Ratu Baru', '08192222333', 'indah', 'f3385c508ce54d577fd205a1b2ecdfb7'),
('G002', 'Sugeng Fitriyadi', 'L', 'Spontan, Braja Asri 5, Way Jepara', '0821333445', 'sugeng', '9e28894760bdf11cb2bef7a32c020e3b'),
('G003', 'Iis Suwindri', 'P', 'Margahayu, Labuhan Ratu Baru, Kota Metro', '082123334445', 'indri', '71f7be7b8496f7ece8454b1bcdcd2162'),
('G004', 'Juwanto, SPd', 'L', 'Jl. Siliragung, Labuhan Ratu 5, Way Jepara Lampung Timur', '082199229', 'juwan', '4797ff1b6a437754010bfaedc8e26087');

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
('K01', 'VII A ', 'G001'),
('K02', 'VII B', 'G002'),
('K03', 'VII C', 'G003');

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
('M0001', 'Materi Pelajaran Bahasa Indonesia VII (7)', 'Pelajaran Bahasa Indonesia', 'M0001.Not Lagu Jawa.docx', 'P01', 'G001'),
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
('M0001', 'K01', 'P01', 'G001', 'Senin', '07.30', 'S11'),
('M0002', 'K01', 'P02', 'G002', 'Senin', '09.00', 'S12'),
('M0003', 'K02', 'P01', 'G001', 'Senin', '9:15', 'Ruang');

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
('S0001', 'Septi Suhesti', '150001', 'P', 'Islam', 'Way Jepara', '2001-12-20', 'Jl. Margayu, Labuhan Ratu Baru, Way Jepara', '0821334421', '', 'septi', 'd58d8a16aa666d48fbcc30bd3217fb17'),
('S0002', 'Riska Dwisaputra', '150002', 'L', 'Islam', 'Raman Utara', '1992-06-02', 'Jl. Raman Aji, Raman Aji, Kec. Raman Utara', '08214445555', 'S0002.IMG_20161203_065330.jpg', 'putra', '5e0c5a0bf82decdd43b2150b622c66c5'),
('S0003', 'Alfa Diyoni', '150003', 'L', 'Katolik', 'Tanjung Bintang', '1992-10-02', 'Jl. Suhada, Labuhan Ratu 1, Way Jepara', '0819334567', 'S0003.rompi.jpg', 'dion', '982c500a206551c665f746cc9e77a961'),
('S0004', 'Indah Indriyanni', '150004', 'P', 'Islam', 'Way Jepara', '1991-09-15', 'Jl. Margahayu, Labuhan Ratu Baru, Kec. Way Jepara', '0819445333', 'S0004.septi.jpg', 'indah', 'f3385c508ce54d577fd205a1b2ecdfb7'),
('S0005', 'Sardi Sudrajad', '150005', 'L', 'Islam', 'Way Jepara', '1995-03-05', 'Jl. Margayu, Labuhan Ratu Baru, Way Jepara, Lampung Timur', '0829433324', 'S0005.kenong 2.jpg', 'sardi', '04fa8fa4a83332800fec174cc0928521'),
('S0006', 'Fitria Prasetiyawati ', '150006', 'P', 'Islam', 'Raman Utara', '1996-04-10', 'Jl. Margayu, Labuhan Ratu Baru, Way Jepara, Lampung Timur', '08192333456', 'S0006.septi.jpg', 'fitria', 'ef208a5dfcfc3ea9941d7a6c43841784');

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
('T0001', 'Tugas Bahasa Indonesia - VII A', 'Tugasnya adalah membuat pantun seputar hari kemerdekaan Agustus 2016', '', 'P01', 'K01', 'G001'),
('T0002', 'Tugas Bahasa Indonesia - VII B', 'Mengarang tentang desaku', '', 'P01', 'K02', 'G001'),
('T0003', 'Tugas Bahasa Indonesia - VII C', 'Membuat Puisi yang berkaitan hari kemerdekaan', '', 'P01', 'K03', 'G003');

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
('U02', 'Fitria Prasetiawati', 'fitri', '534a0b7aa872ad1340d0071cbfa38697'),
('U01', 'Bunafit Nugroho', 'admin', '21232f297a57a5a743894a0e4a801fc3');

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
