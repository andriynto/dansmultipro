-- -------------------------------------------------------------
-- TablePlus 4.6.8(425)
--
-- https://tableplus.com/
--
-- Database: dansmultipro
-- Generation Time: 2022-05-27 16:11:52.4430
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `failed_jobs`;
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

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `permission_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
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

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.jpg',
  `last_logged_in_at` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `activation_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_in` datetime DEFAULT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `suspend` tinyint(1) NOT NULL DEFAULT '1',
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'id-ID',
  `last_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_deleted_at_unique` (`email`,`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(11, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(12, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(13, '2016_06_01_000004_create_oauth_clients_table', 1),
(14, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2022_05_26_153516_create_user_table', 1),
(17, '2022_05_26_153650_create_password_resets_table', 1),
(18, '2022_05_26_165102_laratrust_setup_tables', 1),
(19, '2022_05_27_035428_create_jobs_table', 2),
(20, '2022_05_27_035504_create_failed_jobs_table', 3),
(21, '2022_05_27_044247_add_colomn_activation_code_user', 4);

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('1533021311ce1f2fe0a3b62d24493d3cb71cede83070ea72e90953253feb7846c9e7e17645591692', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 13:59:50', '2022-05-27 13:59:50', '2022-06-11 13:59:50'),
('2957558abd4451b27a28a260ce934d0eefa888e398d17ff6dcd9a9d8cecfa87dcfd9005c5c726e11', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 14:28:58', '2022-05-27 14:28:58', '2022-06-11 14:28:58'),
('3791f65a7dce775b846bea9aecd7d5a7489a45b9868dc948ec7b5715553c940ff11092c78689c5ca', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 14:04:46', '2022-05-27 14:04:46', '2022-06-11 14:04:46'),
('3e08dcc64cb01bafe4b801e33c247a2999634e07f18619e96996e682d8d874fd82940d8531f679ee', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 13:53:21', '2022-05-27 13:53:21', '2022-06-11 13:53:21'),
('4136b4bbb38b9561542765ba8df9427c586fc0827e92f93648bdd63969c8b7f397945063de858dc0', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 14:36:07', '2022-05-27 14:36:07', '2022-06-11 14:36:07'),
('46dc506c6a14a5f6166179b8bfb899590bc57d062c360c7c0cb1e873ad12e54ec0917b15e30d1288', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 14:03:00', '2022-05-27 14:03:00', '2022-06-11 14:03:00'),
('6b42ae61b3b2413ba7b7e11a6a3114bddec81c7ca8ab5e71705c36ed64c5283b98f2b3e4ec4d22a9', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 14:00:28', '2022-05-27 14:00:28', '2022-06-11 14:00:28'),
('92434dafffe5a824e10eb37e80b5ab70045879f427e997eab1c0a0a47367df82e056cef39daf6815', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 14:30:57', '2022-05-27 14:30:57', '2022-06-11 14:30:57'),
('9491c0e861f636010393fafc578fc2000d6bc321423027805a803f4b98513f5f6499a2656deb6b83', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 15:09:23', '2022-05-27 15:09:23', '2022-06-11 15:09:23'),
('d405b8c563da60b38c853bce8448383330abf44efad5c93543ad6350867ac0fb057dd6b20717369e', 1, '9665acdc-278f-4315-8349-45fd4a5a8987', NULL, '[]', 0, '2022-05-27 14:00:22', '2022-05-27 14:00:22', '2022-06-11 14:00:22');

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
('966552b2-5f79-432a-b853-7059638a1a93', NULL, 'dansmultipro Personal Access Client', '$2y$10$2UJPRfAY.QE96Jkro1rW5uqdkz4xPqOePxtNricnhLvNE6mcBiuu6', NULL, 'http://localhost', 1, 0, 0, '2022-05-27 02:40:32', '2022-05-27 02:40:32'),
('966552b2-7c39-4b4c-9295-ba960c449abb', 1, 'dansmultipro Password Grant Client', '$2y$10$TxMWmbfkm8Jwlsd4VEJKhuYf9vpDE.P7ct8kQl3AjzXuBjUJGGU/i', 'users', 'http://localhost', 0, 1, 0, '2022-05-27 02:40:32', '2022-05-27 02:40:32'),
('9665acdc-278f-4315-8349-45fd4a5a8987', NULL, 'Dansmultipro Password Client', '$2y$10$Wgg2wn3XaJ4ddbRNkg.9L.Wj9Q4lFD6JcLR7NIFpNbmXg3Fl79UVK', 'users', 'http://localhost', 0, 1, 0, '2022-05-27 13:52:39', '2022-05-27 13:52:39');

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '966552b2-5f79-432a-b853-7059638a1a93', '2022-05-27 02:40:32', '2022-05-27 02:40:32');

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('7df6fbf9cc4896adfd31d991d6337d622430dd43857a4a8056d35b5b6c57768939704148c31ddd78', '9491c0e861f636010393fafc578fc2000d6bc321423027805a803f4b98513f5f6499a2656deb6b83', 0, '2022-06-26 15:09:23'),
('7f9f3ee3d76a31807eae23d07b54285af84f64c4276bfb6c13fa94d0683d2907388323471bc1654a', '3791f65a7dce775b846bea9aecd7d5a7489a45b9868dc948ec7b5715553c940ff11092c78689c5ca', 0, '2022-06-26 14:04:46'),
('8998cb35d4aa57623406c99484cb981aba62459acb403327254c9f52e23c4a86ceed95984ecbcf9d', '4136b4bbb38b9561542765ba8df9427c586fc0827e92f93648bdd63969c8b7f397945063de858dc0', 0, '2022-06-26 14:36:07'),
('91385ca1708403e507b551deefaeca2f28982e8e0c3d613f83bb853909ec5feb32189d764eba9469', '92434dafffe5a824e10eb37e80b5ab70045879f427e997eab1c0a0a47367df82e056cef39daf6815', 0, '2022-06-26 14:30:57'),
('9c1d151e45cd53c7dc96bf69ce7ba4c33bf23e1d6d09be07ab1b4651a126822d2dce23fbe8eb567b', 'd405b8c563da60b38c853bce8448383330abf44efad5c93543ad6350867ac0fb057dd6b20717369e', 0, '2022-06-26 14:00:22'),
('a0abb548850f8318aec8f2ded3481cc1ae21f3c78536d7468684a35115b4686c5959b10c6893fb3f', '1533021311ce1f2fe0a3b62d24493d3cb71cede83070ea72e90953253feb7846c9e7e17645591692', 0, '2022-06-26 13:59:50'),
('adae4d984cddacf3993b4bd4586bb848949eceeb7599d82f4f128c2c25900843fdd32f342691d465', '2957558abd4451b27a28a260ce934d0eefa888e398d17ff6dcd9a9d8cecfa87dcfd9005c5c726e11', 0, '2022-06-26 14:28:58'),
('c9de3b77419819e9204bc10c92cc949b8d79313ad6f99d3eca62c4aff8f4dbefa068905837718333', '46dc506c6a14a5f6166179b8bfb899590bc57d062c360c7c0cb1e873ad12e54ec0917b15e30d1288', 0, '2022-06-26 14:03:00'),
('dd01f5af734d70c2f3424343a7652c82aca3915e275e7faacae8ab4c22321eb7f3c107168a16e76b', '6b42ae61b3b2413ba7b7e11a6a3114bddec81c7ca8ab5e71705c36ed64c5283b98f2b3e4ec4d22a9', 0, '2022-06-26 14:00:28'),
('e934352238b3621273e4998046877cdfb39e8e077332fb5c08db638ff100646b617b35929aeaa4c7', '3e08dcc64cb01bafe4b801e33c247a2999634e07f18619e96996e682d8d874fd82940d8531f679ee', 0, '2022-06-26 13:53:21');

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(2, 1, 'App\\Models\\User'),
(2, 2, 'App\\Models\\User');

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', 'Administrator', '2022-05-27 03:46:52', '2022-05-27 03:46:52'),
(2, 'user', 'User', 'User', '2022-05-27 03:46:52', '2022-05-27 03:46:52');

INSERT INTO `users` (`id`, `uuid`, `name`, `username`, `email`, `password`, `remember_token`, `picture`, `last_logged_in_at`, `enabled`, `activation_code`, `expired_in`, `verify`, `suspend`, `locale`, `last_session`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '5222bd1c-d966-4cfe-a6e1-3894d783702e', 'Andryanto', 'andriynto', 'andrims21@gmail.com', '$2y$10$BWMD2ofz.20lHMjKC1nYYukx4hJqbGHsR26iFmPPb9auwl5MyCgVW', NULL, 'avatar.jpg', NULL, 0, '120502', '2022-05-27 11:55:21', 1, 1, 'id-ID', NULL, '2022-05-27 04:07:58', '2022-05-27 13:11:19', NULL),
(2, 'ec971834-3971-434a-97a3-78df7800a9f4', 'Destiya Febrianti', 'dfebriantiya', 'andriynto.dev@gmail.com', '$2y$10$EBMx8.5Zupz3YI3R.3jTvuLiEL6YJrMXTwd3i/.Jb2VEcrL/MVzGS', NULL, 'avatar.jpg', NULL, 0, NULL, NULL, 0, 1, 'id-ID', NULL, '2022-05-27 04:13:13', '2022-05-27 04:13:13', NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;