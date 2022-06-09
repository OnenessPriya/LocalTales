-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 02:56 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OneNess_localtales_pre_launch_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bottom_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `suburb_id` int NOT NULL,
  `meta_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `title`, `slug`, `image`, `address`, `rating`, `short_description`, `bottom_content`, `description`, `pin_code`, `suburb_id`, `meta_title`, `meta_key`, `meta_description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651059125.cafe-1.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '70003', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-01-12 23:48:52', '2022-04-27 06:02:05'),
(3, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651059025.cafe-2.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '700003', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-04-22 02:12:20', '2022-04-27 06:00:25'),
(4, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum', '1651059185.cafe-3.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>\r\n<div class=\"d-flex justify-content-between align-items-center\">&nbsp;</div>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>\r\n<div class=\"d-flex justify-content-between align-items-center\">&nbsp;</div>', '700001', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-04-27 05:37:55', '2022-04-27 06:03:05'),
(5, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651058103.cafe-2.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '785214', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>\r\n<div class=\"d-flex justify-content-between align-items-center\">&nbsp;</div>', 1, '2022-04-27 05:45:03', '2022-04-27 05:45:03'),
(6, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651059154.cafe-5.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '70002', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-04-27 05:46:40', '2022-04-27 06:02:34'),
(7, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651147190.collection-1.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '2601', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-04-28 06:27:43', '2022-04-28 06:29:50'),
(8, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651147166.collection-2.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '2602', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-04-28 06:29:26', '2022-04-28 06:29:26'),
(9, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651147241.collection-3.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '2914', 4, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-04-28 06:30:41', '2022-04-28 06:30:41'),
(10, 'Aenean sollicitudin, lorem quis bibendum', 'aenean-sollicitudin-lorem-quis-bibendum-2', '1651646710.collection-4.png', 'South Melbourne, Melbourne', '4.5', 'Aenean sollicitudin, lorem quis bibendum', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', '2614', 6, 'meta title', 'meta key', '<h4>Aenean sollicitudin, lorem quis bibendum</h4>', 1, '2022-04-28 06:31:58', '2022-05-04 01:15:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
