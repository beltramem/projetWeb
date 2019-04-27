-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 25 Avril 2019 à 13:16
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `thegame`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_game` (IN `p_id` INT, IN `p_private` TINYINT(1), IN `p_state` VARCHAR(50))  BEGIN 
	INSERT into game (id, private, state) VALUES (p_id, p_private, p_state);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_ground` (IN `p_placex` INT, IN `p_placey` INT, IN `p_map` INT)  NO SQL
BEGIN
	insert into square(placex,placey,val,map) VALUES (p_placex,p-placey,0,p_map);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_invitation` (IN `p_id` INT, IN `p_author` VARCHAR(30), IN `p_recipient` VARCHAR(30), IN `p_game` INT, IN `p_state` VARCHAR(50))  BEGIN
	INSERT INTO invitation (id,author,recipient,game,state) VALUES (p_id, p_author, p_recipient, p_game, p_state);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_player` (IN `p_pseudo` VARCHAR(30), IN `p_mail` VARCHAR(150), IN `p_mdp` VARCHAR(150))  BEGIN
	INSERT INTO player (pseudo,mail,mdp,admin,inspectate) VALUES (p_pseudo,p_mail,p_mdp,0,null);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_wall` (IN `p_placex` INT, IN `p_placey` INT, IN `p_map` INT)  NO SQL
BEGIN
	insert into square(placex,placey,val,map) VALUES (p_placex,p-placey,1,p_map);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `join_game` (IN `p_ingame` INT, IN `p_pseudo` VARCHAR(30))  BEGIN
	UPDATE player
    SET ingame = p_ingame
    where pseudo = p_pseudo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spectate_game` (IN `p_spectator` INT, IN `p_pseudo` VARCHAR(30))  BEGIN
	UPDATE player
    	SET spectator = p_spectator
    where pseudo = p_pseudo;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

CREATE TABLE `friend` (
  `friendOne` varchar(30) NOT NULL,
  `friendTwo` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `private` tinyint(1) DEFAULT NULL,
  `nbPlayer` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL,
  `game` int(11) DEFAULT NULL,
  `author` varchar(30) DEFAULT NULL,
  `recipient` varchar(30) DEFAULT NULL,
  `state` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

CREATE TABLE `map` (
  `game` int(11) NOT NULL,
  `nbx` int(11) NOT NULL,
  `nby` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

CREATE TABLE `player` (
  `pseudo` varchar(30) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `inspectate` int(11) DEFAULT NULL,
  `mdp` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `player`
--

INSERT INTO `player` (`pseudo`, `mail`, `admin`, `inspectate`, `mdp`) VALUES
('admin2', 'admin2@gmail.com', 0, NULL, '21232f297a57a5a743894a0e4a801fc3'),
('admin', 'admin@gmail.com', 0, NULL, '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure de la table `playerstat`
--

CREATE TABLE `playerstat` (
  `id` int(11) NOT NULL,
  `player` varchar(30) NOT NULL,
  `game` int(11) NOT NULL,
  `posX` int(11) NOT NULL,
  `posY` int(11) NOT NULL,
  `invisible` tinyint(1) NOT NULL,
  `boots` tinyint(1) NOT NULL,
  `shield` tinyint(1) NOT NULL,
  `superView` tinyint(1) NOT NULL,
  `incognito` tinyint(1) NOT NULL,
  `team` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `square`
--

CREATE TABLE `square` (
  `map` int(11) NOT NULL,
  `placeX` int(11) NOT NULL,
  `placeY` int(11) NOT NULL,
  `val` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`friendOne`,`friendTwo`),
  ADD KEY `friendTwo` (`friendTwo`);

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`),
  ADD KEY `recipient` (`recipient`),
  ADD KEY `game` (`game`);

--
-- Index pour la table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`game`);

--
-- Index pour la table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`pseudo`),
  ADD KEY `inspectate` (`inspectate`);

--
-- Index pour la table `playerstat`
--
ALTER TABLE `playerstat`
  ADD PRIMARY KEY (`id`,`game`),
  ADD KEY `player` (`player`),
  ADD KEY `game` (`game`);

--
-- Index pour la table `square`
--
ALTER TABLE `square`
  ADD PRIMARY KEY (`map`,`placeX`,`placeY`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
