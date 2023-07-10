-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 03:32 AM
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
-- Table structure for table `administrative_feedbacks`
--

CREATE TABLE `administrative_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrative_feedbacks`
--

INSERT INTO `administrative_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`) VALUES
(8, 28, 'joshuamalabanan70@gmail.com', 'test lang po');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `extension_name` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `office_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `last_name`, `first_name`, `middle_name`, `extension_name`, `email`, `password`, `office_id`) VALUES
(1, 'Salmingo', 'Leny', NULL, NULL, 'test_administrative@admin.com', '$2y$10$KuniRiDPitLlx/V7fEVxy.sC2LIPEEdC58Ps9QqQwVjtl0vXJXjCy', 1),
(2, 'Salmingo', 'Leny', NULL, NULL, 'test_accounting@admin.com', '$2y$10$KuniRiDPitLlx/V7fEVxy.sC2LIPEEdC58Ps9QqQwVjtl0vXJXjCy', 2),
(3, 'Salmingo', 'Leny', NULL, NULL, 'test_registrar@admin.com', '$2y$10$KuniRiDPitLlx/V7fEVxy.sC2LIPEEdC58Ps9QqQwVjtl0vXJXjCy', 3),
(4, 'Salmingo', 'Leny', NULL, NULL, 'test_academic@admin.com', '$2y$10$KuniRiDPitLlx/V7fEVxy.sC2LIPEEdC58Ps9QqQwVjtl0vXJXjCy', 4),
(5, 'Salmingo', 'Leny', NULL, NULL, 'test_guidance@admin.com', '$2y$10$KuniRiDPitLlx/V7fEVxy.sC2LIPEEdC58Ps9QqQwVjtl0vXJXjCy', 5);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_facility`
--

CREATE TABLE `appointment_facility` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `start_date_time_sched` datetime DEFAULT NULL,
  `end_date_time_sched` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `purpose` varchar(200) DEFAULT NULL,
  `facility_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_facility`
--

INSERT INTO `appointment_facility` (`appointment_id`, `user_id`, `status_id`, `course`, `section`, `start_date_time_sched`, `end_date_time_sched`, `email`, `purpose`, `facility_id`) VALUES
(3, 39, 3, 'BSIT', '3-1', '2023-07-12 15:30:00', '2023-07-13 16:00:00', 'joshuamalabanan70@gmail.com', 'basta', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `counseling_schedules`
--

CREATE TABLE `counseling_schedules` (
  `counseling_id` varchar(50) NOT NULL DEFAULT concat('GC-',unix_timestamp()),
  `appointment_description` varchar(255) DEFAULT NULL,
  `doc_requests_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `counseling_schedules`
--

INSERT INTO `counseling_schedules` (`counseling_id`, `appointment_description`, `doc_requests_id`) VALUES
('GC-1688797180', 'Academic Performance', 'DR-1688797180'),
('GC-1688799694', 'Other', 'DR-1688799694');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` int(20) DEFAULT NULL,
  `course_description` varchar(100) DEFAULT NULL,
  `units` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cross_enrollments`
--

CREATE TABLE `cross_enrollments` (
  `student_id` int(15) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_requests`
--

CREATE TABLE `doc_requests` (
  `request_id` varchar(50) NOT NULL DEFAULT concat('DR-',unix_timestamp()),
  `request_description` varchar(255) DEFAULT NULL,
  `scheduled_datetime` datetime DEFAULT NULL,
  `office_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `attached_files` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doc_requests`
--

INSERT INTO `doc_requests` (`request_id`, `request_description`, `scheduled_datetime`, `office_id`, `user_id`, `status_id`, `amount_to_pay`, `attached_files`) VALUES
('DR-1688797156', 'Request Good Moral Document', NULL, 5, 39, 1, 0.00, ''),
('DR-1688797166', 'Request Clearance', NULL, 5, 39, 1, 0.00, ''),
('DR-1688797180', NULL, '2023-07-14 12:30:00', 5, 39, 1, 0.00, ''),
('DR-1688799647', 'Request Good Moral Document', NULL, 5, 41, 1, 0.00, ''),
('DR-1688799655', 'Request Clearance', NULL, 5, 41, 1, 0.00, ''),
('DR-1688799662', 'Request Good Moral Document', NULL, 5, 41, 1, 0.00, ''),
('DR-1688799671', 'Request Good Moral Document', NULL, 5, 41, 1, 0.00, ''),
('DR-1688799694', NULL, '2023-07-19 11:30:00', 5, 39, 1, 0.00, ''),
('DR-1688799724', 'Request Good Moral Document', NULL, 5, 39, 1, 0.00, ''),
('DR-1688799730', 'Request Clearance', NULL, 5, 39, 1, 0.00, ''),
('DR-1688799736', 'Request Clearance', NULL, 5, 39, 1, 0.00, '');

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
(5, 'BasketBall Ring and Net', 'Available', 20, 2, 1),
(6, 'Brush', 'Available', 19, 3, 1),
(7, 'Bucket', 'Available', 15, 3, 1),
(8, 'Chairs', 'Unavailable', 0, 1, 1),
(9, 'Cleaning Detergent', 'Available', 20, 3, 1),
(10, 'Curtains', 'Available', 1, 1, 1),
(11, 'Chess Board', 'Available', 20, 2, 1),
(12, 'Digital Scoreboard', 'Available', 20, 1, 1),
(13, 'Mop', 'Available', 10, 3, 1),
(14, 'Projectors', 'Available', 18, 1, 1),
(15, 'Scoreboard', 'Available', 2, 2, 1),
(16, 'Vacuum', 'Available', 20, 3, 1),
(17, 'Volleyball', 'Available', 6, 2, 1),
(18, 'Volleyball Net', 'Available', 3, 2, 1),
(19, 'Tables', 'Available', 10, 1, 1),
(20, 'TV', 'Available', 20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

CREATE TABLE `equipment_type` (
  `equipment_type_id` int(11) NOT NULL,
  `equipment_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_type`
--

INSERT INTO `equipment_type` (`equipment_type_id`, `equipment_type`) VALUES
(1, 'School'),
(2, 'Sports'),
(3, 'Cleaning');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facility_id` int(11) NOT NULL,
  `facility_name` varchar(50) NOT NULL,
  `availability` enum('Available','Unavailable') DEFAULT 'Available',
  `facility_number` varchar(50) DEFAULT NULL,
  `facility_type_id` int(11) DEFAULT 0,
  `request` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facility_id`, `facility_name`, `availability`, `facility_number`, `facility_type_id`, `request`) VALUES
(1, 'Campus Court', 'Unavailable', '101', 1, 1),
(2, 'Room 102', 'Available', '102', 1, 1),
(3, 'Room 103', 'Available', '103', 1, 1),
(4, 'Room 104', 'Available', '104', 1, 1),
(5, 'Room 105', 'Available', '105', 1, 1),
(6, 'Room 106', 'Available', '106', 1, 1),
(7, 'Room 107', 'Available', '107', 1, 1),
(8, 'Room 108', 'Available', '108', 1, 1),
(9, 'Room 109', 'Available', '109', 1, 1),
(10, 'Room 110', 'Available', '110', 1, 1),
(11, 'Computer Lab', 'Available', '201', 2, 1),
(12, 'Room 202', 'Available', '202', 2, 1),
(13, 'Room 203', 'Available', '203', 2, 1),
(14, 'Room 204', 'Available', '204', 2, 1),
(15, 'Room 205', 'Available', '205', 2, 1),
(16, 'Room 206', 'Available', '206', 2, 1),
(17, 'Room 207', 'Available', '207', 2, 1),
(18, 'Room 208', 'Available', '208', 2, 1),
(19, 'Room 209', 'Available', '209', 2, 1),
(20, 'Room 210', 'Available', '210', 2, 1),
(21, 'Room 301', 'Available', '301', 3, 1),
(22, 'Room 302', 'Available', '302', 3, 1),
(23, 'Room 303', 'Available', '303', 3, 1),
(24, 'Room 304', 'Available', '304', 3, 1),
(25, 'Room 305', 'Available', '305', 3, 1),
(26, 'Room 306', 'Available', '306', 3, 1),
(27, 'Audio Visual Room', 'Available', '307', 3, 1),
(28, 'Room 308', 'Available', '308', 3, 1),
(29, 'Room 309', 'Available', '309', 3, 1),
(30, 'Room 310', 'Available', '310', 3, 1),
(31, 'Room 401', 'Available', '401', 4, 1),
(32, 'Room 402', 'Available', '402', 4, 1),
(33, 'Room 403', 'Available', '403', 4, 1),
(34, 'Room 404', 'Available', '404', 4, 1),
(35, 'Room 405', 'Available', '405', 4, 1),
(36, 'Room 406', 'Available', '406', 4, 1),
(37, 'Room 407', 'Available', '407', 4, 1),
(38, 'Room 408', 'Available', '408', 4, 1),
(39, 'Room 409', 'Available', '409', 4, 1),
(40, 'Room 410', 'Available', '410', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `facility_type`
--

CREATE TABLE `facility_type` (
  `facility_type_id` int(11) NOT NULL,
  `facility_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_type`
--

INSERT INTO `facility_type` (`facility_type_id`, `facility_type`) VALUES
(1, 'First Floor'),
(2, 'Second Floor'),
(3, 'Third Floor'),
(4, 'Fourth Floor');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade` decimal(4,2) DEFAULT NULL,
  `semester` enum('First Semester','Second Semester','Summer') DEFAULT NULL,
  `acad_year` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guidance_feedbacks`
--

CREATE TABLE `guidance_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Registrar Office');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `office_name`) VALUES
(1, 'Administrative Office'),
(2, 'Accounting Office'),
(3, 'Registrar Office'),
(4, 'Academic Office'),
(5, 'Guidance Office');

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
-- Dumping data for table `offsettingtb`
--

INSERT INTO `offsettingtb` (`offsetting_id`, `user_id`, `amountToOffset`, `offsetType`, `timestamp`) VALUES
(0, 39, 100.00, 'tuitionFee', '2023-07-08 14:48:01');

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `personal_detail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `birth_date` date NOT NULL DEFAULT current_timestamp(),
  `sex` tinyint(1) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `zip_code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Application for Graduation SIS and Non-SIS', '<li>Accomplished and printed copy of the Application for Graduation thru SIS Account (2 copies)</li>\n<li>Accomplished copy of the Application for Graduation for Non-SIS (2 copies)</li>\n<li>Proof of payment</li>', '<li>IF NOT COVERED BY FREE TUITION ACT: </li>\n<ul>\n                                    <li>P600.00 - Grad. Fee</li>\n                                    <li>P350.00 - Non Eng’g</li>\n                                    <li>P450.00 - Eng’g.</li>\n                                    <li>P200.00 - Diploma</li>\n                                    <li>P150.00 - Cert. of Grad.</li>\n                                    <li>P90.00 – documentary stamp tax</li>\n                           '),
(2, 'Correction of Entry of Grade', '<li>Accomplished Completion Form 3 copies</li>                                 <li>Photocopy of Class Record of the Faculty</li>                                 <li>Notarized Affidavit for the Change of Grades signed by the Professor</li>                                 <li>Proof of payment</li>', '<li>P30.00</li>'),
(3, 'Completion of Incomplete Grade', '<li>Accomplished Completion Form 3 copies</li\r\n<li>Photocopy of Class Record of the Faculty</li>\r\n<li>Notarized Affidavit for the Change of Grades\r\nsigned by the Professor</li>\r\n<li>Proof of payment</li>\r\n', '<li>P30.00</li>'),
(4, 'Late Reporting of Grade', '<li>Accomplished Completion Form 3 copies</li\r\n<li>Photocopy of Class Record of the Faculty</li>\r\n<li>Notarized Affidavit for the Change of Grades\r\nsigned by the Professor</li>\r\n<li>Proof of payment</li>', '<li>P30.00</li>'),
(5, 'Processing of Request for Correction of Name in Conformity \r\nwith the Philippines Statistics Authority Certificate of Live Birth \r\nand/or Correction of Name in the School Records', '<li>Letter address to the Campus Registrar </li>\r\n<li>Original Copy of PSA Birth Certificate  </li>\r\n<li>Parent Affidavit / Affidavit of Discrepancy </li>\r\n<li>Joint Affidavit of Two Disinterested Person </li>\r\n<li>Corrected copy of F137A/TOR (if applicable) </li>\r\n<li>Original copy of Transcript of Records and \r\nDiploma (if previously issued)\r\n </li>\r\n<li>General Clearance showing the client is \r\ncleared of all accountabilities\r\n </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Pro', '<li>P150.00</li>'),
(6, 'Certification, Verification, Authentication \r\n(CAV/Apostile)', '<li>Student’s Request Letter </li>\r\n<li>General Clearance showing the client is cleared of all accountabilities </li>\r\n<li>Letter request addressed to CHED Regional Director (for CAV-CHED request only) </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Documentary stamp </li>\r\n<li>Proof of payment </li>\r\n<li>1 Long Brown Envelope </li>', '<li>P920.00 for \r\nDFA\r\n </li>\r\n<li>150.00 for \r\nSpecial Certification\r\n </li>\r\n<li>P620.00 for \r\nCHED\r\n </li>\r\n<li>P470.00 for \r\nPRC\r\n </li>'),
(7, 'Certificates \r\nof Attendance\r\n', '<li>Student’s Request Letter </li>\r\n<li>General Clearance showing the client is cleared of all accountabilities </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Official receipt for documentary stamp </li>\r\n<li>Proof of payment </li>\r\n<li>1 Long Brown Envelope </li>', '<li>P150.00 per \r\ncertificate\r\n</li>'),
(8, 'Certificate of Graduation', '<li>Student’s Request Letter </li>\r\n<li>General Clearance showing the client is cleared of all accountabilities </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Official receipt for documentary stamp </li>\r\n<li>Proof of payment </li>\r\n<li>1 Long Brown Envelope </li>', '<li>P150.00 per \r\ncertificate\r\n</li>'),
(9, 'Certificate of Medium of Instruction', '<li>Student’s Request Letter </li>\r\n<li>General Clearance showing the client is cleared of all accountabilities </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Official receipt for documentary stamp </li>\r\n<li>Proof of payment </li>\r\n<li>1 Long Brown Envelope </li>', '<li>P150.00 per \r\ncertificate\r\n</li>'),
(10, 'Certificate of General Weighted Average (GWA)\r\n', '<li>Student’s Request Letter </li>\r\n<li>General Clearance showing the client is cleared of all accountabilities </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Official receipt for documentary stamp </li>\r\n<li>Proof of payment </li>\r\n<li>1 Long Brown Envelope </li>', '<li>P150.00 per \r\ncertificate\r\n</li>'),
(11, 'Non Issuance of Special Order ', '<li>Student’s Request Letter </li>\r\n<li>General Clearance showing the client is cleared of all accountabilities </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Official receipt for documentary stamp </li>\r\n<li>Proof of payment </li>\r\n<li>1 Long Brown Envelope </li>', '<li>P150.00 per \r\ncertificate\r\n</li>'),
(12, 'Certified True Copy', '<li>Student’s Request Letter </li>\r\n<li>General Clearance showing the client is cleared of all accountabilities </li>\r\n<li>2 pcs. 2” x 2” picture in Formal Attire </li>\r\n<li>Official receipt for documentary stamp </li>\r\n<li>Proof of payment </li>\r\n<li>1 Long Brown Envelope </li>', '<li>P150.00 per \r\ncertificate\r\n</li>');

-- --------------------------------------------------------

--
-- Table structure for table `reg_requirements`
--

CREATE TABLE `reg_requirements` (
  `id` int(11) NOT NULL,
  `requirement` text NOT NULL,
  `payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_requirements`
--

INSERT INTO `reg_requirements` (`id`, `requirement`, `payment`) VALUES
(1, 'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\nLetter request addressed to CHED Regional Director (for CAV-CHED request only)\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope', '920.00 for DFA\n150.00 for Special Certification\nP620.00 for CHED\nP470.00 for PRC'),
(2, 'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nOfficial receipt for documentary stamp\nProof of payment\n1 Long Brown Envelope', 'P150.00 per certificate'),
(3, 'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope', 'P150.00 per course description'),
(4, 'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope', 'P150.00 per certificate'),
(5, 'Accomplished and printed copy of the application and payment voucher from the branch/campus registrar\nGeneral Clearance showing the client is cleared of all accountabilities\nCertificate of Candidacy\nCertificate of Conferment of Degree (Dummy Diploma)\n2 pcs. 2” x 2” picture in Academic Gown\nDocumentary stamp\nProof of payments (for applicants not covered by RA 10931 otherwise known as Universal Access to Quality Tertiary Education Act of 2017)', 'N/A'),
(6, 'Letter of request by the student\n2” x 2” picture in formal attire\nDocumentary Stamp\nProof of payment', 'P350.00 – Non Engineering\nP450.00 - Engineering\nP20.00 for White Long Envelope for TOR Copy for Another School'),
(7, 'Letter of request by the student\n2” x 2” picture in formal attire\nDocumentary Stamp\nProof of payment\nAcknowledged/Signed Copy of Transfer Credential/Honorable Dismissal', 'P400.00 - Non Engineering\nP500.00 – Engineering\nP20.00 for White Long Envelope for TOR Copy for Another School');

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
(22, 'Leave of Absence'),
(23, 'Certification, Verification, Authentication (CAV/Apostile)'),
(24, 'Certificates of Attendance'),
(25, 'Certificate of Graduation'),
(26, 'Certificate of Medium of Instruction'),
(27, 'Certificate of General Weighted Average (GWA)'),
(28, 'Non-Issuance of Special Order'),
(29, 'Certified True Copy'),
(30, 'Course/Subject Description'),
(31, 'Certificate of Transfer Credential/Honorable Dismissal'),
(32, 'Transcript of Records (First Copy)'),
(33, 'Transcript of Records (Second and succeeding copies)'),
(34, 'Transcript of Records (Copy for Another School)');

-- --------------------------------------------------------

--
-- Table structure for table `reg_status`
--

CREATE TABLE `reg_status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_status`
--

INSERT INTO `reg_status` (`status_id`, `status`) VALUES
(1, 'Pending'),
(2, 'For Receiving'),
(3, 'For Evaluation'),
(4, 'Ready for Pickup'),
(5, 'Released'),
(6, 'Pending');

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
(1, '', 39, 3, 28, '2023-06-28', 1),
(2, '', 41, 3, 25, '2023-07-12', 1),
(3, '', 41, 3, 23, '2023-07-05', 1),
(4, '', 41, 3, 29, '2023-07-05', 1);

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
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_equipment`
--

INSERT INTO `request_equipment` (`request_id`, `user_id`, `datetime_schedule`, `quantity_equip`, `status_id`, `email`, `purpose`, `equipment_id`) VALUES
(6, 39, '2023-07-19 11:30:00', 2, 3, 'joshuamalabanan70@gmail.com', 'basta', 10);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_description` text NOT NULL,
  `office_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `service_name`, `service_description`, `office_id`, `url`) VALUES
(1, 'Create Request', 'Seeks the registrar office\'s help in requesting related to academic records', 2, 'http://localhost/student/registrar/create_request.php'),
(2, 'Schedule Counseling', 'Schedule an appointment for counseling with the guidance counselor of the campus.', 5, 'http://localhost/student/guidance/counseling.php'),
(3, 'Request Good Moral Document', 'Request for a good moral document for requirement purposes.', 5, 'http://localhost/student/guidance/good_morals.php'),
(4, 'Request Clearance', 'Request and check the status of your academic clearance.', 5, 'http://localhost/student/guidance/clearance.php'),
(5, 'Subject Overload', 'Add additional subject/s more than the prescribed number of units.', 4, 'http://localhost/student/academic/subject_overload.php'),
(6, 'Grade Accreditation', 'For Correction of Grade Entry, Late Reporting of Grades, and Removal of Incomplete Mark.', 4, 'http://localhost/student/academic/grade_accreditation.php'),
(7, 'Cross-Enrollment', 'Enrollment of subject/s at another college or university.', 4, 'http://localhost/student/academic/cross_enrollment.php'),
(8, 'Shifting', 'Shift to another program offered in PUP Santa Rosa.', 4, 'http://localhost/student/academic/shifting.php'),
(9, 'Manual Enrollment', 'Failed to enroll during the online registration period set by the University.', 4, 'http://localhost/student/academic/manual_enrollment.php'),
(10, 'Services in SIS Tools', '(a) ACE Form - Add subjects or change your officially enrolled subjects, (b) Subject Petition/Tutorial - Request for subject not offered in current semester.', 4, 'http://localhost/student/academic/servicesinsistools.php'),
(11, 'Payments', 'Simplify your payments for campus documents', 2, 'http://localhost/student/accounting/payment1.php'),
(12, 'Offsetting', 'Balance your campus accounts.', 2, 'http://localhost/student/accounting/offsetting1.php'),
(13, 'Request of School Equipment', 'Request of equipment inside the campus.', 1, 'http://localhost/student/administrative/view-equipment.php'),
(14, 'School Facility Appointment', 'Request of Facilities for campus event purposes.', 1, 'http://localhost/student/administrative/view-facility.php');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'For Receiving'),
(3, 'For Evaluation'),
(4, 'Ready for Pickup'),
(5, 'Released'),
(6, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `course` varchar(50) NOT NULL,
  `documentType` varchar(50) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `studentNumber` varchar(15) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `referenceNumber` varchar(20) NOT NULL,
  `image_url` text NOT NULL,
  `date&time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `student_record_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `student_no` varchar(15) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `extension_name` varchar(11) DEFAULT NULL,
  `contact_no` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `birth_date` date NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_no`, `last_name`, `first_name`, `middle_name`, `extension_name`, `contact_no`, `email`, `birth_date`, `password`, `user_role`) VALUES
(31, '2020-00200-SR-0', 'Shandra', 'Miki', 'Brawl', 'Jr.', '09464032004', 'mmallow624@gmail.com', '2023-06-24', '$2y$10$orJgdEoFs1G066jHzilA4Or/WrvzNj8HDJVBk6pcJBtMhguQ6MlbG', 1),
(32, '2021-0220-SR-0', 'Shanks', 'Akagami', 'B', NULL, '09464032005', 'bussinbaldes@gmail.com', '2023-06-24', '$2y$10$TlnTlMSObrJ7NG4WtG3KJu/ZpcIZwieyJfcCnlt4Ap5LQROZG4Z5a', 1),
(34, '2020-02000-SR-0', 'Capybara', 'Miki', 'S.', 'Jr', '09645231215', 'mixelsynth@gmail.com', '2023-06-24', '$2y$10$gZQbuR7zYWdQp42zrji0eO/M0BST6N.463mNY5vaeYn3FAntH/SDm', 1),
(35, '2020-00189-SR-0', 'Lampiño', 'Tracia Jean', 'Deligencia', '', '0905-444-1943', 'traciajeanlampino@gmail.com', '2023-06-24', '$2y$10$KYONfSPJz/jnKfzrzsp66.apOjMMkg1spdDIfrykYj9iexKjV.vT2', 1),
(39, '2020-00201-SR-0', 'Malabanan', 'Joshua', 'Gonzales', '', '0908-775-6313', 'joshuamalabanan70@gmail.com', '2001-08-27', '$2y$10$WuFz92Ko1kz0TTve.Vig5.KjjP.vkZg6AZph18up9c8xyzlyvGA7C', 1),
(41, '', 'Dela Cruz', 'Pedro', 'Penduko', '', '0901-234-5678', 'pendropenduko@yahoo.com', '1990-01-01', '$2y$10$8VUfrpqEcVxjtaPTII0KqeV6mAty/ngEj.PKEwExrjmsaQ2LRN/xq', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_detail_id` int(11) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `zip_code` varchar(6) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_detail_id`, `sex`, `home_address`, `province`, `city`, `barangay`, `zip_code`, `user_id`) VALUES
(1, 1, 'Blk. 14, Lot 2, Phase 2, St. Agata Homes', 'LAGUNA', 'SANTA ROSA CITY', 'Dita', '4026', 39),
(2, 1, 'Biringan', 'TAWI-TAWI', 'SAPA-SAPA', '1', '1234', 40);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `role`) VALUES
(1, 'Student'),
(2, 'Alumni/Client'),
(3, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrative_feedbacks`
--
ALTER TABLE `administrative_feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_admins_offices1_idx` (`office_id`);

--
-- Indexes for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `facility` (`facility_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `fk_clients_users1_idx` (`users_id`);

--
-- Indexes for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  ADD PRIMARY KEY (`counseling_id`),
  ADD KEY `fk_schedules_doc_requests1_idx` (`doc_requests_id`);

--
-- Indexes for table `doc_requests`
--
ALTER TABLE `doc_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_doc_requests_offices1_idx` (`office_id`),
  ADD KEY `fk_doc_requests_users1_idx` (`user_id`),
  ADD KEY `fk_doc_requests_statuses1_idx` (`status_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `equipment_type_id` (`equipment_type_id`);

--
-- Indexes for table `equipment_type`
--
ALTER TABLE `equipment_type`
  ADD PRIMARY KEY (`equipment_type_id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facility_id`),
  ADD KEY `facility_type_id` (`facility_type_id`);

--
-- Indexes for table `facility_type`
--
ALTER TABLE `facility_type`
  ADD PRIMARY KEY (`facility_type_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`personal_detail_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reg_faq`
--
ALTER TABLE `reg_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `reg_requirements`
--
ALTER TABLE `reg_requirements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_services`
--
ALTER TABLE `reg_services`
  ADD PRIMARY KEY (`services_id`);

--
-- Indexes for table `reg_status`
--
ALTER TABLE `reg_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `reg_transaction`
--
ALTER TABLE `reg_transaction`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `request_equipment`
--
ALTER TABLE `request_equipment`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `request_equipment_ibfk_3` (`equipment_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`),
  ADD KEY `office_id` (`office_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`student_record_id`),
  ADD KEY `fk_student_record_students1_idx` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_users_user_roles1_idx` (`user_role`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_detail_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrative_feedbacks`
--
ALTER TABLE `administrative_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `equipment_type`
--
ALTER TABLE `equipment_type`
  MODIFY `equipment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `facility_type`
--
ALTER TABLE `facility_type`
  MODIFY `facility_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `personal_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reg_services`
--
ALTER TABLE `reg_services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reg_status`
--
ALTER TABLE `reg_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reg_transaction`
--
ALTER TABLE `reg_transaction`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request_equipment`
--
ALTER TABLE `request_equipment`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_admins_offices1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
