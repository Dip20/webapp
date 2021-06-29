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
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `contactno` varchar(10) NOT NULL,
  `userrole` varchar(100) NOT NULL,
  `permission` varchar(100) NOT NULL,
  `Remarks` varchar(100) NOT NULL,
  `del_index` varchar(100) NOT NULL,
  `admin_redirect` varchar(100) NOT NULL,
  `block` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `username`, `password`, `Email`, `contactno`, `userrole`, `permission`, `Remarks`, `del_index`, `admin_redirect`, `block`, `timestamp`) VALUES
(22, 'santu', '4124bc0a9335c27f086f24ba207a4912', 'santu@gmail.com', '1234567890', 'admin', 'Full', 'DB_admin', 'FALSE', 'server', 'No', '2020-06-22 13:06:01'),
(51, 'Tapan Karmakar', 'f5cf510bc2470d26e96caab655e7ee14', 'tk.jyotirmay2005.tk@gmail.com', '9734562604', 'admin', 'Full', 'App_admin', 'FALSE', '', 'No', '2020-06-24 01:52:32'),
(52, 'arati electronics', '6cc4d082af4f08009c4220d022f48356', 'aratiservice@gmail.com', '8145015672', 'admin', 'Modify', '', '', '', 'No', '2020-06-23 19:47:14'),
(53, 'gopal sarkar', '81dc9bdb52d04dc20036dbd8313ed055', '82gopalsarkar@gmail.com', '6296117143', 'user', 'View', '', '', '', 'No', '2020-06-23 09:46:17'),
(54, 'arijit sarkar', '3c049fb9b434b6019685cd1dd7c2043f', 'debjani99sarkar@gmail.com', '6294850231', 'user', 'View', '', '', '', 'No', '2020-06-14 19:01:57'),
(55, 'somnath paul', '37d1c437b1d7bfd25366fef61cf1cedb', 'somnathpaulapache@gmail.com', '9091134504', 'user', 'View', '', '', '', 'No', '2020-06-14 19:02:10'),
(60, 'admin', '4124bc0a9335c27f086f24ba207a4912', 'santusarkar2020@gmail.com', '8637554692', 'admin', 'Full', 'DB_admin', 'FALSE', 'server', 'No', '2020-06-22 13:11:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
