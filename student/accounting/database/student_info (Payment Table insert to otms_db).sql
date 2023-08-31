-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 05:47 PM
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

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`course`, `documentType`, `payment_id`, `firstname`, `middlename`, `surname`, `studentNumber`, `amount`, `referenceNumber`, `image_url`, `date&time`) VALUES
('Course 1', 'Document 1', 3, 'John Mark', 'Dauan', 'Garapans', '1111-11111-SR-1', '222.00', '12312312312312312312', 'uploads/payment_3_John Mark_Garapans.png', '2023-06-24 15:49:24'),
('Course 2', 'Document 2', 4, 'Joy', 'Joy', 'Joy', '2222-22222-SR-2', '22.00', '23123123123123123123', 'uploads/payment_4_Joy_Joy.png', '2023-06-24 15:50:17'),
('Course 2', 'Document 2', 5, 'Mark', 'Mark', 'Mark', '1111-11111-SR-1', '111.00', '12312312312312312312', 'uploads/payment_5_Mark_Mark.png', '2023-06-24 15:53:00'),
('Course 1', 'Document 1', 6, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '111.00', '21231231231231231231', 'uploads/payment_6_John Mark_Garapan.png', '2023-06-24 15:57:51'),
('Course 1', 'Document 1', 7, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '100.00', '12312312312312312312', 'uploads/payment_7_John Mark_Garapan.png', '2023-06-24 16:01:33');

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
