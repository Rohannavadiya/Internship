-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 06:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cab_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `drop_location` varchar(255) NOT NULL,
  `distance_km` decimal(6,2) NOT NULL,
  `fare` decimal(10,2) NOT NULL,
  `status` enum('requested','accepted','ongoing','completed','cancelled') DEFAULT 'requested',
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `cancel_reason` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `driver_id`, `pickup_location`, `drop_location`, `distance_km`, `fare`, `status`, `booking_time`, `cancel_reason`) VALUES
(1, 1, 1, 'Bhavnagar', 'Surat', 300.00, 3600.00, 'completed', '2026-01-17 04:53:23', NULL),
(2, 1, 1, 'Bhavnagar', 'Ahmadabad', 200.00, 2400.00, 'completed', '2026-01-21 04:57:28', NULL),
(3, 2, 1, 'Surat', 'Ahmadabad', 500.00, 6000.00, 'completed', '2026-01-27 04:34:17', NULL),
(4, 2, 1, 'Bhavnagar', 'surat', 584.00, 7008.00, 'completed', '2026-01-27 04:36:34', NULL),
(5, 2, 1, 'Bhavnagar', 'Ahmadabad', 845.00, 10140.00, 'completed', '2026-01-27 04:37:30', NULL),
(6, 2, 1, 'Surat', 'Ahmadabad', 3864.00, 46368.00, 'completed', '2026-01-27 04:39:52', NULL),
(7, 2, 1, 'Bhavnagar', 'Ahmadabad', 100.00, 1200.00, 'completed', '2026-01-27 04:45:13', NULL),
(8, 2, 1, 'Bhavnagar', 'Ahmadabad', 200.00, 2400.00, 'completed', '2026-01-27 04:49:19', NULL),
(9, 2, 1, 'Bhavnagar', 'sirat', 182.00, 2184.00, 'completed', '2026-01-27 05:19:20', NULL),
(10, 1, 1, 'Bhavnagar', 'Ahmadabad', 100.00, 1200.00, 'completed', '2026-01-28 04:16:14', NULL),
(11, 1, 1, 'Bhavnagar', 'surat', 100.00, 1200.00, 'completed', '2026-01-28 05:09:00', NULL),
(12, 1, 1, 'Surat', 'Ahmadabad', 200.00, 2400.00, 'completed', '2026-01-28 05:09:10', NULL),
(13, 1, 1, 'Bhavnagar', 'surat', 100.00, 1200.00, 'completed', '2026-01-28 05:17:01', NULL),
(14, 1, 1, 'Bhavnagar', 'surat', 200.00, 2400.00, 'cancelled', '2026-01-28 05:30:35', 'Rejected by driver'),
(15, 1, 1, 'Bhavnagar', 'Ahmadabad', 200.00, 2400.00, 'completed', '2026-01-29 03:58:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `vehicle_type` enum('Mini','Sedan','SUV') NOT NULL,
  `availability` enum('online','offline') DEFAULT 'offline',
  `status` enum('pending','approved','blocked') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) NOT NULL DEFAULT '123_unknown.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `full_name`, `email`, `mobile`, `password`, `license_number`, `vehicle_type`, `availability`, `status`, `created_at`, `img`) VALUES
(1, 'Priyansh', 'priyansh@gmail.com', '6846846464', '$2y$10$X0V9XhOcYPVapsJZKGqmBetCasIyxk4tgAWFYs40AwiN64KPFxCKa', 'GBF498', 'SUV', 'offline', 'pending', '2026-01-13 04:28:29', '3992_521298448_17891700405292519_8103117475924722002_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','online') NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `payment_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `driver_amount` decimal(10,2) DEFAULT NULL,
  `platform_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `driver_id`, `amount`, `payment_method`, `payment_status`, `payment_time`, `driver_amount`, `platform_amount`) VALUES
(1, 1, 1, 3600.00, 'cash', 'paid', '2026-01-27 04:09:10', 2520.00, 1080.00),
(2, 2, 1, 2400.00, 'online', 'paid', '2026-01-27 04:15:42', 1680.00, 720.00),
(3, 3, 1, 6000.00, 'online', 'paid', '2026-01-27 04:35:18', 4200.00, 1800.00),
(4, 4, 1, 7008.00, 'online', 'paid', '2026-01-27 04:37:10', 4905.60, 2102.40),
(5, 5, 1, 10140.00, 'cash', 'paid', '2026-01-27 04:38:00', 7098.00, 3042.00),
(6, 6, 1, 46368.00, 'cash', 'paid', '2026-01-27 04:42:31', 32457.60, 13910.40),
(7, 7, 1, 1200.00, 'cash', 'paid', '2026-01-27 04:45:34', 840.00, 360.00),
(8, 8, 1, 2400.00, 'cash', 'paid', '2026-01-27 04:50:24', 1680.00, 720.00),
(9, 9, 1, 2184.00, 'online', 'paid', '2026-01-27 05:28:45', 1528.80, 655.20),
(10, 10, 1, 1200.00, 'cash', 'paid', '2026-01-28 04:21:06', 840.00, 360.00),
(11, 12, NULL, 2400.00, 'online', 'paid', '2026-01-28 05:14:45', 1680.00, 720.00),
(12, 11, NULL, 1200.00, 'online', 'paid', '2026-01-28 05:15:16', 840.00, 360.00),
(13, 13, NULL, 1200.00, 'cash', 'paid', '2026-01-28 05:18:04', 840.00, 360.00),
(14, 15, NULL, 2400.00, 'online', 'paid', '2026-01-29 04:04:29', 1680.00, 720.00);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `booking_id`, `user_id`, `driver_id`, `rating`, `review`, `created_at`) VALUES
(1, 15, 1, 1, 3, NULL, '2026-01-29 05:10:36'),
(2, 13, 1, 1, 3, NULL, '2026-01-29 05:10:43'),
(3, 11, 1, 1, 2, NULL, '2026-01-29 05:10:47'),
(4, 2, 1, 1, 5, NULL, '2026-01-29 05:13:24'),
(5, 10, 1, 1, 4, NULL, '2026-01-29 05:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) NOT NULL DEFAULT '123_unknown.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `mobile`, `password`, `status`, `created_at`, `img`) VALUES
(1, 'Rohan', 'rohan@gmail.com', '16811894991', '$2y$10$gHjYQ.V./LZSJq81njCgKeN9BRwpjPMF0k271kdgyDnW5uskABdoy', 'active', '2026-01-12 04:25:36', '4820_505788603_17889939783291569_3561812959331288301_n.jpg'),
(2, 'raj', 'raj@gmail.com', '86853954', '$2y$10$LIFfj5UZMS0XipAno92B3O58Hy5t87QQJ2CuHFWWi8oxrNyfS6qxu', 'active', '2026-01-13 04:33:07', '8572_504458397_17889939891291569_4717418635984946107_n.jpg'),
(3, 'Ronak', 'ronak@gmail.com', '97343511364', '$2y$10$cd9BheooysPIFuzAH6IHB.hWYDtXNV498NIraBOKgYETTfiJZXHY6', 'active', '2026-01-13 04:37:50', '123_unknown.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `payments_ibfk_driver` (`driver_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `payments_ibfk_driver` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
