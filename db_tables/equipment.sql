-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 08:01 PM
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
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_name` varchar(100) NOT NULL,
  `availability` enum('Available','Unavailable') DEFAULT 'Available',
  `quantity` int(11) DEFAULT 0,
  `equipment_type_id` int(11) DEFAULT 0,
  `request` tinyint(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `equipment_name`, `availability`, `quantity`, `equipment_type_id`, `request`) VALUES
(1, 'Badminton Net', 'Available', 4, 2, 1),
(2, 'Badminton Racket', 'Available', 15, 2, 1),
(3, 'Badminton Shuttlecock', 'Available', 20, 2, 1),
(4, 'Basketball', 'Available', 10, 2, 1),
(5, 'BasketBall Ring and Net', 'Unavailable', 0, 2, 1),
(6, 'Brush', 'Available', 10, 3, 1),
(7, 'Bucket', 'Available', 15, 3, 1),
(8, 'Chairs', 'Available', 9, 1, 1),
(9, 'Cleaning Detergent', 'Available', 20, 3, 1),
(10, 'Curtains', 'Unavailable', 0, 1, 1),
(11, 'Chess Board', 'Available', 5, 2, 1),
(12, 'Digital Scoreboard', 'Unavailable', 0, 1, 1),
(13, 'Mop', 'Available', 10, 3, 1),
(14, 'Projectors', 'Available', 3, 1, 1),
(15, 'Scoreboard', 'Available', 2, 2, 1),
(16, 'Vacuum', 'Available', 5, 3, 1),
(17, 'Volleyball', 'Available', 6, 2, 1),
(18, 'Volleyball Net', 'Available', 3, 2, 1),
(19, 'Tables', 'Available', 10, 1, 1),
(20, 'TV', 'Available', 3, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `equipment_type_id` (`equipment_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`equipment_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
