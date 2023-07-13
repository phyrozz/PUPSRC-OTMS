-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 09:58 AM
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
  `payment_id` int(11) NOT NULL,
  `course` varchar(200) NOT NULL,
  `documentType` varchar(200) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `studentNumber` varchar(15) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `referenceNumber` varchar(20) NOT NULL,
  `image_url` text NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`payment_id`, `course`, `documentType`, `firstName`, `middleName`, `lastName`, `studentNumber`, `amount`, `referenceNumber`, `image_url`, `transaction_date`) VALUES
(24, 'Bachelor of Science in Information Technology', 'Certified True Copy', 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '250.00', '23123565674564564458', 'uploads/payment_24_Juan_Dela Cruz.jpg', '2023-07-12 23:31:16'),
(25, 'Bachelor of Science in Information Technology', 'Certified True Copy', 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '150.00', '21327694959680580962', 'uploads/payment_25_Joshua_Malabanan.jpg', '2023-07-13 11:09:19'),
(26, 'Bachelor of Science in Information Technology', 'Late Reporting of Grade', 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '50.00', '21342547095384634024', 'uploads/payment_26_Joshua_Malabanan.jpg', '2023-07-13 11:14:29'),
(27, 'Bachelor of Science in Information Technology', 'Late Reporting of Grade', 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '125.00', '43568906234523534645', 'uploads/payment_27_Joshua_Malabanan.jpg', '2023-07-13 11:14:58'),
(28, 'Bachelor of Science in Information Technology', 'Academic Verification Service', 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '50.00', '34445767463454525342', 'uploads/payment_28_Juan_Dela Cruz.jpg', '2023-07-13 11:34:20'),
(29, 'Bachelor of Science in Information Technology', 'Application for Graduation SIS and Non-SIS', 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '100.00', '45365732452342353453', 'uploads/payment_29_Juan_Dela Cruz.jpeg', '2023-07-13 11:34:38'),
(30, 'Bachelor of Science in Information Technology', 'Certificate of Attendance', 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '125.00', '43654674767456363636', 'uploads/payment_30_Juan_Dela Cruz.jpg', '2023-07-13 11:35:02'),
(31, 'Bachelor in Secondary Education Major in English', 'Academic Verification Service', 'Dorothy', 'Dauan', 'Garapan', '', '200.00', '21321312321321321321', 'uploads/payment_31_Dorothy_Garapan.png', '2023-07-13 15:41:18'),
(32, 'Bachelor in Secondary Education Major in Filipino', 'Application for Graduation SIS and Non-SIS', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '100.00', '44565465465465465465', 'uploads/payment_32_John Mark_Garapan.png', '2023-07-13 15:46:00');

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
