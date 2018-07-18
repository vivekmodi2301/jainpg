-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2017 at 11:47 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

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
-- Table structure for table `boyfundexcelfile`
--

CREATE TABLE IF NOT EXISTS `boyfundexcelfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `boyfundexcelfile`
--

INSERT INTO `boyfundexcelfile` (`id`, `filename`, `date`) VALUES
(1, '16_Aug_2016_1471340866__studentlist.xls', '2016-08-16 15:17:47'),
(2, '16_Aug_2016_1471341098__studentlist.xls', '2016-08-16 15:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `boysfund`
--

CREATE TABLE IF NOT EXISTS `boysfund` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fund` varchar(50) DEFAULT NULL,
  `fees` int(4) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `dived` enum('1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `boysfund`
--

INSERT INTO `boysfund` (`id`, `fund`, `fees`, `year`, `dived`) VALUES
(2, 'Mag', 20, '2016-2017', '2'),
(3, 'Stu-Un', 20, '2016-2017', '1'),
(4, 'St-Aid', 50, '2016-2017', '1'),
(5, 'Misc', 210, '2016-2017', '1'),
(6, 'Enrol', 100, '2016-2017', '1'),
(7, 'Eligib', 100, '2016-2017', '2');

-- --------------------------------------------------------

--
-- Table structure for table `boysfunddte`
--

CREATE TABLE IF NOT EXISTS `boysfunddte` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `sid` int(6) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `funds` varchar(20) DEFAULT NULL,
  `fees` int(5) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  `cid` int(11) NOT NULL,
  `scid` int(11) NOT NULL,
  `dt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `boysfunddte`
--

INSERT INTO `boysfunddte` (`id`, `sid`, `date`, `funds`, `fees`, `year`, `cid`, `scid`, `dt`) VALUES
(1, 3, '2016-08-11 00:19:22', 'Mag', 10, 2016, 5, 25, '2016-08-10'),
(2, 3, '2016-08-11 00:19:23', 'Stu-Un', 20, 2016, 5, 25, '2016-08-10'),
(3, 3, '2016-08-11 00:19:24', 'St-Aid', 50, 2016, 5, 25, '2016-08-10'),
(4, 3, '2016-08-11 00:19:25', 'Misc', 210, 2016, 5, 25, '2016-08-10'),
(5, 3, '2016-08-11 00:19:26', 'Enrol', 100, 2016, 5, 25, '2016-08-10'),
(6, 3, '2016-08-11 00:19:27', 'Eligib', 50, 2016, 5, 25, '2016-08-10'),
(7, 2, '2016-08-11 00:20:53', 'Mag', 10, 2016, 4, 22, '2016-08-10'),
(8, 2, '2016-08-11 00:20:54', 'Stu-Un', 20, 2016, 4, 22, '2016-08-10'),
(9, 2, '2016-08-11 00:20:55', 'St-Aid', 50, 2016, 4, 22, '2016-08-10'),
(10, 2, '2016-08-11 00:20:56', 'Misc', 210, 2016, 4, 22, '2016-08-10'),
(11, 2, '2016-08-11 00:20:57', 'Enrol', 100, 2016, 4, 22, '2016-08-10'),
(12, 2, '2016-08-11 00:20:58', 'Eligib', 50, 2016, 4, 22, '2016-08-10'),
(13, 4, '2016-08-15 16:07:22', 'Mag', 10, 2016, 4, 23, '2016-08-15'),
(14, 4, '2016-08-15 16:07:23', 'Stu-Un', 20, 2016, 4, 23, '2016-08-15'),
(15, 4, '2016-08-15 16:07:24', 'St-Aid', 50, 2016, 4, 23, '2016-08-15'),
(16, 4, '2016-08-15 16:07:25', 'Misc', 210, 2016, 4, 23, '2016-08-15'),
(17, 4, '2016-08-15 16:07:26', 'Enrol', 100, 2016, 4, 23, '2016-08-15'),
(18, 4, '2016-08-15 16:07:27', 'Eligib', 50, 2016, 4, 23, '2016-08-15'),
(19, 4, '2016-08-17 15:23:13', 'Mag', 10, 2016, 4, 23, '2016-08-17'),
(20, 4, '2016-08-17 15:23:14', 'Eligib', 50, 2016, 4, 23, '2016-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `collegefund`
--

CREATE TABLE IF NOT EXISTS `collegefund` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `fund` varchar(40) DEFAULT NULL,
  `fees` int(4) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `dived` enum('1','2') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `collegefund`
--

INSERT INTO `collegefund` (`id`, `fund`, `fees`, `year`, `dived`) VALUES
(1, 'Reg.', 100, '2016-2017', '1'),
(2, 'Adm.', 100, '2016-2017', '1'),
(3, 'Games', 50, '2016-2017', '1'),
(4, 'Home', 300, '2016-2017', '1'),
(5, 'Caut', 500, '2016-2017', '1'),
(6, 'G-Uni', 100, '2016-2017', '1'),
(7, 'Dev', 150, '2016-2017', '1'),
(8, 'Compulsary Computer', 1100, '2016-2017', '1');

-- --------------------------------------------------------

--
-- Table structure for table `collegefunddte`
--

CREATE TABLE IF NOT EXISTS `collegefunddte` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `sid` int(5) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `funds` varchar(20) DEFAULT NULL,
  `fees` int(5) DEFAULT NULL,
  `year` int(5) DEFAULT NULL,
  `dt` date NOT NULL,
  `cid` int(11) NOT NULL,
  `scid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `collegefunddte`
--

INSERT INTO `collegefunddte` (`id`, `sid`, `date`, `funds`, `fees`, `year`, `dt`, `cid`, `scid`) VALUES
(1, 3, '2016-08-11 00:19:28', '1', 100, 2016, '2016-08-10', 5, 25),
(2, 3, '2016-08-11 00:19:29', '2', 100, 2016, '2016-08-10', 5, 25),
(3, 3, '2016-08-11 00:19:30', '3', 50, 2016, '2016-08-10', 5, 25),
(4, 3, '2016-08-11 00:19:31', '4', 300, 2016, '2016-08-10', 5, 25),
(5, 3, '2016-08-11 00:19:32', '5', 500, 2016, '2016-08-10', 5, 25),
(6, 3, '2016-08-11 00:19:33', '6', 100, 2016, '2016-08-10', 5, 25),
(7, 3, '2016-08-11 00:19:34', '7', 150, 2016, '2016-08-10', 5, 25),
(8, 3, '2016-08-11 00:19:35', '8', 1100, 2016, '2016-08-10', 5, 25),
(9, 2, '2016-08-11 00:20:59', '1', 100, 2016, '2016-08-10', 4, 22),
(10, 2, '2016-08-11 00:21:00', '2', 100, 2016, '2016-08-10', 4, 22),
(11, 2, '2016-08-11 00:21:01', '3', 50, 2016, '2016-08-10', 4, 22),
(12, 2, '2016-08-11 00:21:02', '4', 300, 2016, '2016-08-10', 4, 22),
(13, 2, '2016-08-11 00:21:03', '5', 500, 2016, '2016-08-10', 4, 22),
(14, 2, '2016-08-11 00:21:04', '6', 100, 2016, '2016-08-10', 4, 22),
(15, 2, '2016-08-11 00:21:05', '7', 150, 2016, '2016-08-10', 4, 22),
(16, 2, '2016-08-11 00:21:06', '8', 1100, 2016, '2016-08-10', 4, 22),
(17, 4, '2016-08-15 16:07:28', '1', 100, 2016, '2016-08-15', 4, 23),
(18, 4, '2016-08-15 16:07:30', '2', 100, 2016, '2016-08-15', 4, 23),
(19, 4, '2016-08-15 16:07:31', '3', 50, 2016, '2016-08-15', 4, 23),
(20, 4, '2016-08-15 16:07:32', '4', 300, 2016, '2016-08-15', 4, 23),
(21, 4, '2016-08-15 16:07:33', '5', 500, 2016, '2016-08-15', 4, 23),
(22, 4, '2016-08-15 16:07:34', '6', 100, 2016, '2016-08-15', 4, 23),
(23, 4, '2016-08-15 16:07:35', '7', 150, 2016, '2016-08-15', 4, 23),
(24, 4, '2016-08-15 16:07:36', '8', 1100, 2016, '2016-08-15', 4, 23);

-- --------------------------------------------------------

--
-- Table structure for table `collegefunddtlexcelfile`
--

CREATE TABLE IF NOT EXISTS `collegefunddtlexcelfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `collegefunddtlexcelfile`
--


-- --------------------------------------------------------

--
-- Table structure for table `collegefundexcelfile`
--

CREATE TABLE IF NOT EXISTS `collegefundexcelfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `collegefundexcelfile`
--

INSERT INTO `collegefundexcelfile` (`id`, `filename`, `date`) VALUES
(1, '10_Aug_2016_1470855529__studentlist.xls', '2016-08-11 00:28:51'),
(2, '10_Aug_2016_1470855837__studentlist.xls', '2016-08-11 00:33:58'),
(3, '10_Aug_2016_1470856449__studentlist.xls', '2016-08-11 00:44:10'),
(4, '10_Aug_2016_1470856556__studentlist.xls', '2016-08-11 00:45:57'),
(5, '10_Aug_2016_1470856780__studentlist.xls', '2016-08-11 00:49:41');

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

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `coursename` varchar(30) NOT NULL,
  `classcode` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `coursename`, `classcode`) VALUES
(1, 'BA', 'ba'),
(2, 'B.com', 'bcom'),
(3, 'B.C.A', 'bca'),
(4, 'M.Sc.IT', 'msc'),
(5, 'M.Sc.CS', 'msc'),
(6, 'M.Com.', 'mcom'),
(7, 'M.A.', 'ma');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `refundexe`
--

CREATE TABLE IF NOT EXISTS `refundexe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `refundexe`
--


-- --------------------------------------------------------

--
-- Table structure for table `student1`
--

CREATE TABLE IF NOT EXISTS `student1` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `cid` int(6) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `optsubject` varchar(500) NOT NULL,
  `scid` int(4) NOT NULL,
  `regyear` varchar(10) NOT NULL,
  `resident` enum('y','n') NOT NULL,
  `category` enum('sc','st','obc','sbc','saharia','gen') NOT NULL,
  `bpl` enum('y','n') NOT NULL,
  `std` varchar(5) NOT NULL,
  `phone` varchar(8) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `year` varchar(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `obtain` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `board_name` varchar(100) NOT NULL,
  `dt` date NOT NULL,
  `cid_change` int(11) NOT NULL,
  `scid_change` int(11) NOT NULL,
  `optsub_change` varchar(500) NOT NULL,
  `refund_reson` varchar(500) NOT NULL,
  `refund_date` datetime NOT NULL,
  `refund_fees` varchar(10) NOT NULL,
  `old_cid` varchar(5) NOT NULL,
  `old_scid` varchar(5) NOT NULL,
  `old_subject` varchar(300) NOT NULL,
  `scholarcode` int(11) NOT NULL,
  `submitDate` date NOT NULL,
  `compulsorysubject` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student1`
--

INSERT INTO `student1` (`id`, `name`, `cid`, `fname`, `optsubject`, `scid`, `regyear`, `resident`, `category`, `bpl`, `std`, `phone`, `mobile`, `class`, `year`, `subject`, `obtain`, `total`, `percentage`, `board_name`, `dt`, `cid_change`, `scid_change`, `optsub_change`, `refund_reson`, `refund_date`, `refund_fees`, `old_cid`, `old_scid`, `old_subject`, `scholarcode`, `submitDate`, `compulsorysubject`) VALUES
(1, 'vivek modi', 2, 'manohar lal modi', 'ABST,B and FM,Computer Application', 13, '2016-2017', 'y', 'gen', 'n', ' 0151', '87687798', '8768767678', '12', '2016', 'commerce', 600, 300, 50, 'RBSE', '2016-08-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '', '', '', 1, '2016-08-08', 'Hindi,English,Envi,Elementry Computer'),
(2, 'ankit sharma', 4, 'anil sharma', 'Web Technology and Sof,OOPS with C pp,Operating System,Computer Organization and Architecture,Data Communication and Networking,Relational Database Managment System,Lab - Internet and Web,Lab - C pp,Lab - RDBMS', 22, '2016-2017', 'y', 'gen', 'n', ' 0151', '2232190', '9799770038', '12', '2014', 'commerce', 500, 250, 50, 'RBSE', '2016-08-09', 0, 0, '', '', '0000-00-00 00:00:00', '', '', '', '', 2, '2016-08-09', 'Hindi,English,Envi,Elementry Computer'),
(3, 'ramesh', 5, 'suresh', 'Data and File Structure using C / C pp,Computer Graphics,Java ,Discrete Mathematics,Web Application Development,current trends and technologies,Lab - Data and File Structure Using C / C pp,lab - java and web application development,Project', 25, '2016-2017', 'y', 'sbc', 'n', ' 0151', '78689709', '76875756897', '12', '2014', 'commerce', 600, 300, 50, 'RBSE', '2016-08-09', 0, 0, '', '', '0000-00-00 00:00:00', '', '', '', '', 3, '2016-08-09', 'Hindi,English,Envi,Elementry Computer'),
(4, 'raj', 4, 'shivam', 'Data and File Structure using C / C pp,Java ,Web Application Development using asp.net,Computer Graphics,Computer Graphics,Discrete Maths and Itrative Method,Artificial Intilligence(A),Lab - Data and File Structure Using C / C pp,Lab- Java and Asp.net', 23, '2016-2017', 'y', 'gen', 'n', ' 0151', '98879', '65767657687', '', '', '', 0, 0, 0, '', '2016-08-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '4', '22', 'Web Technology and Sof,OOPS with C pp,Operating System,Computer Organization and Architecture,Data Communication and Networking,Relational Database Managment System,Lab - Internet and Web,Lab - C pp,Lab - RDBMS', 4, '2016-08-15', 'Hindi,English,Envi,Elementry Computer');

-- --------------------------------------------------------

--
-- Table structure for table `studentexcelfile`
--

CREATE TABLE IF NOT EXISTS `studentexcelfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `studentexcelfile`
--

INSERT INTO `studentexcelfile` (`id`, `filename`, `date`) VALUES
(1, '10_Aug_2016_1470822174__studentlist.xls', '2016-08-10 15:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `studentfees`
--

CREATE TABLE IF NOT EXISTS `studentfees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tution_fees` varchar(15) NOT NULL,
  `dte` date NOT NULL,
  `cid` int(11) NOT NULL,
  `scid` int(11) NOT NULL,
  `extraFees` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `studentfees`
--

INSERT INTO `studentfees` (`id`, `sid`, `fees`, `dt`, `tution_fees`, `dte`, `cid`, `scid`, `extraFees`) VALUES
(1, 3, 9500, '2016-08-11 00:19:36', '6600', '2016-08-10', 5, 25, ''),
(2, 2, 9500, '2016-08-11 00:21:07', '6600', '2016-08-10', 4, 22, ''),
(3, 4, 9500, '2016-08-15 16:07:37', '6600', '2016-08-15', 4, 23, ''),
(4, 4, 8700, '2016-08-17 15:23:15', '8580', '2016-08-17', 4, 23, '');

-- --------------------------------------------------------

--
-- Table structure for table `subcourse`
--

CREATE TABLE IF NOT EXISTS `subcourse` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `cid` int(2) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fees` int(6) DEFAULT NULL,
  `instalment1` int(6) DEFAULT NULL,
  `instalment2` int(6) DEFAULT NULL,
  `total_group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `subcourse`
--

INSERT INTO `subcourse` (`id`, `cid`, `name`, `fees`, `instalment1`, `instalment2`, `total_group`) VALUES
(1, 1, 'part-1', 7900, 5200, 2700, 3),
(2, 1, 'part-2', 6200, 3500, 2700, 3),
(3, 1, 'part-3', 6200, 3500, 2700, 3),
(4, 10, 'part-1', 8500, 5500, 3000, 3),
(5, 10, 'part-2', 6800, 3800, 3000, 3),
(6, 10, 'part-3', 6800, 3800, 3000, 3),
(7, 8, 'part-1', 12700, 7600, 5100, 3),
(8, 8, 'part-2', 11000, 5900, 5100, 3),
(9, 8, 'part-3', 11000, 5900, 5100, 3),
(10, 11, 'part-1', 13300, 7900, 5400, 3),
(11, 11, 'part-2', 11600, 6200, 5400, 3),
(12, 11, 'part-3', 11600, 6200, 5400, 3),
(13, 2, 'part-1', 7900, 5200, 2700, 3),
(14, 2, 'part-2', 6200, 3500, 2700, 3),
(15, 2, 'part-3', 6200, 3500, 2700, 3),
(16, 9, 'part-1', 12700, 7600, 5100, 3),
(17, 9, 'part-2', 11000, 5900, 5100, 3),
(18, 9, 'part-3', 11000, 5900, 5100, 3),
(19, 3, 'part-1', 17000, 9200, 7800, 9),
(20, 3, 'part-2', 16400, 8600, 7800, 9),
(21, 3, 'part-3', 16400, 8600, 7800, 9),
(22, 4, 'previous', 18200, 9500, 8700, 9),
(23, 4, 'final', 18200, 9500, 8700, 9),
(24, 5, 'previous', 18200, 9500, 8700, 9),
(25, 5, 'final', 18200, 9500, 8700, 9),
(26, 6, 'previous', 6200, 3500, 2700, 4),
(27, 6, 'final', 6200, 3500, 2700, 5),
(28, 7, 'previous', 6200, 3500, 2700, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cid` int(2) DEFAULT NULL,
  `scid` int(3) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `extraFees` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `scid` (`scid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `cid`, `scid`, `name`, `extraFees`) VALUES
(1, 2, 13, 'ABST', 0),
(2, 2, 13, 'B and FM', 0),
(3, 2, 13, 'B.M.', 0),
(4, 2, 13, 'Computer Application', 4800),
(5, 3, 19, 'Fundamental Maths', 0),
(6, 3, 19, 'Com. Fund. and Office Auto.', 0),
(7, 3, 19, 'Internet and Web Prog.', 0),
(8, 3, 19, 'C- Prog.', 0),
(9, 3, 19, 'DBMS', 0),
(10, 3, 19, 'Comp. Archi.', 0),
(11, 3, 20, 'Data Stru.', 0),
(12, 3, 20, 'C pp Prog.', 0),
(13, 3, 20, 'Comp. Networks', 0),
(14, 3, 20, 'Operating Systems', 0),
(15, 3, 20, 'Discrete Maths', 0),
(16, 3, 20, 'ADBMS', 0),
(17, 3, 21, 'Soft. Eng. and VB', 0),
(18, 3, 21, 'JAVA Prog.', 0),
(19, 3, 21, 'Network Security and Data Comm.', 0),
(20, 3, 21, 'A W P', 0),
(21, 3, 21, 'C G and IP', 0),
(22, 3, 21, 'O B', 0),
(23, 3, 21, 'E- Comm. E- Banking and Security Transaction', 0),
(24, 1, 1, 'Political Science', 0),
(25, 1, 1, 'Public Administration', 0),
(26, 1, 1, 'Computer Application', 4800),
(27, 1, 1, 'Sociology', 0),
(28, 1, 1, 'Economics', 0),
(29, 1, 1, 'Sanskrit', 0),
(30, 1, 1, 'History', 0),
(31, 1, 1, 'Home Science', 600),
(32, 1, 1, 'Hindi Literature', 0),
(33, 1, 1, 'English Literature', 0),
(34, 1, 2, 'Political Science', 0),
(35, 1, 2, 'Public Administratio', 0),
(36, 1, 2, 'Computer Application', 4800),
(37, 1, 2, 'Sociology', 0),
(38, 1, 2, 'Economics', 0),
(39, 1, 2, 'Sanskrit', 0),
(40, 1, 2, 'History', 0),
(41, 1, 2, 'Home Science', 600),
(42, 1, 2, 'Hindi Literature', 0),
(43, 1, 2, 'English Literature', 0),
(44, 1, 3, 'Political Science', 0),
(45, 1, 3, 'Public Administratio', 0),
(46, 1, 3, 'Computer Application', 4800),
(47, 1, 3, 'Sociology', 0),
(48, 1, 3, 'Economics', 0),
(49, 1, 3, 'Sanskrit', 0),
(50, 1, 3, 'History', 0),
(51, 1, 3, 'Home Science', 600),
(52, 1, 3, 'Hindi Literature', 0),
(53, 1, 3, 'English Literature', 0),
(54, 2, 14, 'ABST', 0),
(55, 2, 14, 'B and FM', 0),
(56, 2, 14, 'Business Managment', 0),
(57, 2, 14, 'Computer Application', 4800),
(58, 2, 15, 'ABST', 0),
(59, 2, 15, 'B and FM', 0),
(60, 2, 15, 'Business Managment', 0),
(61, 2, 15, 'Computer Application', 4800),
(62, 3, 19, 'lab - ms office', 0),
(63, 3, 19, 'lab - c programming', 0),
(64, 3, 19, 'lab - web programming', 0),
(65, 3, 20, 'lab - DS', 0),
(66, 3, 20, 'lab - c pp programming', 0),
(67, 3, 20, 'lab - unix and dbms', 0),
(68, 3, 21, 'lab - java and v b programming', 0),
(69, 3, 21, 'lab - a w p and c g', 0),
(70, 3, 21, 'project', 0),
(71, 4, 22, 'Web Technology and Sof', 0),
(72, 4, 22, 'OOPS with C pp', 0),
(73, 4, 22, 'Operating System', 0),
(74, 4, 22, 'Computer Organization and Architecture', 0),
(75, 4, 22, 'Data Communication and Networking', 0),
(76, 4, 22, 'Relational Database Managment System', 0),
(77, 4, 22, 'Lab - Internet and Web', 0),
(78, 4, 22, 'Lab - C pp', 0),
(79, 4, 22, 'Lab - RDBMS', 0),
(80, 4, 23, 'Data and File Structure using C / C pp', 0),
(81, 4, 23, 'Java ', 0),
(82, 4, 23, 'Web Application Development using asp.net', 0),
(83, 4, 23, 'Computer Graphics', 0),
(84, 4, 23, 'Discrete Maths and Itrative Method', 0),
(85, 4, 23, 'Artificial Intilligence(A)', 0),
(86, 4, 23, 'Data Warehousing and Data Mining(B)', 0),
(87, 4, 23, 'Communication Theory (C)', 0),
(88, 4, 23, 'Lab - Data and File Structure Using C / C pp', 0),
(89, 4, 23, 'Lab- Java and Asp.net', 0),
(90, 4, 23, 'Project', 0),
(91, 5, 24, 'Computer Organization and Architecture', 0),
(92, 5, 24, 'Programing With Cpp', 0),
(93, 5, 24, 'Relational Database Managment System', 0),
(94, 5, 24, 'Operating System', 0),
(95, 5, 24, 'Data Communication and Networking', 0),
(96, 5, 24, 'Software Engineering and Visual Basic', 0),
(97, 5, 24, 'Lab - Programing with C pp', 0),
(98, 5, 24, 'Lab - Relational Database Managment Syst', 0),
(99, 5, 24, 'Lab - Visual Basic', 0),
(100, 5, 25, 'Data and File Structure using C / C pp', 0),
(101, 5, 25, 'Computer Graphics', 0),
(102, 5, 25, 'Java ', 0),
(103, 5, 25, 'Discrete Mathematics', 0),
(104, 5, 25, 'Web Application Development', 0),
(105, 5, 25, 'Artificial Intilligence(A)', 0),
(106, 5, 25, 'current trends and technologies', 0),
(107, 5, 25, 'formal languages and automata theory', 0),
(108, 5, 25, 'Lab - Data and File Structure Using C / C pp', 0),
(109, 5, 25, 'lab - java and web application development', 0),
(110, 5, 25, 'Project', 0),
(111, 6, 26, 'management - accounting and financial control', 0),
(112, 6, 26, 'research methodology and statistical techniques', 0),
(113, 6, 26, 'higher accounting', 0),
(114, 6, 26, 'cost accounting and cost control', 0),
(115, 6, 27, 'direct and indirect taxes', 0),
(116, 6, 27, 'operational research and quantitative techniques', 0),
(117, 6, 27, 'management and operational audit', 0),
(118, 6, 27, 'advanced costing problems', 0),
(119, 6, 27, 'project planning appraisal and control', 0),
(120, 6, 27, 'taxation and tax planning', 0),
(121, 6, 27, 'dissertation', 0),
(122, 1, 1, 'Geography', 0),
(123, 1, 2, 'Geography', 0),
(124, 1, 3, 'Geography', 0),
(125, 1, 1, 'urdu', 0),
(126, 8, 7, 'Sociology', 0),
(127, 8, 7, 'Economics', 0),
(128, 8, 7, 'Sanskrit', 0),
(129, 8, 7, 'History', 0),
(130, 8, 7, 'HomeScience', 0),
(131, 8, 7, 'Hindi Literature', 0),
(132, 8, 7, 'English Literature', 0),
(134, 8, 7, 'Geography', 0),
(136, 9, 16, 'B and FM', 0),
(137, 9, 16, 'ABST', 0),
(138, 10, 4, 'Political Science', 0),
(139, 10, 4, 'Public Administratio', 0),
(141, 10, 4, 'Sociology', 0),
(142, 10, 4, 'Economics', 0),
(143, 10, 4, 'Sanskrit', 0),
(144, 10, 4, 'Hindi Literature', 0),
(145, 10, 4, 'English Literature', 0),
(148, 11, 10, 'Sociology', 0),
(149, 11, 10, 'Economics', 0),
(150, 11, 10, 'Sanskrit', 0),
(152, 11, 10, 'Hindi Literature', 0),
(153, 11, 10, 'English Literature', 0),
(155, 8, 8, 'Sociology', 0),
(156, 8, 8, 'Economics', 0),
(157, 8, 8, 'Sanskrit', 0),
(158, 8, 8, 'History', 0),
(160, 8, 8, 'Geography', 0),
(161, 8, 8, 'Hindi Literature', 0),
(162, 8, 8, 'English Literature', 0),
(164, 8, 9, 'Sociology', 0),
(165, 8, 9, 'Economics', 0),
(166, 8, 9, 'Sanskrit', 0),
(167, 8, 9, 'History', 0),
(169, 8, 9, 'Geography', 0),
(170, 8, 9, 'Hindi Literature', 0),
(171, 8, 9, 'English Literature', 0),
(172, 9, 17, 'ABST', 0),
(173, 9, 17, 'B and FM', 0),
(175, 9, 18, 'ABST', 0),
(176, 9, 18, 'B and FM', 0),
(178, 10, 5, 'Political Science', 0),
(179, 10, 5, 'Public Administratio', 0),
(181, 10, 5, 'Sociology', 0),
(182, 10, 5, 'Economics', 0),
(183, 10, 5, 'Sanskrit', 0),
(185, 10, 5, 'Hindi Literature', 0),
(186, 10, 5, 'English Literature', 0),
(187, 10, 6, 'Political Science', 0),
(188, 10, 6, 'Public Administratio', 0),
(190, 10, 6, 'Sociology', 0),
(191, 10, 6, 'Economics', 0),
(192, 10, 6, 'Sanskrit', 0),
(194, 10, 6, 'Hindi Literature', 0),
(195, 10, 6, 'English Literature', 0),
(197, 11, 11, 'Sociology', 0),
(198, 11, 11, 'Economics', 0),
(199, 11, 11, 'Sanskrit', 0),
(201, 11, 11, 'Hindi Literature', 0),
(202, 11, 11, 'English Literature', 0),
(204, 11, 12, 'Sociology', 0),
(205, 11, 12, 'Economics', 0),
(206, 11, 12, 'Sanskrit', 0),
(208, 11, 12, 'Hindi Literature', 0),
(209, 11, 12, 'English Literature', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjectgroup`
--

CREATE TABLE IF NOT EXISTS `subjectgroup` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) DEFAULT NULL,
  `cid` int(3) DEFAULT NULL,
  `groupsub` varchar(500) DEFAULT NULL,
  `scid` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;

--
-- Dumping data for table `subjectgroup`
--

INSERT INTO `subjectgroup` (`id`, `gname`, `cid`, `groupsub`, `scid`) VALUES
(1, ' Group1', 1, 'Political Science, Public Administration, Computer Application', 1),
(2, ' Group2  ', 1, 'Sociology, Economics, Sanskrit', 1),
(3, ' Group3', 1, 'History, Home Science, Geography', 1),
(4, ' Group4', 1, 'Hindi Literature, English Literature', 1),
(5, 'Group1', 1, 'Political Science, Public Administratio, Computer Application', 2),
(6, 'Group2', 1, 'Sociology, Economics, Sanskrit', 2),
(7, 'Group3', 1, 'History, Home Science, Geography', 2),
(8, 'Group4', 1, 'Hindi Literature, English Literature', 2),
(9, 'Group1', 1, 'Political Science, Public Administratio, Computer Application', 3),
(10, 'Group2', 1, 'Sociology, Economics, Sanskrit', 3),
(11, 'Group3', 1, 'History, Home Science, Geography', 3),
(12, 'Group4', 1, 'Hindi Literature, English Literature', 3),
(13, 'Group1', 2, 'ABST', 13),
(14, 'Group2 ', 2, 'B and FM', 13),
(15, 'Group3', 2, 'B.M., Computer Application', 13),
(16, 'Group1', 2, 'ABST', 14),
(17, 'Group2 ', 2, 'B and FM', 14),
(18, 'Group3', 2, 'Business Managment, Computer Application', 14),
(19, 'Group1', 2, 'ABST', 15),
(20, 'Group2 ', 2, 'B and FM', 15),
(21, 'Group3', 2, 'Business Managment, Computer Application', 15),
(22, 'Group1 ', 3, 'Fundamental Maths', 19),
(24, 'Group1 ', 3, 'Soft. Eng. and VB', 21),
(25, 'Group1 ', 4, 'Web Technology and Sof', 22),
(26, 'Group1 ', 4, 'Data and File Structure using C / C pp', 23),
(27, 'Group1 ', 5, 'Computer Organization and Architecture', 24),
(28, 'Group1 ', 5, 'Data and File Structure using C / C pp', 25),
(29, 'Group1 ', 6, 'management - accounting and financial control', 26),
(30, 'Group1 ', 6, 'direct and indirect taxes, operational research and quantitative techniques, management and operational audit', 27),
(31, 'Group2', 6, 'advanced costing problems', 27),
(32, 'Group3 ', 6, 'project planning appraisal and control', 27),
(33, 'Group4 ', 6, 'taxation and tax planning', 27),
(34, 'Group5', 6, 'dissertation', 27),
(36, 'Group2', 5, 'Programing With C pp', 24),
(37, 'Group3 ', 5, 'Relational Database Managment System', 24),
(38, 'Group4', 5, 'Operating System', 24),
(39, 'Group5', 5, 'Data Communication and Networking', 24),
(40, 'Group6', 5, 'Software Engineering and Visual Basic', 24),
(41, 'Group7', 5, 'Lab - Programing with C pp', 24),
(42, 'Group8 ', 5, 'Lab - C pp', 0),
(43, 'Group9', 5, 'Lab - Visual Basic', 24),
(44, 'Group2', 4, 'OOPS with C pp', 22),
(45, 'Group3', 4, 'Operating System', 22),
(46, 'Group4', 4, 'Computer Organization and Architecture', 22),
(47, 'Group5', 4, 'Data Communication and Networking', 22),
(48, 'Group6', 4, 'Relational Database Managment System', 22),
(49, 'Group7', 4, 'Lab - Internet and Web', 22),
(50, 'Group8', 4, 'Lab - C pp', 22),
(51, 'Group9', 4, 'Lab - RDBMS', 22),
(52, 'Group2', 5, 'Computer Graphics', 25),
(53, 'Group3', 5, 'Java ', 25),
(54, 'Group4', 5, 'Discrete Mathematics', 25),
(55, 'Group5', 5, 'Web Application Development', 25),
(56, 'Group6', 5, 'Artificial Intilligence(A), current trends and technologies, formal languages and automata theory', 25),
(57, 'Group7', 5, 'Lab - Data and File Structure Using C / C pp', 25),
(58, 'Group8', 5, 'lab - java and web application development', 25),
(59, 'Group9', 5, 'Project', 25),
(60, 'Group2', 4, 'Java ', 23),
(61, ' Group3', 4, 'Web Application Development using asp.net', 23),
(62, 'Group4', 4, 'Computer Graphics', 23),
(63, 'Group4', 4, 'Computer Graphics', 23),
(64, 'Group5', 4, 'Discrete Maths and Itrative Method', 23),
(65, 'Group6', 4, 'Artificial Intilligence(A), Data Warehousing and Data Mining(B), Communication Theory (C)', 23),
(66, 'Group7', 4, 'Lab - Data and File Structure Using C / C pp', 23),
(67, 'Group8', 4, 'Lab- Java and Asp.net', 23),
(68, 'Group2', 3, 'Com. Fund. and Office Auto.', 19),
(69, 'Group3', 3, 'Internet and Web Prog.', 19),
(70, 'Group4', 3, 'C- Prog.', 19),
(71, 'Group5', 3, 'DBMS', 19),
(72, 'Group6', 3, 'Comp. Archi.', 19),
(73, 'Group7', 3, 'lab - ms office', 19),
(74, 'Group8', 3, 'lab - c programming', 19),
(75, 'Group9', 3, 'lab - web programming', 19),
(76, 'Group1', 3, 'Data Stru.', 20),
(77, 'Group2', 3, 'C pp Prog.', 20),
(78, 'Group3', 3, 'Comp. Networks', 20),
(79, 'Group4', 3, 'Operating Systems', 20),
(80, 'Group5', 3, 'Discrete Maths', 20),
(81, 'Group6', 3, 'ADBMS', 20),
(82, 'Group7', 3, 'lab - DS', 20),
(84, 'Group9', 3, 'lab - unix and dbms', 20),
(85, 'Group8', 3, 'lab - c pp programming', 20),
(86, 'Group2', 3, 'JAVA Prog.', 21),
(87, 'Group3', 3, 'Network Security and Data Comm.', 21),
(88, 'Group4', 3, 'A W P', 21),
(89, 'Group5', 3, 'C G and IP', 21),
(90, 'Group6', 3, 'O B, E- Comm. E- Banking and Security Transaction', 21),
(91, 'Group7', 3, 'lab - java and v b programming', 21),
(92, 'Group8', 3, 'lab - a w p and c g', 21),
(93, 'Group9', 3, 'project', 21),
(94, 'Group2', 6, 'research methodology and statistical techniques', 26),
(95, 'Group3', 6, 'higher accounting', 26),
(96, 'Group4', 6, 'cost accounting and cost control', 26),
(97, ' Group1', 8, 'Computer Application', 7),
(98, 'Group2', 8, 'Sociology, Economics, Sanskrit', 7),
(99, 'Group3', 8, 'History, HomeScience, Geography', 7),
(100, 'Group4', 8, 'Hindi Literature, English Literature', 7),
(101, 'Group1', 10, 'Political Science, Public Administratio, Computer Application', 4),
(102, 'Group2', 10, 'Sociology, Economics, Sanskrit', 4),
(103, 'Group3', 10, 'Home Science', 4),
(104, 'Group4', 10, 'Hindi Literature, English Literature', 4),
(105, 'Group1', 8, 'Computer Application', 8),
(106, 'Group2', 8, 'Sociology, Economics, Sanskrit', 8),
(107, 'Group3', 8, 'History, Home Science, Geography', 8),
(108, 'Group4', 8, 'Hindi Literature, English Literature', 8),
(109, 'Group1', 8, 'Computer Application', 9),
(110, 'Group2', 8, 'Sociology, Economics, Sanskrit', 9),
(111, 'Group3', 8, 'History, Home Science, Geography', 9),
(112, 'Group4', 8, 'Hindi Literature, English Literature', 9),
(113, 'Group1', 11, 'Computer Application', 10),
(114, 'Group2', 11, 'Sociology, Economics, Sanskrit', 10),
(115, 'Group3', 11, 'Home Science', 10),
(116, 'Group4', 11, 'Hindi Literature, English Literature', 10),
(117, 'Group1', 10, 'Political Science, Public Administratio, Computer Application', 5),
(118, 'Group2', 10, 'Sociology, Economics, Sanskrit', 5),
(119, 'Group3', 10, 'Home Science', 5),
(120, 'Group4', 10, 'Hindi Literature, English Literature', 5),
(121, 'Group1', 10, 'Political Science, Public Administratio, Computer Application', 6),
(122, 'Group2', 10, 'Sociology, Economics, Sanskrit', 6),
(123, 'Group3', 10, 'Home Science', 6),
(124, 'Group4', 10, 'Hindi Literature, English Literature', 6),
(125, 'Group1', 11, 'Computer Application', 11),
(126, 'Group2', 11, 'Sociology, Economics, Sanskrit', 11),
(127, 'Group3', 11, 'Home Science', 11),
(128, 'Group4', 11, 'Hindi Literature, English Literature', 11),
(129, 'Group1', 11, 'Computer Application', 12),
(130, 'Group2', 11, 'Sociology, Economics, Sanskrit', 12),
(131, 'Group3', 11, 'Home Science', 12),
(132, 'Group4', 11, 'Hindi Literature, English Literature', 12),
(133, 'Group1', 9, 'ABST', 17),
(134, 'Group2', 9, 'B and FM', 17),
(135, 'Group3', 9, 'Computer Application', 17),
(136, 'Group1', 9, 'ABST', 18),
(137, 'Group2', 9, 'B and FM', 18),
(138, 'Group3', 9, 'Computer Application', 18),
(139, ' Group1', 9, 'ABST', 16),
(140, ' Group2', 9, 'B and FM', 16),
(141, ' Group3', 9, 'Computer Application', 16);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student1`
--
ALTER TABLE `student1`
  ADD CONSTRAINT `student1_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
