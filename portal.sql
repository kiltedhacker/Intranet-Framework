-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: portal
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `podcast`
--

DROP TABLE IF EXISTS `podcast`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `podcast` (
  `id` int(6) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `display_date` varchar(100) NOT NULL,
  `save_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `string_date` int(20) DEFAULT NULL,
  PRIMARY KEY (`display_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podcast`
--

LOCK TABLES `podcast` WRITE;
/*!40000 ALTER TABLE `podcast` DISABLE KEYS */;
INSERT INTO `podcast` VALUES (3,'Podcast Title 1','17 October 2017 | 12:01 am','2018-01-02 21:51:27',NULL),(8,'Podcast Title 2','19 December 2017 | 8:43 am','2018-01-01 18:57:37',NULL),(1,'Podcast title 3','19 September 2017 | 12:01 am','2018-01-02 21:52:09',NULL);
/*!40000 ALTER TABLE `podcast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `department` text NOT NULL,
  `extension` int(6) NOT NULL,
  `email` text,
  `manager` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Dept 1',1111,NULL,NULL),(2,'Dept 2',2222,NULL,NULL),(3,'Dept 3',3333,NULL,NULL),(4,'Dept 4',4444,NULL,NULL),(5,'Dept 5',5555,NULL,NULL),(6,'Dept 6',6666,NULL,NULL),(7,'Dept 7',7777,NULL,NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS `feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feeds` (
  `title` varchar(300) NOT NULL,
  `content` longtext,
  `link` text,
  `display_date` varchar(100) DEFAULT NULL,
  `save_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `feed_type` text,
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feeds`
--

LOCK TABLES `feeds` WRITE;
/*!40000 ALTER TABLE `feeds` DISABLE KEYS */;
INSERT INTO `feeds` VALUES ('&amp;#x26;#xa;PDF documents &amp;#x26; URLs: video, (Tue, Jan 2nd)','\n<p>I received some questions about my diary entry <a href=\"https://isc.sans.edu/forums/diary/PDF&amp;#x2b;documents&amp;%23x2b;URLs&amp;%23x2b;update/23167/\">\"PDF documents &amp; URLs: update\"</a>, and to beter explain the analysis method, I created a <a href=\"https://www.youtube.com/watch?v=aikgbbbK5co\">video</a>.</p>\r','https://isc.sans.edu/diary/rss/23181','2 January 2018 | 4:50 pm','2018-01-03 16:28:54','external');
/*!40000 ALTER TABLE `feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_lists`
--

DROP TABLE IF EXISTS `ip_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip_lists` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `ip_use` text NOT NULL,
  `ip_range` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_lists`
--

LOCK TABLES `ip_lists` WRITE;
/*!40000 ALTER TABLE `ip_lists` DISABLE KEYS */;
INSERT INTO `ip_lists` VALUES (1,'List 1','111.111.111.111<br>111.111.111.112<br>111.111.111.113/27'),(2,'List 2','222.222.222.0/21<br>222.222.222.1/19<br>222.222.222.3/21'),(3,'List 3','333.333.333.333/28');
/*!40000 ALTER TABLE `ip_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `type` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (1,'Dashboard Sorter','/portal/content/downloads/dashboard-sorter.user.js','Sentinel Downloads'),(2,'SMART Exclusions Improvements','/portal/content/downloads/SMART-Exclusions-Improvements.user.js','Sentinel Downloads'),(3,'CRM Links in New Tab','/portal/content/downloads/crmnewtab.user.js','Sentinel Downloads'),(4,'Dashboard Menu Extender','/tools/dashboard-menu-extender.user.js','Sentinel Downloads'),(5,'Hostgator cPanel Button','/portal/content/downloads/hostgatorcpanel.user.js','Sentinel Downloads'),(6,'SABER - Firefox','https://drive.google.com/open?id=*','Sentinel Downloads'),(7,'Google Webmaster Tools','https://www.google.com/webmasters/tools','Sentinel Tools'),(8,'Bing Webmaster Tools','https://www.bing.com/webmaster/home/dashboard','Sentinel Tools'),(9,'WordPress Release Archive','https://wordpress.org/download/release-archive','Sentinel Tools'),(10,'Drupal Release Archive','https://www.drupal.org/node/3060/release','Sentinel Tools'),(11,'Symptom Guidelines','/portal/content/downloads/SymptomGuidelines.pdf','Downloads Menu'),(12,'WordPress Codex','https://codex.wordpress.org','Resources Menu'),(13,'DNS Watch','http://www.dnswatch.info','Resources Menu'),(14,'Email Header Analyzer','https://toolbox.googleapps.com/apps/messageheader/','Resources Menu'),(15,'Firewall Error Codes','https://company.zendesk.com/hc/en-us/articles/Common-Errors','Resources Menu'),(17,'Google Webmaster Tools','http://www.google.com/webmasters/tools/home?hl=en','Resources Menu'),(18,'WordPress Release Archive','https://wordpress.org/download/release-archive/','Resources Menu'),(19,'Botopedia','http://www.botopedia.org','Resources Menu'),(20,'SECCON Training Manual','https://docs.google.com/document/d/1T6HJXU7IupfrgMHjTOoVlAnBhlE9KDsqyWtkmY6JPKk/edit','Sentinel Training'),(21,'VIM Adventures','https://vim-adventures.com','Sentinel Training'),(22,'Regex Golf','https://alf.nu/RegexGolf','Sentinel Training'),(23,'The Big Sheet','https://docs.google.com/spreadsheets/d/docid','Sentinel Tracking'),(24,'Wish List','https://docs.google.com/document/d/docid','Sentinel Tracking'),(25,'Trend Tracking','http://localserver/trends','Sentinel Tracking'),(26,'SABER - Chrome','https://chrome.google.com/webstore/detail/saber/extensionid/related','Sentinel Downloads'),(36,'PCI Mitigation Plan','https://docs.google.com/document/d/docid','Downloads Menu');
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_alerts`
--

DROP TABLE IF EXISTS `site_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_alerts` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `submitted_by` varchar(30) DEFAULT NULL,
  `submitted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permanent` int(2) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_alerts`
--

LOCK TABLES `site_alerts` WRITE;
/*!40000 ALTER TABLE `site_alerts` DISABLE KEYS */;
INSERT INTO `site_alerts` VALUES (1,'Admin Down','We are aware of an issue with access to Admin. We are working on the issue, and will have it back to normal as quickly as possible.',NULL,'2017-08-08 20:53:49',1,1);
/*!40000 ALTER TABLE `site_alerts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-21 15:23:12
