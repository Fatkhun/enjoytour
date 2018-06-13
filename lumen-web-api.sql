-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 04:36 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lumen-web-api`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_pakets`
--

CREATE TABLE `item_pakets` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penginapan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transportasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `makan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tiket` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_pakets`
--

INSERT INTO `item_pakets` (`id`, `admin_id`, `nama`, `deskripsi`, `info`, `penginapan`, `transportasi`, `makan`, `lokasi`, `gambar`, `tiket`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'Taman Nasional Bunaken', 'Taman Nasional Bunaken merupakan tempat wisata yang berada di Teluk Manado - Sulawesi Utara dengan luas sekitar 8,08 km persegi, tempat wisata ini merupakan salah satu bagian dari pemeritahan', 'Info lebih lanjut bisa menghubungi CP : 085732326736', 'Hotel bintang 3', 'Sepeda dan mobil', '3x di rumah makan  manado', 'Teluk Manado, Sulawesi Utara', '986267384.jpg', 60000, 1000000, '2018-06-07 01:16:04', '2018-06-07 01:17:11'),
(2, 2, 'Taman Nasional Bunaken', 'Taman Nasional Bunaken merupakan tempat wisata yang berada di Teluk Manado - Sulawesi Utara dengan luas sekitar 8,08 km persegi, tempat wisata ini merupakan salah satu bagian dari pemeritahan', 'Info lebih lanjut bisa menghubungi CP : 085732326736', 'Hotel bintang 3', 'Sepeda dan mobil', '3x di rumah makan  manado', 'Teluk Manado, Sulawesi Utara', '448086508.jpg', 80000, 2500000, '2018-06-09 07:42:03', '2018-06-10 03:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2018_04_17_033938_create_users_table', 3),
(8, '2018_05_23_075536_create_item_pakets_table', 4),
(12, '2018_06_06_190441_create_users_admin_table', 5),
(13, '2018_05_23_075548_create_rating_pakets_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `rating_pakets`
--

CREATE TABLE `rating_pakets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nama_wisata` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_pakets`
--

INSERT INTO `rating_pakets` (`id`, `user_id`, `nama_wisata`, `nama`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(2, 1, 'Taman Nasional Bunaken', 'Najaa', 4, 'wah, saya sangat enjoy sekali dan banyak pengalaman hebat...', '2018-06-11 00:01:47', '2018-06-11 00:01:47'),
(3, 3, 'Taman Nasional Bunaken', 'Anang', 2, 'banyak pemandangan yang menakjubkan baru kali ini saya berkunjung kesini. thanks enjoytour', '2018-06-11 05:57:46', '2018-06-11 05:57:46'),
(6, 1, 'Taman Nasional Bunaken', 'Cherry', 4, 'Banyak pemandangan indah', '2018-06-12 19:01:14', '2018-06-12 19:01:14'),
(8, 1, 'Taman Nasional Bunaken', 'Cak', 5, 'awesome', '2018-06-12 19:05:53', '2018-06-12 19:05:53'),
(9, 2, 'Taman Nasional Bunaken', 'Budi', 5, 'Wah, sangat mengagumkan, thanks', '2018-06-12 19:07:23', '2018-06-12 19:07:23'),
(10, 4, 'Taman Nasional Bunaken', 'Grak', 5, 'Grak wah', '2018-06-13 01:17:56', '2018-06-13 01:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Cherry', 'c@gmail.com', '$2y$10$VK8m70ZNx31zQmyEk3rJxuOGQyI5Fdkybm4jE9kywJx4H7Ba5WfDW', 'd5ace18e4d1efce220c7c01bc81a257e271d1d9a', '2018-06-05 11:50:49', '2018-06-13 01:18:40'),
(2, 'Budi', 'b@gmail.com', '$2y$10$qieU.tAdOc2ZomFq.CicGOh2TqKYObXAiTmXgMKILq2FDgIDlf692', '137ab55159f3829108becf1d282e102c78ca99f8', '2018-06-07 00:58:02', '2018-06-12 19:06:51'),
(3, 'Anang', 'a@gmail.com', '$2y$10$pDK4nfbyqzspdYN2rK1BEu.0/GZgecxps9D4E2xDrvB5Znr2soJdG', '3692886cacd19466706c81994c7309d51d2a7380', '2018-06-07 01:57:15', '2018-06-11 05:56:17'),
(4, 'Grak', 'g@gmail.com', '$2y$10$12MWSkAGlgN5ThotSPPTi.ttxyyRxBpOHoNQ8W.657ymsjf.pC2XW', '2a2b90bf0da48c0deaf923d8335e434c0e05105c', '2018-06-13 00:40:47', '2018-06-13 02:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `users_admin`
--

CREATE TABLE `users_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_admin`
--

INSERT INTO `users_admin` (`id`, `username`, `email`, `password`, `api_key`, `created_at`, `updated_at`) VALUES
(1, 'Doe', 'd@gmail.com', '$2y$10$0CMq7soEQBa9b3yeh4CYuOrqpCHqiuJHv1QutTyuR2POlWWM6E2CS', '0b8833cdfb19ed63fae5eb185cb14f1bd9b88f50', '2018-06-07 01:41:55', '2018-06-07 01:44:42'),
(2, 'one', 'o@gmail.com', '$2y$10$hNGj9S6oAoBlEj4dKYLuYOoOb86rS3mU35KOrFH1EwxSd0NoAF1Xm', '25740fb115a6fd5f4e6a964df1c214da950a641e', '2018-06-09 07:38:01', '2018-06-09 07:38:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_pakets`
--
ALTER TABLE `item_pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_pakets`
--
ALTER TABLE `rating_pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_admin`
--
ALTER TABLE `users_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_admin_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_pakets`
--
ALTER TABLE `item_pakets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rating_pakets`
--
ALTER TABLE `rating_pakets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_admin`
--
ALTER TABLE `users_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
