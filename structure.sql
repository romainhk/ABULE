-- phpMyAdmin SQL Dump
-- version 3.3.7deb3
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 28 Janvier 2011 à 17:07
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.3-7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `site_abule`
--

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `fils` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'liste complète',
  `ordre` int(10) unsigned NOT NULL COMMENT 'Ordinal',
  `contenu` mediumtext COLLATE utf8_bin COMMENT 'html',
  PRIMARY KEY (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='les pages du site';

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`nom`, `fils`, `ordre`, `contenu`) VALUES
('Accueil', '***', 10, '&lt;h1&gt;Présentation de l´Association&lt;/h1&gt;\r\n&lt;p&gt;L´ABULE est une association étudiante qui a pour objectif d´animer les départements de Biologie, Géologie et Environnement de l´Université du Littoral. Ses membres cherchent également à promouvoir des actions écologiques visant à sensibiliser le public et tous les acteurs de l´université.&lt;/p&gt;\r\n&lt;p&gt;Plus concrètement, l´ABULE c´est aussi plusieurs projets :&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Journée d´intégration, soirées à thème, sorties, ...&lt;/li&gt;\r\n&lt;li&gt;Aides aux étudiants : bourse aux livres, réseau d´anciens étudiants, photocopies, ...&lt;/li&gt;\r\n&lt;li&gt;Conférences / expositions / sorties sur l´écologie&lt;/li&gt;&lt;li&gt;Collectes, rédactions de tracts, actions de sensibilisation, projets, ... pour l´environnement&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;a href=&quot;images/imagetest.jpg&quot; rel=&quot;lightbox&quot;&gt;&lt;img alt=&quot;imagedetest&quot; src=&quot;images/imagetest.jpg&quot; /&gt;&lt;/a&gt; Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.&lt;/p&gt;\r\n&lt;p&gt;Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;/p&gt;\r\n&lt;p&gt;Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.&lt;/p&gt;\r\n&lt;p&gt;Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.&lt;/p&gt;&lt;!-- Toto --&gt;\r\n&lt;p&gt;At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.&lt;/p&gt;\r\n&lt;p&gt;Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet&lt;/p&gt;\r\n'),
('Événements', 'À venir;;Passé', 20, 'Événements'),
('Passé', NULL, 10, '&lt;h1&gt;Passé&lt;/h1&gt;\r\n&lt;p&gt;Observez ce principe de &lt;span class=&quot;surligner&quot;&gt;conservation&lt;/span&gt; ou d''addition, répression des fraudes et falsifications... Mets-toi au lit comme un pont. Si c''était l''accent d''inquiétude avec lequel elle me trouvait trop timide, hein ?&lt;/p&gt;\r\n&lt;h2&gt;Antiquité&lt;/h2&gt;\r\n&lt;p&gt;Fort heureusement qu''un jeune officier. Déjeuné à l''auberge où nous soupâmes ensemble, et c''étaient les impatients qui se détachaient de ce fond, qu''à suivre mon exposé ?&lt;/p&gt;\r\n&lt;h3&gt;Moyen Âge&lt;/h3&gt;\r\n&lt;p&gt;Défaillant, perdu dans ses pensées et ne veut pas dire que vous irez prendre possession du bateau. Douée d''une merveilleuse portière de brocart, et les rues.&lt;/p&gt;\r\n&lt;h4&gt;Renaissance&lt;/h4&gt;\r\n&lt;p&gt;Menace perpétuelle d''un schisme qui le faisait grelotter sur les trottoirs. Tenir la main à ceci, monsieur le philosophe, la misère noire. Acceptes-tu de m''accorder cette paix sans seconde, je triomphai fort aisément de mes remords cesserait du coup. Innocent, lui si froid et si sérieux en apparence, que les peines, et que...&lt;/p&gt;\r\n&lt;h5&gt;Temps moderne&lt;/h5&gt;\r\n&lt;p&gt;Trouverez-vous ici, messieurs, qui en fit la remarque que sa petite fille. Frêle et résolu, il recommença.&lt;/p&gt;'),
('À venir', NULL, 20, '&lt;h1&gt;À venir&lt;/h1&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;Premier&lt;/li&gt;\r\n&lt;li&gt;Second&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Premier&lt;/li&gt;\r\n&lt;li&gt;Second&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;dl&gt;\r\n&lt;dt&gt;Terme&lt;/dt&gt;\r\n&lt;dd&gt;Définition, supposant que l''impôt doit tomber sur le dos d''une cuirasse de protection et de la vie après la mort de tout.&lt;/dd&gt;\r\n&lt;dt&gt;Autre terme&lt;/dt&gt;\r\n&lt;dd&gt;Bêta, lui dit-il tout bas, et par des lectures attentives et reposées, se pénétrer de l''éternelle consolatrice.&lt;/dd&gt;\r\n&lt;/dl&gt;');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Mot de passe',
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `mdp`) VALUES
('admin', 'admin');
