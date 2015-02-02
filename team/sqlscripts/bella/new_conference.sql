-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2015 at 02:44 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `conforg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
CREATE TABLE IF NOT EXISTS `conference` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `begin_date` date NOT NULL,
  `begin_time` datetime NOT NULL,
  `end_date` date NOT NULL,
  `end_time` datetime NOT NULL,
  `is_free` bit(1) NOT NULL DEFAULT b'0',
  `cutoff_time` datetime NOT NULL,
  `min_score` double NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`conf_id`),
  UNIQUE KEY `Title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `conference`
--

INSERT INTO `conference` (`conf_id`, `title`, `description`, `begin_date`, `begin_time`, `end_date`, `end_time`, `is_free`, `cutoff_time`, `min_score`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Conference 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-01-15', '2015-01-05 06:30:00', '2015-01-07', '2015-01-07 00:00:00', b'0', '0000-00-00 00:00:00', 0, 1, NULL, '2015-01-17 15:25:10', NULL),
(2, 'Conference 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2015-01-12', '2015-01-12 06:00:00', '2015-01-14', '2015-01-14 09:00:00', b'0', '0000-00-00 00:00:00', 0, 1, NULL, '2015-01-17 15:25:58', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
