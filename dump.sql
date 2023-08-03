-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: symfony
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `boardgame`
--

DROP TABLE IF EXISTS `boardgame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `boardgame` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `sdj` tinyint(1) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_98A1DB1D989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boardgame`
--

LOCK TABLES `boardgame` WRITE;
/*!40000 ALTER TABLE `boardgame` DISABLE KEYS */;
INSERT INTO `boardgame` VALUES (2,'7 Wonders','Antoine Bauza',2010,1,'7-wonders-2010'),(3,'Blood Rage','Eric M. Lang',2015,0,'blood-rage-2015'),(4,'Brass Birmingham','Martin Wallace',2018,0,'brass-birmingham-2018'),(5,'Cascadia','Randy Flynn',2021,1,'cascadia-2021'),(6,'Ark Nova','Mathias Wigge',2021,0,'ark-nova-2021');
/*!40000 ALTER TABLE `boardgame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `boardgame_id` int NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `photo_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CB1A27A21` (`boardgame_id`),
  CONSTRAINT `FK_9474526CB1A27A21` FOREIGN KEY (`boardgame_id`) REFERENCES `boardgame` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,2,'Geraldes','geraldes@mooneye.de','Awesome','2023-08-03 17:34:43',NULL,10),(2,2,'Marc','geraldes@mooneye.de','Di best','2023-08-03 17:34:53',NULL,10),(3,2,'Kim','geraldes@mooneye.de','Boring','2023-08-03 17:35:03',NULL,1),(4,2,'Enrique','geraldes@mooneye.de','Solid','2023-08-03 17:35:12',NULL,6),(5,2,'Julia','geraldes@mooneye.de','I love it','2023-08-03 17:35:32',NULL,8),(6,3,'Geraldes','geraldes@mooneye.de','My favorite game','2023-08-03 17:54:27',NULL,10),(7,3,'Marc','geraldes@mooneye.de','I love it','2023-08-03 17:54:43',NULL,10);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20230803121825','2023-08-03 17:15:27',238),('DoctrineMigrations\\Version20230803124440','2023-08-03 17:15:28',27),('DoctrineMigrations\\Version20230803131505','2023-08-03 17:15:28',47),('DoctrineMigrations\\Version20230803134100','2023-08-03 17:15:28',22),('DoctrineMigrations\\Version20230803134906','2023-08-03 17:15:28',26);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `sess_id` varchar(128) NOT NULL,
  `sess_data` blob NOT NULL,
  `sess_lifetime` int NOT NULL,
  `sess_time` int NOT NULL,
  PRIMARY KEY (`sess_id`),
  KEY `expiry` (`sess_lifetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('pecoh1iiq37rcvf38jt8gfgm3l',_binary '_sf2_attributes|a:6:{s:15:\"_csrf/Boardgame\";s:43:\"MEFXfh-_pX1FsSLJiQNHFbAaS8irC97ho7qEB4LFIYE\";s:15:\"_csrf/ea-toggle\";s:43:\"d0PyAz8TgkBVhOhGuu-K5LXC2JVk3uECOOxty1htLuo\";s:33:\"_csrf/ea-batch-action-batchDelete\";s:43:\"Ys5kJfvxACB36fGnIPup_ReaYcq9A9r2Zoz5ABdz_0w\";s:15:\"_csrf/ea-delete\";s:43:\"CPvr-sGV4Vb6Zilw4eV1HRUfMrmvaPdTyK4PoxvkBLw\";s:13:\"_csrf/Comment\";s:43:\"Pmv_AhCYHLma4yTdeAYpQ0HMVkPOc9N-dfYRKUPLxos\";s:13:\"_csrf/comment\";s:43:\"nBfhOWF0YwelKr5OxrLvTppmY3l5I8-EC2tsx2A-qfc\";}_sf2_meta|a:3:{s:1:\"u\";i:1691078100;s:1:\"c\";i:1691075733;s:1:\"l\";i:0;}',1691079541,1691078101);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-03 17:56:14
