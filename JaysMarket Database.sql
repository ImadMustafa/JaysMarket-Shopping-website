-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2025 at 08:58 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u471353624_ImadSites`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryname`) VALUES
(1, 'Electronics'),
(2, 'Tech'),
(3, 'Tools'),
(4, 'Clothes'),
(5, 'Automotive'),
(6, 'Home'),
(7, 'Office & School Supplies'),
(8, 'Makeup'),
(9, 'Satellite'),
(12, 'Phone Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `image_alt_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `product_id`, `image_url`, `image_alt_text`) VALUES
(82, 59, 'images/products/product59/IMG-66cf03adcd99d6.44817447.png', NULL),
(83, 59, 'images/products/product59/IMG-66cf03adcde241.14627602.png', NULL),
(84, 60, 'images/products/product60/IMG-66cf0510021845.30006214.jpg', NULL),
(85, 60, 'images/products/product60/IMG-66cf051003a244.62339649.png', NULL),
(86, 60, 'images/products/product60/IMG-66cf051003eaf0.49823303.png', NULL),
(87, 61, 'images/products/product61/IMG-66d181f5d04851.90977376.jpg', NULL),
(88, 61, 'images/products/product61/IMG-66d181f5d0d7d3.17442252.png', NULL),
(89, 62, 'images/products/product62/IMG-66d6dc33ecec32.28278348.png', NULL),
(90, 62, 'images/products/product62/IMG-66d6dc33ee3480.17714529.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `description` text NOT NULL,
  `imagemain` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `additional_images` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productname`, `price`, `categoryid`, `storeid`, `description`, `imagemain`, `quantity`, `additional_images`) VALUES
(92, 'BWOO charger 2.4A ', 4, 1, 10, 'input: 100/220v 50/60 hz 0.5A output: DC 5V=2.4A smart', 'images/products/product92/IMG-66f2d6739dffb5.58789458.jpg', 12, '[\"images\\/products\\/product92\\/IMG-66f2d6739e2a63.90871095.jpg\",\"images\\/products\\/product92\\/IMG-66f2d6739e3986.73279843.jpg\"]'),
(93, 'BWOO cable RGB color USB to lightning', 5, 1, 10, 'Model X277L l Output Port USB-A To Lightning | Output: 3A | Length: 1M', 'images/products/product93/IMG-66f2dacb498934.11894729.png', 12, '[\"images\\/products\\/product93\\/IMG-66f2dacb49e568.52765001.jpg\",\"images\\/products\\/product93\\/IMG-66f2dacb49f778.94898297.jpg\"]'),
(94, 'BWOO cable RGB color USB to type C', 5, 1, 10, 'Model X277L l Output Port USB-A To Type-C | Output: 3A | Length: 1M', 'images/products/product94/IMG-66f2dea0245616.81524864.png', 12, '[\"images\\/products\\/product94\\/IMG-66f2dea0249760.52208183.jpg\",\"images\\/products\\/product94\\/IMG-66f2dea024a544.14043082.jpg\"]'),
(99, 'BWOO Charging Adapter', 10, 1, 10, '40W Charging Adapter', 'images/products/product99/IMG-66f7f8d1d7e152.10142811.jpg', 10, '[\"images/products/product99/IMG-66f7f93db8ccb6.84361696.jpg\",\"images/products/product99/IMG-66f7f93db8e588.50849312.jpg\",\"images/products/product99/IMG-66f7f93db8f841.57441680.jpg\"]'),
(100, 'BWOO Magnetic Bracket', 10, 3, 10, 'To hold The Phone in the car', 'images/products/product100/IMG-66f7fcee2c1f21.51579436.jpg', 10, '[\"images/products/product100/IMG-66f7fcee2c4ad8.93078850.jpg\",\"images/products/product100/IMG-66f7fcee2c63c9.46444953.jpg\",\"images/products/product100/IMG-66f7fcee2c7327.77513991.jpg\"]'),
(101, 'BWOO Car Adapter', 7, 1, 10, 'Charges phone in car', 'images/products/product101/IMG-66f7fe938212b9.56365851.jpg', 10, '[\"images/products/product101/IMG-66f7fe93823b30.77550684.jpg\",\"images/products/product101/IMG-66f7fe93824ab3.47305582.jpg\"]'),
(103, 'BWOO Power Bank ', 25, 1, 10, 'Charges your phone Outside the house', 'images/products/product103/IMG-66f7ffefab6837.41165451.jpg', 10, '[\"images/products/product103/IMG-66f7ffefab9342.88931607.jpg\",\"images/products/product103/IMG-66f7ffefabb100.11770670.jpg\",\"images/products/product103/IMG-66f7ffefabc433.06196454.jpg\",\"images/products/product103/IMG-66f7ffefabd340.26177241.jpg\",\"images/products/product103/IMG-66f7ffefabe430.44330270.jpg\"]'),
(104, 'BWOO Headphones', 7, 1, 10, 'Type C/ 1.2m', 'images/products/product104/IMG-66f803cdbac421.42961926.jpg', 10, '[\"images/products/product104/IMG-66f803cdbaefb3.73888884.jpg\",\"images/products/product104/IMG-66f803cdbafed3.92804850.jpg\",\"images/products/product104/IMG-66f803cdbb0cb4.45939069.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `storename` varchar(50) NOT NULL,
  `phonenumber` int(8) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `storename`, `phonenumber`, `email`, `location`) VALUES
(10, 'Jays', 3701403, 'jihadmostafa4@gmail.com', 'Moharram Street');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `img` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `img`, `admin`) VALUES
(1, 'Admin', 'jihadmostafa4@gmail.com', 'J3h4dBl00dyC00l', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `idx_product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `storeid` (`storeid`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`storeid`) REFERENCES `stores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
