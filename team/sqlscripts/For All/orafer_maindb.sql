-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2015 at 04:12 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";

-- --------------------------------------------------------

--
-- Table structure for table `bill_component`
--

DROP TABLE IF EXISTS `bill_component`;
CREATE TABLE IF NOT EXISTS `bill_component` (
  `billcomponent_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `billcomponenttype_id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`billcomponent_id`),
  KEY `FK_BillComp_01` (`bill_id`),
  KEY `BillComponentType` (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bill_component_type`
--

DROP TABLE IF EXISTS `bill_component_type`;
CREATE TABLE IF NOT EXISTS `bill_component_type` (
  `billcomponenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `Company_id` int(11) NOT NULL AUTO_INCREMENT,
  `Company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

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
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

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
-- Table structure for table `conference_entertainment`
--

DROP TABLE IF EXISTS `conference_entertainment`;
CREATE TABLE IF NOT EXISTS `conference_entertainment` (
  `conference_entertainment_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `entertainment_id` int(11) NOT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conference_entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_equipmentrequest`
--

DROP TABLE IF EXISTS `conference_equipmentrequest`;
CREATE TABLE IF NOT EXISTS `conference_equipmentrequest` (
  `conferenceequipmentrequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `equipmentcat_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferenceequipmentrequest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencefield_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_food`
--

DROP TABLE IF EXISTS `conference_food`;
CREATE TABLE IF NOT EXISTS `conference_food` (
  `conferencefood_id` int(11) NOT NULL,
  `conf_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `foodprice_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_datetime` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencefood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conference_paymenttransaction`
--

DROP TABLE IF EXISTS `conference_paymenttransaction`;
CREATE TABLE IF NOT EXISTS `conference_paymenttransaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `paymenttype_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_reviewpanel`
--

DROP TABLE IF EXISTS `conference_reviewpanel`;
CREATE TABLE IF NOT EXISTS `conference_reviewpanel` (
  `conferencereviewpanel_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencereviewpanel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`confroomschedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'unpaid',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`paymenttype_id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

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
  `capacity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rental_cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`room_id`,`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  PRIMARY KEY (`sub_id`),
  UNIQUE KEY `submissions_subtitle_unique` (`sub_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`interestfield_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `interest_field`
--

INSERT INTO `interest_field` (`interestfield_id`, `name`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science', NULL, 0, NULL, '2015-01-14 14:48:26', NULL),
(2, 'Artificial Intelligence', NULL, 0, NULL, '2015-01-14 14:48:35', NULL),
(3, 'Databases', NULL, 0, NULL, '2015-01-14 14:48:45', NULL),
(4, 'Human-Computer Interaction', NULL, 0, NULL, '2015-01-14 14:48:57', NULL),
(5, 'Computer Security', NULL, 0, NULL, '2015-01-14 14:49:03', NULL),
(6, 'Internet Technology', NULL, 0, NULL, '2015-01-14 14:49:08', NULL),
(7, 'Open Source', NULL, 0, NULL, '2015-01-14 14:49:28', NULL),
(8, 'E-commerce', NULL, 0, NULL, '2015-01-14 14:49:38', NULL),
(9, 'Networking', NULL, 0, NULL, '2015-01-14 14:49:38', NULL),
(10, 'Mobile Technology', NULL, 0, NULL, '2015-01-14 14:49:38', NULL);

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
