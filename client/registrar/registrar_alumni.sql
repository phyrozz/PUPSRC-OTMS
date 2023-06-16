CREATE TABLE `reg_requirements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `requirement` text NOT NULL,
  `payment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `reg_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `services` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `requirement_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK.requirement` (`requirement_id`),
  CONSTRAINT `FK.REQUIREMENT_ID` FOREIGN KEY (`requirement_id`) REFERENCES `reg_requirements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `reg_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `reg_transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `office_id` int NOT NULL,
  `services_id` int NOT NULL,
  `schedule` date NOT NULL,
  `status_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `reg_requirements` VALUES (1,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\nLetter request addressed to CHED Regional Director (for CAV-CHED request only)\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope','920.00 for DFA\n150.00 for Special Certification\nP620.00 for CHED\nP470.00 for PRC'),(2,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nOfficial receipt for documentary stamp\nProof of payment\n1 Long Brown Envelope','P150.00 per certificate'),(3,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope','P150.00 per course description'),(4,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope','P150.00 per certificate'),(5,'Accomplished and printed copy of the application and payment voucher from the branch/campus registrar\nGeneral Clearance showing the client is cleared of all accountabilities\nCertificate of Candidacy\nCertificate of Conferment of Degree (Dummy Diploma)\n2 pcs. 2” x 2” picture in Academic Gown\nDocumentary stamp\nProof of payments (for applicants not covered by RA 10931 otherwise known as Universal Access to Quality Tertiary Education Act of 2017)','N/A'),(6,'Letter of request by the student\n2” x 2” picture in formal attire\nDocumentary Stamp\nProof of payment','P350.00 – Non Engineering\nP450.00 - Engineering\nP20.00 for White Long Envelope for TOR Copy for Another School'),(7,'Letter of request by the student\n2” x 2” picture in formal attire\nDocumentary Stamp\nProof of payment\nAcknowledged/Signed Copy of Transfer Credential/Honorable Dismissal','P400.00 - Non Engineering\nP500.00 – Engineering\nP20.00 for White Long Envelope for TOR Copy for Another School');
INSERT INTO `reg_services` VALUES (1,'Application for Graduation SIS and Non-SIS',NULL),(2,' Correction of Entry of Grade',NULL),(3,'Completion of Incomplete Grade',NULL),(4,'Late Reporting of Grade',NULL),(5,'Processing of Request for Correction of Name in Conformity \r\nwith the Philippines Statistics Authority Certificate of Live Birth \r\nand/or Correction of Name in the School Records\r\n',NULL),(6,'Certification, Verification, Authentication (CAV/Apostile)',NULL),(7,'Certificates \r\nof Attendance\r\n',NULL),(8,'Certificate of Graduation',NULL),(9,'Certificate of Medium of Instruction',NULL),(10,'Certificate of General Weighted Average (GWA)',NULL),(11,'Non-Issuance of Special Order ',NULL),(12,'Certified True Copy',NULL),(13,'Course/Subject \r\nDescription)\r\n',NULL),(14,'Certificate of Transfer Credential/Honorable Dismissal',NULL),(15,'Transcript of \r\nRecords (First Copy)\r\n',NULL),(16,'Transcript of Records (Second and succeeding copies)',NULL),(17,'Transcript of Records (Copy for Another School)',NULL),(18,'Course Accreditation Service-Senior High School to Bridge Course',NULL),(19,' Course Accreditation Service (For Shiftees and \r\nRegular Students)\r\n',NULL),(20,'Course Accreditation Service (for Transferees)',NULL),(21,'Informative Copy of Grades',NULL),(22,'Leave of Absence',NULL),(23,'Certification, Verification, Authentication (CAV/Apostile)',1),(24,'Certificates of Attendance',2),(25,'Certificate of Graduation',2),(26,'Certificate of Medium of Instruction',2),(27,'Certificate of General Weighted Average (GWA)',2),(28,'Non-Issuance of Special Order',2),(29,'Certified True Copy',2),(30,'Course/Subject Description',3),(31,'Certificate of Transfer Credential/Honorable Dismissal',4),(32,'Transcript of Records (First Copy)',5),(33,'Transcript of Records (Second and succeeding copies)',6),(34,'Transcript of Records (Copy for Another School)',7);
INSERT INTO `reg_status` VALUES (1,'Pending'),(2,'For Receiving'),(3,'For Evaluating'),(4,'Released');
INSERT INTO `reg_transaction` VALUES (13,NULL,3,27,'2023-06-29',1,28),(14,NULL,3,24,'2023-06-26',1,28),(15,NULL,3,26,'2023-06-26',1,28),(16,NULL,3,28,'2023-07-07',1,28),(17,NULL,3,29,'2023-07-08',1,28),(18,NULL,3,30,'2023-06-23',1,28);

