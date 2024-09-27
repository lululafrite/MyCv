-- MariaDB dump 10.19  Distrib 10.11.5-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mycv
-- ------------------------------------------------------
-- Server version	10.11.5-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `home`
--

DROP TABLE IF EXISTS `home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home` (
  `home_id` int(11) NOT NULL AUTO_INCREMENT,
  `home_title` varchar(150) NOT NULL,
  `home_subtitle` varchar(150) NOT NULL,
  `home_title_page` varchar(150) NOT NULL,
  PRIMARY KEY (`home_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home`
--

LOCK TABLES `home` WRITE;
/*!40000 ALTER TABLE `home` DISABLE KEYS */;
INSERT INTO `home` VALUES
(1,'Ludovic FOLLACO - Conseils & Solutions','Amélioration, Productivité, Efficience','Bienvenue sur ma page d\'accueil');
/*!40000 ALTER TABLE `home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_article`
--

DROP TABLE IF EXISTS `home_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_article` (
  `home_article_id` int(11) NOT NULL AUTO_INCREMENT,
  `home_article_title` varchar(255) NOT NULL,
  `home_article` text NOT NULL,
  `home_article_img` varchar(255) NOT NULL,
  `home_article_img_rightOrLeft` varchar(6) NOT NULL DEFAULT 'right',
  `home_article_img_width` varchar(6) NOT NULL DEFAULT '150px',
  `home_article_img_height` varchar(6) NOT NULL DEFAULT '100%',
  `home_article_img_objectFit` varchar(11) NOT NULL DEFAULT 'cover',
  `home_article_sort` int(11) NOT NULL,
  PRIMARY KEY (`home_article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_article`
--

LOCK TABLES `home_article` WRITE;
/*!40000 ALTER TABLE `home_article` DISABLE KEYS */;
INSERT INTO `home_article` VALUES
(1,'Présentation','Durant mes 35 ans d\'expérience dans l\'industrie des véhicules de transport, j\'ai eu l\'opportunité d\'exercer divers métiers tels que la maintenance, la compétition, le prototypage, les études, la production (unitaire, petite série et série), la qualité, les méthodes, le commerce, la gestion de projet, les achats, le système d\'information, la gestion de centre de profit et chef d\'entreprise. Cette diversité m\'a permis d\'acquérir une expertise complète dans ce secteur et dans le fonctionnement d\'une entreprise.\r\n\r\nMa curiosité et mon intérêt pour les nouvelles technologies m\'ont conduit à maîtriser les systèmes embarqués ainsi que les outils informatiques, puis, d\'accéder aux compétences de développement logiciel pour microcontrôleur et d\'application web, web mobile et bureau. Au-delà de la maîtrise technologique, mes compétences de développeur d\'application de bureau répondaient à des besoins opérationnels en tant que directeur de centre de profit et de chef d\'entreprise. En effet, la productivité et la qualité sont des leviers cruciaux pour toute entreprise.\r\n\r\nPour légitimer et compléter mes compétences de développeur, j\'ai suivi une formation Graduate en développement web et mobile, ainsi qu\'en traitement de base de données. Cette compétence stratégique me permet de proposer une approche globale pour améliorer l\'efficience en interfaçant les différents logiciels de l\'entreprise, réduisant ainsi les interventions humaines sources d\'erreurs et de perte de temps.\r\n\r\nJ\'ai également créé plusieurs systèmes qualité, que ce soit en équipe ou en tant que chef d\'entreprise, ce qui m\'a permis de développer une solide connaissance de la norme ISO 9001 et des systèmes adaptés à la production. J\'ai mis en place des méthodes de travail performantes, intégrées dans ces systèmes, accompagnées de logiciels, de documents et de supports de formation que j\'ai souvent animés.','','right','150px','100%','cover',1),
(2,'CONSEIL :','Fort de ma vision globale de l\'entreprise et de l\'ensemble de mes compétences, cette offre consiste à proposer aux entreprises de les accompagner pour analyser leur fonctionnement, identifier les points d\'amélioration de la productivité, concevoir les solutions adéquates, piloter les développements, améliorer le système qualité, organiser les formations nécessaires, déployer les solutions et assurer le suivi des bonnes pratiques.\r\n\r\nEn tant que consultant doté d\'une expertise reconnue, j\'accompagne les dirigeants dans l\'élaboration de leur stratégie. Je réalise des audits complets sur les processus et procédures de l\'entreprise et propose des solutions d\'amélioration et de productivité, notamment à travers le développement d\'applications web, web mobile et/ou de bureau. Ces solutions ont pour but de favoriser l\'interaction entre les systèmes déjà existants au sein de l\'entreprise.\r\n\r\nMes solutions sont pensées pour s\'intégrer harmonieusement dans le système qualité de l\'entreprise, améliorant ainsi les processus et les procédures. Elles permettent également de créer un système de qualité sur mesure et de faciliter le maintient du système et l\'obtention de certifications, grâce à une organisation intégrée et adaptée aux besoins spécifiques de chaque entreprise.\r\n','roadToSucces.webp','left','150px','100%','cover',2),
(3,'MANAGEMENT DE CENTRE DE PROFIT ET/OU DE PRODUCTION :','Mon expérience de manageur dans différente entreprises mon permis d\'acquérir toutes les compétences nécessaires pour accomplir les fonctions de Manageur de centre de profit et/ou de production entre 1995 et aujourd\'hui :\r\n\r\n- Responsable du service électricité, électronique et câblage au sein de la société FERRY DEVELOPPEMENT dans la laquelle j\'étais actionnaire à parts égales avec trois autres associés.\r\n- Directeur de la Business Unit Prototypes, Système et câblage au sein de la société ENCELADE du GROUPE INGENICA.\r\n- Directeur de la Business Unit Prototypes, Système et câblage au sein de la société METRA de GENARIS GROUP.\r\n- Président fondateur de la société e-nodev proposant un service d\'études, de prototypage et d\'installation de systèmes embarqués et câblages pour l\'industrie des véhicules de transports.\r\nNOTA : Chacune des expériences citées ci-dessus ont été des réussites créées de toutes pièces (clients, offres, équipes, moyens, méthodes, ...).\r\n- Directeur technique et de l\'innovation chez Style Ans Design.','roadToSucces.webp','right','150px','100%','cover',3),
(4,'GESTION DE PROJET :','Fort des expériences citées ci-dessus, j\'ai systématiquement assuré le rôle de chef de projet jusqu\'à ce que les activités étaient suffisantes pour embaucher des chefs de projets.\r\nMéthodes Cascade, Agile, V-Model, Kanban, je n\'ai aucun problème à adapter mon organisation.','roadToSucces.webp','left','150px','100%','cover',4),
(5,'CONCEPTION :','Mon expertise reconnue en mécatronique, systèmes et faisceaux embarqués vous permet d\'accéder à une compétence autonome et polyvalente dans ce domaine. Etudes électriques (schémas de principes et/ou fonctionnels), conception faisceau sur CATIA V5 et le module EHI, architecture systèmes et prototypage rapide avec Arduino.','roadToSucces.webp','right','150px','100%','cover',5),
(6,'DEVELOPPEMENT APPLICATIONS WEB ET WEB MOBILE :','- Frontend : HTML, Javascript, CSS et Bootstrap.\r\n- Backend : PHP et Javascript.\r\n- Base de données : MySQL et MariaDB\r\n- Symfony,\r\n- VS Code, GITHUB, …','roadToSucces.webp','left','150px','100%','cover',6),
(7,'DEVELOPPEMENT APPLICATIONS DE BUREAU :','- C#\r\n- MySQL et MariaDB\r\n- VBA CATIA,\r\n- VBA Excel, Word, MS Project, … ','roadToSucces.webp','right','150px','100%','cover',7);
/*!40000 ALTER TABLE `home_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'NOM',
  `surname` varchar(50) NOT NULL DEFAULT 'Prénom',
  `pseudo` varchar(20) NOT NULL DEFAULT '''pseudo''',
  `email` varchar(255) NOT NULL DEFAULT 'nom.prenom@domaine.com',
  `phone` varchar(18) NOT NULL DEFAULT '## ## ## ## ##',
  `password` varchar(255) NOT NULL DEFAULT 'Mot de passe',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar_membre_white.webp',
  `id_type` int(11) NOT NULL DEFAULT 2,
  `pw` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `index_user_id_type` (`id_type`),
  CONSTRAINT `rel_user_id_type` FOREIGN KEY (`id_type`) REFERENCES `user_type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Utilisateur pour la gestion de connexion au site';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'ADMIN','Admin','Admin','admin@gmail.com','01 02 03 04 05','$2y$10$Eu2g7qbA8I5a2DGPsoZ13OZBpHe5pELDYISthqk1FYW.JTkQgG19S','avatar_admin_black.webp',1,'admin123/');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL DEFAULT 'Guest',
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Type utilisateur pour la gestion des droits d''utilisation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES
(1,'Administrator'),
(2,'Member'),
(3,'User');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-05 16:50:22
