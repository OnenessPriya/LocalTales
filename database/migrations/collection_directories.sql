-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 02:57 PM
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
-- Table structure for table `collection_directories`
--

CREATE TABLE `collection_directories` (
  `id` bigint UNSIGNED NOT NULL,
  `collection_id` int NOT NULL,
  `directory_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collection_directories`
--

INSERT INTO `collection_directories` (`id`, `collection_id`, `directory_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 1, '2022-04-13 04:07:20', '2022-04-22 02:24:33'),
(3, 3, 20, 1, '2022-04-22 02:25:11', '2022-04-22 02:25:11'),
(4, 2, 9, 1, '2022-05-09 06:39:52', '2022-05-09 06:39:52'),
(5, 3, 10, 1, '2022-05-09 07:17:45', '2022-05-09 07:17:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collection_directories`
--
ALTER TABLE `collection_directories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collection_directories`
--
ALTER TABLE `collection_directories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
