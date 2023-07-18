-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 05:39 PM
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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`user_id`, `file_name`, `file_path`, `file_size`, `type`) VALUES
(1, 'SO_ACEFORM_2020-00238-SR-0_Nuque,Erwin.pdf', 'D:/chris/Documents/xampp/htdocs//assets/uploads/generated_pdf/SO_ACEFORM_2020-00238-SR-0_Nuque,Erwin.pdf', 126617, 'Generated PDF'),
(2, '2020-00238-SR-0_Nuque,Erwin_Screenshot (12).png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/2020-00238-SR-0_Nuque,Erwin_Screenshot (12).png', 2713, 'User Upload'),
(3, '2020-00238-SR-0_Nuque_Erwin_Screenshot (12).png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/2020-00238-SR-0_Nuque_Erwin_Screenshot (12).png', 2713, 'User Upload'),
(4, 'SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 013248.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 013248.png', 69, 'User Upload'),
(5, 'SO_ACEFORM___.pdf', 'D:/chris/Documents/xampp/htdocs//assets/uploads/generated_pdf/SO_ACEFORM___.pdf', 126355, 'Generated PDF'),
(6, 'SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-18 022249.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-18 022249.png', 34, 'User Upload'),
(7, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(8, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(9, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(10, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(11, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(12, 'SO_Erwin_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO_Erwin_2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(13, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(14, 'SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 'D:/chris/Documents/xampp/htdocs/assets/uploads/user_uploads/SO__2020-00238-SR-0_Nuque_Erwin_Screenshot 2023-07-17 130137.png', 28, 'User Upload'),
(15, 'SO_ACEFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 'D:/chris/Documents/xampp/htdocs//assets/uploads/generated_pdf/SO_ACEFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 126621, 'Generated PDF'),
(16, 'GA_CFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 'D:/chris/Documents/xampp/htdocs//assets/uploads/generated_pdf/GA_CFORM_2020-00238-SR-0_Nuque_Erwin.pdf', 124418, 'Generated PDF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
