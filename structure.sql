-- phpMyAdmin SQL Dump
-- version 3.3.9.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 11 Mars 2011 à 11:06
-- Version du serveur: 5.1.56
-- Version de PHP: 5.3.5-1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `labulefr_site`
--

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'who',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='journal des modifications' AUTO_INCREMENT=1 ;

--
-- Contenu de la table `log`
--


-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `niveau` tinyint(1) unsigned NOT NULL COMMENT 'de titre',
  `ordre` tinyint(1) unsigned NOT NULL COMMENT 'Ordinal',
  `contenu` mediumtext COLLATE utf8_bin COMMENT 'html',
  PRIMARY KEY (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='les pages du site';

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`nom`, `niveau`, `ordre`, `contenu`) VALUES
('Accueil', 1, 11, '&lt;h1&gt;Présentation de l´Association&lt;/h1&gt;\r\n&lt;p&gt;L´ABULE est une toute jeune association étudiante à but non lucratif qui a pour objectif d''animer les départements de Biologie, Géologie et Environnement de l''Université du Littoral.&lt;/p&gt;\r\n&lt;br /&gt;\r\n&lt;p&gt;Ses membres tentent également de promouvoir des actions écologiques visant à sensibiliser le public et tous les acteurs de l''Université.&lt;/p&gt;\r\n&lt;br /&gt;\r\n&lt;p&gt;Plus concrètement, L''ABULE c''est aussi plusieurs projets :\r\n&lt;ul&gt;\r\n  &lt;li&gt;journées d''intégration, soirée à thèmes, ...&lt;/li&gt;\r\n  &lt;li&gt;aides aux étudiants :\r\n	&lt;ul&gt;\r\n	&lt;li&gt;bourse aux livres,&lt;/li&gt;\r\n	&lt;li&gt;trousses à dissection,&lt;/li&gt;\r\n	&lt;li&gt;réseau étudiant, ...&lt;/li&gt;\r\n	&lt;/ul&gt;&lt;/li&gt;\r\n  &lt;li&gt;conférences / expositions sur l''écologie&lt;/li&gt;\r\n  &lt;li&gt;collectes, rédaction de tracts, actions de sensibilisation à l''environnement&lt;/li&gt;\r\n&lt;/ul&gt;&lt;/p&gt;'),
('En cours', 2, 20, '&lt;h1&gt;En cours&lt;/h1&gt;\r\n&lt;h2&gt;En construction&lt;/h2&gt;'),
('Nos Services', 1, 33, '&lt;h1&gt;Nos Services&lt;/h1&gt;'),
('Bourse aux livres', 2, 10, '&lt;h1&gt;Bourse aux livres&lt;/h1&gt;\r\n&lt;h2&gt;En construction&lt;/h2&gt;'),
('Trousse à dissection', 2, 20, '&lt;h1&gt;Trousse à dissection&lt;/h1&gt;\r\n&lt;h2&gt;En construction&lt;/h2&gt;'),
('Événements', 1, 22, '&lt;h1&gt;Événements&lt;/h1&gt;'),
('Passé', 2, 10, '&lt;h1&gt;Passé&lt;/h1&gt;\r\n&lt;h2&gt;En construction&lt;/h2&gt;'),
('À venir', 2, 30, '&lt;h1&gt;À venir&lt;/h1&gt;\r\n&lt;h2&gt;En construction&lt;/h2&gt;');

-- --------------------------------------------------------

--
-- Structure de la table `parente`
--

CREATE TABLE IF NOT EXISTS `parente` (
  `page` varchar(50) COLLATE utf8_bin NOT NULL,
  `fils` varchar(50) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `fils` (`fils`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Pour le menu';

--
-- Contenu de la table `parente`
--

INSERT INTO `parente` (`page`, `fils`) VALUES
('Événements', 'Passé'),
('Événements', 'À venir'),
('Événements', 'En cours'),
('Nos Services', 'Bourse aux livres'),
('Nos Services', 'Trousse à dissection');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Mot de passe',
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Administrateurs';

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `mdp`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');
