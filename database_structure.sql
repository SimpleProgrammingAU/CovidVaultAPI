/*
SQLyog Community
MySQL - 10.2.31-MariaDB-log-cll-lve : Database - simplepr_covid
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `account_snapshots` */

CREATE TABLE `account_snapshots` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(127) COLLATE utf8mb4_bin NOT NULL,
  `phone` char(12) COLLATE utf8mb4_bin NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `suburb` varchar(127) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `postcode` char(4) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `auth` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `snapshot_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

/*Table structure for table `accounts` */

CREATE TABLE `accounts` (
  `id` bigint(20) NOT NULL,
  `business_name` varchar(127) COLLATE utf8mb4_bin NOT NULL,
  `auth_contact` varchar(127) COLLATE utf8mb4_bin NOT NULL,
  `avatar` varchar(127) COLLATE utf8mb4_bin DEFAULT 'NULL',
  `phone` char(12) COLLATE utf8mb4_bin NOT NULL DEFAULT '+61',
  `street_address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `suburb` varchar(127) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(3) COLLATE utf8mb4_bin NOT NULL,
  `postcode` char(4) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ABN` bigint(11) DEFAULT NULL,
  `checklist_select_all` tinyint(1) NOT NULL DEFAULT 0,
  `auth` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `login_attempts` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

/*Table structure for table `checklist` */

CREATE TABLE `checklist` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `statement` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ACCOUNT` (`account_id`),
  CONSTRAINT `Account Deletion` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

/*Table structure for table `contacts` */

CREATE TABLE `contacts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `name` varbinary(255) NOT NULL,
  `phone` char(12) COLLATE utf8mb4_bin NOT NULL DEFAULT '+61',
  `arr` datetime NOT NULL DEFAULT current_timestamp(),
  `dep` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ACCOUNT_CONSTRAINT` (`account_id`),
  CONSTRAINT `ACCOUNT_CONSTRAINT` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4267 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

/*Table structure for table `data_exports` */

CREATE TABLE `data_exports` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `rows_exported` int(11) NOT NULL,
  `date_exported` datetime NOT NULL DEFAULT current_timestamp(),
  `evidence_supplied` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

/*Table structure for table `follow_ons` */

CREATE TABLE `follow_ons` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `type` int(11) NOT NULL,
  `text` varchar(511) COLLATE utf8mb4_bin DEFAULT NULL,
  `img` varchar(127) COLLATE utf8mb4_bin DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `expiry` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ACCOUNT_FOLLOWON` (`account_id`),
  CONSTRAINT `ACCOUNT_FOLLOWON` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

/*Table structure for table `sessions` */

CREATE TABLE `sessions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_id` bigint(20) NOT NULL,
  `access_token` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `access_token_expiry` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `refresh_token` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `refresh_token_expiry` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ACCOUNT_SESSIONS` (`account_id`),
  CONSTRAINT `ACCOUNT_SESSIONS` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
