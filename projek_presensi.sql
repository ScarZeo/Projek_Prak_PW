-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2025 at 09:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_Admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_Admin`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `ID_Akun` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `Admin_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`ID_Akun`, `Username`, `Password`, `Role`, `Admin_ID`) VALUES
(1, 'admin', 'admin123', 'Admin', 1),
(2, 'guru1', 'guru123', 'Guru', 1),
(3, 'guru2', 'guru123', 'Guru', 1),
(4, 'guru3', 'guru123', 'Guru', 1),
(5, 'guru4', 'guru123', 'Guru', 1),
(6, 'guru5', 'guru123', 'Guru', 1),
(7, 'guru6', 'guru123', 'Guru', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `ID_Guru` int(11) NOT NULL,
  `nama_guru` varchar(150) DEFAULT NULL,
  `Admin_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`ID_Guru`, `nama_guru`, `Admin_ID`) VALUES
(1, 'Ibu Siti Aminah, S.Pd', 1),
(2, 'Bapak Ahmad Fauzi, S.Pd', 1),
(3, 'Ibu Ratna Dewi, S.Pd', 1),
(4, 'Bapak Hendra Gunawan, S.Pd', 1),
(5, 'Ibu Nur Aini, S.Pd', 1),
(6, 'Bapak Dodi Setiawan, S.Pd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `ID_Kelas` int(11) NOT NULL,
  `Nama_Kelas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`ID_Kelas`, `Nama_Kelas`) VALUES
(1, 'Kelas 1'),
(2, 'Kelas 2'),
(3, 'Kelas 3'),
(4, 'Kelas 4'),
(5, 'Kelas 5'),
(6, 'Kelas 6');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_mapel`
--

CREATE TABLE `kelas_mapel` (
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas_mapel`
--

INSERT INTO `kelas_mapel` (`id_kelas`, `id_mapel`) VALUES
(1, 1),
(1, 7),
(1, 21),
(2, 2),
(2, 8),
(2, 22),
(3, 3),
(3, 9),
(3, 13),
(3, 17),
(3, 23),
(4, 4),
(4, 10),
(4, 14),
(4, 18),
(4, 24),
(4, 27),
(5, 5),
(5, 11),
(5, 15),
(5, 19),
(5, 25),
(5, 28),
(6, 6),
(6, 12),
(6, 16),
(6, 20),
(6, 26),
(6, 29);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id_kelas` int(11) NOT NULL,
  `nis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id_kelas`, `nis`) VALUES
(1, 2401001),
(1, 2401002),
(1, 2401003),
(1, 2401004),
(1, 2401005),
(1, 2401006),
(1, 2401007),
(1, 2401008),
(1, 2401009),
(1, 2401010),
(1, 2401011),
(1, 2401012),
(1, 2401013),
(1, 2401014),
(1, 2401015),
(1, 2401016),
(1, 2401017),
(1, 2401018),
(1, 2401019),
(1, 2401020),
(1, 2401021),
(1, 2401022),
(1, 2401023),
(1, 2401024),
(1, 2401025),
(1, 2401026),
(1, 2401027),
(1, 2401028),
(2, 2301001),
(2, 2301002),
(2, 2301003),
(2, 2301004),
(2, 2301005),
(2, 2301006),
(2, 2301007),
(2, 2301008),
(2, 2301009),
(2, 2301010),
(2, 2301011),
(2, 2301012),
(2, 2301013),
(2, 2301014),
(2, 2301015),
(2, 2301016),
(2, 2301017),
(2, 2301018),
(2, 2301019),
(2, 2301020),
(2, 2301021),
(2, 2301022),
(2, 2301023),
(2, 2301024),
(2, 2301025),
(2, 2301026),
(2, 2301027),
(2, 2301028),
(2, 2301029),
(2, 2301030),
(3, 2201001),
(3, 2201002),
(3, 2201003),
(3, 2201004),
(3, 2201005),
(3, 2201006),
(3, 2201007),
(3, 2201008),
(3, 2201009),
(3, 2201010),
(3, 2201011),
(3, 2201012),
(3, 2201013),
(3, 2201014),
(3, 2201015),
(3, 2201016),
(3, 2201017),
(3, 2201018),
(3, 2201019),
(3, 2201020),
(3, 2201021),
(3, 2201022),
(3, 2201023),
(3, 2201024),
(3, 2201025),
(3, 2201026),
(3, 2201027),
(3, 2201028),
(3, 2201029),
(4, 2101001),
(4, 2101002),
(4, 2101003),
(4, 2101004),
(4, 2101005),
(4, 2101006),
(4, 2101007),
(4, 2101008),
(4, 2101009),
(4, 2101010),
(4, 2101011),
(4, 2101012),
(4, 2101013),
(4, 2101014),
(4, 2101015),
(4, 2101016),
(4, 2101017),
(4, 2101018),
(4, 2101019),
(4, 2101020),
(4, 2101021),
(4, 2101022),
(4, 2101023),
(4, 2101024),
(4, 2101025),
(4, 2101026),
(4, 2101027),
(5, 2001001),
(5, 2001002),
(5, 2001003),
(5, 2001004),
(5, 2001005),
(5, 2001006),
(5, 2001007),
(5, 2001008),
(5, 2001009),
(5, 2001010),
(5, 2001011),
(5, 2001012),
(5, 2001013),
(5, 2001014),
(5, 2001015),
(5, 2001016),
(5, 2001017),
(5, 2001018),
(5, 2001019),
(5, 2001020),
(5, 2001021),
(5, 2001022),
(5, 2001023),
(5, 2001024),
(5, 2001025),
(5, 2001026),
(5, 2001027),
(5, 2001028),
(5, 2001029),
(5, 2001030),
(6, 1901001),
(6, 1901002),
(6, 1901003),
(6, 1901004),
(6, 1901005),
(6, 1901006),
(6, 1901007),
(6, 1901008),
(6, 1901009),
(6, 1901010),
(6, 1901011),
(6, 1901012),
(6, 1901013),
(6, 1901014),
(6, 1901015),
(6, 1901016),
(6, 1901017),
(6, 1901018),
(6, 1901019),
(6, 1901020),
(6, 1901021),
(6, 1901022),
(6, 1901023),
(6, 1901024),
(6, 1901025),
(6, 1901026),
(6, 1901027),
(6, 1901028);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `ID_MaPel` int(11) NOT NULL,
  `Nama_MaPel` varchar(150) DEFAULT NULL,
  `Guru_Pengampu` int(11) NOT NULL,
  `Kelas` int(11) NOT NULL,
  `Admin_ID` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`ID_MaPel`, `Nama_MaPel`, `Guru_Pengampu`, `Kelas`, `Admin_ID`, `id_guru`) VALUES
(1, 'Matematika', 1, 1, 1, 1),
(2, 'Matematika', 1, 2, 1, 1),
(3, 'Matematika', 2, 3, 1, 2),
(4, 'Matematika', 2, 4, 1, 2),
(5, 'Matematika', 3, 5, 1, 3),
(6, 'Matematika', 3, 6, 1, 3),
(7, 'Bahasa Indonesia', 1, 1, 1, 1),
(8, 'Bahasa Indonesia', 1, 2, 1, 1),
(9, 'Bahasa Indonesia', 2, 3, 1, 2),
(10, 'Bahasa Indonesia', 2, 4, 1, 2),
(11, 'Bahasa Indonesia', 3, 5, 1, 3),
(12, 'Bahasa Indonesia', 3, 6, 1, 3),
(13, 'IPA', 4, 3, 1, 4),
(14, 'IPA', 4, 4, 1, 4),
(15, 'IPA', 5, 5, 1, 5),
(16, 'IPA', 5, 6, 1, 5),
(17, 'IPS', 4, 3, 1, 4),
(18, 'IPS', 4, 4, 1, 4),
(19, 'IPS', 5, 5, 1, 5),
(20, 'IPS', 5, 6, 1, 5),
(21, 'Pendidikan Agama', 6, 1, 1, 6),
(22, 'Pendidikan Agama', 6, 2, 1, 6),
(23, 'Pendidikan Agama', 6, 3, 1, 6),
(24, 'Pendidikan Agama', 6, 4, 1, 6),
(25, 'Pendidikan Agama', 6, 5, 1, 6),
(26, 'Pendidikan Agama', 6, 6, 1, 6),
(27, 'Bahasa Inggris', 5, 4, 1, 5),
(28, 'Bahasa Inggris', 5, 5, 1, 5),
(29, 'Bahasa Inggris', 5, 6, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nis` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `NIS` int(11) NOT NULL,
  `nama_siswa` varchar(150) DEFAULT NULL,
  `Admin_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`NIS`, `nama_siswa`, `Admin_ID`) VALUES
(1901001, 'Wahid Hasyim', 1),
(1901002, 'Xaviera Putri', 1),
(1901003, 'Yogi Saputra', 1),
(1901004, 'Zara Amelia', 1),
(1901005, 'Adi Wijaya', 1),
(1901006, 'Beni Kurniawan', 1),
(1901007, 'Citra Lestari', 1),
(1901008, 'Dedi Setiawan', 1),
(1901009, 'Endang Susilowati', 1),
(1901010, 'Firman Hidayat', 1),
(1901011, 'Gita Pertiwi', 1),
(1901012, 'Hasan Basri', 1),
(1901013, 'Ika Damayanti', 1),
(1901014, 'Jono Sutrisno', 1),
(1901015, 'Kartini Sari', 1),
(1901016, 'Lutfi Prasetyo', 1),
(1901017, 'Mira Wulandari', 1),
(1901018, 'Noval Prasetya', 1),
(1901019, 'Olla Ramona', 1),
(1901020, 'Pandu Kusuma', 1),
(1901021, 'Rani Safitri', 1),
(1901022, 'Sandi Wijaya', 1),
(1901023, 'Tina Marlina', 1),
(1901024, 'Ucok Ramadhan', 1),
(1901025, 'Vera Anggraini', 1),
(1901026, 'Willy Setiawan', 1),
(1901027, 'Yanti Puspita', 1),
(1901028, 'Zidan Maulana', 1),
(2001001, 'Sari Indah', 1),
(2001002, 'Tito Karnavian', 1),
(2001003, 'Umi Kalsum', 1),
(2001004, 'Vero Aditya', 1),
(2001005, 'Wawan Setiawan', 1),
(2001006, 'Xena Wijaya', 1),
(2001007, 'Yanto Pratama', 1),
(2001008, 'Zainal Arifin', 1),
(2001009, 'Amir Hamzah', 1),
(2001010, 'Bunga Citra', 1),
(2001011, 'Cahyo Nugroho', 1),
(2001012, 'Diana Safitri', 1),
(2001013, 'Eko Wibowo', 1),
(2001014, 'Fina Anggraini', 1),
(2001015, 'Gani Permana', 1),
(2001016, 'Hilda Rahmawati', 1),
(2001017, 'Ivan Setiawan', 1),
(2001018, 'Jasmin Azzahra', 1),
(2001019, 'Kevin Ananda', 1),
(2001020, 'Laila Sari', 1),
(2001021, 'Maman Suryaman', 1),
(2001022, 'Nita Puspita', 1),
(2001023, 'Omen Saputra', 1),
(2001024, 'Prita Kusuma', 1),
(2001025, 'Qonita Maharani', 1),
(2001026, 'Rudi Hartono', 1),
(2001027, 'Siska Mellyana', 1),
(2001028, 'Toni Wijaya', 1),
(2001029, 'Ulfah Hasanah', 1),
(2001030, 'Vina Wulandari', 1),
(2101001, 'Reza Pahlevi', 1),
(2101002, 'Sinta Dewi', 1),
(2101003, 'Tegar Wijaya', 1),
(2101004, 'Ully Oktavia', 1),
(2101005, 'Verdi Kurniawan', 1),
(2101006, 'Widya Ningrum', 1),
(2101007, 'Yoga Pratama', 1),
(2101008, 'Yunita Sari', 1),
(2101009, 'Zaki Ramadhan', 1),
(2101010, 'Agus Setiawan', 1),
(2101011, 'Bella Pramesti', 1),
(2101012, 'Chandra Wijaya', 1),
(2101013, 'Dina Marlina', 1),
(2101014, 'Erik Saputra', 1),
(2101015, 'Fitri Handayani', 1),
(2101016, 'Gilang Ramadhan', 1),
(2101017, 'Hesti Wulandari', 1),
(2101018, 'Imam Santoso', 1),
(2101019, 'Julia Safitri', 1),
(2101020, 'Kurnia Sari', 1),
(2101021, 'Lia Permata', 1),
(2101022, 'Mirza Fadli', 1),
(2101023, 'Nina Andriani', 1),
(2101024, 'Oka Prasetya', 1),
(2101025, 'Putra Mahendra', 1),
(2101026, 'Queen Azzura', 1),
(2101027, 'Rama Danu', 1),
(2201001, 'Pradana Kusuma', 1),
(2201002, 'Qory Sandrina', 1),
(2201003, 'Rangga Aditya', 1),
(2201004, 'Safira Azzahra', 1),
(2201005, 'Teguh Wibisono', 1),
(2201006, 'Umi Kulsum', 1),
(2201007, 'Vicky Saputra', 1),
(2201008, 'Winda Safitri', 1),
(2201009, 'Yusuf Arifin', 1),
(2201010, 'Zulfa Maharani', 1),
(2201011, 'Abdul Aziz', 1),
(2201012, 'Anindya Putri', 1),
(2201013, 'Bayu Firmansyah', 1),
(2201014, 'Cindy Puspita', 1),
(2201015, 'Deni Kurniawan', 1),
(2201016, 'Endah Wulandari', 1),
(2201017, 'Fauzi Rahman', 1),
(2201018, 'Gina Aulia', 1),
(2201019, 'Haryo Bimo', 1),
(2201020, 'Indri Lestari', 1),
(2201021, 'Jefri Saputra', 1),
(2201022, 'Karina Sari', 1),
(2201023, 'Lutfi Hamdani', 1),
(2201024, 'Mega Wati', 1),
(2201025, 'Nurul Fadilah', 1),
(2201026, 'Okta Ramadhan', 1),
(2201027, 'Putri Ayu', 1),
(2201028, 'Qomar Zaman', 1),
(2201029, 'Rendi Saputra', 1),
(2301001, 'Rahmat Hidayat', 1),
(2301002, 'Rani Oktavia', 1),
(2301003, 'Rifki Ananda', 1),
(2301004, 'Salsabila Azzahra', 1),
(2301005, 'Satria Wibowo', 1),
(2301006, 'Silvia Damayanti', 1),
(2301007, 'Taufik Rahman', 1),
(2301008, 'Tiara Kusuma', 1),
(2301009, 'Umar Faruq', 1),
(2301010, 'Vina Melati', 1),
(2301011, 'Wahyu Setiawan', 1),
(2301012, 'Wulan Sari', 1),
(2301013, 'Yogi Pratama', 1),
(2301014, 'Zahra Amelia', 1),
(2301015, 'Aldo Firmansyah', 1),
(2301016, 'Anggun Pertiwi', 1),
(2301017, 'Bintang Permana', 1),
(2301018, 'Cinta Lestari', 1),
(2301019, 'Danu Prasetya', 1),
(2301020, 'Elsa Rahmawati', 1),
(2301021, 'Fahmi Akbar', 1),
(2301022, 'Gita Savitri', 1),
(2301023, 'Hadi Purnomo', 1),
(2301024, 'Ica Septiani', 1),
(2301025, 'Jaka Perdana', 1),
(2301026, 'Kiki Amalia', 1),
(2301027, 'Luthfi Hakim', 1),
(2301028, 'Melani Putri', 1),
(2301029, 'Novan Andika', 1),
(2301030, 'Olivia Marlina', 1),
(2401001, 'Adi Nugroho', 1),
(2401002, 'Alya Zahra', 1),
(2401003, 'Andi Saputra', 1),
(2401004, 'Anisa Putri', 1),
(2401005, 'Arif Rahman', 1),
(2401006, 'Ayu Lestari', 1),
(2401007, 'Bagas Pratama', 1),
(2401008, 'Bella Safira', 1),
(2401009, 'Bima Sakti', 1),
(2401010, 'Citra Dewi', 1),
(2401011, 'Daffa Ramadhan', 1),
(2401012, 'Desi Wulandari', 1),
(2401013, 'Dimas Aditya', 1),
(2401014, 'Eka Puspita', 1),
(2401015, 'Fajar Setiawan', 1),
(2401016, 'Fani Aulia', 1),
(2401017, 'Galih Pratama', 1),
(2401018, 'Hana Maharani', 1),
(2401019, 'Ilham Maulana', 1),
(2401020, 'Intan Permata', 1),
(2401021, 'Joko Widodo', 1),
(2401022, 'Kartika Sari', 1),
(2401023, 'Lukman Hakim', 1),
(2401024, 'Maya Anggraini', 1),
(2401025, 'Nanda Pratiwi', 1),
(2401026, 'Novi Lestari', 1),
(2401027, 'Omar Bakri', 1),
(2401028, 'Putri Rahayu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`ID_Akun`),
  ADD KEY `Menjaga` (`Admin_ID`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`ID_Guru`),
  ADD KEY `Mengatur` (`Admin_ID`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID_Kelas`);

--
-- Indexes for table `kelas_mapel`
--
ALTER TABLE `kelas_mapel`
  ADD PRIMARY KEY (`id_kelas`,`id_mapel`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id_kelas`,`nis`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`ID_MaPel`),
  ADD KEY `Input` (`Admin_ID`),
  ADD KEY `Mengajar` (`id_guru`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NIS`),
  ADD KEY `Setting` (`Admin_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `ID_Akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `ID_Guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `ID_Kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `ID_MaPel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `Menjaga` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`ID_Admin`);

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `Mengatur` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`ID_Admin`);

--
-- Constraints for table `kelas_mapel`
--
ALTER TABLE `kelas_mapel`
  ADD CONSTRAINT `kelas_mapel_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`ID_Kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_mapel_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`ID_MaPel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`ID_Kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_siswa_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`NIS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `Input` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`ID_Admin`),
  ADD CONSTRAINT `Mengajar` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`ID_Guru`);

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`ID_Kelas`),
  ADD CONSTRAINT `presensi_ibfk_3` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`ID_MaPel`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `Setting` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`ID_Admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
