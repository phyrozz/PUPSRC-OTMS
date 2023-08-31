-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 01:38 PM
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
-- Table structure for table `accounting_feedbacks`
--

CREATE TABLE `accounting_feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_feedbacks`
--

INSERT INTO `accounting_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`, `submitted_on`) VALUES
(1, 49, 'celia@gmail.com', 'yo yo hey', '2023-07-21 11:34:15'),
(2, 49, 'celia@gmail.com', 'mamamo ', '2023-07-21 11:34:24'),
(3, 47, 'sample@gmail.com', 'papamo papako', '2023-07-21 11:35:06'),
(4, 47, 'sample@gmail.com', 'papa nating lahat', '2023-07-21 11:35:15'),
(5, 49, 'celia@gmail.com', 'help kase need ko ng tulong', '2023-07-21 11:37:00'),
(6, 49, 'celia@gmail.com', 'sabi ko help naman pre', '2023-07-21 11:37:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `accountingfeedback_ibfk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  ADD CONSTRAINT `accountingfeedback_ibfk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
