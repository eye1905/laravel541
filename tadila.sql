-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 04:31 PM
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
  `harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `namaBarang`, `stok`, `satuan`, `status`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Kaki', 90.4, 'Kg', 1, 15000, '2019-06-25 05:41:05', '2019-11-17 03:34:37'),
(2, 'Mangkok A', 56.900000000000006, 'Kg', 1, 14500, '2019-07-04 03:59:18', '2019-11-26 23:26:39'),
(3, 'Raw', 163.29999999999998, 'Kg', 1, 0, '2019-07-10 03:43:18', '2019-11-26 09:13:00'),
(4, 'Sudut', 26.18, 'Kg', 1, 13000, '2019-10-02 06:45:18', '2019-11-26 23:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `belis`
--

CREATE TABLE `belis` (
  `id` int(10) UNSIGNED NOT NULL,
  `noNotaBeli` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglBeli` date NOT NULL,
  `id_suppliers` int(10) UNSIGNED NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `belis`
--

INSERT INTO `belis` (`id`, `noNotaBeli`, `tglBeli`, `id_suppliers`, `id_users`, `status`, `created_at`, `updated_at`) VALUES
(6, 'B00006', '2019-10-28', 1, 1, '1', '2019-10-27 18:52:18', '2019-11-17 03:34:37'),
(7, 'B00007', '2019-11-13', 1, 1, '1', '2019-11-12 22:53:49', '2019-11-12 22:54:46'),
(8, 'B00008', '2019-11-26', 5, 5, '1', '2019-11-26 09:12:22', '2019-11-26 09:13:00');

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
(1, 1, '2', 5000, 10000, 0, '2019-10-21 06:33:06', '2019-10-21 06:33:33'),
(2, 1, '2', 10000, 20000, 0, '2019-10-21 06:33:06', '2019-10-21 06:33:40'),
(3, 1, '10', 0, 0, 0, '2019-10-21 06:33:06', '2019-10-21 06:33:06'),
(4, 1, '5', 12500, 62500, 0, '2019-10-21 06:33:06', '2019-10-21 06:33:47'),
(3, 2, '4.5', 0, 0, 0, '2019-10-24 03:52:31', '2019-10-24 03:52:31'),
(1, 3, '10.399999999999999', 50000, 520000, 0, '2019-10-26 07:15:17', '2019-10-26 07:15:58'),
(2, 3, '11.5', 20000, 230000, 0, '2019-10-26 07:15:17', '2019-10-26 07:16:12'),
(3, 3, '32.5', 0, 0, 0, '2019-10-26 07:15:17', '2019-10-26 07:15:17'),
(4, 3, '10.1', 15000, 151500, 0, '2019-10-26 07:15:17', '2019-10-26 07:16:20'),
(1, 4, '7.800000000000001', 30000, 234000, 0, '2019-10-27 08:51:06', '2019-10-27 08:51:34'),
(2, 4, '3.3', 40000, 132000, 0, '2019-10-27 08:51:07', '2019-10-27 08:51:40'),
(3, 4, '15.6', 0, 0, 0, '2019-10-27 08:51:07', '2019-10-27 08:51:07'),
(4, 4, '4.4', 10000, 44000, 0, '2019-10-27 08:51:07', '2019-10-27 08:51:45'),
(1, 5, '2.7', 80000, 216000, 0, '2019-10-27 09:49:53', '2019-10-27 09:50:48'),
(2, 5, '6', 60000, 360000, 0, '2019-10-27 09:49:53', '2019-10-27 09:50:54'),
(3, 5, '12.8', 0, 0, 0, '2019-10-27 09:49:53', '2019-10-27 09:49:53'),
(4, 5, '3.9', 80999, 315896, 0, '2019-10-27 09:49:53', '2019-10-27 09:51:00'),
(1, 6, '30.3', 15000, 454500, 0, '2019-10-27 18:52:18', '2019-10-27 18:55:12'),
(2, 6, '19.700000000000003', 13500, 265950, 0, '2019-10-27 18:52:18', '2019-10-27 18:55:22'),
(3, 6, '50.7', 0, 0, 0, '2019-10-27 18:52:18', '2019-10-27 18:52:18'),
(1, 7, '27.1', 25000, 677500, 0, '2019-11-12 22:53:49', '2019-11-12 22:54:14'),
(2, 7, '4.3', 20500, 88150, 0, '2019-11-12 22:53:49', '2019-11-12 22:54:34'),
(3, 7, '23.5', 0, 0, 0, '2019-11-12 22:53:49', '2019-11-12 22:53:49'),
(4, 7, '4.1', 19700, 80770, 0, '2019-11-12 22:53:49', '2019-11-12 22:54:42'),
(2, 8, '7.2', 14500, 104400, 0, '2019-11-26 09:12:22', '2019-11-26 09:12:44'),
(3, 8, '25.6', 0, 0, 0, '2019-11-26 09:12:22', '2019-11-26 09:12:22'),
(4, 8, '18.18', 13800, 250884, 0, '2019-11-26 09:12:22', '2019-11-26 09:12:56');

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

--
-- Dumping data for table `detailjuals`
--

INSERT INTO `detailjuals` (`id_barang`, `id_jual`, `beratJual`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 18.3, 17253, '2019-11-12 23:16:12', '2019-11-26 10:57:45'),
(2, 1, 3.4, 15525, '2019-11-12 23:16:18', '2019-11-12 23:16:18'),
(4, 1, 6.1, 6900, '2019-11-12 23:16:26', '2019-11-12 23:16:26'),
(2, 3, 7.800000000000001, 15525, '2019-11-16 05:42:22', '2019-11-16 05:42:22'),
(1, 5, 12, 18000, '2019-11-16 21:57:06', '2019-11-16 21:57:17'),
(1, 6, 10, 18500, '2019-11-17 03:33:19', '2019-11-17 03:34:23'),
(1, 9, 10, 17250, '2019-11-17 07:43:47', '2019-11-17 07:43:47');

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
(1, 1, 3, 50.7, 5, '2019-10-27 18:47:25', '2019-10-27 18:50:44'),
(2, 1, 3, 40.6, 7, '2019-10-27 18:47:42', '2019-10-27 18:50:53'),
(3, 1, 1, 30.7, 8, '2019-10-27 18:48:03', '2019-10-27 18:51:42'),
(4, 1, 1, 23.6, 8, '2019-10-27 18:49:00', '2019-10-27 18:49:16'),
(5, 1, 1, 23.5, 4, '2019-10-27 18:49:16', '2019-10-27 18:49:16'),
(6, 1, 3, 10.1, 7, '2019-10-27 18:50:44', '2019-10-27 18:51:07'),
(7, 1, 2, 9.9, 8, '2019-10-27 18:50:53', '2019-10-27 18:51:54'),
(8, 1, 2, 10.1, 8, '2019-10-27 18:51:07', '2019-10-27 18:52:02'),
(9, 1, 1, 7.1, 8, '2019-10-27 18:51:42', '2019-10-27 18:52:13'),
(10, 1, 2, 9.8, 4, '2019-10-27 18:51:54', '2019-10-27 18:51:54'),
(11, 1, 2, 9.9, 4, '2019-10-27 18:52:02', '2019-10-27 18:52:02'),
(12, 1, 1, 6.8, 4, '2019-10-27 18:52:13', '2019-10-27 18:52:13'),
(13, 2, 3, 23.5, 5, '2019-11-12 22:38:31', '2019-11-12 22:40:21'),
(14, 2, 1, 12.2, 8, '2019-11-12 22:39:04', '2019-11-12 22:39:35'),
(15, 2, 3, 12.4, 7, '2019-11-12 22:39:13', '2019-11-12 22:40:15'),
(16, 2, 1, 6.5, 8, '2019-11-12 22:39:27', '2019-11-12 22:39:44'),
(17, 2, 1, 5.7, 4, '2019-11-12 22:39:35', '2019-11-12 22:39:35'),
(18, 2, 1, 6.3, 4, '2019-11-12 22:39:44', '2019-11-12 22:39:44'),
(19, 2, 1, 4, 8, '2019-11-12 22:39:55', '2019-11-12 22:41:40'),
(20, 2, 2, 4.3, 8, '2019-11-12 22:40:07', '2019-11-12 22:41:54'),
(21, 2, 4, 4.1, 8, '2019-11-12 22:40:15', '2019-11-12 22:42:10'),
(22, 2, 3, 11.1, 7, '2019-11-12 22:40:21', '2019-11-12 22:42:30'),
(23, 2, 1, 10.3, 8, '2019-11-12 22:40:34', '2019-11-12 22:42:16'),
(24, 2, 1, 0.7, 8, '2019-11-12 22:41:24', '2019-11-12 22:42:25'),
(25, 2, 1, 4, 4, '2019-11-12 22:41:40', '2019-11-12 22:41:40'),
(26, 2, 2, 4.3, 4, '2019-11-12 22:41:54', '2019-11-12 22:41:54'),
(27, 2, 4, 4.1, 4, '2019-11-12 22:42:10', '2019-11-12 22:42:10'),
(28, 2, 1, 10.3, 4, '2019-11-12 22:42:16', '2019-11-12 22:42:16'),
(29, 2, 1, 0.7, 4, '2019-11-12 22:42:25', '2019-11-12 22:42:25'),
(30, 2, 1, 0.1, 8, '2019-11-12 22:42:30', '2019-11-12 22:42:38'),
(31, 2, 1, 0.1, 4, '2019-11-12 22:42:38', '2019-11-12 22:42:38'),
(32, 3, 3, 25.6, 5, '2019-11-26 09:03:40', '2019-11-26 09:11:35'),
(33, 3, 3, 16.7, 7, '2019-11-26 09:04:03', '2019-11-26 09:05:09'),
(34, 3, 4, 9.4, 8, '2019-11-26 09:05:01', '2019-11-26 09:10:45'),
(35, 3, 2, 7.3, 8, '2019-11-26 09:05:09', '2019-11-26 09:10:58'),
(36, 3, 4, 6.4, 8, '2019-11-26 09:09:53', '2019-11-26 09:10:22'),
(37, 3, 4, 6.38, 4, '2019-11-26 09:10:22', '2019-11-26 09:10:22'),
(38, 3, 4, 3, 4, '2019-11-26 09:10:45', '2019-11-26 09:10:45'),
(39, 3, 2, 7.3, 8, '2019-11-26 09:10:58', '2019-11-26 09:11:26'),
(40, 3, 2, 7.2, 4, '2019-11-26 09:11:26', '2019-11-26 09:11:26'),
(41, 3, 3, 8.9, 7, '2019-11-26 09:11:35', '2019-11-26 09:11:46'),
(42, 3, 4, 8.9, 8, '2019-11-26 09:11:46', '2019-11-26 09:11:57'),
(43, 3, 4, 8.8, 4, '2019-11-26 09:11:57', '2019-11-26 09:11:57'),
(44, 4, 3, 23.4, 0, '2019-11-27 00:23:24', '2019-11-27 00:23:24'),
(45, 4, 1, 12.5, 0, '2019-11-27 00:23:34', '2019-11-27 00:23:34'),
(46, 4, 3, 15.3, 1, '2019-11-27 00:23:58', '2019-11-27 00:23:58'),
(47, 4, 1, 6.7, 8, '2019-11-27 00:24:15', '2019-11-27 00:27:06'),
(48, 4, 2, 8, 2, '2019-11-27 00:24:29', '2019-11-27 00:24:29'),
(49, 4, 4, 0.5, 2, '2019-11-27 00:26:06', '2019-11-27 00:26:06'),
(50, 4, 1, 0.1, 2, '2019-11-27 00:26:14', '2019-11-27 00:26:14'),
(51, 4, 1, 3.6, 8, '2019-11-27 00:26:59', '2019-11-27 00:27:30'),
(52, 4, 1, 3.1, 4, '2019-11-27 00:27:06', '2019-11-27 00:27:06'),
(53, 4, 1, 3.4, 4, '2019-11-27 00:27:30', '2019-11-27 00:27:30'),
(54, 4, 3, 8, 1, '2019-11-27 00:42:40', '2019-11-27 00:42:40'),
(55, 4, 3, 0, 1, '2019-11-27 00:43:24', '2019-11-27 00:43:24'),
(56, 4, 3, 0.09, 1, '2019-11-27 00:56:51', '2019-11-27 00:56:51'),
(57, 5, 3, 23.5, 0, '2019-11-27 00:58:47', '2019-11-27 00:58:47'),
(58, 5, 3, 23.4, 1, '2019-11-27 00:58:53', '2019-11-27 00:58:53'),
(59, 6, 3, 10, 0, '2019-11-28 06:47:01', '2019-11-28 06:47:01'),
(60, 6, 3, 4.3, 1, '2019-11-28 06:47:09', '2019-11-28 06:47:09'),
(61, 6, 1, 20, 0, '2019-11-28 06:47:29', '2019-11-28 06:47:29'),
(62, 6, 1, 13.5, 3, '2019-11-28 06:47:36', '2019-11-28 06:47:36'),
(63, 6, 3, 2.1, 1, '2019-11-28 06:48:10', '2019-11-28 06:48:10'),
(64, 8, 3, 12.3, 0, '2019-11-28 08:20:24', '2019-11-28 08:20:24'),
(65, 8, 3, 3.6, 1, '2019-11-28 08:20:33', '2019-11-28 08:20:33'),
(66, 9, 3, 23.5, 0, '2019-11-28 08:21:02', '2019-11-28 08:21:02'),
(67, 9, 1, 13.4, 0, '2019-11-28 08:21:10', '2019-11-28 08:21:10'),
(68, 9, 3, 3.4, 1, '2019-11-28 08:21:15', '2019-11-28 08:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `history_pengeringans`
--

CREATE TABLE `history_pengeringans` (
  `iddetail` int(20) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_pengeringans`
--

INSERT INTO `history_pengeringans` (`iddetail`, `jumlah`, `created_at`, `updated_at`) VALUES
(3, 23.6, '2019-10-27 18:49:00', '2019-10-27 18:49:00'),
(3, 7.1, '2019-10-27 18:51:42', '2019-10-27 18:51:42'),
(14, 6.5, '2019-11-12 22:39:27', '2019-11-12 22:39:27'),
(34, 6.4, '2019-11-26 09:09:53', '2019-11-26 09:09:53'),
(35, 7.3, '2019-11-26 09:10:58', '2019-11-26 09:10:58'),
(47, 3.6, '2019-11-27 00:26:59', '2019-11-27 00:26:59'),
(61, 13.5, '2019-11-28 06:47:36', '2019-11-28 06:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `history_sortirs`
--

CREATE TABLE `history_sortirs` (
  `iddetail` int(20) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_sortirs`
--

INSERT INTO `history_sortirs` (`iddetail`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, 30.7, '2019-10-27 18:48:03', '2019-10-27 18:48:03'),
(2, 9.9, '2019-10-27 18:50:53', '2019-10-27 18:50:53'),
(6, 10.1, '2019-10-27 18:51:07', '2019-10-27 18:51:07'),
(15, 4, '2019-11-12 22:39:55', '2019-11-12 22:39:55'),
(15, 4.3, '2019-11-12 22:40:07', '2019-11-12 22:40:07'),
(15, 4.1, '2019-11-12 22:40:15', '2019-11-12 22:40:15'),
(22, 10.3, '2019-11-12 22:40:35', '2019-11-12 22:40:35'),
(22, 0.7, '2019-11-12 22:41:24', '2019-11-12 22:41:24'),
(22, 0.1, '2019-11-12 22:42:30', '2019-11-12 22:42:30'),
(33, 9.4, '2019-11-26 09:05:01', '2019-11-26 09:05:01'),
(33, 7.3, '2019-11-26 09:05:09', '2019-11-26 09:05:09'),
(41, 8.9, '2019-11-26 09:11:46', '2019-11-26 09:11:46'),
(46, 6.7, '2019-11-27 00:24:15', '2019-11-27 00:24:15'),
(46, 8, '2019-11-27 00:24:29', '2019-11-27 00:24:29'),
(46, 0.5, '2019-11-27 00:26:07', '2019-11-27 00:26:07'),
(46, 0.1, '2019-11-27 00:26:14', '2019-11-27 00:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `hystoriraw`
--

CREATE TABLE `hystoriraw` (
  `iddetail` int(200) NOT NULL,
  `jumlah` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hystoriraw`
--

INSERT INTO `hystoriraw` (`iddetail`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 0, '2019-10-27 18:47:42', '2019-10-27 18:50:44'),
(2, 0, '2019-10-27 18:48:03', '2019-10-27 18:50:53'),
(3, 0, '2019-10-27 18:49:00', '2019-10-27 18:51:42'),
(4, 0.1, '2019-10-27 18:49:16', '2019-10-27 18:49:16'),
(6, 0, '2019-10-27 18:51:07', '2019-10-27 18:51:07'),
(7, 0.1, '2019-10-27 18:51:54', '2019-10-27 18:51:54'),
(8, 0.2, '2019-10-27 18:52:02', '2019-10-27 18:52:02'),
(9, 0.3, '2019-10-27 18:52:13', '2019-10-27 18:52:13'),
(13, 0, '2019-11-12 22:39:13', '2019-11-12 22:40:21'),
(14, 0, '2019-11-12 22:39:27', '2019-11-12 22:39:35'),
(16, 0.2, '2019-11-12 22:39:45', '2019-11-12 22:39:45'),
(15, 0, '2019-11-12 22:39:55', '2019-11-12 22:40:15'),
(22, 0, '2019-11-12 22:40:34', '2019-11-12 22:42:30'),
(19, 0, '2019-11-12 22:41:40', '2019-11-12 22:41:40'),
(20, 0, '2019-11-12 22:41:54', '2019-11-12 22:41:54'),
(21, 0, '2019-11-12 22:42:10', '2019-11-12 22:42:10'),
(23, 0, '2019-11-12 22:42:16', '2019-11-12 22:42:16'),
(24, 0, '2019-11-12 22:42:25', '2019-11-12 22:42:25'),
(30, 0, '2019-11-12 22:42:39', '2019-11-12 22:42:39'),
(32, 0, '2019-11-26 09:04:03', '2019-11-26 09:11:35'),
(33, 0, '2019-11-26 09:05:01', '2019-11-26 09:05:09'),
(34, 0, '2019-11-26 09:09:53', '2019-11-26 09:10:45'),
(36, 0, '2019-11-26 09:10:22', '2019-11-26 09:10:22'),
(35, 0, '2019-11-26 09:10:58', '2019-11-26 09:10:58'),
(39, 0.1, '2019-11-26 09:11:26', '2019-11-26 09:11:26'),
(41, 0, '2019-11-26 09:11:46', '2019-11-26 09:11:46'),
(42, 0.1, '2019-11-26 09:11:57', '2019-11-26 09:11:57'),
(44, 0, '2019-11-27 00:23:58', '2019-11-27 00:56:51'),
(46, 0, '2019-11-27 00:24:15', '2019-11-27 00:26:14'),
(47, 0, '2019-11-27 00:26:59', '2019-11-27 00:27:06'),
(51, 0.2, '2019-11-27 00:27:30', '2019-11-27 00:27:30'),
(57, 0.1, '2019-11-27 00:58:53', '2019-11-27 00:58:53'),
(59, 3.6, '2019-11-28 06:47:09', '2019-11-28 06:48:10'),
(61, 6.5, '2019-11-28 06:47:36', '2019-11-28 06:47:36'),
(64, 8.7, '2019-11-28 08:20:33', '2019-11-28 08:20:33'),
(66, 20.1, '2019-11-28 08:21:15', '2019-11-28 08:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `juals`
--

CREATE TABLE `juals` (
  `id` int(10) UNSIGNED NOT NULL,
  `noNotaJual` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglKirim` date DEFAULT NULL,
  `noResi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglPesan` date NOT NULL,
  `tglTerima` date DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusBayar` tinyint(2) NOT NULL,
  `id_konsumen` int(10) UNSIGNED NOT NULL,
  `id_users` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `juals`
--

INSERT INTO `juals` (`id`, `noNotaJual`, `tglKirim`, `noResi`, `tglPesan`, `tglTerima`, `diskon`, `total`, `statusBayar`, `id_konsumen`, `id_users`, `created_at`, `updated_at`) VALUES
(1, 'J00001', NULL, NULL, '2019-11-13', NULL, NULL, '410604.9', 0, 2, 1, '2019-11-12 23:16:00', '2019-11-26 10:57:45'),
(2, 'J00002', NULL, NULL, '2019-11-13', NULL, NULL, NULL, 0, 2, 1, '2019-11-12 23:19:58', '2019-11-12 23:19:58'),
(3, 'J00003', NULL, NULL, '2019-11-16', NULL, NULL, NULL, 0, 2, 2, '2019-11-16 05:41:03', '2019-11-16 05:41:03'),
(4, 'J00004', '2019-11-18', '001', '2019-11-17', '2019-11-18', NULL, NULL, 0, 2, 2, '2019-11-16 21:29:53', '2019-11-16 21:29:54'),
(5, 'J00005', '2019-11-18', '002', '2019-11-17', '2019-11-18', NULL, '216000', 0, 2, 2, '2019-11-16 21:56:59', '2019-11-16 21:57:17'),
(6, 'J00006', '2019-11-18', '003', '2019-11-18', '2019-11-18', NULL, '185000', 0, 2, 2, '2019-11-17 03:33:08', '2019-11-17 03:34:23'),
(7, 'J00007', '2019-11-10', '999', '2019-11-10', '2019-11-18', NULL, NULL, 1, 2, 2, '2019-11-17 03:40:23', '2019-11-17 03:59:14'),
(8, 'J00008', '2019-11-07', '123', '2019-11-14', '2019-11-12', NULL, NULL, 0, 2, 2, '2019-11-17 05:21:31', '2019-11-17 05:21:32'),
(9, 'J00009', '2019-11-30', '2019001', '2019-11-29', '2019-11-30', NULL, '172500', 0, 2, 2, '2019-11-17 07:42:27', '2019-11-17 07:43:48');

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
(15, '2019_05_15_043531_create_penggajians_table', 3),
(16, '2019_10_10_185816_create_historysortir_table', 4),
(17, '2019_10_10_193155_create_historypengeringan_table', 4),
(18, '2019_10_21_064447_alterSupplier', 5),
(19, '2019_10_22_124716_hystori_raw', 6);

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
  `id_users` int(10) UNSIGNED NOT NULL,
  `id_suppliers` int(10) UNSIGNED NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id`, `tglProses`, `id_users`, `id_suppliers`, `status`, `created_at`, `updated_at`) VALUES
(1, '2019-10-28', 1, 1, 1, '2019-10-27 18:47:16', '2019-10-27 18:52:18'),
(2, '2019-11-13', 1, 1, 1, '2019-11-12 22:38:23', '2019-11-12 22:53:49'),
(3, '2019-11-26', 5, 5, 1, '2019-11-26 09:03:26', '2019-11-26 09:12:22'),
(4, '2019-11-27', 1, 5, 0, '2019-11-27 00:23:15', '2019-11-27 00:23:15'),
(5, '2019-11-27', 1, 4, 0, '2019-11-27 00:58:32', '2019-11-27 00:58:32'),
(6, '2019-11-28', 1, 5, 0, '2019-11-28 06:46:53', '2019-11-28 06:46:53'),
(7, '2019-11-28', 1, 3, 0, '2019-11-28 07:44:40', '2019-11-28 07:44:40'),
(8, '2019-11-28', 6, 4, 0, '2019-11-28 07:59:52', '2019-11-28 07:59:52'),
(9, '2019-11-28', 6, 3, 0, '2019-11-28 08:20:56', '2019-11-28 08:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(5) NOT NULL,
  `persen` double NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id_setting`, `persen`, `updated_at`, `created_at`) VALUES
(1, 15, '2019-10-14', '2019-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `namaSupplier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noTelp` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noRekening` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `namaSupplier`, `alamat`, `noTelp`, `noRekening`, `created_at`, `updated_at`) VALUES
(1, 'Maria', 'Surabaya', '081739282734', '71181772891', '2019-05-15 23:55:07', '2019-10-21 23:31:50'),
(2, 'Wijaya', 'jkt', '087896756235', '', '2019-07-04 04:01:36', '2019-07-04 04:01:45'),
(3, 'Ziyad', 'Ubaya', '081203939121', '', '2019-07-24 02:33:42', '2019-07-24 02:33:42'),
(4, 'Ijang', 'bangil', '087829933312', '', '2019-08-22 06:44:43', '2019-08-22 06:44:43'),
(5, 'Hamid', 'Tenggilis', '082222333444', '', '2019-08-27 19:58:22', '2019-08-27 19:58:22');

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
(1, 'apungnest@gmail.com', '$2y$10$MMBKpn37.KWVjuYd3F35YukTaO3mAAQjEAk4YJVwkfz2oQTicT.lm', 'Apung', '1', 'H5EiwvBp21oWTyKXvHIH7ee4KvbBzBynSkzOhyaFycRWqC9xE6zGMaha8jGb', '2019-05-14 22:15:48', '2019-06-25 05:39:56'),
(2, 'adielah@gmail.com', '$2y$10$WwxJPvV633arxmnl6ud/xuqnWCxk1WQs1JudmpRO.gB5csMdPNUzi', 'Adielah', '2', 'H2nvQCD21qLayxMznQ1B0QU4ZgYDmcfA1uOohYhc6kotQqugu1mt9tKspLqc', '2019-05-18 08:00:50', '2019-06-25 05:36:27'),
(4, 'kkk@gmail.com', '$2y$10$kcQXuh6Suq9c6jYIiyZ6PeThr/iSFMW5fe0Vg4o5B96fbR4mLb72m', 'kakak', '3', NULL, '2019-05-18 08:22:09', '2019-06-25 05:40:02'),
(5, 'saad123@gmail.com', '$2y$10$IvBbDO93UYzfVmer7T9YW.NgIzGr/JpwRc1g7fUZ0j7J9lgeb3wRK', 'Saad', '1', 'xpLydk2hqTt2Pto87QMhf95iOT9mvLjbtHNgDKFjHo3mHuyrFrdrSn3GZTX2', '2019-11-15 00:21:01', '2019-11-15 00:21:01'),
(6, 'abidmehman@gmail.com', '$2y$10$0OTf.IQkYdVu5suBiZGPQOwVpqxsGu9iMIhinclhijS2x.rGarzZS', 'Abid', '3', 'tw2vtj3oAGeUn4nGJkYRvb2mTYWs71U1684hawlxL2Ojc1wrFQPs8ZDm0Sqq', '2019-11-28 07:59:30', '2019-11-28 07:59:30');

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
  ADD KEY `belis_id_supplier_foreign` (`id_suppliers`),
  ADD KEY `belis_ibfk_1` (`id_users`);

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
-- Indexes for table `history_pengeringans`
--
ALTER TABLE `history_pengeringans`
  ADD KEY `fk_history_pengeringans_detailproses1_idx` (`iddetail`);

--
-- Indexes for table `history_sortirs`
--
ALTER TABLE `history_sortirs`
  ADD KEY `fk_history_sortirs_detailproses1_idx` (`iddetail`);

--
-- Indexes for table `hystoriraw`
--
ALTER TABLE `hystoriraw`
  ADD KEY `fk_hystoriraw_detailproses1_idx` (`iddetail`);

--
-- Indexes for table `juals`
--
ALTER TABLE `juals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `juals_id_konsumen_foreign` (`id_konsumen`),
  ADD KEY `juals_ibfk_1` (`id_users`);

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
  ADD KEY `fk_proses_suppliers1_idx` (`id_suppliers`),
  ADD KEY `proses_ibfk_1` (`id_users`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `belis`
--
ALTER TABLE `belis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailproses`
--
ALTER TABLE `detailproses`
  MODIFY `iddetail` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `juals`
--
ALTER TABLE `juals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `konsumens`
--
ALTER TABLE `konsumens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `belis`
--
ALTER TABLE `belis`
  ADD CONSTRAINT `belis_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

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
-- Constraints for table `history_pengeringans`
--
ALTER TABLE `history_pengeringans`
  ADD CONSTRAINT `fk_history_pengeringans_detailproses1` FOREIGN KEY (`iddetail`) REFERENCES `detailproses` (`iddetail`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `history_sortirs`
--
ALTER TABLE `history_sortirs`
  ADD CONSTRAINT `fk_history_sortirs_detailproses1` FOREIGN KEY (`iddetail`) REFERENCES `detailproses` (`iddetail`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hystoriraw`
--
ALTER TABLE `hystoriraw`
  ADD CONSTRAINT `fk_hystoriraw_detailproses1` FOREIGN KEY (`iddetail`) REFERENCES `detailproses` (`iddetail`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `juals`
--
ALTER TABLE `juals`
  ADD CONSTRAINT `juals_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `juals_id_konsumen_foreign` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumens` (`id`);

--
-- Constraints for table `proses`
--
ALTER TABLE `proses`
  ADD CONSTRAINT `fk_proses_suppliers1` FOREIGN KEY (`id_suppliers`) REFERENCES `suppliers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `proses_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
