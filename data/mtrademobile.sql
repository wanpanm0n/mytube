-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2015 at 07:53 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mtrademobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `language_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_language_id_idx` (`language_id`),
  KEY `category_user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `language_id`, `user_id`, `created_date`, `modified_date`) VALUES
(2, 'Drama', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Comdey', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Romance', 1, 1, '2015-01-24 06:31:08', '2015-01-24 06:32:51'),
(6, 'Documentary', 1, 1, '2015-01-24 06:33:36', '2015-01-24 06:33:36'),
(7, 'Drama', 2, 1, '2015-01-24 08:13:41', '2015-01-24 08:13:41'),
(8, 'Dail Soap', 2, 1, '2015-01-24 14:59:17', '2015-01-24 14:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE IF NOT EXISTS `tbl_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title_unicode` varchar(255) CHARACTER SET utf8 NOT NULL,
  `link` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `duration` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_language_id_idx` (`language_id`),
  KEY `content_category_id_idx` (`category_id`),
  KEY `content_user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `title`, `title_unicode`, `link`, `description`, `image`, `duration`, `user_id`, `language_id`, `category_id`, `created_date`, `modified_date`) VALUES
(49, 'Bengali Show 1', 'ইবহমধষর ঞবষবারংরড়হ ঝযড়ি ১', 'www.youtube.com/v?=3ffdsf3ffddxs2', 'ঞযরং রং ধ নবহমধষর ঃবষবারংরড়হ ংযড়ি ফবংপৎরঢ়ঃরড়হ\r\nঞযরং রং ধ নবহমধষর ঃবষবারংরড়হ ংযড়ি ফবংপৎরঢ়ঃরড়হ\r\nঞযরং রং ধ নবহমধষর ঃবষবারংরড়হ ংযড়ি ফবংপৎরঢ়ঃরড়হ\r\nঞযরং রং ধ নবহমধষর ঃবষবারংরড়হ ংযড়ি ফবংপৎরঢ়ঃরড়হ', '20169-img.jpg', '20:20', 5, 2, 7, '2015-01-25 14:26:36', '2015-01-25 14:26:36'),
(50, 'Jire Khursani Episode 15', 'जिरे खुर्सानी भाग १५ ', 'https://www.youtube.com/watch?v=mUygbNy9VCo', 'जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी जिरे खुर्सानी ', '94613-brtnepal_20131111100951_Jire-Khursani.jpg', '20:20', 4, 1, 3, '2015-01-28 18:57:19', '2015-01-28 18:57:19'),
(51, 'Jire Khursani Episode 16', 'जिरे खुर्सानी भाग १६ ', 'https://www.youtube.com/watch?v=mUygbNy9VCo', 'जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ जिरे खुर्सानी भाग १६ ', '442-brtnepal_20131111100951_Jire-Khursani.jpg', '30:00', 4, 1, 3, '2015-01-28 18:59:42', '2015-01-28 18:59:42'),
(52, 'Bhadragol Episode 10', 'भद्रगोल भाग १० ', 'https://www.youtube.com/watch?v=PWqP2rps7xY', 'भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० भद्रगोल भाग १० ', '21844-watch-bhadragol-full-episode-new.jpg', '30', 4, 1, 3, '2015-01-28 19:03:39', '2015-01-28 19:03:39'),
(53, 'Fireside', 'फाइरसाइद ', 'www.youtube.com/v?=3ffdsf3ffddxs2', 'फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद फाइरसाइद ', '93414-fireside.jpg', '45:00', 4, 1, 6, '2015-01-28 19:07:58', '2015-01-28 19:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feeback` text NOT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `feeback_user_name` varchar(45) DEFAULT NULL,
  `language_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `feedback_language_id_idx` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE IF NOT EXISTS `tbl_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `modified_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`id`, `name`, `created_date`, `modified_date`) VALUES
(1, 'Nepali', '2015-01-24 06:02:33', '2015-01-24 06:02:33'),
(2, 'Bangladeshi', '2015-01-24 06:02:33', '2015-01-24 06:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title_unicode` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `language_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_user_id_idx` (`user_id`),
  KEY `notification_language_id_idx` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `title`, `title_unicode`, `description`, `start_date`, `end_date`, `language_id`, `user_id`, `created_date`, `modified_date`, `status`) VALUES
(1, 'Notification 1', 'Notification 1', 'This is notification 1', NULL, NULL, 1, 4, '2015-01-29 19:05:24', '0000-00-00 00:00:00', 1),
(2, 'Notification 3', 'Notification 3', 'Notification 3', NULL, NULL, 1, 4, '2015-01-29 19:07:46', '2015-01-29 19:18:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `language_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `language_id`) VALUES
(1, 'Admin', 'Administrator', 0),
(2, 'Demo', 'Demo', 0),
(4, 'upd', 'Upload1', 1),
(5, 'dsfdsf', 'Upload2', 2),
(7, 'sdfsdf', 'fsdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'language_id', 'Language', 'INTEGER', '11', '0', 2, '', '1==Nepali;2==Bangladeshi;3==Indonesian', 'Please select a language', '', '0', '', '', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_text`
--

CREATE TABLE IF NOT EXISTS `tbl_text` (
  `id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NULL DEFAULT NULL,
  `superuser` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@mail.com', '23432443242343', '2015-01-24 05:35:11', '2015-01-29 12:31:43', 1, 1),
(4, 'uploader1', 'b4190e42a5749f137b5e2e53c554dc71', 'adsfmin@mail.com', '83d02800c90ce4dcfa3659a80ff04a5f', '2015-01-24 02:11:52', '2015-01-29 12:31:54', 0, 1),
(5, 'uploader2', 'b4190e42a5749f137b5e2e53c554dc71', 'uploader2@mail.com', '60e62ff580f68801990d45c2d48f1135', '2015-01-24 08:13:35', '2015-01-28 11:01:24', 0, 1),
(7, 'fdsafasd', '3c81f6f6858656d40341d53c32b4a0bb', 'dsfdf@xdf.com', '15695d88e3811739fe83e040120d31b5', '2015-01-28 10:38:55', '0000-00-00 00:00:00', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD CONSTRAINT `category_language_id` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `category_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD CONSTRAINT `content_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `content_language_id` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `content_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `feedback_language_id` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD CONSTRAINT `notification_language_id` FOREIGN KEY (`language_id`) REFERENCES `tbl_language` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `notification_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
