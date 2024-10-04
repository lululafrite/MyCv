-- MariaDB dump 10.19  Distrib 10.11.5-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: garage_parrot
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
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_brand`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Marques des voitures';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES
(1,'_'),
(2,'RENAULT'),
(3,'PEUGEOT'),
(4,'CITROEN'),
(5,'DS'),
(6,'ALPINE'),
(7,'WOLKSWAGEN'),
(8,'MERCEDES'),
(9,'BMW'),
(10,'DACIA'),
(11,'OPEL'),
(12,'AUDI');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car` (
  `id_car` int(11) NOT NULL AUTO_INCREMENT,
  `id_brand` int(11) NOT NULL DEFAULT 1,
  `id_model` int(11) NOT NULL DEFAULT 1,
  `id_motorization` int(11) NOT NULL DEFAULT 1,
  `year` year(4) NOT NULL DEFAULT year(curdate()),
  `mileage` int(9) NOT NULL DEFAULT 0,
  `price` int(9) NOT NULL DEFAULT 0,
  `sold` enum('Oui','Non') NOT NULL DEFAULT 'Non',
  `description` text NOT NULL DEFAULT '\'Options et description\'',
  `image1` varchar(255) NOT NULL DEFAULT 'image.webp',
  `image2` varchar(255) NOT NULL DEFAULT 'image.webp',
  `image3` varchar(255) NOT NULL DEFAULT 'image.webp',
  `image4` varchar(255) NOT NULL DEFAULT 'image.webp',
  `image5` varchar(255) NOT NULL DEFAULT 'image.webp',
  PRIMARY KEY (`id_car`),
  KEY `index_car_id_brand` (`id_brand`) USING BTREE,
  KEY `index_car_id_motorization` (`id_motorization`),
  KEY `index_car_id_model` (`id_model`),
  CONSTRAINT `rel_car_id_brand` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_car_id_model` FOREIGN KEY (`id_model`) REFERENCES `model` (`id_model`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rel_car_id_motorization` FOREIGN KEY (`id_motorization`) REFERENCES `motorization` (`id_motorization`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car`
--

LOCK TABLES `car` WRITE;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
INSERT INTO `car` VALUES
(1,7,16,8,2023,3534,39612,'Oui','Options et description','golf_1.png','golf_2.webp','golf_3.webp','golf_4.webp','golf_5.webp'),
(4,3,2,4,2022,58600,22500,'Oui','Véhicule en très bon état, 1ère main.\r\nCT OK \r\nEntretien complet Peugeot ','208_1.png','208_2.png','208_3.png','208_4.png','208_5.png'),
(33,10,24,7,2022,3500,13690,'Oui','Véhicule parfait pour faible budget\r\nProche du neuf\r\nCouleur: bleu électron ','dacia-sandero-stepway_2024-02-17_19_22.png','dacia-sandero-inter1_2024-02-18_10_42.jpg','dacia-sandero-inter2_2024-02-18_10_41.jpg','dacia-sandero-inter3_2024-02-18_10_43.jpg','dacia-sandero-inter4_2024-02-18_10_44.jpg'),
(34,10,25,7,2021,33600,18650,'Oui','Véhicule 1ère main, 7 places, passe partout aussi bien en ville qu\'en montagne.\r\nEntretien complet Dacia\r\nPas de double des clés\r\nCT OK\r\n','dacia_joggerextreme_2024-02-17_19-22.png','dacia_jogger_inter1_2024-02-18_10-39.jpg','dacia_jogger_inter2_2024-02-18_10-40.jpg','dacia_jogger_inter3_2024-02-18_10-41.jpg','dacia_jogger_inter4_2024-02-18_10-42.jpg'),
(35,6,37,8,2023,30000,59000,'Oui','Véhicule sportif (possible usage sur circuit)\r\nTrès peu de kilomètre\r\nEntretien complet Renault ','alpine-A110_2024-02-17_19-20.png','Alpine_A110_inter1_2024-02_18_10_49.webp','Alpine_A110_inter2_2024-02_18_10_50.webp','Alpine_A110_inter3_2024-02_18_10_51.webp','Alpine_A110_inter4_2024-02_18_10_52.webp'),
(36,2,31,11,2022,50000,12000,'Oui','Clio full hybride toutes options. \r\nTrès bon état \r\nPhotos non contractuelles ','renaultcliofullhybride_2024-02-17_19-15.png','renaultcliofullhybride_2024-02-17_19-15.webp','renaultcliofullhybride_2024-02-17_19-16.webp','renaultcliofullhybride_2024-02-17_19-18.webp','renaultcliofullhybride_2024-02-17_19-19.webp'),
(37,9,39,8,2024,5000,120000,'Oui','Véhicule électrique sportif composer d\'un moteur électrique et d\'un faible moteur essence pour le complément.\r\nFaible kilométrage\r\nEntretien complet BMW\r\nCouleur : Rouge\r\n','bmw-i8-protonic-red_2024-02-17-19-21.png','BMW_i8_inter1_2024-02-18-11-00.jpg','BMW_i8_inter2_2024-02-18-11-01.jpg','BMW_i8_inter3_2024-02-18-11-02.jpg','BMW_i8_inter4_2024-02-18-11-03.jpg'),
(38,2,35,6,2013,115230,10990,'Oui','CT OK\r\nEtat correct\r\nEntretien complet Renault\r\nDouble des clés\r\n','renaultcaptur_2024-02-17_11-00.png','renaultcaptur_2024-02-17_11-01.png','renaultcaptur_2024-02-17_11-02.png','renaultcaptur_2024-02-17_11-03.png','renaultcaptur_2024-02-17_11-04.png'),
(39,9,40,2,2021,90000,55000,'Oui','Véhicule compact (citadine) parfait pour la ville.\r\nEntretien complet BMW\r\nCouleur blanc\r\nJante 16\"','bmw_serie_1_2024-02-17-19-09.png','BMW_serie1_inter1_2024_02_18_11_08.jpg','BMW_serie1_inter2_2024_02_18_11_09.jpg','BMW_serie1_inter3_2024_02_18_11_10.jpg','BMW_serie1_inter4_2024_02_18_11_11.jpg'),
(40,2,17,8,2022,33600,55000,'Oui','Voiture électrique très bon marché, puissante et dynamique.\r\nEntretien Renault \r\nContrôle technique moins de 6 mois','Renault-Megane-e-tech_2024-02-17-19-19.png','renault-megane-e-tech-electric-inter1_2024_02_18_11_11.jpg','renault-megane-e-tech-electric-inter2_2024_02_18_11_12.jpg','renault-megane-e-tech-electric-inter3_2024_02_18_11_13.jpg','renault-megane-e-tech-electric-inter4_2024_02_18_11_14.jpg'),
(41,12,8,8,2019,8200,25900,'Oui','Audi A3 pack luxe\r\n\r\nVéhicule proche du neuf !\r\nCT OK\r\nEntretien Audi a jour\r\n\r\nCouleur noir\r\nJante 17\"','AudiA3_2024-02-17_17-57.png','AudiA3_2024-02-17_17-58.webp','AudiA3_2024-02-17_17-59.webp','AudiA3_2024-02-17_18-00.webp','AudiA3_2024-02-17_18-01.webp'),
(42,2,20,11,2024,5000,22000,'Oui','Totalement neuve ! \r\nscenic e-tech 2024 grise presque pas utilisé\r\nToutes options avec toit ouvrant \r\n','renaultscenice-tech_2024-02-17_19-20.png','renaultscenice-tech_2024-02-17_19-20.webp','renaultscenice-tech_2024-02-17_19-21.webp','renaultscenice-tech_2024-02-17_19-23.webp','renaultscenice-tech_2024-02-17_19-24.webp'),
(43,12,27,11,2023,10,59000,'Oui','Véhicule neuf importé\r\nTrès faible kilométrage \r\nCouleur gris nardo\r\n\r\nA saisir\r\n','AudiQ4e-tron_2024-02-17_18-48.jpg','AudiQ4e-tron_2024-02-17_18-49.webp','AudiQ4e-tron_2024-02-17_18-50.webp','AudiQ4e-tron_2024-02-17_18-51.webp','AudiQ4e-tron_2024-02-17_18-58.webp'),
(44,2,22,4,2020,80000,6000,'Oui','Jolie Twingo de 4 ans en très bon état. CT OK.\r\ncouleur : Grise\r\nPhotos non contractuelles','RenaultTwingo_2024-02-17_19-05.png','RenaultTwingo_2024-02-17_19-10.webp','RenaultTwingo_2024-02-17_19-11.webp','RenaultTwingo_2024-02-17_19-12.webp','RenaultTwingo_2024-02-17_19-13.webp'),
(45,4,29,11,2020,67000,23900,'Oui','Véhicule électrique pour un usage quotidien fait pour les petit parcours routier.\r\nEntretien semi complet Citroen\r\nPas de double des clés\r\nCT OK\r\n','Citroen_eC4_2024-02-17_19-27.png','Citroen_eC4_2024-02-17_19-28.webp','Citroen_eC4_2024-02-17_19-29.webp','Citroen_eC4_2024-02-17_19-30.webp','Citroen_eC4_2024-02-17_19-31.webp');
/*!40000 ALTER TABLE `car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `closed_periods`
--

DROP TABLE IF EXISTS `closed_periods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `closed_periods` (
  `id_closed_periods` int(11) NOT NULL AUTO_INCREMENT,
  `closed_periods` varchar(255) NOT NULL DEFAULT 'Nous serons fermé du 29/07/2024 au 19/08/2024',
  PRIMARY KEY (`id_closed_periods`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Période de fermetue';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `closed_periods`
--

LOCK TABLES `closed_periods` WRITE;
/*!40000 ALTER TABLE `closed_periods` DISABLE KEYS */;
INSERT INTO `closed_periods` VALUES
(1,'Nous serons fermés du 29/07/2024 au 19/08/2024');
/*!40000 ALTER TABLE `closed_periods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `date_` date NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `comment` text NOT NULL,
  `publication` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL DEFAULT 'avatar.webp',
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES
(44,'2024-01-02','Patrick92',5,'Top!',1,'_.webp'),
(45,'2024-01-08','Ornella',4,'Accueillant professionnel et honnete. Je recommande!',1,'_.webp'),
(46,'2024-01-15','Cobra',5,'Un passionne de bagnole! Ca fait plaisir!',1,'_.webp');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `energy`
--

DROP TABLE IF EXISTS `energy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `energy` (
  `id_energy` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT 'Energie_du_moteur',
  PRIMARY KEY (`id_energy`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de type d''énergie (essence, diesel, GPL, électrique, .';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `energy`
--

LOCK TABLES `energy` WRITE;
/*!40000 ALTER TABLE `energy` DISABLE KEYS */;
INSERT INTO `energy` VALUES
(1,'_'),
(2,'DIESEL'),
(3,'ELECTRIQUE'),
(4,'ESSENCE'),
(5,'GPL'),
(6,'HYBRIDE'),
(7,'HYDROGENE');
/*!40000 ALTER TABLE `energy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home`
--

DROP TABLE IF EXISTS `home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home` (
  `id_home` int(11) NOT NULL AUTO_INCREMENT,
  `titre1` varchar(255) NOT NULL,
  `titre2` varchar(255) NOT NULL,
  `intro_chapter1` text NOT NULL,
  `intro_chapter2` text NOT NULL,
  `article1_titre` varchar(255) NOT NULL,
  `article1_chapter1` text NOT NULL,
  `article1_image1` varchar(255) NOT NULL,
  `article1_titre2` varchar(255) NOT NULL,
  `article1_chapter2` text NOT NULL,
  `article1_image2` varchar(255) NOT NULL,
  `article2_titre` varchar(255) NOT NULL,
  `article2_chapter1` text NOT NULL,
  `article2_image1` varchar(255) NOT NULL,
  `article2_titre2` varchar(255) NOT NULL,
  `article2_chapter2` text NOT NULL,
  `article2_image2` varchar(255) NOT NULL,
  PRIMARY KEY (`id_home`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home`
--

LOCK TABLES `home` WRITE;
/*!40000 ALTER TABLE `home` DISABLE KEYS */;
INSERT INTO `home` VALUES
(1,'Histoire du Garage et message de Vincent PARROT','Nous garantissons un service de qualité','Fort de mes 15 années d\'expérience dans la réparation de véhicules automobiles. J\'ai ouvert mon propre garage en 2021 à Toulouse, pour proposer des prestations modernes et de qualités. Depuis 3 ans, je propose une large gamme de services en terme de réparation de carrosserie, de mécanique et d\'entretien courant. Ma devise : garantir un travail bien fait pour assurer la longévité des véhicules de mes clients et leur permettre de rouler en toute sécurité. Le succès a été immédiat, c\'est pourquoi je propose à présent des véhicules d\'occasion soigneusement sélectionnés et ainsi satisfaire d\'avantage nos clients.','Je considère mon atelier comme un véritable lieu de confiance pour mes clients. Leurs voitures doivent être entre les mains de professionnels reconnus sur le marché. Ce nouveau site web vous permettra d\'être plus facilement en lien avec nous. Depuis ce site, vous pourrez visualiser tous nos les véhicules d\'occasions actuellement disponibles, mais aussi, prendre rendez-vous pour tous les services que nous proposons (révision, réparation, essai véhicule, ...).\r\nMerci pour votre confiance,','DERNIERES TECHOLOGIES','Nos mécaniciens hautement qualifiés utilisent les dernières technologies pour vous garantir une réparation rapide et efficace. Qu\'il s\'agisse de remplacer des plaquettes de frein ou une courroie, nous mettons tout en œuvre pour minimiser votre temps d\'immobilisation.','machine_technology.jpg','HAUTE EXPÉRIENCE','Notre équipe d\'experts en carrosserie possède une vaste expérience dans la réparation des dégâts de tous types. Que vous ayez besoin d\'une peinture et de retouches ou que votre véhicule ait subi des dégâts plus importants, nous vous garantissons un travail de qualité supérieure.','high_experience.jpg','SÉCURITÉ AVANT TOUT','Offrez à votre véhicule une révision complète chez nous. Que vous ayez besoin d\'une révision annuelle ou sur mesure, nous veillerons à ce que votre véhicule soit toujours en parfait état de marche. Nous croyons en la prévention plutôt que dans la réparation.','cars_security.jpg','CERTIFICATION ET GARANTIE','Votre opinion compte pour nous. Nous apprécions les retours de nos clients et nous utilisons vos avis pour améliorer continuellement nos services. Si vous avez déjà fait affaire avec nous, nous vous invitons à laisser un avis et à partager votre expérience.','qualite.jpg');
/*!40000 ALTER TABLE `home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model` (
  `id_model` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'modèle_voiture',
  `id_brand` int(11) NOT NULL,
  PRIMARY KEY (`id_model`),
  KEY `id_brand` (`id_brand`),
  CONSTRAINT `id_brand` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Modèle de voiture (Scénic, A3, Golf, etc)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model`
--

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` VALUES
(1,'_',1),
(2,'208',3),
(3,'308',3),
(4,'408',3),
(5,'508',3),
(6,'A1',12),
(7,'A2',12),
(8,'A3',12),
(9,'A4',12),
(10,'A6',12),
(11,'A8',12),
(12,'CLASSE A',8),
(13,'CLASSE B',8),
(14,'CLASSE C',8),
(15,'ESPACE',2),
(16,'GOLF',7),
(17,'MEGANE',2),
(18,'PASSAT',7),
(19,'POLO',7),
(20,'SCENIC',2),
(21,'SIROCCO',7),
(22,'TWINGO',2),
(24,'SANDERO',10),
(25,'JOGGER',10),
(27,'Q4 E-TRON',12),
(29,'C4',4),
(31,'CLIO',2),
(33,'MEGANE E-TECH',2),
(35,'CAPTUR',2),
(37,'A110',6),
(39,'i8',12),
(40,'SERIE1',9);
/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorization`
--

DROP TABLE IF EXISTS `motorization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motorization` (
  `id_motorization` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT 'Energie_moteur',
  `id_energy` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_motorization`),
  KEY `index_motorization_id_energy` (`id_energy`),
  CONSTRAINT `rel_motorization_id_energy` FOREIGN KEY (`id_energy`) REFERENCES `energy` (`id_energy`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table de type d''énergie (essence, diesel, GPL, électrique, .';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorization`
--

LOCK TABLES `motorization` WRITE;
/*!40000 ALTER TABLE `motorization` DISABLE KEYS */;
INSERT INTO `motorization` VALUES
(1,'_',1),
(2,'1.6 VTEC 120CH (88kW)',4),
(3,'2.0 TFSI 200CH (147kW)',4),
(4,'1.2 PURE TECH 110CH (81kW)',4),
(5,'2.0 TDI 150CH (110kW)',2),
(6,'1.5 BLUE HDI 130CH (96kW)',2),
(7,'1.6 CRDI 115CH (85kW)',2),
(8,'1.8 SYNERGY DRIVE 220CH (162kW)',6),
(9,'2.0 ATKINSON 250CH (180kW)',6),
(10,'64 kWh EV',3),
(11,'40kWh ELECTRIC',3),
(12,'1.6 ECO-G 115CH (85kW)',5),
(13,'FUEL CELL 150kWh',7);
/*!40000 ALTER TABLE `motorization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedules` (
  `id_schedules` int(11) NOT NULL AUTO_INCREMENT,
  `lundiMatin` varchar(30) NOT NULL DEFAULT '08:00 - 12:00',
  `lundiAM` varchar(30) NOT NULL DEFAULT '14:00 - 18:00',
  `mardiMatin` varchar(30) NOT NULL DEFAULT '08:00 - 12:00',
  `mardiAM` varchar(30) NOT NULL DEFAULT '14:00 - 18:00',
  `mercrediMatin` varchar(30) NOT NULL DEFAULT '08:00 - 12:00',
  `mercrediAM` varchar(30) NOT NULL DEFAULT '14:00 - 18:00',
  `jeudiMatin` varchar(30) NOT NULL DEFAULT '08:00 - 12:00',
  `jeudiAM` varchar(30) NOT NULL DEFAULT '14:00 - 18:00',
  `vendrediMatin` varchar(30) NOT NULL DEFAULT '08:00 - 12:00',
  `vendrediAM` varchar(30) NOT NULL DEFAULT '14:00 - 18:00',
  `samediMatin` varchar(30) NOT NULL DEFAULT '08:00 - 12:00',
  `samediAM` varchar(30) NOT NULL DEFAULT 'Fermè',
  `dimancheMatin` varchar(30) NOT NULL DEFAULT 'Fermè',
  `dimancheAM` varchar(30) NOT NULL DEFAULT 'Fermè',
  PRIMARY KEY (`id_schedules`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='horaires ouverture';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES
(1,'08:00 -12:00','14:00 - 18:00','08:00 -12:00','14:00 - 18:00','08:00 -12:00','14:00 - 18:00','08:00 -12:00','14:00 - 18:00','08:00 -12:00','14:00 - 18:00','08:00 -12:00','Ferme','Ferme','Ferme');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `id_subscription` int(11) NOT NULL AUTO_INCREMENT,
  `subscription` varchar(20) NOT NULL,
  PRIMARY KEY (`id_subscription`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
INSERT INTO `subscription` VALUES
(1,'Actarus'),
(2,'Goldorak'),
(3,'Vénusia');
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
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
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar_membre_white.webp	',
  `id_subscription` int(11) NOT NULL DEFAULT 3,
  `id_type` int(11) NOT NULL DEFAULT 2,
  `pw` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `index_user_id_type` (`id_type`),
  CONSTRAINT `rel_user_id_type` FOREIGN KEY (`id_type`) REFERENCES `user_type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Utilisateur pour la gestion de connexion au site';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'ADMIN','Admin','Admin','admin@gmail.com','0102030405','$2y$10$Eu2g7qbA8I5a2DGPsoZ13OZBpHe5pELDYISthqk1FYW.JTkQgG19S','avatar_admin_black.webp',2,1,'admin123/'),
(2,'USER','User','User','user@gmail.com','0607080910','$2y$10$irfSGt1nAb3s1dFqvCxTeuamP66kvFoXP5KDRAybBXXzgSjRF5rAa','avatar_user.webp',2,3,'User123/'),
(3,'ACTARUS','Actarus','Actarus','actarus@gmail.com','0203040506','$2y$10$AY5n7w0aoCann8g3vW3mGukfjN6mTjlEJ.0GrOpZNU2CrECZkUzHy','avatar_actarus.webp',1,2,'Actarus123/'),
(4,'GOLDORAK','Goldorak','Goldorak','goldorak@gmail.com','0304050607','$2y$10$eFIwsT3LnMuqzeQdJkujqesFGctYIrdpPx8Is2kybY5CcgQfsh2pG','avatar_goldorak_01.webp',2,2,'User123/'),
(5,'VENUSIA','Venusia','Venusia','venusia@gmail.com','0405060708','$2y$10$PqWto4t7hH1RUymgzI2ANelWy.anLMRRtOv2sD8LKWqU1B/K8nzVS','avatar_venusia_01.webp',3,2,'Venusia123/'),
(6,'FOLLACO','Ludovic','Professeur','ludovic.follaco@free.fr','0608818390','$2y$10$FAcGC9iwqgVykFllHp8pmuUGyHkAEqw02fDw1FjgGqJ0kJTDFSCke','professeur_procyon.webp',2,1,'Lud123/*-');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Type utilisateur pour la gestion des droits d''utilisation';
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

-- Dump completed on 2024-10-03 19:18:40
