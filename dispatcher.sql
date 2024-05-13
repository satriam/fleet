-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2023 at 09:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dispatcher`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_input`
--

CREATE TABLE `detail_input` (
  `id` int(11) NOT NULL,
  `id_input` varchar(100) NOT NULL,
  `Exca` varchar(50) NOT NULL,
  `Nama_loading` varchar(100) NOT NULL,
  `Lokasi_dumping` varchar(100) NOT NULL,
  `Jarak` int(20) NOT NULL,
  `Jumlah_bb` int(20) NOT NULL,
  `Tonase` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dumping`
--

CREATE TABLE `dumping` (
  `id_dumping` int(11) NOT NULL,
  `Nama_dumping` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dumping`
--

INSERT INTO `dumping` (`id_dumping`, `Nama_dumping`) VALUES
(1, 'DH 3'),
(2, 'DH 4'),
(3, 'DH 5'),
(4, '1B'),
(5, '1A'),
(6, 'Elevasi 35 Utara'),
(7, 'Elevasi 35 Selatan'),
(8, 'Elevasi 37'),
(9, 'TLS 1 Utara'),
(10, 'TLS 1 Selatan'),
(11, 'TLS 2 Utara'),
(12, 'TLS 2 Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `fleet_info`
--

CREATE TABLE `fleet_info` (
  `id` int(11) NOT NULL,
  `Tanggal` varchar(100) NOT NULL,
  `Shift` varchar(30) NOT NULL,
  `Grup` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fleet_info`
--

INSERT INTO `fleet_info` (`id`, `Tanggal`, `Shift`, `Grup`) VALUES
(8, '7 November 2023 03:09:54', 'Shift 2', 'Grup B');

-- --------------------------------------------------------

--
-- Table structure for table `jarak`
--

CREATE TABLE `jarak` (
  `Id_jarak` int(11) NOT NULL,
  `Nama_loading` varchar(90) NOT NULL,
  `Nama_dumping` varchar(90) NOT NULL,
  `jarak` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jarak`
--

INSERT INTO `jarak` (`Id_jarak`, `Nama_loading`, `Nama_dumping`, `jarak`) VALUES
(1, 'DH3', 'Ts Niru', 13.5),
(2, 'DH 4', 'Ts Merbau', 8),
(3, 'Ts Niru', 'DH 4', 40.6),
(5, 'Ts Merbau', 'DH 4', 20),
(6, 'Ts Aren', 'DH 4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `loading`
--

CREATE TABLE `loading` (
  `id_loading` int(11) NOT NULL,
  `Nama_loading` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loading`
--

INSERT INTO `loading` (`id_loading`, `Nama_loading`) VALUES
(1, 'Ts Niru'),
(2, 'Ts Merbau'),
(3, 'Ts Aren'),
(4, 'Ts Sungkai'),
(5, 'Ts infit BWE'),
(6, 'Ts Mahoni'),
(7, 'Ts Greenbelt'),
(8, 'Ts Kemuning'),
(9, 'Ts Niru Ext'),
(10, 'Ts Sungkai Ext'),
(11, 'Ts Sakura'),
(12, 'Ts Raflesia'),
(13, 'Ts Merbau Ext'),
(14, '1A'),
(15, '1B'),
(16, 'Ts CCP'),
(17, 'Ts Timur Selatan'),
(18, 'Ts BWE 203 utara'),
(19, 'Ts BWE Ext'),
(20, 'Ts Cardiff'),
(21, 'Ts Liverpool'),
(22, 'Crusher PAMA'),
(23, 'Stock CIP'),
(24, 'Mobile Crusher OLC 12');

-- --------------------------------------------------------

--
-- Table structure for table `setting_dt`
--

CREATE TABLE `setting_dt` (
  `id_setting_dt` int(11) NOT NULL,
  `id_setting_fleet` int(11) NOT NULL,
  `Nama_DT` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `setting_dt`
--

INSERT INTO `setting_dt` (`id_setting_dt`, `id_setting_fleet`, `Nama_DT`) VALUES
(1, 5, 'DT01SGJ'),
(2, 4, 'DT01PIM'),
(5, 4, 'DT02SGJ'),
(6, 4, 'DT03SGJ'),
(7, 4, 'DT05SGJ');

-- --------------------------------------------------------

--
-- Table structure for table `setting_fleet`
--

CREATE TABLE `setting_fleet` (
  `Id_setting` int(11) NOT NULL,
  `id_info` int(11) NOT NULL,
  `Exca` varchar(40) NOT NULL,
  `Nama_loading` varchar(90) NOT NULL,
  `Loading_pengalihan_1` varchar(90) NOT NULL,
  `Loading_pengalihan_2` varchar(90) NOT NULL,
  `Loading_pengalihan_3` varchar(90) NOT NULL,
  `Nama_dumping` varchar(90) NOT NULL,
  `Dumping_pengalihan_1` varchar(90) NOT NULL,
  `Dumping_pengalihan_2` varchar(90) NOT NULL,
  `Dumping_pengalihan_3` varchar(90) NOT NULL,
  `Jenis_BB` varchar(90) NOT NULL,
  `Lokasi` varchar(90) NOT NULL,
  `Pengukuran` varchar(100) NOT NULL,
  `Status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `setting_fleet`
--

INSERT INTO `setting_fleet` (`Id_setting`, `id_info`, `Exca`, `Nama_loading`, `Loading_pengalihan_1`, `Loading_pengalihan_2`, `Loading_pengalihan_3`, `Nama_dumping`, `Dumping_pengalihan_1`, `Dumping_pengalihan_2`, `Dumping_pengalihan_3`, `Jenis_BB`, `Lokasi`, `Pengukuran`, `Status`) VALUES
(4, 8, 'Exca 02 SGJ', 'Ts Merbau', 'Ts infit BWE', 'Ts BWE 203 utara', 'Ts BWE 203 utara', 'DH 4', '1B', '1B', '1B', 'test', 'TAL', '', ''),
(5, 8, 'DH 4', 'Ts Aren', 'Ts Merbau', 'Ts Merbau', 'Ts Merbau', 'DH 4', 'DH 4', 'DH 4', 'DH 4', '35gf', 'MTB', 'Rata Rata', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `temporary`
--

CREATE TABLE `temporary` (
  `id_temporary` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `setting_dt` int(11) NOT NULL,
  `tonase` double NOT NULL,
  `loading_point` varchar(150) NOT NULL,
  `dumping_point` varchar(150) NOT NULL,
  `jarak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `temporary`
--

INSERT INTO `temporary` (`id_temporary`, `tanggal`, `setting_dt`, `tonase`, `loading_point`, `dumping_point`, `jarak`) VALUES
(2, '7 November 2023 07:07:49', 1, 22, 'Ts Aren', 'DH 4', ''),
(3, '7 November 2023 07:07:49', 1, 22, 'Ts Aren', 'DH 4', '2 km'),
(4, '7 November 2023 07:07:49', 1, 66, 'Ts Aren', 'DH 4', '2 km'),
(5, '7 November 2023 07:07:49', 5, 40, 'Ts Merbau', 'DH 4', '20 km'),
(6, '7 November 2023 07:07:49', 2, 44, 'Ts Merbau', 'DH 4', '20 km'),
(7, '7 November 2023 07:07:49', 1, 90, 'Ts Merbau', 'DH 4', '20 km');

-- --------------------------------------------------------

--
-- Table structure for table `unit_dt`
--

CREATE TABLE `unit_dt` (
  `id_unit` int(11) NOT NULL,
  `unit` varchar(90) NOT NULL,
  `mitra` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `unit_dt`
--

INSERT INTO `unit_dt` (`id_unit`, `unit`, `mitra`) VALUES
(2, 'DT01SGJ', 'Sumi Gita Jaya'),
(3, 'DT02SGJ', 'Sumi Gita Jaya'),
(4, 'DT03SGJ', 'Sumi Gita Jaya'),
(5, 'DT04SGJ', 'Sumi Gita Jaya'),
(6, 'DT05SGJ', 'Sumi Gita Jaya'),
(7, 'DT06SGJ', 'Sumi Gita Jaya'),
(8, 'DT07SGJ', 'Sumi Gita Jaya'),
(9, 'DT08SGJ', 'Sumi Gita Jaya'),
(10, 'DT09SGJ', 'Sumi Gita Jaya'),
(11, 'DT10SGJ', 'Sumi Gita Jaya'),
(12, 'DT11SGJ', 'Sumi Gita Jaya'),
(13, 'DT12SGJ', 'Sumi Gita Jaya'),
(14, 'DT13SGJ', 'Sumi Gita Jaya'),
(15, 'DT14SGJ', 'Sumi Gita Jaya'),
(16, 'DT15SGJ', 'Sumi Gita Jaya'),
(17, 'DT16SGJ', 'Sumi Gita Jaya'),
(18, 'DT17SGJ', 'Sumi Gita Jaya'),
(19, 'DT18SGJ', 'Sumi Gita Jaya'),
(20, 'DT19SGJ', 'Sumi Gita Jaya'),
(21, 'DT20SGJ', 'Sumi Gita Jaya'),
(23, 'DT21SGJ', 'Sumi Gita Jaya'),
(24, 'DT22SGJ', 'Sumi Gita Jaya'),
(25, 'DT23SGJ', 'Sumi Gita Jaya'),
(26, 'DT24SGJ', 'Sumi Gita Jaya'),
(27, 'DT25SGJ', 'Sumi Gita Jaya'),
(28, 'DT26SGJ', 'Sumi Gita Jaya'),
(29, 'DT27SGJ', 'Sumi Gita Jaya'),
(30, 'DT28SGJ', 'Sumi Gita Jaya'),
(31, 'DT29SGJ', 'Sumi Gita Jaya'),
(32, 'DT30SGJ', 'Sumi Gita Jaya'),
(33, 'DT31SGJ', 'Sumi Gita Jaya'),
(34, 'DT32SGJ', 'Sumi Gita Jaya'),
(35, 'DT33SGJ', 'Sumi Gita Jaya'),
(36, 'DT34SGJ', 'Sumi Gita Jaya'),
(37, 'DT35SGJ', 'Sumi Gita Jaya'),
(38, 'DT36SGJ', 'Sumi Gita Jaya'),
(39, 'DT37SGJ', 'Sumi Gita Jaya'),
(40, 'DT38SGJ', 'Sumi Gita Jaya'),
(41, 'DT39SGJ', 'Sumi Gita Jaya'),
(42, 'DT40SGJ', 'Sumi Gita Jaya'),
(43, 'DT41SGJ', 'Sumi Gita Jaya'),
(44, 'DT42SGJ', 'Sumi Gita Jaya'),
(45, 'DT43SGJ', 'Sumi Gita Jaya'),
(46, 'DT44SGJ', 'Sumi Gita Jaya'),
(47, 'DT45SGJ', 'Sumi Gita Jaya'),
(48, 'DT46SGJ', 'Sumi Gita Jaya'),
(49, 'DT47SGJ', 'Sumi Gita Jaya'),
(50, 'DT48SGJ', 'Sumi Gita Jaya'),
(51, 'DT49SGJ', 'Sumi Gita Jaya'),
(52, 'DT50SGJ', 'Sumi Gita Jaya'),
(53, 'DT51SGJ', 'Sumi Gita Jaya'),
(54, 'DT52SGJ', 'Sumi Gita Jaya'),
(55, 'DT53SGJ', 'Sumi Gita Jaya'),
(56, 'DT54SGJ', 'Sumi Gita Jaya'),
(57, 'DT55SGJ', 'Sumi Gita Jaya'),
(58, 'DT56SGJ', 'Sumi Gita Jaya'),
(59, 'DT57SGJ', 'Sumi Gita Jaya'),
(60, 'DT58SGJ', 'Sumi Gita Jaya'),
(61, 'DT59SGJ', 'Sumi Gita Jaya'),
(62, 'DT60SGJ', 'Sumi Gita Jaya'),
(63, 'DT61SGJ', 'Sumi Gita Jaya'),
(64, 'DT62SGJ', 'Sumi Gita Jaya'),
(65, 'DT63SGJ', 'Sumi Gita Jaya'),
(66, 'DT64SGJ', 'Sumi Gita Jaya'),
(67, 'DT65SGJ', 'Sumi Gita Jaya'),
(68, 'DT66SGJ', 'Sumi Gita Jaya'),
(69, 'DT67SGJ', 'Sumi Gita Jaya'),
(70, 'DT68SGJ', 'Sumi Gita Jaya'),
(71, 'DT69SGJ', 'Sumi Gita Jaya'),
(72, 'DT70SGJ', 'Sumi Gita Jaya'),
(73, 'DT71SGJ', 'Sumi Gita Jaya'),
(74, 'DT72SGJ', 'Sumi Gita Jaya'),
(75, 'DT73SGJ', 'Sumi Gita Jaya'),
(76, 'DT74SGJ', 'Sumi Gita Jaya'),
(77, 'DT75SGJ', 'Sumi Gita Jaya'),
(78, 'DT76SGJ', 'Sumi Gita Jaya'),
(79, 'DT77SGJ', 'Sumi Gita Jaya'),
(80, 'DT78SGJ', 'Sumi Gita Jaya'),
(81, 'DT79SGJ', 'Sumi Gita Jaya'),
(82, 'DT80SGJ', 'Sumi Gita Jaya'),
(83, 'DT81SGJ', 'Sumi Gita Jaya'),
(84, 'DT82SGJ', 'Sumi Gita Jaya'),
(85, 'DT83SGJ', 'Sumi Gita Jaya'),
(86, 'DT84SGJ', 'Sumi Gita Jaya'),
(87, 'DT85SGJ', 'Sumi Gita Jaya'),
(88, 'DT86SGJ', 'Sumi Gita Jaya'),
(89, 'DT87SGJ', 'Sumi Gita Jaya'),
(90, 'DT88SGJ', 'Sumi Gita Jaya'),
(91, 'DT89SGJ', 'Sumi Gita Jaya'),
(92, 'DT90SGJ', 'Sumi Gita Jaya'),
(93, 'DT01PIM', 'Prima Indojaya Mandiri'),
(94, 'DT02PIM', 'Prima Indojaya Mandiri'),
(95, 'DT03PIM', 'Prima Indojaya Mandiri'),
(96, 'DT04PIM', 'Prima Indojaya Mandiri'),
(97, 'DT05PIM', 'Prima Indojaya Mandiri'),
(98, 'DT06PIM', 'Prima Indojaya Mandiri'),
(99, 'DT07PIM', 'Prima Indojaya Mandiri'),
(100, 'DT08PIM', 'Prima Indojaya Mandiri'),
(101, 'DT09PIM', 'Prima Indojaya Mandiri'),
(102, 'DT10PIM', 'Prima Indojaya Mandiri'),
(103, 'DT11PIM', 'Prima Indojaya Mandiri'),
(104, 'DT12PIM', 'Prima Indojaya Mandiri'),
(105, 'DT13PIM', 'Prima Indojaya Mandiri'),
(106, 'DT14PIM', 'Prima Indojaya Mandiri'),
(107, 'DT15PIM', 'Prima Indojaya Mandiri'),
(108, 'DT16PIM', 'Prima Indojaya Mandiri'),
(109, 'DT17PIM', 'Prima Indojaya Mandiri'),
(110, 'DT18PIM', 'Prima Indojaya Mandiri'),
(111, 'DT19PIM', 'Prima Indojaya Mandiri'),
(112, 'DT20PIM', 'Prima Indojaya Mandiri'),
(113, 'DT21PIM', 'Prima Indojaya Mandiri'),
(114, 'DT22PIM', 'Prima Indojaya Mandiri'),
(115, 'DT23PIM', 'Prima Indojaya Mandiri'),
(116, 'DT24PIM', 'Prima Indojaya Mandiri'),
(117, 'DT25PIM', 'Prima Indojaya Mandiri'),
(118, 'DT01RDP', 'Rifansi Dwi Putra'),
(119, 'DT02RDP', 'Rifansi Dwi Putra'),
(120, 'DT03RDP', 'Rifansi Dwi Putra'),
(121, 'DT03RDP', 'Rifansi Dwi Putra'),
(122, 'DT04RDP', 'Rifansi Dwi Putra'),
(123, 'DT05RDP', 'Rifansi Dwi Putra'),
(124, 'DT06RDP', 'Rifansi Dwi Putra'),
(125, 'DT07RDP', 'Rifansi Dwi Putra'),
(126, 'DT08RDP', 'Rifansi Dwi Putra'),
(127, 'DT09RDP', 'Rifansi Dwi Putra'),
(128, 'DT10RDP', 'Rifansi Dwi Putra'),
(129, 'DT11RDP', 'Rifansi Dwi Putra'),
(130, 'DT12RDP', 'Rifansi Dwi Putra'),
(131, 'DT13RDP', 'Rifansi Dwi Putra'),
(132, 'DT14RDP', 'Rifansi Dwi Putra'),
(133, 'DT15RDP', 'Rifansi Dwi Putra'),
(134, 'DT16RDP', 'Rifansi Dwi Putra'),
(135, 'DT17RDP', 'Rifansi Dwi Putra'),
(136, 'DT18RDP', 'Rifansi Dwi Putra'),
(137, 'DT19RDP', 'Rifansi Dwi Putra'),
(138, 'DT20RDP', 'Rifansi Dwi Putra'),
(139, 'DT21RDP', 'Rifansi Dwi Putra'),
(140, 'DT22RDP', 'Rifansi Dwi Putra'),
(141, 'DT23RDP', 'Rifansi Dwi Putra'),
(142, 'DT24RDP', 'Rifansi Dwi Putra'),
(143, 'DT25RDP', 'Rifansi Dwi Putra'),
(144, 'DT26RDP', 'Rifansi Dwi Putra'),
(145, 'DT27RDP', 'Rifansi Dwi Putra');

-- --------------------------------------------------------

--
-- Table structure for table `unit_exca`
--

CREATE TABLE `unit_exca` (
  `id_unit` int(11) NOT NULL,
  `unit` varchar(90) NOT NULL,
  `mitra` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `unit_exca`
--

INSERT INTO `unit_exca` (`id_unit`, `unit`, `mitra`) VALUES
(1, 'Exca 01 SGJ', 'Sumi Gita Jaya'),
(2, 'Exca 02 SGJ', 'Sumi Gita Jaya'),
(3, 'DH 4', '33'),
(4, 'Exca 04 SGJ', 'Sumi Gita Jaya'),
(5, 'Exca 05 SGJ', 'Sumi Gita Jaya'),
(6, 'Exca 06 SGJ', 'Sumi Gita Jaya'),
(7, 'Exca 07 SGJ', 'Sumi Gita Jaya'),
(8, 'Exca 08 SGJ', 'Sumi Gita Jaya'),
(9, 'Exca 09 SGJ', 'Sumi Gita Jaya'),
(10, 'Exca 03 PIM', 'Prima Indojaya Mandiri'),
(11, 'Exca 04 PIM', 'Prima Indojaya Mandiri'),
(12, 'Exca 05 PIM', 'Prima Indojaya Mandiri'),
(13, 'Exca 06 PIM', 'Prima Indojaya Mandiri'),
(14, 'Exca 3019 RDP', 'Rifansi Dwi Putra'),
(15, 'Exca 3020 RDP', 'Rifansi Dwi Putra'),
(16, 'Exca 3021 RDP', 'Rifansi Dwi Putra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_input`
--
ALTER TABLE `detail_input`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dumping`
--
ALTER TABLE `dumping`
  ADD PRIMARY KEY (`id_dumping`);

--
-- Indexes for table `fleet_info`
--
ALTER TABLE `fleet_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jarak`
--
ALTER TABLE `jarak`
  ADD PRIMARY KEY (`Id_jarak`);

--
-- Indexes for table `loading`
--
ALTER TABLE `loading`
  ADD PRIMARY KEY (`id_loading`);

--
-- Indexes for table `setting_dt`
--
ALTER TABLE `setting_dt`
  ADD PRIMARY KEY (`id_setting_dt`),
  ADD KEY `Setting_Fleet` (`id_setting_fleet`);

--
-- Indexes for table `setting_fleet`
--
ALTER TABLE `setting_fleet`
  ADD PRIMARY KEY (`Id_setting`),
  ADD KEY `info` (`id_info`);

--
-- Indexes for table `temporary`
--
ALTER TABLE `temporary`
  ADD PRIMARY KEY (`id_temporary`);

--
-- Indexes for table `unit_dt`
--
ALTER TABLE `unit_dt`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `unit_exca`
--
ALTER TABLE `unit_exca`
  ADD PRIMARY KEY (`id_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_input`
--
ALTER TABLE `detail_input`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `dumping`
--
ALTER TABLE `dumping`
  MODIFY `id_dumping` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fleet_info`
--
ALTER TABLE `fleet_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jarak`
--
ALTER TABLE `jarak`
  MODIFY `Id_jarak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loading`
--
ALTER TABLE `loading`
  MODIFY `id_loading` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `setting_dt`
--
ALTER TABLE `setting_dt`
  MODIFY `id_setting_dt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setting_fleet`
--
ALTER TABLE `setting_fleet`
  MODIFY `Id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temporary`
--
ALTER TABLE `temporary`
  MODIFY `id_temporary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `unit_dt`
--
ALTER TABLE `unit_dt`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `unit_exca`
--
ALTER TABLE `unit_exca`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `setting_dt`
--
ALTER TABLE `setting_dt`
  ADD CONSTRAINT `Setting_Fleet` FOREIGN KEY (`id_setting_fleet`) REFERENCES `setting_fleet` (`Id_setting`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `setting_fleet`
--
ALTER TABLE `setting_fleet`
  ADD CONSTRAINT `info` FOREIGN KEY (`id_info`) REFERENCES `fleet_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
