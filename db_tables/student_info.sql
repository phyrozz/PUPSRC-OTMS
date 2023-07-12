-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 09:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `course` varchar(200) NOT NULL,
  `documentType` varchar(200) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `studentNumber` varchar(15) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `referenceNumber` varchar(20) NOT NULL,
  `image_url` text NOT NULL,
  `date&time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`course`, `documentType`, `payment_id`, `firstName`, `middleName`, `lastName`, `studentNumber`, `amount`, `referenceNumber`, `image_url`, `date&time`) VALUES
('Bachelor of Science in Information Technology', 'Academic Verification Service', 24, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '10.00', '12313213213213213213', 'uploads/payment_24_John Mark_Garapan.png', '2023-07-11 01:48:42'),
('Bachelor of Science in Business Administration Major in Human Resource Management', 'Processing of Request for Correction of Name: PSA/School Records', 25, 'Dorothy', 'Dauan', 'Garapan', '', '200.00', '54654645646546465465', 'uploads/payment_25_Dorothy_Garapan.png', '2023-07-11 02:00:05'),
('Bachelor in Secondary Education Major in English', 'Late Reporting of Grade', 26, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '20.00', '78978979879879798987', 'uploads/payment_26_John Mark_Garapan.jpg', '2023-07-11 18:10:11'),
('Bachelor of Science in Psychology', 'Informative Copy of Grades', 27, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '900.00', '79879879879879879879', 'uploads/payment_27_John Mark_Garapan.png', '2023-07-11 19:38:50'),
('Bachelor in Secondary Education Major in Mathematics', 'Processing of Request for Correction of Name: PSA/School Records', 28, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '30.00', '30303030303030303030', 'uploads/payment_28_John Mark_Garapan.jpg', '2023-07-12 02:27:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
