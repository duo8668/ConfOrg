/*
Navicat MySQL Data Transfer

Source Server         : WorkPC
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-15 11:41:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for interest_field
-- ----------------------------
DROP TABLE IF EXISTS `interest_field`;
CREATE TABLE `interest_field` (
  `interestfield_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`interestfield_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of interest_field
-- ----------------------------
INSERT INTO `interest_field` VALUES ('1', 'Solar', null, '0', null, '2015-01-14 14:48:26', null);
INSERT INTO `interest_field` VALUES ('2', 'Physics', null, '0', null, '2015-01-14 14:48:35', null);
INSERT INTO `interest_field` VALUES ('3', 'Heliosphere', null, '0', null, '2015-01-14 14:48:45', null);
INSERT INTO `interest_field` VALUES ('4', 'Space', null, '0', null, '2015-01-14 14:48:57', null);
INSERT INTO `interest_field` VALUES ('5', 'Climate', null, '0', null, '2015-01-14 14:49:03', null);
INSERT INTO `interest_field` VALUES ('6', 'Game', null, '0', null, '2015-01-14 14:49:08', null);
INSERT INTO `interest_field` VALUES ('7', 'Ionosphere', null, '0', null, '2015-01-14 14:49:28', null);
INSERT INTO `interest_field` VALUES ('8', 'Academy', null, '0', null, '2015-01-14 14:49:38', null);
