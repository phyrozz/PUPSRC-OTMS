-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 09:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `request_equipment`
--

CREATE TABLE `request_equipment` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime_schedule` datetime DEFAULT NULL,
  `quantity_equip` int(30) NOT NULL,
  `status_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `purpose` text NOT NULL,
  `equipment_id` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_equipment`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_equipment`
--
ALTER TABLE `request_equipment`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_equipment`
--
ALTER TABLE `request_equipment`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_equipment`
--
ALTER TABLE `request_equipment`
  ADD CONSTRAINT `request_equipment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `request_equipment_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`);
  ADD CONSTRAINT `request_equipment_ibfk_3` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
