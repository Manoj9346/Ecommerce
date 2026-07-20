-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 20, 2026 at 12:12 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(5, 1, 7, 100, '2025-08-31 05:04:09', '2025-08-31 05:04:15'),
(6, 1, 1, 1, '2025-08-31 05:08:31', '2025-08-31 05:08:31'),
(8, 1, 10, 1, '2025-08-31 05:12:40', '2025-08-31 05:12:40'),
(9, 3, 4, 1, '2025-09-05 04:21:24', '2025-09-05 04:21:24'),
(10, 3, 9, 1, '2025-09-05 04:21:29', '2025-09-05 04:21:29'),
(11, 3, 10, 1, '2025-09-05 04:21:33', '2025-09-05 04:21:33'),
(12, 3, 1, 1, '2025-09-05 04:21:37', '2025-09-05 04:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `created_at`) VALUES
(1, 'Product 1', 100.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 08:17:48'),
(3, 'Product 2', 100.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 11:18:44'),
(4, 'Product 3', 100.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 11:22:23'),
(5, 'Product 4', 100.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 11:22:53'),
(6, 'Product 5', 100.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 11:23:08'),
(7, 'Product 6', 100.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 11:23:28'),
(8, 'Product 7', 100.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 11:23:47'),
(9, 'Product 8', 200.00, 'High-quality product designed to meet your needs. value for everyday use', 'product1.jpg', '2025-08-27 11:24:10'),
(10, 'Praveen', 2000.00, 'EEE highest package of the Decade', 'Screenshot 2025-08-09 144328.png', '2025-08-31 05:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'MANOJ KUMAR', 'Manu@1', '$2y$10$O7oWv6G0xBGNRNmcuktpl.tPZQg5wWV1oitzit1ce2KaEtSoIwcy.', '2025-08-27 06:35:00', 'user'),
(7, '', 'Manu@2', '$2y$10$oBX.oB5R5GaxdLmYcwwpEOc5elBKRNOI0E90dxJK77uNaMzLP53Ku', '2025-08-27 12:48:08', 'user'),
(9, 'Manoj Kumar', 'Manoj@gmail.com', '$2y$10$3sKbMbhPMdFCXn8XMhBc9uEKhLb/wFPIP1RRaNq.AslWmnRUMRm/C', '2025-08-27 12:56:32', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
