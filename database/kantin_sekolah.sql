-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20251027.b01d991947
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2026 at 03:06 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantin_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `kategori_menu` varchar(50) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `status_menu` varchar(50) NOT NULL,
  `deskripsi` text,
  `tanggal_input` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `user_id`, `nama_menu`, `kategori_menu`, `harga`, `stok`, `status_menu`, `deskripsi`, `tanggal_input`, `created_at`, `updated_at`) VALUES
(4, 2, 'teh manis', 'Minuman', 3000, 5, 'Tersedia', 'es segar', '2026-06-05', NULL, NULL),
(6, 2, 'mie goreng', 'Makanan', 5000, 10, 'Tersedia', 'miegoreng, mierendang dll', '2026-06-05', NULL, NULL),
(7, 2, 'ice cream', 'Snack', 5000, 5, 'Tersedia', 'ice cream aice', '2026-06-05', NULL, NULL),
(8, 2, 'ricebook', 'Makanan', 10000, 3, 'Tersedia', 'isi daging ayam sayuran nasi sambel', '2026-06-05', NULL, NULL),
(9, 2, 'kue cubit', 'Snack', 2000, 6, 'Tersedia', 'kue cubit aneka rasa', '2026-06-05', NULL, NULL),
(10, 2, 'es buah', 'Minuman', 3000, 10, 'Tersedia', 'es buah buahan', '2026-06-05', NULL, NULL),
(11, 2, 'ayam goreng', 'Makanan', 5000, 8, 'Tersedia', 'ayamgoreng balado', '2026-06-05', NULL, NULL),
(27, 4, 'martabak mini', 'Snack', 2000, 0, 'Habis', 'martabak mini mini', '2026-06-06', NULL, NULL),
(30, 4, 'es buah naga', 'Snack', 3000, 6, 'Tersedia', 'es buah naga', '2026-06-06', NULL, NULL),
(34, 4, 'ayam kremes', 'Makanan', 5000, 5, 'Tersedia', 'ayam goreng', '2026-06-06', NULL, NULL),
(40, 4, 'nasi goreng', 'Makanan', 2000, 0, 'Habis', 'nasi goreng special', '2026-06-06', NULL, NULL),
(41, 4, 'teh manis', 'Minuman', 2000, 0, 'Habis', 'teh manis segar', '2026-06-06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'zulfa', 'zulfa@gmail.com', '$2y$12$Zha2ry4/podAL86YBPJEaO81bgZ0rla90aj1nHonO5mr5id9TbB1K', '2026-06-04 20:29:50', '2026-06-04 20:29:50'),
(4, 'nazwa khaerani', 'nazwa@gmail.com', '$2y$12$906MuMxE1uw9jwDWcC7lv.vrki2WdWtOf6QrRBGC3d23Whm3g/MOa', '2026-06-05 05:35:51', '2026-06-05 05:35:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
