-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: lasimethris05
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  KEY `role_id_fk_6464585` (`role_id`),
  KEY `permission_id_fk_6464585` (`permission_id`),
  CONSTRAINT `permission_id_fk_6464585` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_id_fk_6464585` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,47),(1,48),(1,49),(1,50),(1,51),(1,52),(1,53),(1,54),(1,55),(1,56),(1,57),(1,58),(1,59),(1,60),(1,61),(1,62),(1,63),(1,64),(1,65),(1,66),(1,67),(1,68),(1,69),(1,70),(1,71),(1,72),(1,73),(1,74),(1,75),(1,76),(1,77),(1,78),(1,79),(1,80),(1,81),(1,82),(1,83),(1,84),(1,85),(1,86),(1,92),(1,93),(1,94),(1,95),(1,96),(1,107),(1,109),(1,110),(1,111),(1,112),(1,113),(1,114),(1,115),(1,116),(1,117),(1,118),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,23),(2,25),(2,26),(2,27),(2,28),(2,29),(2,30),(2,31),(2,32),(2,33),(2,34),(2,35),(2,36),(2,37),(2,38),(2,39),(2,40),(2,41),(2,42),(2,43),(2,44),(2,45),(2,46),(2,47),(2,48),(2,49),(2,50),(2,51),(2,52),(2,53),(2,54),(2,55),(2,56),(2,57),(2,58),(2,59),(2,60),(2,61),(2,62),(2,63),(2,64),(2,65),(2,66),(2,67),(2,68),(2,69),(2,70),(2,71),(2,72),(2,73),(2,74),(2,75),(2,76),(2,77),(2,78),(2,79),(2,80),(2,81),(2,82),(2,83),(2,84),(2,85),(2,86),(2,87),(2,88),(2,89),(2,90),(2,91),(2,92),(2,93),(2,94),(2,95),(2,96),(2,97),(2,98),(2,99),(2,100),(2,101),(2,102),(2,103),(2,104),(2,105),(2,106),(2,107),(2,108),(2,109),(2,110),(2,111),(2,112),(2,113),(2,114),(2,115),(2,116),(2,117),(2,118),(5,21),(5,20),(5,45),(5,19),(3,21),(3,20),(3,48),(3,53),(3,46),(3,43),(3,44),(3,45),(3,19),(6,21),(6,19),(4,21);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `perm_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `grp_title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'user_management_access','5','User management',NULL,NULL,NULL),(2,'permission_create','1','Permissions',NULL,NULL,NULL),(3,'permission_edit','2','Permissions',NULL,NULL,NULL),(4,'permission_show','3','Permissions',NULL,NULL,NULL),(5,'permission_delete','4','Permissions',NULL,NULL,NULL),(6,'permission_access','5','Permissions',NULL,NULL,NULL),(7,'role_create','1','Roles',NULL,NULL,NULL),(8,'role_edit','2','Roles',NULL,NULL,NULL),(9,'role_show','3','Roles',NULL,NULL,NULL),(10,'role_delete','4','Roles',NULL,NULL,NULL),(11,'role_access','5','Roles',NULL,NULL,NULL),(12,'user_create','1','Users',NULL,NULL,NULL),(13,'user_edit','2','Users',NULL,NULL,NULL),(14,'user_show','3','Users',NULL,NULL,NULL),(15,'user_delete','4','Users',NULL,NULL,NULL),(16,'user_access','5','Users',NULL,NULL,NULL),(17,'audit_log_show','3','Audit Logs',NULL,NULL,NULL),(18,'audit_log_access','5','Audit Logs',NULL,NULL,NULL),(19,'profile_password_edit','2','Profile',NULL,NULL,NULL),(20,'dashboard_access','5','Dashboard',NULL,NULL,NULL),(21,'landing_access','5','Landing',NULL,NULL,NULL),(22,'dashboardv_access','5','Dashboard Verifikator',NULL,NULL,NULL),(23,'dashboarda_access','5','Dashboard Admin',NULL,NULL,NULL),(24,'user_task_access','5','Proses RIPH',NULL,NULL,NULL),(25,'pull_access','5','Tarik Data RIPH',NULL,NULL,NULL),(26,'commitment_access','5','Daftar RIPH',NULL,NULL,NULL),(27,'kelompoktani_access','5','Kelompok Tani',NULL,NULL,NULL),(28,'permohonan_access','5','Permohonan',NULL,NULL,NULL),(29,'pengajuan_access','5','Pengajuan Verifikasi',NULL,NULL,NULL),(30,'pengajuan_create','1','Pengajuan Verifikasi',NULL,NULL,NULL),(31,'pengajuan_edit','2','Pengajuan Verifikasi',NULL,NULL,NULL),(32,'pengajuan_show','3','Pengajuan Verifikasi',NULL,NULL,NULL),(33,'pengajuan_delete','4','Pengajuan Verifikasi',NULL,NULL,NULL),(34,'skl_access','5','SKL Terbit',NULL,NULL,NULL),(35,'skl_create','1','Daftar SKL',NULL,NULL,NULL),(36,'skl_edit','2','Daftar SKL',NULL,NULL,NULL),(37,'skl_show','3','Daftar SKL',NULL,NULL,NULL),(38,'skl_delete','4','Daftar SKL',NULL,NULL,NULL),(39,'folder_access','5','Pengelolaan Berkas',NULL,NULL,NULL),(40,'berkas_access','5','Berkas Saya',NULL,NULL,NULL),(41,'galeri_access','5','Galeri Saya',NULL,NULL,NULL),(42,'template_access','5','Template Master',NULL,NULL,NULL),(43,'onfarm_access','5','Onfarm',NULL,NULL,NULL),(44,'online_access','5','Online',NULL,NULL,NULL),(45,'completed_access','5','Completed',NULL,NULL,NULL),(46,'verificator_task_access','5','Verificator task',NULL,NULL,NULL),(47,'feedmsg_access','5','Feed & Messages',NULL,NULL,NULL),(48,'feeds_access','5','Feeds',NULL,NULL,NULL),(49,'feeds_create','1','Feeds',NULL,NULL,NULL),(50,'feeds_edit','2','Feeds',NULL,NULL,NULL),(51,'feeds_show','3','Feeds',NULL,NULL,NULL),(52,'feeds_delete','4','Feeds',NULL,NULL,NULL),(53,'messenger_access','5','Messenger',NULL,NULL,NULL),(54,'messenger_create','1','Messenger',NULL,NULL,NULL),(55,'messenger_edit','2','Messenger',NULL,NULL,NULL),(56,'messenger_show','3','Messenger',NULL,NULL,NULL),(57,'messenger_delete','4','Messenger',NULL,NULL,NULL),(58,'verification_skl_access','5','Verificator SKL',NULL,NULL,NULL),(59,'list_skl_access','5','SKL List',NULL,NULL,NULL),(60,'list_skl_create','1','SKL List',NULL,NULL,NULL),(61,'list_skl_edit','2','SKL List',NULL,NULL,NULL),(62,'list_skl_show','3','SKL List',NULL,NULL,NULL),(63,'list_skl_delete','4','SKL List',NULL,NULL,NULL),(64,'create_skl_access','5','Create SKL',NULL,NULL,NULL),(65,'issued_skl_access','5','Issued SKL',NULL,NULL,NULL),(66,'administrator_access','5','Administrator',NULL,NULL,NULL),(67,'create_skl_create','1','Create SKL',NULL,NULL,NULL),(68,'create_skl_edit','2','Create SKL',NULL,NULL,NULL),(69,'create_skl_show','3','Create SKL',NULL,NULL,NULL),(70,'create_skl_delete','4','Create SKL',NULL,NULL,NULL),(71,'issued_skl_create','1','Issued SKL',NULL,NULL,NULL),(72,'issued_skl_edit','2','Issued SKL',NULL,NULL,NULL),(73,'issued_skl_show','3','Issued SKL',NULL,NULL,NULL),(74,'issued_skl_delete','4','Issued SKL',NULL,NULL,NULL),(75,'master_riph_access','5','Master Data RIPH',NULL,NULL,NULL),(76,'data_report_access','5','Data Report',NULL,NULL,NULL),(77,'master_template_access','5','Master Template',NULL,NULL,NULL),(78,'commitment_list_access','5','Commitment List',NULL,NULL,NULL),(79,'verification_report_access','5','Verification Report',NULL,NULL,NULL),(80,'verif_onfarm_access','5','Onfarm Report',NULL,NULL,NULL),(81,'verif_online_access','5','Online Report',NULL,NULL,NULL),(82,'admin_SKL_access','5','SKL',NULL,NULL,NULL),(83,'master_riph_edit','2','Master Data RIPH',NULL,NULL,NULL),(84,'master_riph_create','1','Master Data RIPH',NULL,NULL,NULL),(85,'master_riph_show','3','Master Data RIPH',NULL,NULL,NULL),(86,'master_riph_delete','4','Master Data RIPH',NULL,NULL,NULL),(87,'commitment_create','1','Commitment',NULL,NULL,NULL),(88,'commitment_edit','2','Daftar RIPH',NULL,NULL,NULL),(89,'commitment_delete','4','Daftar RIPH',NULL,NULL,NULL),(90,'commitment_show','3','Daftar RIPH',NULL,NULL,NULL),(91,'hello_edit','2','Data Report',NULL,NULL,NULL),(92,'provinsi_access','5','Provinsi',NULL,NULL,NULL),(93,'kabupaten_access','5','Kabupaten',NULL,NULL,NULL),(94,'kecamatan_access','5','Kecamatan',NULL,NULL,NULL),(95,'desa_access','5','Desa',NULL,NULL,NULL),(96,'master_wilayah_access','5','Master Wilayah',NULL,NULL,NULL),(97,'poktan_create','1','Daftar Kelompok Tani',NULL,NULL,NULL),(98,'poktan_edit','2','Daftar Kelompok Tani',NULL,NULL,NULL),(99,'poktan_show','3','Daftar Kelompok Tani',NULL,NULL,NULL),(100,'poktan_delete','4','Daftar Kelompok Tani',NULL,NULL,NULL),(101,'daftar_riph_create','1','Daftar RIPH',NULL,NULL,NULL),(102,'pks_access','5','Daftar PKS',NULL,NULL,NULL),(103,'poktan_access','5','Daftar Kelompok Tani',NULL,NULL,NULL),(104,'pks_create','1','Daftar PKS',NULL,NULL,NULL),(105,'pks_edit','2','Daftar PKS',NULL,NULL,NULL),(106,'pks_show','3','Daftar PKS',NULL,NULL,NULL),(107,'pks_delete','4','Daftar PKS',NULL,NULL,NULL),(108,'v2access','5','V2',NULL,'2023-06-24 12:24:54',NULL),(109,'varietas_access','5','Varietas',NULL,NULL,NULL),(110,'varietas_create','1','Varietas',NULL,NULL,NULL),(111,'varietas_show','3','Varietas',NULL,NULL,NULL),(112,'varietas_edit','2','Varietas',NULL,NULL,NULL),(113,'varietas_delete','4','Varietas',NULL,NULL,NULL),(114,'old_skl_access','5','Old Skl',NULL,NULL,NULL),(115,'old_skl_create','1','Old Skl',NULL,NULL,NULL),(116,'old_skl_edit','2','Old Skl',NULL,NULL,NULL),(117,'old_skl_show','3','Old Skl',NULL,NULL,NULL),(118,'old_skl_delete','4','Old Skl',NULL,NULL,NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  KEY `user_id_fk_6464594` (`user_id`),
  KEY `role_id_fk_6464594` (`role_id`),
  CONSTRAINT `role_id_fk_6464594` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_fk_6464594` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(4,3),(2,2),(5,6),(3,5);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin',NULL,NULL,NULL),(2,'User',NULL,NULL,NULL),(3,'Verifikator',NULL,NULL,NULL),(4,'user_v2',NULL,NULL,NULL),(5,'Pejabat',NULL,NULL,NULL),(6,'API',NULL,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-24 19:38:31
