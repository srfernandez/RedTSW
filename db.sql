drop database if exists REDSOCIAL;
CREATE DATABASE `REDSOCIAL` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

-- creacion de usuario (dandole todos los privilegios)
GRANT USAGE ON *.* TO 'redsocial'@'localhost';
DROP USER 'redsocial'@'localhost';
CREATE USER 'redsocial'@'localhost' IDENTIFIED BY 'redsocial';
GRANT ALL PRIVILEGES ON `REDSOCIAL`.* TO 'redsocial'@'localhost' WITH GRANT OPTION;


USE `REDSOCIAL`;


DROP TABLE IF EXISTS `Users` ;
-- creacion de tabla Usuario
CREATE TABLE IF NOT EXISTS `Users` (
  `username` VARCHAR(45) NOT NULL,
  `passwd` VARCHAR(45) NOT NULL,
  `mail` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `Posts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Posts` ;

CREATE TABLE IF NOT EXISTS `Posts` (
  `idPost` INT NOT NULL AUTO_INCREMENT,
  `content` VARCHAR(255) NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `numLikes` int(11) NOT NULL DEFAULT '0',
  `datePost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPost`),
  FOREIGN KEY (`author`) REFERENCES `Users` (`username`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `Favoritos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Favorites` ;

CREATE TABLE IF NOT EXISTS `Favorites` (
  `idFav` INT NOT NULL AUTO_INCREMENT,
  `post` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `dateFav` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFav`),
  FOREIGN KEY (`post`) REFERENCES `Posts` (`idPost`),
  FOREIGN KEY (`username`) REFERENCES `Users` (`username`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `Amigos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Friends` ;

CREATE TABLE IF NOT EXISTS `Friends` (
  `friend1` VARCHAR(45) NOT NULL,
  `friend2` VARCHAR(45),
  `status` TINYINT(1) NOT NULL DEFAULT '0' comment '0=pendiente, 1=aceptado',
  `dateFriend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`friend1`, `friend2`),
  FOREIGN KEY (`friend1`) REFERENCES `Users` (`Username`),
  FOREIGN KEY (`friend2`) REFERENCES `Users` (`Username`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


insert into Users (username, passwd, mail) values ("user1", "user1", "user1@gmail.com");
insert into Users (username, passwd, mail) values ("user2", "user2", "user2@gmail.com");
insert into Users (username, passwd, mail) values ("user3", "user3", "user3@gmail.com");

INSERT INTO `posts` (`idPost`, `content`, `author`, `numLikes`, `datePost`) VALUES
(1, 'Post de ejemplo', 'user1', 0, '0000-00-00 00:00:00'),
(2, 'Post de ejemplo 2', 'user2', 1, '0000-00-00 00:00:00'),
(3, 'Otro post mas', 'user2', 0, '2014-12-03 17:06:59'),
(4, 'nuevo post', 'user1', 0, '2014-12-05 10:41:16');

insert into Friends (friend1, friend2, status) values ("user1", "user2", "1");
insert into Friends (friend1, friend2, status) values ("user2", "user1", "1");
insert into Friends (friend1, friend2, status) values ("user2", "user3", "0");


INSERT INTO `favorites` (`idFav`, `post`, `username`, `dateFav`) VALUES
(1, 2, 'user1', '0000-00-00 00:00:00'),
(2, 3, 'user1', '2014-12-05 10:32:44'),
(3, 1, 'user2', '2014-12-05 10:48:02'),
(4, 4, 'user2', '2014-12-05 10:49:14');


