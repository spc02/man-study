-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: manstudy
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `manstudy`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `manstudy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `manstudy`;

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumni` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `name` varchar(120) NOT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `birth_place` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `jurusan_id` int unsigned DEFAULT NULL,
  `tahun_lulus_id` int unsigned DEFAULT NULL,
  `status_alumni_id` int unsigned DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `verification_status` enum('pending','verified','rejected') DEFAULT 'pending',
  `registered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `nisn` (`nisn`),
  KEY `jurusan_id` (`jurusan_id`),
  KEY `tahun_lulus_id` (`tahun_lulus_id`),
  KEY `status_alumni_id` (`status_alumni_id`),
  CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alumni_ibfk_2` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`),
  CONSTRAINT `alumni_ibfk_3` FOREIGN KEY (`tahun_lulus_id`) REFERENCES `tahun_lulus` (`id`),
  CONSTRAINT `alumni_ibfk_4` FOREIGN KEY (`status_alumni_id`) REFERENCES `status_alumni` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` (`id`, `user_id`, `nisn`, `nik`, `name`, `gender`, `birth_place`, `birth_date`, `address`, `phone`, `email`, `jurusan_id`, `tahun_lulus_id`, `status_alumni_id`, `photo`, `verification_status`, `registered_at`) VALUES (3,5,'87612451','33240814020300652','Ahmad Fauzan Pratama','L','Magelang','2026-07-24','Magelang','0821873633','fauzan@gmail.com',1,1,1,NULL,'verified','2026-07-24 02:15:10'),(4,6,'87621934',NULL,'Siti Nur Aisyah',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(5,7,'87634178',NULL,'Muhammad Rizky Ramadhan',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(6,8,'87645289',NULL,'Nabila Putri Ananda',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(7,9,'87658142',NULL,'Arif Maulana',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(8,10,'87662391',NULL,'Dewi Lestari',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(9,11,'87674586',NULL,'Fajar Hidayat',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(10,12,'87689753',NULL,'Intan Permatasari',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(11,13,'87693217',NULL,'Rizal Firmansyah',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(12,14,'87708465',NULL,'Yuni Kartika Sari',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(13,15,'87712948',NULL,'Bagus Saputra',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(14,16,'87726183',NULL,'Nurul Hikmah',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(15,17,'87734057',NULL,'Andika Putra',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(16,18,'87749812',NULL,'Laila Khairunnisa',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(17,19,'87751364',NULL,'Hafidz Al Ghifari',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(18,20,'87765829',NULL,'Anisa Rahmawati',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(19,21,'87776245',NULL,'Rahmat Hidayatullah',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(20,22,'87784913',NULL,'Muhammad Fikri',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(21,23,'87798526',NULL,'Aulia Maharani',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:10'),(22,24,'87801349',NULL,'Yusuf Maulana',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(23,25,'87816492',NULL,'Nadya Safitri',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(24,26,'87824175',NULL,'Fikri Alamsyah',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(25,27,'87839561',NULL,'Putri Amelia',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(26,28,'87842087',NULL,'Galih Prakoso',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(27,29,'87857436',NULL,'Rina Oktaviani',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(28,30,'87863194',NULL,'Ilham Akbar',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(29,31,'87875648',NULL,'Salma Zahra',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(30,32,'87881265',NULL,'Dimas Wahyu Nugroho',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(31,33,'87898371',NULL,'Cahya Nur Azizah',NULL,NULL,NULL,NULL,NULL,NULL,2,1,NULL,NULL,'verified','2026-07-24 02:15:11'),(32,34,'87904518',NULL,'Reza Ardiansyah',NULL,NULL,NULL,NULL,NULL,NULL,3,1,NULL,NULL,'verified','2026-07-24 02:15:11');
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jawaban`
--

DROP TABLE IF EXISTS `jawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jawaban` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tracer_id` int unsigned NOT NULL,
  `pertanyaan_id` int unsigned NOT NULL,
  `answer` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_answer` (`tracer_id`,`pertanyaan_id`),
  KEY `pertanyaan_id` (`pertanyaan_id`),
  CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`tracer_id`) REFERENCES `tracer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=505 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jawaban`
--

LOCK TABLES `jawaban` WRITE;
/*!40000 ALTER TABLE `jawaban` DISABLE KEYS */;
INSERT INTO `jawaban` (`id`, `tracer_id`, `pertanyaan_id`, `answer`) VALUES (1,1,1,'Melanjutkan Pendidikan'),(2,1,2,'Perguruan Tinggi Negeri (PTN)'),(3,1,3,'Universitas Sebelas Maret'),(4,1,4,'Fakultas Teknik'),(5,1,5,'Pendidikan Agama Islam'),(6,1,6,'S1'),(7,1,7,'Seleksi Mandiri'),(8,1,10,'2023'),(9,1,11,'Aktif'),(10,1,12,'Tidak'),(11,1,38,'5'),(12,1,39,'4'),(13,1,40,'3'),(14,1,41,'5'),(15,1,42,'5'),(16,1,43,'4'),(17,1,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(35,3,1,'Sedang Mencari Pekerjaan'),(36,3,28,'< 3 Bulan'),(37,3,29,'Teknologi'),(38,3,30,'Portal Lowongan Online (JobStreet, LinkedIn, dll)'),(39,3,31,'Persaingan Ketat'),(40,3,32,'Ya'),(41,3,38,'4'),(42,3,39,'5'),(43,3,40,'5'),(44,3,41,'4'),(45,3,42,'4'),(46,3,43,'4'),(47,3,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(48,4,1,'Melanjutkan Pendidikan'),(49,4,2,'Perguruan Tinggi Negeri (PTN)'),(50,4,3,'Universitas Gadjah Mada'),(51,4,4,'Fakultas Teknik'),(52,4,5,'Pendidikan Agama Islam'),(53,4,6,'S1'),(54,4,7,'Seleksi Mandiri'),(55,4,10,'2023'),(56,4,11,'Aktif'),(57,4,12,'Ya'),(58,4,13,'KIP Kuliah'),(59,4,38,'5'),(60,4,39,'5'),(61,4,40,'3'),(62,4,41,'4'),(63,4,42,'5'),(64,4,43,'4'),(65,4,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(66,5,1,'Sedang Mencari Pekerjaan'),(67,5,28,'< 3 Bulan'),(68,5,29,'Teknologi'),(69,5,30,'Portal Lowongan Online (JobStreet, LinkedIn, dll)'),(70,5,31,'Persaingan Ketat'),(71,5,32,'Ya'),(72,5,38,'4'),(73,5,39,'4'),(74,5,40,'4'),(75,5,41,'3'),(76,5,42,'4'),(77,5,43,'5'),(78,5,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(79,6,1,'Bekerja'),(80,6,14,'PT Maju Jaya'),(81,6,15,'Pendidikan'),(82,6,16,'Staff'),(83,6,17,'Tetap'),(84,6,18,'Jawa Tengah'),(85,6,19,'Magelang'),(86,6,20,'Rp4â€“6 Juta'),(87,6,21,'< 3 Bulan'),(88,6,22,'Kurang Sesuai'),(89,6,38,'5'),(90,6,39,'5'),(91,6,40,'4'),(92,6,41,'3'),(93,6,42,'5'),(94,6,43,'5'),(95,6,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(96,7,1,'Melanjutkan Pendidikan'),(97,7,2,'Perguruan Tinggi Negeri (PTN)'),(98,7,3,'Institut Teknologi Bandung'),(99,7,4,'Fakultas Ekonomi'),(100,7,5,'Pendidikan Agama Islam'),(101,7,6,'S1'),(102,7,7,'SNBT'),(103,7,10,'2023'),(104,7,11,'Aktif'),(105,7,12,'Tidak'),(106,7,38,'5'),(107,7,39,'4'),(108,7,40,'5'),(109,7,41,'4'),(110,7,42,'4'),(111,7,43,'5'),(112,7,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(113,8,1,'Melanjutkan Pendidikan'),(114,8,2,'Perguruan Tinggi Swasta (PTS)'),(115,8,3,'Universitas Muhammadiyah Yogyakarta'),(116,8,4,'Fakultas Ekonomi'),(117,8,5,'Pendidikan Agama Islam'),(118,8,6,'S1'),(119,8,8,'Reguler'),(120,8,10,'2023'),(121,8,11,'Aktif'),(122,8,12,'Ya'),(123,8,13,'KIP Kuliah'),(124,8,38,'3'),(125,8,39,'4'),(126,8,40,'4'),(127,8,41,'3'),(128,8,42,'5'),(129,8,43,'5'),(130,8,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(131,9,1,'Bekerja'),(132,9,14,'PT Maju Jaya'),(133,9,15,'Manufaktur'),(134,9,16,'Staff'),(135,9,17,'Tetap'),(136,9,18,'Jawa Tengah'),(137,9,19,'Magelang'),(138,9,20,'Rp2â€“4 Juta'),(139,9,21,'3â€“6 Bulan'),(140,9,22,'Kurang Sesuai'),(141,9,38,'4'),(142,9,39,'4'),(143,9,40,'5'),(144,9,41,'3'),(145,9,42,'4'),(146,9,43,'5'),(147,9,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(148,10,1,'Melanjutkan Pendidikan'),(149,10,2,'Perguruan Tinggi Swasta (PTS)'),(150,10,3,'Universitas Atma Jaya'),(151,10,4,'Fakultas Ekonomi'),(152,10,5,'Ilmu Hukum'),(153,10,6,'S1'),(154,10,8,'Reguler'),(155,10,10,'2023'),(156,10,11,'Aktif'),(157,10,12,'Tidak'),(158,10,38,'5'),(159,10,39,'4'),(160,10,40,'3'),(161,10,41,'3'),(162,10,42,'4'),(163,10,43,'4'),(164,10,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(165,11,1,'Melanjutkan Pendidikan'),(166,11,2,'Perguruan Tinggi Negeri (PTN)'),(167,11,3,'Universitas Diponegoro'),(168,11,4,'Fakultas Ekonomi'),(169,11,5,'Manajemen'),(170,11,6,'S1'),(171,11,7,'SNBT'),(172,11,10,'2023'),(173,11,11,'Aktif'),(174,11,12,'Ya'),(175,11,13,'KIP Kuliah'),(176,11,38,'3'),(177,11,39,'5'),(178,11,40,'5'),(179,11,41,'4'),(180,11,42,'4'),(181,11,43,'5'),(182,11,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(183,12,1,'Melanjutkan Pendidikan'),(184,12,2,'Perguruan Tinggi Negeri (PTN)'),(185,12,3,'Institut Teknologi Bandung'),(186,12,4,'Fakultas Ekonomi'),(187,12,5,'Manajemen'),(188,12,6,'S1'),(189,12,7,'Seleksi Mandiri'),(190,12,10,'2023'),(191,12,11,'Aktif'),(192,12,12,'Tidak'),(193,12,38,'3'),(194,12,39,'5'),(195,12,40,'5'),(196,12,41,'3'),(197,12,42,'5'),(198,12,43,'4'),(199,12,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(200,13,1,'Melanjutkan Pendidikan'),(201,13,2,'Perguruan Tinggi Negeri (PTN)'),(202,13,3,'Universitas Indonesia'),(203,13,4,'Fakultas Ekonomi'),(204,13,5,'Teknik Informatika'),(205,13,6,'S1'),(206,13,7,'SNBP'),(207,13,10,'2023'),(208,13,11,'Aktif'),(209,13,12,'Ya'),(210,13,13,'KIP Kuliah'),(211,13,38,'3'),(212,13,39,'4'),(213,13,40,'4'),(214,13,41,'5'),(215,13,42,'4'),(216,13,43,'4'),(217,13,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(218,14,1,'Melanjutkan Pendidikan'),(219,14,2,'Perguruan Tinggi Swasta (PTS)'),(220,14,3,'Universitas Islam Indonesia'),(221,14,4,'Fakultas Teknik'),(222,14,5,'Teknik Informatika'),(223,14,6,'S1'),(224,14,8,'Reguler'),(225,14,10,'2023'),(226,14,11,'Aktif'),(227,14,12,'Tidak'),(228,14,38,'5'),(229,14,39,'4'),(230,14,40,'3'),(231,14,41,'5'),(232,14,42,'5'),(233,14,43,'4'),(234,14,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(235,15,1,'Berwirausaha'),(236,15,23,'Kedai Mantap'),(237,15,24,'Perdagangan'),(238,15,25,'1â€“3 Tahun'),(239,15,26,'5'),(240,15,27,'< Rp5 Juta'),(241,15,38,'4'),(242,15,39,'4'),(243,15,40,'3'),(244,15,41,'4'),(245,15,42,'4'),(246,15,43,'5'),(247,15,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(248,16,1,'Melanjutkan Pendidikan'),(249,16,2,'Perguruan Tinggi Negeri (PTN)'),(250,16,3,'Universitas Indonesia'),(251,16,4,'Fakultas Teknik'),(252,16,5,'Manajemen'),(253,16,6,'S1'),(254,16,7,'SNBT'),(255,16,10,'2023'),(256,16,11,'Aktif'),(257,16,12,'Tidak'),(258,16,38,'5'),(259,16,39,'5'),(260,16,40,'3'),(261,16,41,'3'),(262,16,42,'5'),(263,16,43,'4'),(264,16,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(265,17,1,'Melanjutkan Pendidikan'),(266,17,2,'Perguruan Tinggi Swasta (PTS)'),(267,17,3,'Universitas Islam Indonesia'),(268,17,4,'Fakultas Ekonomi'),(269,17,5,'Pendidikan Agama Islam'),(270,17,6,'S1'),(271,17,8,'Beasiswa'),(272,17,10,'2023'),(273,17,11,'Aktif'),(274,17,12,'Ya'),(275,17,13,'KIP Kuliah'),(276,17,38,'4'),(277,17,39,'5'),(278,17,40,'3'),(279,17,41,'4'),(280,17,42,'4'),(281,17,43,'5'),(282,17,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(283,18,1,'Sedang Mencari Pekerjaan'),(284,18,28,'< 3 Bulan'),(285,18,29,'Perdagangan'),(286,18,30,'Portal Lowongan Online (JobStreet, LinkedIn, dll)'),(287,18,31,'Persaingan Ketat'),(288,18,32,'Ya'),(289,18,38,'5'),(290,18,39,'5'),(291,18,40,'4'),(292,18,41,'3'),(293,18,42,'4'),(294,18,43,'5'),(295,18,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(296,19,1,'Berwirausaha'),(297,19,23,'Kedai Mantap'),(298,19,24,'Perdagangan'),(299,19,25,'1â€“3 Tahun'),(300,19,26,'1'),(301,19,27,'< Rp5 Juta'),(302,19,38,'5'),(303,19,39,'4'),(304,19,40,'3'),(305,19,41,'3'),(306,19,42,'4'),(307,19,43,'4'),(308,19,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(309,20,1,'Berwirausaha'),(310,20,23,'Kedai Mantap'),(311,20,24,'Perdagangan'),(312,20,25,'1â€“3 Tahun'),(313,20,26,'5'),(314,20,27,'Rp5â€“10 Juta'),(315,20,38,'4'),(316,20,39,'5'),(317,20,40,'4'),(318,20,41,'5'),(319,20,42,'5'),(320,20,43,'4'),(321,20,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(322,21,1,'Melanjutkan Pendidikan'),(323,21,2,'Perguruan Tinggi Negeri (PTN)'),(324,21,3,'Universitas Gadjah Mada'),(325,21,4,'Fakultas Teknik'),(326,21,5,'Akuntansi'),(327,21,6,'S1'),(328,21,7,'SNBP'),(329,21,10,'2023'),(330,21,11,'Aktif'),(331,21,12,'Tidak'),(332,21,38,'5'),(333,21,39,'5'),(334,21,40,'5'),(335,21,41,'5'),(336,21,42,'5'),(337,21,43,'5'),(338,21,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(339,22,1,'Melanjutkan Pendidikan'),(340,22,2,'Perguruan Tinggi Swasta (PTS)'),(341,22,3,'Universitas Muhammadiyah Magelang'),(342,22,4,'Fakultas Teknik'),(343,22,5,'Ilmu Hukum'),(344,22,6,'S1'),(345,22,8,'Reguler'),(346,22,10,'2023'),(347,22,11,'Aktif'),(348,22,12,'Tidak'),(349,22,38,'5'),(350,22,39,'4'),(351,22,40,'4'),(352,22,41,'5'),(353,22,42,'5'),(354,22,43,'4'),(355,22,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(356,23,1,'Melanjutkan Pendidikan'),(357,23,2,'Perguruan Tinggi Swasta (PTS)'),(358,23,3,'Universitas Muhammadiyah Yogyakarta'),(359,23,4,'Fakultas Teknik'),(360,23,5,'Manajemen'),(361,23,6,'S1'),(362,23,8,'Beasiswa'),(363,23,10,'2023'),(364,23,11,'Aktif'),(365,23,12,'Tidak'),(366,23,38,'3'),(367,23,39,'5'),(368,23,40,'5'),(369,23,41,'5'),(370,23,42,'5'),(371,23,43,'4'),(372,23,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(373,24,1,'Bekerja'),(374,24,14,'PT Maju Jaya'),(375,24,15,'Teknologi'),(376,24,16,'Staff'),(377,24,17,'Tetap'),(378,24,18,'Jawa Tengah'),(379,24,19,'Magelang'),(380,24,20,'Rp4â€“6 Juta'),(381,24,21,'3â€“6 Bulan'),(382,24,22,'Kurang Sesuai'),(383,24,38,'5'),(384,24,39,'4'),(385,24,40,'5'),(386,24,41,'5'),(387,24,42,'4'),(388,24,43,'5'),(389,24,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(390,25,1,'Melanjutkan Pendidikan'),(391,25,2,'Perguruan Tinggi Swasta (PTS)'),(392,25,3,'Bina Nusantara'),(393,25,4,'Fakultas Ekonomi'),(394,25,5,'Ilmu Komunikasi'),(395,25,6,'S1'),(396,25,8,'Beasiswa'),(397,25,10,'2023'),(398,25,11,'Aktif'),(399,25,12,'Tidak'),(400,25,38,'3'),(401,25,39,'4'),(402,25,40,'3'),(403,25,41,'3'),(404,25,42,'4'),(405,25,43,'4'),(406,25,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(407,26,1,'Melanjutkan Pendidikan'),(408,26,2,'Perguruan Tinggi Swasta (PTS)'),(409,26,3,'Universitas Muhammadiyah Magelang'),(410,26,4,'Fakultas Ekonomi'),(411,26,5,'Manajemen'),(412,26,6,'S1'),(413,26,8,'Reguler'),(414,26,10,'2023'),(415,26,11,'Aktif'),(416,26,12,'Tidak'),(417,26,38,'4'),(418,26,39,'4'),(419,26,40,'5'),(420,26,41,'4'),(421,26,42,'4'),(422,26,43,'5'),(423,26,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(424,27,1,'Melanjutkan Pendidikan'),(425,27,2,'Perguruan Tinggi Negeri (PTN)'),(426,27,3,'Universitas Sebelas Maret'),(427,27,4,'Fakultas Ekonomi'),(428,27,5,'Ilmu Komunikasi'),(429,27,6,'S1'),(430,27,7,'SNBP'),(431,27,10,'2023'),(432,27,11,'Aktif'),(433,27,12,'Tidak'),(434,27,38,'4'),(435,27,39,'5'),(436,27,40,'3'),(437,27,41,'4'),(438,27,42,'5'),(439,27,43,'4'),(440,27,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(441,28,1,'Melanjutkan Pendidikan'),(442,28,2,'Perguruan Tinggi Negeri (PTN)'),(443,28,3,'Institut Teknologi Bandung'),(444,28,4,'Fakultas Ekonomi'),(445,28,5,'Teknik Informatika'),(446,28,6,'S1'),(447,28,7,'SNBP'),(448,28,10,'2023'),(449,28,11,'Aktif'),(450,28,12,'Tidak'),(451,28,38,'5'),(452,28,39,'5'),(453,28,40,'3'),(454,28,41,'3'),(455,28,42,'5'),(456,28,43,'4'),(457,28,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(458,29,1,'Bekerja'),(459,29,14,'PT Maju Jaya'),(460,29,15,'Jasa'),(461,29,16,'Staff'),(462,29,17,'Tetap'),(463,29,18,'Jawa Tengah'),(464,29,19,'Magelang'),(465,29,20,'Rp4â€“6 Juta'),(466,29,21,'3â€“6 Bulan'),(467,29,22,'Kurang Sesuai'),(468,29,38,'4'),(469,29,39,'4'),(470,29,40,'3'),(471,29,41,'4'),(472,29,42,'5'),(473,29,43,'4'),(474,29,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(475,30,1,'Berwirausaha'),(476,30,23,'Kedai Mantap'),(477,30,24,'Perdagangan'),(478,30,25,'1â€“3 Tahun'),(479,30,26,'1'),(480,30,27,'Rp5â€“10 Juta'),(481,30,38,'3'),(482,30,39,'5'),(483,30,40,'3'),(484,30,41,'5'),(485,30,42,'4'),(486,30,43,'4'),(487,30,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!'),(488,31,1,'Melanjutkan Pendidikan'),(489,31,2,'Perguruan Tinggi Negeri (PTN)'),(490,31,3,'UNDIP'),(491,31,4,'Teknik'),(492,31,5,'Teknik Informatika'),(493,31,6,'D4'),(494,31,7,'SNBP'),(495,31,10,'10'),(496,31,11,'Aktif'),(497,31,12,'Tidak'),(498,31,38,'1'),(499,31,39,'5'),(500,31,40,'5'),(501,31,41,'5'),(502,31,42,'4'),(503,31,43,'4'),(504,31,44,'Terima kasih MAN 1 Magelang, tingkatkan terus kualitasnya!');
/*!40000 ALTER TABLE `jawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurusan`
--

DROP TABLE IF EXISTS `jurusan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jurusan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurusan`
--

LOCK TABLES `jurusan` WRITE;
/*!40000 ALTER TABLE `jurusan` DISABLE KEYS */;
INSERT INTO `jurusan` (`id`, `name`, `created_at`) VALUES (1,'Tata Boga','2026-07-24 02:12:13'),(2,'Tata Busana','2026-07-24 02:12:17'),(3,'Teknik Komputer dan Jaringan (TKJ)','2026-07-24 02:12:28'),(4,'Teknik dan Bisnis Sepeda Motor (TBSM)','2026-07-24 02:12:38'),(5,'Teknik Instalasi Listrik','2026-07-24 02:12:49');
/*!40000 ALTER TABLE `jurusan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legalisir`
--

DROP TABLE IF EXISTS `legalisir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legalisir` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `alumni_id` int unsigned NOT NULL,
  `quantity` int NOT NULL,
  `notes` text,
  `status` enum('pending','processing','completed','rejected') DEFAULT 'pending',
  `result_file` varchar(255) DEFAULT NULL,
  `processed_by` int unsigned DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `alumni_id` (`alumni_id`),
  KEY `processed_by` (`processed_by`),
  CONSTRAINT `legalisir_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE,
  CONSTRAINT `legalisir_ibfk_2` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legalisir`
--

LOCK TABLES `legalisir` WRITE;
/*!40000 ALTER TABLE `legalisir` DISABLE KEYS */;
INSERT INTO `legalisir` (`id`, `alumni_id`, `quantity`, `notes`, `status`, `result_file`, `processed_by`, `processed_at`, `created_at`) VALUES (1,3,1,'Legalisir Ijazah','completed','1f7c97ce25c40b9b3ed167a678f0b707.pdf',2,'2026-07-24 02:27:55','2026-07-24 02:26:29'),(2,3,1,'legalisir\r\n','completed','c2a2e8c845bd236b7614fdaa6f2cbd98.pdf',2,'2026-07-24 02:39:41','2026-07-24 02:39:02');
/*!40000 ALTER TABLE `legalisir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legalisir_file`
--

DROP TABLE IF EXISTS `legalisir_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legalisir_file` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `legalisir_id` int unsigned NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `legalisir_id` (`legalisir_id`),
  CONSTRAINT `legalisir_file_ibfk_1` FOREIGN KEY (`legalisir_id`) REFERENCES `legalisir` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legalisir_file`
--

LOCK TABLES `legalisir_file` WRITE;
/*!40000 ALTER TABLE `legalisir_file` DISABLE KEYS */;
INSERT INTO `legalisir_file` (`id`, `legalisir_id`, `file_path`, `created_at`) VALUES (1,1,'b3d73753ea04080edac4c2575dbef6c5.pdf','2026-07-24 02:26:29'),(2,2,'1cf2acecc7a5adac0fc66f6bd359e5e5.pdf','2026-07-24 02:39:02');
/*!40000 ALTER TABLE `legalisir_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_activity`
--

DROP TABLE IF EXISTS `log_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_activity` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(80) DEFAULT NULL,
  `reference_id` int unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_activity`
--

LOCK TABLES `log_activity` WRITE;
/*!40000 ALTER TABLE `log_activity` DISABLE KEYS */;
INSERT INTO `log_activity` (`id`, `user_id`, `action`, `module`, `reference_id`, `ip_address`, `created_at`) VALUES (1,5,'Mengajukan legalisir','legalisir',1,'::1','2026-07-24 02:26:29'),(2,2,'Status processing','legalisir',1,'::1','2026-07-24 02:26:48'),(3,2,'Status completed','legalisir',1,'::1','2026-07-24 02:27:55'),(4,5,'Mengisi tracer','tracer',1,'::1','2026-07-24 02:34:35'),(5,5,'Mengajukan legalisir','legalisir',2,'::1','2026-07-24 02:39:02'),(6,2,'Status processing','legalisir',2,'::1','2026-07-24 02:39:32'),(7,2,'Status completed','legalisir',2,'::1','2026-07-24 02:39:41'),(8,5,'Mengisi tracer','tracer',2,'::1','2026-07-24 03:52:24'),(9,5,'Mengisi tracer','tracer',3,'::1','2026-07-24 03:52:47'),(10,5,'Memperbarui tracer','tracer',4,'::1','2026-07-24 04:04:55'),(11,5,'Memperbarui tracer','tracer',5,'::1','2026-07-24 04:29:20'),(12,5,'Memperbarui tracer','tracer',6,'::1','2026-07-24 04:32:07'),(13,5,'Memperbarui tracer','tracer',7,'::1','2026-07-24 06:10:44'),(14,5,'Memperbarui tracer','tracer',8,'::1','2026-07-25 02:25:20'),(15,5,'Memperbarui tracer','tracer',9,'::1','2026-07-25 02:29:15'),(16,6,'Memperbarui tracer','tracer',31,'::1','2026-07-29 04:13:24');
/*!40000 ALTER TABLE `log_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `body` text,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset`
--

LOCK TABLES `password_reset` WRITE;
/*!40000 ALTER TABLE `password_reset` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertanyaan`
--

DROP TABLE IF EXISTS `pertanyaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pertanyaan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `type` enum('text','textarea','radio','checkbox','select','date','number') NOT NULL,
  `options` text,
  `sort_order` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(100) DEFAULT NULL,
  `parent_id` int unsigned DEFAULT NULL,
  `parent_value` varchar(255) DEFAULT NULL,
  `question_key` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question_key` (`question_key`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertanyaan`
--

LOCK TABLES `pertanyaan` WRITE;
/*!40000 ALTER TABLE `pertanyaan` DISABLE KEYS */;
INSERT INTO `pertanyaan` (`id`, `question`, `type`, `options`, `sort_order`, `is_active`, `created_at`, `category`, `parent_id`, `parent_value`, `question_key`) VALUES (1,'Apa aktivitas utama Anda saat ini?','radio','Melanjutkan Pendidikan|Bekerja|Berwirausaha|Sedang Mencari Pekerjaan|Belum Bekerja|Lainnya',1,1,'2026-07-25 02:52:47','Status Alumni',NULL,NULL,'activity'),(2,'Jenis Perguruan Tinggi','select','Perguruan Tinggi Negeri (PTN)|Perguruan Tinggi Swasta (PTS)|Perguruan Tinggi Kedinasan|Perguruan Tinggi Luar Negeri|Pesantren|Lainnya',2,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_type'),(3,'Nama Perguruan Tinggi','text',NULL,3,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_name'),(4,'Fakultas','text',NULL,4,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_faculty'),(5,'Program Studi','text',NULL,5,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_major'),(6,'Jenjang Pendidikan','radio','D3|D4|S1|S2',6,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_level'),(7,'Jalur Masuk (PTN)','select','SNBP|SNBT|Seleksi Mandiri|Jalur Prestasi|Jalur Internasional|Lainnya',7,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',2,'Perguruan Tinggi Negeri (PTN)','uni_path_ptn'),(8,'Jalur Masuk (PTS)','select','Reguler|Beasiswa|Transfer|Prestasi|Lainnya',8,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',2,'Perguruan Tinggi Swasta (PTS)','uni_path_pts'),(9,'Jalur Masuk (Kedinasan)','select','Seleksi Nasional|Jalur Prestasi|Lainnya',9,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',2,'Perguruan Tinggi Kedinasan','uni_path_kedinasan'),(10,'Tahun Masuk Kuliah','number',NULL,10,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_year'),(11,'Status Kuliah','select','Aktif|Cuti|Lulus|Mengundurkan Diri',11,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_status'),(12,'Apakah menerima beasiswa?','radio','Ya|Tidak',12,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',1,'Melanjutkan Pendidikan','uni_scholarship'),(13,'Nama Beasiswa','text',NULL,13,1,'2026-07-25 02:52:47','Pendidikan Lanjutan',12,'Ya','uni_scholarship_name'),(14,'Nama Instansi / Perusahaan','text',NULL,14,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_company'),(15,'Bidang Industri','select','Pendidikan|Pemerintahan|Perbankan|Teknologi|Manufaktur|Kesehatan|Perdagangan|Jasa|Lainnya',15,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_industry'),(16,'Jabatan','text',NULL,16,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_position'),(17,'Status Pekerjaan','select','Tetap|Kontrak|Magang|Freelance',17,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_status'),(18,'Lokasi Bekerja (Provinsi)','text',NULL,18,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_province'),(19,'Lokasi Bekerja (Kabupaten/Kota)','text',NULL,19,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_city'),(20,'Rentang Gaji Pertama','select','< Rp2 Juta|Rp2â€“4 Juta|Rp4â€“6 Juta|Rp6â€“8 Juta|> Rp8 Juta',20,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_salary'),(21,'Berapa lama memperoleh pekerjaan pertama setelah lulus?','select','< 3 Bulan|3â€“6 Bulan|6â€“12 Bulan|> 1 Tahun',21,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_wait_time'),(22,'Apakah pekerjaan Anda sesuai jurusan?','select','Sangat Sesuai|Sesuai|Kurang Sesuai|Tidak Sesuai',22,1,'2026-07-25 02:52:47','Pekerjaan',1,'Bekerja','job_relevance'),(23,'Nama Usaha','text',NULL,23,1,'2026-07-25 02:52:47','Wirausaha',1,'Berwirausaha','biz_name'),(24,'Bidang Usaha','select','Kuliner|Fashion|Teknologi|Pertanian|Jasa|Perdagangan|Lainnya',24,1,'2026-07-25 02:52:47','Wirausaha',1,'Berwirausaha','biz_field'),(25,'Lama Menjalankan Usaha','select','< 1 Tahun|1â€“3 Tahun|> 3 Tahun',25,1,'2026-07-25 02:52:47','Wirausaha',1,'Berwirausaha','biz_duration'),(26,'Jumlah Karyawan','number',NULL,26,1,'2026-07-25 02:52:47','Wirausaha',1,'Berwirausaha','biz_employees'),(27,'Omzet per Bulan','select','< Rp5 Juta|Rp5â€“10 Juta|Rp10â€“25 Juta|> Rp25 Juta',27,1,'2026-07-25 02:52:47','Wirausaha',1,'Berwirausaha','biz_turnover'),(28,'Sudah berapa lama Anda aktif mencari pekerjaan?','select','< 3 Bulan|3â€“6 Bulan|6â€“12 Bulan|> 1 Tahun',28,1,'2026-07-25 02:52:47','Mencari Pekerjaan',1,'Sedang Mencari Pekerjaan','seek_duration'),(29,'Bidang pekerjaan yang Anda tuju?','select','Pendidikan|Pemerintahan|Perbankan|Teknologi|Manufaktur|Kesehatan|Perdagangan|Jasa|Lainnya',29,1,'2026-07-25 02:52:47','Mencari Pekerjaan',1,'Sedang Mencari Pekerjaan','seek_field'),(30,'Cara yang digunakan dalam mencari pekerjaan?','checkbox','Portal Lowongan Online (JobStreet, LinkedIn, dll)|Media Sosial|Relasi / Kenalan|Langsung ke Perusahaan|Bursa Kerja Sekolah / Campus Hiring|Lainnya',30,1,'2026-07-25 02:52:47','Mencari Pekerjaan',1,'Sedang Mencari Pekerjaan','seek_method'),(31,'Apa hambatan utama dalam mencari pekerjaan?','select','Kurang Pengalaman|Kurang Keterampilan / Skill|Persaingan Ketat|Lokasi|Gaji Tidak Sesuai Harapan|Belum Ada Lowongan yang Cocok|Lainnya',31,1,'2026-07-25 02:52:47','Mencari Pekerjaan',1,'Sedang Mencari Pekerjaan','seek_obstacle'),(32,'Apakah Anda sedang mengikuti pelatihan / kursus sambil mencari kerja?','radio','Ya|Tidak',32,1,'2026-07-25 02:52:47','Mencari Pekerjaan',1,'Sedang Mencari Pekerjaan','seek_training'),(33,'Apa alasan utama Anda belum bekerja atau melanjutkan pendidikan?','select','Merawat Keluarga|Kondisi Kesehatan|Belum Ada Motivasi|Sedang Mempersiapkan Diri|Faktor Ekonomi|Lainnya',33,1,'2026-07-25 02:52:47','Belum Bekerja',1,'Belum Bekerja','idle_reason'),(34,'Apa rencana Anda dalam waktu 6 bulan ke depan?','radio','Mencari Pekerjaan|Melanjutkan Pendidikan|Berwirausaha|Mengikuti Pelatihan / Kursus|Belum Ada Rencana',34,1,'2026-07-25 02:52:47','Belum Bekerja',1,'Belum Bekerja','idle_plan'),(35,'Apakah ada kegiatan yang Anda lakukan saat ini?','textarea',NULL,35,1,'2026-07-25 02:52:47','Belum Bekerja',1,'Belum Bekerja','idle_activity'),(36,'Jelaskan aktivitas utama Anda saat ini','textarea',NULL,36,1,'2026-07-25 02:52:47','Lainnya',1,'Lainnya','other_activity'),(37,'Apakah aktivitas tersebut memberikan penghasilan?','radio','Ya|Tidak',37,1,'2026-07-25 02:52:47','Lainnya',1,'Lainnya','other_income'),(38,'Seberapa relevan materi pembelajaran dengan aktivitas saat ini?','radio','1|2|3|4|5',38,1,'2026-07-25 02:52:47','Evaluasi Sekolah',NULL,NULL,'eval_relevance'),(39,'Kualitas guru selama belajar di MAN 1 Magelang?','radio','1|2|3|4|5',39,1,'2026-07-25 02:52:47','Evaluasi Sekolah',NULL,NULL,'eval_teacher'),(40,'Kualitas fasilitas sekolah?','radio','1|2|3|4|5',40,1,'2026-07-25 02:52:47','Evaluasi Sekolah',NULL,NULL,'eval_facility'),(41,'Pelayanan administrasi sekolah?','radio','1|2|3|4|5',41,1,'2026-07-25 02:52:47','Evaluasi Sekolah',NULL,NULL,'eval_admin'),(42,'Seberapa besar sekolah membantu persiapan dunia kerja/kuliah?','radio','1|2|3|4|5',42,1,'2026-07-25 02:52:47','Evaluasi Sekolah',NULL,NULL,'eval_prep'),(43,'Seberapa puas Anda menjadi alumni MAN 1 Magelang?','radio','1|2|3|4|5',43,1,'2026-07-25 02:52:47','Evaluasi Sekolah',NULL,NULL,'eval_satisfaction'),(44,'Apa saran Anda agar MAN 1 Magelang menjadi lebih baik?','textarea',NULL,44,1,'2026-07-25 02:52:47','Masukan Alumni',NULL,NULL,'feedback');
/*!40000 ALTER TABLE `pertanyaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `slug`) VALUES (1,'Super Admin','super_admin'),(2,'Tata Usaha','tu'),(3,'Kepala Madrasah','kepala'),(4,'Alumni','alumni');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_alumni`
--

DROP TABLE IF EXISTS `status_alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_alumni` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_alumni`
--

LOCK TABLES `status_alumni` WRITE;
/*!40000 ALTER TABLE `status_alumni` DISABLE KEYS */;
INSERT INTO `status_alumni` (`id`, `name`) VALUES (4,'Belum Bekerja'),(2,'Kerja'),(1,'Kuliah'),(3,'Wirausaha');
/*!40000 ALTER TABLE `status_alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun_lulus`
--

DROP TABLE IF EXISTS `tahun_lulus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tahun_lulus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun_lulus`
--

LOCK TABLES `tahun_lulus` WRITE;
/*!40000 ALTER TABLE `tahun_lulus` DISABLE KEYS */;
INSERT INTO `tahun_lulus` (`id`, `name`) VALUES (1,'2025/2026');
/*!40000 ALTER TABLE `tahun_lulus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracer`
--

DROP TABLE IF EXISTS `tracer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tracer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `alumni_id` int unsigned NOT NULL,
  `status` enum('draft','submitted') DEFAULT 'draft',
  `submitted_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alumni_id` (`alumni_id`),
  CONSTRAINT `tracer_ibfk_1` FOREIGN KEY (`alumni_id`) REFERENCES `alumni` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracer`
--

LOCK TABLES `tracer` WRITE;
/*!40000 ALTER TABLE `tracer` DISABLE KEYS */;
INSERT INTO `tracer` (`id`, `alumni_id`, `status`, `submitted_at`, `updated_at`) VALUES (1,3,'submitted','2026-07-07 09:53:18','2026-07-25 02:53:18'),(3,5,'submitted','2026-07-07 09:53:18','2026-07-25 02:53:18'),(4,6,'submitted','2026-07-04 09:53:18','2026-07-25 02:53:18'),(5,7,'submitted','2026-07-02 09:53:18','2026-07-25 02:53:18'),(6,8,'submitted','2026-07-01 09:53:18','2026-07-25 02:53:18'),(7,9,'submitted','2026-07-06 09:53:19','2026-07-25 02:53:19'),(8,10,'submitted','2026-07-01 09:53:19','2026-07-25 02:53:19'),(9,11,'submitted','2026-07-23 09:53:19','2026-07-25 02:53:19'),(10,12,'submitted','2026-07-25 09:53:19','2026-07-25 02:53:19'),(11,13,'submitted','2026-07-01 09:53:19','2026-07-25 02:53:19'),(12,14,'submitted','2026-07-25 09:53:19','2026-07-25 02:53:19'),(13,15,'submitted','2026-07-06 09:53:19','2026-07-25 02:53:19'),(14,16,'submitted','2026-07-19 09:53:19','2026-07-25 02:53:19'),(15,17,'submitted','2026-07-22 09:53:19','2026-07-25 02:53:19'),(16,18,'submitted','2026-06-27 09:53:19','2026-07-25 02:53:19'),(17,19,'submitted','2026-07-13 09:53:19','2026-07-25 02:53:19'),(18,20,'submitted','2026-07-18 09:53:19','2026-07-25 02:53:19'),(19,21,'submitted','2026-06-27 09:53:19','2026-07-25 02:53:19'),(20,22,'submitted','2026-06-26 09:53:19','2026-07-25 02:53:19'),(21,23,'submitted','2026-07-25 09:53:19','2026-07-25 02:53:19'),(22,24,'submitted','2026-07-18 09:53:19','2026-07-25 02:53:19'),(23,25,'submitted','2026-07-21 09:53:19','2026-07-25 02:53:19'),(24,26,'submitted','2026-07-23 09:53:19','2026-07-25 02:53:19'),(25,27,'submitted','2026-06-30 09:53:19','2026-07-25 02:53:19'),(26,28,'submitted','2026-06-26 09:53:19','2026-07-25 02:53:19'),(27,29,'submitted','2026-07-11 09:53:19','2026-07-25 02:53:19'),(28,30,'submitted','2026-07-15 09:53:19','2026-07-25 02:53:19'),(29,31,'submitted','2026-07-16 09:53:19','2026-07-25 02:53:19'),(30,32,'submitted','2026-07-09 09:53:19','2026-07-25 02:53:19'),(31,4,'submitted','2026-07-29 04:13:24','2026-07-29 04:13:24');
/*!40000 ALTER TABLE `tracer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `force_change_password` tinyint(1) DEFAULT '0',
  `name` varchar(120) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `force_change_password`, `name`, `is_active`, `last_login`, `created_at`) VALUES (1,1,'admin','admin@man1magelang.sch.id','$2y$10$APoPJwY1QtTpiqj3vkxtLup8qSSjx0culjP2CKIinynpLDQdxV.4C',0,'Super Admin',1,'2026-07-25 06:26:08','2026-07-24 01:41:23'),(2,2,'Admin_Biasa','Admin_Biasa@gmail.com','$2y$10$TcPWUvxq9/u4ZITb0Jcuvu2zAJX8b7a/6h2AArgeSsggq01/oowGK',0,'Admin_Biasa',1,'2026-10-15 08:53:29','2026-07-24 01:51:16'),(5,4,'87612451',NULL,'$2y$10$4xQKIbeTCV9lxCBw.Bnrc.G2GU8sKt47YSMS6Pg5y6IdR2bGEjBRO',0,'Ahmad Fauzan Pratama',1,'2026-07-29 04:15:11','2026-07-24 02:15:10'),(6,4,'87621934',NULL,'$2y$10$iY.xQeGSBrOwVVmrMpHu.eday9v2.TPU5x6Gx8EzatIynM74gX7t6',0,'Siti Nur Aisyah',1,'2026-07-29 04:11:35','2026-07-24 02:15:10'),(7,4,'87634178',NULL,'$2y$10$UpkCPAuwboSIz3OW/jUXcuf3nmgkLtm3M1BovmM9SndDd3lEiOP6G',0,'Muhammad Rizky Ramadhan',1,NULL,'2026-07-24 02:15:10'),(8,4,'87645289',NULL,'$2y$10$fVIcWuEhPx2Csh6hoOORaeO0RxsETAzcinRo3K..aN1MpUap.gKpe',0,'Nabila Putri Ananda',1,NULL,'2026-07-24 02:15:10'),(9,4,'87658142',NULL,'$2y$10$acsT1AQ1ShArC5mqxM07..yzdu11Z.8S9cKiPhelXmT7hJMCQmyNW',0,'Arif Maulana',1,NULL,'2026-07-24 02:15:10'),(10,4,'87662391',NULL,'$2y$10$keVqJsdb/aSWI67ixnl5R.v2i7bmHneE.kVPDFMGiIjhE4OebiCSK',0,'Dewi Lestari',1,NULL,'2026-07-24 02:15:10'),(11,4,'87674586',NULL,'$2y$10$PRsvyoati.3DQAc2y4eJH.ttthLGz/l.yqqG67rAYt04trZetP32i',0,'Fajar Hidayat',1,NULL,'2026-07-24 02:15:10'),(12,4,'87689753',NULL,'$2y$10$DzbiHmDOyd9t2Lfg89hnT.1QQcCfoRh7J8Xks.vmWLAQ5j/x0Inuu',0,'Intan Permatasari',1,NULL,'2026-07-24 02:15:10'),(13,4,'87693217',NULL,'$2y$10$d05Y5NmtOwYHvrg4UpQPPejTzA59aXUu9uMPgnx30ed.scTGT8xte',0,'Rizal Firmansyah',1,NULL,'2026-07-24 02:15:10'),(14,4,'87708465',NULL,'$2y$10$bzbJzQLo6a5or6BwyYkDMO8CBE/fMRMzl04s9SDM6jrjLkia5QY2e',0,'Yuni Kartika Sari',1,NULL,'2026-07-24 02:15:10'),(15,4,'87712948',NULL,'$2y$10$KeAqF.2Tgp6e6AB1kggIIeP7SlqyHKTx.TA0wdMGyuzAGXb.5XecC',0,'Bagus Saputra',1,NULL,'2026-07-24 02:15:10'),(16,4,'87726183',NULL,'$2y$10$e3XS0wNdUowq8UqjmHm1CO3Tzv5UXe9Lar2qXB3ZudJbSyR046Or2',0,'Nurul Hikmah',1,NULL,'2026-07-24 02:15:10'),(17,4,'87734057',NULL,'$2y$10$gCJrg1I.tqJwlGgB1p9b6utFCFhvmBaDzN1vspE1b234aIgNDl4xa',0,'Andika Putra',1,NULL,'2026-07-24 02:15:10'),(18,4,'87749812',NULL,'$2y$10$vzMl.O8Sr5IPN7wHWEvu1Oe6nu28uMqQcv8i7IQ95WFNKwmWcxCXS',0,'Laila Khairunnisa',1,NULL,'2026-07-24 02:15:10'),(19,4,'87751364',NULL,'$2y$10$R0mnFFR9t4NgJvqJPMiXye6vLJtsLerp5lZLfDIi1wqaN3LU6gMAG',0,'Hafidz Al Ghifari',1,NULL,'2026-07-24 02:15:10'),(20,4,'87765829',NULL,'$2y$10$lXgfmNgtwKoBNfQPLxS8Fet6UQp6EnXQZkvugJ9E3/ENUihidy9N.',0,'Anisa Rahmawati',1,NULL,'2026-07-24 02:15:10'),(21,4,'87776245',NULL,'$2y$10$DlGy5.HbsRd.TOnrK7819.DvDQ4ZFTBNWpmlNwPTwjT3JAEQdb5Ji',0,'Rahmat Hidayatullah',1,NULL,'2026-07-24 02:15:10'),(22,4,'87784913',NULL,'$2y$10$eTA4ZM0uRJmnFYcQqzRj9.rQzGeAOroXbEwFhgnyRB7jYa1cVJM2m',0,'Muhammad Fikri',1,NULL,'2026-07-24 02:15:10'),(23,4,'87798526',NULL,'$2y$10$9yt59cC.DevQoSdpaF/GT.w.D5wTiY0DcquzE/Ej7LwdaoQ15ITle',0,'Aulia Maharani',1,NULL,'2026-07-24 02:15:10'),(24,4,'87801349',NULL,'$2y$10$nm8wee0PiVLw4jl4D2sc4ul5QXwk7yxLVk14IrEBMuASK9DDmilOm',0,'Yusuf Maulana',1,NULL,'2026-07-24 02:15:11'),(25,4,'87816492',NULL,'$2y$10$B3rZFJ3dxvwxPmQJFWrxdepAihx05RZ6eFhfV/vcsfO9P2EgJ2qtm',0,'Nadya Safitri',1,NULL,'2026-07-24 02:15:11'),(26,4,'87824175',NULL,'$2y$10$VUHwh9ulLqiAI30DUqG1s.ik6frmGLCglX4Q6Olx/P7hFq1R9.w.W',0,'Fikri Alamsyah',1,NULL,'2026-07-24 02:15:11'),(27,4,'87839561',NULL,'$2y$10$otov/6NdYz92eX7BvhVxQuHiidTCP/D.iy2234LsFrVsH/QlctVm.',0,'Putri Amelia',1,NULL,'2026-07-24 02:15:11'),(28,4,'87842087',NULL,'$2y$10$4OTU3O.pC53czkP0daGdreneZOslCZUPEagpP4qCOg55/8JVkEsqi',0,'Galih Prakoso',1,NULL,'2026-07-24 02:15:11'),(29,4,'87857436',NULL,'$2y$10$4bV5k/KO/.aZpena0KYk0O2LJC6iZquSrkEhjnWb6ZuVDxrCT6qB.',0,'Rina Oktaviani',1,NULL,'2026-07-24 02:15:11'),(30,4,'87863194',NULL,'$2y$10$u.ScLV95qDKvCvONMnGLFeJzeG7QbeOEncyXaLbU7u7zrYwhU.mxO',0,'Ilham Akbar',1,NULL,'2026-07-24 02:15:11'),(31,4,'87875648',NULL,'$2y$10$Uy5uuoZKe31533UZRR9YUuvwZPVHx3gO4BVWpDEqPk.cgZZTzQDVq',0,'Salma Zahra',1,NULL,'2026-07-24 02:15:11'),(32,4,'87881265',NULL,'$2y$10$G1P3sCoRW9jL0ZozB3AY1uSge9CFYQkSpB0Cd53y03Q23YQrsrTgm',0,'Dimas Wahyu Nugroho',1,NULL,'2026-07-24 02:15:11'),(33,4,'87898371',NULL,'$2y$10$gL0R4uTWxl.ugcFk4clXxO7rgnd18s45SPs9zOCjGSH.kAe.UQwzq',0,'Cahya Nur Azizah',1,NULL,'2026-07-24 02:15:11'),(34,4,'87904518',NULL,'$2y$10$GFfH90HxEGh5EYLnWRJXhupKnnc7oTdXUQp0mBAGa72Ji7ogINcbK',0,'Reza Ardiansyah',1,NULL,'2026-07-24 02:15:11'),(35,3,'kepalasekolah','kepalasekolah@gmail.com','$2y$10$gsXCTIhChyajncX3Rh.DVO3YD9wsScBDiy15AWn8RrPC7zIaFXFeK',0,'kepalasekolah',1,'2026-07-25 06:27:39','2026-07-25 06:27:33'),(36,2,'zidan','zidan@gmail.com','$2y$10$du1jp1UdUzerubJQ6Vx.VOnfeCcoSoYNHNDLRhWZBLQmJnBzJ169y',0,'Zidan',1,'2026-10-15 08:47:27','2026-10-15 08:38:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'manstudy'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-15 17:44:01
