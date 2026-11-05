DROP DATABASE IF EXISTS `banana_tree`;

CREATE DATABASE `banana_tree`;

USE `banana_tree`;

CREATE TABLE `products` (
    product_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity_available INT NOT NULL 
);

INSERT INTO `products` (`name`, `description`, `price`, `quantity_available`) VALUES 
('Banana gate', 'banana submersible', '20', '15'),
('Banana', 'just a banana.... thats it', '1.50', '10');

CREATE TABLE `users`(
    user_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(20) NOT NULL,
    password TEXT NOT NULL,
    E_mail varchar(255) NOT NULL UNIQUE,
    role ENUM('customer', 'admin') DEFAULT 'customer'
);

CREATE TABLE `orders` (
    order_id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id MEDIUMINT,
    order_date date NOT NULL,
    total_price DECIMAL(10,2) NOT NULL
);

CREATE TABLE `orderlines` (
    ID MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_id MEDIUMINT,
    product_id MEDIUMINT,
    amount INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL
);