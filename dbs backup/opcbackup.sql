/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.11-MariaDB : Database - opc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`opc` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `opc`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rule` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`email`,`password`,`created_date`,`updated_date`,`rule`) values (8,'admin','','admin','2021-09-23 17:59:18','2021-09-23 17:59:18',1);

/*Table structure for table `appointment` */

DROP TABLE IF EXISTS `appointment`;

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(20) NOT NULL,
  `patient_contact` varchar(20) NOT NULL,
  `doctor_name` varchar(20) NOT NULL,
  `doctor_contact` varchar(20) NOT NULL,
  `appointment_fee` varchar(200) NOT NULL,
  `appiontment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `doctor_id` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `appointment` */

insert  into `appointment`(`id`,`patient_name`,`patient_contact`,`doctor_name`,`doctor_contact`,`appointment_fee`,`appiontment_date`,`status`,`doctor_id`,`created_date`,`update_date`) values (18,'ali',' 03083127419','Abbas wahab','03439011993','5000','2021-09-27 11:57:48','inactive',1,'2021-09-27 11:57:48','2021-09-27 11:57:48'),(19,'ali',' 03083127419','Abbas wahab','03439011993','5000','2021-11-19 15:01:30','inactive',1,'2021-11-19 15:01:30','2021-11-19 15:01:30');

/*Table structure for table `doctor` */

DROP TABLE IF EXISTS `doctor`;

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `skype_id` varchar(100) NOT NULL,
  `specialty` text NOT NULL,
  `degree` varchar(255) NOT NULL DEFAULT '0',
  `certificate` varchar(255) NOT NULL DEFAULT '0',
  `appointment_fee` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_unavalible` varchar(100) NOT NULL,
  `status` int(3) DEFAULT 0,
  `appointment_id` int(11) NOT NULL DEFAULT 1,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rule` int(11) NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `doctor` */

insert  into `doctor`(`id`,`name`,`password`,`gender`,`email`,`phone`,`whatsapp`,`skype_id`,`specialty`,`degree`,`certificate`,`appointment_fee`,`image`,`date_unavalible`,`status`,`appointment_id`,`created_date`,`update_date`,`rule`) values (27,'Ayeshia','123',' female','Reh@gmail.com','923083127419','03471906561','no','constertaint','header.jpg','','800','Capture.PNG','2021-11-24',1,1,'2021-11-23 16:07:27','2021-11-23 16:07:27',2);

/*Table structure for table `patients` */

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `age` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `village` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `problem` text NOT NULL,
  `status` int(3) DEFAULT 0,
  `doctor_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rule` int(11) NOT NULL DEFAULT 3,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `patients` */

insert  into `patients`(`id`,`name`,`password`,`blood_group`,`age`,`gender`,`whatsapp`,`mobile`,`village`,`city`,`district`,`problem`,`status`,`doctor_id`,`created_date`,`update_date`,`rule`) values (34,'khan','123','a','2021-11-15','male',' 03471906561','923475162145',' ghalegay',' barikot',' swat','Career Selection',0,27,'2021-11-23 16:16:45','0000-00-00 00:00:00',3),(35,'nasb','asd','a+','2021-11-04','male',' 03471906561','03475162145',' ghalegay',' barikot',' swat','male',0,27,'2021-11-23 16:24:46','0000-00-00 00:00:00',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
