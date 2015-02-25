-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2015 at 12:47 AM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `orafer_maindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `Company_id` int(11) NOT NULL AUTO_INCREMENT,
  `Company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_id`, `Company_name`) VALUES
(1, 'Expo');

-- --------------------------------------------------------

--
-- Table structure for table `company_user`
--

DROP TABLE IF EXISTS `company_user`;
CREATE TABLE IF NOT EXISTS `company_user` (
  `company_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_user`
--

INSERT INTO `company_user` (`company_user_id`, `company_id`, `user_id`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` date NOT NULL,
  `begin_time` datetime NOT NULL,
  `end_date` date NOT NULL,
  `end_time` datetime NOT NULL,
  `is_free` bit(1) NOT NULL DEFAULT b'0',
  `cutoff_time` datetime DEFAULT NULL,
  `min_score` double DEFAULT NULL,
  `ticket_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conf_id`, `title`, `description`, `begin_date`, `begin_time`, `end_date`, `end_time`, `is_free`, `cutoff_time`, `min_score`, `ticket_price`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, '8th Annual International Conference on Computer Games Multimedia and Allied Technologies (CGAT 2015)', '						<p style="text-align: justify; margin-bottom: 14px; padding: 0px;"><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi varius sed', '2015-06-01', '2015-06-01 08:30:00', '2015-06-02', '2015-06-02 16:00:00', b'0', '2015-04-30 00:00:00', 60, '110.00', 1, 1, '2015-01-17 04:25:10', '2015-02-17 13:08:30'),
(2, '6th Annual International Conference on ICT: Big Data, Cloud and Security ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-05-04', '2015-05-04 09:00:00', '2015-05-05', '2015-05-05 17:00:00', b'0', '2015-03-31 00:00:00', 70, '150.00', 2, 1, '2015-01-17 04:25:58', '2015-02-18 16:12:55');

--
-- Triggers `conference`
--
DROP TRIGGER IF EXISTS `conference_BEFORE_INSERT`;
DELIMITER //
CREATE TRIGGER `conference_BEFORE_INSERT` BEFORE INSERT ON `conference`
 FOR EACH ROW IF(NEW.cutoff_time IS NULL) THEN
BEGIN
SET NEW.cutoff_time = DATE_SUB(DATE_ADD(DATE_ADD(NEW.begin_date, INTERVAL 1 MONTH), INTERVAL 1 DAY), INTERVAL 1 second) ;
END;
END if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_field`
--

DROP TABLE IF EXISTS `conference_field`;
CREATE TABLE IF NOT EXISTS `conference_field` (
  `conferencefield_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `interestfield_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencefield_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_room_schedule`
--

DROP TABLE IF EXISTS `conference_room_schedule`;
CREATE TABLE IF NOT EXISTS `conference_room_schedule` (
  `confroomschedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `begin_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`confroomschedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `conference_room_schedule`
--

INSERT INTO `conference_room_schedule` (`confroomschedule_id`, `conf_id`, `room_id`, `description`, `date_start`, `date_end`, `begin_time`, `end_time`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Testing', '2015-04-02', '2015-04-03', '2015-04-02 03:00:00', '2015-04-03 15:00:00', NULL, 0, NULL, '2015-02-14 13:46:09', '2015-02-18 16:12:56'),
(2, 2, 4, 'Testing', '2015-04-02', '2015-04-03', '2015-04-02 03:00:00', '2015-04-03 15:00:00', NULL, 0, NULL, '2015-02-14 13:46:09', '2015-02-18 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `conference_topic`
--

DROP TABLE IF EXISTS `conference_topic`;
CREATE TABLE IF NOT EXISTS `conference_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `topic_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `confuserrole`
--

DROP TABLE IF EXISTS `confuserrole`;
CREATE TABLE IF NOT EXISTS `confuserrole` (
  `confuserrole_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `conf_id` int(11) NOT NULL,
  PRIMARY KEY (`confuserrole_id`),
  KEY `confuserrole_role_id_index_01` (`role_id`),
  KEY `confuserrole_user_id_index_02` (`user_id`),
  KEY `confuserrole_ibfk_1` (`conf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `confuserrole`
--

INSERT INTO `confuserrole` (`confuserrole_id`, `role_id`, `user_id`, `conf_id`) VALUES
(1, 4, 1, 1),
(2, 4, 2, 2),
(3, 7, 3, 1),
(4, 7, 3, 2),
(5, 7, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `calling_code` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_id` int(11) NOT NULL DEFAULT '0',
  `equipment_name` varchar(45) DEFAULT NULL,
  `equipment_remark` varchar(45) DEFAULT NULL,
  `rental_cost` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`equipment_id`,`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--

DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE IF NOT EXISTS `equipment_category` (
  `equipmentcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipmentcategory_remark` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `interest_field`
--

DROP TABLE IF EXISTS `interest_field`;
CREATE TABLE IF NOT EXISTS `interest_field` (
  `interestfield_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`interestfield_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `interest_field`
--

INSERT INTO `interest_field` (`interestfield_id`, `name`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science', NULL, 0, NULL, '2015-01-14 06:48:26', NULL),
(2, 'Artificial Intelligence', NULL, 0, NULL, '2015-01-14 06:48:35', NULL),
(3, 'Databases', NULL, 0, NULL, '2015-01-14 06:48:45', NULL),
(4, 'Human-Computer Interaction', NULL, 0, NULL, '2015-01-14 06:48:57', NULL),
(5, 'Computer Security', NULL, 0, NULL, '2015-01-14 06:49:03', NULL),
(6, 'Internet Technology', NULL, 0, NULL, '2015-01-14 06:49:08', NULL),
(7, 'Open Source', NULL, 0, NULL, '2015-01-14 06:49:28', NULL),
(8, 'E-commerce', NULL, 0, NULL, '2015-01-14 06:49:38', NULL),
(9, 'Networking', NULL, 0, NULL, '2015-01-14 06:49:38', NULL),
(10, 'Mobile Technology', NULL, 0, NULL, '2015-01-14 06:49:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
CREATE TABLE IF NOT EXISTS `invitation` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`invite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`invite_id`, `code`, `email`, `company`) VALUES
(5, 'PGevFfZcgdOffwuVS24g6HQdQdTIOQVw9du44Vb83e8kgObNLmbkeREvqd6l', 'pohjun.ng@hotmail.sg', 'Expo');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'unpaid',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
CREATE TABLE IF NOT EXISTS `keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `payment_type` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_cash`
--

DROP TABLE IF EXISTS `payment_cash`;
CREATE TABLE IF NOT EXISTS `payment_cash` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_creditcard`
--

DROP TABLE IF EXISTS `payment_creditcard`;
CREATE TABLE IF NOT EXISTS `payment_creditcard` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `card_num` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE IF NOT EXISTS `payment_type` (
  `paymenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`paymenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

DROP TABLE IF EXISTS `pending`;
CREATE TABLE IF NOT EXISTS `pending` (
  `pending_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `equipmentcategory_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avaliable` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pending_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_Id` int(11) NOT NULL,
  `permission_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_Id`),
  UNIQUE KEY `permission_name_UNIQUE` (`permission_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `profile_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fb_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `uid` bigint(20) unsigned NOT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bio` text COLLATE utf8_unicode_ci,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `fb_email`, `user_id`, `uid`, `access_token`, `created_at`, `updated_at`, `bio`, `location`, `photo`) VALUES
(1, '', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(2, '', 2, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(3, '', 3, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(4, '', 4, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(5, '', 5, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(6, '', 6, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(7, 'pohjun.ng@gmail.com', 7, 10152916861920967, 'CAAV2KrdSapcBAOaIiG4F7eGmwVC5XpMUFSWWshHKR84zpJfpz7MPMUG9zucZCOAsGZA7zRsKersHdUVyC0vLTXngE3YYDo0IgrIZCkfGthrJpAnzZCgZBFbNr4ioAwEWUaVIVHwhRsZAdHj3YWL4L1jZBkTBZBcteklZBeJyw3jEZA9nbrDfO9o0K5xRZCuMxd8TqTKobmmSKTqKqjTCo8vL37l', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, 'https://graph.facebook.com/10152916861920967/picture?type=normal');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `internal_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `quality_score` int(11) NOT NULL,
  `relevance_score` int(11) NOT NULL,
  `originality_score` int(11) NOT NULL,
  `significance_score` int(11) NOT NULL,
  `presentation_score` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `roles_rolename_unique` (`rolename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `rolename`, `remarks`) VALUES
(1, 'User', 'normal user'),
(2, 'Resource Provider', 'resource provider'),
(3, 'Admin', 'super admin account'),
(4, 'Conference Chair', 'organizer'),
(5, 'Conference Staff', 'staff'),
(6, 'Author', 'author'),
(7, 'Reviewer', 'reviewer'),
(8, 'Participant', 'participant');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `rolepermission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`rolepermission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `room_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` int(45) DEFAULT NULL,
  `rental_cost` decimal(12,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`room_id`,`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `venue_id`, `room_name`, `capacity`, `rental_cost`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Hall 1', 500, '500.00', 1, NULL, '2015-01-16 05:23:07', '2015-02-18 16:12:56'),
(2, 2, 'Hall 2', 450, '550.00', 1, NULL, '2015-01-16 05:23:22', '2015-02-18 16:12:56'),
(3, 2, 'Hall 3', 550, '600.00', 1, NULL, '2015-01-16 05:23:36', '2015-02-18 16:12:56'),
(4, 2, 'Hall 4', 500, '1200.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56'),
(5, 3, 'Summit 1 (Level 3)', 600, '1000.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56'),
(6, 3, 'Summit 2 (Level 3)', 500, '1800.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56'),
(7, 3, 'Auditorium (Level 6)', 1000, '2000.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56'),
(8, 1, 'Hall A', 2500, '3300.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56'),
(9, 1, 'Jasmine Ballroom', 800, '1100.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56'),
(10, 4, 'The Star Theater', 800, '1100.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56'),
(11, 4, 'The Star Gallery', 800, '1100.00', 1, NULL, '2015-02-01 02:23:18', '2015-02-18 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `room_equipment`
--

DROP TABLE IF EXISTS `room_equipment`;
CREATE TABLE IF NOT EXISTS `room_equipment` (
  `roomequipment_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`roomequipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `sub_title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment_path` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = accepted, 9 = rejected, 0 = on review',
  `overall_score` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `submission_authors`
--

DROP TABLE IF EXISTS `submission_authors`;
CREATE TABLE IF NOT EXISTS `submission_authors` (
  `sub_id` int(11) NOT NULL,
  `email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `is_presenting` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`,`email`),
  UNIQUE KEY `submission_author_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_keyword`
--

DROP TABLE IF EXISTS `submission_keyword`;
CREATE TABLE IF NOT EXISTS `submission_keyword` (
  `keyword_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_topic`
--

DROP TABLE IF EXISTS `submission_topic`;
CREATE TABLE IF NOT EXISTS `submission_topic` (
  `topic_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sysrole`
--

DROP TABLE IF EXISTS `sysrole`;
CREATE TABLE IF NOT EXISTS `sysrole` (
  `sysrole_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sysrole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sysrole`
--

INSERT INTO `sysrole` (`sysrole_id`, `user_id`, `role_id`) VALUES
(2, 1, 1),
(3, 2, 1),
(4, 3, 1),
(5, 4, 2),
(6, 5, 1),
(7, 6, 3),
(8, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `email_temp`, `password`, `password_temp`, `remember_token`, `code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Bella', 'Ratmelia', 'bella.ratmelia@gmail.com', NULL, '$2y$10$zk0eNrBzSo1E83QVyESrm.2.MVlTz2aQiFMKBEPWfTFLhVfv1hMxG', NULL, 'QKb8qBIktNpLxh5M2gHtNkpXCaM17uokcPYyEvRQEHZcyqkcDCtL2wPnKzlX', '', 1, '2015-02-25 09:39:34', '2015-02-25 09:41:27'),
(2, 'Noverinda', 'Bella', 'bella.ratmelia@hotmail.com', NULL, '$2y$10$VnvQKbqSNcwGwBMH.y0rXe/vyJ91MfVLDSKL/JTEJQQoBoY3I/18S', NULL, 'yX4RMHllzUbFXO38wmpn1tytNCvv2nRbE1ugDJZK8TH6psh4ub94kSyoccUK', '', 1, '2015-02-25 09:41:44', '2015-02-25 09:42:29'),
(3, 'Reviewer', 'Thomas', 'batmanray@live.com.sg', NULL, '$2y$10$alAVwg4moSwWGlXYfM.lsu6XGguF1V9XuffI.ShKN3.CrCgM4ovzu', NULL, 'ZGytiNEwuVO1xir74zgPCcgieiCq0hxHItgs7R6g1zkdDVATe1Rpj86TSQC3', '', 1, '2015-02-25 09:42:27', '2015-02-25 09:54:18'),
(4, 'Resource Provider', 'Poh Jun', 'pohjun.ng@hotmail.sg', NULL, '$2y$10$8fqu6qMH1EVpzX2Gv58dbOAO7OLaGiSptpBuAMLXURURwoi0H3vOW', NULL, NULL, NULL, 1, '2015-02-25 09:54:47', '2015-02-25 09:54:47'),
(5, 'Participant', 'Thomas', 'thomas.leera@gmail.com', NULL, '$2y$10$OCHmGIUjfj/ENHp2j7kWSe55O40ASD6ZZ9VEASaazAA4BI8KS2xXm', NULL, 'jkqxTBl8vvvkQVpIqrex4M1oX0asD7TawWRlcRfdaWRkKjtOCE2i8Qk7Z2fH', '', 1, '2015-02-25 09:57:17', '2015-02-25 09:57:46'),
(6, 'admin', 'orafer', 'admin@orafer.com', NULL, '$2y$10$kX/HtiXsmoojqsfy9.Q5zeGt9EjodjK1SerS7iE4EH542w5r7vdUu', NULL, NULL, '', 1, '2015-02-25 09:58:48', '2015-02-25 09:59:34'),
(7, 'Author', 'Poh Jun', 'pohjun.ng@gmail.com', NULL, '$2y$10$x8mmQ4BF/IAoGMSNZ3BkjegqeUen8j/mQRAXV6aJJj29tqrH8BAOq', NULL, 'sgIVoLrXmqTehyRUtaeSryotB9kFhI74eVVIHPlL4HrLdpRnwWMzhe0I0cbI', '', 1, '2015-02-25 10:15:30', '2015-02-25 14:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_bill`
--

DROP TABLE IF EXISTS `user_bill`;
CREATE TABLE IF NOT EXISTS `user_bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
CREATE TABLE IF NOT EXISTS `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venue_name`, `venue_address`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Sands Expo and Convention Centre', '10 Bayfront Avenue Singapore 018956', '1.283676', ' 103.860341', 1, NULL, '2015-01-24 04:28:23', '2015-02-18 16:12:57'),
(2, 'Singapore Expo ', '1 Expo Drive Singapore 486150', '1.332875', '103.9590039', 1, NULL, '2015-02-01 02:21:03', '2015-02-23 00:16:16'),
(3, 'Suntec Singapore Convention & Exhibition Cent', '1 Raffles Boulevard Singapore 039593', '1.293493', '103.857059', 1, NULL, '2015-02-01 02:21:03', '2015-02-18 16:12:57'),
(4, 'The Star Performing Arts Centre', '1 Vista Exchange Green\r\nSingapore 138617', '1.306839', '103.788440', 1, NULL, '2015-02-01 02:21:03', '2015-02-18 16:12:57');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `confuserrole`
--
ALTER TABLE `confuserrole`
  ADD CONSTRAINT `confuserrole_ibfk_1` FOREIGN KEY (`conf_id`) REFERENCES `conference` (`conf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confuserrole_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confuserrole_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
