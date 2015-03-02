-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2015 at 09:38 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `conforg_db`
--

--
-- Truncate table before insert `conference`
--

TRUNCATE TABLE `conference`;
--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conf_id`, `title`, `description`, `begin_date`, `begin_time`, `end_date`, `end_time`, `is_free`, `cutoff_time`, `min_score`, `ticket_price`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, '2015 IEEE Wireless Communications and Networking Conference (WCNC)', 'IEEE WCNC is the world premier wireless event that brings together industry professionals, academics, and individuals from government agencies and other institutions to exchange information and ideas on the advancement of wireless communications and networking technology.\r\n\r\nThe conference will feature a comprehensive technical program offering numerous technical sessions with papers showcasing the latest technologies, applications and services. In addition, the conference program includes workshops, tutorials, keynote talks from industrial leaders and renowned academics, panel discussions, a large exhibition, business and industrial forums.', '2015-04-02', '2015-04-02 09:00:00', '2015-04-03', '2015-04-03 16:00:00', b'0', '2015-02-20 00:00:00', 75, '200.00', 1, 0, '2015-03-02 02:04:07', NULL),
(2, 'Gartner IT Infrastructure, Operations & Data Center Summit', 'The must-attend event for I&O and data center professionals\r\nThe Gartner IT Infrastructure, Operations & Data Center Summit 2015 will empower you to formulate and implement a strategy that delivers clear outcomes built on a realistically executable infrastructure and operations roadmap.\r\nThis event will help you lead your IT organization and reinforce the criticality and relevance of your position in the face of increasing change and challenges from ever increasing disruption brought about by Nexus of Forces and digital business.', '2015-06-04', '2015-06-04 09:00:00', '2015-06-05', '2015-06-05 17:00:00', b'0', '2015-04-30 00:00:00', 75, '350.00', 2, NULL, '2015-03-02 02:04:07', NULL),
(3, 'Gartner Digital Marketing Conference 2015', 'Fuel your marketing strategy as an engine for growth, unlock revenue, gain aggressive market share, build stronger brands and secure your own personal success as a marketing leader.\r\nThis conference was created for senior marketing executives, like you, as the premier outlet for learning the latest digital marketing trends. You will leave with actionable insights and key strategies derived from independent and objective research.', '2015-05-06', '2015-05-06 10:00:00', '2015-05-08', '2015-05-08 17:00:00', b'0', '2015-04-03 00:00:00', 80, '300.00', 2, NULL, '2015-03-02 02:10:10', NULL),
(4, 'CommunicAsia 2015 Conference', 'The rising size of mobile workforce and increasingly complex user demands, coupled with the proliferation of connected devices has made this industry more dynamic than ever. It has also blurred the line between work and personal time as seen in the rise of mobility driven innovations such as smart living solutions, wearable technologies and many more.\r\n\r\nAt CommunicAsia2015, the latest innovative technologies from Big Data, Business Analytics, Cloud technologies, IoT, to Zigbee will be unveiled. These advances are poised to change the way we live and work.\r\n\r\nCommunicAsia2015 continues to be THE one-stop venue for the ICT industry', '2015-04-16', '2015-04-16 09:00:00', '2015-04-17', '2015-04-17 16:00:00', b'0', '2015-02-20 00:00:00', 75, '200.00', 1, 0, '2015-03-02 02:04:07', NULL);

--
-- Truncate table before insert `conference_field`
--

TRUNCATE TABLE `conference_field`;
--
-- Dumping data for table `conference_field`
--

INSERT INTO `conference_field` (`conferencefield_id`, `conf_id`, `interestfield_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, '2015-03-02 02:21:24', NULL),
(2, 1, 9, 1, NULL, '2015-03-02 02:21:24', NULL),
(3, 1, 14, 1, NULL, '2015-03-02 02:21:24', NULL),
(4, 2, 3, 1, NULL, '2015-03-02 02:21:24', NULL),
(5, 2, 5, 1, NULL, '2015-03-02 02:21:24', NULL),
(6, 2, 14, 1, NULL, '2015-03-02 02:21:24', NULL),
(7, 3, 8, 1, NULL, '2015-03-02 02:21:24', NULL),
(8, 3, 16, 1, NULL, '2015-03-02 02:21:24', NULL),
(9, 3, 17, 1, NULL, '2015-03-02 02:21:24', NULL),
(10, 4, 1, 0, NULL, '2015-03-02 02:37:50', NULL),
(11, 4, 6, 0, NULL, '2015-03-02 02:37:50', NULL),
(12, 4, 16, 0, NULL, '2015-03-02 02:37:50', NULL);

--
-- Truncate table before insert `conference_room_schedule`
--

TRUNCATE TABLE `conference_room_schedule`;
--
-- Dumping data for table `conference_room_schedule`
--

INSERT INTO `conference_room_schedule` (`confroomschedule_id`, `conf_id`, `room_id`, `description`, `date_start`, `date_end`, `begin_time`, `end_time`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2015-04-02', '2015-04-03', '2015-04-02 09:00:00', '2015-04-03 16:00:00', NULL, 0, NULL, '2015-03-02 03:21:27', NULL),
(2, 2, 4, NULL, '2015-06-04', '2015-06-05', '2015-06-04 09:00:00', '2015-06-05 17:00:00', NULL, 0, NULL, '2015-03-02 03:21:27', NULL),
(3, 3, 2, NULL, '2015-05-06', '2015-05-08', '2015-05-06 10:00:00', '2015-05-08 17:00:00', NULL, 0, NULL, '2015-03-02 03:21:27', NULL),
(4, 4, 5, NULL, '2015-04-16', '2015-04-17', '2015-04-16 09:00:00', '2015-04-17 17:00:00', NULL, 0, NULL, '2015-03-02 03:23:53', NULL);

--
-- Truncate table before insert `conference_topic`
--

TRUNCATE TABLE `conference_topic`;
--
-- Dumping data for table `conference_topic`
--

INSERT INTO `conference_topic` (`topic_id`, `conf_id`, `topic_name`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Wireless Communication', 1, NULL, '2015-03-02 02:17:52', NULL),
(2, 1, 'Networking', 1, NULL, '2015-03-02 02:17:52', NULL),
(3, 1, 'Current Trend in Wireless Technology', 1, NULL, '2015-03-02 02:17:52', NULL),
(4, 2, 'Cloud Technology', 2, NULL, '2015-03-02 02:17:52', NULL),
(5, 2, 'Emerging Data Center Architecture', 2, NULL, '2015-03-02 02:17:52', NULL),
(6, 2, 'Server and Storage Evolution', 2, NULL, '2015-03-02 02:17:52', NULL),
(7, 2, 'Changes in Traditional IT Operations', 2, NULL, '2015-03-02 02:17:52', NULL),
(8, 3, 'Data-driven Marketing', 2, NULL, '2015-03-02 02:17:52', NULL),
(9, 3, 'Digital Commerce', 2, NULL, '2015-03-02 02:17:52', NULL),
(10, 3, 'Emerging Marketing Tech & Trends', 2, NULL, '2015-03-02 02:17:52', NULL),
(11, 4, 'Big Data', 0, NULL, '2015-03-02 02:35:07', NULL),
(12, 4, 'Business Technology', 0, NULL, '2015-03-02 02:35:07', NULL),
(13, 4, 'Cloud Technology', 0, NULL, '2015-03-02 02:35:07', NULL);

--
-- Truncate table before insert `confuserrole`
--

TRUNCATE TABLE `confuserrole`;
--
-- Dumping data for table `confuserrole`
--

INSERT INTO `confuserrole` (`confuserrole_id`, `role_id`, `user_id`, `conf_id`) VALUES
(1, 4, 1, 1),
(2, 4, 2, 2),
(3, 4, 2, 2),
(4, 7, 1, 3),
(5, 4, 2, 4),
(6, 7, 3, 1),
(7, 7, 3, 2),
(8, 7, 3, 3),
(9, 7, 3, 4),
(10, 8, 1, 4);

--
-- Truncate table before insert `equipment`
--

TRUNCATE TABLE `equipment`;
--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `equipmentcategory_id`, `equipment_name`, `equipment_remark`, `rental_cost`, `created_by`, `modified_by`, `created_at`, `updated_at`, `equipment_status`) VALUES
(1, 4, 'Brown Chair (vintage)', '60 cm tall, 20 cm wide', NULL, 4, 4, '2015-02-27 22:10:15', NULL, 'Pending'),
(2, 4, 'Dining Table ', '90 cm diameter', NULL, 4, 4, '2015-02-27 22:10:15', NULL, 'Approved'),
(3, 5, 'Projector Screen ', '10 by 10 Meters', NULL, 4, 6, '2015-02-27 22:10:15', NULL, 'Approved'),
(4, 6, 'Surround Sound System  (Black) ', 'Sony Surrounding Sound System ', NULL, 4, 6, '2015-02-27 22:10:15', NULL, 'Approved'),
(5, 7, 'Conference Round Table', 'This is a VIP room', NULL, 4, NULL, '2015-02-27 22:13:55', NULL, 'Approved'),
(6, 8, 'Mic', 'Big Room', NULL, 4, NULL, '2015-02-27 22:13:55', NULL, 'Approved');

--
-- Truncate table before insert `equipment_category`
--

TRUNCATE TABLE `equipment_category`;
--
-- Dumping data for table `equipment_category`
--

INSERT INTO `equipment_category` (`equipmentcategory_id`, `equipmentcategory_name`, `equipmentcategory_remark`, `created_by`, `modified_by`, `created_at`, `updated_at`, `status`) VALUES
(4, 'Logisitc', NULL, 4, NULL, '2015-02-27 19:10:15', '2015-02-28 06:17:15', 'Approved'),
(5, 'Technical', NULL, 4, NULL, '2015-02-27 19:10:15', '2015-02-28 06:17:18', 'Approved'),
(6, 'Audio', NULL, 4, NULL, '2015-02-27 19:10:15', '2015-02-28 06:17:21', 'Approved'),
(7, 'Dining Equipment', NULL, 4, NULL, '2015-02-27 19:13:55', '2015-02-28 06:17:33', 'Approved'),
(8, 'Sound Equipment', NULL, 4, NULL, '2015-02-27 19:13:55', '2015-02-28 06:17:30', 'Approved'),
(11, 'Logistic', NULL, 4, NULL, '2015-02-27 19:43:11', '2015-02-28 06:43:11', 'Pending');

--
-- Truncate table before insert `interest_field`
--

TRUNCATE TABLE `interest_field`;
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

--
-- Truncate table before insert `keywords`
--

TRUNCATE TABLE `keywords`;
--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`keyword_id`, `keyword_name`, `sub_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'cloud', 1, 0, NULL, '2015-03-02 03:47:58', '2015-03-02 11:47:58'),
(2, 'data center', 1, 0, NULL, '2015-03-02 03:47:58', '2015-03-02 11:47:58'),
(3, 'trends', 1, 0, NULL, '2015-03-02 03:47:58', '2015-03-02 11:47:58'),
(4, 'WiFi', 2, 7, NULL, '2015-03-02 08:06:11', NULL),
(5, 'RFID', 2, 7, NULL, '2015-03-02 08:06:11', NULL);

--
-- Truncate table before insert `room`
--

TRUNCATE TABLE `room`;
--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `venue_id`, `room_name`, `capacity`, `rental_cost`, `created_by`, `modified_by`, `created_at`, `updated_at`, `available`) VALUES
(1, 1, 'Hall 1', 400, '800.00', 4, NULL, '2015-02-27 19:10:15', '2015-02-28 06:10:15', 'yes'),
(2, 1, 'Hall 2', 450, '2000.00', 4, NULL, '2015-02-27 19:10:15', '2015-02-28 06:10:15', 'yes'),
(3, 1, 'Hall 3', 800, '4000.00', 4, NULL, '2015-02-27 19:10:15', '2015-02-28 06:10:15', 'yes'),
(4, 2, 'Room A', 80, '650.00', 4, NULL, '2015-02-27 19:13:55', '2015-02-28 06:13:55', 'yes'),
(5, 2, 'Room B', 70, '800.00', 4, NULL, '2015-02-27 19:13:55', '2015-02-28 06:13:55', 'yes'),
(6, 3, 'Sapphire', 800, '650.00', 4, NULL, '2015-02-27 19:23:31', '2015-02-28 06:23:31', 'yes'),
(7, 3, 'Topaz', 900, '800.00', 4, NULL, '2015-02-27 19:23:31', '2015-02-28 06:23:31', 'yes'),
(8, 3, 'Ruby', 1000, '950.00', 4, NULL, '2015-02-27 19:23:31', '2015-02-28 06:23:31', 'yes'),
(9, 3, 'Crystal', 1100, '1100.00', 4, NULL, '2015-02-27 19:23:31', '2015-02-28 06:23:31', 'yes'),
(10, 3, 'Diamond', 1200, '1250.00', 4, NULL, '2015-02-27 19:23:31', '2015-02-28 06:23:31', 'yes'),
(25, 4, 'Reservoir Hall 1', 800, '1000.00', 4, 4, '2015-02-27 19:43:11', '2015-02-28 06:43:53', 'yes'),
(26, 5, 'Conference Room A', 80, '650.00', 4, NULL, '2015-02-27 21:56:17', '2015-02-28 08:56:17', 'yes'),
(27, 5, 'Hall AAA', 500, '1200.00', 4, NULL, '2015-02-27 22:03:18', '2015-02-28 09:03:18', 'yes');

--
-- Truncate table before insert `room_equipment`
--

TRUNCATE TABLE `room_equipment`;
--
-- Dumping data for table `room_equipment`
--

INSERT INTO `room_equipment` (`roomequipment_id`, `room_id`, `equipment_id`, `quantity`, `remarks`, `created_by`, `modified_by`, `created_at`, `updated_at`, `equipment_status`) VALUES
(1, 1, 1, '400', NULL, 0, NULL, '2015-02-27 22:10:15', NULL, 'Pending'),
(2, 1, 2, '50', NULL, 0, NULL, '2015-02-27 22:10:15', NULL, 'Pending'),
(3, 2, 1, '800', NULL, 0, NULL, '2015-02-27 22:10:15', NULL, 'Pending'),
(4, 2, 3, '2', NULL, 0, NULL, '2015-02-27 22:10:15', NULL, 'Pending'),
(5, 3, 4, '6', NULL, 0, NULL, '2015-02-27 22:10:15', NULL, 'Pending'),
(6, 4, 5, '650', NULL, 0, NULL, '2015-02-27 22:13:55', NULL, 'Pending'),
(7, 5, 6, '4', NULL, 0, NULL, '2015-02-27 22:13:55', NULL, 'Pending'),
(8, 6, 5, '650', NULL, 0, NULL, '2015-02-27 22:23:31', NULL, 'Pending'),
(9, 7, 6, '4', NULL, 0, NULL, '2015-02-27 22:23:31', NULL, 'Pending'),
(11, 25, 5, '40', NULL, 0, NULL, '2015-02-27 22:43:53', NULL, 'Pending'),
(12, 25, 4, '5', NULL, 0, NULL, '2015-02-27 22:43:53', NULL, 'Pending'),
(13, 26, 5, '650', NULL, 0, NULL, '2015-02-28 00:56:17', NULL, 'Pending'),
(14, 27, 4, ' 1', NULL, 0, NULL, '2015-02-28 01:03:19', NULL, 'Pending'),
(15, 27, 6, ' 2', NULL, 0, NULL, '2015-02-28 01:03:19', NULL, 'Pending'),
(16, 27, 1, ' 40', NULL, 0, NULL, '2015-02-28 01:03:19', NULL, 'Pending');

--
-- Truncate table before insert `submissions`
--

TRUNCATE TABLE `submissions`;
--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`sub_id`, `user_id`, `conf_id`, `sub_type`, `sub_title`, `sub_abstract`, `attachment_path`, `sub_remarks`, `status`, `overall_score`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Submission 1', 'Abstract for Submission 1', 'uploads/503228.pdf', '', 0, 0, 0, NULL, '2015-03-02 03:47:58', '2015-03-02 11:47:58'),
(2, 7, 1, 1, 'Author Submission 1', 'Abstract for Author Submission 1', 'uploads/503228.pdf', '', 0, 0, 7, NULL, '2015-03-02 03:47:58', '2015-03-02 11:47:58');

--
-- Truncate table before insert `submission_authors`
--

TRUNCATE TABLE `submission_authors`;
--
-- Dumping data for table `submission_authors`
--

INSERT INTO `submission_authors` (`sub_id`, `email`, `first_name`, `last_name`, `organization`, `is_presenting`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'hedrensum@ntu.edu.sg', 'Hedren', 'Sum', 'NTU', 0, 0, NULL, '2015-03-02 03:47:59', '2015-03-02 11:47:59'),
(1, 'joanwee@ntu.edu.sg', 'Joan ', 'Wee', 'NTU', 1, 0, NULL, '2015-03-02 03:47:59', '2015-03-02 11:47:59'),
(2, 'trafalgar@ntu.edu.sg', 'Trafalgar', 'Law', 'Heart Pirates', 1, 7, NULL, '2015-03-02 03:47:59', '2015-03-02 11:47:59');

--
-- Truncate table before insert `submission_topic`
--

TRUNCATE TABLE `submission_topic`;
--
-- Dumping data for table `submission_topic`
--

INSERT INTO `submission_topic` (`topic_id`, `sub_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 2, 0, NULL, '2015-03-02 08:05:12', NULL),
(2, 2, 0, NULL, '2015-03-02 08:05:12', NULL),
(4, 1, 0, NULL, '2015-03-02 03:47:59', '2015-03-02 11:47:59'),
(5, 1, 0, NULL, '2015-03-02 03:47:59', '2015-03-02 11:47:59');

--
-- Truncate table before insert `venue`
--

TRUNCATE TABLE `venue`;
--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venue_name`, `venue_address`, `latitude`, `longitude`, `created_by`, `modified_by`, `created_at`, `updated_at`, `company_id`, `available`) VALUES
(1, 'Marina Bay Sand', 'Singapore Marina Bay Sands', '1.2838785', '103.85899', 4, NULL, '2015-02-27 19:10:15', '2015-02-28 06:10:15', 1, 'yes'),
(2, 'Singapore Expo', 'Singapore Expo', '1.334632', '103.961381', 4, NULL, '2015-02-27 19:13:55', '2015-02-28 06:13:55', 1, 'yes'),
(3, 'SIM UOW', 'Singapore Institude of Management', '1.296864', '103.800775', 4, NULL, '2015-02-27 19:23:31', '2015-02-28 06:23:31', 1, 'yes'),
(4, 'The M Hotel', 'Singapore Bedok Reservoir ', '1.3413025', '103.9245499', 4, NULL, '2015-02-27 19:43:11', '2015-02-28 06:43:11', 1, 'yes'),
(5, 'NTU', 'Nanyang Technological University ', '1.3483099', '103.6831347', 4, NULL, '2015-02-27 21:56:17', '2015-02-28 08:56:17', 1, 'yes');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
