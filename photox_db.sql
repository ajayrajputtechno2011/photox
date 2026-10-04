-- MySQL dump 10.19  Distrib 10.3.39-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: photox
-- ------------------------------------------------------
-- Server version	10.3.39-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES ('0xH78iIoV0DxCj3StA5xo8DlTh5zQI7AY16hqX0p',NULL,'195.123.244.84','Mozilla/5.0 (X11; Linux x86_64; rv:122.0) Gecko/20100101 Firefox/122.0','eyJfdG9rZW4iOiJYWUFoUEdpT3VFVzdsdVdxR0JJSHZ6TVI2N2hRVGxiNlVOdExiUHdoIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790155783),('2svoelnezK9BfsMo9Ot9GDFFodq0B0H5UDQsK6dN',NULL,'66.116.196.82','curl/7.61.1','eyJfdG9rZW4iOiJHY2dlWlBLc1Y3NDdvYmlHczZHd241RTVldW5rM0w2cTlsTHlJSVhpIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790157277),('66QmGg0pjOhJ6OdBXjRJD04iGmHFgYSR6KeBOHXd',NULL,'93.152.209.4','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI3bWQ3bEpNVjVNdlFCTmEzbm5FdUJONUhTTFpkcHgxaFF2VmxUa2wzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153469),('6PzQDTm7IoLcW0eRvRR47S0UqxXGBlhKcPHJkZb1',NULL,'87.192.41.15','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJXOFJTcnpTRnZQUjc0MEl5NldJUGJFWFVjbm0zRzNOb2phUUZ1YXdZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153461),('6Yfb3ly4p8km8lpiCdoEJL0hlHV0jUElf5xM092U',NULL,'52.90.245.233','Mozilla/5.0 (Linux; Android 16; SM-S921U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36','eyJfdG9rZW4iOiJCSzFVdXVycXBUVUF5b2p2dGZTUnJTWEt1VGMxMDJjeDM4c1NSSlIxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153481),('7lcrGFvoW1mP4JsKRhRTI1F37fHQ4WnSLLhnOxR9',NULL,'159.223.132.86','Mozilla/5.0 (l9scan/2.0.2383e2639313e2631313e26363; +https://leakix.net)','eyJfdG9rZW4iOiI0TEUxOUxFNlF3cXVoT2h4Y01iSnpCcUxIY2hjbzl6M0x4eER5Y21rIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153523),('7sCb9IIZWMWzBJab0gBNbXO8cAPdIoDyL8ETTQ8o',NULL,'158.69.55.82','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJta3RjM1R2TUJpeURIYm01MEljdHdJRTVkN3pJWVBCRVlmVzJSUkd1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153634),('99yNtAIRMPHCkY2JqmTkJkwszOnp7ZBKLrwwZEf2',NULL,'103.196.9.8','Mozilla/5.0 (iPhone; CPU iPhone OS 26_3_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/144.0.7559.95 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJHWDZyeTVBVEdBMUsyZFlQUXd5NWlrb1JKQnIzN2d1YXhOdk1aamE3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790154870),('A6CqwdiNQb010pXm6YERfhtULOg0B2OGdx4BStXK',NULL,'93.152.209.3','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36','eyJfdG9rZW4iOiIxNGFVUnVaV3UyYVlFaE9EdENjaEJsV2tkWGhDRnFxQll0RVRZSThFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153456),('acuJnWBxN937pTx7oRVpjO6eBjN22ZOCIVK49GNy',NULL,'195.123.244.84','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:120.0) Gecko/20100101 Firefox/120.0','eyJfdG9rZW4iOiI1SUkyVnB0ejZiM0ZMQnhieGliU0hkVE5CRUxqV3BFa1ExdkFxWjZ5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790155784),('Br8i6bpjKuoD8W143knqShUF8QLNRoqZYlQFsWYW',NULL,'66.116.196.82','curl/7.61.1','eyJfdG9rZW4iOiJJZnNTMDYyRGtpNkZtRk0xOHo1Zkt5RHBWSGUyN2tDY05GNVZwMjhZIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790153875),('D3lRqQqvw8IjpTfThyDKeYPJKsgcGX4ipOBAvCWN',NULL,'66.116.196.82','curl/7.61.1','eyJfdG9rZW4iOiI2RzJKb253R0pYTUdXTklCUHNGU0xUS2g4d1VwN1NCemplSHY1cFduIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790157277),('dFtSvYJyRN6ypKTy672wSt60mkv8JZmAF3hqrEgZ',NULL,'122.181.100.173','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJLOUZDUlVpdXE5TExGWHpTU3UzbXV3N1lHd0RiWm43ZXhUYnY5dUt4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790157674),('eJ2j7D1I5up3RlUvhIQdIPbcu7SQMUK91gioFGrV',NULL,'159.223.132.86','Mozilla/5.0 (l9scan/2.0.2383e2639313e2631313e26363; +https://leakix.net)','eyJfdG9rZW4iOiJCQUZINU1YRHdLMXBFZmRXa2tpc1FuVG1Jc0twcGJxRU1tYVB3dDlzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluXC8/cmVzdF9yb3V0ZT0lMkZ3cCUyRnYyJTJGdXNlcnMlMkYiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790153554),('EsToxxLK8OKLmlYgWeeTfrcLsiRVM2hZoFfRqYtU',NULL,'122.181.100.173','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJCd3VOam96NlhxTDcwTjg5dGhTSzNNOWxkQmtpbTRnSjF1RGNXajlBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790156507),('FTJ9fogec04oHtIjhxqXMWXV3QiOjBgzfFAGSqfb',NULL,'168.100.11.184','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0','eyJfdG9rZW4iOiI3SWVMM3ZZcWtweDdzMjBJQ3plUjVZZGdRYmpjTEJUcFBIYTFrWDdLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790156997),('FYw5nKp1M2QODP4OxhnVOQJxU05nwzp7TvxwFmoI',NULL,'66.116.196.82','curl/7.61.1','eyJfdG9rZW4iOiJ1ZEExY2JpbjlSc0Vrc0tNQWlERFIxaHFMZmFmaHN6NUt2Z3ZvYlBMIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790153469),('l09sNbHZHmSzTEva3o55pX0eeYJzE6ZIw0G2gi75',NULL,'3.238.17.167','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJNSEsyc2hVRlk1cDZ3OElTSEdNRlZXdW53RDc1dzU0eXJzQ0xCUzQxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153482),('lohvus8kwbTGQrM6arCPYfhdnMqaz1I3Fi6uN4ah',NULL,'216.73.217.34','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; ClaudeBot/1.0; +claudebot@anthropic.com)','eyJfdG9rZW4iOiJaeTNoallHSEZ0dGpQb2ZiUzhQd0dXOHNLcndwT1gybWptU2FRYVVFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790156880),('nCmipPgGAG31UTXEOGVBcX2kpAJiutMHi9Isaj71',NULL,'137.184.87.161','Mozilla/5.0 (X11; Linux x86_64; rv:142.0) Gecko/20100101 Firefox/142.0','eyJfdG9rZW4iOiJhT01MVTJDUVBVYTdnUGtUdHlqZG9SQ2QzZ0JrZm9ISVlhVjJaZUN6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153805),('nwkB9WDJ5UzUVB2yGl2PjAjOCF8YF30enkz7v1uM',NULL,'158.69.55.148','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJORXZuc1NWOHdpMzQ2RERaMktlbFA5ejFyMm8wRk5Pb0lDeWE0Vk9UIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluXC9waG90b2dyYXBoZXItdXBsb2FkLW5ldy5odG1sIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153860),('qiTXLC8iaHfsLAnyySE5kVbZG73fvPuPJvhu8480',NULL,'74.7.242.53','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.4; +https://openai.com/gptbot)','eyJfdG9rZW4iOiJickNiY3dnV0JMd1M2TlUwYWtuUDJhaGNnWHJOM1VqTG5YeXNHV0ZMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluXC9nYWxsZXJ5Lmh0bWwiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1790156431),('RJqdPL7rr1zr9Td3QIcqvqHiWORhxvum5B8wy4Lc',NULL,'104.165.20.2','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI2NzNDOTNFVEZsWHdQVmZZTVdZQUtuZVFtZU11Z21QQkJOUEw3bVFMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790154698),('sp61nCb9jnKSrPfcE82FdTUyCQGBqtPia4R02lEQ',NULL,'47.79.233.158','Mozilla/5.0 (compatible; rust_sniffer/0.1; +https://github.com/)','eyJfdG9rZW4iOiJXMkhTNmx6YjdTMGlIWVdDVnluRzB5UHpMQmZPQUZFd3FMSkRmaWtqIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790153620),('Tzx9818Mr59R63envRuY7o2U4A3Cd7YTNyVfMiYk',NULL,'66.116.196.82','curl/7.61.1','eyJfdG9rZW4iOiJLRzcxeVZ2a1M4ZktMeGh6cG81cDFYdE5JS1hDR0pkajhwME1NcE9vIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1790153906),('U1WHbudxIddiNxXw9nxLZkiCaU6yNHxELAVa5JeS',NULL,'103.196.9.71','Mozilla/5.0 (iPhone; CPU iPhone OS 26_3_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/144.0.7559.95 Mobile/15E148 Safari/604.1','eyJfdG9rZW4iOiJtbDNzQTl1RllwU1N5M1VhcGtNSFg5NzhHeHJJbGtvSkxoVXNYRHMxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790154869),('V5CT5AeogYJ4K7jAoiBh2oJDDEPlOu7O68gXr3Yc',NULL,'159.223.132.86','Mozilla/5.0 (l9scan/2.0.2383e2639313e2631313e26363; +https://leakix.net)','eyJfdG9rZW4iOiI5U1E5YXZvN2dSMlFIQmJBVEIzTGZFaTdnME5ZMGt5VmxZTlE2RjBMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153530),('vFINGezWX1IKcigIzahbzHyymzE913WybB6nd5Ye',NULL,'66.116.196.82','curl/7.61.1','eyJfdG9rZW4iOiJDY2NGQmJ0UTJsTmdtVzBnc09qU3BWelZaV21sdzYyZjltekltWFhHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153888),('vj52ISki2Zi0lDswLKVgP5UnLGNivoN0bkyIPhKz',NULL,'91.231.89.226','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:134.0) Gecko/20100101 Firefox/134.0','eyJfdG9rZW4iOiJzeXVYWmE0NkZ0Rkt6UFM4Y1RhQlJ5WmJUZWF4Y0NScHptMXpNdHFjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790154034),('WIpFjk224DC0ji2NYx4ePA2fxLQrbrfVaVJPFTFv',NULL,'57.129.136.57','','eyJfdG9rZW4iOiJLMnpGY1VwRDVmc04xWGJJZlYyc3Z6bHQ5NUZWblRqb3RhMEYxa0VlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153466),('X526DcYMSA3pRPU5v4mbiNkdJa36M3WYitgZl0Ea',NULL,'57.129.136.57','','eyJfdG9rZW4iOiI2VTdCVXdScEMzcHQ1MzBZemJhUG1BbDYyOWhIaTVaWDFpcGU4ZEM0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9waG90b3guYWl0ZWNobm90ZWNoLmluIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1790153457);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2026-09-23  4:01:28
