-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2019 at 02:57 AM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `lov`
--

CREATE TABLE `lov` (
  `type` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `objid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lov`
--

INSERT INTO `lov` (`type`, `value`, `objid`) VALUES
('location', 'Melbourne', 1),
('location', 'Sydney', 2),
('role', 'QA Engineer', 3),
('role', 'QA Architect', 4),
('role', 'QA Coach', 5),
('role', 'Release Engineer', 6),
('role', 'Release coach', 7),
('spl', 'Test Architrect', 8),
('spl', 'Data specialist', 9),
('team', 'L&SS leadership', 10),
('team', 'C&SB', 11),
('team', 'Entreprise', 12),
('team', 'Infra Co', 13),
('team', 'ALM', 14),
('team', 'Functional Practice', 15),
('team', 'Non Functional Practice', 16),
('team', 'Orchestration', 17),
('', '', 18),
('team', 'NWOW', 19),
('team', 'Business Operation', 20),
('team', 'Emerging Technology', 21),
('stream', 'Robotics', 22),
('stream', 'Program Delivery', 23),
('stream', 'Continuous Improvements', 24),
('stream', 'Shared Services', 25),
('stream', 'Practice', 26),
('org', 'Araza', 27),
('org', 'Cognizant', 28),
('org', 'Telstra', 29),
('org', 'Wipro', 30),
('org', 'TCS', 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lov`
--
ALTER TABLE `lov`
  ADD PRIMARY KEY (`objid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lov`
--
ALTER TABLE `lov`
  MODIFY `objid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
