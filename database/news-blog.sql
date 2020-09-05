-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 03, 2020 at 11:47 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(1, 'Sports', 0),
(3, 'Politics', 2),
(4, 'Entertainment', 5),
(5, 'Other', 2);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL,
  PRIMARY KEY (`post_id`),
  UNIQUE KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(11, 'Kapil Sharma', 'Kapil Sharma is an Indian stand-up comedian, television presenter, actor and producer known for hosting The Kapil Sharma Show. He previously hosted the television comedy shows Comedy Nights with Kapil and Family Time with Kapil. Ormax Media rated Sharma the most popular Indian television personality in April 2016. ', '4', '29 Aug, 2020', 1, '423096_v9_aa.jpg'),
(13, 'CID', 'ACP Pradyuman, Daya and Abhijeet are an elite trio of officers who work for the CID. They seek the help of professional forensic expert Dr Salunkhe and solve various criminal cases.', '4', '31 Aug, 2020', 1, 'Screenshot_2020-07-31-21-38-49-588_com.mi.android.globalFileexplorer.jpg'),
(3, 'BBB', 'BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB', '3', '28 Aug, 2020', 1, 'sport_2.jpg'),
(12, 'Manan Shah', 'Manan Shah is the 24 year old founder of Vadodara based cyber security firm Avalance Global Solutions. His expertise in cyber forensics has helped Gujarat & Rajasthan police, Ministry of Defence, CBI Gandhinagar, Vadodara & Ahmedabad Airport in safeguarding their platform against attacks', '5', '29 Aug, 2020', 1, 'manan-shah__88512.jpeg'),
(7, 'htyrt', 'yrtyrt', '4', '28 Aug, 2020', 2, '0.jpg'),
(14, 'Taarak Mehta Ka Ooltah Chashmah', 'The residents of a housing society help each other find solutions when they face common, real-life challenges and get involved in sticky situations.', '4', '31 Aug, 2020', 1, 'images.jpg'),
(15, 'Balveer', 'Baal Veer is taken to a fairyland where he is blessed with special powers by six fairies, each having her own unique traits. He uses his powers to help good and honest children, including his friends.', '4', '31 Aug, 2020', 1, 'download.jpg'),
(16, 'AA', 'AA', '5', '03 Sep, 2020', 1, 'Book.jpg'),
(17, 'BB', 'BB', '3', '03 Sep, 2020', 4, 'PNG.png');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `websitename` varchar(60) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `footerdesc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`websitename`, `logo`, `footerdesc`) VALUES
('New - Site', 'news.jpg', 'ï¿½ Copyright 2020 News | Powered by News-Blog');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Hemal', 'Boghara', 'HemalBoghara', '93c0a31726fc8dce8c3f649a84d9b7b4', 1),
(2, 'Dhaval', 'Boghara', 'DB', '3d377916b7e62f7014878b4420b53670', 0),
(3, 'Admin', 'Admin', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 1),
(4, 'Bhargav', 'Bhavani', 'BB', '202cb962ac59075b964b07152d234b70', 0),
(5, 'A', 'A', 'A', '7fc56270e7a70fa81a5935b72eacbe29', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
