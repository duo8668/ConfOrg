-- ----------------------------
-- Table structure for room_cost
-- ----------------------------
DROP TABLE IF EXISTS `room_cost`;
CREATE TABLE `room_cost` (
  `roomcost_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `seattype_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`roomcost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room_cost
-- ----------------------------