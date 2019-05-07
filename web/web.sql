-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2011 at 07:31 AM
-- Server version: 5.1.54
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHpartnersARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csl`
--

CREATE DATABASE web DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

USE `web`;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `listing` (
  `orderNumber` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `price` int(5) NOT NULL,
  `listDate` date NOT NULL,
  `condition` varchar(11) NOT NULL,
  PRIMARY KEY (`OrderNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `partners`
--

INSERT INTO `listing` (`OrderNumber`, `title`, `email`, `price`, `listDate`, `condition`) VALUES
(1, 'Database Systems', 'C19Chad.Bucko@usafa.edu', 15.00, 2019-4-25, 'Good'),
(2, 'Intro to Physics', 'C21Jimmy.Dunagan@usafa.edu', 10.00, 2019-4-26, 'Poor'),
(3, 'Frankenstien', 'C20Notso.Smartie@usafa.edu', 24.50, 2019-4-27, 'Fair');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userEmail`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--
-- NOTE: passwords are all set to '1234' and then hashed with MD5
--

INSERT INTO `users` (`userEmail`, `userPassword`) VALUES
('C20Heath.Hilton@usafa.edu', '81dc9bdb52d04dc20036dbd8313ed055'),
('C20Evan.Gabrielsen@usafa.edu', '81dc9bdb52d04dc20036dbd8313ed055'),
('C19Chad.Bucko@usafa.edu', '81dc9bdb52d04dc20036dbd8313ed055'),
('C21Jimmy.Dunagan@usafa.edu', '81dc9bdb52d04dc20036dbd8313ed055'),
('C20Notso.Smartie@usafa.edu', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE IF NOT EXISTS `student` (
  `email` varchar(50) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `phone` int(10) NOT NULL,
  `squadron` int(2) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `atudent` (`email`, `fname`, `lname`, `phone`, `squadron`) VALUES
('C19Chad.Bucko@usafa.edu', 'Chad', 'Bucko', 3188807123, 21),
('C21Jimmy.Dunagan@usafa.edu', 'Jimmy', 'Dunagan', 7198801242, 28),
('C20Notso.Smartie@usafa.edu', 'Notso', 'Smartie', 5148809831, 26);
