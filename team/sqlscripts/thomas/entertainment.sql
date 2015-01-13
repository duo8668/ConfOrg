DROP TABLE IF EXISTS `entertainment`;
CREATE TABLE `entertainment` (
  `entertainment_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `entertainment_cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entertainment_duration` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_of_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poc_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment
-- ----------------------------