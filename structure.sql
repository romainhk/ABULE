-- phpMyAdmin SQL Dump
-- version 3.3.9.2deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 01 Mars 2011 à 15:31
-- Version du serveur: 5.1.55
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='journal des modifications';

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
('Accueil', 1, 1, '&lt;h1&gt;Présentation de l´Association&lt;/h1&gt;\r\n&lt;p&gt;L´ABULE est une toute jeune association étudiante à but non lucratif qui a pour objectif d''animer les départements de Biologie, Géologie et Environnement de l''Université du Littoral.&lt;/p&gt;\r\n&lt;p&gt;&lt;a href=&quot;uploads/champion_grisblanc.gif&quot; rel=&quot;lightbox&quot;&gt;&lt;img class=&quot;img_droite&quot; src=&quot;uploads/champion_grisblanc.gif&quot;  alt=&quot;petit chat&quot; title=&quot;Oullala lal&quot; /&gt;&lt;/a&gt;Ses membres tentent également de promouvoir des actions écologiques visant à sensibiliser le public et tous les acteurs de l''Université.&lt;/p&gt;\r\n&lt;p&gt;Plus concrètement, L''ABULE c''est aussi plusieurs projets :\r\n&lt;ul&gt;\r\n  &lt;li&gt;journées d''intégration, soirée à thèmes, ...&lt;/li&gt;\r\n  &lt;li&gt;aides aux étudiants :\r\n	&lt;ul&gt;\r\n	&lt;li&gt;bourse aux livres,&lt;/li&gt;\r\n	&lt;li&gt;trousses à dissection,&lt;/li&gt;\r\n	&lt;li&gt;réseau étudiant, ...&lt;/li&gt;\r\n	&lt;/ul&gt;&lt;/li&gt;\r\n  &lt;li&gt;conférences / expositions sur l''écologie&lt;/li&gt;\r\n  &lt;li&gt;collectes, rédaction de tracts, actions de sensibilisation à l''environnement&lt;/li&gt;\r\n&lt;/ul&gt;&lt;/p&gt;'),
('Futur', 3, 25, '&lt;h1&gt;Futur&lt;/h1&gt;\r\n&lt;p&gt;Contenu de la &lt;b&gt;sous&lt;/b&gt;-page...&lt;/p&gt;'),
('Événements', 1, 20, ''),
('Passé', 2, 10, '&lt;h1&gt;Passé&lt;/h1&gt;\r\n&lt;p&gt;Observez ce principe de &lt;span class=&quot;surligner&quot;&gt;conservation&lt;/span&gt; ou d''addition, répression des fraudes et falsifications... Mets-toi au lit comme un pont. Si c''était l''accent d''inquiétude avec lequel elle me trouvait trop timide, hein ?&lt;/p&gt;\r\n&lt;h2&gt;Antiquité&lt;/h2&gt;\r\n&lt;p&gt;Fort heureusement qu''un jeune officier. Déjeuné à l''auberge où nous soupâmes ensemble, et c''étaient les impatients qui se détachaient de ce fond, qu''à suivre mon exposé ?&lt;/p&gt;\r\n&lt;h3&gt;Moyen Âge&lt;/h3&gt;\r\n&lt;p&gt;Défaillant, perdu dans ses pensées et ne veut pas dire que vous irez prendre possession du bateau. Douée d''une merveilleuse portière de brocart, et les rues.&lt;/p&gt;\r\n&lt;h4&gt;Renaissance&lt;/h4&gt;\r\n&lt;p&gt;Menace perpétuelle d''un schisme qui le faisait grelotter sur les trottoirs. Tenir la main à ceci, monsieur le philosophe, la misère noire. Acceptes-tu de m''accorder cette paix sans seconde, je triomphai fort aisément de mes remords cesserait du coup. Innocent, lui si froid et si sérieux en apparence, que les peines, et que...&lt;/p&gt;\r\n\r\n&lt;h5&gt;Temps moderne&lt;/h5&gt;\r\n&lt;p&gt;Trouverez-vous ici, messieurs, qui en fit la remarque que sa petite fille. Frêle et résolu, il recommença.&lt;/p&gt;'),
('À venir', 2, 21, '&lt;h1&gt;À venir&lt;/h1&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;Premier&lt;/li&gt;\r\n&lt;li&gt;Second&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Premier&lt;/li&gt;\r\n&lt;li&gt;Second&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;dl&gt;\r\n&lt;dt&gt;Terme&lt;/dt&gt;\r\n&lt;dd&gt;Définition, supposant que l''impôt doit tomber sur le dos d''une cuirasse de protection et de la vie après la mort de tout.&lt;/dd&gt;\r\n&lt;dt&gt;Autre terme&lt;/dt&gt;\r\n&lt;dd&gt;Bêta, lui dit-il tout bas, et par des lectures attentives et reposées, se pénétrer de l''éternelle consolatrice.&lt;/dd&gt;\r\n&lt;/dl&gt;\r\n');

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
('À venir', 'Futur');

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
('admin', 'admin');
