-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mundo-bolita
-- ------------------------------------------------------
-- Server version	5.6.34-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `mb_term_relationships`
--

DROP TABLE IF EXISTS `mb_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_term_relationships`
--

LOCK TABLES `mb_term_relationships` WRITE;
/*!40000 ALTER TABLE `mb_term_relationships` DISABLE KEYS */;
INSERT INTO `mb_term_relationships` VALUES (1,1,0),(5,2,0),(5,23,0),(6,2,0),(6,23,0),(7,2,0),(7,23,0),(8,2,0),(8,23,0),(9,2,0),(9,23,0),(10,2,0),(10,23,0),(11,2,0),(11,23,0),(12,2,0),(12,23,0),(13,2,0),(13,23,0),(14,2,0),(14,23,0),(15,24,0),(16,2,0),(16,24,0),(17,2,0),(17,24,0),(18,2,0),(18,24,0),(23,2,0),(23,24,0),(24,2,0),(24,24,0),(25,2,0),(25,24,0),(26,2,0),(26,24,0),(27,2,0),(27,24,0),(28,2,0),(28,24,0),(29,2,0),(29,25,0),(32,25,0),(33,25,0),(34,25,0),(35,25,0),(36,25,0),(37,25,0),(39,25,0),(40,25,0),(41,25,0),(42,25,0),(43,25,0),(44,25,0),(45,25,0),(46,25,0),(48,25,0),(49,25,0),(50,25,0),(51,25,0),(52,25,0),(53,25,0),(54,25,0),(55,25,0),(56,25,0),(57,25,0),(58,25,0),(59,25,0),(60,25,0),(61,25,0),(62,25,0),(63,2,0),(63,25,0),(64,25,0),(65,25,0),(67,25,0),(68,25,0),(69,25,0),(70,25,0),(71,25,0),(72,25,0),(73,25,0),(74,25,0),(75,25,0),(76,25,0),(77,25,0),(78,2,0),(78,25,0),(79,2,0),(79,25,0),(80,2,0),(80,25,0),(81,2,0),(81,25,0),(82,2,0),(82,25,0),(83,2,0),(83,25,0),(84,2,0),(84,25,0),(85,2,0),(85,25,0),(86,2,0),(86,25,0),(87,2,0),(87,25,0),(88,2,0),(88,25,0),(89,2,0),(89,25,0),(90,2,0),(90,25,0),(91,2,0),(91,25,0),(92,2,0),(92,25,0),(93,2,0),(93,25,0),(94,2,0),(94,25,0),(95,2,0),(95,25,0),(96,2,0),(96,25,0),(97,2,0),(97,25,0),(98,25,0),(99,2,0),(99,25,0),(100,2,0),(100,25,0),(101,2,0),(101,25,0),(102,2,0),(102,25,0),(103,2,0),(103,25,0),(104,2,0),(104,25,0),(105,2,0),(105,25,0),(106,2,0),(106,25,0),(107,2,0),(107,25,0),(108,2,0),(108,25,0),(109,2,0),(109,25,0),(110,2,0),(110,25,0),(111,2,0),(111,25,0),(112,2,0),(112,25,0),(113,18,0),(114,18,0),(115,18,0),(116,18,0),(117,18,0),(118,26,0),(119,26,0),(120,26,0),(121,26,0),(122,26,0),(123,26,0),(124,26,0),(125,27,0),(126,27,0),(127,27,0),(128,27,0),(129,27,0),(130,28,0),(131,28,0),(132,28,0),(133,28,0),(134,28,0),(135,28,0),(136,28,0),(138,16,0),(139,16,0),(140,16,0),(141,16,0),(142,16,0),(143,16,0),(144,16,0),(145,16,0),(146,16,0),(147,16,0),(149,30,0),(150,30,0),(151,30,0);
/*!40000 ALTER TABLE `mb_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-28 17:55:18
