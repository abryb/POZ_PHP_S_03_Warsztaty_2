-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: twitter
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `text` varchar(140) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `postId` (`postId`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `tweets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,35,13,NULL,'2017-03-26 14:25:28'),(2,35,13,'Kolorki nie kolorki bootstrapy prapy','2017-03-26 14:25:44'),(3,35,13,'Kolorki nie kolorki bootstrapy prapy','2017-03-26 14:26:09'),(4,35,13,'54545','2017-03-26 14:27:00'),(5,35,13,'dfdsf','2017-03-26 14:28:17'),(6,35,13,'dfdsf','2017-03-26 14:29:33'),(7,35,13,'dfdsf','2017-03-26 14:30:43'),(8,35,13,'fsdf','2017-03-26 14:46:27'),(9,35,13,'fsdf','2017-03-26 14:47:11'),(10,35,13,'fsdf','2017-03-26 14:47:49'),(11,35,12,'To nie Anglia','2017-03-26 14:48:09'),(12,35,12,'To nie Francja','2017-03-26 14:56:01'),(13,35,1,'Janusz co ty robisz','2017-03-26 14:59:37'),(14,35,1,'Janusz co ty robisz','2017-03-26 15:00:44'),(15,35,1,'Janusz co ty robisz','2017-03-26 15:01:25'),(16,35,1,'Dobra koniec','2017-03-26 15:02:08'),(17,35,15,'Och ty','2017-03-26 15:02:20'),(18,35,8,'Kifds fdsfd df ','2017-03-26 18:02:03'),(19,35,15,'Kafka nie rÃ³b tego','2017-03-26 18:20:18'),(20,35,15,'gfdgf','2017-03-26 18:25:44'),(21,40,21,'Co robisz','2017-03-26 20:10:54'),(22,41,24,'fdfdf','2017-03-26 21:53:33'),(23,41,24,'dfdf','2017-03-26 21:53:34'),(24,41,24,'kupa','2017-03-26 21:53:36'),(25,41,24,'eret','2017-03-26 21:53:39'),(26,41,24,'fdsf','2017-03-26 21:53:41'),(27,37,25,'kjlk','2017-03-27 08:22:49'),(28,40,26,'fdsfdsf','2017-03-27 12:03:53'),(29,40,20,'fdfdf','2017-03-27 20:49:55'),(30,40,25,'r','2017-03-27 21:13:33');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `text` varchar(140) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `senderId` (`senderId`),
  KEY `receiverId` (`receiverId`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(2,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(3,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(4,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(5,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(6,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(7,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(8,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(9,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(10,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(11,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(12,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(13,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(14,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(15,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(16,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(17,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(18,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(19,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(20,40,41,'WiadomoÅ›Ä‡ do Kafki','2017-03-27 20:01:51',1),(43,41,40,'Kafka ty mendo co ty robisz jak ty sie zachowujesz co byÄ‡','2017-03-27 20:46:44',1),(44,41,40,'Kafka ty mendo co ty robisz jak ty sie zachowujessz fdfd f','2017-03-27 20:47:09',1),(45,1,40,'WiadomoÅ›c przykÅ‚adowa to jest kliknij PREZENT nie ma prezentu','2017-03-27 21:04:29',1),(46,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:07:23',1),(47,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:10:51',1),(48,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:10:57',1),(49,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:02',1),(50,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:04',1),(51,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:04',1),(52,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:05',1),(53,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:05',1),(54,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:29',1),(55,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:30',1),(56,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:30',1),(57,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:31',1),(58,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:31',1),(59,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:31',1),(60,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:31',1),(61,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:32',1),(62,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:32',1),(63,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:32',1),(64,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:32',1),(65,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:32',1),(66,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:51',1),(67,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:51',1),(68,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:11:52',1),(69,42,40,'A jak siÄ™ nie wie, co siÄ™ buduje, to nawet szaÅ‚asu nie moÅ¼na rozbieraÄ‡, bo deszcz na gÅ‚owÄ™ bÄ™dzie padaÅ‚.','2017-03-27 21:12:51',1),(70,40,42,'fdsf','2017-03-27 21:13:03',NULL);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `text` varchar(141) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (1,1,'fdsf','2017-03-25 22:41:06'),(2,1,'nasz michal 52 to baju baju ','2017-03-26 08:17:00'),(3,30,'gfdgfdg','2017-03-26 12:29:59'),(4,30,'nowy tweet','2017-03-26 12:30:05'),(5,30,'nowy tweet','2017-03-26 12:30:38'),(6,30,'nowy tweet','2017-03-26 12:31:20'),(7,30,'a teraz?','2017-03-26 12:31:35'),(8,30,'a teraz?','2017-03-26 12:33:10'),(9,30,'a teraz?','2017-03-26 12:34:15'),(10,30,'a teraz?','2017-03-26 12:34:54'),(11,35,'Ameryka','2017-03-26 13:26:52'),(12,35,'Ameryka','2017-03-26 13:27:30'),(13,35,'Do jakiego uÅ›miechu jest pan zdolny?','2017-03-26 13:48:29'),(14,35,'Do jakiego uÅ›miechu jest pan zdolny?','2017-03-26 13:49:23'),(15,35,'ZaczÄ…Å‚ uprawiaÄ‡ joging i rozmawiaÄ‡ z satanistami.','2017-03-26 13:50:02'),(16,35,'Twit kafki','2017-03-26 18:32:11'),(17,35,'Tweet prÃ³bny','2017-03-26 19:34:53'),(18,4,'jjj','2017-03-26 19:37:12'),(19,37,'ho ho o hoho f d f','2017-03-26 19:57:33'),(20,37,'fdgfdg','2017-03-26 20:00:26'),(21,37,'no co tam','2017-03-26 20:10:00'),(22,40,'no nic','2017-03-26 20:10:44'),(23,40,'fdf','2017-03-26 20:31:35'),(24,40,'fdf','2017-03-26 20:46:45'),(25,41,'fdfdf','2017-03-26 21:51:38'),(26,40,'dsfdf','2017-03-27 12:03:13');
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `passwordHash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Janusz z Obornik 6','janusz140@wp.pl','827ccb0eea8a706c4c34a16891f84e7b'),(2,'Janusz z Obornik 2','janusz147@wp.pl','55d491cf951b1b920900684d71419282'),(4,'To nie jest Krzysztof','janusz145@wp.pl','8a13dab3f5ec9e22d0d1495c8c85e436'),(5,'Janusz z Obornik 8','janusz141@wp.pl','f190ce9ac8445d249747cab7be43f7d5'),(7,'Janusz z Obornik 7','janusz148@wp.pl','ee25f924b7df4d4fb93b3da96ee342b1'),(9,'marek2','co','55d491cf951b1b920900684d71419282'),(25,'Janusz z Obornik 1','janusz146@wp.pl','1c104b9c0accfca52ef21728eaf01453'),(26,'Janusz z Obornik 27','janusz1414@wp.pl','e15894f5df1034cf1b7486418ac3dadd'),(27,'Michal z Gdanska 89','michal7@wp.pl','412544c15cf11f6034cd128755e9087a'),(28,'userZFormularza','userZFormularza','b50d454c76ce40b2ed83a63e13be2160'),(29,'user','user','ee11cbb19052e40b07aac0ca060c23ee'),(30,'user2','user2','$2y$11$CUsuseJrwb19oT9hcDMBueT5gyjTtW.Y26kqRiOgH48eG7LyshwFC'),(32,'ewa','ewa','$2y$11$.y46Y9JktVHsK6JphJPrteJpyvdcKDI38NFPIccV.gZDbB0ZINX5.'),(34,'fgfdg','kafkacoszrobi','$2y$11$RHQR61MvKHaMycLTdSZKhu9NgqoNwQti0iCCAh4qFidK6Em.ZAgoq'),(35,'Franc','KafkaZPragi@praga.cz','$2y$11$TUFi8gB4aMNoKopdX1LTm.3G7wc7hUjdRZ/CsqjEUXELdKoerKtly'),(36,'WisÅ‚awa Szymborska','klawiatura@op.pl','$2y$11$7TJyYr2pGhZSNSmfI.mSQuW9MyJzVzwOOloUvbSNGwoMUiZ6XH7xi'),(37,'Ty','Ty@ty','$2y$11$HKt/zONxQv6ZHD1MgCXCk.zYgIrQ07HifMxdZC5trenXyx3lsDbv.'),(38,'f g dg tgFranc','ffgft46  sg','$2y$11$eBq6P2gXBQBnHthGl6VgyukAovj4oqQuel6yXqP4Pu3Bvu5HSEYva'),(39,'Francvcxdf','dsf','$2y$11$jIm2zdJQH2EQQKaFGrVASuEtbRIKg/jtn/IbSoMa/TOZA7BFfxdte'),(40,'Kafka','Frank','$2y$11$CR1Werd1oeEs700b1b7mF.7wLAZ/HoewRA95dqfMiWnVvjbuCLvpy'),(41,'urna','urna','$2y$11$AJ5U0w/bUbnObksWRrCQqOaOzxODdIfbPA1BaL5RIh.C1j0OK/lq6'),(42,'elektryka@gov.pl','Lech WaÅ‚Ä™sa','$2y$11$Op6.mqc7vqera/rKbQZDMO18AvH2G/0VYWnP2emMk8e0drLlPocCC');
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

-- Dump completed on 2017-03-27 23:15:22
