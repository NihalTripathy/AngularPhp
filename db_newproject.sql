/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.18-MariaDB : Database - db_newproject
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `products` */

insert  into `products`(`id`,`title`,`description`,`created_by`,`created_on`,`updated_by`,`updated_on`,`status`) values 
(10,'PRODUCT 1','TITLE 1','hello','2022-02-26 23:41:07','','0000-00-00 00:00:00',0),
(13,'PRODUCT 2','TITLE 2','GOURISANKAR','2022-02-26 23:56:31','','0000-00-00 00:00:00',0),
(14,'PRODUCT 3','TITLE 3','GOURISANKAR','2022-02-26 23:56:45','','0000-00-00 00:00:00',0),
(15,'PRODUCT 4','TITLE 4','GOURISANKAR','2022-02-26 23:57:00','','0000-00-00 00:00:00',0),
(16,'PRODUCT 5','TITLE 5','GOURISANKAR','2022-02-26 23:57:14','','0000-00-00 00:00:00',0);

/*Table structure for table `reg_master` */

DROP TABLE IF EXISTS `reg_master`;

CREATE TABLE `reg_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reg_user_id` varchar(20) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`reg_user_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

/*Data for the table `reg_master` */

insert  into `reg_master`(`id`,`reg_user_id`,`username`,`password`,`created_by`,`created_on`) values 
(41,'1645899533','pppp','12345','pppp','2022-02-26 23:48:53'),
(42,'1645899942','GOURISANKAR','12345','GOURISANKAR','2022-02-26 23:55:42');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
