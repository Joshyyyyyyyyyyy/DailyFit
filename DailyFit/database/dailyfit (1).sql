-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 04:07 PM
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
  `category` varchar(100) DEFAULT NULL,
  `color1` varchar(7) DEFAULT NULL,
  `color2` varchar(7) DEFAULT NULL,
  `color3` varchar(7) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allproduct`
--

INSERT INTO `allproduct` (`id`, `title`, `price`, `badge`, `description`, `category`, `color1`, `color2`, `color3`, `image`) VALUES
(1, 'shirt', 20.00, 'sale', 'hahahtfdi7fgihobvdrhjkhjvc5ev rctghuiokp,mkhjrzxtcyghnkjnbtyfghj', 'T-shirt', '#ff0000', '#0022cc', '#4d0000', 'image/5.jpg'),
(2, 'SHORT', 20.00, 'sale', 'SHORT', 'Shorts', '#ffffff', '#000000', '#ffee38', 'image/4.jpg'),
(3, 'STUSSY', 20.00, 'New', 'New Brand', 'T-shirt', '#000000', '#000000', '#000000', 'image/5.jpg'),
(4, 'Limited Edition Shirt', 1000.00, 'New', 'Limited Edition', 'T-shirt', '#000000', '#000000', '#000000', 'image/6.jpg'),
(5, 'Limited Edition Shirt', 1000.00, 'New', 'Limited Edition', 'T-shirt', '#000000', '#000000', '#000000', 'image/7.jpg'),
(6, 'Limited Edition', 1000.00, 'New', 'Limited Edition', 'T-shirt', '#000000', '#000000', '#000000', 'image/8.jpg'),
(7, 'Limited Edition', 1000.00, 'New', 'Limited Edition', 'T-shirt', '#000000', '#000000', '#000000', 'image/9.jpg'),
(8, 'SHORT', 1000.00, 'New', 'WHAHHAHAHHAHAHHA', 'Shorts', '#95416e', '#e147c0', '#f07070', 'image/11.jpg'),
(11, 'short', 540.00, 'New', 'HAHAAHAHAAHA', 'Shorts', '#000000', '#000000', '#000000', 'image/13.jpg'),
(12, 'Shirt', 530.00, '', 'hhahdfdhkynbm, ', 'T-shirt', '#000000', '#000000', '#000000', 'image/10.jpg'),
(13, 'short', 530.00, '', 'dsfsdkjfcbslonflas', 'Shorts', '#000000', '#000000', '#000000', 'image/4.jpg'),
(14, 'short', 450.00, '', 'ldsnosd;vnsnvs;fdsfd', 'Shorts', '#000000', '#000000', '#000000', 'image/14.jpg'),
(15, 'short', 450.00, '', 'dasfoasofndsosinvn', 'Shorts', '#000000', '#000000', '#000000', 'image/21.jpg'),
(16, 'SHIRT', 420.00, 'Hot', 'fasfsajfnasovna', 'T-shirt', '#000000', '#000000', '#000000', 'image/15.jpg'),
(17, 'shirt', 540.00, 'New', 'dnsaofnaonanovuaienf', 'T-shirt', '#000000', '#000000', '#000000', 'image/16.jpg'),
(18, 'shirt', 540.00, 'Sale', 'noasndasofnavpaspdasf', 'T-shirt', '#000000', '#000000', '#000000', 'image/17.jpg'),
(19, 'shirt', 540.00, 'New', 'kjvdsjfsdlfndspfdp;sffds;pnf', 'T-shirt', '#000000', '#000000', '#000000', 'image/18.jpg'),
(20, 'shirt', 450.00, 'New', 'xbxcbdfhdn dfvdgvfd', 'T-shirt', '#000000', '#000000', '#000000', 'image/19.jpg'),
(21, 'shirt', 540.00, 'New', 'ndsfsdgsdgsdgs', 'T-shirt', '#000000', '#000000', '#000000', 'image/20.jpg'),
(22, 'Shirt', 560.00, 'New', 'dmasfpsdfmkdspdgfewmrfewfwe', 'T-shirt', '#000000', '#000000', '#000000', 'image/2.jpg'),
(23, 'Shirt', 560.00, 'New', 'vsvsvdsvdsvdsvsdv', 'T-shirt', '#000000', '#000000', '#000000', 'image/10.jpg'),
(24, 'Shirt', 560.00, 'New', ' vcxlvn cxlk oslvds lvlcx', 'T-shirt', '#000000', '#000000', '#000000', 'image/16.jpg'),
(25, 'Shirt', 560.00, 'New', 'fondsvnsvnsonivds v', 'T-shirt', '#000000', '#000000', '#000000', 'image/15.jpg'),
(26, 'CHROME HEART', 560.00, 'New', 'CHROME HEART BAPS LIMITED STOCK ONLY ', 'T-shirt', '#000000', '#000000', '#000000', 'image/2.jpg');

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
(5, 'LIMITED SHIRTS', 1000.00, 5.0, '6.jpg'),
(6, 'LIMITED SHIRT	', 1000.00, 5.0, '7.jpg'),
(7, 'LIMITED SHIRT	', 1000.00, 5.0, '8.jpg'),
(19, 'LIMITED SHIRTsasa', 1000.00, 5.0, '6.jpg'),
(20, '', 560.00, 0.0, '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'default.jpg',
  `user_role` enum('user','admin') DEFAULT 'user',
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `company`, `profile_image`, `user_role`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'Joshua', 'Suruiz', 'admin@gmail.com', '$2y$10$5YbMAsqq3HyTA06g4V7lP.afhSzNEfF.5Tze9.lqPAoo/673NbEO6', '09090900900', 'DailyFit', 'default.jpg', 'user', 1, '2025-04-26 03:16:16', '2025-04-21 07:10:35', '2025-04-25 19:16:16'),
(4, 'Joshua', 'Suruiz', 'suruizandrie@gmail.com', '$2y$10$H90IjJrsoeNKgFyQQnOG/.jOsaM6sG/JOA6rn4HwdomLOCDjnW0Ti', '09103840798', 'Daily Fit', 'default.jpg', 'user', 1, '2025-04-26 07:54:06', '2025-04-21 11:29:07', '2025-04-25 23:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(1, 1, '411f2d267c4366279f340d9912e75d27341151738e407ce2a652ce132ab53bce', '2025-05-21 07:11:18', '2025-04-21 07:11:18'),
(2, 1, 'd741aafa608449bcaea9166914e214fd98d9781a64d94a26d5c9556e2f7fa7e1', '2025-05-21 07:12:21', '2025-04-21 07:12:21'),
(3, 1, '91cdc678c45de57872b9d3eded78d6873fea681052f7a344878a991531210ed9', '2025-05-21 07:12:29', '2025-04-21 07:12:29'),
(4, 1, '73fe716415065c0acb398781dc0a60e8376d7e16964974df711920fe8ad85a88', '2025-05-21 07:12:39', '2025-04-21 07:12:39'),
(5, 1, '3b3d1a2c8865c17f9c5e4643a4a50ff1a5caf0d08532018049cc08cb0e4ad86b', '2025-05-21 07:14:49', '2025-04-21 07:14:49'),
(6, 1, 'bc4e995de2841969957245f7af60131bc02978bdee3c753e354e56ec63af53be', '2025-05-21 07:15:24', '2025-04-21 07:15:24'),
(7, 1, '08b4acc3dbb167ae0dd63887267aaa263c14fc32a85abe17bd7010bde4b96039', '2025-05-21 07:19:17', '2025-04-21 07:19:17'),
(8, 1, '80864d9b57dfb437b3a20fa704c267767660a1154a18fc5418db039149667364', '2025-05-21 07:20:52', '2025-04-21 07:20:52'),
(9, 1, 'bd62cf6d9f7ecf23282a4d816e7d6e3a6435c4e3853a36e41aeaf07eace28280', '2025-05-21 07:22:51', '2025-04-21 07:22:51'),
(10, 1, 'd76c41e50c9e0e3663798e0dccd1cf65adfe99a018d405515edca9887901fdd7', '2025-05-21 07:22:54', '2025-04-21 07:22:54'),
(11, 1, 'c4e1ec44471eda3ec999dc66f95c6c31444d3c1982cfcd1c676e6a632af8bbb5', '2025-05-21 07:23:07', '2025-04-21 07:23:07'),
(13, 4, '1f7351e5e65555dcb7815d6c72dcfd0d47f5a443f11d114b04345af491d4d1b7', '2025-05-21 11:29:29', '2025-04-21 11:29:29');

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allproduct`
--
ALTER TABLE `allproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
