-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2019 at 07:07 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `pen_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(30) NOT NULL,
  `publisher` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `title`, `publisher`) VALUES
('1234567891234', 'testTitle', 'testPublisher'),
('lkj', 'lkj', 'lkj'),
('mnb', 'mnb', 'mnb'),
('oiu', 'oiu title', 'oiu'),
('poi', 'poi', 'poi');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(10) NOT NULL,
  `course_name` varchar(30) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `orderNumber` int(10) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `price` int(5) NOT NULL,
  `condition` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`orderNumber`, `isbn`, `email`, `price`, `condition`) VALUES
(2, 'mnb', ',mn', 98, ''),
(3, 'oiu', 'oiu', 98, ''),
(4, 'oiu', 'oiu', 98, ''),
(5, '1234567891234', 'testEmail@gmail.com', 98, '');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `file_name` varchar(30) NOT NULL,
  `cover_photo` blob NOT NULL,
  `back_photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `email` varchar(50) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `squadron` varchar(2) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`email`, `fname`, `lname`, `phone`, `squadron`, `password`) VALUES
(',mn', ',mn', ',nm', ',nm', '21', ',mn'),
('jhg', 'jhg', 'jh', 'gjhg', '7', 'jhg'),
('oi', 'oi', 'oi', 'oi', '98', 'oi'),
('oiu', 'oiu', 'oiu', 'oiu', 'oi', 'oiu'),
('TE', 'TRE', 'TRE', 'TRE', '54', 'TRE'),
('testEmail@gmail.com', 'testFName', 'testLName', '8675309', '29', 'testPassword');

-- --------------------------------------------------------

--
-- Table structure for table `writings`
--

CREATE TABLE `writings` (
  `authorid` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`orderNumber`),
  ADD KEY `isbn` (`isbn`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`file_name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `writings`
--
ALTER TABLE `writings`
  ADD KEY `author_id` (`authorid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `orderNumber` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `student` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `isbn` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`) ON UPDATE CASCADE;

--
-- Constraints for table `writings`
--
ALTER TABLE `writings`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`authorid`) REFERENCES `author` (`author_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
