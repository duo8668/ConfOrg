
-- ----------------------------
-- Table structure for entertainment_type
-- ----------------------------
DROP TABLE IF EXISTS `entertainment_type`;
CREATE TABLE `entertainment_type` (
  `entertainmentype_id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainment_type_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`entertainmenteype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment_type
-- ----------------------------
