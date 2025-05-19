-- Adminer 5.2.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `aset`;
CREATE TABLE `aset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_aset` varchar(50) NOT NULL,
  `nama_aset` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `tanggal_perolehan` date NOT NULL,
  `nilai_perolehan` decimal(15,2) NOT NULL,
  `kondisi` enum('baik','rusak ringan','rusak berat') DEFAULT 'baik',
  `keterangan` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_aset` (`kode_aset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `aset` (`id`, `kode_aset`, `nama_aset`, `kategori`, `lokasi`, `tanggal_perolehan`, `nilai_perolehan`, `kondisi`, `keterangan`) VALUES
(1,	'AST-001',	'Laptop Lenovo ThinkPad',	'Elektronik',	'Ruang IT',	'2023-03-15',	15000000.00,	'baik',	'Digunakan untuk pengolahan data'),
(2,	'AST-002',	'Printer Canon MP287',	'Elektronik',	'Ruang Administrasi',	'2022-10-20',	2000000.00,	'baik',	'Untuk mencetak dokumen'),
(3,	'AST-003',	'Meja Kerja Karyawan',	'Furniture',	'Ruang HRD',	'2021-08-01',	1200000.00,	'rusak ringan',	'Lecet di bagian kaki'),
(4,	'AST-004',	'AC Panasonic 1 PK',	'Elektronik',	'Ruang Pimpinan',	'2020-01-05',	3500000.00,	'baik',	'Masih dingin'),
(5,	'AST-005',	'Lemari Arsip Besi',	'Furniture',	'Gudang',	'2019-11-30',	2500000.00,	'rusak berat',	'Pintu susah dibuka'),
(7,	'AS-0007',	'test 123 4545',	'MEJA',	'1',	'2025-05-19',	1.00,	'baik',	'1');

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text,
  `jumlah` decimal(15,2) NOT NULL,
  `status` enum('lunas','belum lunas') NOT NULL DEFAULT 'belum lunas',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `transaksi` (`id`, `no_invoice`, `tanggal`, `nama`, `keterangan`, `jumlah`, `status`) VALUES
(11,	'INV20250519040321',	'2025-04-17',	'SUPRIANTO',	'PELUNASAN WEDDING RUMAH JOGLO DIAN MUSTIKA',	16300000.00,	'lunas'),
(13,	'INV20250519040502',	'2025-04-30',	'BAPAK HAMDAN',	'DP KE 2 WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	20000000.00,	'lunas'),
(15,	'INV20250519041244',	'2025-02-03',	'SRI AGUSTINAWATI',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	5000000.00,	'lunas'),
(16,	'INV20250519041340',	'2025-04-19',	'DEWI PURNASARI ',	'DP GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(17,	'INV20250519041526',	'2025-04-20',	'RAFFA WIJAYA KUSUMA',	'DP GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(18,	'INV20250519041611',	'2025-02-14',	'ERNI SUSILOWATI',	'DP GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(21,	'INV20250519042430',	'2025-02-20',	'MUHAMMAD LUTHFI',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(22,	'INV20250519042658',	'2025-02-01',	'SAEFULLAH',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	10000000.00,	'lunas'),
(23,	'INV20250519042843',	'2025-03-15',	'IRFAN ANDREAS',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(24,	'INV20250519042949',	'2025-03-02',	'IIS ROHAYATI',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(25,	'INV20250519043136',	'2025-03-17',	'WEARING KLAMBY',	'PELUNASAN GEDUNG RUMAH JOGLO DIAN MUSTIKA',	24500000.00,	'lunas'),
(26,	'INV20250519043255',	'2025-04-30',	'REVAN ANANDA SYAFITRI',	'PELUNASAN GEDUNG RUMAH JOGLO DIAN MUSTIKA',	30000000.00,	'lunas'),
(29,	'INV20250519043609',	'2025-04-19',	'CHANTIKA EPRILIASA',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(30,	'INV20250519043719',	'2025-04-10',	'ADELIA ARSYAD',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	3000000.00,	'lunas'),
(32,	'INV20250519044238',	'2025-02-15',	'IKA RAHAYU',	'PELUNASAN WEDDING RUMAH JOGLO DIAN MUSTIKA',	10000000.00,	'lunas'),
(33,	'INV20250519044341',	'2025-02-17',	'SAEFULLAH',	'DP GEDUNG WEDDING RUMAH JOGLO DIAN MUSTIKA',	10000000.00,	'lunas'),
(34,	'INV20250519044531',	'2025-02-15',	'LINA IRSALINA',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	1000000.00,	'lunas'),
(35,	'INV20250519044703',	'2025-03-13',	'DEASY CAROLINA',	'PELUNASAN WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	21000000.00,	'lunas'),
(36,	'INV20250519044805',	'2025-03-02',	'SRI AGUSTINAWATI',	'DP WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	5000000.00,	'lunas'),
(37,	'INV20250519044947',	'2025-04-30',	'RESNI MAWATI RESTIO',	'PELUNASAN WEDDING GEDUNG RUMAH JOGLO DIAN MUSTIKA',	34100000.00,	'lunas');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `role` enum('admin','staff','user') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `email`, `telp`, `status`, `role`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'Administrator ASHTER',	'admin@example.com',	'081234567890',	'aktif',	'admin');

-- 2025-05-19 07:07:45 UTC
