-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2026 at 10:18 PM
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
-- Database: `clothingstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`admin_id`, `full_name`, `email`, `password_hash`) VALUES
(1, 'Admin User', 'admin@pastimes.co.za', 'c93ccd78b2076528346216b3b2f701e6');

-- --------------------------------------------------------

--
-- Table structure for table `tblclothes`
--

CREATE TABLE `tblclothes` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `clothing_condition` varchar(50) DEFAULT NULL,
  `sell_price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `image_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclothes`
--

INSERT INTO `tblclothes` (`item_id`, `item_name`, `description`, `brand`, `size`, `clothing_condition`, `sell_price`, `quantity`, `image_name`) VALUES
(1, 'Denim Jacket', 'Blue denim jacket in good condition.', 'Levis', 'M', 'Good', 250.00, 2, 'denim.jpg'),
(2, 'Summer Dress', 'Floral summer dress, lightly worn.', 'Zara', 'S', 'Excellent', 180.00, 1, 'dress.jpg'),
(3, 'White Sneakers', 'Comfortable pre-owned sneakers.', 'Nike', '7', 'Good', 300.00, 3, 'shoes.jpg'),
(4, 'Black Jeans', 'Slim fit black jeans.', 'H&M', '32', 'Good', 200.00, 4, 'jeans.jpg'),
(5, 'Formal Shirt', 'Formal shirt suitable for work.', 'Cotton On', 'L', 'Excellent', 150.00, 3, 'shirt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`order_id`, `user_id`, `order_date`, `total_amount`, `status`) VALUES
(1, 7, '2026-05-04 19:44:41', 250.00, 'Pending'),
(2, 7, '2026-05-04 19:47:05', 480.00, 'Pending'),
(3, 7, '2026-05-04 19:58:52', 200.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tblorderline`
--

CREATE TABLE `tblorderline` (
  `order_line_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorderline`
--

INSERT INTO `tblorderline` (`order_line_id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 250.00),
(2, 2, 2, 1, 180.00),
(3, 2, 3, 1, 300.00),
(4, 3, 4, 1, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` enum('pending','verified') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`user_id`, `full_name`, `email`, `username`, `password_hash`, `status`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', 'johndoe', '5f4dcc3b5aa765d61d8327deb882cf99', 'verified', '2026-05-04 19:12:40'),
(2, 'Mary Smith', 'mary@example.com', 'marysmith', '5f4dcc3b5aa765d61d8327deb882cf99', 'pending', '2026-05-04 19:12:40'),
(3, 'Aisha Khan', 'aisha@example.com', 'aishak', '5f4dcc3b5aa765d61d8327deb882cf99', 'verified', '2026-05-04 19:12:40'),
(4, 'Thabo Mokoena', 'thabo@example.com', 'thabom', '5f4dcc3b5aa765d61d8327deb882cf99', 'pending', '2026-05-04 19:12:40'),
(5, 'Lisa Adams', 'lisa@example.com', 'lisaa', '5f4dcc3b5aa765d61d8327deb882cf99', 'verified', '2026-05-04 19:12:40'),
(7, 'Aneeqah Fisher', 'fisheraneeqah45@gmail.com', 'anni', '5f4dcc3b5aa765d61d8327deb882cf99', 'verified', '2026-05-04 19:19:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tblclothes`
--
ALTER TABLE `tblclothes`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblorderline`
--
ALTER TABLE `tblorderline`
  ADD PRIMARY KEY (`order_line_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblclothes`
--
ALTER TABLE `tblclothes`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblorderline`
--
ALTER TABLE `tblorderline`
  MODIFY `order_line_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD CONSTRAINT `tblorder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`user_id`);

--
-- Constraints for table `tblorderline`
--
ALTER TABLE `tblorderline`
  ADD CONSTRAINT `tblorderline_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tblorder` (`order_id`),
  ADD CONSTRAINT `tblorderline_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tblclothes` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
