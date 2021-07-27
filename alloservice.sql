-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 13 juil. 2019 à 11:41
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `alloservice`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_23A0E662B36786B` (`title`),
  UNIQUE KEY `UNIQ_23A0E66989D9B62` (`slug`),
  KEY `IDX_23A0E6612469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `category_id`, `title`, `slug`, `subtitle`, `date`, `content`, `state`, `src`) VALUES
(1, 1, 'Le passage de Lorem Ipsum standard', 'le-passage-de-lorem-ipsum-standard', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor', '2019-06-29 22:02:05', '<h2>Copa america</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<h2>Coupe du monde f&eacute;minine</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<h2>CAN d\'Afrique</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;<img src=\"../../../../tinymce/js/tinymce/plugins/emoticons/img/smiley-tongue-out.gif\" alt=\"tongue-out\" /></p>\r\n<p>Source: <a title=\"Marotia Dodson\" href=\"https://marotiadodson.org\" target=\"_blank\" rel=\"noopener noreferrer\">Marotia Dodson</a></p>', 1, '4ab673a3e86d39e03cad1f9a9727d721.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_53A4EDAA5E237E06` (`name`),
  UNIQUE KEY `UNIQ_53A4EDAA989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article_category`
--

INSERT INTO `article_category` (`id`, `name`, `slug`) VALUES
(1, 'Ma maison', 'ma-maison'),
(2, 'Mon extérieur', 'mon-exterieur');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note1` smallint(6) NOT NULL,
  `note2` smallint(6) NOT NULL,
  `note3` smallint(6) NOT NULL,
  `note4` smallint(6) NOT NULL,
  `note5` smallint(6) NOT NULL,
  `noteGlobal` smallint(6) NOT NULL,
  `demande_id` int(11) NOT NULL,
  `offre_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8F91ABF080E95E18` (`demande_id`),
  UNIQUE KEY `UNIQ_8F91ABF04CC8505A` (`offre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2D5B0234989D9B62` (`slug`),
  KEY `IDX_2D5B0234F92F3E70` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `country_id`, `name`, `slug`, `cp`, `src`) VALUES
(2, 2, 'Paris', 'paris', '75000', '71c6244f326e668d9a37642139ebbeda.jpeg'),
(3, 2, 'Marseille', 'marseille', '13000', '1e7cdbde309361ad14bfc89a8577504d.jpeg'),
(4, 2, 'Lyon', 'lyon', '69000', '7449115fdafca8109322d42ece754d5b.jpeg'),
(5, 2, 'Toulouse', 'toulouse', '31000', 'c37ad4e2a74a494cfe0a2a4a6722e785.jpeg'),
(6, 2, 'Nice', 'nice', '06000', 'bbcffcf25a090b15582dcb9ff1078050.jpeg'),
(7, 2, 'Nantes', 'nantes', '44000', '4f0aac8feb4ddcd1daa55346affff03f.jpeg'),
(8, 2, 'Montpellier', 'montpellier', '34000', '5e90954d4805d32a2734e88b5ec11556.jpeg'),
(9, 2, 'Bordeaux', 'bordeaux', '33000', '405e51a2416cc1bf8a20ecde2a8bb057.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5373C96677153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `code`) VALUES
(1, 'CH'),
(2, 'FR');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `state` smallint(6) NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nbJobeur` smallint(6) NOT NULL,
  `dateJob` date NOT NULL,
  `timeJob` time NOT NULL,
  `nbHour` smallint(6) NOT NULL,
  `priceHour` decimal(10,2) NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2694D7A5ED5CA9E6` (`service_id`),
  KEY `IDX_2694D7A5A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demande_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `state` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AF86866F80E95E18` (`demande_id`),
  KEY `IDX_AF86866FA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partner`
--

DROP TABLE IF EXISTS `partner`;
CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `svg` longtext COLLATE utf8_unicode_ci,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_312B3E165E237E06` (`name`),
  UNIQUE KEY `UNIQ_312B3E16989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `partner`
--

INSERT INTO `partner` (`id`, `name`, `slug`, `src`, `svg`, `description`) VALUES
(1, 'TFI', 'tfi', NULL, '<svg aria-hidden=\"true\" aria-label=\"TF1\" class=\"d-inline-block align-middle  mx-3\" height=\"60\" role=\"img\" version=\"1.1\" viewBox=\"0 0 360 240\" width=\"90\"><defs><linearGradient id=\"linear-tf1-a\" x1=\"0%\" y1=\"100%\" y2=\"100%\"><stop offset=\"0%\" stop-color=\"#01168B\"></stop><stop offset=\"10%\" stop-color=\"#001B9C\"></stop><stop offset=\"20%\" stop-color=\"#021D9E\"></stop><stop offset=\"30%\" stop-color=\"#06198F\"></stop><stop offset=\"40%\" stop-color=\"#31127A\"></stop><stop offset=\"50%\" stop-color=\"#500B64\"></stop><stop offset=\"60%\" stop-color=\"#77054D\"></stop><stop offset=\"70%\" stop-color=\"#960234\"></stop><stop offset=\"80%\" stop-color=\"#BB0221\"></stop><stop offset=\"90%\" stop-color=\"#B00005\"></stop><stop offset=\"100%\" stop-color=\"#9A0003\"></stop></linearGradient><linearGradient id=\"linear-tf1-b\" x1=\"0%\" y1=\"1.2%\" y2=\"1.2%\"><stop offset=\"0%\" stop-color=\"#0F30B3\" stop-opacity=\".5\"></stop><stop offset=\"10%\" stop-color=\"#1C45CF\" stop-opacity=\".7\"></stop><stop offset=\"20%\" stop-color=\"#2B53D7\"></stop><stop offset=\"30%\" stop-color=\"#3757C6\"></stop><stop offset=\"40%\" stop-color=\"#665CB2\"></stop><stop offset=\"50%\" stop-color=\"#87539B\"></stop><stop offset=\"60%\" stop-color=\"#A44080\"></stop><stop offset=\"70%\" stop-color=\"#B4325E\"></stop><stop offset=\"80%\" stop-color=\"#C42038\"></stop><stop offset=\"90%\" stop-color=\"#BD1016\"></stop><stop offset=\"100%\" stop-color=\"#99060C\"></stop></linearGradient></defs><path d=\"M0 131.4V0h360v131.4H0z\" fill=\"url(#linear-tf1-a)\" transform=\"translate(0 54)\"></path><path d=\"M0 82.8V0h360v37.08s-31.96-.972-49.137-.972C213.05 36.108 95.178 55.168 0 82.8z\" fill=\"url(#linear-tf1-b)\" transform=\"translate(0 54)\"></path><path d=\"M89.28 165.96H48.96v-60.12H28.08V74.16h82.08v31.68H89.28v60.12zM159.48 165.96v-91.8h74.88V97.2H199.8v16.56h24.84v23.04H199.8v29.16h-40.32zM281.88 165.96V85.32l41.76-11.88v92.52h-41.76z\" fill=\"#FFF\"></path></svg>', 'Qlq description'),
(2, 'M6', 'm6', NULL, '<svg aria-hidden=\"true\" aria-label=\"M6\" class=\"d-inline-block align-middle  mx-3\" height=\"60\" role=\"img\" version=\"1.1\" viewBox=\"0 0 360 240\" width=\"90\"><defs><linearGradient id=\"linear-m6-a\" x1=\"50.0%\" x2=\"50.0%\" y1=\"0%\" y2=\"101.3%\"><stop offset=\"1%\" stop-color=\"#6A83A4\"></stop><stop offset=\"47%\" stop-color=\"#A4B2CB\"></stop><stop offset=\"82%\" stop-color=\"#C7D2E5\"></stop><stop offset=\"99%\" stop-color=\"#D4DEEF\"></stop></linearGradient><linearGradient id=\"linear-m6-b\" x1=\"35698%\" x2=\"35698%\" y1=\"12241%\" y2=\"892%\"><stop offset=\"1%\" stop-color=\"#6A83A4\"></stop><stop offset=\"47%\" stop-color=\"#A4B2CB\"></stop><stop offset=\"82%\" stop-color=\"#C7D2E5\"></stop><stop offset=\"99%\" stop-color=\"#D4DEEF\"></stop></linearGradient><radialGradient cx=\"27.8%\" cy=\"36.4%\" fx=\"27.8%\" fy=\"36.4%\" id=\"linear-m6-c\" r=\"70.8%\"><stop offset=\"35%\" stop-color=\"#D4DEEF\"></stop><stop offset=\"67%\" stop-color=\"#A3B1CB\"></stop><stop offset=\"100%\" stop-color=\"#6A83A4\"></stop></radialGradient><linearGradient id=\"linear-m6-d\" x1=\"97.9%\" x2=\"-59.3%\" y1=\"98.8%\" y2=\"-60.1%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-e\" x1=\"-3.0%\" x2=\"55.3%\" y1=\"-5.3%\" y2=\"57.2%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"3%\" stop-color=\"#7089A0\"></stop><stop offset=\"13%\" stop-color=\"#8EA1B6\"></stop><stop offset=\"25%\" stop-color=\"#A7B6C9\"></stop><stop offset=\"38%\" stop-color=\"#B9C6D8\"></stop><stop offset=\"52%\" stop-color=\"#C6D2E2\"></stop><stop offset=\"70%\" stop-color=\"#CDD9E9\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-f\" x1=\"-389.3%\" x2=\"122.5%\" y1=\"437.4%\" y2=\"-13.9%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"30%\" stop-color=\"#6D879E\"></stop><stop offset=\"47%\" stop-color=\"#758DA4\"></stop><stop offset=\"62%\" stop-color=\"#8398AE\"></stop><stop offset=\"75%\" stop-color=\"#96A8BC\"></stop><stop offset=\"87%\" stop-color=\"#AFBDD0\"></stop><stop offset=\"98%\" stop-color=\"#CCD8E8\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-g\" x1=\"10807%\" x2=\"32873%\" y1=\"12499.492%\" y2=\"-4749.5%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"3%\" stop-color=\"#7089A0\"></stop><stop offset=\"13%\" stop-color=\"#8EA1B6\"></stop><stop offset=\"25%\" stop-color=\"#A7B6C9\"></stop><stop offset=\"38%\" stop-color=\"#B9C6D8\"></stop><stop offset=\"52%\" stop-color=\"#C6D2E2\"></stop><stop offset=\"70%\" stop-color=\"#CDD9E9\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-h\" x1=\"171.7%\" x2=\"-75.5%\" y1=\"-34.9%\" y2=\"139.5%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"45%\" stop-color=\"#9FAFC3\"></stop><stop offset=\"81%\" stop-color=\"#C2CFDF\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-i\" x1=\"0%\" x2=\"100.0%\" y1=\"50.2%\" y2=\"50.2%\"><stop offset=\"1%\" stop-color=\"#A2C0DF\"></stop><stop offset=\"25%\" stop-color=\"#A4C1DF\"></stop><stop offset=\"39%\" stop-color=\"#ACC6E2\"></stop><stop offset=\"51%\" stop-color=\"#BACEE5\"></stop><stop offset=\"61%\" stop-color=\"#CDD9EA\"></stop><stop offset=\"63%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-j\" x1=\"-.2%\" x2=\"81.0%\" y1=\".4%\" y2=\"81.3%\"><stop offset=\"1%\" stop-color=\"#B3C9DF\"></stop><stop offset=\"28%\" stop-color=\"#B5CBE0\"></stop><stop offset=\"45%\" stop-color=\"#BDCFE3\"></stop><stop offset=\"58%\" stop-color=\"#CAD7E8\"></stop><stop offset=\"63%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-k\" x1=\"9.1%\" x2=\"87.1%\" y1=\"3.8%\" y2=\"90.3%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"11%\" stop-color=\"#768DA4\"></stop><stop offset=\"71%\" stop-color=\"#B7C4D6\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-l\" x1=\"28850%\" x2=\"22461%\" y1=\"20584.5%\" y2=\"15153.2%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"3%\" stop-color=\"#7089A0\"></stop><stop offset=\"13%\" stop-color=\"#8EA1B6\"></stop><stop offset=\"25%\" stop-color=\"#A7B6C9\"></stop><stop offset=\"38%\" stop-color=\"#B9C6D8\"></stop><stop offset=\"52%\" stop-color=\"#C6D2E2\"></stop><stop offset=\"70%\" stop-color=\"#CDD9E9\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-m\" x1=\"30444%\" x2=\"42987%\" y1=\"31501%\" y2=\"31501%\"><stop offset=\"1%\" stop-color=\"#6A859C\"></stop><stop offset=\"3%\" stop-color=\"#7089A0\"></stop><stop offset=\"13%\" stop-color=\"#8EA1B6\"></stop><stop offset=\"25%\" stop-color=\"#A7B6C9\"></stop><stop offset=\"38%\" stop-color=\"#B9C6D8\"></stop><stop offset=\"52%\" stop-color=\"#C6D2E2\"></stop><stop offset=\"70%\" stop-color=\"#CDD9E9\"></stop><stop offset=\"99%\" stop-color=\"#D0DBEB\"></stop></linearGradient><linearGradient id=\"linear-m6-n\" x1=\"97.2%\" x2=\"1.5%\" y1=\"50.0%\" y2=\"50.0%\"><stop offset=\"0%\" stop-color=\"#F19A80\"></stop><stop offset=\"15%\" stop-color=\"#EE8D71\"></stop><stop offset=\"44%\" stop-color=\"#E46C4F\"></stop><stop offset=\"83%\" stop-color=\"#D73226\"></stop><stop offset=\"100%\" stop-color=\"#D10019\"></stop></linearGradient><linearGradient id=\"linear-m6-o\" x1=\"99.2%\" x2=\"71.3%\" y1=\"11.7%\" y2=\"98.0%\"><stop offset=\"0%\" stop-color=\"#E42726\"></stop><stop offset=\"63%\" stop-color=\"#E42724\"></stop><stop offset=\"100%\" stop-color=\"#C81B1D\"></stop></linearGradient><radialGradient cx=\"2.8%\" cy=\"37.3%\" fx=\"2.8%\" fy=\"37.3%\" id=\"linear-m6-p\" r=\"95.5%\"><stop offset=\"5%\" stop-color=\"#F6B5A3\"></stop><stop offset=\"80%\" stop-color=\"#E53B1F\"></stop><stop offset=\"100%\" stop-color=\"#D1001F\"></stop></radialGradient><linearGradient id=\"linear-m6-q\" x1=\"104.4%\" x2=\"-16.1%\" y1=\"67.0%\" y2=\"29.0%\"><stop offset=\"0%\" stop-color=\"#FFF\"></stop><stop offset=\"8%\" stop-color=\"#FEF5F0\"></stop><stop offset=\"22%\" stop-color=\"#FBD9C9\"></stop><stop offset=\"41%\" stop-color=\"#F4A88C\"></stop><stop offset=\"65%\" stop-color=\"#E95D41\"></stop><stop offset=\"77%\" stop-color=\"#E42724\"></stop><stop offset=\"100%\" stop-color=\"#C81B1D\"></stop></linearGradient><linearGradient id=\"linear-m6-r\" x1=\"46348%\" x2=\"7640%\" y1=\"36090.5%\" y2=\"-8723.9%\"><stop offset=\"0%\" stop-color=\"#FFF\"></stop><stop offset=\"8%\" stop-color=\"#FEF5F0\"></stop><stop offset=\"22%\" stop-color=\"#FBD9C9\"></stop><stop offset=\"41%\" stop-color=\"#F4A88C\"></stop><stop offset=\"65%\" stop-color=\"#E95D41\"></stop><stop offset=\"77%\" stop-color=\"#E42724\"></stop><stop offset=\"100%\" stop-color=\"#C81B1D\"></stop></linearGradient><linearGradient id=\"linear-m6-s\" x1=\"-7.7%\" x2=\"591.5%\" y1=\"23.2%\" y2=\"298.1%\"><stop offset=\"0%\" stop-color=\"#E42726\"></stop><stop offset=\"77%\" stop-color=\"#E42724\"></stop><stop offset=\"100%\" stop-color=\"#C81B1D\"></stop></linearGradient><linearGradient id=\"linear-m6-t\" x1=\"29781%\" x2=\"22994%\" y1=\"16039.7%\" y2=\"11386.2%\"><stop offset=\"0%\" stop-color=\"#FFF\"></stop><stop offset=\"8%\" stop-color=\"#FEF5F0\"></stop><stop offset=\"22%\" stop-color=\"#FBD9C9\"></stop><stop offset=\"41%\" stop-color=\"#F4A88C\"></stop><stop offset=\"65%\" stop-color=\"#E95D41\"></stop><stop offset=\"77%\" stop-color=\"#E42724\"></stop><stop offset=\"100%\" stop-color=\"#C81B1D\"></stop></linearGradient></defs><path d=\"M84.193 238.85l8.258-66.448-5.472-5.782-8.87 72.23h6.085z\" fill=\"url(#linear-m6-a)\" transform=\"translate(25)\"></path><path d=\"M226.595 238.85l-8.2-66.294 5.37-5.628 8.913 71.923h-6.083z\" fill=\"url(#linear-m6-b)\" transform=\"translate(25)\"></path><path d=\"M38.862 2.11L.828 238.85H78.14l8.838-72.23 68.406 72.23 68.483-72.23 8.83 72.23h77.25L271.983 2.11l-116.6 121.47L38.864 2.11z\" fill=\"url(#linear-m6-c)\" transform=\"translate(25)\"></path><path d=\"M309.452 238.845l.995.013L272.31 1.052l-.667 2.124 37.81 235.67z\" fill=\"url(#linear-m6-d)\" transform=\"translate(25)\"></path><path d=\"M232.197 238.858h1.007l-8.97-73.34-.732 2.22 8.695 71.12z\" fill=\"url(#linear-m6-e)\" transform=\"translate(25)\"></path><path d=\"M155.384 238.126v1.45l68.118-71.84.73-2.22-68.848 72.61z\" fill=\"url(#linear-m6-f)\" transform=\"translate(25)\"></path><path d=\"M87.337 167.737l68.047 71.833v-1.444l-68.772-72.61.725 2.22z\" fill=\"url(#linear-m6-g)\" transform=\"translate(25)\"></path><path d=\"M77.647 238.845l.988.013 8.702-71.12-.725-2.22-8.965 73.327z\" fill=\"url(#linear-m6-h)\" transform=\"translate(25)\"></path><path d=\"M39.202 3.19l-.68-2.144L.308 238.85h1.027L39.202 3.19z\" fill=\"url(#linear-m6-i)\" transform=\"translate(25)\"></path><path d=\"M115.367 82.582l.686-.72-77.53-80.816.686 2.143 76.157 79.392z\" fill=\"url(#linear-m6-j)\" transform=\"translate(25)\"></path><path d=\"M155.384 124.3v-1.432l-39.33-41.005-.687.72 40.017 41.716z\" fill=\"url(#linear-m6-k)\" transform=\"translate(25)\"></path><path d=\"M192.526 85.61l-.706-.7-36.436 37.958v1.43l37.142-38.687z\" fill=\"url(#linear-m6-l)\" transform=\"translate(25)\"></path><path d=\"M191.82 84.91l.706.7 79.117-82.434.667-2.124-80.49 83.86z\" fill=\"url(#linear-m6-m)\" transform=\"translate(25)\"></path><g><path d=\"M51.53 97.187l5.486 5.634c9.92-7.988 23.044-8.046 32.496-.082l5.468-5.686c-16.576-14.393-36.052-7.75-43.45.135z\" fill=\"url(#linear-m6-n)\" transform=\"translate(107.14 3.21)\"></path><path d=\"M106.044 13.174S94.717 30.38 84.38 49.277c-4.165-.398-8.78-.68-8.76-.712C81.107 38.843 98.985 9.587 106.044.39v12.784z\" fill=\"url(#linear-m6-o)\" transform=\"translate(107.14 3.21)\"></path><path d=\"M75.022 48.905C85.656 30.642 96.88 12.533 105.125.892H56.02C32.01 34.595 9.66 74.824 3.325 102.135 1.707 108.18.887 114.41.886 120.667c0 39.703 32.45 71.834 72.417 71.834 39.965 0 72.417-32.13 72.417-71.84 0-39.04-31.49-70.83-70.698-71.755zM73.31 152.78c-17.723-.07-32.04-14.478-31.997-32.2.045-17.722 14.436-32.06 32.16-32.036 17.72.022 32.076 14.395 32.076 32.117.007 8.544-3.39 16.738-9.444 22.767-6.053 6.028-14.26 9.394-22.803 9.352h.006z\" fill=\"url(#linear-m6-p)\" transform=\"translate(107.14 3.21)\"></path><path d=\"M40.588 120.66c-.044 13.248 7.902 25.215 20.128 30.315 12.225 5.1 26.32 2.327 35.702-7.025 9.383-9.35 12.203-23.436 7.144-35.68-5.06-12.242-17-20.227-30.246-20.227-18.033 0-32.668 14.586-32.728 32.618zm.995 0c-.04-12.837 7.664-24.432 19.513-29.372 11.85-4.94 25.507-2.252 34.6 6.81 9.092 9.064 11.825 22.714 6.923 34.58-4.903 11.863-16.473 19.604-29.31 19.606-17.487.01-31.68-14.137-31.727-31.623z\" fill=\"url(#linear-m6-q)\" transform=\"translate(107.14 3.21)\"></path><path d=\"M55.893.39C34.923 29.86 9.89 72.15 2.965 102.02 1.343 108.1.52 114.366.513 120.66c0 39.883 32.728 72.328 72.912 72.328 40.184 0 72.917-32.445 72.917-72.327 0-38.643-31.49-70.857-70.357-72.217h-.924l-.782.97h.854c38.714.904 70.203 32.874 70.203 71.248 0 39.338-32.265 71.334-71.923 71.334S1.508 159.998 1.508 120.66c.003-6.213.816-12.4 2.42-18.403C9.702 77.417 29.787 38.785 56.405 1.38l-.513-.99z\" fill=\"url(#linear-m6-r)\" transform=\"translate(107.14 3.21)\"></path><path d=\"M104.31 1.386l1.868-.995H55.893l.513.996h47.904z\" fill=\"url(#linear-m6-s)\" transform=\"translate(107.14 3.21)\"></path><path d=\"M104.304 1.386c-7.67 10.91-18.398 28.017-29.596 47.27l-.436.756 1.707-.963C87.272 29.062 98.58 11.075 106.19.39l-1.886.996z\" fill=\"url(#linear-m6-t)\" transform=\"translate(107.14 3.21)\"></path></g></svg>', 'M6 description');

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text1` longtext COLLATE utf8_unicode_ci,
  `subtitle2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text2` longtext COLLATE utf8_unicode_ci,
  `subtitle3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text3` longtext COLLATE utf8_unicode_ci,
  `subtitle4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text4` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id`, `title`, `description`, `subtitle1`, `img1`, `text1`, `subtitle2`, `img2`, `text2`, `subtitle3`, `img3`, `text3`, `subtitle4`, `img4`, `text4`) VALUES
(1, '<span>Trouvez le prestataire idéal</span> <span>pour tous les services du quotidien</span>', 'Section 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'De quel service avez-vous besoin ?', 'Section 2', NULL, NULL, 'Pour chaque situation, trouvez le prestataire dont les compétences répondent à vos attentes et à votre niveau d’exigence.', NULL, NULL, '<span class=\"text-primary font-weight-medium\">-50%</span> <span class=\"text-muted\">crédit d\'impôt selon la catégorie</span>', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Nos demandes les plus populaires', 'Section 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Le service à domicile en toute sérénité', 'Section 4', 'Services assurés par AXA', '<i class=\"fa fa-shield-alt font-size-5 mr-2 text-primary\"></i>', 'Réservez sereinement, vous êtes couvert en cas d’accident, casse, dégradation et malfaçon.', 'Prix fixé à l\'avance', '<i class=\"far fa-handshake font-size-5 mr-2 text-primary\"></i>', 'Maitrisez votre budget et évitez les mauvaises surprises. Les prix sont fixés à l\'avance entre vous et votre prestataire.', 'Prestations encadrées', '<i class=\"fa fa-user-check font-size-5 mr-2 text-primary\"></i>', 'Tous les prestataires sont vérifiés, suivis et évalués pour chaque service rendu afin de vous garantir le meilleur niveau de satisfaction.', 'Assistance 7j/7', '<i class=\"fa fa-phone font-size-5 mr-2 text-primary\"></i>', 'Notre service client vous accompagne 7j/7 pour vous assurer le bon déroulement de votre demande.'),
(5, 'Spécialiste du service', 'Section 5', NULL, NULL, 'Tentez l’expérience et faites nous confiance comme plus de 135 000 clients qui aujourd’hui profitent de leur temps libre.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Comment ça marche ?', 'section6', 'Demandez un service', 'images/hiw-icon1-c2b46308c928256d1bc34d7fcb07a162a7140c3f120d810f55.svg', 'Remplissez le formulaire et obtenez une estimation du prix et de la durée', 'Choisissez votre jobeur', 'images/hiw-icon2-641d5c09d8789cb41711d0e41557929d8ee2a196bab3b2e47b.svg', 'Des jobeurs compétents et proches de chez vous vous proposent leurs services', 'Souriez, c\'est fait !', 'images/hiw-icon3-b21fb9288ea360942c1a3a595cd3d5e481725e37e615bb42e7.svg', 'Votre jobeur vous rend service au prix et à la date convenus', NULL, NULL, NULL),
(7, 'Nous sommes partout en France', 'section7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Nos clients parlent pour nous', 'section8', NULL, NULL, 'La satisfaction de nos clients est notre priorité, nous collectons les avis de tous nos utilisateurs. Vous souhaitez être convaincu que Youpijob est la bonne plateforme ? Découvrez les avis !', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Vous avez le sens du service ?', 'section9', NULL, NULL, 'Rejoignez la communauté de jobeurs, développez votre activité et augmentez vos revenus en rendant service près de chez vous.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Le service entre particuliers en toute sérénité', 'section10', 'Alloservice, numéro 1 du jobbing en France', '<i class=\"fa fa-trophy mr-2 text-primary\"></i>', 'Aujourd\'hui, avec l\'avènement de la consommation collaborative, il n\'a jamais été aussi simple de se rendre service entre particuliers. En fait, si vous avez une petite mission à déléguer, faites tout simplement appel à vos voisins plutôt qu\'à une grande enseigne spécialisée : bricolage, ménage, jardinage ou même déménagement, de nombreux particuliers ont du temps à revendre et toutes les compétences nécessaires pour venir à bout de votre corvée en un temps record et de manière efficace et professionnelle.Alors, pour tous vos petits traquas du quotidien, faites confiance au jobbing. Non seulement vous pourrez donner à un particulier le complément de revenu qu\'il mérite, mais vous pourrez aussi aider une micro-entreprise qui débute à développer sa notoriété. Et pour cela, rien de plus simple, choisissez la catégorie dans laquelle poster votre besoin et  faites confiance à votre jobeur pour tout le reste, il réalisera votre mission en toute confiance et en toute sécurité !', 'Des profils évalués aux compétences diversifiées', '<i class=\"fa fa-user-check mr-2 text-primary\"></i>', 'Étudiants, retraités, entrepreneurs, employés ou sans emploi, les jobeurs de Alloservice ont des profils très variés et font chacun preuve de compétences et d\'expériences diverses. Ainsi, certains jobeurs sont - ou ont été - plombiers, électriciens, menuisiers ou encore informaticiens, certains sont des autodidactes passionnés, d\'autres encore des professionnels qui ont déjà créé leur micro-entreprise. Mais, dans tous les cas, tous les jobeurs sont des travailleurs compétents disponibles, serviables, organisés et surtout fiables. Alors, pour vous garantir sécurité et confiance, le sérieux et le professionnalisme de chaque jobeur est validé par la communauté Alloservice. Pour cela, notre équipe de modération vérifie avec soin l’identité de tous les jobeurs. Ensuite, toutes les prestations sont commentées et évaluées : une fois votre chaque jobeur. Ainsi, vous avez toutes les cartes en main pour choisir le jobeur le plus professionnel et le plus compétent pour réaliser votre mission.', 'Confiez tous vos besoins en quelques minutes', '<i class=\"fa fa-stopwatch mr-2 text-primary\"></i>', 'Entre le ménage, le travail, les travaux et les enfants, vous avez l\'impression que même le weekend ne vous laisse pas une minute de répit ? Déléguez simplement toutes les petites corvées qui vous encombrent et retrouvez un peu de temps pour vous grâce au jobbing. En vous rapprochant de nombreux particuliers travaillant sur leur temps libre et de micro-entrepreneurs qui veulent développer leur activité, Alloservice vous permet de faire appel à un professionnel en quelques clics et vous facilite la vie. Alors oubliez les heures passées à repasser, à tondre la pelouse ou à monter vos meubles IKEA : confiez toutes vos corvées à un jobeur et recentrez-vous sur l\'essentiel, votre santé comme votre moral y gagneront.', NULL, NULL, NULL),
(11, 'Services à domicile', 'section11', 'Services à domicile : un choix gagnant-gagnant', NULL, 'A l’ère de la consommation collaborative, de nombreuses personnes souhaitent partager leur expérience et leur savoir-faire, en complément de leur travail ou comme activité principale ; il serait dommage de ne pas en profiter ! Avec les services d’aide à domicile, vous accédez à des prestations de :\nServices à la famille : garde d’enfants, garde d’animaux, promenade de chien, etc.\nServices liés aux tâches quotidiennes : ménage, bricolage, déménagement, conciergerie, informatique et jardinage.\nLa notion de « service à la personne » apparaît pour la première fois à la fin de la seconde guerre mondiale. Avec l’augmentation des naissances, l’allongement du temps de travail ou encore le vieillissement des populations, la prise en charge – par des tiers – de besoins autrefois remplis par les proches apparaît en tant que nouveau secteur de services.\nLes familles ont de plus en plus besoin d’aide pour assurer l’exécution des services de ménage ou nettoyage à domicile, de garde d’enfants, de soutien scolaire, de bricolage, ainsi que bien d’autres tâches, car elles sont déjà très occupées à remplir leurs obligations professionnelles.', 'Fonctionnement du service à domicile', NULL, 'Jusqu’à présent, lorsque vous aviez une tâche à effectuer à domicile, vous étiez obligé de faire appel à votre entourage ou des professionnels, voire de l’exécuter vous-même malgré le manque de temps ou d’expérience. Aujourd’hui, la digitalisation du marché du service d’aide à la personne apporte des solutions concrètes à ces nombreuses problématiques.\nLe service d’aide à domicile a longtemps fonctionné suivant le système du gré à gré ou emploi direct. Généralement, le particulier employeur est alors chargé de toutes les obligations administratives et légales, il paye directement son employé en main propre ; ce qui n’est pas toujours des plus confortables. Désormais, avec Alloservice, vous sélectionnez et vous payez votre jobeur en un clic !\nLes plateformes de services à la personne facilitent grandement la recherche de prestataires quels que soient vos besoins. En effet, fini le temps passé à poster vos petites annonces chez le boulanger et autres commerçants ou dépendre des publicités des professionnels ! Sur Alloservice, vous avez accès à une multitude de profils compétents par type de services en un seul endroit. De plus, grâce aux avis clients, vous avez ainsi plus de facilité à vous faire une idée sur leurs compétences et à choisir – en peu de temps – plusieurs profils.', 'Simplifiez-vous la vie avec Alloservice', NULL, 'Spécialistes du service à domicile\nDe nos jours, entre le travail, les enfants, les activités et les dépenses du quotidien, il devient difficile de trouver rapidement une aide à proximité fiable et peu cher. Sur Alloservice, des profils compétents et vérifiés sont à votre disposition pour vous permettre de profiter de vos week-ends et de votre temps libre. Les jobeurs sont des étudiants, des retraités, des auto-entrepreneurs ou tous autres particuliers qui ont du temps et des aptitudes à revendre, à moindre coût.\nAlloservice est ainsi LA référence en matière de services entre particuliers. Que vous recherchiez un service à domicile pour du bricolage, du ménage, de la conciergerie, de l’informatique, du jardinage, de la garde d’enfants ou d’animaux, de l’aide au déménagement ou autres, les jobeurs se chargent de tout.\nDéléguez vos tâches quotidiennes à nos jobeurs et profitez-en pour vaquer à vos occupations favorites.\nDes profils vérifiés et des prestations couvertes par notre assurance\nAu moment de l’inscription, notre équipe de recruteurs vérifie la conformité entre la carte d’identité, les données personnelles et la photo de chaque nouvel inscrit. Par ailleurs, après chaque prestation, les clients notent et commentent le travail effectué par chaque jobeur. Ces évaluations sont authentifiées par une société tierce afin de garantir la transparence des avis. De plus, nous offrons un service couvert par notre assurance. Chez Alloservice, sécurité et fiabilité des partenaires sont primordiales.\nAlloservice, un outil simple et efficace\nNos outils et services sont pensés pour vous permettre de gagner un maximum de temps. Lorsque vous réalisez une demande, vous voulez être sûr que la tâche sera vite et bien faite ! Sur Alloservice, vous bénéficiez grâce à une plateforme de service à la personne agréée, d\'un service clé en main vous permettant de maitriser votre budget.\nSi vous cherchez des prestations de services a domicile de qualité et à des prix compétitifs, Alloservice est la plateforme de mise en relation entre particuliers qu’il vous faut. Gagnez du temps et réalisez des économies en faisant appel à nos prestataires de services compétents et fiables.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sup_service_id` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_job` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `our_jobers` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_service_pub` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_blog` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `button_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `button_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `button_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E19D9AD2989D9B62` (`slug`),
  KEY `IDX_E19D9AD2ED5CA9E6` (`service_id`),
  KEY `IDX_E19D9AD221B44948` (`sup_service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `service_id`, `title`, `description`, `slug`, `src`, `sup_service_id`, `meta_title`, `service_type`, `other_job`, `our_jobers`, `last_service_pub`, `job_city`, `job_blog`, `button_1`, `button_2`, `button_3`) VALUES
(1, NULL, 'Bricolage', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'bricolage', '9a37261ce3ea6524a872fc7c70dbee1b.jpeg', NULL, 'Service de bricolage', 'De quel service de bricolage avez-vous besoin ?', 'Autre job de bricolage', 'Nos bricoleurs sont à votre service', 'Dernières annonces de bricolage', 'Le bricolage près de chez vous', 'Le blog du bricolage', 'Demander un service de bricolage à domicile', 'Voir toutes les annonces de bricolage', 'Voir tous les bricoleurs'),
(2, NULL, 'Jardinage', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'jardinage', '11c80b42d558b109cf0b466400b8ba36.jpeg', NULL, 'Service de jardinage', 'De quel service de jardinage avez-vous besoin ?', 'Autre job de jardinage', 'Nos jardiniers sont à votre service', 'Dernières annonces de jardinage', 'Le jardinage près de chez vous', 'Le blog de jardinage', 'Demander un service de jardinage à domicile', 'Voir toutes les annonces de jardinage', 'Voir tous les jardiniers'),
(3, NULL, 'Déménagement', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'demenagement', '3ac0b15b15ca4e7d0fb5798b0c2e4b20.jpeg', NULL, 'Service de déménagement', 'De quel service de déménagement avez-vous besoin ?', 'Autre job de déménagement', 'Nos déménagères sont à votre service', 'Dernières annonces de déménagement', 'Le déménagement près de chez vous', 'Le blog de déménagement', 'Demander un service de déménagement à domicile', 'Voir toutes les annonces de déménagement', 'Voir tous les déménagères'),
(4, NULL, 'Ménage', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'menage', '3a0640b360bcb8c8e3d281ee5cce9c63.jpeg', NULL, 'Service de ménage', 'De quel service de ménage avez-vous besoin ?', 'Autre job de ménage', 'Nos ménagères sont à votre service', 'Dernières annonces de ménage', 'Le ménage près de chez vous', 'Le blog de ménage', 'Demander un service de ménage à domicile', 'Voir toutes les annonces de ménage', 'Voir tous les ménagères'),
(5, 1, 'Electricité', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'electricite', 'c37e05380e1b8ec8a315d5b3c3f85eef.jpeg', NULL, 'Service d\'électricité', 'De quel service d\'électricité avez-vous besoin ?', 'Autre job d\'électricité', 'Nos électriciens sont à votre service', 'Dernières annonces d\'électricité', 'L\'électricité près de chez vous', 'Le blog d\'électricité', 'Demander un service d\'électricité à domicile', 'Voir toutes les annonces d\'électricité', 'Voir tous les électriciens'),
(6, 1, 'Aménagement', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'amenagement', '5df3734184a27627328bbfc6ae757846.jpeg', NULL, 'Service d\'aménagement', 'De quel service d\'aménagement avez-vous besoin ?', 'Autre job d\'aménagement', 'Nos aménage... sont à votre service', 'Dernières annonces d\'aménagement', 'L\'aménagement près de chez vous', 'Le blog d\'aménagement', 'Demander un service d\'aménagement à domicile', 'Voir toutes les annonces d\'aménagement', 'Voir tous les aménage...'),
(7, NULL, 'Installation électrique', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'installation-electrique', 'd70e747cd7788ed636ccf1b3c6a95aac.jpeg', 5, 'Service d\'installation électrique', 'De quel service d\'installation électrique avez-vous besoin ?', 'Autre job d\'installation électrique', 'Nos install... sont à votre service', 'Dernières annonces d\'installation électrique', 'L\'installation électrique près de chez vous', 'Le blog d\'installation électrique', 'Demander un service d\'installation électrique à domicile', 'Voir toutes les annonces d\'instalation électrique', 'Voir tous les installa...'),
(8, NULL, 'Repassage', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'repassage', '82c2b1cfc17d41746ca8fe56489f719c.jpeg', 4, 'Service de repassage', 'De quel service de repassage avez-vous besoin ?', 'Autre job de repassage', 'Nos repassa... sont à votre service', 'Dernières annonces de repassage', 'Le repassage près de chez vous', 'Le blog de repassage', 'Demander un service de repassage à domicile', 'Voir toutes les annonces de repassage', 'Voir tous les repass...');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `actived` tinyint(1) NOT NULL,
  `tokenExpiredDate` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registrationDate` datetime DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  KEY `IDX_8D93D6498BAC62AF` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `name`, `username`, `email`, `genre`, `password`, `token`, `actived`, `tokenExpiredDate`, `roles`, `salt`, `registrationDate`, `city_id`) VALUES
(1, 'Rasoa', 'Kininika', 'rasoa', 'kininika@domain.com', 'Madame', '$2y$13$6Mt2zEK3lUC2bNtRJOJ0XuuasasPxJgAoQVz5OJ9nIfCz1CUobrsW', NULL, 1, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', '83d72adb09b8e73f9020069e7f820d1b42df0d4a', '2019-06-28 15:47:13', NULL),
(2, 'Antonio', 'Rabemanantsaina', 'antonio', 'antonio@domain.com', NULL, '$2y$13$Rlg2SWTrmgT4su8gYetUverM4fTN5I5mmAAdV6QUNML03cT4cZMcu', NULL, 0, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'ecb1ef105f937d18635f3715a533b91e02dce757', '2019-06-28 15:54:09', NULL),
(3, 'Antonio', 'Rabemanantsaina', 'rabemantonio', 'antonio@yahoo.com', NULL, '$2y$13$x791tOd6VylXWLtyEPMk6.gzCSiGCBF.fKiaobXqbiBtDL3lewkiu', NULL, 1, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '49f2a3c4b6bf9f3511c6c21a643038541548ca2c', '2019-06-28 18:38:28', NULL),
(4, 'Dodson', 'Marotia', 'marotia-dodson', 'marotia29@yahoo.com', 'Monsieur', '$2y$13$ZP20OLsAdA7SbHS8qAsgWewCNAjNvLjEPtjmPw9xDBOy9/exVs5cu', NULL, 1, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '4e4406c385b6970cd909f8a3d24d783619de0400', '2019-07-04 21:36:57', NULL),
(5, 'Modeste', 'Ratsitohaina', 'ratsitohaina-modeste', 'modeste@yahoo.com', NULL, '$2y$13$BBJkkMA2ws2AQPR3OwgqbuJ35MYC2QRJCBhSY.EP38AA8zkFS164W', NULL, 0, NULL, 'a:1:{i:0;s:11:\"ROLE_JOBEUR\";}', '5089663ef14ed3833a909004fe868bc72e8a8e30', '2019-07-04 22:28:01', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6612469DE2` FOREIGN KEY (`category_id`) REFERENCES `article_category` (`id`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF04CC8505A` FOREIGN KEY (`offre_id`) REFERENCES `offre` (`id`),
  ADD CONSTRAINT `FK_8F91ABF080E95E18` FOREIGN KEY (`demande_id`) REFERENCES `demande` (`id`);

--
-- Contraintes pour la table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `FK_2D5B0234F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `FK_2694D7A5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2694D7A5ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `FK_AF86866F80E95E18` FOREIGN KEY (`demande_id`) REFERENCES `demande` (`id`),
  ADD CONSTRAINT `FK_AF86866FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_E19D9AD221B44948` FOREIGN KEY (`sup_service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `FK_E19D9AD2ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6498BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
