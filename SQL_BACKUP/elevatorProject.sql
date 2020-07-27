-- MySQL dump 10.16  Distrib 10.1.23-MariaDB, for debian-linux-gnueabihf (armv7l)
--
-- Host: localhost    Database: elevatorProject
-- ------------------------------------------------------
-- Server version	10.1.23-MariaDB-9+deb9u1

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
-- Table structure for table `authorizedUsers`
--

DROP TABLE IF EXISTS `authorizedUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authorizedUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authorizedUsers`
--

LOCK TABLES `authorizedUsers` WRITE;
/*!40000 ALTER TABLE `authorizedUsers` DISABLE KEYS */;
INSERT INTO `authorizedUsers` VALUES (1,'TAnnette3903','admin123'),(2,'DDreise6630','admin123'),(3,'BHarkness8050','admin123'),(4,'JTurcotte0406','admin123'),(5,'MGalle','admin123'),(6,'ATehrani','admin123');
/*!40000 ALTER TABLE `authorizedUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elevatorNetwork`
--

DROP TABLE IF EXISTS `elevatorNetwork`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elevatorNetwork` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `nodeID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL,
  `currentFloor` tinyint(4) NOT NULL,
  `requestedFloor` tinyint(4) NOT NULL,
  `numberOfVisits` int(10) unsigned NOT NULL,
  `otherInfo` text,
  PRIMARY KEY (`nodeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elevatorNetwork`
--

LOCK TABLES `elevatorNetwork` WRITE;
/*!40000 ALTER TABLE `elevatorNetwork` DISABLE KEYS */;
INSERT INTO `elevatorNetwork` VALUES ('2020-07-27','15:10:43',1,1,1,1,0,'na'),('2020-07-27','15:14:53',2,1,1,1,0,'na');
/*!40000 ALTER TABLE `elevatorNetwork` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elevatorQueue`
--

DROP TABLE IF EXISTS `elevatorQueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elevatorQueue` (
  `queueNumber` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sourceNode` tinyint(3) unsigned NOT NULL,
  `destinationFloor` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`queueNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elevatorQueue`
--

LOCK TABLES `elevatorQueue` WRITE;
/*!40000 ALTER TABLE `elevatorQueue` DISABLE KEYS */;
INSERT INTO `elevatorQueue` VALUES (1,'0000-00-00 00:00:00',1,2),(2,'2020-07-27 16:40:27',1,1),(3,'2020-07-27 16:41:20',1,3),(4,'2020-07-27 16:41:30',2,1);
/*!40000 ALTER TABLE `elevatorQueue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'elevatorProject'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-27 16:51:37
