-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 11:57 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_electre`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `prodi` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode`, `nama`, `prodi`, `created_at`, `updated_at`) VALUES
(1, 'A1', 'Muhammad Rasya', 'Teknik Informatika (S1)', '2025-02-14 11:41:23', '2025-02-14 11:41:23'),
(2, 'A2', 'Muhammad Alif Alfarino', 'Teknik Informatika (S1)', '2025-02-14 18:28:12', '2025-02-14 18:28:12'),
(3, 'A3', 'M.Yusri Hafizd', 'Sistem Informasi (S1)', '2025-02-14 18:28:33', '2025-02-14 18:28:33'),
(4, 'A4', 'Hamdan prayoga', 'Sistem Informasi (S1)', '2025-02-14 18:28:56', '2025-02-14 18:28:56'),
(5, 'A5', 'Reynold Satria Mahendra', 'Teknik Informatika (S1)', '2025-02-14 18:29:09', '2025-02-14 18:29:09'),
(6, 'A6', 'Putri Shyfa Khairani', 'Sistem Informasi', '2025-02-15 02:54:32', '2025-02-15 02:55:21'),
(7, 'A7', 'Muhammad Zaki', 'Teknik Informatika', '2025-02-15 06:35:00', '2025-02-15 06:35:00'),
(8, 'A8', 'Tiara Fransica Br. Sihole', 'Teknik Informatika', '2025-02-15 06:35:27', '2025-02-15 06:35:27'),
(9, 'A9', 'Siti Fatimah', 'Sistem Informasi', '2025-02-15 06:35:55', '2025-02-15 06:35:55'),
(10, 'A10', 'Mhd. Ahyar Faturrahim', 'Komputerisasi Akuntansi', '2025-02-15 06:36:32', '2025-02-15 06:36:32'),
(11, 'A11', 'Renita Br. Tarigan', 'Sistem Informasi', '2025-02-15 06:36:49', '2025-02-15 06:36:49'),
(12, 'A12', 'Doni Dwi Sutrisno', 'Sistem Informasi', '2025-02-15 06:37:09', '2025-02-15 06:37:09'),
(13, 'A13', 'Novia Auliani', 'Sistem Informasi', '2025-02-15 06:37:32', '2025-02-15 06:37:32'),
(14, 'A14', 'Ridho Fernanda', 'Sistem Informasi', '2025-02-15 06:37:45', '2025-02-15 06:37:45'),
(15, 'A15', 'Dimas Syahputra', 'Sistem Informasi', '2025-02-15 06:38:05', '2025-02-15 06:38:05'),
(16, 'A16', 'Putri Ramadhani', 'Sistem Informasi', '2025-02-15 06:38:22', '2025-02-15 06:38:22'),
(17, 'A17', 'Septi Herlina Wati Hulu', 'Sistem Informasi', '2025-02-15 06:38:43', '2025-02-15 06:38:43'),
(18, 'A18', 'Rohit Setiawan', 'Sistem Informasi', '2025-02-15 06:39:00', '2025-02-15 06:39:00'),
(19, 'A19', 'Erly Putri Zulfani', 'Sistem Informasi', '2025-02-15 06:39:26', '2025-02-15 06:39:26'),
(20, 'A20', 'Rizky Pratama', 'Teknik Informatika', '2025-02-15 06:39:41', '2025-02-15 06:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode` varchar(3) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot` decimal(10,2) NOT NULL,
  `tipe` enum('Benefit','Cost') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `nama_kriteria`, `bobot`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 'C7', 'Penghasilan Orang Tua', '5.00', 'Cost', '2025-02-14 12:20:29', '2025-02-14 12:20:29'),
(2, 'C6', 'Pekerjaan Orangtua', '4.00', 'Cost', '2025-02-14 18:26:01', '2025-02-14 18:26:01'),
(3, 'C1', 'Administrasi', '3.00', 'Cost', '2025-02-15 05:59:23', '2025-02-15 05:59:23'),
(4, 'C2', 'Ujian Saringan Masuk', '5.00', 'Cost', '2025-02-15 06:13:54', '2025-02-15 06:13:54'),
(5, 'C3', 'Wawancara', '3.00', 'Cost', '2025-02-15 06:17:49', '2025-02-15 06:17:49'),
(6, 'C4', 'Prestasi Akademik', '5.00', 'Cost', '2025-02-15 06:18:18', '2025-02-15 06:18:18'),
(7, 'C5', 'Prestasi Non Akademik', '3.00', 'Benefit', '2025-02-15 06:25:11', '2025-02-15 06:25:22'),
(8, 'C8', 'Status Orang Tua', '2.00', 'Benefit', '2025-02-15 06:29:24', '2025-02-15 06:29:24'),
(9, 'C9', 'Tanggungan Orang Tua', '4.00', 'Benefit', '2025-02-15 06:31:39', '2025-02-15 06:31:39'),
(10, 'C10', 'Kepemilikan Rumah', '2.00', 'Cost', '2025-02-15 06:33:00', '2025-02-15 06:33:00');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_17_124036_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_alternatif`, `id_kriteria`, `nilai`, `created_at`, `updated_at`) VALUES
(4, 1, 1, 20, '2025-02-14 19:56:45', '2025-02-15 09:06:20'),
(3, 1, 2, 25, '2025-02-14 19:56:45', '2025-02-15 09:06:20'),
(5, 2, 2, 25, '2025-02-14 19:56:55', '2025-02-14 19:56:55'),
(6, 2, 1, 10, '2025-02-14 19:56:55', '2025-02-15 09:10:23'),
(7, 4, 2, 30, '2025-02-14 19:57:06', '2025-02-14 19:57:06'),
(8, 4, 1, 25, '2025-02-14 19:57:06', '2025-02-14 19:57:06'),
(9, 3, 2, 25, '2025-02-14 19:57:15', '2025-02-15 09:11:34'),
(10, 3, 1, 10, '2025-02-14 19:57:15', '2025-02-14 19:57:15'),
(11, 5, 2, 10, '2025-02-14 19:57:25', '2025-02-15 09:15:13'),
(12, 5, 1, 10, '2025-02-14 19:57:25', '2025-02-15 09:15:13'),
(13, 6, 2, 10, '2025-02-15 03:24:01', '2025-02-15 09:16:16'),
(14, 6, 1, 20, '2025-02-15 03:24:01', '2025-02-15 03:24:01'),
(15, 1, 3, 30, '2025-02-15 06:04:43', '2025-02-15 06:04:43'),
(16, 2, 3, 10, '2025-02-15 06:04:52', '2025-02-15 09:10:23'),
(17, 3, 3, 10, '2025-02-15 06:05:05', '2025-02-15 09:11:34'),
(18, 5, 3, 25, '2025-02-15 06:05:12', '2025-02-15 09:15:13'),
(19, 4, 3, 30, '2025-02-15 06:05:23', '2025-02-15 06:05:23'),
(20, 6, 3, 30, '2025-02-15 06:05:35', '2025-02-15 06:05:35'),
(21, 1, 10, 25, '2025-02-15 08:40:13', '2025-02-15 09:07:30'),
(22, 1, 6, 25, '2025-02-15 08:40:13', '2025-02-15 09:06:20'),
(23, 1, 7, 10, '2025-02-15 08:40:13', '2025-02-15 09:06:20'),
(24, 1, 8, 10, '2025-02-15 08:40:13', '2025-02-15 09:06:20'),
(25, 1, 9, 25, '2025-02-15 08:40:13', '2025-02-15 08:40:13'),
(26, 1, 4, 550, '2025-02-15 09:06:20', '2025-02-15 09:06:20'),
(27, 1, 5, 80, '2025-02-15 09:06:20', '2025-02-15 09:06:20'),
(28, 2, 10, 35, '2025-02-15 09:10:23', '2025-02-15 09:10:23'),
(29, 2, 4, 500, '2025-02-15 09:10:23', '2025-02-15 09:10:23'),
(30, 2, 5, 90, '2025-02-15 09:10:23', '2025-02-15 09:10:23'),
(31, 2, 6, 25, '2025-02-15 09:10:23', '2025-02-15 09:10:23'),
(32, 2, 7, 10, '2025-02-15 09:10:23', '2025-02-15 09:10:23'),
(33, 2, 8, 10, '2025-02-15 09:10:23', '2025-02-15 09:10:23'),
(34, 2, 9, 10, '2025-02-15 09:10:23', '2025-02-15 09:10:23'),
(35, 3, 10, 25, '2025-02-15 09:11:34', '2025-02-15 09:11:34'),
(36, 3, 4, 500, '2025-02-15 09:11:34', '2025-02-15 09:11:34'),
(37, 3, 5, 90, '2025-02-15 09:11:34', '2025-02-15 09:11:34'),
(38, 3, 6, 25, '2025-02-15 09:11:34', '2025-02-15 09:11:34'),
(39, 3, 7, 10, '2025-02-15 09:11:34', '2025-02-15 09:11:34'),
(40, 3, 8, 30, '2025-02-15 09:11:34', '2025-02-15 09:11:34'),
(41, 3, 9, 25, '2025-02-15 09:11:34', '2025-02-15 09:11:34'),
(42, 4, 10, 25, '2025-02-15 09:13:46', '2025-02-15 09:13:46'),
(43, 4, 4, 500, '2025-02-15 09:13:46', '2025-02-15 09:13:46'),
(44, 4, 5, 90, '2025-02-15 09:13:46', '2025-02-15 09:13:46'),
(45, 4, 6, 25, '2025-02-15 09:13:46', '2025-02-15 09:13:46'),
(46, 4, 7, 10, '2025-02-15 09:13:46', '2025-02-15 09:13:46'),
(47, 4, 8, 25, '2025-02-15 09:13:46', '2025-02-15 09:13:46'),
(48, 4, 9, 25, '2025-02-15 09:13:46', '2025-02-15 09:13:46'),
(49, 5, 10, 25, '2025-02-15 09:15:13', '2025-02-15 09:15:13'),
(50, 5, 4, 420, '2025-02-15 09:15:13', '2025-02-15 09:15:13'),
(51, 5, 5, 70, '2025-02-15 09:15:13', '2025-02-15 09:15:13'),
(52, 5, 6, 10, '2025-02-15 09:15:13', '2025-02-15 09:15:13'),
(53, 5, 7, 10, '2025-02-15 09:15:13', '2025-02-15 09:15:13'),
(54, 5, 8, 25, '2025-02-15 09:15:13', '2025-02-15 09:15:13'),
(55, 5, 9, 25, '2025-02-15 09:15:13', '2025-02-15 09:15:13'),
(56, 6, 10, 25, '2025-02-15 09:16:16', '2025-02-15 09:16:16'),
(57, 6, 4, 400, '2025-02-15 09:16:16', '2025-02-15 09:16:16'),
(58, 6, 5, 80, '2025-02-15 09:16:16', '2025-02-15 09:16:16'),
(59, 6, 6, 10, '2025-02-15 09:16:16', '2025-02-15 09:16:16'),
(60, 6, 7, 10, '2025-02-15 09:16:16', '2025-02-15 09:16:16'),
(61, 6, 8, 10, '2025-02-15 09:16:16', '2025-02-15 09:16:16'),
(62, 6, 9, 25, '2025-02-15 09:16:16', '2025-02-15 09:16:37'),
(63, 7, 3, 30, '2025-02-15 09:18:01', '2025-02-15 09:18:01'),
(64, 7, 10, 25, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(65, 7, 4, 380, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(66, 7, 5, 85, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(67, 7, 6, 25, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(68, 7, 7, 10, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(69, 7, 2, 25, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(70, 7, 1, 15, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(71, 7, 8, 10, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(72, 7, 9, 10, '2025-02-15 09:18:02', '2025-02-15 09:18:02'),
(73, 8, 3, 30, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(74, 8, 10, 25, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(75, 8, 4, 320, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(76, 8, 5, 70, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(77, 8, 6, 10, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(78, 8, 7, 25, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(79, 8, 2, 25, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(80, 8, 1, 30, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(81, 8, 8, 25, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(82, 8, 9, 25, '2025-02-15 09:19:26', '2025-02-15 09:19:26'),
(83, 9, 3, 30, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(84, 9, 10, 25, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(85, 9, 4, 320, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(86, 9, 5, 80, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(87, 9, 6, 25, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(88, 9, 7, 10, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(89, 9, 2, 25, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(90, 9, 1, 10, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(91, 9, 8, 10, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(92, 9, 9, 25, '2025-02-15 09:20:39', '2025-02-15 09:20:39'),
(93, 10, 3, 30, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(94, 10, 10, 40, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(95, 10, 4, 320, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(96, 10, 5, 98, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(97, 10, 6, 10, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(98, 10, 7, 10, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(99, 10, 2, 10, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(100, 10, 1, 15, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(101, 10, 8, 10, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(102, 10, 9, 10, '2025-02-15 09:21:51', '2025-02-15 09:21:51'),
(103, 11, 3, 30, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(104, 11, 10, 25, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(105, 11, 4, 300, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(106, 11, 5, 75, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(107, 11, 6, 10, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(108, 11, 7, 25, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(109, 11, 2, 10, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(110, 11, 1, 10, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(111, 11, 8, 10, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(112, 11, 9, 25, '2025-02-15 09:23:33', '2025-02-15 09:23:33'),
(113, 12, 3, 30, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(114, 12, 10, 25, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(115, 12, 4, 290, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(116, 12, 5, 96, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(117, 12, 6, 10, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(118, 12, 7, 25, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(119, 12, 2, 10, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(120, 12, 1, 10, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(121, 12, 8, 10, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(122, 12, 9, 25, '2025-02-15 09:24:37', '2025-02-15 09:24:37'),
(123, 13, 3, 20, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(124, 13, 10, 25, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(125, 13, 4, 280, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(126, 13, 5, 88, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(127, 13, 6, 10, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(128, 13, 7, 10, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(129, 13, 2, 10, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(130, 13, 1, 10, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(131, 13, 8, 10, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(132, 13, 9, 25, '2025-02-15 09:25:45', '2025-02-15 09:25:45'),
(133, 14, 3, 30, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(134, 14, 10, 25, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(135, 14, 4, 250, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(136, 14, 5, 75, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(137, 14, 6, 10, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(138, 14, 7, 10, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(139, 14, 2, 10, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(140, 14, 1, 10, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(141, 14, 8, 10, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(142, 14, 9, 25, '2025-02-15 09:26:55', '2025-02-15 09:26:55'),
(143, 15, 3, 30, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(144, 15, 10, 40, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(145, 15, 4, 190, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(146, 15, 5, 75, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(147, 15, 6, 25, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(148, 15, 7, 10, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(149, 15, 2, 10, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(150, 15, 1, 10, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(151, 15, 8, 10, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(152, 15, 9, 25, '2025-02-15 09:28:28', '2025-02-15 09:28:28'),
(153, 16, 3, 30, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(154, 16, 10, 25, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(155, 16, 4, 580, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(156, 16, 5, 70, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(157, 16, 6, 10, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(158, 16, 7, 10, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(159, 16, 2, 10, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(160, 16, 1, 10, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(161, 16, 8, 10, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(162, 16, 9, 30, '2025-02-15 09:29:51', '2025-02-15 09:29:51'),
(163, 17, 3, 30, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(164, 17, 10, 40, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(165, 17, 4, 170, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(166, 17, 5, 85, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(167, 17, 6, 10, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(168, 17, 7, 10, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(169, 17, 2, 10, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(170, 17, 1, 10, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(171, 17, 8, 10, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(172, 17, 9, 25, '2025-02-15 09:30:55', '2025-02-15 09:30:55'),
(173, 18, 3, 30, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(174, 18, 10, 25, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(175, 18, 4, 530, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(176, 18, 5, 60, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(177, 18, 6, 10, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(178, 18, 7, 10, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(179, 18, 2, 25, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(180, 18, 1, 30, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(181, 18, 8, 30, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(182, 18, 9, 10, '2025-02-15 09:32:09', '2025-02-15 09:32:09'),
(183, 19, 3, 10, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(184, 19, 10, 25, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(185, 19, 4, 500, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(186, 19, 5, 93, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(187, 19, 6, 10, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(188, 19, 7, 10, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(189, 19, 2, 10, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(190, 19, 1, 10, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(191, 19, 8, 10, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(192, 19, 9, 25, '2025-02-15 09:33:51', '2025-02-15 09:33:51'),
(193, 20, 3, 30, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(194, 20, 10, 25, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(195, 20, 4, 500, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(196, 20, 5, 70, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(197, 20, 6, 10, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(198, 20, 7, 10, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(199, 20, 2, 25, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(200, 20, 1, 20, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(201, 20, 8, 25, '2025-02-15 09:35:17', '2025-02-15 09:35:17'),
(202, 20, 9, 25, '2025-02-15 09:35:17', '2025-02-15 09:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('30rFsjokBgiqlMwEqTjBBWmHqub5xgaT9La7E5ZC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzRWRjlHb25CZHlMMHNRT2llQ25IT3ZHUDBkMUhXZEJhN0NYY2RaSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcHAtbmFtZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729173753),
('7jw4euHVK5A8cQqCvGvlUPgNXpaOAkmkWZGo5tqI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnQ3M05DcnU1UU9ZWTJDUjIyRTExVTA3djkyZlNVd1M1S1ZnVndHeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcHAtbmFtZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729173702),
('lIch8apMRIUtXNvHAfTiM0HXij4dvixpn8EwAGcf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkVvN0trY25jcERRMkNvU2VTM3ZuZmxYVHY5dDB3TjBvSXNZNnlTVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcHAtbmFtZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729173752),
('LuEGGDxU1yse39CSF941X9oLus07c5EQWnmv0xyg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3BQUENvcDVOSm5XZVVOd1RLUlEweVVQT2RLejl2eG43N2N6UzE4cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcHAtbmFtZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729173748),
('UI8JDz7GwwDoC5P28sCxLgQnkmfjIobZRP8hSLmF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMEdma1JkUVVFT09nTFJORkxOcURyVW1zMnM1TzE4WjAxYTJZaEtUdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcHAtbmFtZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729173753);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(50) NOT NULL,
  `nilai` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id`, `id_kriteria`, `sub_kriteria`, `nilai`, `created_at`, `updated_at`) VALUES
(3, 1, 'Rp1.100.000 – Rp1.500.000', 25, '2025-02-14 18:23:22', '2025-02-14 18:23:34'),
(2, 1, 'Rp500.000 – Rp1.000.000', 30, '2025-02-14 18:20:52', '2025-02-14 18:20:52'),
(4, 1, 'Rp1.600.000 – Rp2.000.000', 20, '2025-02-14 18:23:55', '2025-02-14 18:23:55'),
(5, 1, 'Rp2.100.000 – Rp3.000.000', 15, '2025-02-14 18:24:07', '2025-02-14 18:24:07'),
(6, 1, '>Rp3.000.000', 10, '2025-02-14 18:24:18', '2025-02-14 18:24:18'),
(7, 2, 'Tidak Bekerja', 35, '2025-02-14 18:26:43', '2025-02-14 18:26:43'),
(8, 2, 'Pekerja Tidak Tetap/Serabutan', 30, '2025-02-14 18:26:58', '2025-02-14 18:26:58'),
(9, 2, 'Pekerja Informal', 25, '2025-02-14 18:27:09', '2025-02-14 18:27:09'),
(10, 2, 'Buruh', 10, '2025-02-14 18:27:21', '2025-02-14 18:27:21'),
(11, 3, 'DTKS', 30, '2025-02-15 06:03:30', '2025-02-15 06:11:40'),
(12, 3, 'P3KE', 25, '2025-02-15 06:11:51', '2025-02-15 06:11:51'),
(13, 3, 'KKS', 20, '2025-02-15 06:12:01', '2025-02-15 06:12:01'),
(14, 3, 'SKTM', 15, '2025-02-15 06:12:11', '2025-02-15 06:12:18'),
(15, 3, 'Belum Terdata', 10, '2025-02-15 06:13:09', '2025-02-15 06:13:09'),
(16, 7, 'Skala Internasional', 35, '2025-02-15 06:26:24', '2025-02-15 06:26:24'),
(17, 7, 'Skala Nasional', 30, '2025-02-15 06:26:40', '2025-02-15 06:26:40'),
(18, 7, 'Skala Provinsi', 25, '2025-02-15 06:26:58', '2025-02-15 06:26:58'),
(19, 7, 'Tidak Ada', 10, '2025-02-15 06:27:09', '2025-02-15 06:27:09'),
(20, 6, 'Skala Internasional', 35, '2025-02-15 06:27:32', '2025-02-15 06:27:32'),
(21, 6, 'Skala Nasional', 30, '2025-02-15 06:27:45', '2025-02-15 06:27:45'),
(22, 6, 'Skala Provinsi', 25, '2025-02-15 06:27:53', '2025-02-15 06:27:53'),
(23, 6, 'Tidak Ada', 10, '2025-02-15 06:28:02', '2025-02-15 06:28:02'),
(24, 8, 'Ayah dan Ibu Meninggal', 35, '2025-02-15 06:30:07', '2025-02-15 06:30:07'),
(25, 8, 'Ayah Meninggal', 30, '2025-02-15 06:30:21', '2025-02-15 06:30:21'),
(26, 8, 'Ibu Meninggal', 25, '2025-02-15 06:30:30', '2025-02-15 06:30:30'),
(27, 8, 'Ayah Ibu Masih Ada', 10, '2025-02-15 06:30:41', '2025-02-15 06:30:41'),
(28, 9, '>8', 35, '2025-02-15 06:31:59', '2025-02-15 06:31:59'),
(29, 9, '7-5', 30, '2025-02-15 06:32:08', '2025-02-15 06:32:08'),
(30, 9, '4-2', 25, '2025-02-15 06:32:17', '2025-02-15 06:32:17'),
(31, 9, '1', 10, '2025-02-15 06:32:24', '2025-02-15 06:32:24'),
(32, 10, 'Tidak Mempunyai rumah', 40, '2025-02-15 06:33:27', '2025-02-15 06:33:27'),
(33, 10, 'Sewa', 35, '2025-02-15 06:33:36', '2025-02-15 06:33:36'),
(34, 10, 'Rumah Sendiri', 25, '2025-02-15 06:33:46', '2025-02-15 06:33:46'),
(35, 4, '500', 500, '2025-02-15 08:46:54', '2025-02-15 08:47:06'),
(36, 4, '550', 550, '2025-02-15 08:47:13', '2025-02-15 08:47:13'),
(37, 4, '470', 470, '2025-02-15 08:47:20', '2025-02-15 08:47:20'),
(38, 4, '420', 420, '2025-02-15 08:47:29', '2025-02-15 08:47:29'),
(39, 4, '400', 400, '2025-02-15 08:47:34', '2025-02-15 08:47:34'),
(40, 4, '380', 380, '2025-02-15 08:47:41', '2025-02-15 08:47:41'),
(41, 4, '320', 320, '2025-02-15 08:47:46', '2025-02-15 08:47:46'),
(42, 4, '300', 300, '2025-02-15 08:47:50', '2025-02-15 08:47:50'),
(43, 4, '290', 290, '2025-02-15 08:47:56', '2025-02-15 08:47:56'),
(44, 4, '280', 280, '2025-02-15 08:48:01', '2025-02-15 08:48:01'),
(45, 4, '250', 250, '2025-02-15 08:48:06', '2025-02-15 08:48:06'),
(46, 4, '190', 190, '2025-02-15 08:48:12', '2025-02-15 08:48:12'),
(47, 4, '580', 580, '2025-02-15 08:48:22', '2025-02-15 08:48:22'),
(48, 4, '170', 170, '2025-02-15 08:48:30', '2025-02-15 08:48:30'),
(49, 4, '530', 530, '2025-02-15 08:48:36', '2025-02-15 08:48:36'),
(50, 5, '80', 80, '2025-02-15 08:49:13', '2025-02-15 08:49:13'),
(51, 5, '90', 90, '2025-02-15 08:49:17', '2025-02-15 08:49:17'),
(52, 5, '75', 75, '2025-02-15 08:49:24', '2025-02-15 08:49:24'),
(53, 5, '70', 70, '2025-02-15 08:49:30', '2025-02-15 08:49:30'),
(54, 5, '85', 85, '2025-02-15 08:49:37', '2025-02-15 08:49:37'),
(55, 5, '98', 98, '2025-02-15 08:49:42', '2025-02-15 08:49:42'),
(56, 5, '96', 96, '2025-02-15 08:49:48', '2025-02-15 08:49:48'),
(57, 5, '88', 88, '2025-02-15 08:49:53', '2025-02-15 08:49:53'),
(58, 5, '60', 60, '2025-02-15 08:50:00', '2025-02-15 08:50:00'),
(59, 5, '93', 93, '2025-02-15 08:50:08', '2025-02-15 08:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Admin','Mahasiswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Mahasiswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$.zyv.mN4ewS36HGJcBDXWua88yylf2MwZRK3603IZfRfoNZhJEvHy', 'Admin', NULL, '2024-10-20 15:44:16', '2024-10-20 15:44:16'),
(2, 'Dr. Emily Clark', 'emilyclark@gmail.com', '$2y$10$.zyv.mN4ewS36HGJcBDXWua88yylf2MwZRK3603IZfRfoNZhJEvHy', '', NULL, '2024-10-20 15:44:16', '2024-10-20 15:44:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
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
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
