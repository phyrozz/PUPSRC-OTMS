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
-- Table structure for table `doc_requests`
--

CREATE TABLE `doc_requests` (
  `request_id` int(11) NOT NULL,
  `request_description` varchar(255) DEFAULT NULL,
  `scheduled_datetime` datetime DEFAULT NULL,
  `office_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `attached_files` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doc_requests`
--

INSERT INTO `doc_requests` (`request_id`, `request_description`, `scheduled_datetime`, `office_id`, `user_id`, `status_id`, `amount_to_pay`, `attached_files`) VALUES
(27, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(28, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(29, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(30, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(31, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(32, NULL, '2023-06-16 01:00:00', 5, 31, 3, 0.00, ''),
(33, NULL, '2023-06-16 01:00:00', 5, 31, 3, 0.00, ''),
(34, NULL, '2023-06-04 08:00:00', 5, 31, 3, 0.00, ''),
(35, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(36, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(37, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(38, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(39, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(40, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(41, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(42, NULL, '0000-00-00 00:00:00', 5, 31, 3, 0.00, ''),
(43, NULL, '2023-06-17 12:00:00', 5, 28, 3, 0.00, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc_requests`
--
ALTER TABLE `doc_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_doc_requests_offices1_idx` (`office_id`),
  ADD KEY `fk_doc_requests_users1_idx` (`user_id`),
  ADD KEY `fk_doc_requests_statuses1_idx` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc_requests`
--
ALTER TABLE `doc_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doc_requests`
--
ALTER TABLE `doc_requests`
  ADD CONSTRAINT `fk_doc_requests_offices1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doc_requests_statuses1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doc_requests_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
