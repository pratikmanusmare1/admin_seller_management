-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 08:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_pune_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_23_122039_add_role_to_users_table', 1),
(6, '2025_06_23_122047_create_skills_table', 1),
(7, '2025_06_23_122052_create_seller_skills_table', 1),
(8, '2025_06_23_122058_create_products_table', 1),
(9, '2025_06_23_122103_create_brands_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'admin-token', 'f42970e1609427d99bfeb7fcb04a6cdf03fc53f8a92e12416199f72eaa83c952', '[\"*\"]', '2025-06-23 20:30:19', NULL, '2025-06-23 19:36:29', '2025-06-23 20:30:19'),
(2, 'App\\Models\\User', 2, 'seller-token', '545379e4dab13a5ae5f1276de6df828cd0bb5c90083f5507ac90118a31ca08d5', '[\"*\"]', NULL, NULL, '2025-06-23 20:11:18', '2025-06-23 20:11:18'),
(3, 'App\\Models\\User', 2, 'seller-token', 'f6eb692400db4f9ca26c939759e674bddc22a339ce64b61577a01ddad6c8c0ae', '[\"*\"]', '2025-06-23 20:50:39', NULL, '2025-06-23 20:34:01', '2025-06-23 20:50:39'),
(4, 'App\\Models\\User', 2, 'seller-token', '0bac7cd58f970fb95e218743720656935b544327592a3e92f885dae7f97dbc46', '[\"*\"]', '2025-06-23 23:32:53', NULL, '2025-06-23 21:02:27', '2025-06-23 23:32:53'),
(5, 'App\\Models\\User', 1, 'admin-token', '0bbdf59f9c63fe8fc43bdbf2dd397168dca1b1187ab407c29160bd461d9c31fb', '[\"*\"]', '2025-06-23 23:26:36', NULL, '2025-06-23 23:05:28', '2025-06-23 23:26:36'),
(6, 'App\\Models\\User', 4, 'seller-token', 'bd4a865d2187c23f2d563596366fc99a0af86932c72d56efbe7b525c5dddfe0a', '[\"*\"]', NULL, NULL, '2025-06-23 23:28:43', '2025-06-23 23:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_skills`
--

CREATE TABLE `seller_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `skill_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seller_skills`
--

INSERT INTO `seller_skills` (`id`, `user_id`, `skill_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 4, 1, NULL, NULL),
(6, 4, 2, NULL, NULL),
(7, 5, 8, NULL, NULL),
(8, 5, 9, NULL, NULL),
(9, 6, 2, NULL, NULL),
(10, 6, 3, NULL, NULL),
(11, 6, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PHP', NULL, '2025-06-23 19:26:24', '2025-06-23 19:26:24'),
(2, 'Laravel', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(3, 'JavaScript', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(4, 'React', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(5, 'Vue.js', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(6, 'MySQL', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(7, 'HTML/CSS', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(8, 'Python', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(9, 'Java', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25'),
(10, 'Node.js', NULL, '2025-06-23 19:26:25', '2025-06-23 19:26:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','seller') NOT NULL DEFAULT 'seller',
  `mobile_no` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `mobile_no`, `country`, `state`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', '1234567890', 'India', 'Maharashtra', NULL, '$2y$12$b0RWK7J58MMOYtLehe0kYuRLSKdQ.YEVHSeEQDirkiuRfQXfOODDm', NULL, '2025-06-23 19:25:43', '2025-06-23 19:25:43'),
(2, 'Seller One', 'seller1@example.com', 'seller', '9876543210', 'India', 'Maharashtra', NULL, '$2y$12$YZm3P0IYwfACXGG05cMkWu5BVNZPhAKRFWRPxUnl1spLSBkV29Tx.', NULL, '2025-06-23 19:43:39', '2025-06-23 19:43:39'),
(3, 'Seller two', 'seller2@example.com', 'seller', '7030281823', 'India', 'Maharashtra', NULL, '$2y$12$a0/QZp3tt2QzGBG3QXAHY.Vc8p0MQ9NUcLA4mE.erkOUAn0rWO2iC', NULL, '2025-06-23 20:30:19', '2025-06-23 20:30:19'),
(4, 'Seller One', 'pratik@gmail.com', 'seller', '9876543210', 'India', 'Maharashtra', NULL, '$2y$12$FF7IE2QhTujoTkncCjfT0.1kmDbYqBOiU1ZslqIUWa4e6Nh4DV4nu', NULL, '2025-06-23 23:07:35', '2025-06-23 23:07:35'),
(5, 'tester', 'tester@example.com', 'seller', '8888888888', 'India', 'Maharashtra', NULL, '$2y$12$sKw8MLeRIlRabQF5OS6xBO70xufwq0BeVMl9wzW3qBi47GZ.YlMea', NULL, '2025-06-24 00:16:47', '2025-06-24 00:16:47'),
(6, 'tester2', 'tester2@example.com', 'seller', '7777777777', 'India', 'Maharashtra', NULL, '$2y$12$CBak0avl2UBAMxzMj7shLembS7JPpIqYN5raZNTjricYAfUkwu7VG', NULL, '2025-06-24 00:17:30', '2025-06-24 00:17:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `seller_skills`
--
ALTER TABLE `seller_skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seller_skills_user_id_skill_id_unique` (`user_id`,`skill_id`),
  ADD KEY `seller_skills_skill_id_foreign` (`skill_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skills_name_unique` (`name`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seller_skills`
--
ALTER TABLE `seller_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seller_skills`
--
ALTER TABLE `seller_skills`
  ADD CONSTRAINT `seller_skills_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seller_skills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
