/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for osx10.20 (arm64)
--
-- Host: localhost    Database: itabhumi
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `chitha_register`
--

DROP TABLE IF EXISTS `chitha_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `chitha_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chitha_no` varchar(45) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `circle` varchar(100) DEFAULT NULL,
  `land_holder` varchar(100) DEFAULT NULL,
  `father_husband` varchar(100) DEFAULT NULL,
  `village_ward` varchar(100) DEFAULT NULL,
  `location_description` mediumtext DEFAULT NULL,
  `land_classification` varchar(45) DEFAULT NULL,
  `land_use` varchar(45) DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  `area_possessed` varchar(45) DEFAULT NULL,
  `occupy_date` varchar(45) DEFAULT NULL,
  `crop_details` mediumtext DEFAULT NULL,
  `land_revenue` decimal(10,2) DEFAULT NULL,
  `land_revenue_paid` mediumtext DEFAULT NULL,
  `receipt_details` varchar(255) DEFAULT NULL,
  `remarks` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chitha_register`
--

LOCK TABLES `chitha_register` WRITE;
/*!40000 ALTER TABLE `chitha_register` DISABLE KEYS */;
INSERT INTO `chitha_register` VALUES
(1,'213','1','Chaglagam Circle','Pranjal Gogoi','Jibon Gogoi','Anini','Any description related to the boundary','Govt','Residential','1 Ha','0.78 Ha','May- 2005','NA',1500.00,'1500',NULL,'Nothing Special remarks are here.','2026-02-27 21:46:47','2026-02-27 21:46:47'),
(2,'213','1','Chaglagam Circle','Pranjal Gogoi','Jibon Gogoi','Anini','Any description related to the boundary','Govt','Residential','1 Ha','0.78 Ha','May- 2005','NA',1500.00,'1500','Ch: 25466/ 02-02-2006','Nothing Special remarks are here.','2026-02-27 21:47:32','2026-02-27 21:47:32');
/*!40000 ALTER TABLE `chitha_register` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `circles`
--

DROP TABLE IF EXISTS `circles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `circles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) DEFAULT NULL,
  `circle_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `district_id_idx` (`district_id`),
  CONSTRAINT `district` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `circles`
--

LOCK TABLES `circles` WRITE;
/*!40000 ALTER TABLE `circles` DISABLE KEYS */;
INSERT INTO `circles` VALUES
(1,1,'Chaglagam Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(2,1,'Goiliang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(3,1,'Hawai HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(4,1,'Hayuliang ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(5,1,'Kibithoo Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(6,1,'Manchal Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(7,1,'Metengliang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(8,1,'Walong Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(9,2,'Bordumsa ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(10,2,'Changlang HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(11,2,'Diyun EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(12,2,'Jairampur ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(13,2,'Kharsang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(14,2,'Khimiyang EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(15,2,'Lyngok Longtoi Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(16,2,'Manmao EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(17,2,'Miao ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(18,2,'Nampong SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(19,2,'Namtok EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(20,2,'Renuk','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(21,2,'Tikhak Rima Putok','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(22,2,'Vijoynagar EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(23,2,'Yatdam Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(24,3,'Anelih','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(25,3,'Anini','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(26,3,'Etalin','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(27,3,'Kronli','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(28,3,'Mipi','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(29,4,'Bameng ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(30,4,'Chayangtajo ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(31,4,'Gyawe Purang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(32,4,'Khenawa Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(33,4,'Lada Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(34,4,'Pipu Dipu Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(35,4,'Richukrong Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(36,4,'Sawa CIrcle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(37,4,'Seppa HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(38,5,'Bilat Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(39,5,'Mebo ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(40,5,'Namsing Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(41,5,'Oyan Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(42,5,'Pasighat HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(43,5,'Ruksin ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(44,6,'Dollungmukh','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(45,6,'Kamporijo','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(46,6,'Raga','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(47,7,'Palin','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(48,7,'Pipsorang','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(49,7,'Tali','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(50,7,'Yangte','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(51,8,'DAMIN CIRCLE','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(52,8,'KOLORIANG HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(53,8,'NYAPIN ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(54,8,'Parsi-Parlo','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(55,8,'SANGRAM SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(56,8,'SARLI CIRCLE','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(57,9,'Basar','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(58,9,'Daring','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(59,9,'Tirbin','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(60,10,'Sunpura','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(61,10,'Tezu','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(62,10,'Wakro','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(63,11,'Kanubari ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(64,11,'Lawnu','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(65,11,'Longding ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(66,11,'Pangchao ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(67,11,'Pumao','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(68,11,'Wakka','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(69,12,'Dambuk ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(70,12,'Desali','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(71,12,'Hunli SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(72,12,'Koronu Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(73,12,'Roing HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(74,12,'Tinali Paglam Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(75,13,'Gensi EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(76,13,'Kangku Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(77,13,'Kora Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(78,13,'Koyu EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(79,13,'Likabali SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(80,13,'Nari ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(81,13,'New Seren Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(82,13,'Sibe Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(83,14,'Chambang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(84,14,'Old Ziro SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(85,14,'Pistana Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(86,14,'Yachuli ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(87,14,'Yazali Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(88,14,'Ziro HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(89,15,'Chongkham EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(90,15,'Lathao Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(91,15,'Lekang Mahadevpur Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(92,15,'Namsai HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(93,15,'Piyong Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(94,16,'Dissing-Passo','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(95,16,'Pakke Kessang EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(96,16,'Pizirang Veo Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(97,16,'Saijosa ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(98,17,'Balijan ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(99,17,'Banderdawa','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(100,17,'Doimukh SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(101,17,'Gumto Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(102,17,'Itanagar EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(103,17,'Kakoi Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(104,17,'Kimin SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(105,17,'Leporiang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(106,17,'Mengio EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(107,17,'Naharlagun EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(108,17,'Parang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(109,17,'Sagalee ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(110,17,'Sangdupota Basar Nello Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(111,17,'Taraso Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(112,17,'Toru Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(113,18,'Mechuka ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(114,18,'Monigong EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(115,18,'Pidi Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(116,18,'Tato','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(117,19,'Boleng ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(118,19,'Jomlo Mobuk Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(119,19,'Kaying EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(120,19,'Kebang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(121,19,'Pangin EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(122,19,'Payum Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(123,19,'Rebo Perging Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(124,19,'Riga EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(125,19,'Rumgong ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(126,20,'Bongkhar Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(127,20,'DUDUNGHAR','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(128,20,'Jang ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(129,20,'Kitpi Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(130,20,'Lhou Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(131,20,'Lumla ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(132,20,'Mukto Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(133,20,'TAWANG HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(134,20,'Thingbu Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(135,20,'Zemithang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(136,21,'Dadam Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(137,21,'Khonsa HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(138,21,'Deomali ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(139,21,'Laju SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(140,21,'Soha Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(141,22,'Geku EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(142,22,'Gelling Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(143,22,'Jengging Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(144,22,'Katan Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(145,22,'Mariyang ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(146,22,'Migging Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(147,22,'Mopom Adipasi Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(148,22,'Palling Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(149,22,'Singa Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(150,22,'Tuting ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(151,22,'Yingkiong Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(152,23,'Baririjo Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(153,23,'Chetam Peer Yapu Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(154,23,'Daporijo Hq','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(155,23,'Dumporijo ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(156,23,'Giba Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(157,23,'Gite-Ripa','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(158,23,'Gussar','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(159,23,'Limeking Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(160,23,'Maro Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(161,23,'Nacho SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(162,23,'Payeng Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(163,23,'Puchi Geko Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(164,23,'Siyum ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(165,23,'Taksing','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(166,23,'Taliha','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(167,24,'Balemu','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(168,24,'Bhalukpong EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(169,24,'Bomdila HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(170,24,'Dirang ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(171,24,'Jamiri Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(172,24,'Kalaktang ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(173,24,'Kamengbari Doimara Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(174,24,'Nafra EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(175,24,'Rupa SDO','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(176,24,'Shergaon Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(177,24,'Singchung ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(178,24,'Thembang Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(179,24,'Thrizino ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(180,25,'Aalo HQ','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(181,25,'Bagra','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(182,25,'Darak Circle','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(183,25,'Kamba ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(184,25,'Liromoba EAC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(185,25,'Yomcha ADC','2026-02-23 17:20:08','2026-02-23 17:20:08'),
(186,1,'Test Circle','2026-02-25 06:33:49','2026-02-25 06:33:49');
/*!40000 ALTER TABLE `circles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` VALUES
(1,'Anjaw','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(2,'Changlang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(3,'Dibang Valley','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(4,'East Kameng','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(5,'East Siang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(6,'Kamle','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(7,'Kra Daadi','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(8,'Kurung Kumey','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(9,'Leparada','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(10,'Lohit','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(11,'Longding','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(12,'Lower Dibang Valley','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(13,'Lower Siang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(14,'Lower Subansiri','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(15,'Namsai','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(16,'Pakke Kessang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(17,'Papum Pare','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(18,'Shi Yomi','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(19,'Siang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(20,'Tawang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(21,'Tirap','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(22,'Upper Siang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(23,'Upper Subansiri','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(24,'West Kameng','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(25,'West Siang','2026-02-23 16:09:47','2026-02-23 16:09:47'),
(26,'Test District','2026-02-25 06:35:23','2026-02-25 06:35:23'),
(27,'Test District2','2026-02-25 06:36:25','2026-02-25 06:36:25');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents_uploaded`
--

DROP TABLE IF EXISTS `documents_uploaded`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents_uploaded` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_parcel_id` varchar(45) DEFAULT NULL,
  `document_details` varchar(45) DEFAULT NULL,
  `document_file` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents_uploaded`
--

LOCK TABLES `documents_uploaded` WRITE;
/*!40000 ALTER TABLE `documents_uploaded` DISABLE KEYS */;
INSERT INTO `documents_uploaded` VALUES
(2,NULL,'Jamabandi','92e2b104c362dccbbc44a4d721200efb.pdf','2026-02-27 20:40:46','2026-02-27 20:40:46'),
(3,NULL,'Caste Certificate','d4a4df6e547704a97e2d248900b88da5.pdf','2026-02-27 20:40:58','2026-02-27 20:40:58'),
(4,'2','Jamabandi','92e2b104c362dccbbc44a4d721200efb.pdf','2026-02-27 20:41:46','2026-02-27 20:41:46'),
(5,'2','Caste Certificate','d4a4df6e547704a97e2d248900b88da5.pdf','2026-02-27 20:41:46','2026-02-27 20:41:46');
/*!40000 ALTER TABLE `documents_uploaded` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land_parcel`
--

DROP TABLE IF EXISTS `land_parcel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `land_parcel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parcel_id` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `circle` varchar(45) DEFAULT NULL,
  `village_ward` varchar(45) DEFAULT NULL,
  `allotment_no` varchar(45) DEFAULT NULL,
  `dag_no` varchar(45) DEFAULT NULL,
  `map_sheet_no` varchar(45) DEFAULT NULL,
  `pattadar_name` varchar(45) DEFAULT NULL,
  `father_husband` varchar(45) DEFAULT NULL,
  `tribe_community` varchar(45) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `family_details` varchar(45) DEFAULT NULL,
  `ownership_type` varchar(45) DEFAULT NULL,
  `tenure_type` varchar(45) DEFAULT NULL,
  `area` varchar(45) DEFAULT NULL,
  `land_use` varchar(45) DEFAULT NULL,
  `north_boundary` varchar(45) DEFAULT NULL,
  `south_boundary` varchar(45) DEFAULT NULL,
  `east_boundary` varchar(45) DEFAULT NULL,
  `west_boundary` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `gis_polygon` varchar(45) DEFAULT NULL,
  `mutation_order` varchar(45) DEFAULT NULL,
  `mutation_date` varchar(45) DEFAULT NULL,
  `revenue_demand` varchar(45) DEFAULT NULL,
  `revenue_paid` varchar(45) DEFAULT NULL,
  `receipt_no` varchar(45) DEFAULT NULL,
  `last_payment_date` varchar(45) DEFAULT NULL,
  `encumbrance_no` varchar(45) DEFAULT NULL,
  `acquisition_status` varchar(45) DEFAULT NULL,
  `encroachment_status` varchar(45) DEFAULT NULL,
  `inspection_date` varchar(45) DEFAULT NULL,
  `documents_available` varchar(45) DEFAULT NULL,
  `digitisation_status` varchar(45) DEFAULT NULL,
  `entered_by` varchar(45) DEFAULT NULL,
  `verified_by` varchar(45) DEFAULT NULL,
  `last_updated_date` varchar(45) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_parcel`
--

LOCK TABLES `land_parcel` WRITE;
/*!40000 ALTER TABLE `land_parcel` DISABLE KEYS */;
INSERT INTO `land_parcel` VALUES
(1,'AS1212','1','Chaglagam Circle','Kibitoh','25','216','12','Pranjal Gogoi','Jibon Gogoi','Ahom','House no 68, Halua Gaon, Po Sasoni, Dist. Dibrugarh, Assam 786610','House no 68, Halua Gaon, Po Sasoni, Dist. Dibrugarh, Assam 786610','Y','G','P','2000 Sqm','R','North Boundary','South Boundary','East Boundary','West Boundary','','','yy','1','2026-02-26','1000','1000','123','2026-02-26','Y','Pending','NO','2026-02-20','Y','Pending','pranjal','','','Any Remarks','2026-02-27 20:41:06','2026-02-27 20:41:06'),
(2,'AS1212','1','Chaglagam Circle','Kibitoh','25','216','12','Pranjal Gogoi','Jibon Gogoi','Ahom','House no 68, Halua Gaon, Po Sasoni, Dist. Dibrugarh, Assam 786610','House no 68, Halua Gaon, Po Sasoni, Dist. Dibrugarh, Assam 786610','Y','G','P','2000 Sqm','R','North Boundary','South Boundary','East Boundary','West Boundary','','','yy','1','2026-02-26','1000','1000','123','2026-02-26','Y','Pending','NO','2026-02-20','Y','Pending','pranjal','','','Any Remarks','2026-02-27 20:41:46','2026-02-27 20:41:46');
/*!40000 ALTER TABLE `land_parcel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land_parcel_family`
--

DROP TABLE IF EXISTS `land_parcel_family`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `land_parcel_family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_parcel_id` int(11) DEFAULT NULL,
  `person_name` varchar(100) DEFAULT NULL,
  `relationship` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_parcel_family`
--

LOCK TABLES `land_parcel_family` WRITE;
/*!40000 ALTER TABLE `land_parcel_family` DISABLE KEYS */;
INSERT INTO `land_parcel_family` VALUES
(1,1,'Jibon Gogoi','Father','78','2026-02-27 20:41:06','2026-02-27 20:41:06'),
(2,1,'Arna Gogoi','Mother','65','2026-02-27 20:41:06','2026-02-27 20:41:06'),
(3,2,'Jibon Gogoi','Father','78','2026-02-27 20:41:46','2026-02-27 20:41:46'),
(4,2,'Arna Gogoi','Mother','65','2026-02-27 20:41:46','2026-02-27 20:41:46');
/*!40000 ALTER TABLE `land_parcel_family` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pattadar_history`
--

DROP TABLE IF EXISTS `pattadar_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pattadar_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_parcel_id` int(11) DEFAULT NULL,
  `Pattadar_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `pattadar_land_idx` (`land_parcel_id`),
  CONSTRAINT `pattadar_land` FOREIGN KEY (`land_parcel_id`) REFERENCES `land_parcel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pattadar_history`
--

LOCK TABLES `pattadar_history` WRITE;
/*!40000 ALTER TABLE `pattadar_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `pattadar_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revenue_payments`
--

DROP TABLE IF EXISTS `revenue_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `revenue_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_parcel_id` varchar(45) DEFAULT NULL,
  `revenue_amount` decimal(10,2) DEFAULT NULL,
  `paid_status` varchar(45) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_session` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revenue_payments`
--

LOCK TABLES `revenue_payments` WRITE;
/*!40000 ALTER TABLE `revenue_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `revenue_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `role` varchar(45) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'admin','admin','Admin','admin@itabhumi.com','admin',0,NULL,'2026-02-24 06:18:56','2026-02-24 06:37:30'),
(2,'pranjal','$2y$10$A8QLzgBZ7JL9rQKuUfIdL.1m6Sg7N6V4tee1KB9Wy6hOEBeL7NtCC','pranjal@itabhumi.com','Pranjal Gogoi','admin',0,NULL,'2026-02-24 07:48:06','2026-02-24 07:55:01');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `village_wards`
--

DROP TABLE IF EXISTS `village_wards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `village_wards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) DEFAULT NULL,
  `circle_id` int(11) DEFAULT NULL,
  `village_ward_name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `districts_idx` (`district_id`),
  KEY `circles_idx` (`circle_id`),
  CONSTRAINT `circles` FOREIGN KEY (`circle_id`) REFERENCES `circles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `districts` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `village_wards`
--

LOCK TABLES `village_wards` WRITE;
/*!40000 ALTER TABLE `village_wards` DISABLE KEYS */;
/*!40000 ALTER TABLE `village_wards` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-02-28 15:46:27
