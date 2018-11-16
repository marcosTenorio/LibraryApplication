-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2017 at 03:28 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` int(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `author` varchar(20) NOT NULL,
  `studentNumber` int(7) NOT NULL DEFAULT '1111111'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `title`, `author`, `studentNumber`) VALUES
(321509021, 'Bulletproof Web Design', 'Dan Cederholm', 1111111),
(321643380, 'Handcrafted CSS', 'Dan Cederholm', 2016789),
(321687299, 'Introducing HTML5', 'Remy Sharp', 1111111),
(346758678, 'Harry Potter', 'Albert Richie', 1111111),
(349108390, 'Generation X', 'Douglas Coupland', 1111111),
(349113467, 'The Tipping Point', 'Malcolm Gladwell', 1111111),
(390897685, 'How to programming', 'Jacob White', 1111111),
(456788796, 'Java Advanced', 'Greg North', 2016271),
(567894356, 'Javascript to beginners', 'Alex Santos', 1111111),
(569067843, 'Cat Fish', 'Albert Granville', 1111111),
(768958743, 'Travel Guide', 'Emma Watson', 2016456),
(896784657, 'PHP intermediate', 'Walter Castro', 2016271),
(1238907654, 'Introducing Networking ', 'Bob Crop', 1111111),
(2147483647, 'Lord of Rings', 'Trevor Lee', 1111111);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `studentNumber` int(7) NOT NULL,
  `isbn` int(10) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `studentNumber`, `isbn`, `date`, `due_date`) VALUES
(2, 2016456, 768958743, '2017-12-06 16:06:10', '2017-12-13'),
(3, 2016271, 456788796, '2017-12-06 16:06:31', '2017-12-13'),
(4, 2016271, 896784657, '2017-12-06 16:06:42', '2017-12-13'),
(5, 2016789, 321643380, '2017-12-06 16:06:53', '2017-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `studentNumber` int(7) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`studentNumber`, `username`, `password`) VALUES
(1111111, 'admin', '$2y$10$lkVDBJhLd1yjGAOQtJx4Ce1TOIsXK6fRPGkMcJey8vQu.E2i6psyq'),
(2016271, 'marcos', '$2y$10$z4K8McszwURIsRz./mCTaOYYW1mLU/LCb76SC4u44SwGKypoSfLn6'),
(2016456, 'jacob', '$2y$10$4ES.XjsZW4x7V6FcjRX5be4lxzqRg0L9HuxUtgNT8PxKrOE3MNvpa'),
(2016789, 'greg', '$2y$10$Mh.GC7x.MDgJ5Ub0e..b7.H./rEjJ.083XpbaAjma/1QcS/Cl/iSS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `studentNumber` (`studentNumber`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentNumber` (`studentNumber`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`studentNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
