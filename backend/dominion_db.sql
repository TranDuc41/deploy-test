-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 08:57 AM
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
(17, 'dominion_truyen-thong-va-mang-may-tinh.png', '/uploads/dominion_truyen-thong-va-mang-may-tinh.png', 'App\\Models\\Room', '27', '2023-11-11 07:32:53', '2023-11-11 07:32:53'),
(18, 'dominion_laravelAPI.png', '/uploads/dominion_laravelAPI.png', 'App\\Models\\Room', '28', '2023-11-11 09:30:26', '2023-11-11 09:30:26'),
(19, 'dominion_thiet-ke-do-hoa.png', '/uploads/dominion_thiet-ke-do-hoa.png', 'App\\Models\\Room', '28', '2023-11-11 09:30:26', '2023-11-11 09:30:26'),
(20, 'dominion_Laravel.jpg', '/uploads/dominion_Laravel.jpg', 'App\\Models\\Room', '29', '2023-11-11 10:22:08', '2023-11-11 10:22:08'),
(21, 'dominion_laravel-Query.png', '/uploads/dominion_laravel-Query.png', 'App\\Models\\Room', '29', '2023-11-11 10:22:08', '2023-11-11 10:22:08'),
(22, 'dominion_Amanoi_Accommodation_Interior 1.png', '/uploads/dominion_Amanoi_Accommodation_Interior 1.png', 'App\\Models\\Room', '30', '2023-11-12 23:40:39', '2023-11-12 23:40:39'),
(23, 'dominion_Amanoi_Accommodation_Interior 1.png', '/uploads/dominion_Amanoi_Accommodation_Interior 1.png', 'App\\Models\\Room', '31', '2023-11-13 00:01:21', '2023-11-13 00:01:21');

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
(19, '2023_11_11_094327_add_sale_id_to_room_table', 8),
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
  `rty_id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'maintenance'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `title`, `slug`, `price`, `adults`, `children`, `area`, `description`, `created_at`, `updated_at`, `rty_id`, `sale_id`, `status`) VALUES
(27, 'Phòng 02 Thường', 'phong-02-thuong-6551bdc3ebfd2', 1200000, 3, 1, 26, 'Mô tả', '2023-11-11 07:32:53', '2023-11-12 23:10:11', 1, 1, 'maintenance'),
(28, 'Phòng 01 VIP', 'phong-01-vip-6551bb7a7f916', 5000000, 6, 2, 211, 'Mô tả VIP 02', '2023-11-11 09:30:26', '2023-11-12 23:00:26', 2, 1, 'work'),
(29, 'Phòng 01 Thường', 'phong-01-thuong-6551b91410252', 2000000, 4, 1, 26, 'Mô tả chi tiết room 01 thường', '2023-11-11 10:22:08', '2023-11-12 22:50:12', 1, 1, 'used'),
(30, 'Phòng 02 Villa', 'phong-02-villa-6551c4e728a6d', 8000000, 8, 4, 200, 'Mô tả chi tiết về phòng 02 Villa', '2023-11-12 23:40:39', '2023-11-12 23:40:39', 3, 1, 'work'),
(31, 'Phòng 02 VIP', 'phong-02-vip-6551c9c1d3bbf', 1000000, 6, 4, 35, 'dfdsfsfs', '2023-11-13 00:01:21', '2023-11-13 00:01:21', 2, 1, 'work');

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
(28, 28, 9, NULL, NULL),
(29, 28, 13, NULL, NULL),
(30, 29, 9, NULL, NULL),
(31, 29, 12, NULL, NULL),
(37, 28, 9, NULL, NULL),
(39, 28, 11, NULL, NULL),
(40, 28, 13, NULL, NULL),
(41, 28, 9, NULL, NULL),
(42, 28, 11, NULL, NULL),
(43, 28, 12, NULL, NULL),
(44, 28, 13, NULL, NULL),
(45, 27, 10, NULL, NULL),
(46, 30, 9, NULL, NULL),
(47, 30, 10, NULL, NULL),
(48, 30, 11, NULL, NULL),
(49, 30, 12, NULL, NULL),
(50, 30, 13, NULL, NULL),
(51, 31, 9, NULL, NULL),
(52, 31, 10, NULL, NULL);

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
(31, 28, 2, NULL, NULL),
(32, 28, 6, NULL, NULL),
(33, 29, 2, NULL, NULL),
(34, 29, 4, NULL, NULL),
(35, 29, 2, NULL, NULL),
(36, 29, 4, NULL, NULL),
(37, 29, 6, NULL, NULL),
(44, 28, 2, NULL, NULL),
(45, 28, 6, NULL, NULL),
(46, 28, 2, NULL, NULL),
(47, 28, 6, NULL, NULL),
(48, 27, 2, NULL, NULL),
(49, 27, 4, NULL, NULL),
(50, 30, 2, NULL, NULL),
(51, 30, 3, NULL, NULL),
(52, 30, 4, NULL, NULL),
(53, 30, 5, NULL, NULL),
(54, 30, 6, NULL, NULL),
(55, 31, 2, NULL, NULL),
(56, 31, 4, NULL, NULL),
(57, 31, 6, NULL, NULL);

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
  MODIFY `img_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `room_amenities`
--
ALTER TABLE `room_amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `room_package`
--
ALTER TABLE `room_package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
