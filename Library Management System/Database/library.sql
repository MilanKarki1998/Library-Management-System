-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 05:57 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `bookreq`
--

CREATE TABLE IF NOT EXISTS `bookreq` (
  `id` int(10) unsigned NOT NULL,
  `Student_Name` varchar(170) DEFAULT NULL,
  `Student_ID` varchar(150) DEFAULT NULL,
  `Book_Name` varchar(150) DEFAULT NULL,
  `Author` varchar(150) DEFAULT NULL,
  `Information` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookreq`
--

INSERT INTO `bookreq` (`id`, `Student_Name`, `Student_ID`, `Book_Name`, `Author`, `Information`) VALUES
(6, '23', 'SID024', 'er', 'rwe', 'ekhfashdcsn'),
(7, 'Milan Karki', 'SID024', 'R1', 'jack', ''),
(8, 'gythyt', 'SID005', 'f', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) unsigned NOT NULL,
  `Book_Name` varchar(170) DEFAULT NULL,
  `Category` varchar(150) DEFAULT NULL,
  `Author` varchar(150) DEFAULT NULL,
  `ISBN` varchar(150) DEFAULT NULL,
  `Price` varchar(150) DEFAULT NULL,
  `TCopies` int(20) NOT NULL,
  `Copies` int(10) DEFAULT NULL,
  `TimeIssue` int(20) NOT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `Book_Name`, `Category`, `Author`, `ISBN`, `Price`, `TCopies`, `Copies`, `TimeIssue`, `RegDate`, `UpdationDate`) VALUES
(1, '232', 'Medical', 'w', '1', '100', 6, 1, 1, '2021-09-16 04:01:28', '2021-11-16 04:06:05'),
(2, 'king', 'History', 'msaiao', 'kjsn', 'mswqk', 10, 10, 0, '2021-09-26 06:59:43', '2021-10-28 05:02:34'),
(3, 'King2', 'History', 'Milan', '112', '230', 5, 5, 0, '2021-10-28 04:47:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issuedbooks`
--

CREATE TABLE IF NOT EXISTS `issuedbooks` (
  `id` int(10) unsigned NOT NULL,
  `BookID` varchar(50) DEFAULT NULL,
  `StudentId` varchar(70) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ExpectedReturnDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ReturnStatus` varchar(1) DEFAULT NULL,
  `fine` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuedbooks`
--

INSERT INTO `issuedbooks` (`id`, `BookID`, `StudentId`, `IssuesDate`, `ExpectedReturnDate`, `ReturnDate`, `ReturnStatus`, `fine`) VALUES
(6, '1', 'SID024', '2021-09-21 08:48:21', '2021-09-19 18:15:00', '2021-10-29 06:26:30', '1', '0.11'),
(7, '1', 'SID024', '2021-09-21 09:11:26', '2021-09-21 18:15:00', '2021-09-21 09:11:39', '1', '0'),
(8, '1', 'SID024', '2021-09-21 09:15:01', '2021-09-18 18:15:00', '2021-09-21 12:21:48', '1', '0.2'),
(9, '1', 'SID024', '2021-09-21 12:01:26', '2021-08-20 12:01:00', '2021-09-21 12:21:34', '1', '3.1'),
(12, '1', 'SID005', '2021-09-26 07:03:44', '2021-09-28 18:15:00', '2021-10-01 16:50:04', '1', '0.2'),
(13, '1', 'SID024', '2021-09-26 07:22:45', '2021-09-28 06:15:00', '2021-10-01 15:23:04', '1', '0.2'),
(14, '1', 'SID025', '2021-10-01 09:19:36', '2021-09-01 02:15:00', '2021-10-01 09:19:46', '1', '2.9'),
(15, '1', 'SID025', '2021-10-01 09:20:43', '2021-09-23 02:15:00', '2021-10-01 09:20:51', '1', '0.7'),
(16, '1', 'SID025', '2021-10-01 16:51:38', '2021-10-07 07:51:00', '2021-10-28 06:53:20', '1', '2.1'),
(17, '1', 'SID024', '2021-10-04 06:32:28', '2021-10-04 12:30:00', '2021-10-28 05:02:57', '1', '2.4'),
(18, '1', 'SID007', '2021-10-28 06:53:47', '2021-10-31 12:30:00', '2021-10-28 07:01:22', '1', '0'),
(19, '1', 'SID007', '2021-10-28 07:01:49', '2021-11-30 12:30:00', '2021-10-28 07:06:08', '1', '0'),
(20, '1', 'SID007', '2021-10-28 07:06:22', '2021-11-02 12:30:00', '2021-10-28 07:22:14', '1', '0'),
(21, '1', 'SID007', '2021-10-28 07:22:38', '2021-11-29 12:30:00', '2021-10-28 07:23:46', '1', '0'),
(22, '1', 'SID007', '2021-10-28 07:23:55', '2021-10-31 12:30:00', '2021-10-28 07:28:41', '1', '0'),
(23, '1', 'SID007', '2021-10-28 07:35:54', '2021-11-05 12:30:00', '0000-00-00 00:00:00', NULL, NULL),
(24, '1', 'SID006', '2021-10-29 05:43:53', '2021-11-11 15:37:00', '0000-00-00 00:00:00', NULL, NULL),
(25, '1', 'SID006', '2021-10-29 06:09:46', '2021-12-10 02:27:27', NULL, NULL, NULL),
(26, '1', 'SID007', '2021-11-15 07:16:59', '2021-11-16 02:31:33', NULL, NULL, NULL),
(27, '1', 'SID007', '2021-11-16 04:06:05', '2021-11-16 23:20:45', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `News_Id` int(10) unsigned NOT NULL,
  `announcement` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`News_Id`, `announcement`) VALUES
(2, 'hi'),
(3, 'hi milan');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) unsigned NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `StudentId` varchar(90) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `profile_image`, `StudentId`, `name`, `mobile`, `email`, `password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, '1635074707-2.PNG', 'SID024', 'Milan Karki', '9841323129', 'milan@gmail.com', '3d276164c559448e773f5a97cb6837ad', 0, '2021-09-16 02:19:47', '2021-11-14 09:41:45'),
(2, NULL, 'SID025', 'Milan', '9834567809', 'milan1@gmail.com', 'ae7be26cdaa742ca148068d5ac90eaca', 1, '2021-09-18 04:47:10', NULL),
(3, NULL, 'SID005', 'z', '9841364534', 'm@gmail.com', '6f8f57715090da2632453988d9a1501b', 1, '2021-09-22 12:30:26', NULL),
(4, NULL, 'SID006', 'mi', '981', 'h@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-01 15:54:21', NULL),
(5, NULL, 'SID007', 'dd', '9841364534', 'd@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-01 15:56:33', NULL),
(6, NULL, 'SID008', 'K1', '9841364534', '1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-01 15:58:30', NULL),
(7, NULL, 'SID009', 'k1', '123456789', 'm221@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-01 16:01:00', NULL),
(8, NULL, 'SID010', 'k m', '9841364534', 'm2345@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-01 16:02:42', NULL),
(9, NULL, 'SID011', 'm k', '9841364534', '5642@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2021-10-01 16:20:23', NULL),
(10, NULL, 'SID012', 'm k', '9812345238', '11@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-01 16:24:00', NULL),
(11, NULL, 'SID013', '12 1', '9841364534', '118@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2021-10-24 10:57:34', NULL),
(12, NULL, 'SID014', 'milan', '9841323561', '123452@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-24 11:00:57', NULL),
(13, NULL, 'SID015', 'Milan Karki', '8812345678', 'milsna@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2021-10-24 11:14:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `ID` int(11) NOT NULL,
  `StdID` varchar(255) NOT NULL,
  `StdName` varchar(255) NOT NULL,
  `StdIP` varbinary(25) NOT NULL,
  `LoginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`ID`, `StdID`, `StdName`, `StdIP`, `LoginTime`) VALUES
(1, 'sid024', 'Milan Karki', 0x3a3a31, '2021-10-13 05:41:39'),
(2, '', 'Milan Karki', 0x3a3a31, '2021-09-22 05:55:14'),
(3, 'sid024', 'Milan Karki ', 0x3a3a31, '2020-09-22 05:56:07'),
(4, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 05:57:27'),
(5, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 05:58:26'),
(6, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 06:03:03'),
(7, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 06:04:38'),
(8, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 06:15:32'),
(9, 'SID024', 'Milan Karki', 0x4d6f7a696c6c612f352e30202857696e, '2021-10-26 06:26:31'),
(10, 'SID024', 'Milan Karki', 0x4d6f7a696c6c612f352e30202857696e646f7773204e542036, '2021-10-26 06:28:28'),
(11, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 07:41:10'),
(12, 'SID024', 'Milan Karki', 0x3132372e302e302e31, '2021-10-26 07:43:48'),
(13, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 07:45:26'),
(14, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 07:54:57'),
(15, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 07:57:28'),
(16, 'SID024', 'Milan Karki', '', '2021-10-26 07:58:27'),
(17, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 08:07:26'),
(18, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 08:15:34'),
(19, 'SID007', 'dd', 0x3a3a31, '2021-10-26 08:41:16'),
(20, 'SID024', 'Milan Karki', 0x3a3a31, '2021-10-26 09:05:48'),
(21, 'SID007', 'dd', 0x3a3a31, '2021-10-27 05:29:25'),
(22, 'SID007', 'dd', 0x3a3a31, '2021-10-29 07:51:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookreq`
--
ALTER TABLE `bookreq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuedbooks`
--
ALTER TABLE `issuedbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`News_Id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bookreq`
--
ALTER TABLE `bookreq`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `issuedbooks`
--
ALTER TABLE `issuedbooks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `News_Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
