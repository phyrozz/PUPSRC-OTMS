-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 08:25 PM
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
  `birth_date` date NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_no`, `last_name`, `first_name`, `middle_name`, `extension_name`, `contact_no`, `birth_date`, `email`, `password`, `user_role`) VALUES
(28, '2020-00201-SR-0', 'Malabanan', 'Joshua', 'Gonzales', '', '09087756313', '2001-08-27', 'joshuamalabanan70@gmail.com', '$2y$10$Tzsuk4BMbLY5ewMILCTTdeIk2/ufNWTbWQzOZcLlsH8Iy/LQmaC8a', 1),
(31, '2020-00200-SR-0', 'Shandra', 'Miki', 'Brawl', 'Jr.', '09464032004', '2023-06-16', 'mmallow624@gmail.com', '$2y$10$orJgdEoFs1G066jHzilA4Or/WrvzNj8HDJVBk6pcJBtMhguQ6MlbG', 1),
(32, '2021-0220-SR-0', 'Shanks', 'Akagami', 'B', NULL, '09464032005', '2023-06-16', 'bussinbaldes@gmail.com', '$2y$10$TlnTlMSObrJ7NG4WtG3KJu/ZpcIZwieyJfcCnlt4Ap5LQROZG4Z5a', 1),
(33, '2020-12356-SR-0', 'Magno', 'Dowel', 'P', 'Jr', '09645231211', '2023-06-16', 'mixelsynth69@gmail.com', '$2y$10$ZZFWcYG4TvuawhqLZfoNs.ijLIefE0k9rUJMhathYttUQqX8B1q66', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_users_user_roles1_idx` (`user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_roles1` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`user_role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
