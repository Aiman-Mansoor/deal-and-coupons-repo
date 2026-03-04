-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2022 at 10:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `couponnsales_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@cns.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `billing_information`
--

CREATE TABLE `billing_information` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_information`
--

INSERT INTO `billing_information` (`id`, `customer_id`, `address`, `city`, `country`, `state`, `zipcode`, `created_at`) VALUES
(4, 2, 'Mirpur Azad Kashmir', 'Mirpur', 'Pakistan', 'Pakistan — Azad Kashmir', '10250', '2022-07-28 19:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `qty`, `created_at`) VALUES
(33, 2, 22, 1, '2022-08-26 00:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `picture`, `created_at`) VALUES
(20, 'Electronic Devices', 'images/categories/STSCI_1629048286.jfif', '2022-06-13 06:47:10'),
(21, 'Electronic Accessories', 'images/categories/STSCI_1629048369.png', '2022-06-13 06:47:15'),
(22, 'TV & Home Appliances', 'images/categories/STSCI_1629048440.jfif', '2022-06-13 06:47:19'),
(23, 'Health & Beauty', 'images/categories/STSCI_1629048586.jpg', '2022-06-13 06:47:23'),
(24, 'Babies & Toys', 'images/categories/STSCI_1629048662.png', '2022-06-13 06:47:27'),
(25, 'Groceries & Pets', 'images/categories/STSCI_1629048796.jfif', '2022-06-13 06:47:33'),
(26, 'Home & Lifestyle', 'images/categories/STSCI_1629048994.jfif', '2022-06-13 06:47:37'),
(27, 'Women\'s Fashion', 'images/categories/STSCI_1629049078.jpg', '2022-06-13 06:47:42'),
(28, 'Men\'s Fashion', 'images/categories/STSCI_1629049230.png', '2022-06-13 06:47:46'),
(29, 'Watches, Bags & Jewelery', 'images/categories/STSCI_1629049289.png', '2022-06-13 06:47:51'),
(30, 'Sports & Outdoor', 'images/categories/STSCI_1629049322.png', '2022-06-13 06:47:56'),
(31, 'Automotive & Motorbike', 'images/categories/STSCI_1629049366.jfif', '2022-06-13 06:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `amount_to_apply` decimal(18,2) NOT NULL,
  `off` decimal(18,2) NOT NULL,
  `code` varchar(255) NOT NULL,
  `no_of_persons` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `picture`, `amount_to_apply`, `off`, `code`, `no_of_persons`, `created_at`) VALUES
(1, 'Save 5% Cash', 'images/coupon.png', '2000.00', '5.00', 'CAS5', 5036, '2022-06-11 07:24:51'),
(2, 'Save 15% Cash', 'images/coupon.png', '3000.00', '15.00', 'CAS15', 50, '2022-06-11 07:24:51'),
(3, 'Save 10% Cash', 'images/coupon.png', '2500.00', '10.00', 'CAS10', 67, '2022-06-11 07:24:51'),
(5, 'Save 12% Cash', 'images/coupons/depositphotos_33303707-stock-photo-construction-mason-worker-bricklayer.jpg', '2400.00', '12.00', 'CAS12', 39, '2022-06-13 09:08:48'),
(6, 'Great Deal Save 5%', 'images/coupons/pharmacy.jpg', '900.00', '5.00', 'GreatDeal5', 14, '2022-07-28 19:40:38'),
(8, 'Save 50% Off', 'images/coupons/pexels-element-digital-712323.jpg', '5000.00', '50.00', 'SAVE50', 400, '2022-08-27 19:49:15'),
(9, 'Save 25% Off', 'images/coupons/pexels-element-digital-712323.jpg', '2500.00', '25.00', 'SAVE25', 400, '2022-08-27 19:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'images/dummy.png',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`, `phone`, `profile_picture`, `status`, `created_at`) VALUES
(2, 'Umer Rajput', 'umer@mailinator.com', '$2y$10$fNrkRlSsEOn2fOUSrjMkduohiMIYB8s69MnhGou/FTUDIDfoB2akK', '03415304550', 'images/customers/03.jpg', 1, '2022-06-08 10:27:56'),
(3, 'Ali Rajput', 'ali@mailinator.com', '$2y$10$8IjrAz8EVfLihcMt7VpyYuAYzZE0uKQQTBozTp/L8vCnlXDhdORDu', '03414323344', 'images/customers/pexels-luis-quintero-2257704.jpg', 1, '2022-07-27 05:06:41'),
(4, 'Sheroz Khan', 'sheroz@mailinator.com', '$2y$10$yYYGtmNFHtwVfY7vjckW0uWkZuVKiomF/ehLn7kiQzhQez4r6e3.i', '03112234323', 'images/dummy.png', 1, '2022-07-27 05:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `category_id`, `seller_id`, `name`, `picture`, `price`, `created_at`) VALUES
(1, 20, 3, 'New Box Deals', 'images/deals/razor.jpg', 500, '2022-07-20 10:33:20'),
(3, 21, 3, 'Summer Deal', 'images/deals/m2.PNG', 1500, '2022-07-21 07:34:03'),
(4, 22, 3, 'Summer New Deal', 'images/deals/m1.PNG', 2000, '2022-07-21 07:35:02'),
(5, 21, 5, 'Electric Deal', 'images/deals/responsive-web-design-bootstrap-front-end-web-development-logo-png-favpng-jkJHVpwdzQd5Q5XXXkL0Q5S3Q.jpg', 500, '2022-07-28 19:35:27'),
(6, 20, 3, 'New Box Deals', 'images/deals/razor.jpg', 500, '2022-07-20 10:33:20'),
(7, 21, 3, 'Summer Deal', 'images/deals/m2.PNG', 1500, '2022-07-21 07:34:03'),
(8, 22, 3, 'Summer New Deal', 'images/deals/m1.PNG', 2000, '2022-07-21 07:35:02'),
(9, 21, 5, 'Electric Deal', 'images/deals/responsive-web-design-bootstrap-front-end-web-development-logo-png-favpng-jkJHVpwdzQd5Q5XXXkL0Q5S3Q.jpg', 500, '2022-07-28 19:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `deals_booked`
--

CREATE TABLE `deals_booked` (
  `id` int(255) NOT NULL,
  `deal_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `shippingrate` decimal(18,2) NOT NULL,
  `booking_date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deals_booked`
--

INSERT INTO `deals_booked` (`id`, `deal_id`, `seller_id`, `customer_id`, `price`, `shippingrate`, `booking_date`, `status`) VALUES
(3, 1, 3, 2, 500, '0.00', '2022-07-21', 'Delivered'),
(4, 1, 3, 2, 500, '0.00', '2022-07-21', 'Delivered'),
(5, 1, 3, 2, 500, '0.00', '2022-07-21', 'Processing'),
(6, 3, 3, 2, 1500, '0.00', '2022-07-29', 'Processing'),
(7, 3, 3, 2, 1500, '0.00', '2022-07-29', 'Processing'),
(8, 3, 3, 2, 1500, '0.00', '2022-07-29', 'Processing'),
(9, 3, 3, 2, 1500, '0.00', '2022-07-29', 'Processing'),
(10, 3, 3, 2, 1500, '0.00', '2022-07-29', 'Processing'),
(11, 1, 3, 2, 500, '120.00', '2022-08-01', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `deal_products`
--

CREATE TABLE `deal_products` (
  `id` int(255) NOT NULL,
  `deal_id` int(255) NOT NULL,
  `seller_Id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deal_products`
--

INSERT INTO `deal_products` (`id`, `deal_id`, `seller_Id`, `product_id`, `created_at`) VALUES
(11, 1, 3, 20, '2022-07-21 07:34:33'),
(12, 1, 3, 21, '2022-07-21 07:34:35'),
(13, 3, 3, 22, '2022-07-21 07:34:42'),
(14, 3, 3, 23, '2022-07-21 07:34:47'),
(15, 4, 3, 24, '2022-07-21 07:35:09'),
(16, 4, 3, 25, '2022-07-21 07:35:11'),
(17, 5, 5, 28, '2022-07-28 19:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `tracking_number` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `original_price` decimal(18,2) NOT NULL,
  `off` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `shipping_price` decimal(18,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_amount` decimal(18,2) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Processing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_number`, `seller_id`, `customer_id`, `product_id`, `original_price`, `off`, `qty`, `shipping_price`, `coupon_code`, `coupon_amount`, `address`, `city`, `country`, `state`, `zipcode`, `customer_name`, `customer_email`, `customer_phone`, `order_date`, `status`, `created_at`) VALUES
(30, 1001, 3, 2, 22, '12000.00', 25, 1, '120.00', 'CAS5', '450.00', 'Mirpur Azad Kashmir', 'Mirpur', 'Pakistan', 'Pakistan — Azad Kashmir', '10250', 'Umer Rajput', 'umer@mailinator.com', '03415304550', '2022-08-27', 'Processing', '2022-08-27 20:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `off` int(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `is_display` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `category_id`, `name`, `picture`, `price`, `off`, `qty`, `tags`, `description`, `is_display`, `created_at`) VALUES
(20, 3, 28, 'Nike Shoes12', 'images/products/01.jpg', '2500.00', 10, 495, 'nike,shoes,as', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.\r\n\r\nDonec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.12', 1, '2022-08-16 22:37:48'),
(21, 3, 28, 'Rayban Glasses', 'images/products/03.jpg', '1500.00', 15, 200, 'rayban,glasses', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.\r\n\r\nDonec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', 1, '2022-08-16 22:35:12'),
(22, 3, 20, 'Nikon Camera', 'images/products/04.jpg', '12000.00', 25, 95, 'nikon,camera', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.\r\n\r\nDonec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', 1, '2022-08-27 20:24:35'),
(23, 3, 29, 'Vinta Army Bagpack', 'images/products/05.jpg', '1200.00', 0, 250, 'army,bag,vinta', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.\r\n\r\nDonec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', 1, '2022-08-16 22:35:12'),
(24, 3, 28, 'Mens latest green Shoes', 'images/products/06.jpg', '1800.00', 35, 230, 'shoes,green shoes,green,mens', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.\r\n\r\nDonec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', 1, '2022-08-16 22:35:12'),
(25, 3, 29, 'Apple Watch White', 'images/products/09.jpg', '25000.00', 18, 340, 'apple,watch,apple watch,white watch', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.\r\n\r\nDonec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', 1, '2022-08-16 22:35:12'),
(28, 5, 20, 'HP Omen Laptop', 'images/products/HPOmen15-dh__1_.jpg', '12000.00', 0, 500, 'laptop', 'lorem ipsum dolar text is a dummy text.', 1, '2022-08-14 06:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_galleries`
--

INSERT INTO `product_galleries` (`id`, `product_id`, `image`, `created_at`) VALUES
(18, 20, 'images/products/gallery/01.jpg', '2022-06-09 06:04:05'),
(19, 21, 'images/products/gallery/03.jpg', '2022-06-09 06:04:45'),
(20, 22, 'images/products/gallery/04.jpg', '2022-06-09 06:05:13'),
(21, 23, 'images/products/gallery/05.jpg', '2022-06-09 06:06:04'),
(22, 24, 'images/products/gallery/06.jpg', '2022-06-09 06:06:45'),
(23, 25, 'images/products/gallery/09.jpg', '2022-06-09 06:07:26'),
(26, 20, 'images/products/gallery/04.jpg', '2022-06-09 09:42:29'),
(27, 20, 'images/products/gallery/05.jpg', '2022-06-09 09:42:29'),
(28, 20, 'images/products/gallery/06.jpg', '2022-06-09 09:42:29'),
(29, 20, 'images/products/gallery/07.jpg', '2022-06-09 09:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `review_description` text NOT NULL,
  `rating` decimal(18,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `seller_id`, `customer_id`, `product_id`, `review_description`, `rating`, `created_at`) VALUES
(11, 3, 2, 25, 'Great product', '5.00', '2022-08-14 06:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `storename` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `shippingrate` decimal(18,2) NOT NULL,
  `about` longtext NOT NULL,
  `status` tinytext NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `email`, `password`, `storename`, `phone_number`, `profile_picture`, `company_address`, `shippingrate`, `about`, `status`, `created_at`) VALUES
(3, 'umer@mailinator.com', '$2y$10$gY6w6E0wmpz08nO6gGGKI.0kZtMUezig8LoXb1StDNAO/.2EvpCti', 'Code Creatives', '03415304550', 'images/sellers/01.jpg', 'Mirpur Azad Kashmir', '120.00', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.\r\n\r\nDonec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.', '1', '2022-08-16 22:35:12'),
(4, 'ali@mailinator.com', '$2y$10$ZSDNQG90sVnFtzxXbCe4Au596gG0tJA7Z.3YLQtMx562ut4EulHTO', 'Ali General Store', '03441234433', 'images/sellers/pexels-luis-quintero-2257704.jpg', 'Mirpur', '20.00', 'we are a store with all kind of products.', '1', '2022-07-27 05:09:19'),
(5, 'new@mailinator.com', '$2y$10$gY6w6E0wmpz08nO6gGGKI.0kZtMUezig8LoXb1StDNAO/.2EvpCti', 'New Shop', '03415304550', 'images/sellers/Kim and Dexter-3078.jpg', 'Mirpur Azad Kashmir', '20.00', 'we are an online shop.', '1', '2022-07-28 19:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `customer_id`, `product_id`, `created_at`) VALUES
(12, 2, 22, '2022-07-19 12:27:27'),
(13, 2, 28, '2022-07-28 19:25:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_information`
--
ALTER TABLE `billing_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `deals_booked`
--
ALTER TABLE `deals_booked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_id` (`deal_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `deal_products`
--
ALTER TABLE `deal_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deal_id` (`deal_id`),
  ADD KEY `seller_Id` (`seller_Id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tracking_number` (`tracking_number`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_information`
--
ALTER TABLE `billing_information`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `deals_booked`
--
ALTER TABLE `deals_booked`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `deal_products`
--
ALTER TABLE `deal_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
