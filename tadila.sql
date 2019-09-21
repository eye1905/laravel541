-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2019 at 12:35 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tadila`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `namaBarang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` double NOT NULL,
  `satuan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `namaBarang`, `stok`, `satuan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kaki', 56, 'Kg', 1, '2019-06-25 05:41:05', '2019-08-27 20:11:23'),
(2, 'Mangkok A', 17, 'Kg', 1, '2019-07-04 03:59:18', '2019-07-24 03:12:46'),
(3, 'Raw', 45, 'Kg', 1, '2019-07-10 03:43:18', '2019-08-27 20:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `belis`
--

CREATE TABLE `belis` (
  `id` int(10) UNSIGNED NOT NULL,
  `noNotaBeli` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglBeli` date NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `belis`
--

INSERT INTO `belis` (`id`, `noNotaBeli`, `tglBeli`, `id_supplier`, `id_karyawan`, `status`, `created_at`, `updated_at`) VALUES
(1, '1978823', '2019-06-25', 1, 4, '1', '2019-06-25 06:03:05', '2019-07-04 05:05:06'),
(2, '1768558', '2019-07-04', 1, 1, '0', '2019-07-04 03:59:35', '2019-07-04 04:57:46'),
(3, '7552035', '2019-07-04', 2, 1, '', '2019-07-04 04:01:56', '2019-07-04 04:01:56'),
(4, '9367707', '2019-07-04', 2, 1, '', '2019-07-04 04:02:41', '2019-07-04 04:02:41'),
(5, '1024733', '2019-07-04', 2, 1, '', '2019-07-04 04:20:02', '2019-07-04 04:20:02'),
(6, NULL, '2019-07-10', 2, 1, '0', '2019-07-10 02:39:14', '2019-07-10 02:39:14'),
(7, 'B00007', '2019-07-10', 2, 1, '1', '2019-07-10 02:41:37', '2019-07-10 03:40:13'),
(8, 'B00008', '2019-07-10', 1, 1, '0', '2019-07-10 03:43:27', '2019-07-10 03:43:27'),
(9, 'B00009', '2019-07-11', 1, 1, '0', '2019-07-10 21:37:22', '2019-07-10 21:37:22'),
(10, 'B000010', '2019-07-24', 3, 1, '1', '2019-07-24 02:33:51', '2019-07-24 02:35:46'),
(11, 'B000011', '2019-07-24', 3, 1, '1', '2019-07-24 03:11:25', '2019-08-27 20:11:23'),
(12, 'B000012', '2019-07-24', 2, 1, '1', '2019-07-24 03:11:52', '2019-07-24 03:12:46'),
(13, 'B000013', '2019-08-14', 3, 1, '0', '2019-08-13 23:20:13', '2019-08-13 23:20:13'),
(14, 'B000014', '2019-08-19', 3, 1, '1', '2019-08-18 19:44:45', '2019-08-18 19:45:08'),
(15, 'B000015', '2019-08-27', 4, 1, '0', '2019-08-27 06:01:32', '2019-08-27 06:01:33'),
(16, 'B000016', '2019-08-27', 1, 1, '0', '2019-08-27 06:10:06', '2019-08-27 06:10:07'),
(17, 'B000017', '2019-08-27', 1, 1, '0', '2019-08-27 06:22:41', '2019-08-27 06:22:41'),
(18, 'B000018', '2019-09-17', 1, 1, '0', '2019-09-16 22:02:36', '2019-09-16 22:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detailbelis`
--

CREATE TABLE `detailbelis` (
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_beli` int(10) UNSIGNED NOT NULL,
  `berat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `subTotal` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detailbelis`
--

INSERT INTO `detailbelis` (`id_barang`, `id_beli`, `berat`, `harga`, `subTotal`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, '5', 5000, 25000, 175000, '2019-07-04 03:27:51', '2019-07-04 04:07:29'),
(1, 1, '5', 5000, 25000, 175000, '2019-07-04 03:30:24', '2019-07-04 04:07:29'),
(1, 1, '5', 5000, 25000, 175000, '2019-07-04 03:30:42', '2019-07-04 04:07:29'),
(1, 1, '5', 5000, 25000, 175000, '2019-07-04 03:44:48', '2019-07-04 04:07:29'),
(2, 1, '3', 25000, 75000, 175000, '2019-07-04 04:07:29', '2019-07-04 04:07:29'),
(2, 5, '2', 30000, 60000, 60000, '2019-07-04 04:20:25', '2019-07-04 04:20:25'),
(2, 2, '4', 25000, 100000, 120000, '2019-07-04 04:57:35', '2019-07-04 04:57:44'),
(1, 2, '2', 10000, 20000, 120000, '2019-07-04 04:57:44', '2019-07-04 04:57:44'),
(1, 7, '20', 30000, 600000, 600000, '2019-07-10 02:41:48', '2019-07-10 02:41:48'),
(3, 10, '20', NULL, 0, 0, '2019-07-24 02:35:07', '2019-07-24 02:35:07'),
(2, 12, '10', 15000, 150000, 150000, '2019-07-24 03:12:05', '2019-07-24 03:12:12'),
(3, 12, '5', NULL, 0, 150000, '2019-07-24 03:12:12', '2019-07-24 03:12:12'),
(1, 8, '6', NULL, 0, 0, '2019-07-24 04:30:08', '2019-07-24 04:30:31'),
(3, 8, '20', NULL, 0, 0, '2019-07-24 04:30:31', '2019-07-24 04:30:31'),
(3, 11, '10', NULL, 0, 0, '2019-07-24 04:45:38', '2019-07-24 04:45:43'),
(1, 11, '6', NULL, 0, 0, '2019-07-24 04:45:43', '2019-07-24 04:45:43'),
(3, 13, '25', NULL, 0, 240000, '2019-08-13 23:20:22', '2019-08-13 23:20:32'),
(1, 13, '12', 20000, 240000, 240000, '2019-08-13 23:20:31', '2019-08-13 23:20:32'),
(3, 14, '10', NULL, 0, 600000, '2019-08-18 19:44:50', '2019-08-18 19:45:00'),
(1, 14, '30', 20000, 600000, 600000, '2019-08-18 19:45:00', '2019-08-18 19:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `detailjuals`
--

CREATE TABLE `detailjuals` (
  `id_barang` int(10) UNSIGNED NOT NULL,
  `id_jual` int(10) UNSIGNED NOT NULL,
  `beratJual` double NOT NULL,
  `harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detailproses`
--

CREATE TABLE `detailproses` (
  `iddetail` int(200) NOT NULL,
  `id_proses` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL,
  `jumlahBarang` double NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detailproses`
--

INSERT INTO `detailproses` (`iddetail`, `id_proses`, `id_barang`, `jumlahBarang`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 3, 0, 0, '2019-08-27 06:08:31', '2019-08-27 06:08:56'),
(2, 9, 3, 0, 1, '2019-08-27 06:08:50', '2019-08-27 06:09:04'),
(3, 9, 3, 0, 1, '2019-08-27 06:08:56', '2019-08-27 06:09:24'),
(4, 9, 1, 0, 2, '2019-08-27 06:09:04', '2019-08-27 06:09:11'),
(5, 9, 1, 0, 3, '2019-08-27 06:09:11', '2019-08-27 06:09:17'),
(6, 9, 1, 10, 4, '2019-08-27 06:09:17', '2019-08-27 06:09:17'),
(7, 9, 2, 0, 2, '2019-08-27 06:09:24', '2019-08-27 06:09:30'),
(8, 9, 2, 0, 3, '2019-08-27 06:09:30', '2019-08-27 06:09:35'),
(9, 9, 2, 10, 4, '2019-08-27 06:09:35', '2019-08-27 06:09:35'),
(10, 10, 3, 0, 0, '2019-08-27 06:12:49', '2019-08-27 06:14:38'),
(11, 10, 3, 0, 1, '2019-08-27 06:12:57', '2019-08-27 06:13:10'),
(12, 10, 1, 0, 2, '2019-08-27 06:13:10', '2019-08-27 06:13:18'),
(13, 10, 1, 0, 3, '2019-08-27 06:13:18', '2019-08-27 06:13:28'),
(14, 10, 1, 9.9, 4, '2019-08-27 06:13:28', '2019-08-27 06:13:28'),
(15, 10, 3, 0, 1, '2019-08-27 06:14:37', '2019-08-27 06:22:16'),
(16, 10, 2, 0, 2, '2019-08-27 06:22:16', '2019-08-27 06:22:29'),
(17, 10, 2, 0, 3, '2019-08-27 06:22:29', '2019-08-27 06:22:51'),
(18, 10, 2, 10, 4, '2019-08-27 06:22:51', '2019-08-27 06:22:51'),
(19, 11, 3, 0, 0, '2019-08-27 20:01:07', '2019-08-27 20:08:00'),
(20, 11, 3, 0, 1, '2019-08-27 20:07:40', '2019-08-27 20:07:55'),
(21, 11, 1, 0.09999999999999964, 2, '2019-08-27 20:07:48', '2019-08-27 20:08:47'),
(22, 11, 2, 10, 2, '2019-08-27 20:07:55', '2019-08-27 20:07:55'),
(23, 11, 3, 0, 1, '2019-08-27 20:08:00', '2019-08-27 20:08:28'),
(24, 11, 1, 9, 2, '2019-08-27 20:08:18', '2019-08-27 20:08:18'),
(25, 11, 2, 0, 2, '2019-08-27 20:08:28', '2019-09-16 22:03:16'),
(26, 11, 1, 0, 3, '2019-08-27 20:08:47', '2019-08-27 20:09:42'),
(27, 11, 1, 9.8, 4, '2019-08-27 20:09:41', '2019-08-27 20:09:41'),
(28, 11, 2, 0, 3, '2019-09-16 22:03:16', '2019-09-16 22:03:41'),
(29, 11, 2, 1, 4, '2019-09-16 22:03:41', '2019-09-16 22:03:41'),
(30, 12, 1, 25, 0, '2019-09-16 22:11:02', '2019-09-16 22:11:02'),
(32, 13, 3, 0, 1, '2019-09-21 01:39:59', '2019-09-21 01:40:14'),
(33, 13, 1, 0, 2, '2019-09-21 01:40:05', '2019-09-21 01:40:23'),
(34, 13, 1, 5, 2, '2019-09-21 01:40:14', '2019-09-21 01:40:14'),
(35, 13, 1, 0, 3, '2019-09-21 01:40:23', '2019-09-21 01:40:37'),
(36, 13, 1, 5, 4, '2019-09-21 01:40:37', '2019-09-21 01:40:37'),
(49, 14, 2, 20, 1, '2019-09-21 02:14:29', '2019-09-21 02:17:25'),
(50, 14, 1, 20, 5, '2019-09-21 02:14:35', '2019-09-21 02:19:50'),
(51, 14, 2, 10, 5, '2019-09-21 02:17:25', '2019-09-21 02:19:34'),
(53, 14, 2, 10, 4, '2019-09-21 02:19:34', '2019-09-21 02:19:34'),
(54, 14, 1, 10, 5, '2019-09-21 02:19:50', '2019-09-21 02:19:59'),
(55, 14, 1, 10, 4, '2019-09-21 02:19:59', '2019-09-21 02:19:59'),
(61, 14, 1, 10, 5, '2019-09-21 02:24:29', '2019-09-21 02:28:56'),
(62, 14, 1, 10, 4, '2019-09-21 02:28:56', '2019-09-21 02:28:56'),
(70, 14, 3, 20, 5, '2019-09-21 02:45:41', '2019-09-21 03:06:44'),
(88, 14, 3, 0, 1, '2019-09-21 03:02:17', '2019-09-21 03:08:51'),
(90, 14, 3, 0, 1, '2019-09-21 03:06:44', '2019-09-21 03:10:10'),
(91, 14, 1, 5, 5, '2019-09-21 03:08:40', '2019-09-21 03:09:04'),
(92, 14, 2, 5, 5, '2019-09-21 03:08:51', '2019-09-21 03:09:32'),
(93, 14, 1, 5, 5, '2019-09-21 03:09:04', '2019-09-21 03:09:15'),
(94, 14, 1, 5, 4, '2019-09-21 03:09:15', '2019-09-21 03:09:15'),
(95, 14, 2, 4, 5, '2019-09-21 03:09:32', '2019-09-21 03:10:01'),
(96, 14, 2, 3.9, 4, '2019-09-21 03:10:01', '2019-09-21 03:10:01'),
(97, 14, 1, 10, 5, '2019-09-21 03:10:10', '2019-09-21 03:10:18'),
(98, 14, 1, 10, 4, '2019-09-21 03:10:18', '2019-09-21 03:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `juals`
--

CREATE TABLE `juals` (
  `id` int(10) UNSIGNED NOT NULL,
  `noNotaJual` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglKirim` date NOT NULL,
  `noResi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tglPesan` date NOT NULL,
  `tglTerima` date NOT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusBayar` tinyint(2) NOT NULL,
  `kurs` double NOT NULL,
  `id_currencies` int(10) UNSIGNED NOT NULL,
  `id_konsumen` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konsumens`
--

CREATE TABLE `konsumens` (
  `id` int(10) UNSIGNED NOT NULL,
  `namaKonsumen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noTelp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konsumens`
--

INSERT INTO `konsumens` (`id`, `namaKonsumen`, `alamat`, `noTelp`, `created_at`, `updated_at`) VALUES
(2, 'Yusuf', 'rungkut', 123456, '2019-06-21 05:28:30', '2019-06-21 05:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_03_25_071704_create_barangs_table', 1),
(4, '2019_03_25_073626_create_suppliers_table', 1),
(5, '2019_03_25_074308_create_konsumens_table', 1),
(6, '2019_03_25_075443_create_karyawans_table', 1),
(8, '2019_03_25_083209_create_belis_table', 1),
(9, '2019_03_25_083406_create_detailbelis_table', 1),
(10, '2019_03_25_085452_create_juals_table', 1),
(11, '2019_03_25_085907_create_detailjuals_table', 1),
(12, '2019_03_25_090158_create_proses_table', 1),
(13, '2019_03_25_090304_create_detailproses_table', 1),
(14, '2019_05_15_042707_create_currencies_table', 2),
(15, '2019_05_15_043531_create_penggajians_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penggajians`
--

CREATE TABLE `penggajians` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `gajiPokok` int(11) NOT NULL,
  `gajiTambahan` int(11) NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id` int(10) UNSIGNED NOT NULL,
  `tglProses` date NOT NULL,
  `jenisProses` tinyint(2) NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id`, `tglProses`, `jenisProses`, `id_karyawan`, `id_supplier`, `status`, `created_at`, `updated_at`) VALUES
(9, '2019-08-27', 0, 1, 1, 1, '2019-08-27 06:08:22', '2019-08-27 06:10:07'),
(10, '2019-08-27', 0, 1, 1, 1, '2019-08-27 06:12:35', '2019-08-27 06:22:41'),
(11, '2019-08-28', 0, 1, 5, 0, '2019-08-27 19:58:46', '2019-08-27 19:58:46'),
(12, '2019-09-17', 0, 1, 2, 0, '2019-09-16 22:10:56', '2019-09-16 22:10:56'),
(13, '2019-09-21', 0, 1, 4, 0, '2019-09-21 01:39:27', '2019-09-21 01:39:27'),
(14, '2019-09-21', 0, 1, 1, 0, '2019-09-21 01:42:13', '2019-09-21 01:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `namaSupplier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noTelp` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `namaSupplier`, `alamat`, `noTelp`, `created_at`, `updated_at`) VALUES
(1, 'Maria', 'Ghhh', '29292', '2019-05-15 23:55:07', '2019-05-15 23:55:07'),
(2, 'Wijaya', 'jkt', '087896756235', '2019-07-04 04:01:36', '2019-07-04 04:01:45'),
(3, 'Ziyad', 'Ubaya', '081203939121', '2019-07-24 02:33:42', '2019-07-24 02:33:42'),
(4, 'Ijang', 'bangil', '087829933312', '2019-08-22 06:44:43', '2019-08-22 06:44:43'),
(5, 'Hamid', 'Tenggilis', '082222333444', '2019-08-27 19:58:22', '2019-08-27 19:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaKaryawan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `namaKaryawan`, `jabatan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'apungnest@gmail.com', '$2y$10$MMBKpn37.KWVjuYd3F35YukTaO3mAAQjEAk4YJVwkfz2oQTicT.lm', 'Apung', '1', 'FbmX8nZ7DsNvQ2xEa9exm4coIo8xwM1jcBS2kV0T6x4Nme8bThPRiUlJMaAP', '2019-05-14 22:15:48', '2019-06-25 05:39:56'),
(2, 'adielah@gmail.com', '$2y$10$WwxJPvV633arxmnl6ud/xuqnWCxk1WQs1JudmpRO.gB5csMdPNUzi', 'Adielah', '2', 'H2nvQCD21qLayxMznQ1B0QU4ZgYDmcfA1uOohYhc6kotQqugu1mt9tKspLqc', '2019-05-18 08:00:50', '2019-06-25 05:36:27'),
(4, 'kkk@gmail.com', '$2y$10$kcQXuh6Suq9c6jYIiyZ6PeThr/iSFMW5fe0Vg4o5B96fbR4mLb72m', 'kakak', '3', NULL, '2019-05-18 08:22:09', '2019-06-25 05:40:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `belis`
--
ALTER TABLE `belis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `belis_id_supplier_foreign` (`id_supplier`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailbelis`
--
ALTER TABLE `detailbelis`
  ADD KEY `detailbelis_id_barang_foreign` (`id_barang`),
  ADD KEY `detailbelis_id_beli_foreign` (`id_beli`);

--
-- Indexes for table `detailjuals`
--
ALTER TABLE `detailjuals`
  ADD KEY `detailjuals_id_barang_foreign` (`id_barang`),
  ADD KEY `detailjuals_id_jual_foreign` (`id_jual`);

--
-- Indexes for table `detailproses`
--
ALTER TABLE `detailproses`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `detailproses_id_proses_foreign` (`id_proses`),
  ADD KEY `detailproses_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `juals`
--
ALTER TABLE `juals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `juals_id_konsumen_foreign` (`id_konsumen`),
  ADD KEY `id_currencies` (`id_currencies`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `konsumens`
--
ALTER TABLE `konsumens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penggajians`
--
ALTER TABLE `penggajians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `belis`
--
ALTER TABLE `belis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailproses`
--
ALTER TABLE `detailproses`
  MODIFY `iddetail` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `juals`
--
ALTER TABLE `juals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsumens`
--
ALTER TABLE `konsumens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penggajians`
--
ALTER TABLE `penggajians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `belis`
--
ALTER TABLE `belis`
  ADD CONSTRAINT `belis_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `belis_id_supplier_foreign` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `detailbelis`
--
ALTER TABLE `detailbelis`
  ADD CONSTRAINT `detailbelis_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `detailbelis_id_beli_foreign` FOREIGN KEY (`id_beli`) REFERENCES `belis` (`id`);

--
-- Constraints for table `detailjuals`
--
ALTER TABLE `detailjuals`
  ADD CONSTRAINT `detailjuals_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `detailjuals_id_jual_foreign` FOREIGN KEY (`id_jual`) REFERENCES `juals` (`id`);

--
-- Constraints for table `detailproses`
--
ALTER TABLE `detailproses`
  ADD CONSTRAINT `detailproses_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `detailproses_id_proses_foreign` FOREIGN KEY (`id_proses`) REFERENCES `proses` (`id`);

--
-- Constraints for table `juals`
--
ALTER TABLE `juals`
  ADD CONSTRAINT `juals_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `juals_id_currencies_foreign` FOREIGN KEY (`id_currencies`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `juals_id_konsumen_foreign` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumens` (`id`);

--
-- Constraints for table `penggajians`
--
ALTER TABLE `penggajians`
  ADD CONSTRAINT `penggajians_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `users` (`id`);

--
-- Constraints for table `proses`
--
ALTER TABLE `proses`
  ADD CONSTRAINT `proses_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
