-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-12-17 11:57:42
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wechat`
--

-- --------------------------------------------------------

--
-- 表的结构 `wx_admin`
--

CREATE TABLE IF NOT EXISTS `wx_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(25) COLLATE utf8_bin NOT NULL,
  `password` char(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wx_admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `wx_exchange_rate`
--

CREATE TABLE IF NOT EXISTS `wx_exchange_rate` (
  `type_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `expires` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `wx_token`
--

CREATE TABLE IF NOT EXISTS `wx_token` (
  `type_id` int(11) NOT NULL,
  `token` varchar(1024) COLLATE utf8_bin NOT NULL,
  `expires` int(11) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `wx_token`
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
