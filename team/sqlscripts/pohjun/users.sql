/*
Navicat MySQL Data Transfer

Source Server         : csci321
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-01-20 17:12:29
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
  `email_temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Shera', 'Kuro', 'shera@gmail.com', null, '$2y$10$Bahmed8JSm2QI7dPXRQgT.6Z8Y.Dt4AWNnQksx1X7u/8jisVDmg1.', null, 'v4Qsb3cic9hc9VYDvxbZ8R418YcNr2ipRAPG4ZfYf5db7winRDTc56SebzJ8', null, '1', '0000-00-00 00:00:00', null);
INSERT INTO `users` VALUES ('2', 'Pew', 'Pew', 'pewpew@gmail.com', null, '$2y$10$MYnkqi7TI069Kz3F5wdFXOLWtvJpw/Ru3kV6fKZWDs76BVLSPoxAK', null, 'uKgrfQYG5hx5xzLDtmgQBMAYNTshv8AxF8QoSbLd0isiLIi75oaYrgJLqrUh', null, '1', '0000-00-00 00:00:00', null);
INSERT INTO `users` VALUES ('21', 'Poh Jun', 'Ng', 'pohjun.ng@gmail.com', '', '$2y$10$pckpfK.N.HvoHymch49MNena95jZNQN2TURrpfiq9jf9tHpSIeB2G', '', '6eDBIMJuj7W28h7vlOLZLM7TuRbji2iKaewNF9VSZOYWkrmZ3f3EP4vFHovp', '', '1', '0000-00-00 00:00:00', '2015-01-20 09:02:22');
INSERT INTO `users` VALUES ('22', 'Jason', 'Ng', 'pohjun.ng@hotmail.sg', null, '$2y$10$8tD/mXQbPV1NlbpL7ICX5ul7Cm7aLg1ArTlRw9mqn8Pb77ugccFJ6', '', 'SQqmMqycfd1IkKWihb5EgFFkn7pweiC8IcGk47H2qOW0Zoln1bP78O7vdvf3', '', '1', '0000-00-00 00:00:00', null);
INSERT INTO `users` VALUES ('30', 'lab', 'mice', 'metaspell@hotmail.com', '', '$2y$10$fuultGIMDEXOiaFh9mXnc..nKR.CjNtKEQ9BzigbcZDo2A3HSFqaO', null, 'cL5mf8TAvXCIvaA3C3prws3FdORHZtB7Rq8oGB9RqGK31DKYLG8fJGCZ0BtQ', '', '1', '2015-01-20 08:27:36', '2015-01-20 08:51:01');
