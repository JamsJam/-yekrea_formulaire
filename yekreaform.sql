-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 sep. 2022 à 19:40
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yekreaform`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `societe` varchar(100) NOT NULL,
  `telephone` int NOT NULL,
  `e-mail` varchar(45) NOT NULL,
  `presence_web` varchar(100) NOT NULL,
  `fk_user_id` int NOT NULL,
  PRIMARY KEY (`client_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client_service`
--

DROP TABLE IF EXISTS `client_service`;
CREATE TABLE IF NOT EXISTS `client_service` (
  `client_service_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `service_id` int NOT NULL,
  PRIMARY KEY (`client_service_id`),
  KEY `client_id` (`client_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande_log`
--

DROP TABLE IF EXISTS `commande_log`;
CREATE TABLE IF NOT EXISTS `commande_log` (
  `commande_id` int NOT NULL AUTO_INCREMENT,
  `fk_client_id` int NOT NULL,
  `fk_video_id` int DEFAULT NULL,
  `fk_site_id` int DEFAULT NULL,
  `fk_photo_id` int DEFAULT NULL,
  `fk_print_id` int DEFAULT NULL,
  PRIMARY KEY (`commande_id`),
  KEY `fk_client_id` (`fk_client_id`),
  KEY `fk_video_id` (`fk_video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `nom_service` int NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `password` varchar(45) NOT NULL,
  `role` int NOT NULL,
  `e-mail` varchar(45) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `video_id` int NOT NULL AUTO_INCREMENT,
  `presentation` varchar(150) NOT NULL,
  `type_video` int NOT NULL,
  `date` date NOT NULL,
  `durée` int NOT NULL,
  `occasion` varchar(45) NOT NULL,
  `longueur_video` varchar(45) NOT NULL,
  `figurant` int NOT NULL,
  `MKU_artiste` tinyint(1) NOT NULL,
  `complement` varchar(500) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `client_service`
--
ALTER TABLE `client_service`
  ADD CONSTRAINT `client_service_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `client_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `commande_log`
--
ALTER TABLE `commande_log`
  ADD CONSTRAINT `commande_log_ibfk_1` FOREIGN KEY (`fk_client_id`) REFERENCES `client` (`client_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commande_log_ibfk_2` FOREIGN KEY (`fk_video_id`) REFERENCES `video` (`video_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
