-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2023 at 01:26 PM
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
-- Database: `pharmacyapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(3, 'MDDF52'),
(73, '  sf120'),
(77, 'sxs'),
(81, ' s210'),
(82, 'newBox');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(200) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `wholesaleUnitId` int(11) NOT NULL,
  `hasChildUnit` tinyint(1) NOT NULL DEFAULT 0,
  `RetailUnitId` int(11) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` date NOT NULL,
  `details` varchar(300) NOT NULL,
  `image` varchar(200) NOT NULL,
  `barcode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `categoryId`, `wholesaleUnitId`, `hasChildUnit`, `RetailUnitId`, `userId`, `addedDate`, `details`, `image`, `barcode`) VALUES
(14, 'MCTY', 3, 3, 1, 4, 3, '2023-10-10', ';lsdfk;ls sld fasd;fja;sdfj', '1696944150.jpg', '65255015b54dc'),
(15, 'LL15', 3, 3, 1, 4, 3, '2023-10-10', 'All rights reserved.', '1696960620.jpg', '6525906b8fa5c'),
(16, 'DCCDD', 3, 5, 0, 0, 3, '2023-10-10', 'All rights reserved.', '1696960620.jpg', '6525906b8fa5c'),
(17, 'MAD', 82, 5, 1, 4, 3, '2023-10-14', 'details details details', '1697315929.jpg', 'LKLK5454'),
(18, 'GDDD 123', 73, 5, 0, 0, 3, '2023-10-14', 'DDD', '1697315983.jpg', 'LKLK5454');

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetails`
--

CREATE TABLE `purchasedetails` (
  `purchaseDetailId` int(11) NOT NULL,
  `purchaseId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `wholesaleUnitId` int(11) NOT NULL,
  `WholesaleQty` int(11) NOT NULL,
  `WholesalePayPrice` float NOT NULL,
  `WholesaleSalePrice` float NOT NULL,
  `hasChildUnit` tinyint(1) NOT NULL DEFAULT 0,
  `RetailUnitId` int(11) DEFAULT NULL,
  `RetailQty` int(11) DEFAULT NULL,
  `RetailSalePrice` float DEFAULT NULL,
  `RetailPayPrice` float DEFAULT NULL,
  `TotalRetailQty` int(11) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `endDate` date NOT NULL,
  `batchNumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`purchaseDetailId`, `purchaseId`, `productId`, `wholesaleUnitId`, `WholesaleQty`, `WholesalePayPrice`, `WholesaleSalePrice`, `hasChildUnit`, `RetailUnitId`, `RetailQty`, `RetailSalePrice`, `RetailPayPrice`, `TotalRetailQty`, `userId`, `endDate`, `batchNumber`) VALUES
(53, 1, 14, 3, 20, 200, 30000, 0, 0, 0, 0, 0, 0, 3, '2023-10-04', '455dfs'),
(58, 2, 14, 3, 3, 200, 4, 0, 0, 0, 0, 0, 0, 3, '2023-10-03', 'sdksld5545'),
(59, 1, 16, 3, 44, 200, 55, 0, 4, 0, 0, 0, 0, 3, '2023-10-09', '455dfs');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchaseId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `addedDate` date NOT NULL,
  `details` varchar(300) DEFAULT NULL,
  `invoiceNumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchaseId`, `userId`, `supplierId`, `addedDate`, `details`, `invoiceNumber`) VALUES
(1, 3, 3, '2023-10-11', 'Manar id ', 'CH120MDF'),
(2, 3, 3, '2023-10-11', '', '652696b2da519');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierId` int(11) NOT NULL,
  `supplierName` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierId`, `supplierName`, `address`, `phone`) VALUES
(3, 'manar Ali Omer', 'alh', '09993199955555555'),
(4, 'manar 120', 'sadss', '09993199955555555');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitId` int(11) NOT NULL,
  `unitName` varchar(100) NOT NULL,
  `isMaster` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitId`, `unitName`, `isMaster`) VALUES
(3, 'old', 1),
(4, 'new', 0),
(5, 'box', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `userType` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `password`, `email`, `userType`) VALUES
(1, 'manar Ali Omer', '58b64460faadcca8406bcc6dc97320d0', 'manar@manar.sd', 2),
(2, 'manar', 'f4cc399f0effd13c888e310ea2cf5399', 'manar@manar.com', 1),
(3, 'Ali', '202cb962ac59075b964b07152d234b70', 'ali@ali', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  ADD PRIMARY KEY (`purchaseDetailId`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchaseId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  MODIFY `purchaseDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
