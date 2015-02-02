-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2015 at 07:43 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `conforg_db`
--
CREATE DATABASE IF NOT EXISTS `conforg_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `conforg_db`;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `conference_topic`
--

INSERT INTO `conference_topic` (`topic_id`, `conf_id`, `topic_name`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 4, 'Blues', 0, NULL, '2015-01-29 12:16:44', NULL),
(2, 4, 'Jazz', 0, NULL, '2015-01-29 12:16:44', NULL),
(3, 4, 'Swing', 0, NULL, '2015-01-29 12:17:09', NULL),
(4, 4, 'Classical', 0, NULL, '2015-01-29 12:17:09', NULL);

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`keyword_id`,`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`keyword_id`, `keyword_name`, `sub_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(17, 'zoro', 3, 0, NULL, '2015-01-29 11:12:36', '2015-01-29 11:12:36'),
(21, 'music', 3, 0, NULL, '2015-01-29 12:46:55', '2015-01-29 12:46:55'),
(51, 'chopper', 1, 0, NULL, '2015-02-02 15:06:39', '2015-02-02 15:06:39'),
(52, 'sanji', 1, 0, NULL, '2015-02-02 15:06:39', '2015-02-02 15:06:39'),
(54, 'grapes', 39, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

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
  `is_accepted` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`),
  UNIQUE KEY `submissions_subtitle_unique` (`sub_title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`sub_id`, `user_id`, `conf_id`, `sub_type`, `sub_title`, `sub_abstract`, `attachment_path`, `sub_remarks`, `is_accepted`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Contribution 1 Updated', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'uploads/877983.pdf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 0, 1, NULL, '2015-01-17 15:27:32', '2015-02-02 15:06:23'),
(3, 1, 1, 2, 'Contribution 3 (2 was deleted!)', 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'uploads/129638.pdf', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 0, 1, NULL, '2015-01-17 16:31:43', NULL),
(39, 0, 0, 1, 'qwerty', 'fgfdfdfdfd', 'uploads/891655.pdf', 'read', 0, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sub_id`,`email`),
  UNIQUE KEY `submission_author_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submission_authors`
--

INSERT INTO `submission_authors` (`sub_id`, `email`, `first_name`, `last_name`, `organization`, `is_presenting`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'luffy@onepiece.com', 'Luffy', 'Monkey D.', 'Strawhat Pirates', 1, 0, NULL, '2015-02-02 00:23:52', NULL),
(1, 'zoro@onepiece.com', 'Zoro', 'Roronoa', 'Strawhat Pirates', 1, 0, NULL, '2015-02-02 00:23:52', NULL),
(3, 'law@onepiece.com', 'Law', 'Trafalgar D. Waters', 'Heart Pirates', 0, 0, NULL, '2015-02-02 00:24:52', NULL),
(3, 'robin@onepiece.com', 'Robin', 'Nico', 'Straw Hat Pirates', 1, 0, NULL, '2015-02-02 00:24:52', NULL),
(39, 'qq@n.c', 'qqq', 'qqq', 'qqq', 1, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`,`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `submission_topic`
--

INSERT INTO `submission_topic` (`topic_id`, `sub_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(2, 3, 0, NULL, '2015-01-29 13:09:29', '2015-01-29 13:09:29'),
(3, 1, 0, NULL, '2015-02-02 15:06:39', '2015-02-02 15:06:39'),
(4, 39, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
