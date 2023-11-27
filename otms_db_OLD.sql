-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 03:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
-- Table structure for table `acad_cross_enrollment`
--

CREATE TABLE `acad_cross_enrollment` (
  `so_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL DEFAULT concat('AO-CE-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `application_letter` varchar(255) DEFAULT NULL,
  `application_letter_status` int(11) NOT NULL DEFAULT 1,
  `ce_remarks` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_cross_enrollment`
--

INSERT INTO `acad_cross_enrollment` (`so_id`, `transaction_id`, `user_id`, `application_letter`, `application_letter_status`, `ce_remarks`) VALUES
(7, 'AO-CE-1693042486', 51, NULL, 1, NULL),
(8, 'AO-CE-1693042619', 52, NULL, 1, NULL),
(9, 'AO-CE-1693043435', 53, NULL, 1, NULL),
(10, 'AO-CE-1693043487', 54, NULL, 1, NULL),
(11, 'AO-CE-1693045545', 55, NULL, 1, NULL),
(12, 'AO-CE-1693045778', 56, NULL, 1, NULL),
(13, 'AO-CE-1693057431', 58, NULL, 1, NULL),
(14, 'AO-CE-1693136531', 60, NULL, 1, NULL),
(15, 'AO-CE-1693137578', 62, 'AO_CE_2020-00323-SR-0_Uson_Sharie_APPLETTER.pdf', 5, NULL),
(16, 'AO-CE-1693138947', 63, NULL, 1, NULL),
(17, 'AO-CE-1693141010', 64, 'AO_CE_2020-00569-SR-0_Delas Alas_Chloie Isabelle_APPLETTER.pdf', 2, NULL),
(18, 'AO-CE-1693143445', 66, NULL, 1, NULL),
(19, 'AO-CE-1693203476', 68, 'AO_CE_2020-00884-SR-0_Isagon_Christian Froilan_APPLETTER.pdf', 6, NULL),
(20, 'AO-CE-1693206883', 69, NULL, 1, NULL),
(21, 'AO-CE-1693209793', 70, NULL, 1, NULL),
(22, 'AO-CE-1693210214', 71, NULL, 1, NULL),
(23, 'AO-CE-1693211309', 72, NULL, 1, NULL),
(24, 'AO-CE-1693212195', 73, NULL, 1, NULL),
(25, 'AO-CE-1693265625', 74, NULL, 2, NULL),
(27, 'AO-CE-1693282962', 76, NULL, 1, NULL),
(29, 'AO-CE-1693286004', 78, NULL, 1, NULL),
(30, 'AO-CE-1693288524', 79, NULL, 1, NULL),
(31, 'AO-CE-1693292503', 80, NULL, 1, NULL),
(32, 'AO-CE-1693293656', 81, NULL, 1, NULL),
(33, 'AO-CE-1693293948', 82, NULL, 1, NULL),
(35, 'AO-CE-1693295703', 84, NULL, 1, NULL),
(36, 'AO-CE-1693299635', 89, NULL, 1, NULL),
(37, 'AO-CE-1693302497', 91, NULL, 1, NULL),
(38, 'AO-CE-1693304812', 92, NULL, 1, NULL),
(39, 'AO-CE-1693314178', 94, NULL, 1, NULL),
(40, 'AO-CE-1693376822', 100, 'AO_CE_2020-06969-SR-0_Hwang_Yeji_APPLETTER.pdf', 2, NULL),
(41, 'AO-CE-1693380170', 103, NULL, 1, NULL),
(43, 'AO-CE-1693400631', 105, NULL, 1, NULL),
(44, 'AO-CE-1693400982', 106, NULL, 1, NULL),
(45, 'AO-CE-1693404097', 108, NULL, 1, NULL),
(46, 'AO-CE-1693404491', 109, NULL, 1, NULL),
(47, 'AO-CE-1693412196', 111, NULL, 1, NULL),
(58, 'AO-CE-1699995964', 128, NULL, 1, NULL),
(59, 'AO-CE-1700720058', 129, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acad_feedbacks`
--

CREATE TABLE `acad_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acad_feedbacks`
--

INSERT INTO `acad_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`, `submitted_on`) VALUES
(1, 75, 'phyrozz70@gmail.com', 'testing', '2023-08-29 14:42:15'),
(2, 68, 'chrstn.frln21@gmail.com', '12312 ', '2023-08-29 15:11:03'),
(3, 71, 'pachecofidel2000@gmail.com', 'dfgsdfghjkl', '2023-08-30 06:47:47'),
(4, 63, 'njhanni@gmail.com', 'good good service', '2023-08-30 16:13:25'),
(5, 56, 'juanpedro1@gmail.com', 'Thanks', '2023-08-31 05:11:47');

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
  `assessed_fee_status` int(11) NOT NULL DEFAULT 1,
  `ga_remarks` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_grade_accreditation`
--

INSERT INTO `acad_grade_accreditation` (`ga_id`, `transaction_id`, `user_id`, `completion_form`, `assessed_fee`, `completion_form_status`, `assessed_fee_status`, `ga_remarks`) VALUES
(7, 'AO-GA-1693042486', 51, NULL, NULL, 4, 2, NULL),
(8, 'AO-GA-1693042619', 52, NULL, NULL, 1, 1, NULL),
(9, 'AO-GA-1693043435', 53, NULL, NULL, 1, 1, NULL),
(10, 'AO-GA-1693043487', 54, NULL, NULL, 1, 1, NULL),
(11, 'AO-GA-1693045545', 55, NULL, NULL, 1, 1, NULL),
(12, 'AO-GA-1693045778', 56, NULL, NULL, 1, 1, NULL),
(13, 'AO-GA-1693057431', 58, NULL, NULL, 1, 1, NULL),
(14, 'AO-GA-1693136531', 60, NULL, NULL, 1, 1, NULL),
(15, 'AO-GA-1693137578', 62, NULL, NULL, 1, 1, NULL),
(16, 'AO-GA-1693138947', 63, NULL, NULL, 1, 1, NULL),
(17, 'AO-GA-1693141010', 64, NULL, NULL, 1, 1, NULL),
(18, 'AO-GA-1693143445', 66, NULL, NULL, 1, 1, NULL),
(19, 'AO-GA-1693203476', 68, NULL, NULL, 1, 1, NULL),
(20, 'AO-GA-1693206883', 69, NULL, NULL, 1, 1, NULL),
(21, 'AO-GA-1693209793', 70, NULL, NULL, 1, 1, NULL),
(22, 'AO-GA-1693210214', 71, NULL, NULL, 1, 1, NULL),
(23, 'AO-GA-1693211309', 72, NULL, NULL, 1, 1, NULL),
(24, 'AO-GA-1693212195', 73, NULL, NULL, 1, 1, NULL),
(25, 'AO-GA-1693265625', 74, NULL, NULL, 1, 1, NULL),
(27, 'AO-GA-1693282962', 76, NULL, NULL, 1, 1, NULL),
(29, 'AO-GA-1693286004', 78, NULL, NULL, 1, 1, NULL),
(30, 'AO-GA-1693288524', 79, NULL, NULL, 1, 1, NULL),
(31, 'AO-GA-1693292503', 80, NULL, NULL, 1, 1, NULL),
(32, 'AO-GA-1693293656', 81, NULL, NULL, 1, 1, NULL),
(33, 'AO-GA-1693293948', 82, NULL, NULL, 1, 1, NULL),
(35, 'AO-GA-1693295703', 84, NULL, NULL, 1, 1, NULL),
(36, 'AO-GA-1693299635', 89, NULL, NULL, 1, 1, NULL),
(37, 'AO-GA-1693302497', 91, NULL, NULL, 1, 1, NULL),
(38, 'AO-GA-1693304812', 92, NULL, NULL, 1, 1, NULL),
(39, 'AO-GA-1693314178', 94, NULL, NULL, 1, 1, NULL),
(40, 'AO-GA-1693376822', 100, 'AO_GA_2020-06969-SR-0_Hwang_Yeji_CFORM.pdf', 'AO_GA_2020-06969-SR-0_Hwang_Yeji_Screenshot (50).png', 2, 2, NULL),
(41, 'AO-GA-1693380170', 103, NULL, NULL, 1, 1, NULL),
(43, 'AO-GA-1693400631', 105, NULL, NULL, 1, 1, NULL),
(44, 'AO-GA-1693400982', 106, NULL, NULL, 1, 1, NULL),
(45, 'AO-GA-1693404097', 108, NULL, NULL, 1, 1, NULL),
(46, 'AO-GA-1693404491', 109, NULL, NULL, 1, 1, NULL),
(47, 'AO-GA-1693412196', 111, NULL, NULL, 1, 1, NULL),
(58, 'AO-GA-1699995964', 128, NULL, NULL, 1, 1, NULL),
(59, 'AO-GA-1700720058', 129, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acad_manual_enrollment`
--

CREATE TABLE `acad_manual_enrollment` (
  `me_id` int(11) NOT NULL,
  `transaction_id` varchar(50) DEFAULT concat('AO-ME-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `r_zero_form` varchar(1024) DEFAULT NULL,
  `r_zero_form_status` int(11) NOT NULL DEFAULT 1,
  `me_remarks` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_manual_enrollment`
--

INSERT INTO `acad_manual_enrollment` (`me_id`, `transaction_id`, `user_id`, `r_zero_form`, `r_zero_form_status`, `me_remarks`) VALUES
(7, 'AO-ME-1693042486', 51, NULL, 1, NULL),
(8, 'AO-ME-1693042619', 52, NULL, 1, NULL),
(9, 'AO-ME-1693043435', 53, NULL, 1, NULL),
(10, 'AO-ME-1693043487', 54, NULL, 1, NULL),
(11, 'AO-ME-1693045545', 55, NULL, 1, NULL),
(12, 'AO-ME-1693045778', 56, 'AO_ME_2020-00010-SR-0_Matos_Mary Anne_R0FORM.pdf', 2, NULL),
(13, 'AO-ME-1693057431', 58, NULL, 1, NULL),
(14, 'AO-ME-1693136531', 60, NULL, 1, NULL),
(15, 'AO-ME-1693137578', 62, 'AO_ME_2020-00323-SR-0_Uson_Sharie_R0FORM.pdf', 2, NULL),
(16, 'AO-ME-1693138947', 63, NULL, 1, NULL),
(17, 'AO-ME-1693141010', 64, 'AO_ME_2020-00569-SR-0_Delas Alas_Chloie Isabelle_R0FORM.pdf', 2, NULL),
(18, 'AO-ME-1693143445', 66, NULL, 1, NULL),
(19, 'AO-ME-1693203476', 68, NULL, 1, NULL),
(20, 'AO-ME-1693206883', 69, 'AO_ME_2020-00297-SR-0_Santocildes_Alyca_R0FORM.pdf', 2, NULL),
(21, 'AO-ME-1693209793', 70, NULL, 1, NULL),
(22, 'AO-ME-1693210214', 71, 'AO_ME_2020-00986-SR-0_Pacheco_Fidel_R0FORM.pdf', 2, NULL),
(23, 'AO-ME-1693211309', 72, NULL, 1, NULL),
(24, 'AO-ME-1693212195', 73, NULL, 1, NULL),
(25, 'AO-ME-1693265625', 74, NULL, 1, NULL),
(27, 'AO-ME-1693282962', 76, NULL, 1, NULL),
(29, 'AO-ME-1693286004', 78, NULL, 1, NULL),
(30, 'AO-ME-1693288524', 79, NULL, 1, NULL),
(31, 'AO-ME-1693292503', 80, NULL, 1, NULL),
(32, 'AO-ME-1693293656', 81, NULL, 1, NULL),
(33, 'AO-ME-1693293948', 82, NULL, 1, NULL),
(35, 'AO-ME-1693295703', 84, NULL, 1, NULL),
(36, 'AO-ME-1693299635', 89, NULL, 1, NULL),
(37, 'AO-ME-1693302497', 91, NULL, 1, NULL),
(38, 'AO-ME-1693304812', 92, NULL, 1, NULL),
(39, 'AO-ME-1693314178', 94, NULL, 1, NULL),
(40, 'AO-ME-1693376822', 100, NULL, 1, NULL),
(41, 'AO-ME-1693380170', 103, NULL, 1, NULL),
(43, 'AO-ME-1693400631', 105, NULL, 1, NULL),
(44, 'AO-ME-1693400982', 106, NULL, 1, NULL),
(45, 'AO-ME-1693404097', 108, NULL, 1, NULL),
(46, 'AO-ME-1693404491', 109, NULL, 1, NULL),
(47, 'AO-ME-1693412196', 111, NULL, 1, NULL),
(58, 'AO-ME-1699995964', 128, NULL, 1, NULL),
(59, 'AO-ME-1700720058', 129, NULL, 1, NULL);

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
  `second_ctc_status` int(11) NOT NULL DEFAULT 1,
  `s_remarks` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_shifting`
--

INSERT INTO `acad_shifting` (`s_id`, `transaction_id`, `user_id`, `request_letter`, `first_ctc`, `second_ctc`, `request_letter_status`, `first_ctc_status`, `second_ctc_status`, `s_remarks`) VALUES
(7, 'AO-S-1693042486', 51, NULL, NULL, NULL, 1, 1, 1, NULL),
(8, 'AO-S-1693042619', 52, NULL, NULL, NULL, 1, 1, 1, NULL),
(9, 'AO-S-1693043435', 53, NULL, NULL, NULL, 1, 1, 1, NULL),
(10, 'AO-S-1693043487', 54, NULL, NULL, NULL, 1, 1, 1, NULL),
(11, 'AO-S-1693045545', 55, NULL, NULL, NULL, 1, 1, 1, NULL),
(12, 'AO-S-1693045778', 56, NULL, NULL, NULL, 1, 1, 1, NULL),
(13, 'AO-S-1693057431', 58, NULL, NULL, NULL, 1, 1, 1, NULL),
(14, 'AO-S-1693136531', 60, NULL, NULL, NULL, 1, 1, 1, NULL),
(15, 'AO-S-1693137578', 62, NULL, NULL, NULL, 1, 1, 1, NULL),
(16, 'AO-S-1693138947', 63, NULL, NULL, NULL, 1, 1, 1, NULL),
(17, 'AO-S-1693141010', 64, NULL, NULL, NULL, 1, 1, 1, NULL),
(18, 'AO-S-1693143445', 66, NULL, NULL, NULL, 1, 1, 1, NULL),
(19, 'AO-S-1693203476', 68, 'AO_S_2020-00884-SR-0_Isagon_Christian Froilan_RobloxScreenShot20230107_081654744.png', 'AO_S_2020-00884-SR-0_Isagon_Christian Froilan_RobloxScreenShot20230107_081654744.png', 'AO_S_2020-00884-SR-0_Isagon_Christian Froilan_RobloxScreenShot20230107_081654744.png', 5, 5, 5, NULL),
(20, 'AO-S-1693206883', 69, NULL, NULL, NULL, 1, 1, 1, NULL),
(21, 'AO-S-1693209793', 70, NULL, NULL, NULL, 1, 1, 1, NULL),
(22, 'AO-S-1693210214', 71, 'AO_S_2020-00986-SR-0_Pacheco_Fidel_Keyds - Durian, John Kenneth D..png', NULL, NULL, 5, 1, 1, NULL),
(23, 'AO-S-1693211309', 72, NULL, NULL, NULL, 1, 1, 1, NULL),
(24, 'AO-S-1693212195', 73, NULL, NULL, NULL, 1, 1, 1, NULL),
(25, 'AO-S-1693265625', 74, NULL, NULL, NULL, 1, 1, 1, NULL),
(27, 'AO-S-1693282962', 76, NULL, NULL, NULL, 1, 1, 1, NULL),
(29, 'AO-S-1693286004', 78, NULL, NULL, NULL, 1, 1, 1, NULL),
(30, 'AO-S-1693288524', 79, NULL, NULL, NULL, 1, 1, 1, NULL),
(31, 'AO-S-1693292503', 80, NULL, NULL, NULL, 1, 1, 1, NULL),
(32, 'AO-S-1693293656', 81, NULL, NULL, NULL, 1, 1, 1, NULL),
(33, 'AO-S-1693293948', 82, NULL, NULL, NULL, 1, 1, 1, NULL),
(35, 'AO-S-1693295703', 84, NULL, NULL, NULL, 1, 1, 1, NULL),
(36, 'AO-S-1693299635', 89, NULL, NULL, NULL, 1, 1, 1, NULL),
(37, 'AO-S-1693302497', 91, NULL, NULL, NULL, 1, 1, 1, NULL),
(38, 'AO-S-1693304812', 92, NULL, NULL, NULL, 1, 1, 1, NULL),
(39, 'AO-S-1693314178', 94, NULL, NULL, NULL, 1, 1, 1, NULL),
(40, 'AO-S-1693376822', 100, NULL, NULL, NULL, 1, 1, 1, NULL),
(41, 'AO-S-1693380170', 103, NULL, NULL, NULL, 1, 1, 1, NULL),
(43, 'AO-S-1693400631', 105, NULL, NULL, NULL, 1, 1, 1, NULL),
(44, 'AO-S-1693400982', 106, NULL, NULL, NULL, 1, 1, 1, NULL),
(45, 'AO-S-1693404097', 108, NULL, NULL, NULL, 1, 1, 1, NULL),
(46, 'AO-S-1693404491', 109, NULL, NULL, NULL, 1, 1, 1, NULL),
(47, 'AO-S-1693412196', 111, NULL, NULL, NULL, 1, 1, 1, NULL),
(58, 'AO-S-1699995964', 128, NULL, NULL, NULL, 1, 1, 1, NULL),
(59, 'AO-S-1700720058', 129, NULL, NULL, NULL, 1, 1, 1, NULL);

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
(5, 'Rejected'),
(6, 'To Be Evaluated'),
(7, 'Need F to F Evaluation'),
(8, 'Approved');

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
  `cert_of_registration_status` int(11) NOT NULL DEFAULT 1,
  `so_remarks` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acad_subject_overload`
--

INSERT INTO `acad_subject_overload` (`so_id`, `transaction_id`, `user_id`, `overload_letter`, `ace_form`, `cert_of_registration`, `overload_letter_status`, `ace_form_status`, `cert_of_registration_status`, `so_remarks`) VALUES
(7, 'AO-SO-1693042486', 51, NULL, NULL, NULL, 1, 1, 1, NULL),
(8, 'AO-SO-1693042619', 52, NULL, NULL, NULL, 1, 1, 1, NULL),
(9, 'AO-SO-1693043435', 53, NULL, NULL, NULL, 5, 1, 1, NULL),
(10, 'AO-SO-1693043487', 54, NULL, NULL, NULL, 1, 1, 1, NULL),
(11, 'AO-SO-1693045545', 55, NULL, NULL, NULL, 1, 1, 1, NULL),
(12, 'AO-SO-1693045778', 56, NULL, NULL, NULL, 1, 1, 1, NULL),
(13, 'AO-SO-1693057431', 58, NULL, NULL, NULL, 1, 1, 1, NULL),
(14, 'AO-SO-1693136531', 60, NULL, NULL, NULL, 1, 1, 1, NULL),
(15, 'AO-SO-1693137578', 62, NULL, 'AO_SO_2020-00323-SR-0_Uson_Sharie_ACEFORM.pdf', NULL, 6, 1, 1, NULL),
(16, 'AO-SO-1693138947', 63, NULL, NULL, NULL, 1, 1, 1, NULL),
(17, 'AO-SO-1693141010', 64, NULL, NULL, NULL, 1, 1, 1, NULL),
(18, 'AO-SO-1693143445', 66, NULL, NULL, NULL, 1, 1, 1, NULL),
(19, 'AO-SO-1693203476', 68, 'AO_SO_2020-00884-SR-0_Isagon_Christian Froilan_RobloxScreenShot20230107_081654744.png', 'AO_SO_2020-00884-SR-0_Isagon_Christian Froilan_ACEFORM.pdf', 'AO_SO_2020-00884-SR-0_Isagon_Christian Froilan_RobloxScreenShot20230107_081654744.png', 5, 5, 3, NULL),
(20, 'AO-SO-1693206883', 69, NULL, NULL, NULL, 3, 1, 1, NULL),
(21, 'AO-SO-1693209793', 70, NULL, NULL, NULL, 1, 1, 1, NULL),
(22, 'AO-SO-1693210214', 71, NULL, NULL, NULL, 1, 1, 1, NULL),
(23, 'AO-SO-1693211309', 72, NULL, NULL, NULL, 1, 1, 1, ''),
(24, 'AO-SO-1693212195', 73, NULL, NULL, NULL, 1, 1, 1, NULL),
(25, 'AO-SO-1693265625', 74, NULL, NULL, NULL, 1, 2, 1, NULL),
(27, 'AO-SO-1693282962', 76, NULL, NULL, NULL, 1, 1, 1, NULL),
(29, 'AO-SO-1693286004', 78, NULL, NULL, NULL, 1, 1, 1, NULL),
(30, 'AO-SO-1693288524', 79, NULL, NULL, NULL, 1, 1, 1, NULL),
(31, 'AO-SO-1693292503', 80, NULL, NULL, NULL, 1, 1, 1, NULL),
(32, 'AO-SO-1693293656', 81, NULL, NULL, NULL, 1, 1, 1, NULL),
(33, 'AO-SO-1693293948', 82, NULL, NULL, NULL, 1, 1, 1, NULL),
(35, 'AO-SO-1693295703', 84, NULL, NULL, NULL, 1, 1, 1, NULL),
(36, 'AO-SO-1693299635', 89, NULL, NULL, NULL, 1, 1, 1, NULL),
(37, 'AO-SO-1693302497', 91, NULL, NULL, NULL, 1, 1, 1, NULL),
(38, 'AO-SO-1693304812', 92, NULL, NULL, NULL, 1, 1, 1, NULL),
(39, 'AO-SO-1693314178', 94, NULL, NULL, NULL, 1, 1, 1, NULL),
(40, 'AO-SO-1693376822', 100, 'AO_SO_2020-06969-SR-0_Hwang_Yeji_Screenshot (47).png', 'AO_SO_2020-06969-SR-0_Hwang_Yeji_ACEFORM.pdf', 'AO_SO_2020-06969-SR-0_Hwang_Yeji_Screenshot 2023-08-28 000720.png', 3, 6, 2, NULL),
(41, 'AO-SO-1693380170', 103, NULL, NULL, NULL, 1, 1, 1, NULL),
(43, 'AO-SO-1693400631', 105, NULL, NULL, NULL, 1, 1, 1, NULL),
(44, 'AO-SO-1693400982', 106, NULL, NULL, NULL, 1, 1, 1, NULL),
(45, 'AO-SO-1693404097', 108, NULL, NULL, NULL, 1, 1, 1, NULL),
(46, 'AO-SO-1693404491', 109, NULL, NULL, NULL, 1, 1, 1, NULL),
(47, 'AO-SO-1693412196', 111, NULL, NULL, NULL, 1, 1, 1, NULL),
(58, 'AO-SO-1699995964', 128, NULL, NULL, NULL, 1, 1, 1, NULL),
(59, 'AO-SO-1700720058', 129, NULL, NULL, NULL, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acad_survey`
--

CREATE TABLE `acad_survey` (
  `survey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `suggestions` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acad_survey`
--

INSERT INTO `acad_survey` (`survey_id`, `user_id`, `rating`, `suggestions`) VALUES
(1, 69, 'Excellent', 'testing testing');

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
(1, 69, 'lykasantocildes@gmail.com', 'this is a test', '2023-08-29 08:33:00'),
(2, 63, 'njhanni@gmail.com', 'smooth service', '2023-08-30 16:09:11'),
(3, 96, 'monteroballuser@gmail.com', 'smooth service', '2023-08-30 16:09:40'),
(4, 96, 'monteroballuser@gmail.com', 'Excellent job', '2023-08-30 16:18:56'),
(5, 69, 'lykasantocildes@gmail.com', 'testing testingg', '2023-08-30 16:20:21'),
(6, 86, 'hannahsantiago@gmail.com', 'testing mic test 1 2 3 4 5', '2023-08-30 16:20:53'),
(7, 86, 'hannahsantiago@gmail.com', 'testing ulit kung totoo', '2023-08-30 16:22:10');

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
(9, 43, 'juandelacruz123@gmail.com', 'hello', '2023-07-22 06:02:40'),
(10, 56, 'juanpedro1@gmail.com', 'Thank you.', '2023-08-29 09:04:04'),
(11, 56, 'juanpedro1@gmail.com', 'I am writing to express my utmost satisfaction and appreciation for the exceptional performance of your system.I have had the opportunity to interact with and utilize your system extensively, and I am thoroughly impressed by its capabilities and user-friendly interface.', '2023-08-29 09:10:00'),
(12, 75, 'phyrozz70@gmail.com', 'Thank you so much for this system. I can now request for a facility appointment much faster and easier now!', '2023-08-29 14:32:08'),
(13, 71, 'pachecofidel2000@gmail.com', 'asdfghjkl', '2023-08-30 06:47:15'),
(14, 63, 'njhanni@gmail.com', 'equipment is best', '2023-08-30 16:14:02');

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
(1, 'Salmingo', 'Leny', NULL, NULL, 'pupsrc_administrative@admin.com', '$2y$10$5A1HwUUMrJ0GM3j95vCuhu/jNKord5ZLuGY2bO2rNRzBK/CzqXyQS', 1),
(2, 'Salmingo', 'Leny', NULL, NULL, 'pupsrc_accounting@admin.com', '$2y$10$5A1HwUUMrJ0GM3j95vCuhu/jNKord5ZLuGY2bO2rNRzBK/CzqXyQS', 2),
(3, 'Salmingo', 'Leny', NULL, NULL, 'pupsrc_registrar@admin.com', '$2y$10$5A1HwUUMrJ0GM3j95vCuhu/jNKord5ZLuGY2bO2rNRzBK/CzqXyQS', 3),
(4, 'Salmingo', 'Leny', NULL, NULL, 'pupsrc_academic@admin.com', '$2y$10$5A1HwUUMrJ0GM3j95vCuhu/jNKord5ZLuGY2bO2rNRzBK/CzqXyQS', 4),
(5, 'Salmingo', 'Leny', NULL, NULL, 'pupsrc_guidance@admin.com', '$2y$10$5A1HwUUMrJ0GM3j95vCuhu/jNKord5ZLuGY2bO2rNRzBK/CzqXyQS', 5);

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
('FA-1693549165', 99, 4, NULL, NULL, '2023-09-01 14:30:00', '2023-09-01 16:00:00', 'Event', 1, 'Alumni'),
('FA-1693549224', 99, 1, NULL, NULL, '2023-09-01 15:30:00', '2023-09-01 16:00:00', 'Event', 2, 'Organization'),
('FA-1693557034', 71, 5, 'BSEE', '3-1', '2023-09-06 12:00:00', '2023-09-06 15:00:00', 'PE CLASS', 1, NULL),
('FA-1700617832', 128, 1, 'BSIT', '3-1', '2023-11-24 10:00:00', '2023-11-24 14:30:00', 'IT subject', 2, NULL),
('FA-1700745221', 129, 8, 'BSIT', '4-1', '2023-11-29 08:00:00', '2023-11-29 11:00:00', 'Prog3', 2, NULL),
('FA-1700745271', 129, 8, 'BSIT', '4-1', '2023-11-30 08:00:00', '2023-11-30 18:00:00', 'Project TALENT Seminar\r\n', 3, NULL),
('FA-1700748220', 130, 8, NULL, NULL, '2023-11-25 15:00:00', '2023-11-27 17:00:00', 'hulaan mo', 2, 'Alumni'),
('FA-1700748245', 130, 8, NULL, NULL, '2023-11-29 13:00:00', '2023-11-29 17:00:00', 'seminar', 3, 'Organization');

-- --------------------------------------------------------

--
-- Table structure for table `cancel_request_equipment`
--

CREATE TABLE `cancel_request_equipment` (
  `request_id` varchar(50) NOT NULL DEFAULT concat('ROE-',unix_timestamp()),
  `user_id` int(11) NOT NULL,
  `datetime_schedule` datetime DEFAULT NULL,
  `quantity_equip` int(30) NOT NULL,
  `purpose` text NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `slip_content` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cancel_request_equipment`
--

INSERT INTO `cancel_request_equipment` (`request_id`, `user_id`, `datetime_schedule`, `quantity_equip`, `purpose`, `equipment_id`, `slip_content`) VALUES
('ROE-1700739241', 129, '2023-11-29 14:00:00', 2, 'Classes', 19, ''),
('ROE-1700739353', 129, '2023-11-27 17:00:00', 1, 'Class for Change Management', 20, '');

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
('GC-1693136757', 'Other', 'badajdjkasjkahoahdjahfkaslf', 'DR-1693136757'),
('GC-1693193160', 'Academic Performance', '', 'DR-1693193160'),
('GC-1693282861', 'Personal Development', '', 'DR-1693282861'),
('GC-1693301299', 'Study Skills', '', 'DR-1693301299'),
('GC-1693325509', 'Academic Performance', '', 'DR-1693325509'),
('GC-1693366646', 'Report Issue', '', 'DR-1693366646'),
('GC-1693374881', 'Other', 'Mental health issues', 'DR-1693374881'),
('GC-1693451665', 'Academic Performance', '', 'DR-1693451665'),
('GC-1693476869', 'Personal Development', '', 'DR-1693476869'),
('GC-1693557298', 'Academic Performance', '', 'DR-1693557298'),
('GC-1700224223', 'Other', 'bullying', 'DR-1700224223'),
('GC-1700227195', 'Academic Performance', '', 'DR-1700227195');

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
  `amount_to_pay` decimal(10,2) NOT NULL DEFAULT 0.00,
  `attached_files` varchar(255) DEFAULT NULL,
  `request_letter` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doc_requests`
--

INSERT INTO `doc_requests` (`request_id`, `request_description`, `scheduled_datetime`, `office_id`, `user_id`, `status_id`, `purpose`, `amount_to_pay`, `attached_files`, `request_letter`) VALUES
('DR-1693042649', 'Request Good Moral Document', '2023-08-28 00:00:00', 5, 52, 5, 'School Requirement', '0.00', NULL, NULL),
('DR-1693057547', 'Course Accreditation Service-Senior High School to Bridge Course', '2023-08-29 00:00:00', 3, 53, 3, NULL, '0.00', NULL, NULL),
('DR-1693067270', 'Completion of Incomplete Grade', '2023-09-02 00:00:00', 3, 52, 1, NULL, '0.00', NULL, NULL),
('DR-1693136757', 'Guidance Counseling', '2023-08-29 10:00:00', 5, 60, 1, NULL, '0.00', NULL, NULL),
('DR-1693136870', 'Request Good Moral Document', '2023-08-31 00:00:00', 5, 60, 5, 'School Requirement', '0.00', '../../assets/uploads/supporting_docs/64eb37e6934dd-cuti.jpg', NULL),
('DR-1693136922', 'Request Clearance', '2023-08-29 00:00:00', 5, 60, 3, NULL, '0.00', '../../assets/uploads/supporting_docs/64eb381a65d89-treasure.jpg', NULL),
('DR-1693137538', 'Request Good Moral Document', '2023-08-31 00:00:00', 5, 61, 6, 'School Requirement', '0.00', '../../assets/uploads/supporting_docs/64eb3a8255e18-cuti.jpg', NULL),
('DR-1693137601', 'Request Clearance', '2023-08-29 00:00:00', 5, 61, 3, NULL, '0.00', '../../assets/uploads/supporting_docs/64eb3ac168c84-ee.jpg', NULL),
('DR-1693144219', 'Certificate of General Weighted Average (GWA)', '2023-08-31 00:00:00', 3, 66, 3, NULL, '0.00', NULL, NULL),
('DR-1693152155', 'Late Reporting of Grade', '2023-09-28 00:00:00', 3, 66, 1, NULL, '0.00', NULL, NULL),
('DR-1693193160', 'Guidance Counseling', '2023-08-31 17:30:00', 5, 51, 1, NULL, '0.00', NULL, NULL),
('DR-1693218333', ' Correction of Entry of Grade', '2023-09-08 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693218396', 'Late Reporting of Grade', '2023-09-09 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219398', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219406', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219458', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219463', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219468', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219473', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219478', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219494', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219499', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219504', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219529', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219535', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219540', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219547', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219551', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219556', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219561', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219565', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219570', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219575', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219580', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219584', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219605', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219611', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219616', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219621', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219626', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219631', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219636', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219643', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219648', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219652', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219657', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219662', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219667', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 1, NULL, '0.00', NULL, NULL),
('DR-1693219698', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 2, NULL, '0.00', NULL, NULL),
('DR-1693219703', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 2, NULL, '0.00', NULL, NULL),
('DR-1693219708', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 2, NULL, '0.00', NULL, NULL),
('DR-1693219715', 'Application for Graduation SIS and Non-SIS', '2023-08-30 00:00:00', 3, 72, 2, NULL, '0.00', NULL, NULL),
('DR-1693235939', 'Application for Graduation SIS and Non-SIS', '2023-08-28 00:00:00', 3, 70, 4, 'The documents are not visible', '0.00', NULL, NULL),
('DR-1693282861', 'Guidance Counseling', '2023-08-31 11:00:00', 5, 55, 1, NULL, '0.00', NULL, NULL),
('DR-1693293466', 'Request Clearance', '2023-08-29 00:00:00', 5, 66, 3, NULL, '0.00', NULL, NULL),
('DR-1693298487', 'Request Clearance', '2023-08-29 00:00:00', 5, 55, 2, NULL, '0.00', '../../assets/uploads/supporting_docs/64edaf37b3dae-cat.jpg', NULL),
('DR-1693298805', 'Request Good Moral Document', '2023-08-29 00:00:00', 5, 88, 6, 'Professional Licenses', '0.00', '../../assets/uploads/supporting_docs/64edb075aa3ae-nyar.png', NULL),
('DR-1693298822', 'Request Clearance', '2023-08-29 00:00:00', 5, 88, 3, NULL, '0.00', NULL, NULL),
('DR-1693301299', 'Guidance Counseling', '2023-08-31 15:30:00', 5, 89, 1, NULL, '0.00', NULL, NULL),
('DR-1693301470', 'Request Clearance', '2023-08-29 00:00:00', 5, 90, 4, NULL, '0.00', NULL, NULL),
('DR-1693302543', 'Application for Graduation SIS and Non-SIS', '2023-09-02 00:00:00', 3, 91, 1, NULL, '0.00', NULL, NULL),
('DR-1693310162', 'Request Good Moral Document', '2023-08-29 00:00:00', 5, 93, 1, 'Job Application', '0.00', NULL, NULL),
('DR-1693325509', 'Guidance Counseling', '2023-08-31 14:30:00', 5, 52, 1, NULL, '0.00', NULL, NULL),
('DR-1693326618', 'Request Good Moral Document', '2023-08-30 00:00:00', 5, 52, 1, 'Job Application', '0.00', NULL, NULL),
('DR-1693327214', 'Request Clearance', '2023-08-30 00:00:00', 5, 52, 1, NULL, '0.00', NULL, NULL),
('DR-1693366646', 'Guidance Counseling', '2023-08-31 13:30:00', 5, 89, 1, NULL, '0.00', NULL, NULL),
('DR-1693374749', 'Completion of Incomplete Grade', '2023-08-31 00:00:00', 3, 70, 4, NULL, '0.00', NULL, NULL),
('DR-1693374881', 'Guidance Counseling', '2023-08-31 20:00:00', 5, 62, 1, NULL, '0.00', NULL, NULL),
('DR-1693378418', 'Certificate of Medium of Instruction', '2023-08-31 00:00:00', 3, 102, 1, NULL, '0.00', NULL, NULL),
('DR-1693378471', 'Certificate of Transfer Credential/Honorable Dismissal', '2023-12-25 00:00:00', 3, 102, 1, NULL, '0.00', NULL, NULL),
('DR-1693400211', 'Certificate of Graduation', '2023-08-31 00:00:00', 3, 93, 6, 'Kulang pa po sa requirements.', '0.00', NULL, NULL),
('DR-1693412669', 'Certification, Verification, Authentication (CAV/Apostile)', '2023-09-01 00:00:00', 3, 69, 5, NULL, '0.00', NULL, NULL),
('DR-1693413071', 'Request Clearance', '2023-09-07 00:00:00', 5, 69, 1, NULL, '0.00', '../../assets/uploads/supporting_docs/64ef6ecf6b2a4-Screenshot (47).png', NULL),
('DR-1693449516', 'Transcript of Records (Second and succeeding copies)', '2023-09-04 00:00:00', 3, 113, 1, NULL, '0.00', NULL, NULL),
('DR-1693450313', 'Certified True Copy', '2023-09-01 00:00:00', 3, 78, 1, NULL, '0.00', NULL, NULL),
('DR-1693451562', 'Certified True Copy', '2023-09-01 00:00:00', 3, 56, 6, NULL, '0.00', NULL, NULL),
('DR-1693451665', 'Guidance Counseling', '2023-09-01 08:00:00', 5, 56, 1, NULL, '0.00', NULL, NULL),
('DR-1693476869', 'Guidance Counseling', '2023-08-31 13:00:00', 5, 73, 1, NULL, '0.00', NULL, NULL),
('DR-1693489989', '', '2023-08-31 00:00:00', 3, 102, 1, NULL, '0.00', NULL, NULL),
('DR-1693494075', 'Certificate of General Weighted Average (GWA)', '2023-09-01 00:00:00', 3, 63, 4, NULL, '0.00', NULL, NULL),
('DR-1693494312', 'Request Clearance', '2023-08-31 00:00:00', 5, 63, 6, NULL, '0.00', '../../assets/uploads/supporting_docs/64f0ac282a610-payment-voucher.jpg', NULL),
('DR-1693495858', 'Informative Copy of Grades', '2023-09-01 00:00:00', 3, 53, 1, '123', '0.00', NULL, NULL),
('DR-1693496422', 'Certified True Copy', '2023-09-08 00:00:00', 3, 93, 5, NULL, '0.00', NULL, NULL),
('DR-1693555024', 'Informative Copy of Grades', '2023-09-01 00:00:00', 3, 71, 6, 'Insufficient documents submitted, please resubmit.', '0.00', NULL, NULL),
('DR-1693557298', 'Guidance Counseling', '2023-09-04 09:30:00', 5, 71, 1, NULL, '0.00', NULL, NULL),
('DR-1693557418', 'Request Good Moral Document', '2023-09-02 00:00:00', 5, 71, 5, 'School Requirement', '0.00', NULL, NULL),
('DR-1700224223', 'Guidance Counseling', '2023-11-18 05:00:00', 5, 128, 1, NULL, '0.00', NULL, NULL),
('DR-1700227195', 'Guidance Counseling', '2023-11-29 02:00:00', 5, 128, 1, NULL, '0.00', NULL, NULL),
('DR-1700228353', 'Request Good Moral Document', '2023-11-17 16:00:00', 5, 128, 1, 'School Requirement', '0.00', NULL, NULL),
('DR-1700720167', 'Certified True Copy', '2023-11-26 16:00:00', 3, 129, 1, NULL, '0.00', NULL, NULL);

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
(1, 'Badminton Net', 'Available', 10, 2, 1),
(2, 'Badminton Racket', 'Available', 6, 2, 1),
(3, 'Badminton Shuttlecock', 'Available', 6, 2, 1),
(4, 'Basketball', 'Unavailable', 0, 2, 1),
(5, 'Basketball Ring and Net', 'Available', 8, 2, 1),
(6, 'Brush', 'Available', 10, 3, 1),
(7, 'Bucket', 'Available', 5, 3, 1),
(8, 'Chairs', 'Available', 100, 1, 1),
(9, 'Cleaning Detergent', 'Available', 10, 3, 1),
(10, 'Curtains', 'Available', 2, 1, 1),
(11, 'Chess Board', 'Available', 2, 2, 1),
(12, 'Digital Scoreboard', 'Available', 5, 1, 1),
(13, 'Mop', 'Available', 5, 3, 1),
(14, 'Projector', 'Available', 1, 1, 1),
(15, 'Scoreboard', 'Available', 3, 2, 1),
(16, 'Vacuum', 'Available', 2, 3, 1),
(17, 'Volleyball', 'Available', 3, 2, 1),
(18, 'Volleyball Net', 'Available', 2, 2, 1),
(19, 'Table', 'Available', 5, 1, 1),
(20, 'TV', 'Available', 5, 1, 1);

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
(1, 'Campus Court', 'Unavailable', '', 1, 1),
(2, 'Computer Lab', 'Available', '205', 2, 1),
(3, 'Audio Visual Room', 'Available', '307', 3, 1);

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
(3, 'Third Floor');

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
(9, 60, 'alanaell@gmail.com', 'ghhghggh', '2023-08-27 11:44:54'),
(10, 61, 'thea@gmail.com', 'jkjjjiojih', '2023-08-27 11:57:58'),
(11, 69, 'lykasantocildes@gmail.com', 'this is a test', '2023-08-28 09:18:07'),
(12, 63, 'njhanni@gmail.com', 'life changing', '2023-08-30 16:13:05'),
(13, 96, 'monteroballuser@gmail.com', 'ggwp', '2023-08-30 16:15:11'),
(14, 86, 'hannahsantiago@gmail.com', 'testing kung true', '2023-08-30 16:22:30'),
(15, 56, 'juanpedro1@gmail.com', 'Nice service, thank you.', '2023-08-31 03:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `office_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `office_id`, `title`, `description`, `timestamp`, `is_read`) VALUES
(12, 55, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 29, 2023 is ready for pickup.', '2023-08-29 04:35:02', 1),
(13, 70, 5, 'Request Status Update', 'Your Application for Graduation SIS and Non-SIS scheduled on August 28, 2023 has been rejected.', '2023-08-29 04:41:41', 1),
(14, 63, 5, 'Request Status Update', 'Your Certificate of General Weighted Average (GWA) scheduled on August 29, 2023 has been rejected.', '2023-08-29 05:22:04', 1),
(17, 53, 5, 'Request Status Update', 'Your Certified True Copy scheduled on August 30, 2023 has been rejected.', '2023-08-29 05:41:41', 1),
(18, 66, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 29, 2023 has been rejected.', '2023-08-29 07:08:17', 1),
(19, 66, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 29, 2023 is ready for pickup.', '2023-08-29 07:22:21', 1),
(20, 60, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 31, 2023 has been rejected.', '2023-08-29 07:43:32', 0),
(21, 55, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 29, 2023 has been rejected.', '2023-08-29 07:43:32', 1),
(22, 66, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 29, 2023 has been rejected.', '2023-08-29 07:43:32', 1),
(25, 71, 5, 'Request Status Update', 'Your Certificate of Graduation scheduled on August 29, 2023 has been rejected.', '2023-08-29 08:41:08', 1),
(26, 88, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 29, 2023 is ready for pickup.', '2023-08-29 08:51:06', 1),
(27, 60, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 29, 2023 has been rejected.', '2023-08-29 09:28:59', 0),
(28, 61, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 31, 2023 has been rejected.', '2023-08-29 09:28:59', 0),
(29, 61, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 29, 2023 has been rejected.', '2023-08-29 09:28:59', 0),
(30, 55, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 29, 2023 has been rejected.', '2023-08-29 09:28:59', 1),
(31, 88, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 29, 2023 has been rejected.', '2023-08-29 09:28:59', 0),
(32, 88, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 29, 2023 has been rejected.', '2023-08-29 09:28:59', 0),
(33, 90, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 29, 2023 is ready for pickup.', '2023-08-29 09:33:16', 1),
(34, 53, 5, 'Request Status Update', 'Your Leave of Absence scheduled on August 30, 2023 is ready for pickup.', '2023-08-29 11:59:00', 1),
(35, 53, 5, 'Request Status Update', 'Your Leave of Absence scheduled on August 30, 2023 has been rejected.', '2023-08-29 12:00:34', 1),
(36, 53, 5, 'Request Status Update', 'Your Certified True Copy scheduled on August 30, 2023 is ready for pickup.', '2023-08-29 12:01:13', 1),
(40, 68, 4, 'Academic Shifting Status Update', 'Your Request Letter has been approved.', '2023-08-30 02:14:22', 0),
(41, 68, 4, 'Academic Shifting Status Update', 'Your Certified Copy of Grades has been approved.', '2023-08-30 02:14:24', 0),
(42, 68, 4, 'Academic Shifting Status Update', 'Your Certified Copy of Grades (Office copy) has been approved.', '2023-08-30 02:14:26', 0),
(44, 68, 4, 'Manual Enrollment Status Update', 'Your R Zero Form requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-08-30 03:11:50', 1),
(45, 96, 3, 'Request Status Update', 'Your Request for Transcript of Records (Second and succeeding copies) scheduled on September 1, 2023 has been rejected for the following reason: \"Insufficient documents submitted. Please resubmit..\"', '2023-08-30 03:11:59', 1),
(46, 71, 4, 'Academic Shifting Status Update', 'Your Request Letter has been rejected.', '2023-08-30 03:14:15', 1),
(47, 68, 4, 'Academic Shifting Status Update', 'Your Request Letter has been rejected.', '2023-08-30 03:15:26', 0),
(48, 68, 4, 'Academic Shifting Status Update', NULL, '2023-08-30 03:15:28', 0),
(49, 68, 4, 'Academic Shifting Status Update', NULL, '2023-08-30 03:15:30', 0),
(50, 89, 5, 'Counseling Status Update', 'Your Counseling Appointment with the following reason: \"Report Issue\" and scheduled on August 31, 2023 has been approved.', '2023-08-30 03:39:23', 1),
(51, 63, 3, 'Request Status Update', 'Your Request for Correction of Entry of Grade scheduled on September 7, 2023 is ready for pickup.', '2023-08-30 04:29:10', 1),
(52, 63, 3, 'Request Status Update', 'Your Request for Correction of Entry of Grade scheduled on September 7, 2023 has been rejected for the following reason: \"Resubmit clear documents.\"', '2023-08-30 04:31:44', 1),
(53, 63, 3, 'Request Status Update', 'Your Request for Correction of Entry of Grade scheduled on September 7, 2023 has been rejected for the following reason: \"Resubmit clear documents.\"', '2023-08-30 04:31:47', 1),
(54, 96, 3, 'Request Status Update', 'Your Request for Certification, Verification, Authentication (CAV/Apostile) scheduled on September 6, 2023 is ready for pickup.', '2023-08-30 04:37:29', 1),
(55, 96, 3, 'Request Status Update', 'Your Request for Certification, Verification, Authentication (CAV/Apostile) scheduled on September 6, 2023 has been rejected for the following reason: \"Resubmit clear documents .\"', '2023-08-30 04:39:38', 1),
(56, 63, 3, 'Request Status Update', 'Your Request for Certified True Copy scheduled on August 31, 2023 has been rejected for the following reason: \"Resubmit clear documents .\"', '2023-08-30 04:51:26', 1),
(57, 63, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 31, 2023 has been rejected.', '2023-08-30 04:52:49', 1),
(58, 96, 3, 'Request Status Update', 'Your Request for Transcript of Records (Second and succeeding copies) scheduled on September 1, 2023 has been rejected for the following reason: \"Resubmit clear documents .\"', '2023-08-30 05:15:05', 1),
(59, 96, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 31, 2023 has been rejected.', '2023-08-30 05:15:22', 1),
(60, 69, 3, 'Request Status Update', 'Your Request for Course/Subject Description scheduled on September 7, 2023 has been rejected for the following reason: \"Di po available tnxx ;).\"', '2023-08-30 06:26:28', 1),
(61, 53, 3, 'Request Status Update', 'Your Request for Leave of Absence scheduled on August 30, 2023 has been rejected for the following reason: \"Hello po, malabo po ang copy..\"', '2023-08-30 06:26:43', 1),
(62, 93, 3, 'Request Status Update', 'Your Request for Certificate of Graduation scheduled on August 31, 2023 has been rejected for the following reason: \"Kulang pa po sa requirements..\"', '2023-08-30 12:58:23', 0),
(63, 96, 3, 'Request Status Update', 'Your Request for Transcript of Records (Second and succeeding copies) scheduled on September 7, 2023 is ready for pickup.', '2023-08-30 14:26:51', 1),
(64, 63, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 31, 2023 has been rejected.', '2023-08-30 14:47:06', 1),
(65, 96, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 31, 2023 has been rejected.', '2023-08-30 14:47:06', 1),
(66, 63, 5, 'Counseling Status Update', 'Your Counseling Appointment with the following reason: \"Academic Guidance\" and scheduled on August 31, 2023 has been rejected.', '2023-08-30 15:02:59', 1),
(67, 63, 3, 'Request Status Update', 'Your Request for Certified True Copy scheduled on August 31, 2023 has been rejected for the following reason: \"Insufficient documents submitted .\"', '2023-08-30 15:53:08', 1),
(68, 63, 5, 'Request Status Update', 'Your Request Good Moral Document scheduled on August 30, 2023 has been rejected.', '2023-08-30 15:53:30', 1),
(69, 69, 4, 'Subject Overload Status Update', NULL, '2023-08-30 16:35:49', 1),
(70, 100, 4, 'Subject Overload Status Update', NULL, '2023-08-30 16:35:56', 1),
(71, 100, 4, 'Subject Overload Status Update', NULL, '2023-08-30 16:35:59', 0),
(72, 62, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-08-31 05:37:47', 1),
(75, 62, 4, 'Cross-Enrollment Status Update', 'Your Application Letter for Cross-Enrollment has been rejected.', '2023-08-31 05:51:28', 1),
(76, 68, 4, 'Academic Shifting Status Update', 'Your Certified Copy of Grades has been rejected.', '2023-08-31 06:12:11', 0),
(77, 68, 4, 'Academic Shifting Status Update', 'Your Certified Copy of Grades (Office copy) has been rejected.', '2023-08-31 06:12:13', 0),
(78, 64, 5, 'Counseling Status Update', 'Your Counseling Appointment with the following reason: \"Other\" and scheduled on September 8, 2023 has been rejected.', '2023-08-31 07:12:02', 0),
(79, 62, 3, 'Request Status Update', 'Your Request for Certificates of Attendance scheduled on August 29, 2023 is ready for pickup.', '2023-08-31 13:07:56', 1),
(80, 62, 3, 'Request Status Update', 'Your Request for Certificates of Attendance scheduled on August 29, 2023 has been rejected for the following reason: \"Insufficient documents submitted, please resubmit..\"', '2023-08-31 13:12:07', 1),
(81, 62, 3, 'Request Status Update', 'Your Request for Certificates of Attendance scheduled on August 29, 2023 has been rejected for the following reason: \"pkisbmt, anlbo.\"', '2023-08-31 13:13:04', 1),
(82, 62, 3, 'Request Status Update', 'Your Request for Certificates of Attendance scheduled on August 29, 2023 has been rejected for the following reason: \"pkisbmt, anlbo slm8.\"', '2023-08-31 13:13:13', 1),
(83, 70, 3, 'Request Status Update', 'Your Request for Completion of Incomplete Grade scheduled on August 31, 2023 is ready for pickup.', '2023-08-31 14:12:14', 1),
(84, 63, 3, 'Request Status Update', 'Your Request for Certificate of General Weighted Average (GWA) scheduled on September 1, 2023 is ready for pickup.', '2023-08-31 15:05:10', 1),
(85, 63, 5, 'Request Status Update', 'Your Request Clearance scheduled on August 31, 2023 has been rejected.', '2023-08-31 15:05:56', 1),
(86, 53, 3, 'Request Status Update', 'Your Request for Informative Copy of Grades scheduled on September 1, 2023 has been rejected for the following reason: \"123.\"', '2023-08-31 15:34:01', 0),
(87, 56, 1, 'Request Equipment Status Update', 'Your request for 2 Curtains scheduled on September 15, 2023 is ready for pickup.', '2023-08-31 16:55:24', 1),
(88, 56, 1, 'Request Equipment Status Update', 'Your request for 2 Curtains scheduled on September 15, 2023 is ready for pickup.', '2023-08-31 16:57:42', 1),
(89, 56, 1, 'Request Equipment Status Update', 'Your request for 2 Curtains scheduled on September 15, 2023 is ready for pickup.', '2023-08-31 17:00:33', 1),
(90, 56, 1, 'Request Equipment Status Update', 'Your request for 5 Chairs scheduled on September 2, 2023 is ready for pickup.', '2023-08-31 17:02:10', 1),
(91, 56, 1, 'Request Equipment Status Update', 'Your request for 2 Curtains scheduled on September 15, 2023 is ready for pickup.', '2023-08-31 17:02:10', 1),
(92, 56, 1, 'Request Equipment Status Update', 'Your request for 5 Chairs scheduled on September 2, 2023 is ready for pickup.', '2023-08-31 17:02:55', 1),
(93, 56, 1, 'Request Equipment Status Update', 'Your request for 2 Curtains scheduled on September 15, 2023 is ready for pickup.', '2023-08-31 17:02:55', 1),
(94, 56, 1, 'Request Equipment Status Update', 'Your request for 5 Chairs scheduled on September 2, 2023 is ready for pickup.', '2023-08-31 17:04:33', 1),
(95, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 08:30 AM to September 1, 2023, 11:30 AM has been approved.', '2023-08-31 17:13:39', 1),
(96, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 08:30 AM to September 1, 2023, 11:30 AM has been approved.', '2023-08-31 17:13:39', 1),
(97, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 08:30 AM to September 1, 2023, 11:30 AM has been rejected.', '2023-08-31 17:14:11', 1),
(98, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 08:30 AM to September 1, 2023, 11:30 AM has been rejected.', '2023-08-31 17:14:11', 1),
(99, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 10:30 AM to September 1, 2023, 11:30 AM has been approved.', '2023-08-31 17:20:22', 1),
(100, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 10:30 AM to September 1, 2023, 11:30 AM has been rejected.', '2023-08-31 17:20:37', 1),
(101, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 21, 2023, 03:00 PM to September 21, 2023, 03:30 PM has been approved.', '2023-08-31 17:26:44', 1),
(102, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 03:30 PM to September 7, 2023, 04:00 PM has been approved.', '2023-08-31 17:26:44', 1),
(103, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 03:30 PM to September 7, 2023, 04:00 PM has been rejected.', '2023-08-31 17:27:02', 1),
(104, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 21, 2023, 02:00 PM to September 25, 2023, 02:00 PM has been approved.', '2023-08-31 17:29:29', 1),
(105, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 13, 2023, 12:00 PM to September 13, 2023, 02:30 PM has been approved.', '2023-08-31 17:31:58', 1),
(106, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 6, 2023, 12:00 PM to September 6, 2023, 01:30 PM has been approved.', '2023-08-31 17:51:09', 1),
(107, 99, 1, 'Request Equipment Status Update', 'Your request for 3 Chairs scheduled on August 30, 2023 has been rejected.', '2023-08-31 18:04:19', 1),
(108, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 21, 2023, 01:30 PM to September 21, 2023, 03:00 PM has been rejected.', '2023-09-01 02:01:14', 1),
(109, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 7, 2023, 03:30 PM to September 13, 2023, 02:00 PM has been rejected.', '2023-09-01 02:01:14', 1),
(110, 56, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 6, 2023, 12:00 PM to September 6, 2023, 01:30 PM has been rejected.', '2023-09-01 02:01:14', 1),
(111, 99, 1, 'Request Equipment Status Update', 'Your request for 1 Chairs scheduled on September 1, 2023 is ready for pickup.', '2023-09-01 03:29:03', 1),
(112, 99, 1, 'Request Equipment Status Update', 'Your request for 6 Digital Scoreboard scheduled on September 2, 2023 is ready for pickup.', '2023-09-01 03:29:17', 1),
(113, 99, 1, 'Request Equipment Status Update', 'Your request for 6 Digital Scoreboard scheduled on September 2, 2023 has been rejected.', '2023-09-01 03:29:59', 1),
(115, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 01:00 PM to September 1, 2023, 03:30 PM has been approved.', '2023-09-01 03:36:18', 1),
(116, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been approved.', '2023-09-01 03:38:00', 1),
(117, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 01:00 PM to September 1, 2023, 03:30 PM has been approved.', '2023-09-01 03:38:00', 1),
(118, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been approved.', '2023-09-01 03:41:23', 1),
(119, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 01:00 PM to September 1, 2023, 03:30 PM has been rejected.', '2023-09-01 03:42:50', 1),
(120, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 01:30 PM to September 2, 2023, 04:30 PM has been rejected.', '2023-09-01 03:42:50', 1),
(121, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been rejected.', '2023-09-01 03:46:30', 1),
(122, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 01:00 PM has been rejected.', '2023-09-01 03:46:30', 1),
(123, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 12:00 PM to September 2, 2023, 04:30 PM has been rejected.', '2023-09-01 03:46:30', 1),
(124, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been approved.', '2023-09-01 03:47:03', 1),
(125, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 01:00 PM has been approved.', '2023-09-01 03:47:03', 1),
(126, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 12:00 PM to September 2, 2023, 04:30 PM has been approved.', '2023-09-01 03:47:03', 1),
(143, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been rejected.', '2023-09-01 13:17:35', 0),
(144, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 01:00 PM has been rejected.', '2023-09-01 13:17:35', 0),
(145, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 12:00 PM to September 2, 2023, 04:30 PM has been rejected.', '2023-09-01 13:17:35', 0),
(146, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been approved.', '2023-09-01 13:17:49', 0),
(147, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 01:00 PM has been approved.', '2023-09-01 13:17:49', 0),
(148, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 12:00 PM to September 2, 2023, 04:30 PM has been approved.', '2023-09-01 13:17:49', 0),
(149, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been approved.', '2023-09-01 13:18:19', 1),
(150, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 01:00 PM has been approved.', '2023-09-01 13:18:19', 0),
(151, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 12:00 PM to September 2, 2023, 04:30 PM has been approved.', '2023-09-01 13:18:19', 1),
(152, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 12:30 PM has been rejected.', '2023-09-01 13:18:34', 0),
(153, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Computer Lab scheduled on September 1, 2023, 12:00 PM to September 1, 2023, 01:00 PM has been rejected.', '2023-09-01 13:18:34', 0),
(154, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 12:00 PM to September 2, 2023, 04:30 PM has been rejected.', '2023-09-01 13:18:34', 1),
(164, 99, 1, 'Facility Appointment Status Update', 'Your appointment for Audio Visual Room scheduled on September 1, 2023, 02:30 PM to September 1, 2023, 03:00 PM has been approved.', '2023-09-01 14:21:46', 1),
(165, 51, 4, 'Grade Accreditation Status Update', 'Your Completion Form has been approved.', '2023-09-01 15:38:01', 1),
(166, 71, 3, 'Request Status Update', 'Your Request for Informative Copy of Grades scheduled on September 1, 2023 has been rejected for the following reason: \"Insufficient documents submitted, please resubmit..\"', '2023-09-01 08:00:48', 1),
(167, 71, 1, 'Facility Appointment Status Update', 'Your appointment for Campus Court scheduled on September 6, 2023, 12:00 PM to September 6, 2023, 03:00 PM has been approved.', '2023-09-01 16:31:32', 1),
(168, 71, 5, 'Counseling Status Update', 'Your Counseling Appointment with the following reason: \"Academic Performance\" and scheduled on September 4, 2023 has been approved.', '2023-09-01 16:35:46', 1),
(169, 71, 5, 'Counseling Status Update', 'Your Counseling Appointment with the following reason: \"Academic Performance\" and scheduled on September 4, 2023 has been approved.', '2023-09-01 16:35:47', 1),
(170, 68, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-09-02 20:24:00', 0),
(171, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-09-03 12:03:38', 0),
(172, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been approved.', '2023-09-03 12:03:40', 0),
(173, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-09-03 12:03:43', 0),
(174, 94, 4, 'Subject Overload Status Update', 'Your Certificate of Registration requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-09-03 12:05:49', 0),
(175, 94, 4, 'Subject Overload Status Update', 'Your Certificate of Registration has been approved.', '2023-09-03 12:06:04', 0),
(176, 94, 4, 'Subject Overload Status Update', 'Your ACE Form requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-09-03 12:06:05', 0),
(177, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been approved.', '2023-09-03 12:11:59', 0),
(178, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been approved.', '2023-09-03 12:14:23', 0),
(179, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-09-03 12:14:24', 0),
(180, 94, 4, 'Subject Overload Status Update', 'Your ACE Form has been approved.', '2023-09-03 12:14:25', 0),
(184, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been approved.', '2023-09-03 12:16:43', 0),
(185, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-09-03 12:16:44', 0),
(186, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-09-03 12:16:47', 0),
(187, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-09-03 12:16:49', 0),
(188, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-09-03 12:16:51', 0),
(189, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been approved.', '2023-09-03 12:18:16', 0),
(190, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-09-03 12:18:17', 0),
(191, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-09-03 12:18:19', 0),
(192, 92, 4, 'Subject Overload Status Update', 'Your ACE Form has been rejected.', '2023-09-03 12:41:13', 0),
(193, 68, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been rejected.', '2023-09-03 13:06:58', 0),
(194, 94, 4, 'Subject Overload Status Update', 'Your Certificate of Registration has been rejected.', '2023-09-03 14:34:19', 0),
(195, 94, 4, 'Grade Accreditation Status Update', 'Your Assessed Fee Receipt has been rejected.', '2023-09-03 14:37:03', 0),
(196, 73, 4, 'Manual Enrollment Status Update', 'Your R Zero Form has been rejected.', '2023-09-03 14:37:14', 0),
(198, 94, 4, 'Grade Accreditation Status Update', 'Your Completion Form has been rejected.', '2023-09-03 14:41:26', 0),
(199, 94, 4, 'Grade Accreditation Status Update', 'Your Assessed Fee Receipt has been rejected.', '2023-09-03 14:41:27', 0),
(200, 94, 4, 'Subject Overload Status Update', 'Your ACE Form has been approved.', '2023-09-03 14:41:33', 0),
(201, 94, 4, 'Subject Overload Status Update', 'Your Certificate of Registration has been approved.', '2023-09-03 14:41:34', 0),
(202, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been approved.', '2023-09-03 14:41:35', 0),
(206, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload has been approved.', '2023-09-04 11:51:52', 0),
(207, 94, 4, 'Subject Overload Status Update', 'Your Request Letter for Overload requires a Face-to-face Evaluation. Please proceed to the Director\'s Office.', '2023-09-04 11:51:53', 0),
(209, 94, 4, 'Cross-Enrollment Status Update', 'Your Application Letter for Cross-Enrollment has been approved.', '2023-09-05 08:04:39', 0),
(210, 94, 4, 'Cross-Enrollment Status Update', 'Your Application Letter for Cross-Enrollment has been approved.', '2023-09-05 08:06:04', 0),
(211, 72, 4, 'Cross-Enrollment Status Update', 'Your Application Letter for Cross-Enrollment has been verified by the office.', '2023-09-05 08:06:05', 0),
(212, 94, 4, 'Cross-Enrollment Status Update', 'Your Application Letter for Cross-Enrollment has been approved.', '2023-09-05 08:06:11', 0),
(213, 72, 4, 'Cross-Enrollment Status Update', 'Your Application Letter for Cross-Enrollment has been verified by the office.', '2023-09-05 08:06:12', 0),
(224, 129, 1, 'Request Equipment Status Update', 'Your request for 1 TV scheduled on November 27, 2023 has been rejected.', '2023-11-23 14:24:33', 0);

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
(9, 58, '5000.00', 'Miscellaneous Fee', '2023-08-27 01:17:27', 6),
(10, 58, '3000.00', 'Tuition Fee', '2023-08-27 05:35:33', 6),
(11, 51, '400.00', 'Miscellaneous Fee', '2023-08-28 03:24:33', 1),
(12, 51, '100.00', 'Miscellaneous Fee', '2023-08-28 04:05:09', 1),
(13, 51, '1000.00', 'Tuition Fee', '2023-08-28 04:57:51', 1),
(14, 84, '500.00', 'Tuition Fee', '2023-08-29 08:42:16', 6),
(15, 84, '1000.00', 'Tuition Fee', '2023-08-29 08:43:19', 1),
(16, 73, '23.00', 'Tuition Fee', '2023-08-29 09:09:09', 7),
(18, 92, '1299.00', 'Miscellaneous Fee', '2023-08-29 10:32:06', 3),
(19, 84, '3000.00', 'Miscellaneous Fee', '2023-08-29 13:41:01', 1),
(20, 62, '9999.99', 'Tuition Fee', '2023-08-30 06:11:29', 6),
(21, 100, '345.00', 'Tuition Fee', '2023-08-30 06:44:42', 1),
(22, 84, '9999.99', 'Tuition Fee', '2023-08-30 09:18:06', 1),
(23, 71, '1245.00', 'Tuition Fee', '2023-08-30 09:24:50', 6),
(24, 108, '5000.00', 'Miscellaneous Fee', '2023-08-30 14:02:21', 1),
(25, 69, '4350.00', 'Tuition Fee', '2023-08-30 16:26:14', 3),
(26, 69, '453.00', 'Tuition Fee', '2023-08-30 16:36:50', 7),
(27, 100, '34.00', 'Miscellaneous Fee', '2023-08-30 16:38:47', 6),
(29, 63, '1000.00', 'Tuition Fee', '2023-08-31 01:55:26', 6),
(30, 108, '9999.00', 'Miscellaneous Fee', '2023-08-31 03:08:11', 1),
(31, 73, '23.00', 'Tuition Fee', '2023-08-31 03:38:01', 1),
(32, 56, '30.00', 'Tuition Fee', '2023-08-31 05:14:00', 6),
(33, 73, '23.00', 'Tuition Fee', '2023-08-31 06:42:40', 1),
(34, 73, '244.00', 'Miscellaneous Fee', '2023-08-31 06:42:53', 6),
(35, 64, '20.00', 'Miscellaneous Fee', '2023-08-31 07:18:33', 6),
(37, 51, '9999.99', 'Miscellaneous Fee', '2023-08-31 12:09:24', 1),
(39, 51, '5000.00', 'Tuition Fee', '2023-09-01 15:45:37', 1);

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
(2, 63, '3c8052e80d7db1d47141ec03de268165458e1ad6487479e18bba74ee355745b8', '2023-08-28 16:14:44'),
(4, 78, NULL, NULL),
(6, 53, '56ef80b920842ccc1b941bcaa1015cca8848afbc55f1b77f7cbb44e0953c1c8f', '2023-08-29 11:17:25'),
(7, 62, NULL, NULL),
(8, 96, '1fae92ae8fa529eeb355c522ef9e7edc63114e8558b61d50f1fc2a0a27a4fb91', '2023-08-31 15:23:13'),
(10, 111, NULL, NULL),
(11, 82, '43dc8922f4d14ac7e2f24f8426bb00915e16fa435615403dc8a803a2910fcdaa', '2023-08-31 03:48:26'),
(12, 70, '70992ab7c721116a7477345e0d91839bed0ef0e71c65608124d25e11dddbc2fe', '2023-08-31 15:20:42');

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
(3, 72, NULL, 'dafsgdhl ', '2023-08-28 10:41:54'),
(4, 91, NULL, 'sgdsgsdgsdgsdfg', '2023-08-29 09:53:46'),
(5, 71, NULL, 'ufftutu', '2023-08-30 06:35:43'),
(6, 70, NULL, 'ggs sir', '2023-08-30 06:37:29'),
(7, 63, NULL, 'ggs goods', '2023-08-30 16:08:51'),
(8, 63, NULL, 'true to life', '2023-08-30 16:12:49'),
(9, 96, NULL, 'ggs ggs', '2023-08-30 16:14:52'),
(10, 56, NULL, 'Nice service, thank you.', '2023-08-31 03:11:39'),
(11, 71, NULL, 'Good service', '2023-09-01 08:04:07');

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

--
-- Dumping data for table `request_equipment`
--

INSERT INTO `request_equipment` (`request_id`, `user_id`, `datetime_schedule`, `quantity_equip`, `status_id`, `purpose`, `equipment_id`, `slip_content`) VALUES
('ROE-1693044670', 52, '2023-08-28 12:30:00', 1, 6, 'basta', 10, NULL),
('ROE-1693283089', 76, '2023-08-30 14:00:00', 2, 6, 'asdasd', 10, NULL),
('ROE-1693366657', 84, '2023-08-31 13:00:00', 1, 6, 'hump day presentation', 20, NULL),
('ROE-1693376122', 62, '2023-08-31 20:00:00', 1, 6, 'lilinis', 16, NULL),
('ROE-1693376266', 62, '2023-08-31 20:00:00', 2, 6, 'nonood', 20, NULL),
('ROE-1693376495', 62, '2023-08-31 20:00:00', 2, 1, 'dalawa baka sumampid yung isa hehe', 3, NULL),
('ROE-1693376614', 53, '2023-08-31 08:30:00', 1, 1, 'Hi klowi, peram po isang upuan. Tnx :))', 8, NULL),
('ROE-1693377695', 100, '2023-09-01 13:00:00', 3, 1, 'Pangligo', 7, NULL),
('ROE-1693378712', 102, '2023-09-08 20:00:00', 10, 5, 'manonood ng jujutsu kaisen', 20, NULL),
('ROE-1693412471', 111, '2023-08-31 14:00:00', 1, 5, 'cddcfff', 5, NULL),
('ROE-1693414518', 111, '2023-08-31 09:00:00', 2, 5, 'ssssss', 8, NULL),
('ROE-1693452867', 64, '2023-09-05 11:00:00', 1, 5, 'nasa marumi po kasi yung amin', 10, NULL),
('ROE-1693463296', 105, '2023-08-31 14:30:00', 1, 5, '121221323', 10, NULL),
('ROE-1693500696', 56, '2023-09-02 08:00:00', 5, 5, 'Event', 8, NULL),
('ROE-1693500820', 56, '2023-09-15 08:30:00', 2, 5, 'Event', 10, NULL),
('ROE-1693533758', 99, '2023-09-01 10:30:00', 2, 5, 'Event', 8, NULL),
('ROE-1693533829', 99, '2023-09-01 16:00:00', 2, 5, 'Event', 8, NULL),
('ROE-1693538561', 99, '2023-09-01 11:30:00', 5, 5, 'Event', 8, NULL),
('ROE-1693538647', 99, '2023-09-01 11:30:00', 1, 4, 'Event', 8, NULL),
('ROE-1693538719', 99, '2023-09-01 11:30:00', 1, 5, 'Event', 10, NULL),
('ROE-1693538801', 99, '2023-09-02 08:30:00', 6, 6, 'Event', 12, NULL),
('ROE-1693556769', 71, '2023-09-06 10:00:00', 3, 5, 'PE SUBJECT', 4, NULL),
('ROE-1700617608', 128, '2023-11-24 15:00:00', 1, 1, 'basta', 1, NULL),
('ROE-1700739826', 130, '2023-11-24 13:00:00', 20, 1, 'lolz\r\n', 8, NULL),
('ROE-1700742349', 129, '2023-11-30 14:00:00', 35, 8, 'Tekken Tournament', 8, NULL),
('ROE-1700744477', 129, '2023-11-30 09:00:00', 1, 8, 'Volleyball syempre', 17, NULL),
('ROE-1700744502', 129, '2023-11-30 15:30:00', 1, 8, 'Movie Marathon\r\n', 20, NULL),
('ROE-1700744527', 129, '2023-11-30 15:30:00', 30, 8, 'Movie Marathon', 8, NULL),
('ROE-1700747873', 130, '2023-11-24 08:00:00', 1, 8, 'Gamer thingz', 14, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_description` text NOT NULL,
  `office_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `isStudent` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `service_name`, `service_description`, `office_id`, `url`, `isStudent`) VALUES
(1, 'Create Request', 'Seeks the registrar office\'s help in requesting related to academic records', 2, 'registrar/create_request.php', 0),
(2, 'Schedule Counseling', 'Schedule an appointment for counseling with the guidance counselor of the campus.', 5, 'guidance/counseling.php', 1),
(3, 'Request Good Moral Document', 'Request for a good moral document for requirement purposes.', 5, 'guidance/good_morals.php', 0),
(4, 'Request Clearance', 'Request and check the status of your academic clearance.', 5, 'guidance/clearance.php', 0),
(5, 'Subject Overload', 'Add additional subject/s more than the prescribed number of units.', 4, 'academic/subject_overload.php', 1),
(6, 'Grade Accreditation', 'For Correction of Grade Entry, Late Reporting of Grades, and Removal of Incomplete Mark.', 4, 'academic/grade_accreditation.php', 1),
(7, 'Cross-Enrollment', 'Enrollment of subject/s at another college or university.', 4, 'academic/cross_enrollment.php', 1),
(8, 'Shifting', 'Shift to another program offered in PUP Santa Rosa.', 4, 'academic/shifting.php', 1),
(9, 'Manual Enrollment', 'Failed to enroll during the online registration period set by the University.', 4, 'academic/manual_enrollment.php', 1),
(10, 'Services in SIS Tools', '(a) ACE Form - Add subjects or change your officially enrolled subjects, (b) Subject Petition/Tutorial - Request for subject not offered in current semester.', 4, 'academic/servicesinsistools.php', 1),
(11, 'Payments', 'Simplify your payments for campus documents', 2, 'accounting/payment1.php', 0),
(12, 'Offsetting', 'Balance your campus accounts.', 2, 'accounting/offsetting1.php', 1),
(13, 'Request of School Equipment', 'Request of equipment inside the campus.', 1, 'administrative/view-equipment.php', 0),
(14, 'School Facility Appointment', 'Request of Facilities for campus event purposes.', 1, 'administrative/view-facility.php', 0);

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
(7, 'Approved'),
(8, 'Cancelled');

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
  `amount` decimal(10,2) DEFAULT NULL,
  `referenceNumber` varchar(20) DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(32) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`payment_id`, `course`, `documentType`, `user_id`, `firstName`, `middleName`, `lastName`, `studentNumber`, `amount`, `referenceNumber`, `image_url`, `transaction_date`, `status`) VALUES
(47, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Correction of Entry of Grade', 52, 'Pedro', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', NULL, NULL, NULL, '2023-08-26 10:24:52', 'Pending'),
(48, 'Bachelor of Science in Information Technology', 'Certified True Copy', 51, 'Perrell', 'Laquarius', 'Brown', '2020-00696-SR-0', NULL, NULL, NULL, '2023-08-26 11:18:16', 'Pending'),
(49, 'Bachelor of Science in Information Technology', 'Certified True Copy', 54, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', NULL, NULL, NULL, '2023-08-26 11:28:40', 'Pending'),
(50, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Processing of Request for Correction of Name: PSA/School Records', 52, 'Pedro', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', NULL, NULL, NULL, '2023-08-26 16:27:26', 'Pending'),
(51, 'Bachelor of Science in Information Technology', 'Certified True Copy', 52, 'Pedro', 'Penduko', 'Dela Cruz', '2020-00001-SR-0', NULL, NULL, NULL, '2023-08-27 07:45:11', 'Pending'),
(52, 'Bachelor of Science in Information Technology', 'Certificate of Attendance', 56, 'Juan', 'Dela Cruz', 'Pedro', '2020-00010-SR-0', NULL, NULL, NULL, '2023-08-27 15:57:17', 'Pending'),
(53, 'Bachelor of Science in Information Technology', 'Certified True Copy', 51, 'Perrell', 'Laquarius', 'Brown', '2020-00696-SR-0', NULL, NULL, NULL, '2023-08-28 03:25:10', 'Pending'),
(54, 'Bachelor of Science in Information Technology', 'Certificate of General Weighted Average (GWA)', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-28 07:15:46', 'Processed'),
(55, 'Bachelor in Secondary Education Major in Filipino', 'Certified True Copy', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-28 07:22:50', 'Rejected'),
(56, 'Bachelor of Science in Information Technology', 'Academic Verification Service', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-28 07:31:25', 'Pending'),
(57, 'Bachelor of Science in Information Technology', 'Academic Verification Service', 54, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', NULL, NULL, NULL, '2023-08-28 08:14:36', 'Processed'),
(58, 'Bachelor of Science in Information Technology', 'Certified True Copy', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-28 08:21:32', 'Pending'),
(59, 'Bachelor of Science in Information Technology', 'Certified True Copy', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-28 08:22:49', 'Processed'),
(60, 'Bachelor of Science in Information Technology', 'Completion of Incomplete Grade', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-28 08:26:07', 'Processed'),
(61, 'Bachelor of Science in Information Technology', 'Certified True Copy', 73, 'First Sample', 'Middle Sample', 'Last Sample', '2020-12345-SR-0', NULL, NULL, NULL, '2023-08-28 08:45:03', 'Pending'),
(62, 'Bachelor of Science in Information Technology', 'Certification, Verification, Authentication (CAV/Apostile)', 73, 'Juan', 'B', 'Diaz', '2020-12345-SR-0', NULL, NULL, NULL, '2023-08-28 09:32:39', 'Pending'),
(63, 'Bachelor of Science in Information Technology', 'Informative Copy of Grades', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-28 09:33:58', 'Rejected'),
(64, 'Bachelor in Secondary Education Major in English', 'Certificate of General Weighted Average (GWA)', 63, 'Hanni', 'Ngoc', 'Pham', '2022-00106-SR-0', NULL, NULL, NULL, '2023-08-28 15:19:18', 'Pending'),
(66, 'Bachelor in Secondary Education Major in English', 'Certificate of General Weighted Average (GWA)', 63, 'Hanni', 'Ngoc', 'Pham', '2022-00106-SR-0', NULL, NULL, NULL, '2023-08-29 03:17:57', 'Pending'),
(67, 'Bachelor of Science in Information Technology', 'Certificate of General Weighted Average (GWA)', 51, 'Perrell', 'Laquarius', 'Brown', '2020-00696-SR-0', NULL, NULL, NULL, '2023-08-29 04:59:10', 'Pending'),
(68, 'Bachelor of Science in Information Technology', 'Certified True Copy', 53, 'Tracia Jean', 'Deligencia', 'Lampiño', '2020-00189-SR-0', NULL, NULL, NULL, '2023-08-29 06:49:29', 'Processed'),
(69, 'Bachelor of Science in Information Technology', 'Certified True Copy', 81, 'Juan', 'Gregorio', 'Dela Cruz', '2020-00111-SR-0', NULL, NULL, NULL, '2023-08-29 07:26:25', 'Pending'),
(70, 'Bachelor of Science in Information Technology', 'Certified True Copy', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-29 08:33:25', 'Pending'),
(71, 'Client', 'Certified True Copy', 86, 'Hannah', '', 'Santiago', NULL, NULL, NULL, NULL, '2023-08-29 08:36:33', 'Processed'),
(72, 'Bachelor of Science in Electronics Engineering', 'Certificate of Graduation', 71, 'Fidel', '', 'Pacheco', '2020-00986-SR-0', NULL, NULL, NULL, '2023-08-29 08:58:40', 'Pending'),
(73, 'Bachelor of Science in Electronics Engineering', 'Transcript of Records (Second and succeeding copies)', 71, 'Fidel', '', 'Pacheco', '2020-00986-SR-0', NULL, NULL, NULL, '2023-08-29 09:11:10', 'Pending'),
(76, 'Bachelor in Secondary Education Major in Mathematics', 'Certificate of General Weighted Average (GWA)', 84, 'Brandon', '', 'Curington', '2020-00470-SR-0', NULL, NULL, NULL, '2023-08-30 03:24:14', 'Pending'),
(77, 'Alumni', 'Transcript of Records (Second and succeeding copies)', 96, 'Montero', '', 'Balluser', NULL, NULL, NULL, NULL, '2023-08-30 05:09:01', 'Pending'),
(78, 'Bachelor in Secondary Education Major in English', 'Certified True Copy', 63, 'Hanni', 'Ngoc', 'Pham', '2022-00106-SR-0', NULL, NULL, NULL, '2023-08-30 05:27:15', 'Processed'),
(79, 'Bachelor in Secondary Education Major in English', 'Application for Graduation SIS and Non-SIS', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-30 05:59:12', 'Rejected'),
(80, 'Bachelor in Secondary Education Major in Filipino', 'Application for Graduation SIS and Non-SIS', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-30 05:59:29', 'Pending'),
(81, 'Bachelor in Secondary Education Major in Mathematics', 'Certificate of Attendance', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-30 05:59:43', 'Processed'),
(82, 'Bachelor in Technology And Livelihood Education Major in Home Economics', 'Certificate of General Weighted Average (GWA)', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-30 06:00:03', 'Processed'),
(83, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Application for Graduation SIS and Non-SIS', 62, 'Sharie', '', 'Uson', '2020-00323-SR-0', NULL, NULL, NULL, '2023-08-30 06:00:12', 'Rejected'),
(84, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Certificate of Graduation', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-30 06:00:20', 'Pending'),
(85, 'Client', 'Completion of Incomplete Grade', 86, 'Hannah', '', 'Santiago', NULL, NULL, NULL, NULL, '2023-08-30 06:02:00', 'Pending'),
(86, 'Alumni', 'Certificate of General Weighted Average (GWA)', 86, 'Hannah', '', 'Santiago', NULL, NULL, NULL, NULL, '2023-08-30 06:04:03', 'Rejected'),
(87, 'Client', 'Certificate of Graduation', 86, 'Hannah', '', 'Santiago', NULL, NULL, NULL, NULL, '2023-08-30 06:04:28', 'Processed'),
(88, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Certificate of Medium of Instruction', 100, 'Yeji', '', 'Hwang', '2020-06969-SR-0', NULL, NULL, NULL, '2023-08-30 06:45:26', 'Pending'),
(89, 'Bachelor of Science in Information Technology', 'Non Issuance of Special Order', 100, 'Yeji', '', 'Hwang', '2020-06969-SR-0', NULL, NULL, NULL, '2023-08-30 06:45:39', 'Pending'),
(90, 'Client', 'Certified True Copy', 101, 'Arkohn', 'Dauan', 'Garapan', NULL, NULL, NULL, NULL, '2023-08-30 06:46:17', 'Pending'),
(91, 'Bachelor of Science in Electronics Engineering', 'Certified True Copy', 71, 'Fidel', '', 'Pacheco', '2020-00986-SR-0', NULL, NULL, NULL, '2023-08-30 06:49:42', 'Pending'),
(92, 'Bachelor of Science in Information Technology', 'Certified True Copy', 54, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', NULL, NULL, NULL, '2023-08-30 06:51:53', 'Pending'),
(93, 'Alumni', 'Late Reporting of Grade', 102, 'Jung', 'K', 'Ook', NULL, NULL, NULL, NULL, '2023-08-30 06:55:47', 'Pending'),
(95, 'Bachelor in Secondary Education Major in Mathematics', 'Certified True Copy', 71, 'Fidel', '', 'Pacheco', '2020-00986-SR-0', NULL, NULL, NULL, '2023-08-30 09:11:56', 'Pending'),
(96, 'Bachelor in Secondary Education Major in Mathematics', 'Informative Copy of Grades', 62, 'Sharie', '', 'Uson', '2020-00323-SR-0', NULL, NULL, NULL, '2023-08-30 09:21:06', 'Pending'),
(97, 'Bachelor of Science in Information Technology', 'Certified True Copy', 54, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', NULL, NULL, NULL, '2023-08-30 10:27:48', 'Pending'),
(98, 'Bachelor of Science in Information Technology', 'Certified True Copy', 54, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', NULL, NULL, NULL, '2023-08-30 11:15:55', 'Pending'),
(99, 'Bachelor of Science in Information Technology', 'Certified True Copy', 73, 'Juan', '', 'Diaz', '2020-12345-SR-0', NULL, NULL, NULL, '2023-08-30 11:36:23', 'Pending'),
(100, 'Bachelor of Science in Information Technology', 'Certified True Copy', 106, 'Marie', 'Mendoza', 'Reyes', '2023-00147-SR-0', NULL, NULL, NULL, '2023-08-30 13:15:17', 'Pending'),
(101, 'Alumni', 'Informative Copy of Grades', 107, 'Juana', 'Mendoza', 'Reyes', NULL, NULL, NULL, NULL, '2023-08-30 13:28:47', 'Pending'),
(102, 'Bachelor of Science in Information Technology', 'Certified True Copy', 54, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', NULL, NULL, NULL, '2023-08-30 13:39:27', 'Pending'),
(103, 'Alumni', 'Certified True Copy', 101, 'Arkohn', 'Dauan', 'Garapan', NULL, NULL, NULL, NULL, '2023-08-30 13:42:15', 'Pending'),
(104, 'Bachelor in Secondary Education Major in English', 'Certified True Copy', 63, 'Hanni', 'Ngoc', 'Pham', '2022-00106-SR-0', NULL, NULL, NULL, '2023-08-30 14:37:16', 'Pending'),
(105, 'Alumni', 'Transcript of Records (Second and succeeding copies)', 96, 'Montero', '', 'Balluser', NULL, NULL, NULL, NULL, '2023-08-30 14:44:01', 'Pending'),
(106, 'Bachelor of Science in Information Technology', 'Certified True Copy', 109, 'Chris Jester ', 'Manalo', 'Buerano', '2020-00878-SR-0', NULL, NULL, NULL, '2023-08-30 15:50:18', 'Pending'),
(107, 'Bachelor of Science in Information Technology', 'Certified True Copy', 109, 'Chris Jester ', 'Manalo', 'Buerano', '2020-00878-SR-0', NULL, NULL, NULL, '2023-08-30 16:00:14', 'Pending'),
(108, 'Bachelor in Secondary Education Major in Mathematics', 'Certified True Copy', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-30 16:36:58', 'Pending'),
(109, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Certificate of General Weighted Average (GWA)', 100, 'Yeji', '', 'Hwang', '2020-06969-SR-0', NULL, NULL, NULL, '2023-08-30 16:38:32', 'Pending'),
(110, 'Client', 'Certified True Copy', 112, 'Chris Jester', 'Manalo', 'Buerano', NULL, NULL, NULL, NULL, '2023-08-31 00:40:25', 'Pending'),
(111, 'Bachelor of Science in Electronics Engineering', 'Certified True Copy', 71, 'Fidel', '666', 'Pacheco', '2020-00986-SR-0', NULL, NULL, NULL, '2023-08-31 02:27:37', 'Pending'),
(112, 'Alumni', 'Transcript of Records (Second and succeeding copies)', 113, 'Gregorio', 'Montemayor', 'Montelucas', NULL, NULL, NULL, NULL, '2023-08-31 02:39:05', 'Pending'),
(113, 'Bachelor of Science in Electronics Engineering', 'Transcript of Records (Copy for Another School)', 71, 'Fidel', '666', 'Pacheco', '2020-00986-SR-0', NULL, NULL, NULL, '2023-08-31 02:39:43', 'Pending'),
(114, 'Bachelor of Science in Electronics Engineering', 'Transcript of Records (Copy for Another School)', 71, 'Fidel', '666', 'Pacheco', '2020-00986-SR-0', NULL, NULL, NULL, '2023-08-31 02:42:07', 'Pending'),
(115, 'Bachelor of Science in Information Technology', 'Certified True Copy', 78, 'John Kenneth', 'Del Rosario', 'Durian', '2020-00344-SR-0', NULL, NULL, NULL, '2023-08-31 02:52:10', 'Pending'),
(116, 'Bachelor of Science in Information Technology', 'Certified True Copy', 56, 'Mary Anne', 'Galero', 'Matos', '2020-00010-SR-0', NULL, NULL, NULL, '2023-08-31 03:12:56', 'Pending'),
(117, 'Bachelor of Science in Information Technology', 'Certified True Copy', 56, 'Mary Anne', 'Galero', 'Matos', '2020-00010-SR-0', NULL, NULL, NULL, '2023-08-31 03:13:29', 'Pending'),
(118, 'Bachelor of Science in Information Technology', 'Processing of Request for Correction of Name: PSA/School Records', 56, 'Mary Anne', 'Galero', 'Matos', '2020-00010-SR-0', NULL, NULL, NULL, '2023-08-31 05:08:16', 'Pending'),
(119, 'Bachelor in Secondary Education Major in Mathematics', 'Transcript of Records (Copy for Another School)', 64, 'Chloie Isabelle', '12345', 'Delas Alas', '2020-00569-SR-0', NULL, NULL, NULL, '2023-08-31 07:07:21', 'Pending'),
(120, 'Bachelor of Science in Business Administration Major in Human Resource Management', 'Processing of Request for Correction of Name: PSA/School Records', 64, 'Chloie Isabelle', '12345', 'Delas Alas', '2020-00569-SR-0', NULL, NULL, NULL, '2023-08-31 07:17:50', 'Pending'),
(122, 'Bachelor in Secondary Education Major in Mathematics', 'Course Accreditation Service (for Transferees)', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-31 08:22:08', 'Pending'),
(123, 'Bachelor of Science in Electronics Engineering', 'Certificate of General Weighted Average (GWA)', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-08-31 08:26:11', 'Pending'),
(124, 'Bachelor of Science in Information Technology', 'Certificate of Graduation', 62, 'Sharie', '', 'Uson', '2020-00323-SR-0', NULL, NULL, NULL, '2023-08-31 13:10:56', 'Pending'),
(125, 'Bachelor of Science in Information Technology', 'Certificate of General Weighted Average (GWA)', 63, 'Hanni', 'Ngoc', 'Pham', '2022-00106-SR-0', NULL, NULL, NULL, '2023-08-31 15:01:39', 'Pending'),
(126, 'Bachelor in Secondary Education Major in English', 'Academic Verification Service', 53, 'Tracia Jean', 'Deligencia', 'Lampiño', '2020-00189-SR-0', NULL, NULL, NULL, '2023-08-31 15:25:54', 'Pending'),
(127, 'Bachelor of Science in Business Administration Major in Marketing Management', 'Informative Copy of Grades', 53, 'Tracia Jean', 'Deligencia', 'Lampiño', '2020-00189-SR-0', NULL, NULL, NULL, '2023-08-31 15:32:08', 'Pending'),
(128, 'Bachelor of Science in Industrial Engineering', 'Certified True Copy', 69, 'Alyca', '', 'Santocildes', '2020-00297-SR-0', NULL, NULL, NULL, '2023-09-01 06:23:38', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `student_record_id` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `year` int(4) NOT NULL,
  `shelf_location` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `student_no` varchar(15) DEFAULT NULL,
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
(51, '2020-00696-SR-0', 'Brown', 'Perrell', 'Laquarius', '', '0908-428-9915', 'pkayumanggi@gmail.com', '2000-10-24', '$2y$10$EmRNlRH67v8PGTBaNHemDuASedPv5l/xbIFh.UXWz6NacoLNm04F6', 1),
(52, '2020-00001-SR-0', 'Dela Cruz', 'Pedro', 'Penduko', '', '0900-123-4567', 'pedropenduko@yahoo.com', '1990-01-01', '$2y$10$imAaOilvTgi1ggLMTQYpMOe0QYmVlTVA7RcKwr/goMhDw85hKlzY6', 1),
(53, '2020-00189-SR-0', 'Lampiño', 'Tracia Jean', 'Deligencia', '', '0975-444-1943', 'traciajeandlampino@gmail.com', '2002-07-12', '$2y$10$rvFNm77gfGLDzFqjGdI0b.07vsJnZ4dgwP8K2t7Pd1Ak2nedY2xsy', 1),
(54, '2020-00585-SR-0', 'Garapan', 'John Mark', 'Dauan', '', '0927-870-9744', 'johnmarkgarapan2@gmail.com', '2023-05-31', '$2y$10$Dh1hJgoJvUYNKvKA6.CQn.klW3T5UXdLpRJksD15JkAeG7B3s889a', 1),
(55, '2020-00000-SR-0', 'Perez', 'Leann', '', '', '0901-234-5678', 'perezleann11@gmail.com', '2002-04-05', '$2y$10$xubkO/1emqPONO6tWS.RguTfNmcVFrv2mDZB.EJLl6fdFKg6ZMqrG', 1),
(56, '2020-00010-SR-0', 'Matos', 'Mary Anne', 'Galero', '', '0987-654-3212', 'juanpedro1@gmail.com', '2002-08-01', '$2y$10$Qy6jKI7uDPzfT2lEn6oj1en6CAdubmbjjc/RRP0soXKCNd3e2sqDO', 1),
(58, '2020-00291-SR-0', 'Sagun', 'Vince Thomas', 'Felix', '', '0945-136-5029', 'vsagun70@gmail.com', '2001-04-24', '$2y$10$UPPvhpNiM6./BXsNbc/.z.UqyNqMZC0bhFAvA8h1dT1z61Yrj8Tfi', 1),
(60, '2020-00015-SR-0', 'Lana', 'Ell', '', '', '0991-328-8567', 'alanaell@gmail.com', '2001-09-14', '$2y$10$oHWRN4stneAHRgtDdwLBwedj.EfEBdbLBm.KRZrqrQsd64f9KM.6S', 1),
(61, NULL, 'isabeele', 'thea', '', '', '0912-231-2123', 'thea@gmail.com', '2001-12-21', '$2y$10$KXXPoqfamRelS1TWLsLvGuj6g7IMGENKkPy9ssrauFXVoeLNz4KBG', 2),
(62, '2020-00323-SR-0', 'Uson', 'Sharie', '', '', '0905-924-2718', 'sharieuson@gmail.com', '2002-07-20', '$2y$10$aCcfvB1q28G8lL.xzlda6uL1w28v1rr2CVk7q9F3F.quIlMA0oZu2', 1),
(63, '2022-00106-SR-0', 'Pham', 'Hanni', 'Ngoc', '', '0910-620-0418', 'njhanni@gmail.com', '2004-10-06', '$2y$10$PBss2dC1Ref6s2kJIrxfAurkwxQKwd.1suaLmsE38SYkLn/dcsVxm', 1),
(64, '2020-00569-SR-0', 'Delas Alas', 'Chloie Isabelle', '12345', '', '0926-622-7625', 'delasalas.isabelle@gmail.com', '2002-04-20', '$2y$10$Mx1AHwRjp1xTA98QkEuS8OoUM4FvMKIp83CkwPTIs2Je5F9lP71Ii', 1),
(65, NULL, 'Delas Alas', 'Isabelle', '', '', '0917-457-0881', 'isabelle@gmail.com', '2002-04-20', '$2y$10$nDSwSN3VggD7fXJN2DiFdes8LTEw8u8Uzfb9NI50VYL7PoUr974RK', 2),
(66, '2023-00221-SR-0', 'Lee', 'Hyun Seo', '', '', '0922-120-0716', 'iveleeseo@gmail.com', '2007-02-21', '$2y$10$7nKvCYK2NmPv5yN/POrpIOwfWlhZkprHLo72Dfg1luz7reKFywiny', 1),
(67, NULL, 'test', 'test ', 'test', '', '0907-743-9227', 'test@gmail.com', '2001-02-21', '$2y$10$P7iZfLgj/V16/aLXe1JsU.fJpAb2Lw3HzQHOaQzKZTvsOgzlwTP8K', 2),
(68, '2020-00884-SR-0', 'Isagon', 'Christian Froilan', 'Lazo', '', '0929-441-7313', 'chrstn.frln21@gmail.com', '2002-01-21', '$2y$10$Ox2TZFQFcLDO934jpZ1BgOQEQOvh9/4FR5usu7Z9WVJ0AXQ8Eba9G', 1),
(69, '2020-00297-SR-0', 'Santocildes', 'Alyca', '', '', '0906-057-5985', 'lykasantocildes@gmail.com', '2002-07-07', '$2y$10$/G8w3MZGCWD.DsYjCRb27.yPF9yXnWgVjIPhfF0Yq1UsVSAuBlYZ6', 1),
(70, '2020-00241-SR-0', 'Oliver', 'Gabriel Angelo', 'Valderrama', '', '0938-026-1940', 'gabrielangelooliver@gmail.com', '2001-10-01', '$2y$10$VrB/RJzYJLtEbTSCc.rFredtvqJzUbvQ66fe3iWnH6eQcdkmKbNQC', 1),
(71, '2020-00986-SR-0', 'Pacheco', 'Fidel', 'Florenzo', '', '0932-732-3823', 'pachecofidel2000@gmail.com', '2000-09-05', '$2y$10$qVK1QMh8XdtOt2EVfFhRs.tP6uabRNMo5VFIHeIYdT4hdAdNL8r6K', 1),
(72, '2018-00494-SR-0', 'mendoza', 'joshua marc', 'santos', '', '0911-222-2222', 'qwe@gmail.com', '1999-04-23', '$2y$10$qlAoFvVrern0gzZFIxkO2.qb8zNGgUEskOlOlulpJ8.huqz1CUJRm', 1),
(73, '2020-12345-SR-0', 'Diaz', 'Juan', '', '', '0912-345-6789', 'sample@gmail.com', '2001-01-01', '$2y$10$Bn0DtQvQVEv.mtPlcTMTa.FdWBuj4EaAgHtQC1gst8urDodL66iz6', 1),
(74, '2020-00887-SR-0', 'Panganiban', 'Pauline Faustina', 'Santos', '', '0935-385-5054', 'paulinee.panganiban@gmail.com', '2002-08-13', '$2y$10$a6KOHWyUC1a7H5PptlBApu3T/E8Vt6NWGAb0ZRSgGM2RRDA0qMLYe', 1),
(76, '2020-12356-SR-0', 'Fanta', 'Rei', 'B.', '', '0946-402-2004', 'reifanta@gmail.com', '2023-08-22', '$2y$10$NoC0c9DwkR2UQ8V4CUnjIukHfWeA7BgzJvpa3.fduicNPzvLVRo2u', 1),
(78, '2020-00344-SR-0', 'Durian', 'John Kenneth', 'Del Rosario', '', '0992-627-7158', 'jakendurs09@gmail.com', '2002-03-30', '$2y$10$qraJkuf2bn9ft8vx3NPliOyIPhYP4HJphkPf00OE.w2cf2d6dnCRa', 1),
(79, '2020-00883-SR-0', 'Geroche', 'Jasper', 'Tarroza', '', '0908-638-4439', 'jaspergeroche1@gmail.com', '2001-10-07', '$2y$10$9urNu.iKeLYAHgYZ1lD.W.1qFns7oEOytNEEct5r0l1OfHCTUNv56', 1),
(80, '2020-00123-SR-0', 'Ramores', 'Karlos', 'Lorenzo', '', '0922-222-2222', 'karlosramores@gmail.com', '2023-03-07', '$2y$10$EUGUxOXLSCSsJQ/RrIJleesKhEDVJ9sNbw5gNhjmAPcXKFa.te/jG', 1),
(81, '2020-00111-SR-0', 'Dela Cruz', 'Juan', 'Gregorio', '', '0911-523-6444', 'juandelacruz123@gmail.com', '2001-01-23', '$2y$10$L3ze4WAZ8Cb4njGLmwZjiOnqtDUNz1kNBO0QEJnyAHhDpFKolmtjK', 1),
(82, '2020-00309-SR-0', 'Galero', 'Mhean', '', '', '0987-654-3212', 'maryanngalero92@gmail.com', '2023-08-28', '$2y$10$S0qv8TddoMO7F7Lc/YSVguL391rM33dWtyk0ESxMmwnthz/.Y26vq', 1),
(84, '2020-00470-SR-0', 'Curington', 'Brandon', '', '', '0906-969-6969', 'thugbarber@gmail.com', '2000-08-15', '$2y$10$Fug9h4VPNgYitABwQkFI0u6jE/3bzPlnApB4he41yVsGxgnG4pRJ.', 1),
(85, NULL, 'Manalo', 'Joseph', '', '', '0987-654-3212', 'josephmanalo345@gmail.com', '2001-08-29', '$2y$10$SqT1kKyt2VAuxXPz4KJ47ezcjvpzSVkqJtlmIopNT4YF5gYo268H2', 2),
(86, NULL, 'Santiago', 'Hannah', '', '', '0926-555-4562', 'hannahsantiago@gmail.com', '2001-07-05', '$2y$10$wdMbHjzhIWCOJC/qSQE2t.yXRQ4n19kK1bRg5V6a1awlP4FEpt7Wq', 2),
(87, NULL, 'Francisco', 'Kathleen Faye', 'Famillaran', '', '0907-743-9226', 'ktlnfrancisco0@gmail.com', '2001-04-02', '$2y$10$YvG2IwD0CdhJrUG3joyw8eUnIx81G7TJdxWeBOQGVFoscU1w0RpVm', 2),
(88, NULL, 'Perez', 'Alex', '', '', '0901-234-5677', 'testclient@gmail.com', '2001-02-28', '$2y$10$5c.wbSpxm5OFHOuBtH7oD.zH5YPbWRn0gUFAwDgvCTg.WrSuEpZH6', 2),
(89, '2020-00990-SR-0', 'Alena', 'Thea', '', '', '0901-111-2341', 'alenathea@gmail.com', '2001-08-16', '$2y$10$Bo.IfKh.ZE5voRECDUzZb.YPQlpSuXh1zfo.kMsFi410dFFUy0JYm', 1),
(90, NULL, 'Cassandra', 'Ishi', '', '', '0901-111-2341', 'cassie@gmail.com', '2001-08-09', '$2y$10$DrGAuqmIc4RdFXkw.ljbVuRDwAT.Y5Z4SwSTlycsB10e1dOXx7B5q', 2),
(91, '2020-00200-SR-0', 'Dela Cruz', 'Juan', 'Dummy', '', '0912-345-6789', 'juandelacruz@gmail.com', '2000-12-25', '$2y$10$LTqkKt1jey4eYHgwmSPXl.A0wHqS.gg4hfNjuhNLXE1VPewcDBFVC', 1),
(92, '2019-00691-SR-0', 'Raymundo', 'Kobe', 'Gudani', '', '0965-779-1154', 'kobegudani@gmail.com', '2000-08-03', '$2y$10$8HVJKlpgzVnMtxGo0hXMye5y/EAjPZCA52Ttp73vm0bdOn3PjQcZO', 1),
(93, NULL, 'David', 'Kim', '', '', '0911-234-5678', 'junkyujean@gmail.com', '2001-09-09', '$2y$10$xC540zim7z1cUyXlTJkHl.WR/QWeFmVERH66dfmdz.SZIOIijfW9q', 2),
(94, '2014-00169-SR-0', 'Balocon', 'Owen Harvey', '', '', '0956-911-6545', 'oh.balocon@pup.edu.ph', '2001-10-02', '$2y$10$WUzoytoDSwvpW0xQB1HxD.kkI1tyjsDl1H6dINQW/fBEYj2DArsuK', 1),
(96, NULL, 'Balluser', 'Montero', '', '', '0908-654-3210', 'monteroballuser@gmail.com', '1998-02-12', '$2y$10$lq3Qrc/8lTwJrWh9K6hr2uLR9ko2trYLSGe2UoqXv//N1Sw4vEmcm', 2),
(99, NULL, 'Galero', 'Anne', '', '', '0987-654-3212', 'annegalero9@gmail.com', '2001-08-30', '$2y$10$2cJB6UE4nVyScpSe.fnsoONpc2PTsj9vi6GoSjZS8v7WUTR4uxVLC', 2),
(100, '2020-06969-SR-0', 'Hwang', 'Yeji', '', '', '0969-696-9554', 'hwangyeji@gmail.com', '2000-05-26', '$2y$10$GuQgiiotd2IolUef8SqdtOJzpXGDkxtmJWFzMFrL3KwZ/ORcMK3U.', 1),
(101, NULL, 'Garapan', 'Arkohn', 'Dauan', '', '0901-234-5678', 'arkohn@gmail.com', '2020-11-02', '$2y$10$QhIdyKh8pwkXmrdkmyglg.nHFUnJLNrrF.IUinCTU3sjGGRRHE9Wm', 2),
(102, NULL, 'Ook', 'Jung', 'K', 'Jr.', '0999-999-9999', 'shxrieau20@gmail.com', '1918-01-20', '$2y$10$Ymcvs4aKE7J8S.2HzEWSeuvP5REotqYTkgzqDXcQyPDFlkrqf6lJS', 2),
(103, '2020-00238-SR-0', 'Nuque', 'Christian Erwin', '', '', '0912-345-6789', 'christian@hotmail.com', '2000-06-11', '$2y$10$P8aHS5b.RESdSPHkjzG3ceJVBEP8SXbaF0Vz/tjN1e5XbtO1H6Vja', 1),
(105, '2020-00183-SR-0', 'Linberg', 'Daisy', 'Pushing', '', '0931-231-2312', 'lindbergmainlodi@gmail.com', '2002-01-22', '$2y$10$9Y9EXlIDAuPAknIDsHZZ2O62sebnQyChkHyZBgnmOml80AhwjnCGS', 1),
(106, '2023-00147-SR-0', 'Reyes', 'Marie', 'Mendoza', '', '0911-523-6444', 'mariereyes147@gmail.com', '2001-10-25', '$2y$10$3HXLZFwcw6/JpwXh.WBnsOz25gRQSVUTEF.LDhQiBHzmtVtGle2eC', 1),
(107, NULL, 'Reyes', 'Juana', 'Mendoza', '', '0911-523-6444', 'juanareyes123@gmail.com', '2001-10-25', '$2y$10$AQC9W.MQff0yVOiC7UoQ4uVwxKyyQZGualBpCnvl8AHB.itnderGC', 2),
(108, '2020-00290-SR-0', 'Rahma', 'Bunda', '', '', '0945-136-5029', 'abundarahma@gmail.com', '2002-04-26', '$2y$10$0Mr/twPSRUHcYh5jfC9J1uGmAYgJlse5RAJm3ALJZuMhIrv0t4Ajq', 1),
(109, '2020-00878-SR-0', 'Buerano', 'Chris Jester ', 'Manalo', '', '0995-355-8682', 'izayoi.07ye@gmail.com', '2001-01-07', '$2y$10$7Ky4.006ObJvWKissHiC/umOzFy9pyydySQwi76ROhuRHPmM4dzEO', 1),
(111, '2020-00940-SR-0', 'Saligumba', 'April Rose Esmolo', 'o', '', '0981-538-0411', 'aprilrosesaligumba05@gmail.com', '2008-04-17', '$2y$10$qUr0Y25Wt9tD/zFC/89Qfuj7pZxZR5lzf5IL9eWeRbzQ.5MZljhyO', 1),
(112, NULL, 'Buerano', 'Chris Jester', 'Manalo', '', '0995-355-8682', 'moonhaloglow@gmail.com', '2001-01-07', '$2y$10$C/iKBTsd.IfrlOsuMfVAAO5NthMM9yMzRK.o6q58tW63OOpARIVsC', 2),
(113, NULL, 'Montelucas', 'Gregorio', 'Montemayor', 'II', '0932-563-9830', 'gregoriomm@gmail.com', '1997-12-12', '$2y$10$D1SzBKSsxN.6mD1lQRLyteYHB4yD.PAtuM2I4Gj9IpGOi9Z9z/uzm', 2),
(115, NULL, 'Ami', 'Dani', '', '', '0901-000-0000', 'danitest@gmail.com', '2000-03-05', '$2y$10$1x/WObKQadZHN7dVhBqtU.TWmfyTZnM/m5XpdXUoP8G8zu1GXiUaG', 2),
(116, NULL, 'Lindberg', 'Daisy', '', '', '0900-000-0000', 'daisylindberg@gmail.com', '2000-01-01', '$2y$10$ekwnRN.ErL/Fw2wZA2w/neDdKiXUjfFtTsOd0DzPV.BDsvkaVvBKi', 2),
(128, '2020-00201-SR-0', 'Malabanan', 'Joshua', 'Gonzales', '', '0908-775-6313', 'phyrozz70@gmail.com', '2001-08-27', '$2y$10$CLC.zm.yz78bCGp/bBxoQeOdPbk8vmOlS4YpTJXRxwn4Mo5EYP2cm', 1),
(129, '2020-00251-SR-0', 'Pasasadaba', 'Brian Cyber', 'R.', '', '0949-593-1396', 'brian.pasasadaba@gmail.com', '2002-03-01', '$2y$10$avDsdHWP5XVbyTKXF3PKPeae4nh84iM.DaYlDmXC3MxRAvux7A.1i', 1),
(130, NULL, 'Pasasadaba', 'Carl', 'Rayo', '', '0949-593-1396', 'carl.pasasadaba@gmail.com', '2005-06-03', '$2y$10$YcLeDY4ZTX.JUf7lFWwW4.7AGcPBHQt2AGcWtNgRwzFKIQNYdxyeG', 2);

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
  `avatar_url` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_detail_id`, `sex`, `home_address`, `province`, `city`, `barangay`, `zip_code`, `course_id`, `year_and_section`, `avatar_url`, `user_id`) VALUES
(12, 1, 'Blk 19 Lot 22 Adelfa St. Alfonso Homes 2', 'LAGUNA', 'SANTA ROSA CITY', 'Sinalhan', '4026', 8, '3-1', 'assets/uploads/profile_pictures/perrell.jpg', 51),
(13, 1, 'Biringan', 'TAWI-TAWI', 'SAPA-SAPA', '1', '1234', 8, NULL, NULL, 52),
(14, 1, 'Southvile IV', 'LAGUNA', 'SANTA ROSA CITY', 'Caingin', '4026', 8, '4-1', 'assets/uploads/profile_pictures/my_melody.jpg', 53),
(15, 1, 'Sample', 'LAGUNA', 'SAN PEDRO CITY', 'Sample', '4023', 8, '3-1', NULL, 54),
(16, 1, 'aa', 'LAGUNA', 'CAVINTI', 'asads', '4026', 8, NULL, NULL, 55),
(17, 1, 'Block 1 Lot 2 123 Street', 'LAGUNA', 'SANTA ROSA CITY', 'Balibago', '4026', 8, '3-1', 'assets/uploads/profile_pictures/download.jpg', 56),
(19, 1, 'Blk 16 Lot 20 Caballero St. Alfonso Homes 2', 'LAGUNA', 'SANTA ROSA CITY', 'Sinalhan', '4026', 8, NULL, NULL, 58),
(21, 0, '1777 Purok 1', 'LAGUNA', 'SANTA ROSA CITY', 'Dila', '4026', 8, NULL, NULL, 60),
(22, 0, '12123', 'LAGUNA', 'SANTA ROSA CITY', 'jdsa', '4026', 12, NULL, NULL, 61),
(23, 0, 'Phase 3 Milagrosa, Carmona, Cavite', 'CAVITE', 'CARMONA', 'MILAGROSA', '4116', 8, NULL, NULL, 62),
(24, 1, '0339 Sampaguita Street, Maribel Subdivision', 'LAGUNA', 'CITY OF BIÑAN', 'Canlalay', '4024', 4, '2-1', 'assets/uploads/profile_pictures/received_995270008262460.jpeg', 63),
(25, 0, 'tagapo', 'LAGUNA', 'SANTA ROSA CITY', 'tagapo', '4026', 8, '3-1', NULL, 64),
(26, 0, 'tagapo', 'LAGUNA', 'SANTA ROSA CITY', 'tagapo', '4026', 12, NULL, NULL, 65),
(27, 0, 'Sitio Camachile', 'LAGUNA', 'CITY OF BIÑAN', 'Dela Paz', '4024', 3, '1-1', 'assets/uploads/profile_pictures/hls.jpg', 66),
(28, 0, 'labas', 'LAGUNA', 'SANTA ROSA CITY', 'labas', '2000', 12, NULL, NULL, 67),
(29, 1, '140', 'LAGUNA', 'SANTA ROSA CITY', 'Aplaya', '2026', 8, NULL, NULL, 68),
(30, 0, 'Block 6 Lot 35', 'CAVITE', 'SILANG', 'Tartaria', '', 8, NULL, NULL, 69),
(31, 1, '# 140 B Redimano St. Landayan', 'LAGUNA', 'SAN PEDRO CITY', 'Landayan', '4023', 8, NULL, 'assets/uploads/profile_pictures/inbound549189286540426905.jpg', 70),
(32, 1, '1356', 'LAGUNA', 'SANTA ROSA CITY', 'Dila', '4026', 1, '3-1', 'assets/uploads/profile_pictures/IMG_20230327_180416 - Malabanan, Joshua G..jpg', 71),
(33, 1, 'qwe', 'LAGUNA', 'SANTA ROSA CITY', 'qwe', '4026', 8, NULL, NULL, 72),
(34, 1, 'sample@gmail.com', 'ILOCOS NORTE', 'LAOAG CITY', 'sample', '4026', 8, '3-1', NULL, 73),
(35, 0, 'B1 L1 MABOLO ST. EAST DRIVE VILLAGE, BRGY. POOC, STA. ROSA LAGUNA', 'LAGUNA', 'SANTA ROSA CITY', 'POOC', '4026', 8, NULL, NULL, 74),
(37, 1, 'Biringan', 'LANAO DEL SUR', 'LUMBACA-UNAYAN', 'Biringan', '4024', 10, NULL, NULL, 76),
(39, 1, '0339 Sampaguita St., Maribel Subdivision', 'LAGUNA', 'CITY OF BIÑAN', 'Canlalay', '4024', 8, '3-1', NULL, 78),
(40, 1, '1111 Amparo St.', 'NATIONAL CAPITAL REGION - FOURTH DISTRICT', 'CITY OF MUNTINLUPA', 'Poblacion', '1776', 8, NULL, NULL, 79),
(41, 1, 'Amihan subd.', 'LAGUNA', 'SANTA ROSA CITY', 'Tiongco', '4024', 8, NULL, NULL, 80),
(42, 1, 'St. Francis Homes 8', 'LAGUNA', 'SANTA ROSA CITY', 'Brgy. Pooc', '4026', 8, NULL, NULL, 81),
(43, 0, 'Block 1 Lot 2 123 Street', 'LAGUNA', 'SANTA ROSA CITY', 'Pooc', '4026', 8, NULL, NULL, 82),
(45, 1, 'Blk 19 Lot 22 Adelfa St. Alfonso Homes 2', 'LAGUNA', 'SANTA ROSA CITY', 'Sinalhan', '4026', 6, '3-1', NULL, 84),
(46, 1, 'Blk 9 Lot 2', 'LAGUNA', 'SANTA ROSA CITY', 'CAINGIN', '4026', 12, NULL, NULL, 85),
(47, 0, 'Imperial Homes', 'PAMPANGA', 'ANGELES CITY', 'Tartaria', '', 12, NULL, NULL, 86),
(48, 0, 'celina plains', 'LAGUNA', 'SANTA ROSA CITY', 'labas', '4026', 12, NULL, NULL, 87),
(49, 1, 'aaas', 'LA UNION', 'BALAOAN', 'asads', '', 12, NULL, NULL, 88),
(50, 0, '1777 Purok 1', 'LAGUNA', 'SANTA ROSA CITY', 'Dila', '4026', 8, NULL, NULL, 89),
(51, 0, '1777 Purok 1', 'LAGUNA', 'SANTA ROSA CITY', 'Dila', '4026', 12, NULL, NULL, 90),
(52, 1, '47 San Luis St.', 'LAGUNA', 'SAN PEDRO CITY', 'Landayan', '4023', 8, NULL, NULL, 91),
(53, 1, '19 Manuel L. Quezon St.', 'LAGUNA', 'SAN PEDRO CITY', 'Pacita 1', '4023', 8, NULL, NULL, 92),
(54, 1, 'Lamanok Island', 'BOHOL', 'ANDA', 'Badiang', '', 12, NULL, 'assets/uploads/profile_pictures/Emilio_Aguinaldo.jpg', 93),
(55, 1, 'No 54 Sitio Watawat', 'LAGUNA', 'CALAMBA CITY', 'Lecheria', '4027', 8, NULL, NULL, 94),
(57, 1, 'Garnet Street', 'LAGUNA', 'MAJAYJAY', 'Masapa', '4035', 12, NULL, NULL, 96),
(60, 0, 'Blk 9 Lot 3', 'LAGUNA', 'SANTA ROSA CITY', 'CAINGIN', '4026', 12, NULL, 'assets/uploads/profile_pictures/download.jpg', 99),
(61, 0, 'Jeonju', 'NATIONAL CAPITAL REGION - SECOND DISTRICT', 'QUEZON CITY', 'Korea', '', 2, NULL, NULL, 100),
(62, 1, 'sas', 'SOUTHERN LEYTE', 'BONTOC', 'sas', '1234', 12, NULL, NULL, 101),
(63, 1, 'etivac kung nasaan ang mga adik ', 'IFUGAO', 'MAYOYAO', '#$%^&$%&$^*%*(%*%^*%', '999999', 12, NULL, NULL, 102),
(64, 1, 'Marketers', 'LAGUNA', 'SANTA ROSA CITY', 'Areas', '', 8, NULL, NULL, 103),
(66, 0, '612 Diamond St. Tiongco Subdivision Brgy. Tagapo', 'LAGUNA', 'SANTA ROSA CITY', 'Tagapo', '4026', 7, NULL, NULL, 105),
(67, 0, 'St. Francis Homes 8', 'LAGUNA', 'CITY OF BIÑAN', 'Brgy. Pooc', '4026', 8, NULL, NULL, 106),
(68, 0, 'St. Francis Homes 8', 'LAGUNA', 'CITY OF BIÑAN', 'Brgy. Pooc', '4026', 12, NULL, NULL, 107),
(69, 1, 'Celina Homes 5', 'LAGUNA', 'SANTA ROSA CITY', 'Tagapo', '4026', 9, NULL, NULL, 108),
(70, 1, 'Blk 7 Lot 19 Bently St., Garden Villas ', 'LAGUNA', 'SANTA ROSA CITY', 'Labas', '4026', 8, NULL, 'assets/uploads/profile_pictures/IMG_20230508_151944.jpg', 109),
(72, 0, 'blk 13 lot 1 mercury street', 'LAGUNA', 'SANTA ROSA CITY', 'Malusak', '4026', 8, NULL, NULL, 111),
(73, 1, 'blk 7 lot 19', 'LAGUNA', 'SANTA ROSA CITY', 'labas', '4026', 12, NULL, NULL, 112),
(74, 1, 'Mahogany Street, Sampaguita Village', 'AURORA', 'DINALUNGAN', 'Maliliw', '4036', 12, NULL, NULL, 113),
(76, 1, 'aasd', 'NUEVA ECIJA', 'GUIMBA', 'asds', '', 12, NULL, NULL, 115),
(77, 1, 'Daisy Lindberg\'s Garden', 'LAGUNA', 'SANTA ROSA CITY', 'Tagapo', '4026', 12, NULL, NULL, 116),
(89, 1, 'Blk. 14, Lot 2, Phase 2, St. Agata Homes Subdivision', 'LAGUNA', 'SANTA ROSA CITY', 'Dita', '4026', 8, '3-1', NULL, 128),
(90, 1, 'B20 L46 PH2 SAN ISIDRO HEIGHTS SUBD', 'LAGUNA', 'CABUYAO CITY', 'Banlic', '4025', 8, '4-1', NULL, 129),
(91, 1, 'B20 L46 PH2 SAN ISIDRO HEIGHTS SUBD', 'LAGUNA', 'CABUYAO CITY', 'Banlic', '4025', 12, NULL, NULL, 130);

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
-- Indexes for table `acad_cross_enrollment`
--
ALTER TABLE `acad_cross_enrollment`
  ADD PRIMARY KEY (`so_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `acad_cross_enrollment_ibfk_2` (`application_letter_status`);

--
-- Indexes for table `acad_feedbacks`
--
ALTER TABLE `acad_feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

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
-- Indexes for table `acad_survey`
--
ALTER TABLE `acad_survey`
  ADD PRIMARY KEY (`survey_id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `guidance_feedbacks`
--
ALTER TABLE `guidance_feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `office_id` (`office_id`);

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
  ADD KEY `course_id` (`course_id`);

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
-- AUTO_INCREMENT for table `acad_cross_enrollment`
--
ALTER TABLE `acad_cross_enrollment`
  MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `acad_feedbacks`
--
ALTER TABLE `acad_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `acad_grade_accreditation`
--
ALTER TABLE `acad_grade_accreditation`
  MODIFY `ga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `acad_manual_enrollment`
--
ALTER TABLE `acad_manual_enrollment`
  MODIFY `me_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `acad_shifting`
--
ALTER TABLE `acad_shifting`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `acad_status`
--
ALTER TABLE `acad_status`
  MODIFY `academic_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `acad_subject_overload`
--
ALTER TABLE `acad_subject_overload`
  MODIFY `so_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `acad_survey`
--
ALTER TABLE `acad_survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `administrative_feedbacks`
--
ALTER TABLE `administrative_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `guidance_feedbacks`
--
ALTER TABLE `guidance_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `offsettingtb`
--
ALTER TABLE `offsettingtb`
  MODIFY `offsetting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `personal_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrar_feedbacks`
--
ALTER TABLE `registrar_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

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
-- Constraints for table `acad_survey`
--
ALTER TABLE `acad_survey`
  ADD CONSTRAINT `acad_survey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `appointment_facility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_facility_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_facility_ibfk_3` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`facility_id`) ON DELETE CASCADE;

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
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `request_equipment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_equipment_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_equipment_ibfk_3` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`) ON DELETE CASCADE;

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
-- Constraints for table `student_record`
--
ALTER TABLE `student_record`
  ADD CONSTRAINT `student_record_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

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
