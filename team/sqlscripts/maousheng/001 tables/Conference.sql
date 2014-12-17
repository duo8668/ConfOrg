/*
Navicat MySQL Data Transfer

Source Server         : WorkPC
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : conforg

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-12-17 16:57:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bill_component
-- ----------------------------
DROP TABLE IF EXISTS `bill_component`;
CREATE TABLE `bill_component` (
  `ComponentId` int(11) NOT NULL AUTO_INCREMENT,
  `BillId` int(11) NOT NULL,
  `ComponentType` varchar(100) NOT NULL,
  `ComponentDescription` varchar(255) NOT NULL,
  `Amount` decimal(7,2) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ComponentId`),
  KEY `FK_BillComp_01` (`BillId`),
  KEY `ComponentType` (`ComponentType`),
  CONSTRAINT `bill_component_ibfk_1` FOREIGN KEY (`ComponentType`) REFERENCES `componenttype` (`ComponentType`),
  CONSTRAINT `FK_BillComp_01` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for componenttype
-- ----------------------------
DROP TABLE IF EXISTS `componenttype`;
CREATE TABLE `componenttype` (
  `ComponentType` varchar(100) NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ComponentType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for conference
-- ----------------------------
DROP TABLE IF EXISTS `conference`;
CREATE TABLE `conference` (
  `ConfId` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `ConferenceType` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `BeginDate` date NOT NULL,
  `BeginTime` datetime NOT NULL,
  `EndDate` date NOT NULL,
  `EndTime` datetime NOT NULL,
  `IsFree` bit(1) NOT NULL DEFAULT b'0',
  `Speaker` int(11) DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`),
  KEY `ConferenceType` (`ConferenceType`),
  CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`ConferenceType`) REFERENCES `conferencetype` (`ConferenceType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for conferencetype
-- ----------------------------
DROP TABLE IF EXISTS `conferencetype`;
CREATE TABLE `conferencetype` (
  `ConferenceType` varchar(100) NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConferenceType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  UNIQUE KEY `idx_BillId` (`BillId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  CONSTRAINT `FK_ConfParti_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for conference_participantbarred
-- ----------------------------
DROP TABLE IF EXISTS `conference_participantbarred`;
CREATE TABLE `conference_participantbarred` (
  `ConfId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`UserId`),
  CONSTRAINT `FK_ConfPartiBarred_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for conference_paymenttransaction
-- ----------------------------
DROP TABLE IF EXISTS `conference_paymenttransaction`;
CREATE TABLE `conference_paymenttransaction` (
  `TransactionId` int(11) NOT NULL AUTO_INCREMENT,
  `BillId` int(11) NOT NULL,
  `PaymentType` varchar(255) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`),
  KEY `BillId` (`BillId`),
  CONSTRAINT `conference_paymenttransaction_ibfk_1` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for paymenttype
-- ----------------------------
DROP TABLE IF EXISTS `paymenttype`;
CREATE TABLE `paymenttype` (
  `PaymentType` varchar(100) NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PaymentType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  CONSTRAINT `payment_cash_ibfk_1` FOREIGN KEY (`TransactionId`) REFERENCES `conference_paymenttransaction` (`TransactionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for payment_creditcard
-- ----------------------------
DROP TABLE IF EXISTS `payment_creditcard`;
CREATE TABLE `payment_creditcard` (
  `TransactionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `BillId` int(11) NOT NULL,
  `CardNumber` varchar(5) NOT NULL,
  `AmountPaid` double(7,2) NOT NULL,
  `DatePaid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`,`UserId`,`BillId`),
  CONSTRAINT `payment_creditcard_ibfk_1` FOREIGN KEY (`TransactionId`) REFERENCES `conference_paymenttransaction` (`TransactionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
