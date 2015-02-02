/*
Navicat MySQL Data Transfer

Source Server         : csci321
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-02-02 22:08:18
*/

SET FOREIGN_KEY_CHECKS=0;

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
