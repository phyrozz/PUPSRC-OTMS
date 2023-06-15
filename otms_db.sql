-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 05:49 PM
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
-- Database: `otms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `office_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `users_id`, `office_id`) VALUES
(1, 7, 5);

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
(1, 34, 3, 'BSEM', '3-2', '2023-06-13 15:00:00', '2023-06-13 17:00:00', 'mmallow624@gmail.com', 'seminar', 9),
(2, 34, 3, 'BSIT', '3-1', '2023-06-14 10:30:00', '2023-06-14 15:30:00', 'mmallow624@gmail.com', 'classes', 4),
(3, 34, 3, 'BSBAMM', '2-2', '2023-06-14 09:30:00', '2023-06-14 16:00:00', 'mmallow624@gmail.com', 'seminar', 27),
(4, 34, 3, 'BSEM', '3-2', '2023-06-14 13:30:00', '2023-06-14 14:00:00', 'mmallow624@gmail.com', 'seminar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `users_id`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `counseling_schedules`
--

CREATE TABLE `counseling_schedules` (
  `counseling_id` int(11) NOT NULL,
  `appointment_description` varchar(255) DEFAULT NULL,
  `doc_requests_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `counseling_schedules`
--

INSERT INTO `counseling_schedules` (`counseling_id`, `appointment_description`, `doc_requests_id`) VALUES
(9, NULL, 27),
(10, NULL, 28),
(11, NULL, 29),
(12, NULL, 30),
(13, NULL, 31),
(14, NULL, 32),
(15, NULL, 33),
(16, NULL, 34),
(17, NULL, 35),
(18, NULL, 36),
(19, NULL, 37),
(20, NULL, 38),
(21, NULL, 39),
(22, NULL, 40),
(23, NULL, 41),
(24, NULL, 42);

-- --------------------------------------------------------

--
-- Table structure for table `doc_requests`
--

CREATE TABLE `doc_requests` (
  `request_id` int(11) NOT NULL,
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
(27, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(28, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(29, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(30, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(31, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(32, NULL, '2023-06-16 01:00:00', 5, 31, 3, '0.00', ''),
(33, NULL, '2023-06-16 01:00:00', 5, 31, 3, '0.00', ''),
(34, NULL, '2023-06-04 08:00:00', 5, 31, 3, '0.00', ''),
(35, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(36, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(37, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(38, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(39, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(40, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(41, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', ''),
(42, NULL, '0000-00-00 00:00:00', 5, 31, 3, '0.00', '');

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
(1, 'Badminton Net', 'Available', 2, 2, 1),
(2, 'Badminton Racket', 'Available', 15, 2, 1),
(3, 'Badminton Shuttlecock', 'Available', 18, 2, 1),
(4, 'Basketball', 'Available', 10, 2, 1),
(5, 'BasketBall Ring and Net', 'Available', 20, 2, 1),
(6, 'Brush', 'Available', 20, 3, 1),
(7, 'Bucket', 'Available', 15, 3, 1),
(8, 'Chairs', 'Available', 2, 1, 1),
(9, 'Cleaning Detergent', 'Available', 20, 3, 1),
(10, 'Curtains', 'Available', 5, 1, 1),
(11, 'Chess Board', 'Available', 20, 2, 1),
(12, 'Digital Scoreboard', 'Available', 18, 1, 1),
(13, 'Mop', 'Available', 10, 3, 1),
(14, 'Projectors', 'Available', 20, 1, 1),
(15, 'Scoreboard', 'Available', 2, 2, 1),
(16, 'Vacuum', 'Available', 20, 3, 1),
(17, 'Volleyball', 'Available', 6, 2, 1),
(18, 'Volleyball Net', 'Available', 3, 2, 1),
(19, 'Tables', 'Available', 10, 1, 1),
(20, 'TV', 'Available', 18, 1, 1);

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
(4, 'Room 104', 'Unavailable', '104', 1, 1),
(5, 'Room 105', 'Available', '105', 1, 1),
(6, 'Room 106', 'Available', '106', 1, 1),
(7, 'Room 107', 'Available', '107', 1, 1),
(8, 'Room 108', 'Available', '108', 1, 1),
(9, 'Room 109', 'Unavailable', '109', 1, 1),
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
(27, 'Audio Visual Room', 'Unavailable', '307', 3, 1),
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
(1, 34, '2023-06-13 15:00:00', 2, 3, 'mmallow624@gmail.com', 'asd12asd', 12),
(2, 34, '2023-06-13 15:00:00', 2, 3, 'mmallow624@gmail.com', 'room purposes', 20),
(3, 34, '2023-06-13 14:00:00', 2, 3, 'mmallow624@gmail.com', 'sports purposes', 3),
(4, 34, '2023-06-14 12:30:00', 2, 3, 'mmallow624@gmail.com', 'for p.e purposes', 1);

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
(1, 'Approved'),
(2, 'Disapproved'),
(3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `student_no` varchar(15) NOT NULL,
  `is_complete` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `users_id`, `student_no`, `is_complete`) VALUES
(1, 1, '2020-01234-SR-0', 0),
(2, 2, '2020-00329-SR-0', 0),
(3, 3, '2020-00189-SR-0', 0),
(4, 4, '2020-00984-SR-0', 0),
(5, 5, '2020-00104-SR-0', 0);

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
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `extension_name` varchar(11) DEFAULT NULL,
  `contact_no` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_no`, `last_name`, `first_name`, `middle_name`, `extension_name`, `contact_no`, `email`, `password`, `user_role`) VALUES
(1, '', 'Cruz', 'Juan', 'Dela', NULL, '09012345678', 'jdelacruz@gmail.com', NULL, 1),
(2, '', 'Rosario', 'Anna', 'Lampara', NULL, '09056328999', 'anna122L@yahoo.com', NULL, 1),
(3, '', 'Malabanan', 'Isaac', 'Dane', 'Jr.', '09054429918', 'malabanan2222@gmail.com', NULL, 1),
(4, '', 'Austria', 'Skyler Jorden', 'Calapatia', NULL, '09025571297', 'skylerwhitey0@yahoo.com', NULL, 1),
(5, '', 'Belloso', 'Collin', 'Magat', NULL, '09010110590', 'bestnn_2021@gmail.com', NULL, 1),
(6, '', 'Reyes', 'Nataniel Urbano', 'Ynaya', NULL, '09087310002', 'urban_011@yahoo.com', NULL, 2),
(7, '', 'Lorenzo', 'Vincente Dylan', 'Dioquino', NULL, '09051128492', 'vincente_999@yahoo.com', NULL, 3),
(28, '2020-00201-SR-0', 'Malabanan', 'Joshua', 'Gonzales', '', '09087756313', 'joshuamalabanan70@gmail.com', '$2y$10$Tzsuk4BMbLY5ewMILCTTdeIk2/ufNWTbWQzOZcLlsH8Iy/LQmaC8a', 1),
(31, '2020-00200-SR-0', 'Shandra', 'Miki', 'Brawl', 'Jr.', '09464032004', 'mmallow624@gmail.com', '$2y$10$orJgdEoFs1G066jHzilA4Or/WrvzNj8HDJVBk6pcJBtMhguQ6MlbG', 1),
(32, '2021-0220-SR-0', 'Shanks', 'Akagami', 'B', NULL, '09464032005', 'bussinbaldes@gmail.com', '$2y$10$TlnTlMSObrJ7NG4WtG3KJu/ZpcIZwieyJfcCnlt4Ap5LQROZG4Z5a', 1),
(34, '2020-02000-SR-0', 'Capybara', 'Miki', 'S.', 'Jr', '09645231215', 'mixelsynth@gmail.com', '$2y$10$gZQbuR7zYWdQp42zrji0eO/M0BST6N.463mNY5vaeYn3FAntH/SDm', 1);

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
(1, 'students'),
(2, 'clients'),
(3, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_admins_offices1_idx` (`office_id`),
  ADD KEY `fk_admins_users1_idx` (`users_id`);

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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_students_users1_idx` (`users_id`);

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
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  MODIFY `counseling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `doc_requests`
--
ALTER TABLE `doc_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `personal_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_equipment`
--
ALTER TABLE `request_equipment`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `student_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  ADD CONSTRAINT `fk_admins_offices1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_admins_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `appointment_facility`
--
ALTER TABLE `appointment_facility`
  ADD CONSTRAINT `appointment_facility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_3` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`facility_id`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_clients_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `counseling_schedules`
--
ALTER TABLE `counseling_schedules`
  ADD CONSTRAINT `fk_schedules_doc_requests1` FOREIGN KEY (`doc_requests_id`) REFERENCES `doc_requests` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doc_requests`
--
ALTER TABLE `doc_requests`
  ADD CONSTRAINT `fk_doc_requests_offices1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doc_requests_statuses1` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doc_requests_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`equipment_type_id`);

--
-- Constraints for table `facility`
--
ALTER TABLE `facility`
  ADD CONSTRAINT `facility_ibfk_1` FOREIGN KEY (`facility_type_id`) REFERENCES `facility_type` (`facility_type_id`);

--
-- Constraints for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD CONSTRAINT `personal_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

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
  ADD CONSTRAINT `fk_services_office_id1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student_record`
--
ALTER TABLE `student_record`
  ADD CONSTRAINT `fk_student_record_students1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_roles1` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`user_role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
