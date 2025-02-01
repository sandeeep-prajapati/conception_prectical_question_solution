-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 01:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_002`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'books', '2025-02-01 04:29:53', '2025-02-01 04:29:53'),
(2, 'veges', '2025-02-01 04:36:30', '2025-02-01 04:36:30'),
(4, 'abnb', '2025-02-01 03:21:07', '2025-02-01 03:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'pending', '2025-02-01 04:42:24', '2025-02-01 04:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL CHECK (octet_length(`title`) >= 3),
  `description` text NOT NULL CHECK (octet_length(`description`) <= 500),
  `amount` decimal(10,2) NOT NULL CHECK (`amount` > 0),
  `discount_type` enum('Flat','Percentage') NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL CHECK (`discount_amount` >= 0),
  `payable_amount` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `title`, `description`, `amount`, `discount_type`, `discount_amount`, `payable_amount`, `image`, `created_at`, `updated_at`, `sort_order`) VALUES
(4, 2, 2, 'dhbhjd', 'khjhjh', 100.00, 'Percentage', 20.00, 80.00, NULL, '2025-02-01 01:55:52', '2025-02-01 07:39:53', 0),
(6, 2, 2, 'dhbhjd', 'khjhjhd', 100.00, 'Percentage', 20.00, 80.00, NULL, '2025-02-01 05:24:59', '2025-02-01 05:24:59', 0),
(7, 4, 3, 'dhjdhjhd', 'jhhjdhjhdj', 500.00, 'Percentage', 30.00, 350.00, NULL, '2025-02-01 05:25:27', '2025-02-01 05:25:27', 0),
(8, 2, 1, 'jhghdghjgd', 'djgjhdgj', 30.00, 'Percentage', 30.00, 21.00, NULL, '2025-02-01 05:25:59', '2025-02-01 05:25:59', 0),
(9, 4, 1, 'dghdgjgdj', 'hgshhhw', 300.00, 'Percentage', 202.00, -306.00, NULL, '2025-02-01 05:26:22', '2025-02-01 05:26:22', 0),
(10, 4, 3, 'dmbjbd', 'nvdbbd', 2020.00, 'Percentage', 211.00, -2242.20, NULL, '2025-02-01 05:26:43', '2025-02-01 05:26:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'fhjggjd', '2025-02-01 04:35:21', '2025-02-01 04:35:21'),
(2, 2, 'patatato', '2025-02-01 04:36:50', '2025-02-01 04:36:50'),
(3, 2, 'banana 5', '2025-02-01 03:11:31', '2025-02-01 03:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile_image`, `failed_attempts`, `locked_until`, `created_at`, `updated_at`) VALUES
(2, 'Sandeep Prajapati', '6392424180sandeep@gmail.com', '$2y$12$K0Cifg4uBNA30Ufusy8bbOoMKPaP5YdYbw8TeLPAcWEOaLVNsyTu2', NULL, 0, NULL, '2025-01-31 22:45:29', '2025-01-31 22:47:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
