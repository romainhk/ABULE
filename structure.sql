-- phpMyAdmin SQL Dump
-- version 3.3.7deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 11 Novembre 2010 à 10:19
-- Version du serveur: 5.1.49
-- Version de PHP: 5.3.3-2

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
  `contenu` mediumtext COLLATE utf8_bin,
  PRIMARY KEY (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='les pages du site';

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`nom`, `contenu`) VALUES
('Accueil', '&lt;h1&gt;Pr&amp;eacute;sentation de l&amp;acute;Association&lt;/h1&gt;\r\n&lt;p&gt;L&amp;acute;ABULE est une association &amp;eacute;tudiante qui a pour objectif d&amp;acute;animer les d&amp;eacute;partements de Biologie, G&amp;eacute;ologie et Environnement de l&amp;acute;Universit&amp;eacute; du Littoral. Ses membres cherchent &amp;eacute;galement &amp;agrave; promouvoir des actions &amp;eacute;cologiques visant &amp;agrave; sensibiliser le public et tous les acteurs de l&amp;acute;universit&amp;eacute;.&lt;/p&gt;\r\n&lt;p&gt;Plus concr&amp;egrave;tement, l&amp;acute;ABULE c&amp;acute;est aussi plusieurs projets :&lt;/p&gt;\r\n&lt;ul&gt;&lt;li&gt;Journ&amp;eacute;e d&amp;acute;int&amp;eacute;gration, soir&amp;eacute;es &amp;agrave; th&amp;egrave;me, sorties, ...&lt;/li&gt;\r\n&lt;li&gt;Aides aux &amp;eacute;tudiants : bourse aux livres, r&amp;eacute;seau d&amp;acute;anciens &amp;eacute;tudiants, photocopies, ...&lt;/li&gt;\r\n&lt;li&gt;Conf&amp;eacute;rences / expositions / sorties sur l&amp;acute;&amp;eacute;cologie&lt;/li&gt;&lt;li&gt;Collectes, r&amp;eacute;dactions de tracts, actions de sensibilisation, projets, ... pour l&amp;acute;environnement&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&lt;a href=&quot;images/imagetest.jpg&quot; rel=&quot;lightbox&quot;&gt;&lt;img alt=&quot;imagedetest&quot; src=&quot;images/imagetest.jpg&quot; /&gt;&lt;/a&gt; Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.&lt;/p&gt;\r\n&lt;p&gt;\r\n	Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;/p&gt;\r\n&lt;p&gt;\r\n	Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.&lt;/p&gt;\r\n&lt;p&gt;\r\n	Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.&lt;/p&gt;\r\n&lt;p&gt;\r\n	At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.&lt;/p&gt;\r\n&lt;p&gt;\r\n	Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet&lt;/p&gt;\r\n'),
('test', '&lt;h1&gt;\r\nTitre de la page&lt;/h1&gt;\r\n&lt;p&gt;\r\nContenu de la page...&lt;/p&gt;\r\n');
