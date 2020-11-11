-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2020 at 10:27 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water_quality`
--

-- --------------------------------------------------------

--
-- Table structure for table `Issues`
--

CREATE TABLE `Issues` (
  `IssueID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `IssueDesc` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Sites`
--

CREATE TABLE `Sites` (
  `CheckID` int(11) NOT NULL,
  `Latitude` float NOT NULL,
  `Longitude` float NOT NULL,
  `Description` varchar(256) NOT NULL,
  `TestStatus` varchar(50) DEFAULT 'Not Tested',
  `Ranking` varchar(50) DEFAULT NULL,
  `Equipment` varchar(256) DEFAULT NULL,
  `TestDate` date DEFAULT NULL,
  `RequestDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Sites`
--

INSERT INTO `Sites` (`CheckID`, `Latitude`, `Longitude`, `Description`, `TestStatus`, `Ranking`, `Equipment`, `TestDate`, `RequestDate`) VALUES
(6, -27.5038, 153.017, 'smells bad ', 'Tested', 'Good', 'Horiba U-52', '2020-10-28', '2020-10-01 00:00:00'),
(7, -27.4994, 153.016, 'Very green', 'Not Tested', NULL, NULL, NULL, '2020-09-29 00:00:00'),
(8, -27.4963, 153.12, 'Dead fish', 'Tested', 'Good', 'HOBO U26-001', '2020-10-28', '2020-10-14 00:00:00'),
(9, -27.4796, 153.057, 'Stinks!', 'Tested', 'Okay', 'Horiba U-54G', '2020-10-23', '2020-10-17 00:00:00'),
(10, -27.3608, 152.608, 'Flooding', 'Tested', 'Good', 'Horiba U-52', '2020-10-01', '2020-10-05 00:00:00'),
(11, -27.6334, 153.002, 'doesn\'t look too good', 'Tested', 'Good', 'Horiba U-53', '2020-09-21', '2020-09-29 00:00:00'),
(12, -27.6818, 152.917, 'f', 'Tested', 'Bad', 'HOBO U26-001', '2020-09-20', '2020-09-24 00:00:00'),
(13, -27.5208, 152.992, 'dd', 'Tested', 'Okay', 'Horiba U-54G', '2020-10-21', '2020-10-13 00:00:00'),
(14, -27.476, 152.979, 'ded', 'Not Tested', NULL, NULL, NULL, '2020-10-05 00:00:00'),
(28, -31.1329, 140.128, 'bad water', 'Not Tested', NULL, NULL, NULL, '2020-10-29 23:56:41'),
(29, -29.9264, 150.988, 'eh', 'Tested', 'Okay', 'Horiba U-53G', '2020-09-23', '2020-10-29 23:56:51'),
(30, -32.5514, 121.849, 'ss', 'Not Tested', NULL, NULL, NULL, '2020-10-29 23:56:59'),
(31, -35.3353, 143.047, 'ww', 'Tested', 'Good', 'Horiba U-54G', '2020-10-23', '2020-10-29 23:57:08'),
(32, -23.7351, 148.063, 'Water looks funny', 'Tested', 'Good', 'HOBO U26-001', '2020-09-12', '2020-10-29 23:57:25'),
(33, -24.9313, 133.231, 'Stinks', 'Tested', 'Bad', 'Horiba U-54G', '2020-10-21', '2020-10-29 23:57:37'),
(34, -33.9012, 150.958, 'crappp', 'Not Tested', NULL, NULL, NULL, '2020-10-29 23:57:52'),
(35, -34.0876, 151.084, 'looks bad', 'Tested', 'Okay', 'Horiba U-52G', '2020-09-10', '2020-10-29 23:58:09'),
(36, -38.3837, 145.533, 'Dead fish', 'Tested', 'Okay', 'Horiba U-54G', '2020-10-02', '2020-10-29 23:58:23'),
(37, -37.6267, 144.903, 'Water looks funny', 'Not Tested', NULL, NULL, NULL, '2020-10-29 23:58:34'),
(38, -42.4153, 147.362, 'f', 'Tested', 'Okay', 'HOBO U26-001', '2020-10-28', '2020-10-29 23:58:47'),
(39, -31.9312, 115.93, 'f', 'Tested', 'Bad', 'Horiba U-53G', '2020-10-01', '2020-10-29 23:58:59'),
(40, -23.6483, 122.894, 'f', 'Tested', 'Bad', 'HOBO U26-001', '2020-10-28', '2020-10-29 23:59:06'),
(41, -34.0113, 151.089, 'f', 'Not Tested', NULL, NULL, NULL, '2020-10-29 23:59:14'),
(42, -20.3742, 148.377, 'f', 'Tested', 'Bad', 'HOBO U26-001', '2020-10-12', '2020-10-29 23:59:27'),
(43, -34.8268, 138.571, 'f', 'Tested', 'Great', 'Horiba U-54G', '2020-10-02', '2020-10-29 23:59:36'),
(44, -27.4802, 153.027, 'Wet', 'Tested', 'Bad', 'Horiba U-52', '2020-10-30', '2020-10-30 06:22:47'),
(45, -27.4915, 153.002, 'Fish ', 'Not Tested', 'Okay', 'Horiba U-52', '2020-10-30', '2020-10-30 06:41:37'),
(46, -27.4839, 152.998, 'Wet', 'Not Tested', NULL, NULL, NULL, '2020-10-30 06:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Branch` varchar(128) NOT NULL,
  `Role` varchar(128) NOT NULL,
  `Suburb` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Username`, `Password`, `Branch`, `Role`, `Suburb`) VALUES
(1, 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a', 'a'),
(2, 'Roycedong', 'ebe1eb0d373098f41881d4de855a6229', 'wer', 'wer', 'wer'),
(3, 's', '03c7c0ace395d80182db07ae2c30f034', 's', 's', 's'),
(4, 'j', '363b122c528f54df4a0446b6bab05515', 'j', 'j', 'j'),
(5, 'bruh', '2e315dcaa77983999bf11106c65229dc', 'bruh branch', 'bruh ', 'qld'),
(6, '123', '202cb962ac59075b964b07152d234b70', '123', '123', '123'),
(7, 'jun19royce', 'ebe1eb0d373098f41881d4de855a6229', 'wer', 'wer', 'wer'),
(8, 'RoyceDong', '202cb962ac59075b964b07152d234b70', 'isd', 'isd', 'isd'),
(9, 's4508492', 'ebe1eb0d373098f41881d4de855a6229', 'wer', 'wer', 'wer'),
(10, 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'b', 'b'),
(11, 'victor1234', '1517eb80ea9157bf07af0bcf31873815', 'Department of Water', 'Data Updation', 'Brisbane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Issues`
--
ALTER TABLE `Issues`
  ADD PRIMARY KEY (`IssueID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Sites`
--
ALTER TABLE `Sites`
  ADD PRIMARY KEY (`CheckID`),
  ADD UNIQUE KEY `unique_site` (`Latitude`,`Longitude`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Issues`
--
ALTER TABLE `Issues`
  MODIFY `IssueID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Sites`
--
ALTER TABLE `Sites`
  MODIFY `CheckID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Issues`
--
ALTER TABLE `Issues`
  ADD CONSTRAINT `Issues_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
