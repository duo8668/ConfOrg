DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  `category_remark` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  
  `modified_by` int(11) NULL,
  
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  `updated_at` datetime NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
