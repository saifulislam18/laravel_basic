-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 07:13 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disable',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `name`, `username`, `email`, `password`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Msi1', 'msisaiful', 'msisaifulsaif@gmail.com', '$2y$10$ZNb4q2PMKF8QrB.p9PRtPeulWcPlHfCrtDXT8qKe.WCL98OkEhDAe', '1534301895@titledownload.png', 'active', 'IKXBRglR9ZYOjLCFBqb7XI1y0RH6qobbcVTfpjzKo3wp1RTHa3KowjIMoogO', '2018-08-09 08:51:22', '2018-08-14 20:58:15'),
(3, 4, 'Subscriber', 'subscriber', 'subscriber@gmail.com', '$2y$10$K5BUPMiSPo2dK2pG/ekXCuMbppxvvH64nOeB3GgxACrGq2LvEdGpq', NULL, 'active', 'KoLtqO1G7UHpMclIJQyfvN8S4i0ngSn1qqz2HpIZDKTHMfBYzDftNJGmDWjz', '2018-08-16 10:43:26', '2018-08-16 10:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_password_resets`
--

INSERT INTO `admin_password_resets` (`email`, `token`, `created_at`) VALUES
('msisaifulsaif@gmail.com', '$2y$10$nmzxk3ThOEiWOoHfkkj0IOBZ0LGIdFCcHC0b1yg3mkvnzJ/6zhYcC', '2018-08-09 11:19:29'),
('msi1.saiful@gmail.com', '$2y$10$IfWl9MsF1D27Ntrmt0zyW.kXMB74oc0mCDYGxYyNiEEe/FbOkWHgO', '2018-08-09 11:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_09_070854_create_admins_table', 1),
(4, '2018_08_09_070855_create_admin_password_resets_table', 1),
(5, '2018_08_09_143641_create_roles_table', 1),
(6, '2018_08_15_031039_create_terms_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'adminstrator', '2018-08-09 08:48:54', '2018-08-09 08:48:54'),
(2, 'editor', '2018-08-09 08:48:54', '2018-08-09 08:48:54'),
(3, 'author', '2018-08-09 08:48:54', '2018-08-09 08:48:54'),
(4, 'subscriber', '2018-08-09 08:48:54', '2018-08-09 08:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `user_id`, `type`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(18, 1, 'category', 'Mobile', NULL, '2018-08-16 10:57:30', '2018-08-16 11:04:19'),
(19, 2, 'category', 'book', NULL, '2018-08-16 11:02:26', '2018-08-16 11:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disable',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lina Volkman', 'lionel03@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'WOjugmIqQ3', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(2, 'Prof. Jaylen O\'Conner III', 'kunde.zackary@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'fvv1RXd2n9', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(3, 'Hilbert Dicki', 'nquigley@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'mKywcHnclx', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(4, 'Prof. Justice Howell', 'pearlie.weimann@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'iGOt0uqvUx', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(5, 'Althea Rempel', 'darby.greenholt@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'LpZAPCMMWC', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(6, 'Vince Wilkinson', 'jovani.wolff@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'gLRRT48h0N', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(7, 'Mckenzie Medhurst', 'johnston.maye@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'khitBkBiMB', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(8, 'Clinton Walsh', 'erik46@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'm6qMKG4OAJ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(9, 'Dawson Jacobs II', 'carter.queen@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'bqZkL1MAPV', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(10, 'Keshawn Osinski', 'pierce.gleason@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'T2O7bR5Yeb', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(11, 'Shane West', 'marquardt.hank@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'izAnxoM0EJ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(12, 'Myah Franecki DVM', 'cummerata.enoch@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'bmPWYnCquN', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(13, 'Thea Dibbert', 'adare@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'EoQ3u7a1n2', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(14, 'Ms. Amalia Hessel DDS', 'savannah63@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '2tk8lkij44', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(15, 'Ms. Savanah Pacocha V', 'myrtle.kessler@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'BdyNRqSsBs', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(16, 'Angelita Bechtelar', 'yundt.janessa@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'RSQXXKwM8u', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(17, 'Ansley Kris', 'michel81@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'ahYbuSuZ0p', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(18, 'Lurline Ankunding', 'jmosciski@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'U9jXWrWAMR', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(19, 'Danyka Collins', 'tierra82@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'Yj2dRBJC16', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(20, 'Taryn Mills', 'joyce.dicki@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'DCtZpB5VX4', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(21, 'Rhea Bechtelar', 'ron.kohler@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'TQITorE6QX', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(22, 'Miss Kira Lowe I', 'qryan@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'Z9jVsDkxy2', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(23, 'Leopoldo Harber', 'vnikolaus@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '0rPjvAZDYG', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(24, 'Lelah Daugherty', 'damian.gusikowski@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'UGvomhulC8', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(25, 'Mrs. Mandy Schamberger I', 'cloyd.jacobi@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'Qhc8EdoRzG', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(26, 'Alta Hermiston', 'gerdman@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '00ceaqVcsm', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(27, 'Alejandrin Larson', 'brekke.alphonso@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'x5HODHmz9C', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(28, 'Darrell Terry', 'janick.lockman@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'wWCMkDJn0S', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(29, 'Ms. Marlen Ernser', 'fahey.floy@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'YII2Y3dqzX', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(30, 'Prof. Sigmund Weber Jr.', 'mwelch@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '3d5I43a1Zq', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(31, 'Moses Nolan', 'ghammes@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '5E5chNMnNc', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(32, 'Bria Metz', 'lou.funk@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'ONaoRdYNxn', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(33, 'Prof. Jared Abshire', 'polly.jaskolski@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '6nCTGn46MQ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(34, 'Claudia Schowalter', 'kgerhold@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'TcKEEpQZPK', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(35, 'Carmen Kunze', 'volkman.fredrick@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'KC04rmX21A', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(36, 'Matteo Pouros', 'king11@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'VBCArJ4WIn', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(37, 'Dr. Markus Bartell', 'kautzer.elenor@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '5ZTVHAzwvn', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(38, 'Estrella Kris IV', 'huel.dustin@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'HKDrGHvKvm', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(39, 'Keara Gleichner Jr.', 'houston64@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'AhvLyDflVf', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(40, 'Dr. Florence Schaden II', 'dbaumbach@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'z7p6EiwGWg', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(41, 'Mrs. Allison Watsica II', 'dulce.schroeder@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '4YX5QQMUBR', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(42, 'Prof. Clarabelle Hand', 'boyd68@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'wz6QWsxVNc', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(43, 'Warren Boyer', 'vernie03@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '3eNiCtjd2g', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(44, 'Mr. Monty Franecki Sr.', 'britney73@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'ZmZAksiOjk', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(45, 'Dr. Lucius Osinski DVM', 'nikolaus.javonte@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'sgeVguMMI1', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(46, 'Tod Waelchi', 'muriel.miller@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'LeLSekxN60', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(47, 'Dr. Makenzie Robel', 'hgreenholt@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'iTPQPdOoql', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(48, 'Elliot Gerhold', 'gaston.wisoky@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'P4VugsmsiJ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(49, 'Sid Rogahn II', 'phyllis11@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'Vw2fBcssaQ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(50, 'Sheldon Crooks', 'ernie.howell@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'MCNxfyyhRw', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(51, 'Mozell Wolff', 'sebert@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'KYWDasDP75', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(52, 'Alta Collier DVM', 'reyes.zemlak@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'pF0qTDwcGz', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(53, 'Prof. Jeromy Doyle', 'vziemann@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'yMiMZFFEsr', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(54, 'Eli Turner', 'towne.zion@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'bv6w39wgut', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(55, 'Anita Mohr IV', 'bmarks@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'bbgfyaPLNx', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(56, 'Victoria Pagac', 'zieme.danyka@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'IxUl5XvST1', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(57, 'Robert Morar', 'hpollich@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'oCervIhoI3', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(58, 'Rodolfo Monahan', 'hbernhard@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'FP3w6fcgLL', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(59, 'Prof. Blaise Wolff', 'labadie.ashly@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '8lQpCHx034', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(60, 'Bonita Halvorson', 'ulices01@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'YLAkHSKl45', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(61, 'Lempi Ruecker', 'marisol81@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'ZcNVF7VeL1', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(62, 'Estelle Huel', 'nettie90@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'o1afGhOb6O', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(63, 'Magnolia Abshire', 'andreanne.christiansen@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'PIcRo7sp9M', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(64, 'Dr. Austen Cruickshank MD', 'darron46@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'xvUJFF7HhX', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(65, 'Miss Amaya Conn', 'nicholaus.lehner@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'NYOvXFMZt2', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(66, 'Sabryna Jones', 'yrutherford@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '5rVxFujxFa', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(67, 'Rasheed Weimann', 'tevin.fisher@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'MjuAxwFxVx', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(68, 'Pattie Schowalter', 'kim23@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'Y6H5Jt6EBh', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(69, 'Prof. Anna Goyette Jr.', 'adam.bashirian@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'PCQzLUOHxF', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(70, 'Toy Bruen', 'jryan@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'qWf5Yiprwp', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(71, 'Mellie Parker', 'kathlyn.friesen@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'v0qrz3CVOY', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(72, 'Ayla Bednar Sr.', 'ldamore@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '46u6SZv6pB', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(73, 'Marty Corwin V', 'jakubowski.jannie@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'tffeEHU32u', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(74, 'Raphaelle Reinger', 'kurt.corkery@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'IYmykN0Lhu', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(75, 'Nash King', 'effertz.mohamed@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'PbKpQbzNxJ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(76, 'Prof. Alfredo Wiza Sr.', 'allan35@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '9cmsATPeIk', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(77, 'Emmanuelle Kuvalis', 'prolfson@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'aNIFzHNkAn', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(78, 'Efren Kozey', 'omari22@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'rqmqLXhlza', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(79, 'Dr. Harry Rempel', 'marianne.breitenberg@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'U99y1E3F6M', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(80, 'Billie Leuschke', 'bjerde@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'ZP98TfUofm', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(81, 'Dr. Georgiana Osinski', 'kiera47@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'QNUnIetnoG', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(82, 'Madelynn Lebsack I', 'gage.beer@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'Q84ediiDtU', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(83, 'Ms. Ruthie Weber III', 'waelchi.dolly@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'DTQTw9GZ8C', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(84, 'Helga Collier', 'louvenia.wyman@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'Y945UOlSFJ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(85, 'Miss Jeanie Mohr PhD', 'bergstrom.viviane@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'wMYbqJNPR8', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(86, 'Ms. Damaris Koelpin V', 'willms.dejuan@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'yBpGBbMbDt', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(87, 'Brandy Smitham', 'hferry@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '7obnX9jp3L', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(88, 'Prof. Keely McGlynn', 'nola94@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'TEbaDzlbhY', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(89, 'Mohammad Waelchi II', 'jermain.murray@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'fQQZF5qvnr', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(90, 'Gianni Corkery', 'walsh.reanna@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'SoU8dsAY8d', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(91, 'Adam VonRueden III', 'modesto.bernier@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '8h7Bz2KLXP', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(92, 'Mariane Bartoletti', 'sophie.maggio@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'ZXK2025sui', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(93, 'Prof. Antoinette Funk MD', 'daniela.kessler@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'oBnG9P8KPp', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(94, 'Kacey Huel', 'tara.feil@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '7bk93DVOVb', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(95, 'Angela Nitzsche', 'oscar41@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'VFlRAzLbjb', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(96, 'Columbus Bradtke V', 'deondre72@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'KfOI5l4A3L', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(97, 'Una Beier IV', 'rahsaan61@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'ZpTCO2BHrP', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(98, 'Abe Leffler', 'ahmed02@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'cQxYMknuZX', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(99, 'Carlotta Bartell', 'charlie.kuhn@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', '2HVsmep3WZ', '2018-08-10 03:21:49', '2018-08-10 03:21:49'),
(100, 'Elizabeth Hickle', 'diana.vandervort@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'disable', 'VmYl0t8pae', '2018-08-10 03:21:49', '2018-08-10 03:21:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`),
  ADD KEY `admin_password_resets_token_index` (`token`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
