-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 nov. 2023 à 17:29
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `apigraphqljeux`
--

-- --------------------------------------------------------

--
-- Structure de la table `editors`
--

CREATE TABLE `editors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `editors`
--

INSERT INTO `editors` (`id`, `name`) VALUES
(1, 'Rockstar Games'),
(2, 'Take-Two Interactive'),
(3, 'Activision'),
(4, 'Electronic Arts'),
(5, 'Square Enix'),
(6, 'Ubisoft'),
(7, 'Bethesda Softworks'),
(8, 'Capcom'),
(9, 'CD Projekt'),
(10, 'Nintendo'),
(11, '2K Games'),
(12, 'Warner Bros. Interactive Entertainment'),
(13, 'Sega'),
(14, 'Bandai Namco Entertainment'),
(15, 'Konami'),
(16, 'THQ Nordic'),
(17, 'Sony Interactive Entertainment'),
(18, 'Microsoft Studios'),
(19, 'Epic Games'),
(20, 'Devolver Digital');

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `publication_date` int(11) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `name`, `publication_date`, `genre`, `platform`) VALUES
(1, 'Grand Theft Auto V', 20130917, 'Action-Adventure', 'PlayStation, Xbox, PC'),
(2, 'The Elder Scrolls V: Skyrim', 20111111, 'Action RPG', 'PlayStation, Xbox, PC'),
(3, 'Call of Duty: Modern Warfare', 20191025, 'First-Person Shooter', 'PlayStation, Xbox, PC'),
(4, 'Final Fantasy XV', 20161129, 'Action RPG', 'PlayStation, Xbox, PC'),
(5, 'Assassin\'s Creed Odyssey', 20181005, 'Action RPG', 'PlayStation, Xbox, PC'),
(6, 'Fallout 4', 20151110, 'Action RPG', 'PlayStation, Xbox, PC'),
(7, 'Resident Evil Village', 20210507, 'Survival Horror', 'PlayStation, Xbox, PC'),
(8, 'The Witcher 3: Wild Hunt', 20150519, 'Action RPG', 'PlayStation, Xbox, PC'),
(9, 'Super Mario Odyssey', 20171027, 'Platformer', 'Nintendo Switch'),
(10, 'Red Dead Redemption 2', 20181026, 'Action-Adventure', 'PlayStation, Xbox, PC'),
(11, 'BioShock Infinite', 20130326, 'First-Person Shooter', 'PlayStation, Xbox, PC'),
(12, 'The Legend of Zelda: Breath of the Wild', 20170303, 'Action-Adventure', 'Nintendo Switch'),
(13, 'Dark Souls III', 20160412, 'Action RPG', 'PlayStation, Xbox, PC'),
(14, 'God of War', 20180420, 'Action-Adventure', 'PlayStation'),
(15, 'Metal Gear Solid V: The Phantom Pain', 20150901, 'Action-Adventure', 'PlayStation, Xbox, PC'),
(16, 'The Last of Us Part II', 20200619, 'Action-Adventure', 'PlayStation'),
(17, 'Halo: Master Chief Collection', 20141111, 'First-Person Shooter', 'Xbox, PC'),
(18, 'Fortnite', 20170725, 'Battle Royale', 'PlayStation, Xbox, PC'),
(19, 'Cyberpunk 2077', 20201210, 'Action RPG', 'PlayStation, Xbox, PC'),
(20, 'Hotline Miami', 20120623, 'Top-Down Shooter', 'PlayStation, PC');

-- --------------------------------------------------------

--
-- Structure de la table `game_editors`
--

CREATE TABLE `game_editors` (
  `id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `game_editors`
--

INSERT INTO `game_editors` (`id`, `game_id`, `editor_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 5),
(5, 5, 6),
(6, 6, 4),
(7, 7, 4),
(8, 8, 9),
(9, 9, 10),
(10, 10, 1),
(11, 11, 11),
(12, 12, 12),
(13, 13, 13),
(14, 14, 14),
(15, 15, 15),
(16, 16, 16),
(17, 17, 17),
(18, 18, 18),
(19, 19, 19),
(20, 20, 20);

-- --------------------------------------------------------

--
-- Structure de la table `game_studios`
--

CREATE TABLE `game_studios` (
  `id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `studio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `game_studios`
--

INSERT INTO `game_studios` (`id`, `game_id`, `studio_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 6),
(6, 6, 7),
(7, 7, 8),
(8, 8, 9),
(9, 9, 10),
(10, 10, 2),
(11, 11, 11),
(12, 12, 12),
(13, 13, 13),
(14, 14, 14),
(15, 15, 15),
(16, 16, 16),
(17, 17, 17),
(18, 18, 18),
(19, 19, 19),
(20, 20, 20);

-- --------------------------------------------------------

--
-- Structure de la table `studios`
--

CREATE TABLE `studios` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `studios`
--

INSERT INTO `studios` (`id`, `name`) VALUES
(1, 'Rockstar North'),
(2, 'Rockstar San Diego'),
(3, 'Infinity Ward'),
(4, 'Square Enix Tokyo'),
(5, 'EA DICE'),
(6, 'Ubisoft Montreal'),
(7, 'Bethesda Game Studios'),
(8, 'Capcom Production Studio 4'),
(9, 'CD Projekt Red'),
(10, 'Nintendo EPD'),
(11, '2K Czech'),
(12, 'Monolith Productions'),
(13, 'Creative Assembly'),
(14, 'FromSoftware'),
(15, 'Kojima Productions'),
(16, 'Nordic Games'),
(17, 'Santa Monica Studio'),
(18, '343 Industries'),
(19, 'Epic Games Studios'),
(20, 'Devolver Digital Studios');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `editors`
--
ALTER TABLE `editors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `game_editors`
--
ALTER TABLE `game_editors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `editor_id` (`editor_id`);

--
-- Index pour la table `game_studios`
--
ALTER TABLE `game_studios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Index pour la table `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `game_editors`
--
ALTER TABLE `game_editors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `game_studios`
--
ALTER TABLE `game_studios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `game_editors`
--
ALTER TABLE `game_editors`
  ADD CONSTRAINT `game_editors_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `game_editors_ibfk_2` FOREIGN KEY (`editor_id`) REFERENCES `editors` (`id`);

--
-- Contraintes pour la table `game_studios`
--
ALTER TABLE `game_studios`
  ADD CONSTRAINT `game_studios_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `game_studios_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
