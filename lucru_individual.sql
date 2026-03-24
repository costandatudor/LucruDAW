-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2026 at 10:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lucru_individual`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('andrei.georgescu@example.com', 'xyz789uvw456tsr321qpo012nml345kji678hgf901edc234ba', '2026-03-24 09:30:00'),
('ion.popescu@example.com', 'abc123def456ghi789jkl012mno345pqr678stu901vwx234yz', '2026-03-24 08:00:00');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ion Popescu', 'ion.popescu@example.com', '2026-03-24 06:00:00', '$2y$12$N9qo8uLOickgx2zf.Mf1vu6mHkisUjiLCKUHhWxJ3v7kRK4JN8H8K', NULL, '2026-03-20 08:30:00', '2026-03-24 07:15:00'),
(2, 'Maria Ionescu', 'maria.ionescu@example.com', '2026-03-23 12:25:00', '$2y$12$N9qo8uLOickgx2zf.Mf1vu6mHkisUjiLCKUHhWxJ3v7kRK4JN8H8K', 'token_abc123xyz', '2026-03-21 12:45:00', '2026-03-23 14:50:00'),
(3, 'Andrei Georgescu', 'andrei.georgescu@example.com', NULL, '$2y$12$N9qo8uLOickgx2zf.Mf1vu6mHkisUjiLCKUHhWxJ3v7kRK4JN8H8K', NULL, '2026-03-22 07:20:00', '2026-03-22 07:20:00'),
(4, 'Elena Dumitru', 'elena.dumitru@example.com', '2026-03-24 09:00:00', '$2y$12$N9qo8uLOickgx2zf.Mf1vu6mHkisUjiLCKUHhWxJ3v7kRK4JN8H8K', 'token_def456uvw', '2026-03-19 14:15:00', '2026-03-24 10:30:00'),
(5, 'Mihai Nikolas', 'mihai.nikolas@example.com', '2026-03-24 05:45:00', '$2y$12$N9qo8uLOickgx2zf.Mf1vu6mHkisUjiLCKUHhWxJ3v7kRK4JN8H8K', NULL, '2026-03-23 11:00:00', '2026-03-24 11:45:00');

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
