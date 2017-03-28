<?php
// db class
require_once('../src/util/db.php');

// Reception od form makeing database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['awesome'])) {
        $db=new db();
        $sql = $_POST['awesome'];
        $db->conn->query($sql);
        
    }
}
//Creates new Database connection object,
$db = new db();

// If there is no connection writes out information
if ($db->conn == null) {
    echo "<h3>Brak połączenia z bazą danych</h3>";
    echo "<h3>Otwórz plik src/util/db.php i zmień domyślne wartości host,user i pass </h3>";
    exit;
}
// If there is no twitter Database writes out message
if ($db->changeDB('twitters') == false) {
    echo "<h3>Wygląda na to że nie masz bazy danych 'twitter'</h3>";
    echo "Jeśli chcesz stworzymy razem tę bazę danych.<br><br>Spróbuj załadować z pliku w folderze database o nazwie twitter.sql "
    . "potrzebną bazę danych<br>";
    echo "<br> A jeśli wolisz, wyślij poniższy formularz. Zrobi to za Ciebie.<br><br><br>";
}

//If there IS proper database redirects to index.php (for example after using form below
if ($db->conn !=null && $db->changeDB('twitter') != false) {
        header('Refresh: 0; url= ../index.php');
}

?>

<!--Form sending sql querys to make database twitter with tables and mr. President user-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tweeter Main Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <form action="" method="post" role="form">
            <button type="submit" class="btn btn-success">Stwórz bazę danych</button>
            <br>
                    <textarea name='awesome'>
CREATE DATABASE IF NOT EXISTS twitter;
USE twitter;

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
INSERT INTO users VALUES(null, 'Lech W', 'prezydent@gov.pl', 'prezydent');
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
        </textarea>
        </form>
    </body>
</html>