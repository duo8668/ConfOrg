/*
Navicat MySQL Data Transfer

Source Server         : conf_org
Source Server Version : 50617
Source Host           : localhost:3307
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-03-02 00:26:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for invoice
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` float NOT NULL,
  `item_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ticket',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'unpaid',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
