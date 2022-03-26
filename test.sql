-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 09:19 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `router_details`
--

CREATE TABLE `router_details` (
  `sapid` int(18) NOT NULL,
  `hostname` varchar(14) NOT NULL,
  `loopback` varchar(100) NOT NULL,
  `mac_address` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `router_details`
--

INSERT INTO `router_details` (`sapid`, `hostname`, `loopback`, `mac_address`) VALUES
(1, 'amol234987sd', '04804598', '1122342'),
(2, '4', '438098', '4444'),
(999, '99', '11.11.111.111', '222.222.222.222'),
(3999, '33', '', '0'),
(4000, 'host', 'mac', 'loop'),
(4002, 'host.india.in', 'loop.india.in', '123.111.123.111'),
(4003, 'ip.com.sss', 'loop.124', '12.12.12.43'),
(4004, 'ljsadf.ss', 'loop.125', '12.12.12.44'),
(4005, 'ip.aldfj', 'loop.126', '12.12.12.45'),
(4006, 'asdflj', 'loop.127', '12.12.12.46'),
(4007, 'asdfljsd xcv', 'loop.128', '12.12.12.47'),
(4008, 'ss.ss', 'loop.129', '12.12.12.48'),
(4009, 'asdlj.sdf', 'loop.130', '12.12.12.49'),
(4010, 'sdkj.s', 'loop.131', '12.12.12.50'),
(4011, 'asdflj.in', 'loop.132', '12.12.12.51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `router_details`
--
ALTER TABLE `router_details`
  ADD PRIMARY KEY (`sapid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `router_details`
--
ALTER TABLE `router_details`
  MODIFY `sapid` int(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4012;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
