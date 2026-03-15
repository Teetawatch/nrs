-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for nrs
CREATE DATABASE IF NOT EXISTS `nrs` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `nrs`;

-- Dumping structure for table nrs.announcements
CREATE TABLE IF NOT EXISTS `announcements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('info','warning','danger','success') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.announcements: ~2 rows (approximately)
INSERT INTO `announcements` (`id`, `title`, `content`, `type`, `is_active`, `expired_at`, `created_at`, `updated_at`) VALUES
	(1, 'เปิดภาคเรียนที่ 1 ปีการศึกษา 2568', 'เปิดภาคเรียนที่ 1 วันที่ 1 พฤษภาคม 2568 นักเรียนทุกระดับชั้นรายงานตัว', 'info', 1, NULL, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'งดการเรียนการสอนวันที่ 15 มีนาคม', 'เนื่องจากมีการจัดกิจกรรมประชุมผู้ปกครอง', 'danger', 1, NULL, '2026-03-12 06:05:06', '2026-03-13 04:33:59');

-- Dumping structure for table nrs.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.banners: ~0 rows (approximately)

-- Dumping structure for table nrs.contact_infos
CREATE TABLE IF NOT EXISTS `contact_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contact_infos_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.contact_infos: ~0 rows (approximately)

-- Dumping structure for table nrs.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.contact_messages: ~0 rows (approximately)

-- Dumping structure for table nrs.curriculums
CREATE TABLE IF NOT EXISTS `curriculums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.curriculums: ~0 rows (approximately)

-- Dumping structure for table nrs.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.departments: ~3 rows (approximately)
INSERT INTO `departments` (`id`, `name`, `slug`, `description`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'ฝ่ายบริหารงานทั่วไป', 'admin', NULL, 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'ฝ่ายวิชาการ', 'academic', NULL, 2, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(3, 'ฝ่ายกิจการนักเรียน', 'student-affairs', NULL, 3, '2026-03-12 06:05:06', '2026-03-12 06:05:06');

-- Dumping structure for table nrs.documents
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `download_count` int NOT NULL DEFAULT '0',
  `year` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `documents_slug_unique` (`slug`),
  KEY `documents_category_id_foreign` (`category_id`),
  CONSTRAINT `documents_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `document_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.documents: ~1 rows (approximately)

-- Dumping structure for table nrs.document_categories
CREATE TABLE IF NOT EXISTS `document_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3B82F6',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.document_categories: ~5 rows (approximately)
INSERT INTO `document_categories` (`id`, `name`, `slug`, `icon`, `color`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'ระเบียบ/คำสั่ง', '1', NULL, '#3B82F6', 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'แบบฟอร์ม', '2', NULL, '#3B82F6', 2, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(3, 'รายงาน', '3', NULL, '#3B82F6', 3, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(4, 'คู่มือ', '4', NULL, '#3B82F6', 4, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(5, 'ประกาศ', '5', NULL, '#3B82F6', 5, '2026-03-12 06:05:06', '2026-03-12 06:05:06');

-- Dumping structure for table nrs.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table nrs.knowledge_bases
CREATE TABLE IF NOT EXISTS `knowledge_bases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('article','video','link','file') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'article',
  `category_id` bigint unsigned NOT NULL,
  `view_count` int NOT NULL DEFAULT '0',
  `status` enum('draft','published') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `knowledge_bases_slug_unique` (`slug`),
  KEY `knowledge_bases_category_id_foreign` (`category_id`),
  CONSTRAINT `knowledge_bases_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `knowledge_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.knowledge_bases: ~7 rows (approximately)
INSERT INTO `knowledge_bases` (`id`, `title`, `slug`, `content`, `excerpt`, `cover_image`, `external_url`, `type`, `category_id`, `view_count`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'บทเรียนออนไลน์ช่างยนต์เบื้องต้น', '-1', '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>', NULL, NULL, NULL, 'article', 1, 1, 'published', '2026-03-12 06:05:06', '2026-03-13 04:20:18', '2026-03-13 04:20:18'),
	(2, 'วิดีโอสอนการเขียนโปรแกรม Python', 'python', '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>', NULL, NULL, NULL, 'video', 1, 0, 'published', '2026-03-12 06:05:06', '2026-03-13 04:20:18', '2026-03-13 04:20:18'),
	(3, 'ลิงก์แหล่งเรียนรู้คณิตศาสตร์', '-2', '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>', NULL, NULL, NULL, 'link', 1, 0, 'published', '2026-03-12 06:05:06', '2026-03-13 04:20:18', '2026-03-13 04:20:18'),
	(4, 'บทเรียนออนไลน์ช่างยนต์เบื้องต้น', '-3', '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>', NULL, NULL, NULL, 'article', 1, 0, 'published', '2026-03-12 15:14:18', '2026-03-13 04:20:18', '2026-03-13 04:20:18'),
	(5, 'ลิงก์แหล่งเรียนรู้คณิตศาสตร์', '-4', '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>', NULL, NULL, NULL, 'link', 1, 0, 'published', '2026-03-12 15:14:18', '2026-03-13 04:20:18', '2026-03-13 04:20:18'),
	(6, 'บทเรียนออนไลน์ช่างยนต์เบื้องต้น', '-5', '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>', NULL, NULL, NULL, 'article', 1, 0, 'published', '2026-03-12 15:17:50', '2026-03-13 04:20:17', '2026-03-13 04:20:17'),
	(7, 'ลิงก์แหล่งเรียนรู้คณิตศาสตร์', '-6', '<p>เนื้อหาตัวอย่างสำหรับรายการนี้</p>', NULL, NULL, NULL, 'link', 1, 0, 'published', '2026-03-12 15:17:50', '2026-03-13 04:20:17', '2026-03-13 04:20:17');

-- Dumping structure for table nrs.knowledge_categories
CREATE TABLE IF NOT EXISTS `knowledge_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `knowledge_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.knowledge_categories: ~1 rows (approximately)
INSERT INTO `knowledge_categories` (`id`, `name`, `slug`, `icon`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'วิทยาศาสตร์และเทคโนโลยี', '1', NULL, 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(6, 'คู่มือการฝึกพระราชทาน', 'คู่มือการฝึกพระราชทาน', NULL, 1, '2026-03-13 04:29:07', '2026-03-13 04:29:07');

-- Dumping structure for table nrs.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.migrations: ~23 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_01_01_000001_create_post_categories_table', 1),
	(6, '2024_01_01_000002_create_posts_table', 1),
	(7, '2024_01_01_000003_create_school_histories_table', 1),
	(8, '2024_01_01_000004_create_org_units_table', 1),
	(9, '2024_01_01_000005_create_school_symbols_table', 1),
	(10, '2024_01_01_000006_create_philosophies_table', 1),
	(11, '2024_01_01_000007_create_curriculums_table', 1),
	(12, '2024_01_01_000008_create_departments_table', 1),
	(13, '2024_01_01_000009_create_personnel_table', 1),
	(14, '2024_01_01_000010_create_document_categories_table', 1),
	(15, '2024_01_01_000011_create_documents_table', 1),
	(16, '2024_01_01_000012_create_knowledge_categories_table', 1),
	(17, '2024_01_01_000013_create_knowledge_bases_table', 1),
	(18, '2024_01_01_000014_create_system_categories_table', 1),
	(19, '2024_01_01_000015_create_school_systems_table', 1),
	(20, '2024_01_01_000016_create_banners_table', 1),
	(21, '2024_01_01_000017_create_announcements_table', 1),
	(22, '2024_01_01_000018_create_contact_infos_table', 1),
	(23, '2024_01_01_000019_create_contact_messages_table', 1),
	(24, '2026_03_12_222234_create_sessions_table', 2);

-- Dumping structure for table nrs.org_units
CREATE TABLE IF NOT EXISTS `org_units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `org_units_parent_id_foreign` (`parent_id`),
  CONSTRAINT `org_units_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `org_units` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.org_units: ~0 rows (approximately)

-- Dumping structure for table nrs.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table nrs.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table nrs.personnel
CREATE TABLE IF NOT EXISTS `personnel` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_type` enum('commander','unit_head','teacher','staff') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `department_id` bigint unsigned DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personnel_slug_unique` (`slug`),
  KEY `personnel_department_id_foreign` (`department_id`),
  CONSTRAINT `personnel_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.personnel: ~10 rows (approximately)
INSERT INTO `personnel` (`id`, `prefix`, `first_name`, `last_name`, `slug`, `position`, `rank`, `photo`, `bio`, `email`, `phone`, `role_type`, `department_id`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'นาย', 'สมชาย', 'ใจดี', '-1', 'ผู้อำนวยการ', NULL, NULL, NULL, NULL, NULL, 'commander', NULL, 1, 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'นาง', 'สมหญิง', 'รักเรียน', '-2', 'รองผู้อำนวยการฝ่ายวิชาการ', NULL, NULL, NULL, NULL, NULL, 'commander', NULL, 2, 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(3, 'นาย', 'วิชาญ', 'ชำนาญกิจ', '-3', 'ครูประจำแผนกช่างยนต์', NULL, NULL, NULL, NULL, NULL, 'teacher', NULL, 3, 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(4, 'นางสาว', 'มาลี', 'สุขสันต์', '-4', 'ครูประจำแผนกการบัญชี', NULL, NULL, NULL, NULL, NULL, 'teacher', NULL, 4, 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(6, 'นาย', 'สมชาย', 'ใจดี', '-6', 'ผู้อำนวยการ', NULL, NULL, NULL, NULL, NULL, 'commander', NULL, 1, 1, '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(7, 'นาง', 'สมหญิง', 'รักเรียน', '-7', 'รองผู้อำนวยการฝ่ายวิชาการ', NULL, NULL, NULL, NULL, NULL, 'commander', NULL, 2, 1, '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(8, 'นาย', 'วิชาญ', 'ชำนาญกิจ', '-8', 'ครูประจำแผนกช่างยนต์', NULL, NULL, NULL, NULL, NULL, 'teacher', NULL, 3, 1, '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(11, 'นาย', 'สมชาย', 'ใจดี', '-11', 'ผู้อำนวยการ', NULL, NULL, NULL, NULL, NULL, 'commander', NULL, 1, 1, '2026-03-12 15:17:50', '2026-03-12 15:17:50'),
	(12, 'นาง', 'สมหญิง', 'รักเรียน', '-12', 'รองผู้อำนวยการฝ่ายวิชาการ', NULL, NULL, NULL, NULL, NULL, 'commander', NULL, 2, 1, '2026-03-12 15:17:50', '2026-03-12 15:17:50'),
	(13, 'นาย', 'วิชาญ', 'ชำนาญกิจ', '-13', 'ครูประจำแผนกช่างยนต์', NULL, NULL, NULL, NULL, NULL, 'teacher', NULL, 3, 1, '2026-03-12 15:17:50', '2026-03-12 15:17:50');

-- Dumping structure for table nrs.philosophies
CREATE TABLE IF NOT EXISTS `philosophies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.philosophies: ~0 rows (approximately)

-- Dumping structure for table nrs.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.posts: ~18 rows (approximately)
INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `excerpt`, `cover_image`, `status`, `published_at`, `category_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'พิธีไหว้ครูประจำปีการศึกษา 2568', '2568', '<p>วิทยาลัยจัดพิธีไหว้ครูอย่างยิ่งใหญ่ รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'วิทยาลัยจัดพิธีไหว้ครูอย่างยิ่งใหญ่', NULL, 'published', '2026-02-16 06:05:06', 1, 1, '2026-03-12 06:05:06', '2026-03-12 06:52:38', '2026-03-12 06:52:38'),
	(2, 'นักเรียนวิทยาลัยคว้าเหรียญทองทักษะวิชาชีพ', '-1', '<p>ผลงานดีเด่นในการแข่งขันระดับภาค รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'ผลงานดีเด่นในการแข่งขันระดับภาค', NULL, 'published', '2026-03-08 06:05:06', 1, 1, '2026-03-12 06:05:06', '2026-03-12 06:52:38', '2026-03-12 06:52:38'),
	(3, 'กิจกรรมปัจฉิมนิเทศนักเรียน ปีการศึกษา 2567', '2567', '<p>วิทยาลัยจัดงานอำลาให้กับนักเรียนที่สำเร็จการศึกษา รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'วิทยาลัยจัดงานอำลาให้กับนักเรียนที่สำเร็จการศึกษา', NULL, 'published', '2026-02-16 06:05:06', 1, 1, '2026-03-12 06:05:06', '2026-03-12 06:52:38', '2026-03-12 06:52:38'),
	(4, 'โครงการฝึกอบรมวิชาชีพระยะสั้น', '-2', '<p>เปิดรับสมัครหลักสูตรระยะสั้นหลากหลายสาขา รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'เปิดรับสมัครหลักสูตรระยะสั้นหลากหลายสาขา', NULL, 'published', '2026-03-09 06:05:06', 1, 1, '2026-03-12 06:05:06', '2026-03-12 06:52:38', '2026-03-12 06:52:38'),
	(5, 'กิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', 'กิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', '<div class="attachment-gallery attachment-gallery--6"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg&quot;,&quot;filesize&quot;:154924,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/1LThWUf6XAy33bLDKMC4foCNnoWKXMwOcpdMSoUS.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/1LThWUf6XAy33bLDKMC4foCNnoWKXMwOcpdMSoUS.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/1LThWUf6XAy33bLDKMC4foCNnoWKXMwOcpdMSoUS.jpg"><img src="http://localhost/storage/posts/attachments/1LThWUf6XAy33bLDKMC4foCNnoWKXMwOcpdMSoUS.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg</span> <span class="attachment__size">151.29 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg&quot;,&quot;filesize&quot;:92782,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/GzZRHQPvTDMIdqbom9vIl0j1kFImThKEZj5ncVrt.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/GzZRHQPvTDMIdqbom9vIl0j1kFImThKEZj5ncVrt.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/GzZRHQPvTDMIdqbom9vIl0j1kFImThKEZj5ncVrt.jpg"><img src="http://localhost/storage/posts/attachments/GzZRHQPvTDMIdqbom9vIl0j1kFImThKEZj5ncVrt.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg</span> <span class="attachment__size">90.61 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg&quot;,&quot;filesize&quot;:121933,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/sp8rkAkfCQRSXqsciCm9WEaqKSphbPj9zQWoeiFz.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/sp8rkAkfCQRSXqsciCm9WEaqKSphbPj9zQWoeiFz.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/sp8rkAkfCQRSXqsciCm9WEaqKSphbPj9zQWoeiFz.jpg"><img src="http://localhost/storage/posts/attachments/sp8rkAkfCQRSXqsciCm9WEaqKSphbPj9zQWoeiFz.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg</span> <span class="attachment__size">119.08 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_4-1024x683.jpg&quot;,&quot;filesize&quot;:204174,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/YJmjllfGQKxk2XGF8HOpehf9xZC0mdHvn6j87pOv.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/YJmjllfGQKxk2XGF8HOpehf9xZC0mdHvn6j87pOv.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/YJmjllfGQKxk2XGF8HOpehf9xZC0mdHvn6j87pOv.jpg"><img src="http://localhost/storage/posts/attachments/YJmjllfGQKxk2XGF8HOpehf9xZC0mdHvn6j87pOv.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_4-1024x683.jpg</span> <span class="attachment__size">199.39 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg&quot;,&quot;filesize&quot;:163796,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/GWuyxvRbFu9ucK6tkizfQiBKwfjTxH9BtenG8jQN.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/GWuyxvRbFu9ucK6tkizfQiBKwfjTxH9BtenG8jQN.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/GWuyxvRbFu9ucK6tkizfQiBKwfjTxH9BtenG8jQN.jpg"><img src="http://localhost/storage/posts/attachments/GWuyxvRbFu9ucK6tkizfQiBKwfjTxH9BtenG8jQN.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg</span> <span class="attachment__size">159.96 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_5-1024x683.jpg&quot;,&quot;filesize&quot;:96429,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/qVWnwSuRY4qeIk65DvWImBxB3Qe72lsYVgxI76tS.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/qVWnwSuRY4qeIk65DvWImBxB3Qe72lsYVgxI76tS.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/qVWnwSuRY4qeIk65DvWImBxB3Qe72lsYVgxI76tS.jpg"><img src="http://localhost/storage/posts/attachments/qVWnwSuRY4qeIk65DvWImBxB3Qe72lsYVgxI76tS.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_5-1024x683.jpg</span> <span class="attachment__size">94.17 KB</span></figcaption></a></figure></div>', NULL, 'posts/01KKGD6AH1AMCE0HZ8EZ26B7Y8.jpg', 'published', '2026-03-12 06:53:10', 2, 2, '2026-03-12 06:54:21', '2026-03-12 07:04:27', '2026-03-12 07:04:27'),
	(6, 'กิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', 'กิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากร', '<div class="attachment-gallery attachment-gallery--5"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg&quot;,&quot;filesize&quot;:154924,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/If29EAF1mpdwZQBXtThJSLa0FdZvGn2QWUWkXGe5.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/If29EAF1mpdwZQBXtThJSLa0FdZvGn2QWUWkXGe5.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/If29EAF1mpdwZQBXtThJSLa0FdZvGn2QWUWkXGe5.jpg"><img src="http://localhost/storage/posts/attachments/If29EAF1mpdwZQBXtThJSLa0FdZvGn2QWUWkXGe5.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg</span> <span class="attachment__size">151.29 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg&quot;,&quot;filesize&quot;:92782,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/oUOyFnWuK0As6aSmPlPuTqfmtjYIdGlFvrncj3Jx.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/oUOyFnWuK0As6aSmPlPuTqfmtjYIdGlFvrncj3Jx.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/oUOyFnWuK0As6aSmPlPuTqfmtjYIdGlFvrncj3Jx.jpg"><img src="http://localhost/storage/posts/attachments/oUOyFnWuK0As6aSmPlPuTqfmtjYIdGlFvrncj3Jx.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg</span> <span class="attachment__size">90.61 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg&quot;,&quot;filesize&quot;:121933,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/8s0IwHbLbRvZheKxsSUXqrYnn5rSp7RMCW1DQyE3.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/8s0IwHbLbRvZheKxsSUXqrYnn5rSp7RMCW1DQyE3.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/8s0IwHbLbRvZheKxsSUXqrYnn5rSp7RMCW1DQyE3.jpg"><img src="http://localhost/storage/posts/attachments/8s0IwHbLbRvZheKxsSUXqrYnn5rSp7RMCW1DQyE3.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg</span> <span class="attachment__size">119.08 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_4-1024x683.jpg&quot;,&quot;filesize&quot;:204174,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/1Az5OO7lPF9wpf9DFQg3p2ly3cwk7JUN7byDCD8J.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/1Az5OO7lPF9wpf9DFQg3p2ly3cwk7JUN7byDCD8J.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/1Az5OO7lPF9wpf9DFQg3p2ly3cwk7JUN7byDCD8J.jpg"><img src="http://localhost/storage/posts/attachments/1Az5OO7lPF9wpf9DFQg3p2ly3cwk7JUN7byDCD8J.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_4-1024x683.jpg</span> <span class="attachment__size">199.39 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg&quot;,&quot;filesize&quot;:163796,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/Hlz6daedT5dHQX1pCieNattT1IcAs0ZghkJ344If.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/Hlz6daedT5dHQX1pCieNattT1IcAs0ZghkJ344If.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/Hlz6daedT5dHQX1pCieNattT1IcAs0ZghkJ344If.jpg"><img src="http://localhost/storage/posts/attachments/Hlz6daedT5dHQX1pCieNattT1IcAs0ZghkJ344If.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg</span> <span class="attachment__size">159.96 KB</span></figcaption></a></figure></div>', 'รร.พธ.พธ.ทร. ร่วมกับ รร.นวก.ศวก.พร. จัดกิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ ส่งเสริมให้กำลังพลตระหนักถึงการอนุรักษ์ทรัพยากรธรรมชาติและสิ่งแวดล้อม และ กิจกรรมเนื่องในวันพ่อแห่งชาติ ปลูกฝังจิตสำนึกความรักชาติ เทิดทูนสถาบันพระมหากษัตริย์ เป็นคนดี พัฒนาผู้เรียน โดยใช้วิชาชีพสร้างประโยชน์ให้แก่ชุมชนและส่วนรวม โดยมีฐานกิจกรรม สาธิตการทำน้ำพั้นซ์ การปฏิบัติเป็นไปด้วยความเรียบร้อย', 'posts/01KKGDVG5N9AHTX1E5HRZZ39GA.jpg', 'published', '2026-03-12 07:04:46', 2, 2, '2026-03-12 07:05:55', '2026-03-12 07:14:27', '2026-03-12 07:14:27'),
	(7, 'พิธีไหว้ครูประจำปีการศึกษา 2568', '2568-1', '<p>วิทยาลัยจัดพิธีไหว้ครูอย่างยิ่งใหญ่ รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'วิทยาลัยจัดพิธีไหว้ครูอย่างยิ่งใหญ่', NULL, 'published', '2026-02-26 15:14:18', 1, 1, '2026-03-12 15:14:18', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(8, 'นักเรียนวิทยาลัยคว้าเหรียญทองทักษะวิชาชีพ', '-3', '<p>ผลงานดีเด่นในการแข่งขันระดับภาค รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'ผลงานดีเด่นในการแข่งขันระดับภาค', NULL, 'published', '2026-03-09 15:14:18', 1, 1, '2026-03-12 15:14:18', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(9, 'กิจกรรมปัจฉิมนิเทศนักเรียน ปีการศึกษา 2567', '2567-1', '<p>วิทยาลัยจัดงานอำลาให้กับนักเรียนที่สำเร็จการศึกษา รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'วิทยาลัยจัดงานอำลาให้กับนักเรียนที่สำเร็จการศึกษา', NULL, 'published', '2026-02-25 15:14:18', 1, 1, '2026-03-12 15:14:18', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(10, 'โครงการฝึกอบรมวิชาชีพระยะสั้น', '-4', '<p>เปิดรับสมัครหลักสูตรระยะสั้นหลากหลายสาขา รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'เปิดรับสมัครหลักสูตรระยะสั้นหลากหลายสาขา', NULL, 'published', '2026-03-11 15:14:18', 1, 1, '2026-03-12 15:14:18', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(11, 'พิธีไหว้ครูประจำปีการศึกษา 2568', '2568-2', '<p>วิทยาลัยจัดพิธีไหว้ครูอย่างยิ่งใหญ่ รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'วิทยาลัยจัดพิธีไหว้ครูอย่างยิ่งใหญ่', NULL, 'published', '2026-02-17 15:17:50', 1, 1, '2026-03-12 15:17:50', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(12, 'นักเรียนวิทยาลัยคว้าเหรียญทองทักษะวิชาชีพ', '-5', '<p>ผลงานดีเด่นในการแข่งขันระดับภาค รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'ผลงานดีเด่นในการแข่งขันระดับภาค', NULL, 'published', '2026-03-02 15:17:50', 1, 1, '2026-03-12 15:17:50', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(13, 'กิจกรรมปัจฉิมนิเทศนักเรียน ปีการศึกษา 2567', '2567-2', '<p>วิทยาลัยจัดงานอำลาให้กับนักเรียนที่สำเร็จการศึกษา รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'วิทยาลัยจัดงานอำลาให้กับนักเรียนที่สำเร็จการศึกษา', NULL, 'published', '2026-02-18 15:17:50', 1, 1, '2026-03-12 15:17:50', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(14, 'โครงการฝึกอบรมวิชาชีพระยะสั้น', '-6', '<p>เปิดรับสมัครหลักสูตรระยะสั้นหลากหลายสาขา รายละเอียดเพิ่มเติมจะประกาศให้ทราบในภายหลัง</p>', 'เปิดรับสมัครหลักสูตรระยะสั้นหลากหลายสาขา', NULL, 'published', '2026-03-02 15:17:50', 1, 1, '2026-03-12 15:17:50', '2026-03-12 15:24:49', '2026-03-12 15:24:49'),
	(15, 'กิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', 'กิจกรรมวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', '<div class="attachment-gallery attachment-gallery--5"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg&quot;,&quot;filesize&quot;:154924,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/VtbW2DHEUIJu7ObLetsi3wTHYgQlpA5wvbtwDxIZ.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/VtbW2DHEUIJu7ObLetsi3wTHYgQlpA5wvbtwDxIZ.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/VtbW2DHEUIJu7ObLetsi3wTHYgQlpA5wvbtwDxIZ.jpg"><img src="http://localhost/storage/posts/attachments/VtbW2DHEUIJu7ObLetsi3wTHYgQlpA5wvbtwDxIZ.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg</span> <span class="attachment__size">151.29 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg&quot;,&quot;filesize&quot;:92782,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/UPC03ap0MxWUXOdII1uvZEqRECD8A6qxDk5kJhst.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/UPC03ap0MxWUXOdII1uvZEqRECD8A6qxDk5kJhst.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/UPC03ap0MxWUXOdII1uvZEqRECD8A6qxDk5kJhst.jpg"><img src="http://localhost/storage/posts/attachments/UPC03ap0MxWUXOdII1uvZEqRECD8A6qxDk5kJhst.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg</span> <span class="attachment__size">90.61 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg&quot;,&quot;filesize&quot;:121933,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/I6dbCmAJxlNCBD9mWgxwDnzrSrhWCs5f6y6M6Jzv.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/I6dbCmAJxlNCBD9mWgxwDnzrSrhWCs5f6y6M6Jzv.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/I6dbCmAJxlNCBD9mWgxwDnzrSrhWCs5f6y6M6Jzv.jpg"><img src="http://localhost/storage/posts/attachments/I6dbCmAJxlNCBD9mWgxwDnzrSrhWCs5f6y6M6Jzv.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg</span> <span class="attachment__size">119.08 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg&quot;,&quot;filesize&quot;:163796,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/yXdP1vlNCSFWNstJbSLLma4yanbEFdlf5q4uhFS7.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/yXdP1vlNCSFWNstJbSLLma4yanbEFdlf5q4uhFS7.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/yXdP1vlNCSFWNstJbSLLma4yanbEFdlf5q4uhFS7.jpg"><img src="http://localhost/storage/posts/attachments/yXdP1vlNCSFWNstJbSLLma4yanbEFdlf5q4uhFS7.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg</span> <span class="attachment__size">159.96 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_5-1024x683.jpg&quot;,&quot;filesize&quot;:96429,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/YMKYSF5PCuAIUun3AGkwyTFKKf5EOktVW2TGrLXm.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/YMKYSF5PCuAIUun3AGkwyTFKKf5EOktVW2TGrLXm.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/YMKYSF5PCuAIUun3AGkwyTFKKf5EOktVW2TGrLXm.jpg"><img src="http://localhost/storage/posts/attachments/YMKYSF5PCuAIUun3AGkwyTFKKf5EOktVW2TGrLXm.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_5-1024x683.jpg</span> <span class="attachment__size">94.17 KB</span></figcaption></a></figure></div>', 'รร.พธ.พธ.ทร. ร่วมกับ รร.นวก.ศวก.พร. จัดกิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ ส่งเสริมให้กำลังพลตระหนักถึงการอนุรักษ์ทรัพยากรธรรมชาติและสิ่งแวดล้อม และ กิจกรรมเนื่องในวันพ่อแห่งชาติ ปลูกฝังจิตสำนึกความรักชาติ เทิดทูนสถาบันพระมหากษัตริย์ เป็นคนดี พัฒนาผู้เรียน โดยใช้วิชาชีพสร้างประโยชน์ให้แก่ชุมชนและส่วนรวม โดยมีฐานกิจกรรม สาธิตการทำน้ำพั้นซ์ การปฏิบัติเป็นไปด้วยความเรียบร้อย', 'posts/01KKHAMKB343TZJE3Z3PKW28K2.jpg', 'published', '2026-03-12 15:27:38', 2, 2, '2026-03-12 15:28:57', '2026-03-12 15:31:53', '2026-03-12 15:31:53'),
	(16, 'กิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', 'วันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', '<div class="attachment-gallery attachment-gallery--5"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg&quot;,&quot;filesize&quot;:154924,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/YkSrqqBHIu2rjIaN1EAGBUHJ53ZZ2n4jmw7ZWiMH.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/YkSrqqBHIu2rjIaN1EAGBUHJ53ZZ2n4jmw7ZWiMH.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/YkSrqqBHIu2rjIaN1EAGBUHJ53ZZ2n4jmw7ZWiMH.jpg"><img src="http://localhost/storage/posts/attachments/YkSrqqBHIu2rjIaN1EAGBUHJ53ZZ2n4jmw7ZWiMH.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg</span> <span class="attachment__size">151.29 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg&quot;,&quot;filesize&quot;:92782,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/myMgO7RncDcrdg2Lai4tEewzRVSK3jRehoI5KHG7.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/myMgO7RncDcrdg2Lai4tEewzRVSK3jRehoI5KHG7.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/myMgO7RncDcrdg2Lai4tEewzRVSK3jRehoI5KHG7.jpg"><img src="http://localhost/storage/posts/attachments/myMgO7RncDcrdg2Lai4tEewzRVSK3jRehoI5KHG7.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg</span> <span class="attachment__size">90.61 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg&quot;,&quot;filesize&quot;:121933,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/VosG8P03F4Me32uQ3bN0nRustklKjDBP9VjLWcn3.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/VosG8P03F4Me32uQ3bN0nRustklKjDBP9VjLWcn3.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/VosG8P03F4Me32uQ3bN0nRustklKjDBP9VjLWcn3.jpg"><img src="http://localhost/storage/posts/attachments/VosG8P03F4Me32uQ3bN0nRustklKjDBP9VjLWcn3.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg</span> <span class="attachment__size">119.08 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg&quot;,&quot;filesize&quot;:163796,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/S4UXykeeL4C6zcouMpLyRPWAPx6hlkjGoqywZRPR.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/S4UXykeeL4C6zcouMpLyRPWAPx6hlkjGoqywZRPR.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/S4UXykeeL4C6zcouMpLyRPWAPx6hlkjGoqywZRPR.jpg"><img src="http://localhost/storage/posts/attachments/S4UXykeeL4C6zcouMpLyRPWAPx6hlkjGoqywZRPR.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg</span> <span class="attachment__size">159.96 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_5-1024x683.jpg&quot;,&quot;filesize&quot;:96429,&quot;height&quot;:683,&quot;href&quot;:&quot;http://localhost/storage/posts/attachments/BuAYk5Bq3xolFa0sbRis37j9F4bXBeP5zieocTg7.jpg&quot;,&quot;url&quot;:&quot;http://localhost/storage/posts/attachments/BuAYk5Bq3xolFa0sbRis37j9F4bXBeP5zieocTg7.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://localhost/storage/posts/attachments/BuAYk5Bq3xolFa0sbRis37j9F4bXBeP5zieocTg7.jpg"><img src="http://localhost/storage/posts/attachments/BuAYk5Bq3xolFa0sbRis37j9F4bXBeP5zieocTg7.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_5-1024x683.jpg</span> <span class="attachment__size">94.17 KB</span></figcaption></a></figure></div>', 'รร.พธ.พธ.ทร. ร่วมกับ รร.นวก.ศวก.พร. จัดกิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ ส่งเสริมให้กำลังพลตระหนักถึงการอนุรักษ์ทรัพยากรธรรมชาติและสิ่งแวดล้อม และ กิจกรรมเนื่องในวันพ่อแห่งชาติ ปลูกฝังจิตสำนึกความรักชาติ เทิดทูนสถาบันพระมหากษัตริย์ เป็นคนดี พัฒนาผู้เรียน โดยใช้วิชาชีพสร้างประโยชน์ให้แก่ชุมชนและส่วนรวม โดยมีฐานกิจกรรม สาธิตการทำน้ำพั้นซ์ การปฏิบัติเป็นไปด้วยความเรียบร้อย', 'posts/01KKHAVFDYD6567FNH0DHT3M51.jpg', 'published', '2026-03-12 15:32:05', 2, 2, '2026-03-12 15:32:43', '2026-03-12 15:36:21', '2026-03-12 15:36:21'),
	(17, 'กิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', 'โครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ', '<div class="attachment-gallery attachment-gallery--4"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg&quot;,&quot;filesize&quot;:154924,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/v8dauy8ECRlwlKjPcYOnc7j5g3ukitNUrq296F7u.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/v8dauy8ECRlwlKjPcYOnc7j5g3ukitNUrq296F7u.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/v8dauy8ECRlwlKjPcYOnc7j5g3ukitNUrq296F7u.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/v8dauy8ECRlwlKjPcYOnc7j5g3ukitNUrq296F7u.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_17-1024x683.jpg</span> <span class="attachment__size">151.29 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg&quot;,&quot;filesize&quot;:92782,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/MyJGtO7a6GrTDib1eEYCXH7r3dukDJph1UGksVeZ.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/MyJGtO7a6GrTDib1eEYCXH7r3dukDJph1UGksVeZ.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/MyJGtO7a6GrTDib1eEYCXH7r3dukDJph1UGksVeZ.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/MyJGtO7a6GrTDib1eEYCXH7r3dukDJph1UGksVeZ.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_20-1024x683.jpg</span> <span class="attachment__size">90.61 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg&quot;,&quot;filesize&quot;:121933,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/hsWALduzcqhbA9voyuhcKTzROb8fA1V4zS30CM67.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/hsWALduzcqhbA9voyuhcKTzROb8fA1V4zS30CM67.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/hsWALduzcqhbA9voyuhcKTzROb8fA1V4zS30CM67.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/hsWALduzcqhbA9voyuhcKTzROb8fA1V4zS30CM67.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_1-1024x683.jpg</span> <span class="attachment__size">119.08 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg&quot;,&quot;filesize&quot;:163796,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/YvQhhFsa46AM5OPvaRDtszOKjYqq5jlZnSYyDYVi.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/YvQhhFsa46AM5OPvaRDtszOKjYqq5jlZnSYyDYVi.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/YvQhhFsa46AM5OPvaRDtszOKjYqq5jlZnSYyDYVi.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/YvQhhFsa46AM5OPvaRDtszOKjYqq5jlZnSYyDYVi.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_031268_กิจกรรมวันพ่อ_251203_9-1024x683.jpg</span> <span class="attachment__size">159.96 KB</span></figcaption></a></figure></div>', 'รร.พธ.พธ.ทร. ร่วมกับ รร.นวก.ศวก.พร. จัดกิจกรรมเนื่องในวันพ่อแห่งชาติและโครงการอนุรักษ์ฟื้นฟูทรัพยากรธรรมชาติ ส่งเสริมให้กำลังพลตระหนักถึงการอนุรักษ์ทรัพยากรธรรมชาติและสิ่งแวดล้อม และ กิจกรรมเนื่องในวันพ่อแห่งชาติ ปลูกฝังจิตสำนึกความรักชาติ เทิดทูนสถาบันพระมหากษัตริย์ เป็นคนดี พัฒนาผู้เรียน โดยใช้วิชาชีพสร้างประโยชน์ให้แก่ชุมชนและส่วนรวม โดยมีฐานกิจกรรม สาธิตการทำน้ำพั้นซ์ การปฏิบัติเป็นไปด้วยความเรียบร้อย', 'posts/01KKHB4DVPQYGS4K98Z6FHB7AZ.jpg', 'published', '2026-03-12 15:36:34', 2, 2, '2026-03-12 15:37:36', '2026-03-12 15:37:36', NULL),
	(18, 'รร.พธ.พธ.ทร. จัดพิธีรับฟังสารของ ผบ.ทร. เนื่องในวันกองทัพเรือ ประจำปี พ.ศ.๒๕๖๘ โดยให้มีการแถวรับฟังสารฯ ในวันพฤหัสบดีที่๒๐ พ.ย.๖๘', 'รร.พธ.พธ.ทร. จัดพิธีรับฟังสารของ ผบ.ทร. เนื่องในวันกองทัพเรือ ประจำปี พ.ศ.๒๕๖๘ โดยให้มีการแถวรับฟังสารฯ ในวันพฤหัสบดีที่๒๐ พ.ย.๖๘', '<div class="attachment-gallery attachment-gallery--4"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_วันกองทัพเรือ_251120_4-1024x683.jpg&quot;,&quot;filesize&quot;:59060,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/eBO0BBPzvuQwJX0WBVLqQFEJkfjApezagZwxLWAs.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/eBO0BBPzvuQwJX0WBVLqQFEJkfjApezagZwxLWAs.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/eBO0BBPzvuQwJX0WBVLqQFEJkfjApezagZwxLWAs.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/eBO0BBPzvuQwJX0WBVLqQFEJkfjApezagZwxLWAs.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_วันกองทัพเรือ_251120_4-1024x683.jpg</span> <span class="attachment__size">57.68 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_วันกองทัพเรือ_251120_5-1024x683.jpg&quot;,&quot;filesize&quot;:121976,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/3dZFVhywJdGqOvUP6YblnQeiH7OC212fAtASPCsW.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/3dZFVhywJdGqOvUP6YblnQeiH7OC212fAtASPCsW.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/3dZFVhywJdGqOvUP6YblnQeiH7OC212fAtASPCsW.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/3dZFVhywJdGqOvUP6YblnQeiH7OC212fAtASPCsW.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_วันกองทัพเรือ_251120_5-1024x683.jpg</span> <span class="attachment__size">119.12 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_วันกองทัพเรือ_251120_10-1024x683.jpg&quot;,&quot;filesize&quot;:122437,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/moFjb7FngrgKiKLo0JXHSwKMM4ojuYma9nLOpzXL.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/moFjb7FngrgKiKLo0JXHSwKMM4ojuYma9nLOpzXL.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/moFjb7FngrgKiKLo0JXHSwKMM4ojuYma9nLOpzXL.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/moFjb7FngrgKiKLo0JXHSwKMM4ojuYma9nLOpzXL.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_วันกองทัพเรือ_251120_10-1024x683.jpg</span> <span class="attachment__size">119.57 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_วันกองทัพเรือ_251120_7-1024x683.jpg&quot;,&quot;filesize&quot;:170688,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/FnfJR3KUyHqgfdAk2pXpJuL6NTOKcNRo5ovui69M.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/FnfJR3KUyHqgfdAk2pXpJuL6NTOKcNRo5ovui69M.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/FnfJR3KUyHqgfdAk2pXpJuL6NTOKcNRo5ovui69M.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/FnfJR3KUyHqgfdAk2pXpJuL6NTOKcNRo5ovui69M.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_วันกองทัพเรือ_251120_7-1024x683.jpg</span> <span class="attachment__size">166.69 KB</span></figcaption></a></figure></div>', NULL, 'posts/01KKHCZQSVCDMVNVADHZQPKS6K.jpg', 'published', '2026-03-12 16:09:25', 2, 2, '2026-03-12 16:09:59', '2026-03-12 16:09:59', NULL),
	(19, 'พิธีมอบประกาศนียบัตร และปิดการอบรมหลักสูตรการบริการ และหลักสูตรการสหโภชน์ ผลัดที่ 2/68 ประจำปีงบประมาณ 2569', 'พิธีมอบประกาศนียบัตร และปิดการอบรมหลักสูตรการบริการ และหลักสูตรการสหโภชน์ ผลัดที่ 2/68 ประจำปีงบประมาณ 2569', '<div class="attachment-gallery attachment-gallery--5"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_7-1024x683.jpg&quot;,&quot;filesize&quot;:81464,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/ga03vaTtwadGCwgWHrywy8T31RZxiCee8gJbiKFu.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/ga03vaTtwadGCwgWHrywy8T31RZxiCee8gJbiKFu.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/ga03vaTtwadGCwgWHrywy8T31RZxiCee8gJbiKFu.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/ga03vaTtwadGCwgWHrywy8T31RZxiCee8gJbiKFu.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_7-1024x683.jpg</span> <span class="attachment__size">79.55 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_6-1024x683.jpg&quot;,&quot;filesize&quot;:94427,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/wV99BN4ZLxF6PhPeCYd3m4Nk73jtrbRyYckjux2P.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/wV99BN4ZLxF6PhPeCYd3m4Nk73jtrbRyYckjux2P.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/wV99BN4ZLxF6PhPeCYd3m4Nk73jtrbRyYckjux2P.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/wV99BN4ZLxF6PhPeCYd3m4Nk73jtrbRyYckjux2P.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_6-1024x683.jpg</span> <span class="attachment__size">92.21 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_4-1024x683.jpg&quot;,&quot;filesize&quot;:101039,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/3sbBDIyudPHhdc3naDb3HCSG7YXnJQAR0rarzRpV.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/3sbBDIyudPHhdc3naDb3HCSG7YXnJQAR0rarzRpV.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/3sbBDIyudPHhdc3naDb3HCSG7YXnJQAR0rarzRpV.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/3sbBDIyudPHhdc3naDb3HCSG7YXnJQAR0rarzRpV.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_4-1024x683.jpg</span> <span class="attachment__size">98.67 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_3-1024x683.jpg&quot;,&quot;filesize&quot;:111833,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/VdYhPhT0aQemeb6bCZG3Y2FBSkEUq022PuuK3m7H.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/VdYhPhT0aQemeb6bCZG3Y2FBSkEUq022PuuK3m7H.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/VdYhPhT0aQemeb6bCZG3Y2FBSkEUq022PuuK3m7H.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/VdYhPhT0aQemeb6bCZG3Y2FBSkEUq022PuuK3m7H.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_3-1024x683.jpg</span> <span class="attachment__size">109.21 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_1-1024x683.jpg&quot;,&quot;filesize&quot;:98348,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/fLgaWpTEi0t1OUwXJjWxq8bLuRaS0cW5TnTp4bKI.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/fLgaWpTEi0t1OUwXJjWxq8bLuRaS0cW5TnTp4bKI.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/fLgaWpTEi0t1OUwXJjWxq8bLuRaS0cW5TnTp4bKI.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/fLgaWpTEi0t1OUwXJjWxq8bLuRaS0cW5TnTp4bKI.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_ปิดหลักสูตรนร.พล-2.68_260107_1-1024x683.jpg</span> <span class="attachment__size">96.04 KB</span></figcaption></a></figure></div>', NULL, 'posts/01KKK3RM2GZ6WMEC1N6JE2XGQY.jpg', 'published', '2026-03-13 08:06:50', 2, 2, '2026-03-13 08:07:18', '2026-03-13 08:07:18', NULL),
	(20, 'รร.พธ.พธ.ทร. ร่วมกับ โรงเรียนสรรพาวุธ จัดกิจกรรมปลูกฝังจิตสำนึกความรักชาติ เทิดทูนสถาบันพระมหากษัตริย์และกิจกรรมสาระท้องถิ่น', 'รร.พธ.พธ.ทร. ร่วมกับ โรงเรียนสรรพาวุธ จัดกิจกรรมปลูกฝังจิตสำนึกความรักชาติ เทิดทูนสถาบันพระมหากษัตริย์และกิจกรรมสาระท้องถิ่น', '<div class="attachment-gallery attachment-gallery--5"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;DSC_6216-1024x683.jpg&quot;,&quot;filesize&quot;:219584,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/rK41DrrdcMYy3YIVNYZTJHTFHsFf6ezwSkothoIu.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/rK41DrrdcMYy3YIVNYZTJHTFHsFf6ezwSkothoIu.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/rK41DrrdcMYy3YIVNYZTJHTFHsFf6ezwSkothoIu.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/rK41DrrdcMYy3YIVNYZTJHTFHsFf6ezwSkothoIu.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">DSC_6216-1024x683.jpg</span> <span class="attachment__size">214.44 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;DSC_6170-1024x683.jpg&quot;,&quot;filesize&quot;:178998,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/J8qfVkOG2SCksgPlbHGNnaUgr0NX0DYAOzC0rNf9.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/J8qfVkOG2SCksgPlbHGNnaUgr0NX0DYAOzC0rNf9.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/J8qfVkOG2SCksgPlbHGNnaUgr0NX0DYAOzC0rNf9.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/J8qfVkOG2SCksgPlbHGNnaUgr0NX0DYAOzC0rNf9.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">DSC_6170-1024x683.jpg</span> <span class="attachment__size">174.8 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;DSC_6109-1024x683.jpg&quot;,&quot;filesize&quot;:216140,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/sep6m7eO5qBskzeysbzJRrUekaQqQLzfl6vsGN8a.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/sep6m7eO5qBskzeysbzJRrUekaQqQLzfl6vsGN8a.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/sep6m7eO5qBskzeysbzJRrUekaQqQLzfl6vsGN8a.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/sep6m7eO5qBskzeysbzJRrUekaQqQLzfl6vsGN8a.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">DSC_6109-1024x683.jpg</span> <span class="attachment__size">211.07 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;DSC_6002-1024x683.jpg&quot;,&quot;filesize&quot;:221069,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/0ra4EEbfFwSEjGyPSwbAr78nil8ll9LQVEVHC1kQ.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/0ra4EEbfFwSEjGyPSwbAr78nil8ll9LQVEVHC1kQ.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/0ra4EEbfFwSEjGyPSwbAr78nil8ll9LQVEVHC1kQ.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/0ra4EEbfFwSEjGyPSwbAr78nil8ll9LQVEVHC1kQ.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">DSC_6002-1024x683.jpg</span> <span class="attachment__size">215.89 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;DSC_5961-1024x683.jpg&quot;,&quot;filesize&quot;:231155,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/xUfsvXtn17AV4eHiz52amIscA7JjCBVLs0lC2PHq.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/xUfsvXtn17AV4eHiz52amIscA7JjCBVLs0lC2PHq.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/xUfsvXtn17AV4eHiz52amIscA7JjCBVLs0lC2PHq.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/xUfsvXtn17AV4eHiz52amIscA7JjCBVLs0lC2PHq.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">DSC_5961-1024x683.jpg</span> <span class="attachment__size">225.74 KB</span></figcaption></a></figure></div>', NULL, 'posts/01KKK3WE9H27SHJ14GMBGS1FBM.jpg', 'published', '2026-03-13 08:08:31', 2, 2, '2026-03-13 08:09:23', '2026-03-13 08:09:23', NULL),
	(21, 'รร.พธ.พธ.ทร. จัดบูรณาการหลักสูตรอาชีพเพื่อเลื่อนฐานะชั้น พ.จ.อ. ประจำปีงบประมาณ พ.ศ.๒๕๖๙ ในหัวข้อ “การจัดเลี้ยงรูปแบบค็อกเทล”', 'จัดบูรณาการหลักสูตรอาชีพเพื่อเลื่อนฐานะชั้น พ.จ.อ. ประจำปีงบประมาณ พ.ศ.๒๕๖๙ ในหัวข้อ “การจัดเลี้ยงรูปแบบค็อกเทล”', '<div class="attachment-gallery attachment-gallery--5"><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_13-1024x683.jpg&quot;,&quot;filesize&quot;:115226,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/rhmnONykdl7ElKSp6JpOnbFKhbNqWh9Q8bmrougG.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/rhmnONykdl7ElKSp6JpOnbFKhbNqWh9Q8bmrougG.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/rhmnONykdl7ElKSp6JpOnbFKhbNqWh9Q8bmrougG.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/rhmnONykdl7ElKSp6JpOnbFKhbNqWh9Q8bmrougG.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_13-1024x683.jpg</span> <span class="attachment__size">112.53 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_10-1024x683.jpg&quot;,&quot;filesize&quot;:112204,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/CYBVe1KzynIsuXVYJs9wHrGV7fK8aEBUpnmeuYeu.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/CYBVe1KzynIsuXVYJs9wHrGV7fK8aEBUpnmeuYeu.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/CYBVe1KzynIsuXVYJs9wHrGV7fK8aEBUpnmeuYeu.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/CYBVe1KzynIsuXVYJs9wHrGV7fK8aEBUpnmeuYeu.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_10-1024x683.jpg</span> <span class="attachment__size">109.57 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_9-1024x683.jpg&quot;,&quot;filesize&quot;:111076,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/7N1sehXuYp8NISSFR0KdCp9m04yLCrLPMXYCtR8e.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/7N1sehXuYp8NISSFR0KdCp9m04yLCrLPMXYCtR8e.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/7N1sehXuYp8NISSFR0KdCp9m04yLCrLPMXYCtR8e.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/7N1sehXuYp8NISSFR0KdCp9m04yLCrLPMXYCtR8e.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_9-1024x683.jpg</span> <span class="attachment__size">108.47 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_7-1024x683.jpg&quot;,&quot;filesize&quot;:109398,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/XqdwCtKjsSYZqPsSkuMQeVNeu1iSSPIjutiC40v4.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/XqdwCtKjsSYZqPsSkuMQeVNeu1iSSPIjutiC40v4.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/XqdwCtKjsSYZqPsSkuMQeVNeu1iSSPIjutiC40v4.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/XqdwCtKjsSYZqPsSkuMQeVNeu1iSSPIjutiC40v4.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_7-1024x683.jpg</span> <span class="attachment__size">106.83 KB</span></figcaption></a></figure><figure data-trix-attachment="{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_6-1024x683.jpg&quot;,&quot;filesize&quot;:116265,&quot;height&quot;:683,&quot;href&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/5VbTXLn2o8fZFwTWVo9Pnk2kry1iH4MFpKbB174d.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/uploads/posts/attachments/5VbTXLn2o8fZFwTWVo9Pnk2kry1iH4MFpKbB174d.jpg&quot;,&quot;width&quot;:1024}" data-trix-content-type="image/jpeg" data-trix-attributes="{&quot;presentation&quot;:&quot;gallery&quot;}" class="attachment attachment--preview attachment--jpg"><a href="http://127.0.0.1:8000/uploads/posts/attachments/5VbTXLn2o8fZFwTWVo9Pnk2kry1iH4MFpKbB174d.jpg"><img src="http://127.0.0.1:8000/uploads/posts/attachments/5VbTXLn2o8fZFwTWVo9Pnk2kry1iH4MFpKbB174d.jpg" width="1024" height="683"><figcaption class="attachment__caption"><span class="attachment__name">LINE_ALBUM_งานบรูณาการ-หลักสูตร-พันจ่าเอกอาชีพ_251120_6-1024x683.jpg</span> <span class="attachment__size">113.54 KB</span></figcaption></a></figure></div>', NULL, 'posts/01KKK42GR5VFE6C0PYZ7VJXBR7.jpg', 'published', '2026-03-13 08:12:16', 2, 2, '2026-03-13 08:12:42', '2026-03-13 08:12:42', NULL);

-- Dumping structure for table nrs.post_categories
CREATE TABLE IF NOT EXISTS `post_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3B82F6',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.post_categories: ~13 rows (approximately)
INSERT INTO `post_categories` (`id`, `name`, `slug`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'ข่าวทั่วไป', 'slr9', '#3B82F6', '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'ข่าวกิจกรรม', 'ng2d', '#3B82F6', '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(3, 'ข่าวประกาศ', 'a6js', '#3B82F6', '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(4, 'ข่าวสำเร็จการศึกษา', 'mu5m', '#3B82F6', '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(5, 'ข่าวรับสมัคร', 'mnw3', '#3B82F6', '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(6, 'ข่าวทั่วไป', 'kfnq', '#3B82F6', '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(7, 'ข่าวกิจกรรม', 'ttjb', '#3B82F6', '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(8, 'ข่าวประกาศ', 'rqf0', '#3B82F6', '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(9, 'ข่าวสำเร็จการศึกษา', 'lqet', '#3B82F6', '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(10, 'ข่าวรับสมัคร', 'nj3o', '#3B82F6', '2026-03-12 15:14:18', '2026-03-12 15:14:18'),
	(11, 'ข่าวทั่วไป', 'lgzh', '#3B82F6', '2026-03-12 15:17:50', '2026-03-12 15:17:50'),
	(12, 'ข่าวกิจกรรม', 'l5c8', '#3B82F6', '2026-03-12 15:17:50', '2026-03-12 15:17:50'),
	(13, 'ข่าวประกาศ', 'qzzk', '#3B82F6', '2026-03-12 15:17:50', '2026-03-12 15:17:50'),
	(14, 'ข่าวสำเร็จการศึกษา', 'webr', '#3B82F6', '2026-03-12 15:17:50', '2026-03-12 15:17:50'),
	(15, 'ข่าวรับสมัคร', 'a0s8', '#3B82F6', '2026-03-12 15:17:50', '2026-03-12 15:17:50');

-- Dumping structure for table nrs.school_histories
CREATE TABLE IF NOT EXISTS `school_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.school_histories: ~0 rows (approximately)
INSERT INTO `school_histories` (`id`, `title`, `content`, `cover_image`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'ความเป็นมา', '<p>โรงเรียนพลาธิการ กรมพลาธิการทหารเรือ เริ่มก่อตั้งขึ้นในปี<strong>พ.ศ.๒๔๙๑</strong> เป็นหน่วยงานที่ขึ้นตรงกับ กรมพลาธิการทหารเรือ (เดิมเรียกว่า กรมพัสดุทหารเรือ) จนกระทั่งปี พ.ศ.๒๕๐๑ ได้มีการแก้ไขปรับปรุงอัตราภายในกรมพลาธิการทหารเรือใหม่ โดยใช้ชื่อ กองการศึกษา กรมพลาธิการทหารเรือ (กศษ.พธ.ทร.)</p><p>โดยให้ โรงเรียนพลาธิการ กรมพลาธิการทหารเรือ เป็นหน่วยขึ้นตรงกับ กองการศึกษา กรมพลาธิการทหารเรือ และเป็นปีแรกที่กองทัพเรือ ได้เปิดรับนักเรียนจ่า เหล่าทหารพลาธิการ โดยให้จัดการศึกษาที่ โรงเรียนชุมพลทหารเรือ กรมยุทธศึกษาทหารเรือ จำนวน ๑ ปี แล้วจึงส่งตัวมารับการศึกษาที่โรงเรียนพลาธิการ กรมพลาธิการทหารเรือ อีก ๑ ปี เมื่อสำเร็จการศึกษาจะได้รับการแต่งตั้งยศเป็น “จ่าโท” ต่อมาได้เปลี่ยนการแต่งตั้งยศเป็น“จ่าเอก” และครั้งสุดท้ายได้เปลี่ยนการแต่งตั้งยศเป็น “จ่าตรี”</p>', 'about/01KKJPVVRTW9KACDDQ9X5SKEJY.png', 1, '2026-03-13 04:21:53', '2026-03-13 04:21:53');

-- Dumping structure for table nrs.school_symbols
CREATE TABLE IF NOT EXISTS `school_symbols` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.school_symbols: ~0 rows (approximately)

-- Dumping structure for table nrs.school_systems
CREATE TABLE IF NOT EXISTS `school_systems` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#3B82F6',
  `category_id` bigint unsigned DEFAULT NULL,
  `open_new_tab` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_systems_category_id_foreign` (`category_id`),
  CONSTRAINT `school_systems_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `system_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.school_systems: ~2 rows (approximately)
INSERT INTO `school_systems` (`id`, `name`, `description`, `url`, `icon`, `logo`, `color`, `category_id`, `open_new_tab`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'ระบบบริหารงานบุคคล (HRMS)', NULL, 'https://hrms.example.ac.th', NULL, NULL, '#1E3A5F', 1, 1, 1, 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'ระบบงานทะเบียน', NULL, 'https://reg.example.ac.th', NULL, NULL, '#0369A1', 1, 1, 1, 2, '2026-03-12 06:05:06', '2026-03-12 06:05:06');

-- Dumping structure for table nrs.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.sessions: ~0 rows (approximately)

-- Dumping structure for table nrs.system_categories
CREATE TABLE IF NOT EXISTS `system_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.system_categories: ~3 rows (approximately)
INSERT INTO `system_categories` (`id`, `name`, `order`, `created_at`, `updated_at`) VALUES
	(1, 'ระบบบริหารการศึกษา', 1, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'ระบบสนับสนุน', 2, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(3, 'ระบบภายนอก', 3, '2026-03-12 06:05:06', '2026-03-12 06:05:06');

-- Dumping structure for table nrs.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nrs.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'ผู้ดูแลระบบ', 'admin@school.ac.th', NULL, '$2y$12$slkiWi8u4GquNcRi1zcUwu/wYTE7jCM05wVjwjIMRkX/ZGzplDfKq', NULL, '2026-03-12 06:05:06', '2026-03-12 06:05:06'),
	(2, 'Teetawatch', 'teetawatch.p@gmail.com', NULL, '$2y$12$Tz3NOwunDqXzb2fIP9stBOT2R72c8Daneu/7JRPAfK3ES2O4r4mNq', NULL, '2026-03-12 06:48:52', '2026-03-12 06:48:52');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
