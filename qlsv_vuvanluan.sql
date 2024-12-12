-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 07:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlsv_vuvanluan`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_studen`
--

CREATE TABLE `table_studen` (
  `id` int(50) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` int(50) NOT NULL,
  `hometown` varchar(255) NOT NULL,
  `level_id` int(50) NOT NULL,
  `group_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_studen`
--

INSERT INTO `table_studen` (`id`, `fullname`, `dob`, `gender`, `hometown`, `level_id`, `group_id`) VALUES
(2, 'Nguyễn Việt Anh', '2005-06-17', 1, 'Hà Nội', 1, 7),
(3, 'Nguyễn Ngọc Linh', '2005-08-22', 0, 'Hà Nội', 0, 7),
(4, 'Trần Duy Hưng', '2005-04-27', 1, 'Hà Nội', 0, 7),
(6, 'Vũ Văn Luân', '2005-06-05', 1, 'Nam Định', 0, 7),
(7, 'Nguyễn Việt Hoàng An', '2005-06-03', 1, 'Hà Tây', 0, 7),
(8, 'Lại Văn Hưng', '2005-09-01', 1, 'Thanh Hoa', 0, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_studen`
--
ALTER TABLE `table_studen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_studen`
--
ALTER TABLE `table_studen`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
