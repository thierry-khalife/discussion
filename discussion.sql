-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 01 déc. 2019 à 09:59
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `discussion`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(140) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `id_topic` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_utilisateur`, `date`, `id_topic`) VALUES
(37, 'kcnsmleknflm', 2, '2019-11-28 16:00:01', 2),
(11, 'Salut test1', 1, '2019-11-28 11:06:25', NULL),
(12, 'Salut test1', 1, '2019-11-28 11:06:27', NULL),
(13, 'Salut test1', 1, '2019-11-28 11:06:34', NULL),
(14, 'Salut test2', 1, '2019-11-28 11:06:50', NULL),
(15, 'Salut test3', 1, '2019-11-28 11:16:20', 0),
(16, 'Salut test4', 1, '2019-11-28 11:34:59', 0),
(17, 'lmferkjerg', 1, '2019-11-28 11:50:24', 0),
(18, 'sqd qsd qsd qsd qsd qsd ', 1, '2019-11-28 12:03:58', 5),
(19, 'ffucfcu uff  ufuf ', 1, '2019-11-28 12:05:39', 0),
(27, 'lkchsndkcbn', 1, '2019-11-28 12:23:50', 5),
(28, 'salutddddd', 1, '2019-11-28 12:24:27', 5),
(29, 'Test100000', 1, '2019-11-28 12:25:31', 5),
(33, 'dllfjkpoezj', 1, '2019-11-28 15:30:49', 1),
(35, 'Salut Ã  tous', 1, '2019-11-28 15:48:00', 2),
(41, 'Salut je test un peu', 1, '2019-11-29 11:38:36', 4),
(38, 'Salut012345678910', 1, '2019-11-29 09:26:36', 3),
(44, 'Salut', 2, '2019-12-01 10:40:26', 3),
(43, 'lkcnzesdk:cnsmevknmeksvn', 1, '2019-11-29 12:01:08', 4);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomtopic` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `datecreation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `nomtopic`, `id_utilisateur`, `datecreation`) VALUES
(1, 'Test de fou', 1, '2019-11-28 15:30:42'),
(2, 'efjsmef', 1, '2019-11-28 15:31:12'),
(3, 'Salut je test', 2, '2019-11-28 15:58:58'),
(4, 'salut Ã  tous', 1, '2019-11-29 09:32:16');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$12$yVx17MTPkbi4QCNmmw9J/esjkw4TY32kng684FTfDaODlN1iqaGfe'),
(2, 'deku', '$2y$12$81C6tKxCojVYsQQZsNk.8ea8WRE7R0SOfNWXs2udwc/efTiCON2te');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id`, `id_message`, `id_utilisateur`, `valeur`) VALUES
(92, 33, 1, -1),
(94, 35, 1, 1),
(104, 35, 2, 1),
(107, 33, 2, -1),
(105, 37, 2, -1),
(139, 41, 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
