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