/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `activations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `credits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credits_user_id_foreign` (`user_id`),
  CONSTRAINT `credits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `movement_id` bigint(20) unsigned DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  KEY `expenses_movement_id_foreign` (`movement_id`),
  CONSTRAINT `expenses_movement_id_foreign` FOREIGN KEY (`movement_id`) REFERENCES `movements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `movements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `activation_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cash` int(11) DEFAULT NULL,
  `mb` int(11) DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `t_cost` int(11) DEFAULT NULL,
  `t_profit` int(11) DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_activation_id_foreign` (`activation_id`),
  KEY `orders_product_id_foreign` (`product_id`),
  CONSTRAINT `orders_activation_id_foreign` FOREIGN KEY (`activation_id`) REFERENCES `activations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uses` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_allow` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `rate_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `min_price` int(11) DEFAULT NULL,
  `brand_id` bigint(20) unsigned NOT NULL,
  `series_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rate_lists_brand_id_foreign` (`brand_id`),
  KEY `rate_lists_series_id_foreign` (`series_id`),
  CONSTRAINT `rate_lists_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rate_lists_series_id_foreign` FOREIGN KEY (`series_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `start_cash` int(11) DEFAULT NULL,
  `cash_drawer` int(11) DEFAULT NULL,
  `cash_withdraw` int(11) DEFAULT NULL,
  `cash` int(11) DEFAULT NULL,
  `mb` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL,
  `expense` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_user_id_foreign` (`user_id`),
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `team_invites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `type` enum('invite','request') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accept_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deny_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_invites_team_id_foreign` (`team_id`),
  CONSTRAINT `team_invites_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `team_user` (
  `user_id` bigint(20) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `team_user_user_id_foreign` (`user_id`),
  KEY `team_user_team_id_foreign` (`team_id`),
  CONSTRAINT `team_user_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `team_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_i_f` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imei_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repair` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observ_of_damag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `technician` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double(20,2) DEFAULT NULL,
  `received` double(20,2) DEFAULT NULL,
  `balance` double(20,2) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliver_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_user_id_foreign` (`user_id`),
  CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pt',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `withdraws` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `manager_id` bigint(20) unsigned NOT NULL,
  `due` int(11) DEFAULT NULL,
  `withdraw` int(11) DEFAULT NULL,
  `left` int(11) DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdraws_user_id_foreign` (`user_id`),
  KEY `withdraws_manager_id_foreign` (`manager_id`),
  CONSTRAINT `withdraws_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `withdraws_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'TEL. VODA.', '2022-05-05 07:55:10', '2022-05-05 07:55:10');
INSERT INTO `activations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'TEL. TMN', '2022-05-05 07:55:10', '2022-05-05 07:55:10');
INSERT INTO `activations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'TEL. OPT', '2022-05-05 07:55:10', '2022-05-05 07:55:10');
INSERT INTO `activations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'CARD VODA', '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(5, 'CARD TMN', '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(6, 'CARD OPT', '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(7, 'UPG. VODA', '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(8, 'UPG. TMN', '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(9, 'UPG. OPT', '2022-05-05 07:55:10', '2022-05-05 07:55:10');









INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_25_180102_create_products_table', 1),
(6, '2022_02_25_180143_create_activations_table', 1),
(7, '2022_02_25_222808_create_movements_table', 1),
(8, '2022_02_25_223002_create_orders_table', 1),
(9, '2022_02_25_223105_create_expenses_table', 1),
(10, '2022_02_25_233244_create_sales_table', 1),
(11, '2022_03_06_234623_create_categories_table', 1),
(12, '2022_03_10_191249_create_rate_lists_table', 1),
(13, '2022_03_16_223602_create_withdraws_table', 1),
(14, '2022_03_20_175137_create_tickets_table', 1),
(15, '2022_03_22_112322_add_ticket_columns_to_users_table', 1),
(16, '2022_04_18_083946_teamwork_setup_tables', 1),
(17, '2022_04_18_174049_create_permission_tables', 1),
(18, '2022_05_02_121049_create_credits_table', 1);



INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);


INSERT INTO `movements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SALARIES', '2022-05-05 07:55:10', '2022-05-05 07:55:10');
INSERT INTO `movements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'RENT', '2022-05-05 07:55:10', '2022-05-05 07:55:10');
INSERT INTO `movements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'SEG. SOCIAL / ACOUNTANT', '2022-05-05 07:55:10', '2022-05-05 07:55:10');
INSERT INTO `movements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'BILLS', '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(5, 'TRANSPORT/ FUEL/ TICKETS', '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(6, 'LUNCH/DRINKS', '2022-05-05 07:55:11', '2022-05-05 07:55:11'),
(7, 'BOX/CABLES/LOGS', '2022-05-05 07:55:11', '2022-05-05 07:55:11'),
(8, 'PRINTING MATERIAL', '2022-05-05 07:55:11', '2022-05-05 07:55:11'),
(9, 'VINOD / FAISAL / NIKKA', '2022-05-05 07:55:11', '2022-05-05 07:55:11'),
(10, 'BANK DEPOSIT', '2022-05-05 07:55:11', '2022-05-05 07:55:11'),
(11, 'OTHERS', '2022-05-05 07:55:11', '2022-05-05 07:55:11');





INSERT INTO `permissions` (`id`, `name`, `guard_name`, `uses`, `is_default`, `is_allow`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'web', 'dashboard', 0, 1, '2022-05-05 07:55:06', '2022-05-05 07:55:06');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `uses`, `is_default`, `is_allow`, `created_at`, `updated_at`) VALUES
(2, 'pos.dropdown', 'web', 'pos', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `uses`, `is_default`, `is_allow`, `created_at`, `updated_at`) VALUES
(3, 'activations.store', 'web', 'activations', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07');
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `uses`, `is_default`, `is_allow`, `created_at`, `updated_at`) VALUES
(4, 'products.store', 'web', 'products', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(5, 'movements.store', 'web', 'movements', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(6, 'ratelist.import', 'web', 'ratelist', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(7, 'ratelist.store', 'web', 'ratelist', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(8, 'ratelist.destroy', 'web', 'ratelist', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(9, 'ratelist.index', 'web', 'ratelist', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(10, 'tickets.history', 'web', 'tickets', 0, 1, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(11, 'roles.index', 'web', 'roles', 0, 0, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(12, 'roles.store', 'web', 'roles', 0, 0, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(13, 'roles.show', 'web', 'roles', 0, 0, '2022-05-05 07:55:07', '2022-05-05 07:55:07'),
(14, 'roles.update', 'web', 'roles', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(15, 'roles.destroy', 'web', 'roles', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(16, 'teams.index', 'web', 'teams', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(17, 'teams.store', 'web', 'teams', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(18, 'teams.show', 'web', 'teams', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(19, 'teams.update', 'web', 'teams', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(20, 'teams.destroy', 'web', 'teams', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(21, 'permissions.index', 'web', 'permissions', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(22, 'permissions.store', 'web', 'permissions', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(23, 'permissions.show', 'web', 'permissions', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(24, 'permissions.update', 'web', 'permissions', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(25, 'permissions.destroy', 'web', 'permissions', 0, 0, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(26, 'categories.import', 'web', 'categories', 0, 1, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(27, 'categories.store', 'web', 'categories', 0, 1, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(28, 'categories.destroy', 'web', 'categories', 0, 1, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(29, 'tickets.index', 'web', 'tickets', 0, 1, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(30, 'tickets.store', 'web', 'tickets', 0, 1, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(31, 'tickets.show', 'web', 'tickets', 0, 1, '2022-05-05 07:55:08', '2022-05-05 07:55:08'),
(32, 'tickets.destroy', 'web', 'tickets', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(33, 'orders.index', 'web', 'orders', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(34, 'orders.store', 'web', 'orders', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(35, 'orders.update', 'web', 'orders', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(36, 'orders.destroy', 'web', 'orders', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(37, 'users.index', 'web', 'users', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(38, 'users.store', 'web', 'users', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(39, 'users.update', 'web', 'users', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(40, 'withdraws.store', 'web', 'withdraws', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(41, 'withdraws.destroy', 'web', 'withdraws', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(42, 'expenses.store', 'web', 'expenses', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(43, 'expenses.update', 'web', 'expenses', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(44, 'expenses.destroy', 'web', 'expenses', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(45, 'credits.store', 'web', 'credits', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(46, 'credits.update', 'web', 'credits', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(47, 'credits.destroy', 'web', 'credits', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(48, 'sales.index', 'web', 'sales', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(49, 'return.store', 'web', 'return', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(50, 'return.details', 'web', 'return', 0, 1, '2022-05-05 07:55:09', '2022-05-05 07:55:09'),
(51, 'return.update', 'web', 'return', 0, 1, '2022-05-05 07:55:10', '2022-05-05 07:55:10'),
(52, 'logout', 'web', 'logout', 1, 1, '2022-05-05 07:55:10', '2022-05-05 07:55:10');



INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'TELEMÓVEL', '2022-05-05 07:55:11', '2022-05-05 07:55:11');
INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'REPAIR', '2022-05-05 07:55:11', '2022-05-05 07:55:11');
INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'SOFTWARE', '2022-05-05 07:55:11', '2022-05-05 07:55:11');
INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'ACCESSORIOS', '2022-05-05 07:55:11', '2022-05-05 07:55:11'),
(5, 'CARD', '2022-05-05 07:55:11', '2022-05-05 07:55:11'),
(6, 'OTHER', '2022-05-05 07:55:11', '2022-05-05 07:55:11');



INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1);
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(3, 1);
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1);

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2022-05-05 07:55:12', '2022-05-05 07:55:12');












INSERT INTO `users` (`id`, `name`, `username`, `lang`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `contact`, `store_id`, `store_name`, `store_logo`, `store_barcode`, `store_address`, `current_team_id`) VALUES
(1, 'Admin', 'admin', 'en', 'admin@gmail.com', NULL, '$2y$10$LRUT9bci9Aral/hnDMSE.ee1G6FXpAc6/Ur0zHWAtUD9ue0EVp5mS', 1, NULL, '2022-05-05 07:55:12', '2022-05-05 07:55:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL);





/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;