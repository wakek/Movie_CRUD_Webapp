DROP DATABASE IF EXISTS wkyei_crud;

CREATE DATABASE wkyei_crud;

USE wkyei_crud;

DROP TABLE IF EXISTS `MOVIE`;

CREATE TABLE Movie (
Movie_ID INT (8) NOT NULL auto_increment,
Movie_Title VARCHAR (50) NOT NULL,
Movie_Genre VARCHAR (20) not NULL,
About_Movie TEXT,
Movie_Cover VARCHAR (100),
PRIMARY KEY (Movie_ID));