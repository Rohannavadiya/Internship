-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2026 at 06:18 AM
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
-- Database: `rohan`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `account_num` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `source` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `paid_to` varchar(100) DEFAULT NULL,
  `expense_type` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cheqe_num` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expense_date`, `account_num`, `amount`, `source`, `category`, `payment_method`, `paid_to`, `expense_type`, `description`, `cheqe_num`, `created_at`) VALUES
(1, '2025-01-01', 2001, 800.00, 'Salary', 'Food', 'Cash', 'Restaurant', 'Variable', 'Lunch', '', '2025-12-28 16:38:53'),
(2, '2025-01-02', 2001, 1500.00, 'Salary', 'Transport', 'UPI', 'Fuel Pump', 'Variable', 'Petrol', '', '2025-12-28 16:38:53'),
(3, '2025-01-03', 2002, 12000.00, 'Salary', 'Rent', 'Bank', 'Landlord', 'Fixed', 'Office rent', '', '2025-12-28 16:38:53'),
(4, '2025-01-04', 2002, 2500.00, 'Salary', 'Utilities', 'UPI', 'Electric Board', 'Fixed', 'Electric bill', '', '2025-12-28 16:38:53'),
(5, '2025-01-05', 2003, 1800.00, 'Salary', 'Internet', 'UPI', 'ISP', 'Fixed', 'Internet bill', '', '2025-12-28 16:38:53'),
(6, '2025-01-06', 2001, 600.00, 'Salary', 'Food', 'Cash', 'Cafe', 'Variable', 'Snacks', '', '2025-12-28 16:38:53'),
(7, '2025-01-07', 2002, 900.00, 'Salary', 'Transport', 'Cash', 'Auto', 'Variable', 'Travel', '', '2025-12-28 16:38:53'),
(8, '2025-01-08', 2003, 3000.00, 'Salary', 'Shopping', 'UPI', 'Store', 'Variable', 'Office items', '', '2025-12-28 16:38:53'),
(9, '2025-01-09', 2001, 2000.00, 'Salary', 'Medical', 'Cash', 'Clinic', 'Variable', 'Checkup', '', '2025-12-28 16:38:53'),
(10, '2025-01-10', 2002, 1500.00, 'Salary', 'Entertainment', 'UPI', 'Cinema', 'Variable', 'Movie', '', '2025-12-28 16:38:53'),
(11, '2025-01-11', 2001, 1000.00, 'Salary', 'Food', 'Cash', 'Restaurant', 'Variable', 'Dinner', '', '2025-12-28 16:38:53'),
(12, '2025-01-12', 2002, 1700.00, 'Salary', 'Transport', 'UPI', 'Fuel Pump', 'Variable', 'Fuel', '', '2025-12-28 16:38:53'),
(13, '2025-01-13', 2003, 12000.00, 'Salary', 'Rent', 'Bank', 'Landlord', 'Fixed', 'Warehouse rent', '', '2025-12-28 16:38:53'),
(14, '2025-01-14', 2001, 2600.00, 'Salary', 'Utilities', 'UPI', 'Water Dept', 'Fixed', 'Water bill', '', '2025-12-28 16:38:53'),
(15, '2025-01-15', 2002, 1900.00, 'Salary', 'Internet', 'UPI', 'ISP', 'Fixed', 'Internet', '', '2025-12-28 16:38:53'),
(16, '2025-01-16', 2003, 700.00, 'Salary', 'Food', 'Cash', 'Cafe', 'Variable', 'Tea snacks', '', '2025-12-28 16:38:53'),
(17, '2025-01-17', 2001, 2200.00, 'Salary', 'Transport', 'Cash', 'Taxi', 'Variable', 'Client visit', '', '2025-12-28 16:38:53'),
(18, '2025-01-18', 2002, 4000.00, 'Salary', 'Shopping', 'UPI', 'Market', 'Variable', 'Supplies', '', '2025-12-28 16:38:53'),
(19, '2025-01-19', 2003, 3500.00, 'Salary', 'Medical', 'Cash', 'Hospital', 'Variable', 'Medicines', '', '2025-12-28 16:38:53'),
(20, '2025-01-20', 2001, 1800.00, 'Salary', 'Entertainment', 'UPI', 'Streaming', 'Variable', 'Subscription', '', '2025-12-28 16:38:53'),
(21, '2025-01-21', 2002, 900.00, 'Salary', 'Food', 'Cash', 'Restaurant', 'Variable', 'Lunch', '', '2025-12-28 16:38:53'),
(22, '2025-01-22', 2003, 1600.00, 'Salary', 'Transport', 'UPI', 'Fuel Pump', 'Variable', 'Petrol', '', '2025-12-28 16:38:53'),
(23, '2025-01-23', 2001, 13000.00, 'Salary', 'Rent', 'Bank', 'Landlord', 'Fixed', 'Office rent', '', '2025-12-28 16:38:53'),
(24, '2025-01-24', 2002, 2400.00, 'Salary', 'Utilities', 'UPI', 'Electric Board', 'Fixed', 'Bill', '', '2025-12-28 16:38:53'),
(25, '2025-01-25', 2003, 2000.00, 'Salary', 'Internet', 'UPI', 'ISP', 'Fixed', 'Internet', '', '2025-12-28 16:38:53'),
(26, '2025-01-26', 2001, 750.00, 'Salary', 'Food', 'Cash', 'Cafe', 'Variable', 'Breakfast', '', '2025-12-28 16:38:53'),
(27, '2025-01-27', 2002, 2800.00, 'Salary', 'Transport', 'Cash', 'Bus', 'Variable', 'Travel', '', '2025-12-28 16:38:53'),
(28, '2025-01-28', 2003, 5000.00, 'Salary', 'Shopping', 'UPI', 'Electronics', 'Variable', 'Accessories', '', '2025-12-28 16:38:53'),
(29, '2025-01-29', 2001, 3000.00, 'Salary', 'Medical', 'Cash', 'Pharmacy', 'Fixed', 'Medicines', '', '2025-12-28 16:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(11) NOT NULL,
  `income_date` date NOT NULL,
  `account_num` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `source` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `received_from` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cheqe_num` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `income_date`, `account_num`, `amount`, `source`, `category`, `payment_method`, `received_from`, `description`, `cheqe_num`, `created_at`) VALUES
(1, '2025-01-01', 1001, 45000.00, 'Salary', 'Fixed', 'Bank', 'ABC Pvt Ltd', 'January Salary', 'CHQ001', '2025-12-28 16:38:39'),
(2, '2025-01-02', 1002, 12000.00, 'Freelance', 'Variable', 'UPI', 'Client A', 'Website work', 'CHQ002', '2025-12-28 16:38:39'),
(3, '2025-01-03', 1003, 2000.00, 'Interest', 'Fixed', 'Bank', 'SBI Bank', 'Savings interest', 'CHQ003', '2025-12-28 16:38:39'),
(4, '2025-01-04', 1004, 18000.00, 'Business', 'Variable', 'Cash', 'Shop', 'Daily sales', 'CHQ004', '2025-12-28 16:38:39'),
(5, '2025-01-05', 1005, 3000.00, 'Gift', 'Variable', 'Cash', 'Friend', 'Birthday gift', 'CHQ005', '2025-12-28 16:38:39'),
(6, '2025-01-06', 1001, 45000.00, 'Salary', 'Fixed', 'Bank', 'ABC Pvt Ltd', 'February Salary', 'CHQ006', '2025-12-28 16:38:39'),
(7, '2025-01-07', 1002, 10000.00, 'Freelance', 'Variable', 'UPI', 'Client B', 'App work', 'CHQ007', '2025-12-28 16:38:39'),
(8, '2025-02-08', 1003, 2200.00, 'Interest', 'Fixed', 'Bank', 'HDFC Bank', 'FD interest', 'CHQ008', '2025-12-28 16:38:39'),
(9, '2025-02-09', 1004, 16000.00, 'Business', 'Variable', 'Cash', 'Shop', 'Weekend sales', 'CHQ009', '2025-12-28 16:38:39'),
(10, '2025-01-10', 1005, 4000.00, 'Bonus', 'Variable', 'Bank', 'ABC Pvt Ltd', 'Performance bonus', 'CHQ010', '2025-12-28 16:38:39'),
(11, '2025-01-11', 1001, 45000.00, 'Salary', 'Fixed', 'Bank', 'ABC Pvt Ltd', 'March Salary', 'CHQ011', '2025-12-28 16:38:39'),
(12, '2025-01-12', 1002, 9000.00, 'Freelance', 'Variable', 'UPI', 'Client C', 'Design work', 'CHQ012', '2025-12-28 16:38:39'),
(13, '2025-01-13', 1003, 2100.00, 'Interest', 'Fixed', 'Bank', 'SBI Bank', 'Monthly interest', 'CHQ013', '2025-12-28 16:38:39'),
(14, '2025-09-14', 1004, 17000.00, 'Business', 'Variable', 'Cash', 'Shop', 'Retail income', 'CHQ014', '2025-12-28 16:38:39'),
(15, '2025-01-15', 1005, 2500.00, 'Gift', 'Variable', 'Cash', 'Relative', 'Festival gift', 'CHQ015', '2025-12-28 16:38:39'),
(16, '2025-01-16', 1001, 46000.00, 'Salary', 'Fixed', 'Bank', 'ABC Pvt Ltd', 'April Salary', 'CHQ016', '2025-12-28 16:38:39'),
(17, '2025-01-17', 1002, 11000.00, 'Freelance', 'Variable', 'UPI', 'Client D', 'SEO work', 'CHQ017', '2025-12-28 16:38:39'),
(18, '2025-01-18', 1003, 2300.00, 'Interest', 'Fixed', 'Bank', 'Axis Bank', 'Interest credit', 'CHQ018', '2025-12-28 16:38:39'),
(19, '2025-01-19', 1004, 19000.00, 'Business', 'Variable', 'Cash', 'Shop', 'Holiday sales', 'CHQ019', '2025-12-28 16:38:39'),
(20, '2025-08-20', 1005, 3500.00, 'Bonus', 'Variable', 'Bank', 'ABC Pvt Ltd', 'Referral bonus', 'CHQ020', '2025-12-28 16:38:39'),
(21, '2025-01-21', 1001, 47000.00, 'Salary', 'Fixed', 'Bank', 'ABC Pvt Ltd', 'May Salary', 'CHQ021', '2025-12-28 16:38:39'),
(22, '2025-01-22', 1002, 13000.00, 'Freelance', 'Variable', 'UPI', 'Client E', 'API work', 'CHQ022', '2025-12-28 16:38:39'),
(23, '2025-02-23', 1003, 2400.00, 'Interest', 'Fixed', 'Bank', 'SBI Bank', 'Interest', 'CHQ023', '2025-12-28 16:38:39'),
(24, '2025-01-24', 1004, 17500.00, 'Business', 'Variable', 'Cash', 'Shop', 'Daily income', 'CHQ024', '2025-12-28 16:38:39'),
(25, '2025-01-25', 1005, 2800.00, 'Gift', 'Variable', 'Cash', 'Friend', 'Anniversary gift', 'CHQ025', '2025-12-28 16:38:39'),
(26, '2025-01-26', 1001, 48000.00, 'Salary', 'Fixed', 'Bank', 'ABC Pvt Ltd', 'June Salary', 'CHQ026', '2025-12-28 16:38:39'),
(27, '2025-01-27', 1002, 14000.00, 'Freelance', 'Variable', 'UPI', 'Client F', 'Backend work', 'CHQ027', '2025-12-28 16:38:39'),
(28, '2025-01-28', 1003, 2500.00, 'Interest', 'Fixed', 'Bank', 'HDFC Bank', 'Interest', 'CHQ028', '2025-12-28 16:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `master_account`
--

CREATE TABLE `master_account` (
  `id` int(11) NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `acc_group` varchar(50) DEFAULT NULL,
  `opening_balance` decimal(10,2) DEFAULT 0.00,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `state_code` varchar(10) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `bank_ifsc` varchar(20) DEFAULT NULL,
  `bank_branch` varchar(100) DEFAULT NULL,
  `registry_number` varchar(50) DEFAULT NULL,
  `dl_number` varchar(50) DEFAULT NULL,
  `credit_limit` decimal(15,2) DEFAULT 0.00,
  `credit_day` int(11) DEFAULT 0,
  `bill_limit` decimal(15,2) DEFAULT 0.00,
  `audit` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_account`
--

INSERT INTO `master_account` (`id`, `acc_name`, `acc_group`, `opening_balance`, `address1`, `address2`, `city`, `pincode`, `state`, `state_code`, `mobile_number`, `phone_number`, `email`, `bank_name`, `bank_account_number`, `bank_ifsc`, `bank_branch`, `registry_number`, `dl_number`, `credit_limit`, `credit_day`, `bill_limit`, `audit`, `remark`, `created_at`) VALUES
(1, 'Cash Account', 'Asset', 50000.00, 'Main Market Road', 'Near Tower Chowk', 'Bhavnagar', '364001', 'Gujarat', 'GJ', '9876543210', '02782543210', 'cash@company.com', 'State Bank of India', '111122223333', 'SBIN0000456', 'Bhavnagar Main', 'REG001', 'DL001', 0.00, 0, 0.00, 'Yes', 'Main cash handling account', '2025-12-30 10:26:18'),
(2, 'Bank of India', 'Asset', 120000.00, 'Station Road', 'Opp Bus Stand', 'Bhavnagar', '364002', 'Gujarat', 'GJ', '9898989898', '02782541111', 'boi@company.com', 'Bank of India', '222233334444', 'BKID0001234', 'Station Road', 'REG002', 'DL002', 0.00, 0, 0.00, 'Yes', 'Primary company bank', '2026-01-02 04:51:56'),
(3, 'Office Rent', 'Expense', 0.00, 'Kalubha Road', '2nd Floor', 'Bhavnagar', '364003', 'Gujarat', 'GJ', '9123456789', '02782542222', 'rent@vendor.com', 'HDFC Bank', '333344445555', 'HDFC0000789', 'Kalubha Road', 'REG003', 'DL003', 30000.00, 30, 30000.00, 'No', 'Monthly office rent', '2026-01-02 04:52:07'),
(4, 'Electricity Board', 'Expense', 0.00, 'Power House Road', 'City Office', 'Bhavnagar', '364004', 'Gujarat', 'GJ', '9012345678', '02782543333', 'electricity@board.com', 'ICICI Bank', '444455556666', 'ICIC0000567', 'City Branch', 'REG004', 'DL004', 15000.00, 15, 15000.00, 'No', 'Electricity expenses', '2026-01-02 04:52:35'),
(5, 'Internet Services', 'Expense', 0.00, 'Hill Drive', 'Tech Park', 'Bhavnagar', '364005', 'Gujarat', 'GJ', '9988776655', '02782544444', 'internet@isp.com', 'Axis Bank', '555566667777', 'UTIB0000890', 'Hill Drive', 'REG005', 'DL005', 5000.00, 20, 5000.00, 'No', 'Broadband & internet', '2026-01-02 04:52:46'),
(6, 'Sales Account', 'Income', 0.00, 'Business Park', 'Sales Wing', 'Bhavnagar', '364006', 'Gujarat', 'GJ', '9871234560', '02782545555', 'sales@company.com', 'HDFC Bank', '666677778888', 'HDFC0000123', 'Business Park', 'REG006', 'DL006', 0.00, 0, 0.00, 'Yes', 'Sales income account', '2026-01-02 04:53:02'),
(7, 'Service Income', 'Income', 0.00, 'Service Road', 'Unit 5', 'Bhavnagar', '364007', 'Gujarat', 'GJ', '9812345678', '02782546666', 'service@company.com', 'SBI', '777788889999', 'SBIN0000678', 'Service Road', 'REG007', 'DL007', 0.00, 0, 0.00, 'Yes', 'Service income', '2026-01-02 04:53:14'),
(8, 'HDFC Bank', 'Asset', 250000.00, 'Waghawadi Road', 'HDFC Building', 'Bhavnagar', '364008', 'Gujarat', 'GJ', '9900112233', '02782547777', 'hdfc@company.com', 'HDFC Bank', '888899990000', 'HDFC0000456', 'Waghawadi', 'REG008', 'DL008', 0.00, 0, 0.00, 'Yes', 'Savings bank account', '2026-01-02 04:53:24'),
(9, 'Stationery Supplier', 'Expense', 0.00, 'Market Yard', 'Shop No 12', 'Bhavnagar', '364009', 'Gujarat', 'GJ', '9090909090', '2782548888', 'stationery@vendor.com', 'Union Bank', '999900001111', 'UBIN0000345', 'Market Yard', 'REG009', 'DL009', 10000.00, 20, 10000.00, 'No', 'Office stationery supplier', '2026-01-02 04:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Rohan', 'rohan@gmail.com', '$2y$10$zWhbEmfYJNitXrd/CzDLzeXmubAYyJmxEnHq3SUXpGm5fcTvmuIKS', 'admin', '2025-12-30 11:33:29'),
(2, 'User', 'user@gmail.com', '$2y$10$XyFKzUqzaAhJ55hKSzWNCeylDjGlX/j8Tz6MjYvdU1BxrYxogasAG', 'user', '2025-12-30 12:02:11'),
(3, 'Priyansh', 'priyansh@gmail.com', '$2y$10$S8Me5NG2HTzcETEl3TemLuHY3Iurq.vfbYppZKCNZlh76mfoslOe.', 'admin', '2026-01-08 04:55:30'),
(4, 'Raj', 'raj@gmail.com', '$2y$10$UTIwrHy3UHMy0h31lgdCduJV58k2OavbR00X/kxes..AxFsVh/.A.', 'admin', '2026-01-09 04:14:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- Indexes for table `master_account`
--
ALTER TABLE `master_account`
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
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `master_account`
--
ALTER TABLE `master_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
