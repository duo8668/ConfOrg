/*
MySQL Backup
Source Server Version: 5.6.17
Source Database: conforg
Date: 12/25/2014 16:21:24
*/
DROP DATABASE
IF EXISTS `conforg_db`;

DROP DATABASE
IF EXISTS `conforg`;

CREATE DATABASE
IF NOT EXISTS `conforg_db` DEFAULT CHARACTER
SET utf8 COLLATE utf8_unicode_ci;

USE `conforg_db`;


SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `bill_component`
-- ----------------------------
DROP TABLE
IF EXISTS `bill_component`;

CREATE TABLE `bill_component` (
	`ComponentId` INT (11) NOT NULL AUTO_INCREMENT,
	`BillId` INT (11) NOT NULL,
	`ComponentTypeId` INT (11) NOT NULL,
	`ComponentDescription` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`Amount` DECIMAL (7, 2) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ComponentId`),
	KEY `FK_BillComp_01` (`BillId`),
	KEY `ComponentType` (`ComponentTypeId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `category`
-- ----------------------------
DROP TABLE
IF EXISTS `category`;

CREATE TABLE `category` (
	`CategoryID` INT (11) NOT NULL,
	`Name` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Remarks` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`CategoryID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `componenttype`
-- ----------------------------
DROP TABLE
IF EXISTS `componenttype`;

CREATE TABLE `componenttype` (
	`ComponentTypeId` INT (11) NOT NULL AUTO_INCREMENT,
	`ComponentType` VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL,
	`IsEnabled` bit (1) NOT NULL DEFAULT 1,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ComponentTypeId`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference`
-- ----------------------------
DROP TABLE
IF EXISTS `conference`;

CREATE TABLE `conference` (
	`ConfId` INT (11) NOT NULL AUTO_INCREMENT,
	`Title` VARCHAR (100) CHARACTER
SET latin1 NOT NULL,
 `ConfTypeId` INT (11) NOT NULL,
 `Description` VARCHAR (255) CHARACTER
SET latin1 NOT NULL,
 `BeginDate` date NOT NULL,
 `BeginTime` datetime NOT NULL,
 `EndDate` date NOT NULL,
 `EndTime` datetime NOT NULL,
 `IsFree` bit (1) NOT NULL DEFAULT 0,
 `Speaker` INT (11) DEFAULT NULL,
 `CreatedBy` INT (11) NOT NULL,
 `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`ConfId`),
 UNIQUE KEY `Title` (`Title`),
 KEY `ConferenceType` (`ConfTypeId`)

) ENGINE = INNODB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conferenceentertainment`
-- ----------------------------
DROP TABLE
IF EXISTS `conferenceentertainment`;

CREATE TABLE `conferenceentertainment` (
	`ConferenceEntertainmentID` INT (11) NOT NULL,
	`ConferenceID` INT (11) DEFAULT NULL,
	`EntertainmentID` INT (11) DEFAULT NULL,
	`ConferenceVenueRoomScheduleID` INT (11) DEFAULT NULL,
	`Remarks` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (
		`ConferenceEntertainmentID`
	),
	KEY `ConferenceID_idx` (`ConferenceID`),
	KEY `EntertainementID_idx` (`EntertainmentID`),
	KEY `ConferenceVenueRoomScheduleID_idx` (
		`ConferenceVenueRoomScheduleID`
	)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conferenceequipementrequest`
-- ----------------------------
DROP TABLE
IF EXISTS `conferenceequipementrequest`;

CREATE TABLE `conferenceequipementrequest` (
	`ConferenceEquipementRequestID` INT (11) NOT NULL,
	`ConferenceID` INT (11) DEFAULT NULL,
	`UserID` INT (11) DEFAULT NULL,
	`CategoryID` INT (11) DEFAULT NULL,
	`EquipementID` INT (11) DEFAULT NULL,
	`Quantity` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (
		`ConferenceEquipementRequestID`
	),
	KEY `ConferenceID_idx` (`ConferenceID`),
	KEY `UserID_idx` (`UserID`),
	KEY `CategoryID_idx` (`CategoryID`),
	KEY `EquipementID_idx` (`EquipementID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conferencefood`
-- ----------------------------
DROP TABLE
IF EXISTS `conferencefood`;

CREATE TABLE `conferencefood` (
	`ConferenceFoodID` INT (11) NOT NULL,
	`ConferenceID` INT (11) DEFAULT NULL,
	`FoodID` INT (11) DEFAULT NULL,
	`FoodPriceID` INT (11) DEFAULT NULL,
	`Quantity` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Delivery Date & Time` datetime DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`ConferenceFoodID`),
	KEY `ConferenceID_idx` (`ConferenceID`),
	KEY `FoodID_idx` (`FoodID`),
	KEY `FoodPriceID_idx` (`FoodPriceID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conferencetype`
-- ----------------------------
DROP TABLE
IF EXISTS `conferencetype`;

CREATE TABLE `conferencetype` (
	`ConfTypeId` INT (11) NOT NULL AUTO_INCREMENT,
	`ConferenceType` VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL,
	`IsEnabled` bit (1) NOT NULL DEFAULT 1,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ConfTypeId`)
) ENGINE = INNODB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conferencevenueroomcost`
-- ----------------------------
DROP TABLE
IF EXISTS `conferencevenueroomcost`;

CREATE TABLE `conferencevenueroomcost` (
	`ConferenceVenueRoomCostID` INT (11) NOT NULL,
	`ConferenceID` INT (11) DEFAULT NULL,
	`VenueID` INT (11) DEFAULT NULL,
	`RoomID` INT (11) DEFAULT NULL,
	`SeatTypeID` INT (11) DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (
		`ConferenceVenueRoomCostID`
	),
	KEY `ConferenceID_idx` (`ConferenceID`),
	KEY `VenueID_idx` (`VenueID`),
	KEY `RoomID_idx` (`RoomID`),
	KEY `SeatTypeID_idx` (`SeatTypeID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conferencevenueroomschedule`
-- ----------------------------
DROP TABLE
IF EXISTS `conferencevenueroomschedule`;

CREATE TABLE `conferencevenueroomschedule` (
	`ConferenceVenueRoomScheduleID` INT (11) NOT NULL,
	`ConferenceID` INT (11) DEFAULT NULL,
	`VenueID` INT (11) DEFAULT NULL,
	`RoomID` INT (11) DEFAULT NULL,
	`Description` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateStart` datetime DEFAULT NULL,
	`DateEnd` datetime DEFAULT NULL,
	`BeginTime` time DEFAULT NULL,
	`EndTime` time DEFAULT NULL,
	`Remarks` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	PRIMARY KEY (
		`ConferenceVenueRoomScheduleID`
	),
	KEY `ConferenceID_idx` (`ConferenceID`),
	KEY `VenueID_idx` (`VenueID`),
	KEY `RoomID_idx` (`RoomID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference_bill`
-- ----------------------------
DROP TABLE
IF EXISTS `conference_bill`;

CREATE TABLE `conference_bill` (
	`BillId` INT (11) NOT NULL AUTO_INCREMENT,
	`ConfId` INT (11) NOT NULL,
	`UserId` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`BillId`),
	UNIQUE KEY `idx_BillId` (`BillId`) USING BTREE,
	KEY `ConfId` (`ConfId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference_equipmentrequest`
-- ----------------------------
DROP TABLE
IF EXISTS `conference_equipmentrequest`;

CREATE TABLE `conference_equipmentrequest` (
	`ConfId` INT (11) NOT NULL,
	`Requestor` INT (11) NOT NULL,
	`EquipmentCatId` INT (11) NOT NULL,
	`EquipmentId` INT (11) NOT NULL,
	`Qty` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (
		`ConfId`,
		`Requestor`,
		`EquipmentCatId`,
		`EquipmentId`
	)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference_participant`
-- ----------------------------
DROP TABLE
IF EXISTS `conference_participant`;

CREATE TABLE `conference_participant` (
	`ConfUserId` INT (11) NOT NULL AUTO_INCREMENT,
	`ConfId` INT (11) NOT NULL,
	`UserId` INT (11) NOT NULL,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ConfUserId`),
	KEY `ConfId` (`ConfId`, `UserId`),
	KEY `FK_ConfParti_02` (`UserId`)

) ENGINE = INNODB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference_participantbarred`
-- ----------------------------
DROP TABLE
IF EXISTS `conference_participantbarred`;

CREATE TABLE `conference_participantbarred` (
	`ConfId` INT (11) NOT NULL,
	`UserId` INT (11) NOT NULL,
	`Reason` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ConfId`, `UserId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference_paymenttransaction`
-- ----------------------------
DROP TABLE
IF EXISTS `conference_paymenttransaction`;

CREATE TABLE `conference_paymenttransaction` (
	`TransactionId` INT (11) NOT NULL AUTO_INCREMENT,
	`BillId` INT (11) NOT NULL,
	`PaymentTypeId` INT (11) NOT NULL,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`TransactionId`),
	KEY `BillId` (`BillId`),
	KEY `PaymentTypeId` (`PaymentTypeId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference_reviewpanel`
-- ----------------------------
DROP TABLE
IF EXISTS `conference_reviewpanel`;

CREATE TABLE `conference_reviewpanel` (
	`CC_Id` INT (11) NOT NULL,
	`ConfId` INT (11) NOT NULL,
	`UserId` INT (11) NOT NULL,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`CC_Id`),
	KEY `FK_ConfReviewPanel_01` (`ConfId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `conference_venue`
-- ----------------------------
DROP TABLE
IF EXISTS `conference_venue`;

CREATE TABLE `conference_venue` (
	`ConfId` INT (11) NOT NULL,
	`VenueId` INT (11) NOT NULL,
	`MaxSeats` INT (6) NOT NULL,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ConfId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `confuserrole`
-- ----------------------------
DROP TABLE
IF EXISTS `confuserrole`;

CREATE TABLE `confuserrole` (
	`confuserrole_id` INT (10) NOT NULL AUTO_INCREMENT,
	`role_id` INT (10) NOT NULL,
	`user_id` INT (10) NOT NULL,
	`conf_id` INT (11) NOT NULL,
	PRIMARY KEY (`confuserrole_id`),
	KEY `confuserrole_role_id_index_01` (`role_id`),
	KEY `confuserrole_user_id_index_02` (`user_id`),
	KEY `confuserrole_ibfk_1` (`conf_id`)

) ENGINE = INNODB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `cuisine`
-- ----------------------------
DROP TABLE
IF EXISTS `cuisine`;

CREATE TABLE `cuisine` (
	`CusineID` INT (11) NOT NULL,
	`Description` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`CusineID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `entertainment`
-- ----------------------------
DROP TABLE
IF EXISTS `entertainment`;

CREATE TABLE `entertainment` (
	`EntertainmentID` INT (11) NOT NULL,
	`Organization` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`TypeID` INT (11) DEFAULT NULL,
	`Cost` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Duration` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`PointOfContact` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`POC description` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	PRIMARY KEY (`EntertainmentID`),
	KEY `TypeID_idx` (`TypeID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `equipment`
-- ----------------------------
DROP TABLE
IF EXISTS `equipment`;

CREATE TABLE `equipment` (
	`EquipmentID` INT (11) NOT NULL,
	`CategoryID` INT (11) DEFAULT NULL,
	`Name` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Remarks` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`RentalCost` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Category_CategoryID` INT (11) NOT NULL,
	PRIMARY KEY (
		`EquipmentID`,
		`Category_CategoryID`
	),
	KEY `fk_Equipment_Category1_idx` (`Category_CategoryID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `food`
-- ----------------------------
DROP TABLE
IF EXISTS `food`;

CREATE TABLE `food` (
	`FoodID` INT (11) NOT NULL,
	`Oragnaization` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`CuisnieID` INT (11) DEFAULT NULL,
	`Remarks` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`PointOfContact` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`POC description` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`FoodID`),
	KEY `CusineID_idx` (`CuisnieID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `foodprice`
-- ----------------------------
DROP TABLE
IF EXISTS `foodprice`;

CREATE TABLE `foodprice` (
	`FoodPriceID` INT (11) NOT NULL,
	`FoodID` INT (11) DEFAULT NULL,
	`Description` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Price` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`MealType` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`FoodPriceID`),
	KEY `FoodID_idx` (`FoodID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `menuitems`
-- ----------------------------
DROP TABLE
IF EXISTS `menuitems`;

CREATE TABLE `menuitems` (
	`MenuItemsID` INT (11) NOT NULL,
	`FoodPriceID` INT (11) DEFAULT NULL,
	`Description` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`MenuItemsID`),
	KEY `FoodPriceID_idx` (`FoodPriceID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `paymenttype`
-- ----------------------------
DROP TABLE
IF EXISTS `paymenttype`;

CREATE TABLE `paymenttype` (
	`PaymentId` INT (11) NOT NULL AUTO_INCREMENT,
	`PaymentType` VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL,
	`IsEnabled` bit (1) NOT NULL DEFAULT 1,
	`CreatedBy` INT (11) NOT NULL,
	`DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`PaymentId`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `payment_cash`
-- ----------------------------
DROP TABLE
IF EXISTS `payment_cash`;

CREATE TABLE `payment_cash` (
	`TransactionId` INT (11) NOT NULL,
	`UserId` INT (11) NOT NULL,
	`BillId` INT (11) NOT NULL,
	`AmountPaid` DOUBLE (7, 2) NOT NULL,
	`DatePaid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (
		`TransactionId`,
		`UserId`,
		`BillId`
	),
	KEY `BillId` (`BillId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `payment_creditcard`
-- ----------------------------
DROP TABLE
IF EXISTS `payment_creditcard`;

CREATE TABLE `payment_creditcard` (
	`TransactionId` INT (11) NOT NULL,
	`UserId` INT (11) NOT NULL,
	`BillId` INT (11) NOT NULL,
	`CardNumber` VARCHAR (5) COLLATE utf8_unicode_ci NOT NULL,
	`AmountPaid` DOUBLE (7, 2) NOT NULL,
	`DatePaid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (
		`TransactionId`,
		`UserId`,
		`BillId`
	),
	KEY `BillId` (`BillId`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `reviews`
-- ----------------------------
DROP TABLE
IF EXISTS `reviews`;

CREATE TABLE `reviews` (
	`Review_id` INT (11) NOT NULL AUTO_INCREMENT,
	`Sub_id` INT (11) NOT NULL,
	`User_id` INT (11) NOT NULL,
	`InternalComment` text COLLATE utf8_unicode_ci NOT NULL,
	`Comment` text COLLATE utf8_unicode_ci NOT NULL,
	`QualityScore` INT (11) NOT NULL,
	`RelevanceScore` INT (11) NOT NULL,
	`OriginalityScore` INT (11) NOT NULL,
	`SignificanceScore` INT (11) NOT NULL,
	`PresentationScore` INT (11) NOT NULL,
	`Recommendation` INT (11) NOT NULL,
	`ReviewerFamiliarity` INT (11) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`Review_id`),
	KEY `User_id` (`User_id`),
	KEY `Sub_id` (`Sub_id`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `roles`
-- ----------------------------
DROP TABLE
IF EXISTS `roles`;

CREATE TABLE `roles` (
	`role_id` INT (11) NOT NULL AUTO_INCREMENT,
	`rolename` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`remarks` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (`role_id`),
	UNIQUE KEY `roles_rolename_unique` (`rolename`)
) ENGINE = INNODB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `room`
-- ----------------------------
DROP TABLE
IF EXISTS `room`;

CREATE TABLE `room` (
	`RoomID` INT (11) NOT NULL,
	`Name` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Capacity` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Type` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`RentalCost` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Venue_VenueID` INT (11) NOT NULL,
	PRIMARY KEY (`RoomID`, `Venue_VenueID`),
	KEY `fk_Room_Venue_idx` (`Venue_VenueID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `roomequipment`
-- ----------------------------
DROP TABLE
IF EXISTS `roomequipment`;

CREATE TABLE `roomequipment` (
	`RoomEquipmentID` INT (11) NOT NULL,
	`RoomID` INT (11) DEFAULT NULL,
	`EquipmentID` INT (11) DEFAULT NULL,
	`Quantity` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Remarks` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`RoomEquipmentID`),
	KEY `RoomID_idx` (`RoomID`),
	KEY `EquipmentID_idx` (`EquipmentID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `seattype`
-- ----------------------------
DROP TABLE
IF EXISTS `seattype`;

CREATE TABLE `seattype` (
	`SeatTypeID` INT (11) NOT NULL,
	`Name` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Price` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`SeatTypeID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `submissions`
-- ----------------------------
DROP TABLE
IF EXISTS `submissions`;

CREATE TABLE `submissions` (
	`Sub_id` INT (11) NOT NULL AUTO_INCREMENT,
	`User_id` INT (11) NOT NULL,
	`Conf_id` INT (11) NOT NULL,
	`SubType` INT (11) NOT NULL,
	`SubTitle` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`SubAbstract` text COLLATE utf8_unicode_ci NOT NULL,
	`AttachmentPath` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`SubRemarks` text COLLATE utf8_unicode_ci NOT NULL,
	`IsAccepted` TINYINT (1) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`Sub_id`),
	UNIQUE KEY `submissions_subtitle_unique` (`SubTitle`),
	KEY `User_id` (`User_id`),
	KEY `Conf_id` (`Conf_id`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `submission_author`
-- ----------------------------
DROP TABLE
IF EXISTS `submission_author`;

CREATE TABLE `submission_author` (
	`Sub_id` INT (11) NOT NULL,
	`Email` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`FirstName` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`LastName` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`Organization` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`Country` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`ShortBio` VARCHAR (220) COLLATE utf8_unicode_ci NOT NULL,
	`isPresenting` TINYINT (1) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`Sub_id`, `Email`),
	UNIQUE KEY `submission_author_email_unique` (`Email`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `submission_keyword`
-- ----------------------------
DROP TABLE
IF EXISTS `submission_keyword`;

CREATE TABLE `submission_keyword` (
	`Keyword_id` INT (11) NOT NULL,
	`Sub_id` INT (11) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`Keyword_id`, `Sub_id`),
	KEY `Sub_id` (`Sub_id`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `submission_topic`
-- ----------------------------
DROP TABLE
IF EXISTS `submission_topic`;

CREATE TABLE `submission_topic` (
	`Topic_id` INT (11) NOT NULL,
	`Sub_id` INT (11) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`Topic_id`, `Sub_id`),
	KEY `Sub_id` (`Sub_id`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `topics`
-- ----------------------------
DROP TABLE
IF EXISTS `topics`;

CREATE TABLE `topics` (
	`Topic_id` INT (10) NOT NULL AUTO_INCREMENT,
	`Conf_id` INT (11) NOT NULL,
	`TopicName` VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`Topic_id`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `type`
-- ----------------------------
DROP TABLE
IF EXISTS `type`;

CREATE TABLE `type` (
	`TypeID` INT (11) NOT NULL,
	`Description` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`TypeID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE
IF EXISTS `users`;

CREATE TABLE `users` (
	`user_id` INT (11) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`firstname` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`lastname` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`email` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`password` VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL,
	`remember_token` VARCHAR (100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`user_id`),
	UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = INNODB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `venue`
-- ----------------------------
DROP TABLE
IF EXISTS `venue`;

CREATE TABLE `venue` (
	`VenueID` INT (11) NOT NULL,
	`Name` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Address` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Latitude` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Longitude` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`Postal` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`VenueID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

-- ----------------------------
--  Table structure for `venueroom`
-- ----------------------------
DROP TABLE
IF EXISTS `venueroom`;

CREATE TABLE `venueroom` (
	`VenueRoomID` INT (11) NOT NULL,
	`VenueID` INT (11) DEFAULT NULL,
	`RoomID` INT (11) DEFAULT NULL,
	`Remarks` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	`DateCreated` datetime DEFAULT NULL,
	`CreatedBy` VARCHAR (45) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`VenueRoomID`),
	KEY `VenueID_idx` (`VenueID`),
	KEY `RoomID_idx` (`RoomID`)

) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

