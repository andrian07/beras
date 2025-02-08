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
-- Table structure for table `tbl_mastercompany`
--

CREATE TABLE `tbl_mastercompany` (
  `mastercompany_id` int(11) NOT NULL,
  `mastercompany_name` varchar(250) NOT NULL,
  `mastercompany_phone` varchar(250) NOT NULL,
  `mastercompany_email` varchar(250) NOT NULL,
  `mastercompany_status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = tidak aktif, 1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mastercompany`
--

INSERT INTO `tbl_mastercompany` (`mastercompany_id`, `mastercompany_name`, `mastercompany_phone`, `mastercompany_email`, `mastercompany_status`) VALUES
(1, 'CV. GANTARI MAKMUR', 'Jl. Adi Sucipto, Pergudangan Sakura Biz No. J7 & I7 / 0813 4716 3398 ', 'pdsuksemandiri@gmail.com', 1),
(2, 'CV. SUKSES MANDIRI', 'Jl. Adi Sucipto, Pergudangan Sakura Biz No. J7 & I7 / 0813 4716 3398', 'pdsuksemandiri@gmail.com', 1),
(3, 'PD. SUKSES MANDIRI', 'Jl. Adi Sucipto, Pergudangan Sakura Biz No. J7 & I7 / 0813 4716 3398', 'pdsuksemandiri@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_mastercompany`
--
ALTER TABLE `tbl_mastercompany`
  ADD PRIMARY KEY (`mastercompany_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_mastercompany`
--
ALTER TABLE `tbl_mastercompany`
  MODIFY `mastercompany_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
