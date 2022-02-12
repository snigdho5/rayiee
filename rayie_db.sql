-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 18, 2022 at 12:20 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
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
-- Database: `rayie_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` int NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `category_id`, `name`, `rate`, `qty`) VALUES
(1, 3, 'Product1', 200, 3),
(2, 3, 'Product2', 100, 3),
(3, 2, 'Product3', 25, 9),
(5, 6, 'Product4', 100, 7),
(7, 3, 'Kranei', 100, 9),
(8, 3, 'Shimal', 20, 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `id` int NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`id`, `category`) VALUES
(2, 'New1'),
(3, 'New2'),
(4, 'New3'),
(5, 'New4'),
(6, 'New5'),
(7, 'New6'),
(8, 'New7'),
(9, 'New8'),
(10, 'New9'),
(11, 'New10'),
(12, 'New11'),
(13, 'New12'),
(14, 'New13'),
(15, 'New14'),
(16, 'New15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `id` int NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_qty` int NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `sgst_amount` decimal(10,2) NOT NULL,
  `cgst_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `cust_email` varchar(50) NOT NULL,
  `cust_mobile` varchar(10) NOT NULL,
  `cust_address` text NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_sale`
--

INSERT INTO `tbl_sale` (`id`, `invoice_no`, `total_qty`, `discount_amount`, `tax_amount`, `sgst_amount`, `cgst_amount`, `total_amount`, `cust_name`, `cust_email`, `cust_mobile`, `cust_address`, `created_by`, `created_at`) VALUES
(1, '#RayieOrder1', 5, '26.00', '554.00', '555.00', '555.00', '897.00', 'sadewqrwwer', 'dfsdfdsf@er.fi', '35345345', 'sdasda', 0, '2022-01-17 15:17:20'),
(2, '#RayieOrder2', 5, '32.50', '443.00', '76.00', '76.00', '666.00', 'Hitler Sams', 'arandh@did.is', '0932478272', 'sadj auiaosu ius doiaus ia', 7, '2022-01-17 18:43:58'),
(3, '#RayieOrder3', 6, '29.00', '744.00', '255.00', '266.00', '1063.00', 'dedededede', 'dede@de.de', '9989809807', 'hfdsfkjshdfjhdskh dsif hiuds hfdsiuf hiudsfh iusd', 7, '2022-01-18 05:23:07'),
(4, '#RayieOrder4', 1, '1.00', '94.00', '2.50', '2.50', '100.00', 'sadsdf', 'dsfsd@wew.ew', '0932809328', 'erew', 7, '2022-01-18 06:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_details`
--

CREATE TABLE `tbl_sale_details` (
  `id` int NOT NULL,
  `sale_id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(50) NOT NULL,
  `mrp` decimal(5,2) NOT NULL,
  `qty` int NOT NULL,
  `rate` decimal(5,2) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `taxable_amount` decimal(10,2) NOT NULL,
  `sgst_percent` decimal(5,2) NOT NULL,
  `sgst_amount` decimal(10,2) NOT NULL,
  `cgst_percent` decimal(5,2) NOT NULL,
  `cgst_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_sale_details`
--

INSERT INTO `tbl_sale_details` (`id`, `sale_id`, `product_id`, `size`, `mrp`, `qty`, `rate`, `discount_percent`, `discount_amount`, `taxable_amount`, `sgst_percent`, `sgst_amount`, `cgst_percent`, `cgst_amount`, `total_amount`, `created_by`, `created_at`) VALUES
(1, 1, 1, 'm', '200.00', 2, '400.00', '5.00', '20.00', '221.00', '3.00', '333.00', '2.00', '333.00', '555.00', 0, '2022-01-17 15:17:20'),
(2, 1, 2, 'm', '100.00', 3, '300.00', '2.00', '6.00', '333.00', '4.00', '222.00', '4.00', '222.00', '342.00', 0, '2022-01-17 15:17:20'),
(3, 2, 1, 'm', '200.00', 3, '600.00', '5.00', '30.00', '222.00', '2.50', '33.00', '2.50', '33.00', '323.00', 7, '2022-01-17 18:43:58'),
(4, 2, 3, 'XS', '25.00', 2, '50.00', '5.00', '2.50', '221.00', '2.50', '43.00', '2.50', '43.00', '343.00', 7, '2022-01-17 18:43:58'),
(5, 3, 1, 'XS', '200.00', 2, '400.00', '6.00', '24.00', '300.00', '2.50', '222.00', '2.50', '222.00', '500.00', 7, '2022-01-18 05:23:07'),
(6, 3, 3, 'S', '25.00', 4, '100.00', '5.00', '5.00', '444.00', '2.50', '33.00', '2.50', '44.00', '563.00', 7, '2022-01-18 05:23:07'),
(7, 4, 7, 'S', '100.00', 1, '100.00', '1.00', '1.00', '94.00', '2.50', '2.50', '2.50', '2.50', '100.00', 7, '2022-01-18 06:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_details_temp`
--

CREATE TABLE `tbl_sale_details_temp` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size` varchar(50) NOT NULL,
  `mrp` decimal(5,2) NOT NULL,
  `qty` int NOT NULL,
  `rate` decimal(5,2) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `taxable_amount` decimal(10,2) NOT NULL,
  `sgst_percent` decimal(5,2) NOT NULL,
  `sgst_amount` decimal(10,2) NOT NULL,
  `cgst_percent` decimal(5,2) NOT NULL,
  `cgst_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `password`, `active`) VALUES
(7, 'Nikita', 'nikita.wasnik@qtsolv.com', '12345678', '1'),
(8, 'Snigdho', 'sudo@gmail.com', '12345678', '1'),
(9, 'Admin', 'admin@gmail.com', '12345678', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sale_details`
--
ALTER TABLE `tbl_sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sale_details_temp`
--
ALTER TABLE `tbl_sale_details_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_sale_details`
--
ALTER TABLE `tbl_sale_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_sale_details_temp`
--
ALTER TABLE `tbl_sale_details_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
