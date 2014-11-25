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
  `status` TINYINT(1) NOT NULL comment '0=pendiente, 1=aceptado',
  PRIMARY KEY (`friend1`, `friend2`),
  FOREIGN KEY (`friend1`) REFERENCES `Users` (`Username`),
  FOREIGN KEY (`friend2`) REFERENCES `Users` (`Username`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `Mensajes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Messages` ;

CREATE TABLE IF NOT EXISTS `Messages` (
  `idMes` INT NOT NULL AUTO_INCREMENT,
  `sender` VARCHAR(45) NOT NULL,
  `recipient` VARCHAR(45) NOT NULL,
  `content` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idMes`),
  FOREIGN KEY (`sender`) REFERENCES `Users` (`username`),
  FOREIGN KEY (`recipient`) REFERENCES `Users` (`username`)
  )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

insert into Users (username, passwd, mail) values ("user1", "user1", "user1@gmail.com");
insert into Users (username, passwd, mail) values ("user2", "user2", "user2@gmail.com");
insert into Users (username, passwd, mail) values ("user3", "user3", "user3@gmail.com");

insert into Posts (content, author) values("Post de ejemplo", "user1");
insert into Posts (content, author) values ("Post de ejemplo 2", "user2");

insert into Friends (friend1, friend2, status) values ("user1", "user2", "1");
insert into Friends (friend1, friend2, status) values ("user2", "user1", "1");
insert into Friends (friend1, friend2, status) values ("user2", "user3", "0");


insert into Favorites (post,username) values ("2", "user1");

