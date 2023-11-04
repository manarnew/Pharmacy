-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 08:04 AM
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
  `date` date NOT NULL,
  `expenseId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`accountId`, `AccountName`, `debit`, `credit`, `date`, `expenseId`) VALUES
(64, 'Account Sales', NULL, '4500.00', '2023-09-01', NULL),
(65, 'Account expense', '20.00', NULL, '2023-10-01', 3),
(66, 'Account expense', '25.00', NULL, '2023-10-24', 0),
(67, 'Account expense', '60.00', NULL, '2023-11-01', 7),
(69, 'Account Sales', NULL, '6000.00', '2023-10-29', NULL),
(70, 'Account Sales', NULL, '1500.00', '2023-10-30', NULL),
(71, 'Account Sales', NULL, '300.00', '2023-10-30', NULL),
(72, 'Account Sales', NULL, '300.00', '2023-10-30', NULL);

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
(94, '653228ead606d1697786090.8767', 15, '2023-10-03', 24),
(95, '6532290fcff8f1697786127.8519', 19, '2023-11-10', 1),
(96, '6532c8ac101401697826988.0659', 19, '2023-10-04', 5),
(97, '6532c8c9bb7d61697827017.768', 17, '2023-10-10', 225),
(102, '653505a84164b1697973672.2679', 15, '2023-10-02', 118),
(106, '653746169c1181698121238.6393', 15, '2023-10-04', 1);

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
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenseId` int(11) NOT NULL,
  `expenseNote` varchar(300) NOT NULL,
  `expensePrice` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenseId`, `expenseNote`, `expensePrice`, `date`) VALUES
(4, 'for', '50.00', '2023-10-02'),
(7, 'new', '6000.00', '2023-10-24'),
(9, 'new', '6000.00', '2023-11-01');

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
(16, 'DCCDD', 82, 6, 0, 0, 3, '2023-10-10', 'All rights reserved.', '1696960620.jpg', '6525906b8fa5cdd'),
(17, 'MAD', 82, 6, 1, 7, 3, '2023-10-14', 'details details details', '1697315929.jpg', 'LKLK5454'),
(19, 'FSPFR', 82, 6, 0, 0, 3, '2023-10-20', 'reserved reserved reserved', NULL, '6531fff960f431697775609.3971'),
(20, 'online', 83, 6, 0, 0, 3, '2023-11-01', '', '1698819295.jpg', '6541ecde83fe61698819294.5407');

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
(91, 23, 15, 6, 20, '200.00', '3000.00', 1, 7, 10, '300.00', '20.00', 200, 3, '2023-10-02', '653505a84164b1697973672.2679', '2023-09-30'),
(92, 23, 16, 6, 5, '15.00', '1000.00', 0, 0, 0, '0.00', '0.00', 0, 3, '2023-10-09', '653505bcc937d1697973692.8242', '2023-10-03'),
(94, 27, 16, 6, 2, '5.00', '10.00', 0, 7, 0, '0.00', '0.00', 0, 1, '2023-10-02', '6540929cb7c221698730652.7527', '2023-10-10'),
(95, 29, 15, 6, 2, '200.00', '0.00', 1, NULL, 10, NULL, NULL, NULL, 1, '0000-00-00', '653505a84164b1697973672.2679', '0000-00-00');

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
(23, 3, 5, '2023-10-22', '', '653505869ffa51697973638.6553', '10.00', '500.00', '1000.00', '6000.00', 1, 1),
(25, 3, 5, '2023-10-22', '', '653505869ffa51697973638.6553', '0.00', '0.00', '100.00', '200.00', 0, 1),
(27, 3, 5, '2023-10-29', '', '653e6cea7f62d1698589930.5218', NULL, NULL, NULL, NULL, 1, 0),
(28, 3, 5, '2023-11-01', '', '653e6cf48f0011698589940.5857', NULL, NULL, NULL, NULL, 1, 0),
(29, 1, 5, '2023-10-31', '', '653505869ffa51697973638.6553', NULL, NULL, NULL, NULL, 0, 0);

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
  `userId` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`saleId`, `invoiceNumber`, `TotalPrice`, `totalQty`, `date`, `userId`, `type`) VALUES
(70, '6536099ad71151698040218.8809', '1500.00', 5, '2023-10-23', 3, 1),
(72, '65360a16958b31698040342.6125', '10000.00', 10, '2023-09-06', 3, 1),
(73, '65360bcf3d0201698040783.2499', '1500.00', 5, '2023-10-23', 3, 1),
(74, '65367502cc5d61698067714.8371', '2400.00', 8, '2023-11-01', 3, 0),
(75, '653676b4403611698068148.263', '600.00', 2, '2023-10-23', 3, 0),
(81, '6536790fc3b821698068751.8018', '300.00', 1, '2023-10-23', 3, 1),
(88, '65374d07879d31698123015.5555', '300.00', 1, '2023-10-24', 3, 0),
(92, '653759f3ad92e1698126323.711', '4500.00', 15, '2023-10-24', 3, 1),
(93, '653e9d786dace1698602360.4492', '6000.00', 20, '2023-10-29', 1, 1),
(94, '653f2d2ec9a641698639150.826', '1500.00', 5, '2023-10-30', 1, 1),
(95, '653f2de18fcf41698639329.5891', '300.00', 1, '2023-10-30', 1, 1),
(96, '653f4f5fa40881698647903.6719', '300.00', 1, '2023-10-30', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salesdetails`
--

CREATE TABLE `salesdetails` (
  `saleDetailId` int(11) NOT NULL,
  `invoiceNumber` varchar(200) NOT NULL,
  `barcode` varchar(250) DEFAULT NULL,
  `productId` int(11) NOT NULL,
  `batchNumber` varchar(200) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `salePrice` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL,
  `expirationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesdetails`
--

INSERT INTO `salesdetails` (`saleDetailId`, `invoiceNumber`, `barcode`, `productId`, `batchNumber`, `qty`, `salePrice`, `date`, `userId`, `expirationDate`) VALUES
(103, '65360a16958b31698040342.6125', '', 16, '653505bcc937d1697973692.8242', 10, '1000.00', '2023-10-23', 3, '0000-00-00'),
(104, '65360bcf3d0201698040783.2499', '', 15, '653505a84164b1697973672.2679', 5, '300.00', '2023-10-23', 3, '0000-00-00'),
(105, '65367502cc5d61698067714.8371', '', 15, '653505a84164b1697973672.2679', 8, '300.00', '2023-11-02', 3, '0000-00-00'),
(106, '653676b4403611698068148.263', '', 15, '653505a84164b1697973672.2679', 2, '300.00', '2023-09-04', 3, '0000-00-00'),
(107, '653677a631caa1698068390.204', '', 15, '653505a84164b1697973672.2679', 2, '300.00', '2023-10-23', 3, '0000-00-00'),
(109, '653678b3a6cbb1698068659.6832', '', 15, '653505a84164b1697973672.2679', 1, '300.00', '2023-10-23', 3, '0000-00-00'),
(110, '653678d976d421698068697.4867', '', 15, '653505a84164b1697973672.2679', 3, '300.00', '2023-10-23', 3, '0000-00-00'),
(111, '653678e8adf811698068712.7126', '', 15, '653505a84164b1697973672.2679', 1, '300.00', '2023-10-23', 3, '0000-00-00'),
(112, '6536790fc3b821698068751.8018', '', 15, '653505a84164b1697973672.2679', 1, '300.00', '2023-10-23', 3, '0000-00-00'),
(114, '6537448f2d8971698120847.1865', '', 15, NULL, 1, '300.00', '2023-10-24', 3, '2023-10-03'),
(115, '653745b9cd6771698121145.8414', '', 15, NULL, 1, '300.00', '2023-10-24', 3, '2023-10-03'),
(116, '653745d89a3371698121176.6316', '', 15, NULL, 1, '300.00', '2023-10-24', 3, '2023-10-03'),
(117, '65374600f0d771698121216.9865', '', 15, NULL, 1, '300.00', '2023-10-24', 3, '2023-10-04'),
(121, '65374d07879d31698123015.5555', '6525906b8fa5c', 15, NULL, 1, '300.00', '2023-10-24', 3, '2023-10-18'),
(122, '653757a83f7791698125736.26', '', 16, NULL, 5, '1000.00', '2023-10-24', 3, '2023-10-03'),
(123, '65375825683281698125861.4268', '', 16, NULL, 5, '1000.00', '2023-10-24', 3, '2023-10-10'),
(124, '653759d527bfc1698126293.1628', '', 15, NULL, 10, '300.00', '2023-10-24', 3, '2023-10-03'),
(125, '653759f3ad92e1698126323.711', '', 15, '653505a84164b1697973672.2679', 15, '300.00', '2023-10-24', 3, '0000-00-00'),
(126, '653e9d786dace1698602360.4492', '', 15, '653505a84164b1697973672.2679', 20, '300.00', '2023-10-29', 1, '0000-00-00'),
(127, '653f2d2ec9a641698639150.826', '', 15, '653505a84164b1697973672.2679', 5, '300.00', '2023-10-30', 1, '0000-00-00'),
(128, '653f2de18fcf41698639329.5891', '', 15, '653505a84164b1697973672.2679', 1, '300.00', '2023-10-30', 1, '0000-00-00'),
(129, '653f4f5fa40881698647903.6719', '', 15, '653505a84164b1697973672.2679', 1, '300.00', '2023-10-30', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settingId` int(11) NOT NULL,
  `appName` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `notifyDate` int(11) NOT NULL,
  `qtyNumber` int(11) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingId`, `appName`, `logo`, `notifyDate`, `qtyNumber`, `phone`, `email`, `address`) VALUES
(1, 'PharmacySyS', '1698693012.jpg', 10, 20, '0993199616', 'manar@manar.sd', 'Omdaman');

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
(108, 17, 8, 17, 1, '2023-10-20', 3),
(112, 15, 8, 17, 0, '2023-10-20', 3),
(120, 15, 8, 170, 1, '2023-10-22', 3),
(121, 16, 5, 5, 1, '2023-10-22', 3),
(122, 15, 3, 167, 2, '2023-10-23', 3),
(123, 15, 1, 166, 2, '2023-10-23', 3),
(124, 15, 1, 167, 2, '2023-10-24', 3),
(125, 15, 1, 168, 2, '2023-10-24', 3),
(126, 15, 1, 169, 2, '2023-10-24', 3),
(127, 15, 1, 170, 2, '2023-10-24', 3),
(128, 15, 1, 171, 2, '2023-10-24', 3),
(129, 16, 5, 10, 3, '2023-10-24', 3),
(130, 15, 10, 181, 3, '2023-10-24', 3),
(131, 15, 15, 166, 2, '2023-10-24', 3),
(132, 15, 1, 165, 4, '2023-10-26', 3),
(133, 16, 5, 5, 4, '2023-10-26', 3),
(134, 15, 20, 145, 2, '2023-10-29', 1),
(135, 15, 5, 140, 2, '2023-10-30', 1),
(136, 15, 1, 139, 2, '2023-10-30', 1),
(137, 15, 1, 138, 2, '2023-10-30', 1);

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
(37, 5, '6532c88e874631697826958.5541', NULL, NULL, '-600.00', NULL, NULL, '2023-10-20'),
(38, 5, '653505869ffa51697973638.6553', NULL, NULL, '-600.00', NULL, NULL, '2023-10-22');

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
(1, 'manar Ali Omer', 'd9b1d7db4cd6e70935368a1efb10e377', 'manar@manar.sd', 2),
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
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenseId`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settingId`);

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
  MODIFY `accountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `purchasedetails`
--
ALTER TABLE `purchasedetails`
  MODIFY `purchaseDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `saleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `salesdetails`
--
ALTER TABLE `salesdetails`
  MODIFY `saleDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `storeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `supplieraccounting`
--
ALTER TABLE `supplieraccounting`
  MODIFY `supplierAccountingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
