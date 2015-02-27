/*
Navicat MySQL Data Transfer

Source Server         : conf_org
Source Server Version : 50617
Source Host           : localhost:3307
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-02-27 23:23:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for conference_schedule_event
-- ----------------------------
DROP TABLE IF EXISTS `conference_schedule_event`;
CREATE TABLE `conference_schedule_event` (
  `conference_schedule_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `conference_room_schedule_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `day` date NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `className` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`conference_schedule_event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
