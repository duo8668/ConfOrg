-- ----------------------------
-- Table structure for seat_type
-- ----------------------------
DROP TABLE IF EXISTS `seat_type`;
CREATE TABLE `seat_type` (
  `seattype_id` int(11) NOT NULL AUTO_INCREMENT,
  `seattype_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seattype_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`seattype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of seat_type
-- ----------------------------
