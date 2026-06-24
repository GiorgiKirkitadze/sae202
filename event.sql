/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.14-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sae202_event
-- ------------------------------------------------------
-- Server version	10.11.14-MariaDB-0+deb12u2-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES
(1,'admin','$2y$10$YkYVGUFBXTBndbPutKRQxedEk/5dTs/rgwTLxHKsxSIwXLu3/19Pe');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `statut` enum('attente','approuve','rejete') DEFAULT 'attente',
  `date_post` datetime DEFAULT current_timestamp(),
  `note` tinyint(4) NOT NULL DEFAULT 5,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaires`
--

LOCK TABLES `commentaires` WRITE;
/*!40000 ALTER TABLE `commentaires` DISABLE KEYS */;
INSERT INTO `commentaires` VALUES
(1,2,'Test c\'etait tres bien','rejete','2026-06-08 09:49:30',5),
(2,1,'test','approuve','2026-06-11 06:32:41',2),
(3,4,'Bon experience','approuve','2026-06-11 08:52:12',4),
(4,3,'j\'adore','approuve','2026-06-11 11:31:34',4),
(5,3,'test','approuve','2026-06-11 13:42:16',5),
(6,8,'Très bien','approuve','2026-06-23 15:36:19',3);
/*!40000 ALTER TABLE `commentaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipe_membres`
--

DROP TABLE IF EXISTS `equipe_membres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipe_membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_membre` (`reservation_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipe_membres`
--

LOCK TABLES `equipe_membres` WRITE;
/*!40000 ALTER TABLE `equipe_membres` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipe_membres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nom_equipe` varchar(100) NOT NULL,
  `nb_joueurs` int(11) NOT NULL,
  `date_reservation` date NOT NULL,
  `heure_reservation` time NOT NULL,
  `costumes` tinyint(1) NOT NULL DEFAULT 0,
  `service_video` tinyint(1) NOT NULL DEFAULT 0,
  `joueurs` text DEFAULT NULL,
  `code_invitation` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES
(5,4,'Agence',3,'2026-11-05','20:00:00',1,1,'[{\"nom\":\"Test1\",\"email\":\"test@gmail.com\"},{\"nom\":\"Test2\",\"email\":\"test@gmail.com\"},{\"nom\":\"Test3\",\"email\":\"test@gmail.com\"}]',NULL),
(7,6,'TEST',2,'2026-10-20','18:00:00',0,0,'[{\"nom\":\"HQ\",\"email\":\"\"},{\"nom\":\"CNJQCL\",\"email\":\"\"}]','MN-384-AK'),
(8,3,'Agence studio',5,'2026-06-18','18:00:00',1,1,'[{\"nom\":\"evaelle faivre\",\"email\":\"opheliadu10@gmail.com\"},{\"nom\":\"noah jamet\",\"email\":\"opheliadu10@gmail.com\"},{\"nom\":\"giogi k\",\"email\":\"opheliadu10@gmail.com\"},{\"nom\":\"lola jouan\",\"email\":\"opheliadu10@gmail.com\"},{\"nom\":\"anais eung\",\"email\":\"opheliadu10@gmail.com\"}]','NT-394-AT'),
(9,8,'Prof',2,'2026-07-12','00:00:00',1,0,'[{\"nom\":\"Jérome Manfroy\",\"email\":\"jmanfroy@gmail.com\"},{\"nom\":\"Roma Delga\",\"email\":\"romadelga@gmail.com\"}]','BP-174-PU');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `scores` (
  `reservation_id` int(11) NOT NULL,
  `resultat` varchar(100) NOT NULL DEFAULT '',
  `indices_trouves` varchar(100) NOT NULL DEFAULT '',
  `temps_etape5` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scores`
--

LOCK TABLES `scores` WRITE;
/*!40000 ALTER TABLE `scores` DISABLE KEYS */;
INSERT INTO `scores` VALUES
(9,'1234','3','13');
/*!40000 ALTER TABLE `scores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_inscription` datetime DEFAULT current_timestamp(),
  `telephone` varchar(30) DEFAULT NULL,
  `naissance` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Jora','Joradze','gkirkita.2000@gmail.com','$2y$10$6DQH1m.xItDFkhkGvQrOhuSZASJfRprH67vChR.FcfeR.WtPN8Hf6','2026-06-07 20:56:51',NULL,NULL),
(2,'Test','version','test@gmail.com','$2y$10$NyWITNOw2n8Y1WGzHY7e.ezLYOkJF2mmRgrmm5v4k8fAZGHclc1Qa','2026-06-08 09:49:15',NULL,NULL),
(3,'tachenet','ophelia','opheliadu10@gmail.com','$2y$10$Bp1Kr5dYz2msusBPz2ZHZ.RNI6m38.K/EdGOM.Yhs6BJ2OT4WXE9a','2026-06-10 14:41:41','0781812623','13/08/2007'),
(4,'Testtt','Test','giorgi.kirkitadze@etudiant.univ-reims.fr','$2y$10$URZnqH49zTD5QLJ.CTwiueXtPC.rZvs.qQtS3n9eAJl6KJuYe93Ea','2026-06-11 08:49:05','5555555555','05/11/2002'),
(5,'Evaelle','Faivre','evaelle.faivre@etudiant.univ-reims.fr','$2y$10$w1RqjJyZoE3igaod0xF9CuIwDV6TWFL.3W33UR3pEu9jjVkVTB17S','2026-06-12 09:18:48','09090909','18/02/2007'),
(6,'tachenet','ophe','ophelia1308@gmail.com','$2y$10$1Gz3ql75Z3hBKx6lPUEaQuAATwMrnUMv6yCG./b2GfRZEiF.gX3sG','2026-06-12 10:55:03','0781812623','13/08/2007'),
(7,'Evaelle','Faivre','evaelle.faivre@gmail.com','$2y$10$QDiGbVT8twF3N.emkgwBN.rSSD/z09NS7fZc9/6ScYHiFWVTEknVS','2026-06-12 12:41:47','090909','18/02/2007'),
(8,'Thomas','Castellengo','thomas.castellengo@univ-reims.fr','$2y$10$QYuxvB64vwlqTXBMS/uCqOAaxpFuAttVktMwe3CkB80CSbxVD0YeG','2026-06-23 15:11:28','0654553210','16/05/1999');
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

-- Dump completed on 2026-06-24 11:28:35
