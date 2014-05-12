-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2014 at 11:50 PM
-- Server version: 5.5.36-MariaDB-log
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wildbook`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`mark`@`localhost` FUNCTION `getrelation`(x int, y int) RETURNS int(11)
    DETERMINISTIC
begin 
declare result int;
if x=y then
set result=3;
else 
if exists (select * from friendship where maker=x and makee=y) then
	set result=2;
else
	if exists ( select * from friendship f1, friendship f2 where f1.maker=x and f1.makee=f2.maker and f2.makee=y) then
	set result=1;
	else 
		set result=0;
end if;
end if;
end if;
return result;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `likeactivity_num`
--
CREATE TABLE IF NOT EXISTS `likeactivity_num` (
`activityid` int(11)
,`like_num` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `likeactloc_num`
--
CREATE TABLE IF NOT EXISTS `likeactloc_num` (
`actlocid` int(11)
,`like_num` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `likediary_num`
--
CREATE TABLE IF NOT EXISTS `likediary_num` (
`diaryid` int(11)
,`like_num` bigint(21)
);
-- --------------------------------------------------------

--
-- Structure for view `likeactivity_num`
--
DROP TABLE IF EXISTS `likeactivity_num`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `likeactivity_num` AS select `likeactivity`.`activityid` AS `activityid`,count(0) AS `like_num` from `likeactivity` group by `likeactivity`.`activityid` union select `activity`.`activityid` AS `activityid`,0 AS `0` from `activity` where (not(`activity`.`activityid` in (select `likeactivity`.`activityid` from `likeactivity`)));

-- --------------------------------------------------------

--
-- Structure for view `likeactloc_num`
--
DROP TABLE IF EXISTS `likeactloc_num`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `likeactloc_num` AS select `likeactloc`.`actlocid` AS `actlocid`,count(0) AS `like_num` from `likeactloc` group by `likeactloc`.`actlocid` union select `actloc`.`actlocid` AS `actlocid`,0 AS `0` from `actloc` where (not(`actloc`.`actlocid` in (select `likeactloc`.`actlocid` from `likeactloc`)));

-- --------------------------------------------------------

--
-- Structure for view `likediary_num`
--
DROP TABLE IF EXISTS `likediary_num`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `likediary_num` AS select `likediary`.`diaryid` AS `diaryid`,count(0) AS `like_num` from `likediary` group by `likediary`.`diaryid` union select `diary`.`diaryid` AS `diaryid`,0 AS `0` from `diary` where (not(`diary`.`diaryid` in (select `likediary`.`diaryid` from `likediary`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
