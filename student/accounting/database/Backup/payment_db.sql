-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 07:17 PM
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
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `course` varchar(50) NOT NULL,
  `documentType` varchar(50) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
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
('Course 1', 'Document 1', 106, 'ttt', 'ttt', 'ttt', '707070707070707', '70.00', '2147483647', 'uploads/payment_106_ttt_ttt.jpg', '2023-06-16 13:08:19'),
('Course 1', 'Document 1', 107, 'dad', 'dad', 'dad', '123312312312312', '544.00', '2147483647', 'uploads/payment_107_dad_dad.png', '2023-06-16 13:18:13'),
('Course 2', 'Document 1', 108, 'rrr', 'rrr', 'rrr', 'RRRRRRRRRRRRRRR', '24.00', '2147483647', 'uploads/payment_108_rrr_rrr.png', '2023-06-16 13:23:39'),
('Course 1', 'Document 1', 114, 'dad', 'dad', 'dad', '313131313131313', '31.00', '13131313131313131331', 'uploads/payment_114_dad_dad.png', '2023-06-16 14:06:25'),
('Course 2', 'Document 2', 115, 'xax', 'xax', 'xax', '212121212121212', '21.00', '21212121212121212121', 'uploads/payment_115_xax_xax.jpg', '2023-06-16 14:20:17'),
('Course 2', 'Document 2', 116, 'aa', 'aa', 'aa', '231312312312312', '22.00', '32131321231231231312', 'uploads/payment_116_aa_aa.png', '2023-06-16 14:28:16'),
('Course 1', 'Document 1', 117, 'vav', 'vav', 'vav', 'EE1E2EDADAWDADS', '2.00', '32132131231231231231', 'uploads/payment_117_vav_vav.png', '2023-06-16 14:41:01'),
('Course 2', 'Document 2', 118, 'Sophie', 'Serrano', 'Luna', '2020-00589-SR-0', '22.00', '31231231231231231231', 'uploads/payment_118_Sophie_Luna.png', '2023-06-17 01:16:14');

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
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
