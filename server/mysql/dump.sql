-- MySQL dump 10.10
--
-- Host: localhost    Database: webtycoon
-- ------------------------------------------------------
-- Server version	5.0.27-community

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
-- Table structure for table `12`
--

DROP TABLE IF EXISTS `12`;
CREATE TABLE `12` (
  `12` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `12`
--

LOCK TABLES `12` WRITE;
/*!40000 ALTER TABLE `12` DISABLE KEYS */;
/*!40000 ALTER TABLE `12` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `desc` varchar(50) collate latin1_general_ci NOT NULL,
  `file` varchar(50) collate latin1_general_ci NOT NULL,
  `cost` float NOT NULL,
  `get` float NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Grasfl&auml;che bauen','gras.php',100,0),(2,'Steinfl&auml;che bauen','stein.php',150,0),(3,'Wasserfl&auml;che bauen','wasser.php',200,0),(4,'Zeltplatz bauen','zelt.php',50,0),(5,'Wohnwagenplatz bauen','wohnwagen.php',200,0),(6,'Stra&szlig; bauen','strasse.php',90,0),(7,'Baum pflanzen','baum.php',20,0),(8,'Spielplatz bauen','spielplatz.php',700,0),(9,'Spielhalle bauen','spielhalle.php',1000,0),(10,'Internet Caf&eacute; bauen','inetcafe.php',1500,0),(11,'T&auml;gliche Bilanz','showbilanzwindow.php',0,0),(12,'Ihre aktuellen Werbekampangen','werbung.php',0,0),(13,'Besucher Ihres Campingplatzes','besucher.php',0,0),(14,'Reparieren Sie defekte Einrichtungen','reparieren.php',250,0),(15,'Einen Feuerplatz bauen','feuer.php',50,0),(16,'Welches Element soll abgerissen werden?','demolish.php',100,0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maps`
--

DROP TABLE IF EXISTS `maps`;
CREATE TABLE `maps` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `map` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `maps`
--

LOCK TABLES `maps` WRITE;
/*!40000 ALTER TABLE `maps` DISABLE KEYS */;
INSERT INTO `maps` VALUES (1,1,'eNrt2sFOg0AUheF36RPcOS0tDE9ToyYk7oyrpu9u1NSVxt8MAxTOjiFnxeELZOaec2ryZcjRn7Pi+ypfXnOTd8/D08vjrh9y6j/XD2/D1zr668dNmhRO7nHygJMNTh5x8oSTLU52/Mn/oyTeUuI1Jd5T4kUl3lTiVSXeVeJlJdrWDYpxGdfycInjEscljkuluGRcxnX3uILjiiq49COuvXEZl3G1PNrB6O1VNS7j2spv4ZS4GuMyLuOqg+toXMY1IS7d0YZGMa6TcRlXKS6tE1fxhkZrXMYl/motE9dCz7k649oSLs2Na1uHyB7RGEGXsC5hXeK6NLcuj2j8omuGGQ1hXcK6hHUJ65J1+dtVpmu0IQ1V0BVYV2BdgXUF1hUVdAXXFVxXcF2xzj2NSXX9MaWhCrpiw7pilbqC6wquK+beMSzXdRhLV1iXdc2lK5ao6/oOn/PuuQ=='),(2,2,'eNrt2k1qwzAQxfG75ATz5Dx/yKdJaQuG7kpXIXcvtLQrpbyQjmNZs7PhvxM/JI91ymA+L9nmU072+5TP75n58Lq8vD0f5iWn+ev96WP5frf5smTIZZLLTi6PcslSaaWyl8tBLke5nOQSNyySvkooLhOKaaenRz2lnvZ6OujpqKeTmP5AWRcXHoorVYIrueBC4FoRV/ovXHDABRkXHHAlB1zJAxcC1zZxdX/jwu5wwQFXClyBq4DrGLiu4YIDLsi4ELiqx8XAdT8ubAsXdVzUcVHHRR0XdVzUcVHHRUdc/T5xQcYFGRdkXJBxQcYFF1yxc3nuXENNuCjjooyLMi7KuCjjooyLgas6XGMcC1s+FraHy3Rcdi+uKXAFrm3iMh2XPRqXlX8i2226KOuirItxLmznXGhN6ULrI420v5HG6sN4q0iXz1fXFV0pBoZ16Fr9V5dVpGur1wvjloaDrrRZXVaRrh1c3o1rGvXvXVaRrobm8ZdPt5LvUQ==');
/*!40000 ALTER TABLE `maps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `amount` float NOT NULL,
  `desc` varchar(50) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,1041,'Abrechnung Tag 1'),(2,2,208,'Abrechnung Tag 1'),(3,1,2082,'Abrechnung Tag 2'),(4,2,416,'Abrechnung Tag 2'),(5,1,3123,'Abrechnung Tag 3'),(6,2,624,'Abrechnung Tag 3');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `session` varchar(32) collate latin1_general_ci NOT NULL,
  `lastaction` int(11) NOT NULL,
  `username` varchar(50) collate latin1_general_ci NOT NULL,
  `password` varchar(32) collate latin1_general_ci NOT NULL,
  `email` varchar(250) collate latin1_general_ci NOT NULL,
  `money` float NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'58da7fffc704a7dd1fffde500caa5271',0,'Filbert','06a6077b0cfcb0f4890fb5f2543c43be','einfachsaufen@gmail.com',967850),(2,'',0,'Testuser','5d9c68c6c50ed3d02a2fcf54f63993b6','test@tester.de',8420);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2007-03-23  8:48:48
