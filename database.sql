-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2026 at 12:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `offer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'logout', 'قام المستخدم Noor Yasser بتسجيل الخروج', '2026-01-18 09:40:11', '2026-01-18 09:40:11'),
(2, 1, 'login', 'قام المستخدم Noor Yasser بتسجيل الدخول', '2026-01-18 09:40:19', '2026-01-18 09:40:19'),
(3, 1, 'logout', 'قام المستخدم Noor Yasser بتسجيل الخروج', '2026-01-18 09:40:22', '2026-01-18 09:40:22'),
(4, 1, 'login', 'قام المستخدم Noor Yasser بتسجيل الدخول', '2026-01-18 09:40:32', '2026-01-18 09:40:32'),
(5, 1, 'logout', 'قام المستخدم Noor Yasser بتسجيل الخروج', '2026-01-18 09:40:35', '2026-01-18 09:40:35'),
(6, 1, 'login', 'قام المستخدم Noor Yasser بتسجيل الدخول', '2026-01-18 09:41:21', '2026-01-18 09:41:21'),
(7, 1, 'add', 'قام المستخدم Noor Yasser بإضافة مستخدم جديد: asdfasd', '2026-01-18 09:51:39', '2026-01-18 09:51:39'),
(8, 1, 'edit', 'قام المستخدم Noor Yasser بتعديل المستخدم: asdfasd', '2026-01-18 09:55:04', '2026-01-18 09:55:04'),
(9, 1, 'edit', 'قام المستخدم Noor Yasser بتعديل المستخدم: asdfasd', '2026-01-18 09:55:09', '2026-01-18 09:55:09');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(5, '2026_01_18_081838_create_logs_table', 2),
(6, '2026_01_18_113012_add_username_to_users_table', 2);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Ty7gjUJhRdlNKvbsDqpoD1Y9BpNf4rqfPjfSVmw1', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicVd5b3ZMU0cwbnBaWkRpYklrWEpCRGdqaUpjd05NSGwzaDBuMjdMbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo2OiJsb2NhbGUiO3M6MjoiYXIiO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvYXIvdXNlcnMvbGlzdD9wYWdlPTEmcGVyX3BhZ2U9MTAiO3M6NToicm91dGUiO3M6MTA6InVzZXJzLmxpc3QiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1768737319);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `age`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Noor Yasser', 'noor1yasser9', 'noor1yasser9@gmail.com', 25, NULL, '$2y$12$qH0rojkFxc6bL6CyE3EmEeAv6tPIkr35TjpqrELVM8CHGv36CObLG', NULL, '2026-01-18 06:19:49', '2026-01-18 06:19:49'),
(4, 'شسيبشس234234', 'etert', 'etert@fs.sdf32', 54, NULL, '$2y$12$GXRAgROV5X9xuvAPCCG17eoIDIAtq/11PRnwQEHG6KnaGqjIvA7tm', NULL, '2026-01-18 08:01:48', '2026-01-18 08:52:56'),
(5, 'asdfasdf', 'qwerq', 'qwerq@das.asd', 23, NULL, '$2y$12$emEa9Y04G76Xc.wuFDuSLuSeczmSgL/K3O3MrMvfWD6XHV10efq/.', NULL, '2026-01-18 08:53:16', '2026-01-18 08:53:16'),
(6, 'asdfasdf', 'qwe2rq', 'qwe2rq@das.asd', 23, NULL, '$2y$12$emEa9Y04G76Xc.wuFDuSLuSeczmSgL/K3O3MrMvfWD6XHV10efq/.', NULL, '2026-01-18 08:53:16', '2026-01-18 08:53:16'),
(7, 'asdfasdf', 'q3we2rq', 'q3we2rq@das.asd', 23, NULL, '$2y$12$emEa9Y04G76Xc.wuFDuSLuSeczmSgL/K3O3MrMvfWD6XHV10efq/.', NULL, '2026-01-18 08:53:16', '2026-01-18 08:53:16'),
(8, 'asdfasdf', 'q3we42rq', 'q3we42rq@das.asd', 23, NULL, '$2y$12$emEa9Y04G76Xc.wuFDuSLuSeczmSgL/K3O3MrMvfWD6XHV10efq/.', NULL, '2026-01-18 08:53:16', '2026-01-18 08:53:16'),
(9, 'asdfasdf', 'q3we3242rq', 'q3we3242rq@das.asd', 23, NULL, '$2y$12$emEa9Y04G76Xc.wuFDuSLuSeczmSgL/K3O3MrMvfWD6XHV10efq/.', NULL, '2026-01-18 08:53:16', '2026-01-18 08:53:16'),
(10, 'Noor Yasser', '3noor1yasser9', '3noor1yasser9@gmail.com', 25, NULL, '$2y$12$qH0rojkFxc6bL6CyE3EmEeAv6tPIkr35TjpqrELVM8CHGv36CObLG', NULL, '2026-01-18 06:19:49', '2026-01-18 06:19:49'),
(12, 'شسيبشس234234', 'etert1', 'etert@fs.sdf323', 54, NULL, '$2y$12$GXRAgROV5X9xuvAPCCG17eoIDIAtq/11PRnwQEHG6KnaGqjIvA7tm', NULL, '2026-01-18 08:01:48', '2026-01-18 08:52:56'),
(13, 'شسيبشس234234', 'etedrt', 'etedrt@fs.sdf323', 54, NULL, '$2y$12$GXRAgROV5X9xuvAPCCG17eoIDIAtq/11PRnwQEHG6KnaGqjIvA7tm', NULL, '2026-01-18 08:01:48', '2026-01-18 08:52:56'),
(14, 'شسيبشس234234', 'ete3drt', 'ete3drt@fs.sdf323', 54, NULL, '$2y$12$GXRAgROV5X9xuvAPCCG17eoIDIAtq/11PRnwQEHG6KnaGqjIvA7tm', NULL, '2026-01-18 08:01:48', '2026-01-18 08:52:56'),
(15, 'asdfasdf', 'qwer3q', 'qwer3q@das.asd', 23, NULL, '$2y$12$emEa9Y04G76Xc.wuFDuSLuSeczmSgL/K3O3MrMvfWD6XHV10efq/.', NULL, '2026-01-18 08:53:16', '2026-01-18 08:53:16'),
(16, 'Noor Yasser', 'noor1ya4sser9', 'noor1ya4sser9@gmail.com', 25, NULL, '$2y$12$qH0rojkFxc6bL6CyE3EmEeAv6tPIkr35TjpqrELVM8CHGv36CObLG', NULL, '2026-01-18 06:19:49', '2026-01-18 06:19:49'),
(18, 'asdfasd', 'asdfasdf٣٢', 'asdfasdfasd@daad.asd', 22, NULL, '$2y$12$PFaPZydNwmzedWiEaDKsduz.wnYpsSu5Q92RYsFJxyJ/1Erb0rge.', NULL, '2026-01-18 09:51:39', '2026-01-18 09:55:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
