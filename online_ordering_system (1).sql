-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 03:14 PM
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
-- Database: `online_ordering_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `order_id`, `name`, `quantity`, `price`) VALUES
(457, 2, 'Tinola', 3, 45),
(458, 2, 'Adobo', 3, 35),
(460, 0, 'Adobo', 1, 35),
(461, 2, 'Adobo', 1, 35),
(463, 0, 'Adobo', 1, 35),
(464, 0, 'Adobo', 1, 35),
(470, 4, 'Adobo', 1, 35),
(471, 4, 'Tinola', 2, 45),
(472, 5, 'Cordon bleu', 1, 80),
(473, 5, 'Bulalo', 1, 100),
(474, 7, 'Adobo', 1, 35),
(475, 7, 'Kare-Kare', 2, 80),
(476, 7, 'Tinola', 1, 45),
(477, 8, 'Adobo', 3, 35),
(480, 9, 'Tinola', 1, 45),
(482, 10, 'Tinola', 1, 45),
(483, 11, 'Sinigang', 1, 70),
(484, 11, 'Kare-Kare', 5, 80),
(485, 11, 'Cordon bleu', 2, 80),
(486, 13, 'Adobo', 1, 35),
(487, 13, 'Adobo', 1, 35),
(488, 13, 'Adobo', 1, 35),
(489, 14, 'Tinola', 1, 45),
(491, 14, 'Cordon bleu', 1, 80),
(492, 14, 'Cordon bleu', 1, 80),
(494, 15, 'Bulalo', 1, 100),
(495, 18, 'Adobo', 1, 35),
(496, 18, 'Sinigang', 1, 70),
(497, 19, 'Adobo', 1, 35),
(498, 19, 'Bulalo', 1, 100),
(500, 20, 'Bulalo', 1, 100),
(502, 21, 'Bulalo', 1, 100),
(504, 22, 'Tinola', 1, 45),
(505, 25, 'Sinanglaw', 1, 75),
(506, 25, 'Tinola', 1, 45),
(507, 27, 'Adobo', 1, 35),
(508, 28, 'Bulalo', 1, 100),
(509, 29, 'Dinengdeng', 1, 65),
(510, 29, 'Tinola', 5, 45);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `imagelink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `name`, `price`, `imagelink`) VALUES
(32, 'Bulalo', 100, '/img/bulalo.jpg'),
(42, 'Adobo', 35, '/img/adobo.jpg'),
(57, 'Tinola', 45, '/img/tinola.jpg'),
(58, 'Cordon bleu', 80, '/img/cordonbleu.jpg'),
(59, 'Sinigang', 70, '/img/sinigang.jpg'),
(60, 'Kare-Kare', 80, '/img/karekare.jpg'),
(64, 'Sinanglaw', 75, '/img/sinanglaw.png'),
(65, 'Dinengdeng', 65, '/img/dinengdeng.jpg'),
(66, 'Igado', 55, '/img/igado.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `deliverymode` varchar(255) NOT NULL,
  `contact_num` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `totalamount` int(11) NOT NULL,
  `paymentmethod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `first_name`, `last_name`, `deliverymode`, `contact_num`, `address`, `totalamount`, `paymentmethod`) VALUES
(1, 83, '', '', 'Yoo', 0, '', 0, ''),
(2, 67, '', '', 'Delivery', 0, '', 0, ''),
(8, 1, 'Claricel', 'Vergara', '', 84754938, 'Bagac', 105, ''),
(9, 1, 'jello', 'vergz', '', 3949274, 'pangasinan', 45, ''),
(10, 1, 'Claricel', 'as', 'Delivery Vehicle', 643532, 'ewt', 45, 'credit'),
(11, 1, 'Selda', 'Mahabags', 'Bike', 9342748, 'Balangas', 630, 'cod'),
(21, 1, 'Kathryn', 'Bernardo', 'Delivery Vehicle', 2147483647, 'Manila', 100, 'cod'),
(22, 1, 'Kathryn', 'Bernardo', 'Bike', 2147483647, 'Llaollao', 45, 'gcash'),
(25, 1, 'Jello', 'Vergara', 'Bike', 2147483647, 'Hahaha', 120, 'cod'),
(27, 2, 'Kathryn', 'Bernardo', 'Delivery Vehicle', 829347282, 'Yey', 35, 'gcash'),
(28, 2, 'Claricel', 'eheh', 'Delivery Vehicle', 2147483647, 'Manila', 100, 'credit'),
(29, 1, 'Claricel', 'vergs', 'Bike', 2147483647, 'Bagac', 290, 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'sample123', 'sample123'),
(2, 'user123', 'user123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
