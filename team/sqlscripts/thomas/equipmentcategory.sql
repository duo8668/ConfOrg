DROP TABLE IF EXISTS `category`;
DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE `equipment_category` (
  `equipmentcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_name` varchar(45) DEFAULT NULL,
  `equipmentcategory_remark` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  
  `modified_by` int(11) NULL,
  
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
  `updated_at` datetime NULL,
  PRIMARY KEY (`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET FOREIGN_KEY_CHECKS=0;
