-- ----------------------------
-- Table structure for cuisine
-- ----------------------------
DROP TABLE IF EXISTS `cuisine`;
CREATE TABLE `cuisine` (
  `cusine_id` int(11) NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NULL,
  PRIMARY KEY (`cusine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cuisine
-- ----------------------------