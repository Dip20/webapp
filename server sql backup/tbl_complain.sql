-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.2
-- Generation Time: Jun 24, 2020 at 02:48 PM
-- Server version: 5.7.30-33-log
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `santusar_santuDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complain`
--

CREATE TABLE `tbl_complain` (
  `id` int(11) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `contactno` varchar(12) NOT NULL,
  `customeraddress` varchar(500) NOT NULL,
  `customerpincode` varchar(8) NOT NULL,
  `customerlandmark` varchar(200) NOT NULL,
  `productname` varchar(200) NOT NULL,
  `productmodelno` varchar(100) NOT NULL,
  `probelmdetails` varchar(500) NOT NULL,
  `delarname` varchar(100) NOT NULL,
  `complaindate` date NOT NULL,
  `jobno` varchar(100) NOT NULL,
  `technicianassigned` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `statustime` varchar(100) NOT NULL,
  `serialno` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complain`
--

INSERT INTO `tbl_complain` (`id`, `customername`, `contactno`, `customeraddress`, `customerpincode`, `customerlandmark`, `productname`, `productmodelno`, `probelmdetails`, `delarname`, `complaindate`, `jobno`, `technicianassigned`, `status`, `statustime`, `serialno`, `remarks`) VALUES
(200, 'tahh', 'yh', 'hhj', '743256', '44', '65', '5', '56', '55', '2020-06-13', 'ART130620202386', 'gopal sarkar', 'completed', '2020-06-13 14:13:26', 'Bxbzb', ''),
(201, 'Customer', '12588999', 'Hsjsj', 'Hzjsj', 'Hshsj', 'Hshshs', 'Hshsh', 'Hshsh', 'Hshsj', '2020-06-15', 'ART150620209961', 'gopal sarkar', 'completed', '16-06-2020 , 08:34:51-pm', 'aa', 'Bzbznz'),
(202, 'Bxbz', 'Hxhxjx', 'Hxhzhz', 'Hzhzb', 'Hzhzhz', 'Hxhxjz', 'Hdhxhx', 'Hdhdhd', 'Hxhxh', '2020-06-15', 'ART150620207215', 'arijit sarkar', 'completed', '16-06-2020 , 08:36:02-pm', 'Nddnnd', 'Nznznz'),
(203, 'Bzbzb', 'Hxjdnd', 'Hxhzhz', 'Hxhxbx', 'Bdxbxb', 'Bxbxxn', 'Bxbxn', 'Bxbxn', 'Hxbxbx', '2020-06-15', 'ART150620208765', 'somnath paul', 'completed', '2020-06-15 08:38:36', 'Hxhx', 'Nxnznz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_complain`
--
ALTER TABLE `tbl_complain`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_complain`
--
ALTER TABLE `tbl_complain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
