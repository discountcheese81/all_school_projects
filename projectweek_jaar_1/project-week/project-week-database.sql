DROP DATABASE IF EXISTS `table_time`;

CREATE DATABASE `table_time`;

USE `table_time`;

CREATE TABLE `restaurant_list` (
	id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100) NOT NULL,
    aantal_tafels int NULL,
    locatie TEXT NOT NULL,
    soort_eten text NOT NULL,
    open_tijd TIME NOT NULL,
    sluit_tijd TIME NOT NULL,
    maximale_aantal_gasten int NOT NULL,
    aantal_actieve_reserveringen int not null DEFAULT '0',
    aantal_resterende_reserveringen int not null
);


INSERT INTO `restaurant_list` (`naam`, `aantal_tafels`, `locatie`, `soort_eten`, `open_tijd`, `sluit_tijd`, `maximale_aantal_gasten`, `aantal_actieve_reserveringen`, `aantal_resterende_reserveringen`) 
VALUES ('smul express', '20', 'Amsterdam', 'Nederlands', '09:00', '21:00', '80', '0', '20');


INSERT INTO `restaurant_list` (`naam`, `aantal_tafels`, `locatie`, `soort_eten`, `open_tijd`, `sluit_tijd`, `maximale_aantal_gasten`, `aantal_actieve_reserveringen`, `aantal_resterende_reserveringen`) 
VALUES
('gewoon broodje', '15', 'Rotterdam', 'broodjes', '09:00', '21:00', '60', '0', '15'),
('Pizza Perfect', '18', 'Utrecht', 'Italiaans', '09:00', '21:00', '36', '0', '18'),
('Sushi Sensation', '8', 'Den Haag', 'Nederlands', '09:00', '21:00', '64', '0', '8'),
('Kebab Pizza Burger Allis', '2', 'Oświęcim polen', 'multicultureel', '09:00', '21:00', '6', '0', '2');

CREATE TABLE `restaurant_reservations` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naam text NOT NULL,
    telefoonnummer VARCHAR(20) NOT NULL,
    naam_restaurant text NOT NULL,
    reserveringstijd text NOT NULL,
    datum DATE NOT NULL,
    aantal_personen MEDIUMINT NOT NULL,
    speciale_verzoeken text NOT NULL
);

CREATE TABLE `users` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefoonnummer CHAR(15) NOT NULL,
    password CHAR(255) NOT NULL
);

CREATE TABLE `menu` (
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naam_restaurant VARCHAR(255) NOT NULL,
    naam_gerecht VARCHAR(255) NOT NULL,
    beschrijving TEXT,
    prijs DECIMAL(6,2) NOT NULL,
    categorie VARCHAR(100)
);

INSERT INTO `menu` (`naam_restaurant`, `naam_gerecht`, `beschrijving`,`prijs`,`categorie`)
VALUES ('smul express', 'pizza hawai', 'een pizza met tomatensaus, kaas, ham en ananas', '11.95', 'avond eten')