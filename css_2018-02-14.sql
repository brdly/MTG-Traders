# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.38)
# Database: css
# Generation Time: 2018-02-14 22:32:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Adverts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Adverts`;

CREATE TABLE `Adverts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cardid` int(11) unsigned NOT NULL,
  `ownerid` int(11) unsigned NOT NULL,
  `condition` int(11) unsigned NOT NULL,
  `price` float NOT NULL,
  `expirydate` datetime NOT NULL,
  `imgname` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `cardid` (`cardid`),
  KEY `ownerid` (`ownerid`),
  CONSTRAINT `adverts_ibfk_1` FOREIGN KEY (`cardid`) REFERENCES `Cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `adverts_ibfk_2` FOREIGN KEY (`ownerid`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Cards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Cards`;

CREATE TABLE `Cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `setid` int(11) unsigned NOT NULL,
  `cardname` varchar(255) NOT NULL DEFAULT '',
  `manacost` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(511) DEFAULT NULL,
  `flavourtext` varchar(511) DEFAULT NULL,
  `cardtype` varchar(255) NOT NULL DEFAULT '',
  `uncommon` tinyint(1) NOT NULL DEFAULT '0',
  `rare` tinyint(1) NOT NULL DEFAULT '0',
  `mythic` tinyint(1) NOT NULL DEFAULT '0',
  `power` int(11) DEFAULT NULL,
  `toughness` int(11) DEFAULT NULL,
  `loyalty` int(11) DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `setID` (`setid`),
  CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`setid`) REFERENCES `sets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Sets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Sets`;

CREATE TABLE `Sets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `setname` varchar(60) NOT NULL DEFAULT '',
  `setcode` varchar(3) NOT NULL DEFAULT '',
  `block` tinyint(2) NOT NULL,
  `core` tinyint(2) NOT NULL,
  `other` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table Users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `addrline1` varchar(255) NOT NULL DEFAULT '',
  `addrline2` varchar(255) DEFAULT NULL,
  `addrline3` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `postcode` varchar(255) NOT NULL DEFAULT '',
  `phonenum` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `EMAIL` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
