-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 08:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `counseling_schedules`
--

CREATE TABLE `counseling_schedules` (
  `counseling_id` int(11) NOT NULL,
  `appointment_description` varchar(255) DEFAULT NULL,
  `doc_requests_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `counseling_schedules`
--

INSERT INTO `counseling_schedules` (`counseling_id`, `appointment_description`, `doc_requests_id`) VALUES
(9, NULL, 27),
(10, NULL, 28),
(11, NULL, 29),
(12, NULL, 30),
(13, NULL, 31),
(14, NULL, 32),
(15, NULL, 33),
(16, NULL, 34),
(17, NULL, 35),
(18, NULL, 36),
(19, NULL, 37),
(20, NULL, 38),
(21, NULL, 39),
(22, NULL, 40),
(23, NULL, 41),
(24, NULL, 42),
(25, 'Goal Setting', 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  ADD PRIMARY KEY (`counseling_id`),
  ADD KEY `fk_schedules_doc_requests1_idx` (`doc_requests_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  MODIFY `counseling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  ADD CONSTRAINT `fk_schedules_doc_requests1` FOREIGN KEY (`doc_requests_id`) REFERENCES `doc_requests` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
