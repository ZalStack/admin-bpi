-- MySQL dump 10.13  Distrib 8.4.10, for Linux (x86_64)
--
-- Host: localhost    Database: admin-panel-bpi
-- ------------------------------------------------------
-- Server version	8.4.10

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
-- Table structure for table `bahasa`
--

DROP TABLE IF EXISTS `bahasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahasa` (
  `kode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode`),
  KEY `bahasa_aktif_index` (`aktif`),
  KEY `bahasa_is_default_index` (`is_default`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahasa`
--

LOCK TABLES `bahasa` WRITE;
/*!40000 ALTER TABLE `bahasa` DISABLE KEYS */;
/*!40000 ALTER TABLE `bahasa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner_halaman`
--

DROP TABLE IF EXISTS `banner_halaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner_halaman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `halaman` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_halaman_halaman_index` (`halaman`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner_halaman`
--

LOCK TABLES `banner_halaman` WRITE;
/*!40000 ALTER TABLE `banner_halaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner_halaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner_halaman_translations`
--

DROP TABLE IF EXISTS `banner_halaman_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner_halaman_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `banner_halaman_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `banner_halaman_translations_banner_halaman_id_bahasa_unique` (`banner_halaman_id`,`bahasa`),
  KEY `banner_halaman_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `banner_halaman_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `banner_halaman_translations_banner_halaman_id_foreign` FOREIGN KEY (`banner_halaman_id`) REFERENCES `banner_halaman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner_halaman_translations`
--

LOCK TABLES `banner_halaman_translations` WRITE;
/*!40000 ALTER TABLE `banner_halaman_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner_halaman_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beranda`
--

DROP TABLE IF EXISTS `beranda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beranda` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beranda_urutan_index` (`urutan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beranda`
--

LOCK TABLES `beranda` WRITE;
/*!40000 ALTER TABLE `beranda` DISABLE KEYS */;
/*!40000 ALTER TABLE `beranda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beranda_translations`
--

DROP TABLE IF EXISTS `beranda_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beranda_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `beranda_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beranda_translations_beranda_id_bahasa_unique` (`beranda_id`,`bahasa`),
  KEY `beranda_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `beranda_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `beranda_translations_beranda_id_foreign` FOREIGN KEY (`beranda_id`) REFERENCES `beranda` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beranda_translations`
--

LOCK TABLES `beranda_translations` WRITE;
/*!40000 ALTER TABLE `beranda_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `beranda_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `berita`
--

DROP TABLE IF EXISTS `berita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_publikasi` date NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `berita_slug_unique` (`slug`),
  KEY `berita_status_index` (`status`),
  KEY `berita_tanggal_publikasi_index` (`tanggal_publikasi`),
  KEY `berita_status_created_at_index` (`status`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita`
--

LOCK TABLES `berita` WRITE;
/*!40000 ALTER TABLE `berita` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `berita_galeri`
--

DROP TABLE IF EXISTS `berita_galeri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_galeri` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_id` bigint unsigned NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `berita_galeri_berita_id_foreign` (`berita_id`),
  CONSTRAINT `berita_galeri_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_galeri`
--

LOCK TABLES `berita_galeri` WRITE;
/*!40000 ALTER TABLE `berita_galeri` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita_galeri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `berita_galeri_translations`
--

DROP TABLE IF EXISTS `berita_galeri_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_galeri_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_galeri_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `berita_galeri_translations_berita_galeri_id_bahasa_unique` (`berita_galeri_id`,`bahasa`),
  KEY `berita_galeri_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `berita_galeri_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `berita_galeri_translations_berita_galeri_id_foreign` FOREIGN KEY (`berita_galeri_id`) REFERENCES `berita_galeri` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_galeri_translations`
--

LOCK TABLES `berita_galeri_translations` WRITE;
/*!40000 ALTER TABLE `berita_galeri_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita_galeri_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `berita_tag`
--

DROP TABLE IF EXISTS `berita_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_tag` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `berita_tag_berita_id_tag_id_unique` (`berita_id`,`tag_id`),
  KEY `berita_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `berita_tag_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`) ON DELETE CASCADE,
  CONSTRAINT `berita_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_tag`
--

LOCK TABLES `berita_tag` WRITE;
/*!40000 ALTER TABLE `berita_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `berita_translations`
--

DROP TABLE IF EXISTS `berita_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ringkasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kutipan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `berita_translations_berita_id_bahasa_unique` (`berita_id`,`bahasa`),
  KEY `berita_translations_bahasa_foreign` (`bahasa`),
  KEY `berita_translations_kategori_index` (`kategori`),
  CONSTRAINT `berita_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `berita_translations_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_translations`
--

LOCK TABLES `berita_translations` WRITE;
/*!40000 ALTER TABLE `berita_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `footer`
--

DROP TABLE IF EXISTS `footer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `footer` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `footer`
--

LOCK TABLES `footer` WRITE;
/*!40000 ALTER TABLE `footer` DISABLE KEYS */;
/*!40000 ALTER TABLE `footer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `footer_translations`
--

DROP TABLE IF EXISTS `footer_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `footer_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `footer_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `link_nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `footer_translations_footer_id_bahasa_unique` (`footer_id`,`bahasa`),
  KEY `footer_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `footer_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `footer_translations_footer_id_foreign` FOREIGN KEY (`footer_id`) REFERENCES `footer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `footer_translations`
--

LOCK TABLES `footer_translations` WRITE;
/*!40000 ALTER TABLE `footer_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `footer_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_berita`
--

DROP TABLE IF EXISTS `kategori_berita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_berita` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_berita`
--

LOCK TABLES `kategori_berita` WRITE;
/*!40000 ALTER TABLE `kategori_berita` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategori_berita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_berita_translations`
--

DROP TABLE IF EXISTS `kategori_berita_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_berita_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_berita_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_berita_translations_kategori_berita_id_bahasa_unique` (`kategori_berita_id`,`bahasa`),
  KEY `kategori_berita_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `kategori_berita_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `kategori_berita_translations_kategori_berita_id_foreign` FOREIGN KEY (`kategori_berita_id`) REFERENCES `kategori_berita` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_berita_translations`
--

LOCK TABLES `kategori_berita_translations` WRITE;
/*!40000 ALTER TABLE `kategori_berita_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategori_berita_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_mitra`
--

DROP TABLE IF EXISTS `kategori_mitra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_mitra` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_mitra_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_mitra`
--

LOCK TABLES `kategori_mitra` WRITE;
/*!40000 ALTER TABLE `kategori_mitra` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategori_mitra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_mitra_translations`
--

DROP TABLE IF EXISTS `kategori_mitra_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori_mitra_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_mitra_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_mitra_translations_kategori_mitra_id_bahasa_unique` (`kategori_mitra_id`,`bahasa`),
  KEY `kategori_mitra_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `kategori_mitra_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `kategori_mitra_translations_kategori_mitra_id_foreign` FOREIGN KEY (`kategori_mitra_id`) REFERENCES `kategori_mitra` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_mitra_translations`
--

LOCK TABLES `kategori_mitra_translations` WRITE;
/*!40000 ALTER TABLE `kategori_mitra_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `kategori_mitra_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak`
--

DROP TABLE IF EXISTS `kontak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontak` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak`
--

LOCK TABLES `kontak` WRITE;
/*!40000 ALTER TABLE `kontak` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak_email`
--

DROP TABLE IF EXISTS `kontak_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontak_email` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` bigint unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kontak_email_kontak_id_foreign` (`kontak_id`),
  CONSTRAINT `kontak_email_kontak_id_foreign` FOREIGN KEY (`kontak_id`) REFERENCES `kontak` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak_email`
--

LOCK TABLES `kontak_email` WRITE;
/*!40000 ALTER TABLE `kontak_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontak_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak_form`
--

DROP TABLE IF EXISTS `kontak_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontak_form` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kontak_form_status_index` (`status`),
  KEY `kontak_form_status_created_at_index` (`status`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak_form`
--

LOCK TABLES `kontak_form` WRITE;
/*!40000 ALTER TABLE `kontak_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontak_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak_phone`
--

DROP TABLE IF EXISTS `kontak_phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontak_phone` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` bigint unsigned NOT NULL,
  `number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'phone',
  `url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kontak_phone_kontak_id_foreign` (`kontak_id`),
  CONSTRAINT `kontak_phone_kontak_id_foreign` FOREIGN KEY (`kontak_id`) REFERENCES `kontak` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak_phone`
--

LOCK TABLES `kontak_phone` WRITE;
/*!40000 ALTER TABLE `kontak_phone` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontak_phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak_social_media`
--

DROP TABLE IF EXISTS `kontak_social_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontak_social_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` bigint unsigned NOT NULL,
  `platform` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kontak_social_media_kontak_id_foreign` (`kontak_id`),
  CONSTRAINT `kontak_social_media_kontak_id_foreign` FOREIGN KEY (`kontak_id`) REFERENCES `kontak` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak_social_media`
--

LOCK TABLES `kontak_social_media` WRITE;
/*!40000 ALTER TABLE `kontak_social_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontak_social_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontak_translations`
--

DROP TABLE IF EXISTS `kontak_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kontak_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kontak_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kontak_translations_kontak_id_bahasa_unique` (`kontak_id`,`bahasa`),
  KEY `kontak_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `kontak_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `kontak_translations_kontak_id_foreign` FOREIGN KEY (`kontak_id`) REFERENCES `kontak` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontak_translations`
--

LOCK TABLES `kontak_translations` WRITE;
/*!40000 ALTER TABLE `kontak_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontak_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_translations`
--

DROP TABLE IF EXISTS `menu_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_translations_menu_id_bahasa_unique` (`menu_id`,`bahasa`),
  KEY `menu_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `menu_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_translations`
--

LOCK TABLES `menu_translations` WRITE;
/*!40000 ALTER TABLE `menu_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_08_16_034353_create_bahasa_table',1),(5,'2026_08_16_034433_create_beranda_table',1),(6,'2026_08_16_034434_create_beranda_translations_table',1),(7,'2026_08_16_034704_create_banner_halaman_table',1),(8,'2026_08_16_034705_create_banner_halaman_translations_table',1),(9,'2026_08_16_045010_create_stakeholder_table',1),(10,'2026_08_16_045011_create_stakeholder_translations_table',1),(11,'2026_08_16_045045_create_program_table',1),(12,'2026_08_16_045046_create_program_translations_table',1),(13,'2026_08_16_045108_create_proyek_table',1),(14,'2026_08_16_045109_create_proyek_translations_table',1),(15,'2026_08_16_045130_create_proyek_galeri_table',1),(16,'2026_08_16_045131_create_proyek_galeri_translations_table',1),(17,'2026_08_16_133704_create_mitra_table',1),(18,'2026_08_16_133705_create_mitra_translations_table',1),(19,'2026_08_16_133747_create_berita_table',1),(20,'2026_08_16_133748_create_berita_translations_table',1),(21,'2026_08_16_133807_create_berita_galeri_table',1),(22,'2026_08_16_133808_create_berita_galeri_translations_table',1),(23,'2026_08_16_134039_create_tentang_table',1),(24,'2026_08_16_134040_create_tentang_translations_table',1),(25,'2026_08_16_150058_create_struktur_organisasi_table',1),(26,'2026_08_16_150059_create_struktur_organisasi_translations_table',1),(27,'2026_08_16_150147_create_kontak_table',1),(28,'2026_08_16_150148_create_kontak_translations_table',1),(29,'2026_08_16_150236_create_kontak_form_table',1),(30,'2026_08_16_150308_create_menu_table',1),(31,'2026_08_16_150309_create_menu_translations_table',1),(32,'2026_08_16_150333_create_footer_table',1),(33,'2026_08_16_150334_create_footer_translations_table',1),(34,'2026_08_23_000001_create_proyek_mitra_table',1),(35,'2026_08_23_000002_create_program_poin_table',1),(36,'2026_08_23_000003_create_program_poin_translations_table',1),(37,'2026_08_23_000004_create_tags_table',1),(38,'2026_08_23_000005_create_tag_translations_table',1),(39,'2026_08_23_000006_create_berita_tag_table',1),(40,'2026_08_23_000007_create_tentang_poin_table',1),(41,'2026_08_23_000008_create_tentang_poin_translations_table',1),(42,'2026_08_23_000009_create_kontak_detail_table',1),(43,'2026_08_23_000010_create_kontak_detail_translations_table',1),(44,'2026_08_23_100001_create_kategori_berita_table',1),(45,'2026_08_23_100002_create_kategori_berita_translations_table',1),(46,'2026_08_23_100003_create_proyek_tujuan_table',1),(47,'2026_08_23_100004_create_proyek_tujuan_translations_table',1),(48,'2026_08_23_100005_create_proyek_dampak_capaian_table',1),(49,'2026_08_23_100006_create_proyek_dampak_capaian_translations_table',1),(50,'2026_08_23_100007_create_proyek_kegiatan_utama_table',1),(51,'2026_08_23_100008_create_proyek_kegiatan_utama_translations_table',1),(52,'2026_08_23_100009_create_proyek_linimasa_table',1),(53,'2026_08_23_100010_create_kontak_social_media_table',1),(54,'2026_08_23_100011_create_kontak_email_table',1),(55,'2026_08_23_100012_create_kontak_phone_table',1),(56,'2026_08_23_100013_alter_proyek_translations_table',1),(57,'2026_08_23_100014_alter_kontak_table',1),(58,'2026_08_23_100015_drop_kontak_detail_tables',1),(59,'2026_08_23_100016_rename_tag_translations_nama_to_tag',1),(60,'2026_08_23_100017_fix_proyek_sub_tables_fk',1),(61,'2026_08_23_110001_create_program_roadmap_table',1),(62,'2026_08_23_110002_create_program_roadmap_translations_table',1),(63,'2026_08_24_130001_make_beranda_translations_deskripsi_nullable',1),(64,'2026_08_25_000001_make_mitra_translations_nullable',1),(65,'2026_08_25_000002_create_kategori_mitra_table',1),(66,'2026_08_25_000003_create_mitra_intro_table',1),(67,'2026_08_25_093400_add_gambar_to_program_roadmap_table',1),(68,'2026_08_25_140500_add_judul_and_deskripsi_to_berita_galeri_translations_table',1),(69,'2026_08_25_161000_make_deskripsi_nullable_in_kontak_translations_table',1),(70,'2026_08_26_100241_add_performance_indexes_to_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitra`
--

DROP TABLE IF EXISTS `mitra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mitra` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mitra_status_index` (`status`),
  KEY `mitra_urutan_index` (`urutan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitra`
--

LOCK TABLES `mitra` WRITE;
/*!40000 ALTER TABLE `mitra` DISABLE KEYS */;
/*!40000 ALTER TABLE `mitra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitra_intro`
--

DROP TABLE IF EXISTS `mitra_intro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mitra_intro` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitra_intro`
--

LOCK TABLES `mitra_intro` WRITE;
/*!40000 ALTER TABLE `mitra_intro` DISABLE KEYS */;
/*!40000 ALTER TABLE `mitra_intro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitra_intro_translations`
--

DROP TABLE IF EXISTS `mitra_intro_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mitra_intro_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mitra_intro_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjudul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mitra_intro_translations_mitra_intro_id_bahasa_unique` (`mitra_intro_id`,`bahasa`),
  KEY `mitra_intro_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `mitra_intro_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `mitra_intro_translations_mitra_intro_id_foreign` FOREIGN KEY (`mitra_intro_id`) REFERENCES `mitra_intro` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitra_intro_translations`
--

LOCK TABLES `mitra_intro_translations` WRITE;
/*!40000 ALTER TABLE `mitra_intro_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `mitra_intro_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mitra_translations`
--

DROP TABLE IF EXISTS `mitra_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mitra_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mitra_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mitra_translations_mitra_id_bahasa_unique` (`mitra_id`,`bahasa`),
  KEY `mitra_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `mitra_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `mitra_translations_mitra_id_foreign` FOREIGN KEY (`mitra_id`) REFERENCES `mitra` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitra_translations`
--

LOCK TABLES `mitra_translations` WRITE;
/*!40000 ALTER TABLE `mitra_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `mitra_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `program_status_index` (`status`),
  KEY `program_urutan_index` (`urutan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_poin`
--

DROP TABLE IF EXISTS `program_poin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_poin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program_id` bigint unsigned NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `program_poin_program_id_foreign` (`program_id`),
  CONSTRAINT `program_poin_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_poin`
--

LOCK TABLES `program_poin` WRITE;
/*!40000 ALTER TABLE `program_poin` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_poin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_poin_translations`
--

DROP TABLE IF EXISTS `program_poin_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_poin_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program_poin_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_poin_translations_program_poin_id_bahasa_unique` (`program_poin_id`,`bahasa`),
  KEY `program_poin_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `program_poin_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `program_poin_translations_program_poin_id_foreign` FOREIGN KEY (`program_poin_id`) REFERENCES `program_poin` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_poin_translations`
--

LOCK TABLES `program_poin_translations` WRITE;
/*!40000 ALTER TABLE `program_poin_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_poin_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_roadmap`
--

DROP TABLE IF EXISTS `program_roadmap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_roadmap` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_roadmap`
--

LOCK TABLES `program_roadmap` WRITE;
/*!40000 ALTER TABLE `program_roadmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_roadmap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_roadmap_translations`
--

DROP TABLE IF EXISTS `program_roadmap_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_roadmap_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program_roadmap_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_roadmap_translations_program_roadmap_id_bahasa_unique` (`program_roadmap_id`,`bahasa`),
  KEY `program_roadmap_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `program_roadmap_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `program_roadmap_translations_program_roadmap_id_foreign` FOREIGN KEY (`program_roadmap_id`) REFERENCES `program_roadmap` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_roadmap_translations`
--

LOCK TABLES `program_roadmap_translations` WRITE;
/*!40000 ALTER TABLE `program_roadmap_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_roadmap_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_translations`
--

DROP TABLE IF EXISTS `program_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `program_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_translations_program_id_bahasa_unique` (`program_id`,`bahasa`),
  KEY `program_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `program_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `program_translations_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_translations`
--

LOCK TABLES `program_translations` WRITE;
/*!40000 ALTER TABLE `program_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek`
--

DROP TABLE IF EXISTS `proyek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proyek_slug_unique` (`slug`),
  KEY `proyek_status_index` (`status`),
  KEY `proyek_urutan_index` (`urutan`),
  KEY `proyek_status_urutan_index` (`status`,`urutan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek`
--

LOCK TABLES `proyek` WRITE;
/*!40000 ALTER TABLE `proyek` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_dampak_capaian`
--

DROP TABLE IF EXISTS `proyek_dampak_capaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_dampak_capaian` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_translations_id` bigint unsigned NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_capaian` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pdc_proj_fk` (`proyek_translations_id`),
  CONSTRAINT `pdc_proj_fk` FOREIGN KEY (`proyek_translations_id`) REFERENCES `proyek_translations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_dampak_capaian`
--

LOCK TABLES `proyek_dampak_capaian` WRITE;
/*!40000 ALTER TABLE `proyek_dampak_capaian` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_dampak_capaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_galeri`
--

DROP TABLE IF EXISTS `proyek_galeri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_galeri` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_id` bigint unsigned NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proyek_galeri_proyek_id_foreign` (`proyek_id`),
  CONSTRAINT `proyek_galeri_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_galeri`
--

LOCK TABLES `proyek_galeri` WRITE;
/*!40000 ALTER TABLE `proyek_galeri` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_galeri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_galeri_translations`
--

DROP TABLE IF EXISTS `proyek_galeri_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_galeri_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_galeri_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proyek_galeri_translations_proyek_galeri_id_bahasa_unique` (`proyek_galeri_id`,`bahasa`),
  KEY `proyek_galeri_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `proyek_galeri_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `proyek_galeri_translations_proyek_galeri_id_foreign` FOREIGN KEY (`proyek_galeri_id`) REFERENCES `proyek_galeri` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_galeri_translations`
--

LOCK TABLES `proyek_galeri_translations` WRITE;
/*!40000 ALTER TABLE `proyek_galeri_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_galeri_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_kegiatan_utama`
--

DROP TABLE IF EXISTS `proyek_kegiatan_utama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_kegiatan_utama` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_translations_id` bigint unsigned NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pkut_proj_fk` (`proyek_translations_id`),
  CONSTRAINT `pkut_proj_fk` FOREIGN KEY (`proyek_translations_id`) REFERENCES `proyek_translations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_kegiatan_utama`
--

LOCK TABLES `proyek_kegiatan_utama` WRITE;
/*!40000 ALTER TABLE `proyek_kegiatan_utama` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_kegiatan_utama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_linimasa`
--

DROP TABLE IF EXISTS `proyek_linimasa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_linimasa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_translations_id` bigint unsigned NOT NULL,
  `tahun` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pl_proj_fk` (`proyek_translations_id`),
  CONSTRAINT `pl_proj_fk` FOREIGN KEY (`proyek_translations_id`) REFERENCES `proyek_translations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_linimasa`
--

LOCK TABLES `proyek_linimasa` WRITE;
/*!40000 ALTER TABLE `proyek_linimasa` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_linimasa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_mitra`
--

DROP TABLE IF EXISTS `proyek_mitra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_mitra` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_id` bigint unsigned NOT NULL,
  `mitra_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proyek_mitra_proyek_id_mitra_id_unique` (`proyek_id`,`mitra_id`),
  KEY `proyek_mitra_mitra_id_foreign` (`mitra_id`),
  CONSTRAINT `proyek_mitra_mitra_id_foreign` FOREIGN KEY (`mitra_id`) REFERENCES `mitra` (`id`) ON DELETE CASCADE,
  CONSTRAINT `proyek_mitra_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_mitra`
--

LOCK TABLES `proyek_mitra` WRITE;
/*!40000 ALTER TABLE `proyek_mitra` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_mitra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_translations`
--

DROP TABLE IF EXISTS `proyek_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi_singkat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruang_lingkup` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_proyek` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeline` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proyek_translations_proyek_id_bahasa_unique` (`proyek_id`,`bahasa`),
  KEY `proyek_translations_bahasa_foreign` (`bahasa`),
  KEY `proyek_translations_kategori_index` (`kategori`),
  CONSTRAINT `proyek_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `proyek_translations_proyek_id_foreign` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_translations`
--

LOCK TABLES `proyek_translations` WRITE;
/*!40000 ALTER TABLE `proyek_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek_tujuan`
--

DROP TABLE IF EXISTS `proyek_tujuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek_tujuan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `proyek_translations_id` bigint unsigned NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pt_proj_fk` (`proyek_translations_id`),
  CONSTRAINT `pt_proj_fk` FOREIGN KEY (`proyek_translations_id`) REFERENCES `proyek_translations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek_tujuan`
--

LOCK TABLES `proyek_tujuan` WRITE;
/*!40000 ALTER TABLE `proyek_tujuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyek_tujuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stakeholder`
--

DROP TABLE IF EXISTS `stakeholder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stakeholder` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stakeholder_status_index` (`status`),
  KEY `stakeholder_urutan_index` (`urutan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stakeholder`
--

LOCK TABLES `stakeholder` WRITE;
/*!40000 ALTER TABLE `stakeholder` DISABLE KEYS */;
/*!40000 ALTER TABLE `stakeholder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stakeholder_translations`
--

DROP TABLE IF EXISTS `stakeholder_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stakeholder_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stakeholder_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stakeholder_translations_stakeholder_id_bahasa_unique` (`stakeholder_id`,`bahasa`),
  KEY `stakeholder_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `stakeholder_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `stakeholder_translations_stakeholder_id_foreign` FOREIGN KEY (`stakeholder_id`) REFERENCES `stakeholder` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stakeholder_translations`
--

LOCK TABLES `stakeholder_translations` WRITE;
/*!40000 ALTER TABLE `stakeholder_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `stakeholder_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `struktur_organisasi`
--

DROP TABLE IF EXISTS `struktur_organisasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `struktur_organisasi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `struktur_organisasi`
--

LOCK TABLES `struktur_organisasi` WRITE;
/*!40000 ALTER TABLE `struktur_organisasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `struktur_organisasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `struktur_organisasi_translations`
--

DROP TABLE IF EXISTS `struktur_organisasi_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `struktur_organisasi_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `struktur_organisasi_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `struktur_organisasi_translations_unique` (`struktur_organisasi_id`,`bahasa`),
  KEY `struktur_organisasi_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `struktur_organisasi_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `struktur_organisasi_translations_struktur_organisasi_id_foreign` FOREIGN KEY (`struktur_organisasi_id`) REFERENCES `struktur_organisasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `struktur_organisasi_translations`
--

LOCK TABLES `struktur_organisasi_translations` WRITE;
/*!40000 ALTER TABLE `struktur_organisasi_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `struktur_organisasi_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_translations`
--

DROP TABLE IF EXISTS `tag_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_translations_tag_id_bahasa_unique` (`tag_id`,`bahasa`),
  KEY `tag_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `tag_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `tag_translations_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_translations`
--

LOCK TABLES `tag_translations` WRITE;
/*!40000 ALTER TABLE `tag_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tentang`
--

DROP TABLE IF EXISTS `tentang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tentang` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tentang`
--

LOCK TABLES `tentang` WRITE;
/*!40000 ALTER TABLE `tentang` DISABLE KEYS */;
/*!40000 ALTER TABLE `tentang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tentang_poin`
--

DROP TABLE IF EXISTS `tentang_poin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tentang_poin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tentang_id` bigint unsigned NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tentang_poin_tentang_id_foreign` (`tentang_id`),
  CONSTRAINT `tentang_poin_tentang_id_foreign` FOREIGN KEY (`tentang_id`) REFERENCES `tentang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tentang_poin`
--

LOCK TABLES `tentang_poin` WRITE;
/*!40000 ALTER TABLE `tentang_poin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tentang_poin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tentang_poin_translations`
--

DROP TABLE IF EXISTS `tentang_poin_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tentang_poin_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tentang_poin_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tentang_poin_translations_tentang_poin_id_bahasa_unique` (`tentang_poin_id`,`bahasa`),
  KEY `tentang_poin_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `tentang_poin_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `tentang_poin_translations_tentang_poin_id_foreign` FOREIGN KEY (`tentang_poin_id`) REFERENCES `tentang_poin` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tentang_poin_translations`
--

LOCK TABLES `tentang_poin_translations` WRITE;
/*!40000 ALTER TABLE `tentang_poin_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tentang_poin_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tentang_translations`
--

DROP TABLE IF EXISTS `tentang_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tentang_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tentang_id` bigint unsigned NOT NULL,
  `bahasa` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subjudul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tentang_translations_tentang_id_bahasa_unique` (`tentang_id`,`bahasa`),
  KEY `tentang_translations_bahasa_foreign` (`bahasa`),
  CONSTRAINT `tentang_translations_bahasa_foreign` FOREIGN KEY (`bahasa`) REFERENCES `bahasa` (`kode`) ON DELETE CASCADE,
  CONSTRAINT `tentang_translations_tentang_id_foreign` FOREIGN KEY (`tentang_id`) REFERENCES `tentang` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tentang_translations`
--

LOCK TABLES `tentang_translations` WRITE;
/*!40000 ALTER TABLE `tentang_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tentang_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin BPI','admin.bpi@gmail.com','2026-08-26 04:00:05','$2y$12$9Sq7s9s2BdJyyJ0m5nL7xueNs0vwkzNsbqgY5l6vPg4u95qG4SGeC',NULL,'2026-08-26 04:00:05','2026-08-26 04:00:05');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-26 18:01:41
