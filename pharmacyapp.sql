-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 01:18 PM
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
-- Table structure for table `accounting`
--

CREATE TABLE `accounting` (
  `accountId` int(11) NOT NULL,
  `AccountName` varchar(200) NOT NULL,
  `debit` decimal(10,2) DEFAULT NULL,
  `credit` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`accountId`, `AccountName`, `debit`, `credit`) VALUES
(1, 'Account Purchase cost', '1430.00', NULL),
(10, 'Account pay for suppliers', '200.00', NULL),
(21, 'Account Return Purchase', NULL, '4100.00');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `batchId` int(11) NOT NULL,
  `batchNumber` varchar(200) NOT NULL,
  `productid` int(11) NOT NULL,
  `expirationDate` date NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batchId`, `batchNumber`, `productid`, `expirationDate`, `qty`) VALUES
(82, '652fd16916af11697632617.0929', 14, '2023-11-10', 15),
(83, '652fd186d70771697632646.8808', 16, '2023-10-23', 50);

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
(17, 'MAD', 82, 5, 1, 4, 3, '2023-10-14', 'details details details', '1697315929.jpg', 'LKLK5454');

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
  `WholesalePayPrice` decimal(10,2) NOT NULL,
  `WholesaleSalePrice` decimal(10,2) NOT NULL,
  `hasChildUnit` tinyint(1) NOT NULL DEFAULT 0,
  `RetailUnitId` int(11) DEFAULT NULL,
  `RetailQty` int(11) DEFAULT NULL,
  `RetailSalePrice` decimal(10,2) DEFAULT NULL,
  `RetailPayPrice` decimal(10,2) DEFAULT NULL,
  `TotalRetailQty` int(11) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `endDate` date NOT NULL,
  `batchNumber` varchar(100) NOT NULL,
  `madeAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`purchaseDetailId`, `purchaseId`, `productId`, `wholesaleUnitId`, `WholesaleQty`, `WholesalePayPrice`, `WholesaleSalePrice`, `hasChildUnit`, `RetailUnitId`, `RetailQty`, `RetailSalePrice`, `RetailPayPrice`, `TotalRetailQty`, `userId`, `endDate`, `batchNumber`, `madeAt`) VALUES
(69, 10, 14, 3, 5, '200.00', '2250.00', 1, 4, 15, '150.00', '13.33', 75, 3, '2023-11-10', '652fd16916af11697632617.0929', '2023-09-30'),
(70, 10, 16, 5, 50, '120.00', '150.00', 0, 4, 0, '0.00', '0.00', 0, 3, '2023-10-23', '652fd186d70771697632646.8808', '2023-10-02'),
(71, 12, 15, 3, 51, '200.00', '125000.00', 1, 4, 250, '500.00', '0.80', 12750, 3, '2023-10-11', '652fd24cd19201697632844.8584', '2023-10-03'),
(72, 12, 16, 5, 50, '54.00', '20.00', 0, 0, 0, '0.00', '0.00', 0, 3, '2023-10-11', '652fd2663aa601697632870.2402', '2023-10-02'),
(73, 11, 14, 3, 3, '200.00', '0.00', 0, NULL, NULL, NULL, NULL, NULL, 3, '0000-00-00', '', '0000-00-00');

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
  `invoiceNumber` varchar(100) NOT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `costOnPay` decimal(10,2) DEFAULT NULL,
  `paid` decimal(10,2) DEFAULT NULL,
  `Remained` decimal(10,2) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchaseId`, `userId`, `supplierId`, `addedDate`, `details`, `invoiceNumber`, `tax`, `costOnPay`, `paid`, `Remained`, `type`, `approved`) VALUES
(10, 3, 6, '2023-10-18', '', '652fd127d64e31697632551.8778', '50.00', '500.00', '500.00', '6500.00', 1, 1),
(11, 3, 6, '2023-10-18', 'omer purchase', '652fd127d64e31697632551.8778', NULL, NULL, '4100.00', '100.00', 0, 1),
(12, 3, 3, '2023-10-18', 'manar omer purchase', '652fd224e60f71697632804.9423', '500.00', '0.00', '150.00', '12750.00', 1, 1),
(13, 3, 3, '2023-10-18', '', '652fd224e60f71697632804.9423', NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `storeId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `qtyRemining` int(11) NOT NULL,
  `Type` tinyint(1) NOT NULL,
  `storeDate` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`storeId`, `productId`, `qty`, `qtyRemining`, `Type`, `storeDate`, `userId`) VALUES
(76, 14, 15, 15, 1, '2023-10-18', 3),
(77, 16, 50, 50, 1, '2023-10-18', 3),
(78, 15, 250, 250, 1, '2023-10-18', 3),
(79, 16, 50, 100, 1, '2023-10-18', 3),
(80, 14, -3, 18, 0, '2023-10-19', 3),
(81, 14, -3, 21, 0, '2023-10-19', 3),
(82, 14, -3, 24, 0, '2023-10-19', 3);

-- --------------------------------------------------------

--
-- Table structure for table `supplieraccounting`
--

CREATE TABLE `supplieraccounting` (
  `supplierAccountingId` int(11) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `invoiceNumber` varchar(250) DEFAULT NULL,
  `paid` decimal(10,2) DEFAULT NULL,
  `remained` decimal(10,2) DEFAULT NULL,
  `remainedBefor` decimal(10,2) DEFAULT NULL,
  `ReceivedForReturn` decimal(10,2) DEFAULT NULL,
  `remainedForReturn` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplieraccounting`
--

INSERT INTO `supplieraccounting` (`supplierAccountingId`, `supplierId`, `invoiceNumber`, `paid`, `remained`, `remainedBefor`, `ReceivedForReturn`, `remainedForReturn`, `date`) VALUES
(2, 3, '652696b2da519', '400.00', '200.00', '200.00', '0.00', '0.00', NULL),
(3, 3, '652696b2da519', '400.00', '200.00', '400.00', '0.00', '0.00', NULL),
(16, 6, '652fd127d64e31697632551.8778', NULL, NULL, '300.00', '4100.00', '100.00', '2023-10-19');

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
(5, 'adma', 'alh', '09993199955555555'),
(6, 'omer', 'Omdaman', '09965655');

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
-- Indexes for table `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`accountId`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`batchId`);

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
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`storeId`);

--
-- Indexes for table `supplieraccounting`
--
ALTER TABLE `supplieraccounting`
  ADD PRIMARY KEY (`supplierAccountingId`);

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
-- AUTO_INCREMENT for table `accounting`
--
ALTER TABLE `accounting`
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

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
  MODIFY `purchaseDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `storeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `supplieraccounting`
--
ALTER TABLE `supplieraccounting`
  MODIFY `supplierAccountingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
