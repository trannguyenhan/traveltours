-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: traveltours
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.10.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (2,'2022-06-17 06:49:44','2022-06-17 10:21:54','Du lịch biển','Du lịch tới các vùng biển như Vũng Tàu, Cát Bà,...'),(7,'2022-06-17 10:24:52','2022-06-23 08:06:18','Thắp hương đầu năm','Đi chùa cầu may, cầu duyên đầu '),(8,'2022-06-17 10:25:40','2022-06-17 10:25:40','Leo núi','Leo núi và các trò chơi mạo hiểm'),(9,'2022-06-17 10:25:40','2022-06-17 10:25:40','Miền quê','Du lịch thăm quan các miền quê');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `start_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL,
  `threshold` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'2021-08-25 05:38:37','2022-07-21 09:56:52','BH123',13.00,'2022-07-12 17:00:00','2022-07-27 17:00:00',14.00),(2,'2022-07-21 17:16:37','2022-07-21 17:16:37','MH123',23.00,'2022-07-03 17:00:00','2022-08-02 17:00:00',30.00);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
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
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (10,'2014_10_12_000000_create_users_table',1),(11,'2014_10_12_100000_create_password_resets_table',1),(12,'2019_08_19_000000_create_failed_jobs_table',1),(13,'2019_12_14_000001_create_personal_access_tokens_table',1),(14,'2022_04_19_133951_create_permission_tables',1),(15,'2022_04_24_150628_create_places_table',1),(16,'2022_04_24_151217_create_reviews_table',1),(17,'2022_04_24_151246_create_place_review_table',1),(18,'2022_04_24_151434_create_tours_table',1),(19,'2022_04_24_171558_add_status_column_to_users_table',2),(20,'2022_04_30_145323_create_categories_table',3),(21,'2022_04_30_171032_create_categories_table',4),(22,'2022_04_30_171340_create_tour_category_table',5),(23,'2022_05_01_082315_add_column_to_tours_table',6),(24,'2022_05_01_090910_add_place_id_column_to_reviews_table',7),(25,'2022_05_02_013645_add_avatar_column_to_users_table',8),(26,'2022_05_09_160411_add_display_name_column_to_roles_table',9),(27,'2022_06_17_120834_create_prices_table',9),(28,'2022_06_17_120954_create_tour_guides_table',9),(29,'2022_06_17_121142_create_coupons_table',9),(30,'2022_06_17_121559_alter_tours_table',10),(31,'2022_06_17_122405_create_category_tour_table',11),(32,'2022_06_17_122945_create_tour_review_table',12),(33,'2022_06_17_123153_create_place_review_2_table',13),(34,'2022_06_17_123237_create_orders_table',14),(35,'2022_06_17_130940_delele_tour_review_table',15),(36,'2022_06_17_131029_delele_place_review_table',16),(37,'2022_06_17_131453_alter_review_table',17),(38,'2022_07_04_153521_set_default_value_coupon_id_column_in_orders_table',18),(39,'2022_07_05_093146_add_name_to_tours',19),(40,'2022_07_05_103250_alter_table_tours_change_places',20),(41,'2022_07_13_095535_add_ward_to_places_table',21),(42,'2022_07_21_113239_alter_table_prices_change_adult_child',22),(43,'2022_07_22_010339_del_category_tour_table',22);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',5),(2,'App\\Models\\User',6),(2,'App\\Models\\User',8),(2,'App\\Models\\User',9),(2,'App\\Models\\User',10),(2,'App\\Models\\User',11),(2,'App\\Models\\User',12),(2,'App\\Models\\User',13),(2,'App\\Models\\User',14),(2,'App\\Models\\User',15),(2,'App\\Models\\User',16),(2,'App\\Models\\User',17),(2,'App\\Models\\User',18),(2,'App\\Models\\User',19),(2,'App\\Models\\User',20),(2,'App\\Models\\User',21),(2,'App\\Models\\User',22);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tour_id` int NOT NULL,
  `coupon_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `child_count` int NOT NULL,
  `adult_count` int NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `tax` double(8,2) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (4,'2022-07-16 21:10:34','2022-07-16 21:10:34',1,NULL,6,0,1,13.00,10.00,'cod','penning'),(5,'2022-07-16 21:11:06','2022-07-21 08:52:51',1,NULL,6,0,1,13.00,10.00,'cod','active'),(21,'2022-07-17 06:02:44','2022-07-21 08:52:50',1,NULL,6,0,1,13.00,10.00,'cod','active'),(28,'2022-07-21 10:00:41','2022-07-21 10:00:41',2,NULL,6,0,1,11.31,10.00,'cod','penning'),(33,'2022-07-21 10:18:54','2022-07-21 10:18:54',1,NULL,6,0,1,13.00,10.00,'cod','penning');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `places` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_detail` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json NOT NULL,
  `ward` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places`
--

LOCK TABLES `places` WRITE;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` VALUES (1,'2022-07-08 06:17:22','2022-07-21 01:15:12','Tỉnh Bắc Giang','Huyện Sơn Động','Sơn Động, Bắc Giang','Tây Yên Tử','Khu du lịch sinh thái Tây Yên Tử','[\"https://pystravel.vn/uploads/posts/albums/3310/a56dd85372e8a4ece692cc7e7beb5521.jpg\"]','Thị trấn Tây Yên Tử'),(2,'2022-07-08 06:17:22','2022-07-21 01:12:24','Tỉnh Bắc Giang','Huyện Lục Ngạn','Chũ, Lục Ngạn, Bắc Giang','Thị chấn Chũ','Trung tâm thị chấn','[\"http://127.0.0.1:8000/uploads/place/62d90a6836bf2.jpg\"]','Thị trấn Chũ'),(4,'2022-07-21 01:10:23','2022-07-21 01:10:23','Thành phố Hải Phòng','Huyện Cát Hải','Cát bà, Cát Hải, Hải Phòng','Vịnh Hạ Long','Vịnh Hạ Long tươi đẹp','[\"http://127.0.0.1:8000/uploads/place/62d909ef76139.jpg\"]','Thị trấn Cát Bà'),(5,'2022-07-21 17:44:59','2022-07-21 17:44:59','Tỉnh Lào Cai','Thị xã Sa Pa','Phan Si Păng, Sa Pa, Lào Cai','Fansipan','Khu du lịch Phan Si Păng','[\"http://127.0.0.1:8000/uploads/place/62d9f30b5254e.jpg\"]','Phường Phan Si Păng');
/*!40000 ALTER TABLE `places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `child` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,'2022-06-17 06:49:44','2022-06-17 06:49:44','12.00','13.00'),(2,'2022-06-17 06:49:44','2022-07-21 10:40:46','15.00','30.00'),(3,NULL,NULL,'15.00','20.00'),(4,NULL,NULL,'2.00','32.00'),(5,NULL,NULL,'17.00','34.00');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int NOT NULL,
  `star` double NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'2022-07-19 06:59:01','2022-07-19 06:59:01',6,5,'tour','Hướng dẫn viên chuyên nghiệp',1),(2,'2022-07-19 06:59:01','2022-07-19 06:59:01',9,4,'tour','Chu đáo, tận ',1),(3,'2022-07-19 06:59:01','2022-07-19 06:59:01',21,4,'tour','Tốt ',1),(4,'2022-07-19 07:01:01','2022-07-19 07:01:01',10,4,'tour','Tốt',1),(5,'2022-07-19 08:23:26','2022-07-19 08:23:26',20,4,'place','Đẹp nhưng vẫn còn đang xây dựng',1),(6,'2022-07-19 08:24:51','2022-07-19 08:24:51',6,4,'place','Thử lại một lần nữa',1),(7,'2022-07-21 17:33:15','2022-07-21 17:33:15',10,4,'place','Khu vực tuyệt đẹp',4);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','api',NULL,NULL,NULL),(2,'member','api',NULL,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_category`
--

DROP TABLE IF EXISTS `tour_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_category` (
  `tour_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`tour_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_category`
--

LOCK TABLES `tour_category` WRITE;
/*!40000 ALTER TABLE `tour_category` DISABLE KEYS */;
INSERT INTO `tour_category` VALUES (1,7),(1,9),(4,2),(4,8),(5,7),(5,9),(6,8);
/*!40000 ALTER TABLE `tour_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_guides`
--

DROP TABLE IF EXISTS `tour_guides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tour_guides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_guides`
--

LOCK TABLES `tour_guides` WRITE;
/*!40000 ALTER TABLE `tour_guides` DISABLE KEYS */;
INSERT INTO `tour_guides` VALUES (1,'2022-06-17 06:49:44','2022-07-21 01:19:40','Davies','09123123','Núi Hiểu, Quang Châu'),(2,'2022-06-17 06:49:44','2022-06-17 10:43:09','Jonny','12312321','Da Nang, Lam Dong'),(3,'2022-06-17 10:41:08','2022-06-17 10:43:02','Hoàng Ngọc Lâm','HDV tài năng','1234');
/*!40000 ALTER TABLE `tour_guides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tours`
--

DROP TABLE IF EXISTS `tours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tours` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dest` int NOT NULL,
  `tour_guide_id` int NOT NULL,
  `price_id` int NOT NULL,
  `range` int NOT NULL,
  `start_date` timestamp NOT NULL,
  `vehicle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_star` int NOT NULL,
  `schedule` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `places` json NOT NULL,
  `max_slot` int NOT NULL,
  `slot` int NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tours`
--

LOCK TABLES `tours` WRITE;
/*!40000 ALTER TABLE `tours` DISABLE KEYS */;
INSERT INTO `tours` VALUES (1,'2022-06-17 06:49:44','2022-06-17 06:49:44',1,1,1,5,'2022-06-17 06:49:44','Ô tô 16 chỗ ngồi',4,'aa','[1, 2]',3,1,'Tham quan mùa xuân'),(2,'2022-06-17 06:49:44','2022-06-17 06:49:44',4,1,1,7,'2022-06-17 06:49:44','Ô tô 16 chỗ ngồi',5,'aa','[1, 4]',3,0,'Tham quan khu du lịch sinh thái Vịnh Hạ Long'),(3,'2022-06-17 06:49:44','2022-06-17 06:49:44',4,1,2,14,'2022-06-27 06:49:44','Ô tô 30 chỗ ngồi',5,'aa','[1, 4]',20,0,'Tham quan khu du lịch sinh thái Vịnh Hạ Long'),(4,'2022-07-21 10:44:38','2022-07-21 10:44:38',1,2,3,5,'2022-07-25 17:00:00','Máy bay',5,'Đi khắp nơi','[2, 1]',50,0,'Bán đảo Triều Tiên'),(5,'2022-07-21 10:45:52','2022-07-21 18:05:05',2,2,4,5,'2022-07-18 17:00:00','Thuyền, bè',5,'Đi Nhât Lệ','[4, 2]',50,0,'Bán đảo Nhật Lệ'),(6,'2022-07-21 17:46:14','2022-07-21 18:06:12',5,2,5,5,'2022-07-28 17:00:00','Ô tô 16 chỗ',5,'Đi tham quan khu du lịch miền quê Fansipan','[2, 5]',50,0,'Du lịch miền núi Fansipan');
/*!40000 ALTER TABLE `tours` ENABLE KEYS */;
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
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@admin.com',NULL,'$2y$10$XrGRLn7NEk/JJQ0PsiadcOejC5mO6mBbV5oPT1AWZ8OjJPWAR9JLi',NULL,NULL,'2022-07-04 08:23:55','admin123','active','http://localhost:8000/uploads/62c3060ba73c9.jpg'),(6,'Nguyễn Quang Huy','xinchao@gmail.com',NULL,'$2y$10$Geta5OxcLfEN3O4KCNgIMuWB5B/lIXGbPzQDae1IEwA2WFUSMupRO',NULL,'2022-04-24 10:20:39','2022-07-16 21:08:12','nqhhh','active','http://localhost:8000/uploads/user/62d38b2c9bab8.png'),(8,'Chu Hiểu ','three@gmail.cm',NULL,'$2y$10$X/h2OcobkKGcOh9a3Sc4dOdl0i0WWwh2St8lbO.epGCawasGymeyu',NULL,'2022-05-03 18:43:49','2022-05-03 18:43:49','cls_130871_20183554','active',NULL),(9,'Phạm Huy Hoàng','contact@pigroupco.com',NULL,'$2y$10$1Y04DTky4F5O1javUAyhZeipwWwVvFhtrwFN6uAf7ifpBuhBOT4vC',NULL,'2022-05-03 18:44:55','2022-05-03 18:44:55','pigroupco','active',NULL),(10,'Dương Công Hậu','aa@a.c',NULL,'$2y$10$JcIoR9f9ly40OJJ/I4wr/uSREN5KkWFbabLp/VOaDUqfXmtUQty5e',NULL,'2022-05-03 18:45:41','2022-07-21 17:33:52','mmstemplate','active','http://localhost:8000/uploads/user/62d9f0706d2f3.jpg'),(20,'Dương Lê','aaaaaaa@a.a',NULL,'$2y$10$AiReXm61opyMPdvfeyn/TefHWZHkhsvA8ODX/aYd5xIgEdN8VE9Mm',NULL,'2022-05-03 19:10:51','2022-05-03 19:10:51','aaaaaaa','active',NULL),(21,'Vân Vân','test@mail',NULL,'$2y$10$y0xAcggVuLe4TS9KsFYEHeZC2rVheRm6Aa7JhKnrLOdkp5jhdTbty',NULL,'2022-06-17 11:36:26','2022-06-17 11:36:26','test12345','active',NULL),(22,'Hoàng Lẽ Phải','asdfasdf@123',NULL,'$2y$10$mkpDgR29FfNBHAn91XIPoeYYA/v1u5EpHJN0HK/ruQaX.RlkKHwMq',NULL,'2022-06-17 11:37:48','2022-06-17 11:37:48','test123456','active',NULL);
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

-- Dump completed on 2022-07-22  8:17:29
