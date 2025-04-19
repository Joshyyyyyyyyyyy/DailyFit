-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 04:11 PM
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
-- Database: `dailyfit`
--

-- --------------------------------------------------------

--
-- Table structure for table `allproduct`
--

CREATE TABLE `allproduct` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `badge` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `color1` varchar(7) DEFAULT NULL,
  `color2` varchar(7) DEFAULT NULL,
  `color3` varchar(7) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allproduct`
--

INSERT INTO `allproduct` (`id`, `title`, `price`, `badge`, `description`, `color1`, `color2`, `color3`, `image`) VALUES
(1, 'joshu', 20.00, 'sale', 'hahahtfdi7fgihobvdrhjkhjvc5ev rctghuiokp,mkhjrzxtcyghnkjnbtyfghj', '#ff0000', '#0022cc', '#4d0000', 'image/5.jpg'),
(2, 'SHORT', 20.00, 'sale', 'SHORT', '#ffffff', '#000000', '#ffee38', 'image/4.jpg'),
(3, 'STUSSY', 20.00, 'New', 'New Brand', '#000000', '#000000', '#000000', 'image/5.jpg'),
(4, 'Limited Edition Shirt', 1000.00, 'New', 'Limited Edition', '#000000', '#000000', '#000000', 'image/6.jpg'),
(5, 'Limited Edition Shirt', 1000.00, 'New', 'Limited Edition', '#000000', '#000000', '#000000', 'image/7.jpg'),
(6, 'Limited Edition', 1000.00, 'New', 'Limited Edition', '#000000', '#000000', '#000000', 'image/8.jpg'),
(7, 'Limited Edition', 1000.00, 'New', 'Limited Edition', '#000000', '#000000', '#000000', 'image/9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `rating`, `image`) VALUES
(5, 'Pro Club', 20.00, 1.0, '2.jpg'),
(6, 'T-Shirt', 29.00, 3.5, '5.jpg'),
(7, 'Sando', 22.00, 3.0, '5.jpg'),
(9, 'short', 100.00, 2.0, '4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allproduct`
--
ALTER TABLE `allproduct`
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
-- AUTO_INCREMENT for table `allproduct`
--
ALTER TABLE `allproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
