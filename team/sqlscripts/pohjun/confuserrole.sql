/*
Navicat MySQL Data Transfer

Source Server         : csci321
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-06 14:09:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for confuserrole
-- ----------------------------
DROP TABLE IF EXISTS `confuserrole`;
CREATE TABLE `confuserrole` (
  `confuserrole_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `conf_id` int(11) NOT NULL,
  PRIMARY KEY (`confuserrole_id`),
  KEY `confuserrole_role_id_index_01` (`role_id`),
  KEY `confuserrole_user_id_index_02` (`user_id`),
  KEY `confuserrole_ibfk_1` (`conf_id`),
  CONSTRAINT `confuserrole_ibfk_1` FOREIGN KEY (`conf_id`) REFERENCES `conference` (`ConfId`),
  CONSTRAINT `confuserrole_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  CONSTRAINT `confuserrole_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confuserrole
-- ----------------------------
INSERT INTO `confuserrole` VALUES ('1', '4', '1', '1');
INSERT INTO `confuserrole` VALUES ('2', '3', '2', '2');
