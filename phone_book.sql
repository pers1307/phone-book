-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: phone_book
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `phones`
--

DROP TABLE IF EXISTS `phones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `surname` varchar(255) DEFAULT '',
  `phone` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `path_image` text,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phones_users_fk` (`userId`),
  CONSTRAINT `phones_users_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phones`
--

LOCK TABLES `phones` WRITE;
/*!40000 ALTER TABLE `phones` DISABLE KEYS */;
INSERT INTO `phones` VALUES (1,'1111','222','1212','sk@mail.ru','/upload/fon-devushka-elfiika.jpg',1),(2,'Ð®Ñ€Ð¸Ð¹','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','+7 (000) 000-00-00','skulines@gmail.com','/upload/upwork.jpeg',1),(8,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','1212','skulines@gmail.com','/upload/19609787.jpg',1),(9,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','test','skulines@gmail.com','',1),(11,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²!','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','1','skulines@gmail.com','/upload/keep-calm-and-practice-english-4.jpg',1),(12,'Ð®Ñ€Ð¸Ð¹','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','23','skulines@gmail.com','/upload/gabriel-gajdos-by-gabriel-gajdos-from-the-edge-planet-space.jpg',1),(17,'Ð®Ñ€Ð¸Ð¹','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','233','skulines@gmail.com','/upload/fon-devushka-elfiika.jpg',1),(18,'Ð®Ñ€Ð¸Ð¹','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','233','skulines@gmail.com','',1),(21,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','test','skulines@gmail.com','/upload/gabriel-gajdos-by-gabriel-gajdos-anthology-nebula-space.jpg',1),(23,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','1000','skulines@gmail.com','/upload/screenshot_20190812_134959.png',1),(24,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','2000','skulines@gmail.com','/upload/sneg-snezhinki-snow-snowflakes-2019-god-svini-god-2019-minim.jpg',1),(25,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','3000','skulines@gmail.com','/upload/vadim-sadovski-by-vadim-sadovski-nebula.jpg',1),(26,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','4000','skulines@gmail.com','/upload/zvezdy-planeta-kosmos-planety-planets-art-stars-space-art-sp.jpg',1),(27,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','5000','skulines@gmail.com','/upload/zvezdy-planeta-kosmos-planety-planets-art-stars-space-art-sp.jpg',1),(28,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','1001212','skulines@gmail.com','/upload/woocommerce-logo.jpg',1),(29,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','1000000','skulines@gmail.com','/upload/vadim-sadovski-by-vadim-sadovski-the-end.jpg',1),(30,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','2000000','skulines@gmail.com','/upload/sneg-snezhinki-snow-snowflakes-2019-god-svini-god-2019-minim.jpg',1),(31,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','5000000','skulines@gmail.com','/upload/selection_001.png',1),(32,'Ð®Ñ€Ð¸Ð¹ ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','ÐŸÐµÑ€ÐµÑÐºÐ¾ÐºÐ¾Ð²','1001212','skulines@gmail.com','/upload/screenshot_20190806_141138.png',1);
/*!40000 ALTER TABLE `phones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'pers1307','202cb962ac59075b964b07152d234b70','skulines@mail.ru'),(2,'qwerty1','6dbd0fe19c9a301c4708287780df41a2','skulines@gmail.com');
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

-- Dump completed on 2020-01-26 21:17:31
