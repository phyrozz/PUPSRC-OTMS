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
-- Table structure for table `appointment_facility`
--

CREATE TABLE `appointment_facility` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `start_date_time_sched` datetime DEFAULT NULL,
  `end_date_time_sched` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `purpose` varchar(200) DEFAULT NULL,
  `facility_id` int(11) NOT NULL,
  `orgs` varchar(100) DEFAULT NULL,
  `admin_reason` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `appointment_facility`
--

INSERT INTO `appointment_facility` (`appointment_id`, `user_id`, `status_id`, `start_date_time_sched`, `end_date_time_sched`, `email`, `purpose`, `facility_id`) VALUES
(1, 31, 3, '2023-06-12 11:00:00', '2023-06-12 11:30:00', 'mmallow624@gmail.com', 'asdasd213asdasd', 1),
(2, 31, 3, '2023-07-08 13:00:00', '2023-07-08 13:30:00', 'mmallow624@gmail.com', 'asdasd12312asdasd', 6),
(3, 31, 3, '2023-06-13 16:00:00', '2023-06-13 17:30:00', 'mmallow624@gmail.com', 'sdasd213asdasd', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `facility` (`facility_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  ADD CONSTRAINT `appointment_facility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_3` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`facility_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
