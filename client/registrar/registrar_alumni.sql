CREATE DATABASE  IF NOT EXISTS `reg_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `reg_db`;
-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: reg_db
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `office`
--

DROP TABLE IF EXISTS `office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `office` (
  `id` int NOT NULL AUTO_INCREMENT,
  `office` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office`
--

LOCK TABLES `office` WRITE;
/*!40000 ALTER TABLE `office` DISABLE KEYS */;
INSERT INTO `office` VALUES (1,'Registration Office');
/*!40000 ALTER TABLE `office` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_requirements`
--

DROP TABLE IF EXISTS `reg_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reg_requirements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `requirement` text NOT NULL,
  `payment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_requirements`
--

LOCK TABLES `reg_requirements` WRITE;
/*!40000 ALTER TABLE `reg_requirements` DISABLE KEYS */;
INSERT INTO `reg_requirements` VALUES (1,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\nLetter request addressed to CHED Regional Director (for CAV-CHED request only)\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope','920.00 for DFA\n150.00 for Special Certification\nP620.00 for CHED\nP470.00 for PRC'),(2,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nOfficial receipt for documentary stamp\nProof of payment\n1 Long Brown Envelope','P150.00 per certificate'),(3,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope','P150.00 per course description'),(4,'Student’s Request Letter\nGeneral Clearance showing the client is cleared of all accountabilities\n2 pcs. 2” x 2” picture in Formal Attire\nDocumentary stamp\nProof of payment\n1 Long Brown Envelope','P150.00 per certificate'),(5,'Accomplished and printed copy of the application and payment voucher from the branch/campus registrar\nGeneral Clearance showing the client is cleared of all accountabilities\nCertificate of Candidacy\nCertificate of Conferment of Degree (Dummy Diploma)\n2 pcs. 2” x 2” picture in Academic Gown\nDocumentary stamp\nProof of payments (for applicants not covered by RA 10931 otherwise known as Universal Access to Quality Tertiary Education Act of 2017)','N/A'),(6,'Letter of request by the student\n2” x 2” picture in formal attire\nDocumentary Stamp\nProof of payment','P350.00 – Non Engineering\nP450.00 - Engineering\nP20.00 for White Long Envelope for TOR Copy for Another School'),(7,'Letter of request by the student\n2” x 2” picture in formal attire\nDocumentary Stamp\nProof of payment\nAcknowledged/Signed Copy of Transfer Credential/Honorable Dismissal','P400.00 - Non Engineering\nP500.00 – Engineering\nP20.00 for White Long Envelope for TOR Copy for Another School');
/*!40000 ALTER TABLE `reg_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_services`
--

DROP TABLE IF EXISTS `reg_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reg_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `services` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `requirement_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK.requirement` (`requirement_id`),
  CONSTRAINT `FK.REQUIREMENT_ID` FOREIGN KEY (`requirement_id`) REFERENCES `reg_requirements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_services`
--

LOCK TABLES `reg_services` WRITE;
/*!40000 ALTER TABLE `reg_services` DISABLE KEYS */;
INSERT INTO `reg_services` VALUES (1,'Application for Graduation SIS and Non-SIS',NULL),(2,' Correction of Entry of Grade',NULL),(3,'Completion of Incomplete Grade',NULL),(4,'Late Reporting of Grade',NULL),(5,'Processing of Request for Correction of Name in Conformity \r\nwith the Philippines Statistics Authority Certificate of Live Birth \r\nand/or Correction of Name in the School Records\r\n',NULL),(6,'Certification, Verification, Authentication (CAV/Apostile)',NULL),(7,'Certificates \r\nof Attendance\r\n',NULL),(8,'Certificate of Graduation',NULL),(9,'Certificate of Medium of Instruction',NULL),(10,'Certificate of General Weighted Average (GWA)',NULL),(11,'Non-Issuance of Special Order ',NULL),(12,'Certified True Copy',NULL),(13,'Course/Subject \r\nDescription)\r\n',NULL),(14,'Certificate of Transfer Credential/Honorable Dismissal',NULL),(15,'Transcript of \r\nRecords (First Copy)\r\n',NULL),(16,'Transcript of Records (Second and succeeding copies)',NULL),(17,'Transcript of Records (Copy for Another School)',NULL),(18,'Course Accreditation Service-Senior High School to Bridge Course',NULL),(19,' Course Accreditation Service (For Shiftees and \r\nRegular Students)\r\n',NULL),(20,'Course Accreditation Service (for Transferees)',NULL),(21,'Informative Copy of Grades',NULL),(22,'Leave of Absence',NULL),(23,'Certification, Verification, Authentication (CAV/Apostile)',1),(24,'Certificates of Attendance',2),(25,'Certificate of Graduation',2),(26,'Certificate of Medium of Instruction',2),(27,'Certificate of General Weighted Average (GWA)',2),(28,'Non-Issuance of Special Order',2),(29,'Certified True Copy',2),(30,'Course/Subject Description',3),(31,'Certificate of Transfer Credential/Honorable Dismissal',4),(32,'Transcript of Records (First Copy)',5),(33,'Transcript of Records (Second and succeeding copies)',6),(34,'Transcript of Records (Copy for Another School)',7);
/*!40000 ALTER TABLE `reg_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_status`
--

DROP TABLE IF EXISTS `reg_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reg_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_status`
--

LOCK TABLES `reg_status` WRITE;
/*!40000 ALTER TABLE `reg_status` DISABLE KEYS */;
INSERT INTO `reg_status` VALUES (1,'Pending'),(2,'For Receiving'),(3,'For Evaluating'),(4,'Released');
/*!40000 ALTER TABLE `reg_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_transaction`
--

DROP TABLE IF EXISTS `reg_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reg_transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `office_id` int NOT NULL,
  `services_id` int NOT NULL,
  `schedule` date NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_transaction`
--

LOCK TABLES `reg_transaction` WRITE;
/*!40000 ALTER TABLE `reg_transaction` DISABLE KEYS */;
INSERT INTO `reg_transaction` VALUES (1,'RE-001',1,1,'2023-05-27',1);
/*!40000 ALTER TABLE `reg_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `student_no` varchar(45) NOT NULL,
  `is_complete` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,1,'2020-01234-SR-0',0),(2,2,'2020-00329-SR-0',0),(3,3,'2020-00189-SR-0',0),(4,4,'2020-00984-SR-0',0),(5,5,'2020-00104-SR-0',0);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `extension_name` varchar(255) DEFAULT NULL,
  `contact_no` varchar(13) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_role` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Cruz','Juan','Dela',NULL,'09012345678','jdelacruz@gmail.com',NULL,1),(2,'Rosario','Anna','Lampara',NULL,'09056328999','anna122L@yahoo.com',NULL,1),(3,'Malabanan','Isaac','Dane','Jr.','09054429918','malabanan2222@gmail.com',NULL,1),(4,'Austria','Skyler Jorden','Calapatia',NULL,'09025571297','skylerwhitey0@yahoo.com',NULL,1),(5,'Belloso','Collin','Magat',NULL,'09010110590','bestnn_2021@gmail.com',NULL,1),(6,'Reyes','Nataniel Urbano','Ynaya',NULL,'09087310002','urban_011@yahoo.com',NULL,2),(7,'Lorenzo','Vincente Dylan','Dioquino',NULL,'09051128492','vincente_999@yahoo.com',NULL,3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-27  0:10:50
