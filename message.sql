-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2014 at 09:05 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wildbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) DEFAULT NULL,
  `content` text,
  `posttime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `senderid` int(11) DEFAULT NULL,
  `receiverid` int(11) DEFAULT NULL,
  PRIMARY KEY (`messageid`),
  KEY `senderid` (`senderid`),
  KEY `receiverid` (`receiverid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageid`, `title`, `content`, `posttime`, `senderid`, `receiverid`) VALUES
(1, 'Friend Request', NULL, '2014-05-12 02:32:50', 1, 2),
(2, 'real message', 'aaaaaaa', '2014-05-12 02:33:02', 1, 3),
(3, 'a', 'aaa', '2014-05-12 02:40:38', 1, 2),
(4, 'a', 'aaa', '2014-05-12 02:41:10', 1, 2),
(5, 'I see', 'I have never seen!!', '2014-05-12 03:05:13', 4, 1),
(6, 'How about take a shower', 'If by "rip" you mean "pierce a hole in", then the answer is yes, in a way. A black hole has a singularity in its middle, which is a point where the curvature of spacetime becomes infinite.\r\n\r\nIf you use the popular (but slightly misleading!) image of spacetime curvature as being caused by mass that "bends" the fabric of spacetime in the same way a bowling ball bends a mattress:', '2014-05-12 03:05:13', 5, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`senderid`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiverid`) REFERENCES `user` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
