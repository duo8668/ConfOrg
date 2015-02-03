/*
Navicat MySQL Data Transfer

Source Server         : conforg
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-02-03 21:12:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bill_component
-- ----------------------------
DROP TABLE IF EXISTS `bill_component`;
CREATE TABLE `bill_component` (
  `billcomponent_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `billcomponenttype_id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`billcomponent_id`),
  KEY `FK_BillComp_01` (`bill_id`),
  KEY `BillComponentType` (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bill_component
-- ----------------------------

-- ----------------------------
-- Table structure for bill_component_type
-- ----------------------------
DROP TABLE IF EXISTS `bill_component_type`;
CREATE TABLE `bill_component_type` (
  `billcomponenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bill_component_type
-- ----------------------------

-- ----------------------------
-- Table structure for conference
-- ----------------------------
DROP TABLE IF EXISTS `conference`;
CREATE TABLE `conference` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` date NOT NULL,
  `begin_time` datetime NOT NULL,
  `end_date` date NOT NULL,
  `end_time` datetime NOT NULL,
  `is_free` bit(1) NOT NULL DEFAULT b'0',
  `cutoff_time` datetime DEFAULT NULL,
  `min_score` double DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference
-- ----------------------------
INSERT INTO `conference` VALUES ('1', 'Conference 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-01-15', '2015-01-05 06:30:00', '2015-01-07', '2015-01-07 00:00:00', '\0', '0000-00-00 00:00:00', '0', '1', null, '2015-01-17 15:25:10', null);
INSERT INTO `conference` VALUES ('2', 'Conference 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-01-12', '2015-01-12 06:00:00', '2015-01-14', '2015-01-14 09:00:00', '\0', '0000-00-00 00:00:00', '0', '1', null, '2015-01-17 15:25:58', null);
INSERT INTO `conference` VALUES ('3', 'My Test Conf 01', '', '2015-02-23', '0000-00-00 00:00:00', '2015-02-27', '0000-00-00 00:00:00', '', null, null, '52', null, '2015-02-03 21:08:09', '2015-02-03 21:08:09');

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

-- ----------------------------
-- Records of conference_entertainment
-- ----------------------------

-- ----------------------------
-- Table structure for conference_equipmentrequest
-- ----------------------------
DROP TABLE IF EXISTS `conference_equipmentrequest`;
CREATE TABLE `conference_equipmentrequest` (
  `conferenceequipmentrequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `equipmentcat_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferenceequipmentrequest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_equipmentrequest
-- ----------------------------

-- ----------------------------
-- Table structure for conference_field
-- ----------------------------
DROP TABLE IF EXISTS `conference_field`;
CREATE TABLE `conference_field` (
  `conferencefield_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `interestfield_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencefield_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_field
-- ----------------------------

-- ----------------------------
-- Table structure for conference_food
-- ----------------------------
DROP TABLE IF EXISTS `conference_food`;
CREATE TABLE `conference_food` (
  `conferencefood_id` int(11) NOT NULL,
  `conf_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `foodprice_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_datetime` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencefood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_food
-- ----------------------------

-- ----------------------------
-- Table structure for conference_paymenttransaction
-- ----------------------------
DROP TABLE IF EXISTS `conference_paymenttransaction`;
CREATE TABLE `conference_paymenttransaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `paymenttype_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_paymenttransaction
-- ----------------------------

-- ----------------------------
-- Table structure for conference_reviewpanel
-- ----------------------------
DROP TABLE IF EXISTS `conference_reviewpanel`;
CREATE TABLE `conference_reviewpanel` (
  `conferencereviewpanel_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencereviewpanel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_reviewpanel
-- ----------------------------

-- ----------------------------
-- Table structure for conference_room_schedule
-- ----------------------------
DROP TABLE IF EXISTS `conference_room_schedule`;
CREATE TABLE `conference_room_schedule` (
  `confroomschedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `begin_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`confroomschedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_room_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for conference_topic
-- ----------------------------
DROP TABLE IF EXISTS `conference_topic`;
CREATE TABLE `conference_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `topic_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of conference_topic
-- ----------------------------
INSERT INTO `conference_topic` VALUES ('1', '4', 'Blues', '0', null, '2015-01-29 12:16:44', null);
INSERT INTO `conference_topic` VALUES ('2', '4', 'Jazz', '0', null, '2015-01-29 12:16:44', null);
INSERT INTO `conference_topic` VALUES ('3', '4', 'Swing', '0', null, '2015-01-29 12:17:09', null);
INSERT INTO `conference_topic` VALUES ('4', '4', 'Classical', '0', null, '2015-01-29 12:17:09', null);

-- ----------------------------
-- Table structure for confuserrole
-- ----------------------------
DROP TABLE IF EXISTS `confuserrole`;
CREATE TABLE `confuserrole` (
  `confuserrole_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`confuserrole_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confuserrole
-- ----------------------------

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `calling_code` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=251 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'Afghanistan', 'Islamic Republic of Afghanistan', '93');
INSERT INTO `countries` VALUES ('2', 'Aland Islands', '&Aring;land Islands', '358');
INSERT INTO `countries` VALUES ('3', 'Albania', 'Republic of Albania', '355');
INSERT INTO `countries` VALUES ('4', 'Algeria', 'People\'s Democratic Republic of Algeria', '213');
INSERT INTO `countries` VALUES ('5', 'American Samoa', 'American Samoa', '1+684');
INSERT INTO `countries` VALUES ('6', 'Andorra', 'Principality of Andorra', '376');
INSERT INTO `countries` VALUES ('7', 'Angola', 'Republic of Angola', '244');
INSERT INTO `countries` VALUES ('8', 'Anguilla', 'Anguilla', '1+264');
INSERT INTO `countries` VALUES ('9', 'Antarctica', 'Antarctica', '672');
INSERT INTO `countries` VALUES ('10', 'Antigua and Barbuda', 'Antigua and Barbuda', '1+268');
INSERT INTO `countries` VALUES ('11', 'Argentina', 'Argentine Republic', '54');
INSERT INTO `countries` VALUES ('12', 'Armenia', 'Republic of Armenia', '374');
INSERT INTO `countries` VALUES ('13', 'Aruba', 'Aruba', '297');
INSERT INTO `countries` VALUES ('14', 'Australia', 'Commonwealth of Australia', '61');
INSERT INTO `countries` VALUES ('15', 'Austria', 'Republic of Austria', '43');
INSERT INTO `countries` VALUES ('16', 'Azerbaijan', 'Republic of Azerbaijan', '994');
INSERT INTO `countries` VALUES ('17', 'Bahamas', 'Commonwealth of The Bahamas', '1+242');
INSERT INTO `countries` VALUES ('18', 'Bahrain', 'Kingdom of Bahrain', '973');
INSERT INTO `countries` VALUES ('19', 'Bangladesh', 'People\'s Republic of Bangladesh', '880');
INSERT INTO `countries` VALUES ('20', 'Barbados', 'Barbados', '1+246');
INSERT INTO `countries` VALUES ('21', 'Belarus', 'Republic of Belarus', '375');
INSERT INTO `countries` VALUES ('22', 'Belgium', 'Kingdom of Belgium', '32');
INSERT INTO `countries` VALUES ('23', 'Belize', 'Belize', '501');
INSERT INTO `countries` VALUES ('24', 'Benin', 'Republic of Benin', '229');
INSERT INTO `countries` VALUES ('25', 'Bermuda', 'Bermuda Islands', '1+441');
INSERT INTO `countries` VALUES ('26', 'Bhutan', 'Kingdom of Bhutan', '975');
INSERT INTO `countries` VALUES ('27', 'Bolivia', 'Plurinational State of Bolivia', '591');
INSERT INTO `countries` VALUES ('28', 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', '599');
INSERT INTO `countries` VALUES ('29', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', '387');
INSERT INTO `countries` VALUES ('30', 'Botswana', 'Republic of Botswana', '267');
INSERT INTO `countries` VALUES ('31', 'Bouvet Island', 'Bouvet Island', 'NONE');
INSERT INTO `countries` VALUES ('32', 'Brazil', 'Federative Republic of Brazil', '55');
INSERT INTO `countries` VALUES ('33', 'British Indian Ocean Territory', 'British Indian Ocean Territory', '246');
INSERT INTO `countries` VALUES ('34', 'Brunei', 'Brunei Darussalam', '673');
INSERT INTO `countries` VALUES ('35', 'Bulgaria', 'Republic of Bulgaria', '359');
INSERT INTO `countries` VALUES ('36', 'Burkina Faso', 'Burkina Faso', '226');
INSERT INTO `countries` VALUES ('37', 'Burundi', 'Republic of Burundi', '257');
INSERT INTO `countries` VALUES ('38', 'Cambodia', 'Kingdom of Cambodia', '855');
INSERT INTO `countries` VALUES ('39', 'Cameroon', 'Republic of Cameroon', '237');
INSERT INTO `countries` VALUES ('40', 'Canada', 'Canada', '1');
INSERT INTO `countries` VALUES ('41', 'Cape Verde', 'Republic of Cape Verde', '238');
INSERT INTO `countries` VALUES ('42', 'Cayman Islands', 'The Cayman Islands', '1+345');
INSERT INTO `countries` VALUES ('43', 'Central African Republic', 'Central African Republic', '236');
INSERT INTO `countries` VALUES ('44', 'Chad', 'Republic of Chad', '235');
INSERT INTO `countries` VALUES ('45', 'Chile', 'Republic of Chile', '56');
INSERT INTO `countries` VALUES ('46', 'China', 'People\'s Republic of China', '86');
INSERT INTO `countries` VALUES ('47', 'Christmas Island', 'Christmas Island', '61');
INSERT INTO `countries` VALUES ('48', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', '61');
INSERT INTO `countries` VALUES ('49', 'Colombia', 'Republic of Colombia', '57');
INSERT INTO `countries` VALUES ('50', 'Comoros', 'Union of the Comoros', '269');
INSERT INTO `countries` VALUES ('51', 'Congo', 'Republic of the Congo', '242');
INSERT INTO `countries` VALUES ('52', 'Cook Islands', 'Cook Islands', '682');
INSERT INTO `countries` VALUES ('53', 'Costa Rica', 'Republic of Costa Rica', '506');
INSERT INTO `countries` VALUES ('54', 'Cote d\'ivoire (Ivory Coast)', 'Republic of C&ocirc;te D\'Ivoire (Ivory Coast)', '225');
INSERT INTO `countries` VALUES ('55', 'Croatia', 'Republic of Croatia', '385');
INSERT INTO `countries` VALUES ('56', 'Cuba', 'Republic of Cuba', '53');
INSERT INTO `countries` VALUES ('57', 'Curacao', 'Cura&ccedil;ao', '599');
INSERT INTO `countries` VALUES ('58', 'Cyprus', 'Republic of Cyprus', '357');
INSERT INTO `countries` VALUES ('59', 'Czech Republic', 'Czech Republic', '420');
INSERT INTO `countries` VALUES ('60', 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', '243');
INSERT INTO `countries` VALUES ('61', 'Denmark', 'Kingdom of Denmark', '45');
INSERT INTO `countries` VALUES ('62', 'Djibouti', 'Republic of Djibouti', '253');
INSERT INTO `countries` VALUES ('63', 'Dominica', 'Commonwealth of Dominica', '1+767');
INSERT INTO `countries` VALUES ('64', 'Dominican Republic', 'Dominican Republic', '1+809, 8');
INSERT INTO `countries` VALUES ('65', 'Ecuador', 'Republic of Ecuador', '593');
INSERT INTO `countries` VALUES ('66', 'Egypt', 'Arab Republic of Egypt', '20');
INSERT INTO `countries` VALUES ('67', 'El Salvador', 'Republic of El Salvador', '503');
INSERT INTO `countries` VALUES ('68', 'Equatorial Guinea', 'Republic of Equatorial Guinea', '240');
INSERT INTO `countries` VALUES ('69', 'Eritrea', 'State of Eritrea', '291');
INSERT INTO `countries` VALUES ('70', 'Estonia', 'Republic of Estonia', '372');
INSERT INTO `countries` VALUES ('71', 'Ethiopia', 'Federal Democratic Republic of Ethiopia', '251');
INSERT INTO `countries` VALUES ('72', 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', '500');
INSERT INTO `countries` VALUES ('73', 'Faroe Islands', 'The Faroe Islands', '298');
INSERT INTO `countries` VALUES ('74', 'Fiji', 'Republic of Fiji', '679');
INSERT INTO `countries` VALUES ('75', 'Finland', 'Republic of Finland', '358');
INSERT INTO `countries` VALUES ('76', 'France', 'French Republic', '33');
INSERT INTO `countries` VALUES ('77', 'French Guiana', 'French Guiana', '594');
INSERT INTO `countries` VALUES ('78', 'French Polynesia', 'French Polynesia', '689');
INSERT INTO `countries` VALUES ('79', 'French Southern Territories', 'French Southern Territories', null);
INSERT INTO `countries` VALUES ('80', 'Gabon', 'Gabonese Republic', '241');
INSERT INTO `countries` VALUES ('81', 'Gambia', 'Republic of The Gambia', '220');
INSERT INTO `countries` VALUES ('82', 'Georgia', 'Georgia', '995');
INSERT INTO `countries` VALUES ('83', 'Germany', 'Federal Republic of Germany', '49');
INSERT INTO `countries` VALUES ('84', 'Ghana', 'Republic of Ghana', '233');
INSERT INTO `countries` VALUES ('85', 'Gibraltar', 'Gibraltar', '350');
INSERT INTO `countries` VALUES ('86', 'Greece', 'Hellenic Republic', '30');
INSERT INTO `countries` VALUES ('87', 'Greenland', 'Greenland', '299');
INSERT INTO `countries` VALUES ('88', 'Grenada', 'Grenada', '1+473');
INSERT INTO `countries` VALUES ('89', 'Guadaloupe', 'Guadeloupe', '590');
INSERT INTO `countries` VALUES ('90', 'Guam', 'Guam', '1+671');
INSERT INTO `countries` VALUES ('91', 'Guatemala', 'Republic of Guatemala', '502');
INSERT INTO `countries` VALUES ('92', 'Guernsey', 'Guernsey', '44');
INSERT INTO `countries` VALUES ('93', 'Guinea', 'Republic of Guinea', '224');
INSERT INTO `countries` VALUES ('94', 'Guinea-Bissau', 'Republic of Guinea-Bissau', '245');
INSERT INTO `countries` VALUES ('95', 'Guyana', 'Co-operative Republic of Guyana', '592');
INSERT INTO `countries` VALUES ('96', 'Haiti', 'Republic of Haiti', '509');
INSERT INTO `countries` VALUES ('97', 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'NONE');
INSERT INTO `countries` VALUES ('98', 'Honduras', 'Republic of Honduras', '504');
INSERT INTO `countries` VALUES ('99', 'Hong Kong', 'Hong Kong', '852');
INSERT INTO `countries` VALUES ('100', 'Hungary', 'Hungary', '36');
INSERT INTO `countries` VALUES ('101', 'Iceland', 'Republic of Iceland', '354');
INSERT INTO `countries` VALUES ('102', 'India', 'Republic of India', '91');
INSERT INTO `countries` VALUES ('103', 'Indonesia', 'Republic of Indonesia', '62');
INSERT INTO `countries` VALUES ('104', 'Iran', 'Islamic Republic of Iran', '98');
INSERT INTO `countries` VALUES ('105', 'Iraq', 'Republic of Iraq', '964');
INSERT INTO `countries` VALUES ('106', 'Ireland', 'Ireland', '353');
INSERT INTO `countries` VALUES ('107', 'Isle of Man', 'Isle of Man', '44');
INSERT INTO `countries` VALUES ('108', 'Israel', 'State of Israel', '972');
INSERT INTO `countries` VALUES ('109', 'Italy', 'Italian Republic', '39');
INSERT INTO `countries` VALUES ('110', 'Jamaica', 'Jamaica', '1+876');
INSERT INTO `countries` VALUES ('111', 'Japan', 'Japan', '81');
INSERT INTO `countries` VALUES ('112', 'Jersey', 'The Bailiwick of Jersey', '44');
INSERT INTO `countries` VALUES ('113', 'Jordan', 'Hashemite Kingdom of Jordan', '962');
INSERT INTO `countries` VALUES ('114', 'Kazakhstan', 'Republic of Kazakhstan', '7');
INSERT INTO `countries` VALUES ('115', 'Kenya', 'Republic of Kenya', '254');
INSERT INTO `countries` VALUES ('116', 'Kiribati', 'Republic of Kiribati', '686');
INSERT INTO `countries` VALUES ('117', 'Kosovo', 'Republic of Kosovo', '381');
INSERT INTO `countries` VALUES ('118', 'Kuwait', 'State of Kuwait', '965');
INSERT INTO `countries` VALUES ('119', 'Kyrgyzstan', 'Kyrgyz Republic', '996');
INSERT INTO `countries` VALUES ('120', 'Laos', 'Lao People\'s Democratic Republic', '856');
INSERT INTO `countries` VALUES ('121', 'Latvia', 'Republic of Latvia', '371');
INSERT INTO `countries` VALUES ('122', 'Lebanon', 'Republic of Lebanon', '961');
INSERT INTO `countries` VALUES ('123', 'Lesotho', 'Kingdom of Lesotho', '266');
INSERT INTO `countries` VALUES ('124', 'Liberia', 'Republic of Liberia', '231');
INSERT INTO `countries` VALUES ('125', 'Libya', 'Libya', '218');
INSERT INTO `countries` VALUES ('126', 'Liechtenstein', 'Principality of Liechtenstein', '423');
INSERT INTO `countries` VALUES ('127', 'Lithuania', 'Republic of Lithuania', '370');
INSERT INTO `countries` VALUES ('128', 'Luxembourg', 'Grand Duchy of Luxembourg', '352');
INSERT INTO `countries` VALUES ('129', 'Macao', 'The Macao Special Administrative Region', '853');
INSERT INTO `countries` VALUES ('130', 'Macedonia', 'The Former Yugoslav Republic of Macedonia', '389');
INSERT INTO `countries` VALUES ('131', 'Madagascar', 'Republic of Madagascar', '261');
INSERT INTO `countries` VALUES ('132', 'Malawi', 'Republic of Malawi', '265');
INSERT INTO `countries` VALUES ('133', 'Malaysia', 'Malaysia', '60');
INSERT INTO `countries` VALUES ('134', 'Maldives', 'Republic of Maldives', '960');
INSERT INTO `countries` VALUES ('135', 'Mali', 'Republic of Mali', '223');
INSERT INTO `countries` VALUES ('136', 'Malta', 'Republic of Malta', '356');
INSERT INTO `countries` VALUES ('137', 'Marshall Islands', 'Republic of the Marshall Islands', '692');
INSERT INTO `countries` VALUES ('138', 'Martinique', 'Martinique', '596');
INSERT INTO `countries` VALUES ('139', 'Mauritania', 'Islamic Republic of Mauritania', '222');
INSERT INTO `countries` VALUES ('140', 'Mauritius', 'Republic of Mauritius', '230');
INSERT INTO `countries` VALUES ('141', 'Mayotte', 'Mayotte', '262');
INSERT INTO `countries` VALUES ('142', 'Mexico', 'United Mexican States', '52');
INSERT INTO `countries` VALUES ('143', 'Micronesia', 'Federated States of Micronesia', '691');
INSERT INTO `countries` VALUES ('144', 'Moldava', 'Republic of Moldova', '373');
INSERT INTO `countries` VALUES ('145', 'Monaco', 'Principality of Monaco', '377');
INSERT INTO `countries` VALUES ('146', 'Mongolia', 'Mongolia', '976');
INSERT INTO `countries` VALUES ('147', 'Montenegro', 'Montenegro', '382');
INSERT INTO `countries` VALUES ('148', 'Montserrat', 'Montserrat', '1+664');
INSERT INTO `countries` VALUES ('149', 'Morocco', 'Kingdom of Morocco', '212');
INSERT INTO `countries` VALUES ('150', 'Mozambique', 'Republic of Mozambique', '258');
INSERT INTO `countries` VALUES ('151', 'Myanmar (Burma)', 'Republic of the Union of Myanmar', '95');
INSERT INTO `countries` VALUES ('152', 'Namibia', 'Republic of Namibia', '264');
INSERT INTO `countries` VALUES ('153', 'Nauru', 'Republic of Nauru', '674');
INSERT INTO `countries` VALUES ('154', 'Nepal', 'Federal Democratic Republic of Nepal', '977');
INSERT INTO `countries` VALUES ('155', 'Netherlands', 'Kingdom of the Netherlands', '31');
INSERT INTO `countries` VALUES ('156', 'New Caledonia', 'New Caledonia', '687');
INSERT INTO `countries` VALUES ('157', 'New Zealand', 'New Zealand', '64');
INSERT INTO `countries` VALUES ('158', 'Nicaragua', 'Republic of Nicaragua', '505');
INSERT INTO `countries` VALUES ('159', 'Niger', 'Republic of Niger', '227');
INSERT INTO `countries` VALUES ('160', 'Nigeria', 'Federal Republic of Nigeria', '234');
INSERT INTO `countries` VALUES ('161', 'Niue', 'Niue', '683');
INSERT INTO `countries` VALUES ('162', 'Norfolk Island', 'Norfolk Island', '672');
INSERT INTO `countries` VALUES ('163', 'North Korea', 'Democratic People\'s Republic of Korea', '850');
INSERT INTO `countries` VALUES ('164', 'Northern Mariana Islands', 'Northern Mariana Islands', '1+670');
INSERT INTO `countries` VALUES ('165', 'Norway', 'Kingdom of Norway', '47');
INSERT INTO `countries` VALUES ('166', 'Oman', 'Sultanate of Oman', '968');
INSERT INTO `countries` VALUES ('167', 'Pakistan', 'Islamic Republic of Pakistan', '92');
INSERT INTO `countries` VALUES ('168', 'Palau', 'Republic of Palau', '680');
INSERT INTO `countries` VALUES ('169', 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', '970');
INSERT INTO `countries` VALUES ('170', 'Panama', 'Republic of Panama', '507');
INSERT INTO `countries` VALUES ('171', 'Papua New Guinea', 'Independent State of Papua New Guinea', '675');
INSERT INTO `countries` VALUES ('172', 'Paraguay', 'Republic of Paraguay', '595');
INSERT INTO `countries` VALUES ('173', 'Peru', 'Republic of Peru', '51');
INSERT INTO `countries` VALUES ('174', 'Phillipines', 'Republic of the Philippines', '63');
INSERT INTO `countries` VALUES ('175', 'Pitcairn', 'Pitcairn', 'NONE');
INSERT INTO `countries` VALUES ('176', 'Poland', 'Republic of Poland', '48');
INSERT INTO `countries` VALUES ('177', 'Portugal', 'Portuguese Republic', '351');
INSERT INTO `countries` VALUES ('178', 'Puerto Rico', 'Commonwealth of Puerto Rico', '1+939');
INSERT INTO `countries` VALUES ('179', 'Qatar', 'State of Qatar', '974');
INSERT INTO `countries` VALUES ('180', 'Reunion', 'R&eacute;union', '262');
INSERT INTO `countries` VALUES ('181', 'Romania', 'Romania', '40');
INSERT INTO `countries` VALUES ('182', 'Russia', 'Russian Federation', '7');
INSERT INTO `countries` VALUES ('183', 'Rwanda', 'Republic of Rwanda', '250');
INSERT INTO `countries` VALUES ('184', 'Saint Barthelemy', 'Saint Barth&eacute;lemy', '590');
INSERT INTO `countries` VALUES ('185', 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', '290');
INSERT INTO `countries` VALUES ('186', 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', '1+869');
INSERT INTO `countries` VALUES ('187', 'Saint Lucia', 'Saint Lucia', '1+758');
INSERT INTO `countries` VALUES ('188', 'Saint Martin', 'Saint Martin', '590');
INSERT INTO `countries` VALUES ('189', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', '508');
INSERT INTO `countries` VALUES ('190', 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', '1+784');
INSERT INTO `countries` VALUES ('191', 'Samoa', 'Independent State of Samoa', '685');
INSERT INTO `countries` VALUES ('192', 'San Marino', 'Republic of San Marino', '378');
INSERT INTO `countries` VALUES ('193', 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', '239');
INSERT INTO `countries` VALUES ('194', 'Saudi Arabia', 'Kingdom of Saudi Arabia', '966');
INSERT INTO `countries` VALUES ('195', 'Senegal', 'Republic of Senegal', '221');
INSERT INTO `countries` VALUES ('196', 'Serbia', 'Republic of Serbia', '381');
INSERT INTO `countries` VALUES ('197', 'Seychelles', 'Republic of Seychelles', '248');
INSERT INTO `countries` VALUES ('198', 'Sierra Leone', 'Republic of Sierra Leone', '232');
INSERT INTO `countries` VALUES ('199', 'Singapore', 'Republic of Singapore', '65');
INSERT INTO `countries` VALUES ('200', 'Sint Maarten', 'Sint Maarten', '1+721');
INSERT INTO `countries` VALUES ('201', 'Slovakia', 'Slovak Republic', '421');
INSERT INTO `countries` VALUES ('202', 'Slovenia', 'Republic of Slovenia', '386');
INSERT INTO `countries` VALUES ('203', 'Solomon Islands', 'Solomon Islands', '677');
INSERT INTO `countries` VALUES ('204', 'Somalia', 'Somali Republic', '252');
INSERT INTO `countries` VALUES ('205', 'South Africa', 'Republic of South Africa', '27');
INSERT INTO `countries` VALUES ('206', 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', '500');
INSERT INTO `countries` VALUES ('207', 'South Korea', 'Republic of Korea', '82');
INSERT INTO `countries` VALUES ('208', 'South Sudan', 'Republic of South Sudan', '211');
INSERT INTO `countries` VALUES ('209', 'Spain', 'Kingdom of Spain', '34');
INSERT INTO `countries` VALUES ('210', 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', '94');
INSERT INTO `countries` VALUES ('211', 'Sudan', 'Republic of the Sudan', '249');
INSERT INTO `countries` VALUES ('212', 'Suriname', 'Republic of Suriname', '597');
INSERT INTO `countries` VALUES ('213', 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', '47');
INSERT INTO `countries` VALUES ('214', 'Swaziland', 'Kingdom of Swaziland', '268');
INSERT INTO `countries` VALUES ('215', 'Sweden', 'Kingdom of Sweden', '46');
INSERT INTO `countries` VALUES ('216', 'Switzerland', 'Swiss Confederation', '41');
INSERT INTO `countries` VALUES ('217', 'Syria', 'Syrian Arab Republic', '963');
INSERT INTO `countries` VALUES ('218', 'Taiwan', 'Republic of China (Taiwan)', '886');
INSERT INTO `countries` VALUES ('219', 'Tajikistan', 'Republic of Tajikistan', '992');
INSERT INTO `countries` VALUES ('220', 'Tanzania', 'United Republic of Tanzania', '255');
INSERT INTO `countries` VALUES ('221', 'Thailand', 'Kingdom of Thailand', '66');
INSERT INTO `countries` VALUES ('222', 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', '670');
INSERT INTO `countries` VALUES ('223', 'Togo', 'Togolese Republic', '228');
INSERT INTO `countries` VALUES ('224', 'Tokelau', 'Tokelau', '690');
INSERT INTO `countries` VALUES ('225', 'Tonga', 'Kingdom of Tonga', '676');
INSERT INTO `countries` VALUES ('226', 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', '1+868');
INSERT INTO `countries` VALUES ('227', 'Tunisia', 'Republic of Tunisia', '216');
INSERT INTO `countries` VALUES ('228', 'Turkey', 'Republic of Turkey', '90');
INSERT INTO `countries` VALUES ('229', 'Turkmenistan', 'Turkmenistan', '993');
INSERT INTO `countries` VALUES ('230', 'Turks and Caicos Islands', 'Turks and Caicos Islands', '1+649');
INSERT INTO `countries` VALUES ('231', 'Tuvalu', 'Tuvalu', '688');
INSERT INTO `countries` VALUES ('232', 'Uganda', 'Republic of Uganda', '256');
INSERT INTO `countries` VALUES ('233', 'Ukraine', 'Ukraine', '380');
INSERT INTO `countries` VALUES ('234', 'United Arab Emirates', 'United Arab Emirates', '971');
INSERT INTO `countries` VALUES ('235', 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', '44');
INSERT INTO `countries` VALUES ('236', 'United States', 'United States of America', '1');
INSERT INTO `countries` VALUES ('237', 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'NONE');
INSERT INTO `countries` VALUES ('238', 'Uruguay', 'Eastern Republic of Uruguay', '598');
INSERT INTO `countries` VALUES ('239', 'Uzbekistan', 'Republic of Uzbekistan', '998');
INSERT INTO `countries` VALUES ('240', 'Vanuatu', 'Republic of Vanuatu', '678');
INSERT INTO `countries` VALUES ('241', 'Vatican City', 'State of the Vatican City', '39');
INSERT INTO `countries` VALUES ('242', 'Venezuela', 'Bolivarian Republic of Venezuela', '58');
INSERT INTO `countries` VALUES ('243', 'Vietnam', 'Socialist Republic of Vietnam', '84');
INSERT INTO `countries` VALUES ('244', 'Virgin Islands, British', 'British Virgin Islands', '1+284');
INSERT INTO `countries` VALUES ('245', 'Virgin Islands, US', 'Virgin Islands of the United States', '1+340');
INSERT INTO `countries` VALUES ('246', 'Wallis and Futuna', 'Wallis and Futuna', '681');
INSERT INTO `countries` VALUES ('247', 'Western Sahara', 'Western Sahara', '212');
INSERT INTO `countries` VALUES ('248', 'Yemen', 'Republic of Yemen', '967');
INSERT INTO `countries` VALUES ('249', 'Zambia', 'Republic of Zambia', '260');
INSERT INTO `countries` VALUES ('250', 'Zimbabwe', 'Republic of Zimbabwe', '263');

-- ----------------------------
-- Table structure for cuisine
-- ----------------------------
DROP TABLE IF EXISTS `cuisine`;
CREATE TABLE `cuisine` (
  `cusine_id` int(11) NOT NULL AUTO_INCREMENT,
  `cusine_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cusine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cuisine
-- ----------------------------

-- ----------------------------
-- Table structure for entertainment
-- ----------------------------
DROP TABLE IF EXISTS `entertainment`;
CREATE TABLE `entertainment` (
  `entertainment_id` int(11) NOT NULL,
  `organization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_of_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poc_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment
-- ----------------------------

-- ----------------------------
-- Table structure for entertainment_type
-- ----------------------------
DROP TABLE IF EXISTS `entertainment_type`;
CREATE TABLE `entertainment_type` (
  `entertainmentype_id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainment_type_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`entertainmentype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of entertainment_type
-- ----------------------------

-- ----------------------------
-- Table structure for equipment
-- ----------------------------
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_id` int(11) NOT NULL DEFAULT '0',
  `equipment_name` varchar(45) DEFAULT NULL,
  `equipment_remark` varchar(45) DEFAULT NULL,
  `rental_cost` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`equipment_id`,`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipment
-- ----------------------------

-- ----------------------------
-- Table structure for equipment_category
-- ----------------------------
DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE `equipment_category` (
  `equipmentcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipmentcategory_remark` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of equipment_category
-- ----------------------------

-- ----------------------------
-- Table structure for food
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `oragnaization` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cuisnie_id` int(11) DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point_of_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poc_description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food
-- ----------------------------

-- ----------------------------
-- Table structure for food_price
-- ----------------------------
DROP TABLE IF EXISTS `food_price`;
CREATE TABLE `food_price` (
  `foodprice_id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meal_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`foodprice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food_price
-- ----------------------------

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

-- ----------------------------
-- Table structure for keywords
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of keywords
-- ----------------------------
INSERT INTO `keywords` VALUES ('17', 'zoro', '3', '0', null, '2015-01-29 11:12:36', '2015-01-29 11:12:36');
INSERT INTO `keywords` VALUES ('21', 'music', '3', '0', null, '2015-01-29 12:46:55', '2015-01-29 12:46:55');
INSERT INTO `keywords` VALUES ('51', 'chopper', '1', '0', null, '2015-02-02 15:06:39', '2015-02-02 15:06:39');
INSERT INTO `keywords` VALUES ('52', 'sanji', '1', '0', null, '2015-02-02 15:06:39', '2015-02-02 15:06:39');
INSERT INTO `keywords` VALUES ('54', 'grapes', '39', '0', null, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

-- ----------------------------
-- Table structure for menu_items
-- ----------------------------
DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `menuitem_id` int(11) NOT NULL,
  `foodprice_id` int(11) DEFAULT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`menuitem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu_items
-- ----------------------------

-- ----------------------------
-- Table structure for payment_cash
-- ----------------------------
DROP TABLE IF EXISTS `payment_cash`;
CREATE TABLE `payment_cash` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_cash
-- ----------------------------

-- ----------------------------
-- Table structure for payment_creditcard
-- ----------------------------
DROP TABLE IF EXISTS `payment_creditcard`;
CREATE TABLE `payment_creditcard` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `card_num` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_creditcard
-- ----------------------------

-- ----------------------------
-- Table structure for payment_type
-- ----------------------------
DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE `payment_type` (
  `paymenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`paymenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment_type
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `permission_Id` int(11) NOT NULL,
  `permission_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_Id`),
  UNIQUE KEY `permission_name_UNIQUE` (`permission_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('0', '', '');
INSERT INTO `permissions` VALUES ('1', 'do something', 'do something');
INSERT INTO `permissions` VALUES ('2', 'do 2', 'do 2');

-- ----------------------------
-- Table structure for primary_role
-- ----------------------------
DROP TABLE IF EXISTS `primary_role`;
CREATE TABLE `primary_role` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `primary_role_fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of primary_role
-- ----------------------------
INSERT INTO `primary_role` VALUES ('2', '3');
INSERT INTO `primary_role` VALUES ('1', '4');

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `profile_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fb_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `uid` bigint(20) unsigned NOT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bio` text COLLATE utf8_unicode_ci,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES ('15', '', '52', '0', '', '2015-02-03 20:59:39', '2015-02-03 20:59:39', 'Hi! Thanks for visiting', null, null);

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `internal_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `quality_score` int(11) NOT NULL,
  `relevance_score` int(11) NOT NULL,
  `originality_score` int(11) NOT NULL,
  `significance_score` int(11) NOT NULL,
  `presentation_score` int(11) NOT NULL,
  `recommendation` int(11) NOT NULL,
  `reviewer_familiarity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of reviews
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'reviewer', 'reviewer');
INSERT INTO `roles` VALUES ('2', 'participant', 'participant');
INSERT INTO `roles` VALUES ('3', 'author', 'author');
INSERT INTO `roles` VALUES ('4', 'conference_chair', 'conference_chair');
INSERT INTO `roles` VALUES ('5', 'conference_staff', 'conference_staff');

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `permission_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_permission_fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES ('3', '1');
INSERT INTO `role_permission` VALUES ('4', '2');

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `room_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rental_cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`room_id`,`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room
-- ----------------------------
INSERT INTO `room` VALUES ('1', '1', 'Room V1 R1', '500', '500', '1', null, '2015-01-16 16:23:07', null);
INSERT INTO `room` VALUES ('2', '1', 'Room V1 R2', '450', '550', '1', null, '2015-01-16 16:23:22', null);
INSERT INTO `room` VALUES ('3', '1', 'Room V1 R3', '550', '600', '1', null, '2015-01-16 16:23:36', null);

-- ----------------------------
-- Table structure for room_cost
-- ----------------------------
DROP TABLE IF EXISTS `room_cost`;
CREATE TABLE `room_cost` (
  `roomcost_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `seattype_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`roomcost_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room_cost
-- ----------------------------

-- ----------------------------
-- Table structure for room_equipment
-- ----------------------------
DROP TABLE IF EXISTS `room_equipment`;
CREATE TABLE `room_equipment` (
  `roomequipment_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`roomequipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of room_equipment
-- ----------------------------

-- ----------------------------
-- Table structure for seat_type
-- ----------------------------
DROP TABLE IF EXISTS `seat_type`;
CREATE TABLE `seat_type` (
  `seattype_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`seattype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of seat_type
-- ----------------------------

-- ----------------------------
-- Table structure for submissions
-- ----------------------------
DROP TABLE IF EXISTS `submissions`;
CREATE TABLE `submissions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `sub_title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment_path` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `is_accepted` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`),
  UNIQUE KEY `submissions_subtitle_unique` (`sub_title`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submissions
-- ----------------------------
INSERT INTO `submissions` VALUES ('1', '1', '1', '2', 'Contribution 1 Updated', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'uploads/877983.pdf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '0', '1', null, '2015-01-17 15:27:32', '2015-02-02 15:06:23');
INSERT INTO `submissions` VALUES ('3', '1', '1', '2', 'Contribution 3 (2 was deleted!)', 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'uploads/129638.pdf', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', '0', '1', null, '2015-01-17 16:31:43', null);
INSERT INTO `submissions` VALUES ('39', '0', '0', '1', 'qwerty', 'fgfdfdfdfd', 'uploads/891655.pdf', 'read', '0', '0', null, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

-- ----------------------------
-- Table structure for submission_author
-- ----------------------------
DROP TABLE IF EXISTS `submission_author`;
CREATE TABLE `submission_author` (
  `sub_id` int(11) NOT NULL,
  `email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `short_bio` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `is_presenting` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`,`email`),
  UNIQUE KEY `submission_author_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_author
-- ----------------------------

-- ----------------------------
-- Table structure for submission_authors
-- ----------------------------
DROP TABLE IF EXISTS `submission_authors`;
CREATE TABLE `submission_authors` (
  `sub_id` int(11) NOT NULL,
  `email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `is_presenting` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`,`email`),
  UNIQUE KEY `submission_author_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_authors
-- ----------------------------
INSERT INTO `submission_authors` VALUES ('1', 'luffy@onepiece.com', 'Luffy', 'Monkey D.', 'Strawhat Pirates', '1', '0', null, '2015-02-02 00:23:52', null);
INSERT INTO `submission_authors` VALUES ('1', 'zoro@onepiece.com', 'Zoro', 'Roronoa', 'Strawhat Pirates', '1', '0', null, '2015-02-02 00:23:52', null);
INSERT INTO `submission_authors` VALUES ('3', 'law@onepiece.com', 'Law', 'Trafalgar D. Waters', 'Heart Pirates', '0', '0', null, '2015-02-02 00:24:52', null);
INSERT INTO `submission_authors` VALUES ('3', 'robin@onepiece.com', 'Robin', 'Nico', 'Straw Hat Pirates', '1', '0', null, '2015-02-02 00:24:52', null);
INSERT INTO `submission_authors` VALUES ('39', 'qq@n.c', 'qqq', 'qqq', 'qqq', '1', '0', null, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

-- ----------------------------
-- Table structure for submission_keyword
-- ----------------------------
DROP TABLE IF EXISTS `submission_keyword`;
CREATE TABLE `submission_keyword` (
  `keyword_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for submission_topic
-- ----------------------------
DROP TABLE IF EXISTS `submission_topic`;
CREATE TABLE `submission_topic` (
  `topic_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of submission_topic
-- ----------------------------
INSERT INTO `submission_topic` VALUES ('2', '3', '0', null, '2015-01-29 13:09:29', '2015-01-29 13:09:29');
INSERT INTO `submission_topic` VALUES ('3', '1', '0', null, '2015-02-02 15:06:39', '2015-02-02 15:06:39');
INSERT INTO `submission_topic` VALUES ('4', '39', '0', null, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

-- ----------------------------
-- Table structure for topics
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `topic_id` int(10) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `topic_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of topics
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_temp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('52', 'Maou Sheng', 'Lee', 'duomax8668@hotmail.com', null, '$2y$10$570.AZ.AhB.RbjYCE.Dzre5HV69ZnINOYeORRcKjNGXb5GhCSuLMu', null, null, '', '1', '2015-02-03 20:59:06', '2015-02-03 20:59:39');

-- ----------------------------
-- Table structure for user_bill
-- ----------------------------
DROP TABLE IF EXISTS `user_bill`;
CREATE TABLE `user_bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_bill
-- ----------------------------

-- ----------------------------
-- Table structure for venue
-- ----------------------------
DROP TABLE IF EXISTS `venue`;
CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of venue
-- ----------------------------
INSERT INTO `venue` VALUES ('1', 'Venue 01', 'Address Venue 01', null, null, '1', null, '2015-01-24 15:28:23', null);
