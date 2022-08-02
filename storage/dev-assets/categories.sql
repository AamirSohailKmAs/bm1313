-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2022 at 07:17 AM
-- Server version: 5.7.32-35-log
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbiirziynpl7y`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Samsung ', NULL, '2022-03-11 11:15:17', '2022-03-11 11:15:17'),
(2, 'APPLE', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(3, 'OPPO', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(4, ' Huawei', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(5, 'Redmi', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(6, 'WIKO', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(7, 'SONY ', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(8, 'ALCATEL', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(9, 'VIVO', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(10, 'Asus', NULL, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(11, 'BATRRY ', 2, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(12, 'PHONE', 2, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(13, 'PHONE', 3, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(14, 'Huawei lcd', 4, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(15, ' Huawei lcd-Tablet', 4, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(16, 'Redmi lcd', 5, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(17, 'Xiaomi lcd', 5, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(18, 'Nokia Lcd', 6, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(19, 'SONY XPERIA', 7, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(20, 'ALCATEL', 7, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(21, 'A Serie', 1, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(22, 'S Serie', 1, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(23, 'J Serie', 1, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(24, 'Note Serie', 1, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(25, 'M Serie', 1, '2022-03-11 11:15:18', '2022-03-11 11:15:18'),
(26, 'phone', 4, '2022-03-11 11:15:18', '2022-03-11 11:15:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
