-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: cvjdb
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `admin_FN` varchar(45) DEFAULT NULL,
  `admin_LN` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agency`
--

DROP TABLE IF EXISTS `agency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agency` (
  `agency_id` int(11) NOT NULL AUTO_INCREMENT,
  `agency_name` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agency`
--

LOCK TABLES `agency` WRITE;
/*!40000 ALTER TABLE `agency` DISABLE KEYS */;
INSERT INTO `agency` VALUES (1,'casting_couch',NULL);
/*!40000 ALTER TABLE `agency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `billing` (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_billed` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `costid` int(11) DEFAULT NULL,
  PRIMARY KEY (`billing_id`),
  UNIQUE KEY `event_id_UNIQUE` (`event_billed`),
  KEY `fk_billing_event1` (`event_billed`),
  CONSTRAINT `fk_billing_event1` FOREIGN KEY (`event_billed`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing`
--

LOCK TABLES `billing` WRITE;
/*!40000 ALTER TABLE `billing` DISABLE KEYS */;
/*!40000 ALTER TABLE `billing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_ref`
--

DROP TABLE IF EXISTS `category_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_ref` (
  `category_no` tinyint(1) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL,
  PRIMARY KEY (`category_no`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_ref`
--

LOCK TABLES `category_ref` WRITE;
/*!40000 ALTER TABLE `category_ref` DISABLE KEYS */;
INSERT INTO `category_ref` VALUES (1,'Centerpiece'),(2,'Chair'),(3,'Table'),(4,'Utensils'),(5,'Flowers'),(6,'Equipment'),(7,'Linen');
/*!40000 ALTER TABLE `category_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tel_no` varchar(45) DEFAULT NULL,
  `fax_no` varchar(45) DEFAULT NULL,
  `mob_no` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Dela Paz','rose@gmail.com','8018271',NULL,'09178811393','TAft Ave., Malate, Manila',15,NULL,NULL),(3,'Jeremy Ocampo','itsoneseno@gmail.com','8426250',NULL,'09369455269','Rizal Village, Alabang, Muntinlupa City',16,NULL,NULL),(4,'Gerald Anderson','gerald.anderson@gmail.com','8109258',NULL,'09178498527','Ayala Alabang, Alabang, Muntinlupa City',17,NULL,NULL),(5,'March Eusebio','march@gmail.com','123',NULL,'321','123abc',18,'2019-08-08 20:13:33','2019-08-08 20:13:33');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Red'),(2,'Orange'),(3,'Yellow'),(4,'Green'),(5,'Blue'),(6,'Violet'),(7,'Black'),(8,'White'),(9,'Brown'),(10,'Silver'),(11,'Gold'),(12,'Pink');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_feedback`
--

DROP TABLE IF EXISTS `customer_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `feedback_type` varchar(45) NOT NULL,
  `feedback` longtext NOT NULL,
  PRIMARY KEY (`feedback_id`),
  KEY `fk_client_idx` (`client_id`),
  CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_feedback`
--

LOCK TABLES `customer_feedback` WRITE;
/*!40000 ALTER TABLE `customer_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `damaged_inventory`
--

DROP TABLE IF EXISTS `damaged_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `damaged_inventory` (
  `damaged_id` int(5) NOT NULL,
  `quantity` int(7) DEFAULT NULL,
  `datereported` datetime DEFAULT CURRENT_TIMESTAMP,
  `event_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`damaged_id`),
  KEY `fk_event_name_idx` (`event_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `damaged_inventory`
--

LOCK TABLES `damaged_inventory` WRITE;
/*!40000 ALTER TABLE `damaged_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `damaged_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deployed_inventory`
--

DROP TABLE IF EXISTS `deployed_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deployed_inventory` (
  `event_deployed` int(11) NOT NULL,
  `inventory_deployed` int(5) NOT NULL,
  `quantity` int(7) NOT NULL,
  `date_deployed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`inventory_deployed`),
  UNIQUE KEY `event_deployed_UNIQUE` (`event_deployed`),
  KEY `fk_event_deployment_inventory1_idx` (`inventory_deployed`),
  CONSTRAINT `fk_event_deployment_event1` FOREIGN KEY (`event_deployed`) REFERENCES `event` (`event_id`),
  CONSTRAINT `fk_event_deployment_inventory1` FOREIGN KEY (`inventory_deployed`) REFERENCES `inventory` (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deployed_inventory`
--

LOCK TABLES `deployed_inventory` WRITE;
/*!40000 ALTER TABLE `deployed_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `deployed_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(45) NOT NULL,
  `employee_FN` varchar(45) NOT NULL,
  `employee_LN` varchar(45) NOT NULL,
  `employee_type` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `fk_employee_agency1_idx` (`agency_id`),
  CONSTRAINT `fk_employee_agency1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'123','Mark','Cartman','Logistics','cartman@gmail.com',1,'09','09',NULL);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_event_schedule`
--

DROP TABLE IF EXISTS `employee_event_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_event_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `event_date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_event_schedule_event_event_id_fk` (`event_id`),
  KEY `fk_employee` (`employee_id`),
  CONSTRAINT `employee_event_schedule_event_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  CONSTRAINT `fk_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`agency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_event_schedule`
--

LOCK TABLES `employee_event_schedule` WRITE;
/*!40000 ALTER TABLE `employee_event_schedule` DISABLE KEYS */;
INSERT INTO `employee_event_schedule` VALUES (1,15,1,'2019-12-25 11:11:00');
/*!40000 ALTER TABLE `employee_event_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(45) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `event_start` datetime DEFAULT NULL,
  `event_end` datetime DEFAULT NULL,
  `event_type` varchar(100) DEFAULT NULL,
  `theme` varchar(45) DEFAULT NULL,
  `others` varchar(45) DEFAULT NULL,
  `totalpax` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `event_detailsAdded` timestamp NULL DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  UNIQUE KEY `event_id_UNIQUE` (`event_id`),
  KEY `fk_client_clientID_idx` (`client_id`),
  KEY `fk_packageid_event_idx` (`package_id`),
  KEY `fk_inventoryId_idx` (`inventory_id`),
  KEY `fk_event_status_idx` (`status`),
  KEY `fk_userId_idx` (`user_id`),
  CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`),
  CONSTRAINT `fk_event_status` FOREIGN KEY (`status`) REFERENCES `event_status_ref` (`status_id`),
  CONSTRAINT `fk_inventoryId` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`),
  CONSTRAINT `fk_packageid_event` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (13,'Rosette\'s Debut',1,'CVJ Clubhouse Ground Floor','2019-08-20 10:30:00','2019-08-20 13:30:00',NULL,'Black and Gold','Rosette\'s Debut',100,1,1,NULL,NULL,NULL),(15,'Pat and Jeremy',1,'CVJ Underground Den','2019-12-25 11:11:00','2019-12-25 16:11:00','Wedding','Christmas','312',50,1,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_budget`
--

DROP TABLE IF EXISTS `event_budget`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `total_budget` decimal(10,2) DEFAULT NULL,
  `total_buffer` decimal(10,0) DEFAULT '0',
  `spent_buffer` decimal(10,0) DEFAULT '0',
  `total_spent` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_budget_event_id_uindex` (`event_id`),
  CONSTRAINT `event_budget_event_event_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_budget`
--

LOCK TABLES `event_budget` WRITE;
/*!40000 ALTER TABLE `event_budget` DISABLE KEYS */;
INSERT INTO `event_budget` VALUES (2,13,1300.00,195,0,0),(5,15,5560.00,834,0,0);
/*!40000 ALTER TABLE `event_budget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_budget_item`
--

DROP TABLE IF EXISTS `event_budget_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_budget_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_budget_id` int(11) DEFAULT NULL,
  `item_name` varchar(225) DEFAULT NULL,
  `budget_amount` decimal(10,0) DEFAULT NULL,
  `actual_amount` decimal(10,0) DEFAULT '0',
  `item_tag` text,
  PRIMARY KEY (`id`),
  KEY `event_budget_item_event_budget_id_fk` (`event_budget_id`),
  CONSTRAINT `event_budget_item_event_budget_id_fk` FOREIGN KEY (`event_budget_id`) REFERENCES `event_budget` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_budget_item`
--

LOCK TABLES `event_budget_item` WRITE;
/*!40000 ALTER TABLE `event_budget_item` DISABLE KEYS */;
INSERT INTO `event_budget_item` VALUES (5,5,'Chairs',500,0,NULL),(6,5,'Tables',800,0,NULL),(7,5,'Outsourcing Expenses',4260,0,NULL);
/*!40000 ALTER TABLE `event_budget_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_budget_template`
--

DROP TABLE IF EXISTS `event_budget_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_budget_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(225) DEFAULT NULL,
  `total_budget` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_budget_template`
--

LOCK TABLES `event_budget_template` WRITE;
/*!40000 ALTER TABLE `event_budget_template` DISABLE KEYS */;
INSERT INTO `event_budget_template` VALUES (2,'Debut Package A',55000.00),(3,'Package B Debut',60000.00);
/*!40000 ALTER TABLE `event_budget_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_budget_template_item`
--

DROP TABLE IF EXISTS `event_budget_template_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_budget_template_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_budget_template_id` int(11) DEFAULT NULL,
  `default_value` decimal(10,0) DEFAULT '0',
  `item_name` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_budget_template_item_event_budget_template_id_fk` (`event_budget_template_id`),
  CONSTRAINT `event_budget_template_item_event_budget_template_id_fk` FOREIGN KEY (`event_budget_template_id`) REFERENCES `event_budget_template` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_budget_template_item`
--

LOCK TABLES `event_budget_template_item` WRITE;
/*!40000 ALTER TABLE `event_budget_template_item` DISABLE KEYS */;
INSERT INTO `event_budget_template_item` VALUES (9,2,500,'Ikea Chair');
/*!40000 ALTER TABLE `event_budget_template_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_costing`
--

DROP TABLE IF EXISTS `event_costing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_costing` (
  `event_costing_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `venue_cost` decimal(10,0) DEFAULT NULL,
  `food` decimal(10,0) DEFAULT NULL,
  `labor` decimal(10,0) DEFAULT NULL,
  `beverage` decimal(10,0) DEFAULT NULL,
  `logistics` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`event_costing_id`),
  UNIQUE KEY `event_costing_event_name_uindex` (`event_id`),
  CONSTRAINT `event_costing_event_event_name_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_costing`
--

LOCK TABLES `event_costing` WRITE;
/*!40000 ALTER TABLE `event_costing` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_costing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_inventory`
--

DROP TABLE IF EXISTS `event_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_inventory` (
  `einventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `rent_price` decimal(10,0) DEFAULT NULL,
  `esku` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`einventory_id`),
  KEY `fk_inventory_id_idx` (`inventory_id`),
  KEY `fk_event_id_idx` (`event_id`),
  CONSTRAINT `fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  CONSTRAINT `fk_inventory_id` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_inventory`
--

LOCK TABLES `event_inventory` WRITE;
/*!40000 ALTER TABLE `event_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_outsource_item`
--

DROP TABLE IF EXISTS `event_outsource_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_outsource_item` (
  `event_id` int(11) NOT NULL,
  `outsourced_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  KEY `event_outsource_item_event_event_name_fk` (`event_id`),
  KEY `event_outsource_item_outsourced_item_outsourced_item_id_fk` (`outsourced_item_id`),
  CONSTRAINT `event_outsource_item_event_event_name_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  CONSTRAINT `event_outsource_item_outsourced_item_outsourced_item_id_fk` FOREIGN KEY (`outsourced_item_id`) REFERENCES `outsourced_item` (`outsourced_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_outsource_item`
--

LOCK TABLES `event_outsource_item` WRITE;
/*!40000 ALTER TABLE `event_outsource_item` DISABLE KEYS */;
INSERT INTO `event_outsource_item` VALUES (15,1,30,750,'Ordered'),(15,2,10,750,'Delivered'),(15,3,5,2760,'Deliivered');
/*!40000 ALTER TABLE `event_outsource_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_package`
--

DROP TABLE IF EXISTS `event_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_package` (
  `epackage_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `rawmaterial_id` int(11) NOT NULL,
  `event_packagecol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`epackage_id`),
  KEY `fk_event_package_event1_idx` (`event_id`),
  KEY `fk_event_package_package1_idx` (`package_id`),
  KEY `fk_event_package_rawmaterial` (`rawmaterial_id`),
  CONSTRAINT `fk_event_package_event1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  CONSTRAINT `fk_event_package_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_package`
--

LOCK TABLES `event_package` WRITE;
/*!40000 ALTER TABLE `event_package` DISABLE KEYS */;
INSERT INTO `event_package` VALUES (1,1,15,1,NULL);
/*!40000 ALTER TABLE `event_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_status_ref`
--

DROP TABLE IF EXISTS `event_status_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_status_ref` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_status_ref`
--

LOCK TABLES `event_status_ref` WRITE;
/*!40000 ALTER TABLE `event_status_ref` DISABLE KEYS */;
INSERT INTO `event_status_ref` VALUES (1,'Pending'),(2,'Approved'),(3,'Confirmed'),(4,'In-Progress'),(5,'Finished');
/*!40000 ALTER TABLE `event_status_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredient` (
  `ingredient_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `measure` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
INSERT INTO `ingredient` VALUES (1,'Vinegar',1000,'mL'),(2,'Salt',500,'g'),(3,'Pepper',500,'g'),(4,'Oil',150,'mL'),(5,'Chicken',1000,'kg');
/*!40000 ALTER TABLE `ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `inventory_id` int(5) NOT NULL AUTO_INCREMENT,
  `inventory_name` varchar(45) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `threshold` int(7) DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `itemSource` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `rental_cost` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`inventory_id`),
  KEY `fk_inventory_CATEGORY_REF1_idx` (`category`),
  KEY `fk_inventory_color_idx` (`color`),
  KEY `fk_size_idx` (`size`),
  CONSTRAINT `fk_inventory_color` FOREIGN KEY (`color`) REFERENCES `color` (`color_id`),
  CONSTRAINT `fk_size` FOREIGN KEY (`size`) REFERENCES `size` (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,'Ikea Chair',2,150,15,NULL,'1',1,'9781582646770','2019-08-04 13:06:37',30.00,1,1,10),(2,'Ikea Table',3,200,30,NULL,'1',1,'9781585637209','2019-08-04 13:06:37',1200.00,1,3,100),(3,'Spoon',4,10,10,NULL,'1',1,'9781585247209','2019-08-04 13:06:37',10.00,1,1,0),(4,'Fork',4,10,10,NULL,'1',1,'9781585637260','2019-08-04 13:06:37',10.00,1,1,0),(5,'Tiffany Chair',2,150,15,NULL,'1',1,NULL,'2019-08-04 13:06:37',300.00,1,1,10),(6,'Banquet Chair',2,200,30,NULL,'1',1,NULL,'2019-08-04 13:06:37',450.00,1,3,15),(7,'Side Chair',2,140,30,NULL,'1',1,NULL,'2019-08-04 13:06:37',300.00,1,1,20),(8,'Ladderback Chair',2,120,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',450.00,1,1,15),(9,'Windsor Chair',2,140,30,NULL,'1',1,NULL,'2019-08-04 13:06:37',300.00,1,1,15),(10,'Parsons Chair',2,100,20,NULL,'1',1,NULL,'2019-08-04 13:06:37',400.00,1,1,20),(11,'Modern Chair',2,150,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',300.00,1,1,15),(12,'Round Table',3,50,10,NULL,'1',1,NULL,'2019-08-04 13:06:37',1200.00,1,1,70),(13,'Side Table',3,30,10,NULL,'1',1,NULL,'2019-08-04 13:06:37',1000.00,1,1,70),(14,'End Table',3,20,10,NULL,'1',1,NULL,'2019-08-04 13:06:37',800.00,1,1,80),(15,'Spoon',5,550,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',20.00,1,1,10),(16,'Fork',5,550,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',20.00,1,1,10),(17,'Knife',5,550,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',20.00,1,1,10),(18,'Bread Knife',5,550,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',20.00,1,1,10),(19,'Bread Plate',7,550,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(20,'Soup Bowl',7,650,95,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(21,'Dinner Plate',7,650,95,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(22,'Salad Plate',7,650,95,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,20),(23,'Cup',6,400,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(24,'Drinking Glass',6,800,70,NULL,'1',1,NULL,'2019-08-04 13:06:37',60.00,1,1,20),(47,'Round Tables',3,300,70,NULL,'1',1,NULL,'2019-08-04 13:06:37',60.00,1,1,30),(48,'Regular Chairs',2,400,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,20),(49,'Tablecloth',7,400,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',60.00,1,1,20),(50,'Linen',7,400,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',60.00,1,1,30),(51,'VIP Table',3,200,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,80),(52,'Floral Arrangement',5,500,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,20),(53,'Round Tables',3,300,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',60.00,1,1,80),(54,'Regular Chairs',2,500,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(55,'Tablecloth',7,400,70,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,30),(56,'Linen',7,400,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,20),(57,'VIP Table',3,200,70,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,30),(58,'Floral Arrangement',5,500,10,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,80),(59,'Floral Centerpiece',1,500,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,80),(60,'VIP Table',3,400,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(61,'Cake Table',3,200,10,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,80),(62,'Gift Table',3,300,70,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(63,'Round Table',3,500,10,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,80),(64,'Tablecloth',7,600,10,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,30),(65,'Linen',7,350,70,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,80),(66,'Tiffany Chairs',2,300,90,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,80),(67,'Presidential Table',3,200,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',90.00,1,1,30),(68,'Guest Table',3,200,40,NULL,'1',1,NULL,'2019-08-04 13:06:37',70.00,1,1,30);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_audit`
--

DROP TABLE IF EXISTS `inventory_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_audit` (
  `audit` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` int(5) NOT NULL,
  `changes_made` varchar(255) NOT NULL,
  `audit_date` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reason` varchar(255) NOT NULL,
  `reason_extra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`audit`,`inventory_id`),
  KEY `fk_inventory_audit_inventory2_idx` (`inventory_id`),
  CONSTRAINT `fk_inventory_audit_inventory2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_audit`
--

LOCK TABLES `inventory_audit` WRITE;
/*!40000 ALTER TABLE `inventory_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_category`
--

DROP TABLE IF EXISTS `inventory_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` text,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_category`
--

LOCK TABLES `inventory_category` WRITE;
/*!40000 ALTER TABLE `inventory_category` DISABLE KEYS */;
INSERT INTO `inventory_category` VALUES (1,'Chairs'),(2,'Tables'),(3,'Utensils'),(4,'Food'),(5,'Decorations'),(6,'Talent Fee');
/*!40000 ALTER TABLE `inventory_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_returned`
--

DROP TABLE IF EXISTS `inventory_returned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_returned` (
  `event_returned` int(11) NOT NULL,
  `returned_id` int(5) NOT NULL,
  `quantity` int(7) NOT NULL,
  `date_returned` datetime NOT NULL,
  PRIMARY KEY (`returned_id`),
  UNIQUE KEY `event_returned_UNIQUE` (`event_returned`),
  KEY `fk_inventory_deployed_event1_idx` (`event_returned`),
  CONSTRAINT `fk_inventory_deployed_event1` FOREIGN KEY (`event_returned`) REFERENCES `event` (`event_id`),
  CONSTRAINT `fk_inventory_deployed_inventory1` FOREIGN KEY (`returned_id`) REFERENCES `inventory` (`inventory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_returned`
--

LOCK TABLES `inventory_returned` WRITE;
/*!40000 ALTER TABLE `inventory_returned` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory_returned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` text,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(10,0) DEFAULT NULL,
  `item_image` text,
  `unit_expense` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Bistek Tagalog',100,40,'food/bistek.jpg',20),(2,'Chinese Chopsuey',100,35,'food/chopsuy.jpg',15),(3,'Manacc',100,40,'food/manac.jpg',20),(4,'Adobong Manok',100,40,'food/shrimp.jpg',20),(5,'Pechay',100,40,'food/pechay.jpg',20),(6,'Tiula Itum',100,60,'food/itum.jpg',45),(7,'Golden Retriever',100,240,'food/dog.jpg',100);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lost_inventory`
--

DROP TABLE IF EXISTS `lost_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lost_inventory` (
  `lost_id` int(5) NOT NULL,
  `event_id` int(11) NOT NULL,
  `quantity` int(7) NOT NULL,
  `date_reported` datetime NOT NULL,
  PRIMARY KEY (`lost_id`),
  UNIQUE KEY `event_id_UNIQUE` (`event_id`),
  KEY `fk_event_name_idx` (`event_id`),
  CONSTRAINT `` FOREIGN KEY (`lost_id`) REFERENCES `inventory` (`inventory_id`),
  CONSTRAINT `fk_event_name_lost` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lost_inventory`
--

LOCK TABLES `lost_inventory` WRITE;
/*!40000 ALTER TABLE `lost_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `lost_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measure_ref`
--

DROP TABLE IF EXISTS `measure_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `measure_ref` (
  `measure_id` int(11) NOT NULL AUTO_INCREMENT,
  `measure` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`measure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measure_ref`
--

LOCK TABLES `measure_ref` WRITE;
/*!40000 ALTER TABLE `measure_ref` DISABLE KEYS */;
/*!40000 ALTER TABLE `measure_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `month_ref`
--

DROP TABLE IF EXISTS `month_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `month_ref` (
  `month_no` int(11) NOT NULL,
  `month_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`month_no`),
  CONSTRAINT `fk_month_ref_sales_report1` FOREIGN KEY (`month_no`) REFERENCES `sales_report` (`MONTH`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `month_ref`
--

LOCK TABLES `month_ref` WRITE;
/*!40000 ALTER TABLE `month_ref` DISABLE KEYS */;
/*!40000 ALTER TABLE `month_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `status_desc` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `fk_userType_idx` (`userType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outsourced_item`
--

DROP TABLE IF EXISTS `outsourced_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outsourced_item` (
  `outsourced_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`outsourced_item_id`),
  KEY `outsourced_item_supplier_supplier_id_fk` (`supplier_id`),
  CONSTRAINT `outsourced_item_supplier_supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outsourced_item`
--

LOCK TABLES `outsourced_item` WRITE;
/*!40000 ALTER TABLE `outsourced_item` DISABLE KEYS */;
INSERT INTO `outsourced_item` VALUES (1,'Ikea Chair',1),(2,'Ikea Monoblock',2),(3,'Ikea Table',3);
/*!40000 ALTER TABLE `outsourced_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(65) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `package_client_id` int(11) DEFAULT NULL,
  `package_img_url` text,
  `suggested_pax` int(11) DEFAULT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` VALUES (1,'Debut Package',80000.00,13,'img/debut.jpg',100),(2,'Grand Debut Package',147000.00,NULL,'img/debut.jpg',100),(3,'Standard Party Package',78000.00,NULL,'img/debut.jpg',50),(4,'Grand Party Package A',112000.00,NULL,'img/bday.jpg',200),(5,' Grand Party Package B',115000.00,NULL,'img/bday.jpg',200),(6,' Grand Party Package C',118000.00,NULL,'img/bday.jpg',100),(7,'Grand Wedding Package A',140000.00,NULL,'img/wed.jpg',100),(8,' Grand Wedding Package B',147000.00,NULL,'img/wed.jpg',100),(9,'Grand Wedding Package C',150000.00,NULL,'img/wed.jpg',100);
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_inventory`
--

DROP TABLE IF EXISTS `package_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_inventory` (
  `package_id` int(11) DEFAULT NULL,
  `inventory_id` int(5) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `rent_cost` decimal(10,0) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  KEY `package_inventory_package_package_id_fk` (`package_id`),
  KEY `package_inventory_inventory_inventory_id_fk` (`inventory_id`),
  CONSTRAINT `package_inventory_inventory_inventory_id_fk` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`),
  CONSTRAINT `package_inventory_package_package_id_fk` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_inventory`
--

LOCK TABLES `package_inventory` WRITE;
/*!40000 ALTER TABLE `package_inventory` DISABLE KEYS */;
INSERT INTO `package_inventory` VALUES (1,1,1,20,30);
/*!40000 ALTER TABLE `package_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_item`
--

DROP TABLE IF EXISTS `package_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_item` (
  `package_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `computed_cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`package_item_id`),
  KEY `package_item_package_package_id_fk` (`package_id`),
  KEY `package_item_items_item_id_fk` (`item_id`),
  CONSTRAINT `package_item_items_item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  CONSTRAINT `package_item_package_package_id_fk` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_item`
--

LOCK TABLES `package_item` WRITE;
/*!40000 ALTER TABLE `package_item` DISABLE KEYS */;
INSERT INTO `package_item` VALUES (1,1,1,4000),(2,1,2,3500),(3,1,6,6000),(4,2,7,24000);
/*!40000 ALTER TABLE `package_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_misc_item`
--

DROP TABLE IF EXISTS `package_misc_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_misc_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) DEFAULT NULL,
  `name` text,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `package_misc_item_package_package_id_fk` (`package_id`),
  CONSTRAINT `package_misc_item_package_package_id_fk` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_misc_item`
--

LOCK TABLES `package_misc_item` WRITE;
/*!40000 ALTER TABLE `package_misc_item` DISABLE KEYS */;
INSERT INTO `package_misc_item` VALUES (2,1,'Round Tables',20,450),(3,1,'Regular Chairs',30,250),(4,1,'Tablecloth',40,300),(5,1,'Linen',40,200),(6,1,'VIP Table',50,900),(7,1,'Floral Arrangement',40,400),(8,1,'Round Tables',20,450),(9,1,'Regular Chairs',30,250),(10,1,'Tablecloth',40,300),(11,1,'Linen',40,200),(12,1,'VIP Table',50,900),(13,1,'Floral Arrangement',40,400),(14,2,'Floral Centerpiece',100,60),(15,2,'VIP Table',1,600),(16,2,'Cake Table',1,300),(17,2,'Gift Table',1,300),(18,2,'Round Table',20,600),(19,2,'Tablecloth',20,120),(20,2,'Linen',20,120),(21,2,'Tiffany Chairs',100,700),(22,2,'Presidential Table',1,900),(23,2,'Guest Table',5,300);
/*!40000 ALTER TABLE `package_misc_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NOT NULL,
  `date_paid` datetime NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `modeofpayment` varchar(45) DEFAULT NULL,
  `ref_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`payment_id`,`billing_id`),
  KEY `fk_payment_billing1_idx` (`billing_id`),
  CONSTRAINT `fk_payment_billing1` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`billing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rawmaterial`
--

DROP TABLE IF EXISTS `rawmaterial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rawmaterial` (
  `rawmaterial_id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `measure` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`rawmaterial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rawmaterial`
--

LOCK TABLES `rawmaterial` WRITE;
/*!40000 ALTER TABLE `rawmaterial` DISABLE KEYS */;
INSERT INTO `rawmaterial` VALUES (1,'Adobo',5,0,NULL);
/*!40000 ALTER TABLE `rawmaterial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rawmaterial_audit`
--

DROP TABLE IF EXISTS `rawmaterial_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rawmaterial_audit` (
  `audit_id` int(11) NOT NULL AUTO_INCREMENT,
  `rawmaterial_id` int(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `reason` varchar(45) NOT NULL,
  PRIMARY KEY (`audit_id`,`rawmaterial_id`),
  KEY `fk_rawmaterial_audit_rawmaterial1` (`rawmaterial_id`),
  CONSTRAINT `fk_rawmaterial_audit_rawmaterial1` FOREIGN KEY (`rawmaterial_id`) REFERENCES `rawmaterial` (`rawmaterial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rawmaterial_audit`
--

LOCK TABLES `rawmaterial_audit` WRITE;
/*!40000 ALTER TABLE `rawmaterial_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `rawmaterial_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rawmaterial_ingredient`
--

DROP TABLE IF EXISTS `rawmaterial_ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rawmaterial_ingredient` (
  `ringredient_id` int(11) NOT NULL AUTO_INCREMENT,
  `ingredient_id` int(11) DEFAULT NULL,
  `rawmaterial_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`ringredient_id`),
  KEY `fk_ingredient_idx` (`ingredient_id`),
  KEY `fk_rawmaterial_idx` (`rawmaterial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rawmaterial_ingredient`
--

LOCK TABLES `rawmaterial_ingredient` WRITE;
/*!40000 ALTER TABLE `rawmaterial_ingredient` DISABLE KEYS */;
INSERT INTO `rawmaterial_ingredient` VALUES (1,1,1,10),(2,2,1,50),(3,3,1,50),(4,4,1,30),(5,5,1,5);
/*!40000 ALTER TABLE `rawmaterial_ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`),
  KEY `fk_recipe_package1_idx` (`package_id`),
  CONSTRAINT `fk_recipe_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_items`
--

DROP TABLE IF EXISTS `recipe_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_items` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `measure` int(11) NOT NULL,
  PRIMARY KEY (`ingredient_id`,`recipe_id`),
  KEY `fk_recipe_items_measure_ref1_idx` (`measure`),
  KEY `fk_recipe_items_ingredient1_idx` (`ingredient_id`),
  KEY `fk_recipe_items_recipe1` (`recipe_id`),
  CONSTRAINT `fk_recipe_items_ingredient1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`),
  CONSTRAINT `fk_recipe_items_measure_ref1` FOREIGN KEY (`measure`) REFERENCES `measure_ref` (`measure_id`),
  CONSTRAINT `fk_recipe_items_recipe1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_items`
--

LOCK TABLES `recipe_items` WRITE;
/*!40000 ALTER TABLE `recipe_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_steps`
--

DROP TABLE IF EXISTS `recipe_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_steps` (
  `recipe_id` int(11) NOT NULL,
  `step_no` int(5) NOT NULL,
  `step_desc` longtext,
  PRIMARY KEY (`recipe_id`,`step_no`),
  CONSTRAINT `fk_recipe_steps_recipe1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_steps`
--

LOCK TABLES `recipe_steps` WRITE;
/*!40000 ALTER TABLE `recipe_steps` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_report`
--

DROP TABLE IF EXISTS `sales_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_report` (
  `NoOfSales` int(11) NOT NULL,
  `TotalSales` decimal(10,2) DEFAULT NULL,
  `MONTH` int(11) NOT NULL,
  `YEAR` int(11) NOT NULL,
  PRIMARY KEY (`MONTH`,`YEAR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_report`
--

LOCK TABLES `sales_report` WRITE;
/*!40000 ALTER TABLE `sales_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_name` varchar(45) DEFAULT NULL,
  `measurement` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `size`
--

LOCK TABLES `size` WRITE;
/*!40000 ALTER TABLE `size` DISABLE KEYS */;
INSERT INTO `size` VALUES (1,'Box',NULL),(2,'Tray',NULL),(3,'Custom',NULL);
/*!40000 ALTER TABLE `size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contactMobNo` varchar(45) DEFAULT NULL,
  `officeTelNo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'Earl Supplies Inc.','earl@gmail.com','Manila','09158851556','8426250'),(2,'1 Suppliess Corp','1Supp@gmail.com','Quezon City','09178812625','4357890'),(3,'FaReach Inc.','faReach@gmail.com','Valenzuela City','09171231312','9019271');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `tel_no` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mob_no` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_userType_notifs_idx` (`userType`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'Events Manager','event@gmail.com','$2y$10$hjRyF78fmB/O2aXWs4yBKeGeWYJ/PSgkDvd2RD7V6tVeWn.aqP8Aq',3,'2019-07-26 20:17:15','2019-07-26 20:17:15','lqxR5PoDJyxxW0mP8pIO1lFgGXOeLGM7kDZ2Ya40CqUTUScRU59aAwrNdnbr',NULL,NULL,'8426250','09369455269',NULL,'2'),(12,'Admin','jeremy@dlsu.edu.ph','$2y$10$g/2tFknVBxnmmiOTZp816.INLLjpx3UYdXXog46XLUK.kJAekFNJC',1,'2019-08-02 02:38:48','2019-08-02 02:38:48','X86jfGB8BOWX1xclrAo9ZTvMERq4JHGh3yZQfXE3e12Wz9CNTr8Cf0ivJwDC',NULL,NULL,'8426250','09369455269','Alabang, Muntinlupa City','2'),(13,'jeremy','jeremy@gmail.com','$2y$10$KTQcMGIMSt084LiRO.GQ.ulrh56DbYUPOnD7PtZ/r0v8KRWdIezBu',2,'2019-08-02 05:35:22','2019-08-02 05:35:22','Ci2yf4SPyT3cEJi61yqLxXMEPM6qGIJgOWs2qIEwwTc2EqAUL8UhOT0fJqEo',NULL,NULL,NULL,NULL,NULL,'2'),(15,'Rose Dela Paz','rose@gmail.com','$2y$10$V9UUtvyJ9VjqmAZ9z08wv.dw.FA.3ZaX.HVfoBBkYYWGyChtEb1r.',5,'2019-08-02 06:37:27','2019-08-02 06:37:27','UVNn9SZR7YvOeBwci7tYIhdp0Ixc6uIE8HNXfq3MQAS5Dv26O1bwW8ltuxHW',NULL,NULL,'8426250','09369455269','123 Ocampo St., Taft Ave, Malate, Manila','Pending'),(16,'Jeremy Ocampo','itsoneseno@gmail.com','$2y$10$uZLKfzYw7I6525.kUparCu6IlSIewxQixmt1uzhjqzxOh1JDw1roG',5,'2019-08-06 23:56:00','2019-08-06 23:56:00','YwEyDQWGTesP1hmqnkAqL4VcGwjfNI3CGdXZLaIkB02a3j4UUHZ5jV7HCMVA',NULL,NULL,'8426250','09369455269','Rizal Village, Alabang, Muntinlupa City, Brgy. Cupang','Pending'),(17,'Gerald Anderson','gerald.anderson1@gmail.com','$2y$10$uuwg.7qTAWxEBPLbppGotetgpiIIMIyK4hmm8o4sbO7QZUgdYSiky',5,'2019-08-07 08:01:47','2019-08-07 08:01:47','swRMCgnkw6BAuMEH14G8I9PDPmBBlUhvyCMMK6nrfH4AM53JDmyLxMz2WU4s',NULL,NULL,'8109258','09178498527','Ayala Alabang, Alabang, Muntinlupa City','Pending'),(18,'March Eusebio','march@gmail.com','$2y$10$SxADb56GYtbfz3lbyy6JEe4xA5/U/fhC7A6P6yUGa1nuUkpB3EHIy',5,'2019-08-08 20:13:33','2019-08-08 20:13:33',NULL,NULL,NULL,'123','321','123abc','Pending');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cvjdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-13 14:39:25
