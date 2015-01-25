/*
Navicat MySQL Data Transfer

Source Server         : csci321
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-25 12:32:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `rolepermission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`rolepermission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
