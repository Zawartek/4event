-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 17 Janvier 2016 à 22:31
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `4event`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`adresse_id`, `adresse_numero_voie`, `adresse_ville`, `adresse_code_postal`, `adresse_pays`) VALUES
(1, '10 rue de Vanves', 'Issy-les-Moulineaux', '92130', 'France'),
(2, '51bis rue du Général Leclerc', 'Issy-les-Moulineaux', '92130', 'France'),
(3, '10 rue de Vanves', 'Issy-les-Moulineaux', '92130', 'France');

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
  `avis_contenu` varchar(1024) COLLATE utf8_bin NOT NULL,
  `avis_note` decimal(1,0) unsigned NOT NULL,
  PRIMARY KEY (`avis_id`),
  KEY `avis_utilisateur_id` (`avis_utilisateur_id`),
  KEY `avis_evenement_id` (`avis_evenement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`avis_id`, `avis_utilisateur_id`, `avis_evenement_id`, `avis_contenu`, `avis_note`) VALUES
(1, 2, 1, 'Venez ça va être super :)', '5');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `evenement_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `evenement_titre` varchar(50) COLLATE utf8_bin NOT NULL,
  `evenement_description` varchar(4096) COLLATE utf8_bin NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`evenement_id`, `evenement_titre`, `evenement_description`, `evenement_utilisateur_id`, `evenement_adresse_id`, `evenement_theme_id`, `evenement_date_debut`, `evenement_heure_debut`, `evenement_date_fin`, `evenement_heure_fin`, `evenement_max_participants`, `evenement_type_public`, `evenement_site_web`, `evenement_tarif`) VALUES
(1, 'Présentation Client', 'On présente le projet.', 1, 3, 5, '2016-01-19', '16:00:00', '2016-01-19', '17:30:00', 10, 1, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faq_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `faq_question` varchar(500) COLLATE utf8_bin NOT NULL,
  `faq_reponse` varchar(1000) COLLATE utf8_bin NOT NULL,
  `faq_utilisateur_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`faq_id`),
  KEY `faq_utilisateur_id` (`faq_utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `faq`
--

INSERT INTO `faq` (`faq_id`, `faq_question`, `faq_reponse`, `faq_utilisateur_id`) VALUES
(0, 'Il s''agit du texte présent avec la première Question.\r\nPour le changer modifier la réponse ci-dessous.', 'Vous avez une question ? Vous avez besoin d’aide ? Pas de panique à chaque question une réponse !\r\n4event vous répond, ci-dessous quelques réponses apportées aux questions les plus récurrentes.', 1),
(1, 'Pourquoi je ne peux pas participer, ni commenter, ni noter un événement ?', 'Avant de pouvoir commenter, noter ou de participer à un événement il faut préalablement vous inscrire ! Pour se faire cliquer sur le bouton « Inscription » en haut à droite de votre écran. Puis compléter tous les champs requis. Une fois l’inscription effective, connectez-vous et vous aurez accès à toutes les fonctionnalités du site.', 1),
(2, 'À l’aide ! comment se connecte-t-on ?', 'Pour se connecter il vous suffit de cliquer sur le bouton « Connexion » en haut à droite de votre écran. Si cela ne fonctionne pas, vérifiez que vous êtes bien inscrit sur 4event, sinon rendez-vous à la page inscription ! (Bouton « inscription » à côté du bouton « Connexion »), Lors de la connexion vérifiez bien que votre mot de passe et votre login sont corrects. ', 1),
(3, 'Je souhaite m’inscrire à un événement payant, comment faire ?', '4event étant un site de partage d’événements nous ne gérons pas la billetterie.  Dans la description de l’événement un lien vers la billetterie officielle vous sera indiqué, vous pourrez alors acheter vos places en toute quiétude. Votre participation à un événement payant se fera donc sous réserve de places disponibles sur le site de la billetterie. 4event ne pourra être tenu responsable si malgré l’indication votre participation sur 4event aucun billet n’est disponible à l’achat.', 1),
(4, 'Ma situation a évolué depuis mon inscription sur le site, comment faire ?', 'Toutes vos données personnelles sont modifiables sur la page gérer mon compte accessible depuis la page de votre profil (il suffit juste que vous cliquiez sur votre nom complet en haut à droite de l’écran une fois connecté). ', 1),
(100, 'Que faire si je ne trouve pas de réponse à mon interrogation ?', 'Malheureusement si cette FAQ n’a pas répondu à vos questions vous pouvez nous contacter en cliquant sur le bouton contact dans le footer.\r\nNous nous ferons un plaisir de vous répondre : 4event.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

CREATE TABLE IF NOT EXISTS `favori` (
  `favori_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `favori_utilisateur_id` int(4) unsigned NOT NULL,
  `favori_theme_id` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`favori_id`),
  KEY `favori_utilisateur_id` (`favori_utilisateur_id`),
  KEY `favori_theme_id` (`favori_theme_id`)
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
  `media_miniature` tinyint(1) unsigned NOT NULL COMMENT '0: non 1: oui',
  PRIMARY KEY (`media_id`),
  UNIQUE KEY `media_id` (`media_id`),
  KEY `media_evenement_id` (`media_evenement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE IF NOT EXISTS `participation` (
  `participation_utilisateur_id` int(4) unsigned NOT NULL,
  `participation_evenement_id` int(4) unsigned NOT NULL,
  `participation_nb` int(4) unsigned NOT NULL,
  KEY `participation_utilisateur_id` (`participation_utilisateur_id`),
  KEY `participation_evenement_id` (`participation_evenement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `participation`
--

INSERT INTO `participation` (`participation_utilisateur_id`, `participation_evenement_id`, `participation_nb`) VALUES
(2, 1, 1),
(1, 1, 1);

--
-- Déclencheurs `participation`
--
DROP TRIGGER IF EXISTS `tbi_participation`;
DELIMITER //
CREATE TRIGGER `tbi_participation` BEFORE INSERT ON `participation`
 FOR EACH ROW BEGIN declare msg varchar(255); if ((select SUM(participation_nb) FROM participation WHERE NEW.participation_evenement_id = participation_evenement_id) > (select evenement_max_participants FROM evenement WHERE evenement_id = NEW.participation_evenement_id) OR NEW.participation_nb > (select evenement_max_participants FROM evenement WHERE evenement_id = NEW.participation_evenement_id)) then set msg = 'MyTriggerError: Trying to insert a negative value in trigger_test: '; signal sqlstate '45000' set message_text = msg; end if; end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `theme_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `theme_nom` varchar(100) COLLATE utf8_bin NOT NULL,
  `theme_miniature` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`theme_id`, `theme_nom`, `theme_miniature`) VALUES
(1, 'Cuisine', '1.jpg'),
(2, 'Soirée', '2.png'),
(3, 'Sport', '3.png'),
(4, 'Concert', '4.jpg'),
(5, 'Educatif', '5.jpg');

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
  `utilisateur_mot_de_passe` varchar(32) COLLATE utf8_bin NOT NULL,
  `utilisateur_etat` tinyint(1) unsigned NOT NULL COMMENT '0:actif 1:supprime 2:banni',
  `utilisateur_type` tinyint(1) unsigned NOT NULL COMMENT '0:normal 1:moderateur 2:administrateur',
  `utilisateur_sexe` tinyint(1) unsigned NOT NULL COMMENT '0:femme 1:homme',
  `utilisateur_newsletter` tinyint(1) unsigned NOT NULL COMMENT '0:non 1:oui',
  PRIMARY KEY (`utilisateur_id`),
  UNIQUE KEY `utilisateur_email` (`utilisateur_email`),
  KEY `utilisateur_adresse_id` (`utilisateur_adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `utilisateur_nom`, `utilisateur_prenom`, `utilisateur_email`, `utilisateur_adresse_id`, `utilisateur_date_naissance`, `utilisateur_image_profil`, `utilisateur_mot_de_passe`, `utilisateur_etat`, `utilisateur_type`, `utilisateur_sexe`, `utilisateur_newsletter`) VALUES
(1, 'Vuong', 'Matthieu', 'matthieu.vuong@gmail.com', 1, '1995-09-13', 'Vuong', 'ab4f63f9ac65152575886860dde480a1', 0, 2, 1, 0),
(2, 'Voyat', 'Julien', 'julien.voyat@gmail.com', 2, '1994-12-26', '', '927be57e1279cb8094e80fa96083a92b', 0, 0, 1, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `alerte_ibfk_3` FOREIGN KEY (`alerte_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `alerte_ibfk_4` FOREIGN KEY (`alerte_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`evenement_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evenement_ibfk_2` FOREIGN KEY (`evenement_adresse_id`) REFERENCES `adresse` (`adresse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `evenement_ibfk_3` FOREIGN KEY (`evenement_theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`faq_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `favori`
--
ALTER TABLE `favori`
  ADD CONSTRAINT `favori_theme_id_fk` FOREIGN KEY (`favori_theme_id`) REFERENCES `theme` (`theme_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `favori_utilisateur_id_fk` FOREIGN KEY (`favori_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`media_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`participation_utilisateur_id`) REFERENCES `utilisateur` (`utilisateur_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`participation_evenement_id`) REFERENCES `evenement` (`evenement_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`utilisateur_adresse_id`) REFERENCES `adresse` (`adresse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
