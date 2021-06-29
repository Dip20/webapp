-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.2
-- Generation Time: Jul 11, 2020 at 02:30 PM
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
-- Table structure for table `tbl_technician`
--

CREATE TABLE `tbl_technician` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contactno` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_technician`
--

INSERT INTO `tbl_technician` (`id`, `name`, `contactno`, `emailid`) VALUES
(42, 'Tapan Karmakar', '9734562604', 'tk.jyotirmay2005.tk@gmail.com'),
(43, 'arati electronics', '8145015672', 'aratiservice@gmail.com'),
(44, 'gopal sarkar', '6296117143', '82gopalsarkar@gmail.com'),
(45, 'arijit sarkar', '6294850231', 'debjani99sarkar@gmail.com'),
(46, 'somnath paul', '9091134504', 'somnathpaulapache@gail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_technician`
--
ALTER TABLE `tbl_technician`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_technician`
--
ALTER TABLE `tbl_technician`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
