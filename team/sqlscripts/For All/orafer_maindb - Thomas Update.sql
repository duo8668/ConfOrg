DROP TABLE IF EXISTS `venue` ;

CREATE TABLE IF NOT EXISTS `venue` (
  `venue_id` INT(11) NOT NULL AUTO_INCREMENT,
  `venue_name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `venue_address` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `latitude` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `longitude` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `company_id` INT(11) NULL DEFAULT NULL,
  `available` VARCHAR(45) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`venue_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;



DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE IF NOT EXISTS `equipment_category` (
  `equipmentcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipmentcategory_remark` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `room` ;

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` INT(11) NOT NULL AUTO_INCREMENT,
  `venue_id` INT(11) NOT NULL,
  `room_name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `capacity` INT(45) NULL DEFAULT NULL,
  `rental_cost` DECIMAL(12,2) NULL DEFAULT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `available` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`room_id`, `venue_id`),
  INDEX `room_venue_id_foreign_idx` (`venue_id` ASC),
  CONSTRAINT `room_venue_id_foreign`
    FOREIGN KEY (`venue_id`)
    REFERENCES `venue` (`venue_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

DROP TABLE IF EXISTS `equipment_category` ;

CREATE TABLE IF NOT EXISTS `equipment_category` (
  `equipmentcategory_id` INT(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `equipmentcategory_remark` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`equipmentcategory_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


DROP TABLE IF EXISTS `equipment` ;

CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_id` INT(11) NOT NULL DEFAULT '0',
  `equipment_name` VARCHAR(45) NULL DEFAULT NULL,
  `equipment_remark` VARCHAR(45) NULL DEFAULT NULL,
  `equipment_status` varchar(45) DEFAULT 'Pending',
  `rental_cost` VARCHAR(45) NULL DEFAULT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`equipment_id`, `equipmentcategory_id`),
  INDEX `equipment_equipmentcategory_id_foreign_idx` (`equipmentcategory_id` ASC),
  CONSTRAINT `equipment_equipmentcategory_id_foreign`
    FOREIGN KEY (`equipmentcategory_id`)
    REFERENCES `equipment_category` (`equipmentcategory_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;

DROP TABLE IF EXISTS `pending` ;

CREATE TABLE IF NOT EXISTS `pending` (
  `pending_id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `equipment_id` INT(11) NULL DEFAULT NULL,
  `equipmentcategory_id` INT(11) NULL DEFAULT NULL,
  `room_id` INT(11) NULL DEFAULT NULL,
  `venue_id` INT(11) NULL DEFAULT NULL, 
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`pending_id`),
  INDEX `pending_user_id_foreign_idx` (`user_id` ASC),
  INDEX `pending_equipment_id_foreign_idx` (`equipment_id` ASC),
  INDEX `pending_equipmentcategory_id_foreign_idx` (`equipmentcategory_id` ASC),
  INDEX `pending_room_id_foreign_idx` (`room_id` ASC),
  INDEX `pending_venue_id_foreign_idx` (`venue_id` ASC),
  CONSTRAINT `pending_user_id_foreign`
    FOREIGN KEY (`user_id`)
    REFERENCES `users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `pending_equipment_id_foreign`
    FOREIGN KEY (`equipment_id`)
    REFERENCES `equipment` (`equipment_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `pending_equipmentcategory_id_foreign`
    FOREIGN KEY (`equipmentcategory_id`)
    REFERENCES `equipment_category` (`equipmentcategory_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `pending_room_id_foreign`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`room_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `pending_venue_id_foreign`
    FOREIGN KEY (`venue_id`)
    REFERENCES `venue` (`venue_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

DROP TABLE IF EXISTS `room_equipment` ;

CREATE TABLE IF NOT EXISTS `room_equipment` (
  `roomequipment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `room_id` INT(11) NULL DEFAULT NULL,
  `equipment_id` INT(11) NULL DEFAULT NULL,
  `quantity` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `remarks` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `created_by` INT(11) NOT NULL,
  `modified_by` INT(11) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `equipment_status` varchar(45) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`roomequipment_id`),
  INDEX `room_equipment_equipment_id_foreign_idx` (`equipment_id` ASC),
  INDEX `room_equipment_roomt_id_foreign_idx` (`room_id` ASC),
  CONSTRAINT `room_equipment_equipment_id_foreign`
    FOREIGN KEY (`equipment_id`)
    REFERENCES `equipment` (`equipment_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `room_equipment_room_id_foreign`
    FOREIGN KEY (`room_id`)
    REFERENCES `room` (`room_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;