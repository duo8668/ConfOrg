CREATE TABLE
IF NOT EXISTS `Category` (
	`CategoryID` INT NOT NULL,
	`Name` VARCHAR (45) NULL,
	`Remarks` VARCHAR (45) NULL,
	`DateCreated` VARCHAR (45) NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (`CategoryID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `Type` (
	`TypeID` INT NOT NULL,
	`Description` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (`TypeID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `Entertainment` (
	`EntertainmentID` INT NOT NULL,
	`Organization` VARCHAR (45) NULL,
	`TypeID` INT NULL,
	`Cost` VARCHAR (45) NULL,
	`Duration` VARCHAR (45) NULL,
	`PointOfContact` VARCHAR (45) NULL,
	`POC description` VARCHAR (45) NULL,
	`CreatedBy` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	PRIMARY KEY (`EntertainmentID`),
	INDEX `TypeID_idx` (`TypeID` ASC),
	CONSTRAINT `fk_Entertainment_TypeID` FOREIGN KEY (`TypeID`) REFERENCES `Type` (`TypeID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `Venue` (
	`VenueID` INT NOT NULL,
	`Name` VARCHAR (45) NULL,
	`Address` VARCHAR (45) NULL,
	`Latitude` VARCHAR (45) NULL,
	`Longitude` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	`Postal` VARCHAR (45) NULL,
	PRIMARY KEY (`VenueID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `Room` (
	`RoomID` INT NOT NULL,
	`Name` VARCHAR (45) NULL,
	`Capacity` VARCHAR (45) NULL,
	`Type` VARCHAR (45) NULL,
	`RentalCost` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	`Venue_VenueID` INT NOT NULL,
	PRIMARY KEY (`RoomID`, `Venue_VenueID`),
	INDEX `fk_Room_Venue_idx` (`Venue_VenueID` ASC),
	CONSTRAINT `fk_Room_Venue` FOREIGN KEY (`Venue_VenueID`) REFERENCES `Venue` (`VenueID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `Cuisine` (
	`CusineID` INT NOT NULL,
	`Description` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (`CusineID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `Food` (
	`FoodID` INT NOT NULL,
	`Oragnaization` VARCHAR (45) NULL,
	`CuisnieID` INT NULL,
	`Remarks` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	`PointOfContact` VARCHAR (45) NULL,
	`POC description` VARCHAR (45) NULL,
	PRIMARY KEY (`FoodID`),
	INDEX `CusineID_idx` (`CuisnieID` ASC),
	CONSTRAINT `fk_Food_CusineID` FOREIGN KEY (`CuisnieID`) REFERENCES `Cuisine` (`CusineID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `FoodPrice` (
	`FoodPriceID` INT NOT NULL,
	`FoodID` INT NULL,
	`Description` VARCHAR (45) NULL,
	`Price` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	`MealType` VARCHAR (45) NULL,
	PRIMARY KEY (`FoodPriceID`),
	INDEX `FoodID_idx` (`FoodID` ASC),
	CONSTRAINT `fk_FoodPrice_FoodID` FOREIGN KEY (`FoodID`) REFERENCES `Food` (`FoodID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `ConferenceVenueRoomSchedule` (
	`ConferenceVenueRoomScheduleID` INT NOT NULL,
	`ConferenceID` INT NULL,
	`VenueID` INT NULL,
	`RoomID` INT NULL,
	`Description` VARCHAR (45) NULL,
	`DateStart` DATETIME NULL,
	`DateEnd` DATETIME NULL,
	`BeginTime` TIME NULL,
	`EndTime` TIME NULL,
	`Remarks` VARCHAR (45) NULL,
	`CreatedBy` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	PRIMARY KEY (
		`ConferenceVenueRoomScheduleID`
	),
	INDEX `ConferenceID_idx` (`ConferenceID` ASC),
	INDEX `VenueID_idx` (`VenueID` ASC),
	INDEX `RoomID_idx` (`RoomID` ASC),
	CONSTRAINT `fk_ConferenceVenueRoomSchedule_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `Conference` (`ConfID`),
	CONSTRAINT `fk_ConferenceVenueRoomSchedule_VenueID` FOREIGN KEY (`VenueID`) REFERENCES `Venue` (`VenueID`),
	CONSTRAINT `fk_ConferenceVenueRoomSchedule_RoomID` FOREIGN KEY (`RoomID`) REFERENCES `Room` (`RoomID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `Equipment` (
	`EquipmentID` INT NOT NULL,
	`CategoryID` INT NULL,
	`Name` VARCHAR (45) NULL,
	`Remarks` VARCHAR (45) NULL,
	`RentalCost` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	`Category_CategoryID` INT NOT NULL,
	PRIMARY KEY (
		`EquipmentID`,
		`Category_CategoryID`
	),
	INDEX `fk_Equipment_Category1_idx` (`Category_CategoryID` ASC),
	CONSTRAINT `fk_Equipment_Category1` FOREIGN KEY (`Category_CategoryID`) REFERENCES `Category` (`CategoryID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `ConferenceEntertainment` (
	`ConferenceEntertainmentID` INT NOT NULL,
	`ConferenceID` INT NULL,
	`EntertainmentID` INT NULL,
	`ConferenceVenueRoomScheduleID` INT NULL,
	`Remarks` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (
		`ConferenceEntertainmentID`
	),
	INDEX `ConferenceID_idx` (`ConferenceID` ASC),
	INDEX `EntertainementID_idx` (`EntertainmentID` ASC),
	INDEX `ConferenceVenueRoomScheduleID_idx` (
		`ConferenceVenueRoomScheduleID` ASC
	),
	CONSTRAINT `fk_ConferenceEntertainment_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `Conference` (`ConfID`),
	CONSTRAINT `fk_ConferenceEntertainment_EntertainementID` FOREIGN KEY (`EntertainmentID`) REFERENCES `Entertainment` (`EntertainmentID`),
	CONSTRAINT `fk_ConferenceEntertainment_ConferenceVenueRoomScheduleID` FOREIGN KEY (
		`ConferenceVenueRoomScheduleID`
	) REFERENCES `ConferenceVenueRoomSchedule` (
		`ConferenceVenueRoomScheduleID`
	)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `ConferenceEquipementRequest` (
	`ConferenceEquipementRequestID` INT NOT NULL,
	`ConferenceID` INT NULL,
	`UserID` INT(11) NULL,
	`CategoryID` INT NULL,
	`EquipementID` INT NULL,
	`Quantity` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (
		`ConferenceEquipementRequestID`
	),
	INDEX `ConferenceID_idx` (`ConferenceID` ASC),
	INDEX `UserID_idx` (`UserID` ASC),
	INDEX `CategoryID_idx` (`CategoryID` ASC),
	INDEX `EquipementID_idx` (`EquipementID` ASC),
	CONSTRAINT `fk_ConferenceEquipementRequest_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `Conference` (`ConfID`),
	CONSTRAINT `fk_ConferenceEquipementRequest_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`user_id`),
	CONSTRAINT `fk_ConferenceEquipementRequest_CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `Category` (`CategoryID`),
	CONSTRAINT `fk_ConferenceEquipementRequest_EquipementID` FOREIGN KEY (`EquipementID`) REFERENCES `Equipment` (`EquipmentID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `ConferenceFood` (
	`ConferenceFoodID` INT NOT NULL,
	`ConferenceID` INT NULL,
	`FoodID` INT NULL,
	`FoodPriceID` INT NULL,
	`Quantity` VARCHAR (45) NULL,
	`Delivery Date & Time` DATETIME NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (`ConferenceFoodID`),
	INDEX `ConferenceID_idx` (`ConferenceID` ASC),
	INDEX `FoodID_idx` (`FoodID` ASC),
	INDEX `FoodPriceID_idx` (`FoodPriceID` ASC),
	CONSTRAINT `fk_ConferenceFood_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `Conference` (`ConfID`),
	CONSTRAINT `fk_ConferenceFood_FoodID` FOREIGN KEY (`FoodID`) REFERENCES `Food` (`FoodID`),
	CONSTRAINT `fk_ConferenceFood_FoodPriceID` FOREIGN KEY (`FoodPriceID`) REFERENCES `FoodPrice` (`FoodID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `SeatType` (
	`SeatTypeID` INT NOT NULL,
	`Name` VARCHAR (45) NULL,
	`Price` VARCHAR (45) NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (`SeatTypeID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;

CREATE TABLE
IF NOT EXISTS `ConferenceVenueRoomCost` (
	`ConferenceVenueRoomCostID` INT NOT NULL,
	`ConferenceID` INT NULL,
	`VenueID` INT NULL,
	`RoomID` INT NULL,
	`SeatTypeID` INT NULL,
	`DateCreated` DATETIME NULL,
	`CreatedBy` VARCHAR (45) NULL,
	PRIMARY KEY (
		`ConferenceVenueRoomCostID`
	),
	INDEX `ConferenceID_idx` (`ConferenceID` ASC),
	INDEX `VenueID_idx` (`VenueID` ASC),
	INDEX `RoomID_idx` (`RoomID` ASC),
	INDEX `SeatTypeID_idx` (`SeatTypeID` ASC),
	CONSTRAINT `fk_ConferenceVenueRoomCost_ConferenceID` FOREIGN KEY (`ConferenceID`) REFERENCES `Conference` (`ConfID`),
	CONSTRAINT `fk_ConferenceVenueRoomCost_VenueID` FOREIGN KEY (`VenueID`) REFERENCES `Venue` (`VenueID`),
	CONSTRAINT `fk_ConferenceVenueRoomCost_RoomID` FOREIGN KEY (`RoomID`) REFERENCES `Room` (`RoomID`),
	CONSTRAINT `fk_ConferenceVenueRoomCost_SeatTypeID` FOREIGN KEY (`SeatTypeID`) REFERENCES `SeatType` (`SeatTypeID`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci;


