-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for inventory
CREATE DATABASE IF NOT EXISTS `inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventory`;

-- Dumping structure for table inventory.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `remark`, `created_at`, `updated_at`) VALUES
	(1, 'DAPUR', 'SYSTEM SETTING', '2020-05-27 05:28:49', '2020-05-27 10:00:37'),
	(2, 'ELECTRIC', 'fsfsd', '2020-05-27 05:47:20', '2020-05-27 05:47:20');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table inventory.ci_item
CREATE TABLE IF NOT EXISTS `ci_item` (
  `id` int(11) NOT NULL,
  `ci_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `price_adjustment` float(10,2) DEFAULT '0.00',
  `price` float(10,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.ci_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `ci_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_item` ENABLE KEYS */;

-- Dumping structure for table inventory.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.customers: ~2 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `email`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'test', 'nan_s96@yahoo.com', 'asdasd', 'asdasdas', '2020-05-26 15:24:25', '2020-05-26 15:30:51'),
	(2, 'cust2', 'nan_s96@yahoo.com2', 'asdasd', 'sad', '2020-05-26 15:31:36', '2020-05-26 15:31:36');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for table inventory.customer_invoices
CREATE TABLE IF NOT EXISTS `customer_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `price_total` float(10,2) NOT NULL DEFAULT '0.00',
  `price_net` float(10,2) NOT NULL DEFAULT '0.00',
  `remark` varchar(50) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `payment_type` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_no` (`invoice_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table inventory.customer_invoices: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer_invoices` DISABLE KEYS */;
INSERT INTO `customer_invoices` (`id`, `customer_id`, `date`, `invoice_no`, `price_total`, `price_net`, `remark`, `status`, `payment_type`, `created_at`, `updated_at`) VALUES
	(1, 1, '2020-05-05', '1605810493', 0.00, 0.00, 'fgjhghttp://e.test/admin/stock-transfer/add?step=2', 1, 1, '2020-05-27 14:28:24', '2020-05-27 14:28:24'),
	(2, 1, '2020-05-05', '1305737223', 20.00, 20.00, 'fgjhghttp://e.test/admin/stock-transfer/add?step=2', 1, 1, '2020-05-27 14:29:25', '2020-05-27 14:29:25');
/*!40000 ALTER TABLE `customer_invoices` ENABLE KEYS */;

-- Dumping structure for table inventory.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '1',
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `image_url` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `qty_left` int(11) NOT NULL DEFAULT '0',
  `qty_total` int(11) NOT NULL DEFAULT '0',
  `qty_alert` int(11) NOT NULL DEFAULT '0',
  `qty_alert_disabled` int(11) NOT NULL DEFAULT '0',
  `price_supplier` float(10,2) NOT NULL DEFAULT '0.00',
  `price_customer` float(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.items: ~5 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `category_id`, `code`, `name`, `image_url`, `description`, `qty_left`, `qty_total`, `qty_alert`, `qty_alert_disabled`, `price_supplier`, `price_customer`, `created_at`, `updated_at`) VALUES
	(1, 1, 'test1', 'ITEM 1', 'items/VNGDT1MZLob7POgzhLAVM9Jycu08oqvbKZ8gW4VT.jpeg', 'asdasd', 0, 0, 0, 0, 20.00, 20.00, '2020-05-26 13:54:27', '2020-05-26 17:27:40'),
	(2, 2, 'test', 'PAINT 1', '', 'asdasd', 1, 2, 0, 0, 10.00, 20.00, '2020-05-26 14:35:37', '2020-05-27 14:29:25'),
	(3, 1, 'sdada', 'adasd', 'img/item-default.png', 'asdad', 3, 3, 0, 0, 21.00, 21.00, '2020-05-27 05:45:14', '2020-05-27 11:31:30'),
	(4, 2, 'dfgdfg', 'test', 'img/item-default.png', 'adasd', 1, 1, 0, 0, 20.00, 20.00, '2020-05-27 05:47:54', '2020-05-27 15:10:21'),
	(5, 2, 'RD12321', 'ROLLER', 'img/item-default.png', NULL, 0, 0, 0, 0, 6.03, 18.00, '2020-05-27 14:55:16', '2020-05-27 14:55:16');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table inventory.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.migrations: ~10 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2017_09_03_144628_create_permission_tables', 1),
	(4, '2017_09_11_174816_create_social_accounts_table', 1),
	(5, '2017_09_26_140332_create_cache_table', 1),
	(6, '2017_09_26_140528_create_sessions_table', 1),
	(7, '2017_09_26_140609_create_jobs_table', 1),
	(8, '2018_04_08_033256_create_password_histories_table', 1),
	(9, '2018_11_21_000001_create_ledgers_table', 1),
	(10, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table inventory.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table inventory.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.model_has_roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\Auth\\User', 1),
	(2, 'App\\Models\\Auth\\User', 2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table inventory.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table inventory.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.permissions: ~1 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view backend', 'web', '2020-05-26 04:28:51', '2020-05-26 04:28:51');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table inventory.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'web', '2020-05-26 04:28:51', '2020-05-26 04:28:51'),
	(2, 'user', 'web', '2020-05-26 04:28:51', '2020-05-26 04:28:51');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table inventory.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.role_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table inventory.si_item
CREATE TABLE IF NOT EXISTS `si_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `si_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '0',
  `price_adjustment` float(10,2) DEFAULT '0.00',
  `price` float(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table inventory.si_item: ~5 rows (approximately)
/*!40000 ALTER TABLE `si_item` DISABLE KEYS */;
INSERT INTO `si_item` (`id`, `si_id`, `item_id`, `qty`, `price_adjustment`, `price`, `created_at`, `updated_at`) VALUES
	(1, 2, 2, 2, 10.00, 10.00, '2020-05-27 11:31:30', '2020-05-27 11:31:30'),
	(2, 2, 3, 3, 21.00, 21.00, '2020-05-27 11:31:30', '2020-05-27 11:31:30'),
	(3, 2, 4, 1, 20.00, 20.00, '2020-05-27 11:31:30', '2020-05-27 11:31:30'),
	(4, 1, 2, 1, 20.00, 20.00, '2020-05-27 14:28:24', '2020-05-27 14:28:24'),
	(5, 2, 2, 1, 20.00, 20.00, '2020-05-27 14:29:25', '2020-05-27 14:29:25');
/*!40000 ALTER TABLE `si_item` ENABLE KEYS */;

-- Dumping structure for table inventory.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.suppliers: ~2 rows (approximately)
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` (`id`, `name`, `email`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'test', 'nan_s96@yahoo.com', 'test', 'setrtset', '2020-05-26 15:49:34', '2020-05-26 15:49:34'),
	(2, 'supplier 2', 'safwanyusop220@gmail.com', 'asdasd', 'asda', '2020-05-27 10:17:52', '2020-05-27 10:17:52');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

-- Dumping structure for table inventory.supplier_invoices
CREATE TABLE IF NOT EXISTS `supplier_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `invoice_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price_total` float(10,2) NOT NULL DEFAULT '0.00',
  `price_net` float(10,2) NOT NULL DEFAULT '0.00',
  `remark` varchar(50) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `payment_type` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_no` (`invoice_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.supplier_invoices: ~2 rows (approximately)
/*!40000 ALTER TABLE `supplier_invoices` DISABLE KEYS */;
INSERT INTO `supplier_invoices` (`id`, `supplier_id`, `invoice_no`, `date`, `price_total`, `price_net`, `remark`, `status`, `payment_type`, `created_at`, `updated_at`) VALUES
	(1, 2, '643285681', '2001-02-21', 0.00, 0.00, 'dasdasdas', 1, 1, '2020-05-27 11:30:21', '2020-05-27 11:30:21'),
	(2, 2, '1602127004', '2001-02-21', 51.00, 51.00, 'dasdasdas', 1, 1, '2020-05-27 11:31:30', '2020-05-27 11:31:30');
/*!40000 ALTER TABLE `supplier_invoices` ENABLE KEYS */;

-- Dumping structure for table inventory.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gravatar',
  `avatar_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_changed_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `confirmation_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_be_logged_out` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventory.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `uuid`, `first_name`, `last_name`, `email`, `avatar_type`, `avatar_location`, `password`, `password_changed_at`, `active`, `confirmation_code`, `confirmed`, `timezone`, `last_login_at`, `last_login_ip`, `to_be_logged_out`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '6ca218cb-acbe-4414-8bee-7f9a04a33faf', 'Super', 'Admin', 'admin@admin.com', 'gravatar', NULL, '$2y$10$FXlyoMDiwgGQ2Wuq2hIgvuajF0VeUYUjL.SjS8FRJ24eMAU7/23Aa', NULL, 1, 'c47335ff133fe4bd51f6adc2abbb3c1c', 1, 'America/New_York', '2020-05-27 16:07:27', '127.0.0.1', 0, '1PajLOb8UYIkzhnrZoEdP4qYSkrbAjrSZ7liUWYmZHvJjF0fFlYrrnQYM1hM', '2020-05-26 04:28:51', '2020-05-27 16:07:27', NULL),
	(2, '6d355425-664a-492f-889b-4fef2d15a267', 'Default', 'User', 'user@user.com', 'gravatar', NULL, '$2y$10$ZGDN5sIzsGiKtF5i6A/uTeL2Q9qZ9pTOfS0PoskDpqIZDEw4U2hPu', NULL, 1, '82b07526eafba2ca2cdcea40a11b2187', 1, NULL, NULL, NULL, 0, NULL, '2020-05-26 04:28:51', '2020-05-26 04:28:51', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
