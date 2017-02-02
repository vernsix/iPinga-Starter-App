-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2017 at 08:25 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipinga_starter`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `access_word` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `user_id`, `access_word`) VALUES
(1, 1, 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `environment` varchar(100) NOT NULL,
  `option_name` varchar(100) NOT NULL,
  `option_value` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=213 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `environment`, `option_name`, `option_value`) VALUES
(1, '', 'recaptcha_site_key', 'agjhkjwe589yihi235kjdgkug'),
(2, '', 'recaptcha_secret_key', 'gdslhli35y'),
(3, '', 'recaptcha_siteverify_url', 'https://www.google.com/recaptcha/api/siteverify'),
(4, '', 'use_recaptcha', 'yes'),
(20, '', 'logo_url', '/images/logo.jpg'),
(21, '', 'copyright_holder', 'Vern Six'),
(22, '', 'skin', 'sunny'),
(100, '', 'email_host', 'yourmailhost.com'),
(101, '', 'email_port', '587'),
(102, '', 'email_username', 'do-not-reply@example.com'),
(103, '', 'email_password', 'SDG$RWE@#sdgf'),
(104, '', 'email_localhost', 'localhost'),
(105, '', 'email_timeout', '15'),
(106, '', 'email_from', 'No Reply <do-not-reply@example.com>'),
(107, '', 'email_auth', 'yes'),
(200, '', 'environment_watermark', 'iPinga Starter App'),
(207, '', 'website_url', 'http://yoursite.com'),
(208, '', 'password_email_subject', 'Password Reset Instructions'),
(209, '', 'password_email_body', 'To reset your password, click this link :link:'),
(210, '', 'password_link_timeout', '10'),
(211, '', 'log_level', '0'),
(212, '', 'website_title', 'Your System');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `passwd`, `first_name`, `last_name`, `phone`) VALUES
(1, 'you@example.com', '3083ad189b494a1c3ba5e35e242565b8', 'FirstName', 'LastName', '515-555-1212');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
