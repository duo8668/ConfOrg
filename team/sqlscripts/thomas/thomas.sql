/*
Navicat MySQL Data Transfer

Source Server         : conforg
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-13 07:40:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bill_component
-- ----------------------------
DROP TABLE IF EXISTS `bill_component`;
CREATE TABLE `bill_component` (
  `billcomponent_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `billcomponenttype_id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`billcomponent_id`),
  KEY `FK_BillComp_01` (`bill_id`),
  KEY `BillComponentType` (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bill_component
-- ----------------------------

-- ----------------------------
-- Table structure for bill_component_type
-- ----------------------------
DROP TABLE IF EXISTS `bill_component_type`;
CREATE TABLE `bill_component_type` (
  `billcomponenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bill_component_type
-- ----------------------------

-- ----------------------------
-- Table structure for conference
-- ----------------------------
DROP TABLE IF EXISTS `conference`;
CREATE TABLE `conference` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` date NOT NULL,
  `begin_time` datetime NOT NULL,
  `end_date` date NOT NULL,
  `end_time` datetime NOT NULL,
  `is_free` bit(1) NOT NULL DEFAULT b'0',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`Title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference
-- ----------------------------

-- ----------------------------
-- Table structure for conference_entertainment
-- ----------------------------
DROP TABLE IF EXISTS `conference_entertainment`;
CREATE TABLE `conference_entertainment` (
  `conference_entertainment_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `entertainment_id` int(11) NOT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`conference_entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_entertainment
-- ----------------------------

-- ----------------------------
-- Table structure for conference_equipmentrequest
-- ----------------------------
DROP TABLE IF EXISTS `conference_equipmentrequest`;
CREATE TABLE `conference_equipmentrequest` (
  `conferenceequipmentrequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `equipmentcat_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`conferenceequipmentrequest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_equipmentrequest
-- ----------------------------


-- ----------------------------
-- Table structure for conference_field
-- ----------------------------
DROP TABLE IF EXISTS `conference_field`;
CREATE TABLE `conference_field` (
  `conferencefield_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `interestfield_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`conferencefield_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_field
-- ----------------------------

-- ----------------------------
-- Table structure for conference_food
-- ----------------------------
DROP TABLE IF EXISTS `conference_food`;
CREATE TABLE `conference_food` (
  `conferencefood_id` int(11) NOT NULL,
  `conf_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `foodprice_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_datetime` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`conferencefood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_food
-- ----------------------------

-- ----------------------------
-- Table structure for conference_paymenttransaction
-- ----------------------------
DROP TABLE IF EXISTS `conference_paymenttransaction`;
CREATE TABLE `conference_paymenttransaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `paymenttype_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_paymenttransaction
-- ----------------------------

-- ----------------------------
-- Table structure for conference_reviewpanel
-- ----------------------------
DROP TABLE IF EXISTS `conference_reviewpanel`;
CREATE TABLE `conference_reviewpanel` (
  `conferencereviewpanel_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`conferencereviewpanel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_reviewpanel
-- ----------------------------

-- ----------------------------
-- Table structure for conference_room_schedule
-- ----------------------------
DROP TABLE IF EXISTS `conference_room_schedule`;
CREATE TABLE `conference_room_schedule` (
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
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`confroomschedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_room_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for confuserrole
-- ----------------------------
DROP TABLE IF EXISTS `confuserrole`;
CREATE TABLE `confuserrole` (
  `confuserrole_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`confuserrole_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confuserrole
-- ----------------------------

-- ----------------------------
-- Table structure for cuisine
-- ----------------------------
DROP TABLE IF EXISTS `cuisine`;
CREATE TABLE `cuisine` (
  `cusine_id` int(11) NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`cusine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cuisine
-- ----------------------------

-- ----------------------------
-- Table structure for entertainment
-- ----------------------------
DROP TABLE IF EXISTS `entertainment`;
CREATE TABLE `entertainment` (
  `entertainment_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `entertainment_cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entertainment_duration` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_of_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poc_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment
-- ----------------------------

-- ----------------------------
-- Table structure for entertainment_type
-- ----------------------------
DROP TABLE IF EXISTS `entertainment_type`;
CREATE TABLE `entertainment_type` (
  `entertainmenteype_id` int(11) NOT NULL,
  `entertainment_type_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`entertainmenteype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment_type
-- ----------------------------

-- ----------------------------
-- Table structure for equipment
-- ----------------------------
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `equipment_name` varchar(45) DEFAULT NULL,
  `equipment_remarks` varchar(45) DEFAULT NULL,
  `rental_cost` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`equipment_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipment
-- ----------------------------

-- ----------------------------
-- Table structure for food
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `oragnaization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuisnie_id` int(11) DEFAULT NULL,
  `food_remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_of_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poc_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food
-- ----------------------------

-- ----------------------------
-- Table structure for food_price
-- ----------------------------
DROP TABLE IF EXISTS `food_price`;
CREATE TABLE `food_price` (
  `foodprice_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_id` int(11) DEFAULT NULL,
  `food_price_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `food_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meal_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`foodprice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food_price
-- ----------------------------

-- ----------------------------
-- Table structure for interest_field
-- ----------------------------
DROP TABLE IF EXISTS `interest_field`;
CREATE TABLE `interest_field` (
  `interestfield_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`interestfield_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of interest_field
-- ----------------------------

-- ----------------------------
-- Table structure for menu_items
-- ----------------------------
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `menuitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `foodprice_id` int(11) DEFAULT NULL,
  `menu_items_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`menuitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu_items
-- ----------------------------

-- ----------------------------
-- Table structure for payment_cash
-- ----------------------------
DROP TABLE IF EXISTS `payment_cash`;
CREATE TABLE `payment_cash` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_cash
-- ----------------------------

-- ----------------------------
-- Table structure for payment_creditcard
-- ----------------------------
DROP TABLE IF EXISTS `payment_creditcard`;
CREATE TABLE `payment_creditcard` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `card_num` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_creditcard
-- ----------------------------

-- ----------------------------
-- Table structure for payment_type
-- ----------------------------
DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE `payment_type` (
  `paymenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`paymenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_type
-- ----------------------------

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
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
  `recommendation` int(11) NOT NULL,
  `reviewer_familiarity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of reviews
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `roles_rolename_unique` (`rolename`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'reviewer', 'reviewer');
INSERT INTO `roles` VALUES ('2', 'participant', 'participant');
INSERT INTO `roles` VALUES ('3', 'author', 'author');

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `room_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rental_cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`room_id`,`venue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room
-- ----------------------------

-- ----------------------------
-- Table structure for room_cost
-- ----------------------------
DROP TABLE IF EXISTS `room_cost`;
CREATE TABLE `room_cost` (
  `roomcost_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `seattype_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`roomcost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room_cost
-- ----------------------------

-- ----------------------------
-- Table structure for room_equipment
-- ----------------------------
DROP TABLE IF EXISTS `room_equipment`;
CREATE TABLE `room_equipment` (
  `roomequipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roomequipment_remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`roomequipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room_equipment
-- ----------------------------

-- ----------------------------
-- Table structure for seat_type
-- ----------------------------
DROP TABLE IF EXISTS `seat_type`;
CREATE TABLE `seat_type` (
  `seattype_id` int(11) NOT NULL AUTO_INCREMENT,
  `seattype_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seattype_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`seattype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of seat_type
-- ----------------------------

-- ----------------------------
-- Table structure for submissions
-- ----------------------------
DROP TABLE IF EXISTS `submissions`;
CREATE TABLE `submissions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `sub_title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment_path` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `is_accepted` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`sub_id`),
  UNIQUE KEY `submissions_subtitle_unique` (`sub_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submissions
-- ----------------------------

-- ----------------------------
-- Table structure for submission_author
-- ----------------------------
DROP TABLE IF EXISTS `submission_author`;
CREATE TABLE `submission_author` (
  `sub_id` int(11) NOT NULL,
  `email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `short_bio` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `is_presenting` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`sub_id`,`email`),
  UNIQUE KEY `submission_author_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_author
-- ----------------------------

-- ----------------------------
-- Table structure for submission_keyword
-- ----------------------------
DROP TABLE IF EXISTS `submission_keyword`;
CREATE TABLE `submission_keyword` (
  `keyword_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for submission_topic
-- ----------------------------
DROP TABLE IF EXISTS `submission_topic`;
CREATE TABLE `submission_topic` (
  `topic_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`topic_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_topic
-- ----------------------------

-- ----------------------------
-- Table structure for topics
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `topic_id` int(10) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `topic_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of topics
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'mr', 'jason', 'ng', 'jason@gmail.com', '$2y$10$Bahmed8JSm2QI7dPXRQgT.6Z8Y.Dt4AWNnQksx1X7u/8jisVDmg1.', 'l7oOPr6rmVloVhXaw4q0lxean2hvUJwOMwoP3hi8tkcACjstPUuKzzZmRSJC');
INSERT INTO `users` VALUES ('2', 'mr', 'pewpew', 'pewpew', 'pewpew@gmail.com', '$2y$10$MYnkqi7TI069Kz3F5wdFXOLWtvJpw/Ru3kV6fKZWDs76BVLSPoxAK', null);

-- ----------------------------
-- Table structure for user_bill
-- ----------------------------
DROP TABLE IF EXISTS `user_bill`;
CREATE TABLE `user_bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_bill
-- ----------------------------

-- ----------------------------
-- Table structure for venue
-- ----------------------------
DROP TABLE IF EXISTS `venue`;
CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of venue
-- ----------------------------
