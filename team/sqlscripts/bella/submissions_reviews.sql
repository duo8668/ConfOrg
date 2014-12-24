-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 24, 2014 at 01:11 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `conforg_db`
--
CREATE DATABASE IF NOT EXISTS `conforg_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `conforg_db`;

-- --------------------------------------------------------

--
-- Table structure for table `bill_component`
--

CREATE TABLE IF NOT EXISTS `bill_component` (
  `ComponentId` int(11) NOT NULL AUTO_INCREMENT,
  `BillId` int(11) NOT NULL,
  `ComponentType` varchar(100) NOT NULL,
  `ComponentDescription` varchar(255) NOT NULL,
  `Amount` decimal(7,2) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ComponentId`),
  KEY `FK_BillComp_01` (`BillId`),
  KEY `ComponentType` (`ComponentType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `componenttype`
--

CREATE TABLE IF NOT EXISTS `componenttype` (
  `ComponentType` varchar(100) NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ComponentType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

CREATE TABLE IF NOT EXISTS `conference` (
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
  KEY `ConferenceType` (`ConferenceType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conferencetype`
--

CREATE TABLE IF NOT EXISTS `conferencetype` (
  `ConferenceType` varchar(100) NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConferenceType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference_bill`
--

CREATE TABLE IF NOT EXISTS `conference_bill` (
  `ConfId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `BillId` int(11) NOT NULL AUTO_INCREMENT,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`UserId`),
  UNIQUE KEY `idx_BillId` (`BillId`) USING BTREE,
  KEY `ConfId` (`ConfId`,`UserId`,`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_equipmentrequest`
--

CREATE TABLE IF NOT EXISTS `conference_equipmentrequest` (
  `ConfId` int(11) NOT NULL,
  `Requestor` int(11) NOT NULL,
  `EquipmentCatId` int(11) NOT NULL,
  `EquipmentId` int(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`Requestor`,`EquipmentCatId`,`EquipmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference_participant`
--

CREATE TABLE IF NOT EXISTS `conference_participant` (
  `ConfId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_participantbarred`
--

CREATE TABLE IF NOT EXISTS `conference_participantbarred` (
  `ConfId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`,`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference_paymenttransaction`
--

CREATE TABLE IF NOT EXISTS `conference_paymenttransaction` (
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
  KEY `PaymentType` (`PaymentType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_reviewpanel`
--

CREATE TABLE IF NOT EXISTS `conference_reviewpanel` (
  `CC_Id` int(11) NOT NULL,
  `ConfId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CC_Id`),
  KEY `FK_ConfReviewPanel_01` (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conference_venue`
--

CREATE TABLE IF NOT EXISTS `conference_venue` (
  `ConfId` int(11) NOT NULL,
  `VenueId` int(11) NOT NULL,
  `MaxSeats` int(6) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ConfId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `Keyword_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `KeyString` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Keyword_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_12_14_121221_create_submission_table', 1),
('2014_12_24_092720_create_topics_table', 1),
('2014_12_24_092815_create_keywords_table', 1),
('2014_12_24_092854_create_reviews_table', 1),
('2014_12_24_093036_create_submission_topic_table', 1),
('2014_12_24_093130_create_submission_keyword_table', 1),
('2014_12_24_093155_create_submission_author_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype`
--

CREATE TABLE IF NOT EXISTS `paymenttype` (
  `PaymentType` varchar(100) NOT NULL,
  `IsEnabled` bit(1) NOT NULL DEFAULT b'1',
  `CreatedBy` int(11) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`PaymentType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_cash`
--

CREATE TABLE IF NOT EXISTS `payment_cash` (
  `TransactionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `BillId` int(11) NOT NULL,
  `AmountPaid` double(7,2) NOT NULL,
  `DatePaid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`,`UserId`,`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_creditcard`
--

CREATE TABLE IF NOT EXISTS `payment_creditcard` (
  `TransactionId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `BillId` int(11) NOT NULL,
  `CardNumber` varchar(5) NOT NULL,
  `AmountPaid` double(7,2) NOT NULL,
  `DatePaid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransactionId`,`UserId`,`BillId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `Review_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `Sub_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Conf_id` int(11) NOT NULL,
  `SubType` int(11) NOT NULL,
  `SubTitle` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `SubAbstract` text COLLATE utf8_unicode_ci NOT NULL,
  `AttachmentPath` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `SubRemarks` text COLLATE utf8_unicode_ci NOT NULL,
  `IsAccepted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Sub_id`),
  UNIQUE KEY `submissions_subtitle_unique` (`SubTitle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `submission_author`
--

CREATE TABLE IF NOT EXISTS `submission_author` (
  `Sub_id` int(11) NOT NULL,
  `Email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `Organization` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `ShortBio` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `isPresenting` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Sub_id`,`Email`),
  UNIQUE KEY `submission_author_email_unique` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_keyword`
--

CREATE TABLE IF NOT EXISTS `submission_keyword` (
  `Keyword_id` int(11) NOT NULL,
  `Sub_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Keyword_id`,`Sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_topic`
--

CREATE TABLE IF NOT EXISTS `submission_topic` (
  `Topic_id` int(11) NOT NULL,
  `Sub_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Topic_id`,`Sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `Topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Conf_id` int(11) NOT NULL,
  `TopicName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill_component`
--
ALTER TABLE `bill_component`
  ADD CONSTRAINT `bill_component_ibfk_1` FOREIGN KEY (`ComponentType`) REFERENCES `componenttype` (`ComponentType`),
  ADD CONSTRAINT `FK_BillComp_01` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`);

--
-- Constraints for table `conference`
--
ALTER TABLE `conference`
  ADD CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`ConferenceType`) REFERENCES `conferencetype` (`ConferenceType`);

--
-- Constraints for table `conference_equipmentrequest`
--
ALTER TABLE `conference_equipmentrequest`
  ADD CONSTRAINT `FK_ConfEquipRequest_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

--
-- Constraints for table `conference_participant`
--
ALTER TABLE `conference_participant`
  ADD CONSTRAINT `FK_ConfParti_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

--
-- Constraints for table `conference_participantbarred`
--
ALTER TABLE `conference_participantbarred`
  ADD CONSTRAINT `FK_ConfPartiBarred_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

--
-- Constraints for table `conference_paymenttransaction`
--
ALTER TABLE `conference_paymenttransaction`
  ADD CONSTRAINT `conference_paymenttransaction_ibfk_1` FOREIGN KEY (`PaymentType`) REFERENCES `paymenttype` (`PaymentType`);

--
-- Constraints for table `conference_reviewpanel`
--
ALTER TABLE `conference_reviewpanel`
  ADD CONSTRAINT `FK_ConfReviewPanel_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

--
-- Constraints for table `conference_venue`
--
ALTER TABLE `conference_venue`
  ADD CONSTRAINT `FK_ConfVenue_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

--
-- Constraints for table `payment_cash`
--
ALTER TABLE `payment_cash`
  ADD CONSTRAINT `FK_PaymentCash_01` FOREIGN KEY (`TransactionId`, `UserId`, `BillId`) REFERENCES `conference_paymenttransaction` (`TransactionId`, `UserId`, `BillId`);

--
-- Constraints for table `payment_creditcard`
--
ALTER TABLE `payment_creditcard`
  ADD CONSTRAINT `fk_payment_cc_01` FOREIGN KEY (`TransactionId`, `UserId`, `BillId`) REFERENCES `conference_paymenttransaction` (`TransactionId`, `UserId`, `BillId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
