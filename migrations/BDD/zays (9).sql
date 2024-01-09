-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 09 jan. 2024 à 14:10
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zays`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

DROP TABLE IF EXISTS `appartement`;
CREATE TABLE IF NOT EXISTS `appartement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surface_habitable` double NOT NULL,
  `immeuble_id` int DEFAULT NULL,
  `porte` int NOT NULL,
  `surface_sol` double NOT NULL,
  `situation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_71A6BD8D63768E3F` (`immeuble_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appartement`
--

INSERT INTO `appartement` (`id`, `description`, `surface_habitable`, `immeuble_id`, `porte`, `surface_sol`, `situation`) VALUES
(57, '', 15.11, 1, 1, 15.11, 'Rez de chaussée'),
(58, '', 20, 1, 2, 20, 'Rez de chaussée'),
(59, '', 21, 1, 3, 21, 'Cour extérieure'),
(60, '', 20, 1, 4, 20, 'Cour extérieure'),
(61, '', 18.86, 1, 5, 18.86, '1er étage'),
(62, '', 25, 1, 6, 25, '2eme étage'),
(63, '', 14.31, 1, 7, 14.31, '3eme étage');

-- --------------------------------------------------------

--
-- Structure de la table `appartement_equipement`
--

DROP TABLE IF EXISTS `appartement_equipement`;
CREATE TABLE IF NOT EXISTS `appartement_equipement` (
  `appartement_id` int NOT NULL,
  `equipement_id` int NOT NULL,
  PRIMARY KEY (`appartement_id`,`equipement_id`),
  KEY `IDX_EBC624F2E1729BBA` (`appartement_id`),
  KEY `IDX_EBC624F2806F0F5C` (`equipement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `associe`
--

DROP TABLE IF EXISTS `associe`;
CREATE TABLE IF NOT EXISTS `associe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_rue` int NOT NULL,
  `rue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `copos` int NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_part` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_235AAA4AFCF77503` (`societe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `associe`
--

INSERT INTO `associe` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`, `nb_part`, `societe_id`) VALUES
(1, 'CAUVIN', 'Sébastien', 4, 'Rue Guillaume de la Tremblaye', 14000, 'Caen', 0, '', '25', 1),
(2, 'JOSEPH', 'Aurore', 11, 'Avenue de Normandie', 14150, 'Ouistreham', 0, '', '25', 1),
(3, 'ANNOUCHE', 'Zakina', 6, 'Rue du bac', 78300, 'Poissy', 0, '', '25', 1),
(4, 'BUIRON', 'Yann', 11, 'Avenue de Normandie', 14150, 'Ouistreham', 0, '', '25', 1),
(5, 'Test', 'Test', 15, 'Gambino', 15000, 'Test', 7859565, 'Test@gmail.com', '25', 1),
(6, 'Test', 'Test', 15, 'Gambino', 15000, 'Test', 7859565, 'Test@gmail.com', '25', 1),
(7, 'Test', 'Test', 15, 'Gambino', 15000, 'Test', 7859565, 'Test@gmail.com', '25', 1),
(8, 'Test2', 'Test2', 15, 'Tourlaville', 50100, 'Test2', 123456789, 'Test2@gmail.com', '25', 1),
(9, 'Test2', 'Test2', 15, 'Tourlaville', 50100, 'Test2', 123456789, 'Test2@gmail.com', '25', 1),
(10, 'Test5', 'Test5', 15, 'Tourlaville', 14000, 'Caen', 7526395, 'Test5@gmail.com', '25', 1);

-- --------------------------------------------------------

--
-- Structure de la table `bail`
--

DROP TABLE IF EXISTS `bail`;
CREATE TABLE IF NOT EXISTS `bail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `montant_hc` double NOT NULL,
  `montant_charges` double NOT NULL,
  `montant_caution` double NOT NULL,
  `nom_caution1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_caution2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `duree_bail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bail_signe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat_lieu_entree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat_lieu_sortie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attestation_assurance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appartement_id` int DEFAULT NULL,
  `associe_id` int DEFAULT NULL,
  `montant_prem_echeance` double NOT NULL,
  `montant_der_echeance` double DEFAULT NULL,
  `trimestre_reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_justificative` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archive` int NOT NULL,
  `caution_restituer` double DEFAULT NULL,
  `etat_lieu_entree_signe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat_lieu_sortie_signe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_945BC1EE1729BBA` (`appartement_id`),
  KEY `IDX_945BC1EC41A218C` (`associe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bail`
--

INSERT INTO `bail` (`id`, `date_debut`, `montant_hc`, `montant_charges`, `montant_caution`, `nom_caution1`, `nom_caution2`, `date_fin`, `duree_bail`, `bail_signe`, `etat_lieu_entree`, `etat_lieu_sortie`, `attestation_assurance`, `appartement_id`, `associe_id`, `montant_prem_echeance`, `montant_der_echeance`, `trimestre_reference`, `piece_justificative`, `archive`, `caution_restituer`, `etat_lieu_entree_signe`, `etat_lieu_sortie_signe`) VALUES
(1, '2022-08-01', 290, 30, 290, 'M. Antony Carpentier, père de Zoé Carpentier', 'Mme Séverien Carpentier, mère de Zoé Carpentier', '2024-11-01', '6', 'Oui', 'azerty', 'azerty', 'azerty', 57, 3, 320, 0, 'azerty', 'azerty', 0, 0, '', ''),
(2, '2020-09-01', 390, 30, 390, 'Néant', '', '2024-09-01', '6', 'Oui', 'azerty', 'azerty', '', 58, 2, 390, 420, 'thewoo', '', 0, 0, '', ''),
(11, '2023-12-16', 582, 282, 252, 'zaaz', 'aza', '2023-12-09', '6', 'Oui', 'reeze', 'zeez', 'ezz', 58, 2, 252, 366, 'zeez', 'ezze', 1, 0, '', ''),
(12, '2023-12-07', 555, 555, 888, 'freggdr', 'drgdgg', '2023-12-15', '6', 'Oui', 'zazazaz', 'zazaza', 'zazaazza', 57, 3, 555, 555, 'azzzaaz', 'zazzaza', 1, 0, '', ''),
(13, '2023-12-06', 888, 8888, 8888, 'frfref', 'sddsf', '2023-12-06', '5', 'Oui', 'drddfff', 'fddfdf', 'fddfdf', 57, 3, 888, 888, 'fdfdffd', 'dffdfdfd', 1, 0, '', ''),
(14, '2023-12-15', 888, 8888, 8888, 'svdfbgdfg', 'fvbfdvdfvf', '2023-12-15', '6', 'Oui', 'erdfghn', 'gbn', 'sdfgvb', 58, 2, 88888, 8888, 'sdfghbn', 'sdfghjk', 1, 0, '', ''),
(17, '2024-01-08', 400, 200, 400, '', '', '2030-08-30', '6', '', '', '', '', 61, NULL, 200, 0, 'thewoo', '', 0, 0, '', ''),
(18, '2024-01-09', 400, 200, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, 200, NULL, 'THEWOO', NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bail_locataire`
--

DROP TABLE IF EXISTS `bail_locataire`;
CREATE TABLE IF NOT EXISTS `bail_locataire` (
  `bail_id` int NOT NULL,
  `locataire_id` int NOT NULL,
  PRIMARY KEY (`bail_id`,`locataire_id`),
  KEY `IDX_EA325C7E3E3F1FE8` (`bail_id`),
  KEY `IDX_EA325C7ED8A38199` (`locataire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bail_locataire`
--

INSERT INTO `bail_locataire` (`bail_id`, `locataire_id`) VALUES
(1, 1),
(2, 2),
(11, 13),
(12, 14),
(13, 15),
(14, 16),
(14, 17),
(17, 23),
(18, 25);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
(1, 'Loyer'),
(2, 'Caution'),
(3, 'Emprunt'),
(4, 'Assurance'),
(5, 'Impôt'),
(6, 'Divers'),
(7, 'Entretien'),
(8, 'Charges'),
(9, 'Travaux'),
(20, 'Test3'),
(21, 'Test44'),
(22, 'Test44'),
(23, 'Test44'),
(24, 'Test44'),
(25, 'Test44'),
(26, 'Test44'),
(27, 'Test44'),
(28, 'Test44'),
(29, 'Test44'),
(30, 'Test44'),
(31, 'Test44'),
(32, 'Loyer');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231120135208', '2023-11-20 13:52:47', 100),
('DoctrineMigrations\\Version20231120135552', '2023-11-20 13:55:56', 14),
('DoctrineMigrations\\Version20231120140319', '2023-11-20 14:03:26', 14),
('DoctrineMigrations\\Version20231120140920', '2023-11-20 14:09:28', 15),
('DoctrineMigrations\\Version20231120141624', '2023-11-20 14:16:30', 12),
('DoctrineMigrations\\Version20231120141947', '2023-11-20 14:19:54', 13),
('DoctrineMigrations\\Version20231120142058', '2023-11-20 14:21:03', 13),
('DoctrineMigrations\\Version20231120142253', '2023-11-20 14:22:58', 13),
('DoctrineMigrations\\Version20231120142536', '2023-11-20 14:25:40', 11),
('DoctrineMigrations\\Version20231120142913', '2023-11-20 14:29:18', 13),
('DoctrineMigrations\\Version20231120143048', '2023-11-20 14:30:52', 12),
('DoctrineMigrations\\Version20231120143136', '2023-11-20 14:31:40', 12),
('DoctrineMigrations\\Version20231120143750', '2023-11-20 14:37:56', 59),
('DoctrineMigrations\\Version20231120143934', '2023-11-20 14:39:37', 58),
('DoctrineMigrations\\Version20231120144135', '2023-11-20 14:41:38', 42),
('DoctrineMigrations\\Version20231120144334', '2023-11-20 14:43:37', 70),
('DoctrineMigrations\\Version20231120144521', '2023-11-20 14:45:24', 65),
('DoctrineMigrations\\Version20231120144911', '2023-11-20 14:49:14', 65),
('DoctrineMigrations\\Version20231120145338', '2023-11-20 14:53:41', 56),
('DoctrineMigrations\\Version20231120145953', '2023-11-20 14:59:55', 66),
('DoctrineMigrations\\Version20231120150158', '2023-11-20 15:02:02', 53),
('DoctrineMigrations\\Version20231120152232', '2023-11-20 15:22:38', 66),
('DoctrineMigrations\\Version20231127135606', '2023-11-27 13:58:05', 76),
('DoctrineMigrations\\Version20231127154232', '2023-11-27 15:43:44', 163),
('DoctrineMigrations\\Version20231129091613', '2023-11-29 09:19:54', 135),
('DoctrineMigrations\\Version20231129092836', '2023-11-29 09:28:53', 87),
('DoctrineMigrations\\Version20231129093031', '2023-11-29 09:30:44', 86),
('DoctrineMigrations\\Version20231204092833', '2023-12-04 09:29:11', 75),
('DoctrineMigrations\\Version20231204093124', '2023-12-04 09:31:40', 103),
('DoctrineMigrations\\Version20231204093505', '2023-12-04 09:35:11', 13),
('DoctrineMigrations\\Version20231204093558', '2023-12-04 09:36:01', 71),
('DoctrineMigrations\\Version20231204103023', '2023-12-04 10:30:41', 12),
('DoctrineMigrations\\Version20231204124350', '2023-12-04 12:44:37', 28),
('DoctrineMigrations\\Version20231206131254', '2023-12-06 13:13:20', 93),
('DoctrineMigrations\\Version20231210092613', '2023-12-10 09:26:49', 79),
('DoctrineMigrations\\Version20231211132646', '2023-12-11 13:27:52', 70),
('DoctrineMigrations\\Version20231218094341', '2023-12-18 09:44:24', 131),
('DoctrineMigrations\\Version20231218141631', '2023-12-18 14:16:56', 13),
('DoctrineMigrations\\Version20231226055306', '2023-12-26 05:56:21', 132),
('DoctrineMigrations\\Version20240106222035', '2024-01-06 22:22:56', 106),
('DoctrineMigrations\\Version20240109093248', '2024-01-09 12:57:10', 17),
('DoctrineMigrations\\Version20240109122024', '2024-01-09 12:57:10', 41),
('DoctrineMigrations\\Version20240109125355', '2024-01-09 12:58:25', 90);

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE IF NOT EXISTS `equipement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `elements` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `observations` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8B4C6F3C40FCFA8` (`piece_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `elements`, `etat`, `observations`, `piece_id`) VALUES
(1, 'Sols_Cuisine', '', '', 17),
(2, 'Murs_Cuisine', '', '', 17),
(3, 'Plafond_Cuisine', '', '', 17),
(4, 'Plinthes_Cuisine', '', '', 17),
(5, 'Ventilation_Cuisine', '', '', 17),
(6, 'Interrupteurs_Cuisine', '', '', 17),
(7, 'Prises_Cuisine', '', '', 17),
(8, 'Eclairages_Cuisine', '', '', 17),
(9, 'Evier_Cuisine', '', '', 3),
(10, 'Meuble évier_Cuisine', '', '', 3),
(11, 'Plan de travail_Cuisine', '', '', 3),
(12, 'Elements bas_Cuisine', '', '', 3),
(13, 'Plaque vitrocéramique_Cuisine', '', '', 3),
(14, 'Tiroirs_Cuisine', '', '', 3),
(15, 'Réfrigérateur_Cuisine', '', '', 3),
(16, 'Sols_Douche', '', '', 4),
(17, 'Murs_Douche', '', '', 4),
(18, 'Plafond_Douche', '', '', 4),
(19, 'Porte intérieure_Douche', '', '', 4),
(20, 'Plinthes_Douche', '', '', 4),
(21, 'Ventilation_Douche', '', '', 4),
(22, 'Interrupteurs_Douche', '', '', 4),
(23, 'Prises_Douche', '', '', 4),
(24, 'Éclairages_Douche', '', '', 4),
(25, 'Sèche-serviette_Douche', '', '', 4),
(26, 'Douche', '', '', 4),
(27, 'WC_Douche ', '', '', 4),
(28, 'Joints_Douche', '', '', 4),
(29, 'Rangement_Douche', '', '', 4),
(30, 'Lavabo et robinet_Douche', '', '', 4),
(31, 'Eclairages_Exterieurs', '', '', 5),
(32, 'Boite aux lettres_Exterieurs', '', '', 5),
(33, 'Cour_Exterieurs', '', '', 5),
(34, 'Espace vert_Exterieurs', '', '', 5),
(35, 'Parking_Exterieurs', '', '', 5),
(36, 'Ballon d\'eau chaude', '', '', 1),
(37, 'Radiateurs électriques', '', '', 1),
(38, 'Pièce de vie – nb :', '', '', 1),
(39, 'Salle d\'eau – nb :', '', '', 1),
(40, 'VMI avec télécommande :', '', '', 1),
(41, 'Porte d\'entrée_Piece de vie', '', '', 2),
(42, 'Sols_Piece de vie', '', '', 2),
(43, 'Murs_Piece de vie', '', '', 2),
(44, 'Plafond_Piece de vie', '', '', 2),
(45, 'Porte intérieure_Piece de vie', '', '', 2),
(46, 'Fenêtres_Piece de vie', '', '', 2),
(47, 'Volets_Piece de vie', '', '', 2),
(48, 'Plinthes__Piece de vie', '', '', 2),
(49, 'Radiateurs_Piece de vie', '', '', 2),
(50, 'Ventilation_Piece de vie', '', '', 2),
(51, 'Prises_Piece de vie', '', '', 2),
(52, 'Prises RJ45_Piece de vie', '', '', 2),
(53, 'Prises antenne_Piece de vie', '', '', 2),
(54, 'Eclairages_Piece de vie', '', '', 2),
(55, 'Détecteur de fumée_Piece de vie', '', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `immeuble`
--

DROP TABLE IF EXISTS `immeuble`;
CREATE TABLE IF NOT EXISTS `immeuble` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_rue` int NOT NULL,
  `rue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `copos` int NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_467D53F9FCF77503` (`societe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `immeuble`
--

INSERT INTO `immeuble` (`id`, `nom`, `num_rue`, `rue`, `copos`, `ville`, `societe_id`) VALUES
(1, 'ICE', 97, 'Rue de Falaise', 14000, 'Caen', 1);

-- --------------------------------------------------------

--
-- Structure de la table `locataire`
--

DROP TABLE IF EXISTS `locataire`;
CREATE TABLE IF NOT EXISTS `locataire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_caf` double DEFAULT NULL,
  `archive` double NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` double NOT NULL,
  `piece_justificative` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `locataire`
--

INSERT INTO `locataire` (`id`, `nom`, `prenom`, `date_naissance`, `lieu_naissance`, `montant_caf`, `archive`, `email`, `telephone`, `piece_justificative`) VALUES
(1, 'CARPENTIER', 'Zoé', '2004-01-16', 'Lisieux', 0, 0, '', 0, ''),
(2, 'LECUYER', 'Christine', '1957-06-22', 'Caen', 22, 0, '', 0, ''),
(3, 'KHASMI', 'Mehdi', '1993-08-06', 'Montivillers', 277, 0, '', 0, ''),
(4, 'JOACHIM', 'Romane', '2003-09-02', 'Caen', 0, 0, '', 0, ''),
(5, 'LESSU FALIO', 'Elsa', '1993-10-23', 'Douala (Cameroun)', 0, 0, '', 0, ''),
(6, 'LAURENT', 'Charlotte', '2004-03-25', 'Coutances', 268, 0, '', 0, ''),
(7, 'JOUVIN', 'Théo', '2001-12-19', 'Coutances', 118, 0, '', 0, ''),
(12, 'rerere', 'erreerre', '2023-12-09', 'rereerre', 8528, 0, '', 0, ''),
(13, 'aaaaa', 'aaaaaa', '2023-12-14', 'aaaaa', 8585, 0, '', 0, ''),
(14, 'bbbbbbbbb', 'bbbbbbbbb', '2023-12-16', 'bbbbbbbbbb', 777, 0, '', 0, ''),
(15, 'ooooooo', 'oooooooo', '2023-12-06', 'oooooooooooo', 888, 0, '', 0, ''),
(16, 'dddddd', 'dddddd', '2023-12-09', 'ddddddd', 555, 0, '', 0, ''),
(17, 'eeeeee', 'eeee', '2023-12-09', 'eeeeee', 6666, 0, '', 0, ''),
(23, 'Bacar', 'Ize', '2000-11-20', 'Mamoudzou', 0, 0, 'ize@gmail.com', 780625195, ''),
(25, 'ISMAEL', 'Karim', '2010-10-10', 'GOTHAM', NULL, 0, 'karim@gmail.com', 722659854, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mois_annee`
--

DROP TABLE IF EXISTS `mois_annee`;
CREATE TABLE IF NOT EXISTS `mois_annee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mois` date NOT NULL,
  `annee` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mois_annee`
--

INSERT INTO `mois_annee` (`id`, `mois`, `annee`) VALUES
(1, '2023-11-01', '2023-11-01');

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

DROP TABLE IF EXISTS `mouvement`;
CREATE TABLE IF NOT EXISTS `mouvement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_m` date NOT NULL,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `souscategorie_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B51FC3EA27126E0` (`souscategorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mouvement`
--

INSERT INTO `mouvement` (`id`, `date_m`, `libelle`, `debit`, `credit`, `souscategorie_id`) VALUES
(1, '2022-12-19', 'PRELEVEMENT ELECTRICITE DE FRANCE', 55.47, 0, 59),
(2, '2022-12-10', 'REMBOURSEMENT DE PRET 10001119643 ECHEANCE 10/12/22  ', 598.13, 0, 55),
(3, '2022-12-10', 'REMBOURSEMENT DE PRET 10000255789 ECHEANCE 10/12/22 ', 579.49, 0, 55),
(4, '2022-12-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/12/22 ', 59.33, 0, 55),
(5, '2022-12-07', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU23411ES07RL001 VIR DE M JOUVIN TEO    ', 0, 292, 8),
(6, '2022-12-07', 'VIREMENT EN VOTRE FAVEUR\nM KASMI MEHDI VIREMENT VERS SCI VIREMENT DE M KASMI MEHDI ', 0, 103, 3),
(7, '2022-12-06', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA         ', 0, 400, 6),
(8, '2022-12-06', 'VIREMENT EN VOTRE FAVEUR\nMLLE ROMANE JOACHIM VIREMENT VER VIREMENT DE MLLE ROMANE JOACHIM         ', 0, 370, 5),
(9, '2022-12-06', 'VIREMENT EN VOTRE FAVEUR\nDE MLE      CARPENTIER ZOE                        ', 0, 320, 1),
(10, '2022-12-06', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER', 0, 380, 2),
(11, '2022-12-05', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                           -', 31.52, 0, 58),
(12, '2022-12-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 17135565V16 0752816HKASMI     ', 0, 277, 11),
(13, '2022-12-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 17135992V16 0774612JLAURENT  ', 0, 268, 15),
(14, '2022-12-05', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE ', 0, 122, 7),
(15, '2022-12-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 17135469V16 0749382TJOUVIN     ', 0, 118, 16),
(16, '2022-12-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 17131193V16 0416158DLECUYER     ', 0, 22, 10),
(17, '2022-12-02', 'REGLEMENT               \nASSU. CNP PRET HABITAT 12/22  ', 31.96, 0, 50),
(18, '2022-12-02', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 12/22  ', 27.18, 0, 50),
(19, '2022-11-15', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT ', 178, 0, 53),
(20, '2022-11-14', 'PRELEVEMENT CARTE       \nDEPENSES CARTE X5009 AU 31/10/22  ', 2.5, 0, 55),
(21, '2022-11-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/11/22  ', 598.13, 0, 55),
(22, '2022-11-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/11/22  ', 579.49, 0, 55),
(23, '2022-11-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/11/22  ', 59.33, 0, 55),
(24, '2022-11-07', 'PRELEVEMENT             \nFACTURE 10/2022 N?2230400143192  \n', 52.5, 0, 68),
(25, '2022-11-07', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU23101R87PE8P01 VIR DE M JOUVIN TEO ', 0, 292, 4),
(26, '2022-11-07', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA  ', 31.52, 0, 58),
(27, '2022-11-07', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA ', 0, 400, 6),
(28, '2022-11-07', 'VIREMENT EN VOTRE FAVEUR\nMLLE ROMANE JOACHIM VIREMENT VER VIREMENT DE MLLE ROMANE JOACHIM      ', 0, 370, 5),
(29, '2022-11-07', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE ', 0, 122, 7),
(30, '2022-11-07', 'VIREMENT EN VOTRE FAVEUR\nM KASMI MEHDI VIREMENT VERS SCI VIREMENT DE M KASMI MEHDI ', 0, 103, 3),
(31, '2022-11-07', 'VIREMENT EN VOTRE FAVEUR\nDE MLE      CARPENTIER ZOE                ', 0, 320, 1),
(32, '2022-11-07', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 380, 2),
(33, '2022-11-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16854055V16 0752816HKASMI ', 0, 277, 11),
(34, '2022-11-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16854486V16 0774612JLAURENT     102022ME ', 0, 268, 15),
(35, '2022-11-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16853960V16 0749382TJOUVIN                     ', 0, 118, 16),
(36, '2022-11-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16849664V16 0416158DLECUYER ', 0, 22, 10),
(37, '2022-11-03', 'REGLEMENT               \nASSU. CNP PRET HABITAT 11/22  ', 31.96, 0, 50),
(38, '2022-11-03', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 11/22  ', 27.18, 0, 50),
(39, '2022-10-31', 'EFFETS DOMICILIES       \nDOMICILIES  ', 36.06, 0, 54),
(40, '2022-10-31', 'CHEQUE EMIS             \n1849367  ', 3793.53, 0, 68),
(41, '2022-10-19', 'PRELEVEMENT             \nELECTRICITE DE FRANCE Numero de client : 6012189567 - Numero de', 41.94, 0, 59),
(42, '2022-10-17', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(43, '2022-10-11', 'CHEQUE EMIS             \n6013608/0000000/000000000 ', 6014.9, 0, 68),
(44, '2022-10-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/10/22 ', 598.13, 0, 55),
(45, '2022-10-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/10/22 ', 579.49, 0, 55),
(46, '2022-10-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/10/22 ', 59.33, 0, 55),
(47, '2022-10-07', 'VIREMENT EN VOTRE FAVEUR\nVIR INST de M KASMI MEHDI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 103, 3),
(48, '2022-10-07', 'VIREMENT EN VOTRE FAVEUR\nMLE ROMANE JOACHIM C18D22279N004 LOYER JOACHIM \nC18D22279N00412                    ', 0, 370, 5),
(49, '2022-10-06', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(50, '2022-10-06', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU22782XAJUSBX01 VIR DE M JOUVIN TEO \nVU22782XAJUSBX01                   ', 0, 292, 8),
(51, '2022-10-06', 'VIREMENT EN VOTRE FAVEUR\nDE MLE      CARPENTIER ZOE \nLoyer                              ', 0, 320, 1),
(52, '2022-10-06', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 380, 2),
(53, '2022-10-05', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422002         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \na2bee2e6be2f4', 31.52, 0, 58),
(54, '2022-10-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16716996V16 0752816HKASMI       092022ME \n16716996V16                        ', 0, 277, 11),
(55, '2022-10-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16717439V16 0774612JLAURENT     092022ME \n16717439V16                        ', 0, 268, 15),
(56, '2022-10-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16716902V16 0749382TJOUVIN      092022ME \n16716902V16                        ', 0, 118, 16),
(57, '2022-10-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16712499V16 0416158DLECUYER     092022ME \n16712499V16                        ', 0, 25, 10),
(58, '2022-10-04', 'REGLEMENT               \nASSU. CNP PRET HABITAT 10/22 ', 31.96, 0, 50),
(59, '2022-10-04', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 10/22 ', 27.18, 0, 50),
(60, '2022-10-03', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE \nVIREMENT VERS SEBAS                ', 0, 122, 7),
(61, '2022-09-15', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(62, '2022-09-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/09/22 ', 598.13, 0, 55),
(63, '2022-09-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/09/22 ', 579.49, 0, 55),
(64, '2022-09-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/09/22 ', 59.33, 0, 55),
(65, '2022-09-06', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(66, '2022-09-06', 'VIREMENT EN VOTRE FAVEUR\nDE MLE      CARPENTIER ZOE \nLoyer                              ', 0, 320, 1),
(67, '2022-09-06', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 380, 2),
(68, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nMle JOACHIM ROMANE VK224815MVNPM VIR DE MLE JOACHIM ROMANE \nVK224815MVNPMW01                   ', 0, 370, 5),
(69, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU224818DSGLNR01 VIR DE M JOUVIN TEO \nVU224818DSGLNR01                   ', 0, 248, 8),
(70, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE \nVIREMENT VERS SEBAS                ', 0, 109, 7),
(71, '2022-09-05', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422001         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \nad2d970cd0f34', 31.52, 0, 58),
(72, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nVIR INST de M KASMI MEHDI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 177, 3),
(73, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16515685V16 0774612JLAURENT     082022ME \n16515685V16                        ', 0, 281, 15),
(74, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16515251V16 0752816HKASMI       082022ME \n16515251V16                        ', 0, 203, 11),
(75, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16515159V16 0749382TJOUVIN      082022ME \n16515159V16                        ', 0, 162, 16),
(76, '2022-09-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16510761V16 0416158DLECUYER     082022ME \n16510761V16                        ', 0, 25, 10),
(77, '2022-09-02', 'REGLEMENT               \nASSU. CNP PRET HABITAT 09/22 ', 31.96, 0, 50),
(78, '2022-09-02', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 09/22 ', 27.18, 0, 50),
(79, '2022-08-19', 'PRELEVEMENT             \nELECTRICITE DE FRANCE Numero de client : 6012189567 - Numero de compte : xxx 004021382958 \nMM9760121895670001                 \nFR47EDF001007                      \nZ020018852940 11403 1   SIMM    114', 41.59, 0, 59),
(80, '2022-08-18', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16431422V16 0749382TJOUVIN      180822JO \n16431422V16                        ', 0, 21, 16),
(81, '2022-08-18', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16431492V16 0752816HKASMI       180822JO \n16431492V16                        ', 0, 16, 11),
(82, '2022-08-18', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16427571V16 0416158DLECUYER     180822JO \n16427571V16                        ', 0, 15, 10),
(83, '2022-08-18', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16431842V16 0774612JLAURENT     180822JO \n16431842V16                        ', 0, 9, 15),
(84, '2022-08-16', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(85, '2022-08-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/08/22 ', 598.13, 0, 55),
(86, '2022-08-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/08/22 ', 579.49, 0, 55),
(87, '2022-08-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/08/22 ', 59.33, 0, 55),
(88, '2022-08-08', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(89, '2022-08-08', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU22172XDQ1EES01 VIR DE M JOUVIN TEO \nVU22172XDQ1EES01                   ', 0, 210, 8),
(90, '2022-08-08', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 380, 2),
(91, '2022-08-05', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE \nVIREMENT VERS SEBAS                ', 0, 118, 7),
(92, '2022-08-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16280100V16 0774612JLAURENT     072022ME \n16280100V16                        ', 0, 272, 15),
(93, '2022-08-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16279613V16 0749382TJOUVIN      072022ME \n16279613V16                        ', 0, 199, 16),
(94, '2022-08-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16279700V16 0752816HKASMI       072022ME \n16279700V16                        ', 0, 187, 11),
(95, '2022-08-05', 'VIREMENT EN VOTRE FAVEUR\nVEOLIA EAU - COMPAGNIE GENERALE 084830010193010422510         1 \nI0000228257006                     ', 0, 12.58, 58),
(96, '2022-08-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16275170V16 0416158DLECUYER     072022ME \n16275170V16                        ', 0, 10, 10),
(97, '2022-08-03', 'VIREMENT EN VOTRE FAVEUR\nVIR INST de M KASMI MEHDI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 193, 3),
(98, '2022-08-03', 'VIREMENT EN VOTRE FAVEUR\nMle JOACHIM ROMANE VK22151SZE272 VIR DE MLE JOACHIM ROMANE \nVK22151SZE272F01                   ', 0, 370, 5),
(99, '2022-08-02', 'REGLEMENT               \nASSU. CNP PRET HABITAT 08/22 ', 31.96, 0, 50),
(100, '2022-08-02', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 08/22 ', 27.18, 0, 50),
(101, '2022-07-29', 'VIREMENT EN VOTRE FAVEUR\nCaution + 1er loyer CARPENTIER Z \nVirement depuis Ma Banque          ', 0, 610, 1),
(102, '2022-07-29', 'CHEQUE EMIS             \n6013607 ', 280, 0, 44),
(103, '2022-07-15', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(104, '2022-07-12', 'PRELEVEMENT CARTE       \nDEPENSES CARTE AU 30/06/2022 ', 59.8, 0, 56),
(105, '2022-07-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/07/22 ', 598.13, 0, 55),
(106, '2022-07-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/07/22 ', 579.49, 0, 55),
(107, '2022-07-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/07/22 ', 59.33, 0, 55),
(108, '2022-07-06', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(109, '2022-07-06', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 380, 2),
(110, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU21861JK6G9L801 VIR DE M JOUVIN TEO \nVU21861JK6G9L801                   ', 0, 210, 8),
(111, '2022-07-05', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422005         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \n831073a8a3d54', 34.07, 0, 58),
(112, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE \nVIREMENT VERS SEBAS                ', 0, 118, 7),
(113, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nMle JOACHIM ROMANE VK21852JY275N VIR DE MLE JOACHIM ROMANE \nVK21852JY275NW01                   ', 0, 370, 5),
(114, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16146260V16 0774612JLAURENT     062022ME \n16146260V16                        ', 0, 272, 15),
(115, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16145730V16 0749382TJOUVIN      062022ME \n16145730V16                        ', 0, 199, 16),
(116, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16145852V16 0752816HKASMI       062022ME \n16145852V16                        ', 0, 187, 11),
(117, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16145259V16 0728325LVERNUSSE    062022ME \n16145259V16                        ', 0, 175, 4),
(118, '2022-07-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16141126V16 0416158DLECUYER     062022ME \n16141126V16                        ', 0, 10, 10),
(119, '2022-07-04', 'REGLEMENT               \nASSU. CNP PRET HABITAT 07/22 ', 31.96, 0, 50),
(120, '2022-07-04', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 07/22 ', 27.18, 0, 50),
(121, '2022-07-04', 'VIREMENT EN VOTRE FAVEUR\nM KASMI MEHDI VIREMENT VERS SCI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 193, 3),
(122, '2022-07-04', 'VIREMENT EN VOTRE FAVEUR\nMme VERNUSSE YUNA Loyer ', 0, 40, 4),
(123, '2022-06-21', 'PRELEVEMENT             \nELECTRICITE DE FRANCE Numero de client : 6012189567 - Numero de compte : xxx 004021382958 \nMM9760121895670001                 \nFR47EDF001007                      \nZ021684113852 11403 1   SIMM    114', 41.71, 0, 59),
(124, '2022-06-15', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(125, '2022-06-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/06/22 ', 598.13, 0, 55),
(126, '2022-06-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/06/22 ', 579.49, 0, 55),
(127, '2022-06-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/06/22 ', 59.33, 0, 55),
(128, '2022-06-07', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422004         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \nf4f2712191444', 34.03, 0, 58),
(129, '2022-06-07', 'VIREMENT EN VOTRE FAVEUR\nMR BUIRON YANN COMMANDE YANN ', 0, 1664, 55),
(130, '2022-06-07', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(131, '2022-06-07', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU215632M9WAW001 VIR DE M JOUVIN TEO \nVU215632M9WAW001                   ', 0, 183, 8),
(132, '2022-06-07', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 380, 2),
(133, '2022-06-03', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE \nVIREMENT VERS SEBAS                ', 0, 390, 7),
(134, '2022-06-03', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16122840V16 XXXREFERENCE  016122840      ME    0749382TJOUVIN      052022ME \n16122840V16                        ', 0, 227, 16),
(135, '2022-06-03', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16122343V16 XXXREFERENCE  016122343      ME    0728325LVERNUSSE    052022ME \n16122343V16                        ', 0, 175, 4),
(136, '2022-06-03', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16122963V16 XXXREFERENCE  016122963      ME    0752816HKASMI       052022ME \n16122963V16                        ', 0, 134, 11),
(137, '2022-06-03', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 16118187V16 XXXREFERENCE  016118187      ME    0416158DLECUYER     052022ME \n16118187V16                        ', 0, 10, 10),
(138, '2022-06-02', 'REGLEMENT               \nASSU. CNP PRET HABITAT 06/22 ', 31.96, 0, 50),
(139, '2022-06-02', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 06/22 ', 27.18, 0, 50),
(140, '2022-06-02', 'VIREMENT EN VOTRE FAVEUR\nMle JOACHIM ROMANE VK21531QTJ5RY VIR DE MLE JOACHIM ROMANE \nVK21531QTJ5RYJ01                   ', 0, 370, 5),
(141, '2022-06-02', 'VIREMENT EN VOTRE FAVEUR\nVIR INST de M KASMI MEHDI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 246, 3),
(142, '2022-05-31', 'EFFETS DOMICILIES       \nDOMICILIES ', 1663.98, 0, 55),
(143, '2022-05-31', 'VIREMENT EN VOTRE FAVEUR\nMme VERNUSSE YUNA Loyer ', 0, 135, 4),
(144, '2022-05-25', 'CHEQUE EMIS             \n1849366/0000000/000000000 ', 345, 0, 72),
(145, '2022-05-16', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(146, '2022-05-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/05/22 ', 598.13, 0, 55),
(147, '2022-05-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/05/22 ', 579.49, 0, 55),
(148, '2022-05-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/05/22 ', 59.33, 0, 55),
(149, '2022-05-06', 'VIREMENT EN VOTRE FAVEUR\nM JOUVIN TEO VU21253Q27ZDUS01 VIR DE M JOUVIN TEO \nVU21253Q27ZDUS01                   ', 0, 44, 8),
(150, '2022-05-06', 'VIREMENT EN VOTRE FAVEUR\nMLLE LAURENT CHARLOTTE VIREMENT VIREMENT DE MLLE LAURENT CHARLOTTE \nVIREMENT VERS SEBAS                ', 0, 750, 7),
(151, '2022-05-06', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(152, '2022-05-06', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 380, 2),
(153, '2022-05-05', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422003         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \nd623127831904', 34.03, 0, 58),
(154, '2022-05-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015875586V16 XXXREFERENCE  015875586      ME    0749382TJOUVIN      042022ME \n015875586V16                       ', 0, 227, 16),
(155, '2022-05-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015875086V16 XXXREFERENCE  015875086      ME    0728325LVERNUSSE    042022ME \n015875086V16                       ', 0, 175, 4),
(156, '2022-05-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015875717V16 XXXREFERENCE  015875717      ME    0752816HKASMI       042022ME \n015875717V16                       ', 0, 134, 11),
(157, '2022-05-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015870899V16 XXXREFERENCE  015870899      ME    0416158DLECUYER     042022ME \n015870899V16                       ', 0, 10, 10),
(158, '2022-05-04', 'CHEQUE EMIS             \n1849365 ', 320, 0, 71),
(159, '2022-05-04', 'VIREMENT EN VOTRE FAVEUR\nMle JOACHIM ROMANE VK21232W3Q7US VIR DE MLE JOACHIM ROMANE \nVK21232W3Q7USC01                   ', 0, 710, 5),
(160, '2022-05-03', 'REGLEMENT               \nASSU. CNP PRET HABITAT 05/22 ', 31.96, 0, 50),
(161, '2022-05-03', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 05/22 ', 27.18, 0, 50),
(162, '2022-05-03', 'VIREMENT EN VOTRE FAVEUR\nVIR INST de M KASMI MEHDI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 224, 3),
(163, '2022-05-03', 'VIREMENT EN VOTRE FAVEUR\nMme VERNUSSE YUNA Loyer ', 0, 135, 4),
(164, '2022-04-30', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE rappel loy rappel loyer ', 0, 51, 2),
(165, '2022-04-19', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(166, '2022-04-19', 'PRELEVEMENT             \nELECTRICITE DE FRANCE Numero de client : 6012189567 - Numero de compte : xxx 004021382958 \nMM9760121895670001                 \nFR47EDF001007                      \nZ128250175387 11403 1   SIMM    114', 41.37, 0, 59),
(167, '2022-04-13', 'RETRAIT AU DISTRIBUTEUR \nCAEN             12/04 11H58 ', 70, 0, 2),
(168, '2022-04-11', 'VIREMENT EN VOTRE FAVEUR\nMME MALIKA DASROT VIREMENT VERS DASROT MALIKA LOYER AVRIL \nVIREMENT VERS SCI ZAYS             ', 0, 350, 70),
(169, '2022-04-11', 'VIREMENT EN VOTRE FAVEUR\nMME MALIKA DASROT VIREMENT VERS DASROT MALIKA COMPLEMENT LOYER MARS \nVIREMENT VERS SCI ZAYS             ', 0, 240, 70),
(170, '2022-04-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/04/22 ', 598.13, 0, 55),
(171, '2022-04-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/04/22 ', 579.49, 0, 55),
(172, '2022-04-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/04/22 ', 59.33, 0, 55),
(173, '2022-04-06', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(174, '2022-04-06', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 329, 2),
(175, '2022-04-05', 'PRELEVEMENT             \nMACIF Loir Bretagne Production-M -PRELEV 1305042022  01554969126 \nMA3630638380                       \nFR66ZZZ110663                      \nI0000412667517015549691042         ', 161.14, 0, 52),
(176, '2022-04-05', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422002         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \nb1c48d1e86d04', 34.03, 0, 58),
(177, '2022-04-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015741143V16 XXXREFERENCE  015741143      ME    0749382TJOUVIN      032022ME \n015741143V16                       ', 0, 227, 16),
(178, '2022-04-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015740631V16 XXXREFERENCE  015740631      ME    0728325LVERNUSSE    032022ME \n015740631V16                       ', 0, 175, 4),
(179, '2022-04-05', 'VIREMENT EN VOTRE FAVEUR\nMme VERNUSSE YUNA Loyer ', 0, 135, 4),
(180, '2022-04-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015741274V16 XXXREFERENCE  015741274      ME    0752816HKASMI       032022ME \n015741274V16                       ', 0, 134, 11),
(181, '2022-04-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015736433V16 XXXREFERENCE  015736433      ME    0416158DLECUYER     032022ME \n015736433V16                       ', 0, 90, 10),
(182, '2022-04-05', 'VIREMENT EN VOTRE FAVEUR\nBEULET ALLAN ', 0, 375, 69),
(183, '2022-04-04', 'REGLEMENT               \nASSU. CNP PRET HABITAT 04/22 ', 31.96, 0, 50),
(184, '2022-04-04', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 04/22 ', 27.18, 0, 50),
(185, '2022-04-04', 'VIREMENT EN VOTRE FAVEUR\nVIR INST de M KASMI MEHDI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 246, 3),
(186, '2022-03-15', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(187, '2022-03-14', 'PRELEVEMENT CARTE       \nDEPENSES CARTE AU 28/02/2022 ', 17.9, 0, 56),
(188, '2022-03-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/03/22 ', 598.13, 0, 55),
(189, '2022-03-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/03/22 ', 579.49, 0, 55),
(190, '2022-03-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/03/22 ', 59.33, 0, 55),
(191, '2022-03-07', 'VIREMENT EN VOTRE FAVEUR\nVIR INST de MME MALIKA DASROT DASROT MALIKA LOYER MARS \nVIREMENT VERS SCI ZAYS             ', 0, 110, 70),
(192, '2022-03-07', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422001         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \n02c8fbd499584', 34.03, 0, 58),
(193, '2022-03-07', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(194, '2022-03-07', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 329, 2),
(195, '2022-03-07', 'VIREMENT EN VOTRE FAVEUR\nBEULET ALLAN ', 0, 375, 69),
(196, '2022-03-04', 'VIREMENT EN VOTRE FAVEUR\nM KASMI MEHDI VIREMENT VERS SCI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 268, 3),
(197, '2022-03-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015604097V16 XXXREFERENCE  015604097      ME    0619400YDASROT      022022ME \n015604097V16                       ', 0, 240, 70),
(198, '2022-03-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015606386V16 XXXREFERENCE  015606386      ME    0749382TJOUVIN      022022ME \n015606386V16                       ', 0, 230, 16),
(199, '2022-03-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015605875V16 XXXREFERENCE  015605875      ME    0728325LVERNUSSE    022022ME \n015605875V16                       ', 0, 175, 4),
(200, '2022-03-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015606519V16 XXXREFERENCE  015606519      ME    0752816HKASMI       022022ME \n015606519V16                       ', 0, 112, 11),
(201, '2022-03-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015601661V16 XXXREFERENCE  015601661      ME    0416158DLECUYER     022022ME \n015601661V16                       ', 0, 90, 10),
(202, '2022-03-03', 'VIREMENT EN VOTRE FAVEUR\nMme VERNUSSE YUNA loyer ', 0, 135, 4),
(203, '2022-03-02', 'REGLEMENT               \nASSU. CNP PRET HABITAT 03/22 ', 31.96, 0, 50),
(204, '2022-03-02', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 03/22 ', 27.18, 0, 50),
(205, '2022-02-21', 'PRELEVEMENT             \nELECTRICITE DE FRANCE Numero de client : 6012189567 - Numero de compte : xxx 004021382958 \nMM9760121895670001                 \nFR47EDF001007                      \nZ029816422255 11403 1   SIMM    114', 39.98, 0, 59),
(206, '2022-02-15', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(207, '2022-02-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/02/22 ', 598.13, 0, 55),
(208, '2022-02-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/02/22 ', 579.49, 0, 55),
(209, '2022-02-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/02/22 ', 59.33, 0, 55),
(210, '2022-02-07', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(211, '2022-02-07', 'VIREMENT EN VOTRE FAVEUR\nM KASMI MEHDI VIREMENT VERS SCI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 268, 3),
(212, '2022-02-07', 'VIREMENT EN VOTRE FAVEUR\nMME MALIKA DASROT VIREMENT VERS DASROT MALIKA LOYER FVRIER \nVIREMENT VERS SCI ZAYS             ', 0, 110, 70),
(213, '2022-02-07', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 329, 2),
(214, '2022-02-07', 'VIREMENT EN VOTRE FAVEUR\nBEULET ALLAN ', 0, 375, 69),
(215, '2022-02-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015469376V16 XXXREFERENCE  015469376      ME    0749382TJOUVIN      012022ME \n015469376V16                       ', 0, 285, 16),
(216, '2022-02-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015467110V16 XXXREFERENCE  015467110      ME    0619400YDASROT      012022ME \n015467110V16                       ', 0, 240, 70),
(217, '2022-02-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015468848V16 XXXREFERENCE  015468848      ME    0728325LVERNUSSE    012022ME \n015468848V16                       ', 0, 175, 4),
(218, '2022-02-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015469513V16 XXXREFERENCE  015469513      ME    0752816HKASMI       012022ME \n015469513V16                       ', 0, 112, 11),
(219, '2022-02-04', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015464730V16 XXXREFERENCE  015464730      ME    0416158DLECUYER     012022ME \n015464730V16                       ', 0, 90, 10),
(220, '2022-02-02', 'REGLEMENT               \nASSU. CNP PRET HABITAT 02/22 ', 31.96, 0, 50),
(221, '2022-02-02', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 02/22 ', 27.18, 0, 50),
(222, '2022-02-02', 'VIREMENT EN VOTRE FAVEUR\nMme VERNUSSE YUNA Loyer ', 0, 135, 4),
(223, '2022-02-02', 'VIREMENT EN VOTRE FAVEUR\nVEOLIA EAU - COMPAGNIE GENERALE 084830010193010422400         1 \nI0000208509317                     ', 0, 21.58, 58),
(224, '2022-01-28', 'VIREMENT EN VOTRE FAVEUR\nMME MALIKA DASROT VIREMENT VERS DASROT MALIKA LOYER DECEMBRE COMPLEMENT \nVIREMENT VERS SCI ZAYS             ', 0, 23, 70),
(225, '2022-01-28', 'VIREMENT EN VOTRE FAVEUR\nMME MALIKA DASROT VIREMENT VERS DASROT MALIKA LOYER JANVIER COMPLEMENT \nVIREMENT VERS SCI ZAYS             ', 0, 10, 70),
(226, '2022-01-17', 'PRELEVEMENT             \nDIRECTION GENERALE DES FINANCES 140664663470050246 111                      MENM314019483831066  IMPOT TF \nNNFR46ZZZ005002M314019483831       \nFR46ZZZ005002                      \n1E087000014066M314019483831        ', 294, 0, 53),
(227, '2022-01-10', 'REMBOURSEMENT DE PRET   \n10001119643 ECHEANCE    10/01/22 ', 598.13, 0, 55),
(228, '2022-01-10', 'REMBOURSEMENT DE PRET   \n10000255789 ECHEANCE    10/01/22 ', 579.49, 0, 55),
(229, '2022-01-10', 'REMBOURSEMENT DE PRET   \n10000255790 ECHEANCE    10/01/22 ', 59.33, 0, 55),
(230, '2022-01-06', 'VIREMENT EN VOTRE FAVEUR\nML LESSU FALIO ELSA VIREMENT VER VIREMENT DE ML LESSU FALIO ELSA \nVIREMENT VERS SCI ZAYS             ', 0, 400, 6),
(231, '2022-01-06', 'VIREMENT EN VOTRE FAVEUR\nM KASMI MEHDI VIREMENT VERS SCI VIREMENT DE M KASMI MEHDI \nVIREMENT VERS SCI ZAYS             ', 0, 186, 3),
(232, '2022-01-06', 'VIREMENT EN VOTRE FAVEUR\nMme VERNUSSE YUNA loyer ', 0, 135, 4),
(233, '2022-01-06', 'VIREMENT EN VOTRE FAVEUR\nMME LECUYER CHRISTINE LOYER LOYER ', 0, 329, 2),
(234, '2022-01-05', 'PRELEVEMENT             \nVEOLIA EAU - COMPAGNIE GENERALE RUM:XX131306450SEPA                    /ICS:FR68ZZZ437614                      -084830010193010422005         1 \nXX131306450SEPA                    \nFR68ZZZ437614                      \n741149b2410d4', 38.37, 0, 58),
(235, '2022-01-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015421550V16 XXXREFERENCE  015421550      ME    0749382TJOUVIN      122021ME \n015421550V16                       ', 0, 281, 16),
(236, '2022-01-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015418958V16 XXXREFERENCE  015418958      ME    0619400YDASROT      122021ME \n015418958V16                       ', 0, 250, 70),
(237, '2022-01-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015420946V16 XXXREFERENCE  015420946      ME    0728325LVERNUSSE    122021ME \n015420946V16                       ', 0, 175, 4),
(238, '2022-01-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015416340V16 XXXREFERENCE  015416340      ME    0416158DLECUYER     122021ME \n015416340V16                       ', 0, 56, 10),
(239, '2022-01-05', 'VIREMENT EN VOTRE FAVEUR\nCAF DU CALVADOS DIE 015421691V16 XXXREFERENCE  015421691      ME    0752816HKASMI       122021ME \n015421691V16                       ', 0, 47, 11),
(240, '2022-01-05', 'VIREMENT EN VOTRE FAVEUR\nBEULET ALLAN ', 0, 375, 69),
(241, '2022-01-04', 'REGLEMENT               \nASSU. CNP PRET HABITAT 01/22 ', 31.96, 0, 50),
(242, '2022-01-04', 'REGLEMENT               \nASSU. CAAE PRET HABITAT 01/22 ', 27.18, 0, 50),
(243, '2022-01-04', 'VIREMENT EN VOTRE FAVEUR\nMME MALIKA DASROT VIREMENT VERS DASROT MALIKA LOYER JANVIER \nVIREMENT VERS SCI ZAYS             ', 0, 100, 70);

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_p` date NOT NULL,
  `montant` double NOT NULL,
  `source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bail_id` int DEFAULT NULL,
  `moisannee_id` int DEFAULT NULL,
  `caf` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B1DC7A1E3E3F1FE8` (`bail_id`),
  KEY `IDX_B1DC7A1EDBC40344` (`moisannee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id`, `date_p`, `montant`, `source`, `bail_id`, `moisannee_id`, `caf`) VALUES
(1, '2024-01-10', 292, '', 1, 1, 28),
(4, '2024-01-20', 400, '', 2, 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`id`, `libelle`) VALUES
(1, 'Équipement de chauffage'),
(2, 'Pièce de vie (séjour/couchage)'),
(3, 'Equipement cuisine'),
(4, 'Salle de douche'),
(5, 'Elements extérieurs et autres'),
(17, 'Espace Cuisine');

-- --------------------------------------------------------

--
-- Structure de la table `piece_jointe`
--

DROP TABLE IF EXISTS `piece_jointe`;
CREATE TABLE IF NOT EXISTS `piece_jointe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_fichier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `locataire_id` int DEFAULT NULL,
  `typejointe_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AB5111D4D8A38199` (`locataire_id`),
  KEY `IDX_AB5111D470CAF51F` (`typejointe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

DROP TABLE IF EXISTS `societe`;
CREATE TABLE IF NOT EXISTS `societe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_rue` int NOT NULL,
  `rue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_tel` int NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `copos` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `nom`, `num_rue`, `rue`, `ville`, `num_tel`, `mail`, `copos`) VALUES
(1, 'SCI ZAYS', 97, 'Rue de falaise', 'Caen', 722305060, 'sci.zays@hotmail.com', 14000);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int DEFAULT NULL,
  `bail_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52743D7BBCF5E72D` (`categorie_id`),
  KEY `IDX_52743D7B3E3F1FE8` (`bail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `libelle`, `categorie_id`, `bail_id`) VALUES
(1, 'Appartement 1-Carpentier', 1, NULL),
(2, 'Appartement 2-Lecuyer', 1, NULL),
(3, 'Appartement 3-Khasmi', 1, NULL),
(4, 'Appartement 4', 1, NULL),
(5, 'Appartement 5-Joachim', 1, NULL),
(6, 'Appartement 6-Lessu Falio', 1, NULL),
(7, 'Appartement 7-Laurent', 1, NULL),
(8, 'Appartement 8-Jouvin', 1, NULL),
(9, 'Appartement 1-Carpentier-caf', 1, NULL),
(10, 'Appartement 2-Lecuyer-caf', 1, NULL),
(11, 'Appartement 3-Khasmi-caf', 1, NULL),
(12, 'Appartement 4--caf', 1, NULL),
(13, 'Appartement 5-Joachim-caf', 1, NULL),
(14, 'Appartement 6-Lessu Fialo-caf', 1, NULL),
(15, 'Appartement 7-Laurent-caf', 1, NULL),
(16, 'Appartement 8-Jouvin-caf', 1, NULL),
(17, 'Versement appartement 1-Carpentier', 2, NULL),
(18, 'Versement appartement 2-Lecuyer', 2, NULL),
(19, 'Versement appartement 3-Khasmi', 2, NULL),
(20, 'Versement appartement 4', 2, NULL),
(21, 'Versement appartement 5-Joachim', 2, NULL),
(22, 'Versement appartement 6-Lessu Fialo', 2, NULL),
(23, 'Versement appartement 7-Laurent', 2, NULL),
(24, 'Versement appartement 8-Jouvin', 2, NULL),
(41, 'Restitution appartement 1-Carpentier', 2, NULL),
(42, 'Restitution appartement 2-Lecuyer', 2, NULL),
(43, 'Restitution appartement 3-Khasmi', 2, NULL),
(44, 'Restitution appartement 4', 2, NULL),
(45, 'Restitution appartement 5-Joachim', 2, NULL),
(46, 'Restitution appartement 6-Lessu Fialo', 2, NULL),
(47, 'Restitution appartement 7-Laurent', 2, NULL),
(48, 'Restitution appartement 8-Jouvin', 2, NULL),
(49, 'Remboursement emprunt', 3, NULL),
(50, 'Assurance emprunt ', 3, NULL),
(51, 'Assurance emprunteur', 4, NULL),
(52, 'Habitation', 4, NULL),
(53, 'Taxe foncière', 5, NULL),
(54, 'Frais bancaires', 6, NULL),
(55, 'Autres', 6, NULL),
(56, 'Achat matériel, produit', 7, NULL),
(57, 'Réparation', 7, NULL),
(58, 'Eau', 8, NULL),
(59, 'Electricité', 8, NULL),
(60, 'Appartement 1', 9, NULL),
(61, 'Appartement 2', 9, NULL),
(62, 'Appartement 3', 9, NULL),
(63, 'Appartement 4', 9, NULL),
(64, 'Appartement 5', 9, NULL),
(65, 'Appartement 6', 9, NULL),
(66, 'Appartement 7', 9, NULL),
(67, 'Appartement 8', 9, NULL),
(68, 'Parties communes', 9, NULL),
(69, 'Ancien locataire-Beullet', 1, NULL),
(70, 'Ancien locataire-Dasrot', 1, NULL),
(71, 'Restitution caution-Dasrot', 2, NULL),
(72, 'Restitution caution-Beullet', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_jointe`
--

DROP TABLE IF EXISTS `type_jointe`;
CREATE TABLE IF NOT EXISTS `type_jointe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_jointe`
--

INSERT INTO `type_jointe` (`id`, `libelle`) VALUES
(1, 'Carte nationale d\'identité'),
(2, 'Passeport'),
(3, 'Bulletin de paye'),
(4, 'Garantie visale'),
(5, 'Facture'),
(6, 'Quittance'),
(7, 'Certificat de scolarité');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `roles`, `is_verified`) VALUES
(6, 'Lonardino', 'Mickael', 'mickael@hotmail.com', '$2y$13$DMp9ifF9lfI3qmsnvom86.Vh5/WzTtOphtDRfwDGlyaLcGQ0q49eG', '[\"ROLE_ASSOCIE\"]', 0),
(9, 'super', 'admin', 'superadmin@zays.com', '$2y$13$zhUjkA6VWwa/hNIpxcJQte7b/fRW3GCNKO9DSZpQo5gjX.7DvmMsW', '[\"ROLE_ADMIN\"]', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartement`
--
ALTER TABLE `appartement`
  ADD CONSTRAINT `FK_71A6BD8D63768E3F` FOREIGN KEY (`immeuble_id`) REFERENCES `immeuble` (`id`);

--
-- Contraintes pour la table `appartement_equipement`
--
ALTER TABLE `appartement_equipement`
  ADD CONSTRAINT `FK_EBC624F2806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EBC624F2E1729BBA` FOREIGN KEY (`appartement_id`) REFERENCES `appartement` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `associe`
--
ALTER TABLE `associe`
  ADD CONSTRAINT `FK_235AAA4AFCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`);

--
-- Contraintes pour la table `bail`
--
ALTER TABLE `bail`
  ADD CONSTRAINT `FK_945BC1EC41A218C` FOREIGN KEY (`associe_id`) REFERENCES `associe` (`id`),
  ADD CONSTRAINT `FK_945BC1EE1729BBA` FOREIGN KEY (`appartement_id`) REFERENCES `appartement` (`id`);

--
-- Contraintes pour la table `bail_locataire`
--
ALTER TABLE `bail_locataire`
  ADD CONSTRAINT `FK_EA325C7E3E3F1FE8` FOREIGN KEY (`bail_id`) REFERENCES `bail` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_EA325C7ED8A38199` FOREIGN KEY (`locataire_id`) REFERENCES `locataire` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `FK_B8B4C6F3C40FCFA8` FOREIGN KEY (`piece_id`) REFERENCES `piece` (`id`);

--
-- Contraintes pour la table `immeuble`
--
ALTER TABLE `immeuble`
  ADD CONSTRAINT `FK_467D53F9FCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`);

--
-- Contraintes pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD CONSTRAINT `FK_5B51FC3EA27126E0` FOREIGN KEY (`souscategorie_id`) REFERENCES `sous_categorie` (`id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `FK_B1DC7A1E3E3F1FE8` FOREIGN KEY (`bail_id`) REFERENCES `bail` (`id`),
  ADD CONSTRAINT `FK_B1DC7A1EDBC40344` FOREIGN KEY (`moisannee_id`) REFERENCES `mois_annee` (`id`);

--
-- Contraintes pour la table `piece_jointe`
--
ALTER TABLE `piece_jointe`
  ADD CONSTRAINT `FK_AB5111D470CAF51F` FOREIGN KEY (`typejointe_id`) REFERENCES `type_jointe` (`id`),
  ADD CONSTRAINT `FK_AB5111D4D8A38199` FOREIGN KEY (`locataire_id`) REFERENCES `locataire` (`id`);

--
-- Contraintes pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD CONSTRAINT `FK_52743D7B3E3F1FE8` FOREIGN KEY (`bail_id`) REFERENCES `bail` (`id`),
  ADD CONSTRAINT `FK_52743D7BBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
