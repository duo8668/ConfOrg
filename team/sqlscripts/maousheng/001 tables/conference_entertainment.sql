/*
Navicat MySQL Data Transfer

Source Server         : WorkPC
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-14 11:05:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for conference_entertainment
-- ----------------------------
DROP TABLE IF EXISTS `conference_entertainment`;
CREATE TABLE `conference_entertainment` (
  `conference_entertainment_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `entertainment_id` int(11) NOT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conference_entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
