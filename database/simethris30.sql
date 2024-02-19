/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80031
 Source Host           : localhost:3306
 Source Schema         : simethris30

 Target Server Type    : MySQL
 Target Server Version : 80031
 File Encoding         : 65001

 Date: 26/02/2023 00:32:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for audit_logs
-- ----------------------------
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `properties` text COLLATE utf8mb3_unicode_ci,
  `host` varchar(46) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of audit_logs
-- ----------------------------
BEGIN;
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (1, 'audit:created', 1, 'App\\Models\\User#1', 53, '{\"username\":\"luthfi.s2022\",\"roleaccess\":2,\"name\":\"MAYA SARI IRELA\",\"email\":\"ladang_rt@yahoo.com\",\"updated_at\":\"2023-02-25 23:28:42\",\"created_at\":\"2023-02-25 23:28:42\",\"id\":1}', '127.0.0.1', '2023-02-25 23:28:42', '2023-02-25 23:28:42');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (2, 'audit:created', 1, 'App\\Models\\DataUser#1', NULL, '{\"user_id\":53,\"company_name\":\"LADANG REZEKI TANI\",\"name\":\"MAYA SARI IRELA\",\"mobile_phone\":\"082276029118\",\"fix_phone\":\"082276029118\",\"pic_name\":\"MAYA SARI IRELA\",\"jabatan\":\"DIREKTUR\",\"npwp_company\":\"42.214.798.3-604.000\",\"nib_company\":\"1237005432329\",\"address_company\":\"Perumahan Wisata Bukit Mas Blok K Nomor 5\",\"provinsi\":\"35\",\"kabupaten\":\"3578\",\"kodepos\":\"60213\",\"ktp\":\"1116015705970001\",\"fax\":\"\",\"email_company\":\"ladang_rt@yahoo.com\",\"updated_at\":\"2023-02-25 23:41:10\",\"created_at\":\"2023-02-25 23:41:10\",\"id\":1}', '127.0.0.1', '2023-02-25 23:41:10', '2023-02-25 23:41:10');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (3, 'audit:created', 1, 'App\\Models\\PullRiph#1', 53, '{\"npwp\":\"42.214.798.3-604.000\",\"no_ijin\":\"0106\\/PP.240\\/D\\/03\\/2022\",\"keterangan\":\"SUCCESS\",\"nama\":\"LADANG REZEKI TANI\",\"periodetahun\":\"2022\",\"tgl_ijin\":\"2022-03-14\",\"tgl_akhir\":\"2022-12-31\",\"no_hs\":\"07032090- - Bawang putih, segar atau dingin\",\"volume_riph\":\"9976\",\"volume_produksi\":\"498.8\",\"luas_wajib_tanam\":\"83.13\",\"datariph\":\"uploads\\/422147983604000\\/0106PP240D032022.json\",\"updated_at\":\"2023-02-25T16:41:37.000000Z\",\"created_at\":\"2023-02-25T16:41:37.000000Z\",\"id\":1}', '127.0.0.1', '2023-02-25 23:41:37', '2023-02-25 23:41:37');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (4, 'audit:updated', 90, 'App\\Models\\Permission#90', 1, '{\"grp_title\":\"Daftar RIPH\",\"updated_at\":\"2023-02-25 23:47:54\",\"id\":90}', '127.0.0.1', '2023-02-25 23:47:54', '2023-02-25 23:47:54');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (5, 'audit:updated', 89, 'App\\Models\\Permission#89', 1, '{\"grp_title\":\"Daftar RIPH\",\"updated_at\":\"2023-02-25 23:48:12\",\"id\":89}', '127.0.0.1', '2023-02-25 23:48:12', '2023-02-25 23:48:12');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (6, 'audit:updated', 88, 'App\\Models\\Permission#88', 1, '{\"grp_title\":\"Daftar RIPH\",\"updated_at\":\"2023-02-25 23:48:48\",\"id\":88}', '127.0.0.1', '2023-02-25 23:48:48', '2023-02-25 23:48:48');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (7, 'audit:updated', 26, 'App\\Models\\Permission#26', 1, '{\"grp_title\":\"Proses RIPH\",\"updated_at\":\"2023-02-25 23:49:37\",\"id\":26}', '127.0.0.1', '2023-02-25 23:49:37', '2023-02-25 23:49:37');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (8, 'audit:updated', 25, 'App\\Models\\Permission#25', 1, '{\"grp_title\":\"Tarik Data RIPH\",\"updated_at\":\"2023-02-25 23:50:47\",\"id\":25}', '127.0.0.1', '2023-02-25 23:50:47', '2023-02-25 23:50:47');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (9, 'audit:updated', 33, 'App\\Models\\Permission#33', 1, '{\"grp_title\":\"Pengajuan\",\"updated_at\":\"2023-02-25 23:51:09\",\"id\":33}', '127.0.0.1', '2023-02-25 23:51:09', '2023-02-25 23:51:09');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (10, 'audit:updated', 32, 'App\\Models\\Permission#32', 1, '{\"grp_title\":\"Pengajuan\",\"updated_at\":\"2023-02-25 23:51:20\",\"id\":32}', '127.0.0.1', '2023-02-25 23:51:20', '2023-02-25 23:51:20');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (11, 'audit:updated', 31, 'App\\Models\\Permission#31', 1, '{\"grp_title\":\"Pengajuan\",\"updated_at\":\"2023-02-25 23:51:32\",\"id\":31}', '127.0.0.1', '2023-02-25 23:51:32', '2023-02-25 23:51:32');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (12, 'audit:updated', 30, 'App\\Models\\Permission#30', 1, '{\"grp_title\":\"Pengajuan\",\"updated_at\":\"2023-02-25 23:51:41\",\"id\":30}', '127.0.0.1', '2023-02-25 23:51:42', '2023-02-25 23:51:42');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (13, 'audit:updated', 29, 'App\\Models\\Permission#29', 1, '{\"grp_title\":\"Pengajuan\",\"updated_at\":\"2023-02-25 23:51:52\",\"id\":29}', '127.0.0.1', '2023-02-25 23:51:52', '2023-02-25 23:51:52');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (14, 'audit:updated', 24, 'App\\Models\\Permission#24', 1, '{\"grp_title\":\"Proses RIPH\",\"updated_at\":\"2023-02-25 23:53:01\",\"id\":24}', '127.0.0.1', '2023-02-25 23:53:01', '2023-02-25 23:53:01');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (15, 'audit:updated', 28, 'App\\Models\\Permission#28', 1, '{\"grp_title\":\"Verificator task\",\"updated_at\":\"2023-02-25 23:53:33\",\"id\":28}', '127.0.0.1', '2023-02-25 23:53:33', '2023-02-25 23:53:33');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (16, 'audit:updated', 28, 'App\\Models\\Permission#28', 1, '{\"title\":\"permohonan_access\",\"grp_title\":\"Permohonan\",\"updated_at\":\"2023-02-26 00:05:59\",\"id\":28}', '127.0.0.1', '2023-02-26 00:05:59', '2023-02-26 00:05:59');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (17, 'audit:updated', 34, 'App\\Models\\Permission#34', 1, '{\"grp_title\":\"SKL Terbit\",\"updated_at\":\"2023-02-26 00:07:07\",\"id\":34}', '127.0.0.1', '2023-02-26 00:07:07', '2023-02-26 00:07:07');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (18, 'audit:created', 101, 'App\\Models\\Permission#101', 1, '{\"title\":\"daftar_riph_create\",\"perm_type\":\"1\",\"grp_title\":\"Daftar RIPH\",\"updated_at\":\"2023-02-26 00:19:49\",\"created_at\":\"2023-02-26 00:19:49\",\"id\":101}', '127.0.0.1', '2023-02-26 00:19:49', '2023-02-26 00:19:49');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (19, 'audit:updated', 26, 'App\\Models\\Permission#26', 1, '{\"grp_title\":\"Daftar RIPH\",\"updated_at\":\"2023-02-26 00:21:56\",\"id\":26}', '127.0.0.1', '2023-02-26 00:21:56', '2023-02-26 00:21:56');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (20, 'audit:deleted', 44, 'App\\Models\\User#44', 1, '{\"id\":44,\"name\":\"RICKY SUTANTO\",\"username\":\"some\",\"email\":\"Digitalone8@gmail.com\",\"email_verified_at\":null,\"roleaccess\":3,\"created_at\":\"2022-11-22 10:59:33\",\"updated_at\":\"2023-02-26 00:29:20\",\"deleted_at\":\"2023-02-26 00:29:20\"}', '127.0.0.1', '2023-02-26 00:29:20', '2023-02-26 00:29:20');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (21, 'audit:deleted', 2, 'App\\Models\\User#2', 1, '{\"id\":2,\"name\":\"Ricky\",\"username\":\"rickysut\",\"email\":\"ricky@sali-evo.com\",\"email_verified_at\":null,\"roleaccess\":2,\"created_at\":\"2022-10-04 09:34:27\",\"updated_at\":\"2023-02-26 00:29:28\",\"deleted_at\":\"2023-02-26 00:29:28\"}', '127.0.0.1', '2023-02-26 00:29:28', '2023-02-26 00:29:28');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (22, 'audit:deleted', 51, 'App\\Models\\User#51', 1, '{\"id\":51,\"name\":\"cuncun\",\"username\":\"cuncun\",\"email\":\"cun@cun.com\",\"email_verified_at\":null,\"roleaccess\":3,\"created_at\":\"2022-12-25 00:05:00\",\"updated_at\":\"2023-02-26 00:30:28\",\"deleted_at\":\"2023-02-26 00:30:28\"}', '127.0.0.1', '2023-02-26 00:30:28', '2023-02-26 00:30:28');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (23, 'audit:deleted', 4, 'App\\Models\\User#4', 1, '{\"id\":4,\"name\":\"Herman\",\"username\":\"herman\",\"email\":\"herman@gmail.com\",\"email_verified_at\":null,\"roleaccess\":3,\"created_at\":\"2022-10-31 14:43:00\",\"updated_at\":\"2023-02-26 00:30:34\",\"deleted_at\":\"2023-02-26 00:30:34\"}', '127.0.0.1', '2023-02-26 00:30:35', '2023-02-26 00:30:35');
INSERT INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES (24, 'audit:deleted', 15, 'App\\Models\\User#15', 1, '{\"id\":15,\"name\":\"company1 satu\",\"username\":\"company1\",\"email\":\"company1@satu.com\",\"email_verified_at\":null,\"roleaccess\":3,\"created_at\":\"2022-11-10 13:10:11\",\"updated_at\":\"2023-02-26 00:30:43\",\"deleted_at\":\"2023-02-26 00:30:43\"}', '127.0.0.1', '2023-02-26 00:30:43', '2023-02-26 00:30:43');
COMMIT;

-- ----------------------------
-- Table structure for berkas
-- ----------------------------
DROP TABLE IF EXISTS `berkas`;
CREATE TABLE `berkas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kind` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of berkas
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for commitments
-- ----------------------------
DROP TABLE IF EXISTS `commitments`;
CREATE TABLE `commitments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of commitments
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for completeds
-- ----------------------------
DROP TABLE IF EXISTS `completeds`;
CREATE TABLE `completeds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of completeds
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for data_users
-- ----------------------------
DROP TABLE IF EXISTS `data_users`;
CREATE TABLE `data_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `mobile_phone` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `fix_phone` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `pic_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `npwp_company` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nib_company` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address_company` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `desa` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `kodepos` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ktp` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ktp_image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `assignment` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email_company` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_users_user_id_unique` (`user_id`),
  CONSTRAINT `data_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of data_users
-- ----------------------------
BEGIN;
INSERT INTO `data_users` (`id`, `user_id`, `name`, `mobile_phone`, `fix_phone`, `company_name`, `pic_name`, `jabatan`, `npwp_company`, `nib_company`, `address_company`, `provinsi`, `kabupaten`, `kecamatan`, `desa`, `kodepos`, `fax`, `ktp`, `ktp_image`, `assignment`, `avatar`, `logo`, `email_company`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 53, 'MAYA SARI IRELA', '082276029118', '082276029118', 'LADANG REZEKI TANI', 'MAYA SARI IRELA', 'DIREKTUR', '42.214.798.3-604.000', '1237005432329', 'Perumahan Wisata Bukit Mas Blok K Nomor 5', '35', '3578', NULL, NULL, '60213', '', '1116015705970001', NULL, NULL, NULL, NULL, 'ladang_rt@yahoo.com', '2023-02-25 23:41:10', '2023-02-25 23:41:10', NULL);
COMMIT;

-- ----------------------------
-- Table structure for kelompoktanis
-- ----------------------------
DROP TABLE IF EXISTS `kelompoktanis`;
CREATE TABLE `kelompoktanis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `cpcl_id` bigint unsigned NOT NULL,
  `no_poktan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nama_poktan` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `desa` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `jumlah_anggota` int NOT NULL,
  `luas_lahan` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of kelompoktanis
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2022_04_30_000001_create_audit_logs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2022_04_30_000002_create_permissions_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2022_04_30_000003_create_roles_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2022_04_30_000004_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2022_04_30_000013_create_permission_role_pivot_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2022_04_30_000014_create_role_user_pivot_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2022_04_30_000020_create_qa_topics_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2022_04_30_000021_create_qa_messages_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2022_10_19_145238_create_pull_riphs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2022_10_19_152548_create_commitments_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13, '2022_11_02_141756_create_kelompoktanis_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14, '2022_11_03_071309_create_pengajuans_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15, '2022_11_03_071323_create_skls_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16, '2022_11_03_074614_create_berkas_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17, '2022_11_05_141518_create_onfarms_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18, '2022_11_05_141529_create_onlines_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19, '2022_11_05_141539_create_completeds_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20, '2022_11_06_144001_create_data_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21, '2022_12_15_170226_create_riph_admins_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22, '2023_01_09_231307_create_poktans_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23, '2023_02_02_185929_create_readarticles_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24, '2023_02_02_232101_create_categories_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25, '2023_02_02_232103_create_posts_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for onfarms
-- ----------------------------
DROP TABLE IF EXISTS `onfarms`;
CREATE TABLE `onfarms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of onfarms
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for onlines
-- ----------------------------
DROP TABLE IF EXISTS `onlines`;
CREATE TABLE `onlines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of onlines
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pengajuans
-- ----------------------------
DROP TABLE IF EXISTS `pengajuans`;
CREATE TABLE `pengajuans` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `no_doc` varchar(13) COLLATE utf8mb3_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `jenis` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengajuans_no_doc_unique` (`no_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of pengajuans
-- ----------------------------
BEGIN;
INSERT INTO `pengajuans` (`id`, `no_doc`, `detail`, `jenis`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, '063c129164cb4', '0106/PP.240/D/03/2022', 1, 1, '2023-01-13 16:49:10', '2023-01-13 16:49:10', NULL);
COMMIT;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  KEY `role_id_fk_6464585` (`role_id`),
  KEY `permission_id_fk_6464585` (`permission_id`),
  CONSTRAINT `permission_id_fk_6464585` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_id_fk_6464585` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 1);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 2);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 3);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 4);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 5);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 6);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 7);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 8);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 9);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 10);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 11);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 12);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 13);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 14);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 15);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 16);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 17);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 18);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 26);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 20);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 24);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 19);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 27);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 28);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 29);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 30);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 32);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 31);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 33);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 34);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 39);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 40);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 41);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 42);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 39);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 40);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 41);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 42);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 43);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 44);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 46);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 66);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 24);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 27);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 75);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 76);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 77);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 78);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 79);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 80);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 81);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 59);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 60);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 62);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 61);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 63);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 82);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 21);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 47);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 48);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 49);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 51);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 50);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 52);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 53);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 54);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 56);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 55);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 57);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 84);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 85);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 83);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 86);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 89);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 89);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 90);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 90);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 97);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 99);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 98);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 100);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 88);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 27);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 97);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 99);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 98);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 100);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 25);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 90);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 88);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 89);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 29);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 30);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 32);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 31);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 33);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 39);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 40);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 41);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 42);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 28);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 43);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 44);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 45);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 58);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 64);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 67);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 69);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 68);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 70);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 65);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 71);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 73);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 72);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 74);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 96);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 92);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 93);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 94);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 95);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 34);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 35);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 37);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 36);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 38);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 25);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 29);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 30);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 32);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 31);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 33);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 46);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 45);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 58);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 59);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 60);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 62);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 61);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 63);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 64);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 67);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 69);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 68);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 70);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 65);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 71);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 73);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 72);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (3, 74);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 97);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 99);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 98);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 100);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 28);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 34);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 88);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 101);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (2, 24);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 25);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (4, 26);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 26);
INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES (1, 101);
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `perm_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `grp_title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'user_management_access', '5', 'User management', NULL, '2022-10-05 07:43:13', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'permission_create', '1', 'Permissions', NULL, '2022-10-05 07:47:01', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'permission_edit', '2', 'Permissions', NULL, '2022-10-05 07:46:35', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'permission_show', '3', 'Permissions', NULL, '2022-10-05 07:46:24', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 'permission_delete', '4', 'Permissions', NULL, '2022-10-05 07:46:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 'permission_access', '5', 'Permissions', NULL, '2022-10-05 07:47:13', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 'role_create', '1', 'Roles', NULL, '2022-10-05 07:45:23', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 'role_edit', '2', 'Roles', NULL, '2022-10-05 07:44:56', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 'role_show', '3', 'Roles', NULL, '2022-10-05 07:44:46', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (10, 'role_delete', '4', 'Roles', NULL, '2022-10-05 07:45:05', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (11, 'role_access', '5', 'Roles', NULL, '2022-10-05 07:45:42', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (12, 'user_create', '1', 'Users', NULL, '2022-10-05 07:44:10', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (13, 'user_edit', '2', 'Users', NULL, '2022-10-05 07:43:41', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (14, 'user_show', '3', 'Users', NULL, '2022-10-05 07:43:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (15, 'user_delete', '4', 'Users', NULL, '2022-10-05 07:43:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (16, 'user_access', '5', 'Users', NULL, '2022-10-05 07:44:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (17, 'audit_log_show', '3', 'Audit Logs', NULL, '2022-10-05 07:47:23', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (18, 'audit_log_access', '5', 'Audit Logs', NULL, '2022-10-05 07:47:34', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (19, 'profile_password_edit', '2', 'Profile', NULL, '2022-10-05 07:46:09', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (20, 'dashboard_access', '5', 'Dashboard', '2022-10-05 08:18:49', '2022-10-13 15:32:35', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (21, 'landing_access', '5', 'Landing', '2022-10-05 15:03:17', '2022-10-13 15:32:49', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (22, 'dashboardv_access', '5', 'Dashboard Verifikator', '2022-10-07 06:52:04', '2022-10-13 15:34:10', '2022-10-13 15:34:10');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (23, 'dashboarda_access', '5', 'Dashboard Admin', '2022-10-07 06:52:32', '2022-10-13 15:34:17', '2022-10-13 15:34:17');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (24, 'user_task_access', '5', 'Proses RIPH', '2022-10-13 15:46:06', '2023-02-25 23:53:01', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (25, 'pull_access', '5', 'Tarik Data RIPH', '2022-10-13 16:16:43', '2023-02-25 23:50:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (26, 'commitment_access', '5', 'Daftar RIPH', '2022-10-13 16:17:05', '2023-02-26 00:21:56', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (27, 'kelompoktani_access', '5', 'Kelompok Tani', '2022-11-02 14:29:05', '2022-11-02 14:29:05', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (28, 'permohonan_access', '5', 'Permohonan', '2022-11-03 06:39:24', '2023-02-26 00:05:59', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (29, 'pengajuan_access', '5', 'Pengajuan', '2022-11-03 06:42:35', '2023-02-25 23:51:52', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (30, 'pengajuan_create', '1', 'Pengajuan', '2022-11-03 06:42:55', '2023-02-25 23:51:41', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (31, 'pengajuan_edit', '2', 'Pengajuan', '2022-11-03 06:47:01', '2023-02-25 23:51:32', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (32, 'pengajuan_show', '3', 'Pengajuan', '2022-11-03 06:47:19', '2023-02-25 23:51:20', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (33, 'pengajuan_delete', '4', 'Pengajuan', '2022-11-03 06:47:35', '2023-02-25 23:51:09', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (34, 'skl_access', '5', 'SKL Terbit', '2022-11-03 06:47:53', '2023-02-26 00:07:07', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (35, 'skl_create', '1', 'Daftar SKL', '2022-11-03 06:48:10', '2022-11-03 06:48:10', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (36, 'skl_edit', '2', 'Daftar SKL', '2022-11-03 06:48:24', '2022-11-03 06:48:24', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (37, 'skl_show', '3', 'Daftar SKL', '2022-11-03 06:48:40', '2022-11-03 06:48:40', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (38, 'skl_delete', '4', 'Daftar SKL', '2022-11-03 06:48:54', '2022-11-03 06:48:54', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (39, 'folder_access', '5', 'Pengelolaan Berkas', '2022-11-03 07:43:51', '2022-11-03 07:43:51', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (40, 'berkas_access', '5', 'Berkas Saya', '2022-11-03 07:44:05', '2022-11-03 07:44:05', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (41, 'galeri_access', '5', 'Galeri Saya', '2022-11-03 07:44:19', '2022-11-03 07:44:19', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (42, 'template_access', '5', 'Template Master', '2022-11-03 07:44:35', '2022-11-03 07:44:35', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (43, 'onfarm_access', '5', 'Onfarm', '2022-11-05 15:12:36', '2022-11-05 15:12:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (44, 'online_access', '5', 'Online', '2022-11-05 15:12:53', '2022-11-05 15:12:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (45, 'completed_access', '5', 'Completed', '2022-11-05 15:13:11', '2022-11-05 15:13:11', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (46, 'verificator_task_access', '5', 'Verificator task', '2022-11-24 15:44:34', '2022-11-24 15:44:34', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (47, 'feedmsg_access', '5', 'Feed & Messages', '2022-11-25 11:09:04', '2022-11-25 11:09:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (48, 'feeds_access', '5', 'Feeds', '2022-11-25 11:16:25', '2022-11-25 11:16:25', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (49, 'feeds_create', '1', 'Feeds', '2022-11-25 11:17:07', '2022-11-25 11:17:07', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (50, 'feeds_edit', '2', 'Feeds', '2022-11-25 11:17:26', '2022-11-25 11:17:26', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (51, 'feeds_show', '3', 'Feeds', '2022-11-25 11:17:47', '2022-11-25 11:17:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (52, 'feeds_delete', '4', 'Feeds', '2022-11-25 11:19:47', '2022-11-25 11:19:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (53, 'messenger_access', '5', 'Messenger', '2022-11-25 11:22:42', '2022-11-25 11:22:42', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (54, 'messenger_create', '1', 'Messenger', '2022-11-25 11:22:58', '2022-11-25 11:22:58', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (55, 'messenger_edit', '2', 'Messenger', '2022-11-25 11:23:13', '2022-11-25 11:23:13', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (56, 'messenger_show', '3', 'Messenger', '2022-11-25 11:23:27', '2022-11-25 11:23:27', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (57, 'messenger_delete', '4', 'Messenger', '2022-11-25 11:23:45', '2022-11-25 11:23:45', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (58, 'verification_skl_access', '5', 'Verificator SKL', '2022-11-26 16:44:37', '2022-11-26 16:44:37', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (59, 'list_skl_access', '5', 'SKL List', '2022-11-26 16:51:36', '2022-11-26 16:51:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (60, 'list_skl_create', '1', 'SKL List', '2022-11-26 16:51:57', '2022-11-26 16:51:57', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (61, 'list_skl_edit', '2', 'SKL List', '2022-11-26 16:52:15', '2022-11-26 16:52:15', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (62, 'list_skl_show', '3', 'SKL List', '2022-11-26 16:52:33', '2022-11-26 16:52:33', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (63, 'list_skl_delete', '4', 'SKL List', '2022-11-26 16:52:50', '2022-11-26 16:52:50', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (64, 'create_skl_access', '5', 'Create SKL', '2022-11-26 16:59:53', '2022-11-26 16:59:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (65, 'issued_skl_access', '5', 'Issued SKL', '2022-11-26 17:00:11', '2022-11-26 17:00:11', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (66, 'administrator_access', '5', 'Administrator', '2022-11-29 04:58:04', '2022-11-29 04:58:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (67, 'create_skl_create', '1', 'Create SKL', '2022-11-29 06:02:46', '2022-11-29 06:02:46', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (68, 'create_skl_edit', '2', 'Create SKL', '2022-11-29 06:23:47', '2022-11-29 06:23:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (69, 'create_skl_show', '3', 'Create SKL', '2022-11-29 06:24:09', '2022-11-29 06:24:09', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (70, 'create_skl_delete', '4', 'Create SKL', '2022-11-29 06:24:28', '2022-11-29 06:24:28', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (71, 'issued_skl_create', '1', 'Issued SKL', '2022-11-29 06:24:47', '2022-11-29 06:24:47', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (72, 'issued_skl_edit', '2', 'Issued SKL', '2022-11-29 06:25:04', '2022-11-29 06:25:04', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (73, 'issued_skl_show', '3', 'Issued SKL', '2022-11-29 06:25:24', '2022-11-29 06:25:24', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (74, 'issued_skl_delete', '4', 'Issued SKL', '2022-11-29 06:25:36', '2022-11-29 06:25:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (75, 'master_riph_access', '5', 'Master Data RIPH', '2022-11-29 06:51:52', '2022-11-29 06:53:58', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (76, 'data_report_access', '5', 'Data Report', '2022-12-05 07:36:16', '2022-12-05 07:36:16', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (77, 'master_template_access', '5', 'Master Template', '2022-12-05 07:43:40', '2022-12-05 07:43:40', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (78, 'commitment_list_access', '5', 'Commitment List', '2022-12-05 08:40:29', '2022-12-05 08:40:29', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (79, 'verification_report_access', '5', 'Verification Report', '2022-12-05 08:40:45', '2022-12-05 08:40:45', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (80, 'verif_onfarm_access', '5', 'Onfarm Report', '2022-12-05 16:04:53', '2022-12-05 16:04:53', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (81, 'verif_online_access', '5', 'Online Report', '2022-12-05 16:05:07', '2022-12-05 16:05:07', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (82, 'admin_SKL_access', '5', 'SKL', '2022-12-05 16:06:52', '2022-12-05 16:06:52', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (83, 'master_riph_edit', '2', 'Master Data RIPH', '2022-12-15 23:25:11', '2022-12-15 23:25:11', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (84, 'master_riph_create', '1', 'Master Data RIPH', '2022-12-15 23:25:29', '2022-12-15 23:25:29', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (85, 'master_riph_show', '3', 'Master Data RIPH', '2022-12-15 23:25:41', '2022-12-15 23:25:41', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (86, 'master_riph_delete', '4', 'Master Data RIPH', '2022-12-15 23:25:54', '2022-12-15 23:25:54', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (87, 'commitment_create', '1', 'Commitment', '2023-01-07 23:26:10', '2023-01-08 00:23:40', '2023-01-08 00:23:40');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (88, 'commitment_edit', '2', 'Daftar RIPH', '2023-01-07 23:26:25', '2023-02-25 23:48:48', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (89, 'commitment_delete', '4', 'Daftar RIPH', '2023-01-07 23:26:38', '2023-02-25 23:48:12', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (90, 'commitment_show', '3', 'Daftar RIPH', '2023-01-07 23:43:55', '2023-02-25 23:47:54', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (91, 'hello_edit', '2', 'Data Report', '2023-01-09 11:54:31', '2023-01-09 11:54:39', '2023-01-09 11:54:39');
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (92, 'provinsi_access', '5', 'Provinsi', '2023-01-21 20:07:36', '2023-01-21 20:07:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (93, 'kabupaten_access', '5', 'Kabupaten', '2023-01-21 20:07:55', '2023-01-21 20:07:55', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (94, 'kecamatan_access', '5', 'Kecamatan', '2023-01-21 20:08:17', '2023-01-21 20:08:17', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (95, 'desa_access', '5', 'Desa', '2023-01-21 20:08:33', '2023-01-21 20:08:33', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (96, 'master_wilayah_access', '5', 'Master Wilayah', '2023-01-21 20:09:30', '2023-01-21 20:09:30', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (97, 'kelompoktani_create', '1', 'Kelompok Tani', '2023-01-21 22:49:36', '2023-01-21 22:49:36', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (98, 'kelompoktani_edit', '2', 'Kelompok Tani', '2023-01-21 22:49:51', '2023-01-21 22:49:51', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (99, 'kelompoktani_show', '3', 'Kelompok Tani', '2023-01-21 22:50:07', '2023-01-21 22:50:07', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (100, 'kelompoktani_delete', '4', 'Kelompok Tani', '2023-01-21 22:50:21', '2023-01-21 22:50:21', NULL);
INSERT INTO `permissions` (`id`, `title`, `perm_type`, `grp_title`, `created_at`, `updated_at`, `deleted_at`) VALUES (101, 'daftar_riph_create', '1', 'Daftar RIPH', '2023-02-26 00:19:49', '2023-02-26 00:19:49', NULL);
COMMIT;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for poktans
-- ----------------------------
DROP TABLE IF EXISTS `poktans`;
CREATE TABLE `poktans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_riph` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_kabupaten` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_kecamatan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_kelurahan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nama_kelompok` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nama_pimpinan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hp_pimpinan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nama_petani` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ktp_petani` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `luas_lahan` double DEFAULT NULL,
  `periode_tanam` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `poktans_no_riph_foreign` (`no_riph`),
  CONSTRAINT `poktans_no_riph_foreign` FOREIGN KEY (`no_riph`) REFERENCES `pull_riphs` (`no_ijin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of poktans
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `img_cover` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb3_unicode_ci,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pull_riphs
-- ----------------------------
DROP TABLE IF EXISTS `pull_riphs`;
CREATE TABLE `pull_riphs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `npwp` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `no_ijin` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `periodetahun` int DEFAULT NULL,
  `tgl_ijin` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `no_hs` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `volume_riph` double(8,2) DEFAULT NULL,
  `volume_produksi` double(8,2) DEFAULT NULL,
  `luas_wajib_tanam` double(8,2) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `formRiph` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `formSptjm` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `logBook` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `formRt` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `formRta` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `formRpo` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `formLa` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `no_doc` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `datariph` text COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pull_riphs_npwp_unique` (`npwp`),
  UNIQUE KEY `pull_riphs_no_ijin_unique` (`no_ijin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of pull_riphs
-- ----------------------------
BEGIN;
INSERT INTO `pull_riphs` (`id`, `npwp`, `keterangan`, `nama`, `no_ijin`, `periodetahun`, `tgl_ijin`, `tgl_akhir`, `no_hs`, `volume_riph`, `volume_produksi`, `luas_wajib_tanam`, `status`, `formRiph`, `formSptjm`, `logBook`, `formRt`, `formRta`, `formRpo`, `formLa`, `no_doc`, `datariph`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, '42.214.798.3-604.000', 'SUCCESS', 'LADANG REZEKI TANI', '0106/PP.240/D/03/2022', 2022, '2022-03-14', '2022-12-31', '07032090- - Bawang putih, segar atau dingin', 9976.00, 498.80, 83.13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/422147983604000/0106PP240D032022.json', '2023-02-25 23:41:37', '2023-02-25 23:41:37', NULL);
COMMIT;

-- ----------------------------
-- Table structure for qa_messages
-- ----------------------------
DROP TABLE IF EXISTS `qa_messages`;
CREATE TABLE `qa_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qa_messages_topic_id_foreign` (`topic_id`),
  KEY `qa_messages_sender_id_foreign` (`sender_id`),
  CONSTRAINT `qa_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `qa_messages_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `qa_topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of qa_messages
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for qa_topics
-- ----------------------------
DROP TABLE IF EXISTS `qa_topics`;
CREATE TABLE `qa_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `creator_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qa_topics_creator_id_foreign` (`creator_id`),
  KEY `qa_topics_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `qa_topics_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `qa_topics_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of qa_topics
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for readarticles
-- ----------------------------
DROP TABLE IF EXISTS `readarticles`;
CREATE TABLE `readarticles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `posts_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of readarticles
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for riph_admins
-- ----------------------------
DROP TABLE IF EXISTS `riph_admins`;
CREATE TABLE `riph_admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `v_pengajuan_import` int NOT NULL,
  `v_beban_tanam` int NOT NULL,
  `v_beban_produksi` int NOT NULL,
  `jumlah_importir` int NOT NULL,
  `periode` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of riph_admins
-- ----------------------------
BEGIN;
INSERT INTO `riph_admins` (`id`, `v_pengajuan_import`, `v_beban_tanam`, `v_beban_produksi`, `jumlah_importir`, `periode`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 868324, 7236, 43416, 117, 2021, NULL, '2022-12-15 11:58:56', NULL);
COMMIT;

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  KEY `user_id_fk_6464594` (`user_id`),
  KEY `role_id_fk_6464594` (`role_id`),
  CONSTRAINT `role_id_fk_6464594` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_fk_6464594` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
BEGIN;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (1, 1);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (2, 2);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (3, 3);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (4, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (15, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (23, 2);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (44, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (45, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (21, 2);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (51, 4);
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES (53, 2);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Admin', NULL, NULL, NULL);
INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'User', NULL, NULL, NULL);
INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'Verifikator', '2022-10-07 08:16:33', '2022-10-07 08:16:33', NULL);
INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'user_v2', '2022-11-02 13:22:27', '2022-11-02 13:22:27', NULL);
COMMIT;

-- ----------------------------
-- Table structure for skls
-- ----------------------------
DROP TABLE IF EXISTS `skls`;
CREATE TABLE `skls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of skls
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `roleaccess` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'Admin', 'admin', 'admin@admin.com', NULL, '$2y$10$d580yIFD6xux9D.F6lhHsOMe92iTeTbwGUCf9tbuxIX4WlE019ONO', NULL, 1, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 'Ricky', 'rickysut', 'ricky@sali-evo.com', NULL, '$2y$10$sptf9V51DGIfSLNhmls8muW0cOMhglCBbYmdx7IU.EW.p4nCvF8Zq', NULL, 2, '2022-10-04 09:34:27', '2023-02-26 00:29:28', '2023-02-26 00:29:28');
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 'verifikator1', 'verifikator1', 'veri@gmail.com', NULL, '$2y$10$iga/NgzY5nsCe3kj9lVAh.O1xjg4KssyY8DfukRDwlIvGcblqh/jK', NULL, 1, '2022-10-07 08:15:55', '2022-10-07 08:15:55', NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 'Herman', 'herman', 'herman@gmail.com', NULL, '$2y$10$sN4uBjFe.mbfD7Uw9RhFCOfAOZ.ZTVA4RWdJlSe9/ecgtNlpW7xaC', NULL, 3, '2022-10-31 14:43:00', '2023-02-26 00:30:34', '2023-02-26 00:30:34');
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (15, 'company1 satu', 'company1', 'company1@satu.com', NULL, '$2y$10$9NR2IAASsxAxwWWxD88M5uPugIasLfdI.naR8k8kBg.qVtrduXYdS', NULL, 3, '2022-11-10 13:10:11', '2023-02-26 00:30:43', '2023-02-26 00:30:43');
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (21, 'Budi', 'hortikultura.jaya', 'horti.riph@gmail.com', NULL, '$2y$10$fqzbTFPislk2tHLcCEWvkeb42iZJJy.VaIOmb8hZirRiV3QlYus0G', NULL, 2, '2022-11-21 09:04:24', '2022-11-21 09:04:24', NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (23, 'Coba 1', 'coba1', 'inatrade@kemendag.go.id', NULL, '$2y$10$Oxu85PsGYLZpy65o4gFFrO/mtufpcFHbf1s8z3i24GrrdG3Pu3Ipq', NULL, 2, '2022-11-21 09:07:24', '2022-11-21 09:07:24', NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (44, 'RICKY SUTANTO', 'some', 'Digitalone8@gmail.com', NULL, '$2y$10$4eQEX75bR0AUbA5UwO38jeyI00wxZl6k/jTCiZx86ChtF8IXCPP6y', NULL, 3, '2022-11-22 10:59:33', '2023-02-26 00:29:20', '2023-02-26 00:29:20');
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (45, 'ome', 'ome', 'ome@email.com', NULL, '$2y$10$KEtjaaFP9L6PswBqwNcuWukErkkZRFyfzi6RMaCYgQwZiMxSsLz/C', NULL, 3, '2022-11-22 11:50:41', '2022-11-22 11:50:41', NULL);
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (51, 'cuncun', 'cuncun', 'cun@cun.com', NULL, '$2y$10$VZb3vnFKjw3MXIWvLdIRs.GybGai5V.CMjjpIKtETWz.ZOyaA.NGe', NULL, 3, '2022-12-25 00:05:00', '2023-02-26 00:30:28', '2023-02-26 00:30:28');
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `roleaccess`, `created_at`, `updated_at`, `deleted_at`) VALUES (53, 'MAYA SARI IRELA', 'luthfi.s2022', 'ladang_rt@yahoo.com', NULL, '$2y$10$ha9gq4qR/dk.eKEAIkOYrOYQxULvLz1yqwtJtV6fItGqcroPf63vS', NULL, 2, '2023-01-12 23:04:48', '2023-01-12 23:04:48', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
