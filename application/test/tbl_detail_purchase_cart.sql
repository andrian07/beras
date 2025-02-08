-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 03:47 PM
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
-- Table structure for table `tbl_detail_purchase_cart`
--

CREATE TABLE `tbl_detail_purchase_cart` (
  `purchase_detail_cart_id` int(11) NOT NULL,
  `purchase_detail_cart_faktur` varchar(250) NOT NULL,
  `purchase_detail_cart_item` int(11) NOT NULL,
  `purchase_detail_cart_suplier` varchar(250) NOT NULL,
  `purchase_detail_cart_company` int(11) NOT NULL,
  `purchase_detail_cart_price` int(11) NOT NULL,
  `purchase_detail_cart_satuan` int(11) NOT NULL,
  `purchase_detail_cart_discount` int(11) NOT NULL,
  `purchase_detail_cart_total` int(11) NOT NULL,
  `purchase_detail_cart_admin` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detail_purchase_cart`
--

INSERT INTO `tbl_detail_purchase_cart` (`purchase_detail_cart_id`, `purchase_detail_cart_faktur`, `purchase_detail_cart_item`, `purchase_detail_cart_suplier`, `purchase_detail_cart_company`, `purchase_detail_cart_price`, `purchase_detail_cart_satuan`, `purchase_detail_cart_discount`, `purchase_detail_cart_total`, `purchase_detail_cart_admin`) VALUES
(44, 'P-023/3', 5, 'Lancar Jaya / 1', 3, 50000, 10, 0, 500000, '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_detail_purchase_cart`
--
ALTER TABLE `tbl_detail_purchase_cart`
  ADD PRIMARY KEY (`purchase_detail_cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_detail_purchase_cart`
--
ALTER TABLE `tbl_detail_purchase_cart`
  MODIFY `purchase_detail_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
