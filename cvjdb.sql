-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema cvjdb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `cvjdb` ;

-- -----------------------------------------------------
-- Schema cvjdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cvjdb` DEFAULT CHARACTER SET utf8 ;
USE `cvjdb` ;

-- -----------------------------------------------------
-- Table `cvjdb`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`admin` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`admin` (
  `admin_id` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `admin_FN` VARCHAR(45) NULL DEFAULT NULL,
  `admin_LN` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `contact_no` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`agency`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`agency` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`agency` (
  `agency_id` INT(11) NOT NULL AUTO_INCREMENT,
  `agency_name` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`agency_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`client`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`client` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`client` (
  `client_id` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  `client_FN` VARCHAR(45) NOT NULL,
  `client_LN` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `tel_no` VARCHAR(45) NULL DEFAULT NULL,
  `fax_no` VARCHAR(45) NULL DEFAULT NULL,
  `mob_no` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(255) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`client_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`color`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`color` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`color` (
  `color_id` INT(11) NOT NULL AUTO_INCREMENT,
  `color_name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`color_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`size`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`size` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`size` (
  `size_id` INT(11) NOT NULL AUTO_INCREMENT,
  `size_name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`size_id`),
  CONSTRAINT `fk_size`
    FOREIGN KEY (`size_id`)
    REFERENCES `cvjdb`.`inventory` (`inventory_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`inventory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`inventory` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`inventory` (
  `inventory_id` INT(5) NOT NULL AUTO_INCREMENT,
  `inventory_name` VARCHAR(45) NULL DEFAULT NULL,
  `category` INT(11) NULL DEFAULT NULL,
  `quantity` INT(11) NULL DEFAULT NULL,
  `threshold` INT(7) NULL DEFAULT NULL,
  `last_modified` TIMESTAMP NULL DEFAULT NULL,
  `itemSource` VARCHAR(100) NULL DEFAULT NULL,
  `status` INT(11) NULL DEFAULT NULL,
  `sku` VARCHAR(255) NULL DEFAULT NULL,
  `date_created` TIMESTAMP NULL DEFAULT NULL,
  `price` DECIMAL(9,2) NULL DEFAULT NULL,
  `color` INT(11) NULL DEFAULT NULL,
  `size` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`inventory_id`),
  INDEX `fk_inventory_CATEGORY_REF1_idx` (`category` ASC) VISIBLE,
  INDEX `fk_inventory_color_idx` (`color` ASC) VISIBLE,
  INDEX `fk_inventory_size_idx` (`size` ASC) VISIBLE,
  CONSTRAINT `fk_inventory_color`
    FOREIGN KEY (`color`)
    REFERENCES `cvjdb`.`color` (`color_id`),
  CONSTRAINT `fk_inventory_size`
    FOREIGN KEY (`size`)
    REFERENCES `cvjdb`.`size` (`size_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`package`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`package` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`package` (
  `package_id` INT(11) NOT NULL AUTO_INCREMENT,
  `package_name` VARCHAR(65) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`package_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`reserve_venue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`reserve_venue` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`reserve_venue` (
  `reservation_id` INT(11) NOT NULL,
  `venue` VARCHAR(45) NULL DEFAULT NULL,
  `hallnumber` INT(11) NULL DEFAULT NULL,
  `numberOfPax` INT(11) NULL DEFAULT NULL,
  `reservation_date_time` DATETIME NULL DEFAULT NULL,
  `reservation_detailsAdded` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`reservation_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`event` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`event` (
  `event_id` INT(11) NOT NULL AUTO_INCREMENT,
  `event_name` VARCHAR(45) NULL,
  `client_id` VARCHAR(45) NULL DEFAULT NULL,
  `reservation_id` INT(11) NULL DEFAULT NULL,
  `event_start` DATETIME NULL DEFAULT NULL,
  `event_end` DATETIME NULL DEFAULT NULL,
  `event_type` VARCHAR(45) NULL DEFAULT NULL,
  `theme` VARCHAR(45) NULL DEFAULT NULL,
  `others` VARCHAR(45) NULL DEFAULT NULL,
  `totalpax` INT(11) NULL DEFAULT NULL,
  `package_id` INT(11) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  `event_detailsAdded` TIMESTAMP NULL DEFAULT NULL,
  `inventory_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  INDEX `fk_client_clientID_idx` (`client_id` ASC) VISIBLE,
  INDEX `fk_reservevenue_reserveID_idx` (`reservation_id` ASC) VISIBLE,
  INDEX `fk_packageid_event_idx` (`package_id` ASC) VISIBLE,
  INDEX `fk_inventoryId_idx` (`inventory_id` ASC) VISIBLE,
  UNIQUE INDEX `event_id_UNIQUE` (`event_id` ASC) VISIBLE,
  CONSTRAINT `fk_client_clientID`
    FOREIGN KEY (`client_id`)
    REFERENCES `cvjdb`.`client` (`client_id`),
  CONSTRAINT `fk_inventoryId`
    FOREIGN KEY (`inventory_id`)
    REFERENCES `cvjdb`.`inventory` (`inventory_id`),
  CONSTRAINT `fk_packageid_event`
    FOREIGN KEY (`package_id`)
    REFERENCES `cvjdb`.`package` (`package_id`),
  CONSTRAINT `fk_reservevenue_reserveID`
    FOREIGN KEY (`reservation_id`)
    REFERENCES `cvjdb`.`reserve_venue` (`reservation_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`billing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`billing` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`billing` (
  `billing_id` INT(11) NOT NULL AUTO_INCREMENT,
  `event_billed` INT(11) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `tax` DECIMAL(10,2) NOT NULL,
  `totalPrice` DECIMAL(10,2) NOT NULL,
  `date` DATETIME NOT NULL,
  `balance` DECIMAL(10,2) NOT NULL,
  `costid` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`billing_id`),
  INDEX `fk_billing_event1` (`event_billed` ASC) VISIBLE,
  UNIQUE INDEX `event_id_UNIQUE` (`event_billed` ASC) VISIBLE,
  CONSTRAINT `fk_billing_event1`
    FOREIGN KEY (`event_billed`)
    REFERENCES `cvjdb`.`event` (`event_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`category_ref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`category_ref` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`category_ref` (
  `category_no` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`category_no`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`customer_feedback`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`customer_feedback` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`customer_feedback` (
  `feedback_id` INT(11) NOT NULL AUTO_INCREMENT,
  `client_id` VARCHAR(45) NOT NULL,
  `feedback_type` VARCHAR(45) NOT NULL,
  `feedback` LONGTEXT NOT NULL,
  PRIMARY KEY (`feedback_id`),
  INDEX `fk_client_feedback_idx` (`client_id` ASC) VISIBLE,
  CONSTRAINT `fk_client_feedback`
    FOREIGN KEY (`client_id`)
    REFERENCES `cvjdb`.`client` (`client_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`damaged_inventory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`damaged_inventory` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`damaged_inventory` (
  `damaged_id` INT(5) NOT NULL,
  `quantity` INT(7) NULL DEFAULT NULL,
  `datereported` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `event_name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`damaged_id`),
  INDEX `fk_event_name_idx` (`event_name` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`deployed_inventory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`deployed_inventory` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`deployed_inventory` (
  `event_deployed` INT(11) NOT NULL,
  `inventory_deployed` INT(5) NOT NULL,
  `quantity` INT(7) NOT NULL,
  `date_deployed` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`inventory_deployed`),
  INDEX `fk_event_deployment_inventory1_idx` (`inventory_deployed` ASC) VISIBLE,
  UNIQUE INDEX `event_deployed_UNIQUE` (`event_deployed` ASC) VISIBLE,
  CONSTRAINT `fk_event_deployment_event1`
    FOREIGN KEY (`event_deployed`)
    REFERENCES `cvjdb`.`event` (`event_id`),
  CONSTRAINT `fk_event_deployment_inventory1`
    FOREIGN KEY (`inventory_deployed`)
    REFERENCES `cvjdb`.`inventory` (`inventory_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`employee` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`employee` (
  `employee_id` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `employee_FN` VARCHAR(45) NOT NULL,
  `employee_LN` VARCHAR(45) NOT NULL,
  `employee_type` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `agency_id` INT(11) NOT NULL,
  `contact_no` VARCHAR(45) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  INDEX `fk_employee_agency1_idx` (`agency_id` ASC) VISIBLE,
  CONSTRAINT `fk_employee_agency1`
    FOREIGN KEY (`agency_id`)
    REFERENCES `cvjdb`.`agency` (`agency_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`employee_event_schedule`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`employee_event_schedule` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`employee_event_schedule` (
  `employee_id` VARCHAR(45) NOT NULL,
  `event_assigned` INT(11) NOT NULL,
  `event_date_time` DATETIME NOT NULL,
  PRIMARY KEY (`employee_id`),
  INDEX `fk_employeeID_eventsched_idx` (`employee_id` ASC) VISIBLE,
  UNIQUE INDEX `event_assigned_UNIQUE` (`event_assigned` ASC) VISIBLE,
  CONSTRAINT `fk_employeeID_eventsched`
    FOREIGN KEY (`employee_id`)
    REFERENCES `cvjdb`.`employee` (`employee_id`),
  CONSTRAINT `fk_eventassigned_event`
    FOREIGN KEY (`event_assigned`)
    REFERENCES `cvjdb`.`event` (`event_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`event_costing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`event_costing` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`event_costing` (
  `event_costing_id` INT(11) NOT NULL AUTO_INCREMENT,
  `event_id` INT(11) NOT NULL,
  `venue_cost` DECIMAL(10,0) NULL DEFAULT NULL,
  `food` DECIMAL(10,0) NULL DEFAULT NULL,
  `labor` DECIMAL(10,0) NULL DEFAULT NULL,
  `beverage` DECIMAL(10,0) NULL DEFAULT NULL,
  `logistics` DECIMAL(10,0) NULL DEFAULT NULL,
  PRIMARY KEY (`event_costing_id`),
  UNIQUE INDEX `event_costing_event_name_uindex` (`event_id` ASC) VISIBLE,
  CONSTRAINT `event_costing_event_event_name_fk`
    FOREIGN KEY (`event_id`)
    REFERENCES `cvjdb`.`event` (`event_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`supplier`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`supplier` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`supplier` (
  `supplier_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NULL DEFAULT NULL,
  `email` VARCHAR(200) NULL DEFAULT NULL,
  `address` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`outsourced_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`outsourced_item` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`outsourced_item` (
  `outsourced_item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_name` VARCHAR(200) NULL DEFAULT NULL,
  `supplier_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`outsourced_item_id`),
  INDEX `outsourced_item_supplier_supplier_id_fk` (`supplier_id` ASC) VISIBLE,
  CONSTRAINT `outsourced_item_supplier_supplier_id_fk`
    FOREIGN KEY (`supplier_id`)
    REFERENCES `cvjdb`.`supplier` (`supplier_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`event_outsource_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`event_outsource_item` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`event_outsource_item` (
  `event_id` INT(11) NOT NULL,
  `outsourced_item_id` INT(11) NULL DEFAULT NULL,
  `quantity` INT(11) NULL DEFAULT NULL,
  `total_price` DECIMAL(10,0) NULL DEFAULT NULL,
  INDEX `event_outsource_item_event_event_name_fk` (`event_id` ASC) VISIBLE,
  INDEX `event_outsource_item_outsourced_item_outsourced_item_id_fk` (`outsourced_item_id` ASC) VISIBLE,
  UNIQUE INDEX `event_id_UNIQUE` (`event_id` ASC) VISIBLE,
  CONSTRAINT `event_outsource_item_event_event_name_fk`
    FOREIGN KEY (`event_id`)
    REFERENCES `cvjdb`.`event` (`event_id`),
  CONSTRAINT `event_outsource_item_outsourced_item_outsourced_item_id_fk`
    FOREIGN KEY (`outsourced_item_id`)
    REFERENCES `cvjdb`.`outsourced_item` (`outsourced_item_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`measure_ref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`measure_ref` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`measure_ref` (
  `measure_id` INT(11) NOT NULL AUTO_INCREMENT,
  `measure` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`measure_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`ingredient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`ingredient` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`ingredient` (
  `ingredient_id` INT(5) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `measure` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`),
  INDEX `fk_ingredient_measure_ref1_idx` (`measure` ASC) VISIBLE,
  CONSTRAINT `fk_ingredient_measure_ref1`
    FOREIGN KEY (`measure`)
    REFERENCES `cvjdb`.`measure_ref` (`measure_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`inventory_audit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`inventory_audit` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`inventory_audit` (
  `audit` INT(11) NOT NULL AUTO_INCREMENT,
  `inventory_id` INT(5) NOT NULL,
  `changes_made` VARCHAR(255) NOT NULL,
  `audit_date` TIMESTAMP NULL DEFAULT NULL,
  `last_modified` TIMESTAMP NOT NULL,
  `reason` VARCHAR(255) NOT NULL,
  `reason_extra` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`audit`, `inventory_id`),
  INDEX `fk_inventory_audit_inventory2_idx` (`inventory_id` ASC) VISIBLE,
  CONSTRAINT `fk_inventory_audit_inventory2`
    FOREIGN KEY (`inventory_id`)
    REFERENCES `cvjdb`.`inventory` (`inventory_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`inventory_returned`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`inventory_returned` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`inventory_returned` (
  `event_returned` INT(11) NOT NULL,
  `returned_id` INT(5) NOT NULL,
  `quantity` INT(7) NOT NULL,
  `date_returned` DATETIME NOT NULL,
  PRIMARY KEY (`returned_id`),
  INDEX `fk_inventory_deployed_event1_idx` (`event_returned` ASC) VISIBLE,
  UNIQUE INDEX `event_returned_UNIQUE` (`event_returned` ASC) VISIBLE,
  CONSTRAINT `fk_inventory_deployed_event1`
    FOREIGN KEY (`event_returned`)
    REFERENCES `cvjdb`.`event` (`event_id`),
  CONSTRAINT `fk_inventory_deployed_inventory1`
    FOREIGN KEY (`returned_id`)
    REFERENCES `cvjdb`.`inventory` (`inventory_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`rawmaterial`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`rawmaterial` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`rawmaterial` (
  `rawmaterial_id` INT(5) NOT NULL AUTO_INCREMENT,
  `ingredient_id` INT(5) NOT NULL,
  `name` VARCHAR(45) NOT NULL DEFAULT 'Generic Brand',
  `quantity` INT(11) NOT NULL DEFAULT '0',
  `measure` INT(11) NOT NULL,
  `piece` INT(11) NULL DEFAULT '0',
  `ordertype` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`rawmaterial_id`),
  INDEX `fk_rawmaterial_ingredient1_idx` (`ingredient_id` ASC) VISIBLE,
  INDEX `fk_rawmaterial_measure_ref1_idx` (`measure` ASC) VISIBLE,
  CONSTRAINT `fk_rawmaterial_ingredient1`
    FOREIGN KEY (`ingredient_id`)
    REFERENCES `cvjdb`.`ingredient` (`ingredient_id`),
  CONSTRAINT `fk_rawmaterial_measure_ref1`
    FOREIGN KEY (`measure`)
    REFERENCES `cvjdb`.`measure_ref` (`measure_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`items` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`items` (
  `item_id` INT(11) NOT NULL,
  `item_name` VARCHAR(45) NOT NULL,
  `package_id` INT(11) NOT NULL,
  `rawmaterial_id` INT(5) NOT NULL,
  PRIMARY KEY (`item_id`),
  INDEX `fk_items_package1_idx` (`package_id` ASC) VISIBLE,
  INDEX `fk_items_rawmaterial1_idx` (`rawmaterial_id` ASC) VISIBLE,
  CONSTRAINT `fk_items_package1`
    FOREIGN KEY (`package_id`)
    REFERENCES `cvjdb`.`package` (`package_id`),
  CONSTRAINT `fk_items_rawmaterial1`
    FOREIGN KEY (`rawmaterial_id`)
    REFERENCES `cvjdb`.`rawmaterial` (`rawmaterial_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`lost_inventory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`lost_inventory` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`lost_inventory` (
  `lost_id` INT(5) NOT NULL,
  `event_id` INT(11) NOT NULL,
  `quantity` INT(7) NOT NULL,
  `date_reported` DATETIME NOT NULL,
  PRIMARY KEY (`lost_id`),
  INDEX `fk_event_name_idx` (`event_id` ASC) VISIBLE,
  UNIQUE INDEX `event_id_UNIQUE` (`event_id` ASC) VISIBLE,
  CONSTRAINT ``
    FOREIGN KEY (`lost_id`)
    REFERENCES `cvjdb`.`inventory` (`inventory_id`),
  CONSTRAINT `fk_event_name_lost`
    FOREIGN KEY (`event_id`)
    REFERENCES `cvjdb`.`event` (`event_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`material`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`material` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`material` (
  `material_id` INT(11) NOT NULL AUTO_INCREMENT,
  `material_name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`material_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`migrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`migrations` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cvjdb`.`sales_report`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`sales_report` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`sales_report` (
  `NoOfSales` INT(11) NOT NULL,
  `TotalSales` DECIMAL(10,2) NULL DEFAULT NULL,
  `MONTH` INT(11) NOT NULL,
  `YEAR` INT(11) NOT NULL,
  PRIMARY KEY (`MONTH`, `YEAR`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`month_ref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`month_ref` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`month_ref` (
  `month_no` INT(11) NOT NULL,
  `month_name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`month_no`),
  CONSTRAINT `fk_month_ref_sales_report1`
    FOREIGN KEY (`month_no`)
    REFERENCES `cvjdb`.`sales_report` (`MONTH`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`payment` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`payment` (
  `payment_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `billing_id` INT(11) NOT NULL,
  `date_paid` DATETIME NOT NULL,
  `payment_amount` DECIMAL(10,2) NOT NULL,
  `modeofpayment` VARCHAR(45) NULL DEFAULT NULL,
  `ref_number` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`, `billing_id`),
  INDEX `fk_payment_billing1_idx` (`billing_id` ASC) VISIBLE,
  CONSTRAINT `fk_payment_billing1`
    FOREIGN KEY (`billing_id`)
    REFERENCES `cvjdb`.`billing` (`billing_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`rawmaterial_audit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`rawmaterial_audit` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`rawmaterial_audit` (
  `audit_id` INT(11) NOT NULL AUTO_INCREMENT,
  `rawmaterial_id` INT(5) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `date` DATE NOT NULL,
  `reason` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`audit_id`, `rawmaterial_id`),
  INDEX `fk_rawmaterial_audit_rawmaterial1` (`rawmaterial_id` ASC) VISIBLE,
  CONSTRAINT `fk_rawmaterial_audit_rawmaterial1`
    FOREIGN KEY (`rawmaterial_id`)
    REFERENCES `cvjdb`.`rawmaterial` (`rawmaterial_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`recipe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`recipe` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`recipe` (
  `recipe_id` INT(11) NOT NULL AUTO_INCREMENT,
  `recipe_name` VARCHAR(255) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `package_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`recipe_id`),
  INDEX `fk_recipe_package1_idx` (`package_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_package1`
    FOREIGN KEY (`package_id`)
    REFERENCES `cvjdb`.`package` (`package_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`recipe_items`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`recipe_items` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`recipe_items` (
  `recipe_id` INT(11) NOT NULL,
  `ingredient_id` INT(5) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `measure` INT(11) NOT NULL,
  PRIMARY KEY (`ingredient_id`, `recipe_id`),
  INDEX `fk_recipe_items_measure_ref1_idx` (`measure` ASC) VISIBLE,
  INDEX `fk_recipe_items_ingredient1_idx` (`ingredient_id` ASC) VISIBLE,
  INDEX `fk_recipe_items_recipe1` (`recipe_id` ASC) VISIBLE,
  CONSTRAINT `fk_recipe_items_ingredient1`
    FOREIGN KEY (`ingredient_id`)
    REFERENCES `cvjdb`.`ingredient` (`ingredient_id`),
  CONSTRAINT `fk_recipe_items_measure_ref1`
    FOREIGN KEY (`measure`)
    REFERENCES `cvjdb`.`measure_ref` (`measure_id`),
  CONSTRAINT `fk_recipe_items_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `cvjdb`.`recipe` (`recipe_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`recipe_steps`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`recipe_steps` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`recipe_steps` (
  `recipe_id` INT(11) NOT NULL,
  `step_no` INT(5) NOT NULL,
  `step_desc` LONGTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`recipe_id`, `step_no`),
  CONSTRAINT `fk_recipe_steps_recipe1`
    FOREIGN KEY (`recipe_id`)
    REFERENCES `cvjdb`.`recipe` (`recipe_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`subcategory_ref`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`subcategory_ref` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`subcategory_ref` (
  `category_no` TINYINT(1) NOT NULL,
  `subcategory` TINYINT(1) NOT NULL AUTO_INCREMENT,
  `subcategory_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`subcategory`),
  INDEX `fk_subcategory_ref_category_ref1_idx` (`category_no` ASC) VISIBLE,
  CONSTRAINT `fk_subcategory_ref_category_ref1`
    FOREIGN KEY (`category_no`)
    REFERENCES `cvjdb`.`category_ref` (`category_no`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cvjdb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cvjdb`.`users` ;

CREATE TABLE IF NOT EXISTS `cvjdb`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `password` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `userType` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `verified` TINYINT(4) NULL DEFAULT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
