-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 mai 2024 à 12:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `staffs_airways`
--

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `plane_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rental_date` date DEFAULT NULL,
  `rental_time` time NOT NULL,
  `departure_location` int(11) DEFAULT NULL,
  `arrival_location` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status_s` enum('confirmed','pending','canceled') DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `plane_id`, `customer_id`, `rental_date`, `rental_time`, `departure_location`, `arrival_location`, `total_price`, `status_s`, `notes`) VALUES
(11, 2, 3, '2024-05-02', '05:46:00', 1, 2, 3469.65, NULL, NULL),
(12, 2, 3, '2024-05-02', '05:46:00', 1, 2, 3469.65, NULL, NULL),
(13, 2, 3, '2024-05-30', '01:54:00', 1, 2, 3469.65, NULL, NULL),
(14, 1, 3, '2024-05-29', '12:14:00', 1, 12, 15046.39, NULL, NULL),
(15, 1, 3, '2024-05-29', '12:14:00', 1, 12, 15046.39, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `plane_id` (`plane_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `departure_location` (`departure_location`),
  ADD KEY `arrival_location` (`arrival_location`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`plane_id`) REFERENCES `rental_planes` (`rental_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`departure_location`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`arrival_location`) REFERENCES `locations` (`location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
