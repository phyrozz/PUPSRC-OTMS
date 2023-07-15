-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Jul 15, 2023 at 06:22 PM
=======
-- Generation Time: Jul 13, 2023 at 08:25 PM
>>>>>>> d9c49f15e57e6e76c9561c59fc5d5898989cb57a
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
<<<<<<< HEAD
(8, 44, 'dorothy@gmail.com', 'eme parin talaga ito'),
(9, 46, 'johnmarkgarapan2@gmail.com', 'hi hehehehe'),
(10, 47, 'dorothy@gmail.com', 'hello hehehehe'),
(11, 47, 'dorothy@gmail.com', 'hello hello'),
(12, 46, 'johnmarkgarapan2@gmail.com', 'hi hi hi');
=======
(8, 44, 'dorothy@gmail.com', 'eme parin talaga ito');
>>>>>>> d9c49f15e57e6e76c9561c59fc5d5898989cb57a

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
<<<<<<< HEAD
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
=======
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
>>>>>>> d9c49f15e57e6e76c9561c59fc5d5898989cb57a
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
