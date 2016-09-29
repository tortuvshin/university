-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 20, 2016 at 07:56 AM
-- Server version: 10.0.27-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `foldermn_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert`
--

CREATE TABLE IF NOT EXISTS `alert` (
  `alertID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `noticeID` int(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `usertype` varchar(128) NOT NULL,
  PRIMARY KEY (`alertID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `attendanceID` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `monthyear` varchar(10) NOT NULL,
  `a1` varchar(3) DEFAULT NULL,
  `a2` varchar(3) DEFAULT NULL,
  `a3` varchar(3) DEFAULT NULL,
  `a4` varchar(3) DEFAULT NULL,
  `a5` varchar(3) DEFAULT NULL,
  `a6` varchar(3) DEFAULT NULL,
  `a7` varchar(3) DEFAULT NULL,
  `a8` varchar(3) DEFAULT NULL,
  `a9` varchar(3) DEFAULT NULL,
  `a10` varchar(3) DEFAULT NULL,
  `a11` varchar(3) DEFAULT NULL,
  `a12` varchar(3) DEFAULT NULL,
  `a13` varchar(3) DEFAULT NULL,
  `a14` varchar(3) DEFAULT NULL,
  `a15` varchar(3) DEFAULT NULL,
  `a16` varchar(3) DEFAULT NULL,
  `a17` varchar(3) DEFAULT NULL,
  `a18` varchar(3) DEFAULT NULL,
  `a19` varchar(3) DEFAULT NULL,
  `a20` varchar(3) DEFAULT NULL,
  `a21` varchar(3) DEFAULT NULL,
  `a22` varchar(3) DEFAULT NULL,
  `a23` varchar(3) DEFAULT NULL,
  `a24` varchar(3) DEFAULT NULL,
  `a25` varchar(3) DEFAULT NULL,
  `a26` varchar(3) DEFAULT NULL,
  `a27` varchar(3) DEFAULT NULL,
  `a28` varchar(3) DEFAULT NULL,
  `a29` varchar(3) DEFAULT NULL,
  `a30` varchar(3) DEFAULT NULL,
  `a31` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`attendanceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `studentID`, `classesID`, `userID`, `usertype`, `monthyear`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `a13`, `a14`, `a15`, `a16`, `a17`, `a18`, `a19`, `a20`, `a21`, `a22`, `a23`, `a24`, `a25`, `a26`, `a27`, `a28`, `a29`, `a30`, `a31`) VALUES
(1, 1, 1, 1, 'Admin', '09-2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, 1, 'Admin', '09-2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 1, 1, 'Admin', '09-2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 1, 1, 'Admin', '09-2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 1, 1, 'Admin', '09-2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `automation_rec`
--

CREATE TABLE IF NOT EXISTS `automation_rec` (
  `automation_recID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(3) NOT NULL,
  `month` varchar(3) NOT NULL,
  `year` year(4) NOT NULL,
  `nofmodule` int(11) NOT NULL,
  PRIMARY KEY (`automation_recID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `automation_shudulu`
--

CREATE TABLE IF NOT EXISTS `automation_shudulu` (
  `automation_shuduluID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `day` varchar(3) NOT NULL,
  `month` varchar(3) NOT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`automation_shuduluID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `automation_shudulu`
--

INSERT INTO `automation_shudulu` (`automation_shuduluID`, `date`, `day`, `month`, `year`) VALUES
(1, '2016-09-15', '15', '09', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `bookID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book` varchar(60) NOT NULL,
  `subject_code` tinytext NOT NULL,
  `author` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `due_quantity` int(11) NOT NULL,
  `rack` tinytext NOT NULL,
  PRIMARY KEY (`bookID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hostelID` int(11) NOT NULL,
  `class_type` varchar(60) NOT NULL,
  `hbalance` varchar(20) NOT NULL,
  `note` text,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `classesID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classes` varchar(60) NOT NULL,
  `classes_numeric` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `note` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`classesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classesID`, `classes`, `classes_numeric`, `teacherID`, `note`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 'Class 1', 1, 1, '', '2016-09-15 05:35:26', '2016-09-15 05:35:26', 1, 'Admin', 'Admin'),
(2, 'Class 2', 2, 3, '', '2016-09-16 02:36:52', '2016-09-19 05:59:22', 1, 'Admin', 'Admin'),
(3, '2017 оны төгсөлт', 2017, 2, '', '2016-09-19 06:54:37', '2016-09-19 06:54:37', 1, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `eattendance`
--

CREATE TABLE IF NOT EXISTS `eattendance` (
  `eattendanceID` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `examID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `date` date NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `s_name` varchar(60) DEFAULT NULL,
  `eattendance` varchar(20) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `eextra` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`eattendanceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `eventID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fdate` date NOT NULL,
  `ftime` time NOT NULL,
  `tdate` date NOT NULL,
  `ttime` time NOT NULL,
  `title` varchar(128) NOT NULL,
  `details` text NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventcounter`
--

CREATE TABLE IF NOT EXISTS `eventcounter` (
  `eventcounterID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `eventID` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(128) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`eventcounterID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
  `examID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `exam` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `note` text,
  PRIMARY KEY (`examID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`examID`, `exam`, `date`, `note`) VALUES
(1, '2017 оны хаврын хичээлийн дүн', '2017-06-01', ''),
(2, '2017 оны намрын хичээлийн дүн', '2018-01-01', ''),
(3, '2016 оны намрын хичээлийн дүн', '2017-01-01', ''),
(4, '2018 оны хаврын хичээлийн дүн', '2018-06-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `examschedule`
--

CREATE TABLE IF NOT EXISTS `examschedule` (
  `examscheduleID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `examID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `edate` date NOT NULL,
  `examfrom` varchar(10) NOT NULL,
  `examto` varchar(10) NOT NULL,
  `room` tinytext,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`examscheduleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `expenseID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `create_date` date NOT NULL,
  `date` date NOT NULL,
  `expense` varchar(128) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `uname` varchar(60) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `expenseyear` year(4) NOT NULL,
  `note` text,
  PRIMARY KEY (`expenseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feetype`
--

CREATE TABLE IF NOT EXISTS `feetype` (
  `feetypeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `feetype` varchar(60) NOT NULL,
  `note` text,
  PRIMARY KEY (`feetypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `gradeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `grade` varchar(60) NOT NULL,
  `point` varchar(11) NOT NULL,
  `gradefrom` int(11) NOT NULL,
  `gradeupto` int(11) NOT NULL,
  `note` text,
  PRIMARY KEY (`gradeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`gradeID`, `grade`, `point`, `gradefrom`, `gradeupto`, `note`) VALUES
(1, 'A+', '4', 95, 100, ''),
(2, 'A-', '3.5', 90, 95, ''),
(3, 'B+', '3.3', 85, 90, ''),
(4, 'B-', '3', 80, 85, ''),
(5, 'C+', '2.7', 75, 80, ''),
(6, 'C-', '2.5', 70, 75, ''),
(7, 'D+', '2.3', 65, 70, ''),
(8, 'D-', '2', 60, 65, ''),
(9, 'Унасан', '0', 0, 60, '');

-- --------------------------------------------------------

--
-- Table structure for table `hmember`
--

CREATE TABLE IF NOT EXISTS `hmember` (
  `hmemberID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hostelID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `hbalance` varchar(20) DEFAULT NULL,
  `hjoindate` date NOT NULL,
  PRIMARY KEY (`hmemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE IF NOT EXISTS `holiday` (
  `holidayID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fdate` date NOT NULL,
  `tdate` date NOT NULL,
  `title` varchar(128) NOT NULL,
  `details` text NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`holidayID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE IF NOT EXISTS `hostel` (
  `hostelID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `htype` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` text,
  PRIMARY KEY (`hostelID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ini_config`
--

CREATE TABLE IF NOT EXISTS `ini_config` (
  `configID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `config_key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`configID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ini_config`
--

INSERT INTO `ini_config` (`configID`, `type`, `config_key`, `value`) VALUES
(1, 'paypal', 'paypal_api_username', ''),
(2, 'paypal', 'paypal_api_password', ''),
(3, 'paypal', 'paypal_api_signature', ''),
(4, 'paypal', 'paypal_email', ''),
(5, 'paypal', 'paypal_demo', ''),
(6, 'stripe', 'stripe_private_key', ''),
(7, 'stripe', 'stripe_public_key', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoiceID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classesID` int(11) NOT NULL,
  `classes` varchar(128) NOT NULL,
  `studentID` int(11) NOT NULL,
  `student` varchar(128) NOT NULL,
  `roll` varchar(128) NOT NULL,
  `feetype` varchar(128) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `paidamount` varchar(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `uname` varchar(60) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `paymenttype` varchar(128) DEFAULT NULL,
  `date` date NOT NULL,
  `paiddate` date DEFAULT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`invoiceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `issueID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lID` varchar(128) NOT NULL,
  `bookID` int(11) NOT NULL,
  `book` varchar(60) NOT NULL,
  `author` varchar(100) NOT NULL,
  `serial_no` varchar(40) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `fine` varchar(11) DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`issueID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `leaveapp`
--

CREATE TABLE IF NOT EXISTS `leaveapp` (
  `leaveID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fdate` date NOT NULL,
  `tdate` date NOT NULL,
  `title` varchar(128) NOT NULL,
  `details` text NOT NULL,
  `tousername` varchar(40) NOT NULL,
  `fromusername` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`leaveID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lmember`
--

CREATE TABLE IF NOT EXISTS `lmember` (
  `lmemberID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lID` varchar(40) NOT NULL,
  `studentID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `lbalance` varchar(20) DEFAULT NULL,
  `ljoindate` date NOT NULL,
  PRIMARY KEY (`lmemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailandsms`
--

CREATE TABLE IF NOT EXISTS `mailandsms` (
  `mailandsmsID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users` varchar(15) NOT NULL,
  `type` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`mailandsmsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailandsmstemplate`
--

CREATE TABLE IF NOT EXISTS `mailandsmstemplate` (
  `mailandsmstemplateID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `user` varchar(15) NOT NULL,
  `type` varchar(10) NOT NULL,
  `template` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mailandsmstemplateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailandsmstemplatetag`
--

CREATE TABLE IF NOT EXISTS `mailandsmstemplatetag` (
  `mailandsmstemplatetagID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usersID` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `tagname` varchar(128) NOT NULL,
  `mailandsmstemplatetag_extra` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mailandsmstemplatetagID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `mailandsmstemplatetag`
--

INSERT INTO `mailandsmstemplatetag` (`mailandsmstemplatetagID`, `usersID`, `name`, `tagname`, `mailandsmstemplatetag_extra`, `create_date`) VALUES
(1, 1, 'student', '[student_name]', NULL, '2015-06-30 17:44:10'),
(2, 1, 'student', '[student_class]', NULL, '2015-06-30 17:43:56'),
(3, 1, 'student', '[student_roll]', NULL, '2015-06-30 17:44:21'),
(4, 1, 'student', '[student_dob]', NULL, '2015-06-30 17:45:24'),
(5, 1, 'student', '[student_gender]', NULL, '2015-06-30 17:47:01'),
(6, 1, 'student', '[student_religion]', NULL, '2015-06-30 17:47:01'),
(7, 1, 'student', '[student_email]', NULL, '2015-06-30 17:47:40'),
(8, 1, 'student', '[student_phone]', NULL, '2015-06-30 17:47:40'),
(9, 1, 'student', '[student_section]', NULL, '2015-06-30 17:48:47'),
(10, 1, 'student', '[student_username]', NULL, '2015-06-30 17:48:47'),
(11, 2, 'parents', '[guardian_name]', NULL, '2015-07-06 09:09:16'),
(12, 2, 'parents', '[father''s_name]', NULL, '2015-07-06 09:11:42'),
(13, 2, 'parents', '[mother''s_name]', NULL, '2015-07-06 09:11:42'),
(14, 2, 'parents', '[father''s_profession]', NULL, '2015-07-06 09:14:32'),
(15, 2, 'parents', '[mother''s_profession]', NULL, '2015-07-06 09:14:32'),
(16, 2, 'parents', '[parents_email]', NULL, '2015-07-06 09:20:37'),
(17, 2, 'parents', '[parents_phone]', NULL, '2015-07-06 09:20:44'),
(18, 2, 'parents', '[parents_address]', NULL, '2015-07-06 09:20:53'),
(19, 2, 'parents', '[parents_username]', NULL, '2015-07-06 09:21:00'),
(20, 3, 'teacher', '[teacher_name]\r\n', NULL, '2015-07-06 09:41:13'),
(21, 3, 'teacher', '[teacher_designation]', NULL, '2015-07-06 09:41:13'),
(22, 3, 'teacher', '[teacher_dob]', NULL, '2015-07-06 09:41:13'),
(23, 3, 'teacher', '[teacher_gender]', NULL, '2015-07-06 09:41:13'),
(24, 3, 'teacher', '[teacher_religion]', NULL, '2015-07-06 09:41:13'),
(25, 3, 'teacher', '[teacher_email]', NULL, '2015-07-06 09:41:13'),
(26, 3, 'teacher', '[teacher_phone]\r\n', NULL, '2015-07-06 09:41:13'),
(27, 3, 'teacher', '[teacher_address]', NULL, '2015-07-06 09:41:13'),
(28, 3, 'teacher', '[teacher_jod]', NULL, '2015-07-06 11:25:07'),
(29, 3, 'teacher', '[teacher_username]', NULL, '2015-07-06 09:41:13'),
(30, 4, 'librarian', '[librarian_name]', NULL, '2015-07-06 10:05:44'),
(31, 4, 'librarian', '[librarian_dob]', NULL, '2015-07-06 10:05:48'),
(32, 4, 'librarian', '[librarian_gender]', NULL, '2015-07-06 10:05:52'),
(33, 4, 'librarian', '[librarian_religion]', NULL, '2015-07-06 10:05:55'),
(34, 4, 'librarian', '[librarian_email]', NULL, '2015-07-06 10:05:59'),
(35, 4, 'librarian', '[librarian_phone]', NULL, '2015-07-06 10:06:20'),
(36, 4, 'librarian', '[librarian_address]', NULL, '2015-07-06 10:06:27'),
(37, 4, 'librarian', '[librarian_jod]', NULL, '2015-07-06 11:25:17'),
(38, 4, 'librarian', '[librarian_username]', NULL, '2015-07-06 10:06:36'),
(39, 5, 'accountant', '[accountant_name]', NULL, '2015-07-06 10:06:59'),
(40, 5, 'accountant', '[accountant_dob]', NULL, '2015-07-06 10:07:02'),
(41, 5, 'accountant', '[accountant_gender]', NULL, '2015-07-06 10:07:04'),
(42, 5, 'accountant', '[accountant_religion]', NULL, '2015-07-06 10:07:07'),
(43, 5, 'accountant', '[accountant_email]', NULL, '2015-07-06 10:07:10'),
(44, 5, 'accountant', '[accountant_phone]', NULL, '2015-07-06 10:07:13'),
(45, 5, 'accountant', '[accountant_address]', NULL, '2015-07-06 10:07:15'),
(46, 5, 'accountant', '[accountant_jod]', NULL, '2015-07-06 11:25:24'),
(47, 5, 'accountant', '[accountant_username]', NULL, '2015-07-06 10:07:21'),
(48, 1, 'student', '[student_result_table]', NULL, '2015-09-08 03:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
  `markID` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `examID` int(11) NOT NULL,
  `exam` varchar(60) NOT NULL,
  `studentID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `mark` int(11) DEFAULT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`markID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`markID`, `examID`, `exam`, `studentID`, `classesID`, `subjectID`, `subject`, `mark`, `year`) VALUES
(1, 1, '1-р улирлын эцсийн дүн', 1, 1, 1, 'Хичээл 1', 99, 2016),
(2, 3, '2016 оны намрын хичээлийн дүн', 1, 1, 1, 'Хичээл 1', 100, 2016),
(3, 3, '2016 оны намрын хичээлийн дүн', 2, 1, 1, 'Хичээл 1', 75, 2016),
(4, 3, '2016 оны намрын хичээлийн дүн', 3, 1, 1, 'Хичээл 1', 90, 2016),
(5, 3, '2016 оны намрын хичээлийн дүн', 4, 1, 1, 'Хичээл 1', 85, 2016),
(6, 3, '2016 оны намрын хичээлийн дүн', 5, 1, 1, 'Хичээл 1', 55, 2016),
(7, 3, '2016 оны намрын хичээлийн дүн', 6, 2, 6, 'Хичээл 1', 90, 2016),
(8, 3, '2016 оны намрын хичээлийн дүн', 7, 2, 6, 'Хичээл 1', 85, 2016),
(9, 3, '2016 оны намрын хичээлийн дүн', 8, 2, 6, 'Хичээл 1', 70, 2016),
(10, 3, '2016 оны намрын хичээлийн дүн', 9, 2, 6, 'Хичээл 1', 50, 2016),
(11, 3, '2016 оны намрын хичээлийн дүн', 6, 2, 7, 'Хичээл 2', 60, 2016),
(12, 3, '2016 оны намрын хичээлийн дүн', 7, 2, 7, 'Хичээл 2', 75, 2016),
(13, 3, '2016 оны намрын хичээлийн дүн', 8, 2, 7, 'Хичээл 2', 80, 2016),
(14, 3, '2016 оны намрын хичээлийн дүн', 9, 2, 7, 'Хичээл 2', 54, 2016),
(15, 3, '2016 оны намрын хичээлийн дүн', 6, 2, 8, 'Хичээл 3', 76, 2016),
(16, 3, '2016 оны намрын хичээлийн дүн', 7, 2, 8, 'Хичээл 3', 78, 2016),
(17, 3, '2016 оны намрын хичээлийн дүн', 8, 2, 8, 'Хичээл 3', 45, 2016),
(18, 3, '2016 оны намрын хичээлийн дүн', 9, 2, 8, 'Хичээл 3', 83, 2016),
(19, 3, '2016 оны намрын хичээлийн дүн', 6, 2, 9, 'Хичээл 4', 68, 2016),
(20, 3, '2016 оны намрын хичээлийн дүн', 7, 2, 9, 'Хичээл 4', 76, 2016),
(21, 3, '2016 оны намрын хичээлийн дүн', 8, 2, 9, 'Хичээл 4', 45, 2016),
(22, 3, '2016 оны намрын хичээлийн дүн', 9, 2, 9, 'Хичээл 4', 80, 2016),
(23, 3, '2016 оны намрын хичээлийн дүн', 6, 2, 10, 'Хичээл 5', 70, 2016),
(24, 3, '2016 оны намрын хичээлийн дүн', 7, 2, 10, 'Хичээл 5', 85, 2016),
(25, 3, '2016 оны намрын хичээлийн дүн', 8, 2, 10, 'Хичээл 5', 87, 2016),
(26, 3, '2016 оны намрын хичээлийн дүн', 9, 2, 10, 'Хичээл 5', 90, 2016),
(27, 3, '2016 оны намрын хичээлийн дүн', 10, 2, 10, 'Хичээл 5', 5, 2016),
(28, 3, '2016 оны намрын хичээлийн дүн', 10, 2, 9, 'Хичээл 4', 89, 2016),
(29, 3, '2016 оны намрын хичээлийн дүн', 10, 2, 8, 'Хичээл 3', 67, 2016),
(30, 3, '2016 оны намрын хичээлийн дүн', 10, 2, 7, 'Хичээл 2', 90, 2016),
(31, 3, '2016 оны намрын хичээлийн дүн', 10, 2, 6, 'Хичээл 1', 100, 2016),
(32, 3, '2016 оны намрын хичээлийн дүн', 1, 1, 4, 'Хичээл 4', 50, 2016),
(33, 3, '2016 оны намрын хичээлийн дүн', 2, 1, 4, 'Хичээл 4', 60, 2016),
(34, 3, '2016 оны намрын хичээлийн дүн', 3, 1, 4, 'Хичээл 4', 55, 2016),
(35, 3, '2016 оны намрын хичээлийн дүн', 4, 1, 4, 'Хичээл 4', 87, 2016),
(36, 3, '2016 оны намрын хичээлийн дүн', 5, 1, 4, 'Хичээл 4', 98, 2016),
(37, 3, '2016 оны намрын хичээлийн дүн', 1, 1, 2, 'Хичээл 2', 97, 2016),
(38, 3, '2016 оны намрын хичээлийн дүн', 2, 1, 2, 'Хичээл 2', 97, 2016),
(39, 3, '2016 оны намрын хичээлийн дүн', 3, 1, 2, 'Хичээл 2', 100, 2016),
(40, 3, '2016 оны намрын хичээлийн дүн', 4, 1, 2, 'Хичээл 2', 73, 2016),
(41, 3, '2016 оны намрын хичээлийн дүн', 5, 1, 2, 'Хичээл 2', 80, 2016),
(42, 3, '2016 оны намрын хичээлийн дүн', 1, 1, 5, 'Хичээл 5', 67, 2016),
(43, 3, '2016 оны намрын хичээлийн дүн', 2, 1, 5, 'Хичээл 5', 46, 2016),
(44, 3, '2016 оны намрын хичээлийн дүн', 3, 1, 5, 'Хичээл 5', 95, 2016),
(45, 3, '2016 оны намрын хичээлийн дүн', 4, 1, 5, 'Хичээл 5', 16, 2016),
(46, 3, '2016 оны намрын хичээлийн дүн', 5, 1, 5, 'Хичээл 5', 70, 2016),
(47, 2, '2017 оны намрын хичээлийн дүн', 2, 1, 1, 'Хичээл 1', 67, 2016),
(48, 2, '2017 оны намрын хичээлийн дүн', 3, 1, 1, 'Хичээл 1', 89, 2016),
(49, 2, '2017 оны намрын хичээлийн дүн', 4, 1, 1, 'Хичээл 1', 90, 2016),
(50, 2, '2017 оны намрын хичээлийн дүн', 5, 1, 1, 'Хичээл 1', 65, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `mediaID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `mcategoryID` int(11) NOT NULL DEFAULT '0',
  `file_name` varchar(255) NOT NULL,
  `file_name_display` varchar(255) NOT NULL,
  PRIMARY KEY (`mediaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media_category`
--

CREATE TABLE IF NOT EXISTS `media_category` (
  `mcategoryID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mcategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media_share`
--

CREATE TABLE IF NOT EXISTS `media_share` (
  `shareID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classesID` int(11) NOT NULL,
  `public` int(11) NOT NULL,
  `file_or_folder` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shareID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `messageID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `receiverType` varchar(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `attach` text,
  `attach_file_name` text,
  `userID` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `useremail` varchar(40) NOT NULL,
  `year` year(4) NOT NULL,
  `date` date NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `read_status` tinyint(1) NOT NULL,
  `from_status` int(11) NOT NULL,
  `to_status` int(11) NOT NULL,
  `fav_status` tinyint(1) NOT NULL,
  `fav_status_sent` tinyint(1) NOT NULL,
  `reply_status` int(11) NOT NULL,
  PRIMARY KEY (`messageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `noticeID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `notice` text NOT NULL,
  `year` year(4) NOT NULL,
  `date` date NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`noticeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
  `parentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `father_name` varchar(60) NOT NULL,
  `mother_name` varchar(60) NOT NULL,
  `father_profession` varchar(40) NOT NULL,
  `mother_profession` varchar(40) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  `parentactive` int(11) NOT NULL,
  PRIMARY KEY (`parentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parentID`, `name`, `father_name`, `mother_name`, `father_profession`, `mother_profession`, `email`, `phone`, `address`, `photo`, `username`, `password`, `usertype`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `parentactive`) VALUES
(1, 'Main', 'Main', 'Main', 'Main', 'Main', 'main@yahoo.com', '', '', 'defualt.png', 'Main', 'fc0328854718b66723c325911e25e8e0a8e524a12540c0f73f7d5937eeac238248c0e9f7687cef35b36fb0e2be568c2b9e410fab0a53370a3708c235af0eadee', 'Parent', '2016-09-15 05:33:44', '2016-09-15 05:33:44', 1, 'Admin', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `paymentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `invoiceID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `paymentamount` varchar(20) NOT NULL,
  `paymenttype` varchar(128) NOT NULL,
  `paymentdate` date NOT NULL,
  `paymentmonth` varchar(10) NOT NULL,
  `paymentyear` year(4) NOT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promotionsubject`
--

CREATE TABLE IF NOT EXISTS `promotionsubject` (
  `promotionSubjectID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classesID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `subjectCode` tinytext NOT NULL,
  `subjectMark` int(11) DEFAULT NULL,
  PRIMARY KEY (`promotionSubjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `promotionsubject`
--

INSERT INTO `promotionsubject` (`promotionSubjectID`, `classesID`, `subjectID`, `subjectCode`, `subjectMark`) VALUES
(1, 1, 1, 'subject1', 60),
(2, 1, 2, 'subject2', 60),
(3, 1, 3, 'subject3', 60),
(4, 1, 4, 'subject4', 60),
(5, 1, 5, 'subject5', 60),
(6, 2, 6, 'subject6', 60),
(7, 2, 7, 'subject7', 60),
(8, 2, 8, 'subject8', 60),
(9, 2, 9, 'subject9', 60),
(10, 2, 10, 'subject10', 60);

-- --------------------------------------------------------

--
-- Table structure for table `reply_msg`
--

CREATE TABLE IF NOT EXISTS `reply_msg` (
  `replyID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `messageID` int(11) NOT NULL,
  `reply_msg` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`replyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

CREATE TABLE IF NOT EXISTS `reset` (
  `resetID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyID` varchar(128) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`resetID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE IF NOT EXISTS `routine` (
  `routineID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `day` varchar(60) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `room` tinytext NOT NULL,
  PRIMARY KEY (`routineID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`routineID`, `classesID`, `sectionID`, `subjectID`, `day`, `start_time`, `end_time`, `room`) VALUES
(4, 1, 1, 3, 'НЯМ', '8:30 AM', '10:00 AM', '65'),
(5, 1, 1, 4, 'НЯМ', '10:00 AM', '11:30 PM', '87'),
(6, 1, 1, 3, 'TUESDAY', '8:30 AM', '10:00 AM', '56'),
(7, 2, 2, 9, 'MONDAY', '7:00 PM', '8:00 PM', '67');

-- --------------------------------------------------------

--
-- Table structure for table `school_sessions`
--

CREATE TABLE IF NOT EXISTS `school_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school_sessions`
--

INSERT INTO `school_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('00a1fbc9ea45bb8bc031eb90210f4ef0', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474374084, 'a:9:{s:9:"user_data";s:0:"";s:4:"lang";s:7:"russian";s:11:"loginuserID";s:1:"1";s:4:"name";s:5:"Admin";s:5:"email";s:14:"info@folder.mn";s:8:"usertype";s:5:"Admin";s:8:"username";s:5:"Admin";s:5:"photo";s:11:"defualt.png";s:8:"loggedin";b:1;}'),
('755d0214220feb2bf29eff354a49d037', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474375533, 'a:9:{s:9:"user_data";s:0:"";s:4:"lang";s:7:"russian";s:11:"loginuserID";s:1:"1";s:4:"name";s:5:"Admin";s:5:"email";s:14:"info@folder.mn";s:8:"usertype";s:5:"Admin";s:8:"username";s:5:"Admin";s:5:"photo";s:11:"defualt.png";s:8:"loggedin";b:1;}'),
('783243f19da47eaccd662d121b0b265e', '0.0.0.0', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:38.0) Gecko/20100101 Firefox/38.0', 1561580923, 'a:8:{s:9:"user_data";s:0:"";s:4:"name";s:5:"Dipok";s:5:"email";s:16:"info@inilabs.net";s:8:"usertype";s:5:"Admin";s:8:"username";s:5:"admin";s:5:"photo";s:8:"site.png";s:4:"lang";s:7:"english";s:8:"loggedin";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `sectionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(60) NOT NULL,
  `category` varchar(128) NOT NULL,
  `classesID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `note` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`sectionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionID`, `section`, `category`, `classesID`, `teacherID`, `note`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 'A', 'Үндсэн', 1, 1, '', '2016-09-15 05:35:49', '2016-09-19 06:25:14', 1, 'Admin', 'Admin'),
(2, 'A', '1-р бүлэг', 2, 1, '', '2016-09-16 02:38:22', '2016-09-19 06:33:46', 1, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `settingID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sname` text,
  `phone` tinytext,
  `address` text,
  `email` varchar(40) DEFAULT NULL,
  `automation` int(11) DEFAULT NULL,
  `currency_code` varchar(11) DEFAULT NULL,
  `currency_symbol` text,
  `language` varchar(50) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `fontorbackend` int(11) DEFAULT NULL,
  `footer` text,
  `photo` varchar(128) DEFAULT NULL,
  `purchase_code` varchar(255) DEFAULT NULL,
  `updateversion` text,
  `attendance` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`settingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`settingID`, `sname`, `phone`, `address`, `email`, `automation`, `currency_code`, `currency_symbol`, `language`, `theme`, `fontorbackend`, `footer`, `photo`, `purchase_code`, `updateversion`, `attendance`) VALUES
(1, 'Оюутны бүртгэлийн систем v.1', '99882322', 'Ulaanbaatar,Mongolia', 'info@folder.mn', 5, '₮', 'MNT', 'russian', 'Basic', 0, 'Тагтаа Оюутны Бүртгэлийн Систем', 'site.png', '15ccba3b-f8d5-478f-9402-7fe8713b192f', '2.00', 'day');

-- --------------------------------------------------------

--
-- Table structure for table `smssettings`
--

CREATE TABLE IF NOT EXISTS `smssettings` (
  `smssettingsID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `types` varchar(255) DEFAULT NULL,
  `field_names` varchar(255) DEFAULT NULL,
  `field_values` varchar(255) DEFAULT NULL,
  `smssettings_extra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`smssettingsID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `smssettings`
--

INSERT INTO `smssettings` (`smssettingsID`, `types`, `field_names`, `field_values`, `smssettings_extra`) VALUES
(1, 'clickatell', 'clickatell_username', '', NULL),
(2, 'clickatell', 'clickatell_password', '', NULL),
(3, 'clickatell', 'clickatell_api_key', '', NULL),
(4, 'twilio', 'twilio_accountSID', '', NULL),
(5, 'twilio', 'twilio_authtoken', '', NULL),
(6, 'twilio', 'twilio_fromnumber', '', NULL),
(7, 'bulk', 'bulk_username', '', NULL),
(8, 'bulk', 'bulk_password', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `section` varchar(60) NOT NULL,
  `roll` tinytext NOT NULL,
  `library` int(11) NOT NULL,
  `hostel` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `totalamount` varchar(128) DEFAULT NULL,
  `paidamount` varchar(128) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `parentID` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  `studentactive` int(11) NOT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `name`, `dob`, `sex`, `religion`, `email`, `phone`, `address`, `classesID`, `sectionID`, `section`, `roll`, `library`, `hostel`, `transport`, `create_date`, `totalamount`, `paidamount`, `photo`, `parentID`, `year`, `username`, `password`, `usertype`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `studentactive`) VALUES
(1, 'Student1', '2008-12-29', 'Эрэгтэй', '', 'student1@yahoo.com', '', '', 1, 2, 'A', '1', 0, 0, 0, '2016-09-15 05:38:51', '0', '0', 'defualt.png', 1, 2018, 'Student1', 'b4e695d0332c61ee431443c2c55c3f2d31a3bf63f04c7b8a730c16b48817986e0a97324525ee920866cfd87ec68b52d091ee22153ae6abe64e29bbdcf9831ed4', 'Student', '2016-09-19 07:01:21', 1, 'Admin', 'Admin', 1),
(2, 'Student2', '2008-12-28', 'Эрэгтэй', '', 'student2@yahoo.com', '', '', 1, 1, 'A', '2', 0, 0, 0, '2016-09-19 05:28:35', '0', '0', 'defualt.png', 1, 2017, 'Student2', 'cdc4a00595a7bd3a7ca89b6125e7fb18a2182983f456a16fc34a0888696352b8bded69738a1cd787e6ddab1afb5323b8e0fdaf4976c1e404ad9ec74f0df0ffc4', 'Student', '2016-09-19 06:59:38', 1, 'Admin', 'Admin', 1),
(3, 'Student3', '2008-12-28', 'Эмэгтэй', '', 'Student3@yahoo.com', '', '', 1, 1, 'A бүлэг', '3', 0, 0, 0, '2016-09-19 05:33:29', '0', '0', 'defualt.png', 1, 2017, 'Student3', '03e01e3b768a489715336ea312c01ac69ff7d03bc78e58177edced9b64310867c6f28c89140195c6bdf660bff5b64c9ccc89d5e17134a6705673d453bfc17d05', 'Student', '2016-09-19 05:33:29', 1, 'Admin', 'Admin', 1),
(4, 'Student4', '2008-12-28', 'Эрэгтэй', '', 'Student4@yahoo.com', '', '', 1, 1, 'A бүлэг', '4', 0, 0, 0, '2016-09-19 05:34:06', '0', '0', 'defualt.png', 1, 2017, 'Student4', '842b0ac83bf130e3d8068ea28b47031479b9bd7110c282516893972cc293ffb4d7d1360c32f11bc214c28970113e1072d1f806f6d6c6e0b0b44084847700bf4e', 'Student', '2016-09-19 05:34:06', 1, 'Admin', 'Admin', 1),
(5, 'Student5', '2008-12-29', 'Эрэгтэй', '', 'Student5@yahoo.com', '', '', 1, 1, 'A бүлэг', '5', 0, 0, 0, '2016-09-19 05:35:44', '0', '0', 'defualt.png', 1, 2017, 'Student5', '08a1871a459d0c6722ee4e3e62de8ae3063b808a3bf43aa2d7b7f053a46011b1b81b5ebe6bd1b2c6d1d24ec1b9d62121f29d37b67c6408fcccdf055684dd8b0c', 'Student', '2016-09-19 05:35:44', 1, 'Admin', 'Admin', 1),
(6, 'Student6', '2008-12-29', 'Эмэгтэй', '', 'Student6@yahoo.com', '', '', 2, 2, 'Main', '6', 0, 0, 0, '2016-09-19 05:36:27', '0', '0', 'defualt.png', 1, 2017, 'Student6', '0efbd244c26ca371a6df2efd0ce3debecdbc8a20e213bc041e87257130522978be49cadf5ea70d047f06be1faf07740b6f130e8ffe0fbdffdcd7f6d6957f7ae6', 'Student', '2016-09-19 05:36:27', 1, 'Admin', 'Admin', 1),
(7, 'Student7', '2008-12-29', 'Эрэгтэй', '', 'Student7@yahoo.com', '', '', 2, 2, '1-р бүлэг', '7', 0, 0, 0, '2016-09-19 05:40:22', '0', '0', 'defualt.png', 1, 2017, 'Student7', '0eff1d8392a8927fc3507bf8ff08f6e65a4d641c1ecd27632093b99e731e81f2d063b41d5ef68ccbc7d127d4e41eeedb975af19b9fbefcbc70fe35e1ea8817b3', 'Student', '2016-09-19 05:40:22', 1, 'Admin', 'Admin', 1),
(8, 'Student8', '2008-12-28', 'Эрэгтэй', '', 'Student8@yahoo.com', '', '', 2, 2, '1-р бүлэг', '8', 0, 0, 0, '2016-09-19 05:41:08', '0', '0', 'defualt.png', 1, 2017, 'Student8', 'f2d9923a5827002196e9c268b6f8db3405b1860483ebd7e412e70a92ef3e95307ca43b21961da39645f2bf5b98512e86b24d079261d2abaa999946da07ea17f4', 'Student', '2016-09-19 05:41:08', 1, 'Admin', 'Admin', 1),
(9, 'Student9', '2008-12-28', 'Эрэгтэй', '', 'Student9@yahoo.com', '', '', 2, 2, '1-р бүлэг', '9', 0, 0, 0, '2016-09-19 05:51:30', '0', '0', 'defualt.png', 1, 2017, 'Student9', '433d66feb761f69bac2f964fbb95a1bdd851a4c9be2187984d8cbed6dbcf046042632b71b1aef7ac8399f5739bb7f3cee8bd5c60f3ffc43fef0bc29f09e76967', 'Student', '2016-09-19 05:51:30', 1, 'Admin', 'Admin', 1),
(10, 'Student10', '2008-12-29', 'Эрэгтэй', '', 'Student10@yahoo.com', '', '', 2, 2, '1-р бүлэг', '10', 0, 0, 0, '2016-09-19 06:19:33', '0', '0', 'defualt.png', 1, 2017, 'Student10', '1f9d847d5a7d5721b05153ade391205d89c550eea5a3701bbbfe4b3584f24b214ce40b54b11f578abaef1488a700629784d7839bd5b14974b1d7c0550423d2ab', 'Student', '2016-09-19 06:19:33', 1, 'Admin', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subjectID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classesID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `subject_author` varchar(100) DEFAULT NULL,
  `subject_code` tinytext NOT NULL,
  `teacher_name` varchar(60) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `classesID`, `teacherID`, `subject`, `subject_author`, `subject_code`, `teacher_name`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 1, 1, 'Хичээл 1', 'Үндэслэгч 1', 'subject1', 'Teacher1', '2016-09-15 05:36:09', '2016-09-19 06:01:31', 1, 'Admin', 'Admin'),
(2, 1, 1, 'Хичээл 2', 'Үндэслэгч 2', 'subject2', 'Teacher1', '2016-09-16 02:37:36', '2016-09-19 06:00:50', 1, 'Admin', 'Admin'),
(3, 1, 3, 'Хичээл 3', 'Үндэслэгч 3', 'subject3', 'Teacher3', '2016-09-19 06:03:21', '2016-09-19 06:03:21', 1, 'Admin', 'Admin'),
(4, 1, 5, 'Хичээл 4', 'Үндэслэгч 4', 'subject4', 'Teacher4', '2016-09-19 06:03:52', '2016-09-19 06:03:52', 1, 'Admin', 'Admin'),
(5, 1, 4, 'Хичээл 5', 'Үндэслэгч 5', 'subject5', 'Teacher5', '2016-09-19 06:05:35', '2016-09-19 06:05:35', 1, 'Admin', 'Admin'),
(6, 2, 1, 'Хичээл 1', 'Үндэслэгч 1', 'subject6', 'Teacher1', '2016-09-19 06:06:25', '2016-09-19 06:06:25', 1, 'Admin', 'Admin'),
(7, 2, 2, 'Хичээл 2', 'Үндэслэгч 2', 'subject7', 'Teacher2', '2016-09-19 06:07:05', '2016-09-19 06:07:05', 1, 'Admin', 'Admin'),
(8, 2, 3, 'Хичээл 3', 'Үндэслэгч 3', 'subject8', 'Teacher3', '2016-09-19 06:07:26', '2016-09-19 06:07:26', 1, 'Admin', 'Admin'),
(9, 2, 5, 'Хичээл 4', 'Үндэслэгч 4', 'subject9', 'Teacher4', '2016-09-19 06:08:33', '2016-09-19 06:08:33', 1, 'Admin', 'Admin'),
(10, 2, 4, 'Хичээл 5', 'Үндэслэгч 5', 'subject10', 'Teacher5', '2016-09-19 06:08:48', '2016-09-19 06:08:48', 1, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `sub_attendance`
--

CREATE TABLE IF NOT EXISTS `sub_attendance` (
  `attendanceID` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `monthyear` varchar(10) NOT NULL,
  `a1` varchar(3) DEFAULT NULL,
  `a2` varchar(3) DEFAULT NULL,
  `a3` varchar(3) DEFAULT NULL,
  `a4` varchar(3) DEFAULT NULL,
  `a5` varchar(3) DEFAULT NULL,
  `a6` varchar(3) DEFAULT NULL,
  `a7` varchar(3) DEFAULT NULL,
  `a8` varchar(3) DEFAULT NULL,
  `a9` varchar(3) DEFAULT NULL,
  `a10` varchar(3) DEFAULT NULL,
  `a11` varchar(3) DEFAULT NULL,
  `a12` varchar(3) DEFAULT NULL,
  `a13` varchar(3) DEFAULT NULL,
  `a14` varchar(3) DEFAULT NULL,
  `a15` varchar(3) DEFAULT NULL,
  `a16` varchar(3) DEFAULT NULL,
  `a17` varchar(3) DEFAULT NULL,
  `a18` varchar(3) DEFAULT NULL,
  `a19` varchar(3) DEFAULT NULL,
  `a20` varchar(3) DEFAULT NULL,
  `a21` varchar(3) DEFAULT NULL,
  `a22` varchar(3) DEFAULT NULL,
  `a23` varchar(3) DEFAULT NULL,
  `a24` varchar(3) DEFAULT NULL,
  `a25` varchar(3) DEFAULT NULL,
  `a26` varchar(3) DEFAULT NULL,
  `a27` varchar(3) DEFAULT NULL,
  `a28` varchar(3) DEFAULT NULL,
  `a29` varchar(3) DEFAULT NULL,
  `a30` varchar(3) DEFAULT NULL,
  `a31` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`attendanceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `systemadmin`
--

CREATE TABLE IF NOT EXISTS `systemadmin` (
  `systemadminID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `jod` date NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  `systemadminactive` int(11) NOT NULL,
  `systemadminextra1` varchar(128) DEFAULT NULL,
  `systemadminextra2` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`systemadminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `systemadmin`
--

INSERT INTO `systemadmin` (`systemadminID`, `name`, `dob`, `sex`, `religion`, `email`, `phone`, `address`, `jod`, `photo`, `username`, `password`, `usertype`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `systemadminactive`, `systemadminextra1`, `systemadminextra2`) VALUES
(1, 'Admin', '2011-01-01', 'Male', 'Unknown', 'info@folder.mn', '99882322', 'Ulaanbaatar,Mongolia', '2016-09-15', 'defualt.png', 'Admin', '38ebf028e2df48e35e65f8234428b64159f7d14077313d15db1cc2eaffc3242ae2f7249e1dd14b5cfb94b1ff55cd10069cd835e59e33058b570b2c4d11f14977', 'Admin', '2016-09-15 05:12:03', '2016-09-15 05:12:03', 0, 'Admin', 'Admin', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tattendance`
--

CREATE TABLE IF NOT EXISTS `tattendance` (
  `tattendanceID` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `teacherID` int(11) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `monthyear` varchar(10) NOT NULL,
  `a1` varchar(3) DEFAULT NULL,
  `a2` varchar(3) DEFAULT NULL,
  `a3` varchar(3) DEFAULT NULL,
  `a4` varchar(3) DEFAULT NULL,
  `a5` varchar(3) DEFAULT NULL,
  `a6` varchar(3) DEFAULT NULL,
  `a7` varchar(3) DEFAULT NULL,
  `a8` varchar(3) DEFAULT NULL,
  `a9` varchar(3) DEFAULT NULL,
  `a10` varchar(3) DEFAULT NULL,
  `a11` varchar(3) DEFAULT NULL,
  `a12` varchar(3) DEFAULT NULL,
  `a13` varchar(3) DEFAULT NULL,
  `a14` varchar(3) DEFAULT NULL,
  `a15` varchar(3) DEFAULT NULL,
  `a16` varchar(3) DEFAULT NULL,
  `a17` varchar(3) DEFAULT NULL,
  `a18` varchar(3) DEFAULT NULL,
  `a19` varchar(3) DEFAULT NULL,
  `a20` varchar(3) DEFAULT NULL,
  `a21` varchar(3) DEFAULT NULL,
  `a22` varchar(3) DEFAULT NULL,
  `a23` varchar(3) DEFAULT NULL,
  `a24` varchar(3) DEFAULT NULL,
  `a25` varchar(3) DEFAULT NULL,
  `a26` varchar(3) DEFAULT NULL,
  `a27` varchar(3) DEFAULT NULL,
  `a28` varchar(3) DEFAULT NULL,
  `a29` varchar(3) DEFAULT NULL,
  `a30` varchar(3) DEFAULT NULL,
  `a31` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`tattendanceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `designation` varchar(128) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `jod` date NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  `teacheractive` int(11) NOT NULL,
  PRIMARY KEY (`teacherID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `name`, `designation`, `dob`, `sex`, `religion`, `email`, `phone`, `address`, `jod`, `photo`, `username`, `password`, `usertype`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `teacheractive`) VALUES
(1, 'Teacher1', '1', '2008-12-29', 'Эрэгтэй', '', 'teacher1@yahoo.com', '', '', '2016-09-15', 'defualt.png', 'Teacher1', '32621553f0f125858c5f005822bea94df1fd841657be0dfd0b9c4abb2ae6cef634b25789967b1c0ccda4b136642df1680dff91befb13a541725f6df1940d5fb3', 'Teacher', '2016-09-15 05:35:05', '2016-09-15 05:35:05', 1, 'Admin', 'Admin', 1),
(2, 'Teacher2', '2', '2008-12-29', 'Эрэгтэй', '', 'Teacher@yahoo.com', '', '', '2016-09-20', 'defualt.png', 'Teacher', 'd1a77dbba6118f4378708f648f5b6df05a02cdeb8d4ddad4767bc62945d13927a018e9fe2b31a6edaa775c66ad2a226c76d7efe43d93039e7881be7a62a3cf2b', 'Teacher', '2016-09-19 05:52:17', '2016-09-19 05:52:17', 1, 'Admin', 'Admin', 1),
(3, 'Teacher3', '3', '2008-12-28', 'Эрэгтэй', '', 'Teacher3@yahoo.com', '', '', '2016-09-20', 'defualt.png', 'Teacher3', '03841c322436541a5e31f0ed0ca5059dbd979fe927faec47be00a7cbd4dfda074f586edb3fe4f0960b9895063b2dadca61c07363d12dde646c198b622525f39b', 'Teacher', '2016-09-19 05:52:47', '2016-09-19 05:52:47', 1, 'Admin', 'Admin', 1),
(4, 'Teacher5', '5', '2008-12-28', 'Эрэгтэй', '', 'Teacher5@yahoo.com', '', '', '2016-09-20', 'defualt.png', 'Teacher5', '70a65bab8f7ec4ab2066d1782afb3b23af765102818fe48622681ea3a6f596462813dfe06355c7bbe0c003cbef48a2789ad27d538014d872150a3ce72440b2a9', 'Teacher', '2016-09-19 05:53:45', '2016-09-19 05:54:06', 1, 'Admin', 'Admin', 1),
(5, 'Teacher4', '4', '2008-12-28', 'Эрэгтэй', '', 'Teacher4@yahoo.com', '', '', '2016-09-20', 'defualt.png', 'Teacher4', 'ce150eb00337254e0243c31a292410ca6411685de0cf5f97ccd1a4ac2b8119f6179dc4f3aba4bb1793396bca2e28ebc744f6d275ae99e0ead5dd764d2df8242f', 'Teacher', '2016-09-19 05:54:31', '2016-09-19 05:54:31', 1, 'Admin', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmember`
--

CREATE TABLE IF NOT EXISTS `tmember` (
  `tmemberID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `transportID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `tbalance` varchar(11) DEFAULT NULL,
  `tjoindate` date NOT NULL,
  PRIMARY KEY (`tmemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `transportID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `route` text NOT NULL,
  `vehicle` int(11) NOT NULL,
  `fare` varchar(11) NOT NULL,
  `note` text,
  PRIMARY KEY (`transportID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `jod` date NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(40) NOT NULL,
  `create_usertype` varchar(20) NOT NULL,
  `useractive` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitorinfo`
--

CREATE TABLE IF NOT EXISTS `visitorinfo` (
  `visitorID` bigint(12) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `email_id` varchar(128) DEFAULT NULL,
  `phone` text NOT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `company_name` varchar(128) DEFAULT NULL,
  `coming_from` varchar(128) DEFAULT NULL,
  `to_meet` varchar(128) DEFAULT NULL,
  `representing` varchar(128) DEFAULT NULL,
  `to_meet_personID` int(11) NOT NULL,
  `to_meet_person_usertype` varchar(40) NOT NULL,
  `check_in` timestamp NULL DEFAULT NULL,
  `check_out` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`visitorID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
