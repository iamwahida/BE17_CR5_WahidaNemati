-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Nov 2022 um 15:02
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be17_cr5_animal_adoption_wahida`
--
CREATE DATABASE IF NOT EXISTS `be17_cr5_animal_adoption_wahida` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be17_cr5_animal_adoption_wahida`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animal`
--

CREATE TABLE `animal` (
  `animalID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `size` decimal(13,2) NOT NULL,
  `age` int(3) NOT NULL,
  `vaccinated` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `status` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `animal`
--

INSERT INTO `animal` (`animalID`, `name`, `gender`, `picture`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`) VALUES
(2, 'Hinata', 'female', 'babykatze.webp', 'Waldstraße 66', 'The cat (Felis catus) is a domestic species of small carnivorous mammal. It is the only domesticated species in the family Felidae and is commonly referred to as the domestic cat or house cat to distinguish it from the wild members of the family.', '40.00', 4, 'Yes', 'Cat', 'available'),
(3, 'Cäsar', 'male', 'babylöwe.jpg', 'Cäsarstraße 44', 'Lions have strong, compact bodies and powerful forelegs, teeth and jaws for pulling down and killing prey. Their coats are yellow-gold, and adult males have shaggy manes that range in color from blond to reddish-brown to black.', '40.00', 6, 'Yes', 'Lion', 'available'),
(4, 'Naruto', 'male', 'babytiger.webp', 'Samsastraße 33', 'Easily recognized by its coat of reddish-orange with dark stripes, the tiger is the largest wild cat in the world. The big cats tail is three feet long. On average the big cat weighs 450 pounds, about the same as eight ten-year-old kids.', '40.00', 4, 'Yes', 'Tiger', 'available'),
(5, 'Clever', 'female', 'fuchs.jpg', 'Animalstraße 45', 'Foxes are small to medium-sized, omnivorous mammals belonging to several genera of the family Canidae. They have a flattened skull, upright triangular ears, a pointed, slightly upturned snout, and a long bushy tail (or brush).', '1.30', 9, 'Yes', 'Fox', 'available'),
(6, 'Heaven', 'female', 'husky.jpg', 'Widmerstraße 11', 'The Siberian husky is a medium-sized dog, slightly longer than tall. Height ranges from 20 to 23 1/2 inches and weight from 35 to 60 pounds. The Siberian husky has erect ears and eyes of brown to blue or maybe even one of each color. The neck is carried straight and the topline is level.', '1.40', 10, 'Yes', 'Siberian Husky', 'available'),
(7, 'Carrot', 'male', 'kaninchen.webp', 'Karottenstraße 12', 'Rabbits are small, furry mammals with long ears, short fluffy tails, and strong, large hind legs. They have 2 pairs of sharp incisors (front teeth), one pair on top and one pair on the bottom. They also have 2 peg teeth behind the top incisors.', '1.30', 10, 'Yes', 'Rabbit', 'available'),
(8, 'Slowy', 'male', 'schildkröte.jpg', 'Widmerstraße 2', 'Tortoises are reptiles that have a large shell on their back for protection. Unlike other turtles, tortoises live almost exclusively on land, whilst most turtles are aquatic, meaning they live primarily in water. Most tortoises are herbivores, and they live in diverse habitats across the world.', '30.00', 12, 'Yes', 'Tortoise', 'available'),
(15, 'Simon', 'male', 'babyblackpanther.jpg', 'Inidastraße 12', 'black panther, colloquial term used to refer to large felines classified in the genus Panthera that are characterized by a coat of black fur or large concentrations of black spots set against a dark background.', '45.00', 4, '', 'Black panther', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `usersID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`usersID`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `status`) VALUES
(5, 'Naruto', 'Uzumaki', 'naruto@mail.com', 75658939, 'Narutostreet 12', '6377bbeac462e.jpg', 'e6ecc972e91c445f6c8317544fc01223fa823d79bec8f9eb9ea273cd7f084a93', 'user'),
(6, 'Hinata', 'Hyuga', 'hinata@mail.com', 2147483647, 'Hinatastreet 33', '6377bc2e8a608.png', 'e6ecc972e91c445f6c8317544fc01223fa823d79bec8f9eb9ea273cd7f084a93', 'user'),
(7, 'Wahida', 'Nemo', 'wahida@mail.com', 678474575, 'Wahidastraße 12', 'avatar.png', 'e6ecc972e91c445f6c8317544fc01223fa823d79bec8f9eb9ea273cd7f084a93', 'user'),
(11, 'Kakashi', 'Hatake', 'kakashi@mail.com', 2147483647, 'Kakashistreet 1', '6377fade1eea9.jpg', 'e6ecc972e91c445f6c8317544fc01223fa823d79bec8f9eb9ea273cd7f084a93', 'adm');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animalID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animal`
--
ALTER TABLE `animal`
  MODIFY `animalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
