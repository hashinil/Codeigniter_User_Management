-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/


--
-- Database: `internations_dev`
--
CREATE DATABASE IF NOT EXISTS `internations_dev` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `internations_dev`;


--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2022 at 01:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internations_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `in_user`
--

CREATE TABLE `in_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_group_id` int(4) NOT NULL,
  `user_status` int(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_user`
--

INSERT INTO `in_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_group_id`, `user_status`) VALUES
(1, 'user1@gmail.com', 'user1@gmail.com', 'ba5ef51294fea5cb4eadea5306f3ca3b', 1, 1),
(2, 'user2@gmail.com', 'user2@gmail.com', '415ae01d78998c8191a416ddd8cabe33', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `in_user_groups`
--

CREATE TABLE `in_user_groups` (
  `ug_id` int(4) NOT NULL COMMENT 'Unique ID of User Groups',
  `ug_name` varchar(20) NOT NULL COMMENT 'Name of User Groups',
  `ug_status` int(4) NOT NULL DEFAULT 1 COMMENT 'Status of User Groups'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `in_user_groups`
--

INSERT INTO `in_user_groups` (`ug_id`, `ug_name`, `ug_status`) VALUES
(1, 'admin', 1),
(2, 'member', 1),
(3, 'user', 1),
(4, 'test', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `in_user`
--
ALTER TABLE `in_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `in_user_groups`
--
ALTER TABLE `in_user_groups`
  ADD PRIMARY KEY (`ug_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `in_user`
--
ALTER TABLE `in_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `in_user_groups`
--
ALTER TABLE `in_user_groups`
  MODIFY `ug_id` int(4) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID of User Groups', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
