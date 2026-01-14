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

-- Dumping structure for table cafein.antrian
CREATE TABLE IF NOT EXISTS `antrian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) NOT NULL,
  `noMeja` int NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '0',
  `idUser` int NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUser` (`idUser`),
  KEY `idx_order_id` (`order_id`),
  CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cafein.antrian: ~69 rows (approximately)
INSERT INTO `antrian` (`id`, `nama`, `noMeja`, `tanggal`, `status`, `idUser`, `order_id`) VALUES
	(8, 'mhm', 12, '2022-01-17 23:26:22', 2, 3, NULL),
	(9, 'tes aja', 1, '2022-01-17 23:28:18', 2, 3, NULL),
	(10, 'hehe', 23, '2022-01-17 23:29:23', 2, 1, NULL),
	(11, 'tes', 12, '2022-01-17 23:36:48', 2, 1, NULL),
	(12, 'FIndri', 12, '2022-01-17 23:37:49', 2, 1, NULL),
	(13, 'a', 2, '2022-01-17 23:38:51', 2, 3, NULL),
	(14, 'moham', 1, '2022-01-23 12:01:00', 2, 3, NULL),
	(15, 'moham', 12, '2022-01-17 23:40:58', 2, 1, NULL),
	(16, 'andi', 12, '2022-01-23 12:01:00', 2, 1, NULL),
	(17, 'Test', 1, '2025-07-23 00:00:00', 2, 1, NULL),
	(20, 'sundir', 3, '2025-07-23 00:00:00', 2, 1, NULL),
	(25, 'wewe', 1, '2025-07-23 00:00:00', 2, 1, NULL),
	(26, 'rusdi tali gas', 1, '2025-07-24 00:00:00', 2, 1, NULL),
	(27, 'riyan bensin', 8, '2025-07-31 00:00:00', 2, 1, NULL),
	(28, 'ridwan klaher', 4, '2025-07-31 00:00:00', 2, 1, NULL),
	(29, 'ridwan r', 1, '2025-07-31 00:00:00', 2, 1, NULL),
	(30, 'kamso', 1, '2025-07-31 00:00:00', 2, 1, NULL),
	(31, 'joko', 2, '2025-07-31 00:00:00', 2, 1, NULL),
	(32, 'muria', 3, '2025-07-31 00:00:00', 2, 1, NULL),
	(33, 'sanusi', 4, '2025-08-08 00:00:00', 2, 1, NULL),
	(34, 'jumat', 1, '2025-07-31 01:59:23', 2, 1, NULL),
	(35, 'sabtu', 4, '2025-07-31 00:00:00', 2, 1, NULL),
	(36, 'senen', 4, '2025-08-08 00:00:00', 2, 1, NULL),
	(37, 'rebo', 4, '2025-07-31 00:00:00', 2, 1, NULL),
	(38, 'kemis', 3, '2025-07-31 00:00:00', 2, 1, NULL),
	(39, 'jumat2', 1, '2025-08-08 00:00:00', 2, 1, NULL),
	(40, 'ridwan kasur', 1, '2025-08-08 00:00:00', 2, 1, NULL),
	(41, 'irwan sosis', 12, '2025-08-08 00:00:00', 2, 1, NULL),
	(42, 'hilman sumur', 3, '2025-08-09 00:00:00', 2, 7, NULL),
	(43, 'rizal bohlam', 1, '2025-08-09 00:00:00', 2, 6, NULL),
	(44, 'ilham radiator', 1, '2025-08-09 00:00:00', 2, 6, NULL),
	(45, 'rojali', 1, '2025-08-09 00:00:00', 2, 6, NULL),
	(46, 'mahmud sosis', 2, '2025-08-09 00:00:00', 2, 6, NULL),
	(47, 'roni sosis', 4, '2025-08-09 00:00:00', 2, 6, NULL),
	(48, 'paijo', 3, '2025-08-09 00:00:00', 2, 6, NULL),
	(49, 'sukimin', 2, '2025-08-09 00:00:00', 2, 7, NULL),
	(50, 'renbur', 5, '2025-08-10 00:00:00', 2, 6, NULL),
	(51, 'tes1', 2, '2025-08-10 00:00:00', 2, 7, NULL),
	(52, 'tes2', 4, '2025-08-10 00:00:00', 2, 6, NULL),
	(53, 'andi galon', 2, '2025-08-09 00:00:00', 2, 7, NULL),
	(54, 'mungkar bubur', 2, '2025-08-10 00:00:00', 2, 6, NULL),
	(55, 'jusnaidi', 2, '2025-08-12 00:00:00', 2, 7, NULL),
	(56, 'testing2', 3, '2025-08-12 00:00:00', 2, 6, NULL),
	(57, 'testing3', 3, '2025-08-12 00:00:00', 2, 6, NULL),
	(58, 'test4', 4, '2025-08-12 00:00:00', 2, 6, NULL),
	(59, 'test5', 5, '2025-08-12 00:00:00', 2, 6, NULL),
	(60, 'tes6', 6, '2025-08-12 00:00:00', 2, 6, NULL),
	(61, 'eee', 2, '2025-08-12 00:00:00', 2, 6, NULL),
	(62, 'IMRON', 2, '2025-08-12 00:00:00', 2, 6, NULL),
	(63, 'rendi', 5, '2025-08-12 00:00:00', 2, 6, NULL),
	(64, 'esgrgr', 1, '2025-08-12 00:00:00', 2, 6, NULL),
	(65, 'edfe', 1, '2025-08-12 00:00:00', 2, 6, NULL),
	(66, 'ASTI ANDINI', 1, '2025-08-12 00:00:00', 2, 6, NULL),
	(67, 'kamil', 2, '2025-08-13 00:00:00', 2, 6, NULL),
	(68, 'renbur', 1, '2025-08-13 00:00:00', 2, 6, NULL),
	(69, 'ANTONI FIKRI', 5, '2025-08-13 00:00:00', 2, 7, NULL),
	(70, 'EVI OKTAVIA', 3, '2025-08-13 00:00:00', 2, 6, NULL),
	(71, 'dedi mulyadi', 1, '2025-08-13 00:00:00', 2, 1, NULL),
	(72, 'dedw', 2, '2025-08-13 00:00:00', 2, 1, NULL),
	(73, 'tes1', 1, '2025-08-13 00:00:00', 2, 6, NULL),
	(74, 'tes2', 1, '2025-08-13 00:00:00', 2, 6, NULL),
	(75, 'mengetes1', 1, '2025-08-13 00:00:00', 2, 6, NULL),
	(76, 'mengetes2', 1, '2025-08-13 00:00:00', 2, 6, NULL),
	(77, 'teresa', 14, '2025-08-13 12:03:04', 1, 6, NULL),
	(78, 'endro', 3, '2025-08-14 00:00:00', 1, 6, NULL),
	(79, 'www', 1, '2025-08-14 00:00:00', 2, 6, NULL),
	(80, 'eee', 2, '2025-08-13 12:14:10', 0, 6, NULL),
	(81, 'zzz', 1, '2025-08-13 12:16:47', 0, 6, NULL),
	(82, 'ccc', 2, '2025-08-13 12:18:47', 0, 6, NULL);

-- Dumping structure for table cafein.barcode
CREATE TABLE IF NOT EXISTS `barcode` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_number` int NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cafein.barcode: ~15 rows (approximately)
INSERT INTO `barcode` (`id`, `table_number`, `barcode`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'MEJA01_688104f0555ad', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(2, 2, 'MEJA02_688104f058da5', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(3, 3, 'MEJA03_688104f059b1b', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(4, 4, 'MEJA04_688104f05a349', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(5, 5, 'MEJA05_688104f05aa5e', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(6, 6, 'MEJA06_688104f05b1d1', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(7, 7, 'MEJA07_688104f05bda8', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(8, 8, 'MEJA08_688104f05ca54', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(9, 9, 'MEJA09_688104f05ded3', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(10, 10, 'MEJA10_688104f05e7a0', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(11, 11, 'MEJA11_688104f05f0b7', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(12, 12, 'MEJA12_688104f05fefa', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(13, 13, 'MEJA13_688104f060a1e', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(14, 14, 'MEJA14_688104f061325', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12'),
	(15, 15, 'MEJA15_688104f062723', 'active', '2025-07-23 15:51:12', '2025-07-23 15:51:12');

-- Dumping structure for table cafein.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) NOT NULL,
  `jenis` int NOT NULL,
  `harga` int NOT NULL,
  `foto` varchar(32) NOT NULL,
  `status` int NOT NULL,
  `hapus` datetime DEFAULT NULL,
  `best_seller` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cafein.menu: ~29 rows (approximately)
INSERT INTO `menu` (`id`, `nama`, `jenis`, `harga`, `foto`, `status`, `hapus`, `best_seller`) VALUES
	(1, 'Chiken Katsu', 1, 20000, 'chickenkatsu1.jpg', 1, NULL, 1),
	(2, 'Kentang Goreng', 2, 12000, 'kentanggoreng.jpg', 1, NULL, 1),
	(3, 'Chesee Tea', 3, 10000, 'cheseetea.jpg', 0, NULL, 1),
	(4, 'Espresso', 4, 10000, 'espresso.jpg', 1, NULL, 0),
	(5, 'Mie Goreng Telur', 1, 8000, 'miegorengtelur.jpg', 0, NULL, 0),
	(6, 'Nasi Goreng Keju', 1, 12000, 'nasigorengkeju.jpg', 1, NULL, 1),
	(7, 'Ayam Goreng Tepung', 1, 20000, 'ayamgorengtepung.jpg', 1, NULL, 0),
	(8, 'Sate Ayam', 1, 15000, 'sateayam.jpg', 0, NULL, 0),
	(9, 'Tahu Bakso', 2, 10000, 'tahubakso.jpg', 1, NULL, 0),
	(10, 'Kulit Ayam', 2, 10000, 'kulitayam.jpg', 1, NULL, 0),
	(11, 'Banana Roll', 2, 10000, 'bananaroll.jpg', 1, NULL, 0),
	(12, 'Sosis Bakar', 2, 10000, 'sosisbakar.jpg', 1, NULL, 0),
	(13, 'Martabak Ayam', 2, 15000, 'martabakayam.jpg', 1, NULL, 0),
	(14, 'Pisang Keju', 2, 12000, 'pisangkeju.jpg', 1, NULL, 0),
	(15, 'Coklat Keju', 3, 12000, 'coklatkeju.jpg', 1, NULL, 0),
	(16, 'Greentea keju', 3, 10000, 'greenteakeju.jpg', 1, NULL, 0),
	(17, 'Milk Tea', 3, 10000, 'milktea.jpg', 1, NULL, 0),
	(18, 'Cappucino Cincau', 3, 10000, 'cappucinocincau.jpg', 0, NULL, 0),
	(19, 'Teh Keju Susu', 3, 12000, 'tehkejususu.jpg', 1, NULL, 0),
	(20, 'Jus Melon', 3, 10000, 'jusmelon.jpg', 1, NULL, 0),
	(21, 'Jus Semangka', 3, 10000, 'jussemangka.jpg', 1, NULL, 0),
	(22, 'Jus Buah Naga', 3, 10000, 'jusbuahnaga.jpg', 1, NULL, 0),
	(23, 'Jus Sirsak', 3, 10000, 'jussirsak.jpg', 0, NULL, 0),
	(24, 'Cappucino Latte', 4, 10000, 'cappucinolatte.jpg', 1, NULL, 0),
	(25, 'Green tea latte', 4, 10000, 'greentealatte.jpg', 0, NULL, 0),
	(26, 'Kopi Americano', 4, 8000, 'kopiamericano.jpg', 1, NULL, 0),
	(27, 'Kopi Susu', 4, 8000, 'kopisusu.jpg', 0, NULL, 0),
	(28, 'ayam bakar', 1, 20000, 'default.jpg', 0, '2022-01-20 12:01:00', 0),
	(29, 'Kopi Tubruk', 4, 8000, 'default.jpg', 0, '2022-01-20 12:01:00', 0);

-- Dumping structure for view cafein.pembelian
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `pembelian` (
	`id` INT(10) NOT NULL,
	`idMenu` INT(10) NOT NULL,
	`namaMenu` VARCHAR(32) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`jumlah` INT(10) NOT NULL,
	`harga` INT(10) NOT NULL,
	`idAntrian` INT(10) NOT NULL,
	`namaAntrian` VARCHAR(32) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`noMeja` INT(10) NOT NULL,
	`tanggal` DATETIME NOT NULL,
	`statusAntrian` INT(10) NOT NULL,
	`namaUser` VARCHAR(32) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`tanggalTransaksi` DATETIME NULL
) ENGINE=MyISAM;

-- Dumping structure for table cafein.table_barcodes
CREATE TABLE IF NOT EXISTS `table_barcodes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `table_number` int unsigned NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_table_number` (`table_number`),
  UNIQUE KEY `unique_barcode` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cafein.table_barcodes: ~15 rows (approximately)
INSERT INTO `table_barcodes` (`id`, `table_number`, `barcode`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'MEJA01_6880d5c4554d9', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(2, 2, 'MEJA02_6880d5c4584db', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(3, 3, 'MEJA03_6880d5c458f47', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(4, 4, 'MEJA04_6880d5c459724', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(5, 5, 'MEJA05_6880d5c45a2ef', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(6, 6, 'MEJA06_6880d5c45aa98', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(7, 7, 'MEJA07_6880d5c45b3c6', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(8, 8, 'MEJA08_6880d5c45bbe3', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(9, 9, 'MEJA09_6880d5c45c3d9', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(10, 10, 'MEJA10_6880d5c45ccc1', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(11, 11, 'MEJA11_6880d5c45d5a6', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(12, 12, 'MEJA12_6880d5c45dedf', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(13, 13, 'MEJA13_6880d5c45e654', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(14, 14, 'MEJA14_6880d5c45ed84', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56'),
	(15, 15, 'MEJA15_6880d5c45f4cd', 'active', '2025-07-23 14:29:56', '2025-07-23 14:29:56');

-- Dumping structure for table cafein.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idMenu` int NOT NULL,
  `jumlah` int NOT NULL,
  `idAntrian` int NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idMenu` (`idMenu`) USING BTREE,
  KEY `idAntrian` (`idAntrian`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idAntrian`) REFERENCES `antrian` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`idMenu`) REFERENCES `menu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cafein.transaksi: ~117 rows (approximately)
INSERT INTO `transaksi` (`id`, `idMenu`, `jumlah`, `idAntrian`, `tanggal`) VALUES
	(1, 5, 1, 8, '2025-07-31 13:48:30'),
	(2, 6, 1, 8, '2025-07-31 13:48:30'),
	(3, 6, 1, 9, '2025-07-31 13:48:30'),
	(4, 7, 1, 9, '2025-07-31 13:48:30'),
	(5, 7, 1, 10, '2025-07-31 13:48:30'),
	(6, 8, 1, 10, '2025-07-31 13:48:30'),
	(7, 2, 1, 10, '2025-07-31 13:48:30'),
	(8, 5, 1, 11, '2025-07-31 13:48:30'),
	(9, 6, 1, 11, '2025-07-31 13:48:30'),
	(10, 7, 1, 11, '2025-07-31 13:48:30'),
	(11, 1, 1, 12, '2025-07-31 13:48:30'),
	(12, 6, 1, 13, '2025-07-31 13:48:30'),
	(13, 6, 1, 14, '2025-07-31 13:48:30'),
	(14, 8, 1, 15, '2025-07-31 13:48:30'),
	(15, 1, 1, 16, '2025-07-31 13:48:30'),
	(16, 25, 2, 16, '2025-07-31 13:48:30'),
	(17, 27, 1, 16, '2025-07-31 13:48:30'),
	(18, 7, 1, 16, '2025-07-31 13:48:30'),
	(19, 1, 1, 17, '2025-07-31 13:48:30'),
	(20, 3, 1, 25, '2025-07-31 13:48:30'),
	(21, 2, 1, 25, '2025-07-31 13:48:30'),
	(22, 1, 1, 25, '2025-07-31 13:48:30'),
	(23, 2, 1, 26, '2025-07-31 13:48:30'),
	(24, 1, 1, 26, '2025-07-31 13:48:30'),
	(25, 3, 1, 29, '2025-07-31 13:48:30'),
	(26, 2, 1, 29, '2025-07-31 13:48:30'),
	(27, 4, 1, 31, '2025-07-31 13:48:30'),
	(28, 3, 1, 31, '2025-07-31 13:48:30'),
	(29, 3, 1, 34, '2025-07-31 01:59:23'),
	(30, 2, 1, 34, '2025-07-31 01:59:23'),
	(31, 1, 1, 34, '2025-07-31 01:59:23'),
	(32, 6, 1, 37, '2025-07-31 02:10:41'),
	(33, 5, 1, 37, '2025-07-31 02:10:41'),
	(34, 1, 1, 37, '2025-07-31 02:10:41'),
	(35, 2, 1, 38, '2025-07-31 02:11:22'),
	(36, 3, 1, 38, '2025-07-31 02:11:22'),
	(37, 4, 1, 38, '2025-07-31 02:11:22'),
	(38, 2, 1, 39, '2025-07-31 03:07:37'),
	(39, 3, 1, 39, '2025-07-31 03:07:37'),
	(40, 3, 1, 40, '2025-08-08 03:18:05'),
	(41, 6, 1, 40, '2025-08-08 03:18:05'),
	(42, 12, 7, 41, '2025-08-08 06:20:52'),
	(43, 26, 1, 42, '2025-08-08 23:18:42'),
	(44, 24, 1, 42, '2025-08-08 23:18:42'),
	(45, 8, 2, 42, '2025-08-08 23:18:42'),
	(46, 1, 1, 42, '2025-08-08 23:18:42'),
	(47, 1, 1, 43, '2025-08-08 23:21:15'),
	(48, 2, 1, 43, '2025-08-08 23:21:15'),
	(49, 3, 1, 43, '2025-08-08 23:21:15'),
	(50, 3, 1, 44, '2025-08-08 23:28:56'),
	(51, 2, 1, 44, '2025-08-08 23:28:56'),
	(52, 1, 1, 44, '2025-08-08 23:28:56'),
	(53, 3, 1, 45, '2025-08-08 23:34:39'),
	(54, 2, 1, 45, '2025-08-08 23:34:39'),
	(55, 12, 9, 45, '2025-08-08 23:34:39'),
	(56, 12, 8, 46, '2025-08-08 23:49:38'),
	(57, 12, 6, 47, '2025-08-09 00:38:32'),
	(58, 8, 2, 48, '2025-08-09 00:50:30'),
	(59, 6, 1, 49, '2025-08-09 02:31:04'),
	(60, 5, 1, 49, '2025-08-09 02:31:04'),
	(61, 1, 1, 49, '2025-08-09 02:31:04'),
	(62, 3, 1, 50, '2025-08-09 02:35:35'),
	(63, 2, 1, 50, '2025-08-09 02:35:35'),
	(64, 1, 1, 50, '2025-08-09 02:35:35'),
	(65, 6, 1, 51, '2025-08-09 02:48:13'),
	(66, 5, 1, 51, '2025-08-09 02:48:13'),
	(67, 5, 1, 52, '2025-08-09 02:51:36'),
	(68, 6, 1, 52, '2025-08-09 02:51:36'),
	(69, 3, 1, 53, '2025-08-09 03:04:44'),
	(70, 2, 1, 53, '2025-08-09 03:04:44'),
	(71, 2, 1, 54, '2025-08-10 04:46:42'),
	(72, 3, 1, 54, '2025-08-10 04:46:42'),
	(73, 1, 1, 55, '2025-08-10 11:26:12'),
	(74, 2, 1, 55, '2025-08-10 11:26:12'),
	(75, 2, 1, 56, '2025-08-10 11:29:17'),
	(76, 1, 1, 56, '2025-08-10 11:29:17'),
	(77, 6, 1, 57, '2025-08-10 11:34:09'),
	(78, 7, 1, 57, '2025-08-10 11:34:09'),
	(79, 1, 1, 58, '2025-08-10 11:34:32'),
	(80, 2, 1, 58, '2025-08-10 11:34:32'),
	(81, 1, 1, 59, '2025-08-10 11:37:43'),
	(82, 2, 1, 59, '2025-08-10 11:37:43'),
	(83, 1, 1, 60, '2025-08-10 11:44:53'),
	(84, 2, 1, 60, '2025-08-10 11:44:53'),
	(85, 2, 2, 61, '2025-08-10 12:11:44'),
	(86, 2, 1, 62, '2025-08-11 15:42:10'),
	(87, 1, 1, 62, '2025-08-11 15:42:10'),
	(88, 2, 1, 63, '2025-08-11 22:25:59'),
	(89, 1, 1, 63, '2025-08-11 22:25:59'),
	(90, 2, 2, 64, '2025-08-12 05:52:17'),
	(91, 1, 1, 64, '2025-08-12 05:52:17'),
	(92, 2, 1, 65, '2025-08-12 05:52:38'),
	(93, 6, 1, 65, '2025-08-12 05:52:38'),
	(94, 1, 1, 66, '2025-08-12 09:28:24'),
	(95, 2, 3, 66, '2025-08-12 09:28:24'),
	(96, 2, 2, 67, '2025-08-12 09:31:02'),
	(97, 2, 2, 68, '2025-08-12 22:49:36'),
	(98, 6, 2, 69, '2025-08-12 23:29:09'),
	(99, 2, 3, 70, '2025-08-12 23:33:03'),
	(100, 2, 1, 71, '2025-08-13 11:44:05'),
	(101, 1, 1, 71, '2025-08-13 11:44:05'),
	(102, 2, 1, 72, '2025-08-13 11:44:30'),
	(103, 1, 1, 72, '2025-08-13 11:44:30'),
	(110, 1, 1, 73, '2025-08-13 11:53:38'),
	(111, 2, 1, 73, '2025-08-13 11:53:38'),
	(112, 2, 1, 74, '2025-08-13 11:54:40'),
	(113, 1, 1, 74, '2025-08-13 11:54:40'),
	(114, 2, 1, 75, '2025-08-13 11:58:16'),
	(115, 1, 1, 75, '2025-08-13 11:58:16'),
	(116, 6, 2, 76, '2025-08-13 11:58:55'),
	(117, 2, 2, 77, '2025-08-13 12:03:04'),
	(118, 2, 1, 78, '2025-08-13 12:11:19'),
	(119, 1, 1, 78, '2025-08-13 12:11:19'),
	(120, 6, 2, 79, '2025-08-13 12:13:37'),
	(121, 2, 2, 80, '2025-08-13 12:14:10'),
	(122, 6, 2, 81, '2025-08-13 12:16:47'),
	(123, 6, 2, 82, '2025-08-13 12:18:47');

-- Dumping structure for table cafein.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rule` int NOT NULL,
  `hapus` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table cafein.user: ~7 rows (approximately)
INSERT INTO `user` (`id`, `nama`, `password`, `rule`, `hapus`) VALUES
	(1, 'Moham', '$2y$10$MuR.3IpT.1xLJbeUYs6V6.KcCw0A6OO3Vv6K4L9dCuXgDum1eBf/G', 1, '2025-08-08 12:08:00'),
	(2, 'findri', '$2y$10$tNdOYtHXIcaDMaG9F74E9ucomT55HJQh49A/hc9NCosDXTPp4EX0O', 0, '2025-08-08 12:08:00'),
	(3, 'Moh. Nikmat', '$2y$10$N8XuFBEzrTLVccSYXgBoeuSk85r1ZmG/ouiq2hFbbiTpj4WB0yLGS', 1, '2025-08-08 12:08:00'),
	(4, 'Krocket ayam', '$2y$10$qC5Xlz80E7BuC/1cfkI5KOeyi/BQ9lw4nvmtYMmAUb0ijhq2NwMDi', 0, '2022-01-20 12:01:00'),
	(5, 'Samsul Kopling', '$2y$10$igq4EOwwNyzEUHauWFNRR.LmMqokL5IhbxtAhaDaQItwdzWirO6PO', 1, '2025-08-08 12:08:00'),
	(6, 'Pemilik', '$2y$10$uPDmHGefLpBz5gBmhQ.WTetziqP5qqrqfKCupipHH9Osy3lZXuzIW', 1, NULL),
	(7, 'Kasir', '$2y$10$gyPV6meRz.YPhMEv/.Tdw.mdisIpxN5SSE0tyVEs.0O0azET8u2iO', 0, NULL);

-- Dumping structure for view cafein.pembelian
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `pembelian`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `pembelian` AS select `t`.`id` AS `id`,`t`.`idMenu` AS `idMenu`,`m`.`nama` AS `namaMenu`,`t`.`jumlah` AS `jumlah`,`m`.`harga` AS `harga`,`t`.`idAntrian` AS `idAntrian`,`a`.`nama` AS `namaAntrian`,`a`.`noMeja` AS `noMeja`,coalesce(`t`.`tanggal`,`a`.`tanggal`,now()) AS `tanggal`,`a`.`status` AS `statusAntrian`,`u`.`nama` AS `namaUser`,`t`.`tanggal` AS `tanggalTransaksi` from (((`transaksi` `t` join `antrian` `a` on((`t`.`idAntrian` = `a`.`id`))) join `menu` `m` on((`t`.`idMenu` = `m`.`id`))) join `user` `u` on((`a`.`idUser` = `u`.`id`)));

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
