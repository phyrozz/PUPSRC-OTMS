-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 06:22 PM
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
  `feedback_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounting_feedbacks`
--

INSERT INTO `accounting_feedbacks` (`feedback_id`, `user_id`, `email`, `feedback_text`) VALUES
(1, 39, 'sample@gmail.com', 'try lang hehe'),
(2, 42, 'sample@gmail.com', 'hehehe '),
(3, 44, 'johnmarkgarapan2@gmail.com', 'sample try'),
(4, 45, 'johnmarkgarapan2@gmail.com', 'try lang naman ito'),
(5, 45, 'johnmarkgarapan2@gmail.com', 'try lang ulit hehe'),
(6, 45, 'johnmarkgarapan2@gmail.com', 'try nga lang ulit eh anoba'),
(7, 44, 'dorothy@gmail.com', 'eme lang ito'),
(8, 44, 'dorothy@gmail.com', 'eme parin talaga ito'),
(9, 46, 'johnmarkgarapan2@gmail.com', 'hi hehehehe'),
(10, 47, 'dorothy@gmail.com', 'hello hehehehe'),
(11, 47, 'dorothy@gmail.com', 'hello hello'),
(12, 46, 'johnmarkgarapan2@gmail.com', 'hi hi hi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_feedbacks`
--
ALTER TABLE `accounting_feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
