-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 01:39 PM
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
  `user_id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) NOT NULL,
  `studentNumber` varchar(15) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `referenceNumber` varchar(20) NOT NULL,
  `image_url` text NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`payment_id`, `course`, `documentType`, `user_id`, `firstName`, `middleName`, `lastName`, `studentNumber`, `amount`, `referenceNumber`, `image_url`, `transaction_date`, `status`) VALUES
(24, 'Bachelor of Science in Information Technology', 'Certified True Copy', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '250.00', '23123565674564564458', 'uploads/payment_24_Juan_Dela Cruz.jpg', '2023-07-12 23:31:16', ''),
(25, 'Bachelor of Science in Information Technology', 'Certified True Copy', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '150.00', '21327694959680580962', 'uploads/payment_25_Joshua_Malabanan.jpg', '2023-07-13 11:09:19', ''),
(26, 'Bachelor of Science in Information Technology', 'Late Reporting of Grade', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '50.00', '21342547095384634024', 'uploads/payment_26_Joshua_Malabanan.jpg', '2023-07-13 11:14:29', ''),
(27, 'Bachelor of Science in Information Technology', 'Late Reporting of Grade', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '125.00', '43568906234523534645', 'uploads/payment_27_Joshua_Malabanan.jpg', '2023-07-13 11:14:58', ''),
(28, 'Bachelor of Science in Information Technology', 'Academic Verification Service', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '50.00', '34445767463454525342', 'uploads/payment_28_Juan_Dela Cruz.jpg', '2023-07-13 11:34:20', ''),
(29, 'Bachelor of Science in Information Technology', 'Application for Graduation SIS and Non-SIS', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '100.00', '45365732452342353453', 'uploads/payment_29_Juan_Dela Cruz.jpeg', '2023-07-13 11:34:38', ''),
(30, 'Bachelor of Science in Information Technology', 'Certificate of Attendance', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '125.00', '43654674767456363636', 'uploads/payment_30_Juan_Dela Cruz.jpg', '2023-07-13 11:35:02', ''),
(31, 'Bachelor in Secondary Education Major in English', 'Academic Verification Service', 42, 'Pedro', NULL, 'Dela Cruz', NULL, '100.00', '23256576763453453453', 'uploads/payment_31_Pedro_Dela Cruz.png', '2023-07-19 17:54:51', ''),
(35, 'Bachelor in Secondary Education Major in Filipino', 'Certificate of General Weighted Average (GWA)', 42, 'Pedro', '', 'Dela Cruz', NULL, '100.00', '23425345234323453453', 'uploads/payment_35_Pedro_Dela Cruz.png', '2023-07-19 18:10:46', ''),
(36, 'Bachelor of Science in Information Technology', 'Completion of Incomplete Grade', 42, 'Pedro', '', 'Dela Cruz', NULL, '200.00', '45235587863634625124', 'uploads/payment_36_Pedro_Dela Cruz.png', '2023-07-19 18:14:46', ''),
(37, 'Bachelor of Science in Information Technology', 'Completion of Incomplete Grade', 42, 'Pedro', '', 'Dela Cruz', NULL, '200.00', '45235587863634625124', 'uploads/payment_37_Pedro_Dela Cruz.png', '2023-07-19 18:16:07', ''),
(38, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Transcript of Records (Copy for Another School)', 42, 'Pedro', '', 'Dela Cruz', NULL, '100.00', '43545433412643562342', 'uploads/payment_38_Pedro_Dela Cruz.png', '2023-07-19 18:17:04', ''),
(39, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '122.00', '32143432432565436234', 'uploads/payment_39_Joshua_Malabanan.png', '2023-07-19 18:18:25', ''),
(40, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '122.00', '32143432432565436234', 'uploads/payment_40_Joshua_Malabanan.png', '2023-07-19 18:20:33', ''),
(41, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', '122.00', '32143432432565436234', 'uploads/payment_41_Joshua_Malabanan.png', '2023-07-19 18:20:33', ''),
(42, 'Bachelor of Science in Information Technology', 'Certificate of Graduation', 42, 'Pedro', '', 'Dela Cruz', NULL, '100.00', '32158855324214754762', 'uploads/payment_42_Pedro_Dela Cruz.png', '2023-07-19 18:21:12', ''),
(44, 'Bachelor of Science in Information Technology', 'Non Issuance of Special Order', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '100.00', '45324423432654351245', 'uploads/payment_44_Juan_Dela Cruz.png', '2023-07-19 18:24:29', 'Processed'),
(45, 'Bachelor of Science in Management Accounting', 'Certificate of Attendance', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', '100.00', '43546524236547634534', 'uploads/payment_45_Juan_Dela Cruz.png', '2023-07-19 18:28:06', 'Pending'),
(46, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 47, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '20.00', '12312312312312312312', 'uploads/payment_46_John Mark_Garapan.jpg', '2023-07-21 14:55:11', 'Processed'),
(47, 'Bachelor of Science in Information Technology', 'Late Reporting of Grade', 47, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '789.00', '78978797879879879879', 'uploads/payment_47_John Mark_Garapan.png', '2023-07-21 18:24:25', 'Processed'),
(48, 'Bachelor of Science in Information Technology', 'Certified True Copy', 48, 'Dauan', 'Dan', 'Grace', NULL, '123.00', '12312312312312312312', 'uploads/payment_48_Dauan_Grace.png', '2023-07-21 18:55:43', 'Processed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `student_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
