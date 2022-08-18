-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2022 at 04:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `sku` varchar(8) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL,
  `price` varchar(10) NOT NULL,
  `size` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `product_name`, `type`, `price`, `size`, `weight`, `height`, `width`, `length`, `created_at`) VALUES
(1, 'bo1234', 'Vivian Hines', 'book', '87000', NULL, 24, NULL, NULL, NULL, '2022-08-18 13:17:35'),
(2, 'ANQQxb', 'test sample', 'book', '7000', NULL, 30, NULL, NULL, NULL, '2022-08-18 13:41:31'),
(6, '1v5tf', 'Amela Trevino', 'dvd/cd', '237', 566, NULL, NULL, NULL, NULL, '2022-08-18 15:41:28'),
(7, 'In hic', 'Adele Hawkins', 'furniture', '273', NULL, 0, 3, 5, 7, '2022-08-18 15:44:22'),
(8, 'Pariat', 'Mikayla Rodgers', 'dvd/cd', '22', 128, NULL, NULL, NULL, NULL, '2022-08-18 15:45:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
