-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 08:26 PM
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
(40, 'Bachelor of Science in Information Technology', 'Certified True Copy', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '10.00', '12312132132132123132', 'uploads/payment_40_John Mark_Garapan.png', '2023-07-14 00:14:55'),
(41, 'Bachelor of Science in Psychology', 'Certified True Copy', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '20.00', '46546546546546465465', 'uploads/payment_41_John Mark_Garapan.png', '2023-07-14 00:15:15'),
(42, 'Bachelor in Technology And Livelihood Education Major in Home Economics', 'Processing of Request for Correction of Name: PSA/School Records', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '30.00', '78978798798798789798', 'uploads/payment_42_John Mark_Garapan.jpg', '2023-07-14 00:15:36'),
(43, 'Bachelor in Secondary Education Major in Mathematics', 'Certificate of Medium of Instruction', 'Dorothy', 'Dauan', 'Garapan', '', '40.00', '13121321231231231212', 'uploads/payment_43_Dorothy_Garapan.png', '2023-07-14 00:25:46'),
(44, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Processing of Request for Correction of Name: PSA/School Records', 'Dorothy', 'Dauan', 'Garapan', '', '50.00', '46465465465465465465', 'uploads/payment_44_Dorothy_Garapan.png', '2023-07-14 00:26:09'),
(45, 'Bachelor of Science in Business Administration Major in Marketing Management', 'Certification, Verification, Authentication (CAV/Apostile)', 'Dorothy', 'Dauan', 'Garapan', '', '60.00', '78798798789789787878', 'uploads/payment_45_Dorothy_Garapan.png', '2023-07-14 00:26:29'),
(46, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Certification, Verification, Authentication (CAV/Apostile)', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '70.00', '17174174174174174147', 'uploads/payment_46_John Mark_Garapan.jpg', '2023-07-14 00:34:09'),
(47, 'Bachelor in Secondary Education Major in Mathematics', 'Transcript of Records (Copy for Another School)', 'Dorothy', 'Dauan', 'Garapan', '', '80.00', '22828285285285285285', 'uploads/payment_47_Dorothy_Garapan.png', '2023-07-14 00:44:00'),
(48, 'Bachelor in Technology And Livelihood Education Major in Home Economics', 'Certified True Copy', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '100.00', '57367356846575786437', 'uploads/payment_48_John Mark_Garapan.png', '2023-07-14 00:50:22'),
(49, 'Bachelor in Secondary Education Major in Mathematics', 'Certificate of Transfer Credential/Honorable Dismissal', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '150.00', '34486456875348673546', 'uploads/payment_49_John Mark_Garapan.png', '2023-07-14 00:50:52'),
(50, 'Bachelor in Secondary Education Major in Mathematics', 'Certificate of Transfer Credential/Honorable Dismissal', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '200.00', '78674654796845687656', 'uploads/payment_50_John Mark_Garapan.png', '2023-07-14 00:51:16'),
(51, 'Bachelor of Science in Business Administration Major in Marketing Management', 'Course Accreditation Service (for Transferees)', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '205.00', '54654687456413321364', 'uploads/payment_51_John Mark_Garapan.png', '2023-07-14 00:51:56'),
(52, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Completion of Incomplete Grade', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '454.00', '45468431354643545643', 'uploads/payment_52_John Mark_Garapan.jpg', '2023-07-14 00:52:11'),
(53, 'Bachelor of Science in Business Administration Major in Marketing Management', 'Application for Graduation SIS and Non-SIS', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '201.00', '54647864346846543387', 'uploads/payment_53_John Mark_Garapan.jpg', '2023-07-14 00:52:31'),
(54, 'Bachelor in Technology And Livelihood Education Major in Home Economics', 'Certificate of Transfer Credential/Honorable Dismissal', 'Dorothy', 'Dauan', 'Garapan', '', '456.00', '46575464654646784354', 'uploads/payment_54_Dorothy_Garapan.png', '2023-07-14 00:53:23'),
(55, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Academic Verification Service', 'Dorothy', 'Dauan', 'Garapan', '', '56.00', '78879879879454687895', 'uploads/payment_55_Dorothy_Garapan.png', '2023-07-14 00:53:40'),
(56, 'Bachelor of Science in Business Administration Major in Marketing Management', 'Transcript of Records (Second and succeeding copies)', 'Dorothy', 'Dauan', 'Garapan', '', '99.00', '54684653464321131212', 'uploads/payment_56_Dorothy_Garapan.png', '2023-07-14 00:54:02'),
(57, 'Bachelor of Science in Industrial Engineering', 'Certification, Verification, Authentication (CAV/Apostile)', 'Dorothy', 'Dauan', 'Garapan', '', '55.00', '54547879879879879879', 'uploads/payment_57_Dorothy_Garapan.png', '2023-07-14 00:54:41'),
(58, 'Bachelor of Science in Management Accounting', 'Non Issuance of Special Order', 'Dorothy', 'Dauan', 'Garapan', '', '361.00', '21324631213132136563', 'uploads/payment_58_Dorothy_Garapan.png', '2023-07-14 00:55:03'),
(59, 'Bachelor in Technology And Livelihood Education Major in Home Economics', 'Informative Copy of Grades', 'Dorothy', 'Dauan', 'Garapan', '', '789.00', '56465465464654654323', 'uploads/payment_59_Dorothy_Garapan.png', '2023-07-14 00:55:38'),
(60, 'Bachelor of Science in Information Technology', 'Certified True Copy', 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '2000.54', '31313131313131313131', 'uploads/payment_60_John Mark_Garapan.png', '2023-07-14 00:56:47'),
(61, 'Bachelor of Science in Industrial Engineering', 'Certificate of Attendance', 'Dorothy', 'Dauan', 'Garapan', '', '500.00', '58745467646468764546', 'uploads/payment_61_Dorothy_Garapan.png', '2023-07-14 01:07:52');

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
