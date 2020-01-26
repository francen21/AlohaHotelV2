-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 11:51 PM
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
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` smallint(5) UNSIGNED NOT NULL,
  `price` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `room_id`, `guest_id`, `code`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 16, 5, 'AB324', 2, 400.00, '2020-01-22 15:55:40', NULL),
(2, 16, 5, 'BES23A', 2, 400.00, '2020-01-22 18:29:09', NULL),
(3, 17, 44, 'TUTYYE3', 35, 40.00, '2020-01-22 21:20:18', NULL),
(5, 16, 1, 'AB324', 2, 400.00, '2020-01-23 03:37:26', '2020-01-23 03:37:26');

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
-- Table structure for table `guests_data`
--

CREATE TABLE `guests_data` (
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `guest_tittle` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_name` varchar(23) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_lastname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'Others',
  `guest_address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Undefined',
  `guest_city` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Undefined',
  `guest_country` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Undefined',
  `guest_email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT 'Undefined',
  `guest_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_number` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'No remarks',
  `guest_checkin_points` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_balance` double(8,2) DEFAULT NULL,
  `alter_name` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alter_lastname` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alter_city` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'Undefined',
  `alter_country` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'Undefined',
  `howFind` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'Undefined',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests_data`
--

INSERT INTO `guests_data` (`guest_id`, `guest_tittle`, `guest_name`, `guest_lastname`, `guest_gender`, `guest_address`, `guest_city`, `guest_country`, `guest_email`, `guest_mobile`, `guest_type`, `guest_number`, `guest_remarks`, `guest_checkin_points`, `guest_balance`, `alter_name`, `alter_lastname`, `alter_city`, `alter_country`, `howFind`, `created_at`, `updated_at`) VALUES
(1, 'Mr.', 'Tommy', 'Aquestas', 'Male', 'Binondo St.', 'Manila', 'Philippines', 'tommy@gmail.com', '09483765555', 'PRC ID', '99999999', NULL, NULL, NULL, 'Tommy', 'Aquestas', 'Manila', 'Philippines', 'Social Media', '2020-01-20 12:33:12', '2020-01-20 14:59:37'),
(4, 'Ms.', 'Jenny', 'Lynn', 'Female', 'Manila', 'Quezon City', 'Philippines', 'jenny@gmail.com', '092374736', 'GSIS ID or GSIS UMID Card', 'N03823HSD984', NULL, NULL, NULL, 'Mario', 'Luis', 'Taguig', 'Philippines', 'Social Media', '2020-01-25 10:25:46', '2020-01-25 10:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `item_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`inventory_id`, `item_code`, `item_category`, `item_quantity`, `item_price`, `created_at`, `updated_at`) VALUES
(1, 'AB324', 'Category 2', '33', 200.00, '2020-01-10 03:17:34', '2020-01-10 03:17:34'),
(2, 'BES23A', 'Item', '35', 35.00, '2020-01-22 18:28:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_25_213357_create_roomdata_table', 1),
(12, '2020_01_01_185950_create_inventories_table', 1),
(13, '2020_01_06_144625_create_rates_table', 1),
(14, '2020_01_06_144717_create_occus_table', 1),
(15, '2020_01_09_170701_create_log_activity_table', 2),
(20, '2019_12_25_210742_create_reservationdata_table', 4),
(21, '2019_12_25_214833_create_guestdata_table', 4),
(22, '2020_01_19_110659_create_charges_table', 4),
(23, '2020_01_19_113756_create_payments_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occus`
--

CREATE TABLE `occus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `occupancy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adjustment` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `occus`
--

INSERT INTO `occus` (`id`, `occupancy`, `adjustment`, `created_at`, `updated_at`) VALUES
(1, '50', 10, '2020-01-25 16:26:54', '2020-01-25 16:26:54'),
(2, '70', 15, '2020-01-26 02:49:38', '2020-01-26 02:49:38'),
(3, '90', 20, '2020-01-26 02:52:33', '2020-01-26 02:52:33'),
(4, '95', 30, '2020-01-26 02:52:47', '2020-01-26 02:52:47'),
(5, '15', 10, '2020-01-26 03:34:52', '2020-01-26 03:34:52'),
(6, '5', 20, '2020-01-26 03:44:11', '2020-01-26 03:44:11');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(10,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `room_type`, `rate`, `created_at`, `updated_at`) VALUES
(3, 'Suite', '4500', '2020-01-25 23:28:02', '2020-01-25 18:12:59'),
(4, 'East Side', '1000', '2020-01-25 16:25:55', '2020-01-25 18:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `reservations_data`
--

CREATE TABLE `reservations_data` (
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = reserved; 2 = checkedin; 3 = unpaid; 4 = late check_out;',
  `room_number` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `guest_cap` smallint(5) UNSIGNED NOT NULL,
  `discount_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breakfast` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Breakfast',
  `grace_time` time NOT NULL,
  `purpose_visit` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_persons` tinyint(4) NOT NULL,
  `male_` tinyint(4) NOT NULL,
  `female_` tinyint(4) NOT NULL,
  `children_` tinyint(4) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations_data`
--

INSERT INTO `reservations_data` (`reservation_id`, `status`, `room_number`, `guest_id`, `guest_cap`, `discount_type`, `breakfast`, `grace_time`, `purpose_visit`, `from`, `to`, `number_persons`, `male_`, `female_`, `children_`, `check_in`, `check_out`, `created_at`, `updated_at`) VALUES
(1, 2, 32, 1, 3, 'VIP', 'No Breakfast', '01:00:00', 'Vacation', 'Manila', 'Manila', 3, 1, 1, 1, '2020-01-26', '2020-01-30', '2020-01-20 12:36:02', '2020-01-25 13:57:16'),
(2, 1, 34, 4, 1, 'VIP', 'No Breakfast', '01:00:00', 'Vacation', 'Japan', 'Manila', 1, 0, 1, 0, '2020-01-28', '2020-01-29', '2020-01-25 10:25:46', '2020-01-25 10:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_data`
--

CREATE TABLE `rooms_data` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `room` int(20) UNSIGNED DEFAULT NULL,
  `room_floor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_number` int(10) UNSIGNED NOT NULL,
  `room_sales` int(10) UNSIGNED DEFAULT NULL,
  `room_views` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms_data`
--

INSERT INTO `rooms_data` (`room_id`, `room`, `room_floor`, `room_type`, `room_status`, `room_number`, `room_sales`, `room_views`, `created_at`, `updated_at`) VALUES
(16, 432, '4', 'City Side', 'Occupied', 32, NULL, NULL, '2020-01-09 08:47:18', '2020-01-25 13:57:16'),
(17, 433, '4', 'Bay Side', 'For Inspection', 33, NULL, NULL, '2020-01-25 10:19:03', '2020-01-25 10:19:03'),
(18, 434, '4', 'Suite', 'Reserved', 34, NULL, NULL, '2020-01-25 10:19:17', '2020-01-25 10:25:46'),
(19, 435, '4', 'City Side', 'For Inspection', 35, NULL, NULL, '2020-01-25 10:19:37', '2020-01-25 10:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tommy', 'admin', 'admin@gmail.com', NULL, '$2y$10$phdx9U0UahVVq5zdyRGDfOxuZs6SFR54PyabZk.p1.1vpXBKAkPte', 'YBIeUg0KQl7czjMYxfkGDhOZr4mg0D5OTCC7BweZxEqJGd5ZWiP7xE9DKu1f', '2020-01-09 16:00:00', NULL),
(2, 'Umlas', 'admin', 'admin2@gmail.com', NULL, '$2y$10$3cZpK8vorKlokrh8X/khouCzdBc9MsarOG36qLK7HLdccAszXFvmi', NULL, '2020-01-09 09:44:04', '2020-01-09 09:44:04'),
(3, 'Bry', 'admin', 'zandreetresvalles22@gmail.com', NULL, '$2y$10$yoefZ/XNRGteP5edlZ1f9OPtU/btGrOMAN0eW74LAeHWZQur0bpi6', NULL, '2020-01-09 10:12:53', '2020-01-09 10:12:53'),
(4, 'Paul', 'admin', 'admin4@gmail.com', NULL, '$2y$10$D6XudMtbXpmNA1kFJwEAI.959gahTylgV6v2cjlwBNRPepRdpkNsq', NULL, '2020-01-09 11:47:37', '2020-01-09 11:47:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `occus`
--
ALTER TABLE `occus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests_data`
--
ALTER TABLE `guests_data`
  MODIFY `guest_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `inventory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occus`
--
ALTER TABLE `occus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations_data`
--
ALTER TABLE `reservations_data`
  MODIFY `reservation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms_data`
--
ALTER TABLE `rooms_data`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
