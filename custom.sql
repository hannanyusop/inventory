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


-- Dumping structure for table inventory1.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory1.categories: ~1 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `remark`, `created_at`, `updated_at`) VALUES
	(1, 'DAPUR', 'SYSTEM SETTING', '2020-05-27 05:28:49', '2020-05-27 10:00:37'),
	(2, 'ELECTRIC', 'fsfsd', '2020-05-27 05:47:20', '2020-05-27 05:47:20');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table inventory1.ci_item
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

-- Dumping data for table inventory1.ci_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `ci_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_item` ENABLE KEYS */;

-- Dumping structure for table inventory1.customers
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

-- Dumping data for table inventory1.customers: ~2 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `email`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'test', 'nan_s96@yahoo.com', 'asdasd', 'asdasdas', '2020-05-26 15:24:25', '2020-05-26 15:30:51'),
	(2, 'cust2', 'nan_s96@yahoo.com2', 'asdasd', 'sad', '2020-05-26 15:31:36', '2020-05-26 15:31:36');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for table inventory1.customer_invoices
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

-- Dumping data for table inventory1.customer_invoices: ~2 rows (approximately)
/*!40000 ALTER TABLE `customer_invoices` DISABLE KEYS */;
INSERT INTO `customer_invoices` (`id`, `customer_id`, `date`, `invoice_no`, `price_total`, `price_net`, `remark`, `status`, `payment_type`, `created_at`, `updated_at`) VALUES
	(1, 1, '2020-05-05', '1605810493', 0.00, 0.00, 'fgjhghttp://e.test/admin/stock-transfer/add?step=2', 1, 1, '2020-05-27 14:28:24', '2020-05-27 14:28:24'),
	(2, 1, '2020-05-05', '1305737223', 20.00, 20.00, 'fgjhghttp://e.test/admin/stock-transfer/add?step=2', 1, 1, '2020-05-27 14:29:25', '2020-05-27 14:29:25');
/*!40000 ALTER TABLE `customer_invoices` ENABLE KEYS */;

-- Dumping structure for table inventory1.items
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

-- Dumping data for table inventory1.items: ~4 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `category_id`, `code`, `name`, `image_url`, `description`, `qty_left`, `qty_total`, `qty_alert`, `qty_alert_disabled`, `price_supplier`, `price_customer`, `created_at`, `updated_at`) VALUES
	(1, 1, 'test1', 'ITEM 1', 'items/VNGDT1MZLob7POgzhLAVM9Jycu08oqvbKZ8gW4VT.jpeg', 'asdasd', 0, 0, 0, 0, 20.00, 20.00, '2020-05-26 13:54:27', '2020-05-26 17:27:40'),
	(2, 2, 'test', 'PAINT 1', '', 'asdasd', 1, 2, 0, 0, 10.00, 20.00, '2020-05-26 14:35:37', '2020-05-27 14:29:25'),
	(3, 1, 'sdada', 'adasd', 'img/item-default.png', 'asdad', 3, 3, 0, 0, 21.00, 21.00, '2020-05-27 05:45:14', '2020-05-27 11:31:30'),
	(4, 2, 'dfgdfg', 'test', 'img/item-default.png', 'adasd', 1, 1, 0, 0, 20.00, 20.00, '2020-05-27 05:47:54', '2020-05-27 15:10:21'),
	(5, 2, 'RD12321', 'ROLLER', 'img/item-default.png', NULL, 0, 0, 0, 0, 6.03, 18.00, '2020-05-27 14:55:16', '2020-05-27 14:55:16');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table inventory1.si_item
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

-- Dumping data for table inventory1.si_item: ~4 rows (approximately)
/*!40000 ALTER TABLE `si_item` DISABLE KEYS */;
INSERT INTO `si_item` (`id`, `si_id`, `item_id`, `qty`, `price_adjustment`, `price`, `created_at`, `updated_at`) VALUES
	(1, 2, 2, 2, 10.00, 10.00, '2020-05-27 11:31:30', '2020-05-27 11:31:30'),
	(2, 2, 3, 3, 21.00, 21.00, '2020-05-27 11:31:30', '2020-05-27 11:31:30'),
	(3, 2, 4, 1, 20.00, 20.00, '2020-05-27 11:31:30', '2020-05-27 11:31:30'),
	(4, 1, 2, 1, 20.00, 20.00, '2020-05-27 14:28:24', '2020-05-27 14:28:24'),
	(5, 2, 2, 1, 20.00, 20.00, '2020-05-27 14:29:25', '2020-05-27 14:29:25');
/*!40000 ALTER TABLE `si_item` ENABLE KEYS */;

-- Dumping structure for table inventory1.suppliers
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

-- Dumping data for table inventory1.suppliers: ~2 rows (approximately)
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` (`id`, `name`, `email`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'test', 'nan_s96@yahoo.com', 'test', 'setrtset', '2020-05-26 15:49:34', '2020-05-26 15:49:34'),
	(2, 'supplier 2', 'safwanyusop220@gmail.com', 'asdasd', 'asda', '2020-05-27 10:17:52', '2020-05-27 10:17:52');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

-- Dumping structure for table inventory1.supplier_invoices
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

-- Dumping data for table inventory1.supplier_invoices: ~2 rows (approximately)
/*!40000 ALTER TABLE `supplier_invoices` DISABLE KEYS */;
INSERT INTO `supplier_invoices` (`id`, `supplier_id`, `invoice_no`, `date`, `price_total`, `price_net`, `remark`, `status`, `payment_type`, `created_at`, `updated_at`) VALUES
	(1, 2, '643285681', '2001-02-21', 0.00, 0.00, 'dasdasdas', 1, 1, '2020-05-27 11:30:21', '2020-05-27 11:30:21'),
	(2, 2, '1602127004', '2001-02-21', 51.00, 51.00, 'dasdasdas', 1, 1, '2020-05-27 11:31:30', '2020-05-27 11:31:30');
/*!40000 ALTER TABLE `supplier_invoices` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
