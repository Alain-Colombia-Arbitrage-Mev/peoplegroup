-- MariaDB dump 10.17  Distrib 10.5.4-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: oxigenoglobal.com    Database: oxigenoglobal_red
-- ------------------------------------------------------
-- Server version	10.2.32-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','alexinter16@gmail.com','$2y$10$1S3PHUOj2Uiw15FLaKbQOejqpPJMoZ9xwiGD/je5/onbknYAB3ovy','a1UjTJn4T5xKsv4NlI6q3UeVSNIz5KZyvom8OGiadwq698i7D5nQW1hJsmRI',NULL,'2020-05-15 15:58:30'),(2,'oxigenoglobal','dawinos@gmail.com','$2y$10$1S3PHUOj2Uiw15FLaKbQOejqpPJMoZ9xwiGD/je5/onbknYAB3ovy','RUdPC7Xx0UZPBnWbn7zKqYVzy5ZLdWBiyT6bcc1lIpw4UZxBTkWPAxtCO9ji',NULL,'2020-05-15 16:08:32');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `charge_commisions`
--

DROP TABLE IF EXISTS `charge_commisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `charge_commisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transfer_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdraw_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level1_bonus` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level2_bonus` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level3_bonus` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level4_bonus` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level5_bonus` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level1_consu` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level2_consu` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level3_consu` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level4_consu` decimal(5,2) unsigned NOT NULL DEFAULT 0.00,
  `level5_consu` decimal(5,2) NOT NULL DEFAULT 0.00,
  `rest_bonus_for` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '0-Siguiente-Compresion-Dinamica, 1-Admin',
  `update_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_commision_tree` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charge_commisions`
--

LOCK TABLES `charge_commisions` WRITE;
/*!40000 ALTER TABLE `charge_commisions` DISABLE KEYS */;
INSERT INTO `charge_commisions` VALUES (1,'5','5',5.00,4.00,4.00,7.00,80.00,15.00,9.00,4.00,7.00,65.00,0,NULL,NULL,'<font size=\"4\"><b>Bienvenid@ a Oxígeno Global,</b></font><div><font size=\"4\"><b><br></b></font><div><span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\">Para disfrutar de los beneficios y ganancias de la red por favor compra uno de nuestros planes</span><font size=\"4\"><b><br></b></font></div></div>',NULL,'2020-05-15 15:47:54');
/*!40000 ALTER TABLE `charge_commisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crypto_transactions`
--

DROP TABLE IF EXISTS `crypto_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crypto_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `wallet_from` varchar(255) NOT NULL,
  `wallet_to` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(14,2) DEFAULT 0.00,
  `transaction_id_from` int(11) DEFAULT 0,
  `transaction_id_to` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0 COMMENT '0-Generada, 1-En cola, 2-Procesada OK',
  `try` int(11) DEFAULT 0,
  `confirmation_date` datetime DEFAULT NULL,
  `confirmation_trans` varchar(255) DEFAULT '',
  `confirmation_json` longtext DEFAULT NULL,
  `confirmation_message` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crypto_transactions`
--

LOCK TABLES `crypto_transactions` WRITE;
/*!40000 ALTER TABLE `crypto_transactions` DISABLE KEYS */;
INSERT INTO `crypto_transactions` VALUES (1,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP1025993702',200.00,2,3,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:32','2020-05-19 17:04:32'),(2,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP1025993702',10.00,4,5,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:32','2020-05-19 17:04:32'),(3,3,1,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Compra de Membresía Plan semilla #DP1901875123',100.00,6,7,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(4,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Compra de Membresía Plan semilla #DP1901875123',15.00,8,9,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(5,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Costo Compra de Membresía Plan semilla #DP1901875123 usuario1',22.00,10,11,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(6,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Utilidad Compra de Membresía Plan semilla #DP1901875123 usuario1',22.00,12,13,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(7,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario1 Nivel 1',2.05,14,15,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(8,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario1 Nivel 2',1.64,16,17,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(9,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario1 Nivel 3',1.64,18,19,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(10,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario1 Nivel 4',2.87,20,21,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(11,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario1 Nivel 5',32.80,22,23,0,0,NULL,'',NULL,NULL,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(12,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP28505690',200.00,25,26,0,0,NULL,'',NULL,NULL,'2020-05-19 17:10:30','2020-05-19 17:10:30'),(13,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP28505690',10.00,27,28,0,0,NULL,'',NULL,NULL,'2020-05-19 17:10:30','2020-05-19 17:10:30'),(14,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP793921840',200.00,30,31,0,0,NULL,'',NULL,NULL,'2020-05-19 17:10:31','2020-05-19 17:10:31'),(15,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP793921840',10.00,32,33,0,0,NULL,'',NULL,NULL,'2020-05-19 17:10:31','2020-05-19 17:10:31'),(16,4,1,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Compra de Membresía Plan semilla #DP2031123280',100.00,34,35,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:02','2020-05-19 17:13:02'),(17,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Compra de Membresía Plan semilla #DP2031123280',15.00,36,37,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:02','2020-05-19 17:13:02'),(18,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Costo Compra de Membresía Plan semilla #DP2031123280 usuario2',22.00,38,39,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:02','2020-05-19 17:13:02'),(19,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Utilidad Compra de Membresía Plan semilla #DP2031123280 usuario2',22.00,40,41,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:02','2020-05-19 17:13:02'),(20,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario2 Nivel 1',2.05,42,43,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:03','2020-05-19 17:13:03'),(21,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario2 Nivel 2',1.64,44,45,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:03','2020-05-19 17:13:03'),(22,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario2 Nivel 3',1.64,46,47,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:03','2020-05-19 17:13:03'),(23,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario2 Nivel 4',2.87,48,49,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:03','2020-05-19 17:13:03'),(24,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario2 Nivel 5',32.80,50,51,0,0,NULL,'',NULL,NULL,'2020-05-19 17:13:03','2020-05-19 17:13:03'),(25,1,5,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP273926253',100.00,53,54,0,0,NULL,'',NULL,NULL,'2020-05-19 17:20:34','2020-05-19 17:20:34'),(26,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP273926253',5.00,55,56,0,0,NULL,'',NULL,NULL,'2020-05-19 17:20:34','2020-05-19 17:20:34'),(27,5,1,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Compra de Membresía Plan semilla #DP273119718',100.00,57,58,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(28,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Compra de Membresía Plan semilla #DP273119718',15.00,59,60,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(29,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Costo Compra de Membresía Plan semilla #DP273119718 usuario3',22.00,61,62,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(30,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Utilidad Compra de Membresía Plan semilla #DP273119718 usuario3',22.00,63,64,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(31,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 1',2.05,65,66,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(32,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 2',1.64,67,68,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(33,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 3',1.64,69,70,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(34,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 4',2.87,71,72,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(35,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 5',32.80,73,74,0,0,NULL,'',NULL,NULL,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(36,1,5,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP1829631754',460.00,76,77,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:40','2020-05-19 17:24:40'),(37,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP1829631754',23.00,78,79,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:40','2020-05-19 17:24:40'),(38,5,1,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Actualización de membresía a Plan Sembrador #DP596096955',450.00,80,81,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(39,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Actualización de membresía a Plan Sembrador #DP596096955',67.50,82,83,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(40,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Costo Actualización de membresía a Plan Sembrador #DP596096955 usuario3',66.00,84,85,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(41,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Utilidad Actualización de membresía a Plan Sembrador #DP596096955 usuario3',99.00,86,87,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(42,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 1',10.88,88,89,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(43,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 2',8.70,90,91,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(44,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 3',8.70,92,93,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(45,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 4',15.23,94,95,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(46,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 5',173.99,96,97,0,0,NULL,'',NULL,NULL,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(47,1,6,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP2064413243',600.00,99,100,0,0,NULL,'',NULL,NULL,'2020-05-19 17:35:17','2020-05-19 17:35:17'),(48,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP2064413243',30.00,101,102,0,0,NULL,'',NULL,NULL,'2020-05-19 17:35:17','2020-05-19 17:35:17'),(49,6,1,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Compra de Membresía Plan Sembrador #DP682438755',550.00,103,104,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(50,1,5,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Compra de Membresía Plan Sembrador #DP682438755',82.50,105,106,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(51,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Costo Compra de Membresía Plan Sembrador #DP682438755 usuario4',88.00,107,108,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(52,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Utilidad Compra de Membresía Plan Sembrador #DP682438755 usuario4',121.00,109,110,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(53,1,5,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario4 Nivel 1',12.93,111,112,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(54,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario4 Nivel 2',10.34,113,114,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(55,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario4 Nivel 3',10.34,115,116,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(56,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario4 Nivel 4',18.10,117,118,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(57,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario4 Nivel 5',206.79,119,120,0,0,NULL,'',NULL,NULL,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(58,3,1,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Transferencia de fondos usuario1 a usuario4 #TF1214457324',10.50,121,122,0,0,NULL,'',NULL,NULL,'2020-05-19 17:43:24','2020-05-19 17:43:24'),(59,1,6,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Transferencia de fondos para usuario1 #TF1214457324',10.00,123,124,0,0,NULL,'',NULL,NULL,'2020-05-19 17:43:24','2020-05-19 17:43:24'),(60,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo - Transferencia de fondos enviados ( 10 USD ) de usuario1 a usuario4 #TF1214457324',0.50,125,126,0,0,NULL,'',NULL,NULL,'2020-05-19 17:43:24','2020-05-19 17:43:24'),(61,1,5,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP2066576041',200.00,128,129,0,0,NULL,'',NULL,NULL,'2020-05-19 18:01:05','2020-05-19 18:01:05'),(62,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP2066576041',10.00,130,131,0,0,NULL,'',NULL,NULL,'2020-05-19 18:01:05','2020-05-19 18:01:05'),(63,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP555840602',100.00,133,134,0,0,NULL,'',NULL,NULL,'2020-05-19 18:04:17','2020-05-19 18:04:17'),(64,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP555840602',5.00,135,136,0,0,NULL,'',NULL,NULL,'2020-05-19 18:04:17','2020-05-19 18:04:17'),(65,1,5,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP258872393',200.00,138,139,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:14','2020-05-19 18:07:14'),(66,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP258872393',10.00,140,141,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:14','2020-05-19 18:07:14'),(67,5,1,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Actualización de membresía a Plan Cosecha #DP1288182837',450.00,142,143,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(68,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Actualización de membresía a Plan Cosecha #DP1288182837',67.50,144,145,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(69,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Costo Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',88.00,146,147,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(70,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Utilidad Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',99.00,148,149,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(71,1,4,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 1',9.78,150,151,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(72,1,3,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 2',7.82,152,153,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(73,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 3',7.82,154,155,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(74,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 4',13.69,156,157,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(75,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Bono Unilevel Ingreso usuario usuario3 Nivel 5',156.39,158,159,0,0,NULL,'',NULL,NULL,'2020-05-19 18:07:32','2020-05-19 18:07:32'),(76,1,7,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO','Desembolso DEPOSITO #DP1472591629',10000.00,161,162,0,0,NULL,'',NULL,NULL,'2020-05-28 14:40:54','2020-05-28 14:40:54'),(77,1,2,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D','Desembolso Cargo DEPOSITO #DP1472591629',500.00,163,164,0,0,NULL,'',NULL,NULL,'2020-05-28 14:40:54','2020-05-28 14:40:54');
/*!40000 ALTER TABLE `crypto_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gateway_id` int(11) NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 - Pendiente, 1 - Confirmada, 9 - Descartar',
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcam` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `try` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `detail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aproved_by` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usd_amount` decimal(14,2) DEFAULT 0.00,
  `trx_charge` decimal(14,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
INSERT INTO `deposits` VALUES (1,3,9,200.00,'1','DP1668713404',NULL,NULL,'0','si',0,'2020-05-19 22:04:08','2020-05-19 22:04:32',200.00,10.00),(2,4,9,200.00,'1','DP294533382',NULL,NULL,'0','s',0,'2020-05-19 22:09:10','2020-05-19 22:10:30',200.00,10.00),(3,5,9,100.00,'1','DP1205534602',NULL,NULL,'0','s',0,'2020-05-19 22:19:36','2020-05-19 22:20:34',100.00,5.00),(4,5,9,460.00,'1','DP491959117',NULL,NULL,'0','5',0,'2020-05-19 22:24:16','2020-05-19 22:24:40',460.00,23.00),(5,6,9,600.00,'1','DP1668414971',NULL,NULL,'0','5',0,'2020-05-19 22:34:15','2020-05-19 22:35:17',600.00,30.00),(6,5,9,200.00,'1','DP1883627428',NULL,NULL,'0','3',0,'2020-05-19 23:00:49','2020-05-19 23:01:05',200.00,10.00),(7,3,9,100.00,'1','DP1207955581',NULL,NULL,'0','2',0,'2020-05-19 23:03:21','2020-05-19 23:04:17',100.00,5.00),(8,5,9,200.00,'1','DP1213198867',NULL,NULL,'0','2',0,'2020-05-19 23:06:34','2020-05-19 23:07:14',200.00,10.00),(9,7,9,10000.00,'1','DP169242759',NULL,NULL,'0','yeah',0,'2020-05-28 19:29:54','2020-05-28 19:40:54',10000.00,500.00);
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gateways`
--

DROP TABLE IF EXISTS `gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateimg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minamo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maxamo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargefx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargepc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `val1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gateways`
--

LOCK TABLES `gateways` WRITE;
/*!40000 ALTER TABLE `gateways` DISABLE KEYS */;
INSERT INTO `gateways` VALUES (9,'Efectivo','5eb28a738c72d.jpg','50','10000','0','5','1','La transacción será aprobada por el administrador de la plataforma cuando el dinero sea recibido',NULL,NULL,1,NULL,'2020-05-06 09:59:15');
/*!40000 ALTER TABLE `gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gateways_copy`
--

DROP TABLE IF EXISTS `gateways_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gateways_copy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateimg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minamo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maxamo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargefx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargepc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `val1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gateways_copy`
--

LOCK TABLES `gateways_copy` WRITE;
/*!40000 ALTER TABLE `gateways_copy` DISABLE KEYS */;
INSERT INTO `gateways_copy` VALUES (1,'PayPal','5a7ed13a7d0d3.png','10','10000','2','2.5','80','rexrifat636@gmail.com',NULL,NULL,1,NULL,'2018-02-11 05:56:35'),(2,'Perfect Money','5a7ed14857f6d.png','10','20000','3','1','80','U5376900','G079qn4Q7XATZBqyoCkBteGRg',NULL,0,NULL,'2020-01-24 17:53:40'),(3,'BlockChain','5a70961c5783f.png','10','20000','0.01','0.5','675410.98','YOUR API KEY FROM BLOCKCHAIN.INFO','YOUR XPUB FROM BLOCKCHAIN.INFO',NULL,0,NULL,'2020-01-24 17:53:49'),(4,'Stripe','5a7ed16c4cf99.png','10','50000','5','2.5','80','sk_test_aat3tzBCCXXBkS4sxY3M8A1B','pk_test_AU3G7doZ1sbdpJLj0NaozPBu',NULL,1,NULL,'2018-02-12 01:30:47'),(5,'Skrill','5a70963c08257.jpg','10','50000','3','3','81','merchant@skrill','TheSoftKing',NULL,1,NULL,'2018-02-11 04:11:45'),(6,'Coingate','5a709647b797a.jpg','10','50000','3','3','83.30','1257','8wbQIWcXyRu1AHiJqtEhTY','Hr7LqFM83aJsZgbIVkoUW2Q4cGvlB05n',0,NULL,'2020-01-24 17:54:05'),(7,'Coin Payment','5a709659027e1.jpg','0','0','0','0','675410.98','db1d9f12444e65c921604e289a281c56',NULL,NULL,0,NULL,'2020-01-24 17:54:13'),(8,'Block IO','5a70966f55b80.jpg','0','10000','0','10','675410.98','7e13-0ee0-161c-882e','101201101201',NULL,0,'2018-01-27 12:00:00','2020-01-24 17:54:21');
/*!40000 ALTER TABLE `gateways_copy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generals`
--

DROP TABLE IF EXISTS `generals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `generals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `web_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(191) NOT NULL DEFAULT 0,
  `about_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about_video_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_map_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `smsapi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailver` int(1) NOT NULL,
  `smsver` int(1) NOT NULL,
  `emessage` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `esender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_nfy` int(1) DEFAULT 0,
  `sms_nfy` int(1) NOT NULL DEFAULT 0,
  `first_level_com` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_level_com` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_level_com` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_level_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sec_level_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_level_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generals`
--

LOCK TABLES `generals` WRITE;
/*!40000 ALTER TABLE `generals` DISABLE KEYS */;
INSERT INTO `generals` VALUES (1,'Oxígeno Global','USD','USD','<span style=\"color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 12px; text-align: center;\">W3Schools is optimized for learning, testing, and training. Examples might be simplified to improve reading and basic understanding. Tutorials, references, and examples are constantly reviewed to avoid errors, but we cannot warrant full correctness of all content. While using this site, you agree to have read and accepted our&nbsp;</span><a href=\"https://www.w3schools.com/about/about_copyright.asp\" style=\"box-sizing: inherit; background-color: rgb(255, 255, 255); color: inherit; font-family: Verdana, sans-serif; font-size: 12px; text-align: center;\">terms of use</a><span style=\"color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 12px; text-align: center;\">,&nbsp;</span><a href=\"https://www.w3schools.com/about/about_privacy.asp\" style=\"box-sizing: inherit; background-color: rgb(255, 255, 255); color: inherit; font-family: Verdana, sans-serif; font-size: 12px; text-align: center;\">cookie and privacy policy</a><span style=\"color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 12px; text-align: center;\">.&nbsp;</span><a href=\"https://www.w3schools.com/about/about_copyright.asp\" style=\"box-sizing: inherit; background-color: rgb(255, 255, 255); color: inherit; font-family: Verdana, sans-serif; font-size: 12px; text-align: center;\">Copyright 1999-2018</a><span style=\"color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 12px; text-align: center;\">&nbsp;by Refsnes Data. All Rights Reserved.</span>','info@oxigenoglobal.com','',0,'','1522587150.jpg','AEC800',NULL,'2020-05-15 21:56:16','','2020 © Oxígeno Global','','','','','','2018-02-01','https://api.clockworksms.com/http/send.aspx',1,1,'<div style=\"text-align: center;\"><img src=\"https://i.imgur.com/CYYMPS3.png\" width=\"150\"><b><br></b></div><div style=\"text-align: center;\"><b><br></b></div><div style=\"text-align: center;\"><b>Hola {{name}},</b><br></div><div style=\"text-align: center;\"><br></div><div></div><div style=\"text-align: center;\">{{message}}</div><div style=\"text-align: center;\"><br></div><div style=\"text-align: center;\">Gracias, El equipo de Oxígeno Global<br></div><div><br></div>','notificaciones@oxigenoglobal.com','f6f7f7',1,0,'0','0','0','0','0','0');
/*!40000 ALTER TABLE `generals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incomes`
--

DROP TABLE IF EXISTS `incomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incomes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- Bono rapido, 2- Unilevel, 3-Consumo, 4-Solidario',
  `status` tinyint(4) DEFAULT 0 COMMENT '0 - Pendiente debe realizar consumo mínimo, 1 - Pagado, 2 - Pérdida de bono por no realizar consumo',
  `transaction_id` int(11) DEFAULT 0,
  `payment_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`),
  KEY `user_id_type` (`user_id`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incomes`
--

LOCK TABLES `incomes` WRITE;
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
INSERT INTO `incomes` VALUES (1,2,15.00,'Bono Rápido Compra de Membresía Plan semilla #DP1901875123 usuario1',1,1,9,'2020-05-19 17:04:50','2020-05-19 22:04:50','2020-05-19 22:04:50'),(2,2,2.05,'Bono Unilevel Compra de Membresía Plan semilla #DP1901875123 usuario1 Nivel 1',2,1,15,'2020-05-19 17:04:50','2020-05-19 22:04:50','2020-05-19 22:04:50'),(3,2,1.64,'Bono Unilevel Compra de Membresía Plan semilla #DP1901875123 usuario1 Nivel 2',2,1,17,'2020-05-19 17:04:50','2020-05-19 22:04:50','2020-05-19 22:04:50'),(4,2,1.64,'Bono Unilevel Compra de Membresía Plan semilla #DP1901875123 usuario1 Nivel 3',2,1,19,'2020-05-19 17:04:50','2020-05-19 22:04:50','2020-05-19 22:04:50'),(5,2,2.87,'Bono Unilevel Compra de Membresía Plan semilla #DP1901875123 usuario1 Nivel 4',2,1,21,'2020-05-19 17:04:50','2020-05-19 22:04:50','2020-05-19 22:04:50'),(6,2,32.80,'Bono Unilevel Compra de Membresía Plan semilla #DP1901875123 usuario1 Nivel 5',2,1,23,'2020-05-19 17:04:50','2020-05-19 22:04:50','2020-05-19 22:04:50'),(7,3,15.00,'Bono Rápido Compra de Membresía Plan semilla #DP2031123280 usuario2',1,1,37,'2020-05-19 17:13:02','2020-05-19 22:13:02','2020-05-19 22:13:02'),(8,3,2.05,'Bono Unilevel Compra de Membresía Plan semilla #DP2031123280 usuario2 Nivel 1',2,1,43,'2020-05-19 17:13:03','2020-05-19 22:13:03','2020-05-19 22:13:03'),(9,2,1.64,'Bono Unilevel Compra de Membresía Plan semilla #DP2031123280 usuario2 Nivel 2',2,1,45,'2020-05-19 17:13:03','2020-05-19 22:13:03','2020-05-19 22:13:03'),(10,2,1.64,'Bono Unilevel Compra de Membresía Plan semilla #DP2031123280 usuario2 Nivel 3',2,1,47,'2020-05-19 17:13:03','2020-05-19 22:13:03','2020-05-19 22:13:03'),(11,2,2.87,'Bono Unilevel Compra de Membresía Plan semilla #DP2031123280 usuario2 Nivel 4',2,1,49,'2020-05-19 17:13:03','2020-05-19 22:13:03','2020-05-19 22:13:03'),(12,2,32.80,'Bono Unilevel Compra de Membresía Plan semilla #DP2031123280 usuario2 Nivel 5',2,1,51,'2020-05-19 17:13:03','2020-05-19 22:13:03','2020-05-19 22:13:03'),(13,4,15.00,'Bono Rápido Compra de Membresía Plan semilla #DP273119718 usuario3',1,1,60,'2020-05-19 17:21:20','2020-05-19 22:21:20','2020-05-19 22:21:20'),(14,4,2.05,'Bono Unilevel Compra de Membresía Plan semilla #DP273119718 usuario3 Nivel 1',2,1,66,'2020-05-19 17:21:20','2020-05-19 22:21:20','2020-05-19 22:21:20'),(15,3,1.64,'Bono Unilevel Compra de Membresía Plan semilla #DP273119718 usuario3 Nivel 2',2,1,68,'2020-05-19 17:21:20','2020-05-19 22:21:20','2020-05-19 22:21:20'),(16,2,1.64,'Bono Unilevel Compra de Membresía Plan semilla #DP273119718 usuario3 Nivel 3',2,1,70,'2020-05-19 17:21:20','2020-05-19 22:21:20','2020-05-19 22:21:20'),(17,2,2.87,'Bono Unilevel Compra de Membresía Plan semilla #DP273119718 usuario3 Nivel 4',2,1,72,'2020-05-19 17:21:20','2020-05-19 22:21:20','2020-05-19 22:21:20'),(18,2,32.80,'Bono Unilevel Compra de Membresía Plan semilla #DP273119718 usuario3 Nivel 5',2,1,74,'2020-05-19 17:21:20','2020-05-19 22:21:20','2020-05-19 22:21:20'),(19,4,67.50,'Bono Rápido Actualización de membresía a Plan Sembrador #DP596096955 usuario3',1,1,83,'2020-05-19 17:24:56','2020-05-19 22:24:56','2020-05-19 22:24:56'),(20,4,10.88,'Bono Unilevel Actualización de membresía a Plan Sembrador #DP596096955 usuario3 Nivel 1',2,1,89,'2020-05-19 17:24:56','2020-05-19 22:24:56','2020-05-19 22:24:56'),(21,3,8.70,'Bono Unilevel Actualización de membresía a Plan Sembrador #DP596096955 usuario3 Nivel 2',2,1,91,'2020-05-19 17:24:56','2020-05-19 22:24:56','2020-05-19 22:24:56'),(22,2,8.70,'Bono Unilevel Actualización de membresía a Plan Sembrador #DP596096955 usuario3 Nivel 3',2,1,93,'2020-05-19 17:24:56','2020-05-19 22:24:56','2020-05-19 22:24:56'),(23,2,15.23,'Bono Unilevel Actualización de membresía a Plan Sembrador #DP596096955 usuario3 Nivel 4',2,1,95,'2020-05-19 17:24:56','2020-05-19 22:24:56','2020-05-19 22:24:56'),(24,2,173.99,'Bono Unilevel Actualización de membresía a Plan Sembrador #DP596096955 usuario3 Nivel 5',2,1,97,'2020-05-19 17:24:56','2020-05-19 22:24:56','2020-05-19 22:24:56'),(25,5,82.50,'Bono Rápido Compra de Membresía Plan Sembrador #DP682438755 usuario4',1,1,106,'2020-05-19 17:37:16','2020-05-19 22:37:16','2020-05-19 22:37:16'),(26,5,12.93,'Bono Unilevel Compra de Membresía Plan Sembrador #DP682438755 usuario4 Nivel 1',2,1,112,'2020-05-19 17:37:16','2020-05-19 22:37:16','2020-05-19 22:37:16'),(27,4,10.34,'Bono Unilevel Compra de Membresía Plan Sembrador #DP682438755 usuario4 Nivel 2',2,1,114,'2020-05-19 17:37:16','2020-05-19 22:37:16','2020-05-19 22:37:16'),(28,3,10.34,'Bono Unilevel Compra de Membresía Plan Sembrador #DP682438755 usuario4 Nivel 3',2,1,116,'2020-05-19 17:37:16','2020-05-19 22:37:16','2020-05-19 22:37:16'),(29,2,18.10,'Bono Unilevel Compra de Membresía Plan Sembrador #DP682438755 usuario4 Nivel 4',2,1,118,'2020-05-19 17:37:16','2020-05-19 22:37:16','2020-05-19 22:37:16'),(30,2,206.79,'Bono Unilevel Compra de Membresía Plan Sembrador #DP682438755 usuario4 Nivel 5',2,1,120,'2020-05-19 17:37:16','2020-05-19 22:37:16','2020-05-19 22:37:16'),(31,4,67.50,'Bono Rápido Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',1,1,145,'2020-05-19 18:07:32','2020-05-19 23:07:32','2020-05-19 23:07:32'),(32,4,9.78,'Bono Unilevel Actualización de membresía a Plan Cosecha #DP1288182837 usuario3 Nivel 1',2,1,151,'2020-05-19 18:07:32','2020-05-19 23:07:32','2020-05-19 23:07:32'),(33,3,7.82,'Bono Unilevel Actualización de membresía a Plan Cosecha #DP1288182837 usuario3 Nivel 2',2,1,153,'2020-05-19 18:07:32','2020-05-19 23:07:32','2020-05-19 23:07:32'),(34,2,7.82,'Bono Unilevel Actualización de membresía a Plan Cosecha #DP1288182837 usuario3 Nivel 3',2,1,155,'2020-05-19 18:07:32','2020-05-19 23:07:32','2020-05-19 23:07:32'),(35,2,13.69,'Bono Unilevel Actualización de membresía a Plan Cosecha #DP1288182837 usuario3 Nivel 4',2,1,157,'2020-05-19 18:07:32','2020-05-19 23:07:32','2020-05-19 23:07:32'),(36,2,156.39,'Bono Unilevel Actualización de membresía a Plan Cosecha #DP1288182837 usuario3 Nivel 5',2,1,159,'2020-05-19 18:07:32','2020-05-19 23:07:32','2020-05-19 23:07:32');
/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_active`
--

DROP TABLE IF EXISTS `membership_active`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_active` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `membership_id` int(11) NOT NULL DEFAULT 0,
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `finish_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation_transaction_id` int(11) DEFAULT 0,
  `activation_order_id` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_active`
--

LOCK TABLES `membership_active` WRITE;
/*!40000 ALTER TABLE `membership_active` DISABLE KEYS */;
INSERT INTO `membership_active` VALUES (1,3,1,'2020-05-19 00:00:00','2020-06-18 00:00:00',6,0,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(2,4,1,'2020-05-19 00:00:00','2020-06-18 00:00:00',34,0,'2020-05-19 17:13:02','2020-05-19 17:13:02'),(3,5,1,'2020-05-19 00:00:00','2020-06-18 00:00:00',57,0,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(4,5,2,'2020-05-19 00:00:00','2020-06-18 00:00:00',80,0,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(5,6,2,'2020-05-19 00:00:00','2020-06-18 00:00:00',103,0,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(6,5,3,'2020-05-19 00:00:00','2020-06-18 00:00:00',142,0,'2020-05-19 18:07:32','2020-05-19 18:07:32');
/*!40000 ALTER TABLE `membership_active` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_history`
--

DROP TABLE IF EXISTS `membership_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `amount` decimal(14,2) DEFAULT 0.00,
  `cost` decimal(14,2) DEFAULT 0.00,
  `utility_for_admin` decimal(14,2) DEFAULT 0.00,
  `utility_for_network` decimal(14,2) DEFAULT NULL,
  `residue` decimal(14,2) DEFAULT 0.00,
  `status` tinyint(4) DEFAULT 0,
  `is_upgrade` tinyint(1) DEFAULT 0,
  `activation_transaction_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_history`
--

LOCK TABLES `membership_history` WRITE;
/*!40000 ALTER TABLE `membership_history` DISABLE KEYS */;
INSERT INTO `membership_history` VALUES (1,3,1,100.00,22.00,22.00,41.00,0.00,1,0,6,'2020-05-19 17:04:50','2020-05-19 17:04:50'),(2,4,1,100.00,22.00,22.00,41.00,0.00,1,0,34,'2020-05-19 17:13:02','2020-05-19 17:13:03'),(3,5,1,100.00,22.00,22.00,41.00,0.00,1,0,57,'2020-05-19 17:21:20','2020-05-19 17:21:20'),(4,5,2,450.00,66.00,99.00,217.50,0.00,1,1,80,'2020-05-19 17:24:56','2020-05-19 17:24:56'),(5,6,2,550.00,88.00,121.00,258.50,0.00,1,0,103,'2020-05-19 17:37:16','2020-05-19 17:37:16'),(6,5,3,450.00,88.00,99.00,195.50,0.00,1,1,142,'2020-05-19 18:07:32','2020-05-19 18:07:32');
/*!40000 ALTER TABLE `membership_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tittle` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `max_level` tinyint(4) NOT NULL DEFAULT 3,
  `cost` decimal(14,2) NOT NULL DEFAULT 0.00,
  `utility_perc` decimal(5,2) NOT NULL DEFAULT 0.00,
  `price` decimal(14,2) NOT NULL DEFAULT 0.00,
  `quick_bonus_per` decimal(5,2) NOT NULL DEFAULT 0.00,
  `days_for_upgrade` tinyint(4) NOT NULL DEFAULT 8,
  `days_for_consu` tinyint(4) unsigned NOT NULL DEFAULT 1,
  `unilevel_perc` decimal(5,2) DEFAULT 0.00,
  `binary_perc` decimal(5,2) DEFAULT 0.00,
  `matrix_perc` decimal(5,2) DEFAULT 0.00,
  `capitalization_perc` decimal(5,2) DEFAULT 0.00,
  `product_id` int(11) DEFAULT 0,
  `product_qty` int(11) DEFAULT 1,
  `level1_bonus` decimal(10,2) DEFAULT NULL,
  `level2_bonus` decimal(10,2) DEFAULT NULL,
  `level3_bonus` decimal(10,2) DEFAULT NULL,
  `level4_bonus` decimal(10,2) DEFAULT NULL,
  `level5_bonus` decimal(10,2) DEFAULT NULL,
  `level1_consu` decimal(10,2) DEFAULT NULL,
  `level2_consu` decimal(10,2) DEFAULT NULL,
  `level3_consu` decimal(10,2) DEFAULT NULL,
  `level4_consu` decimal(10,2) DEFAULT NULL,
  `level5_consu` decimal(10,2) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,'Plan semilla','<div><br>                                            </div><div>Paquete de inicio y en el plan de ganancias accede a: bono de Rápido y bono Unilevel hasta el 3 nivel.</div><br><div><b>Nota:</b> Sin limite de referidos Directos.&nbsp; Podrá hacer Actualización del plan durante los primeros 8 días conservando el valor pagado inicial, pasado este tiempo, deberá cancelar el valor total del Plan. <br></div><div><br></div><div>Para acceder a las ganancias de los bonos deberá estar activo en su donación mensual.\r\n                                            </div>',3,22.00,22.00,100.00,15.00,8,8,100.00,0.00,0.00,0.00,1,1,5.00,4.00,4.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'5eb28c646b81b.jpg',1,NULL,'2020-05-13 13:41:49'),(2,'Plan Sembrador','<div><br>                                            </div><div>Paquete intermedio y en el plan de ganancias accede a: bono de Ingreso, bono Unilevel hasta el 4 nivel, Bono por consumo mensual hasta el 4 nivel.</div><br><div><b>Nota:</b> Sin limite de referidos Directos. Podrá hacer Actualización del plan durante los primeros 8 días conservando el valor pagado inicial, pasado este tiempo, deberá cancelar el valor total del Plan</div><div><br></div>Para acceder a las ganancias de los bonos deberá estar activo en su donación mensual.',4,88.00,22.00,550.00,15.00,8,8,100.00,0.00,0.00,0.00,1,4,5.00,4.00,4.00,7.00,0.00,15.00,9.00,4.00,7.00,NULL,'5eb28c889d40c.jpg',1,NULL,'2020-05-13 20:44:32'),(3,'Plan Cosecha','<div><br>                                            </div><div>Paquete de inicio mayor y en el plan de ganancias accede a: bono de Ingreso, bono Unilevel hasta el 5 nivel, Bono Consumo mensual hasta el 5 nivel,&nbsp; Bono Solidario. Además inicia calificaciones para los Bono Liderazgo y Bono Directivo.</div><div> <b><br></b></div><div><b>Nota: </b>Sin limite de referidos Directos. <br></div><div><br></div><div>Para acceder a las ganancias de los bonos deberá estar activo en su donación mensual.\r\n                                            </div>',5,176.00,22.00,1000.00,15.00,0,8,100.00,0.00,0.00,0.00,1,8,5.00,4.00,4.00,7.00,80.00,15.00,9.00,4.00,7.00,65.00,'5eb28c79628c0.jpg',1,NULL,'2020-05-16 01:56:30');
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_02_01_114204_create_admins_table',1),(4,'2018_02_01_114205_create_admin_password_resets_table',1),(5,'2017_12_18_061348_create_menus_table',2),(6,'2017_12_18_082712_create_logos_table',2),(7,'2017_12_18_092133_create_silders_table',2),(8,'2017_12_18_104142_create_services_table',2),(9,'2017_12_19_043718_create_testimonals_table',2),(10,'2017_12_19_063256_create_socials_table',2),(11,'2017_12_19_074614_create_footers_table',2),(12,'2018_01_25_220231_create_teams_table',2),(13,'2018_01_28_071556_create_contact_uses_table',2),(14,'2017_12_02_061213_create_generals_table',3),(15,'2018_02_05_064723_create_terms_policies_table',3),(16,'2018_02_05_070947_create_charge_commisions_table',3),(19,'2014_10_12_000000_create_users_table',4),(21,'2018_01_30_154801_create_tickets_table',6),(22,'2018_01_30_155004_create_ticket_comments_table',6),(23,'2017_12_28_072948_create_gateways_table',7),(25,'2017_12_28_105104_create_deposits_table',8),(27,'2018_02_11_062847_create_withdraws_table',9),(29,'2018_02_11_141223_create_withdraw_trasections_table',10),(30,'2018_02_12_062428_create_transactions_table',11),(31,'2018_02_18_102350_create_socials_table',12),(32,'2018_02_18_125849_create_member_belows_table',13),(33,'2018_02_18_135728_create_member_extras_table',14),(34,'2018_02_28_070550_create_incomes_table',15),(35,'2018_03_13_100618_create_packages_table',16),(36,'2018_03_13_124905_create_lending_logs_table',17),(37,'2018_03_31_084105_create_newletters_table',18),(38,'2018_03_31_100325_create_news_table',19);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `price` decimal(14,2) DEFAULT NULL,
  `cost` decimal(14,2) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(14,2) DEFAULT 0.00,
  `price2` decimal(14,2) DEFAULT 0.00,
  `price3` decimal(14,2) DEFAULT 0.00,
  `cost` decimal(14,2) DEFAULT 0.00,
  `status` tinyint(1) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'AQUAVIE PACA X 20 UNDS',NULL,15.00,0.00,0.00,7.42,1,'aquavie.png','2020-05-08 00:00:00','2020-05-08 00:00:00');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_comments`
--

DROP TABLE IF EXISTS `ticket_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_comments`
--

LOCK TABLES `ticket_comments` WRITE;
/*!40000 ALTER TABLE `ticket_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 - Abierto, 2 - Contestado, 3 - Respuesta de usuario, 9 - Cerrado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `trans_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(14,2) NOT NULL DEFAULT 0.00,
  `charge` decimal(14,2) NOT NULL DEFAULT 0.00,
  `new_balance` decimal(14,2) NOT NULL DEFAULT 0.00,
  `type` int(4) NOT NULL DEFAULT 0,
  `model_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` int(10) unsigned DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`),
  KEY `model` (`model_ref`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES 
(1,
1,
'86191121',
'2020-05-19 17:04:32',
'Ingreso de fondos DEPOSITO #DP1025993702',
210.00,
0.00,
210.00,
15,
'Deposit',
1,
'2020-05-19 22:04:32',
'2020-05-19 22:04:32')


,(2,1,'901514141','2020-05-19 17:04:32','Desembolso DEPOSITO #DP1025993702',-200.00,0.00,10.00,16,'Deposit',1,'2020-05-19 22:04:32','2020-05-19 22:04:32'),(3,3,'1120764901','2020-05-19 17:04:32','DEPOSITO #DP1025993702',200.00,10.00,200.00,1,'Deposit',1,'2020-05-19 22:04:32','2020-05-19 22:04:32'),(4,1,'1219701652','2020-05-19 17:04:32','Desembolso Cargo DEPOSITO #DP1025993702',-10.00,0.00,0.00,16,'Deposit',1,'2020-05-19 22:04:32','2020-05-19 22:04:32'),(5,2,'897690637','2020-05-19 17:04:32','Ingreso por Cargo DEPOSITO #DP1025993702',10.00,0.00,10.00,10,'Deposit',1,'2020-05-19 22:04:32','2020-05-19 22:04:32'),(6,3,'1946921509','2020-05-19 17:04:50','Compra de Membresía Plan semilla #DP1901875123',-100.00,0.00,100.00,2,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(7,1,'807145058','2020-05-19 17:04:50','Ingreso de fondos Compra de Membresía Plan semilla #DP1901875123 usuario1',100.00,0.00,100.00,15,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(8,1,'2074096718','2020-05-19 17:04:50','Desembolso a admin Bono Rápido Compra de Membresía Plan semilla #DP1901875123 usuario1',-15.00,0.00,85.00,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(9,2,'1946009102','2020-05-19 17:04:50','Bono Rápido Compra de Membresía Plan semilla #DP1901875123 usuario1',15.00,0.00,25.00,4,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(10,1,'1424738222','2020-05-19 17:04:50','Desembolso a Admin Costo Compra de Membresía Plan semilla #DP1901875123',-22.00,0.00,63.00,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(11,2,'1629653090','2020-05-19 17:04:50','Ingreso por Costo Compra de Membresía Plan semilla #DP1901875123 usuario1',22.00,0.00,47.00,13,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(12,1,'889633950','2020-05-19 17:04:50','Desembolso a Admin Utilidad Compra de Membresía Plan semilla #DP1901875123',-22.00,0.00,41.00,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(13,2,'500757139','2020-05-19 17:04:50','Ingreso por Utilidad Compra de Membresía Plan semilla #DP1901875123 usuario1',22.00,0.00,69.00,17,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(14,1,'1107864515','2020-05-19 17:04:50','Desembolso a admin Bono Unilevel Ingreso usuario usuario1 Nivel 1',-2.05,0.00,38.95,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(15,2,'1733575415','2020-05-19 17:04:50','Bono Unilevel Ingreso usuario usuario1 Nivel 1',2.05,0.00,71.05,5,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(16,1,'1394431459','2020-05-19 17:04:50','Desembolso a admin Bono Unilevel Ingreso usuario usuario1 Nivel 2',-1.64,0.00,37.31,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(17,2,'606934268','2020-05-19 17:04:50','Bono Unilevel Ingreso usuario usuario1 Nivel 2',1.64,0.00,72.69,5,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(18,1,'1036025238','2020-05-19 17:04:50','Desembolso a admin Bono Unilevel Ingreso usuario usuario1 Nivel 3',-1.64,0.00,35.67,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(19,2,'190658365','2020-05-19 17:04:50','Bono Unilevel Ingreso usuario usuario1 Nivel 3',1.64,0.00,74.33,5,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(20,1,'1661303053','2020-05-19 17:04:50','Desembolso a admin Bono Unilevel Ingreso usuario usuario1 Nivel 4',-2.87,0.00,32.80,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(21,2,'368567020','2020-05-19 17:04:50','Bono Unilevel Ingreso usuario usuario1 Nivel 4',2.87,0.00,77.20,5,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(22,1,'712228340','2020-05-19 17:04:50','Desembolso a admin Bono Unilevel Ingreso usuario usuario1 Nivel 5',-32.80,0.00,0.00,16,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(23,2,'886044114','2020-05-19 17:04:50','Bono Unilevel Ingreso usuario usuario1 Nivel 5',32.80,0.00,110.00,5,'MembershipHistory',1,'2020-05-19 22:04:50','2020-05-19 22:04:50'),(24,1,'627075634','2020-05-19 17:10:30','Ingreso de fondos DEPOSITO #DP28505690',210.00,0.00,210.00,15,'Deposit',2,'2020-05-19 22:10:30','2020-05-19 22:10:30'),(25,1,'1416247675','2020-05-19 17:10:30','Desembolso DEPOSITO #DP28505690',-200.00,0.00,10.00,16,'Deposit',2,'2020-05-19 22:10:30','2020-05-19 22:10:30'),(26,4,'548137898','2020-05-19 17:10:30','DEPOSITO #DP28505690',200.00,10.00,200.00,1,'Deposit',2,'2020-05-19 22:10:30','2020-05-19 22:10:30'),(27,1,'1427226332','2020-05-19 17:10:30','Desembolso Cargo DEPOSITO #DP28505690',-10.00,0.00,0.00,16,'Deposit',2,'2020-05-19 22:10:30','2020-05-19 22:10:30'),(28,2,'238274987','2020-05-19 17:10:30','Ingreso por Cargo DEPOSITO #DP28505690',10.00,0.00,120.00,10,'Deposit',2,'2020-05-19 22:10:30','2020-05-19 22:10:30'),(29,1,'1590161308','2020-05-19 17:10:31','Ingreso de fondos DEPOSITO #DP793921840',210.00,0.00,210.00,15,'Deposit',2,'2020-05-19 22:10:31','2020-05-19 22:10:31'),(30,1,'282122090','2020-05-19 17:10:31','Desembolso DEPOSITO #DP793921840',-200.00,0.00,10.00,16,'Deposit',2,'2020-05-19 22:10:31','2020-05-19 22:10:31'),(31,4,'979896362','2020-05-19 17:10:31','DEPOSITO #DP793921840',200.00,10.00,400.00,1,'Deposit',2,'2020-05-19 22:10:31','2020-05-19 22:10:31'),(32,1,'780223002','2020-05-19 17:10:31','Desembolso Cargo DEPOSITO #DP793921840',-10.00,0.00,0.00,16,'Deposit',2,'2020-05-19 22:10:31','2020-05-19 22:10:31'),(33,2,'212779258','2020-05-19 17:10:31','Ingreso por Cargo DEPOSITO #DP793921840',10.00,0.00,130.00,10,'Deposit',2,'2020-05-19 22:10:31','2020-05-19 22:10:31'),(34,4,'998803084','2020-05-19 17:13:02','Compra de Membresía Plan semilla #DP2031123280',-100.00,0.00,300.00,2,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(35,1,'287011953','2020-05-19 17:13:02','Ingreso de fondos Compra de Membresía Plan semilla #DP2031123280 usuario2',100.00,0.00,100.00,15,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(36,1,'328340901','2020-05-19 17:13:02','Desembolso a usuario1 Bono Rápido Compra de Membresía Plan semilla #DP2031123280 usuario2',-15.00,0.00,85.00,16,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(37,3,'1504567108','2020-05-19 17:13:02','Bono Rápido Compra de Membresía Plan semilla #DP2031123280 usuario2',15.00,0.00,115.00,4,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(38,1,'1312981464','2020-05-19 17:13:02','Desembolso a Admin Costo Compra de Membresía Plan semilla #DP2031123280',-22.00,0.00,63.00,16,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(39,2,'596984175','2020-05-19 17:13:02','Ingreso por Costo Compra de Membresía Plan semilla #DP2031123280 usuario2',22.00,0.00,152.00,13,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(40,1,'1034444138','2020-05-19 17:13:02','Desembolso a Admin Utilidad Compra de Membresía Plan semilla #DP2031123280',-22.00,0.00,41.00,16,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(41,2,'764883064','2020-05-19 17:13:02','Ingreso por Utilidad Compra de Membresía Plan semilla #DP2031123280 usuario2',22.00,0.00,174.00,17,'MembershipHistory',2,'2020-05-19 22:13:02','2020-05-19 22:13:02'),(42,1,'1333800884','2020-05-19 17:13:03','Desembolso a usuario1 Bono Unilevel Ingreso usuario usuario2 Nivel 1',-2.05,0.00,38.95,16,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(43,3,'1502842217','2020-05-19 17:13:03','Bono Unilevel Ingreso usuario usuario2 Nivel 1',2.05,0.00,117.05,5,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(44,1,'1174307236','2020-05-19 17:13:03','Desembolso a admin Bono Unilevel Ingreso usuario usuario2 Nivel 2',-1.64,0.00,37.31,16,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(45,2,'1701366621','2020-05-19 17:13:03','Bono Unilevel Ingreso usuario usuario2 Nivel 2',1.64,0.00,175.64,5,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(46,1,'1901064124','2020-05-19 17:13:03','Desembolso a admin Bono Unilevel Ingreso usuario usuario2 Nivel 3',-1.64,0.00,35.67,16,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(47,2,'596502048','2020-05-19 17:13:03','Bono Unilevel Ingreso usuario usuario2 Nivel 3',1.64,0.00,177.28,5,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(48,1,'1364728504','2020-05-19 17:13:03','Desembolso a admin Bono Unilevel Ingreso usuario usuario2 Nivel 4',-2.87,0.00,32.80,16,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(49,2,'967006332','2020-05-19 17:13:03','Bono Unilevel Ingreso usuario usuario2 Nivel 4',2.87,0.00,180.15,5,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(50,1,'1013769960','2020-05-19 17:13:03','Desembolso a admin Bono Unilevel Ingreso usuario usuario2 Nivel 5',-32.80,0.00,0.00,16,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(51,2,'269091055','2020-05-19 17:13:03','Bono Unilevel Ingreso usuario usuario2 Nivel 5',32.80,0.00,212.95,5,'MembershipHistory',2,'2020-05-19 22:13:03','2020-05-19 22:13:03'),(52,1,'1682999224','2020-05-19 17:20:34','Ingreso de fondos DEPOSITO #DP273926253',105.00,0.00,105.00,15,'Deposit',3,'2020-05-19 22:20:34','2020-05-19 22:20:34'),(53,1,'128077791','2020-05-19 17:20:34','Desembolso DEPOSITO #DP273926253',-100.00,0.00,5.00,16,'Deposit',3,'2020-05-19 22:20:34','2020-05-19 22:20:34'),(54,5,'1154011836','2020-05-19 17:20:34','DEPOSITO #DP273926253',100.00,5.00,100.00,1,'Deposit',3,'2020-05-19 22:20:34','2020-05-19 22:20:34'),(55,1,'1689908303','2020-05-19 17:20:34','Desembolso Cargo DEPOSITO #DP273926253',-5.00,0.00,0.00,16,'Deposit',3,'2020-05-19 22:20:34','2020-05-19 22:20:34'),(56,2,'1529515885','2020-05-19 17:20:34','Ingreso por Cargo DEPOSITO #DP273926253',5.00,0.00,217.95,10,'Deposit',3,'2020-05-19 22:20:34','2020-05-19 22:20:34'),(57,5,'1142981947','2020-05-19 17:21:20','Compra de Membresía Plan semilla #DP273119718',-100.00,0.00,0.00,2,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(58,1,'93645890','2020-05-19 17:21:20','Ingreso de fondos Compra de Membresía Plan semilla #DP273119718 usuario3',100.00,0.00,100.00,15,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(59,1,'20921903','2020-05-19 17:21:20','Desembolso a usuario2 Bono Rápido Compra de Membresía Plan semilla #DP273119718 usuario3',-15.00,0.00,85.00,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(60,4,'260986712','2020-05-19 17:21:20','Bono Rápido Compra de Membresía Plan semilla #DP273119718 usuario3',15.00,0.00,315.00,4,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(61,1,'1813627996','2020-05-19 17:21:20','Desembolso a Admin Costo Compra de Membresía Plan semilla #DP273119718',-22.00,0.00,63.00,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(62,2,'761856749','2020-05-19 17:21:20','Ingreso por Costo Compra de Membresía Plan semilla #DP273119718 usuario3',22.00,0.00,239.95,13,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(63,1,'589833434','2020-05-19 17:21:20','Desembolso a Admin Utilidad Compra de Membresía Plan semilla #DP273119718',-22.00,0.00,41.00,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(64,2,'1349003026','2020-05-19 17:21:20','Ingreso por Utilidad Compra de Membresía Plan semilla #DP273119718 usuario3',22.00,0.00,261.95,17,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(65,1,'434086193','2020-05-19 17:21:20','Desembolso a usuario2 Bono Unilevel Ingreso usuario usuario3 Nivel 1',-2.05,0.00,38.95,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(66,4,'138550066','2020-05-19 17:21:20','Bono Unilevel Ingreso usuario usuario3 Nivel 1',2.05,0.00,317.05,5,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(67,1,'1580029595','2020-05-19 17:21:20','Desembolso a usuario1 Bono Unilevel Ingreso usuario usuario3 Nivel 2',-1.64,0.00,37.31,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(68,3,'1114073374','2020-05-19 17:21:20','Bono Unilevel Ingreso usuario usuario3 Nivel 2',1.64,0.00,118.69,5,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(69,1,'1930202748','2020-05-19 17:21:20','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 3',-1.64,0.00,35.67,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(70,2,'448518460','2020-05-19 17:21:20','Bono Unilevel Ingreso usuario usuario3 Nivel 3',1.64,0.00,263.59,5,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(71,1,'879578069','2020-05-19 17:21:20','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 4',-2.87,0.00,32.80,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(72,2,'262891966','2020-05-19 17:21:20','Bono Unilevel Ingreso usuario usuario3 Nivel 4',2.87,0.00,266.46,5,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(73,1,'1513416075','2020-05-19 17:21:20','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 5',-32.80,0.00,0.00,16,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(74,2,'1578713370','2020-05-19 17:21:20','Bono Unilevel Ingreso usuario usuario3 Nivel 5',32.80,0.00,299.26,5,'MembershipHistory',3,'2020-05-19 22:21:20','2020-05-19 22:21:20'),(75,1,'2117001631','2020-05-19 17:24:40','Ingreso de fondos DEPOSITO #DP1829631754',483.00,0.00,483.00,15,'Deposit',4,'2020-05-19 22:24:40','2020-05-19 22:24:40'),(76,1,'2022683798','2020-05-19 17:24:40','Desembolso DEPOSITO #DP1829631754',-460.00,0.00,23.00,16,'Deposit',4,'2020-05-19 22:24:40','2020-05-19 22:24:40'),(77,5,'2115084721','2020-05-19 17:24:40','DEPOSITO #DP1829631754',460.00,23.00,460.00,1,'Deposit',4,'2020-05-19 22:24:40','2020-05-19 22:24:40'),(78,1,'1537881503','2020-05-19 17:24:40','Desembolso Cargo DEPOSITO #DP1829631754',-23.00,0.00,0.00,16,'Deposit',4,'2020-05-19 22:24:40','2020-05-19 22:24:40'),(79,2,'139265255','2020-05-19 17:24:40','Ingreso por Cargo DEPOSITO #DP1829631754',23.00,0.00,322.26,10,'Deposit',4,'2020-05-19 22:24:40','2020-05-19 22:24:40'),(80,5,'1766644610','2020-05-19 17:24:56','Actualización de membresía a Plan Sembrador #DP596096955',-450.00,0.00,10.00,2,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(81,1,'680694873','2020-05-19 17:24:56','Ingreso de fondos Actualización de membresía a Plan Sembrador #DP596096955 usuario3',450.00,0.00,450.00,15,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(82,1,'864774473','2020-05-19 17:24:56','Desembolso a usuario2 Bono Rápido Actualización de membresía a Plan Sembrador #DP596096955 usuario3',-67.50,0.00,382.50,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(83,4,'434616731','2020-05-19 17:24:56','Bono Rápido Actualización de membresía a Plan Sembrador #DP596096955 usuario3',67.50,0.00,384.55,4,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(84,1,'1809769790','2020-05-19 17:24:56','Desembolso a Admin Costo Actualización de membresía a Plan Sembrador #DP596096955',-66.00,0.00,316.50,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(85,2,'1210476515','2020-05-19 17:24:56','Ingreso por Costo Actualización de membresía a Plan Sembrador #DP596096955 usuario3',66.00,0.00,388.26,13,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(86,1,'2067033488','2020-05-19 17:24:56','Desembolso a Admin Utilidad Actualización de membresía a Plan Sembrador #DP596096955',-99.00,0.00,217.50,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(87,2,'1108878944','2020-05-19 17:24:56','Ingreso por Utilidad Actualización de membresía a Plan Sembrador #DP596096955 usuario3',99.00,0.00,487.26,17,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(88,1,'1882980760','2020-05-19 17:24:56','Desembolso a usuario2 Bono Unilevel Ingreso usuario usuario3 Nivel 1',-10.88,0.00,206.62,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(89,4,'617319960','2020-05-19 17:24:56','Bono Unilevel Ingreso usuario usuario3 Nivel 1',10.88,0.00,395.43,5,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(90,1,'916358070','2020-05-19 17:24:56','Desembolso a usuario1 Bono Unilevel Ingreso usuario usuario3 Nivel 2',-8.70,0.00,197.92,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(91,3,'1408273965','2020-05-19 17:24:56','Bono Unilevel Ingreso usuario usuario3 Nivel 2',8.70,0.00,127.39,5,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(92,1,'1396376095','2020-05-19 17:24:56','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 3',-8.70,0.00,189.22,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(93,2,'1960823913','2020-05-19 17:24:56','Bono Unilevel Ingreso usuario usuario3 Nivel 3',8.70,0.00,495.96,5,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(94,1,'643922926','2020-05-19 17:24:56','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 4',-15.23,0.00,173.99,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(95,2,'1057732270','2020-05-19 17:24:56','Bono Unilevel Ingreso usuario usuario3 Nivel 4',15.23,0.00,511.19,5,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(96,1,'2074283419','2020-05-19 17:24:56','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 5',-173.99,0.00,0.00,16,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(97,2,'773066587','2020-05-19 17:24:56','Bono Unilevel Ingreso usuario usuario3 Nivel 5',173.99,0.00,685.18,5,'MembershipHistory',4,'2020-05-19 22:24:56','2020-05-19 22:24:56'),(98,1,'1249630746','2020-05-19 17:35:17','Ingreso de fondos DEPOSITO #DP2064413243',630.00,0.00,630.00,15,'Deposit',5,'2020-05-19 22:35:17','2020-05-19 22:35:17'),(99,1,'139930850','2020-05-19 17:35:17','Desembolso DEPOSITO #DP2064413243',-600.00,0.00,30.00,16,'Deposit',5,'2020-05-19 22:35:17','2020-05-19 22:35:17'),(100,6,'135151485','2020-05-19 17:35:17','DEPOSITO #DP2064413243',600.00,30.00,600.00,1,'Deposit',5,'2020-05-19 22:35:17','2020-05-19 22:35:17'),(101,1,'1354368239','2020-05-19 17:35:17','Desembolso Cargo DEPOSITO #DP2064413243',-30.00,0.00,0.00,16,'Deposit',5,'2020-05-19 22:35:17','2020-05-19 22:35:17'),(102,2,'2116097464','2020-05-19 17:35:17','Ingreso por Cargo DEPOSITO #DP2064413243',30.00,0.00,715.18,10,'Deposit',5,'2020-05-19 22:35:17','2020-05-19 22:35:17'),(103,6,'1351639294','2020-05-19 17:37:16','Compra de Membresía Plan Sembrador #DP682438755',-550.00,0.00,50.00,2,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(104,1,'814148619','2020-05-19 17:37:16','Ingreso de fondos Compra de Membresía Plan Sembrador #DP682438755 usuario4',550.00,0.00,550.00,15,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(105,1,'392565862','2020-05-19 17:37:16','Desembolso a usuario3 Bono Rápido Compra de Membresía Plan Sembrador #DP682438755 usuario4',-82.50,0.00,467.50,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(106,5,'261647683','2020-05-19 17:37:16','Bono Rápido Compra de Membresía Plan Sembrador #DP682438755 usuario4',82.50,0.00,92.50,4,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(107,1,'1122757170','2020-05-19 17:37:16','Desembolso a Admin Costo Compra de Membresía Plan Sembrador #DP682438755',-88.00,0.00,379.50,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(108,2,'1303956982','2020-05-19 17:37:16','Ingreso por Costo Compra de Membresía Plan Sembrador #DP682438755 usuario4',88.00,0.00,803.18,13,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(109,1,'969930755','2020-05-19 17:37:16','Desembolso a Admin Utilidad Compra de Membresía Plan Sembrador #DP682438755',-121.00,0.00,258.50,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(110,2,'687606500','2020-05-19 17:37:16','Ingreso por Utilidad Compra de Membresía Plan Sembrador #DP682438755 usuario4',121.00,0.00,924.18,17,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(111,1,'205017544','2020-05-19 17:37:16','Desembolso a usuario3 Bono Unilevel Ingreso usuario usuario4 Nivel 1',-12.93,0.00,245.57,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(112,5,'1910385289','2020-05-19 17:37:16','Bono Unilevel Ingreso usuario usuario4 Nivel 1',12.93,0.00,105.43,5,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(113,1,'1529487302','2020-05-19 17:37:16','Desembolso a usuario2 Bono Unilevel Ingreso usuario usuario4 Nivel 2',-10.34,0.00,235.23,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(114,4,'1849728706','2020-05-19 17:37:16','Bono Unilevel Ingreso usuario usuario4 Nivel 2',10.34,0.00,405.77,5,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(115,1,'1739440046','2020-05-19 17:37:16','Desembolso a usuario1 Bono Unilevel Ingreso usuario usuario4 Nivel 3',-10.34,0.00,224.89,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(116,3,'861737105','2020-05-19 17:37:16','Bono Unilevel Ingreso usuario usuario4 Nivel 3',10.34,0.00,137.73,5,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(117,1,'942901184','2020-05-19 17:37:16','Desembolso a admin Bono Unilevel Ingreso usuario usuario4 Nivel 4',-18.10,0.00,206.79,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(118,2,'1895921942','2020-05-19 17:37:16','Bono Unilevel Ingreso usuario usuario4 Nivel 4',18.10,0.00,942.28,5,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(119,1,'343236565','2020-05-19 17:37:16','Desembolso a admin Bono Unilevel Ingreso usuario usuario4 Nivel 5',-206.79,0.00,0.00,16,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(120,2,'2031626268','2020-05-19 17:37:16','Bono Unilevel Ingreso usuario usuario4 Nivel 5',206.79,0.00,1149.07,5,'MembershipHistory',5,'2020-05-19 22:37:16','2020-05-19 22:37:16'),(121,3,'827548545','2020-05-19 17:43:24','Transferencia de fondos enviado a usuario4 #TF1214457324',-10.00,-0.50,127.23,9,'Transfer',1,'2020-05-19 22:43:24','2020-05-19 22:43:24'),(122,1,'1679967279','2020-05-19 17:43:24','Ingreso de fondos Transferencia de fondos de usuario1 a usuario4 #TF1214457324',10.50,0.00,10.50,15,'Transfer',1,'2020-05-19 22:43:24','2020-05-19 22:43:24'),(123,1,'1583614479','2020-05-19 17:43:24','Desembolso Transferencia de fondos para usuario4 #TF1214457324',-10.00,0.00,0.50,16,'Transfer',1,'2020-05-19 22:43:24','2020-05-19 22:43:24'),(124,6,'1614229014','2020-05-19 17:43:24','Transferencia de fondos recibido de usuario1 #TF1214457324',10.00,0.00,60.00,8,'Transfer',1,'2020-05-19 22:43:24','2020-05-19 22:43:24'),(125,1,'151561578','2020-05-19 17:43:24','Desembolso Cargo - Transferencia de fondos enviados ( 10 USD ) de usuario1 a usuario4 #TF1214457324',-0.50,0.00,0.00,16,'Transfer',1,'2020-05-19 22:43:24','2020-05-19 22:43:24'),(126,2,'1863445294','2020-05-19 17:43:24','Ingreso por Cargo - Transferencia de fondos enviados ( 10 USD ) de usuario1 a usuario4 #TF1214457324',0.50,0.00,1149.57,12,'Transfer',1,'2020-05-19 22:43:24','2020-05-19 22:43:24'),(127,1,'1096820291','2020-05-19 18:01:05','Ingreso de fondos DEPOSITO #DP2066576041',210.00,0.00,210.00,15,'Deposit',6,'2020-05-19 23:01:05','2020-05-19 23:01:05'),(128,1,'863624268','2020-05-19 18:01:05','Desembolso DEPOSITO #DP2066576041',-200.00,0.00,10.00,16,'Deposit',6,'2020-05-19 23:01:05','2020-05-19 23:01:05'),(129,5,'365527107','2020-05-19 18:01:05','DEPOSITO #DP2066576041',200.00,10.00,305.43,1,'Deposit',6,'2020-05-19 23:01:05','2020-05-19 23:01:05'),(130,1,'78819387','2020-05-19 18:01:05','Desembolso Cargo DEPOSITO #DP2066576041',-10.00,0.00,0.00,16,'Deposit',6,'2020-05-19 23:01:05','2020-05-19 23:01:05'),(131,2,'1384380224','2020-05-19 18:01:05','Ingreso por Cargo DEPOSITO #DP2066576041',10.00,0.00,1159.57,10,'Deposit',6,'2020-05-19 23:01:05','2020-05-19 23:01:05'),(132,1,'1533297649','2020-05-19 18:04:17','Ingreso de fondos DEPOSITO #DP555840602',105.00,0.00,105.00,15,'Deposit',7,'2020-05-19 23:04:17','2020-05-19 23:04:17'),(133,1,'510738471','2020-05-19 18:04:17','Desembolso DEPOSITO #DP555840602',-100.00,0.00,5.00,16,'Deposit',7,'2020-05-19 23:04:17','2020-05-19 23:04:17'),(134,3,'1658999032','2020-05-19 18:04:17','DEPOSITO #DP555840602',100.00,5.00,227.23,1,'Deposit',7,'2020-05-19 23:04:17','2020-05-19 23:04:17'),(135,1,'89744251','2020-05-19 18:04:17','Desembolso Cargo DEPOSITO #DP555840602',-5.00,0.00,0.00,16,'Deposit',7,'2020-05-19 23:04:17','2020-05-19 23:04:17'),(136,2,'690978949','2020-05-19 18:04:17','Ingreso por Cargo DEPOSITO #DP555840602',5.00,0.00,1164.57,10,'Deposit',7,'2020-05-19 23:04:17','2020-05-19 23:04:17'),(137,1,'460411480','2020-05-19 18:07:14','Ingreso de fondos DEPOSITO #DP258872393',210.00,0.00,210.00,15,'Deposit',8,'2020-05-19 23:07:14','2020-05-19 23:07:14'),(138,1,'2068914311','2020-05-19 18:07:14','Desembolso DEPOSITO #DP258872393',-200.00,0.00,10.00,16,'Deposit',8,'2020-05-19 23:07:14','2020-05-19 23:07:14'),(139,5,'173555740','2020-05-19 18:07:14','DEPOSITO #DP258872393',200.00,10.00,505.43,1,'Deposit',8,'2020-05-19 23:07:14','2020-05-19 23:07:14'),(140,1,'482969776','2020-05-19 18:07:14','Desembolso Cargo DEPOSITO #DP258872393',-10.00,0.00,0.00,16,'Deposit',8,'2020-05-19 23:07:14','2020-05-19 23:07:14'),(141,2,'1128842913','2020-05-19 18:07:14','Ingreso por Cargo DEPOSITO #DP258872393',10.00,0.00,1174.57,10,'Deposit',8,'2020-05-19 23:07:14','2020-05-19 23:07:14'),(142,5,'169554827','2020-05-19 18:07:32','Actualización de membresía a Plan Cosecha #DP1288182837',-450.00,0.00,55.43,2,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(143,1,'1769439421','2020-05-19 18:07:32','Ingreso de fondos Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',450.00,0.00,450.00,15,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(144,1,'358812583','2020-05-19 18:07:32','Desembolso a usuario2 Bono Rápido Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',-67.50,0.00,382.50,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(145,4,'1824373719','2020-05-19 18:07:32','Bono Rápido Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',67.50,0.00,473.27,4,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(146,1,'43436984','2020-05-19 18:07:32','Desembolso a Admin Costo Actualización de membresía a Plan Cosecha #DP1288182837',-88.00,0.00,294.50,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(147,2,'752706258','2020-05-19 18:07:32','Ingreso por Costo Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',88.00,0.00,1262.57,13,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(148,1,'1261350539','2020-05-19 18:07:32','Desembolso a Admin Utilidad Actualización de membresía a Plan Cosecha #DP1288182837',-99.00,0.00,195.50,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(149,2,'301576501','2020-05-19 18:07:32','Ingreso por Utilidad Actualización de membresía a Plan Cosecha #DP1288182837 usuario3',99.00,0.00,1361.57,17,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(150,1,'280415416','2020-05-19 18:07:32','Desembolso a usuario2 Bono Unilevel Ingreso usuario usuario3 Nivel 1',-9.78,0.00,185.72,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(151,4,'1491343057','2020-05-19 18:07:32','Bono Unilevel Ingreso usuario usuario3 Nivel 1',9.78,0.00,483.05,5,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(152,1,'38306200','2020-05-19 18:07:32','Desembolso a usuario1 Bono Unilevel Ingreso usuario usuario3 Nivel 2',-7.82,0.00,177.90,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(153,3,'52688030','2020-05-19 18:07:32','Bono Unilevel Ingreso usuario usuario3 Nivel 2',7.82,0.00,235.05,5,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(154,1,'201708086','2020-05-19 18:07:32','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 3',-7.82,0.00,170.08,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(155,2,'1032299904','2020-05-19 18:07:32','Bono Unilevel Ingreso usuario usuario3 Nivel 3',7.82,0.00,1369.39,5,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(156,1,'2019427889','2020-05-19 18:07:32','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 4',-13.69,0.00,156.39,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(157,2,'1769555650','2020-05-19 18:07:32','Bono Unilevel Ingreso usuario usuario3 Nivel 4',13.69,0.00,1383.08,5,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(158,1,'1905188281','2020-05-19 18:07:32','Desembolso a admin Bono Unilevel Ingreso usuario usuario3 Nivel 5',-156.39,0.00,0.00,16,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(159,2,'1481829878','2020-05-19 18:07:32','Bono Unilevel Ingreso usuario usuario3 Nivel 5',156.39,0.00,1539.47,5,'MembershipHistory',6,'2020-05-19 23:07:32','2020-05-19 23:07:32'),(160,1,'699419815','2020-05-28 14:40:54','Ingreso de fondos DEPOSITO #DP1472591629',10500.00,0.00,10500.00,15,'Deposit',9,'2020-05-28 19:40:54','2020-05-28 19:40:54'),(161,1,'500196836','2020-05-28 14:40:54','Desembolso DEPOSITO #DP1472591629',-10000.00,0.00,500.00,16,'Deposit',9,'2020-05-28 19:40:54','2020-05-28 19:40:54'),(162,7,'1229708438','2020-05-28 14:40:54','DEPOSITO #DP1472591629',10000.00,500.00,10000.00,1,'Deposit',9,'2020-05-28 19:40:54','2020-05-28 19:40:54'),(163,1,'1054274167','2020-05-28 14:40:54','Desembolso Cargo DEPOSITO #DP1472591629',-500.00,0.00,0.00,16,'Deposit',9,'2020-05-28 19:40:54','2020-05-28 19:40:54'),(164,2,'586525806','2020-05-28 14:40:54','Ingreso por Cargo DEPOSITO #DP1472591629',500.00,0.00,2039.47,10,'Deposit',9,'2020-05-28 19:40:54','2020-05-28 19:40:54');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfers`
--

DROP TABLE IF EXISTS `transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_from` int(11) NOT NULL DEFAULT 0,
  `user_to` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(14,2) DEFAULT 0.00,
  `charge` decimal(14,2) DEFAULT 0.00,
  `status` tinyint(4) DEFAULT 0 COMMENT '0-Generada, 1-En cola, 2-Procesada OK',
  `transaction_id_from` int(11) DEFAULT 0,
  `transaction_id_to` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfers`
--

LOCK TABLES `transfers` WRITE;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
INSERT INTO `transfers` VALUES (1,3,6,10.00,0.50,1,0,0,'2020-05-19 17:43:24','2020-05-19 17:43:24');
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `referrer_id` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(14,2) NOT NULL DEFAULT 0.00,
  `join_date` date NOT NULL,
  `status` int(1) NOT NULL,
  `membership_id` int(11) DEFAULT 0,
  `membership_date` date DEFAULT NULL,
  `wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO',
  `paid_status` int(1) DEFAULT NULL,
  `ver_status` int(1) DEFAULT NULL,
  `ver_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forget_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_day` date DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '''000000''',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tauth` int(11) DEFAULT 0,
  `tfver` int(11) DEFAULT 0,
  `emailv` int(11) DEFAULT 0,
  `smsv` int(11) DEFAULT 0,
  `vsent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `vercode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `secretcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `price_group` tinyint(4) DEFAULT 1 COMMENT '1-Normal, 2-Distribuidor, 3-Mayorista',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `referrer_id` (`referrer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,0,0,'reserve_wallet','$2y$10$caHiULcR.hXPkspAwkjhc.OuYGHF.iBRoK1L6pGlV.XXCCcOuFnWa','Reserve','Wallet',0.00,'0000-00-00',1,0,NULL,'reserve_walletrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D',1,NULL,'','',NULL,'reservewallet@oxigenoglobal.net','9999999999','as','as','as','','rCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D',0,1,1,1,'0','0','0','',1,NULL,'2020-05-28 19:40:54'),(2,0,1,'admin','$2y$10$J4YQg2BcdiXKx4jb3fFYu.2fIK7EmgFdquEz7r54RHpJyOrbijcQm','Oxigeno','Global',2039.47,'0000-00-00',1,0,NULL,'adminrCE11UtKkxWcEGn5P29ErcXpkBqblg6cECAs0sd5L9vLiDMeVCgDlGGfMQ8D',1,NULL,'','',NULL,'admin@oxigenoglobal.net','8888888888','a','a','a','','B6maMhLe22Xevod9ArogpXouUuGsLrYSYk6non7p9fPEx6mfdC3Jplb3DTqi',0,1,1,1,'0','0','0','',1,NULL,'2020-05-28 19:40:54'),(3,2,1,'usuario1','$2y$10$yyWhpp0qUVLnoylyzzhmYuCHjqxlk2HGmK2M9LRB/PduS74sGY5aK','Maria','Jimenez',235.05,'2020-05-19',1,1,'2020-05-19','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO',1,0,'925832','0',NULL,'lolji456@gmail.com','3025689752','calle la paz','Medellin','Colombia','\'000000\'','7thDmFh7jozyrrE0i9lvaSgYuJuQPkWLIrdAxkm7aptmoD8nkX0LbaOfgeLh',0,1,1,1,'0','0','0','',1,'2020-05-19 22:03:53','2020-05-19 23:07:32'),(4,3,1,'usuario2','$2y$10$TxXire.X8VyDN.n42jKSaeh7uUxfXM2k.0vVUFRwikBKeYjzpJtlW','hector','perez',483.05,'2020-05-19',1,1,'2020-05-19','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO',1,0,'926126','0',NULL,'hkdihsn44@hotmail.com','3026958723','calle la paz','Medellin','Colombia','\'000000\'','xtatQkxj7FBEfUIMWhPwsS8cueKgwWQofjWShEQMhwNhOAc5LISMuOtClELH',0,1,1,1,'0','0','0','',1,'2020-05-19 22:08:46','2020-05-19 23:07:32'),(5,4,1,'usuario3','$2y$10$pV2nP8UygDRkRb857tlzquSDIu/pH0pV2dWAxv5fncu3Lg4DdnyXu','lola','Jimenez',55.43,'2020-05-19',1,3,'2020-05-19','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO',1,0,'926761','0',NULL,'lolihh@gmail.com','3102653487','calle la paz','Medellin','Colombia','\'000000\'','5jfohdWcgD2ySExzZrNrxOCBaSa11CW8q38YrOZeDktTPtKBjXINbbGnbK3R',0,1,1,1,'0','0','0','',1,'2020-05-19 22:19:22','2020-05-19 23:07:32'),(6,5,1,'usuario4','$2y$10$I9xTJ6GvEIYFh6jqirFLlO74gu3hEPsZt9SBqnRw0QoEIjOls2nhS','julio','perez',60.00,'2020-05-19',1,2,'2020-05-19','iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO',1,0,'927642','0',NULL,'jlouh@gmail.com','3102653487','calle la paz','Medellin','Colombia','\'000000\'','eIC4qLnunJgykv5yb1xm07lHoJEOm7L3xOrCJ43UkNhLylWBQWnKde4pIGnl',0,1,1,1,'0','0','0','',1,'2020-05-19 22:34:03','2020-05-19 22:43:24'),(7,2,0,'prueba','$2y$10$/VmXhw2SsZrK87..xyTyRu/KQnF5Etlg4N8XDtvREG1bubwiZ6Rey','gabriel','perez',10000.00,'2020-05-28',1,0,NULL,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO',0,0,'693841','0',NULL,'gabri@gmail.com','23456789987667','calle la paz','boston','Colombia','\'000000\'',NULL,0,1,1,1,'0','0','0','',1,'2020-05-28 19:24:01','2020-05-28 19:40:54'),(8,6,0,'ruthoxigeno','$2y$10$9QHwQz5e/9scIeAPc/ygJuLw.azcwFmYS2FtxMgrvC37p7T/QZ4AO','Ruth','Guerra',0.00,'2020-06-26',1,0,NULL,'iowerfaioweuripaueruawpiuonawenurpaweupawiuPUIIO',0,0,'184838','0',NULL,'ljhop23@gmail.com','3221567920','calle la paz','Medellin','Colombia','\'000000\'',NULL,0,1,1,1,'0','0','0','',1,'2020-06-26 15:20:39','2020-06-26 15:20:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_trasections`
--

DROP TABLE IF EXISTS `withdraw_trasections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdraw_trasections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `withdraw_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method_cur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_trasections`
--

LOCK TABLES `withdraw_trasections` WRITE;
/*!40000 ALTER TABLE `withdraw_trasections` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdraw_trasections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraws_method`
--

DROP TABLE IF EXISTS `withdraws_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `withdraws_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_amo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargefx` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargepc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraws_method`
--

LOCK TABLES `withdraws_method` WRITE;
/*!40000 ALTER TABLE `withdraws_method` DISABLE KEYS */;
INSERT INTO `withdraws_method` VALUES (10,'PayPal','1518420916.png','10','100000','2','5','1','5-7',1,'USD','2018-02-12 01:35:16','2020-05-15 10:13:27'),(11,'Paytm','1518421069.png','5','10000','5','1.5','1.29','7-10',0,'INR','2018-02-12 01:37:49','2020-01-24 19:27:05'),(12,'Strip','1518421113.png','10','100000','5','1.3','83','6-7',0,'USD','2018-02-12 01:38:33','2020-05-03 10:12:41'),(13,'Perfect Money','1518421160.png','5','100000','10','2.1','83','10-12',0,'USD','2018-02-12 01:39:20','2020-01-24 19:26:51');
/*!40000 ALTER TABLE `withdraws_method` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-02 23:47:19
