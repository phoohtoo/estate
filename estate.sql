-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2013 at 10:53 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `first_name`, `last_name`, `email_address`, `type`, `is_deleted`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', 'admin@localhost', 1, 0),
(5, 'phoehtoo', '21232f297a57a5a743894a0e4a801fc3', 'Phoe', 'Htoo', 'phoohtoo@gmail.com.mm', 3, 1),
(6, 'zarnimoeaung', 'admin', 'Zarni', 'moe aung', 'zarni@gmail.com', 0, 1),
(9, '', '', '', '', '', 0, 1),
(10, 'waiphyoethu', 'dfdfd', 'Wai', 'Phyoe Thu', 'waiphyoehtoo@gmail.com', 0, 0),
(11, 'lovermanager', 'dfdf', 'Mhan', 'Lay', 'lovermanager@gmail.com', 0, 0),
(12, 'just_testing', 'dfdf', 'dfdf', 'dfd', 'dfdfd', 0, 1),
(13, 'toemyintnaing', 'dfd', 'Toe', 'Myint Naing', 'black.toe@gmail.com', 0, 0),
(14, 'zinlay', 'dfd', 'Zin', 'Myint Naing', 'zinlay@gmail.com', 0, 0),
(15, 'bamhan', 'dfdf', 'Ba', 'Mhan', 'bamhan@gmail.com', 0, 0),
(16, 'dfd', 'dfd', 'dfd', 'dfdf', 'dfdf', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` int(11) NOT NULL,
  `eng_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mya_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `photo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `business_or_residence` int(11) NOT NULL,
  `sale_or_rent` int(11) NOT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `order_no`, `eng_title`, `mya_title`, `type_name`, `location`, `description`, `photo`, `business_or_residence`, `sale_or_rent`, `remark`, `is_active`, `is_deleted`) VALUES
(30, 0, 'Sale', '', 'Condominium', '', 'fdfdf dfdfdfdfdfddd ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '', 2, 1, '', 1, 0),
(31, 0, 'Rent', 'မငွားေတာ့ပါ', 'Condominium', '', '', '', 2, 2, '', 0, 0),
(32, 0, 'Sales or Rents', 'ငွားခ်င္လည္းငွားမယ္။ ေရာင္းခ်င္လည္း ေရာင္းမယ္။', 'Condominium', 'ကမာရြက္', 'မေျပာဘူး', '', 2, 2, '', 0, 0),
(33, 0, 'Rent', 'ငွားမွာေနာ္', 'Condominium', 'လမ္းမေတာ္', 'ေပ ၃၀ ၊ ေပ ၈၀', 'မရွိ', 1, 0, 'ပြဲစားမလိုပါ', 0, 0),
(34, 0, 'Rent', 'ငွားမည္', 'Hong Kong Style Apartment', 'မရမ္းကုန္း', '', '', 1, 1, 'ပြဲစားမလို', 0, 0),
(35, 0, '', '', 'Condominium', '', 'dddddddddddddddddddddddddd', '', 2, 2, '', 0, 0),
(36, 0, '', '', 'Condominium', '', '', '', 2, 2, '', 0, 0),
(37, 0, '', '', 'Condominium', '', '', '', 2, 2, '', 0, 0),
(38, 0, '', '', 'Condominium', '', '', '', 2, 2, '', 0, 1),
(39, 0, '''''''', '''''', 'Japan Style House', '', '', '', 2, 2, '', 0, 0),
(40, 0, '1gdfed'' dfdfd'' '' dfdf''', '', 'Condominium', '', '1234567890', '', 2, 2, '', 0, 0),
(41, 0, '', '', 'Condominium', '', '', '', 2, 2, '', 0, 1),
(42, 0, '', '', 'House', '', '', '', 2, 2, '', 0, 0),
(43, 0, 'dddd', 'ddd', 'Japan Style House', '', '', '', 2, 2, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`, `is_deleted`) VALUES
(1, 'Condominium', 0),
(2, 'Land', 0),
(3, 'House', 0),
(4, 'Apartment', 0),
(5, 'Hong Kong Style Apartment', 0),
(6, 'dfdfd', 1),
(7, 'Japan Style House', 0),
(8, 'Hut', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
