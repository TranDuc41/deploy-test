-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 03:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dominion_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenities_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenities_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(9, 'Dịch vụ quản gia 24/7', 'quan-gia', '2023-11-11 10:09:23', NULL),
(10, 'Bể ngâm nước lạnh', 'ngam-nuoc-lanh', '2023-11-11 10:09:23', NULL),
(11, 'Phòng điều trị đôi', 'dieu-tri-doi', '2023-11-11 10:09:23', NULL),
(12, 'bể sục', 'be-suc', '2023-11-11 10:09:23', NULL),
(13, 'Quang cảnh hồ', 'canh-ho', '2023-11-11 10:09:23', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` char(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `img_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  `imageable_type` varchar(255) DEFAULT NULL,
  `imageable_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`img_id`, `name`, `img_src`, `imageable_type`, `imageable_id`, `created_at`, `updated_at`) VALUES
(31, 'dominion_Amanoi_Accommodation_Interior 1.png', '/uploads/dominion_Amanoi_Accommodation_Interior 1.png', 'App\\Models\\Room', '40', '2023-11-13 06:56:54', '2023-11-13 06:56:54'),
(33, 'dominion_6552329d2dea0_dominion_Amanoi_Accommodation_Interior 1.png', '/uploads/dominion_6552329d2dea0_dominion_Amanoi_Accommodation_Interior 1.png', 'App\\Models\\Room', '42', '2023-11-13 07:28:45', '2023-11-13 07:28:45'),
(34, 'dominion_6552378bc0c46_dominion_Amanoi_Accommodation_Interior 1.png', '/uploads/dominion_6552378bc0c46_dominion_Amanoi_Accommodation_Interior 1.png', 'App\\Models\\Room', '43', '2023-11-13 07:49:47', '2023-11-13 07:49:47'),
(35, 'dominion_655237cf4a69b_dominion_Amanoi_Accommodation_Interior 1.png', '/uploads/dominion_655237cf4a69b_dominion_Amanoi_Accommodation_Interior 1.png', 'App\\Models\\Room', '44', '2023-11-13 07:50:55', '2023-11-13 07:50:55'),
(36, 'dominion_65523811c7673_dominion_Amanoi_Accommodation_Interior 1.png', '/uploads/dominion_65523811c7673_dominion_Amanoi_Accommodation_Interior 1.png', 'App\\Models\\Room', '45', '2023-11-13 07:52:01', '2023-11-13 07:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `info_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(55) NOT NULL,
  `link` text DEFAULT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_08_083017_create_hotels_table', 1),
(6, '2023_11_08_083256_create_info_table', 2),
(7, '2023_11_08_084004_create_sale_table', 3),
(8, '2023_11_08_084226_create_room_type_table', 3),
(9, '2023_11_08_084537_create_packages_table', 3),
(10, '2023_11_08_084645_create_amenities_table', 3),
(13, '2023_11_09_134931_add_deleted_at_to_users_table', 4),
(15, '2023_11_08_085204_create_room_table', 5),
(16, '2023_11_08_084829_create_image_table', 6),
(18, '2023_11_11_093506_add_rty_id_to_room_table', 7),
(21, '2023_11_11_094658_create_room_package_table', 9),
(22, '2023_11_11_100612_create_room_amenities_table', 10),
(23, '2023_11_11_134129_add_status_to_room_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `packages_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`packages_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Bữa sáng gọi món hàng ngày tại Nhà hàng Chính', '2023-11-11 10:12:06', NULL),
(3, 'Hoạt động hàng ngày của trẻ (trừ lớp học nấu ăn)', '2023-11-11 10:12:06', NULL),
(4, 'Đồ uống giải khát buổi sáng hàng ngày (món ăn lành mạnh)', '2023-11-11 10:12:06', NULL),
(5, 'Dịch vụ đóng gói hành lý độc quyền', '2023-11-11 10:12:06', NULL),
(6, 'Giặt ủi ngoại trừ giặt khô', '2023-11-11 10:12:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) DEFAULT NULL,
  `area` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rty_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'maintenance'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `title`, `slug`, `price`, `adults`, `children`, `area`, `description`, `created_at`, `updated_at`, `rty_id`, `sale_id`, `status`) VALUES
(40, 'Phòng 01 Thường', 'phong-01-thuong-655236beaf58d', 1000000, 3, 1, 30, 'Mô tả chi tiết phòng thường 01', '2023-11-13 06:56:54', '2023-11-13 07:46:22', 1, NULL, 'used'),
(42, 'Phòng 02 Thường', 'phong-02-thuong-6552329d2cfc8', 1200000, 3, 1, 38, 'Mô tả chi tiết phòng 02 thường', '2023-11-13 07:28:45', '2023-11-13 07:28:45', 1, NULL, 'work'),
(43, 'Phòng 01 VIP', 'phong-01-vip-6552378bbfada', 3000000, 4, 2, 40, 'Mô tả chi tiết cho phòng Vip 01', '2023-11-13 07:49:47', '2023-11-13 07:49:47', 2, NULL, 'work'),
(44, 'Phòng 02 VIP', 'phong-02-vip-655237cf49a83', 4500000, 5, 2, 50, 'Mô tả chi tiết phòng 02 Vip', '2023-11-13 07:50:55', '2023-11-13 07:50:55', 2, NULL, 'work'),
(45, 'Phòng 01 Villa', 'phong-01-villa-65523811c677d', 6000000, 6, 3, 66, 'Mô tả chi tiết phòng 01 Villa', '2023-11-13 07:52:01', '2023-11-13 07:52:01', 3, NULL, 'work');

-- --------------------------------------------------------

--
-- Table structure for table `room_amenities`
--

CREATE TABLE `room_amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `amenities_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_amenities`
--

INSERT INTO `room_amenities` (`id`, `room_id`, `amenities_id`, `created_at`, `updated_at`) VALUES
(68, 42, 9, NULL, NULL),
(69, 42, 10, NULL, NULL),
(71, 40, 9, NULL, NULL),
(72, 40, 11, NULL, NULL),
(73, 43, 10, NULL, NULL),
(74, 43, 11, NULL, NULL),
(75, 43, 12, NULL, NULL),
(76, 44, 10, NULL, NULL),
(77, 44, 13, NULL, NULL),
(78, 45, 9, NULL, NULL),
(79, 45, 11, NULL, NULL),
(80, 45, 12, NULL, NULL),
(81, 45, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_package`
--

CREATE TABLE `room_package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `packages_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_package`
--

INSERT INTO `room_package` (`id`, `room_id`, `packages_id`, `created_at`, `updated_at`) VALUES
(72, 42, 2, NULL, NULL),
(73, 42, 6, NULL, NULL),
(75, 40, 2, NULL, NULL),
(76, 40, 6, NULL, NULL),
(77, 43, 2, NULL, NULL),
(78, 43, 3, NULL, NULL),
(79, 43, 5, NULL, NULL),
(80, 44, 2, NULL, NULL),
(81, 44, 4, NULL, NULL),
(82, 44, 5, NULL, NULL),
(83, 44, 6, NULL, NULL),
(84, 45, 2, NULL, NULL),
(85, 45, 3, NULL, NULL),
(86, 45, 4, NULL, NULL),
(87, 45, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `rty_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`rty_id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Thường', 'thuong', 'phòng thường', '2023-11-11 00:51:09', NULL),
(2, 'Vip', 'vip', 'Phòng Vip', '2023-11-11 00:52:41', NULL),
(3, 'Villa', 'villa', 'Phòng Villa', '2023-11-11 00:53:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `discount` int(11) NOT NULL,
  `start_date` timestamp NULL DEFAULT current_timestamp(),
  `end_date` timestamp NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `discount`, `start_date`, `end_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, '2023-11-11 01:06:42', '2023-11-20 01:06:42', 1, '2023-11-11 01:06:42', NULL),
(2, 10, '2023-11-11 01:07:30', '2023-11-12 01:07:30', 1, '2023-11-10 01:07:30', NULL),
(3, 15, '2023-11-06 01:08:04', '2023-11-10 01:08:04', 1, '2023-11-06 01:08:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `uesr_type` varchar(10) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `active`, `uesr_type`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$oKKIuonfSOweplCogieLi.VsDFmHseaZBNei84gthLgofYJj2yIu6', 0, 'sp-admin', NULL, '2023-11-08 18:28:51', '2023-11-09 19:12:21', NULL),
(4, 'Name', 'email@gmail.com', NULL, '$2y$10$EpzyNe6DPDDrUv0CmhQ7p.fz3rkHZwZJyatI5sShSp1Ubrp6BgRCC', 0, 'admin', NULL, '2023-11-09 02:34:20', '2023-11-09 19:37:21', NULL),
(5, 'Name Test 1', 'test@gmail.com', NULL, '$2y$10$OwC4Rt.8tte7mOf7DMe8MObf/6VFw0rD1pT7hx3IVpUaoYIqxN8oa', 0, 'staff', NULL, '2023-11-09 06:58:45', '2023-11-09 19:40:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenities_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`info_id`),
  ADD KEY `info_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`packages_id`);

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
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_rty_id_foreign` (`rty_id`),
  ADD KEY `room_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `room_amenities`
--
ALTER TABLE `room_amenities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_amenities_room_id_foreign` (`room_id`),
  ADD KEY `room_amenities_amenities_id_foreign` (`amenities_id`);

--
-- Indexes for table `room_package`
--
ALTER TABLE `room_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_package_room_id_foreign` (`room_id`),
  ADD KEY `room_package_packages_id_foreign` (`packages_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`rty_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `sale_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenities_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `img_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `packages_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `room_amenities`
--
ALTER TABLE `room_amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `room_package`
--
ALTER TABLE `room_package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `rty_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `info_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`) ON DELETE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_rty_id_foreign` FOREIGN KEY (`rty_id`) REFERENCES `room_type` (`rty_id`),
  ADD CONSTRAINT `room_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`);

--
-- Constraints for table `room_amenities`
--
ALTER TABLE `room_amenities`
  ADD CONSTRAINT `room_amenities_amenities_id_foreign` FOREIGN KEY (`amenities_id`) REFERENCES `amenities` (`amenities_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_amenities_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `room_package`
--
ALTER TABLE `room_package`
  ADD CONSTRAINT `room_package_packages_id_foreign` FOREIGN KEY (`packages_id`) REFERENCES `packages` (`packages_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_package_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
