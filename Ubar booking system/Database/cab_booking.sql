-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 05:18 PM
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

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Super Admin', 'admin@cabride.com', '$2y$10$YYN92aMnHPQxObkMlgGBOeg9BCDGDChOl.ceqfMol6YCkg1G0UObG', '2026-01-01 03:30:00'),
(2, 'Operations Head', 'ops@cabride.com', '$2y$10$1XQhhEUpbCPSnmZDRNcA2eDzH9jhrNClsUab/QL8n53QQm4utrlFW', '2026-01-05 05:00:00'),
(3, 'Support Manager', 'support@cabride.com', '$2y$10$8cq1ETQvCLUEkZ6m1wypFu9ayO8paYVkSW7Kq1FZXIK9m4a34LhR.', '2026-01-10 06:15:00');

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
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `driver_id`, `pickup_location`, `drop_location`, `distance_km`, `fare`, `status`, `booking_time`) VALUES
(1, 4, 1, 'City Center', 'Airport', 15.84, 424.41, 'completed', '2026-01-10 18:30:00'),
(2, 7, 4, 'City Center', 'Airport', 22.51, 268.98, 'completed', '2026-01-11 18:30:00'),
(3, 2, 5, 'City Center', 'Airport', 11.73, 682.66, 'completed', '2026-01-12 18:30:00'),
(4, 8, 2, 'City Center', 'Airport', 14.99, 663.63, 'completed', '2026-01-13 18:30:00'),
(5, 2, 5, 'City Center', 'Airport', 7.32, 631.13, 'completed', '2026-01-14 18:30:00'),
(6, 10, 2, 'City Center', 'Airport', 10.37, 523.69, 'completed', '2026-01-15 18:30:00'),
(7, 5, 2, 'City Center', 'Airport', 20.38, 303.65, 'completed', '2026-01-16 18:30:00'),
(8, 8, 1, 'City Center', 'Airport', 23.99, 531.59, 'completed', '2026-01-17 18:30:00'),
(9, 5, 2, 'City Center', 'Airport', 11.92, 540.10, 'completed', '2026-01-18 18:30:00'),
(10, 4, 4, 'City Center', 'Airport', 20.66, 496.43, 'completed', '2026-01-19 18:30:00'),
(11, 7, 2, 'City Center', 'Airport', 17.53, 325.66, 'completed', '2026-01-20 18:30:00'),
(12, 4, 2, 'City Center', 'Airport', 15.28, 291.66, 'completed', '2026-01-21 18:30:00'),
(13, 4, 2, 'City Center', 'Airport', 14.99, 461.80, 'completed', '2026-01-22 18:30:00'),
(14, 2, 1, 'City Center', 'Airport', 20.26, 571.55, 'completed', '2026-01-23 18:30:00'),
(15, 5, 5, 'City Center', 'Airport', 9.74, 437.32, 'completed', '2026-01-24 18:30:00'),
(16, 7, 5, 'City Center', 'Airport', 14.09, 503.47, 'completed', '2026-01-25 18:30:00'),
(17, 7, 3, 'City Center', 'Airport', 18.37, 566.71, 'completed', '2026-01-26 18:30:00'),
(18, 7, 1, 'City Center', 'Airport', 15.86, 399.14, 'completed', '2026-01-27 18:30:00'),
(19, 4, 3, 'City Center', 'Airport', 5.26, 301.74, 'completed', '2026-01-28 18:30:00'),
(20, 10, 2, 'City Center', 'Airport', 14.51, 465.11, 'completed', '2026-01-29 18:30:00'),
(21, 3, 3, 'City Center', 'Airport', 24.96, 392.66, 'completed', '2026-01-30 18:30:00'),
(22, 9, 3, 'City Center', 'Airport', 19.99, 309.33, 'completed', '2026-01-31 18:30:00'),
(23, 9, 3, 'City Center', 'Airport', 10.94, 593.07, 'completed', '2026-02-01 18:30:00'),
(24, 1, 4, 'City Center', 'Airport', 6.86, 668.63, 'completed', '2026-02-02 18:30:00'),
(25, 5, 2, 'City Center', 'Airport', 22.87, 599.57, 'completed', '2026-02-03 18:30:00'),
(26, 4, 2, 'City Center', 'Airport', 23.88, 293.26, 'completed', '2026-02-04 18:30:00'),
(27, 2, 5, 'City Center', 'Airport', 13.30, 322.91, 'completed', '2026-02-05 18:30:00'),
(28, 10, 2, 'City Center', 'Airport', 23.99, 303.96, 'completed', '2026-02-06 18:30:00'),
(29, 3, 2, 'City Center', 'Airport', 6.59, 402.63, 'completed', '2026-02-07 18:30:00'),
(30, 8, 4, 'City Center', 'Airport', 10.38, 282.57, 'completed', '2026-02-08 18:30:00'),
(31, 1, 3, 'City Center', 'Airport', 23.40, 608.27, 'completed', '2026-02-09 18:30:00'),
(32, 4, 2, 'City Center', 'Airport', 21.72, 549.90, 'completed', '2026-02-10 18:30:00'),
(33, 10, 4, 'City Center', 'Airport', 10.78, 644.17, 'completed', '2026-02-11 18:30:00'),
(34, 6, 2, 'City Center', 'Airport', 11.60, 208.31, 'completed', '2026-02-12 18:30:00'),
(35, 2, 3, 'City Center', 'Airport', 20.95, 571.20, 'completed', '2026-02-13 18:30:00'),
(36, 4, 2, 'City Center', 'Airport', 22.61, 349.77, 'completed', '2026-02-14 18:30:00'),
(37, 9, 3, 'City Center', 'Airport', 12.04, 503.03, 'completed', '2026-02-15 18:30:00'),
(38, 10, 1, 'City Center', 'Airport', 12.15, 509.41, 'completed', '2026-02-16 18:30:00'),
(39, 1, 2, 'City Center', 'Airport', 8.63, 280.30, 'completed', '2026-02-17 18:30:00'),
(40, 3, 4, 'City Center', 'Airport', 10.59, 682.29, 'completed', '2026-02-18 18:30:00'),
(41, 10, 1, 'City Center', 'Airport', 8.71, 622.15, 'completed', '2026-02-19 18:30:00'),
(42, 7, 4, 'City Center', 'Airport', 24.35, 430.07, 'completed', '2026-02-20 18:30:00'),
(43, 5, 3, 'City Center', 'Airport', 22.09, 421.90, 'completed', '2026-02-21 18:30:00'),
(44, 7, 5, 'City Center', 'Airport', 20.13, 674.25, 'completed', '2026-02-22 18:30:00'),
(45, 5, 3, 'City Center', 'Airport', 8.81, 393.19, 'completed', '2026-02-23 18:30:00'),
(46, 4, 4, 'City Center', 'Airport', 7.50, 550.59, 'completed', '2026-02-24 18:30:00'),
(47, 2, 3, 'City Center', 'Airport', 12.48, 304.65, 'completed', '2026-02-25 18:30:00'),
(48, 9, 5, 'City Center', 'Airport', 8.89, 696.18, 'completed', '2026-02-26 18:30:00'),
(49, 4, 5, 'City Center', 'Airport', 13.68, 413.97, 'completed', '2026-02-27 18:30:00'),
(50, 9, 5, 'City Center', 'Airport', 5.50, 400.51, 'completed', '2026-02-28 18:30:00'),
(51, 9, 3, 'City Center', 'Airport', 13.90, 642.09, 'completed', '2026-03-01 18:30:00'),
(52, 2, 4, 'City Center', 'Airport', 17.47, 594.73, 'completed', '2026-03-02 18:30:00'),
(53, 2, 1, 'City Center', 'Airport', 21.85, 284.20, 'completed', '2026-03-03 18:30:00'),
(54, 4, 1, 'City Center', 'Airport', 13.10, 607.15, 'completed', '2026-03-04 18:30:00'),
(55, 9, 4, 'City Center', 'Airport', 17.75, 530.89, 'completed', '2026-03-05 18:30:00'),
(56, 5, 5, 'City Center', 'Airport', 21.12, 216.05, 'completed', '2026-03-06 18:30:00'),
(57, 8, 3, 'City Center', 'Airport', 22.00, 402.17, 'completed', '2026-03-07 18:30:00'),
(58, 5, 2, 'City Center', 'Airport', 11.09, 245.93, 'completed', '2026-03-08 18:30:00'),
(59, 6, 3, 'City Center', 'Airport', 17.45, 578.07, 'completed', '2026-03-09 18:30:00'),
(60, 9, 2, 'City Center', 'Airport', 20.27, 657.67, 'completed', '2026-03-10 18:30:00'),
(61, 4, 4, 'City Center', 'Airport', 16.05, 558.60, 'completed', '2026-03-11 18:30:00'),
(62, 9, 3, 'City Center', 'Airport', 18.29, 626.87, 'completed', '2026-03-12 18:30:00'),
(63, 3, 4, 'City Center', 'Airport', 9.70, 569.74, 'completed', '2026-03-13 18:30:00'),
(64, 10, 4, 'City Center', 'Airport', 19.88, 443.16, 'completed', '2026-03-14 18:30:00'),
(65, 3, 3, 'City Center', 'Airport', 7.14, 655.54, 'completed', '2026-03-15 18:30:00'),
(66, 3, 3, 'City Center', 'Airport', 14.67, 252.68, 'completed', '2026-03-16 18:30:00'),
(67, 2, 1, 'City Center', 'Airport', 7.19, 371.42, 'completed', '2026-03-17 18:30:00'),
(68, 4, 5, 'City Center', 'Airport', 12.08, 231.47, 'completed', '2026-03-18 18:30:00'),
(69, 3, 1, 'City Center', 'Airport', 17.15, 609.76, 'completed', '2026-03-19 18:30:00'),
(70, 3, 5, 'City Center', 'Airport', 19.94, 696.77, 'completed', '2026-03-20 18:30:00'),
(71, 8, 4, 'City Center', 'Airport', 6.40, 400.31, 'completed', '2026-03-21 18:30:00'),
(72, 8, 4, 'City Center', 'Airport', 13.94, 668.76, 'completed', '2026-03-22 18:30:00'),
(73, 4, 5, 'City Center', 'Airport', 16.56, 259.56, 'completed', '2026-03-23 18:30:00'),
(74, 9, 5, 'City Center', 'Airport', 8.02, 657.89, 'completed', '2026-03-24 18:30:00'),
(75, 2, 5, 'City Center', 'Airport', 5.42, 433.56, 'completed', '2026-03-25 18:30:00'),
(76, 3, 5, 'City Center', 'Airport', 24.71, 223.39, 'completed', '2026-03-26 18:30:00'),
(77, 3, 2, 'City Center', 'Airport', 12.76, 304.41, 'completed', '2026-03-27 18:30:00'),
(78, 9, 4, 'City Center', 'Airport', 9.65, 619.39, 'completed', '2026-03-28 18:30:00'),
(79, 5, 5, 'City Center', 'Airport', 11.74, 594.57, 'completed', '2026-03-29 18:30:00'),
(80, 9, 2, 'City Center', 'Airport', 19.62, 566.30, 'completed', '2026-03-30 18:30:00'),
(81, 5, 2, 'City Center', 'Airport', 12.32, 381.37, 'completed', '2026-03-31 18:30:00'),
(82, 7, 3, 'City Center', 'Airport', 11.20, 237.77, 'completed', '2026-04-01 18:30:00'),
(83, 5, 1, 'City Center', 'Airport', 19.25, 464.86, 'completed', '2026-04-02 18:30:00'),
(84, 6, 5, 'City Center', 'Airport', 10.87, 486.22, 'completed', '2026-04-03 18:30:00'),
(85, 10, 2, 'City Center', 'Airport', 5.02, 419.06, 'completed', '2026-04-04 18:30:00'),
(86, 3, 3, 'City Center', 'Airport', 16.13, 655.66, 'completed', '2026-04-05 18:30:00'),
(87, 9, 4, 'City Center', 'Airport', 21.77, 246.77, 'completed', '2026-04-06 18:30:00'),
(88, 10, 3, 'City Center', 'Airport', 15.81, 332.50, 'completed', '2026-04-07 18:30:00'),
(89, 7, 4, 'City Center', 'Airport', 14.92, 357.97, 'completed', '2026-04-08 18:30:00'),
(90, 2, 3, 'City Center', 'Airport', 10.76, 650.19, 'completed', '2026-04-09 18:30:00'),
(91, 7, 3, 'City Center', 'Airport', 15.85, 318.80, 'completed', '2026-04-10 18:30:00'),
(92, 6, 1, 'City Center', 'Airport', 20.34, 483.31, 'completed', '2026-04-11 18:30:00'),
(93, 6, 5, 'City Center', 'Airport', 8.93, 253.82, 'completed', '2026-04-12 18:30:00'),
(94, 10, 3, 'City Center', 'Airport', 10.13, 210.45, 'completed', '2026-04-13 18:30:00'),
(95, 4, 3, 'City Center', 'Airport', 6.16, 426.07, 'completed', '2026-04-14 18:30:00'),
(96, 2, 1, 'City Center', 'Airport', 7.50, 397.08, 'completed', '2026-04-15 18:30:00'),
(97, 6, 4, 'City Center', 'Airport', 8.84, 486.57, 'completed', '2026-04-16 18:30:00'),
(98, 4, 4, 'City Center', 'Airport', 20.35, 528.50, 'completed', '2026-04-17 18:30:00'),
(99, 10, 5, 'City Center', 'Airport', 19.99, 664.70, 'completed', '2026-04-18 18:30:00'),
(100, 5, 2, 'City Center', 'Airport', 21.74, 482.36, 'completed', '2026-04-19 18:30:00');

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
(1, 'Priyansh Chauhan', 'priyansh.driver@gmail.com', '9000000001', '$2y$10$gdfDw8UoYEdveJFrLczeSObFCwRiQu6wQ7o7JUs.lIO/dnE.cgvjW', 'DL1001', 'Sedan', 'online', 'approved', '2026-01-03 03:00:00', '123_unknown.jpg'),
(2, 'Rakesh Yadav', 'rakesh.driver@gmail.com', '9000000002', '$2y$10$TSfcVJJu94xDMTqvAzvZr.HRupqPoR8CUOlrNvfjhqhGSOS1zNzjC', 'DL1002', 'SUV', 'offline', 'approved', '2026-01-04 04:15:00', '123_unknown.jpg'),
(3, 'Mahesh Patel', 'mahesh.driver@gmail.com', '9000000003', '$2y$10$vs/gkCxDRpTc1TdlIbp40.0Cxa/L0VapliyGpA.fZheR0Y0t1.y2q', 'DL1003', 'Mini', 'online', 'approved', '2026-01-05 05:30:00', '123_unknown.jpg'),
(4, 'Sanjay Kumar', 'sanjay.driver@gmail.com', '9000000004', '$2y$10$KkIlSzPJKD1frPnW5wWTUODQ/CyPvcpWWn2sZU.LJF/p2RrumNL2u', 'DL1004', 'Sedan', 'offline', 'approved', '2026-01-06 06:45:00', '123_unknown.jpg'),
(5, 'Deepak Shah', 'deepak.driver@gmail.com', '9000000005', '$2y$10$kkvB9al60F0wr.BMirAyz.h5mkYtIAqAiEBqM6uBPT.fYPWTTiAbW', 'DL1005', 'SUV', 'online', 'approved', '2026-01-07 08:10:00', '123_unknown.jpg');

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
(1, 1, 1, 424.41, 'cash', 'paid', '2026-01-10 18:40:00', 297.09, 127.32),
(2, 2, 4, 268.98, 'cash', 'paid', '2026-01-11 18:40:00', 188.29, 80.69),
(3, 3, 5, 682.66, 'cash', 'paid', '2026-01-12 18:40:00', 477.86, 204.80),
(4, 4, 2, 663.63, 'online', 'paid', '2026-01-13 18:40:00', 464.54, 199.09),
(5, 5, 5, 631.13, 'online', 'paid', '2026-01-14 18:40:00', 441.79, 189.34),
(6, 6, 2, 523.69, 'cash', 'paid', '2026-01-15 18:40:00', 366.58, 157.11),
(7, 7, 2, 303.65, 'cash', 'paid', '2026-01-16 18:40:00', 212.56, 91.10),
(8, 8, 1, 531.59, 'cash', 'paid', '2026-01-17 18:40:00', 372.11, 159.48),
(9, 9, 2, 540.10, 'online', 'paid', '2026-01-18 18:40:00', 378.07, 162.03),
(10, 10, 4, 496.43, 'cash', 'paid', '2026-01-19 18:40:00', 347.50, 148.93),
(11, 11, 2, 325.66, 'cash', 'paid', '2026-01-20 18:40:00', 227.96, 97.70),
(12, 12, 2, 291.66, 'cash', 'paid', '2026-01-21 18:40:00', 204.16, 87.50),
(13, 13, 2, 461.80, 'cash', 'paid', '2026-01-22 18:40:00', 323.26, 138.54),
(14, 14, 1, 571.55, 'cash', 'paid', '2026-01-23 18:40:00', 400.09, 171.47),
(15, 15, 5, 437.32, 'online', 'paid', '2026-01-24 18:40:00', 306.12, 131.20),
(16, 16, 5, 503.47, 'cash', 'paid', '2026-01-25 18:40:00', 352.43, 151.04),
(17, 17, 3, 566.71, 'cash', 'paid', '2026-01-26 18:40:00', 396.70, 170.01),
(18, 18, 1, 399.14, 'cash', 'paid', '2026-01-27 18:40:00', 279.40, 119.74),
(19, 19, 3, 301.74, 'online', 'paid', '2026-01-28 18:40:00', 211.22, 90.52),
(20, 20, 2, 465.11, 'online', 'paid', '2026-01-29 18:40:00', 325.58, 139.53),
(21, 21, 3, 392.66, 'online', 'paid', '2026-01-30 18:40:00', 274.86, 117.80),
(22, 22, 3, 309.33, 'cash', 'paid', '2026-01-31 18:40:00', 216.53, 92.80),
(23, 23, 3, 593.07, 'cash', 'paid', '2026-02-01 18:40:00', 415.15, 177.92),
(24, 24, 4, 668.63, 'cash', 'paid', '2026-02-02 18:40:00', 468.04, 200.59),
(25, 25, 2, 599.57, 'cash', 'paid', '2026-02-03 18:40:00', 419.70, 179.87),
(26, 26, 2, 293.26, 'cash', 'paid', '2026-02-04 18:40:00', 205.28, 87.98),
(27, 27, 5, 322.91, 'cash', 'paid', '2026-02-05 18:40:00', 226.04, 96.87),
(28, 28, 2, 303.96, 'online', 'paid', '2026-02-06 18:40:00', 212.77, 91.19),
(29, 29, 2, 402.63, 'online', 'paid', '2026-02-07 18:40:00', 281.84, 120.79),
(30, 30, 4, 282.57, 'online', 'paid', '2026-02-08 18:40:00', 197.80, 84.77),
(31, 31, 3, 608.27, 'online', 'paid', '2026-02-09 18:40:00', 425.79, 182.48),
(32, 32, 2, 549.90, 'online', 'paid', '2026-02-10 18:40:00', 384.93, 164.97),
(33, 33, 4, 644.17, 'online', 'paid', '2026-02-11 18:40:00', 450.92, 193.25),
(34, 34, 2, 208.31, 'online', 'paid', '2026-02-12 18:40:00', 145.82, 62.49),
(35, 35, 3, 571.20, 'online', 'paid', '2026-02-13 18:40:00', 399.84, 171.36),
(36, 36, 2, 349.77, 'online', 'paid', '2026-02-14 18:40:00', 244.84, 104.93),
(37, 37, 3, 503.03, 'online', 'paid', '2026-02-15 18:40:00', 352.12, 150.91),
(38, 38, 1, 509.41, 'cash', 'paid', '2026-02-16 18:40:00', 356.59, 152.82),
(39, 39, 2, 280.30, 'online', 'paid', '2026-02-17 18:40:00', 196.21, 84.09),
(40, 40, 4, 682.29, 'online', 'paid', '2026-02-18 18:40:00', 477.60, 204.69),
(41, 41, 1, 622.15, 'online', 'paid', '2026-02-19 18:40:00', 435.51, 186.65),
(42, 42, 4, 430.07, 'cash', 'paid', '2026-02-20 18:40:00', 301.05, 129.02),
(43, 43, 3, 421.90, 'cash', 'paid', '2026-02-21 18:40:00', 295.33, 126.57),
(44, 44, 5, 674.25, 'online', 'paid', '2026-02-22 18:40:00', 471.98, 202.28),
(45, 45, 3, 393.19, 'online', 'paid', '2026-02-23 18:40:00', 275.23, 117.96),
(46, 46, 4, 550.59, 'online', 'paid', '2026-02-24 18:40:00', 385.41, 165.18),
(47, 47, 3, 304.65, 'online', 'paid', '2026-02-25 18:40:00', 213.26, 91.40),
(48, 48, 5, 696.18, 'online', 'paid', '2026-02-26 18:40:00', 487.33, 208.85),
(49, 49, 5, 413.97, 'cash', 'paid', '2026-02-27 18:40:00', 289.78, 124.19),
(50, 50, 5, 400.51, 'online', 'paid', '2026-02-28 18:40:00', 280.36, 120.15),
(51, 51, 3, 642.09, 'cash', 'paid', '2026-03-01 18:40:00', 449.46, 192.63),
(52, 52, 4, 594.73, 'online', 'paid', '2026-03-02 18:40:00', 416.31, 178.42),
(53, 53, 1, 284.20, 'cash', 'paid', '2026-03-03 18:40:00', 198.94, 85.26),
(54, 54, 1, 607.15, 'online', 'paid', '2026-03-04 18:40:00', 425.01, 182.15),
(55, 55, 4, 530.89, 'cash', 'paid', '2026-03-05 18:40:00', 371.62, 159.27),
(56, 56, 5, 216.05, 'cash', 'paid', '2026-03-06 18:40:00', 151.24, 64.82),
(57, 57, 3, 402.17, 'online', 'paid', '2026-03-07 18:40:00', 281.52, 120.65),
(58, 58, 2, 245.93, 'online', 'paid', '2026-03-08 18:40:00', 172.15, 73.78),
(59, 59, 3, 578.07, 'cash', 'paid', '2026-03-09 18:40:00', 404.65, 173.42),
(60, 60, 2, 657.67, 'cash', 'paid', '2026-03-10 18:40:00', 460.37, 197.30),
(61, 61, 4, 558.60, 'online', 'paid', '2026-03-11 18:40:00', 391.02, 167.58),
(62, 62, 3, 626.87, 'online', 'paid', '2026-03-12 18:40:00', 438.81, 188.06),
(63, 63, 4, 569.74, 'cash', 'paid', '2026-03-13 18:40:00', 398.82, 170.92),
(64, 64, 4, 443.16, 'online', 'paid', '2026-03-14 18:40:00', 310.21, 132.95),
(65, 65, 3, 655.54, 'cash', 'paid', '2026-03-15 18:40:00', 458.88, 196.66),
(66, 66, 3, 252.68, 'cash', 'paid', '2026-03-16 18:40:00', 176.88, 75.80),
(67, 67, 1, 371.42, 'cash', 'paid', '2026-03-17 18:40:00', 259.99, 111.43),
(68, 68, 5, 231.47, 'cash', 'paid', '2026-03-18 18:40:00', 162.03, 69.44),
(69, 69, 1, 609.76, 'online', 'paid', '2026-03-19 18:40:00', 426.83, 182.93),
(70, 70, 5, 696.77, 'online', 'paid', '2026-03-20 18:40:00', 487.74, 209.03),
(71, 71, 4, 400.31, 'cash', 'paid', '2026-03-21 18:40:00', 280.22, 120.09),
(72, 72, 4, 668.76, 'online', 'paid', '2026-03-22 18:40:00', 468.13, 200.63),
(73, 73, 5, 259.56, 'online', 'paid', '2026-03-23 18:40:00', 181.69, 77.87),
(74, 74, 5, 657.89, 'cash', 'paid', '2026-03-24 18:40:00', 460.52, 197.37),
(75, 75, 5, 433.56, 'cash', 'paid', '2026-03-25 18:40:00', 303.49, 130.07),
(76, 76, 5, 223.39, 'online', 'paid', '2026-03-26 18:40:00', 156.37, 67.02),
(77, 77, 2, 304.41, 'cash', 'paid', '2026-03-27 18:40:00', 213.09, 91.32),
(78, 78, 4, 619.39, 'cash', 'paid', '2026-03-28 18:40:00', 433.57, 185.82),
(79, 79, 5, 594.57, 'cash', 'paid', '2026-03-29 18:40:00', 416.20, 178.37),
(80, 80, 2, 566.30, 'online', 'paid', '2026-03-30 18:40:00', 396.41, 169.89),
(81, 81, 2, 381.37, 'cash', 'paid', '2026-03-31 18:40:00', 266.96, 114.41),
(82, 82, 3, 237.77, 'cash', 'paid', '2026-04-01 18:40:00', 166.44, 71.33),
(83, 83, 1, 464.86, 'online', 'paid', '2026-04-02 18:40:00', 325.40, 139.46),
(84, 84, 5, 486.22, 'online', 'paid', '2026-04-03 18:40:00', 340.35, 145.87),
(85, 85, 2, 419.06, 'online', 'paid', '2026-04-04 18:40:00', 293.34, 125.72),
(86, 86, 3, 655.66, 'online', 'paid', '2026-04-05 18:40:00', 458.96, 196.70),
(87, 87, 4, 246.77, 'online', 'paid', '2026-04-06 18:40:00', 172.74, 74.03),
(88, 88, 3, 332.50, 'cash', 'paid', '2026-04-07 18:40:00', 232.75, 99.75),
(89, 89, 4, 357.97, 'cash', 'paid', '2026-04-08 18:40:00', 250.58, 107.39),
(90, 90, 3, 650.19, 'online', 'paid', '2026-04-09 18:40:00', 455.13, 195.06),
(91, 91, 3, 318.80, 'cash', 'paid', '2026-04-10 18:40:00', 223.16, 95.64),
(92, 92, 1, 483.31, 'cash', 'paid', '2026-04-11 18:40:00', 338.32, 144.99),
(93, 93, 5, 253.82, 'cash', 'paid', '2026-04-12 18:40:00', 177.67, 76.15),
(94, 94, 3, 210.45, 'cash', 'paid', '2026-04-13 18:40:00', 147.32, 63.14),
(95, 95, 3, 426.07, 'online', 'paid', '2026-04-14 18:40:00', 298.25, 127.82),
(96, 96, 1, 397.08, 'cash', 'paid', '2026-04-15 18:40:00', 277.96, 119.12),
(97, 97, 4, 486.57, 'cash', 'paid', '2026-04-16 18:40:00', 340.60, 145.97),
(98, 98, 4, 528.50, 'cash', 'paid', '2026-04-17 18:40:00', 369.95, 158.55),
(99, 99, 5, 664.70, 'cash', 'paid', '2026-04-18 18:40:00', 465.29, 199.41),
(100, 100, 2, 482.36, 'online', 'paid', '2026-04-19 18:40:00', 337.65, 144.71);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_visible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `booking_id`, `user_id`, `driver_id`, `rating`, `created_at`, `is_visible`) VALUES
(1, 1, 4, 1, 3, '2026-01-11 18:30:00', 1),
(2, 2, 7, 4, 4, '2026-01-12 18:30:00', 0),
(3, 3, 2, 5, 4, '2026-01-13 18:30:00', 1),
(4, 4, 8, 2, 4, '2026-01-14 18:30:00', 1),
(5, 5, 2, 5, 4, '2026-01-15 18:30:00', 0),
(6, 6, 10, 2, 3, '2026-01-16 18:30:00', 1),
(7, 7, 5, 2, 3, '2026-01-17 18:30:00', 1),
(8, 8, 8, 1, 4, '2026-01-18 18:30:00', 1),
(9, 9, 5, 2, 4, '2026-01-19 18:30:00', 1),
(10, 10, 4, 4, 5, '2026-01-20 18:30:00', 1),
(11, 11, 7, 2, 3, '2026-01-21 18:30:00', 1),
(12, 12, 4, 2, 3, '2026-01-22 18:30:00', 1),
(13, 13, 4, 2, 4, '2026-01-23 18:30:00', 1),
(14, 14, 2, 1, 4, '2026-01-24 18:30:00', 1),
(15, 15, 5, 5, 3, '2026-01-25 18:30:00', 1),
(16, 16, 7, 5, 4, '2026-01-26 18:30:00', 0),
(17, 17, 7, 3, 5, '2026-01-27 18:30:00', 1),
(18, 18, 7, 1, 3, '2026-01-28 18:30:00', 0),
(19, 19, 4, 3, 3, '2026-01-29 18:30:00', 1),
(20, 20, 10, 2, 5, '2026-01-30 18:30:00', 1),
(21, 21, 3, 3, 5, '2026-01-31 18:30:00', 0),
(22, 22, 9, 3, 5, '2026-02-01 18:30:00', 0),
(23, 23, 9, 3, 5, '2026-02-02 18:30:00', 1),
(24, 24, 1, 4, 3, '2026-02-03 18:30:00', 0),
(25, 25, 5, 2, 3, '2026-02-04 18:30:00', 1),
(26, 26, 4, 2, 5, '2026-02-05 18:30:00', 1),
(27, 27, 2, 5, 3, '2026-02-06 18:30:00', 1),
(28, 28, 10, 2, 5, '2026-02-07 18:30:00', 1),
(29, 29, 3, 2, 5, '2026-02-08 18:30:00', 1),
(30, 30, 8, 4, 5, '2026-02-09 18:30:00', 0),
(31, 31, 1, 3, 4, '2026-02-10 18:30:00', 1),
(32, 32, 4, 2, 5, '2026-02-11 18:30:00', 1),
(33, 33, 10, 4, 3, '2026-02-12 18:30:00', 1),
(34, 34, 6, 2, 4, '2026-02-13 18:30:00', 1),
(35, 35, 2, 3, 5, '2026-02-14 18:30:00', 1),
(36, 36, 4, 2, 3, '2026-02-15 18:30:00', 1),
(37, 37, 9, 3, 5, '2026-02-16 18:30:00', 1),
(38, 38, 10, 1, 5, '2026-02-17 18:30:00', 1),
(39, 39, 1, 2, 5, '2026-02-18 18:30:00', 1),
(40, 40, 3, 4, 3, '2026-02-19 18:30:00', 1),
(41, 41, 10, 1, 3, '2026-02-20 18:30:00', 1),
(42, 42, 7, 4, 4, '2026-02-21 18:30:00', 1),
(43, 43, 5, 3, 5, '2026-02-22 18:30:00', 0),
(44, 44, 7, 5, 4, '2026-02-23 18:30:00', 1),
(45, 45, 5, 3, 4, '2026-02-24 18:30:00', 1),
(46, 46, 4, 4, 3, '2026-02-25 18:30:00', 0),
(47, 47, 2, 3, 3, '2026-02-26 18:30:00', 0),
(48, 48, 9, 5, 3, '2026-02-27 18:30:00', 1),
(49, 49, 4, 5, 3, '2026-02-28 18:30:00', 1),
(50, 50, 9, 5, 3, '2026-03-01 18:30:00', 1),
(51, 51, 9, 3, 5, '2026-03-02 18:30:00', 1),
(52, 52, 2, 4, 3, '2026-03-03 18:30:00', 1),
(53, 53, 2, 1, 3, '2026-03-04 18:30:00', 1),
(54, 54, 4, 1, 4, '2026-03-05 18:30:00', 1),
(55, 55, 9, 4, 3, '2026-03-06 18:30:00', 0),
(56, 56, 5, 5, 5, '2026-03-07 18:30:00', 1),
(57, 57, 8, 3, 4, '2026-03-08 18:30:00', 1),
(58, 58, 5, 2, 3, '2026-03-09 18:30:00', 1),
(59, 59, 6, 3, 5, '2026-03-10 18:30:00', 0),
(60, 60, 9, 2, 5, '2026-03-11 18:30:00', 1),
(61, 61, 4, 4, 3, '2026-03-12 18:30:00', 1),
(62, 62, 9, 3, 5, '2026-03-13 18:30:00', 1),
(63, 63, 3, 4, 5, '2026-03-14 18:30:00', 1),
(64, 64, 10, 4, 4, '2026-03-15 18:30:00', 0),
(65, 65, 3, 3, 4, '2026-03-16 18:30:00', 1),
(66, 66, 3, 3, 5, '2026-03-17 18:30:00', 0),
(67, 67, 2, 1, 5, '2026-03-18 18:30:00', 0),
(68, 68, 4, 5, 4, '2026-03-19 18:30:00', 1),
(69, 69, 3, 1, 3, '2026-03-20 18:30:00', 0),
(70, 70, 3, 5, 4, '2026-03-21 18:30:00', 1),
(71, 71, 8, 4, 3, '2026-03-22 18:30:00', 0),
(72, 72, 8, 4, 5, '2026-03-23 18:30:00', 1),
(73, 73, 4, 5, 4, '2026-03-24 18:30:00', 1),
(74, 74, 9, 5, 5, '2026-03-25 18:30:00', 0),
(75, 75, 2, 5, 3, '2026-03-26 18:30:00', 1),
(76, 76, 3, 5, 3, '2026-03-27 18:30:00', 1),
(77, 77, 3, 2, 3, '2026-03-28 18:30:00', 1),
(78, 78, 9, 4, 5, '2026-03-29 18:30:00', 0),
(79, 79, 5, 5, 4, '2026-03-30 18:30:00', 0),
(80, 80, 9, 2, 3, '2026-03-31 18:30:00', 1),
(81, 81, 5, 2, 4, '2026-04-01 18:30:00', 0),
(82, 82, 7, 3, 4, '2026-04-02 18:30:00', 1),
(83, 83, 5, 1, 5, '2026-04-03 18:30:00', 1),
(84, 84, 6, 5, 3, '2026-04-04 18:30:00', 1),
(85, 85, 10, 2, 5, '2026-04-05 18:30:00', 1),
(86, 86, 3, 3, 4, '2026-04-06 18:30:00', 1),
(87, 87, 9, 4, 5, '2026-04-07 18:30:00', 1),
(88, 88, 10, 3, 3, '2026-04-08 18:30:00', 1),
(89, 89, 7, 4, 4, '2026-04-09 18:30:00', 0),
(90, 90, 2, 3, 3, '2026-04-10 18:30:00', 1),
(91, 91, 7, 3, 4, '2026-04-11 18:30:00', 0),
(92, 92, 6, 1, 3, '2026-04-12 18:30:00', 0),
(93, 93, 6, 5, 5, '2026-04-13 18:30:00', 1),
(94, 94, 10, 3, 5, '2026-04-14 18:30:00', 1),
(95, 95, 4, 3, 3, '2026-04-15 18:30:00', 0),
(96, 96, 2, 1, 4, '2026-04-16 18:30:00', 1),
(97, 97, 6, 4, 4, '2026-04-17 18:30:00', 1),
(98, 98, 4, 4, 3, '2026-04-18 18:30:00', 1),
(99, 99, 10, 5, 3, '2026-04-19 18:30:00', 0),
(100, 100, 5, 2, 4, '2026-04-20 18:30:00', 1);

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
(1, 'Rohan Navadiya', 'rohan.navadiya@gmail.com', '9876543210', '$2y$10$r.Ufh5bSbLOl.8YknSqpo..eIBKZPuVtUAhwaUYDY4n4ZUEU32tPG', 'active', '2026-01-02 03:45:00', '123_unknown.jpg'),
(2, 'Amit Sharma', 'amit.sharma@gmail.com', '9876543211', '$2y$10$Q1ReR8zfRGk1H/fpE9NwgebT2YUDMtWzJcZNACp1hyFmU.cgvRa7u', 'active', '2026-01-03 04:30:00', '123_unknown.jpg'),
(3, 'Priya Patel', 'priya.patel@gmail.com', '9876543212', '$2y$10$5gktNsqKHzW5njkltZybpO2Yf3vSH3kyLETRWakSKrc6sAEIx9SJ.', 'active', '2026-01-04 05:50:00', '123_unknown.jpg'),
(4, 'Neha Verma', 'neha.verma@gmail.com', '9876543213', '$2y$10$MAtCIfiJW0.lkfCt63oGcewahrTv.pELHE3Db7w4MlXr.e4IUh5rC', 'active', '2026-01-05 06:40:00', '123_unknown.jpg'),
(5, 'Rahul Mehta', 'rahul.mehta@gmail.com', '9876543214', '$2y$10$h1G6b6p0lCQvOaBPo8frz.N4JoYBByF6yNS6q2peuPGvIog/wg7Se', 'active', '2026-01-06 09:15:00', '123_unknown.jpg'),
(6, 'Kunal Joshi', 'kunal.joshi@gmail.com', '9876543215', '$2y$10$L9OMJRDMLr9BWo.Lbvu4Jey9pDjm/GiFzIf4aXZlAzwN5IDoojP/i', 'active', '2026-01-07 10:00:00', '123_unknown.jpg'),
(7, 'Sneha Iyer', 'sneha.iyer@gmail.com', '9876543216', '$2y$10$ECSTq.3C57/JvDFQrSqPue5Ddp/HRLrcdornABaj6mmneZBcFAPPi', 'active', '2026-01-08 10:30:00', '123_unknown.jpg'),
(8, 'Vikas Singh', 'vikas.singh@gmail.com', '9876543217', '$2y$10$DMK7nGjaL5.0RKcgvfQBf.PZym/r1IWPY3o1xoKcxTR56jqildfK.', 'active', '2026-01-09 11:40:00', '123_unknown.jpg'),
(9, 'Anjali Desai', 'anjali.desai@gmail.com', '9876543218', '$2y$10$BU80QzQ1kLnGpv2.gSyrvekPb2tvhG1Tu.wR9/sB36ssLe.SpK2VK', 'active', '2026-01-10 12:50:00', '123_unknown.jpg'),
(10, 'Suresh Kumar', 'suresh.kumar@gmail.com', '9876543219', '$2y$10$M71RlRw4rHy6jW43PbUOEu1U749SM9/zXhsiphKwwIqCv4n/8SbPW', 'active', '2026-01-11 14:00:00', '123_unknown.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
