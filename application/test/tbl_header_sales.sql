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
-- Table structure for table `tbl_header_sales`
--

CREATE TABLE `tbl_header_sales` (
  `sales_header_id` int(11) NOT NULL,
  `sales_faktur_id` varchar(250) NOT NULL,
  `sales_customer_id` int(11) NOT NULL,
  `sales_company_id` int(11) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_due_date` date NOT NULL,
  `sales_subtotal` int(11) NOT NULL,
  `sales_discount` int(11) NOT NULL,
  `sales_total` int(11) NOT NULL,
  `sales_sisa_pembayaran` int(11) NOT NULL,
  `sales_sales_name` varchar(250) NOT NULL,
  `sales_status` varchar(250) NOT NULL,
  `sales_desc` text NOT NULL,
  `sales_warehouse` varchar(250) NOT NULL,
  `sales_po` varchar(250) NOT NULL,
  `sales_terbilang` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_header_sales`
--

INSERT INTO `tbl_header_sales` (`sales_header_id`, `sales_faktur_id`, `sales_customer_id`, `sales_company_id`, `sales_date`, `sales_due_date`, `sales_subtotal`, `sales_discount`, `sales_total`, `sales_sisa_pembayaran`, `sales_sales_name`, `sales_status`, `sales_desc`, `sales_warehouse`, `sales_po`, `sales_terbilang`) VALUES
(1, 'S-023/1', 2, 0, '2022-07-01', '2022-07-04', 590000, 80000, 510000, 0, 'Rudis', 'lunas', '', '1', '2001/1231/B1', 'lima ratus sepuluh ribu'),
(2, 'S-023/2', 3, 0, '2022-07-01', '2022-07-01', 1000000, 0, 1000000, 1000000, 'Rudis', 'lunas', '', '1', '12341321', 'satu juta'),
(3, 'S-023/3', 2, 0, '2022-07-21', '2022-07-21', 100000, 0, 100000, 100000, 'Rudis', 'lunas', '', '1', '123123', 'seratus  ribu'),
(4, 'S-023/4', 2, 0, '2022-07-21', '2022-07-21', 100000, 0, 100000, 100000, 'Rudis', 'lunas', '', '1', '123123', 'seratus  ribu'),
(6, 'S-023/5', 2, 2, '2022-07-26', '2022-07-26', 400000, 0, 400000, 400000, 'Rudis', 'lunas', '', '1', '123123123', 'empat ratus  ribu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_header_sales`
--
ALTER TABLE `tbl_header_sales`
  ADD PRIMARY KEY (`sales_header_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_header_sales`
--
ALTER TABLE `tbl_header_sales`
  MODIFY `sales_header_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
