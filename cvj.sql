CREATE DATABASE  IF NOT EXISTS `cvjdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cvjdb`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cvjdb
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agency`
--

LOCK TABLES `agency` WRITE;
/*!40000 ALTER TABLE `agency` DISABLE KEYS */;
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
  `payment_event_name` varchar(45) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `costid` int(11) DEFAULT NULL,
  PRIMARY KEY (`billing_id`,`payment_event_name`),
  KEY `fk_billing_event1` (`payment_event_name`),
  CONSTRAINT `fk_billing_event1` FOREIGN KEY (`payment_event_name`) REFERENCES `event` (`event_name`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_ref`
--

LOCK TABLES `category_ref` WRITE;
/*!40000 ALTER TABLE `category_ref` DISABLE KEYS */;
INSERT INTO `category_ref` VALUES (1,'Centerpiece'),(2,'Table'),(3,'Chair'),(4,'Flower'),(5,'Utensils'),(6,'Glassware'),(7,'Linen'),(8,'Equipment');
/*!40000 ALTER TABLE `category_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `client_id` varchar(45) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `client_FN` varchar(45) NOT NULL,
  `client_LN` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tel_no` varchar(45) DEFAULT NULL,
  `fax_no` varchar(45) DEFAULT NULL,
  `mob_no` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES ('1','1','Jeremy ','Ocampo','jeremy_ocampojr@dlsu.edu.ph','8426250','8426250','09369455269','140 Kapitan Tiago St., Rizal Village, Muntinlupa City','1');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Red'),(2,'Orange'),(3,'Yellow'),(4,'Green'),(5,'Indigo'),(6,'Violet'),(7,'Brown'),(8,'Black'),(9,'White'),(10,'Pink'),(11,'Peach');
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
  `client_id` varchar(45) NOT NULL,
  `feedback_type` varchar(45) NOT NULL,
  `feedback` longtext NOT NULL,
  PRIMARY KEY (`feedback_id`),
  KEY `fk_client_feedback_idx` (`client_id`),
  CONSTRAINT `fk_client_feedback` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `event_deployed` varchar(100) NOT NULL,
  `inventory_deployed` int(5) NOT NULL,
  `quantity` int(7) NOT NULL,
  `date_deployed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_deployed`,`inventory_deployed`),
  KEY `fk_event_deployment_inventory1_idx` (`inventory_deployed`),
  CONSTRAINT `fk_event_deployment_event1` FOREIGN KEY (`event_deployed`) REFERENCES `event` (`event_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_deployment_inventory1` FOREIGN KEY (`inventory_deployed`) REFERENCES `inventory` (`inventory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `employee_id` varchar(45) NOT NULL,
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
  CONSTRAINT `fk_employee_agency1` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_event_schedule`
--

DROP TABLE IF EXISTS `employee_event_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_event_schedule` (
  `employee_id` varchar(45) NOT NULL,
  `event_assigned` varchar(45) NOT NULL,
  `event_date_time` datetime NOT NULL,
  PRIMARY KEY (`event_assigned`,`employee_id`),
  KEY `fk_employeeID_eventsched_idx` (`employee_id`),
  CONSTRAINT `fk_employeeID_eventsched` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventassigned_event` FOREIGN KEY (`event_assigned`) REFERENCES `event` (`event_name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_event_schedule`
--

LOCK TABLES `employee_event_schedule` WRITE;
/*!40000 ALTER TABLE `employee_event_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_event_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `event_name` varchar(45) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `event_start` datetime DEFAULT NULL,
  `event_end` datetime DEFAULT NULL,
  `event_type` varchar(45) DEFAULT NULL,
  `theme` varchar(45) DEFAULT NULL,
  `others` varchar(45) DEFAULT NULL,
  `totalpax` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `priceperhead` decimal(10,2) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `event_detailsAdded` timestamp NULL DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`event_name`),
  KEY `fk_client_clientID_idx` (`client_id`),
  KEY `fk_reservevenue_reserveID_idx` (`reservation_id`),
  KEY `fk_packageid_event_idx` (`package_id`),
  KEY `fk_inventoryId_idx` (`inventory_id`),
  CONSTRAINT `fk_client_clientID` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventoryId` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_packageid_event` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservevenue_reserveID` FOREIGN KEY (`reservation_id`) REFERENCES `reserve_venue` (`reservation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES ('Jeremy Birthday Party',1,'1','2019-06-13 10:30:00','2019-06-13 12:30:00','1','1','1',1,1,1.00,'1','0000-00-00 00:00:00',1);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_costing`
--

DROP TABLE IF EXISTS `event_costing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_costing` (
  `event_costing_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(45) DEFAULT NULL,
  `venue_cost` decimal(10,0) DEFAULT NULL,
  `food` decimal(10,0) DEFAULT NULL,
  `labor` decimal(10,0) DEFAULT NULL,
  `beverage` decimal(10,0) DEFAULT NULL,
  `logistics` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`event_costing_id`),
  UNIQUE KEY `event_costing_event_name_uindex` (`event_name`),
  CONSTRAINT `event_costing_event_event_name_fk` FOREIGN KEY (`event_name`) REFERENCES `event` (`event_name`)
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
-- Table structure for table `event_outsource_item`
--

DROP TABLE IF EXISTS `event_outsource_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_outsource_item` (
  `event_name` varchar(45) DEFAULT NULL,
  `outsourced_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT NULL,
  KEY `event_outsource_item_event_event_name_fk` (`event_name`),
  KEY `event_outsource_item_outsourced_item_outsourced_item_id_fk` (`outsourced_item_id`),
  CONSTRAINT `event_outsource_item_event_event_name_fk` FOREIGN KEY (`event_name`) REFERENCES `event` (`event_name`),
  CONSTRAINT `event_outsource_item_outsourced_item_outsourced_item_id_fk` FOREIGN KEY (`outsourced_item_id`) REFERENCES `outsourced_item` (`outsourced_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_outsource_item`
--

LOCK TABLES `event_outsource_item` WRITE;
/*!40000 ALTER TABLE `event_outsource_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_outsource_item` ENABLE KEYS */;
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
  `measure` int(11) DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`),
  KEY `fk_ingredient_measure_ref1_idx` (`measure`),
  CONSTRAINT `fk_ingredient_measure_ref1` FOREIGN KEY (`measure`) REFERENCES `measure_ref` (`measure_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient`
--

LOCK TABLES `ingredient` WRITE;
/*!40000 ALTER TABLE `ingredient` DISABLE KEYS */;
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
  PRIMARY KEY (`inventory_id`),
  KEY `fk_inventory_CATEGORY_REF1_idx` (`category`),
  KEY `fk_inventory_color_idx` (`color`),
  KEY `fk_inventory_size_idx` (`size`),
  CONSTRAINT `fk_inventory_color` FOREIGN KEY (`color`) REFERENCES `color` (`color_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventory_size` FOREIGN KEY (`size`) REFERENCES `size` (`size_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,'Kart',1,10,5,'2019-07-18 23:13:52','1',1,'9784973873397','2019-06-18 02:38:25',251.00,1,1),(2,'Item 1',2,105,10,NULL,'1',1,'9780750746854','2019-06-24 21:30:39',102.00,2,2),(3,'hi',3,10,10,NULL,'2',1,'1234567891012','2019-06-24 22:01:43',3000.00,3,3),(4,'1',4,15,10,NULL,'1',1,NULL,'2019-06-24 22:07:30',189.00,4,4),(5,'s',5,10,10,NULL,'2',1,'','2019-06-24 22:08:14',50.00,5,1),(6,'g',6,125,123,NULL,'2',1,'1234567890101','2019-06-24 22:09:01',40.00,6,2);
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
  CONSTRAINT `fk_inventory_audit_inventory2` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `inventory_returned`
--

DROP TABLE IF EXISTS `inventory_returned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_returned` (
  `event_returned` varchar(45) NOT NULL,
  `returned_id` int(5) NOT NULL,
  `quantity` int(7) NOT NULL,
  `date_returned` datetime NOT NULL,
  PRIMARY KEY (`returned_id`,`event_returned`),
  KEY `fk_inventory_deployed_event1_idx` (`event_returned`),
  CONSTRAINT `fk_inventory_deployed_event1` FOREIGN KEY (`event_returned`) REFERENCES `event` (`event_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_inventory_deployed_inventory1` FOREIGN KEY (`returned_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `item_id` int(11) NOT NULL,
  `item_name` varchar(45) NOT NULL,
  `package_id` int(11) NOT NULL,
  `rawmaterial_id` int(5) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_items_package1_idx` (`package_id`),
  KEY `fk_items_rawmaterial1_idx` (`rawmaterial_id`),
  CONSTRAINT `fk_items_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_items_rawmaterial1` FOREIGN KEY (`rawmaterial_id`) REFERENCES `rawmaterial` (`rawmaterial_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
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
  `quantity` int(7) NOT NULL,
  `date_reported` datetime NOT NULL,
  `event_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`lost_id`),
  KEY `fk_event_name_idx` (`event_name`),
  CONSTRAINT `` FOREIGN KEY (`lost_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_name_lost` FOREIGN KEY (`event_name`) REFERENCES `event` (`event_name`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'Wood Shiny'),(2,'Wood Regular'),(3,'Steel Regular'),(4,'Steel Shiny'),(5,'Steel Cushion'),(6,'Plastic Clear'),(7,'Plastic Matte'),(8,'Plastic Tinted'),(9,'Monoblock'),(10,'Monoblock Covered'),(11,'Monoblock Padded');
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
  CONSTRAINT `fk_month_ref_sales_report1` FOREIGN KEY (`month_no`) REFERENCES `sales_report` (`MONTH`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outsourced_item`
--

LOCK TABLES `outsourced_item` WRITE;
/*!40000 ALTER TABLE `outsourced_item` DISABLE KEYS */;
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
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` VALUES (1,'pack1',100.00);
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
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
  CONSTRAINT `fk_payment_billing1` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`billing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `ingredient_id` int(5) NOT NULL,
  `name` varchar(45) NOT NULL DEFAULT 'Generic Brand',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `measure` int(11) NOT NULL,
  `piece` int(11) DEFAULT '0',
  `ordertype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rawmaterial_id`),
  KEY `fk_rawmaterial_ingredient1_idx` (`ingredient_id`),
  KEY `fk_rawmaterial_measure_ref1_idx` (`measure`),
  CONSTRAINT `fk_rawmaterial_ingredient1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rawmaterial_measure_ref1` FOREIGN KEY (`measure`) REFERENCES `measure_ref` (`measure_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rawmaterial`
--

LOCK TABLES `rawmaterial` WRITE;
/*!40000 ALTER TABLE `rawmaterial` DISABLE KEYS */;
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
  CONSTRAINT `fk_rawmaterial_audit_rawmaterial1` FOREIGN KEY (`rawmaterial_id`) REFERENCES `rawmaterial` (`rawmaterial_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  CONSTRAINT `fk_recipe_package1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  CONSTRAINT `fk_recipe_items_ingredient1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`ingredient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipe_items_measure_ref1` FOREIGN KEY (`measure`) REFERENCES `measure_ref` (`measure_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipe_items_recipe1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  CONSTRAINT `fk_recipe_steps_recipe1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `reserve_venue`
--

DROP TABLE IF EXISTS `reserve_venue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserve_venue` (
  `reservation_id` int(11) NOT NULL,
  `venue` varchar(45) DEFAULT NULL,
  `hallnumber` int(11) DEFAULT NULL,
  `numberOfPax` int(11) DEFAULT NULL,
  `reservation_date_time` datetime DEFAULT NULL,
  `reservation_detailsAdded` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserve_venue`
--

LOCK TABLES `reserve_venue` WRITE;
/*!40000 ALTER TABLE `reserve_venue` DISABLE KEYS */;
INSERT INTO `reserve_venue` VALUES (1,'bahay',1,200,'2019-06-13 00:00:00','2019-06-14 16:00:00');
/*!40000 ALTER TABLE `reserve_venue` ENABLE KEYS */;
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
  PRIMARY KEY (`size_id`),
  CONSTRAINT `fk_size` FOREIGN KEY (`size_id`) REFERENCES `inventory` (`inventory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `size`
--

LOCK TABLES `size` WRITE;
/*!40000 ALTER TABLE `size` DISABLE KEYS */;
INSERT INTO `size` VALUES (1,'Small'),(2,'Medium'),(3,'Large'),(4,'Extra Large');
/*!40000 ALTER TABLE `size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory_ref`
--

DROP TABLE IF EXISTS `subcategory_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory_ref` (
  `category_no` tinyint(1) NOT NULL,
  `subcategory` tinyint(1) NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(45) NOT NULL,
  PRIMARY KEY (`subcategory`),
  KEY `fk_subcategory_ref_category_ref1_idx` (`category_no`),
  CONSTRAINT `fk_subcategory_ref_category_ref1` FOREIGN KEY (`category_no`) REFERENCES `category_ref` (`category_no`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory_ref`
--

LOCK TABLES `subcategory_ref` WRITE;
/*!40000 ALTER TABLE `subcategory_ref` DISABLE KEYS */;
INSERT INTO `subcategory_ref` VALUES (1,1,'Paint Job'),(1,2,'Personalize Job'),(1,3,'Custom Parts'),(2,4,'a'),(2,5,'b'),(2,6,'c'),(3,7,'Aa'),(3,8,'Bb'),(3,9,'Cc'),(1,10,'Something Job');
/*!40000 ALTER TABLE `subcategory_ref` ENABLE KEYS */;
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
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Jeremy','itsoneseno@gmail.com','$2y$10$XPMBt4Udi0j7WsQ40dNEEufK6h6OxZd2BKmzogU2iPFnQmNcUO3y2',1,'2019-05-27 21:49:35','2019-05-27 21:49:35','TKapqkQXkbxHl6Ti022rMq7s2myUQwAbnL4wI2BLru0GgOg0lmMrYTCliFvq',1,NULL),(4,'Rosette','princess_delapaz@dlsu.edu.ph','$2y$10$wvOsPyQpQNUCKl9xX.H.AuEz1i.m7Eeg8OMPytwpiGHr/nZbYArT2',2,NULL,NULL,NULL,0,NULL),(5,'Rose','roset@roset.com','$2y$10$etxS7eFOyQW8.XgCqPPTF.xMtAtXW.SNIjLfaTm5q2GYjIzHbz9EK',NULL,'2019-07-06 02:20:36','2019-07-06 02:20:36','pVdcoACmeYZRDc65nJ24qHJZP13oaLKbSzHCY7bVh8OnwN73ApYmj4cNgyWd',NULL,NULL),(6,'Lanz','lanz@lanz.com','$2y$10$Q0hoydcGsPmcAUkK5w9PWOsN6I.oTDf2r3oa9pY9.Pbhss6Xb44FO',NULL,'2019-07-06 02:26:38','2019-07-06 02:26:38','L4iuVHPNBc8vkrJiMcFfMO1I6ctiFnC0F1k4xOSvc2XgEgS7AzRhUSPVRi2c',NULL,NULL),(7,'Earl','earl@earl.com','$2y$10$3UWj8CJWPt3Qw35af5UGKeAgcJOmnNmDOfO4CKLiefZcbswYpo/PW',NULL,'2019-07-06 02:27:01','2019-07-06 02:27:01','4YfR0SUlWB1Jos5qWzr5K13NvxicV1QvZSQKUJkzuRQamE1NGyzuZOezepVf',NULL,NULL),(8,'Earl Anthony','gmail@yahoo.com','$2y$10$paIlrMlVCGp2VaXkpBipd.5xC8P5n.MUUjT5PS5vCnvls6stljiem',NULL,'2019-07-06 02:37:40','2019-07-06 02:37:40','JDruR21iRHn8NDR75sMJHhX2VfNNEsYr2qWNspA1755ovJqyXaa82YSUqOBN',NULL,NULL);
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

-- Dump completed on 2019-07-24  0:25:00
