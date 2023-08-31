-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 06:45 PM
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
-- Table structure for table `academic_statuses`
--

CREATE TABLE `academic_statuses` (
  `academic_statu_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_statuses`
--

INSERT INTO `academic_statuses` (`academic_statu_id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'Missing'),
(3, 'Under Verification'),
(4, 'Verified'),
(5, 'None');
(6, 'To Be Evaluated');
(7, 'Need F to F Evaluation');

-- --------------------------------------------------------

--
-- Table structure for table `acad_cross_enrollment`
--

CREATE TABLE `acad_cross_enrollment` (
  `so_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL DEFAULT concat('AO-CE-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `application_letter` varchar(255) DEFAULT NULL,
  `application_letter_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_cross_enrollment`
--

INSERT INTO `acad_cross_enrollment` (`so_id`, `transaction_id`, `user_id`, `application_letter`, `application_letter_status`) VALUES
(1, 'AO-CE-1689855418', 31, NULL, 1),
(2, 'AO-CE-1689855418', 32, NULL, 1),
(3, 'AO-CE-1689855418', 34, NULL, 1),
(4, 'AO-CE-1689855418', 35, NULL, 1),
(5, 'AO-CE-1689855418', 39, NULL, 1),
(6, 'AO-CE-1689855418', 43, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acad_grade_accreditation`
--

CREATE TABLE `acad_grade_accreditation` (
  `ga_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT concat('AO-GA-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `completion_form` varchar(255) DEFAULT NULL,
  `assessed_fee` varchar(255) DEFAULT NULL,
  `completion_form_status` int(11) NOT NULL DEFAULT 1,
  `assessed_fee_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_grade_accreditation`
--

INSERT INTO `acad_grade_accreditation` (`ga_id`, `transaction_id`, `user_id`, `completion_form`, `assessed_fee`, `completion_form_status`, `assessed_fee_status`) VALUES
(1, 'AO-GA-1689855627', 31, NULL, NULL, 1, 1),
(2, 'AO-GA-1689855627', 32, NULL, NULL, 1, 1),
(3, 'AO-GA-1689855627', 34, NULL, NULL, 1, 1),
(4, 'AO-GA-1689855627', 35, NULL, NULL, 1, 1),
(5, 'AO-GA-1689855627', 39, NULL, NULL, 1, 1),
(6, 'AO-GA-1689855627', 43, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acad_manual_enrollment`
--

CREATE TABLE `acad_manual_enrollment` (
  `me_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT concat('AO-ME-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `r_zero_form` varchar(1024) DEFAULT NULL,
  `r_zero_form_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_manual_enrollment`
--

INSERT INTO `acad_manual_enrollment` (`me_id`, `transaction_id`, `user_id`, `r_zero_form`, `r_zero_form_status`) VALUES
(1, 'AO-ME-1689855662', 31, NULL, 1),
(2, 'AO-ME-1689855662', 32, NULL, 1),
(3, 'AO-ME-1689855662', 34, NULL, 1),
(4, 'AO-ME-1689855662', 35, NULL, 1),
(5, 'AO-ME-1689855662', 39, NULL, 1),
(6, 'AO-ME-1689855662', 43, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acad_shifting`
--

CREATE TABLE `acad_shifting` (
  `s_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT concat('AO-S-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `request_letter` varchar(1024) DEFAULT NULL,
  `first_ctc` varchar(1024) DEFAULT NULL,
  `second_ctc` varchar(1024) DEFAULT NULL,
  `request_letter_status` int(11) NOT NULL DEFAULT 1,
  `first_ctc_status` int(11) NOT NULL DEFAULT 1,
  `second_ctc_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_shifting`
--

INSERT INTO `acad_shifting` (`s_id`, `transaction_id`, `user_id`, `request_letter`, `first_ctc`, `second_ctc`, `request_letter_status`, `first_ctc_status`, `second_ctc_status`) VALUES
(1, 'AO-S-1689855716', 31, NULL, NULL, NULL, 1, 1, 1),
(2, 'AO-S-1689855716', 32, NULL, NULL, NULL, 1, 1, 1),
(3, 'AO-S-1689855716', 34, NULL, NULL, NULL, 1, 1, 1),
(4, 'AO-S-1689855716', 35, NULL, NULL, NULL, 1, 1, 1),
(5, 'AO-S-1689855716', 39, NULL, NULL, NULL, 1, 1, 1),
(6, 'AO-S-1689855716', 43, NULL, NULL, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acad_status`
--

CREATE TABLE `acad_status` (
  `academic_status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_status`
--

INSERT INTO `acad_status` (`academic_status_id`, `status_name`) VALUES
(1, 'Missing'),
(2, 'Pending'),
(3, 'Under Verification'),
(4, 'Verified'),
(5, 'Rejected');
(6, 'To Be Evaluated');
(7, 'Need F to F Evaluation');

-- --------------------------------------------------------

--
-- Table structure for table `acad_subject_overload`
--

CREATE TABLE `acad_subject_overload` (
  `so_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT concat('AO-SO-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `overload_letter` varchar(255) DEFAULT NULL,
  `ace_form` varchar(255) DEFAULT NULL,
  `cert_of_registration` varchar(255) DEFAULT NULL,
  `overload_letter_status` int(11) NOT NULL DEFAULT 1,
  `ace_form_status` int(11) NOT NULL DEFAULT 1,
  `cert_of_registration_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_subject_overload`
--

INSERT INTO `acad_subject_overload` (`so_id`, `transaction_id`, `user_id`, `overload_letter`, `ace_form`, `cert_of_registration`, `overload_letter_status`, `ace_form_status`, `cert_of_registration_status`) VALUES
(1, 'AO-SO-1689855754', 31, NULL, NULL, NULL, 1, 1, 1),
(2, 'AO-SO-1689855754', 32, NULL, NULL, NULL, 1, 1, 1),
(3, 'AO-SO-1689855754', 34, NULL, NULL, NULL, 1, 1, 1),
(4, 'AO-SO-1689855754', 35, NULL, NULL, NULL, 1, 1, 1),
(5, 'AO-SO-1689855754', 39, NULL, NULL, NULL, 1, 1, 1),
(6, 'AO-SO-1689855754', 43, 'AO_SO_2020-00001-SR-0_Dela Cruz_Juan_localhost_student_guidance_help.php.png', 'AO_SO_2020-00001-SR-0_Dela Cruz_Juan_ACEFORM.pdf', 'AO_SO_2020-00001-SR-0_Dela Cruz_Juan_localhost_admin_guidance.php_docreq.png', 5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `accounting_feedbacks`
--

CREATE TABLE `accounting_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_on` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_feedbacks`
--

INSERT INTO `accounting_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`, `submitted_on`) VALUES
(1, 39, 'sample@gmail.com', 'try lang hehe', '2023-07-22 06:39:09'),
(2, 42, 'sample@gmail.com', 'hehehe ', '2023-07-22 06:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `administrative_feedbacks`
--

CREATE TABLE `administrative_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_on` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrative_feedbacks`
--

INSERT INTO `administrative_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`, `submitted_on`) VALUES
(8, 28, 'joshuamalabanan70@gmail.com', 'test lang po', '2023-07-22 06:02:40'),
(9, 43, 'juandelacruz123@gmail.com', 'hello', '2023-07-22 06:02:40');

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
  `appointment_id` varchar(50) NOT NULL DEFAULT concat('FA-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `course` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `start_date_time_sched` datetime DEFAULT NULL,
  `end_date_time_sched` datetime DEFAULT NULL,
  `purpose` varchar(200) DEFAULT NULL,
  `facility_id` int(11) NOT NULL,
  `client` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_facility`
--

INSERT INTO `appointment_facility` (`appointment_id`, `user_id`, `status_id`, `course`, `section`, `start_date_time_sched`, `end_date_time_sched`, `purpose`, `facility_id`, `client`) VALUES
('FA-1689393976', 42, 1, NULL, NULL, '2023-07-19 10:00:00', '2023-07-25 11:30:00', 'basta', 2, 'Visitor'),
('FA-1689910844', 43, 1, 'BSIT', '3-1', '2023-07-22 10:00:00', '2023-07-22 10:30:00', 'basta', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counseling_schedules`
--

CREATE TABLE `counseling_schedules` (
  `counseling_id` varchar(50) NOT NULL DEFAULT concat('GC-',unix_timestamp()),
  `appointment_description` varchar(255) NOT NULL,
  `comments` varchar(2048) DEFAULT NULL,
  `doc_requests_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `counseling_schedules`
--

INSERT INTO `counseling_schedules` (`counseling_id`, `appointment_description`, `comments`, `doc_requests_id`) VALUES
('GC-1689385362', 'Academic Performance', '', 'DR-1689385362'),
('GC-1689385407', 'Other', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vehicula faucibus accumsan. Vestibulum aliquet, nisl a dapibus sagittis, lectus diam condimentum nulla, at rutrum elit elit quis nibh. Maecenas dictum lectus sit amet fermentum molestie. Vestibulum ac enim ex. Nam pellentesque convallis odio, tempus ultricies nulla sodales a. In luctus porta turpis vitae congue. Quisque sollicitudin pulvinar tortor, eu viverra dolor tincidunt nec. Donec accumsan eros ex, ut imperdiet metus egestas at.', 'DR-1689385407'),
('GC-1689385434', 'Report Issue', '', 'DR-1689385434'),
('GC-1689399812', 'Other', 'test testing', 'DR-1689399812'),
('GC-1689949745', 'Goal Setting', '', 'DR-1689949745'),
('GC-1689949814', 'Academic Guidance', '', 'DR-1689949814'),
('GC-1689949956', 'Academic Guidance', '', 'DR-1689949956'),
('GC-1689950398', 'Academic Performance', '', 'DR-1689950398'),
('GC-1689950749', 'Academic Performance', '', 'DR-1689950749'),
('GC-1689950866', 'Academic Performance', '', 'DR-1689950866'),
('GC-1689951020', 'Other', 'testing', 'DR-1689951020'),
('GC-1689958408', 'Academic Performance', '', 'DR-1689958408'),
('GC-1689960499', 'Career Path Guidance', '', 'DR-1689960499'),
('GC-1689962199', 'Career Path Guidance', '', 'DR-1689962199'),
('GC-1689979780', 'Academic Guidance', '', 'DR-1689979780'),
('GC-1691162141', 'Academic Guidance', '', 'DR-1691162141');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course`) VALUES
(1, 'Bachelor of Science in Electronics Engineering'),
(2, 'Bachelor of Science in Business Administration Major in Human Resource Management'),
(3, 'Bachelor of Science in Business Administration Major in Marketing Management'),
(4, 'Bachelor in Secondary Education Major in English'),
(5, 'Bachelor in Secondary Education Major in Filipino'),
(6, 'Bachelor in Secondary Education Major in Mathematics'),
(7, 'Bachelor of Science in Industrial Engineering'),
(8, 'Bachelor of Science in Information Technology'),
(9, 'Bachelor of Science in Psychology'),
(10, 'Bachelor in Technology And Livelihood Education Major in Home Economics'),
(11, 'Bachelor of Science in Management Accounting'),
(12, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `doc_requests`
--

CREATE TABLE `doc_requests` (
  `request_id` varchar(50) NOT NULL DEFAULT concat('DR-',unix_timestamp()),
  `request_description` varchar(255) NOT NULL,
  `scheduled_datetime` timestamp NULL DEFAULT current_timestamp(),
  `office_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `attached_files` varchar(255) DEFAULT NULL,
  `request_letter` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doc_requests`
--

INSERT INTO `doc_requests` (`request_id`, `request_description`, `scheduled_datetime`, `office_id`, `user_id`, `status_id`, `purpose`, `amount_to_pay`, `attached_files`, `request_letter`) VALUES
('DR-1689385362', 'Guidance Counseling', '2023-07-15 06:30:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689385407', 'Guidance Counseling', '2023-07-20 04:00:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689385434', 'Guidance Counseling', '2023-07-18 01:30:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689399812', 'Guidance Counseling', '2023-07-19 02:00:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689401168', 'Request Good Moral Document', '2023-07-17 16:00:00', 5, 42, 1, NULL, 0.00, NULL, NULL),
('DR-1689401368', 'Request Clearance', '2023-07-19 16:00:00', 5, 42, 1, NULL, 0.00, NULL, NULL),
('DR-1689759920', 'Certification, Verification, Authentication (CAV/Apostile)', '2023-07-19 16:00:00', 3, 42, 1, NULL, 0.00, NULL, NULL),
('DR-1689917195', 'Request Good Moral Document', '2023-07-23 16:00:00', 5, 42, 1, 'Job Application', 0.00, NULL, NULL),
('DR-1689917264', 'Request Clearance', '2023-07-25 16:00:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689949745', 'Guidance Counseling', '2023-07-22 03:00:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689949814', 'Guidance Counseling', '2023-07-26 05:30:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689949956', 'Guidance Counseling', '2023-07-21 00:30:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689950043', 'Request Good Moral Document', '2023-07-20 16:00:00', 5, 39, 1, 'School Requirement', 0.00, '../../assets/uploads/supporting_docs/64ba975b50f42-localhost_student_transactions.php.png', NULL),
('DR-1689950398', 'Guidance Counseling', '2023-07-22 00:00:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689950749', 'Guidance Counseling', '2023-07-21 07:00:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689950866', 'Guidance Counseling', '2023-07-21 06:30:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689951020', 'Guidance Counseling', '2023-07-22 00:00:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689957148', 'Request Clearance', '2023-07-23 16:00:00', 5, 43, 1, NULL, 0.00, '../../assets/uploads/supporting_docs/64bab31c39a04-localhost_student_transactions.php.png', NULL),
('DR-1689957221', 'Request Clearance', '2023-07-25 16:00:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689957840', 'Request Good Moral Document', '2023-07-25 16:00:00', 5, 43, 1, 'Job Application', 0.00, '../../assets/uploads/supporting_docs/64bab5d08da2e-localhost_student_transactions.php.png', NULL),
('DR-1689957911', 'Request Good Moral Document', '2023-07-23 16:00:00', 5, 39, 1, 'Immigration or Visa Applications', 0.00, NULL, NULL),
('DR-1689957953', 'Request Clearance', '2023-07-21 16:00:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689958408', 'Guidance Counseling', '2023-07-22 00:00:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689959682', 'Request Clearance', '2023-07-26 16:00:00', 5, 42, 1, NULL, 0.00, NULL, NULL),
('DR-1689959699', 'Request Good Moral Document', '2023-07-30 16:00:00', 5, 42, 1, NULL, 0.00, NULL, NULL),
('DR-1689959836', 'Certified True Copy', '2023-07-24 16:00:00', 3, 42, 1, NULL, 0.00, NULL, NULL),
('DR-1689960499', 'Guidance Counseling', '2023-07-25 08:30:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689961122', 'Course/Subject \r\nDescription)\r\n', '2023-07-23 16:00:00', 3, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689961131', 'Course/Subject \r\nDescription)\r\n', '2023-07-23 16:00:00', 3, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689961165', 'Processing of Request for Correction of Name in Conformity with the PSA Certificate', '2023-07-21 16:00:00', 3, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689961192', 'Leave of Absence', '2023-07-21 16:00:00', 3, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1689961234', 'Request Good Moral Document', '2023-07-21 16:00:00', 5, 43, 1, 'Adoption', 0.00, '../../assets/uploads/supporting_docs/64bac3121ecb7-localhost_student_transactions.php.png', NULL),
('DR-1689961832', 'Request Good Moral Document', '2023-07-23 16:00:00', 5, 42, 1, 'Government Services', 0.00, '../../assets/uploads/supporting_docs/64bac56803bf0-localhost_student_transactions.php.png', NULL),
('DR-1689962199', 'Guidance Counseling', '2023-07-22 08:00:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1689979780', 'Guidance Counseling', '2023-07-27 07:00:00', 5, 39, 1, NULL, 0.00, NULL, NULL),
('DR-1691162100', 'Request Clearance', '2023-08-03 16:00:00', 5, 43, 1, NULL, 0.00, NULL, NULL),
('DR-1691162141', 'Guidance Counseling', '2023-08-05 05:00:00', 5, 43, 1, NULL, 0.00, NULL, NULL);

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
(2, 'Room 102', 'Unavailable', '102', 1, 1),
(3, 'Room 103', 'Unavailable', '103', 1, 1),
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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`user_id`, `file_name`, `file_path`, `file_size`, `type`) VALUES
(1, 'SO_ACEFORM_2020-00238-SR-0_Nuque,Erwin.pdf', 'D:/chris/Documents/xampp/htdocs//assets/uploads/generated_pdf/SO_ACEFORM_2020-00238-SR-0_Nuque,Erwin.pdf', 126617, 'Generated PDF'),
(2, '2020-00238-SR-0_Nuque,Erwin_Screenshot (12).png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/2020-00238-SR-0_Nuque,Erwin_Screenshot (12).png', 2713, 'User Upload'),
(3, '2020-00238-SR-0_Nuque_Erwin_Screenshot (12).png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/2020-00238-SR-0_Nuque_Erwin_Screenshot (12).png', 2713, 'User Upload'),
(4, 'SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 013248.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 013248.png', 69, 'User Upload'),
(5, 'SO_ACEFORM___.pdf', 'C:/xampp/htdocs//assets/uploads/generated_pdf/SO_ACEFORM___.pdf', 126355, 'Generated PDF'),
(6, 'SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-18 022249.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-18 022249.png', 34, 'User Upload'),
(7, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(8, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(9, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(10, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(11, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(12, 'SO_Erwin_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO_Erwin_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(13, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(14, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(15, 'SO_ACEFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 'D:/chris/Documents/xampp/htdocs//assets/uploads/generated_pdf/SO_ACEFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 126621, 'Generated PDF'),
(16, 'GA_CFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 'D:/chris/Documents/xampp/htdocs//assets/uploads/generated_pdf/GA_CFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 124418, 'Generated PDF'),
(17, 'SO__2020-00201-SR-0_Malabanan_Joshua_doc_requests-attached_files.jpg', 'C:/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00201-SR-0_Malabanan_Joshua_doc_requests-attached_files.jpg', 90, 'User Upload'),
(18, 'SO_ACEFORM_2020-00201-SR-0_Malabanan_Joshua.pdf', 'C:/xampp/htdocs//assets/uploads/generated_pdf/SO_ACEFORM_2020-00201-SR-0_Malabanan_Joshua.pdf', 126661, 'Generated PDF');

-- --------------------------------------------------------

--
-- Table structure for table `guidance_feedbacks`
--

CREATE TABLE `guidance_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guidance_feedbacks`
--

INSERT INTO `guidance_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`, `submitted_on`) VALUES
(1, 42, 'pendropenduko@yahoo.com', 'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. \"What\'s happened to me?\" he thought. It wasn\'t a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops', '2023-06-21 04:22:21'),
(2, 43, 'juandelacruz123@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In laoreet urna et risus consectetur ornare. Nunc dictum tincidunt ornare. Curabitur tempus pretium est ut semper. Vivamus tincidunt, metus ut tincidunt rhoncus, eros dolor tempus mauris, et maximus sem odio non odio. Vivamus quis justo vulputate, venenatis nisi vitae, commodo felis. Curabitur tincidunt sed velit et rhoncus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet elit ut ante dapibus tincidunt. Nullam tempus lectus nisi, porttitor egestas sapien lobortis ac.', '2023-07-04 02:39:24'),
(5, 39, 'joshuamalabanan70@gmail.com', 'test feedback comment', '2023-07-16 09:02:00'),
(6, 42, 'pendropenduko@yahoo.com', 'this is a feedback comment for PUPSRC-OTMS\' Guidance Office.', '2023-07-16 09:12:45'),
(7, 43, 'juandelacruz123@gmail.com', 'Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande lingues coalesce, li grammatica del resultant lingue es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic quam Occidental in fact, it va esser Occidental. A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que Occidental es.Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.', '2023-07-16 09:24:44'),
(8, 43, 'juandelacruz123@gmail.com', 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now. When, while the lovely valley teems with', '2023-07-16 09:24:56');

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
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offsettingtb`
--

INSERT INTO `offsettingtb` (`offsetting_id`, `user_id`, `amountToOffset`, `offsetType`, `timestamp`, `status_id`) VALUES
(3, 43, 250.00, 'Tuition Fee', '2023-07-15 03:44:38', 1),
(4, 43, 100.00, 'Miscellaneous Fee', '2023-07-15 03:45:09', 1),
(5, 43, 100.50, 'miscellaneous', '2023-07-15 05:33:13', 1),
(6, 39, 100.00, 'Miscellaneous Fee', '2023-07-18 14:30:44', 1),
(7, 39, 250.00, 'Tuition Fee', '2023-07-18 14:30:53', 1),
(8, 43, 129.00, 'Tuition Fee', '2023-07-21 17:47:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`token_id`, `user_id`, `token`, `expiry`) VALUES
(1, 39, NULL, NULL);

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
-- Table structure for table `registrar_feedbacks`
--

CREATE TABLE `registrar_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `feedback_text` text NOT NULL,
  `createdAt` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrar_feedbacks`
--

INSERT INTO `registrar_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`, `createdAt`) VALUES
(1, 43, NULL, 'testing :)', '2023-07-22 07:03:24'),
(2, 42, NULL, 'testing for client', '2023-07-22 07:03:50');

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
(34, 'Transcript of Records (Copy for Another School)'),
(35, 'Academic Verification Service');

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
(5, 'REG-2', 39, 3, 12, '2023-07-13', 5),
(6, '', 42, 3, 29, '2023-07-13', 1),
(7, '', 42, 3, 31, '2023-07-13', 6),
(8, '', 42, 3, 27, '2023-07-14', 2),
(9, '', 42, 3, 30, '2023-07-12', 3),
(10, '', 42, 3, 25, '2023-07-17', 3),
(12, '', 42, 3, 27, '2023-07-18', 3),
(13, '', 42, 3, 33, '2023-07-24', 1),
(14, '', 42, 3, 24, '2023-07-24', 1),
(15, '', 42, 3, 34, '2023-07-15', 1),
(16, '', 42, 3, 24, '2023-07-18', 1),
(17, '', 42, 3, 28, '2023-07-15', 1),
(18, '', 42, 3, 28, '2023-07-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_equipment`
--

CREATE TABLE `request_equipment` (
  `request_id` varchar(50) NOT NULL DEFAULT concat('ROE-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `datetime_schedule` datetime DEFAULT NULL,
  `quantity_equip` int(30) NOT NULL,
  `status_id` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `slip_content` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 'Rejected'),
(7, 'Approved');
(8, 'To Be Evaluated');
(9, 'Need F to F Evaluation');

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
  `status` varchar(32) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`payment_id`, `course`, `documentType`, `user_id`, `firstName`, `middleName`, `lastName`, `studentNumber`, `amount`, `referenceNumber`, `image_url`, `transaction_date`, `status`) VALUES
(24, 'Bachelor of Science in Information Technology', 'Certified True Copy', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', 250.00, '23123565674564564458', 'uploads/payment_24_Juan_Dela Cruz.jpg', '2023-07-12 23:31:16', 'Pending'),
(25, 'Bachelor of Science in Information Technology', 'Certified True Copy', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', 150.00, '21327694959680580962', 'uploads/payment_25_Joshua_Malabanan.jpg', '2023-07-13 11:09:19', 'Pending'),
(26, 'Bachelor of Science in Information Technology', 'Late Reporting of Grade', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', 50.00, '21342547095384634024', 'uploads/payment_26_Joshua_Malabanan.jpg', '2023-07-13 11:14:29', 'Pending'),
(27, 'Bachelor of Science in Information Technology', 'Late Reporting of Grade', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', 125.00, '43568906234523534645', 'uploads/payment_27_Joshua_Malabanan.jpg', '2023-07-13 11:14:58', 'Pending'),
(28, 'Bachelor of Science in Information Technology', 'Academic Verification Service', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', 50.00, '34445767463454525342', 'uploads/payment_28_Juan_Dela Cruz.jpg', '2023-07-13 11:34:20', 'Pending'),
(29, 'Bachelor of Science in Information Technology', 'Application for Graduation SIS and Non-SIS', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', 100.00, '45365732452342353453', 'uploads/payment_29_Juan_Dela Cruz.jpeg', '2023-07-13 11:34:38', 'Pending'),
(30, 'Bachelor of Science in Information Technology', 'Certificate of Attendance', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', 125.00, '43654674767456363636', 'uploads/payment_30_Juan_Dela Cruz.jpg', '2023-07-13 11:35:02', 'Pending'),
(31, 'Bachelor in Secondary Education Major in English', 'Academic Verification Service', 42, 'Pedro', NULL, 'Dela Cruz', NULL, 100.00, '23256576763453453453', 'uploads/payment_31_Pedro_Dela Cruz.png', '2023-07-19 17:54:51', 'Pending'),
(35, 'Bachelor in Secondary Education Major in Filipino', 'Certificate of General Weighted Average (GWA)', 42, 'Pedro', '', 'Dela Cruz', NULL, 100.00, '23425345234323453453', 'uploads/payment_35_Pedro_Dela Cruz.png', '2023-07-19 18:10:46', 'Pending'),
(36, 'Bachelor of Science in Information Technology', 'Completion of Incomplete Grade', 42, 'Pedro', '', 'Dela Cruz', NULL, 200.00, '45235587863634625124', 'uploads/payment_36_Pedro_Dela Cruz.png', '2023-07-19 18:14:46', 'Pending'),
(37, 'Bachelor of Science in Information Technology', 'Completion of Incomplete Grade', 42, 'Pedro', '', 'Dela Cruz', NULL, 200.00, '45235587863634625124', 'uploads/payment_37_Pedro_Dela Cruz.png', '2023-07-19 18:16:07', 'Pending'),
(38, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Transcript of Records (Copy for Another School)', 42, 'Pedro', '', 'Dela Cruz', NULL, 100.00, '43545433412643562342', 'uploads/payment_38_Pedro_Dela Cruz.png', '2023-07-19 18:17:04', 'Pending'),
(39, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', 122.00, '32143432432565436234', 'uploads/payment_39_Joshua_Malabanan.png', '2023-07-19 18:18:25', 'Pending'),
(40, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', 122.00, '32143432432565436234', 'uploads/payment_40_Joshua_Malabanan.png', '2023-07-19 18:20:33', 'Pending'),
(41, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 39, 'Joshua', 'Gonzales', 'Malabanan', '2020-00201-SR-0', 122.00, '32143432432565436234', 'uploads/payment_41_Joshua_Malabanan.png', '2023-07-19 18:20:33', 'Pending'),
(42, 'Bachelor of Science in Information Technology', 'Certificate of Graduation', 42, 'Pedro', '', 'Dela Cruz', NULL, 100.00, '32158855324214754762', 'uploads/payment_42_Pedro_Dela Cruz.png', '2023-07-19 18:21:12', 'Processed'),
(44, 'Bachelor of Science in Information Technology', 'Non Issuance of Special Order', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', 100.00, '45324423432654351245', 'uploads/payment_44_Juan_Dela Cruz.png', '2023-07-19 18:24:29', 'Processed'),
(45, 'Bachelor of Science in Management Accounting', 'Certificate of Attendance', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', 100.00, '43546524236547634534', 'uploads/payment_45_Juan_Dela Cruz.png', '2023-07-19 18:28:06', 'Processed'),
(46, 'Bachelor of Science in Information Technology', 'Certificate of Attendance', 43, 'Juan', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', 299.00, '32423525321433255435', 'uploads/payment_46_Juan_Dela Cruz.png', '2023-07-22 01:49:10', 'Processed');

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
(39, '2020-00201-SR-0', 'Malabanan', 'Joshua', 'Gonzales', '', '0908-775-6313', 'joshuamalabanan70@gmail.com', '2001-08-27', '$2y$10$a4rycTCNbnsZ6.auPYz.kuodEWiw7lq82K/3QBP.V5IYZu3ukC5Ta', 1),
(42, '', 'Dela Cruz', 'Pedro', '', '', '0900-000-0000', 'pendropenduko@yahoo.com', '1998-01-22', '$2y$10$u02jd1J3b3a/Pi.O4qI15u2PYQXsr9BcZ7PtXGdpAlLIbMcg6unUa', 2),
(43, '2020-00001-SR-0', 'Dela Cruz', 'Juan', 'Penduko', 'Jr.', '0900-000-0010', 'juandelacruz123@gmail.com', '1995-01-12', '$2y$10$LUeRAoE.8RoAVEfnrMpcaerRKhyzU6oM0fBc5kROxJ6cYfoLMH5Hu', 1);

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
  `course_id` int(11) NOT NULL DEFAULT 12,
  `year_and_section` varchar(3) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_detail_id`, `sex`, `home_address`, `province`, `city`, `barangay`, `zip_code`, `course_id`, `year_and_section`, `user_id`) VALUES
(1, 1, 'Blk. 14, Lot 2, Phase 2, St. Agata Homes', 'LAGUNA', 'SANTA ROSA CITY', 'Dita', '4026', 8, '3-1', 39),
(3, 1, 'Concepcion Aguila St.', 'NATIONAL CAPITAL REGION - MANILA', 'QUIAPO', '306', '1001', 12, NULL, 42),
(4, 1, '123 Gonzales Street', 'LAGUNA', 'CITY OF BIÑAN', 'Santo Domingo', '4024', 8, '3-1', 43);

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
-- Indexes for table `academic_statuses`
--
ALTER TABLE `academic_statuses`
  ADD PRIMARY KEY (`academic_statu_id`);

--
-- Indexes for table `acad_cross_enrollment`
--
ALTER TABLE `acad_cross_enrollment`
  ADD PRIMARY KEY (`so_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `acad_cross_enrollment_ibfk_2` (`application_letter_status`);

--
-- Indexes for table `acad_grade_accreditation`
--
ALTER TABLE `acad_grade_accreditation`
  ADD PRIMARY KEY (`ga_id`),
  ADD KEY `assessed_fee_status` (`assessed_fee_status`),
  ADD KEY `completion_form_status` (`completion_form_status`),
  ADD KEY `grade_accreditation_ibfk_2` (`user_id`);

--
-- Indexes for table `acad_manual_enrollment`
--
ALTER TABLE `acad_manual_enrollment`
  ADD PRIMARY KEY (`me_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `r_zero_form_status` (`r_zero_form_status`);

--
-- Indexes for table `acad_shifting`
--
ALTER TABLE `acad_shifting`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `request_letter_status` (`request_letter_status`),
  ADD KEY `first_ctc_status` (`first_ctc_status`),
  ADD KEY `second_ctc_status` (`second_ctc_status`);

--
-- Indexes for table `acad_status`
--
ALTER TABLE `acad_status`
  ADD PRIMARY KEY (`academic_status_id`);

--
-- Indexes for table `acad_subject_overload`
--
ALTER TABLE `acad_subject_overload`
  ADD PRIMARY KEY (`so_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ace_form_status` (`ace_form_status`),
  ADD KEY `cert_of_registration_status` (`cert_of_registration_status`),
  ADD KEY `overload_letter_status` (`overload_letter_status`);

--
-- Indexes for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  ADD PRIMARY KEY (`counseling_id`),
  ADD KEY `fk_schedules_doc_requests1_idx` (`doc_requests_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

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
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `guidance_feedbacks`
--
ALTER TABLE `guidance_feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `offsettingtb`
--
ALTER TABLE `offsettingtb`
  ADD PRIMARY KEY (`offsetting_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`personal_detail_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `registrar_feedbacks`
--
ALTER TABLE `registrar_feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
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
  ADD PRIMARY KEY (`reg_id`),
  ADD KEY `office_id` (`office_id`),
  ADD KEY `services_id` (`services_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_statuses`
--
ALTER TABLE `academic_statuses`
  MODIFY `academic_statu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `acad_cross_enrollment`
--
ALTER TABLE `acad_cross_enrollment`
  MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acad_grade_accreditation`
--
ALTER TABLE `acad_grade_accreditation`
  MODIFY `ga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acad_manual_enrollment`
--
ALTER TABLE `acad_manual_enrollment`
  MODIFY `me_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acad_shifting`
--
ALTER TABLE `acad_shifting`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acad_status`
--
ALTER TABLE `acad_status`
  MODIFY `academic_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `acad_subject_overload`
--
ALTER TABLE `acad_subject_overload`
  MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `administrative_feedbacks`
--
ALTER TABLE `administrative_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `guidance_feedbacks`
--
ALTER TABLE `guidance_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offsettingtb`
--
ALTER TABLE `offsettingtb`
  MODIFY `offsetting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `personal_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrar_feedbacks`
--
ALTER TABLE `registrar_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reg_services`
--
ALTER TABLE `reg_services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `reg_status`
--
ALTER TABLE `reg_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reg_transaction`
--
ALTER TABLE `reg_transaction`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acad_cross_enrollment`
--
ALTER TABLE `acad_cross_enrollment`
  ADD CONSTRAINT `acad_cross_enrollment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_cross_enrollment_ibfk_2` FOREIGN KEY (`application_letter_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE;

--
-- Constraints for table `acad_grade_accreditation`
--
ALTER TABLE `acad_grade_accreditation`
  ADD CONSTRAINT `acad_grade_accreditation_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_grade_accreditation_ibfk_3` FOREIGN KEY (`assessed_fee_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_grade_accreditation_ibfk_4` FOREIGN KEY (`completion_form_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE;

--
-- Constraints for table `acad_manual_enrollment`
--
ALTER TABLE `acad_manual_enrollment`
  ADD CONSTRAINT `acad_manual_enrollment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_manual_enrollment_ibfk_2` FOREIGN KEY (`r_zero_form_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE;

--
-- Constraints for table `acad_shifting`
--
ALTER TABLE `acad_shifting`
  ADD CONSTRAINT `acad_shifting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_shifting_ibfk_2` FOREIGN KEY (`request_letter_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_shifting_ibfk_3` FOREIGN KEY (`first_ctc_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_shifting_ibfk_4` FOREIGN KEY (`second_ctc_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE;

--
-- Constraints for table `acad_subject_overload`
--
ALTER TABLE `acad_subject_overload`
  ADD CONSTRAINT `acad_subject_overload_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_subject_overload_ibfk_2` FOREIGN KEY (`ace_form_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_subject_overload_ibfk_3` FOREIGN KEY (`cert_of_registration_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `acad_subject_overload_ibfk_4` FOREIGN KEY (`overload_letter_status`) REFERENCES `acad_status` (`academic_status_id`) ON DELETE CASCADE;

--
-- Constraints for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  ADD CONSTRAINT `accounting_feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_admins_offices1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  ADD CONSTRAINT `appointment_facility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_3` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`facility_id`);

--
-- Constraints for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  ADD CONSTRAINT `counseling_schedules_ibfk_1` FOREIGN KEY (`doc_requests_id`) REFERENCES `doc_requests` (`request_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `doc_requests`
--
ALTER TABLE `doc_requests`
  ADD CONSTRAINT `doc_requests_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `doc_requests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `doc_requests_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`equipment_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `facility`
--
ALTER TABLE `facility`
  ADD CONSTRAINT `facility_ibfk_1` FOREIGN KEY (`facility_type_id`) REFERENCES `facility_type` (`facility_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `guidance_feedbacks`
--
ALTER TABLE `guidance_feedbacks`
  ADD CONSTRAINT `guidance_feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `offsettingtb`
--
ALTER TABLE `offsettingtb`
  ADD CONSTRAINT `offsettingtb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `offsettingtb_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE CASCADE;

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD CONSTRAINT `personal_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `registrar_feedbacks`
--
ALTER TABLE `registrar_feedbacks`
  ADD CONSTRAINT `registrar_feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reg_transaction`
--
ALTER TABLE `reg_transaction`
  ADD CONSTRAINT `reg_transaction_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reg_transaction_ibfk_2` FOREIGN KEY (`services_id`) REFERENCES `reg_services` (`services_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reg_transaction_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `reg_status` (`status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reg_transaction_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `request_equipment`
--
ALTER TABLE `request_equipment`
  ADD CONSTRAINT `request_equipment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `request_equipment_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `request_equipment_ibfk_3` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE CASCADE;

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `student_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`user_role_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_details_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
