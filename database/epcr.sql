-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2024 at 06:12 PM
-- Server version: 8.0.36-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gmylcsnm_bsit4b`
--

-- --------------------------------------------------------

--
-- Table structure for table `epcr_category`
--

CREATE TABLE `epcr_category` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `epcr_category`
--

INSERT INTO `epcr_category` (`category_id`, `category_name`, `description`) VALUES
(1, 'Sanitation', 'COMPLAIN SA BASURA, KANAL O SA MGA PAGLILINIS'),
(2, 'Security', 'COMPLAIN SA MGA PAGNANAKAW'),
(3, 'Infrastructure', 'COMPLAIN SA MGA SAGABAL SA DAAN AT MGA SIRANG KALSADA'),
(4, 'Neighbor Concerns', 'COMLAIN SA MGA KAPITBAHAY, MAINGAY O AWAY AT IBP.'),
(5, 'Other Concerns', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `epcr_category`
--
ALTER TABLE `epcr_category`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `epcr_category`
--
ALTER TABLE `epcr_category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
