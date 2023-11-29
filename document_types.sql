-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 07:52 PM
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
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `doc_id` int(11) NOT NULL,
  `document` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`doc_id`, `document`) VALUES
(1, 'Application for Graduation SIS and Non-SIS'),
(2, 'Correction of Entry of Grade'),
(3, 'Completion of Incomplete Grade'),
(4, 'Late Reporting of Grade'),
(5, 'Processing of Request for Correction of Name: PSA/School Records'),
(6, 'Certification, Verification, Authentication (CAV/Apostile)'),
(7, 'Certificate of Attendance'),
(8, 'Certificate of Graduation'),
(9, 'Certificate of Medium of Instruction'),
(10, 'Certificate of General Weighted Average (GWA)'),
(11, 'Non Issuance of Special Order'),
(12, 'Course/Subject Description'),
(13, 'Certificate of Transfer Credential/Honorable Dismissal'),
(14, 'Transcript of Records (Second and succeeding copies)'),
(15, 'Transcript of Records (Copy for Another School)'),
(16, 'Course Accreditation Service (for Transferees)'),
(17, 'Informative Copy of Grades'),
(18, 'Certified True Copy'),
(19, 'Academic Verification Service');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`doc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
