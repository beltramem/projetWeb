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
DROP PROCEDURE IF EXISTS `add_game`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_game` (IN `p_private` TINYINT(1), IN `p_nbPlayer` INT, IN `p_duration` INT)  BEGIN 
	INSERT into game (private,nbPlayer,duration,state) VALUES (p_private,p_nbPlayer,p_duration,"create");
    SELECT LAST_INSERT_ID();
END$$

DROP PROCEDURE IF EXISTS `add_ground`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_ground` (IN `p_placex` INT, IN `p_placey` INT, IN `p_map` INT)  NO SQL
BEGIN
	insert into square(placex,placey,val,map) VALUES (p_placex,p-placey,0,p_map);
END$$

DROP PROCEDURE IF EXISTS `add_invitation`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_invitation` (IN `p_id` INT, IN `p_author` VARCHAR(30), IN `p_recipient` VARCHAR(30), IN `p_game` INT, IN `p_state` VARCHAR(50))  BEGIN
	INSERT INTO invitation (id,author,recipient,game,state) VALUES (p_id, p_author, p_recipient, p_game, p_state);
END$$

DROP PROCEDURE IF EXISTS `add_map`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_map` (IN `p_game` INT, IN `p_nbx` INT, IN `p_nby` INT)  NO SQL
BEGIN

INSERT into map(game,nbx,nby) values (p_game,p_nbx,p_nby);
END$$

DROP PROCEDURE IF EXISTS `add_player`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_player` (IN `p_pseudo` VARCHAR(30), IN `p_mail` VARCHAR(150), IN `p_mdp` VARCHAR(150))  BEGIN
	INSERT INTO player (pseudo,mail,mdp,admin,inspectate) VALUES (p_pseudo,p_mail,p_mdp,0,null);
END$$

DROP PROCEDURE IF EXISTS `add_square`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_square` (IN `p_placex` INT, IN `p_placey` INT, IN `p_map` INT, IN `p_val` INT)  NO SQL
BEGIN
	insert into square(placex,placey,val,map) VALUES (p_placex,p_placey,p_val,p_map);
END$$

DROP PROCEDURE IF EXISTS `join_game`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `join_game` (IN `p_ingame` INT, IN `p_pseudo` VARCHAR(30))  BEGIN
	UPDATE player
    SET ingame = p_ingame
    where pseudo = p_pseudo;
END$$

DROP PROCEDURE IF EXISTS `spectate_game`$$
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

DROP TABLE IF EXISTS game;
CREATE TABLE IF NOT EXISTS game (
  id int(11) NOT NULL AUTO_INCREMENT,
  nbPlayer int(11) DEFAULT NULL,
  duration int(11) DEFAULT NULL,
  private tinyint(1) DEFAULT NULL,
  state varchar(30) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `team` ENUM('blaireau','keke','','') NULL
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
													 
INSERT INTO playerstat VALUES(1,"A",5,0,0,0,0,0,0,0,"");
INSERT INTO playerstat VALUES(2,"B",5,0,0,0,0,0,0,0,"");
INSERT INTO playerstat VALUES(3,"C",5,0,0,0,0,0,0,0,"");
