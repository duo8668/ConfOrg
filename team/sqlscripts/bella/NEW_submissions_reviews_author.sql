-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2015 at 03:04 PM
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `sub_id`, `user_id`, `internal_comment`, `comment`, `quality_score`, `relevance_score`, `originality_score`, `significance_score`, `presentation_score`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(3, 39, 3, '', 'pretty ok', 9, 7, 8, 6, 1, 0, NULL, '2015-02-08 21:06:20', '2015-02-08 23:02:34'),
(5, 3, 3, '', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. ', 6, 7, 8, 6, 10, 0, NULL, '2015-02-08 22:49:17', '2015-02-08 23:02:18');

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

INSERT INTO `submissions` (`sub_id`, `user_id`, `conf_id`, `sub_type`, `sub_title`, `sub_abstract`, `attachment_path`, `sub_remarks`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2, 'Contribution 1 Updated', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'uploads/877983.pdf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 0, 1, NULL, '2015-01-17 15:27:32', '2015-02-02 15:06:23'),
(3, 3, 2, 2, 'Contribution 3 (2 was deleted!)', 'Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'uploads/129638.pdf', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 0, 1, NULL, '2015-01-17 16:31:43', NULL),
(39, 1, 1, 1, 'qwerty', 'fgfdfdfdfd', 'uploads/891655.pdf', 'read', 0, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

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
(1, 'ace@onepiece.com', 'Ace', 'Portgas D.', 'Whitebeard Pirates', 1, 0, NULL, '2015-02-08 16:13:36', '2015-02-08 16:13:36'),
(1, 'jewelry@onepiece.com', 'Jewelry', 'Bonney', 'Shichibukai', 0, 0, NULL, '2015-02-08 16:13:36', '2015-02-08 16:13:36'),
(1, 'luffy@onepiece.com', 'Luffy', 'Monkey D', 'Strawhat Pirates', 1, 0, NULL, '2015-02-08 16:13:36', '2015-02-08 16:13:36'),
(3, 'law@onepiece.com', 'Law', 'Trafalgar D. Waters', 'Heart Pirates', 0, 0, NULL, '2015-02-02 00:24:52', NULL),
(3, 'robin@onepiece.com', 'Robin', 'Nico', 'Straw Hat Pirates', 1, 0, NULL, '2015-02-02 00:24:52', NULL),
(39, 'qq@n.c', 'qqq', 'qqq', 'qqq', 1, 0, NULL, '2015-02-02 15:33:52', '2015-02-02 15:33:52');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
