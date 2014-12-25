/*
MySQL Backup
Source Server Version: 5.6.17
Source Database: conforg
Date: 12/25/2014 16:21:24
*/
USE `conforg_db`;


SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `bill_component`
-- ----------------------------
ALTER TABLE `bill_component` ADD CONSTRAINT `bill_component_ibfk_1` FOREIGN KEY (`ComponentTypeId`) REFERENCES `componenttype` (`ComponentTypeId`),
 ADD CONSTRAINT `FK_BillComp_01` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`);

-- ----------------------------
--  Table structure for `conference`
-- ----------------------------
ALTER TABLE `conference` ADD CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`ConfTypeId`) REFERENCES `conferencetype` (`ConfTypeId`);

-- ----------------------------
--  Table structure for `conferenceentertainment`
-- ----------------------------
ALTER TABLE `conferenceentertainment` ADD CONSTRAINT `fk_ConferenceEntertainment_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `fk_ConferenceEntertainment_ConferenceVenueRoomScheduleID` FOREIGN KEY (
	`ConferenceVenueRoomScheduleID`
) REFERENCES `conferencevenueroomschedule` (
	`ConferenceVenueRoomScheduleID`
),
 ADD CONSTRAINT `fk_ConferenceEntertainment_EntertainementID` FOREIGN KEY (`EntertainmentID`) REFERENCES `entertainment` (`EntertainmentID`);

-- ----------------------------
--  Table structure for `conferenceequipementrequest`
-- ----------------------------
ALTER TABLE `conferenceequipementrequest` ADD CONSTRAINT `fk_ConferenceEquipementRequest_CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
 ADD CONSTRAINT `fk_ConferenceEquipementRequest_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `fk_ConferenceEquipementRequest_EquipementID` FOREIGN KEY (`EquipementID`) REFERENCES `equipment` (`EquipmentID`),
 ADD CONSTRAINT `fk_ConferenceEquipementRequest_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`user_id`);

-- ----------------------------
--  Table structure for `conferencefood`
-- ----------------------------
ALTER TABLE `conferencefood` ADD CONSTRAINT `fk_ConferenceFood_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `fk_ConferenceFood_FoodID` FOREIGN KEY (`FoodID`) REFERENCES `food` (`FoodID`),
 ADD CONSTRAINT `fk_ConferenceFood_FoodPriceID` FOREIGN KEY (`FoodPriceID`) REFERENCES `foodprice` (`FoodID`);

-- ----------------------------
--  Table structure for `conferencevenueroomcost`
-- ----------------------------
ALTER TABLE `conferencevenueroomcost` ADD CONSTRAINT `fk_ConferenceVenueRoomCost_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `fk_ConferenceVenueRoomCost_RoomID` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`),
 ADD CONSTRAINT `fk_ConferenceVenueRoomCost_SeatTypeID` FOREIGN KEY (`SeatTypeID`) REFERENCES `seattype` (`SeatTypeID`),
 ADD CONSTRAINT `fk_ConferenceVenueRoomCost_VenueID` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`);

-- ----------------------------
--  Table structure for `conferencevenueroomschedule`
-- ----------------------------
ALTER TABLE `conferencevenueroomschedule` ADD CONSTRAINT `ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `RoomID` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`),
 ADD CONSTRAINT `VenueID` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`);

-- ----------------------------
--  Table structure for `conference_bill`
-- ----------------------------
ALTER TABLE `conference_bill` ADD CONSTRAINT `conference_bill_ibfk_1` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `conference_bill_ibfk_2` FOREIGN KEY (`ConfId`) REFERENCES `conference_participant` (`ConfId`);

-- ----------------------------
--  Table structure for `conference_equipmentrequest`
-- ----------------------------
ALTER TABLE `conference_equipmentrequest` ADD CONSTRAINT `FK_ConfEquipRequest_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

-- ----------------------------
--  Table structure for `conference_participant`
-- ----------------------------
ALTER TABLE `conference_participant` ADD CONSTRAINT `FK_ConfParti_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `FK_ConfParti_02` FOREIGN KEY (`UserId`) REFERENCES `users` (`user_id`);

-- ----------------------------
--  Table structure for `conference_participantbarred`
-- ----------------------------
ALTER TABLE `conference_participantbarred` ADD CONSTRAINT `FK_ConfPartiBarred_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

-- ----------------------------
--  Table structure for `conference_paymenttransaction`
-- ----------------------------
ALTER TABLE `conference_paymenttransaction` ADD CONSTRAINT `conference_paymenttransaction_ibfk_1` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`),
 ADD CONSTRAINT `conference_paymenttransaction_ibfk_2` FOREIGN KEY (`PaymentTypeId`) REFERENCES `paymenttype` (`PaymentId`);

-- ----------------------------
--  Table structure for `conference_reviewpanel`
-- ----------------------------
ALTER TABLE `conference_reviewpanel` ADD CONSTRAINT `FK_ConfReviewPanel_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

-- ----------------------------
--  Table structure for `conference_venue`
-- ----------------------------
ALTER TABLE `conference_venue` ADD CONSTRAINT `FK_ConfVenue_01` FOREIGN KEY (`ConfId`) REFERENCES `conference` (`ConfId`);

-- ----------------------------
--  Table structure for `confuserrole`
-- ----------------------------
ALTER TABLE `confuserrole` ADD CONSTRAINT `confuserrole_ibfk_1` FOREIGN KEY (`conf_id`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `confuserrole_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
 ADD CONSTRAINT `confuserrole_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

-- ----------------------------
--  Table structure for `entertainment`
-- ----------------------------
ALTER TABLE `entertainment` ADD CONSTRAINT `TypeID` FOREIGN KEY (`TypeID`) REFERENCES `type` (`TypeID`);

-- ----------------------------
--  Table structure for `equipment`
-- ----------------------------
ALTER TABLE `equipment` ADD CONSTRAINT `fk_Equipment_Category1` FOREIGN KEY (`Category_CategoryID`) REFERENCES `category` (`CategoryID`);

-- ----------------------------
--  Table structure for `food`
-- ----------------------------
ALTER TABLE `food` ADD CONSTRAINT `fk_Food_CusineID` FOREIGN KEY (`CuisnieID`) REFERENCES `cuisine` (`CusineID`);

-- ----------------------------
--  Table structure for `foodprice`
-- ----------------------------
ALTER TABLE `foodprice` ADD CONSTRAINT `fk_FoodPrice_FoodID` FOREIGN KEY (`FoodID`) REFERENCES `food` (`FoodID`);

-- ----------------------------
--  Table structure for `menuitems`
-- ----------------------------
ALTER TABLE `menuitems` ADD CONSTRAINT `fk_MenuItems_FoodPriceID` FOREIGN KEY (`FoodPriceID`) REFERENCES `foodprice` (`FoodPriceID`);

-- ----------------------------
--  Table structure for `payment_cash`
-- ----------------------------
ALTER TABLE `payment_cash` ADD CONSTRAINT `payment_cash_ibfk_1` FOREIGN KEY (`TransactionId`) REFERENCES `conference_paymenttransaction` (`TransactionId`),
 ADD CONSTRAINT `payment_cash_ibfk_2` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`);

-- ----------------------------
--  Table structure for `payment_creditcard`
-- ----------------------------
ALTER TABLE `payment_creditcard` ADD CONSTRAINT `payment_creditcard_ibfk_1` FOREIGN KEY (`TransactionId`) REFERENCES `conference_paymenttransaction` (`TransactionId`),
 ADD CONSTRAINT `payment_creditcard_ibfk_2` FOREIGN KEY (`BillId`) REFERENCES `conference_bill` (`BillId`);

-- ----------------------------
--  Table structure for `reviews`
-- ----------------------------
ALTER TABLE `reviews` ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`Sub_id`) REFERENCES `submissions` (`Sub_id`),
 ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`user_id`);

-- ----------------------------
--  Table structure for `room`
-- ----------------------------
ALTER TABLE `room` ADD CONSTRAINT `fk_Room_Venue` FOREIGN KEY (`Venue_VenueID`) REFERENCES `venue` (`VenueID`);

-- ----------------------------
--  Table structure for `roomequipment`
-- ----------------------------
ALTER TABLE `roomequipment` ADD CONSTRAINT `fk_RoomEquipment_EquipmentID` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`),
 ADD CONSTRAINT `fk_RoomEquipment_RoomID` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`);

-- ----------------------------
--  Table structure for `submissions`
-- ----------------------------
ALTER TABLE `submissions` ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`Conf_id`) REFERENCES `conference` (`ConfId`),
 ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`user_id`);

-- ----------------------------
--  Table structure for `submission_keyword`
-- ----------------------------
ALTER TABLE `submission_keyword` ADD CONSTRAINT `submission_keyword_ibfk_1` FOREIGN KEY (`Sub_id`) REFERENCES `submissions` (`Sub_id`);

-- ----------------------------
--  Table structure for `submission_topic`
-- ----------------------------
ALTER TABLE `submission_topic` ADD CONSTRAINT `submission_topic_ibfk_1` FOREIGN KEY (`Sub_id`) REFERENCES `submissions` (`Sub_id`);

-- ----------------------------
--  Table structure for `venueroom`
-- ----------------------------
ALTER TABLE `venueroom` ADD CONSTRAINT `fk_VenueRoom_RoomID` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`),
 ADD CONSTRAINT `fk_VenueRoom_VenueID` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`);

