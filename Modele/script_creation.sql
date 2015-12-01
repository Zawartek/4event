-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 01 Décembre 2015 à 14:00
-- Version du serveur: 5.5.31
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `4event`
--
CREATE DATABASE IF NOT EXISTS `4event` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `4event`;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `adresse_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `adresse_numero_voie` varchar(80) COLLATE utf8_bin NOT NULL,
  `adresse_ville` varchar(50) COLLATE utf8_bin NOT NULL,
  `adresse_code_postal` decimal(5,0) unsigned NOT NULL,
  `adresse_pays` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`adresse_id`),
  UNIQUE KEY `adresse_id` (`adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

CREATE TABLE IF NOT EXISTS `alerte` (
  `alerte_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `alerte_evenement_id` int(4) unsigned NOT NULL,
  `alerte_utilisateur_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`alerte_id`),
  UNIQUE KEY `alerte_id` (`alerte_id`),
  KEY `alerte_evenement_id` (`alerte_evenement_id`),
  KEY `alerte_utilisateur_id` (`alerte_utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `avis_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `avis_utilisateur_id` int(4) unsigned NOT NULL,
  `avis_evenement_id` int(4) unsigned NOT NULL,
  `avis_contenu` varchar(255) COLLATE utf8_bin NOT NULL,
  `avis_note` decimal(1,1) unsigned NOT NULL,
  PRIMARY KEY (`avis_id`),
  KEY `avis_utilisateur_id` (`avis_utilisateur_id`),
  KEY `avis_evenement_id` (`avis_evenement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `evenement_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `evenement_titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `evenement_utilisateur_id` int(10) unsigned NOT NULL,
  `evenement_adresse_id` int(4) unsigned NOT NULL,
  `evenement_theme_id` tinyint(1) unsigned NOT NULL,
  `evenement_date_debut` date NOT NULL,
  `evenement_heure_debut` time NOT NULL,
  `evenement_date_fin` date NOT NULL,
  `evenement_heure_fin` time NOT NULL,
  `evenement_max_participants` int(4) unsigned NOT NULL,
  `evenement_type_public` int(4) NOT NULL,
  `evenement_site_web` varchar(100) COLLATE utf8_bin NOT NULL,
  `evenement_tarif` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`evenement_id`),
  KEY `evenement_utilisateur_id` (`evenement_utilisateur_id`),
  KEY `evenement_adresse_id` (`evenement_adresse_id`),
  KEY `evenement_theme_id` (`evenement_theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faq_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `faq_question` varchar(255) COLLATE utf8_bin NOT NULL,
  `faq_reponse` varchar(255) COLLATE utf8_bin NOT NULL,
  `faq_utilisateur_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`faq_id`),
  KEY `faq_utilisateur_id` (`faq_utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `media_titre` varchar(100) COLLATE utf8_bin NOT NULL,
  `media_type` tinyint(1) unsigned NOT NULL COMMENT '0:photo 1:musique 2:video',
  `media_evenement_id` int(4) unsigned NOT NULL,
  `media_url` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`media_id`),
  UNIQUE KEY `media_id` (`media_id`),
  KEY `media_evenement_id` (`media_evenement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `message_date` date NOT NULL,
  `message_contenu` varchar(255) COLLATE utf8_bin NOT NULL,
  `message_utilisateur_id` int(4) unsigned NOT NULL,
  `message_sujet_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `message_utilisateur_id` (`message_utilisateur_id`),
  KEY `message_sujet_id` (`message_sujet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE IF NOT EXISTS `participation` (
  `participation_utilisateur_id` int(4) unsigned NOT NULL,
  `participation_evenement_id` int(4) unsigned NOT NULL,
  KEY `participation_utilisateur_id` (`participation_utilisateur_id`),
  KEY `participation_evenement_id` (`participation_evenement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `sponsor_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `sponsor_nom` varchar(40) COLLATE utf8_bin NOT NULL,
  `sponsor_description` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`sponsor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sponsorisation`
--

CREATE TABLE IF NOT EXISTS `sponsorisation` (
  `sponsorisation_evenement_id` int(4) unsigned NOT NULL,
  `sponsorisation_sponsor_id` int(4) unsigned NOT NULL,
  KEY `assoc_evenement_id` (`sponsorisation_evenement_id`),
  KEY `assoc_sponsor_id` (`sponsorisation_sponsor_id`),
  KEY `sponsorisation_evenement_id` (`sponsorisation_evenement_id`),
  KEY `sponsorisation_sponsor_id` (`sponsorisation_sponsor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `sujet_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `sujet_titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `sujet_description` varchar(200) COLLATE utf8_bin NOT NULL,
  `sujet_utilisateur_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`sujet_id`),
  KEY `sujet_utilisateur_id` (`sujet_utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `theme_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `theme_nom` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `utilisateur_nom` varchar(30) COLLATE utf8_bin NOT NULL,
  `utilisateur_prenom` varchar(25) COLLATE utf8_bin NOT NULL,
  `utilisateur_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `utilisateur_adresse_id` int(4) unsigned NOT NULL,
  `utilisateur_date_naissance` date NOT NULL,
  `utilisateur_image_profil` varchar(100) COLLATE utf8_bin NOT NULL,
  `utilisateur_etat` tinyint(1) unsigned NOT NULL COMMENT '0:actif 1:supprime 2:banni',
  `utilisateur_type` tinyint(1) unsigned NOT NULL COMMENT '0:normal 1:moderateur 2:administrateur',
  PRIMARY KEY (`utilisateur_id`),
  UNIQUE KEY `utilisateur_email` (`utilisateur_email`),
  KEY `utilisateur_adresse_id` (`utilisateur_adresse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `alerte_ibfk_4` FOREIGN KEY (`alerte_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `alerte_ibfk_3` FOREIGN KEY (`alerte_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`avis_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`avis_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`evenement_theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`evenement_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`evenement_adresse_id`) REFERENCES `adresse` (`adresse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`faq_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`media_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`message_sujet_id`) REFERENCES `sujet` (`sujet_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`message_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`participation_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`participation_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sponsorisation`
--
ALTER TABLE `sponsorisation`
  ADD CONSTRAINT `sponsorisation_ibfk_2` FOREIGN KEY (`sponsorisation_sponsor_id`) REFERENCES `sponsor` (`sponsor_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sponsorisation_ibfk_1` FOREIGN KEY (`sponsorisation_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `sujet_ibfk_2` FOREIGN KEY (`sujet_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`utilisateur_adresse_id`) REFERENCES `adresse` (`adresse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
