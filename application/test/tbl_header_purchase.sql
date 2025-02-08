-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 03:46 PM
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
-- Table structure for table `tbl_header_purchase`
--

CREATE TABLE `tbl_header_purchase` (
  `purchase_header_id` int(11) NOT NULL,
  `purchase_faktur_id` varchar(250) NOT NULL,
  `purchase_suplier_id` int(11) NOT NULL,
  `purchase_company_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_due_date` date NOT NULL,
  `purchase_subtotal` int(11) NOT NULL,
  `purchase_discount` int(11) NOT NULL,
  `purchase_total` int(11) NOT NULL,
  `purchase_sisa_pembayaran` int(11) NOT NULL,
  `purchase_status` varchar(250) NOT NULL,
  `purchase_desc` text NOT NULL,
  `purchase_branch` varchar(250) NOT NULL,
  `purchase_bukti_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_header_purchase`
--

INSERT INTO `tbl_header_purchase` (`purchase_header_id`, `purchase_faktur_id`, `purchase_suplier_id`, `purchase_company_id`, `purchase_date`, `purchase_due_date`, `purchase_subtotal`, `purchase_discount`, `purchase_total`, `purchase_sisa_pembayaran`, `purchase_status`, `purchase_desc`, `purchase_branch`, `purchase_bukti_name`) VALUES
(9, 'P-023/1', 1, 0, '2022-07-01', '2022-07-04', 38800000, 800000, 38000000, 0, 'lunas', '', '', ''),
(18, 'P-023/2', 1, 2, '2022-07-25', '2022-07-25', 500000, 0, 500000, 500000, 'lunas', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_header_purchase`
--
ALTER TABLE `tbl_header_purchase`
  ADD PRIMARY KEY (`purchase_header_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_header_purchase`
--
ALTER TABLE `tbl_header_purchase`
  MODIFY `purchase_header_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
