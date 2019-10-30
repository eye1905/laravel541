-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2019 at 02:37 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

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
  `harga` double NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `namaBarang`, `stok`, `satuan`, `harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kaki', 106.7, 'Kg', 10000, 1, '2019-06-25 05:41:05', '2019-10-30 02:46:35'),
(2, 'Mangkok A', 24.5, 'Kg', 8000, 1, '2019-07-04 03:59:18', '2019-10-30 02:46:35'),
(3, 'Raw', 39, 'Kg', 90, 1, '2019-07-10 03:43:18', '2019-10-30 02:46:35'),
(4, 'Kaki Basah', 13.4, 'Kg', 50000, 1, '2019-10-24 02:46:22', '2019-10-30 02:46:35');

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
(37, 'B000037', '2019-10-30', 1, 1, '1', '2019-10-30 02:45:32', '2019-10-30 02:46:35');

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
(1, 37, '3.5', 1000, 3500, 0, '2019-10-30 02:45:32', '2019-10-30 02:46:21'),
(2, 37, '2', 10000, 20000, 0, '2019-10-30 02:45:32', '2019-10-30 02:46:29'),
(3, 37, '10', 0, 0, 0, '2019-10-30 02:45:32', '2019-10-30 02:45:32'),
(4, 37, '4.4', 20000, 88000, 0, '2019-10-30 02:45:32', '2019-10-30 02:46:33');

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
(4, 2, 4, 10000, '2019-10-30 03:01:51', '2019-10-30 03:10:03'),
(1, 2, 10, 10000, '2019-10-30 03:10:51', '2019-10-30 03:10:51'),
(4, 1, 60, 65000, '2019-10-30 03:58:25', '2019-10-30 03:58:35'),
(2, 1, 20, 10400, '2019-10-30 03:58:45', '2019-10-30 03:58:45');

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
(15, 33, 3, 10, 5, '2019-10-30 02:42:41', '2019-10-30 02:43:16'),
(17, 33, 3, 5.5, 7, '2019-10-30 02:43:10', '2019-10-30 02:43:57'),
(18, 33, 3, 4.5, 7, '2019-10-30 02:43:16', '2019-10-30 02:44:13'),
(20, 33, 1, 3.5, 8, '2019-10-30 02:43:49', '2019-10-30 02:44:53'),
(21, 33, 2, 2, 8, '2019-10-30 02:43:57', '2019-10-30 02:45:00'),
(22, 33, 4, 4.5, 8, '2019-10-30 02:44:13', '2019-10-30 02:45:13'),
(23, 33, 1, 3.4, 8, '2019-10-30 02:44:44', '2019-10-30 02:45:17'),
(24, 33, 1, 0.1, 4, '2019-10-30 02:44:53', '2019-10-30 02:44:53'),
(25, 33, 2, 2, 4, '2019-10-30 02:45:00', '2019-10-30 02:45:00'),
(26, 33, 4, 2.3, 8, '2019-10-30 02:45:08', '2019-10-30 02:45:22'),
(27, 33, 4, 2.2, 4, '2019-10-30 02:45:13', '2019-10-30 02:45:13'),
(28, 33, 1, 3.4, 4, '2019-10-30 02:45:17', '2019-10-30 02:45:17'),
(29, 33, 4, 2.2, 4, '2019-10-30 02:45:22', '2019-10-30 02:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `history_pengeringans`
--

CREATE TABLE `history_pengeringans` (
  `iddetail` int(20) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_pengeringans`
--

INSERT INTO `history_pengeringans` (`iddetail`, `jumlah`, `created_at`, `updated_at`) VALUES
(20, 3.4, '2019-10-30 09:44:44', '2019-10-30 09:44:44'),
(22, 2.3, '2019-10-30 09:45:08', '2019-10-30 09:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `history_sortirs`
--

CREATE TABLE `history_sortirs` (
  `iddetail` int(20) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_sortirs`
--

INSERT INTO `history_sortirs` (`iddetail`, `jumlah`, `created_at`, `updated_at`) VALUES
(17, 3.5, '2019-10-30 09:43:49', '2019-10-30 09:43:49'),
(17, 2, '2019-10-30 09:43:57', '2019-10-30 09:43:57'),
(18, 4.5, '2019-10-30 09:44:13', '2019-10-30 09:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `hystoriraw`
--

CREATE TABLE `hystoriraw` (
  `iddetail` int(20) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hystoriraw`
--

INSERT INTO `hystoriraw` (`iddetail`, `jumlah`, `created_at`, `updated_at`) VALUES
(15, 0, '2019-10-30 09:43:10', '2019-10-30 09:43:16'),
(17, 0, '2019-10-30 09:43:49', '2019-10-30 09:43:57'),
(18, 0, '2019-10-30 09:44:13', '2019-10-30 09:44:13'),
(20, 0.1, '2019-10-30 09:44:44', '2019-10-30 09:44:44'),
(20, 3.4, '2019-10-30 09:44:53', '2019-10-30 09:44:53'),
(21, 0, '2019-10-30 09:45:00', '2019-10-30 09:45:00'),
(22, 0, '2019-10-30 09:45:08', '2019-10-30 09:45:13'),
(23, 0, '2019-10-30 09:45:17', '2019-10-30 09:45:17'),
(26, 0.1, '2019-10-30 09:45:22', '2019-10-30 09:45:22');

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
  `total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusBayar` tinyint(2) NOT NULL,
  `kurs` double DEFAULT NULL,
  `id_currencies` int(10) UNSIGNED DEFAULT NULL,
  `id_konsumen` int(10) UNSIGNED NOT NULL,
  `id_karyawan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `juals`
--

INSERT INTO `juals` (`id`, `noNotaJual`, `tglKirim`, `noResi`, `tglPesan`, `tglTerima`, `total`, `statusBayar`, `kurs`, `id_currencies`, `id_konsumen`, `id_karyawan`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, '2019-10-26', NULL, NULL, 0, NULL, NULL, 2, 1, '2019-10-25 22:25:51', '2019-10-30 03:52:04'),
(2, NULL, NULL, NULL, '2019-10-30', NULL, NULL, 0, NULL, NULL, 2, 1, '2019-10-30 02:46:52', '2019-10-30 02:46:52');

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
(14, '2019_05_15_042707_create_currencies_table', 2);

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
(33, '2019-10-30', 0, 1, 1, 1, '2019-10-30 02:42:37', '2019-10-30 02:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(11) NOT NULL,
  `persen` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id_setting`, `persen`, `created_at`, `updated_at`) VALUES
(1, 30, '2019-10-30 10:15:00', '2019-10-30 10:21:51');

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
(1, 'Maria', 'Ghhh', '29292', '343243234324322', '2019-05-15 23:55:07', '2019-10-20 23:50:39'),
(2, 'Wijaya', 'jkt', '087896756235', '', '2019-07-04 04:01:36', '2019-07-04 04:01:45'),
(3, 'Ziyad', 'Ubaya', '081203939121', '323432432432', '2019-07-24 02:33:42', '2019-10-21 01:51:20'),
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
(1, 'apungnest@gmail.com', '$2y$10$MMBKpn37.KWVjuYd3F35YukTaO3mAAQjEAk4YJVwkfz2oQTicT.lm', 'Apung', '1', 'FbmX8nZ7DsNvQ2xEa9exm4coIo8xwM1jcBS2kV0T6x4Nme8bThPRiUlJMaAP', '2019-05-14 22:15:48', '2019-06-25 05:39:56'),
(2, 'adielah@gmail.com', '$2y$10$SUacu7lpwcJ41uUkOOo56u5Vec6o77KRm7iQHvykmirTKivMWsXSy', 'Adielah', '2', 'avIQc2ph5SJyZgEUcnDHf5dMYr8TNJMtamx8eU7SUgqRqTxQoKm8pnWMrfnk', '2019-05-18 08:00:50', '2019-06-25 05:36:27'),
(4, 'kkk@gmail.com', '$2y$10$SUacu7lpwcJ41uUkOOo56u5Vec6o77KRm7iQHvykmirTKivMWsXSy', 'kakak', '3', 'pCqFeG2GoCd9lZQBvPbt4kuKBhDv5tedJ21xOPFCRl07YYarDatu2DseDx2b', '2019-05-18 08:22:09', '2019-06-25 05:40:02'),
(5, 'mardi@gmail.com', '$2y$10$TY0l6RKi7EhLV6XnfFm5U.QkWcb7lipFYYpmi2kKSmDJdMLvh0oxu', 'mardi', '3', 'ldPARXOHW6PeLEn0CwtMDltDpFTDI7xuI0J5D6zP4MWOdKBfFicRATaHsDc8', '2019-10-24 02:09:10', '2019-10-24 02:09:10');

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
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_karyawan` (`id_karyawan`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailproses`
--
ALTER TABLE `detailproses`
  MODIFY `iddetail` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `juals`
--
ALTER TABLE `juals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konsumens`
--
ALTER TABLE `konsumens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `proses`
--
ALTER TABLE `proses`
  ADD CONSTRAINT `proses_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
