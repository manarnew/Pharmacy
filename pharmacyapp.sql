-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2023 at 10:58 AM
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
  `credit` decimal(10,2) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`accountId`, `AccountName`, `debit`, `credit`, `date`) VALUES
(39, 'Account Purchase cost', '2400.00', NULL, '0000-00-00'),
(40, 'Account Return Purchase', NULL, '500.00', '0000-00-00'),
(41, 'Account Return Purchase', NULL, '500.00', '0000-00-00'),
(42, 'Account Purchase cost', '0.00', NULL, '2023-10-20');

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
(94, '653228ead606d1697786090.8767', 15, '2023-10-03', 13),
(95, '6532290fcff8f1697786127.8519', 19, '2023-11-10', 1),
(96, '6532c8ac101401697826988.0659', 19, '2023-10-04', 5),
(97, '6532c8c9bb7d61697827017.768', 17, '2023-10-10', 225);

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
(81, ' s210'),
(82, 'newBox'),
(83, 'oneD'),
(86, 'nNDK');

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
  `details` varchar(300) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `barcode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `categoryId`, `wholesaleUnitId`, `hasChildUnit`, `RetailUnitId`, `userId`, `addedDate`, `details`, `image`, `barcode`) VALUES
(15, 'LL15', 83, 6, 1, 7, 3, '2023-10-10', 'All rights reserved.', '1696960620.jpg', '6525906b8fa5c'),
(16, 'DCCDD', 82, 6, 0, 0, 3, '2023-10-10', 'All rights reserved.', '1696960620.jpg', '6525906b8fa5c'),
(17, 'MAD', 82, 6, 1, 7, 3, '2023-10-14', 'details details details', '1697315929.jpg', 'LKLK5454'),
(19, 'FSPFR', 82, 6, 0, 0, 3, '2023-10-20', 'reserved reserved reserved', NULL, '6531fff960f431697775609.3971');

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
(85, 18, 15, 6, 5, '200.00', '1500.00', 1, 7, 5, '300.00', '40.00', 25, 3, '2023-10-03', '653228ead606d1697786090.8767', '2023-03-20'),
(86, 18, 19, 6, 5, '200.00', '330.00', 0, 0, 0, '0.00', '0.00', 0, 3, '2023-11-10', '6532290fcff8f1697786127.8519', '2023-09-30'),
(87, 20, 15, 6, 2, '200.00', '0.00', 1, NULL, 5, NULL, NULL, NULL, 3, '0000-00-00', '653228ead606d1697786090.8767', '0000-00-00'),
(88, 20, 19, 6, 2, '200.00', '0.00', 0, NULL, 0, NULL, NULL, NULL, 3, '0000-00-00', '6532290fcff8f1697786127.8519', '0000-00-00'),
(89, 21, 19, 6, 5, '5.00', '5.00', 0, 0, 0, '0.00', '0.00', 0, 3, '2023-10-04', '6532c8ac101401697826988.0659', '2023-10-04'),
(90, 21, 17, 6, 15, '15.00', '225.00', 1, 7, 15, '15.00', '1.00', 225, 3, '2023-10-10', '6532c8c9bb7d61697827017.768', '2023-10-01');

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

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `saleId` int(11) NOT NULL,
  `invoiceNumber` varchar(200) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `totalQty` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleId`, `invoiceNumber`, `TotalPrice`, `totalQty`, `date`, `userId`) VALUES
(39, '6534da3275d801697962546.4827', '70.00', 6, '2023-10-22', 3),
(40, '6534e342a03dc1697964866.6564', '45.00', 3, '2023-10-22', 3),
(41, '6534e398bfafd1697964952.7852', '20.00', 2, '2023-10-22', 3);

-- --------------------------------------------------------

--
-- Table structure for table `salesdetails`
--

CREATE TABLE `salesdetails` (
  `saleDetailId` int(11) NOT NULL,
  `invoiceNumber` varchar(200) NOT NULL,
  `barcode` varchar(250) NOT NULL,
  `productId` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `salePrice` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesdetails`
--

INSERT INTO `salesdetails` (`saleDetailId`, `invoiceNumber`, `barcode`, `productId`, `qty`, `salePrice`, `date`, `userId`) VALUES
(52, '6534da3275d801697962546.4827', 'LKLK5454', 17, 4, '15.00', '2023-10-22', 3),
(53, '6534da3275d801697962546.4827', '6531fff960f431697775609.3971', 19, 2, '5.00', '2023-10-22', 3),
(54, '6534e342a03dc1697964866.6564', 'LKLK5454', 17, 3, '15.00', '2023-10-22', 3),
(55, '6534e398bfafd1697964952.7852', 'LKLK5454', 17, 1, '15.00', '2023-10-22', 3),
(56, '6534e398bfafd1697964952.7852', '6531fff960f431697775609.3971', 19, 1, '5.00', '2023-10-22', 3);

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
(108, 15, 25, 25, 1, '2023-10-20', 3),
(109, 19, 5, 5, 1, '2023-10-20', 3),
(112, 15, 10, 15, 0, '2023-10-20', 3),
(113, 19, 2, 3, 0, '2023-10-20', 3),
(114, 19, 5, 8, 1, '2023-10-20', 3),
(115, 17, 225, 225, 1, '2023-10-20', 3),
(116, 19, 5, 13, 1, '2023-10-20', 3),
(117, 17, 225, 450, 1, '2023-10-20', 3),
(118, 19, 5, 18, 1, '2023-10-20', 3),
(119, 17, 225, 675, 1, '2023-10-20', 3);

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
(34, 5, '653228335ad871697785907.3721', '2000.00', '0.00', '0.00', NULL, NULL, '2023-10-20'),
(35, 5, '653228335ad871697785907.3721', NULL, NULL, '-300.00', '500.00', '300.00', '2023-10-20'),
(36, 5, '653228335ad871697785907.3721', NULL, NULL, '-600.00', '500.00', '300.00', '2023-10-20'),
(37, 5, '6532c88e874631697826958.5541', NULL, NULL, '-600.00', NULL, NULL, '2023-10-20');

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
(5, 'Adam', 'alh', '09993199'),
(6, 'omer', 'Omdaman', '09965655'),
(7, 'Khalied', 'Alahadhia', '0993199676');

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
(6, 'Box', 1),
(7, 'unit', 0);

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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`saleId`);

--
-- Indexes for table `salesdetails`
--
ALTER TABLE `salesdetails`
  ADD PRIMARY KEY (`saleDetailId`);

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
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  MODIFY `purchaseDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `salesdetails`
--
ALTER TABLE `salesdetails`
  MODIFY `saleDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `storeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `supplieraccounting`
--
ALTER TABLE `supplieraccounting`
  MODIFY `supplierAccountingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
