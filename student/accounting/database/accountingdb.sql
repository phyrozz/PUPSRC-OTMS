-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 02:33 AM
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
-- Database: `accountingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountingtb`
--

CREATE TABLE `accountingtb` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `student_number` varchar(45) NOT NULL,
  `birthDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountingtb`
--

INSERT INTO `accountingtb` (`user_id`, `first_name`, `last_name`, `student_number`, `birthDate`) VALUES
(1, 'sample2', 'sample2', '123456789', '2003-10-08'),
(2, 'sample', 'sample', 'sample', '2000-01-01'),
(3, 'sample3', 'sample3', 'sample3', '2014-05-05'),
(4, 'sampletwo', 'sampletwo', '123456789', '2014-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `offsettingtb`
--

CREATE TABLE `offsettingtb` (
  `offsetting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amountToOffset` decimal(6,2) NOT NULL,
  `offsetType` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountingtb`
--
ALTER TABLE `accountingtb`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `offsettingtb`
--
ALTER TABLE `offsettingtb`
  ADD PRIMARY KEY (`offsetting_id`),
  ADD KEY `offsetting_user_pk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountingtb`
--
ALTER TABLE `accountingtb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offsettingtb`
--
ALTER TABLE `offsettingtb`
  MODIFY `offsetting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offsettingtb`
--
ALTER TABLE `offsettingtb`
  ADD CONSTRAINT `offsetting_user_pk` FOREIGN KEY (`user_id`) REFERENCES `accountingtb` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
