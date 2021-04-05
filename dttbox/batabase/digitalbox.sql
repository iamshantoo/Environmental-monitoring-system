-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2020 at 10:24 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbox`
--

CREATE TABLE `dbox` (
  `id` int(255) NOT NULL,
  `DID` varchar(255) DEFAULT NULL,
  `TMP` varchar(255) DEFAULT NULL,
  `HUM` varchar(255) DEFAULT NULL,
  `CO2` varchar(255) DEFAULT NULL,
  `VOC` varchar(255) DEFAULT NULL,
  `CH4` varchar(255) DEFAULT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbox`
--

INSERT INTO `dbox` (`id`, `DID`, `TMP`, `HUM`, `CO2`, `VOC`, `CH4`, `date`) VALUES
(1, '1002', '27', '65', '1161', '109', '1', '2020-01-05 13:30:28.527433'),
(2, '1002', '24', '56', '717', '48', '1', '2020-01-05 15:34:42.780341'),
(3, '1002', '27', '56', '1692', '189', '0', '2020-01-06 13:28:16.506442'),
(4, '1002', '28', '52', '1775', '201', '0', '2020-01-06 15:06:16.717681'),
(5, '1002', '28', '52', '1771', '201', '0', '2020-01-06 15:10:57.330237'),
(6, '1002', '28', '53', '1918', '224', '0', '2020-01-06 15:15:38.386577'),
(7, '1002', '28', '51', '1840', '212', '0', '2020-01-06 15:20:18.794070');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbox`
--
ALTER TABLE `dbox`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbox`
--
ALTER TABLE `dbox`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
