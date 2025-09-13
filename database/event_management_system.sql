-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2025 at 11:33 AM
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
-- Database: `event_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Admin User', 'admin@example.com', '0192023a7bbd73250516f069df18b500'),
(6, 'AFNAN vai', 'afnan@gmail.com', '91336517b9fe9b2cdd425e80b9666f44');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `event_id`, `location`, `event_date`, `quantity`, `status`, `created_at`) VALUES
(1, 4, 2, 'Dhaka', '2025-09-25', 57, 'Rejected', '2025-09-09 01:17:31'),
(2, 4, 1, 'Barishal', '2025-09-30', 134, 'Approved', '2025-09-09 02:59:26'),
(3, 4, 2, 'Khulna', '2025-09-30', 78, 'Rejected', '2025-09-12 15:37:17'),
(4, 4, 3, 'Kuakata', '2025-09-23', 98, 'Pending', '2025-09-12 15:39:37'),
(5, 4, 2, 'Gulshan', '2025-09-19', 65, 'Pending', '2025-09-12 15:41:34'),
(6, 4, 2, 'Dhanmondi', '2025-09-30', 7, 'Pending', '2025-09-13 09:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `image`, `base_price`, `created_at`) VALUES
(1, 'Birthday', '1757755175_birthday4.jpg', 670.00, '2025-09-08 04:20:08'),
(2, 'Corporate', '1757341485_corporate2.jpg', 1000.00, '2025-09-08 14:24:45'),
(3, 'Wedding', '1757341621_wedding9.jpg', 800.00, '2025-09-08 14:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'Completed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `booking_id`, `user_id`, `amount`, `method`, `status`, `created_at`) VALUES
(7, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 02:34:58'),
(8, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 02:48:33'),
(9, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 02:48:42'),
(10, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 02:54:40'),
(11, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 02:54:52'),
(12, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 03:07:48'),
(13, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 03:08:28'),
(14, 2, 4, 89780.00, 'Credit Card', 'Completed', '2025-09-12 03:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`, `created_at`) VALUES
(4, 'afnan', 'nahin.islam.bd4@gmail.com', '01234534569', '$2y$10$qR1F7FCgnKd.DYfCN0Z0oeKU6IrN9l/y/9cCbwcY8jYn1mr3.IBbG', '2025-09-05 23:36:28'),
(7, 'aman', 'aman@gmail.com', '01234534567', '$2y$10$q/ATWqjENwgZakD.Ksde2uJz6GX74m.9ftFSY7BHq4qB3WfcrO28S', '2025-09-06 16:06:25'),
(8, 'joybangla', 'joy@gmail.com', '0123453456', '$2y$10$SR.XAShqH1XYznMd9zzWhemacqY3YpwQzq9aFIFSkbzhrL2SfZyA2', '2025-09-09 06:29:35'),
(9, 'argho', 'argho@gmail.com', '018875365897', '$2y$10$752ZXoSrB5bX0HM57oxb1eYc0XyQYYkWHjFMwlZtAtlDIu1o.S9gK', '2025-09-12 10:50:23'),
(10, 'hjk', 'qwr@gmail.com', '01234534569', '$2y$10$Ljiov.0DUrYgv33tZ2PVcO0zmcmjTkimiIcAW9.tiT1udkIodbcl6', '2025-09-13 04:01:02');

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
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_ibfk_1` (`booking_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
