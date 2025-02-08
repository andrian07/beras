-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 03:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beras`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_sales_cart`
--

CREATE TABLE `tbl_detail_sales_cart` (
  `sales_detail_cart_id` int(11) NOT NULL,
  `sales_detail_cart_faktur` varchar(250) NOT NULL,
  `sales_detail_cart_item` int(11) NOT NULL,
  `sales_detail_cart_price` int(11) NOT NULL,
  `sales_detail_cart_satuan` int(11) NOT NULL,
  `sales_detail_cart_customer` varchar(250) NOT NULL,
  `sales_detail_cart_company` varchar(250) NOT NULL,
  `sales_detail_cart_discount` int(11) NOT NULL,
  `sales_detail_cart_total` int(11) NOT NULL,
  `sales_detail_cart_admin` varchar(250) NOT NULL,
  `sales_warehouse_cart_admin` int(11) NOT NULL,
  `sales_description_cart` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_detail_sales_cart`
--
ALTER TABLE `tbl_detail_sales_cart`
  ADD PRIMARY KEY (`sales_detail_cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detail_sales_cart`
--
ALTER TABLE `tbl_detail_sales_cart`
  MODIFY `sales_detail_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
