/*
Navicat MySQL Data Transfer

Source Server         : WorkPC
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : conforg

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-12-24 11:52:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bill_component
-- ----------------------------
DROP TABLE IF EXISTS `bill_component`;
CREATE TABLE `bill_component` (
  `ComponentId` int(11) NOT NULL AUTO_INCREMENT,
  `BillId` int(11) NOT NULL,
  `ComponentTypeId` int(11) NOT NULL,
  `ComponentDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Amount` decimal(7,2) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ComponentId`),
  KEY `FK_BillComp_01` (`BillId`),
  KEY `ComponentType` (`ComponentTypeId`),
  CONSTRAINT `bill_component_ibfk_1` FOREIGN KEY (`ComponentTypeId`) REFERENCES `componenttype` (`ComponentTypeId`),
  CONSTRAINT `FK_BillComp_01` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bill_component
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------

-- ----------------------------
-- Table structure for componenttype
-- ----------------------------
DROP TABLE IF EXISTS `componenttype`;
CREATE TABLE `componenttype` (
  `ComponentTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `ComponentType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ComponentTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of componenttype
-- ----------------------------

-- ----------------------------
-- Table structure for conference
-- ----------------------------
DROP TABLE IF EXISTS `conference`;
CREATE TABLE `conference` (
  `ConfId` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ConfTypeId` int(11) NOT NULL,
  `Description` varchar(255) CHARACTER SET latin1 NOT NULL,
  `BeginDate` date NOT NULL,
  `BeginTime` datetime NOT NULL,
  `EndDate` date NOT NULL,
  `EndTime` datetime NOT NULL,
  `IsFree` bit(1) NOT NULL DEFAULT b'0',
  `Speaker` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`),
  UNIQUE KEY `Title` (`Title`),
  KEY `ConferenceType` (`ConfTypeId`),
  CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`ConfTypeId`) REFERENCES `conferencetype` (`ConfTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference
-- ----------------------------
INSERT INTO `conference` VALUES ('1', 'MyConf 01', '3', 'Duno what to write', '2015-01-23', '2015-01-23 08:30:00', '2015-01-26', '2015-01-26 20:30:00', '\0', null, '1', '2014-12-21 13:29:30');
INSERT INTO `conference` VALUES ('2', 'MyConf 02', '1', 'So just anyhow write', '2014-12-30', '2014-12-30 00:00:00', '2014-12-31', '2014-12-31 00:00:00', '\0', '-1', '0', '2014-12-21 19:14:11');
INSERT INTO `conference` VALUES ('3', 'MyConf 03', '2', 'And write is cool', '2014-12-30', '2014-12-30 00:00:00', '2014-12-31', '2014-12-31 00:00:00', '\0', '-1', '0', '2014-12-21 19:19:44');

-- ----------------------------
-- Table structure for conferencetype
-- ----------------------------
DROP TABLE IF EXISTS `conferencetype`;
CREATE TABLE `conferencetype` (
  `ConfTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `ConferenceType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conferencetype
-- ----------------------------
INSERT INTO `conferencetype` VALUES ('1', 'Community', '', '0', '2014-12-18 12:41:43');
INSERT INTO `conferencetype` VALUES ('2', 'Food', '', '0', '2014-12-18 12:40:23');
INSERT INTO `conferencetype` VALUES ('3', 'Technology', '', '0', '2014-12-18 12:41:15');

-- ----------------------------
-- Table structure for conferencevenueroomschedule
-- ----------------------------
DROP TABLE IF EXISTS `conferencevenueroomschedule`;
CREATE TABLE `conferencevenueroomschedule` (
  `ConferenceVenueRoomScheduleID` int(11) NOT NULL,
  `ConferenceID` int(11) DEFAULT NULL,
  `VenueID` int(11) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `Description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateStart` datetime DEFAULT NULL,
  `DateEnd` datetime DEFAULT NULL,
  `BeginTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`ConferenceVenueRoomScheduleID`),
  KEY `ConferenceID_idx` (`ConferenceID`),
  KEY `VenueID_idx` (`VenueID`),
  KEY `RoomID_idx` (`RoomID`),
  CONSTRAINT `ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `conference` (`ConfId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `RoomID` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `VenueID` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conferencevenueroomschedule
-- ----------------------------

-- ----------------------------
-- Table structure for conference_bill
-- ----------------------------
DROP TABLE IF EXISTS `conference_bill`;
CREATE TABLE `conference_bill` (
  `BillId` int(11) NOT NULL AUTO_INCREMENT,
  `ConfId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`BillId`),
  UNIQUE KEY `idx_BillId` (`BillId`) USING BTREE,
  KEY `ConfId` (`ConfId`),
  CONSTRAINT `conference_bill_ibfk_2` FOREIGN KEY (`ConfId`) REFERENCES `conference_participant` (`ConfId`),
  CONSTRAINT `conference_bill_ibfk_1` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_bill
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
  PRIMARY KEY (`ConfId`,`Requestor`,`EquipmentCatId`,`EquipmentId`),
  CONSTRAINT `FK_ConfEquipRequest_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_equipmentrequest
-- ----------------------------

-- ----------------------------
-- Table structure for conference_participant
-- ----------------------------
DROP TABLE IF EXISTS `conference_participant`;
CREATE TABLE `conference_participant` (
  `ConfId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`UserId`),
  KEY `ConfId` (`ConfId`),
  CONSTRAINT `FK_ConfParti_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_participant
-- ----------------------------
INSERT INTO `conference_participant` VALUES ('1', '1', '0', '2014-12-23 22:42:40');
INSERT INTO `conference_participant` VALUES ('2', '1', '0', '2014-12-23 22:43:30');

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
  PRIMARY KEY (`ConfId`,`UserId`),
  CONSTRAINT `FK_ConfPartiBarred_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
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
  KEY `PaymentTypeId` (`PaymentTypeId`),
  CONSTRAINT `conference_paymenttransaction_ibfk_1` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`),
  CONSTRAINT `conference_paymenttransaction_ibfk_2` FOREIGN KEY (`PaymentTypeId`) REFERENCES `paymenttype` (`PaymentId`)
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
  `ConfId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CC_Id`),
  KEY `FK_ConfReviewPanel_01` (`ConfId`),
  CONSTRAINT `FK_ConfReviewPanel_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_reviewpanel
-- ----------------------------

-- ----------------------------
-- Table structure for conference_venue
-- ----------------------------
DROP TABLE IF EXISTS `conference_venue`;
CREATE TABLE `conference_venue` (
  `ConfId` int(11) NOT NULL,
  `VenueId` int(11) NOT NULL,
  `MaxSeats` int(6) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`),
  CONSTRAINT `FK_ConfVenue_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_venue
-- ----------------------------

-- ----------------------------
-- Table structure for confuserrole
-- ----------------------------
DROP TABLE IF EXISTS `confuserrole`;
CREATE TABLE `confuserrole` (
  `confuserrole_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `conf_id` int(11) NOT NULL,
  PRIMARY KEY (`confuserrole_id`),
  KEY `confuserrole_role_id_index_01` (`role_id`),
  KEY `confuserrole_user_id_index_02` (`user_id`),
  KEY `confuserrole_ibfk_1` (`conf_id`),
  CONSTRAINT `confuserrole_ibfk_1` FOREIGN KEY (`conf_id`) REFERENCES `conference` (`ConfId`) ON DELETE CASCADE,
  CONSTRAINT `confuserrole_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  CONSTRAINT `confuserrole_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confuserrole
-- ----------------------------
INSERT INTO `confuserrole` VALUES ('1', '1', '1', '1');
INSERT INTO `confuserrole` VALUES ('2', '2', '1', '2');
INSERT INTO `confuserrole` VALUES ('3', '3', '2', '1');
INSERT INTO `confuserrole` VALUES ('4', '2', '2', '1');

-- ----------------------------
-- Table structure for equipment
-- ----------------------------
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `EquipmentID` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RentalCost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Category_CategoryID` int(11) NOT NULL,
  PRIMARY KEY (`EquipmentID`,`Category_CategoryID`),
  KEY `fk_Equipment_Category1_idx` (`Category_CategoryID`),
  CONSTRAINT `fk_Equipment_Category1` FOREIGN KEY (`Category_CategoryID`) REFERENCES `category` (`CategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of equipment
-- ----------------------------

-- ----------------------------
-- Table structure for paymenttype
-- ----------------------------
DROP TABLE IF EXISTS `paymenttype`;
CREATE TABLE `paymenttype` (
  `PaymentId` int(11) NOT NULL AUTO_INCREMENT,
  `PaymentType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of paymenttype
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
  KEY `BillId` (`BillId`),
  CONSTRAINT `payment_cash_ibfk_1` FOREIGN KEY (`TransactionId`) REFERENCES `conference_paymenttransaction` (`TransactionId`),
  CONSTRAINT `payment_cash_ibfk_2` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`)
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
  KEY `BillId` (`BillId`),
  CONSTRAINT `payment_creditcard_ibfk_1` FOREIGN KEY (`TransactionId`) REFERENCES `conference_paymenttransaction` (`TransactionId`),
  CONSTRAINT `payment_creditcard_ibfk_2` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_creditcard
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `RoomID` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Capacity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RentalCost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Venue_VenueID` int(11) NOT NULL,
  PRIMARY KEY (`RoomID`,`Venue_VenueID`),
  KEY `fk_Room_Venue_idx` (`Venue_VenueID`),
  CONSTRAINT `fk_Room_Venue` FOREIGN KEY (`Venue_VenueID`) REFERENCES `venue` (`VenueID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room
-- ----------------------------

-- ----------------------------
-- Table structure for roomequipment
-- ----------------------------
DROP TABLE IF EXISTS `roomequipment`;
CREATE TABLE `roomequipment` (
  `RoomEquipmentID` int(11) NOT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `EquipmentID` int(11) DEFAULT NULL,
  `Quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`RoomEquipmentID`),
  KEY `RoomID_idx` (`RoomID`),
  KEY `EquipmentID_idx` (`EquipmentID`),
  CONSTRAINT `RoomEquipment_EquipmentID` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `RoomEquipment_RoomID` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roomequipment
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
INSERT INTO `users` VALUES ('1', 'mr', 'jason', 'ng', 'jason@gmail.com', '$2y$10$Bahmed8JSm2QI7dPXRQgT.6Z8Y.Dt4AWNnQksx1X7u/8jisVDmg1.', 'thdvKPSqIBvCDGgvoexFsMu2sozwB6Qh1EDrzZP5JC9tAcLaqIirqHLGDRpv');
INSERT INTO `users` VALUES ('2', 'mr', 'pewpew', 'pewpew', 'pewpew@gmail.com', '$2y$10$MYnkqi7TI069Kz3F5wdFXOLWtvJpw/Ru3kV6fKZWDs76BVLSPoxAK', null);

-- ----------------------------
-- Table structure for venue
-- ----------------------------
DROP TABLE IF EXISTS `venue`;
CREATE TABLE `venue` (
  `VenueID` int(11) NOT NULL,
  `Name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreated` datetime DEFAULT NULL,
  `CreatedBy` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Postal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`VenueID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of venue
-- ----------------------------
