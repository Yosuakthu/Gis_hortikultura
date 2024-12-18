-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 05:02 PM
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
-- Database: `webgis`
--

-- --------------------------------------------------------

--
-- Table structure for table `lahan_pertanian`
--

CREATE TABLE `lahan_pertanian` (
  `id` int(10) NOT NULL,
  `nama_lokasi` varchar(50) NOT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `luas_lahan` varchar(10) NOT NULL,
  `elevasi` varchar(10) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lahan_pertanian`
--

INSERT INTO `lahan_pertanian` (`id`, `nama_lokasi`, `kelurahan`, `luas_lahan`, `elevasi`, `latitude`, `longitude`) VALUES
(2, 'Kebun Tate', 'Pananekeng', '0,7 ha', '495 mdpl', 3.662817, 125.475276);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lahan_pertanian`
--
ALTER TABLE `lahan_pertanian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lahan_pertanian`
--
ALTER TABLE `lahan_pertanian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
