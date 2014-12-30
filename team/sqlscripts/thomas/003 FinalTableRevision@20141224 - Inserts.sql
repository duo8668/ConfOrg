-- ----------------------------
--  Records 
-- ----------------------------
USE `conforg_db`;


SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO `conference` VALUES ('1','MyConf 01','3','Duno what to write','2015-01-23','2015-01-23 08:30:00','2015-01-26','2015-01-26 20:30:00','\0',NULL,'1','2014-12-21 13:29:30'), ('2','MyConf 02','1','So just anyhow write','2014-12-30','2014-12-30 00:00:00','2014-12-31','2014-12-31 00:00:00','\0','-1','0','2014-12-21 19:14:11'), ('3','MyConf 03','2','And write is cool','2014-12-30','2014-12-30 00:00:00','2014-12-31','2014-12-31 00:00:00','\0','-1','0','2014-12-21 19:19:44');
INSERT INTO `conferencetype` VALUES ('1','Community','','0','2014-12-18 12:41:43'), ('2','Food','','0','2014-12-18 12:40:23'), ('3','Technology','','0','2014-12-18 12:41:15');
INSERT INTO `conference_participant` VALUES ('1','1','1','0','2014-12-23 22:42:40'), ('2','2','1','0','2014-12-23 22:43:30');
INSERT INTO `confuserrole` VALUES ('1','1','1','1'), ('2','2','1','2'), ('3','3','2','1'), ('4','2','2','1');
INSERT INTO `roles` VALUES ('1','reviewer','reviewer'), ('2','participant','participant'), ('3','author','author');
INSERT INTO `users` VALUES ('1','mr','jason','ng','jason@gmail.com','$2y$10$Bahmed8JSm2QI7dPXRQgT.6Z8Y.Dt4AWNnQksx1X7u/8jisVDmg1.','thdvKPSqIBvCDGgvoexFsMu2sozwB6Qh1EDrzZP5JC9tAcLaqIirqHLGDRpv'), ('2','mr','pewpew','pewpew','pewpew@gmail.com','$2y$10$MYnkqi7TI069Kz3F5wdFXOLWtvJpw/Ru3kV6fKZWDs76BVLSPoxAK',NULL);