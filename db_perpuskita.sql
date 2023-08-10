-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 05:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpuskita`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `create` int(11) NOT NULL,
  `read` int(11) NOT NULL,
  `update` int(11) NOT NULL,
  `delete` int(11) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `create`, `read`, `update`, `delete`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, '2023-07-23 00:48:52', '2023-07-23 03:17:08'),
(6, 1, 1, 0, 0, 14, '2023-07-24 03:09:42', '2023-07-24 03:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(191) NOT NULL,
  `deskripsi` varchar(191) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `file` varchar(191) NOT NULL,
  `cover` varchar(191) NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `judul`, `deskripsi`, `jumlah`, `file`, `cover`, `id_kategori`, `id_user`, `created_at`, `updated_at`) VALUES
(17, 'DATA MINING', 'DATA MINING JENJANG AWAL', 100, '1690131803_BUKU DATA MINING.pdf', '1690131803_datamining.jpg', 9, 1, '2023-07-23 17:03:23', '2023-07-23 17:03:23'),
(18, 'EKONOMI DUNIA', 'BUKU TENTANG EKONOMI YANG SEDANG TERJADI', 120, '1690131848_ekonomi.jpg', '1690131848_ekonomi.jpg', 8, 1, '2023-07-23 17:04:08', '2023-07-23 17:04:08'),
(19, 'Sejarah Dunia', 'Buku tentang sejarah di dunia', 230, '1690131891_BUKU SEJARAH DUNIA.pdf', '1690131891_sejarah.jpeg', 6, 1, '2023-07-23 17:04:51', '2023-07-23 17:04:51'),
(23, 'Data Sains', 'buku data sains', 120, '1690168274_BUKU DATA MINING.pdf', '1690168274_datamining.jpg', 1, 14, '2023-07-24 03:11:14', '2023-07-24 03:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Majalah', NULL, '2023-07-20 16:26:46'),
(4, 'Cerita', '2023-07-20 16:24:19', '2023-07-20 16:24:19'),
(5, 'Sains Teknologi', '2023-07-20 16:26:08', '2023-07-20 16:26:08'),
(6, 'Sejarah', '2023-07-20 16:26:25', '2023-07-20 16:26:25'),
(8, 'Ekonomi', '2023-07-23 01:43:50', '2023-07-23 01:43:50'),
(9, 'Pendidikan', '2023-07-23 01:44:04', '2023-07-23 01:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2021_10_09_043359_create_profile_table', 1),
(25, '2023_07_20_222922_create_kategoris_table', 11),
(27, '2023_07_20_223926_create_bukus_table', 12),
(28, '2023_07_20_225307_create_akses_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` enum('Pria','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(60) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `no_telp` varchar(191) DEFAULT NULL,
  `profile_foto` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `umur`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `bio`, `no_telp`, `profile_foto`, `user_id`) VALUES
(1, 18, 'Pria', 'Bogor', '2003-03-29', 'Jln duren', 'Admin Arfiyan', '082246105463', '16900771292141764049.jpg', 1),
(10, 20, NULL, NULL, NULL, NULL, NULL, NULL, 'default.svg', 10),
(12, 50, NULL, NULL, NULL, NULL, NULL, NULL, 'default.svg', 12),
(13, 25, NULL, NULL, NULL, NULL, NULL, NULL, 'default.svg', 13),
(14, 30, NULL, NULL, NULL, NULL, NULL, NULL, 'default.svg', 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$kNuf.i/WD0Ruzi6FUW2xqOoYbgWywa6OTO.uoX12Ysj7Xf1Augnq.', 'Admin', NULL, '2023-01-22 03:47:47', '2023-07-21 02:51:23'),
(10, 'user', 'user', 'user@gmail.com', NULL, '$2y$10$eMTy3B2kOdRwmZd3T8BLTeEa1V8sD6h5HvBZqlJPB3DMGGxn7.wdK', 'user', NULL, '2023-07-23 03:37:41', '2023-07-23 03:37:41'),
(12, 'masppppp', 'masppppp', 'masppppp@gmail.com', NULL, '$2y$10$XU.7ocvjV8yIlyvwcGx1Pe16fK82LMgDUYtinwNPcDBQZ7IwIwY82', 'user', NULL, '2023-07-24 02:19:32', '2023-07-24 02:19:32'),
(13, 'userPian', 'userPian', 'userPian@gmail.com', NULL, '$2y$10$kS3561SwK.aL6N48jdmVW.ObiLfc7lalkUhWjpFX5JZBAZRNG.e6G', 'user', NULL, '2023-07-24 02:52:44', '2023-07-24 02:52:44'),
(14, 'userPratama', 'Pratama', 'userPratama@gmail.com', NULL, '$2y$10$EUMzhfCkgWUh6KnBFncxbOVNgkkURlGK4Ihc0JEH4joTjYeUXn2MC', 'user', NULL, '2023-07-24 03:07:53', '2023-07-24 03:07:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akses_id_user_foreign` (`id_user`);

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bukus_id_kategori_foreign` (`id_kategori`),
  ADD KEY `bukus_id_user_foreign` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `bukus`
--
ALTER TABLE `bukus`
  ADD CONSTRAINT `bukus_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id`),
  ADD CONSTRAINT `bukus_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
