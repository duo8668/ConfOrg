-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2015 at 05:13 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=0; 

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `orafer_maindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--
drop table if exists `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `Company_id` int(11) NOT NULL AUTO_INCREMENT,
  `Company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_name`) VALUES
( 'SingEx Venues'),
('Rock Productions'),
( 'Suntec Singapore'),
('Marina Bay Sands');

-- --------------------------------------------------------

--
-- Table structure for table `company_user`
--
drop table if exists `company_user`;
CREATE TABLE IF NOT EXISTS `company_user` (
  `company_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Table structure for table `conference`
--
drop table if exists `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` date NOT NULL,
  `begin_time` datetime NOT NULL,
  `end_date` date NOT NULL,
  `end_time` datetime NOT NULL,
  `is_free` bit(1) NOT NULL DEFAULT b'0',
  `cutoff_time` datetime DEFAULT NULL,
  `min_score` double DEFAULT NULL,
  `ticket_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Triggers `conference`
--
DROP TRIGGER IF EXISTS `conference_BEFORE_INSERT`;
DELIMITER //
CREATE TRIGGER `conference_BEFORE_INSERT` BEFORE INSERT ON `conference`
 FOR EACH ROW IF(NEW.cutoff_time IS NULL) THEN
BEGIN
SET NEW.cutoff_time = DATE_SUB(DATE_ADD(DATE_ADD(NEW.begin_date, INTERVAL 1 MONTH), INTERVAL 1 DAY), INTERVAL 1 second) ;
END;
END if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_cancel`
--
drop table if exists `conference_cancel`;
CREATE TABLE IF NOT EXISTS `conference_cancel` (
  `conference_cancel_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`conference_cancel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_field`
--
drop table if exists `conference_field`;
CREATE TABLE IF NOT EXISTS `conference_field` (
  `conferencefield_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `interestfield_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conferencefield_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



--
-- Table structure for table `conference_room_schedule`
--
drop table if exists `conference_room_schedule`;
CREATE TABLE IF NOT EXISTS `conference_room_schedule` (
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`confroomschedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Table structure for table `conference_schedule_event`
--
drop table if exists `conference_schedule_event`;
CREATE TABLE IF NOT EXISTS `conference_schedule_event` (
  `conference_schedule_event_id` int(11) NOT NULL AUTO_INCREMENT,
  `conference_room_schedule_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `day` date NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `className` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`conference_schedule_event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `conference_topic`
--
drop table if exists `conference_topic`;
CREATE TABLE IF NOT EXISTS `conference_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `topic_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Table structure for table `confuserrole`
--
drop table if exists `confuserrole`;
CREATE TABLE IF NOT EXISTS `confuserrole` (
  `confuserrole_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `conf_id` int(11) NOT NULL,
  PRIMARY KEY (`confuserrole_id`),
  KEY `confuserrole_role_id_index_01` (`role_id`),
  KEY `confuserrole_user_id_index_02` (`user_id`),
  KEY `confuserrole_ibfk_1` (`conf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `countries`
--
drop table if exists `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT,
  `short_name` varchar(80) NOT NULL DEFAULT '',
  `long_name` varchar(80) NOT NULL DEFAULT '',
  `calling_code` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `short_name`, `long_name`, `calling_code`) VALUES
(1, 'Afghanistan', 'Islamic Republic of Afghanistan', '93'),
(2, 'Aland Islands', '&Aring;land Islands', '358'),
(3, 'Albania', 'Republic of Albania', '355'),
(4, 'Algeria', 'People''s Democratic Republic of Algeria', '213'),
(5, 'American Samoa', 'American Samoa', '1+684'),
(6, 'Andorra', 'Principality of Andorra', '376'),
(7, 'Angola', 'Republic of Angola', '244'),
(8, 'Anguilla', 'Anguilla', '1+264'),
(9, 'Antarctica', 'Antarctica', '672'),
(10, 'Antigua and Barbuda', 'Antigua and Barbuda', '1+268'),
(11, 'Argentina', 'Argentine Republic', '54'),
(12, 'Armenia', 'Republic of Armenia', '374'),
(13, 'Aruba', 'Aruba', '297'),
(14, 'Australia', 'Commonwealth of Australia', '61'),
(15, 'Austria', 'Republic of Austria', '43'),
(16, 'Azerbaijan', 'Republic of Azerbaijan', '994'),
(17, 'Bahamas', 'Commonwealth of The Bahamas', '1+242'),
(18, 'Bahrain', 'Kingdom of Bahrain', '973'),
(19, 'Bangladesh', 'People''s Republic of Bangladesh', '880'),
(20, 'Barbados', 'Barbados', '1+246'),
(21, 'Belarus', 'Republic of Belarus', '375'),
(22, 'Belgium', 'Kingdom of Belgium', '32'),
(23, 'Belize', 'Belize', '501'),
(24, 'Benin', 'Republic of Benin', '229'),
(25, 'Bermuda', 'Bermuda Islands', '1+441'),
(26, 'Bhutan', 'Kingdom of Bhutan', '975'),
(27, 'Bolivia', 'Plurinational State of Bolivia', '591'),
(28, 'Bonaire, Sint Eustatius and Saba', 'Bonaire, Sint Eustatius and Saba', '599'),
(29, 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', '387'),
(30, 'Botswana', 'Republic of Botswana', '267'),
(31, 'Bouvet Island', 'Bouvet Island', 'NONE'),
(32, 'Brazil', 'Federative Republic of Brazil', '55'),
(33, 'British Indian Ocean Territory', 'British Indian Ocean Territory', '246'),
(34, 'Brunei', 'Brunei Darussalam', '673'),
(35, 'Bulgaria', 'Republic of Bulgaria', '359'),
(36, 'Burkina Faso', 'Burkina Faso', '226'),
(37, 'Burundi', 'Republic of Burundi', '257'),
(38, 'Cambodia', 'Kingdom of Cambodia', '855'),
(39, 'Cameroon', 'Republic of Cameroon', '237'),
(40, 'Canada', 'Canada', '1'),
(41, 'Cape Verde', 'Republic of Cape Verde', '238'),
(42, 'Cayman Islands', 'The Cayman Islands', '1+345'),
(43, 'Central African Republic', 'Central African Republic', '236'),
(44, 'Chad', 'Republic of Chad', '235'),
(45, 'Chile', 'Republic of Chile', '56'),
(46, 'China', 'People''s Republic of China', '86'),
(47, 'Christmas Island', 'Christmas Island', '61'),
(48, 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', '61'),
(49, 'Colombia', 'Republic of Colombia', '57'),
(50, 'Comoros', 'Union of the Comoros', '269'),
(51, 'Congo', 'Republic of the Congo', '242'),
(52, 'Cook Islands', 'Cook Islands', '682'),
(53, 'Costa Rica', 'Republic of Costa Rica', '506'),
(54, 'Cote d''ivoire (Ivory Coast)', 'Republic of C&ocirc;te D''Ivoire (Ivory Coast)', '225'),
(55, 'Croatia', 'Republic of Croatia', '385'),
(56, 'Cuba', 'Republic of Cuba', '53'),
(57, 'Curacao', 'Cura&ccedil;ao', '599'),
(58, 'Cyprus', 'Republic of Cyprus', '357'),
(59, 'Czech Republic', 'Czech Republic', '420'),
(60, 'Democratic Republic of the Congo', 'Democratic Republic of the Congo', '243'),
(61, 'Denmark', 'Kingdom of Denmark', '45'),
(62, 'Djibouti', 'Republic of Djibouti', '253'),
(63, 'Dominica', 'Commonwealth of Dominica', '1+767'),
(64, 'Dominican Republic', 'Dominican Republic', '1+809, 8'),
(65, 'Ecuador', 'Republic of Ecuador', '593'),
(66, 'Egypt', 'Arab Republic of Egypt', '20'),
(67, 'El Salvador', 'Republic of El Salvador', '503'),
(68, 'Equatorial Guinea', 'Republic of Equatorial Guinea', '240'),
(69, 'Eritrea', 'State of Eritrea', '291'),
(70, 'Estonia', 'Republic of Estonia', '372'),
(71, 'Ethiopia', 'Federal Democratic Republic of Ethiopia', '251'),
(72, 'Falkland Islands (Malvinas)', 'The Falkland Islands (Malvinas)', '500'),
(73, 'Faroe Islands', 'The Faroe Islands', '298'),
(74, 'Fiji', 'Republic of Fiji', '679'),
(75, 'Finland', 'Republic of Finland', '358'),
(76, 'France', 'French Republic', '33'),
(77, 'French Guiana', 'French Guiana', '594'),
(78, 'French Polynesia', 'French Polynesia', '689'),
(79, 'French Southern Territories', 'French Southern Territories', NULL),
(80, 'Gabon', 'Gabonese Republic', '241'),
(81, 'Gambia', 'Republic of The Gambia', '220'),
(82, 'Georgia', 'Georgia', '995'),
(83, 'Germany', 'Federal Republic of Germany', '49'),
(84, 'Ghana', 'Republic of Ghana', '233'),
(85, 'Gibraltar', 'Gibraltar', '350'),
(86, 'Greece', 'Hellenic Republic', '30'),
(87, 'Greenland', 'Greenland', '299'),
(88, 'Grenada', 'Grenada', '1+473'),
(89, 'Guadaloupe', 'Guadeloupe', '590'),
(90, 'Guam', 'Guam', '1+671'),
(91, 'Guatemala', 'Republic of Guatemala', '502'),
(92, 'Guernsey', 'Guernsey', '44'),
(93, 'Guinea', 'Republic of Guinea', '224'),
(94, 'Guinea-Bissau', 'Republic of Guinea-Bissau', '245'),
(95, 'Guyana', 'Co-operative Republic of Guyana', '592'),
(96, 'Haiti', 'Republic of Haiti', '509'),
(97, 'Heard Island and McDonald Islands', 'Heard Island and McDonald Islands', 'NONE'),
(98, 'Honduras', 'Republic of Honduras', '504'),
(99, 'Hong Kong', 'Hong Kong', '852'),
(100, 'Hungary', 'Hungary', '36'),
(101, 'Iceland', 'Republic of Iceland', '354'),
(102, 'India', 'Republic of India', '91'),
(103, 'Indonesia', 'Republic of Indonesia', '62'),
(104, 'Iran', 'Islamic Republic of Iran', '98'),
(105, 'Iraq', 'Republic of Iraq', '964'),
(106, 'Ireland', 'Ireland', '353'),
(107, 'Isle of Man', 'Isle of Man', '44'),
(108, 'Israel', 'State of Israel', '972'),
(109, 'Italy', 'Italian Republic', '39'),
(110, 'Jamaica', 'Jamaica', '1+876'),
(111, 'Japan', 'Japan', '81'),
(112, 'Jersey', 'The Bailiwick of Jersey', '44'),
(113, 'Jordan', 'Hashemite Kingdom of Jordan', '962'),
(114, 'Kazakhstan', 'Republic of Kazakhstan', '7'),
(115, 'Kenya', 'Republic of Kenya', '254'),
(116, 'Kiribati', 'Republic of Kiribati', '686'),
(117, 'Kosovo', 'Republic of Kosovo', '381'),
(118, 'Kuwait', 'State of Kuwait', '965'),
(119, 'Kyrgyzstan', 'Kyrgyz Republic', '996'),
(120, 'Laos', 'Lao People''s Democratic Republic', '856'),
(121, 'Latvia', 'Republic of Latvia', '371'),
(122, 'Lebanon', 'Republic of Lebanon', '961'),
(123, 'Lesotho', 'Kingdom of Lesotho', '266'),
(124, 'Liberia', 'Republic of Liberia', '231'),
(125, 'Libya', 'Libya', '218'),
(126, 'Liechtenstein', 'Principality of Liechtenstein', '423'),
(127, 'Lithuania', 'Republic of Lithuania', '370'),
(128, 'Luxembourg', 'Grand Duchy of Luxembourg', '352'),
(129, 'Macao', 'The Macao Special Administrative Region', '853'),
(130, 'Macedonia', 'The Former Yugoslav Republic of Macedonia', '389'),
(131, 'Madagascar', 'Republic of Madagascar', '261'),
(132, 'Malawi', 'Republic of Malawi', '265'),
(133, 'Malaysia', 'Malaysia', '60'),
(134, 'Maldives', 'Republic of Maldives', '960'),
(135, 'Mali', 'Republic of Mali', '223'),
(136, 'Malta', 'Republic of Malta', '356'),
(137, 'Marshall Islands', 'Republic of the Marshall Islands', '692'),
(138, 'Martinique', 'Martinique', '596'),
(139, 'Mauritania', 'Islamic Republic of Mauritania', '222'),
(140, 'Mauritius', 'Republic of Mauritius', '230'),
(141, 'Mayotte', 'Mayotte', '262'),
(142, 'Mexico', 'United Mexican States', '52'),
(143, 'Micronesia', 'Federated States of Micronesia', '691'),
(144, 'Moldava', 'Republic of Moldova', '373'),
(145, 'Monaco', 'Principality of Monaco', '377'),
(146, 'Mongolia', 'Mongolia', '976'),
(147, 'Montenegro', 'Montenegro', '382'),
(148, 'Montserrat', 'Montserrat', '1+664'),
(149, 'Morocco', 'Kingdom of Morocco', '212'),
(150, 'Mozambique', 'Republic of Mozambique', '258'),
(151, 'Myanmar (Burma)', 'Republic of the Union of Myanmar', '95'),
(152, 'Namibia', 'Republic of Namibia', '264'),
(153, 'Nauru', 'Republic of Nauru', '674'),
(154, 'Nepal', 'Federal Democratic Republic of Nepal', '977'),
(155, 'Netherlands', 'Kingdom of the Netherlands', '31'),
(156, 'New Caledonia', 'New Caledonia', '687'),
(157, 'New Zealand', 'New Zealand', '64'),
(158, 'Nicaragua', 'Republic of Nicaragua', '505'),
(159, 'Niger', 'Republic of Niger', '227'),
(160, 'Nigeria', 'Federal Republic of Nigeria', '234'),
(161, 'Niue', 'Niue', '683'),
(162, 'Norfolk Island', 'Norfolk Island', '672'),
(163, 'North Korea', 'Democratic People''s Republic of Korea', '850'),
(164, 'Northern Mariana Islands', 'Northern Mariana Islands', '1+670'),
(165, 'Norway', 'Kingdom of Norway', '47'),
(166, 'Oman', 'Sultanate of Oman', '968'),
(167, 'Pakistan', 'Islamic Republic of Pakistan', '92'),
(168, 'Palau', 'Republic of Palau', '680'),
(169, 'Palestine', 'State of Palestine (or Occupied Palestinian Territory)', '970'),
(170, 'Panama', 'Republic of Panama', '507'),
(171, 'Papua New Guinea', 'Independent State of Papua New Guinea', '675'),
(172, 'Paraguay', 'Republic of Paraguay', '595'),
(173, 'Peru', 'Republic of Peru', '51'),
(174, 'Phillipines', 'Republic of the Philippines', '63'),
(175, 'Pitcairn', 'Pitcairn', 'NONE'),
(176, 'Poland', 'Republic of Poland', '48'),
(177, 'Portugal', 'Portuguese Republic', '351'),
(178, 'Puerto Rico', 'Commonwealth of Puerto Rico', '1+939'),
(179, 'Qatar', 'State of Qatar', '974'),
(180, 'Reunion', 'R&eacute;union', '262'),
(181, 'Romania', 'Romania', '40'),
(182, 'Russia', 'Russian Federation', '7'),
(183, 'Rwanda', 'Republic of Rwanda', '250'),
(184, 'Saint Barthelemy', 'Saint Barth&eacute;lemy', '590'),
(185, 'Saint Helena', 'Saint Helena, Ascension and Tristan da Cunha', '290'),
(186, 'Saint Kitts and Nevis', 'Federation of Saint Christopher and Nevis', '1+869'),
(187, 'Saint Lucia', 'Saint Lucia', '1+758'),
(188, 'Saint Martin', 'Saint Martin', '590'),
(189, 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', '508'),
(190, 'Saint Vincent and the Grenadines', 'Saint Vincent and the Grenadines', '1+784'),
(191, 'Samoa', 'Independent State of Samoa', '685'),
(192, 'San Marino', 'Republic of San Marino', '378'),
(193, 'Sao Tome and Principe', 'Democratic Republic of S&atilde;o Tom&eacute; and Pr&iacute;ncipe', '239'),
(194, 'Saudi Arabia', 'Kingdom of Saudi Arabia', '966'),
(195, 'Senegal', 'Republic of Senegal', '221'),
(196, 'Serbia', 'Republic of Serbia', '381'),
(197, 'Seychelles', 'Republic of Seychelles', '248'),
(198, 'Sierra Leone', 'Republic of Sierra Leone', '232'),
(199, 'Singapore', 'Republic of Singapore', '65'),
(200, 'Sint Maarten', 'Sint Maarten', '1+721'),
(201, 'Slovakia', 'Slovak Republic', '421'),
(202, 'Slovenia', 'Republic of Slovenia', '386'),
(203, 'Solomon Islands', 'Solomon Islands', '677'),
(204, 'Somalia', 'Somali Republic', '252'),
(205, 'South Africa', 'Republic of South Africa', '27'),
(206, 'South Georgia and the South Sandwich Islands', 'South Georgia and the South Sandwich Islands', '500'),
(207, 'South Korea', 'Republic of Korea', '82'),
(208, 'South Sudan', 'Republic of South Sudan', '211'),
(209, 'Spain', 'Kingdom of Spain', '34'),
(210, 'Sri Lanka', 'Democratic Socialist Republic of Sri Lanka', '94'),
(211, 'Sudan', 'Republic of the Sudan', '249'),
(212, 'Suriname', 'Republic of Suriname', '597'),
(213, 'Svalbard and Jan Mayen', 'Svalbard and Jan Mayen', '47'),
(214, 'Swaziland', 'Kingdom of Swaziland', '268'),
(215, 'Sweden', 'Kingdom of Sweden', '46'),
(216, 'Switzerland', 'Swiss Confederation', '41'),
(217, 'Syria', 'Syrian Arab Republic', '963'),
(218, 'Taiwan', 'Republic of China (Taiwan)', '886'),
(219, 'Tajikistan', 'Republic of Tajikistan', '992'),
(220, 'Tanzania', 'United Republic of Tanzania', '255'),
(221, 'Thailand', 'Kingdom of Thailand', '66'),
(222, 'Timor-Leste (East Timor)', 'Democratic Republic of Timor-Leste', '670'),
(223, 'Togo', 'Togolese Republic', '228'),
(224, 'Tokelau', 'Tokelau', '690'),
(225, 'Tonga', 'Kingdom of Tonga', '676'),
(226, 'Trinidad and Tobago', 'Republic of Trinidad and Tobago', '1+868'),
(227, 'Tunisia', 'Republic of Tunisia', '216'),
(228, 'Turkey', 'Republic of Turkey', '90'),
(229, 'Turkmenistan', 'Turkmenistan', '993'),
(230, 'Turks and Caicos Islands', 'Turks and Caicos Islands', '1+649'),
(231, 'Tuvalu', 'Tuvalu', '688'),
(232, 'Uganda', 'Republic of Uganda', '256'),
(233, 'Ukraine', 'Ukraine', '380'),
(234, 'United Arab Emirates', 'United Arab Emirates', '971'),
(235, 'United Kingdom', 'United Kingdom of Great Britain and Nothern Ireland', '44'),
(236, 'United States', 'United States of America', '1'),
(237, 'United States Minor Outlying Islands', 'United States Minor Outlying Islands', 'NONE'),
(238, 'Uruguay', 'Eastern Republic of Uruguay', '598'),
(239, 'Uzbekistan', 'Republic of Uzbekistan', '998'),
(240, 'Vanuatu', 'Republic of Vanuatu', '678'),
(241, 'Vatican City', 'State of the Vatican City', '39'),
(242, 'Venezuela', 'Bolivarian Republic of Venezuela', '58'),
(243, 'Vietnam', 'Socialist Republic of Vietnam', '84'),
(244, 'Virgin Islands, British', 'British Virgin Islands', '1+284'),
(245, 'Virgin Islands, US', 'Virgin Islands of the United States', '1+340'),
(246, 'Wallis and Futuna', 'Wallis and Futuna', '681'),
(247, 'Western Sahara', 'Western Sahara', '212'),
(248, 'Yemen', 'Republic of Yemen', '967'),
(249, 'Zambia', 'Republic of Zambia', '260'),
(250, 'Zimbabwe', 'Republic of Zimbabwe', '263');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--
drop table if exists `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_id` int(11) NOT NULL DEFAULT '0',
  `equipment_name` varchar(45) DEFAULT NULL,
  `equipment_remark` varchar(45) DEFAULT NULL,
  `rental_cost` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `equipment_status` varchar(15) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`equipment_id`,`equipmentcategory_id`),
  KEY `equipment_equipmentcategory_id_foreign_idx` (`equipmentcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--
drop table if exists `equipment_category`;
CREATE TABLE IF NOT EXISTS `equipment_category` (
  `equipmentcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipmentcategory_remark` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`equipmentcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `interest_field`
--
drop table if exists `interest_field`;
CREATE TABLE IF NOT EXISTS `interest_field` (
  `interestfield_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`interestfield_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `interest_field`
--

INSERT INTO `interest_field` (`interestfield_id`, `name`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science', NULL, 1, NULL, '2015-01-14 06:48:26', NULL),
(2, 'Artificial Intelligence', NULL, 1, NULL, '2015-01-14 06:48:35', NULL),
(3, 'Databases', NULL, 1, NULL, '2015-01-14 06:48:45', NULL),
(4, 'Human-Computer Interaction', NULL, 1, NULL, '2015-01-14 06:48:57', NULL),
(5, 'Computer Security', NULL, 1, NULL, '2015-01-14 06:49:03', NULL),
(6, 'Internet Technology', NULL, 1, NULL, '2015-01-14 06:49:08', NULL),
(7, 'Open Source', NULL, 1, NULL, '2015-01-14 06:49:28', NULL),
(8, 'E-commerce', NULL, 1, NULL, '2015-01-14 06:49:38', NULL),
(9, 'Networking', NULL, 1, NULL, '2015-01-14 06:49:38', NULL),
(10, 'Mobile Technology', NULL, 1, NULL, '2015-01-14 06:49:38', NULL),
(11, 'Virtual Reality', NULL, 1, NULL, '2015-02-26 04:36:42', NULL),
(12, 'Bio-technology', NULL, 1, NULL, '2015-02-26 04:36:42', NULL),
(13, 'Robotics', NULL, 1, NULL, '2015-02-26 04:36:42', NULL),
(14, 'System and Hardware', NULL, 1, NULL, '2015-02-26 04:36:42', NULL),
(15, 'Devices and Engine', NULL, 1, NULL, '2015-02-26 04:36:42', NULL),
(16, 'Data Science', NULL, 1, NULL, '2015-02-26 04:40:22', NULL),
(17, 'Machine Learning', NULL, 1, NULL, '2015-02-26 04:40:22', NULL),
(18, 'Software', NULL, 1, NULL, '2015-02-26 04:41:07', NULL),
(19, 'Visual Effects', NULL, 1, NULL, '2015-02-26 04:41:07', NULL),
(20, 'Hacking', NULL, 1, NULL, '2015-02-26 04:42:14', NULL),
(21, 'Other', NULL, 1, NULL, '2015-02-26 04:42:14', NULL);
-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--
drop table if exists `invitation`;
CREATE TABLE IF NOT EXISTS `invitation` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`invite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `invitation_to_conference`
--
drop table if exists `invitation_to_conference`;
CREATE TABLE IF NOT EXISTS `invitation_to_conference` (
  `invitation_to_conference_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `conf_id` int(11) DEFAULT NULL,
  `is_used` bit(1) NOT NULL DEFAULT b'0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`invitation_to_conference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--
drop table if exists `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` float NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `total` float DEFAULT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'unpaid',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--
drop table if exists `keywords`;
CREATE TABLE IF NOT EXISTS `keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `payment`
--
drop table if exists `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `payment_type` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Table structure for table `payment_cash`
--
drop table if exists `payment_cash`;
CREATE TABLE IF NOT EXISTS `payment_cash` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_creditcard`
--
drop table if exists `payment_creditcard`;
CREATE TABLE IF NOT EXISTS `payment_creditcard` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `card_num` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--
drop table if exists `payment_type`;
CREATE TABLE IF NOT EXISTS `payment_type` (
  `paymenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`paymenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--
drop table if exists `pending`;
CREATE TABLE IF NOT EXISTS `pending` (
  `pending_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `equipmentcategory_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `delete` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`pending_id`),
  KEY `pending_user_id_foreign_idx` (`user_id`),
  KEY `pending_equipment_id_foreign_idx` (`equipment_id`),
  KEY `pending_equipmentcategory_id_foreign_idx` (`equipmentcategory_id`),
  KEY `pending_room_id_foreign_idx` (`room_id`),
  KEY `pending_venue_id_foreign_idx` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
drop table if exists `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_Id` int(11) NOT NULL,
  `permission_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_Id`),
  UNIQUE KEY `permission_name_UNIQUE` (`permission_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--
drop table if exists `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `fb_email`, `user_id`, `uid`, `access_token`, `created_at`, `updated_at`, `bio`, `location`, `photo`) VALUES
(1, '', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(2, '', 2, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(3, '', 3, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(4, '', 4, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(5, '', 5, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(6, '', 6, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL),
(7, 'pohjun.ng@gmail.com', 7, 10152916861920967, 'CAAV2KrdSapcBAOaIiG4F7eGmwVC5XpMUFSWWshHKR84zpJfpz7MPMUG9zucZCOAsGZA7zRsKersHdUVyC0vLTXngE3YYDo0IgrIZCkfGthrJpAnzZCgZBFbNr4ioAwEWUaVIVHwhRsZAdHj3YWL4L1jZBkTBZBcteklZBeJyw3jEZA9nbrDfO9o0K5xRZCuMxd8TqTKobmmSKTqKqjTCo8vL37l', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hello world!', 'Singapore', 'https://graph.facebook.com/10152916861920967/picture?type=normal'),
(8, 'duomax8668@hotmail.com', 8, 10153082278326070, 'CAAV2KrdSapcBAAcJsmDpJByN7RMDDfuPrn7sRG5Du4dHXVZAlxpQDp0R9J3r5xZBOZAVEYiylN0xgCnEL5maWoNuUv7SVrTv1dTHd8Wgs5ttKCj2nUBDR6pTiGrAsYdVDXXTinFykanLiVEYqG8vZAYQE95ndE32yTSTmcvSZBaPp2YQZCmHOQOn5bOJSBJ2TRGkyoxFEJXEv8ot4uZAZCyE', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, 'https://graph.facebook.com/10153082278326070/picture?type=normal');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--
drop table if exists `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
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
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--
drop table if exists `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `roles_rolename_unique` (`rolename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `rolename`, `remarks`) VALUES
(1, 'User', 'normal user'),
(2, 'Resource Provider', 'resource provider'),
(3, 'Admin', 'super admin account'),
(4, 'Conference Chair', 'organizer'),
(5, 'Conference Staff', 'staff'),
(6, 'Author', 'author'),
(7, 'Reviewer', 'reviewer'),
(8, 'Participant', 'participant');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--
drop table if exists `role_permission`;
CREATE TABLE IF NOT EXISTS `role_permission` (
  `rolepermission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`rolepermission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--
drop table if exists `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `room_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `rental_cost` decimal(12,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `available` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`room_id`,`venue_id`),
  KEY `room_venue_id_foreign_idx` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Table structure for table `room_equipment`
--
drop table if exists `room_equipment`;
CREATE TABLE IF NOT EXISTS `room_equipment` (
  `roomequipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `equipment_status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`roomequipment_id`),
  KEY `room_equipment_equipment_id_foreign_idx` (`equipment_id`),
  KEY `room_equipment_roomt_id_foreign_idx` (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--
drop table if exists `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `sub_title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment_path` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 = accepted, 9 = rejected, 0 = on review',
  `overall_score` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `submission_authors`
--
drop table if exists `submission_authors`;
CREATE TABLE IF NOT EXISTS `submission_authors` (
  `sub_id` int(11) NOT NULL,
  `email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `is_presenting` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_keyword`
--
drop table if exists `submission_keyword`;
CREATE TABLE IF NOT EXISTS `submission_keyword` (
  `keyword_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_topic`
--
drop table if exists `submission_topic`;
CREATE TABLE IF NOT EXISTS `submission_topic` (
  `topic_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sysrole`
--
drop table if exists `sysrole`;
CREATE TABLE IF NOT EXISTS `sysrole` (
  `sysrole_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sysrole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sysrole`
--

INSERT INTO `sysrole` (`sysrole_id`, `user_id`, `role_id`) VALUES
(2, 1, 1),
(3, 2, 1),
(4, 3, 1),
(5, 4, 2),
(6, 5, 1),
(7, 6, 3),
(8, 7, 1),
(9, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
drop table if exists `users`;
CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `email_temp`, `password`, `password_temp`, `remember_token`, `code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Chair', 'Bella', 'bella.ratmelia@gmail.com', NULL, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', '', 'tX8nNYwglxy4Z8xabyQpvb0mvvu8hAUplktv8VDvSccTXAhbxdMfHiwLx8Lo', '', 1, '2015-02-25 09:39:34', '2015-02-28 09:51:05'),
(2, 'Noverinda', 'Bella', 'bella.ratmelia@hotmail.com', NULL, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', NULL, 'yX4RMHllzUbFXO38wmpn1tytNCvv2nRbE1ugDJZK8TH6psh4ub94kSyoccUK', '', 1, '2015-02-25 09:41:44', '2015-02-25 09:42:29'),
(3, 'Reviewer', 'Thomas', 'batmanray@live.com.sg', NULL, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', NULL, 'ZGytiNEwuVO1xir74zgPCcgieiCq0hxHItgs7R6g1zkdDVATe1Rpj86TSQC3', '', 1, '2015-02-25 09:42:27', '2015-02-25 09:54:18'),
(4, 'Resource Provider', 'Poh Jun', 'pohjun.ng@hotmail.sg', NULL, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', NULL, 'OAFui30DFcVZ7eJGKeGhfPfZdYliVlXCeYqBHFXFwPKcildbRb1R86v3wCHq', NULL, 1, '2015-02-25 09:54:47', '2015-03-01 13:46:52'),
(5, 'Participant', 'Thomas', 'thomas.leera@gmail.com', NULL, '$2y$10$uWmiDsmMJzClEnwsldsR5emM7xUftD.CJguQ/nx0wqcF3CAMjqt7K', NULL, 'gEw8IIEI4SenwQ9VzZeTF4u3Wr1lxifmpKVz2AcGECXNqdxXEIQYZoEYeYy8', '', 1, '2015-02-25 09:57:17', '2015-02-28 09:49:41'),
(6, 'admin', 'orafer', 'admin@orafer.com', NULL, '$2y$10$kX/HtiXsmoojqsfy9.Q5zeGt9EjodjK1SerS7iE4EH542w5r7vdUu', NULL, 'Nrls3KOvdbl96Gec6uaAUpxdpmL5XrysJ7XCP6sqvhQR32dWzU0TZJdNWBE5', '', 1, '2015-02-25 09:58:48', '2015-02-28 08:50:58'),
(7, 'Author', 'Ng Poh Jun', 'pohjun.ng@gmail.com', NULL, '$2y$10$x8mmQ4BF/IAoGMSNZ3BkjegqeUen8j/mQRAXV6aJJj29tqrH8BAOq', NULL, 'F360RtShlb2mvGWDY4ZV0MhpKyNhjVTQxUPqNSAv6m9Rx5qsLNQTW0XrZO9o', '', 1, '2015-02-25 10:15:30', '2015-02-28 09:59:55'),
(8, 'Shinn', 'Lee', 'duomax8668@hotmail.com', NULL, '$2y$10$ZB7PnzrlK4g8q.wAO6rjyexJxMg4zZzDaTg3wLNBCshP7lfM1DB9q', NULL, 'LnMWh8MxQdD7LmEKwf6Buk6zWZvVkKem4X5OvOD4H4aYInMBT2qmjfH3lHNf', NULL, 1, '2015-02-28 07:06:18', '2015-02-28 09:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_bill`
--
drop table if exists `user_bill`;
CREATE TABLE IF NOT EXISTS `user_bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--
drop table if exists `venue`;
CREATE TABLE IF NOT EXISTS `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `available` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `confuserrole`
--
ALTER TABLE `confuserrole`
  ADD CONSTRAINT `confuserrole_ibfk_1` FOREIGN KEY (`conf_id`) REFERENCES `conference` (`conf_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confuserrole_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confuserrole_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_equipmentcategory_id_foreign` FOREIGN KEY (`equipmentcategory_id`) REFERENCES `equipment_category` (`equipmentcategory_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pending`
--
ALTER TABLE `pending`
  ADD CONSTRAINT `pending_equipmentcategory_id_foreign` FOREIGN KEY (`equipmentcategory_id`) REFERENCES `equipment_category` (`equipmentcategory_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pending_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pending_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pending_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pending_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`venue_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`venue_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `room_equipment`
--
ALTER TABLE `room_equipment`
  ADD CONSTRAINT `room_equipment_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_equipment_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
