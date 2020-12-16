-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2020 at 03:12 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `is_checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `variant_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `cart_id`, `user_id`, `item_id`, `count`, `is_checked_out`, `variant_id`) VALUES
(3, '5fd58c39d86a9', 1, 1, 5, 1, 2),
(7, '5fd58c39d86a9', 1, 2, 3, 1, 5),
(8, '5fd78e3626861', 1, 1, 1, 1, 1),
(9, '5fd78e3626861', 1, 2, 1, 1, 6),
(10, '5fd8e6fb53c36', 1, 2, 5, 1, 6),
(11, '5fd9f98eaf5c0', 12, 2, 1, 1, 4),
(12, '5fd9f98eaf5c0', 12, 3, 1, 1, 8),
(13, '5fd9f98eaf5c0', 12, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `carts_list`
--

CREATE TABLE `carts_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts_list`
--

INSERT INTO `carts_list` (`id`, `cart_id`, `is_used`) VALUES
(1, '5fd58c39d86a9', 0),
(2, '5fd78e3626861', 0),
(3, '5fd8e6fb53c36', 0),
(4, '5fd9f98eaf5c0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_description`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Amrita Cardigan Black', 'Long sleeved, black cardigan', 1215000, 2, '2020-12-12 20:35:41', '2020-12-12 20:35:41'),
(2, 'Long Sleeve Polo', 'Long sleeved black polo shirt, black and charcoal version.', 800000, 1, '2020-12-14 06:12:39', '2020-12-14 06:12:39'),
(3, 'T-Shirt', 'Very good jacket', 500000, 1, '2020-12-16 02:52:00', '2020-12-16 02:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

CREATE TABLE `item_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_images`
--

INSERT INTO `item_images` (`id`, `item_id`, `filename`) VALUES
(1, 1, '5fd58c0d7f39f.jpeg'),
(2, 2, '5fd764c79cbb1.jpeg'),
(3, 2, '5fd764c7eccb0.jpeg'),
(4, 3, '5fd9d8c07150b.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `item_variants`
--

CREATE TABLE `item_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `variant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_variants`
--

INSERT INTO `item_variants` (`id`, `item_id`, `variant_name`, `stock`) VALUES
(1, 1, 'S', 10),
(2, 1, 'M', 20),
(3, 2, 'Polo S', 14),
(4, 2, 'Polo M', 18),
(5, 2, 'Hoody M', 20),
(6, 2, 'Hoody XL', 5),
(7, 3, 'XS', 15),
(8, 3, 'S', 20);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2020_11_24_00040_create_categories_table', 1),
(3, '2020_11_24_085752_create_items_table', 1),
(4, '2020_11_24_090406_create_carts_table', 1),
(5, '2020_11_29_145541_create_images_table', 1),
(6, '2020_12_05_162040_alter_table_users_add_role', 1),
(7, '2020_12_06_092536_create_item_variants_table', 1),
(8, '2020_12_09_043809_alter_items_no_stock_and_variant_add_stock', 1),
(9, '2020_12_09_091945_alter_foreign_keys_to_have_on_delete', 1),
(10, '2020_12_11_093233_add_cart_id_column', 1),
(11, '2020_12_12_024255_create_transactions_table', 1),
(12, '2020_12_12_061409_add_card_id_foreign_to_carts', 1),
(13, '2020_12_12_122558_fix_carts', 1),
(14, '2020_12_14_153205_add_status_to_transaction', 2);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` double NOT NULL,
  `transaction_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `cart_id`, `total_price`, `transaction_time`, `status`) VALUES
(2, 1, '5fd78e3626861', 2088000, '2020-12-14 16:22:08', 'Completed'),
(3, 1, '5fd8e6fb53c36', 4007000, '2020-12-16 11:52:23', 'Cancelled'),
(4, 12, '5fd9f98eaf5c0', 2582000, '2020-12-16 12:14:18', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `credit_points` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL,
  `cart_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `level`, `credit_points`, `avatar`, `created_at`, `updated_at`, `role`, `cart_id`) VALUES
(1, 'Harsana', 'Fujianto', 'harsana@fujianto.or.id', '$2y$10$DkxESQlBjMu9NlLVJ6nE4eUw3ijYIN34k48KdWi2.wq2oWDkdrHqa', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-16 05:00:32', 0, NULL),
(2, 'Kawaca', 'Farida', 'ulya95@situmorang.my.id', '$2y$10$zdWPUKt/AW6KtdeOxZN/hOOXkHyPDj25nowoAgBPwLKS93LjH2Dqy', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-12 20:34:46', 0, NULL),
(3, 'Diana', 'Dongoran', 'surya89@hassanah.asia', '$2y$10$WUfL4T0u/oraF1PCkN.qb.L/aFToG8I1XOsiNDZIHNTLepcBwwsaC', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-12 20:34:46', 0, NULL),
(4, 'Wadi', 'Mandasari', 'rahimah.novi@adriansyah.info', '$2y$10$x4rwM5nIvxVLOBOC.Nj8ZesDEMFjoUGD0cjD6BbEZhe.BYT7KBQKa', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-12 20:34:46', 0, NULL),
(5, 'Timbul', 'Utami', 'kania31@gmail.co.id', '$2y$10$S4/0EmgvsAxU4/VY/GY4Ae/nrxINRQFZpyQUDwJgFhH6Ib8/qpLR.', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-12 20:34:46', 0, NULL),
(6, 'Ade', 'Utama', 'iutama@nainggolan.my.id', '$2y$10$gNq.bERnv0mBhnf3dBZl/.AOnX1sSF210bPWoUpqyj857qL4ezo9W', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-12 20:34:46', 0, NULL),
(7, 'Martana', 'Sudiati', 'laswi66@yolanda.mil.id', '$2y$10$AJ3p1602rChtb1tj9qX.IOx4Qu.IcAdqO7G4GdQ4b1jRFZ1rqN2/u', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-12 20:34:46', 0, NULL),
(8, 'Darsirah', 'Mardhiyah', 'ahalimah@yahoo.com', '$2y$10$Cm4ED/0VjZFDHtunFIkihuw0j3scaXggeq.Chwo2p0e.FFFa8EOIS', '1', '0', NULL, '2020-12-12 20:34:46', '2020-12-12 20:34:46', 0, NULL),
(9, 'Damar', 'Firgantoro', 'embuh60@nasyiah.desa.id', '$2y$10$Ush9YwxLastA4reUjh3wnuk04FoH3uURgs9t/IEs3xAcb4NSMRRL.', '1', '0', NULL, '2020-12-12 20:34:47', '2020-12-12 20:34:47', 0, NULL),
(10, 'Agnes', 'Laksmiwati', 'karimah48@kusmawati.mil.id', '$2y$10$htCdC/Tf6Fz7JCIVdMDcwu09yGpjz0ejAKlZxykDvkHmCvgeuRgWa', '1', '0', NULL, '2020-12-12 20:34:47', '2020-12-12 20:34:47', 0, NULL),
(11, 'Admin', 'One', 'admin@memeail.com', '$2y$10$nnr0yOA7yoTjPmBARHhKk.AnEbfuWFxnKQYqu0R3pDbhmRifQW3gW', '1', '0', NULL, '2020-12-12 20:34:47', '2020-12-12 20:34:47', 1, NULL),
(12, 'Isolasi', 'Gunting', 'isolasi@gunting.com', '$2y$10$Ky.Iw36TA/QxyF37EzUyQ.0Yauu/KqH7vxSEgR5jkLyXLaVdJrtgu', '0', '0', NULL, '2020-12-16 05:11:24', '2020-12-16 05:11:58', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_item_id_foreign` (`item_id`),
  ADD KEY `carts_cart_id_foreign` (`cart_id`),
  ADD KEY `carts_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `carts_list`
--
ALTER TABLE `carts_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_list_cart_id_unique` (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indexes for table `item_images`
--
ALTER TABLE `item_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_images_filename_unique` (`filename`),
  ADD KEY `item_images_item_id_foreign` (`item_id`);

--
-- Indexes for table `item_variants`
--
ALTER TABLE `item_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_variants_item_id_foreign` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_cart_id_foreign` (`cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `carts_list`
--
ALTER TABLE `carts_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_images`
--
ALTER TABLE `item_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_variants`
--
ALTER TABLE `item_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts_list` (`cart_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `item_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_images`
--
ALTER TABLE `item_images`
  ADD CONSTRAINT `item_images_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_variants`
--
ALTER TABLE `item_variants`
  ADD CONSTRAINT `item_variants_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts_list` (`cart_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts_list` (`cart_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
