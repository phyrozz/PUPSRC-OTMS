CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `equipment_name` varchar(100) NOT NULL,
  `availability` enum('Available','Unavailable') DEFAULT 'Available',
  `quantity` int(11) DEFAULT 0,
  `equipment_type_id` int(11) DEFAULT 0,
  `request` tinyint(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `equipment` (`equipment_id`, `equipment_name`, `availability`, `quantity`, `equipment_type_id`, `request`) VALUES
(1, 'Badminton Net', 'Available', 4, 2, 1),
(2, 'Badminton Racket', 'Available', 15, 2, 1),
(3, 'Badminton Shuttlecock', 'Available', 20, 2, 1),
(4, 'Basketball', 'Available', 10, 2, 1),
(5, 'BasketBall Ring and Net', 'Available', 20, 2, 1),
(6, 'Brush', 'Available', 20, 3, 1),
(7, 'Bucket', 'Available', 15, 3, 1),
(8, 'Chairs', 'Available', 2, 1, 1),
(9, 'Cleaning Detergent', 'Available', 20, 3, 1),
(10, 'Curtains', 'Available', 5, 1, 1),
(11, 'Chess Board', 'Available', 20, 2, 1),
(12, 'Digital Scoreboard', 'Available', 20, 1, 1),
(13, 'Mop', 'Available', 10, 3, 1),
(14, 'Projectors', 'Available', 20, 1, 1),
(15, 'Scoreboard', 'Available', 2, 2, 1),
(16, 'Vacuum', 'Available', 20, 3, 1),
(17, 'Volleyball', 'Available', 6, 2, 1),
(18, 'Volleyball Net', 'Available', 3, 2, 1),
(19, 'Tables', 'Available', 10, 1, 1),
(20, 'TV', 'Available', 20, 1, 1);

ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `equipment_type_id` (`equipment_type_id`);

ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`equipment_type_id`);



CREATE TABLE `equipment_type` (
  `equipment_type_id` int(11) NOT NULL,
  `equipment_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `equipment_type` (`equipment_type_id`, `equipment_type`) VALUES
(1, 'School'),
(2, 'Sports'),
(3, 'Cleaning');


CREATE TABLE `facility` (
  `facility_id` int(11) NOT NULL,
  `facility_name` varchar(50) NOT NULL,
  `availability` enum('Available','Unavailable') DEFAULT 'Available',
  `facility_number` varchar(50) DEFAULT NULL,
  `facility_type_id` int(11) DEFAULT 0,
  `request` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facility_id`, `facility_name`, `availability`, `facility_number`, `facility_type_id`, `request`) VALUES
(1, 'Campus Court', 'Available', '101', 1, 1),
(2, 'Room 102', 'Available', '102', 1, 1),
(3, 'Room 103', 'Available', '103', 1, 1),
(4, 'Room 104', 'Available', '104', 1, 1),
(5, 'Room 105', 'Available', '105', 1, 1),
(6, 'Room 106', 'Available', '106', 1, 1),
(7, 'Room 107', 'Available', '107', 1, 1),
(8, 'Room 108', 'Available', '108', 1, 1),
(9, 'Room 109', 'Available', '109', 1, 1),
(10, 'Room 110', 'Available', '110', 1, 1),
(11, 'Computer Lab', 'Available', '201', 2, 1),
(12, 'Room 202', 'Available', '202', 2, 1),
(13, 'Room 203', 'Available', '203', 2, 1),
(14, 'Room 204', 'Available', '204', 2, 1),
(15, 'Room 205', 'Available', '205', 2, 1),
(16, 'Room 206', 'Available', '206', 2, 1),
(17, 'Room 207', 'Available', '207', 2, 1),
(18, 'Room 208', 'Available', '208', 2, 1),
(19, 'Room 209', 'Available', '209', 2, 1),
(20, 'Room 210', 'Available', '210', 2, 1),
(21, 'Room 301', 'Available', '301', 3, 1),
(22, 'Room 302', 'Available', '302', 3, 1),
(23, 'Room 303', 'Available', '303', 3, 1),
(24, 'Room 304', 'Available', '304', 3, 1),
(25, 'Room 305', 'Available', '305', 3, 1),
(26, 'Room 306', 'Available', '306', 3, 1),
(27, 'Audio Visual Room', 'Available', '307', 3, 1),
(28, 'Room 308', 'Available', '308', 3, 1),
(29, 'Room 309', 'Available', '309', 3, 1),
(30, 'Room 310', 'Available', '310', 3, 1),
(31, 'Room 401', 'Available', '401', 4, 1),
(32, 'Room 402', 'Available', '402', 4, 1),
(33, 'Room 403', 'Available', '403', 4, 1),
(34, 'Room 404', 'Available', '404', 4, 1),
(35, 'Room 405', 'Available', '405', 4, 1),
(36, 'Room 406', 'Available', '406', 4, 1),
(37, 'Room 407', 'Available', '407', 4, 1),
(38, 'Room 408', 'Available', '408', 4, 1),
(39, 'Room 409', 'Available', '409', 4, 1),
(40, 'Room 410', 'Available', '410', 4, 1);


ALTER TABLE `facility`
  ADD PRIMARY KEY (`facility_id`),
  ADD KEY `facility_type_id` (`facility_type_id`);

  ALTER TABLE `facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

ALTER TABLE `facility`
  ADD CONSTRAINT `facility_ibfk_1` FOREIGN KEY (`facility_type_id`) REFERENCES `facility_type` (`facility_type_id`);


CREATE TABLE `facility_type` (
  `facility_type_id` int(11) NOT NULL,
  `facility_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_type`
--

INSERT INTO `facility_type` (`facility_type_id`, `facility_type`) VALUES
(1, 'First Floor'),
(2, 'Second Floor'),
(3, 'Third Floor'),
(4, 'Fourth Floor');

ALTER TABLE `facility_type`
  ADD PRIMARY KEY (`facility_type_id`);

ALTER TABLE `facility_type`
  MODIFY `facility_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;




CREATE TABLE `request_equipment` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime_schedule` datetime DEFAULT NULL,
  `quantity_equip` int(30) NOT NULL,
  `status_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `purpose` text NOT NULL,
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `request_equipment`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `request_equipment_ibfk_3` (`equipment_id`);

ALTER TABLE `request_equipment`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `request_equipment`
  ADD CONSTRAINT `request_equipment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `request_equipment_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `request_equipment_ibfk_3` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);





CREATE TABLE `appointment_facility` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `start_date_time_sched` datetime DEFAULT NULL,
  `end_date_time_sched` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `purpose` varchar(200) DEFAULT NULL,
  `facility_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `appointment_facility`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `facility` (`facility_id`);


ALTER TABLE `appointment_facility`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `appointment_facility`
  ADD CONSTRAINT `appointment_facility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `appointment_facility_ibfk_3` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`facility_id`);

