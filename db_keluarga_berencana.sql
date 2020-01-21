-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2020 at 04:04 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keluarga_berencana`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_kontrasepsi`
--

CREATE TABLE `list_kontrasepsi` (
  `Id_Kontrasepsi` int(3) NOT NULL,
  `Nama_Kontrasepsi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_kontrasepsi`
--

INSERT INTO `list_kontrasepsi` (`Id_Kontrasepsi`, `Nama_Kontrasepsi`) VALUES
(1, 'Pil'),
(2, 'Kondom'),
(3, 'IUD');

-- --------------------------------------------------------

--
-- Table structure for table `list_pemakai_kontrasepsi`
--

CREATE TABLE `list_pemakai_kontrasepsi` (
  `Id_List` int(3) NOT NULL,
  `Id_Propinsi` int(3) NOT NULL,
  `Id_Kontrasepsi` int(3) NOT NULL,
  `Jumlah_Pemakai` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_pemakai_kontrasepsi`
--

INSERT INTO `list_pemakai_kontrasepsi` (`Id_List`, `Id_Propinsi`, `Id_Kontrasepsi`, `Jumlah_Pemakai`) VALUES
(1, 1, 1, 50),
(2, 1, 2, 66),
(3, 1, 3, 25),
(4, 2, 1, 100),
(5, 2, 2, 75),
(6, 2, 3, 50),
(7, 1, 2, 40),
(8, 2, 2, 65),
(9, 3, 3, 90),
(10, 3, 2, 80);

-- --------------------------------------------------------

--
-- Table structure for table `list_propinsi`
--

CREATE TABLE `list_propinsi` (
  `Id_Propinsi` int(3) NOT NULL,
  `Nama_Propinsi` varchar(20) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_propinsi`
--

INSERT INTO `list_propinsi` (`Id_Propinsi`, `Nama_Propinsi`) VALUES
(1, 'Aceh'),
(2, 'Sumatera Utara'),
(3, 'Sumatera Barat'),
(4, 'Riau'),
(5, 'Kepulauan Riau'),
(6, 'Jambi'),
(7, 'Bangka Belitung'),
(8, 'Sumatera Selatan'),
(9, 'Lampung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_kontrasepsi`
--
ALTER TABLE `list_kontrasepsi`
  ADD PRIMARY KEY (`Id_Kontrasepsi`);

--
-- Indexes for table `list_pemakai_kontrasepsi`
--
ALTER TABLE `list_pemakai_kontrasepsi`
  ADD PRIMARY KEY (`Id_List`),
  ADD KEY `Id_Propinsi` (`Id_Propinsi`,`Id_Kontrasepsi`),
  ADD KEY `Id_Kontrasepsi` (`Id_Kontrasepsi`);

--
-- Indexes for table `list_propinsi`
--
ALTER TABLE `list_propinsi`
  ADD PRIMARY KEY (`Id_Propinsi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_kontrasepsi`
--
ALTER TABLE `list_kontrasepsi`
  MODIFY `Id_Kontrasepsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_pemakai_kontrasepsi`
--
ALTER TABLE `list_pemakai_kontrasepsi`
  MODIFY `Id_List` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `list_propinsi`
--
ALTER TABLE `list_propinsi`
  MODIFY `Id_Propinsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_pemakai_kontrasepsi`
--
ALTER TABLE `list_pemakai_kontrasepsi`
  ADD CONSTRAINT `list_pemakai_kontrasepsi_ibfk_1` FOREIGN KEY (`Id_Propinsi`) REFERENCES `list_propinsi` (`Id_Propinsi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `list_pemakai_kontrasepsi_ibfk_2` FOREIGN KEY (`Id_Kontrasepsi`) REFERENCES `list_kontrasepsi` (`Id_Kontrasepsi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
