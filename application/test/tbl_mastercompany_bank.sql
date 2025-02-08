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
-- Table structure for table `tbl_mastercompany_bank`
--

CREATE TABLE `tbl_mastercompany_bank` (
  `mastercompany_bank_id` int(11) NOT NULL,
  `mastercompany_id` int(11) NOT NULL,
  `mastercompany_bank_name` varchar(250) NOT NULL,
  `mastercompany_bank_rek` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mastercompany_bank`
--

INSERT INTO `tbl_mastercompany_bank` (`mastercompany_bank_id`, `mastercompany_id`, `mastercompany_bank_name`, `mastercompany_bank_rek`) VALUES
(1, 1, 'BANK BCA', '77130188885'),
(2, 2, 'BANK BCA', '5125019118'),
(3, 3, 'BANK KALBAR', '1521098267');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_mastercompany_bank`
--
ALTER TABLE `tbl_mastercompany_bank`
  ADD PRIMARY KEY (`mastercompany_bank_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_mastercompany_bank`
--
ALTER TABLE `tbl_mastercompany_bank`
  MODIFY `mastercompany_bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
