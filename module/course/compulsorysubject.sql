-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2016 at 03:22 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jainpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `compulsorysubject`
--

CREATE TABLE IF NOT EXISTS `compulsorysubject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `compulsorysubject`
--

INSERT INTO `compulsorysubject` (`id`, `subname`) VALUES
(1, 'Hindi'),
(2, 'English'),
(3, 'Envi'),
(4, 'Elementry Computer');
