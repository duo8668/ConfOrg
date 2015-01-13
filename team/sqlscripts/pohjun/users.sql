/*
Navicat MySQL Data Transfer

Source Server         : csci321
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-13 10:51:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'jason', 'ng', 'jason@gmail.com', '$2y$10$Bahmed8JSm2QI7dPXRQgT.6Z8Y.Dt4AWNnQksx1X7u/8jisVDmg1.', null, 'v4Qsb3cic9hc9VYDvxbZ8R418YcNr2ipRAPG4ZfYf5db7winRDTc56SebzJ8', null, '1');
INSERT INTO `users` VALUES ('2', 'pew', 'pew', 'pewpew@gmail.com', '$2y$10$MYnkqi7TI069Kz3F5wdFXOLWtvJpw/Ru3kV6fKZWDs76BVLSPoxAK', null, 'uKgrfQYG5hx5xzLDtmgQBMAYNTshv8AxF8QoSbLd0isiLIi75oaYrgJLqrUh', null, '1');
INSERT INTO `users` VALUES ('21', 'poh jun', 'ng', 'pohjun.ng@gmail.com', '$2y$10$D34Pldb0nHc/L9B/XmwCA.IJMhmAZhnly.VQfh4m6a1L36WP7Lxe.', '', 'YtBE0Pmo7kOz7hlj2QwQFLGQ2Iixa1CUcvz8Q2pt8ixWIQgCZGCi2cAlJHHI', '', '1');
