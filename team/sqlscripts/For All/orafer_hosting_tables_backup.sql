-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2015 at 12:19 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `orafer_maindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_component`
--

DROP TABLE IF EXISTS `bill_component`;
CREATE TABLE IF NOT EXISTS `bill_component` (
  `billcomponent_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `billcomponenttype_id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`billcomponent_id`),
  KEY `FK_BillComp_01` (`bill_id`),
  KEY `BillComponentType` (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bill_component_type`
--

DROP TABLE IF EXISTS `bill_component_type`;
CREATE TABLE IF NOT EXISTS `bill_component_type` (
  `billcomponenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`billcomponenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `Company_id` int(11) NOT NULL AUTO_INCREMENT,
  `Company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_id`, `Company_name`) VALUES
(1, 'Expo'),
(2, 'MBS');

-- --------------------------------------------------------

--
-- Table structure for table `company_user`
--

DROP TABLE IF EXISTS `company_user`;
CREATE TABLE IF NOT EXISTS `company_user` (
  `company_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`company_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_user`
--

INSERT INTO `company_user` (`company_user_id`, `company_id`, `user_id`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conf_id`, `title`, `description`, `begin_date`, `begin_time`, `end_date`, `end_time`, `is_free`, `cutoff_time`, `min_score`, `ticket_price`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, '8th Annual International Conference on Computer Games Multimedia and Allied Technologies (CGAT 2015)', '						<p style="text-align: justify; margin-bottom: 14px; padding: 0px;"><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi varius sed', '2015-01-15', '2015-01-05 06:30:00', '2015-01-07', '2015-01-07 00:00:00', b'0', '0000-00-00 00:00:00', 0, '0.00', 1, 52, '2015-01-17 15:25:10', '2015-02-17 13:08:30'),
(2, '6th Annual International Conference on ICT: Big Data, Cloud and Security ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-01-12', '2015-01-12 06:00:00', '2015-01-14', '2015-01-14 09:00:00', b'0', '0000-00-00 00:00:00', 0, '0.00', 1, NULL, '2015-01-17 15:25:58', '2015-02-18 16:12:55');

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
-- Table structure for table `conference_entertainment`
--

DROP TABLE IF EXISTS `conference_entertainment`;
CREATE TABLE IF NOT EXISTS `conference_entertainment` (
  `conference_entertainment_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `entertainment_id` int(11) NOT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`conference_entertainment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_equipmentrequest`
--

DROP TABLE IF EXISTS `conference_equipmentrequest`;
CREATE TABLE IF NOT EXISTS `conference_equipmentrequest` (
  `conferenceequipmentrequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `equipmentcat_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`conferenceequipmentrequest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_field`
--

DROP TABLE IF EXISTS `conference_field`;
CREATE TABLE IF NOT EXISTS `conference_field` (
  `conferencefield_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `interestfield_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`conferencefield_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_food`
--

DROP TABLE IF EXISTS `conference_food`;
CREATE TABLE IF NOT EXISTS `conference_food` (
  `conferencefood_id` int(11) NOT NULL,
  `conf_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `foodprice_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_datetime` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`conferencefood_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conference_paymenttransaction`
--

DROP TABLE IF EXISTS `conference_paymenttransaction`;
CREATE TABLE IF NOT EXISTS `conference_paymenttransaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `paymenttype_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conference_reviewpanel`
--

DROP TABLE IF EXISTS `conference_reviewpanel`;
CREATE TABLE IF NOT EXISTS `conference_reviewpanel` (
  `conferencereviewpanel_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`conferencereviewpanel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conference_room_schedule`
--

DROP TABLE IF EXISTS `conference_room_schedule`;
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`confroomschedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `conference_room_schedule`
--

INSERT INTO `conference_room_schedule` (`confroomschedule_id`, `conf_id`, `room_id`, `description`, `date_start`, `date_end`, `begin_time`, `end_time`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Testing', '2015-04-02', '2015-04-03', '2015-04-02 03:00:00', '2015-04-03 15:00:00', NULL, 0, NULL, '2015-02-15 00:46:09', '2015-02-18 16:12:56'),
(2, 2, 4, 'Testing', '2015-04-02', '2015-04-03', '2015-04-02 03:00:00', '2015-04-03 15:00:00', NULL, 0, NULL, '2015-02-15 00:46:09', '2015-02-18 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `conference_topic`
--

DROP TABLE IF EXISTS `conference_topic`;
CREATE TABLE IF NOT EXISTS `conference_topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_id` int(11) NOT NULL,
  `topic_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `conference_topic`
--

INSERT INTO `conference_topic` (`topic_id`, `conf_id`, `topic_name`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Game Console', 1, NULL, '2015-01-29 12:16:44', '2015-02-18 16:12:56'),
(2, 1, 'Game Engine', 1, NULL, '2015-01-29 12:16:44', '2015-02-18 16:12:56'),
(3, 2, 'Data Science', 1, NULL, '2015-01-29 12:17:09', '2015-02-18 16:12:56'),
(4, 2, 'Analytics', 1, NULL, '2015-01-29 12:17:09', '2015-02-18 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `confuserrole`
--

DROP TABLE IF EXISTS `confuserrole`;
CREATE TABLE IF NOT EXISTS `confuserrole` (
  `confuserrole_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `conf_id` int(11) NOT NULL,
  PRIMARY KEY (`confuserrole_id`),
  KEY `confuserrole_role_id_index_01` (`role_id`),
  KEY `confuserrole_user_id_index_02` (`user_id`),
  KEY `confuserrole_ibfk_1` (`conf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `confuserrole`
--

INSERT INTO `confuserrole` (`confuserrole_id`, `role_id`, `user_id`, `conf_id`) VALUES
(1, 4, 1, 1),
(2, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
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

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_id` int(11) NOT NULL DEFAULT '0',
  `equipment_name` varchar(45) DEFAULT NULL,
  `equipment_remark` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `equipment_status` varchar(45) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`equipment_id`,`equipmentcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_category`
--

DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE IF NOT EXISTS `equipment_category` (
  `equipmentcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentcategory_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipmentcategory_remark` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`equipmentcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `interest_field`
--

DROP TABLE IF EXISTS `interest_field`;
CREATE TABLE IF NOT EXISTS `interest_field` (
  `interestfield_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`interestfield_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `interest_field`
--

INSERT INTO `interest_field` (`interestfield_id`, `name`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Solar', NULL, 0, NULL, '2015-01-14 14:48:26', '2015-02-18 16:12:56'),
(2, 'Physics', NULL, 0, NULL, '2015-01-14 14:48:35', '2015-02-18 16:12:56'),
(3, 'Heliosphere', NULL, 0, NULL, '2015-01-14 14:48:45', '2015-02-18 16:12:56'),
(4, 'Space', NULL, 0, NULL, '2015-01-14 14:48:57', '2015-02-18 16:12:56'),
(5, 'Climate', NULL, 0, NULL, '2015-01-14 14:49:03', '2015-02-18 16:12:56'),
(6, 'Game', NULL, 0, NULL, '2015-01-14 14:49:08', '2015-02-18 16:12:56'),
(7, 'Ionosphere', NULL, 0, NULL, '2015-01-14 14:49:28', '2015-02-18 16:12:56'),
(8, 'Academy', NULL, 0, NULL, '2015-01-14 14:49:38', '2015-02-18 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
CREATE TABLE IF NOT EXISTS `invitation` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`invite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`invite_id`, `code`, `email`, `company`) VALUES
(1, 'l9WVUBUEO8mXGxioF8tGqWsp4ARcwf7kN2aIfgZeeyQuUtjUm9nq9YOjkHlx', 'pohjun.ng@hotmail.sg', 'Expo');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
CREATE TABLE IF NOT EXISTS `keywords` (
  `keyword_id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`keyword_id`, `keyword_name`, `sub_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(54, 'grapes', 39, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52'),
(55, 'data', 3, 0, NULL, '2015-02-19 12:38:32', '2015-02-19 12:38:32'),
(56, 'science', 3, 0, NULL, '2015-02-19 12:38:32', '2015-02-19 12:38:32'),
(57, 'definition', 3, 0, NULL, '2015-02-19 12:38:32', '2015-02-19 12:38:32'),
(58, 'game', 1, 0, NULL, '2015-02-19 12:41:11', '2015-02-19 12:41:11'),
(59, 'mobile', 1, 0, NULL, '2015-02-19 12:41:11', '2015-02-19 12:41:11'),
(60, 'gadgets', 1, 0, NULL, '2015-02-19 12:41:11', '2015-02-19 12:41:11'),
(61, 'lazy', 4, 0, NULL, '2015-02-23 09:48:25', '2015-02-23 09:48:25'),
(62, 'sloth', 4, 0, NULL, '2015-02-23 09:48:25', '2015-02-23 09:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `payment_cash`
--

DROP TABLE IF EXISTS `payment_cash`;
CREATE TABLE IF NOT EXISTS `payment_cash` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_creditcard`
--

DROP TABLE IF EXISTS `payment_creditcard`;
CREATE TABLE IF NOT EXISTS `payment_creditcard` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `card_num` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `amount_paid` double(7,2) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`transaction_id`,`user_id`,`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE IF NOT EXISTS `payment_type` (
  `paymenttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_enabled` bit(1) NOT NULL DEFAULT b'1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`paymenttype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
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

DROP TABLE IF EXISTS `profiles`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `fb_email`, `user_id`, `uid`, `access_token`, `created_at`, `updated_at`, `bio`, `location`, `photo`) VALUES
(1, '', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. ', 'Singapore', NULL),
(2, '', 3, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', 'Singapore', ''),
(3, '', 4, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hi! Thanks for visiting', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `sub_id`, `user_id`, `internal_comment`, `comment`, `quality_score`, `relevance_score`, `originality_score`, `significance_score`, `presentation_score`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(3, 39, 52, '', 'pretty ok', 9, 7, 8, 6, 1, 0, NULL, '2015-02-08 21:06:20', '2015-02-08 23:02:34'),
(5, 3, 52, '', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. ', 6, 7, 8, 6, 10, 0, NULL, '2015-02-08 22:49:17', '2015-02-08 23:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
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

DROP TABLE IF EXISTS `role_permission`;
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

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) NOT NULL,
  `room_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rental_cost` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`room_id`,`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `venue_id`, `room_name`, `capacity`, `rental_cost`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Room V1 R1', '500', '500', 1, NULL, '2015-01-16 16:23:07', '2015-02-18 16:12:56'),
(2, 1, 'Room V1 R2', '450', '550', 1, NULL, '2015-01-16 16:23:22', '2015-02-18 16:12:56'),
(3, 1, 'Room V1 R3', '550', '600', 1, NULL, '2015-01-16 16:23:36', '2015-02-18 16:12:56'),
(4, 1, 'Room A1V1', '500', '1200', 1, NULL, '2015-02-01 13:23:18', '2015-02-18 16:12:56'),
(5, 1, 'Room A2V1', '600', '1000', 1, NULL, '2015-02-01 13:23:18', '2015-02-18 16:12:56'),
(6, 2, 'Room B1V2', '500', '1800', 1, NULL, '2015-02-01 13:23:18', '2015-02-18 16:12:56'),
(7, 2, 'Room B2V2', '1000', '2000', 1, NULL, '2015-02-01 13:23:18', '2015-02-18 16:12:56'),
(8, 2, 'Room B3V2', '2500', '3300', 1, NULL, '2015-02-01 13:23:18', '2015-02-18 16:12:56'),
(9, 3, 'Room C1V3', '800', '1100', 1, NULL, '2015-02-01 13:23:18', '2015-02-18 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `room_equipment`
--

DROP TABLE IF EXISTS `room_equipment`;
CREATE TABLE IF NOT EXISTS `room_equipment` (
  `roomequipment_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `quantity` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`roomequipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `conf_id` int(11) NOT NULL,
  `sub_type` int(11) NOT NULL,
  `sub_title` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment_path` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `sub_remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `overall_score` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sub_id`),
  UNIQUE KEY `submissions_subtitle_unique` (`sub_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`sub_id`, `user_id`, `conf_id`, `sub_type`, `sub_title`, `sub_abstract`, `attachment_path`, `sub_remarks`, `status`, `overall_score`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'The future of mobile gaming: will phones soon replace gadgets?', 'A common argument is that Mobile devices will diminish the handheld market because they have games that fill the portable void. Where exactly are these games though? Angry Birds? a shallow, abiet fun bird launcher where all you do is just swimpe the touch screen, and is only now starting to loose relivance. Fruit Ninja, another shallow, "how mcuh fruit can you cut game" that too has lost relevance. Flappy Bird?, another shallow time waster that was just removed, and probably forgoten. \r\n\r\nPeople say NIntendo and Sony will be irrelevant in the handheld space because games on phone are cheaper alternatives. Failing to realize that the games on mobile devices are completely different from the ones on handhelds. The best games on handhelds are memorable experiences packed with content, depth, and variety, and can keep you enteratained for up to 3 hours. That''s why they cost up to $40. Most mobile games while fun, are generic fads with shallow gameplay, lackluster content, and can only really entertain you for up 10 minnutes. Where''s the iPhone''s Monster Hunter, or Smash Bros. Killer? That isn''t to say mobile games can''t be good or aren''t good, but compared to the best handheld games, most of them might as well be mini games.\r\n\r\nI am aware that there are core franchises on mobile devices, but the vast majority of them are ported from other platforms. Adding insult to injury, not only do most core mobile games not make a profit, but the majority of mobile games in general don''t make a profit. That''s because all people even play on their phones are simple puzzle games, and novelty titles like Fruit Ninja. I can see young children (ages 6 to 10) being entertained by them for long periods of time, but once they get older, they''ll want more competent game experiences. \r\n\r\nPlus, kids are influenced by Brand recognition. If little kids see Mario, Sonic, Kirby and DK on the 3DS, then they''ll want a 3DS. If teens see Street Fighter, Fire Emblem, Kid Icarus, Assasins Creed, Smash, and Monster Hunter on the 3DS and PS Vita respecitvley, they''ll want both a 3DS and a PS Vita. Now obviously, this will work vice versa too, but the point is, as long as handhelds have games people want, and can offer experiences mobile devices can''t, then they''ll be sticking alongside phones and tablets for a long time.', 'uploads/877983.pdf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1, 0, 1, 1, '2015-01-17 15:27:32', '2015-02-23 10:17:11'),
(3, 1, 2, 2, 'A Definition of Data Science and Analysis', 'Data science is, in general terms, the extraction of knowledge from data. It employs techniques and theories drawn from many fields within the broad areas of mathematics, statistics, and information technology, including signal processing, probability models, machine learning, statistical learning, computer programming, data engineering, pattern recognition and learning, visualization, predictive analytics, uncertainty modeling, data warehousing, and high performance computing. Methods that scale to Big Data are of particular interest in data science, although the discipline is not generally considered to be restricted to such data. The development of machine learning, a branch of artificial intelligence used to uncover patterns in data from which predictive models can be developed, has enhanced the growth and importance of data science.\r\nData scientists investigate complex problems through expertise in disciplines within the fields of mathematics, statistics, and computer science. These areas represent great breadth and diversity of knowledge, and a data scientist will most likely be expert in only one or at most two of these areas and merely proficient in the other(s). Therefore a data scientist typically works as part of a team whose other members have knowledge and skills which complement his or hers.\r\nData scientists use the ability to find and interpret rich data sources; manage large amounts of data despite hardware, software, and bandwidth constraints; merge data sources; ensure consistency of datasets; create visualizations to aid in understanding data; build mathematical models using the data; and present and communicate the data insights/findings (preferably actionable insights) to specialists and scientists in their team and if required to a non-technical audience.\r\nData science techniques affect research in many domains, including the biological sciences, medical informatics, health care, social sciences and the humanities. It heavily influences economics, business and finance. From the business perspective, data science is an integral part of competitive intelligence, a newly emerging field that encompasses a number of activities, such as data mining and data analysis.', 'uploads/129638.pdf', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 1, 0, 1, NULL, '2015-01-17 16:31:43', '2015-02-19 12:38:32'),
(4, 3, 1, 2, 'lazy', 'lazy', 'uploads/206137.pdf', '', 1, 0, 0, 1, '2015-02-23 09:48:25', '2015-02-23 10:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `submission_authors`
--

DROP TABLE IF EXISTS `submission_authors`;
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sub_id`,`email`),
  UNIQUE KEY `submission_author_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submission_authors`
--

INSERT INTO `submission_authors` (`sub_id`, `email`, `first_name`, `last_name`, `organization`, `is_presenting`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'ace@onepiece.com', 'Ace', 'Portgas D.', 'Whitebeard Pirates', 1, 0, NULL, '2015-02-08 16:13:36', '2015-02-08 16:13:36'),
(1, 'jewelry@onepiece.com', 'Jewelry', 'Bonney', 'Shichibukai', 0, 0, NULL, '2015-02-08 16:13:36', '2015-02-08 16:13:36'),
(1, 'luffy@onepiece.com', 'Luffy', 'Monkey D', 'Strawhat Pirates', 1, 0, NULL, '2015-02-08 16:13:36', '2015-02-08 16:13:36'),
(3, 'law@onepiece.com', 'Law', 'Trafalgar D. Waters', 'Heart Pirates', 1, 0, NULL, '2015-02-15 22:34:21', '2015-02-15 22:34:21'),
(3, 'robin@onepiece.com', 'Robin', 'Nico', 'Straw Hat Pirates', 0, 0, NULL, '2015-02-15 22:34:21', '2015-02-15 22:34:21'),
(4, 'lazy@sloth.com', 'lazy', 'lazy', 'lazy', 1, 0, NULL, '2015-02-23 09:48:25', '2015-02-23 09:48:25'),
(39, 'qq@n.c', 'qqq', 'qqq', 'qqq', 1, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `submission_keyword`
--

DROP TABLE IF EXISTS `submission_keyword`;
CREATE TABLE IF NOT EXISTS `submission_keyword` (
  `keyword_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submission_topic`
--

DROP TABLE IF EXISTS `submission_topic`;
CREATE TABLE IF NOT EXISTS `submission_topic` (
  `topic_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`topic_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submission_topic`
--

INSERT INTO `submission_topic` (`topic_id`, `sub_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, '2015-02-19 12:41:11', '2015-02-19 12:41:11'),
(1, 4, 0, NULL, '2015-02-23 09:48:25', '2015-02-23 09:48:25'),
(3, 3, 0, NULL, '2015-02-19 12:38:32', '2015-02-19 12:38:32'),
(4, 3, 0, NULL, '2015-02-19 12:38:32', '2015-02-19 12:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `sysrole`
--

DROP TABLE IF EXISTS `sysrole`;
CREATE TABLE IF NOT EXISTS `sysrole` (
  `sysrole_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sysrole_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sysrole`
--

INSERT INTO `sysrole` (`sysrole_id`, `user_id`, `role_id`) VALUES
(1, 52, 1),
(2, 3, 1),
(3, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `email_temp`, `password`, `password_temp`, `remember_token`, `code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Bella', 'Ratmelia', 'bella.ratmelia@gmail.com', NULL, '$2y$10$SGv/YlBBQDVzJ8Gj8n0neeMmDDWJM9TlzE7oClCKrTH.6lY1rhCCu', NULL, 'kO9MK07WmpVkIS8KcsIuvA94WcBS8JmpdTUF01dHKj4Kes4L8OEtrRStCZTa', '', 1, '2015-02-15 00:13:36', '2015-02-23 11:23:13'),
(3, 'Poh Jun', 'Ng', 'pohjun.ng@gmail.com', '', '$2y$10$VO5iR30AKsT/fbUnqFRWV.d4JYa4VeFXbUkUTsdkB5LtAiYHLbJV6', '', 'fD02nxvDsW4eCJ1HV5biwUIaqeESrPQeHRRw5BnKPSslerAJxgirs2ZdqPyV', '', 1, '2015-02-22 15:14:09', '2015-02-24 06:24:33'),
(4, 'Resource provider', 'resource provider', 'pohjun.ng@hotmail.sg', NULL, '$2y$10$xCfeI4ceiszH/QBsQz/nn.LNQLkYfkDkG5Hla7yygV9T1bN0kt8a2', NULL, 'vijxDewmjdPIiWZ9Xnmm4ylamivYfBE4UsZShvUDcFWwsfyGmR7QJMSp7VOz', NULL, 1, '2015-02-23 20:23:19', '2015-02-23 09:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_bill`
--

DROP TABLE IF EXISTS `user_bill`;
CREATE TABLE IF NOT EXISTS `user_bill` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
CREATE TABLE IF NOT EXISTS `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `venue_address` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venue_name`, `venue_address`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Sands Expo and Convention Centre', '10 Bayfront Avenue Singapore 018956', '1.283676', ' 103.860341', 1, NULL, '2015-01-24 15:28:23', '2015-02-18 16:12:57'),
(2, 'Singapore Expo ', '1 Expo Drive Singapore 486150', '1.332875', '103.9590039', 1, NULL, '2015-02-01 13:21:03', '2015-02-23 00:16:16'),
(3, 'Suntec Singapore Convention & Exhibition Center', '1 Raffles Boulevard Singapore 039593', '1.293493', '103.857059', 1, NULL, '2015-02-01 13:21:03', '2015-02-18 16:12:57'),
(4, 'The Star Performing Arts Centre', '1 Vista Exchange Green\r\nSingapore 138617', '1.306839', '103.788440', 1, NULL, '2015-02-01 13:21:03', '2015-02-18 16:12:57');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
