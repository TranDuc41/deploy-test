-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2023 at 08:19 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

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

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `amenities_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`amenities_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenities_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(16, 'Phòng tắm có bồn tắm, bàn trang điểm đôi', 'phong-tam-co-bon-tam-ban-trang-iem-doi', '2023-11-13 15:41:02', '2023-11-17 08:18:30'),
(17, 'Bể ngâm nước lạnh', 'be-ngam-nuoc-lanh', '2023-11-13 15:41:09', '2023-11-13 15:41:09'),
(18, 'Gian hàng ăn uống và nhà bếp', 'gian-hang-an-uong-va-nha-bep', '2023-11-13 15:42:39', '2023-11-13 15:42:39'),
(19, 'Phòng điều trị đôi', 'phong-ieu-tri-oi', '2023-11-13 15:42:49', '2023-11-13 15:42:49'),
(20, 'Phòng tắm riêng có bồn tắm, bàn trang điểm đôi', 'phong-tam-rieng-co-bon-tam-ban-trang-iem-oi', '2023-11-13 15:42:56', '2023-11-13 15:42:56'),
(21, 'Máy pha cà phê espresso', 'may-pha-ca-phe-espresso', '2023-11-13 15:43:02', '2023-11-13 15:43:02'),
(22, 'Sàn tắm nắng bằng gỗ rộng rãi', 'san-tam-nang-bang-go-rong-rai', '2023-11-13 15:43:09', '2023-11-13 15:43:09'),
(23, 'Gian hàng năm phòng ngủ với giường cỡ King', 'gian-hang-nam-phong-ngu-voi-giuong-co-king', '2023-11-13 15:43:15', '2023-11-13 15:43:15'),
(24, 'Nhà 4 phòng ngủ có giường cỡ King', 'nha-4-phong-ngu-co-giuong-co-king', '2023-11-13 15:43:21', '2023-11-13 15:43:21'),
(25, 'Sàn tắm nắng bằng gỗ lớn có khu vực tiếp khách', 'san-tam-nang-bang-go-lon-co-khu-vuc-tiep-khach', '2023-11-13 15:43:27', '2023-11-13 22:49:25'),
(26, 'Đài phun nước băng', 'ai-phun-nuoc-bang', '2023-11-13 15:43:32', '2023-11-13 15:43:32'),
(27, 'bể sục', 'be-suc', '2023-11-13 15:43:38', '2023-11-13 15:43:38'),
(28, 'Giường phía King', 'giuong-phia-king', '2023-11-13 15:43:42', '2023-11-13 15:43:42'),
(29, 'Quang cảnh hồ', 'quang-canh-ho', '2023-11-13 15:43:50', '2023-11-13 15:43:50'),
(30, 'Gian hàng sinh hoạt và ăn uống', 'gian-hang-sinh-hoat-va-an-uong', '2023-11-13 15:43:59', '2023-11-13 15:43:59'),
(31, 'Khu vực sinh hoạt có ghế sofa, bàn viết', 'khu-vuc-sinh-hoat-co-ghe-sofa-ban-viet', '2023-11-13 15:44:07', '2023-11-13 15:44:07'),
(32, 'Quang cảnh núi và đại dương', 'quang-canh-nui-va-ai-duong', '2023-11-13 15:44:32', '2023-11-13 15:44:32'),
(33, 'Quang cảnh núi hoặc đại dương', 'quang-canh-nui-hoac-ai-duong', '2023-11-13 15:44:38', '2023-11-13 15:44:38'),
(34, 'Quang cảnh vườn quốc gia', 'quang-canh-vuon-quoc-gia', '2023-11-13 15:44:43', '2023-11-13 15:44:43'),
(35, 'Máy pha cà phê Nespresso', 'may-pha-ca-phe-nespresso', '2023-11-13 15:44:50', '2023-11-13 15:44:50'),
(36, 'Quang cảnh đại dương', 'quang-canh-ai-duong', '2023-11-13 15:45:01', '2023-11-13 15:45:01'),
(37, 'Một phòng ngủ nhỏ', 'mot-phong-ngu-nho', '2023-11-13 15:45:08', '2023-11-13 15:45:08'),
(38, 'Một phòng ngủ chính', 'mot-phong-ngu-chinh', '2023-11-13 15:45:17', '2023-11-13 15:45:17'),
(39, 'Toàn cảnh đại dương', 'toan-canh-ai-duong', '2023-11-13 15:45:26', '2023-11-13 15:45:26'),
(40, 'Thanh cá nhân', 'thanh-ca-nhan', '2023-11-13 15:45:36', '2023-11-13 15:45:36'),
(41, 'Bể bơi vô cực riêng', 'be-boi-vo-cuc-rieng', '2023-11-13 15:45:42', '2023-11-13 15:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
CREATE TABLE IF NOT EXISTS `hotels` (
  `hotel_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `img_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imageable_id` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`img_id`, `name`, `img_src`, `imageable_type`, `imageable_id`, `created_at`, `updated_at`) VALUES
(64, 'dominion_Amanoi_Bathroom.jpg', '/uploads/dominion_Amanoi_Bathroom.jpg', 'App\\Models\\Room', '50', '2023-11-17 00:35:01', '2023-11-17 00:35:01'),
(65, 'dominion_Amanoi_One-Bedroom Ocean Pool Residence .jpg', '/uploads/dominion_Amanoi_One-Bedroom Ocean Pool Residence .jpg', 'App\\Models\\Room', '50', '2023-11-17 00:35:01', '2023-11-17 00:35:01'),
(66, 'dominion_Amanoi_Swimming Pool Terrace.jpg', '/uploads/dominion_Amanoi_Swimming Pool Terrace.jpg', 'App\\Models\\Room', '50', '2023-11-17 00:35:01', '2023-11-17 00:35:01'),
(67, 'dominion_amanoi_vietnam_-_one_bedroom_ocean_pool_residence.jpg', '/uploads/dominion_amanoi_vietnam_-_one_bedroom_ocean_pool_residence.jpg', 'App\\Models\\Room', '50', '2023-11-17 00:35:01', '2023-11-17 00:35:01'),
(68, 'dominion_amanoi_vietnam_-_one_bedroom_ocean_pool_residence_4.jpg', '/uploads/dominion_amanoi_vietnam_-_one_bedroom_ocean_pool_residence_4.jpg', 'App\\Models\\Room', '50', '2023-11-17 00:35:01', '2023-11-17 00:35:01'),
(69, 'dominion_One-Bedroom Ocean pool Residence-Amanoi_Balcony-2.jpg', '/uploads/dominion_One-Bedroom Ocean pool Residence-Amanoi_Balcony-2.jpg', 'App\\Models\\Room', '50', '2023-11-17 00:35:01', '2023-11-17 00:35:01'),
(70, 'dominion_tgb_20211101_amanoi_00058_final.jpg', '/uploads/dominion_tgb_20211101_amanoi_00058_final.jpg', 'App\\Models\\Room', '50', '2023-11-17 00:35:01', '2023-11-17 00:35:01'),
(71, 'dominion_Amanoi_Accommodation.jpg', '/uploads/dominion_Amanoi_Accommodation.jpg', 'App\\Models\\Room', '51', '2023-11-17 00:40:29', '2023-11-17 00:40:29'),
(72, 'dominion_Amanoi_Aerial View.jpg', '/uploads/dominion_Amanoi_Aerial View.jpg', 'App\\Models\\Room', '51', '2023-11-17 00:40:29', '2023-11-17 00:40:29'),
(73, 'dominion_Amanoi_Outside View.jpg', '/uploads/dominion_Amanoi_Outside View.jpg', 'App\\Models\\Room', '51', '2023-11-17 00:40:29', '2023-11-17 00:40:29'),
(74, 'dominion_Amanoi_Pool Terrace.jpg', '/uploads/dominion_Amanoi_Pool Terrace.jpg', 'App\\Models\\Room', '51', '2023-11-17 00:40:29', '2023-11-17 00:40:29'),
(75, 'dominion_Amanoi_Swimming Pool View.jpg', '/uploads/dominion_Amanoi_Swimming Pool View.jpg', 'App\\Models\\Room', '51', '2023-11-17 00:40:29', '2023-11-17 00:40:29'),
(76, 'dominion_Amanoi_Terrace View.jpg', '/uploads/dominion_Amanoi_Terrace View.jpg', 'App\\Models\\Room', '51', '2023-11-17 00:40:29', '2023-11-17 00:40:29'),
(77, 'dominion_amanoi_vietnam_-_one_bedroom_ocean_pool_residence_3.jpg', '/uploads/dominion_amanoi_vietnam_-_one_bedroom_ocean_pool_residence_3.jpg', 'App\\Models\\Room', '51', '2023-11-17 00:40:29', '2023-11-17 00:40:29'),
(78, 'dominion_Amanoi_Accommodation_Interior.jpg', '/uploads/dominion_Amanoi_Accommodation_Interior.jpg', 'App\\Models\\Room', '52', '2023-11-17 00:41:38', '2023-11-17 00:41:38'),
(79, 'dominion_Amanoi_Aerial_View_0.jpg', '/uploads/dominion_Amanoi_Aerial_View_0.jpg', 'App\\Models\\Room', '52', '2023-11-17 00:41:38', '2023-11-17 00:41:38'),
(80, 'dominion_Amanoi_Pool_View.jpg', '/uploads/dominion_Amanoi_Pool_View.jpg', 'App\\Models\\Room', '52', '2023-11-17 00:41:38', '2023-11-17 00:41:38'),
(81, 'dominion_amanoi_vietnam_-_four_bedroom_ocean_pool_family_residence_swimming_pool_terrace.jpg', '/uploads/dominion_amanoi_vietnam_-_four_bedroom_ocean_pool_family_residence_swimming_pool_terrace.jpg', 'App\\Models\\Room', '52', '2023-11-17 00:41:38', '2023-11-17 00:41:38'),
(82, 'dominion_3-Bedroom Residence, Amanoi, Vietnam_1.jpg', '/uploads/dominion_3-Bedroom Residence, Amanoi, Vietnam_1.jpg', 'App\\Models\\Room', '53', '2023-11-17 00:42:40', '2023-11-17 00:42:40'),
(83, 'dominion_3-Bedroom Residence, Amanoi, Vietnam_3.jpg', '/uploads/dominion_3-Bedroom Residence, Amanoi, Vietnam_3.jpg', 'App\\Models\\Room', '53', '2023-11-17 00:42:40', '2023-11-17 00:42:40'),
(84, 'dominion_3-Bedroom Residence, Amanoi, Vietnam_4.jpg', '/uploads/dominion_3-Bedroom Residence, Amanoi, Vietnam_4.jpg', 'App\\Models\\Room', '53', '2023-11-17 00:42:40', '2023-11-17 00:42:40'),
(85, 'dominion_3-Bedroom Residence, Amanoi, Vietnam_5.jpg', '/uploads/dominion_3-Bedroom Residence, Amanoi, Vietnam_5.jpg', 'App\\Models\\Room', '53', '2023-11-17 00:42:40', '2023-11-17 00:42:40'),
(86, 'dominion_3-Bedroom Residence, Amanoi, Vietnam_6.jpg', '/uploads/dominion_3-Bedroom Residence, Amanoi, Vietnam_6.jpg', 'App\\Models\\Room', '53', '2023-11-17 00:42:40', '2023-11-17 00:42:40'),
(87, 'dominion_4-bedroom_villa_villa_16c.jpg', '/uploads/dominion_4-bedroom_villa_villa_16c.jpg', 'App\\Models\\Room', '53', '2023-11-17 00:42:40', '2023-11-17 00:42:40'),
(88, 'dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, aerial view.jpg', '/uploads/dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, aerial view.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(89, 'dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, bedroom.jpg', '/uploads/dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, bedroom.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(90, 'dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, swimming pool terrace.jpg', '/uploads/dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, swimming pool terrace.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(91, 'dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, Swimming Pool.jpg', '/uploads/dominion_Amanoi, Vietnam - Four Bedroom Ocean Pool Family Residence, Swimming Pool.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(92, 'dominion_Amanoi, Vietnam - Lounge in Residence_3.jpg', '/uploads/dominion_Amanoi, Vietnam - Lounge in Residence_3.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(93, 'dominion_general_br_pavilion.jpg', '/uploads/dominion_general_br_pavilion.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(94, 'dominion_r5_pool_view_from_br.jpg', '/uploads/dominion_r5_pool_view_from_br.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(95, 'dominion_r5_terrace_in_br.jpg', '/uploads/dominion_r5_terrace_in_br.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(96, 'dominion_r7_aerial_view.jpg', '/uploads/dominion_r7_aerial_view.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(97, 'dominion_r7_aerial_view_topdown.jpg', '/uploads/dominion_r7_aerial_view_topdown.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(98, 'dominion_r7_at_night.jpg', '/uploads/dominion_r7_at_night.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(99, 'dominion_r7_living_pavilion.jpg', '/uploads/dominion_r7_living_pavilion.jpg', 'App\\Models\\Room', '54', '2023-11-17 00:43:56', '2023-11-17 00:43:56'),
(100, 'dominion_4-Bedroom Residence, Amanoi, Vietnam_3.jpg', '/uploads/dominion_4-Bedroom Residence, Amanoi, Vietnam_3.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(101, 'dominion_4-Bedroom Residence, Amanoi, Vietnam_4.jpg', '/uploads/dominion_4-Bedroom Residence, Amanoi, Vietnam_4.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(102, 'dominion_4-Bedroom Residence, Amanoi, Vietnam_5.jpg', '/uploads/dominion_4-Bedroom Residence, Amanoi, Vietnam_5.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(103, 'dominion_4-Bedroom Residence, Amanoi, Vietnam_6.jpg', '/uploads/dominion_4-Bedroom Residence, Amanoi, Vietnam_6.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(104, 'dominion_4-Bedroom Residence, Amanoi, Vietnam_8.jpg', '/uploads/dominion_4-Bedroom Residence, Amanoi, Vietnam_8.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(105, 'dominion_Amanoi_4-Bed-Residence-1.jpg', '/uploads/dominion_Amanoi_4-Bed-Residence-1.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(106, 'dominion_Amanoi_Accommodation_Entrance.jpg', '/uploads/dominion_Amanoi_Accommodation_Entrance.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(107, 'dominion_Amanoi_Four_Bedroom_Residence.jpg', '/uploads/dominion_Amanoi_Four_Bedroom_Residence.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(108, 'dominion_Amanoi_Four_Bedroom_View.jpg', '/uploads/dominion_Amanoi_Four_Bedroom_View.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(109, 'dominion_Amanoi_Lake-Pavilion-1.jpg', '/uploads/dominion_Amanoi_Lake-Pavilion-1.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(110, 'dominion_namq5835.jpg', '/uploads/dominion_namq5835.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(111, 'dominion_namq5849.jpg', '/uploads/dominion_namq5849.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(112, 'dominion_namq5896_rz.jpg', '/uploads/dominion_namq5896_rz.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(113, 'dominion_pool_-_residence_9_office_15062.jpg', '/uploads/dominion_pool_-_residence_9_office_15062.jpg', 'App\\Models\\Room', '55', '2023-11-17 00:45:13', '2023-11-17 00:45:13'),
(114, 'dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_1.jpg', '/uploads/dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_1.jpg', 'App\\Models\\Room', '56', '2023-11-17 00:46:41', '2023-11-17 00:46:41'),
(115, 'dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_2.jpg', '/uploads/dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_2.jpg', 'App\\Models\\Room', '56', '2023-11-17 00:46:41', '2023-11-17 00:46:41'),
(116, 'dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_3.jpg', '/uploads/dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_3.jpg', 'App\\Models\\Room', '56', '2023-11-17 00:46:41', '2023-11-17 00:46:41'),
(117, 'dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_4.jpg', '/uploads/dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_4.jpg', 'App\\Models\\Room', '56', '2023-11-17 00:46:41', '2023-11-17 00:46:41'),
(118, 'dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_5.jpg', '/uploads/dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_5.jpg', 'App\\Models\\Room', '56', '2023-11-17 00:46:41', '2023-11-17 00:46:41'),
(119, 'dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_6.jpg', '/uploads/dominion_Forest Wellness Pool Villa, Amanoi, Vietnam_6.jpg', 'App\\Models\\Room', '56', '2023-11-17 00:46:41', '2023-11-17 00:46:41'),
(120, 'dominion_Amanoi, Vietnam - Accommodation, Pavilion view 6 (2).jpg', '/uploads/dominion_Amanoi, Vietnam - Accommodation, Pavilion view 6 (2).jpg', 'App\\Models\\Room', '57', '2023-11-17 00:47:47', '2023-11-17 00:47:47'),
(121, 'dominion_Amanoi, Vietnam - Acommodation, Aerial View of the Forest Wellness Pool Villa and lotus lake.jpg', '/uploads/dominion_Amanoi, Vietnam - Acommodation, Aerial View of the Forest Wellness Pool Villa and lotus lake.jpg', 'App\\Models\\Room', '57', '2023-11-17 00:47:47', '2023-11-17 00:47:47'),
(122, 'dominion_Amanoi, Vietnam - Acommodation, Aerial View of the Forest Wellness Pool Villa and lotus lake2.jpg', '/uploads/dominion_Amanoi, Vietnam - Acommodation, Aerial View of the Forest Wellness Pool Villa and lotus lake2.jpg', 'App\\Models\\Room', '57', '2023-11-17 00:47:47', '2023-11-17 00:47:47'),
(123, 'dominion_Lake Wellness Pool Villa, Amanoi, Vietnam_3.jpg', '/uploads/dominion_Lake Wellness Pool Villa, Amanoi, Vietnam_3.jpg', 'App\\Models\\Room', '57', '2023-11-17 00:47:47', '2023-11-17 00:47:47'),
(124, 'dominion_Lake Wellness Pool Villa, Amanoi, Vietnam_4.jpg', '/uploads/dominion_Lake Wellness Pool Villa, Amanoi, Vietnam_4.jpg', 'App\\Models\\Room', '57', '2023-11-17 00:47:47', '2023-11-17 00:47:47'),
(125, 'dominion_Lake Pavilion, Amanoi, Vietnam_1.jpg', '/uploads/dominion_Lake Pavilion, Amanoi, Vietnam_1.jpg', 'App\\Models\\Room', '58', '2023-11-17 00:49:40', '2023-11-17 00:49:40'),
(126, 'dominion_Lake Pavilion, Amanoi, Vietnam_2.jpg', '/uploads/dominion_Lake Pavilion, Amanoi, Vietnam_2.jpg', 'App\\Models\\Room', '58', '2023-11-17 00:49:40', '2023-11-17 00:49:40'),
(127, 'dominion_Lake Pavilion, Amanoi, Vietnam_3.jpg', '/uploads/dominion_Lake Pavilion, Amanoi, Vietnam_3.jpg', 'App\\Models\\Room', '58', '2023-11-17 00:49:40', '2023-11-17 00:49:40'),
(128, 'dominion_Lake Pavilion, Amanoi, Vietnam_4.jpg', '/uploads/dominion_Lake Pavilion, Amanoi, Vietnam_4.jpg', 'App\\Models\\Room', '58', '2023-11-17 00:49:40', '2023-11-17 00:49:40'),
(129, 'dominion_Lake Pavilion, Amanoi, Vietnam_5.jpg', '/uploads/dominion_Lake Pavilion, Amanoi, Vietnam_5.jpg', 'App\\Models\\Room', '58', '2023-11-17 00:49:40', '2023-11-17 00:49:40'),
(130, 'dominion_Amanoi_Ocean Pavilion_Landscape-2.jpg', '/uploads/dominion_Amanoi_Ocean Pavilion_Landscape-2.jpg', 'App\\Models\\Room', '59', '2023-11-17 00:50:38', '2023-11-17 00:50:38'),
(131, 'dominion_Ocean Pavilion, Amanoi, Vietnam_2.jpg', '/uploads/dominion_Ocean Pavilion, Amanoi, Vietnam_2.jpg', 'App\\Models\\Room', '59', '2023-11-17 00:50:38', '2023-11-17 00:50:38'),
(132, 'dominion_Ocean Pavilion, Amanoi, Vietnam_5.jpg', '/uploads/dominion_Ocean Pavilion, Amanoi, Vietnam_5.jpg', 'App\\Models\\Room', '59', '2023-11-17 00:50:38', '2023-11-17 00:50:38'),
(133, 'dominion_Amanoi, Vietnam - Ocean Pool Family Villa, aerial view.jpg', '/uploads/dominion_Amanoi, Vietnam - Ocean Pool Family Villa, aerial view.jpg', 'App\\Models\\Room', '60', '2023-11-17 00:51:39', '2023-11-17 00:51:39'),
(134, 'dominion_Amanoi, Vietnam - Ocean Pool Family Villa, bedroom.jpg', '/uploads/dominion_Amanoi, Vietnam - Ocean Pool Family Villa, bedroom.jpg', 'App\\Models\\Room', '60', '2023-11-17 00:51:39', '2023-11-17 00:51:39'),
(135, 'dominion_Amanoi, Vietnam - Ocean Pool Family Villa, swimming pool.jpg', '/uploads/dominion_Amanoi, Vietnam - Ocean Pool Family Villa, swimming pool.jpg', 'App\\Models\\Room', '60', '2023-11-17 00:51:39', '2023-11-17 00:51:39'),
(136, 'dominion_Amanoi-Ocean-Pool-Family-Villa.jpg', '/uploads/dominion_Amanoi-Ocean-Pool-Family-Villa.jpg', 'App\\Models\\Room', '60', '2023-11-17 00:51:39', '2023-11-17 00:51:39'),
(137, 'dominion_Amanoi_Ocean Pool Villa_Exterior Pool.jpg', '/uploads/dominion_Amanoi_Ocean Pool Villa_Exterior Pool.jpg', 'App\\Models\\Room', '61', '2023-11-17 00:52:37', '2023-11-17 00:52:37'),
(138, 'dominion_Amanoi_Ocean Pool Villa_Living Room.jpg', '/uploads/dominion_Amanoi_Ocean Pool Villa_Living Room.jpg', 'App\\Models\\Room', '61', '2023-11-17 00:52:37', '2023-11-17 00:52:37'),
(139, 'dominion_Amanoi-Swimming Pool.jpg', '/uploads/dominion_Amanoi-Swimming Pool.jpg', 'App\\Models\\Room', '61', '2023-11-17 00:52:37', '2023-11-17 00:52:37'),
(140, 'dominion_Amanoi-Terrace.jpg', '/uploads/dominion_Amanoi-Terrace.jpg', 'App\\Models\\Room', '61', '2023-11-17 00:52:37', '2023-11-17 00:52:37'),
(141, 'dominion_Ocean Pool Villa, Amanoi, Vietnam_2.jpg', '/uploads/dominion_Ocean Pool Villa, Amanoi, Vietnam_2.jpg', 'App\\Models\\Room', '61', '2023-11-17 00:52:37', '2023-11-17 00:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `info_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `hotel_id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`info_id`),
  KEY `info_hotel_id_foreign` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `packages_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`packages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`packages_id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Bữa sáng gọi món hàng ngày tại Nhà hàng Chính', '2023-11-11 10:12:06', NULL),
(3, 'Hoạt động hàng ngày của trẻ (trừ lớp học nấu ăn)', '2023-11-11 10:12:06', NULL),
(4, 'Đồ uống giải khát buổi sáng hàng ngày (món ăn lành mạnh)', '2023-11-11 10:12:06', NULL),
(5, 'Dịch vụ đóng gói hành lý độc quyền', '2023-11-11 10:12:06', NULL),
(6, 'Giặt ủi ngoại trừ giặt khô', '2023-11-11 10:12:06', NULL),
(7, 'Trà chiều hàng ngày', NULL, NULL),
(8, 'Trà chiều hàng ngày tại nhà hàng Main', NULL, NULL),
(9, 'Đồ uống giải khát buổi sáng hàng ngày (món ăn lành mạnh)', NULL, NULL),
(10, 'Lớp học chăm sóc sức khỏe buổi sáng theo lịch hàng ngày', NULL, NULL),
(11, 'Dịch vụ đóng gói hành lý độc quyền', NULL, NULL),
(12, 'Bao ăn trọn gói bao gồm bữa sáng hàng ngày, bữa trưa, trà chiều và bữa tối với đồ uống không cồn', NULL, NULL),
(13, 'Giải khát trong phòng và đồ uống không cồn', NULL, NULL),
(14, 'Một lần mát-xa 60 phút cho hai khách trong phòng ngủ chính (đối với thời gian lưu trú 3 đêm)', NULL, NULL),
(15, 'Một liệu trình Banya hoặc Hammam cách ngày', NULL, NULL),
(16, 'Một hoạt động miễn phí với lựa chọn đi bộ lên đỉnh Goga có hướng dẫn, đi bộ với Mèo hoang có hướng d', NULL, NULL),
(17, 'Một đêm xem phim với bỏng ngô và kem tại dinh thự bên hồ bơi', NULL, NULL),
(18, 'Trị liệu ba giờ cho mỗi người mỗi ngày từ thực đơn', NULL, NULL),
(19, 'Sử dụng tất cả các thiết bị thể thao dưới nước không có động cơ', NULL, NULL),
(20, 'Tiệc chiêu đãi chào mừng với rượu sâm panh và bánh canapé tại dinh thự', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `room_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `adults` int NOT NULL,
  `children` int DEFAULT NULL,
  `area` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rty_id` bigint UNSIGNED DEFAULT NULL,
  `sale_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'maintenance',
  PRIMARY KEY (`room_id`),
  KEY `room_rty_id_foreign` (`rty_id`),
  KEY `room_sale_id_foreign` (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `title`, `slug`, `price`, `adults`, `children`, `area`, `description`, `created_at`, `updated_at`, `rty_id`, `sale_id`, `status`) VALUES
(50, 'Dinh thự 1 Phòng ngủ có Hồ bơi Đại dương', 'dinh-thu-1-phong-ngu-co-ho-boi-dai-duong-655717a544cdc', 20000000, 4, 2, 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:35:01', '2023-11-17 00:35:01', 7, NULL, 'work'),
(51, 'Dinh thự 2 Phòng ngủ có Hồ bơi Đại dương', 'dinh-thu-2-phong-ngu-co-ho-boi-dai-duong-655718edcad48', 21000000, 4, 2, 200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:40:29', '2023-11-17 00:40:29', 7, NULL, 'work'),
(52, 'Dinh thự Gia đình 2 Phòng ngủ có Hồ bơi Đại dương', 'dinh-thu-gia-dinh-2-phong-ngu-co-ho-boi-dai-duong-6557193221387', 23000000, 4, 2, 150, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:41:38', '2023-11-17 00:41:38', 7, 1, 'work'),
(53, 'Dinh thự có Hồ bơi 3 Phòng ngủ', 'dinh-thu-co-ho-boi-3-phong-ngu-6557197051f54', 20000000, 6, 3, 200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:42:40', '2023-11-17 00:42:40', 7, NULL, 'work'),
(54, 'Dinh thự Gia đình 3 Phòng ngủ có Hồ bơi Đại dương', 'dinh-thu-gia-dinh-3-phong-ngu-co-ho-boi-dai-duong-65571becd6748', 25000000, 6, 3, 300, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:43:56', '2023-11-17 00:53:16', 9, NULL, 'work'),
(55, 'Dinh Thự 4 Phòng Ngủ Có Hồ Bơi', 'dinh-thu-4-phong-ngu-co-ho-boi-65571a095408a', 30000000, 8, 4, 350, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:45:13', '2023-11-17 00:45:13', 7, NULL, 'work'),
(56, 'Biệt thự có hồ bơi chăm sóc sức khỏe rừng', 'biet-thu-co-ho-boi-cham-soc-suc-khoe-rung-65571a612ca64', 50000000, 5, 0, 400, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:46:41', '2023-11-17 00:46:41', 8, NULL, 'work'),
(57, 'Biệt thự có hồ bơi chăm sóc sức khỏe bên hồ', 'biet-thu-co-ho-boi-cham-soc-suc-khoe-ben-ho-65571aa3e4f6d', 59000000, 6, 0, 300, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:47:47', '2023-11-17 00:47:47', 8, 1, 'work'),
(58, 'Biệt thự Gia đình có Hồ bơi Đại dương', 'biet-thu-gia-dinh-co-ho-boi-dai-duong-65571b142679d', 40000000, 10, 5, 400, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:49:40', '2023-11-17 00:49:40', 9, NULL, 'work'),
(59, 'Biệt thự có hồ bơi Amanoi Ocean', 'biet-thu-co-ho-boi-amanoi-ocean-65571b4e2663a', 60000000, 10, 3, 400, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:50:38', '2023-11-17 00:50:38', 7, NULL, 'work'),
(60, 'Biệt thự có hồ bơi đại dương', 'biet-thu-co-ho-boi-dai-duong-65571b8be2160', 84000000, 12, 5, 450, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:51:39', '2023-11-17 00:51:39', 9, NULL, 'work'),
(61, 'Biệt thự có hồ bơi trên núi', 'biet-thu-co-ho-boi-tren-nui-65571bdc0e7cd', 74000000, 15, 5, 400, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-17 00:52:37', '2023-11-17 00:53:00', 9, 6, 'work');

-- --------------------------------------------------------

--
-- Table structure for table `room_amenities`
--

DROP TABLE IF EXISTS `room_amenities`;
CREATE TABLE IF NOT EXISTS `room_amenities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_id` bigint UNSIGNED NOT NULL,
  `amenities_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_amenities_room_id_foreign` (`room_id`),
  KEY `room_amenities_amenities_id_foreign` (`amenities_id`)
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_amenities`
--

INSERT INTO `room_amenities` (`id`, `room_id`, `amenities_id`, `created_at`, `updated_at`) VALUES
(146, 50, 16, NULL, NULL),
(147, 50, 17, NULL, NULL),
(148, 50, 18, NULL, NULL),
(149, 50, 19, NULL, NULL),
(150, 50, 20, NULL, NULL),
(151, 50, 21, NULL, NULL),
(153, 51, 16, NULL, NULL),
(154, 51, 17, NULL, NULL),
(155, 51, 18, NULL, NULL),
(156, 51, 19, NULL, NULL),
(157, 51, 20, NULL, NULL),
(158, 51, 21, NULL, NULL),
(159, 51, 22, NULL, NULL),
(161, 52, 16, NULL, NULL),
(162, 52, 17, NULL, NULL),
(163, 52, 18, NULL, NULL),
(164, 52, 19, NULL, NULL),
(165, 52, 20, NULL, NULL),
(166, 52, 21, NULL, NULL),
(167, 52, 22, NULL, NULL),
(168, 52, 23, NULL, NULL),
(170, 53, 16, NULL, NULL),
(171, 53, 17, NULL, NULL),
(172, 53, 18, NULL, NULL),
(173, 53, 19, NULL, NULL),
(174, 53, 20, NULL, NULL),
(175, 53, 21, NULL, NULL),
(176, 53, 22, NULL, NULL),
(187, 55, 16, NULL, NULL),
(188, 55, 17, NULL, NULL),
(189, 55, 18, NULL, NULL),
(190, 55, 19, NULL, NULL),
(191, 55, 20, NULL, NULL),
(192, 55, 21, NULL, NULL),
(193, 55, 22, NULL, NULL),
(194, 55, 23, NULL, NULL),
(195, 55, 24, NULL, NULL),
(196, 56, 31, NULL, NULL),
(197, 56, 32, NULL, NULL),
(198, 56, 33, NULL, NULL),
(199, 56, 34, NULL, NULL),
(200, 56, 35, NULL, NULL),
(201, 56, 36, NULL, NULL),
(202, 56, 37, NULL, NULL),
(203, 56, 38, NULL, NULL),
(204, 56, 39, NULL, NULL),
(205, 56, 40, NULL, NULL),
(206, 56, 41, NULL, NULL),
(207, 57, 26, NULL, NULL),
(208, 57, 27, NULL, NULL),
(209, 57, 28, NULL, NULL),
(210, 57, 29, NULL, NULL),
(211, 57, 30, NULL, NULL),
(212, 57, 31, NULL, NULL),
(213, 57, 32, NULL, NULL),
(214, 57, 33, NULL, NULL),
(215, 57, 34, NULL, NULL),
(216, 57, 35, NULL, NULL),
(217, 57, 36, NULL, NULL),
(218, 57, 37, NULL, NULL),
(219, 57, 38, NULL, NULL),
(220, 57, 39, NULL, NULL),
(221, 57, 40, NULL, NULL),
(222, 57, 41, NULL, NULL),
(224, 58, 16, NULL, NULL),
(225, 58, 17, NULL, NULL),
(226, 58, 18, NULL, NULL),
(227, 58, 19, NULL, NULL),
(228, 58, 20, NULL, NULL),
(229, 58, 21, NULL, NULL),
(230, 58, 22, NULL, NULL),
(231, 58, 23, NULL, NULL),
(232, 58, 24, NULL, NULL),
(233, 58, 25, NULL, NULL),
(234, 58, 26, NULL, NULL),
(235, 58, 27, NULL, NULL),
(236, 58, 28, NULL, NULL),
(238, 59, 16, NULL, NULL),
(239, 59, 17, NULL, NULL),
(240, 59, 18, NULL, NULL),
(241, 59, 19, NULL, NULL),
(242, 59, 20, NULL, NULL),
(243, 59, 21, NULL, NULL),
(244, 59, 22, NULL, NULL),
(245, 59, 23, NULL, NULL),
(246, 59, 24, NULL, NULL),
(247, 59, 25, NULL, NULL),
(248, 59, 26, NULL, NULL),
(250, 60, 16, NULL, NULL),
(251, 60, 17, NULL, NULL),
(252, 60, 18, NULL, NULL),
(253, 60, 19, NULL, NULL),
(254, 60, 20, NULL, NULL),
(255, 60, 21, NULL, NULL),
(256, 60, 22, NULL, NULL),
(257, 60, 23, NULL, NULL),
(258, 60, 24, NULL, NULL),
(259, 60, 25, NULL, NULL),
(260, 60, 26, NULL, NULL),
(261, 60, 27, NULL, NULL),
(262, 60, 28, NULL, NULL),
(263, 60, 29, NULL, NULL),
(274, 61, 16, NULL, NULL),
(275, 61, 17, NULL, NULL),
(276, 61, 18, NULL, NULL),
(277, 61, 19, NULL, NULL),
(278, 61, 20, NULL, NULL),
(279, 61, 21, NULL, NULL),
(280, 61, 22, NULL, NULL),
(281, 61, 23, NULL, NULL),
(283, 54, 16, NULL, NULL),
(284, 54, 17, NULL, NULL),
(285, 54, 18, NULL, NULL),
(286, 54, 19, NULL, NULL),
(287, 54, 20, NULL, NULL),
(288, 54, 21, NULL, NULL),
(289, 54, 22, NULL, NULL),
(290, 54, 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_package`
--

DROP TABLE IF EXISTS `room_package`;
CREATE TABLE IF NOT EXISTS `room_package` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_id` bigint UNSIGNED NOT NULL,
  `packages_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_package_room_id_foreign` (`room_id`),
  KEY `room_package_packages_id_foreign` (`packages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_package`
--

INSERT INTO `room_package` (`id`, `room_id`, `packages_id`, `created_at`, `updated_at`) VALUES
(130, 50, 2, NULL, NULL),
(131, 50, 3, NULL, NULL),
(132, 50, 4, NULL, NULL),
(133, 50, 5, NULL, NULL),
(134, 50, 6, NULL, NULL),
(135, 51, 2, NULL, NULL),
(136, 51, 3, NULL, NULL),
(137, 51, 4, NULL, NULL),
(138, 51, 5, NULL, NULL),
(139, 51, 6, NULL, NULL),
(140, 51, 7, NULL, NULL),
(141, 51, 8, NULL, NULL),
(142, 52, 14, NULL, NULL),
(143, 53, 3, NULL, NULL),
(144, 53, 4, NULL, NULL),
(145, 53, 5, NULL, NULL),
(146, 53, 6, NULL, NULL),
(147, 53, 7, NULL, NULL),
(148, 53, 8, NULL, NULL),
(149, 53, 9, NULL, NULL),
(157, 55, 2, NULL, NULL),
(158, 55, 3, NULL, NULL),
(159, 55, 4, NULL, NULL),
(160, 55, 5, NULL, NULL),
(161, 55, 6, NULL, NULL),
(162, 55, 7, NULL, NULL),
(163, 55, 8, NULL, NULL),
(164, 55, 9, NULL, NULL),
(165, 55, 10, NULL, NULL),
(166, 56, 2, NULL, NULL),
(167, 56, 3, NULL, NULL),
(168, 56, 4, NULL, NULL),
(169, 56, 5, NULL, NULL),
(170, 56, 6, NULL, NULL),
(171, 56, 7, NULL, NULL),
(172, 56, 8, NULL, NULL),
(173, 56, 9, NULL, NULL),
(174, 57, 6, NULL, NULL),
(175, 57, 7, NULL, NULL),
(176, 57, 8, NULL, NULL),
(177, 57, 9, NULL, NULL),
(178, 57, 10, NULL, NULL),
(179, 57, 11, NULL, NULL),
(180, 57, 12, NULL, NULL),
(181, 57, 13, NULL, NULL),
(182, 57, 14, NULL, NULL),
(183, 57, 15, NULL, NULL),
(184, 57, 16, NULL, NULL),
(185, 57, 17, NULL, NULL),
(186, 57, 18, NULL, NULL),
(187, 57, 19, NULL, NULL),
(188, 57, 20, NULL, NULL),
(189, 58, 2, NULL, NULL),
(190, 58, 3, NULL, NULL),
(191, 58, 4, NULL, NULL),
(192, 58, 5, NULL, NULL),
(193, 58, 6, NULL, NULL),
(194, 58, 7, NULL, NULL),
(195, 58, 8, NULL, NULL),
(196, 58, 9, NULL, NULL),
(197, 58, 10, NULL, NULL),
(198, 59, 2, NULL, NULL),
(199, 59, 3, NULL, NULL),
(200, 59, 4, NULL, NULL),
(201, 59, 5, NULL, NULL),
(202, 59, 6, NULL, NULL),
(203, 59, 7, NULL, NULL),
(204, 59, 8, NULL, NULL),
(205, 59, 9, NULL, NULL),
(206, 59, 10, NULL, NULL),
(207, 59, 11, NULL, NULL),
(208, 59, 12, NULL, NULL),
(209, 59, 13, NULL, NULL),
(210, 59, 14, NULL, NULL),
(211, 59, 15, NULL, NULL),
(212, 60, 2, NULL, NULL),
(213, 60, 3, NULL, NULL),
(214, 60, 4, NULL, NULL),
(215, 60, 5, NULL, NULL),
(216, 60, 6, NULL, NULL),
(217, 60, 7, NULL, NULL),
(218, 60, 8, NULL, NULL),
(219, 60, 9, NULL, NULL),
(220, 60, 10, NULL, NULL),
(221, 60, 11, NULL, NULL),
(222, 60, 12, NULL, NULL),
(223, 60, 13, NULL, NULL),
(224, 60, 14, NULL, NULL),
(225, 60, 15, NULL, NULL),
(226, 60, 16, NULL, NULL),
(227, 60, 17, NULL, NULL),
(240, 61, 2, NULL, NULL),
(241, 61, 3, NULL, NULL),
(242, 61, 4, NULL, NULL),
(243, 61, 5, NULL, NULL),
(244, 61, 6, NULL, NULL),
(245, 61, 7, NULL, NULL),
(246, 61, 8, NULL, NULL),
(247, 61, 9, NULL, NULL),
(248, 61, 10, NULL, NULL),
(249, 61, 11, NULL, NULL),
(250, 61, 12, NULL, NULL),
(251, 61, 13, NULL, NULL),
(252, 54, 2, NULL, NULL),
(253, 54, 3, NULL, NULL),
(254, 54, 4, NULL, NULL),
(255, 54, 5, NULL, NULL),
(256, 54, 6, NULL, NULL),
(257, 54, 7, NULL, NULL),
(258, 54, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
CREATE TABLE IF NOT EXISTS `room_type` (
  `rty_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`rty_id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(7, 'Residences', 'residences', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2023-11-17 00:32:26', '2023-11-17 00:32:26'),
(8, 'Villa thư dãn', 'villa-thu-dan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2023-11-17 00:32:40', '2023-11-17 08:11:14'),
(9, 'Villas', 'villas', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2023-11-17 00:33:12', '2023-11-17 00:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
CREATE TABLE IF NOT EXISTS `sale` (
  `sale_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `discount` int NOT NULL,
  `start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sale_id`),
  KEY `sale_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `discount`, `start_date`, `end_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, '2023-11-11 01:06:00', '2023-11-20 01:06:00', 1, '2023-11-11 01:06:42', '2023-11-13 23:32:21'),
(2, 10, '2023-11-11 01:07:30', '2023-11-12 01:07:30', 1, '2023-11-10 01:07:30', NULL),
(3, 15, '2023-11-06 01:08:04', '2023-11-10 01:08:04', 1, '2023-11-06 01:08:04', NULL),
(6, 30, '2023-11-13 10:56:42', '2023-11-17 03:56:42', 6, '2023-11-13 10:58:15', '2023-11-13 10:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `user_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `active`, `user_type`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$oKKIuonfSOweplCogieLi.VsDFmHseaZBNei84gthLgofYJj2yIu6', 0, 'sp-admin', NULL, '2023-11-08 18:28:51', '2023-11-09 19:12:21', NULL),
(4, 'Name', 'email@gmail.com', NULL, '$2y$10$EpzyNe6DPDDrUv0CmhQ7p.fz3rkHZwZJyatI5sShSp1Ubrp6BgRCC', 0, 'admin', NULL, '2023-11-09 02:34:20', '2023-11-09 19:37:21', NULL),
(5, 'Name Test 1', 'test@gmail.com', NULL, '$2y$10$OwC4Rt.8tte7mOf7DMe8MObf/6VFw0rD1pT7hx3IVpUaoYIqxN8oa', 0, 'staff', NULL, '2023-11-09 06:58:45', '2023-11-09 19:40:27', NULL),
(6, 'Lan Anh', 'la@gmail.com', NULL, '$2y$10$3vTKtvtkEQOeK/bJJCIKiuZKN/UXpFgI/vigWAAzSFFSiIZafbZe2', 0, 'sp-admin', NULL, '2023-11-13 09:07:12', '2023-11-13 09:07:12', NULL);

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
