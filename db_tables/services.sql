-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 08:01 PM
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
(1, 'Create Request', 'Seeks the registrar office\'s help in requesting related to academic records', 2, '/student/registrar/create_request.php'),
(2, 'Schedule Counseling', 'Schedule an appointment for counseling with the guidance counselor of the campus.', 5, '/student/guidance/counseling.php'),
(3, 'Request Good Moral Document', 'Request for a good moral document for requirement purposes.', 5, '/student/guidance/good_morals.php'),
(4, 'Request Clearance', 'Request and check the status of your academic clearance.', 5, '/student/guidance/clearance.php'),
(5, 'Subject Overload', 'Add additional subject/s more than the prescribed number of units.', 4, '/student/academic/subject_overload.php'),
(6, 'Grade Accreditation', 'For Correction of Grade Entry, Late Reporting of Grades, and Removal of Incomplete Mark.', 4, '/student/academic/grade_accreditation.php'),
(7, 'Cross-Enrollment', 'Enrollment of subject/s at another college or university.', 4, '/student/academic/cross_enrollment.php'),
(8, 'Shifting', 'Shift to another program offered in PUP Santa Rosa.', 4, '/student/academic/shifting.php'),
(9, 'Manual Enrollment', 'Failed to enroll during the online registration period set by the University.', 4, '/student/academic/manual_enrollment.php'),
(10, 'Services in SIS Tools', '(a) ACE Form - Add subjects or change your officially enrolled subjects, (b) Subject Petition/Tutorial - Request for subject not offered in current semester.', 4, '/student/academic/servicesinsistools.php'),
(11, 'Payments', 'Simplify your payments for campus documents', 2, '/student/accounting/payment1.php'),
(12, 'Offsetting', 'Balance your campus accounts.', 2, '/student/accounting/offsetting1.php'),
(13, 'Request of School Equipment', 'Request of equipment inside the campus.', 1, '/student/administrative/view-equipment.php'),
(14, 'School Facility Appointment', 'Request of Facilities for campus event purposes.', 1, '/student/administrative/view-facility.php');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_id`),
  ADD KEY `office_id` (`office_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_services_office_id1` FOREIGN KEY (`office_id`) REFERENCES `offices` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
