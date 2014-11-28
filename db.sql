-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 28, 2014 at 11:40 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `redsocial`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--
drop database if exists REDSOCIAL;
CREATE DATABASE `REDSOCIAL` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- creacion de usuario (dandole todos los privilegios)
GRANT USAGE ON *.* TO 'redsocial'@'localhost';
DROP USER 'redsocial'@'localhost';
CREATE USER 'redsocial'@'localhost' IDENTIFIED BY 'redsocial';
GRANT ALL PRIVILEGES ON `REDSOCIAL`.* TO 'redsocial'@'localhost' WITH GRANT OPTION;


USE `REDSOCIAL`;

DROP TABLE IF EXISTS `users` ;
DROP TABLE IF EXISTS `posts` ;
DROP TABLE IF EXISTS `favorites` ;
DROP TABLE IF EXISTS `friends` ;
DROP TABLE IF EXISTS `messages` ;
CREATE TABLE `favorites` (
`idFav` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `username` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`idFav`, `post`, `username`) VALUES
(1, 2, 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend1` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `friend2` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL COMMENT '0=pendiente, 1=aceptado',
  `dateFriend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend1`, `friend2`, `status`, `dateFriend`) VALUES
('user1', 'user2', 1, '0000-00-00 00:00:00'),
('user2', 'user1', 1, '0000-00-00 00:00:00'),
('user2', 'user3', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
`idMes` int(11) NOT NULL,
  `sender` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `recipient` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
`idPost` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `author` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `numLikes` int(11) NOT NULL DEFAULT '0',
  `datePost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`idPost`, `content`, `author`, `numLikes`, `datePost`) VALUES
(1, 'Post de ejemplo', 'user1', 0, '0000-00-00 00:00:00'),
(2, 'Post de ejemplo 2', 'user2', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `passwd` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `passwd`, `mail`) VALUES
('user1', 'user1', 'user1@gmail.com'),
('user2', 'user2', 'user2@gmail.com'),
('user3', 'user3', 'user3@gmail.com'),
('user5', 'user5', 'user5@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
 ADD PRIMARY KEY (`idFav`), ADD KEY `post` (`post`), ADD KEY `username` (`username`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
 ADD PRIMARY KEY (`friend1`,`friend2`), ADD KEY `friend2` (`friend2`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`idMes`), ADD KEY `sender` (`sender`), ADD KEY `recipient` (`recipient`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`idPost`), ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
MODIFY `idFav` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `idMes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`post`) REFERENCES `posts` (`idPost`),
ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`friend1`) REFERENCES `users` (`username`),
ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend2`) REFERENCES `users` (`username`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`username`),
ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recipient`) REFERENCES `users` (`username`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
