/*
Navicat MySQL Data Transfer

Source Server         : conf_org
Source Server Version : 50617
Source Host           : localhost:3307
Source Database       : conforg_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-03-02 20:58:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Records of company
-- ----------------------------
TRUNCATE TABLE `company`;

INSERT INTO `company` VALUES ('5', 'SingEx Venues');
INSERT INTO `company` VALUES ('6', 'Rock Productions');
INSERT INTO `company` VALUES ('7', 'Suntec Singapore');
INSERT INTO `company` VALUES ('8', 'Marina Bay Sands');

-- ----------------------------
-- Records of conference
-- ----------------------------
TRUNCATE TABLE `conference`;

INSERT INTO `conference` VALUES ('1', '2015 IEEE Wireless Communications and Networking Conference (WCNC)', 'IEEE WCNC is the world premier wireless event that brings together industry professionals, academics, and individuals from government agencies and other institutions to exchange information and ideas on the advancement of wireless communications and networking technology.\r\n\r\nThe conference will feature a comprehensive technical program offering numerous technical sessions with papers showcasing the latest technologies, applications and services. In addition, the conference program includes workshops, tutorials, keynote talks from industrial leaders and renowned academics, panel discussions, a large exhibition, business and industrial forums.', '2015-04-02', '2015-04-02 09:00:00', '2015-04-03', '2015-04-03 16:00:00', '\0', '2015-02-20 00:00:00', '75', '200.00', '1', '0', '2015-03-02 10:04:07', null);
INSERT INTO `conference` VALUES ('2', 'Gartner IT Infrastructure, Operations & Data Center Summit', 'The must-attend event for I&O and data center professionals\r\nThe Gartner IT Infrastructure, Operations & Data Center Summit 2015 will empower you to formulate and implement a strategy that delivers clear outcomes built on a realistically executable infrastructure and operations roadmap.\r\nThis event will help you lead your IT organization and reinforce the criticality and relevance of your position in the face of increasing change and challenges from ever increasing disruption brought about by Nexus of Forces and digital business.', '2015-06-04', '2015-06-04 09:00:00', '2015-06-05', '2015-06-05 17:00:00', '\0', '2015-04-30 00:00:00', '75', '350.00', '2', null, '2015-03-02 10:04:07', null);
INSERT INTO `conference` VALUES ('3', 'Gartner Digital Marketing Conference 2015', 'Fuel your marketing strategy as an engine for growth, unlock revenue, gain aggressive market share, build stronger brands and secure your own personal success as a marketing leader.\r\nThis conference was created for senior marketing executives, like you, as the premier outlet for learning the latest digital marketing trends. You will leave with actionable insights and key strategies derived from independent and objective research.', '2015-05-06', '2015-05-06 10:00:00', '2015-05-08', '2015-05-08 17:00:00', '\0', '2015-04-03 00:00:00', '80', '300.00', '2', null, '2015-03-02 10:10:10', null);
INSERT INTO `conference` VALUES ('4', 'CommunicAsia 2015 Conference', 'The rising size of mobile workforce and increasingly complex user demands, coupled with the proliferation of connected devices has made this industry more dynamic than ever. It has also blurred the line between work and personal time as seen in the rise of mobility driven innovations such as smart living solutions, wearable technologies and many more.\r\n\r\nAt CommunicAsia2015, the latest innovative technologies from Big Data, Business Analytics, Cloud technologies, IoT, to Zigbee will be unveiled. These advances are poised to change the way we live and work.\r\n\r\nCommunicAsia2015 continues to be THE one-stop venue for the ICT industry', '2015-04-16', '2015-04-16 09:00:00', '2015-04-17', '2015-04-17 16:00:00', '\0', '2015-02-20 00:00:00', '75', '200.00', '1', '0', '2015-03-02 10:04:07', null);
-- ----------------------------
-- Records of conference_field
-- ----------------------------
TRUNCATE TABLE `conference_field`;

INSERT INTO `conference_field` VALUES ('1', '1', '1', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('2', '1', '9', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('3', '1', '14', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('4', '2', '3', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('5', '2', '5', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('6', '2', '14', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('7', '3', '8', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('8', '3', '16', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('9', '3', '17', '1', null, '2015-03-02 10:21:24', null);
INSERT INTO `conference_field` VALUES ('10', '4', '1', '0', null, '2015-03-02 10:37:50', null);
INSERT INTO `conference_field` VALUES ('11', '4', '6', '0', null, '2015-03-02 10:37:50', null);
INSERT INTO `conference_field` VALUES ('12', '4', '16', '0', null, '2015-03-02 10:37:50', null);

-- ----------------------------
-- Records of conference_room_schedule
-- ----------------------------
TRUNCATE TABLE `conference_room_schedule`;

INSERT INTO `conference_room_schedule` VALUES ('1', '1', '1', null, '2015-04-02', '2015-04-03', '2015-04-02 09:00:00', '2015-04-03 16:00:00', null, '0', null, '2015-03-02 11:21:27', null);
INSERT INTO `conference_room_schedule` VALUES ('2', '2', '4', null, '2015-06-04', '2015-06-05', '2015-06-04 09:00:00', '2015-06-05 17:00:00', null, '0', null, '2015-03-02 11:21:27', null);
INSERT INTO `conference_room_schedule` VALUES ('3', '3', '2', null, '2015-05-06', '2015-05-08', '2015-05-06 10:00:00', '2015-05-08 17:00:00', null, '0', null, '2015-03-02 11:21:27', null);
INSERT INTO `conference_room_schedule` VALUES ('4', '4', '5', null, '2015-04-16', '2015-04-17', '2015-04-16 09:00:00', '2015-04-17 17:00:00', null, '0', null, '2015-03-02 11:23:53', null);

-- ----------------------------
-- Records of conference_topic
-- ----------------------------
TRUNCATE TABLE `conference_topic`;

INSERT INTO `conference_topic` VALUES ('1', '1', 'Wireless Communication', '1', '1', '2015-03-02 10:17:52', '2015-03-02 20:26:09');
INSERT INTO `conference_topic` VALUES ('2', '1', 'Networking and Security', '1', '1', '2015-03-02 10:17:52', '2015-03-02 20:26:09');
INSERT INTO `conference_topic` VALUES ('3', '1', 'Current Trend in Wireless Technology', '1', '1', '2015-03-02 10:17:52', '2015-03-02 20:26:09');
INSERT INTO `conference_topic` VALUES ('4', '2', 'Cloud Technology', '2', null, '2015-03-02 10:17:52', null);
INSERT INTO `conference_topic` VALUES ('5', '2', 'Emerging Data Center Architecture', '2', null, '2015-03-02 10:17:52', null);
INSERT INTO `conference_topic` VALUES ('6', '2', 'Server and Storage Evolution', '2', null, '2015-03-02 10:17:52', null);
INSERT INTO `conference_topic` VALUES ('7', '2', 'Changes in Traditional IT Operations', '2', null, '2015-03-02 10:17:52', null);
INSERT INTO `conference_topic` VALUES ('8', '3', 'Data-driven Marketing', '2', null, '2015-03-02 10:17:52', null);
INSERT INTO `conference_topic` VALUES ('9', '3', 'Digital Commerce', '2', null, '2015-03-02 10:17:52', null);
INSERT INTO `conference_topic` VALUES ('10', '3', 'Emerging Marketing Tech & Trends', '2', null, '2015-03-02 10:17:52', null);
INSERT INTO `conference_topic` VALUES ('11', '4', 'Big Data', '0', null, '2015-03-02 10:35:07', null);
INSERT INTO `conference_topic` VALUES ('12', '4', 'Business Technology', '0', null, '2015-03-02 10:35:07', null);
INSERT INTO `conference_topic` VALUES ('13', '4', 'Cloud Technology', '0', null, '2015-03-02 10:35:07', null);

-- ----------------------------
-- Records of confuserrole
-- ----------------------------
TRUNCATE TABLE `confuserrole`;

INSERT INTO `confuserrole` VALUES ('1', '4', '1', '1');
INSERT INTO `confuserrole` VALUES ('2', '4', '2', '3');
INSERT INTO `confuserrole` VALUES ('3', '4', '2', '2');
INSERT INTO `confuserrole` VALUES ('4', '7', '1', '3');
INSERT INTO `confuserrole` VALUES ('5', '4', '2', '4');
INSERT INTO `confuserrole` VALUES ('6', '7', '3', '1');
INSERT INTO `confuserrole` VALUES ('7', '7', '3', '2');
INSERT INTO `confuserrole` VALUES ('8', '7', '3', '3');
INSERT INTO `confuserrole` VALUES ('9', '7', '3', '4');
INSERT INTO `confuserrole` VALUES ('11', '4', '2', '3');
INSERT INTO `confuserrole` VALUES ('12', '8', '2', '1');
INSERT INTO `confuserrole` VALUES ('13', '8', '2', '1');

-- ----------------------------
-- Records of countries
-- ----------------------------
TRUNCATE TABLE `countries`;

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
-- Records of equipment
-- ----------------------------
TRUNCATE TABLE `equipment`;

INSERT INTO `equipment` VALUES ('1', '4', 'Brown Chair (vintage)', '60 cm tall, 20 cm wide', null, '4', '4', '2015-02-28 06:10:15', null, 'Pending');
INSERT INTO `equipment` VALUES ('2', '4', 'Dining Table ', '90 cm diameter', null, '4', '4', '2015-02-28 06:10:15', null, 'Approved');
INSERT INTO `equipment` VALUES ('3', '5', 'Projector Screen ', '10 by 10 Meters', null, '4', '6', '2015-02-28 06:10:15', null, 'Approved');
INSERT INTO `equipment` VALUES ('4', '6', 'Surround Sound System  (Black) ', 'Sony Surrounding Sound System ', null, '4', '6', '2015-02-28 06:10:15', null, 'Approved');
INSERT INTO `equipment` VALUES ('5', '7', 'Conference Round Table', 'This is a VIP room', null, '4', null, '2015-02-28 06:13:55', null, 'Approved');
INSERT INTO `equipment` VALUES ('6', '8', 'Mic', 'Big Room', null, '4', null, '2015-02-28 06:13:55', null, 'Approved');

-- ----------------------------
-- Records of equipment_category
-- ----------------------------
TRUNCATE TABLE `equipment_category`;

INSERT INTO `equipment_category` VALUES ('4', 'Logisitc', null, '4', null, '2015-02-28 03:10:15', '2015-02-28 06:17:15', 'Approved');
INSERT INTO `equipment_category` VALUES ('5', 'Technical', null, '4', null, '2015-02-28 03:10:15', '2015-02-28 06:17:18', 'Approved');
INSERT INTO `equipment_category` VALUES ('6', 'Audio', null, '4', null, '2015-02-28 03:10:15', '2015-02-28 06:17:21', 'Approved');
INSERT INTO `equipment_category` VALUES ('7', 'Dining Equipment', null, '4', null, '2015-02-28 03:13:55', '2015-02-28 06:17:33', 'Approved');
INSERT INTO `equipment_category` VALUES ('8', 'Sound Equipment', null, '4', null, '2015-02-28 03:13:55', '2015-02-28 06:17:30', 'Approved');
INSERT INTO `equipment_category` VALUES ('11', 'Logistic', null, '4', null, '2015-02-28 03:43:11', '2015-02-28 06:43:11', 'Pending');

-- ----------------------------
-- Records of interest_field
-- ----------------------------
TRUNCATE TABLE `interest_field`;


INSERT INTO `interest_field` VALUES ('1', 'Computer Science', null, '1', null, '2015-01-14 14:48:26', null);
INSERT INTO `interest_field` VALUES ('2', 'Artificial Intelligence', null, '1', null, '2015-01-14 14:48:35', null);
INSERT INTO `interest_field` VALUES ('3', 'Databases', null, '1', null, '2015-01-14 14:48:45', null);
INSERT INTO `interest_field` VALUES ('4', 'Human-Computer Interaction', null, '1', null, '2015-01-14 14:48:57', null);
INSERT INTO `interest_field` VALUES ('5', 'Computer Security', null, '1', null, '2015-01-14 14:49:03', null);
INSERT INTO `interest_field` VALUES ('6', 'Internet Technology', null, '1', null, '2015-01-14 14:49:08', null);
INSERT INTO `interest_field` VALUES ('7', 'Open Source', null, '1', null, '2015-01-14 14:49:28', null);
INSERT INTO `interest_field` VALUES ('8', 'E-commerce', null, '1', null, '2015-01-14 14:49:38', null);
INSERT INTO `interest_field` VALUES ('9', 'Networking', null, '1', null, '2015-01-14 14:49:38', null);
INSERT INTO `interest_field` VALUES ('10', 'Mobile Technology', null, '1', null, '2015-01-14 14:49:38', null);
INSERT INTO `interest_field` VALUES ('11', 'Virtual Reality', null, '1', null, '2015-02-26 12:36:42', null);
INSERT INTO `interest_field` VALUES ('12', 'Bio-technology', null, '1', null, '2015-02-26 12:36:42', null);
INSERT INTO `interest_field` VALUES ('13', 'Robotics', null, '1', null, '2015-02-26 12:36:42', null);
INSERT INTO `interest_field` VALUES ('14', 'System and Hardware', null, '1', null, '2015-02-26 12:36:42', null);
INSERT INTO `interest_field` VALUES ('15', 'Devices and Engine', null, '1', null, '2015-02-26 12:36:42', null);
INSERT INTO `interest_field` VALUES ('16', 'Data Science', null, '1', null, '2015-02-26 12:40:22', null);
INSERT INTO `interest_field` VALUES ('17', 'Machine Learning', null, '1', null, '2015-02-26 12:40:22', null);
INSERT INTO `interest_field` VALUES ('18', 'Software', null, '1', null, '2015-02-26 12:41:07', null);
INSERT INTO `interest_field` VALUES ('19', 'Visual Effects', null, '1', null, '2015-02-26 12:41:07', null);
INSERT INTO `interest_field` VALUES ('20', 'Hacking', null, '1', null, '2015-02-26 12:42:14', null);
INSERT INTO `interest_field` VALUES ('21', 'Other', null, '1', null, '2015-02-26 12:42:14', null);

-- ----------------------------
-- Records of invoice
-- ----------------------------
TRUNCATE TABLE `invoice`;

INSERT INTO `invoice` VALUES ('1', '2', '1', '10', '0', 'ticket', '2', null, '2015-03-02 19:52:04', '2015-03-02 19:52:25', '2000', 'paid');
INSERT INTO `invoice` VALUES ('2', '2', '1', '10', '0', 'ticket', '2', null, '2015-03-02 19:53:01', '2015-03-02 19:53:18', '2000', 'paid');

-- ----------------------------
-- Records of keywords
-- ----------------------------
TRUNCATE TABLE `keywords`;

INSERT INTO `keywords` VALUES ('17', 'penguin', '4', '0', null, '2015-03-02 20:17:14', '2015-03-02 20:17:14');
INSERT INTO `keywords` VALUES ('18', ' sell', '4', '0', null, '2015-03-02 20:17:14', '2015-03-02 20:17:14');
INSERT INTO `keywords` VALUES ('19', ' market', '4', '0', null, '2015-03-02 20:17:14', '2015-03-02 20:17:14');
INSERT INTO `keywords` VALUES ('20', 'data center', '3', '0', null, '2015-03-02 20:17:42', '2015-03-02 20:17:42');
INSERT INTO `keywords` VALUES ('21', ' cold', '3', '0', null, '2015-03-02 20:17:42', '2015-03-02 20:17:42');
INSERT INTO `keywords` VALUES ('22', ' clean', '3', '0', null, '2015-03-02 20:17:42', '2015-03-02 20:17:42');
INSERT INTO `keywords` VALUES ('23', ' tidy', '3', '0', null, '2015-03-02 20:17:42', '2015-03-02 20:17:42');
INSERT INTO `keywords` VALUES ('28', 'WiFi', '2', '0', null, '2015-03-02 20:19:01', '2015-03-02 20:19:01');
INSERT INTO `keywords` VALUES ('29', 'RFID', '2', '0', null, '2015-03-02 20:19:01', '2015-03-02 20:19:01');
INSERT INTO `keywords` VALUES ('30', 'cloud', '1', '0', null, '2015-03-02 20:21:40', '2015-03-02 20:21:40');
INSERT INTO `keywords` VALUES ('31', 'data center', '1', '0', null, '2015-03-02 20:21:40', '2015-03-02 20:21:40');
INSERT INTO `keywords` VALUES ('32', 'trends', '1', '0', null, '2015-03-02 20:21:40', '2015-03-02 20:21:40');
INSERT INTO `keywords` VALUES ('33', 'wireless', '5', '0', null, '2015-03-02 20:46:59', '2015-03-02 20:46:59');
INSERT INTO `keywords` VALUES ('34', 'education', '5', '0', null, '2015-03-02 20:46:59', '2015-03-02 20:46:59');
INSERT INTO `keywords` VALUES ('35', 'complexities', '6', '0', null, '2015-03-02 20:49:48', '2015-03-02 20:49:48');
INSERT INTO `keywords` VALUES ('36', 'studies', '6', '0', null, '2015-03-02 20:49:48', '2015-03-02 20:49:48');
INSERT INTO `keywords` VALUES ('37', 'analysis', '6', '0', null, '2015-03-02 20:49:48', '2015-03-02 20:49:48');

-- ----------------------------
-- Records of payment
-- ----------------------------
TRUNCATE TABLE `payment`;

INSERT INTO `payment` VALUES ('1', '1', '2000', '0', '2', null, '2015-03-02 19:52:25', '2015-03-02 19:52:25');
INSERT INTO `payment` VALUES ('2', '2', '2000', '0', '2', null, '2015-03-02 19:53:18', '2015-03-02 19:53:18');

-- ----------------------------
-- Records of profiles
-- ----------------------------
TRUNCATE TABLE `profiles`;

INSERT INTO `profiles` VALUES ('1', '', '1', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', null, null);
INSERT INTO `profiles` VALUES ('2', '', '2', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', null, null);
INSERT INTO `profiles` VALUES ('3', '', '3', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', null, null);
INSERT INTO `profiles` VALUES ('4', '', '4', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', null, null);
INSERT INTO `profiles` VALUES ('5', '', '5', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', null, null);
INSERT INTO `profiles` VALUES ('6', '', '6', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', null, null);
INSERT INTO `profiles` VALUES ('7', 'pohjun.ng@gmail.com', '7', '10152916861920967', 'CAAV2KrdSapcBAOaIiG4F7eGmwVC5XpMUFSWWshHKR84zpJfpz7MPMUG9zucZCOAsGZA7zRsKersHdUVyC0vLTXngE3YYDo0IgrIZCkfGthrJpAnzZCgZBFbNr4ioAwEWUaVIVHwhRsZAdHj3YWL4L1jZBkTBZBcteklZBeJyw3jEZA9nbrDfO9o0K5xRZCuMxd8TqTKobmmSKTqKqjTCo8vL37l', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hello world!', 'Singapore', 'https://graph.facebook.com/10152916861920967/picture?type=normal');
INSERT INTO `profiles` VALUES ('8', 'duomax8668@hotmail.com', '8', '10153082278326070', 'CAAV2KrdSapcBAAcJsmDpJByN7RMDDfuPrn7sRG5Du4dHXVZAlxpQDp0R9J3r5xZBOZAVEYiylN0xgCnEL5maWoNuUv7SVrTv1dTHd8Wgs5ttKCj2nUBDR6pTiGrAsYdVDXXTinFykanLiVEYqG8vZAYQE95ndE32yTSTmcvSZBaPp2YQZCmHOQOn5bOJSBJ2TRGkyoxFEJXEv8ot4uZAZCyE', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', null, 'https://graph.facebook.com/10153082278326070/picture?type=normal');

-- ----------------------------
-- Records of reviews
-- ----------------------------
TRUNCATE TABLE `reviews`;

INSERT INTO `reviews` VALUES ('1', '4', '3', 'Not sure whether should accept or reject', 'Need more work to make it better quality paper', '6', '8', '7', '8', '7', '0', null, '2015-03-02 20:11:41', '2015-03-02 20:11:41');
INSERT INTO `reviews` VALUES ('2', '3', '3', 'highly recommend to accept', 'This is well-written paper', '8', '8', '8', '7', '9', '0', null, '2015-03-02 20:12:19', '2015-03-02 20:12:19');
INSERT INTO `reviews` VALUES ('3', '1', '3', 'highly recommend to accept', 'Unexpectedly good. Not that relevant to the topic but it is pretty interesting', '8', '7', '8', '9', '9', '0', null, '2015-03-02 20:14:12', '2015-03-02 20:14:12');
INSERT INTO `reviews` VALUES ('4', '2', '3', 'Let\'s reject this one. It needs a lot of rewriting', 'I don\'t really understand what the paper is trying to say here', '5', '6', '5', '4', '5', '0', null, '2015-03-02 20:14:48', '2015-03-02 20:14:48');
INSERT INTO `reviews` VALUES ('5', '6', '3', 'We can accept this paper', 'It is a well written paper, but lacks originality', '9', '9', '6', '10', '8', '0', null, '2015-03-02 20:52:21', '2015-03-02 20:52:21');
INSERT INTO `reviews` VALUES ('6', '5', '3', 'Might be good to accept this paper.', 'Might be better if it\'s presented as a poster instead. But still, it\'s pretty alright.', '8', '8', '8', '9', '10', '0', null, '2015-03-02 20:53:44', '2015-03-02 20:53:44');

-- ----------------------------
-- Records of roles
-- ----------------------------
TRUNCATE TABLE `roles`;

INSERT INTO `roles` VALUES ('1', 'User', 'normal user');
INSERT INTO `roles` VALUES ('2', 'Resource Provider', 'resource provider');
INSERT INTO `roles` VALUES ('3', 'Admin', 'super admin account');
INSERT INTO `roles` VALUES ('4', 'Conference Chair', 'organizer');
INSERT INTO `roles` VALUES ('5', 'Conference Staff', 'staff');
INSERT INTO `roles` VALUES ('6', 'Author', 'author');
INSERT INTO `roles` VALUES ('7', 'Reviewer', 'reviewer');
INSERT INTO `roles` VALUES ('8', 'Participant', 'participant');

-- ----------------------------
-- Records of room
-- ----------------------------
TRUNCATE TABLE `room`;

INSERT INTO `room` VALUES ('1', '1', 'Hall 1', '400', '800.00', '4', null, '2015-02-28 03:10:15', '2015-02-28 06:10:15', 'yes');
INSERT INTO `room` VALUES ('2', '1', 'Hall 2', '450', '2000.00', '4', null, '2015-02-28 03:10:15', '2015-02-28 06:10:15', 'yes');
INSERT INTO `room` VALUES ('3', '1', 'Hall 3', '800', '4000.00', '4', null, '2015-02-28 03:10:15', '2015-02-28 06:10:15', 'yes');
INSERT INTO `room` VALUES ('4', '2', 'Room A', '80', '650.00', '4', null, '2015-02-28 03:13:55', '2015-02-28 06:13:55', 'yes');
INSERT INTO `room` VALUES ('5', '2', 'Room B', '70', '800.00', '4', null, '2015-02-28 03:13:55', '2015-02-28 06:13:55', 'yes');
INSERT INTO `room` VALUES ('6', '3', 'Sapphire', '800', '650.00', '4', null, '2015-02-28 03:23:31', '2015-02-28 06:23:31', 'yes');
INSERT INTO `room` VALUES ('7', '3', 'Topaz', '900', '800.00', '4', null, '2015-02-28 03:23:31', '2015-02-28 06:23:31', 'yes');
INSERT INTO `room` VALUES ('8', '3', 'Ruby', '1000', '950.00', '4', null, '2015-02-28 03:23:31', '2015-02-28 06:23:31', 'yes');
INSERT INTO `room` VALUES ('9', '3', 'Crystal', '1100', '1100.00', '4', null, '2015-02-28 03:23:31', '2015-02-28 06:23:31', 'yes');
INSERT INTO `room` VALUES ('10', '3', 'Diamond', '1200', '1250.00', '4', null, '2015-02-28 03:23:31', '2015-02-28 06:23:31', 'yes');
INSERT INTO `room` VALUES ('25', '4', 'Reservoir Hall 1', '800', '1000.00', '4', '4', '2015-02-28 03:43:11', '2015-02-28 06:43:53', 'yes');
INSERT INTO `room` VALUES ('26', '5', 'Conference Room A', '80', '650.00', '4', null, '2015-02-28 05:56:17', '2015-02-28 08:56:17', 'yes');
INSERT INTO `room` VALUES ('27', '5', 'Hall AAA', '500', '1200.00', '4', null, '2015-02-28 06:03:18', '2015-02-28 09:03:18', 'yes');

-- ----------------------------
-- Records of room_equipment
-- ----------------------------
TRUNCATE TABLE `room_equipment`;

INSERT INTO `room_equipment` VALUES ('1', '1', '1', '400', null, '0', null, '2015-02-28 06:10:15', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('2', '1', '2', '50', null, '0', null, '2015-02-28 06:10:15', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('3', '2', '1', '800', null, '0', null, '2015-02-28 06:10:15', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('4', '2', '3', '2', null, '0', null, '2015-02-28 06:10:15', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('5', '3', '4', '6', null, '0', null, '2015-02-28 06:10:15', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('6', '4', '5', '650', null, '0', null, '2015-02-28 06:13:55', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('7', '5', '6', '4', null, '0', null, '2015-02-28 06:13:55', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('8', '6', '5', '650', null, '0', null, '2015-02-28 06:23:31', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('9', '7', '6', '4', null, '0', null, '2015-02-28 06:23:31', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('11', '25', '5', '40', null, '0', null, '2015-02-28 06:43:53', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('12', '25', '4', '5', null, '0', null, '2015-02-28 06:43:53', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('13', '26', '5', '650', null, '0', null, '2015-02-28 08:56:17', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('14', '27', '4', ' 1', null, '0', null, '2015-02-28 09:03:19', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('15', '27', '6', ' 2', null, '0', null, '2015-02-28 09:03:19', null, 'Pending');
INSERT INTO `room_equipment` VALUES ('16', '27', '1', ' 40', null, '0', null, '2015-02-28 09:03:19', null, 'Pending');

-- ----------------------------
-- Records of submissions
-- ----------------------------
TRUNCATE TABLE `submissions`;

INSERT INTO `submissions` VALUES ('1', '1', '2', '1', 'Effect of Cloud Technology in Data Centers', 'As part of its Library Spaces Business Plan initiative, Edmonton Public Library (EPL) conducted interviews paired with photo elicitation to explore customers’ perceptions of their library spaces and to better understand how customers use those spaces. Sixteen interviews were conducted with participants at 5 branches of the EPL with participants taking photographs used during the interview. Findings revealed the comprehensive views participants’ hold about the library; the library’s spaces are not distinct from the collections and services offered within them.', 'uploads/503228.pdf', '', '0', '82', '0', '1', '2015-03-02 11:47:58', '2015-03-02 20:21:40');
INSERT INTO `submissions` VALUES ('2', '7', '1', '1', 'Effect of Wireless Technology in Society', 'Essentially three approaches could be identiﬁed when choosing a proper search term to detect bibliographic duplicates. Stop words are excluded in all of them, then (1) just the ﬁrst term of an entry will be selected or (2) that term is selected, which produces the smallest number of hits or ﬁnally (3) that term will be used, which has a certain number of hits below a deﬁned threshold. These three procedures are compared with each other here. The results derive from series of measurements done with bibliographic data from the Austrian Central Catalog.', 'uploads/503228.pdf', '', '9', '50', '7', '1', '2015-03-02 11:47:58', '2015-03-02 20:36:11');
INSERT INTO `submissions` VALUES ('3', '7', '2', '1', 'Managing Data Center', 'This study aimed to investigate the relationship between the different learning styles of Thai youths and their information behavior at a time where rapidly developing information and communication technology has affected the informational environment. This was a qualitative research study which used theoretical sampling to select study areas and involved thirty participants in their fourth, fifth and sixth year in a large secondary school. The Grasha-Riechmann Student Learning Style Scale was used to determine the students’ learning styles. The results indicated that learning styles affected information behavior only slightly because the collaborative style of Thai youths was to divide the task and work individually. Information behavior was best examined at a personal level.', 'uploads/579779.pdf', 'Additional remarks for data center', '0', '80', '0', '7', '2015-03-02 19:42:04', '2015-03-02 20:17:42');
INSERT INTO `submissions` VALUES ('4', '7', '3', '1', 'B2C Marketing', 'Thailand suffers from frequent flooding during the monsoon season and droughts in summer. In some places, severe cases of both may even occur. Managing water resources effectively requires a good information system for decision-making. There is currently a lack in knowledge sharing between organizations and researchers responsible. These are the experts in monitoring and controlling the water supply and its conditions. The knowledge owned by these experts are not captured, classified and integrated into an information system for decision-making. Ontologies are formal knowledge representation models. Knowledge management and artificial intelligence technology is a basic requirement for developing ontology-based semantic search on the Web. In this paper, we present ontology modeling approach that is based on the experiences of the researchers. The ontology for drought management consists of River Basin Ontology, Statistics Ontology and Task Ontology to facilitate semantic match during search. The hybrid ontology architecture can also be used for drought management.', 'uploads/128092.pdf', 'Add remarks to penguin', '0', '72', '0', '7', '2015-03-02 19:46:55', '2015-03-02 20:17:14');
INSERT INTO `submissions` VALUES ('5', '7', '1', '1', 'Usage of Wireless Technology in Education', 'Given the budgetary and technological changes facing academic libraries, it has become necessary for librarians to become self-advocates, describing and defending the work they do. Most research in this area is dedicated to public services, with little focus on technical services. A survey conducted in the fall of 2009 found that catalogers in the sample state of New Jersey collect detailed productivity statistics to illustrate their value. This paper analyzes the statistics-gathering process and makes suggestions for developing these methods into a strong assessment model. Quality control assessment is the tool catalogers need to describe their worth to library stakeholders.', 'uploads/858208.pdf', '', '1', '86', '0', null, '2015-03-02 20:46:59', '2015-03-02 20:53:44');
INSERT INTO `submissions` VALUES ('6', '7', '1', '2', 'Complexities of Networking', 'This paper constitutes a trial of a game- and decision-theory based approach that is intended to examine elements of the complexities of scholarly communication as an economic endeavor. Both individual and institutional kinds of games are analyzed in order to determine what factors would affect the real economic use of game and decision theories. There are interrelationships between the two kinds that add complexity to any possible application. Further, this analysis includes ideal and practical factors that affect real economic application. As is shown here, there are serious challenges to application of the theories, but also important indicators for the furtherance of individual and institutional interests by means of negotiation.', 'uploads/810167.pdf', '', '1', '84', '0', null, '2015-03-02 20:49:48', '2015-03-02 20:52:21');

-- ----------------------------
-- Records of submission_authors
-- ----------------------------
TRUNCATE TABLE `submission_authors`;

INSERT INTO `submission_authors` VALUES ('1', 'hedrensum@ntu.edu.sg', 'Hedren', 'Sum', 'NTU', '0', '0', null, '2015-03-02 11:47:59', '2015-03-02 11:47:59');
INSERT INTO `submission_authors` VALUES ('1', 'joanwee@ntu.edu.sg', 'Joan ', 'Wee', 'NTU', '1', '0', null, '2015-03-02 11:47:59', '2015-03-02 11:47:59');
INSERT INTO `submission_authors` VALUES ('2', 'trafalgar@ntu.edu.sg', 'Trafalgar', 'Law', 'Heart Pirates', '1', '7', null, '2015-03-02 11:47:59', '2015-03-02 11:47:59');
INSERT INTO `submission_authors` VALUES ('3', 'pohjun.ng@gmail.com', 'Nico', 'Wayne', 'BATMAN', '1', '0', null, '2015-03-02 19:42:04', '2015-03-02 19:42:04');
INSERT INTO `submission_authors` VALUES ('4', 'monkeypenguin@gmail.com', 'Monkey', 'Penguin', 'Animal Kingdom', '0', '0', null, '2015-03-02 19:46:55', '2015-03-02 19:46:55');
INSERT INTO `submission_authors` VALUES ('4', 'olivia@gmail.com', 'Nico', 'Olivia', 'BATMANNNN', '1', '0', null, '2015-03-02 19:46:55', '2015-03-02 19:46:55');
INSERT INTO `submission_authors` VALUES ('5', 'basil@email.com', 'Basil', 'Hawkins', 'SMU', '1', '0', null, '2015-03-02 20:46:59', '2015-03-02 20:46:59');
INSERT INTO `submission_authors` VALUES ('5', 'drake@email.com', 'Drake', 'Hawkins', 'SMU', '0', '0', null, '2015-03-02 20:46:59', '2015-03-02 20:46:59');
INSERT INTO `submission_authors` VALUES ('6', 'anne@email.com', 'Anne', 'Bonney', 'EBSCO', '1', '0', null, '2015-03-02 20:49:48', '2015-03-02 20:49:48');
INSERT INTO `submission_authors` VALUES ('6', 'jewelry@email.com', 'Jewelry', 'Bonney', 'EBSCO', '1', '0', null, '2015-03-02 20:49:48', '2015-03-02 20:49:48');

-- ----------------------------
-- Records of submission_topic
-- ----------------------------
TRUNCATE TABLE `submission_topic`;

INSERT INTO `submission_topic` VALUES ('1', '2', '0', null, '2015-03-02 20:19:01', '2015-03-02 20:19:01');
INSERT INTO `submission_topic` VALUES ('2', '2', '0', null, '2015-03-02 20:19:01', '2015-03-02 20:19:01');
INSERT INTO `submission_topic` VALUES ('2', '6', '0', null, '2015-03-02 20:49:48', '2015-03-02 20:49:48');
INSERT INTO `submission_topic` VALUES ('3', '5', '0', null, '2015-03-02 20:46:59', '2015-03-02 20:46:59');
INSERT INTO `submission_topic` VALUES ('4', '1', '0', null, '2015-03-02 20:21:40', '2015-03-02 20:21:40');
INSERT INTO `submission_topic` VALUES ('4', '3', '0', null, '2015-03-02 20:17:42', '2015-03-02 20:17:42');
INSERT INTO `submission_topic` VALUES ('5', '3', '0', null, '2015-03-02 20:17:42', '2015-03-02 20:17:42');
INSERT INTO `submission_topic` VALUES ('7', '1', '0', null, '2015-03-02 20:21:41', '2015-03-02 20:21:41');
INSERT INTO `submission_topic` VALUES ('9', '4', '0', null, '2015-03-02 20:17:14', '2015-03-02 20:17:14');
INSERT INTO `submission_topic` VALUES ('10', '4', '0', null, '2015-03-02 20:17:14', '2015-03-02 20:17:14');

-- ----------------------------
-- Records of sysrole
-- ----------------------------
TRUNCATE TABLE `sysrole`;

INSERT INTO `sysrole` VALUES ('2', '1', '1');
INSERT INTO `sysrole` VALUES ('3', '2', '1');
INSERT INTO `sysrole` VALUES ('4', '3', '1');
INSERT INTO `sysrole` VALUES ('5', '4', '2');
INSERT INTO `sysrole` VALUES ('6', '5', '1');
INSERT INTO `sysrole` VALUES ('7', '6', '3');
INSERT INTO `sysrole` VALUES ('8', '7', '1');
INSERT INTO `sysrole` VALUES ('9', '8', '1');

-- ----------------------------
-- Records of users
-- ----------------------------
TRUNCATE TABLE `users`;

INSERT INTO `users` VALUES ('1', 'Chair', 'Bella', 'bella.ratmelia@gmail.com', null, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', '', 'ONVb8ZWU9y5eiEgJUykDZef3bNcOBGcJaltAyqxh0nIddjRKgUB3hNiL8uqa', '', '1', '2015-02-25 09:39:34', '2015-03-02 20:43:22');
INSERT INTO `users` VALUES ('2', 'Noverinda', 'Bella', 'bella.ratmelia@hotmail.com', null, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', null, 'qTUi6lFiE1BSvInj8cNNe8QIGbWuGybuHHbKPxKix3Rh5gDhuHbC4F8aApZY', '', '1', '2015-02-25 09:41:44', '2015-03-02 20:10:07');
INSERT INTO `users` VALUES ('3', 'Reviewer', 'Thomas', 'batmanray@live.com.sg', null, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', null, 'svwL5xzPpxs6Kc2bWOWpdGvoRAOu9b9r0LtgtOrdVuepbqaYsts5KSwcIBsz', '', '1', '2015-02-25 09:42:27', '2015-03-02 20:53:52');
INSERT INTO `users` VALUES ('4', 'Resource Provider', 'Poh Jun', 'pohjun.ng@hotmail.sg', null, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', null, 'OAFui30DFcVZ7eJGKeGhfPfZdYliVlXCeYqBHFXFwPKcildbRb1R86v3wCHq', null, '1', '2015-02-25 09:54:47', '2015-03-01 13:46:52');
INSERT INTO `users` VALUES ('5', 'Participant', 'Thomas', 'thomas.leera@gmail.com', null, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', null, 'gEw8IIEI4SenwQ9VzZeTF4u3Wr1lxifmpKVz2AcGECXNqdxXEIQYZoEYeYy8', '', '1', '2015-02-25 09:57:17', '2015-02-28 09:49:41');
INSERT INTO `users` VALUES ('6', 'admin', 'orafer', 'admin@orafer.com', null, '$2y$10$kX/HtiXsmoojqsfy9.Q5zeGt9EjodjK1SerS7iE4EH542w5r7vdUu', null, 'Nrls3KOvdbl96Gec6uaAUpxdpmL5XrysJ7XCP6sqvhQR32dWzU0TZJdNWBE5', '', '1', '2015-02-25 09:58:48', '2015-02-28 08:50:58');
INSERT INTO `users` VALUES ('7', 'Author', 'Ng Poh Jun', 'pohjun.ng@gmail.com', null, '$2y$10$x8mmQ4BF/IAoGMSNZ3BkjegqeUen8j/mQRAXV6aJJj29tqrH8BAOq', null, 'gFVEGapFzAtPjzR1imT9BYNmn0TWLCMgbHJrahknOEUJI4xdKSdkHRkAweYG', '', '1', '2015-02-25 10:15:30', '2015-03-02 20:50:05');
INSERT INTO `users` VALUES ('8', 'Shinn', 'Lee', 'duomax8668@hotmail.com', null, '$2y$10$ZB7PnzrlK4g8q.wAO6rjyexJxMg4zZzDaTg3wLNBCshP7lfM1DB9q', null, 'LnMWh8MxQdD7LmEKwf6Buk6zWZvVkKem4X5OvOD4H4aYInMBT2qmjfH3lHNf', null, '1', '2015-02-28 07:06:18', '2015-02-28 09:11:16');

-- ----------------------------
-- Records of venue
-- ----------------------------
TRUNCATE TABLE `venue`;

INSERT INTO `venue` VALUES ('1', 'Marina Bay Sand', 'Singapore Marina Bay Sands', '1.2838785', '103.85899', '4', null, '2015-02-28 03:10:15', '2015-02-28 06:10:15', '1', 'yes');
INSERT INTO `venue` VALUES ('2', 'Singapore Expo', 'Singapore Expo', '1.334632', '103.961381', '4', null, '2015-02-28 03:13:55', '2015-02-28 06:13:55', '1', 'yes');
INSERT INTO `venue` VALUES ('3', 'SIM UOW', 'Singapore Institude of Management', '1.296864', '103.800775', '4', null, '2015-02-28 03:23:31', '2015-02-28 06:23:31', '1', 'yes');
INSERT INTO `venue` VALUES ('4', 'The M Hotel', 'Singapore Bedok Reservoir ', '1.3413025', '103.9245499', '4', null, '2015-02-28 03:43:11', '2015-02-28 06:43:11', '1', 'yes');
INSERT INTO `venue` VALUES ('5', 'NTU', 'Nanyang Technological University ', '1.3483099', '103.6831347', '4', null, '2015-02-28 05:56:17', '2015-02-28 08:56:17', '1', 'yes');
DROP TRIGGER IF EXISTS `conference_BEFORE_INSERT`;
DELIMITER ;;
CREATE TRIGGER `conference_BEFORE_INSERT` BEFORE INSERT ON `conference` FOR EACH ROW IF(NEW.cutoff_time IS NULL) THEN
BEGIN
SET NEW.cutoff_time = DATE_SUB(DATE_ADD(DATE_ADD(NEW.begin_date, INTERVAL 1 MONTH), INTERVAL 1 DAY), INTERVAL 1 second) ;
END;
END if
;;
DELIMITER ;
