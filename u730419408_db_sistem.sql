-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 29, 2024 at 03:13 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u730419408_db_sistem`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user_sistem`
-- (See below for the actual view)
--
CREATE TABLE `view_user_sistem` (
`id_sistem` int(11)
,`nama_sistem` varchar(100)
,`singkatan` varchar(50)
,`url_sistem` varchar(255)
,`id_user_sistem` varchar(255)
,`password_sistem` varchar(100)
,`nama_user_sistem` varchar(255)
,`created_on` datetime
,`created_by` varchar(100)
,`updated_on` datetime
,`updated_by` varchar(100)
,`judul_sistem` varchar(100)
,`sub_judul` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `w_jenis_sistem`
--

CREATE TABLE `w_jenis_sistem` (
  `id_sistem` int(11) NOT NULL,
  `nama_sistem` varchar(100) DEFAULT NULL,
  `singkatan` varchar(50) DEFAULT NULL,
  `url_sistem` varchar(255) DEFAULT NULL,
  `judul_sistem` varchar(100) NOT NULL DEFAULT 'Selamat Datang di',
  `sub_judul` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `w_jenis_sistem`
--

INSERT INTO `w_jenis_sistem` (`id_sistem`, `nama_sistem`, `singkatan`, `url_sistem`, `judul_sistem`, `sub_judul`) VALUES
(7, 'SIPANDAWA', 'SIPANDAWA', 'app/sipandawa/temp/dashboard.php', 'Sistem Pendapatan Pegawai', 'SIPANDAWA');

-- --------------------------------------------------------

--
-- Table structure for table `w_mapping_sistem`
--

CREATE TABLE `w_mapping_sistem` (
  `id_user_sistem` varchar(100) NOT NULL,
  `id_sistem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `w_mapping_sistem`
--

INSERT INTO `w_mapping_sistem` (`id_user_sistem`, `id_sistem`) VALUES
('admin', 1),
('admin', 2),
('admin', 3),
('admin', 4),
('admin', 5),
('admin', 6),
('admin', 7),
('admin', 8),
('adminsipandawa', 7),
('adminisa', 8),
('pman', 5),
('198805222007012002', 7),
('197007281998031007', 7),
('200004172022012004', 7),
('200004262022012001', 7),
('200004292022012004', 7),
('200005052022012001', 7),
('200005112022012002', 7),
('200111232022012001', 7),
('198411272006042007', 7),
('198208022012122002', 7),
('198409052010011001', 7),
('197312101999012001', 7),
('198511222005011004', 7),
('198606112005011004', 7),
('197106041994032005', 7),
('197304022008011010', 7),
('197704211997032002', 7),
('197908102008011022', 7),
('197908102010012023', 7),
('197409032008012009', 7),
('199604062020121004', 7),
('196802021990031013', 7),
('197105022006042024', 7),
('197103242008011007', 7),
('197908172005011015', 7),
('196902011997031006', 7),
('197007222003121002', 7),
('197907102009011003', 7),
('198002072006041012', 7),
('199911082022011001', 7),
('200001022022011004', 7),
('197508062001122005', 7),
('198406202011011004', 7),
('198310302010011003', 7),
('199904062022012001', 7),
('199904282022012001', 7),
('197805252009011006', 7),
('197901222008011011', 7),
('196906051990031008', 7),
('196804212003122004', 7),
('197707092006042028', 7),
('197706202008011009', 7),
('198401232010012011', 7),
('199305062020122007', 7),
('heri', 5),
('diki', 5),
('idam', 5),
('burhan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `w_user_sistem`
--

CREATE TABLE `w_user_sistem` (
  `id_user_sistem` varchar(255) NOT NULL,
  `password_sistem` varchar(100) DEFAULT NULL,
  `nama_user_sistem` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(100) DEFAULT NULL,
  `updated_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `sts_user` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `w_user_sistem`
--

INSERT INTO `w_user_sistem` (`id_user_sistem`, `password_sistem`, `nama_user_sistem`, `created_on`, `created_by`, `updated_on`, `updated_by`, `sts_user`) VALUES
('196802021990031013', '614807dea9faa9d36b531dca1c845a40', 'MOHAMMAD NASHRULLOH, M.SI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('196804212003122004', 'c402e193e327a501d83b58e9f8922cae', 'IDA NOERIYATI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('196902011997031006', 'fb68452826eb33c815a84f6de1e77163', 'M A S R U K I N', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('196906051990031008', '48d58eb33cd49bccf3c17beda67ce35c', 'SUPADI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197007222003121002', '3073b4c9c5191db630ee7d89755f2765', 'RASTYO SATPRIYO SULISTYONO.SE', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197007281998031007', 'b7bf8887a8c49d8217650aeea625b2a8', 'SUPARYONO', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197103242008011007', '52f9192718ce01bae5597acc575cc865', 'MOHAMMAD SODIK ARIPIN', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197105022006042024', '749a3b9fd83c814e407b2d00c8624595', 'ENY PUDJI MULJOWATI.', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197106041994032005', '61cc68869de3ffa1067c34395b5463e1', 'NANIK NINGSIH.', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197304022008011010', 'f4fdffe962c0e454e4b8938d3b92dc2e', 'DJOKO SUSILO', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197312101999012001', '8e34574a305037beccbe946b67e81c10', 'DWI ARIYANI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197409032008012009', 'bf3bb20db38b8cb58f19f93ba2ceadec', 'RIRIN ISMAWATI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197508062001122005', '5bcbfe1c58a5c06967d9b193c0f00b4c', 'ENI SULISTIYORINI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197704211997032002', 'd0b01294764db975a785e4a176becf62', 'EVIN HARYANTI SUSILO', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197706202008011009', '0f173f52381f3047676e374cc269d4ea', 'M. AINUN NAIM', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197707092006042028', '5b901153717dd444084cb43661ddbf22', 'GUSTINA ARI MURTI,', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197805252009011006', '91aa3705f2c37cb2597bc26ff33a156d', 'MISWANTO', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197901222008011011', '9515a9ce1809704304d90b66bc1b16d6', 'ANDI ISTIQOM', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197907102009011003', '23ca7ce3a13b45e89cf86140adb97a44', 'HERDY PURNOMO', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197908102008011022', '425d835a7ee3f3acecdee51dddfc4dae', 'ASTA MARGIANA,S.AP', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197908102010012023', 'a26545e9656fe1a88ad5669f17952ff1', 'ITA SETIANINGRUM', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('197908172005011015', '2c077a59ef2da817edec68aca05691e4', 'SULUH AGUS HENDRAWAN', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198002072006041012', '62464d4d095ece430bc4ddd993582eaa', 'FERRY WIDIANTO', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198208022012122002', '6985add93db0a1669105a89004e9537f', 'CHANDRA DYAH ANGGRAINI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198310302010011003', 'e8dd00f320d3195671c3d40d4ae2ae82', 'ARIS DALIMARTA', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198401232010012011', '1c760b48045f6d14dac8fceba42136e4', 'ASTRI YURIANNA.', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198406202011011004', 'de31283b4e99f100a2432a13e7b9933a', 'LUTVY ARDIAN S.AP.', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198409052010011001', 'e668583d46d59f85072427771e0defad', 'MUHAMMAD ROZIQI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198411272006042007', '14bdfdd43d0b98c23e7c57e97e7fb8eb', 'NOVI DWI REVA YANTI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198511222005011004', '1058530daaa26c65d474a20423fd9f07', 'ARIEF BUDIONO', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198606112005011004', '939fb4f4ed0d14ac54aacd17e5c66dc2', 'FITHRIANTO WICAKSONO.K', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('198805222007012002', '55d1fbd590d10f14ffe910d288d4edbb', 'MAY INDRA FATMAWATI,SIP', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('199305062020122007', 'ec4219465eba8d3748729e3ae1bba72a', 'HUSYRONIATUR ROBHATI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('199604062020121004', '8514d9bc1d67161d97268cea5b76fbbe', 'MOHAMMAD AMIRUL ROSYID', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('199904062022012001', '2706bb7c8928aaba300096210e7be3d8', 'DIYANA NUR AZIZAH', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('199904282022012001', '834a918e3abe28c6d39a3563bf254c49', 'IFTITAHUN NI\'AMILLAH KUSUMA RAHAYU', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('199911082022011001', 'a34a9f502db875f32203f1b84ea6632b', 'AHMAD HUSAIN DAIROBI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('200001022022011004', 'c11b655d35e3dbcdc6efcd89ad0c63a1', 'MOHAMMAD IMAN RAMADHANI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('200004172022012004', '8e891b7d0fa7886af9712065fdd28a99', 'FARAMILA HAPSARI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('200004262022012001', 'b26c211e46206df0514e3479a27cbd62', 'DWI RIZATUL AZIZAH', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('200004292022012004', 'fa4e039a12b9a9c63a63402349fc5b62', 'FIKRIYYAH SANIYYAH', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('200005052022012001', '160240ef94d20f850ec142995404c3de', 'ILMY FIRDAUS AULIYA', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('200005112022012002', 'fc108e6d68afbe48502465474dc9f31f', 'ELFIRA DAMAYANTI', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('200111232022012001', '357dfba48752c3abdcb18c031ace613f', 'JIHAN NOVIANTRI AGMALIA', '2023-06-18 16:42:20', NULL, '2023-06-18 16:42:20', NULL, 'Y'),
('admin', '5a1760628ea739e61d9bb798b50542d5', 'Super Admin', '2021-03-17 21:27:17', NULL, '2021-03-17 21:27:17', NULL, 'Y'),
('adminisa', 'ea733f3dc78d752359b7ceae5c806fa0', 'Admin', '2022-05-30 21:58:23', NULL, '2022-05-30 21:58:23', NULL, 'Y'),
('adminsipandawa', 'b06fe2f100d1ded7a0a514da36cff621', 'ADMIN PANDAWA', '2023-05-21 11:14:52', NULL, '2023-05-21 11:14:52', NULL, 'Y'),
('agung', '6f5d0ad4bc971cddc51a0c5f74bdf3fd', 'CS Dina', '2022-05-30 21:58:23', NULL, '2022-05-30 21:58:23', NULL, 'Y'),
('burhan', 'c1a5c76d5d692a72c570ac3dcf1eaf5a', 'Burhan', '2023-05-29 11:48:08', NULL, '2023-05-29 11:48:08', NULL, 'Y'),
('diki', 'dffaa4c60a250f19dc4a79b1d05c8d53', 'Diki', '2023-05-29 11:48:08', NULL, '2023-05-29 11:48:08', NULL, 'Y'),
('heri', 'af25458116a2464f9401870dff1e11f5', 'Heri', '2023-05-29 11:48:08', NULL, '2023-05-29 11:48:08', NULL, 'Y'),
('idam', '0b46f6c543c3186219fa38f8dd7bb74b', 'Idam', '2023-05-29 11:48:08', NULL, '2023-05-29 11:48:08', NULL, 'Y'),
('pman', 'e0a2f24d73095c06a02d82b7213a411e', 'pman', '2023-05-29 11:48:08', NULL, '2023-05-29 11:48:08', NULL, 'Y');

-- --------------------------------------------------------

--
-- Structure for view `view_user_sistem`
--
DROP TABLE IF EXISTS `view_user_sistem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u730419408_sistem`@`127.0.0.1` SQL SECURITY DEFINER VIEW `view_user_sistem`  AS SELECT `ms`.`id_sistem` AS `id_sistem`, `js`.`nama_sistem` AS `nama_sistem`, `js`.`singkatan` AS `singkatan`, `js`.`url_sistem` AS `url_sistem`, `us`.`id_user_sistem` AS `id_user_sistem`, `us`.`password_sistem` AS `password_sistem`, `us`.`nama_user_sistem` AS `nama_user_sistem`, `us`.`created_on` AS `created_on`, `us`.`created_by` AS `created_by`, `us`.`updated_on` AS `updated_on`, `us`.`updated_by` AS `updated_by`, `js`.`judul_sistem` AS `judul_sistem`, `js`.`sub_judul` AS `sub_judul` FROM ((`w_mapping_sistem` `ms` join `w_jenis_sistem` `js`) join `w_user_sistem` `us`) WHERE `js`.`id_sistem` = `ms`.`id_sistem` AND `ms`.`id_user_sistem` = `us`.`id_user_sistem` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `w_jenis_sistem`
--
ALTER TABLE `w_jenis_sistem`
  ADD PRIMARY KEY (`id_sistem`);

--
-- Indexes for table `w_user_sistem`
--
ALTER TABLE `w_user_sistem`
  ADD PRIMARY KEY (`id_user_sistem`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `w_jenis_sistem`
--
ALTER TABLE `w_jenis_sistem`
  MODIFY `id_sistem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
