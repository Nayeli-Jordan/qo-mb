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
-- Table structure for table `mb_termmeta`
--

DROP TABLE IF EXISTS `mb_termmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_termmeta`
--

LOCK TABLES `mb_termmeta` WRITE;
/*!40000 ALTER TABLE `mb_termmeta` DISABLE KEYS */;
INSERT INTO `mb_termmeta` VALUES (4,18,'order','0'),(5,18,'display_type',''),(6,18,'thumbnail_id','0'),(16,22,'order','0'),(17,22,'display_type',''),(18,22,'thumbnail_id','0'),(19,18,'product_count_product_cat','5'),(22,15,'product_count_product_cat','0'),(23,23,'order','0'),(24,23,'display_type',''),(25,23,'thumbnail_id','0'),(26,24,'order','0'),(27,24,'display_type',''),(28,24,'thumbnail_id','0'),(29,25,'order','0'),(30,25,'display_type',''),(31,25,'thumbnail_id','0'),(32,26,'order','0'),(33,26,'display_type',''),(34,26,'thumbnail_id','0'),(35,27,'order','0'),(36,27,'display_type',''),(37,27,'thumbnail_id','0'),(38,28,'order','0'),(39,28,'display_type',''),(40,28,'thumbnail_id','0'),(41,29,'order','0'),(42,29,'display_type',''),(43,29,'thumbnail_id','0'),(44,30,'order','0'),(45,30,'display_type',''),(46,30,'thumbnail_id','0'),(47,23,'product_count_product_cat','10'),(48,24,'product_count_product_cat','10'),(49,25,'product_count_product_cat','79'),(50,26,'product_count_product_cat','7'),(51,27,'product_count_product_cat','5'),(52,28,'product_count_product_cat','7'),(53,30,'product_count_product_cat','3');
/*!40000 ALTER TABLE `mb_termmeta` ENABLE KEYS */;
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
