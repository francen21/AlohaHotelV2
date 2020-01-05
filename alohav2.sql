-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2020 at 10:55 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alohav2`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests_data`
--

CREATE TABLE `guests_data` (
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `guest_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_mobile` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_type` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_number` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_checkin_points` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_balance` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests_data`
--

INSERT INTO `guests_data` (`guest_id`, `guest_name`, `guest_mobile`, `guest_type`, `guest_number`, `guest_checkin_points`, `guest_balance`, `created_at`, `updated_at`) VALUES
(21, 'Zandree', '09498642445', 'Philippine Passport', 'w2rweag', NULL, NULL, '2019-12-26 12:00:23', '2019-12-26 15:35:13'),
(23, 'Jolens', '3333333', 'School ID', '20981472', NULL, NULL, '2019-12-26 16:15:50', '2019-12-27 12:54:41'),
(24, 'HOooosfswer', '09498642445', 'Integrated Bar of the Philippines ID', '23125234', NULL, NULL, '2019-12-26 16:20:50', '2019-12-26 16:20:50'),
(25, 'Krypt', '3289465', 'GSIS ID or GSIS UMID Card', 'rwer34fs', NULL, NULL, '2020-01-04 18:37:05', '2020-01-04 18:37:05'),
(26, 'POwe', '4353677', 'Government-issued ID proving Philippine citizenship', '7888454', NULL, NULL, '2020-01-04 18:39:01', '2020-01-04 18:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `item_code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_category` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` mediumint(120) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`inventory_id`, `item_code`, `item_category`, `item_quantity`, `created_at`, `updated_at`) VALUES
(1, 'ToothBrush', 'Category 1', 4, '2020-01-03 17:31:30', '2020-01-03 17:31:30'),
(2, 'AB324', 'Category 2', 40, '2020-01-03 17:35:16', '2020-01-03 18:02:08');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_25_210742_create_reservationdata_table', 2),
(5, '2019_12_25_213357_create_roomdata_table', 3),
(6, '2019_12_25_214833_create_guestdata_table', 3),
(7, '2019_12_27_235127_create_floors_table', 4),
(8, '2020_01_01_185950_create_inventories_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations_data`
--

CREATE TABLE `reservations_data` (
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `room_number` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `guest_cap` smallint(255) UNSIGNED DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations_data`
--

INSERT INTO `reservations_data` (`reservation_id`, `room_number`, `guest_id`, `guest_cap`, `check_in`, `check_out`, `created_at`, `updated_at`) VALUES
(8, 301, 21, 3, '2019-12-27', '2019-12-28', '2019-12-26 11:42:07', '2019-12-26 11:42:07'),
(24, 301, 23, 5, '2019-12-27', '2019-12-28', '2019-12-26 16:15:50', '2019-12-27 12:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_data`
--

CREATE TABLE `rooms_data` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `room_floor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_number` int(10) UNSIGNED NOT NULL,
  `room_tarrif` double(80,2) NOT NULL,
  `room` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_sales` int(10) UNSIGNED DEFAULT NULL,
  `room_views` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms_data`
--

INSERT INTO `rooms_data` (`room_id`, `room_floor`, `room_type`, `room_status`, `room_number`, `room_tarrif`, `room`, `room_sales`, `room_views`, `created_at`, `updated_at`) VALUES
(3, '4', 'City Side', 'For Inspection', 4, 0.00, '44', NULL, NULL, '2019-12-29 04:21:34', '2019-12-29 04:21:34'),
(4, '33', 'City Side', 'For Inspection', 5, 5983428.00, '335', NULL, NULL, '2019-12-29 04:21:58', '2019-12-30 11:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$phdx9U0UahVVq5zdyRGDfOxuZs6SFR54PyabZk.p1.1vpXBKAkPte', 'j4JtBtR6iVZfZVdfFIewGN0BX2MMWyjw7pcKvXkUifdL6rAE21MULnCXOVSx', '2019-12-23 05:44:58', '2019-12-23 05:44:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests_data`
--
ALTER TABLE `guests_data`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`inventory_id`);

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
-- Indexes for table `reservations_data`
--
ALTER TABLE `reservations_data`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `rooms_data`
--
ALTER TABLE `rooms_data`
  ADD PRIMARY KEY (`room_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests_data`
--
ALTER TABLE `guests_data`
  MODIFY `guest_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `inventory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservations_data`
--
ALTER TABLE `reservations_data`
  MODIFY `reservation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rooms_data`
--
ALTER TABLE `rooms_data`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
