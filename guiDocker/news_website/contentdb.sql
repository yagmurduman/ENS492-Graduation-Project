

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `contentdb`;

USE `contentdb`;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `contentdb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `cid` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `ccontent` varchar(500) NOT NULL,
  `cDate` varchar(100) DEFAULT NULL,
  `nid` int(20) NOT NULL,
   primary key (cid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `conid` int(20) NOT NULL AUTO_INCREMENT,
  `condate` varchar(100) NOT NULL,
  `conemail` varchar(50) NOT NULL,
  `concontent` varchar(500) NOT NULL,
  primary key(conid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `economy_news` (
  `nId` int(20) NOT NULL AUTO_INCREMENT,
  `nTitle` varchar(300) NOT NULL,
  `nContent` mediumtext NOT NULL,
  `nDate` varchar(100),
  `img` mediumtext NOT NULL,
  `type` int(10) NOT NULL,
   primary key(nid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
   primary key(uid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `comments`
  ADD KEY `nid` (`nid`);


ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `economy_news` (`nid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
