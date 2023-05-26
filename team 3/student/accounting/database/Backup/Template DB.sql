-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2023 at 10:01 PM
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
-- Database: `jmkd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `client_ip` varchar(20) NOT NULL,
  `user_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`) VALUES
(1, 'Logo'),
(2, 'Flyer'),
(3, 'Poster'),
(4, 'Packaging'),
(5, 'Banner'),
(6, 'Illustration'),
(7, 'Shirt Design'),
(8, 'Sticker');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `message` text NOT NULL,
  `mobile` text NOT NULL,
  `email` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date&time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `message`, `mobile`, `email`, `status`, `date&time`) VALUES
(4, 'Daniel Lord', 'abc', '123', 'daniel@gmail.com', 1, '2023-02-02 18:53:25'),
(5, 'Daniel Lord', 'abc', '123', 'daniel@gmail.com', 1, '2023-02-02 18:54:16'),
(6, 'Lea Master', 'abc', '123', 'lea@gmail.com', 0, '2023-02-02 18:55:24'),
(7, 'Shark Boys', 'Yes, you can use both IPO and fishbone diagrams in yo', '890', 'sharkboy@gmail.com', 0, '2023-02-07 20:36:25'),
(8, 'Shark Boy', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.', '1234', 'shark@gmail.com', 1, '2023-02-07 20:37:00'),
(13, 'Baby Boi', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and a\r\n\r\nParagraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and a\r\n\r\nParagraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragra', '123412', 'babyboi@gmail.com', 1, '2023-02-07 20:46:32'),
(14, 'Aldrine Dauan', 'Repeating redirects detected - Outlook on the web login loophttps://answers.microsoft.com › msoffice › forum › all\r\nDec 17, 2020 · 1 post\r\nTrying to login to a newly created email account. I can log in to the portal, but when I click Outlook on the web it puts me into a login ...\r\nMissing: button ‎exist ‎refresh ‎phphmtl', '123', 'aldrine@gmail.com', 1, '2023-02-09 04:20:48'),
(17, 'Sopi Luna', 'hehehe', '123', 'sopi@gmail.com', 0, '2023-02-09 04:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 3, 1),
(2, 1, 5, 1),
(3, 1, 3, 1),
(4, 1, 6, 3),
(5, 2, 1, 2),
(6, 3, 6, 1),
(7, 4, 1, 1),
(8, 5, 8, 1),
(9, 6, 2, 1),
(10, 7, 6, 3),
(11, 7, 7, 5),
(12, 9, 1, 1),
(13, 10, 7, 1),
(14, 10, 1, 1),
(15, 11, 2, 1),
(16, 13, 6, 2),
(17, 13, 3, 1),
(18, 14, 7, 1),
(19, 14, 6, 1),
(20, 15, 5, 2),
(21, 16, 8, 1),
(22, 16, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `img_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0= unavailable, 2 Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `category_id`, `name`, `description`, `price`, `img_path`, `status`) VALUES
(1, 1, 'Brand Logo', 'Bringing your vision to life with expert logo design.', 5000, 'logo.jpg', 1),
(2, 7, 'T-Shirt Designs', 'Quality T-Shirt Graphic Designs For Your Clothing Brand.', 2500, 'tshirt.jpg', 1),
(3, 8, 'Sticker Designs', 'Add a pop of personality with custom sticker design.', 600, 'sticker.jpg', 1),
(4, 6, 'Illustration Designs', 'A Commercial Art Created For Specific Industries.', 1500, 'illustration.jpg', 1),
(5, 7, 'Esport Jersey Designs', 'Level up your gaming style with custom eSport jerseys.', 2500, 'jersey.jpg', 1),
(6, 4, 'Package Designs', 'Design packaging for your brand on a wide range of products.', 1500, 'package.jpg', 1),
(7, 2, 'Flyer / Poster', 'Design your flyers and poster for digital and print use and advertisements.', 2500, 'flyerposter.jpg', 1),
(8, 5, 'Roller Banners', 'Make a bold statement with our high-quality roller banners.', 2500, 'rbanner.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`) VALUES
(1, 'JMKD Designs', 'jmkddesigns@gmail.com', '+63 927 870 9744', 'LogoMain4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `message`) VALUES
(1, 'Arkohn', 'JM', 'johnmarkgarapan2.com', '123456', '0927870974', 'San Pedro'),
(2, 'boy', 'girl', 'boy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123', 'absda'),
(3, 'Daniel', 'Lord', 'daniel@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123', 'abc'),
(4, 'Lea', 'Master', 'lea@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123', 'abc'),
(5, 'Shark', 'Boys', 'sharkboy@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '890', 'Yes, you can use both IPO and fishbone diagrams in yo'),
(6, 'Shark', 'Boy', 'shark@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1234', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout, we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.'),
(7, 'Boss', 'Man', 'boss@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '09998', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and a\r\n\r\nParagraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and a\r\n\r\nthanks'),
(8, 'Baby', 'Boi', 'babyboi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123412', 'Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and a\r\n\r\nParagraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence that forms a unit” (Lunsford and Connors 116). Length and a\r\n\r\nParagraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragra'),
(9, 'Cat', 'Dog', 'catdog@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123', ''),
(10, 'dog', 'cat', 'dogdog@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123', ''),
(11, 'sdads', 'asda', 'leas@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'dasad', ''),
(12, 'Mark', 'Mama', 'mark@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123', ''),
(13, 'John ', 'JJ', 'john@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '213', ''),
(14, 'Arkohn', 'JM', 'johnmarkpph@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0927870974', ''),
(15, 'Sopi', 'Luna', 'sopi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
