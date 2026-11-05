DROP DATABASE IF EXISTS `bobby_tables`;

CREATE DATABASE `bobby_tables`;

USE `bobby_tables`;

CREATE TABLE `users` (
    id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(100),
    password varchar(100)
);

INSERT INTO users (`username`, `password`) values ('bobby', 'password');

