/*
Navicat MySQL Data Transfer

Source Server         : conf_org
Source Server Version : 50617
Source Host           : localhost:3307
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-02-27 21:17:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for conference_cancel
-- ----------------------------
DROP TABLE IF EXISTS `conference_cancel`;
CREATE TABLE `conference_cancel` (
  `conference_cancel_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`conference_cancel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
