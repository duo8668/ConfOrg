/*
Navicat MySQL Data Transfer

Source Server         : WorkPC
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : conforg

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2014-12-17 16:03:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for conference_paymenttransaction
-- ----------------------------
DROP TABLE IF EXISTS `conference_paymenttransaction`;
CREATE TABLE `conference_paymenttransaction` (
  `TransactionId` int(11) NOT NULL AUTO_INCREMENT,
  `ConfUserBillId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `BillId` int(11) NOT NULL,
  `PaymentType` varchar(255) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`),
  KEY `FK_ConfPaymentTransac_01` (`ConfUserBillId`,`UserId`,`BillId`),
  KEY `TransactionId` (`TransactionId`,`UserId`,`BillId`),
  KEY `PaymentType` (`PaymentType`),
  CONSTRAINT `conference_paymenttransaction_ibfk_1` FOREIGN KEY (`PaymentType`) REFERENCES `paymenttype` (`PaymentType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
