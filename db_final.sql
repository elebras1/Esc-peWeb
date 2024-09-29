-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 13 déc. 2023 à 00:12
-- Version du serveur :  10.5.19-MariaDB-0+deb11u2
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e22206510_db1`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`e22206510sql`@`%` PROCEDURE `updateCompte` (IN `mot_de_passe` VARCHAR(255), IN `compte_id` INT)  BEGIN
    UPDATE t_compte_cpt SET cpt_mot_de_passe = SHA2(CONCAT(mot_de_passe, 's1a2l3t4'), 512) WHERE cpt_id = compte_id;
END$$

--
-- Fonctions
--
CREATE DEFINER=`e22206510sql`@`%` FUNCTION `nbComptes` () RETURNS INT(11) BEGIN
    SET @nb := (SELECT COUNT(*) FROM t_compte_cpt JOIN t_profil_pfl USING(cpt_id));
    RETURN @nb;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_actualite_act`
--

CREATE TABLE `t_actualite_act` (
  `act_id` int(11) NOT NULL,
  `act_titre` varchar(180) NOT NULL,
  `act_description` varchar(400) NOT NULL,
  `act_statut` char(1) NOT NULL,
  `act_date` date NOT NULL,
  `cpt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_actualite_act`
--

INSERT INTO `t_actualite_act` (`act_id`, `act_titre`, `act_description`, `act_statut`, `act_date`, `cpt_id`) VALUES
(1, 'Nouvelle mise à jour du système', 'Nous avons publié une nouvelle mise à jour pour améliorer les performances du système.', 'A', '2023-11-14', 1),
(2, 'Annonce ajout d\'un nouveau scénario', 'Nous sommes ravis de vous annoncer l\'ajout d\'un nouveau scénario.', 'A', '2023-11-14', 2),
(3, 'Changements de politique de confidentialité', 'Nous avons mis à jour notre politique de confidentialité pour mieux protéger vos données.', 'A', '2023-11-14', 3),
(4, 'Modification d\'un scénario', 'Nous sommes ravis de vous annoncer la modification d\'un scénario.', 'A', '2023-11-09', 3),
(5, 'Modification d\'un scénario', 'Nous sommes ravis de vous annoncer la modification d\'un scénario.', 'A', '2023-11-09', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_cpt`
--

CREATE TABLE `t_compte_cpt` (
  `cpt_id` int(11) NOT NULL,
  `cpt_login` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cpt_mot_de_passe` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_id`, `cpt_login`, `cpt_mot_de_passe`) VALUES
(1, 'administrATeur', '59dfeb2a5cefbcd2635a17155572124fa245c6bb7a6bede6e89f1510fbb2f6ea459c5b42b26b077e9d596cc27ad282a9ecb403431456e80023aa55fc0a0b2293'),
(2, 'sophie84', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(3, 'pierre75', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(4, 'marie91', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(5, 'thomas62', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(6, 'camille22', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(40, 'David', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(41, 'bernard', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(46, 'YveNormand', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(48, 'JulieTay', '45ce6cb7e44826bb066a16a6c64bb0d65cadcdedafdae03b1c370aa3136af769b72adb56b6a9ef69f4966b9139d2ea2f780acec2f08ff8b85796c2f3f244d43e'),
(49, 'andreald', '6c990aa86d4ab4d2e7d9f6a0625b90a39574068142a7fa844c790ebd82e62bc2a9cab495ef7c60a75acf07ce2930543e1f2e26e62de3a454871e08d8cc361755');

-- --------------------------------------------------------

--
-- Structure de la table `t_etape_etp`
--

CREATE TABLE `t_etape_etp` (
  `etp_id` int(11) NOT NULL,
  `etp_code` char(8) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `etp_intitule` varchar(180) NOT NULL,
  `etp_description` varchar(380) NOT NULL,
  `etp_question` varchar(280) NOT NULL,
  `etp_reponse` varchar(120) NOT NULL,
  `etp_numero` int(11) NOT NULL,
  `etp_statut` char(1) NOT NULL,
  `rsc_id` int(11) NOT NULL,
  `snr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_etape_etp`
--

INSERT INTO `t_etape_etp` (`etp_id`, `etp_code`, `etp_intitule`, `etp_description`, `etp_question`, `etp_reponse`, `etp_numero`, `etp_statut`, `rsc_id`, `snr_id`) VALUES
(1, '56368102', 'PIB des États-Unis', 'Le graphique montre l\'évolution du pib des États-Unis de 1945 à 2023.', 'Que s\'est-il passé entre 2007 et 2010, pour que le PIB des États-Unis en 2010 soit inférieur à celui de 2007 ?', 'subprimes', 1, 'A', 1, 1),
(2, '27588305', 'Graphique censuré', 'Plusieurs données du Graphique ont été censuré.', 'Quelle est le sujet du graphique ?', 'dix plus grandes économies', 2, 'A', 2, 1),
(3, '23345917', 'Taux de chômage en Europe', 'Le graphique représente le taux de chomage pour chaque pays Europeen en mai 2023.', 'Quelle est le taux moyen de chomage dans l\'UE (10^-1) ?', '5.6', 3, 'A', 3, 1),
(4, '75387411', 'Croissance mondiale', 'Le graphique représente la croissance globale du PIB de plusieurs pays entre 1920 et 1985', 'Quelle est le pays qui a connu la plus forte croissance ?', 'URSS', 4, 'A', 4, 1),
(5, '88092061', 'Industrie en France', 'Entre 1970 et 2020, la France est le pays européen qui s\'est le plus désindustrialisé, avec une perte de 2,5 millions d\'emplois industriels depuis 1974', 'En France quelle est la contribution de l\'industrie dans le PIB (en pourcentages) ?', '12.6', 5, 'A', 5, 1),
(6, '56362102', 'Pourcentage de croyants par pays', 'Le graphique représente le pourcentage de croyants dans chaque pays.', 'Quel est le pays caché par la zone jaune ?', 'Chine', 1, 'A', 6, 2),
(7, '27429305', 'Religions dominantes', 'Ce graphique montre les religions avec le plus de croyants', 'Quelle est la religion floutée ?', 'Hindouisme', 2, 'A', 7, 2),
(8, '49345397', 'Mariages catholiques en France', 'Le graphique présente l\' évolution du nombre de mariages catholiques en France de 2008 à 2020.', 'Quel est le taux d\' évolution global du nombre de mariages catholiques de 2008 à 2020 en France ?', '-377', 3, 'A', 8, 2),
(9, '15382881', 'Densité des lieux de culte par pays', 'Le graphique montre la densité des lieux de culte par pays.', 'Quelle est la région du monde avec la plus forte densité ?', 'Europe', 4, 'A', 9, 2),
(10, '44516333', 'Livre sacré', 'Ce livre a une influence profonde sur la vie de millions de personnes à travers différentes traditions religieuses. Il est source d\' inspiration,\r\n        de guidance, et de réflexion pour ceux qui le suivent.Sa port ée est mondiale,\r\n        et il a joué un rôle clé dans la formation de nombreuses cultures et croyances.', 'Quel est le livre sacré le plus largement lu et suivi dans le monde ?', 'Bible', 5, 'A', 10, 2),
(11, '96546800', 'Taux de croissance de la population mondiale', 'Le graphique montre l\'évolution du taux de croissance de la population mondiale de 1950 à 2020.', 'Quelle décennie a enregistré le taux de croissance le plus élevé ?', '1960', 1, 'A', 11, 3),
(12, '67050563', 'Pyramide des âges', 'Testez vos connaissances sur les pyramides des âges. Les pyramides des âges représentent la distribution de la population par groupes d\'âge.', 'Quelle catégorie d\'âge représente la plus grande proportion de la population dans une pyramide des âges typique(format : 00-00ans) ?', '25-29ans', 2, 'A', 12, 3),
(13, '84336545', 'Migration nette par pays', 'La migration nette est la différence entre le nombre d\'immigrants et d\'émigrants d\'un pays.', 'Quel pays a enregistré le solde migratoire le plus élevé en 2020 ?', 'Canada', 3, 'A', 13, 3),
(14, '13434235', 'Espérance de vie', 'L\'espérance de vie est un indicateur clé de la santé d\'une population.', 'Quelle elle est pays avec la plus longue esperence de vie censuré par un carré jaune ?', 'Japon', 4, 'A', 14, 3),
(15, '06951590', 'Migration vers les États-Unis', 'Les États-Unis ont longtemps été une destination prisée pour les immigrants du monde entier, attirant des personnes en quête de nouvelles opportunités, de sécurité et d\' un meilleur avenir.', 'De quel continent provient la majorité des immigrants aux États-Unis en 2020 ?', 'Asie', 5, 'A', 15, 3),
(16, '78901123', 'Révolution française', 'La Révolution française a été un événement majeur de l\'histoire politique. Elle a débuté en 1789 et a eu un impact durable sur la France et le monde.', 'Quelle déclaration célèbre a été adoptée pendant la Révolution française ?', 'Droits de l\'Homme et du Citoyen', 1, 'A', 16, 4),
(17, '45672234', 'Communisme en Russie', 'Le communisme a été appliqué en Russie après la Révolution d\'Octobre en 1917. Cela a conduit à la création de l\'Union soviétique.', 'Qui était le dirigeant de l\'Union soviétique pendant la majeure partie de la Guerre froide ?', 'Joseph Staline', 2, 'A', 17, 4),
(18, '88995678', 'Apartheid en Afrique du Sud', 'L\'apartheid était un système de ségrégation raciale en Afrique du Sud qui a été en place pendant des décennies.', 'Qui était la figure emblématique de la lutte contre l\'apartheid en Afrique du Sud ?', 'Nelson Mandela', 3, 'A', 18, 4),
(19, '12345679', 'Thatcherisme au Royaume-Uni', 'Le \"thatcherisme\" est associé à la politique de l\'ancienne Première ministre britannique Margaret Thatcher, caractérisée par le néolibéralisme et la déréglementation.', 'Quelle surnom était souvent donné à Margaret Thatcher en raison de sa politique ferme ?', 'La Dame de Fer', 4, 'A', 19, 4),
(20, '98761234', 'Chine communiste sous Xi Jinping', 'La Chine est dirigée par le Parti communiste chinois sous la présidence de Xi Jinping depuis 2013. Son leadership a été marqué par une consolidation du pouvoir et des politiques économiques et géopolitiques significatives.', 'Quelle politique économique mise en place sous Xi Jinping vise à renforcer les relations commerciales et l\'infrastructure à l\'échelle mondiale ?', 'La Route de la Soie', 5, 'A', 20, 4);

--
-- Déclencheurs `t_etape_etp`
--
DELIMITER $$
CREATE TRIGGER `removeIdcOfEtape` BEFORE DELETE ON `t_etape_etp` FOR EACH ROW BEGIN
    DELETE FROM t_indice_idc WHERE etp_id = OLD.etp_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `t_indice_idc`
--

CREATE TABLE `t_indice_idc` (
  `idc_id` int(11) NOT NULL,
  `idc_description` varchar(280) NOT NULL,
  `idc_url` varchar(300) NOT NULL,
  `idc_difficulte` int(1) NOT NULL,
  `etp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_indice_idc`
--

INSERT INTO `t_indice_idc` (`idc_id`, `idc_description`, `idc_url`, `idc_difficulte`, `etp_id`) VALUES
(1, 'La réponse se trouve dans un événement économique majeur des États-Unis entre 2007 et 2010.', 'https://fr.wikipedia.org/wiki/Crise_financi%C3%A8re_de_2007', 1, 1),
(2, 'L\'information est censurée dans le graphique, mais il s\'agit d\'économies mondiales.', 'https://www.lemonde.fr/economie/article/economie_mondiale', 1, 2),
(3, 'La réponse nécessite de calculer la moyenne du taux de chômage de tous les pays de l\'UE en mai 2023.', 'https://www.usinenouvelle.com/cacul_taux_chomage', 1, 3),
(4, 'Lénine est à l\'origine de la formation de ce pays, et le pays en question était une grande puissance.', 'https://fr.wikipedia.org/wiki/Vladimir_L%C3%A9nine', 1, 4),
(5, 'Il s\'agit d\'une statistique économique importante pour la France, exprimée en pourcentage du PIB.', 'https://www.insee.fr/statistiques/4238616.png', 3, 5),
(6, 'La zone jaune cache un pays asiatique aux dimensions impressionnantes.', 'https://fr.wikipedia.org/wiki/Asie', 2, 6),
(7, 'C\'est l\'une des principales religions du monde, originaire de l\'Inde.', 'https://fr.wikipedia.org/wiki/Hindouisme', 1, 7),
(8, 'Le taux d\'évolution est un nombre négatif indiquant une baisse.', 'https://www.insee.fr/statistiques/4788720', 2, 8),
(9, 'L\'indice fait référence à une région géographique bien connue pour sa culture et son histoire religieuse.', 'https://fr.wikipedia.org/wiki/R%C3%A9gion_g%C3%A9ographique', 1, 9),
(10, 'C\'est l\'un des livres religieux les plus lus et influents au monde.', 'https://fr.wikipedia.org/wiki/Livre_religieux', 3, 10),
(11, 'La décennie en question est associée à des changements mondiaux majeurs.', 'https://www.lemonde.fr/decennie_changement', 1, 11),
(12, 'C\'est l\'une des catégories d\'âge généralement la plus active économiquement.', 'https://www.insee.fr/statistiques/2386946', 1, 12),
(13, 'Le pays en question est connu pour son accueil des immigrants et sa diversité.', 'https://www.lemonde.fr/accueil_immigration', 1, 13),
(14, 'La réponse est liée à une nation asiatique connue pour sa cruauté pendant la Seconde Guerre mondiale.', 'https://fr.wikipedia.org/wiki/Seconde_guerre_mondiale', 1, 14),
(15, 'C\'est le continent le plus peuplé du monde, avec une forte croissance démographique.', 'https://fr.wikipedia.org/wiki/Asie', 1, 15),
(16, 'Cette déclaration est un pilier des droits ... en France.', 'https://www.lemonde.fr/droits_pilier', 1, 16),
(17, 'Il était le dirigeant de l\'Union soviétique pendant une période tendue de la Guerre froide.', 'https://fr.wikipedia.org/wiki/Union_sovi%C3%A9tique', 1, 17),
(18, 'Il est largement vénéré pour son rôle dans la fin de l\'apartheid en Afrique du Sud.', 'https://www.lemonde.fr/afrique_sud_apartheid', 1, 18),
(19, 'Le surnom est en rapport avec son leadership fort et sa détermination.', 'https://www.usinenouvelle.com/surnom_fort_determination', 3, 19),
(20, 'La politique vise à développer des infrastructures mondiales pour renforcer les relations commerciales.', 'https://fr.wikipedia.org/wiki/Chine', 3, 20);

-- --------------------------------------------------------

--
-- Structure de la table `t_participant_ptp`
--

CREATE TABLE `t_participant_ptp` (
  `ptp_id` int(11) NOT NULL,
  `ptp_email` varchar(200) NOT NULL,
  `ptp_nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_participant_ptp`
--

INSERT INTO `t_participant_ptp` (`ptp_id`, `ptp_email`, `ptp_nom`) VALUES
(1, 'johnwick@gmail.com', 'John Wick'),
(2, 'jane_doe@gmail.com', 'Jane Doe'),
(3, 'robert_smith@yahoo.com', 'Robert Smith'),
(4, 'emily_johnson@hotmail.com', 'Emily Johnson'),
(5, 'michael_brown@gmail.com', 'Michael Brown'),
(6, 'susan_williams@gmail.com', 'Susan Williams'),
(7, 'david_jones@yahoo.com', 'David Jones'),
(8, 'laura_anderson@hotmail.com', 'Laura Anderson'),
(9, 'william_smith@gmail.com', 'William Smith'),
(10, 'olivia_davis@gmail.com', 'Olivia Davis'),
(11, 'erwan@gmail.com', 'erwansqdqs'),
(12, 'testerwan@gmail.com', 'ErwanTest'),
(13, 'yve@gmaaail.com', 'YVE'),
(14, 'yve@gmaail.com', 'YVE');

-- --------------------------------------------------------

--
-- Structure de la table `t_partie_prt`
--

CREATE TABLE `t_partie_prt` (
  `ptp_id` int(11) NOT NULL,
  `snr_id` int(11) NOT NULL,
  `prt_date_premiere_reussite` datetime NOT NULL,
  `prt_date_derniere_reussite` datetime NOT NULL,
  `prt_niveau` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_partie_prt`
--

INSERT INTO `t_partie_prt` (`ptp_id`, `snr_id`, `prt_date_premiere_reussite`, `prt_date_derniere_reussite`, `prt_niveau`) VALUES
(1, 2, '2023-02-14 00:00:00', '2023-07-22 00:00:00', 3),
(1, 3, '2021-01-05 00:00:00', '2022-04-07 00:00:00', 1),
(2, 3, '2020-10-10 00:00:00', '2021-11-28 00:00:00', 3),
(2, 4, '2022-08-06 00:00:00', '2022-08-06 00:00:00', 2),
(3, 1, '2020-12-01 00:00:00', '2021-09-05 00:00:00', 3),
(3, 2, '2022-03-24 00:00:00', '2023-01-14 00:00:00', 2),
(4, 1, '2021-03-12 00:00:00', '2022-06-22 00:00:00', 1),
(5, 1, '2023-03-18 00:00:00', '2023-03-18 00:00:00', 1),
(5, 4, '2021-11-30 00:00:00', '2022-12-15 00:00:00', 3),
(6, 2, '2022-07-19 00:00:00', '2023-08-29 00:00:00', 2),
(6, 4, '2021-10-19 00:00:00', '2023-04-25 00:00:00', 2),
(7, 2, '2021-08-15 00:00:00', '2023-05-02 00:00:00', 2),
(7, 3, '2022-01-08 00:00:00', '2022-10-17 00:00:00', 1),
(8, 1, '2021-07-30 00:00:00', '2022-06-09 00:00:00', 3),
(8, 3, '2022-04-07 00:00:00', '2023-09-12 00:00:00', 1),
(9, 3, '2021-06-11 00:00:00', '2022-09-30 00:00:00', 1),
(9, 4, '2021-05-25 00:00:00', '2022-11-10 00:00:00', 1),
(10, 1, '2022-09-22 00:00:00', '2022-09-22 00:00:00', 3),
(10, 2, '2023-08-28 00:00:00', '2023-08-28 00:00:00', 2),
(10, 4, '2023-09-04 00:00:00', '2023-09-24 00:00:00', 1),
(11, 1, '2023-12-12 13:58:30', '2023-12-12 13:58:30', 1),
(11, 2, '2023-12-12 15:58:44', '2023-12-12 15:58:44', 1),
(11, 4, '2023-12-12 16:10:03', '2023-12-12 16:10:03', 1),
(12, 1, '2023-12-12 14:00:17', '2023-12-12 14:00:17', 1),
(13, 1, '2023-12-12 15:43:59', '2023-12-12 15:43:59', 1),
(14, 1, '2023-12-12 15:45:34', '2023-12-12 15:45:34', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_profil_pfl`
--

CREATE TABLE `t_profil_pfl` (
  `cpt_id` int(11) NOT NULL,
  `pfl_nom` varchar(80) NOT NULL,
  `pfl_prenom` varchar(80) NOT NULL,
  `pfl_email` varchar(200) NOT NULL,
  `pfl_date_inscription` date NOT NULL,
  `pfl_role` char(1) NOT NULL,
  `pfl_validite` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_profil_pfl`
--

INSERT INTO `t_profil_pfl` (`cpt_id`, `pfl_nom`, `pfl_prenom`, `pfl_email`, `pfl_date_inscription`, `pfl_role`, `pfl_validite`) VALUES
(1, 'Le Bras', 'Erwan', 'erwan.lebras27@gmail.com', '2023-11-14', 'A', 'A'),
(2, 'De Martine', 'Sophie', 'sophie.martin@example.com', '2023-11-14', 'O', 'A'),
(3, 'Durand', 'Pierre', 'pierre.durand@example.com', '2023-11-14', 'O', 'A'),
(4, 'Lefebvre', 'Marie', 'marie.lefebvre@example.com', '2023-11-14', 'O', 'A'),
(5, 'Dupuis', 'Thomas', 'thomas.dupuis@example.com', '2023-11-14', 'O', 'A'),
(6, 'Riquier', 'Camille', 'Camille.Riquier@example.com', '2023-11-14', 'O', 'D'),
(40, 'Br\'an', 'David', 'david@gmail.com', '2023-11-17', 'O', 'D'),
(41, 'Floc\'h grand', 'Bernard', 'bernard@gmail.com', '2023-11-17', 'O', 'D'),
(46, 'Normand\'e', 'Yve', 'yve@gmail.com', '2023-12-01', 'O', 'D'),
(48, 'Tay\'mond', 'Julie', 'julie@gmail.com', '2023-12-01', 'O', 'A'),
(49, 'ld\'ç', 'andréa', 'testd@gmail.com', '2023-12-12', 'O', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `t_ressource_rsc`
--

CREATE TABLE `t_ressource_rsc` (
  `rsc_id` int(11) NOT NULL,
  `rsc_type` char(1) NOT NULL,
  `rsc_url` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_ressource_rsc`
--

INSERT INTO `t_ressource_rsc` (`rsc_id`, `rsc_type`, `rsc_url`) VALUES
(1, 'I', 'usa_pib.png'),
(2, 'I', 'pays_economie.png'),
(3, 'I', 'chomage_europe.png'),
(4, 'I', 'croissance_mondiale.png'),
(5, 'I', 'industrie_france.png'),
(6, 'I', 'croyant_pays.png'),
(7, 'I', 'religion_dominante.png'),
(8, 'I', 'mariage_catholique.png'),
(9, 'I', 'lieux_culte.png'),
(10, 'I', 'livre_sacre.png'),
(11, 'I', 'croissance_population.png'),
(12, 'I', 'pyramide_age.png'),
(13, 'I', 'migration_nette.png'),
(14, 'I', 'esperance_vie.png'),
(15, 'I', 'migration_usa.png'),
(16, 'I', 'revolution_france.jpg'),
(17, 'I', 'russie_communisme.png'),
(18, 'I', 'apartheid.png'),
(19, 'I', 'thatcherisme.png'),
(20, 'I', 'chine_xi_jinping.png');

-- --------------------------------------------------------

--
-- Structure de la table `t_scenario_snr`
--

CREATE TABLE `t_scenario_snr` (
  `snr_id` int(11) NOT NULL,
  `snr_code` char(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `snr_intitule` varchar(180) NOT NULL,
  `snr_description` varchar(380) NOT NULL,
  `snr_image` varchar(300) NOT NULL,
  `snr_statut` char(1) NOT NULL,
  `cpt_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `t_scenario_snr`
--

INSERT INTO `t_scenario_snr` (`snr_id`, `snr_code`, `snr_intitule`, `snr_description`, `snr_image`, `snr_statut`, `cpt_id`) VALUES
(1, '2007409174', 'Économie mondiale', 'Partez à la découverte des données économiques mondiales en jouant à ce scénario.', 'economie.jpg', 'A', 2),
(2, '6162246796', 'Pratiques religieuses', 'Partez à la découverte d\'une multitude de données sur les pratiques religieuses en jouant à ce scénario.', 'religion.png', 'A', 4),
(3, '8080078732', 'Données démographiques', 'Partez à la découverte des données démographiques en jouant à ce scénario.', 'demographie.jpg', 'A', 2),
(4, '4790995685', 'Idéologie politiques', 'Partez à la découverte des données sur les idéologie politiques appliqué dans le monde en jouant à ce scénario.', 'politique.jpg', 'A', 5),
(5, '279019C685', 'Crise climatique', 'Crise climatique description', 'crise_climatique.jpg', 'A', 40),
(13, '1PRgxnjZyb', 'France', 'La France (Écouter), en forme longue depuis 1875 la République française (Écouter), est un État souverain transcontinental dont le territoire métropolitain s\'étend en Europe de l\'Ouest et dont le territoire ultramarin s\'étend dans les océans Indien, Atlantique et Pacifique, ainsi qu\'en Antarctique8 et en Amérique du Sud.', 'Flag_of_France.png', 'D', 2);

--
-- Déclencheurs `t_scenario_snr`
--
DELIMITER $$
CREATE TRIGGER `removeEtpPrtOfScenario` BEFORE DELETE ON `t_scenario_snr` FOR EACH ROW BEGIN
    DELETE FROM t_partie_prt WHERE snr_id = OLD.snr_id;
    DELETE FROM t_etape_etp WHERE snr_id = OLD.snr_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_etape_indice`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_etape_indice` (
`etp_id` int(11)
,`etp_code` char(8)
,`etp_intitule` varchar(180)
,`etp_description` varchar(380)
,`etp_question` varchar(280)
,`etp_reponse` varchar(120)
,`etp_numero` int(11)
,`etp_statut` char(1)
,`rsc_id` int(11)
,`snr_id` int(11)
,`idc_id` int(11)
,`idc_description` varchar(280)
,`idc_url` varchar(300)
,`idc_difficulte` int(1)
);

-- --------------------------------------------------------

--
-- Structure de la vue `v_etape_indice`
--
DROP TABLE IF EXISTS `v_etape_indice`;

CREATE ALGORITHM=UNDEFINED DEFINER=`e22206510sql`@`%` SQL SECURITY DEFINER VIEW `v_etape_indice`  AS SELECT `t_etape_etp`.`etp_id` AS `etp_id`, `t_etape_etp`.`etp_code` AS `etp_code`, `t_etape_etp`.`etp_intitule` AS `etp_intitule`, `t_etape_etp`.`etp_description` AS `etp_description`, `t_etape_etp`.`etp_question` AS `etp_question`, `t_etape_etp`.`etp_reponse` AS `etp_reponse`, `t_etape_etp`.`etp_numero` AS `etp_numero`, `t_etape_etp`.`etp_statut` AS `etp_statut`, `t_etape_etp`.`rsc_id` AS `rsc_id`, `t_etape_etp`.`snr_id` AS `snr_id`, `t_indice_idc`.`idc_id` AS `idc_id`, `t_indice_idc`.`idc_description` AS `idc_description`, `t_indice_idc`.`idc_url` AS `idc_url`, `t_indice_idc`.`idc_difficulte` AS `idc_difficulte` FROM (`t_etape_etp` join `t_indice_idc` on(`t_etape_etp`.`etp_id` = `t_indice_idc`.`etp_id`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `fk_actualite_compte` (`cpt_id`);

--
-- Index pour la table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  ADD PRIMARY KEY (`cpt_id`),
  ADD UNIQUE KEY `cpt_login_UNIQUE` (`cpt_login`);

--
-- Index pour la table `t_etape_etp`
--
ALTER TABLE `t_etape_etp`
  ADD PRIMARY KEY (`etp_id`),
  ADD UNIQUE KEY `etp_code_UNIQUE` (`etp_code`),
  ADD KEY `fk_etape_scenario` (`snr_id`),
  ADD KEY `fk_etape_ressource` (`rsc_id`);

--
-- Index pour la table `t_indice_idc`
--
ALTER TABLE `t_indice_idc`
  ADD PRIMARY KEY (`idc_id`),
  ADD KEY `fk_indice_etape` (`etp_id`);

--
-- Index pour la table `t_participant_ptp`
--
ALTER TABLE `t_participant_ptp`
  ADD PRIMARY KEY (`ptp_id`),
  ADD UNIQUE KEY `ptp_email_UNIQUE` (`ptp_email`);

--
-- Index pour la table `t_partie_prt`
--
ALTER TABLE `t_partie_prt`
  ADD PRIMARY KEY (`ptp_id`,`snr_id`),
  ADD KEY `fk_t_partie_prt_t_scenario_snr1_idx` (`snr_id`);

--
-- Index pour la table `t_profil_pfl`
--
ALTER TABLE `t_profil_pfl`
  ADD PRIMARY KEY (`cpt_id`),
  ADD KEY `fk_t_profil_pfl_t_compte_cpt1_idx` (`cpt_id`);

--
-- Index pour la table `t_ressource_rsc`
--
ALTER TABLE `t_ressource_rsc`
  ADD PRIMARY KEY (`rsc_id`);

--
-- Index pour la table `t_scenario_snr`
--
ALTER TABLE `t_scenario_snr`
  ADD PRIMARY KEY (`snr_id`),
  ADD UNIQUE KEY `snr_code_UNIQUE` (`snr_code`),
  ADD KEY `fk_scenario_compte` (`cpt_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  MODIFY `cpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `t_etape_etp`
--
ALTER TABLE `t_etape_etp`
  MODIFY `etp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `t_indice_idc`
--
ALTER TABLE `t_indice_idc`
  MODIFY `idc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `t_participant_ptp`
--
ALTER TABLE `t_participant_ptp`
  MODIFY `ptp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `t_ressource_rsc`
--
ALTER TABLE `t_ressource_rsc`
  MODIFY `rsc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `t_scenario_snr`
--
ALTER TABLE `t_scenario_snr`
  MODIFY `snr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_actualite_act`
--
ALTER TABLE `t_actualite_act`
  ADD CONSTRAINT `fk_actualite_compte` FOREIGN KEY (`cpt_id`) REFERENCES `t_compte_cpt` (`cpt_id`);

--
-- Contraintes pour la table `t_etape_etp`
--
ALTER TABLE `t_etape_etp`
  ADD CONSTRAINT `fk_etape_ressource` FOREIGN KEY (`rsc_id`) REFERENCES `t_ressource_rsc` (`rsc_id`),
  ADD CONSTRAINT `fk_etape_scenario` FOREIGN KEY (`snr_id`) REFERENCES `t_scenario_snr` (`snr_id`);

--
-- Contraintes pour la table `t_indice_idc`
--
ALTER TABLE `t_indice_idc`
  ADD CONSTRAINT `fk_indice_etape` FOREIGN KEY (`etp_id`) REFERENCES `t_etape_etp` (`etp_id`);

--
-- Contraintes pour la table `t_partie_prt`
--
ALTER TABLE `t_partie_prt`
  ADD CONSTRAINT `fk_partie_participant` FOREIGN KEY (`ptp_id`) REFERENCES `t_participant_ptp` (`ptp_id`),
  ADD CONSTRAINT `fk_t_partie_prt_t_scenario_snr1` FOREIGN KEY (`snr_id`) REFERENCES `t_scenario_snr` (`snr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_profil_pfl`
--
ALTER TABLE `t_profil_pfl`
  ADD CONSTRAINT `fk_t_profil_pfl_t_compte_cpt1` FOREIGN KEY (`cpt_id`) REFERENCES `t_compte_cpt` (`cpt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_scenario_snr`
--
ALTER TABLE `t_scenario_snr`
  ADD CONSTRAINT `fk_scenario_compte` FOREIGN KEY (`cpt_id`) REFERENCES `t_compte_cpt` (`cpt_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
