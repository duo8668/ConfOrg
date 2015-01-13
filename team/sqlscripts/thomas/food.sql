
-- ----------------------------
-- Table structure for food
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `oragnaization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuisnie_id` int(11) DEFAULT NULL,
  `food_remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_of_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poc_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food
-- ----------------------------
