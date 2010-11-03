-- phpMyAdmin SQL Dump
-- version 3.3.7deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 03 Novembre 2010 à 16:05
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
-- TYPES MIME POUR LA TABLE `page`:
--   `contenu`
--       `text_plain`
--   `nom`
--       `text_plain`
--

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`nom`, `contenu`) VALUES
('index', '&lt;h1&gt;Présentation de l´Association&lt;/h1&gt;\r\n&lt;p&gt;L´ABULE est une association étudiante qui a pour objectif d´animer les départements de Biologie, Géologie et Environnement de l´Université du Littoral. Ses membres cherchent également à promouvoir des actions écologiques visant à sensibiliser le public et tous les acteurs de l´université.&lt;/p&gt;\r\n\r\n&lt;p&gt;Plus concrètement, l´ABULE c´est aussi plusieurs projets :&lt;/p&gt;\r\n&lt;ul&gt;\r\n  &lt;li&gt;Journée d´intégration, soirées à thème, sorties, ...&lt;/li&gt;\r\n  &lt;li&gt;Aides aux étudiants : bourse aux livres, réseau d´anciens étudiants, photocopies, ...&lt;/li&gt;\r\n  &lt;li&gt;Conférences / expositions / sorties sur l´écologie&lt;/li&gt;\r\n  &lt;li&gt;Collectes, rédactions de tracts, actions de sensibilisation, projets, ... pour l´environnement&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;\r\n\r\n&lt;a href=&quot;images/imagetest.jpg&quot; rel=&quot;lightbox&quot;&gt;&lt;img src=&quot;images/imagetest.jpg&quot; alt=&quot;imagedetest&quot; /&gt;&lt;/a&gt;\r\nLorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n&lt;p&gt;Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.&lt;/p&gt;\r\n&lt;p&gt;Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;/p&gt;\r\n&lt;p&gt;Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.&lt;/p&gt;\r\n&lt;p&gt;Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.&lt;/p&gt;\r\n&lt;p&gt;At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.&lt;/p&gt;\r\n&lt;p&gt;Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.&lt;/p&gt;'),
('Admin', '&lt;h1&gt;Formulaires Admin&lt;/h1&gt;\r\n&lt;form method=&quot;post&quot; action=&quot;ajout_page.php&quot;&gt;\r\n&lt;fieldset&gt;\r\n&lt;legend&gt;Ajouter une page&lt;/legend&gt;\r\n&lt;table&gt;\r\n&lt;tr&gt;\r\n    &lt;td&gt;&lt;label for=&quot;nom&quot;&gt;Nom de la page :&lt;/label&gt;&lt;/td&gt;\r\n    &lt;td&gt;&lt;input type=&quot;text&quot; name=&quot;nom&quot; size=&quot;25&quot; /&gt;&lt;/td&gt;\r\n&lt;tr/&gt;&lt;tr&gt;\r\n    &lt;td&gt;&lt;label for=&quot;contenu&quot;&gt;Contenu html :&lt;/label&gt;&lt;/td&gt;\r\n    &lt;td&gt;&lt;textarea name=&quot;contenu&quot; rows=&quot;8&quot; cols=&quot;65&quot;&gt;Contenu html de la page&lt;/textarea&gt;&lt;/td&gt;\r\n&lt;tr/&gt;&lt;tr&gt;\r\n    &lt;td colspan=&quot;2&quot; style=&quot;text-align:right;&quot;&gt;\r\n    &lt;input type=&quot;submit&quot; value=&quot;Ajouter&quot; accesskey=&quot;g&quot; /&gt;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/table&gt;\r\n&lt;/fieldset&gt;\r\n&lt;/form&gt;');
