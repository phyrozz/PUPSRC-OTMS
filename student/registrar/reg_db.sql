-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 07:43 PM
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
-- Database: `reg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `id` int(11) NOT NULL,
  `offices` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`id`, `offices`) VALUES
(1, 'Registration Office');

-- --------------------------------------------------------

--
-- Table structure for table `reg_faq`
--

CREATE TABLE `reg_faq` (
  `faq_id` int(11) NOT NULL,
  `document` varchar(500) NOT NULL,
  `requirements` varchar(500) NOT NULL,
  `payment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_faq`
--

INSERT INTO `reg_faq` (`faq_id`, `document`, `requirements`, `payment`) VALUES
(1, 'Application for Graduation SIS and Non-SIS', '<li>Accomplished and printed copy of the Application for Graduation thru SIS Account (2 copies)</li>\n<li>Accomplished copy of the Application for Graduation for Non-SIS (2 copies)</li>\n<li>Proof of payment</li>', '<li>IF NOT COVERED BY FREE TUITION ACT: </li>\r\n<ul>\r\n                                    <li>P600.00 - Grad. Fee</li>\r\n                                    <li>P350.00 - Non Eng’g</li>\r\n                                    <li>P450.00 - Eng’g.</li>\r\n                                    <li>P200.00 - Diploma</li>\r\n                                    <li>P150.00 - Cert. of Grad.</li>\r\n                                    <li>P90.00 – documentary stamp tax</li>\r\n                                    <li>'),
(2, 'Correction of Entry of Grade', '<li>Accomplished Completion Form 3 copies</li>                                 <li>Photocopy of Class Record of the Faculty</li>                                 <li>Notarized Affidavit for the Change of Grades signed by the Professor</li>                                 <li>Proof of payment</li>', '<li>P30.00</li>');

-- --------------------------------------------------------

--
-- Table structure for table `reg_services`
--

CREATE TABLE `reg_services` (
  `services_id` int(11) NOT NULL,
  `services` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_services`
--

INSERT INTO `reg_services` (`services_id`, `services`) VALUES
(1, 'Application for Graduation SIS and Non-SIS'),
(2, ' Correction of Entry of Grade'),
(3, 'Completion of Incomplete Grade'),
(4, 'Late Reporting of Grade'),
(5, 'Processing of Request for Correction of Name in Conformity \r\nwith the Philippines Statistics Authority Certificate of Live Birth \r\nand/or Correction of Name in the School Records\r\n'),
(6, 'Certification, Verification, Authentication (CAV/Apostile)'),
(7, 'Certificates \r\nof Attendance\r\n'),
(8, 'Certificate of Graduation'),
(9, 'Certificate of Medium of Instruction'),
(10, 'Certificate of General Weighted Average (GWA)'),
(11, 'Non-Issuance of Special Order '),
(12, 'Certified True Copy'),
(13, 'Course/Subject \r\nDescription)\r\n'),
(14, 'Certificate of Transfer Credential/Honorable Dismissal'),
(15, 'Transcript of \r\nRecords (First Copy)\r\n'),
(16, 'Transcript of Records (Second and succeeding copies)'),
(17, 'Transcript of Records (Copy for Another School)'),
(18, 'Course Accreditation Service-Senior High School to Bridge Course'),
(19, ' Course Accreditation Service (For Shiftees and \r\nRegular Students)\r\n'),
(20, 'Course Accreditation Service (for Transferees)'),
(21, 'Informative Copy of Grades'),
(22, 'Leave of Absence');

-- --------------------------------------------------------

--
-- Table structure for table `reg_status`
--

CREATE TABLE `reg_status` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_status`
--

INSERT INTO `reg_status` (`id`, `status`) VALUES
(1, 'Pending'),
(2, 'For Receiving'),
(3, 'For Evaluation'),
(4, 'Ready for Pickup'),
(5, 'Released');

-- --------------------------------------------------------

--
-- Table structure for table `reg_transaction`
--

CREATE TABLE `reg_transaction` (
  `reg_id` int(11) NOT NULL,
  `request_code` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `schedule` date NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_transaction`
--

INSERT INTO `reg_transaction` (`reg_id`, `request_code`, `user_id`, `office_id`, `services_id`, `schedule`, `status_id`) VALUES
(13, 'REG-1', 1, 1, 1, '2001-01-01', 3),
(14, 'REG-2', 1, 1, 2, '2002-02-02', 2),
(27, 'REG-3', 1, 1, 9, '2023-05-05', 4),
(34, 'REG-4', 1, 1, 3, '2023-05-05', 5),
(47, 'REG-5', 1, 1, 1, '2023-06-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `student_no` varchar(45) NOT NULL,
  `is_complete` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `users_id`, `student_no`, `is_complete`) VALUES
(1, 1, '2020-01234-SR-0', 0),
(2, 2, '2020-00329-SR-0', 0),
(3, 3, '2020-00189-SR-0', 0),
(4, 4, '2020-00984-SR-0', 0),
(5, 5, '2020-00104-SR-0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `extension_name` varchar(255) DEFAULT NULL,
  `contact_no` varchar(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `middle_name`, `extension_name`, `contact_no`, `email`, `password`, `user_role`) VALUES
(1, 'Cruz', 'Juan', 'Dela', NULL, '09012345678', 'jdelacruz@gmail.com', NULL, 1),
(2, 'Rosario', 'Anna', 'Lampara', NULL, '09056328999', 'anna122L@yahoo.com', NULL, 1),
(3, 'Malabanan', 'Isaac', 'Dane', 'Jr.', '09054429918', 'malabanan2222@gmail.com', NULL, 1),
(4, 'Austria', 'Skyler Jorden', 'Calapatia', NULL, '09025571297', 'skylerwhitey0@yahoo.com', NULL, 1),
(5, 'Belloso', 'Collin', 'Magat', NULL, '09010110590', 'bestnn_2021@gmail.com', NULL, 1),
(6, 'Reyes', 'Nataniel Urbano', 'Ynaya', NULL, '09087310002', 'urban_011@yahoo.com', NULL, 2),
(7, 'Lorenzo', 'Vincente Dylan', 'Dioquino', NULL, '09051128492', 'vincente_999@yahoo.com', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_faq`
--
ALTER TABLE `reg_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `reg_status`
--
ALTER TABLE `reg_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_transaction`
--
ALTER TABLE `reg_transaction`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reg_faq`
--
ALTER TABLE `reg_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reg_status`
--
ALTER TABLE `reg_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reg_transaction`
--
ALTER TABLE `reg_transaction`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
