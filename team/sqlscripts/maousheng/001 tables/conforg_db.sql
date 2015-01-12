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
  `ComponentDescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Amount` decimal(7,2) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `Title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BeginDate` date NOT NULL,
  `BeginTime` datetime NOT NULL,
  `EndDate` date NOT NULL,
  `EndTime` datetime NOT NULL,
  `IsFree` bit(1) NOT NULL DEFAULT b'0',
  `Speaker` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`Title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference
-- ----------------------------
INSERT INTO `conference` VALUES ('1', 'MyConf 01', 'Duno what to write', '2015-01-23', '2015-01-23 08:30:00', '2015-01-26', '2015-01-26 20:30:00', '\0', null, '1', '2014-12-21 13:29:30');
INSERT INTO `conference` VALUES ('2', 'MyConf 02', 'So just anyhow write', '2014-12-30', '2014-12-30 00:00:00', '2014-12-31', '2014-12-31 00:00:00', '\0', '-1', '0', '2014-12-21 19:14:11');
INSERT INTO `conference` VALUES ('3', 'MyConf 03', 'And write is cool', '2014-12-30', '2014-12-30 00:00:00', '2014-12-31', '2014-12-31 00:00:00', '\0', '-1', '0', '2014-12-21 19:19:44');

-- ----------------------------
-- Table structure for conference_entertainment
-- ----------------------------
DROP TABLE IF EXISTS `conference_entertainment`;
CREATE TABLE `conference_entertainment` (
  `ConferenceEntertainmentID` int(11) NOT NULL AUTO_INCREMENT,
  `ConfId` int(11) NOT NULL,
  `EntertainmentID` int(11) NOT NULL,
  `ConferenceVenueRoomScheduleID` int(11) NOT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ConferenceEntertainmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_entertainment
-- ----------------------------

-- ----------------------------
-- Table structure for conference_equipmentrequest
-- ----------------------------
DROP TABLE IF EXISTS `conference_equipmentrequest`;
CREATE TABLE `conference_equipmentrequest` (
  `ConfId` int(11) NOT NULL,
  `Requestor` int(11) NOT NULL,
  `EquipmentCatId` int(11) NOT NULL,
  `EquipmentId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`Requestor`,`EquipmentCatId`,`EquipmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_equipmentrequest
-- ----------------------------

-- ----------------------------
-- Table structure for conference_equipment_request
-- ----------------------------
DROP TABLE IF EXISTS `conference_equipment_request`;
CREATE TABLE `conference_equipment_request` (
  `ConferenceEquipementRequestID` int(11) NOT NULL AUTO_INCREMENT,
  `ConfID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `EquipementID` int(11) DEFAULT NULL,
  `Quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ConferenceEquipementRequestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_equipment_request
-- ----------------------------

-- ----------------------------
-- Table structure for conference_field
-- ----------------------------
DROP TABLE IF EXISTS `conference_field`;
CREATE TABLE `conference_field` (
  `ConfFieldId` int(11) NOT NULL AUTO_INCREMENT,
  `InterestFieldId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfFieldId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_field
-- ----------------------------

-- ----------------------------
-- Table structure for conference_food
-- ----------------------------
DROP TABLE IF EXISTS `conference_food`;
CREATE TABLE `conference_food` (
  `ConferenceFoodID` int(11) NOT NULL,
  `ConfId` int(11) DEFAULT NULL,
  `FoodID` int(11) DEFAULT NULL,
  `FoodPriceID` int(11) DEFAULT NULL,
  `Quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Delivery Date & Time` datetime DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ConferenceFoodID`),
  KEY `ConferenceID_idx` (`ConfId`),
  KEY `FoodID_idx` (`FoodID`),
  KEY `FoodPriceID_idx` (`FoodPriceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_food
-- ----------------------------

-- ----------------------------
-- Table structure for conference_participantbarred
-- ----------------------------
DROP TABLE IF EXISTS `conference_participantbarred`;
CREATE TABLE `conference_participantbarred` (
  `ConfId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_participantbarred
-- ----------------------------

-- ----------------------------
-- Table structure for conference_paymenttransaction
-- ----------------------------
DROP TABLE IF EXISTS `conference_paymenttransaction`;
CREATE TABLE `conference_paymenttransaction` (
  `TransactionId` int(11) NOT NULL AUTO_INCREMENT,
  `BillId` int(11) NOT NULL,
  `PaymentTypeId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`),
  KEY `BillId` (`BillId`),
  KEY `PaymentTypeId` (`PaymentTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_paymenttransaction
-- ----------------------------

-- ----------------------------
-- Table structure for conference_reviewpanel
-- ----------------------------
DROP TABLE IF EXISTS `conference_reviewpanel`;
CREATE TABLE `conference_reviewpanel` (
  `CC_Id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CC_Id`),
  KEY `FK_ConfReviewPanel_01` (`conf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_reviewpanel
-- ----------------------------

-- ----------------------------
-- Table structure for conference_room_schedule
-- ----------------------------
DROP TABLE IF EXISTS `conference_room_schedule`;
CREATE TABLE `conference_room_schedule` (
  `conf_room_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `Description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateStart` date DEFAULT NULL,
  `DateEnd` date DEFAULT NULL,
  `BeginTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`conf_room_schedule_id`),
  KEY `ConferenceID_idx` (`conf_id`),
  KEY `RoomID_idx` (`room_id`)
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
  PRIMARY KEY (`confuserrole_id`),
  KEY `confuserrole_role_id_index_01` (`role_id`),
  KEY `confuserrole_user_id_index_02` (`user_id`),
  KEY `confuserrole_ibfk_1` (`conf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confuserrole
-- ----------------------------

-- ----------------------------
-- Table structure for cuisine
-- ----------------------------
DROP TABLE IF EXISTS `cuisine`;
CREATE TABLE `cuisine` (
  `CusineID` int(11) NOT NULL,
  `Description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CusineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cuisine
-- ----------------------------

-- ----------------------------
-- Table structure for entertainment
-- ----------------------------
DROP TABLE IF EXISTS `entertainment`;
CREATE TABLE `entertainment` (
  `EntertainmentID` int(11) NOT NULL,
  `Organization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TypeID` int(11) DEFAULT NULL,
  `Cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Duration` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PointOfContact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `POC description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EntertainmentID`),
  KEY `TypeID_idx` (`TypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment
-- ----------------------------

-- ----------------------------
-- Table structure for entertainment_type
-- ----------------------------
DROP TABLE IF EXISTS `entertainment_type`;
CREATE TABLE `entertainment_type` (
  `EntertainmentTypeID` int(11) NOT NULL,
  `Description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`EntertainmentTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment_type
-- ----------------------------

-- ----------------------------
-- Table structure for equipment
-- ----------------------------
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_ID` int(11) NOT NULL DEFAULT '0',
  `EquipmentName` varchar(45) DEFAULT NULL,
  `EquipmentRemarks` varchar(45) DEFAULT NULL,
  `RentalCost` varchar(45) DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`,`Category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipment
-- ----------------------------

-- ----------------------------
-- Table structure for food
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `FoodID` int(11) NOT NULL,
  `Oragnaization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CuisnieID` int(11) DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PointOfContact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `POC description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`FoodID`),
  KEY `CusineID_idx` (`CuisnieID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food
-- ----------------------------

-- ----------------------------
-- Table structure for food_price
-- ----------------------------
DROP TABLE IF EXISTS `food_price`;
CREATE TABLE `food_price` (
  `FoodPriceID` int(11) NOT NULL,
  `FoodID` int(11) DEFAULT NULL,
  `Description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MealType` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`FoodPriceID`),
  KEY `FoodID_idx` (`FoodID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food_price
-- ----------------------------

-- ----------------------------
-- Table structure for interest_field
-- ----------------------------
DROP TABLE IF EXISTS `interest_field`;
CREATE TABLE `interest_field` (
  `FieldId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`FieldId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of interest_field
-- ----------------------------

-- ----------------------------
-- Table structure for menu_items
-- ----------------------------
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `MenuItemsID` int(11) NOT NULL,
  `FoodPriceID` int(11) DEFAULT NULL,
  `Description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`MenuItemsID`),
  KEY `FoodPriceID_idx` (`FoodPriceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu_items
-- ----------------------------

-- ----------------------------
-- Table structure for payment_cash
-- ----------------------------
DROP TABLE IF EXISTS `payment_cash`;
CREATE TABLE `payment_cash` (
  `TransactionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `BillId` int(11) NOT NULL,
  `AmountPaid` double(7,2) NOT NULL,
  `DatePaid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`,`UserId`,`BillId`),
  KEY `BillId` (`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_cash
-- ----------------------------

-- ----------------------------
-- Table structure for payment_creditcard
-- ----------------------------
DROP TABLE IF EXISTS `payment_creditcard`;
CREATE TABLE `payment_creditcard` (
  `TransactionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `BillId` int(11) NOT NULL,
  `CardNumber` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `AmountPaid` double(7,2) NOT NULL,
  `DatePaid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`,`UserId`,`BillId`),
  KEY `BillId` (`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_creditcard
-- ----------------------------

-- ----------------------------
-- Table structure for payment_type
-- ----------------------------
DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE `payment_type` (
  `PaymentId` int(11) NOT NULL AUTO_INCREMENT,
  `PaymentType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_type
-- ----------------------------

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `Review_id` int(11) NOT NULL AUTO_INCREMENT,
  `Sub_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `InternalComment` text COLLATE utf8_unicode_ci NOT NULL,
  `Comment` text COLLATE utf8_unicode_ci NOT NULL,
  `QualityScore` int(11) NOT NULL,
  `RelevanceScore` int(11) NOT NULL,
  `OriginalityScore` int(11) NOT NULL,
  `SignificanceScore` int(11) NOT NULL,
  `PresentationScore` int(11) NOT NULL,
  `Recommendation` int(11) NOT NULL,
  `ReviewerFamiliarity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Review_id`),
  KEY `User_id` (`User_id`),
  KEY `Sub_id` (`Sub_id`)
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
  `ID` int(11) NOT NULL,
  `Venue_ID` int(11) NOT NULL,
  `RoomName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Capacity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RentalCost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`,`Venue_ID`),
  KEY `fk_Room_Venue_idx` (`Venue_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room
-- ----------------------------

-- ----------------------------
-- Table structure for room_cost
-- ----------------------------
DROP TABLE IF EXISTS `room_cost`;
CREATE TABLE `room_cost` (
  `RoomCostID` int(11) NOT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `SeatTypeID` int(11) DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`RoomCostID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room_cost
-- ----------------------------

-- ----------------------------
-- Table structure for room_equipment
-- ----------------------------
DROP TABLE IF EXISTS `room_equipment`;
CREATE TABLE `room_equipment` (
  `RoomEquipmentID` int(11) NOT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `EquipmentID` int(11) DEFAULT NULL,
  `Quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`RoomEquipmentID`),
  KEY `RoomID_idx` (`RoomID`),
  KEY `EquipmentID_idx` (`EquipmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room_equipment
-- ----------------------------

-- ----------------------------
-- Table structure for seat_type
-- ----------------------------
DROP TABLE IF EXISTS `seat_type`;
CREATE TABLE `seat_type` (
  `SeatTypeID` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SeatTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of seat_type
-- ----------------------------

-- ----------------------------
-- Table structure for submissions
-- ----------------------------
DROP TABLE IF EXISTS `submissions`;
CREATE TABLE `submissions` (
  `Sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Conf_id` int(11) NOT NULL,
  `SubType` int(11) NOT NULL,
  `SubTitle` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `SubAbstract` text COLLATE utf8_unicode_ci NOT NULL,
  `AttachmentPath` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `SubRemarks` text COLLATE utf8_unicode_ci NOT NULL,
  `IsAccepted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Sub_id`),
  UNIQUE KEY `submissions_subtitle_unique` (`SubTitle`),
  KEY `User_id` (`User_id`),
  KEY `Conf_id` (`Conf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submissions
-- ----------------------------

-- ----------------------------
-- Table structure for submission_author
-- ----------------------------
DROP TABLE IF EXISTS `submission_author`;
CREATE TABLE `submission_author` (
  `Sub_id` int(11) NOT NULL,
  `Email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `Organization` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `ShortBio` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `isPresenting` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Sub_id`,`Email`),
  UNIQUE KEY `submission_author_email_unique` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_author
-- ----------------------------

-- ----------------------------
-- Table structure for submission_keyword
-- ----------------------------
DROP TABLE IF EXISTS `submission_keyword`;
CREATE TABLE `submission_keyword` (
  `Keyword_id` int(11) NOT NULL,
  `Sub_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Keyword_id`,`Sub_id`),
  KEY `Sub_id` (`Sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for submission_topic
-- ----------------------------
DROP TABLE IF EXISTS `submission_topic`;
CREATE TABLE `submission_topic` (
  `Topic_id` int(11) NOT NULL,
  `Sub_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Topic_id`,`Sub_id`),
  KEY `Sub_id` (`Sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_topic
-- ----------------------------

-- ----------------------------
-- Table structure for topics
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `Topic_id` int(10) NOT NULL AUTO_INCREMENT,
  `Conf_id` int(11) NOT NULL,
  `TopicName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Topic_id`)
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
  `BillId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_bill
-- ----------------------------

-- ----------------------------
-- Table structure for venue
-- ----------------------------
DROP TABLE IF EXISTS `venue`;
CREATE TABLE `venue` (
  `ID` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of venue
-- ----------------------------
