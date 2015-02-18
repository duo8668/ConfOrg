/*
Navicat MySQL Data Transfer

Source Server         : csci321
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-02-18 10:05:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `roles_rolename_unique` (`rolename`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'User', 'normal user');
INSERT INTO `roles` VALUES ('2', 'Resource Provider', 'resource provider');
INSERT INTO `roles` VALUES ('3', 'Admin', 'super admin account');
INSERT INTO `roles` VALUES ('4', 'Conference Chair', 'organizer');
INSERT INTO `roles` VALUES ('5', 'Conference Staff', 'staff');
INSERT INTO `roles` VALUES ('6', 'Author', 'author');
INSERT INTO `roles` VALUES ('7', 'Reviewer', 'reviewer');
INSERT INTO `roles` VALUES ('8', 'Participant', 'participant');
