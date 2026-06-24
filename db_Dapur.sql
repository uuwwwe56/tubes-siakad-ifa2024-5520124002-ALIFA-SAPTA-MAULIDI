-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dapuribu
CREATE DATABASE IF NOT EXISTS `dapuribu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dapuribu`;

-- Dumping structure for table dapuribu.alamat_user
DROP TABLE IF EXISTS `alamat_user`;
CREATE TABLE IF NOT EXISTS `alamat_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alamat_user_user_id_foreign` (`user_id`),
  CONSTRAINT `alamat_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.alamat_user: ~1 rows (approximately)
INSERT IGNORE INTO `alamat_user` (`id`, `user_id`, `nama_penerima`, `no_hp`, `alamat`, `kota`, `kode_pos`, `is_default`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Alif Sapta', '0826192731', 'Desa Pamoyanan,RT01/RW17 Kecamatan Cianjur', 'Cianjur', '43211', 1, '2026-06-21 14:29:53', '2026-06-21 14:29:53');

-- Dumping structure for table dapuribu.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.cache: ~0 rows (approximately)

-- Dumping structure for table dapuribu.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.cache_locks: ~0 rows (approximately)

-- Dumping structure for table dapuribu.carts
DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `qty` int unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carts_user_id_produk_id_unique` (`user_id`,`produk_id`),
  KEY `carts_produk_id_foreign` (`produk_id`),
  CONSTRAINT `carts_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.carts: ~0 rows (approximately)

-- Dumping structure for table dapuribu.chats
DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chats_sender_id_foreign` (`sender_id`),
  KEY `chats_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `chats_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.chats: ~0 rows (approximately)

-- Dumping structure for table dapuribu.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Dumping data for table dapuribu.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table dapuribu.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.jobs: ~0 rows (approximately)

-- Dumping structure for table dapuribu.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Dumping data for table dapuribu.job_batches: ~0 rows (approximately)

-- Dumping structure for table dapuribu.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.kategori: ~4 rows (approximately)
INSERT IGNORE INTO `kategori` (`id`, `nama`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Makanan Berat', 'makanan-berat', '2026-06-18 15:07:16', '2026-06-18 15:07:16'),
	(2, 'Cemilan', 'cemilan', '2026-06-18 15:07:16', '2026-06-18 15:07:16'),
	(3, 'Dessert', 'dessert', '2026-06-18 15:07:16', '2026-06-18 15:07:16'),
	(4, 'Minuman', 'minuman', '2026-06-18 15:07:16', '2026-06-18 15:07:16');

-- Dumping structure for table dapuribu.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.migrations: ~22 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_03_20_010528_create_verifications', 1),
	(5, '2026_03_26_030000_create_alamat_user_table', 1),
	(6, '2026_03_26_034243_create_kategori_table', 1),
	(7, '2026_03_26_034320_create_produk_table', 1),
	(8, '2026_03_26_034439_create_carts_table', 1),
	(9, '2026_03_26_034530_create_order_table', 1),
	(10, '2026_03_26_034531_create_order_detail_table', 1),
	(11, '2026_03_26_034532_create_pengiriman_table', 1),
	(12, '2026_03_26_034556_create_testimoni_table', 1),
	(13, '2026_03_26_041213_create_produk_gambar_table', 1),
	(14, '2026_03_26_041342_create_pembayaran_table', 1),
	(15, '2026_03_26_041554_create_tracking_pengiriman_table', 1),
	(16, '2026_04_10_044842_create_settings_table', 1),
	(17, '2026_05_11_140427_create_notifications_table', 1),
	(18, '2026_05_11_210736_add_profile_fields_to_users_table', 1),
	(19, '2026_05_12_062732_create_chats_table', 1),
	(20, '2026_05_12_202731_add_rating_to_orders_table', 1),
	(21, '2026_06_18_205240_modify_bukti_nullable_on_pembayaran_table', 1),
	(22, '2026_06_21_222029_add_discount_to_orders_table', 2);

-- Dumping structure for table dapuribu.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.notifications: ~9 rows (approximately)
INSERT IGNORE INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `is_read`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Pesanan Baru Berhasil Dibuat', 'Pesanan #INV-1782052250-3 dengan 3 produk telah berhasil dibuat. Total Rp 65.100', 'order', 0, '2026-06-21 14:30:50', '2026-06-21 14:30:50'),
	(2, 3, 'Status Pesanan Diperbarui', 'Pesanan #INV-1782052250-3 berubah dari Menunggu menjadi Selesai', 'order', 0, '2026-06-21 14:31:14', '2026-06-21 14:31:14'),
	(3, 3, 'Status Pesanan Diperbarui', 'Pesanan #INV-1782052250-3 berubah dari Selesai menjadi Menunggu', 'order', 0, '2026-06-21 14:42:16', '2026-06-21 14:42:16'),
	(4, 3, 'Status Pesanan Diperbarui', 'Pesanan #INV-1782052250-3 berubah dari Menunggu menjadi Selesai', 'order', 0, '2026-06-21 14:42:22', '2026-06-21 14:42:22'),
	(5, 3, 'Pesanan Baru Berhasil Dibuat', 'Pesanan #INV-1782055439-3 dengan 1 produk telah berhasil dibuat. Total Rp 70.000', 'order', 0, '2026-06-21 15:23:59', '2026-06-21 15:23:59'),
	(6, 3, 'Pesanan Baru Berhasil Dibuat', 'Pesanan #INV-1782055955-3 dengan 1 produk telah berhasil dibuat. Total Rp 76.000', 'order', 0, '2026-06-21 15:32:35', '2026-06-21 15:32:35'),
	(7, 3, 'Pesanan Baru Berhasil Dibuat', 'Pesanan #INV-1782056159-3 dengan 2 produk telah berhasil dibuat. Total Rp 69.850', 'order', 0, '2026-06-21 15:35:59', '2026-06-21 15:35:59'),
	(8, 3, 'Status Pesanan Diperbarui', 'Pesanan #INV-1782056159-3 berubah dari Selesai menjadi Selesai', 'order', 0, '2026-06-21 15:47:18', '2026-06-21 15:47:18'),
	(9, 3, 'Pesanan Baru Berhasil Dibuat', 'Pesanan #INV-1782096916-3 dengan 1 produk telah berhasil dibuat. Total Rp 78.400', 'order', 1, '2026-06-22 02:55:16', '2026-06-22 02:56:26');

-- Dumping structure for table dapuribu.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `alamat_id` bigint unsigned DEFAULT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `discount` int NOT NULL DEFAULT '0',
  `shipping_fee` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(12,2) NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `status` enum('pending','processing','shipped','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `cancel_requested` tinyint(1) NOT NULL DEFAULT '0',
  `cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `cancel_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Transfer Bank',
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_invoice_number_unique` (`invoice_number`),
  KEY `orders_alamat_id_foreign` (`alamat_id`),
  KEY `orders_user_id_status_index` (`user_id`,`status`),
  CONSTRAINT `orders_alamat_id_foreign` FOREIGN KEY (`alamat_id`) REFERENCES `alamat_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.orders: ~5 rows (approximately)
INSERT IGNORE INTO `orders` (`id`, `user_id`, `alamat_id`, `invoice_number`, `subtotal`, `discount`, `shipping_fee`, `total_price`, `rating`, `status`, `cancel_requested`, `cancel_reason`, `cancel_by`, `payment_method`, `payment_proof`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 'INV-1782052250-3', 58000.00, 0, 10000.00, 65100.00, NULL, 'completed', 0, NULL, NULL, 'cod', NULL, '2026-06-21 14:30:50', '2026-06-21 14:42:22'),
	(2, 3, 1, 'INV-1782055439-3', 60000.00, 0, 10000.00, 70000.00, NULL, 'pending', 0, NULL, NULL, 'cod', NULL, '2026-06-21 15:23:59', '2026-06-21 15:23:59'),
	(3, 3, 1, 'INV-1782055955-3', 66000.00, 0, 10000.00, 76000.00, NULL, 'cancelled', 0, 'Ingin mengubah pesanan', 'user', 'cod', NULL, '2026-06-21 15:32:35', '2026-06-21 15:32:49'),
	(4, 3, 1, 'INV-1782056159-3', 63000.00, 0, 10000.00, 69850.00, NULL, 'completed', 0, NULL, NULL, 'cod', NULL, '2026-06-21 15:35:59', '2026-06-21 15:45:51'),
	(5, 3, 1, 'INV-1782096916-3', 72000.00, 0, 10000.00, 78400.00, NULL, 'pending', 0, NULL, NULL, 'cod', NULL, '2026-06-22 02:55:16', '2026-06-22 02:55:16');

-- Dumping structure for table dapuribu.order_detail
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price_at_purchase` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_detail_order_id_foreign` (`order_id`),
  KEY `order_detail_product_id_foreign` (`product_id`),
  CONSTRAINT `order_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.order_detail: ~8 rows (approximately)
INSERT IGNORE INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price_at_purchase`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 25000.00, '2026-06-21 14:30:50', '2026-06-21 14:30:50'),
	(2, 1, 9, 1, 15000.00, '2026-06-21 14:30:50', '2026-06-21 14:30:50'),
	(3, 1, 23, 1, 18000.00, '2026-06-21 14:30:50', '2026-06-21 14:30:50'),
	(4, 2, 24, 4, 15000.00, '2026-06-21 15:23:59', '2026-06-21 15:23:59'),
	(5, 3, 2, 3, 22000.00, '2026-06-21 15:32:35', '2026-06-21 15:32:35'),
	(6, 4, 3, 2, 24000.00, '2026-06-21 15:35:59', '2026-06-21 15:35:59'),
	(7, 4, 25, 1, 15000.00, '2026-06-21 15:35:59', '2026-06-21 15:35:59'),
	(8, 5, 3, 3, 24000.00, '2026-06-22 02:55:16', '2026-06-22 02:55:16');

-- Dumping structure for table dapuribu.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table dapuribu.pembayaran
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_order_id_foreign` (`order_id`),
  CONSTRAINT `pembayaran_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.pembayaran: ~5 rows (approximately)
INSERT IGNORE INTO `pembayaran` (`id`, `order_id`, `metode`, `status`, `bukti`, `created_at`, `updated_at`) VALUES
	(1, 1, 'cod', 'paid', NULL, '2026-06-21 14:30:50', '2026-06-21 14:42:22'),
	(2, 2, 'cod', 'pending', NULL, '2026-06-21 15:23:59', '2026-06-21 15:23:59'),
	(3, 3, 'cod', 'failed', NULL, '2026-06-21 15:32:35', '2026-06-21 15:32:49'),
	(4, 4, 'cod', 'paid', NULL, '2026-06-21 15:35:59', '2026-06-21 15:47:18'),
	(5, 5, 'cod', 'pending', NULL, '2026-06-22 02:55:16', '2026-06-22 02:55:16');

-- Dumping structure for table dapuribu.pengiriman
DROP TABLE IF EXISTS `pengiriman`;
CREATE TABLE IF NOT EXISTS `pengiriman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `kurir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_resi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_kirim` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pengiriman` enum('diproses','dikirim','selesai','gagal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diproses',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengiriman_order_id_foreign` (`order_id`),
  CONSTRAINT `pengiriman_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.pengiriman: ~0 rows (approximately)

-- Dumping structure for table dapuribu.produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `kategori_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_kategori_id_foreign` (`kategori_id`),
  CONSTRAINT `produk_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.produk: ~29 rows (approximately)
INSERT IGNORE INTO `produk` (`id`, `nama`, `deskripsi`, `harga`, `stok`, `kategori_id`, `created_at`, `updated_at`) VALUES
	(1, 'Nasi Goreng Kampung Spesial', 'Nasi goreng khas rumahan dengan bumbu tradisional.', 25000, 100, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(2, 'Ayam Geprek Sambal Bawang', 'Ayam crispy dengan sambal bawang pedas.', 22000, 100, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(3, 'Ayam Penyet Sambal Terasi', 'Ayam goreng empuk dengan sambal terasi.', 24000, 100, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(4, 'Beef Teriyaki Rice Bowl', 'Rice bowl daging sapi saus teriyaki.', 35000, 80, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(5, 'Nasi Liwet Komplit', 'Nasi liwet gurih dengan lauk lengkap.', 28000, 80, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(6, 'Nasi Ayam Bakar', 'Ayam bakar bumbu rempah khas.', 30000, 80, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(7, 'Mie Goreng Jawa', 'Mie goreng tradisional bercita rasa manis gurih.', 23000, 90, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(8, 'Soto Ayam Lamongan', 'Soto ayam hangat dengan kuah gurih.', 25000, 90, 1, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(9, 'Kentang Goreng', 'Kentang renyah dan gurih.', 15000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(10, 'Tahu Crispy', 'Tahu goreng krispi.', 12000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(11, 'Tempe Mendoan', 'Tempe tipis goreng lembut.', 12000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(12, 'Cireng Isi', 'Cireng isi ayam pedas.', 15000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(13, 'Pisang Goreng', 'Pisang goreng renyah.', 12000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(14, 'Dimsum Ayam', 'Dimsum ayam lembut.', 18000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(15, 'Bakso Goreng', 'Bakso goreng gurih.', 15000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(16, 'Singkong Keju', 'Singkong goreng dengan taburan keju.', 15000, 100, 2, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(17, 'Dessert Box Coklat Lumer', 'Dessert box coklat premium.', 22000, 50, 3, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(18, 'Dessert Box Tiramisu', 'Dessert tiramisu lembut.', 22000, 50, 3, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(19, 'Puding Coklat Vla', 'Puding coklat dengan vla.', 12000, 50, 3, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(21, 'Cheese Cake Mini', 'Cake keju ukuran mini.', 18000, 50, 3, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(22, 'Brownies Kukus', 'Brownies coklat lembut.', 18000, 50, 3, '2026-06-18 15:46:12', '2026-06-18 16:01:23'),
	(23, 'Matcha Latte', 'Minuman matcha creamy.', 18000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(24, 'Jus Mangga', 'Jus mangga segar.', 15000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(25, 'Es Coklat', 'Minuman coklat dingin.', 15000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(26, 'Thai Tea', 'Thai tea creamy khas.', 15000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(27, 'Jus Alpukat', 'Jus alpukat creamy dan segar.', 18000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(28, 'Lemon Tea', 'Teh lemon menyegarkan.', 12000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(29, 'Es Kopi Susu', 'Kopi susu kekinian.', 18000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12'),
	(30, 'Straberry Milk', 'Latte red velvet lembut.', 20000, 100, 4, '2026-06-18 15:46:12', '2026-06-18 15:46:12');

-- Dumping structure for table dapuribu.produk_gambar
DROP TABLE IF EXISTS `produk_gambar`;
CREATE TABLE IF NOT EXISTS `produk_gambar` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `produk_id` bigint unsigned NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_gambar_produk_id_foreign` (`produk_id`),
  CONSTRAINT `produk_gambar_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.produk_gambar: ~82 rows (approximately)
INSERT IGNORE INTO `produk_gambar` (`id`, `produk_id`, `gambar`, `created_at`, `updated_at`) VALUES
	(4, 1, 'produk/1781797849_Nasgor1.png', '2026-06-18 15:50:49', '2026-06-18 15:50:49'),
	(5, 1, 'produk/1781797849_Nasgor2.png', '2026-06-18 15:50:49', '2026-06-18 15:50:49'),
	(6, 1, 'produk/1781797849_Nasgor3.png', '2026-06-18 15:50:49', '2026-06-18 15:50:49'),
	(7, 2, 'produk/1781797998_geprek3.png', '2026-06-18 15:53:18', '2026-06-18 15:53:18'),
	(8, 2, 'produk/1781797998_geprek2.png', '2026-06-18 15:53:18', '2026-06-18 15:53:18'),
	(9, 2, 'produk/1781797998_geprek1.png', '2026-06-18 15:53:18', '2026-06-18 15:53:18'),
	(10, 3, 'produk/1781798018_penyet3.png', '2026-06-18 15:53:38', '2026-06-18 15:53:38'),
	(11, 3, 'produk/1781798018_penyet2.png', '2026-06-18 15:53:38', '2026-06-18 15:53:38'),
	(12, 3, 'produk/1781798018_penyet1.png', '2026-06-18 15:53:38', '2026-06-18 15:53:38'),
	(13, 4, 'produk/1781798035_beeft3.png', '2026-06-18 15:53:55', '2026-06-18 15:53:55'),
	(14, 4, 'produk/1781798035_beeft2.png', '2026-06-18 15:53:55', '2026-06-18 15:53:55'),
	(15, 4, 'produk/1781798035_beeft1.png', '2026-06-18 15:53:55', '2026-06-18 15:53:55'),
	(16, 5, 'produk/1781798055_liwet3.png', '2026-06-18 15:54:15', '2026-06-18 15:54:15'),
	(17, 5, 'produk/1781798055_liwet1.png', '2026-06-18 15:54:15', '2026-06-18 15:54:15'),
	(18, 5, 'produk/1781798055_liwet2.png', '2026-06-18 15:54:15', '2026-06-18 15:54:15'),
	(19, 6, 'produk/1781798070_ayambakar2.png', '2026-06-18 15:54:30', '2026-06-18 15:54:30'),
	(20, 6, 'produk/1781798070_ayambakar1.png', '2026-06-18 15:54:30', '2026-06-18 15:54:30'),
	(21, 7, 'produk/1781798092_miejawa1.png', '2026-06-18 15:54:52', '2026-06-18 15:54:52'),
	(22, 7, 'produk/1781798092_miejawa2.png', '2026-06-18 15:54:52', '2026-06-18 15:54:52'),
	(23, 7, 'produk/1781798092_miejawa3.png', '2026-06-18 15:54:52', '2026-06-18 15:54:52'),
	(24, 8, 'produk/1781798111_soto2.png', '2026-06-18 15:55:11', '2026-06-18 15:55:11'),
	(25, 8, 'produk/1781798111_soto1.png', '2026-06-18 15:55:11', '2026-06-18 15:55:11'),
	(26, 9, 'produk/1781798130_kentang3.png', '2026-06-18 15:55:30', '2026-06-18 15:55:30'),
	(27, 9, 'produk/1781798131_kentang2.png', '2026-06-18 15:55:31', '2026-06-18 15:55:31'),
	(28, 9, 'produk/1781798131_kentang1.png', '2026-06-18 15:55:31', '2026-06-18 15:55:31'),
	(29, 10, 'produk/1781798147_tahu3.png', '2026-06-18 15:55:47', '2026-06-18 15:55:47'),
	(30, 10, 'produk/1781798147_tahu2.png', '2026-06-18 15:55:47', '2026-06-18 15:55:47'),
	(31, 10, 'produk/1781798147_tahu1.png', '2026-06-18 15:55:47', '2026-06-18 15:55:47'),
	(32, 11, 'produk/1781798299_tempe1.png', '2026-06-18 15:58:19', '2026-06-18 15:58:19'),
	(33, 11, 'produk/1781798299_tempe2.png', '2026-06-18 15:58:19', '2026-06-18 15:58:19'),
	(34, 11, 'produk/1781798299_tempe3.png', '2026-06-18 15:58:19', '2026-06-18 15:58:19'),
	(35, 12, 'produk/1781798315_cireng3.png', '2026-06-18 15:58:35', '2026-06-18 15:58:35'),
	(36, 12, 'produk/1781798315_cireng2.png', '2026-06-18 15:58:35', '2026-06-18 15:58:35'),
	(37, 12, 'produk/1781798315_cireng1.png', '2026-06-18 15:58:35', '2026-06-18 15:58:35'),
	(38, 13, 'produk/1781798333_pisang3.png', '2026-06-18 15:58:53', '2026-06-18 15:58:53'),
	(39, 13, 'produk/1781798333_pisang2.png', '2026-06-18 15:58:53', '2026-06-18 15:58:53'),
	(40, 13, 'produk/1781798333_pisang1.png', '2026-06-18 15:58:53', '2026-06-18 15:58:53'),
	(41, 14, 'produk/1781798353_dimsum3.png', '2026-06-18 15:59:13', '2026-06-18 15:59:13'),
	(42, 14, 'produk/1781798353_dimsum2.png', '2026-06-18 15:59:13', '2026-06-18 15:59:13'),
	(43, 14, 'produk/1781798353_dimusam1.png', '2026-06-18 15:59:13', '2026-06-18 15:59:13'),
	(44, 15, 'produk/1781798374_bas1.png', '2026-06-18 15:59:34', '2026-06-18 15:59:34'),
	(45, 15, 'produk/1781798374_bas2.png', '2026-06-18 15:59:34', '2026-06-18 15:59:34'),
	(46, 16, 'produk/1781798392_sing1.png', '2026-06-18 15:59:52', '2026-06-18 15:59:52'),
	(47, 16, 'produk/1781798392_sing2.png', '2026-06-18 15:59:52', '2026-06-18 15:59:52'),
	(48, 16, 'produk/1781798392_sing3.png', '2026-06-18 15:59:52', '2026-06-18 15:59:52'),
	(49, 17, 'produk/1781798411_Dessert Box Coklat Lumer3.png', '2026-06-18 16:00:11', '2026-06-18 16:00:11'),
	(50, 17, 'produk/1781798411_Dessert Box Coklat Lumer2.png', '2026-06-18 16:00:11', '2026-06-18 16:00:11'),
	(51, 17, 'produk/1781798411_Dessert Box Coklat Lumer1.png', '2026-06-18 16:00:11', '2026-06-18 16:00:11'),
	(52, 18, 'produk/1781798427_Dessert Box Tiramisu3.png', '2026-06-18 16:00:27', '2026-06-18 16:00:27'),
	(53, 18, 'produk/1781798427_Dessert Box Tiramisu2.png', '2026-06-18 16:00:27', '2026-06-18 16:00:27'),
	(54, 18, 'produk/1781798427_Dessert Box Tiramisu1.png', '2026-06-18 16:00:27', '2026-06-18 16:00:27'),
	(55, 19, 'produk/1781798444_Puding Coklat Vla3.png', '2026-06-18 16:00:44', '2026-06-18 16:00:44'),
	(56, 19, 'produk/1781798444_Puding Coklat Vla2.png', '2026-06-18 16:00:44', '2026-06-18 16:00:44'),
	(57, 19, 'produk/1781798444_Puding Coklat Vla1.png', '2026-06-18 16:00:44', '2026-06-18 16:00:44'),
	(58, 21, 'produk/1781798466_Cheese Cake Mini1.png', '2026-06-18 16:01:06', '2026-06-18 16:01:06'),
	(59, 21, 'produk/1781798466_Cheese Cake Mini2.png', '2026-06-18 16:01:06', '2026-06-18 16:01:06'),
	(60, 22, 'produk/1781798483_Brownies Kukus Lumer3.png', '2026-06-18 16:01:23', '2026-06-18 16:01:23'),
	(61, 22, 'produk/1781798483_Brownies Kukus Lumer2.png', '2026-06-18 16:01:23', '2026-06-18 16:01:23'),
	(62, 22, 'produk/1781798483_Brownies Kukus Lumer.png', '2026-06-18 16:01:23', '2026-06-18 16:01:23'),
	(63, 23, 'produk/1781798498_matcha3.png', '2026-06-18 16:01:38', '2026-06-18 16:01:38'),
	(64, 23, 'produk/1781798498_matcha2.png', '2026-06-18 16:01:38', '2026-06-18 16:01:38'),
	(65, 23, 'produk/1781798498_matcha1.png', '2026-06-18 16:01:38', '2026-06-18 16:01:38'),
	(66, 24, 'produk/1781798515_jusmangga3.png', '2026-06-18 16:01:55', '2026-06-18 16:01:55'),
	(67, 24, 'produk/1781798515_jusmangga1.png', '2026-06-18 16:01:55', '2026-06-18 16:01:55'),
	(68, 25, 'produk/1781798532_escoklat3.png', '2026-06-18 16:02:12', '2026-06-18 16:02:12'),
	(69, 25, 'produk/1781798532_escoklat2.png', '2026-06-18 16:02:12', '2026-06-18 16:02:12'),
	(70, 25, 'produk/1781798532_escoklat1.png', '2026-06-18 16:02:12', '2026-06-18 16:02:12'),
	(71, 26, 'produk/1781798551_thaitea3.png', '2026-06-18 16:02:31', '2026-06-18 16:02:31'),
	(72, 26, 'produk/1781798551_thaitea2.png', '2026-06-18 16:02:31', '2026-06-18 16:02:31'),
	(73, 26, 'produk/1781798551_thaitea1.png', '2026-06-18 16:02:31', '2026-06-18 16:02:31'),
	(74, 27, 'produk/1781798566_jusalpukat3.png', '2026-06-18 16:02:46', '2026-06-18 16:02:46'),
	(75, 27, 'produk/1781798566_jusalpukat2.png', '2026-06-18 16:02:46', '2026-06-18 16:02:46'),
	(76, 27, 'produk/1781798566_jusalpukat1.png', '2026-06-18 16:02:46', '2026-06-18 16:02:46'),
	(77, 28, 'produk/1781798581_lemon1.png', '2026-06-18 16:03:01', '2026-06-18 16:03:01'),
	(78, 28, 'produk/1781798581_lemon2.png', '2026-06-18 16:03:01', '2026-06-18 16:03:01'),
	(79, 28, 'produk/1781798581_lemon3.png', '2026-06-18 16:03:01', '2026-06-18 16:03:01'),
	(80, 29, 'produk/1781798599_eskop1.png', '2026-06-18 16:03:19', '2026-06-18 16:03:19'),
	(81, 29, 'produk/1781798599_eskop2.png', '2026-06-18 16:03:19', '2026-06-18 16:03:19'),
	(82, 29, 'produk/1781798599_eskop3.png', '2026-06-18 16:03:19', '2026-06-18 16:03:19'),
	(83, 30, 'produk/1781798614_stramilk1.png', '2026-06-18 16:03:34', '2026-06-18 16:03:34'),
	(84, 30, 'produk/1781798614_stramilk2.png', '2026-06-18 16:03:34', '2026-06-18 16:03:34'),
	(85, 30, 'produk/1781798614_stramilk3.png', '2026-06-18 16:03:34', '2026-06-18 16:03:34');

-- Dumping structure for table dapuribu.sessions
DROP TABLE IF EXISTS `sessions`;
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

-- Dumping data for table dapuribu.sessions: ~1 rows (approximately)
INSERT IGNORE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('NvBGh5c3DGCANMHQXkoYf6WFEHDLoo5TG1bheJE8', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY2l2OGVHVEVuTmZFMFhJOEFPMkdWRGhHZ3FxMUY5UVZxMzZaVkxJUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2NoYXQvcG9sbD9sYXN0X2lkPTAiO3M6NToicm91dGUiO3M6MTQ6InVzZXIuY2hhdC5wb2xsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1782098280);

-- Dumping structure for table dapuribu.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `diskon` int NOT NULL DEFAULT '0',
  `ongkir` int NOT NULL DEFAULT '10000',
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Transfer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.settings: ~1 rows (approximately)
INSERT IGNORE INTO `settings` (`id`, `diskon`, `ongkir`, `metode_pembayaran`, `created_at`, `updated_at`) VALUES
	(1, 10, 10000, 'Transfer', '2026-06-18 15:06:34', '2026-06-18 15:06:34');

-- Dumping structure for table dapuribu.testimoni
DROP TABLE IF EXISTS `testimoni`;
CREATE TABLE IF NOT EXISTS `testimoni` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimoni_user_id_foreign` (`user_id`),
  KEY `testimoni_produk_id_foreign` (`produk_id`),
  CONSTRAINT `testimoni_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  CONSTRAINT `testimoni_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.testimoni: ~3 rows (approximately)
INSERT IGNORE INTO `testimoni` (`id`, `user_id`, `produk_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 5, 'nasi gorengnya enakk pedesnya pass makasih...', '2026-06-21 14:32:40', '2026-06-21 14:32:40'),
	(2, 3, 9, 5, 'kentang nya crispy enakkk', '2026-06-21 14:32:40', '2026-06-21 14:32:40'),
	(3, 3, 23, 5, 'matcha nya enakk bangett suka dehh', '2026-06-21 14:32:40', '2026-06-21 14:32:40');

-- Dumping structure for table dapuribu.tracking_pengiriman
DROP TABLE IF EXISTS `tracking_pengiriman`;
CREATE TABLE IF NOT EXISTS `tracking_pengiriman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengiriman_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tracking_pengiriman_pengiriman_id_foreign` (`pengiriman_id`),
  CONSTRAINT `tracking_pengiriman_pengiriman_id_foreign` FOREIGN KEY (`pengiriman_id`) REFERENCES `pengiriman` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.tracking_pengiriman: ~0 rows (approximately)

-- Dumping structure for table dapuribu.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','staff','customer','cs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `status` enum('verify','active','banned') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.users: ~4 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `address`, `city`, `postal_code`, `email_verified_at`, `role`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'active', '$2y$12$tVEsqIMq4vvJBuRFSWPW0.aKyoPcU4w77YHGR5qE.N0vEnhojis1i', NULL, '2026-06-18 15:06:33', '2026-06-18 15:06:33'),
	(2, 'staff', 'staff@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'staff', 'active', '$2y$12$Mjr87P0zfGtab0ztnN2ueO6usSzyvHcEGVpyhoEt7f8ZXiQZ8oE9G', NULL, '2026-06-18 15:06:34', '2026-06-18 15:06:34'),
	(3, 'customer', 'customer@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'customer', 'active', '$2y$12$fIG/yCqBpsnHci7wAQb7WOxUoUvJn9EnfrF6q6uaW5iWCwe4WCI8C', NULL, '2026-06-18 15:06:34', '2026-06-18 15:06:34'),
	(4, 'customerservis', 'customerservis@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'cs', 'active', '$2y$12$GrdpWRWMsA0MUdgoOrXdfudT2jCRb9NO/Utq7uBs4X.d/IROIlzDW', NULL, '2026-06-18 15:06:34', '2026-06-18 15:06:34');

-- Dumping structure for table dapuribu.verifications
DROP TABLE IF EXISTS `verifications`;
CREATE TABLE IF NOT EXISTS `verifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('register','reset_password') COLLATE utf8mb4_unicode_ci NOT NULL,
  `send_via` enum('email','sms','wa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `resend` int NOT NULL DEFAULT '0',
  `status` enum('active','valid','invalid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `verifications_user_id_foreign` (`user_id`),
  CONSTRAINT `verifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table dapuribu.verifications: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
