-- ----------------------------
-- Table structure for food_price
-- ----------------------------
DROP TABLE IF EXISTS `food_price`;
CREATE TABLE `food_price` (
  `foodprice_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_id` int(11) DEFAULT NULL,
  `food_price_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `food_price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meal_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`foodprice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food_price
-- ----------------------------