-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 04:27 AM
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
-- Database: `payment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `reference_id` int(11) NOT NULL,
  `referenceNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`reference_id`, `referenceNumber`) VALUES
(23, '123456789'),
(24, '123');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `course` varchar(50) NOT NULL,
  `documentType` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `studentNumber` varchar(15) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `referenceNumber` int(20) NOT NULL,
  `date&time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`course`, `documentType`, `student_id`, `firstname`, `middlename`, `surname`, `studentNumber`, `amount`, `referenceNumber`, `date&time`) VALUES
('Course 1', 'Document 1', 36, 'John Mark', 'Dauan', 'Garapan', '2020-00585-SR-0', '500.00', 0, '2023-05-22 02:02:20'),
('Course 1', 'Document 2', 37, 'Mark', 'Mark', 'Mark', '123SSDASDASDASD', '123.00', 0, '2023-05-22 02:02:20'),
('Course 1', 'Document 1', 38, 'Mark', 'Mark', 'Mark', '123123123123123', '12.00', 123, '2023-05-22 02:17:06'),
('Course 1', 'Document 1', 39, 'Mark', 'Mark', 'Mark', '123123123123123', '123.00', 123, '2023-05-22 02:17:22'),
('Course 1', 'Document 1', 40, 'John', 'John', 'John', '123123123123123', '555.00', 555, '2023-05-22 02:22:17'),
('Course 1', 'Document 1', 41, 'a', 'a', 'a', '123123123123123', '123.00', 123, '2023-05-22 02:26:59'),
('Course 1', 'Document 1', 42, 'John', 'Mark', 'Garapan', '2020-00585-SR-0', '100.00', 1234567890, '2023-05-22 02:30:28'),
('Course 2', 'Document 2', 43, 'Dorothy Grace', 'Dauan', 'Garapan', '2020-00599-SR-0', '500.00', 123456, '2023-05-22 18:25:25'),
('Course 1', 'Document 1', 44, 'John', 'Sata', 'Kennedy', '2020-00234-SR-0', '122.34', 123456, '2023-05-27 07:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`reference_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
