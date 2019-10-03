-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2019 at 01:12 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project334`
--

-- --------------------------------------------------------

--
-- Table structure for table `clubmember`
--

CREATE TABLE `clubmember` (
  `ClubMemberID` int(5) NOT NULL,
  `CustomerID` int(5) NOT NULL,
  `DateOfJoining` date NOT NULL,
  `MemberStatus` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubmember`
--

INSERT INTO `clubmember` (`ClubMemberID`, `CustomerID`, `DateOfJoining`, `MemberStatus`) VALUES
(1, 1, '2019-05-05', 'Gold'),
(2, 1, '2019-05-10', 'Gold'),
(3, 7, '2019-05-11', 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ContactID` int(5) NOT NULL,
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Address` varchar(30) DEFAULT NULL,
  `PhoneNumber` int(10) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Fax` varchar(30) DEFAULT NULL,
  `ImageLocation` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContactID`, `FirstName`, `LastName`, `Address`, `PhoneNumber`, `Email`, `Fax`, `ImageLocation`) VALUES
(1, 'David', 'Azzi', '98 Tims Avenue, Timmy Town NSW', 410055123, 'da291@uowmail.edu.au', '', 'assets\\img\\user.gif'),
(2, 'Michael', 'Jackson', '33 Hobby Street, Tootoot NSW 2', 410055123, 'da291@uowmail.edu.au', '', 'assets\\img\\user.gif'),
(5, 'David1', 'Azzi', '123 Fake Street, FAKE NSW 2000', 410055123, 'da291@uowmail.edu.au', '', 'assets\\img\\user.gif'),
(6, 'David', 'Azzi', '56 Fake Street, Mortdale NSW 2', 410055123, 'da291@uowmail.edu.au', '', 'assets\\img\\user.gif'),
(7, 'Test', 'Test', '123 Test Street', 123456789, 'test@admin.com.au', '', 'assets\\img\\user.gif'),
(8, 'Ben', 'Sherman', '98 Reflex Road, ARNCLIFFE NSW ', 65432120, 'test@admin.com.au', '', 'assets\\img\\user.gif'),
(9, 'Fox', 'Potato', '123 Fake Street, FAKE NSW 2000', 410055123, 'da291@uowmail.edu.au', '', 'assets\\img\\user.gif'),
(12, 'Peter', 'Parker', '12 Spidey Wed Road  SWING NSW ', 123456789, 'spider@shootshoot.com', '', 'assets\\img\\user.gif'),
(13, 'Emily', 'Anderson', '98 John Street, RAINSBURY NSW ', 75834920, 'emily@anderson.com', '', 'assets\\img\\user.gif');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(5) NOT NULL,
  `ClubMemberID` varchar(20) DEFAULT NULL,
  `CreditLine` decimal(7,2) DEFAULT NULL,
  `CreditBalance` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `ClubMemberID`, `CreditLine`, `CreditBalance`) VALUES
(1, '1', '1500.00', '1000.00'),
(2, NULL, '10020.00', '500.00'),
(6, '1', '15000.00', '1300.00'),
(7, NULL, '123.00', NULL),
(8, '1', '15000.00', NULL),
(9, NULL, '1000.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` int(5) NOT NULL,
  `SupplierID` int(5) NOT NULL,
  `StoreID` int(5) NOT NULL,
  `ItemID` int(5) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `DateOrdered` date NOT NULL,
  `DateDelivered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `SupplierID`, `StoreID`, `ItemID`, `Quantity`, `DateOrdered`, `DateDelivered`) VALUES
(1, 1, 1, 2, 10, '2019-05-01', '2019-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(5) NOT NULL,
  `ContactID` int(5) NOT NULL,
  `StoreID` int(5) NOT NULL,
  `JobTitle` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `ContactID`, `StoreID`, `JobTitle`, `Password`) VALUES
(1, 1, 1, 'Admin', '1234'),
(2, 2, 1, 'Admin', '12'),
(3, 12, 1, 'Backend Staff', '123'),
(4, 13, 1, 'Frontend Staff', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `CustomerID` int(5) NOT NULL,
  `SubjectArea` varchar(30) NOT NULL,
  `ModelType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`CustomerID`, `SubjectArea`, `ModelType`) VALUES
(1, 'Cars', 'Display'),
(2, 'Trains', '');

-- --------------------------------------------------------

--
-- Table structure for table `modelitem`
--

CREATE TABLE `modelitem` (
  `ItemID` int(5) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `ModelType` varchar(30) NOT NULL,
  `SubjectArea` varchar(30) NOT NULL,
  `SellPrice` decimal(7,2) NOT NULL,
  `BuyPrice` decimal(7,2) NOT NULL,
  `DateOfIntroduction` date NOT NULL,
  `Description` varchar(50) NOT NULL,
  `ItemAvailability` tinyint(1) NOT NULL,
  `SupplierID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modelitem`
--

INSERT INTO `modelitem` (`ItemID`, `Name`, `ModelType`, `SubjectArea`, `SellPrice`, `BuyPrice`, `DateOfIntroduction`, `Description`, `ItemAvailability`, `SupplierID`) VALUES
(1, 'White Train Carriage', 'Display', 'Train', '150.00', '120.00', '2019-05-02', 'White Train Carriage with no motor', 1, 1),
(2, 'Red Picket Fence', 'Display', 'Other', '5.00', '2.00', '2019-05-02', 'A small red picket fence ', 1, 1),
(3, 'Car (Red)', 'Display', 'Car', '100.00', '50.00', '2019-05-09', 'A red sedan model car', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `SaleID` int(5) NOT NULL,
  `CustomerID` int(5) NOT NULL,
  `EmployeeID` int(5) NOT NULL,
  `ItemID` int(5) NOT NULL,
  `TransactionID` int(5) NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int(5) NOT NULL,
  `Discount` decimal(7,2) NOT NULL,
  `TotalValue` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`SaleID`, `CustomerID`, `EmployeeID`, `ItemID`, `TransactionID`, `Date`, `Quantity`, `Discount`, `TotalValue`) VALUES
(1, 1, 1, 1, 1, '2019-05-02', 5, '10.00', '100.00'),
(2, 1, 1, 1, 2, '0000-00-00', 2, '0.00', '150.00'),
(3, 1, 1, 1, 3, '2019-05-22', 2, '2.00', '150.00'),
(4, 6, 2, 1, 4, '0000-00-00', 1, '0.00', '123.00'),
(5, 7, 1, 3, 5, '2019-05-08', 1, '0.00', '360.00'),
(6, 1, 1, 2, 6, '2019-05-18', 500, '0.00', '365.00'),
(7, 9, 3, 2, 7, '2019-05-04', 7, '2.00', '150.00'),
(8, 1, 1, 3, 8, '2019-05-08', 7, '2.00', '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `StoreID` int(5) NOT NULL,
  `ContactID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`StoreID`, `ContactID`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `storestock`
--

CREATE TABLE `storestock` (
  `StoreID` int(5) NOT NULL,
  `ItemID` int(5) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `ItemLocation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storestock`
--

INSERT INTO `storestock` (`StoreID`, `ItemID`, `Quantity`, `ItemLocation`) VALUES
(1, 1, 12, 'Top Shelf'),
(1, 2, 50, ''),
(1, 3, 15, '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(5) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `CreditLine` decimal(7,2) NOT NULL,
  `ContactID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `Name`, `CreditLine`, `ContactID`) VALUES
(1, 'HobbyCo', '25000.00', 6),
(2, 'Trains R us', '1000.00', 5),
(3, 'Archies Homewares', '500.00', 1),
(4, 'Georges FireSale', '5000.00', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubmember`
--
ALTER TABLE `clubmember`
  ADD PRIMARY KEY (`ClubMemberID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`),
  ADD KEY `StoreID` (`StoreID`),
  ADD KEY `SupplierID` (`SupplierID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `StoreID` (`StoreID`),
  ADD KEY `ContactID` (`ContactID`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `modelitem`
--
ALTER TABLE `modelitem`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `SupplierID` (`SupplierID`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`SaleID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`StoreID`),
  ADD KEY `ContactID` (`ContactID`);

--
-- Indexes for table `storestock`
--
ALTER TABLE `storestock`
  ADD KEY `StoreID` (`StoreID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`),
  ADD KEY `ContactID` (`ContactID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clubmember`
--
ALTER TABLE `clubmember`
  ADD CONSTRAINT `clubmember_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `contact` (`ContactID`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`),
  ADD CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`ItemID`) REFERENCES `modelitem` (`ItemID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`ContactID`) REFERENCES `contact` (`ContactID`);

--
-- Constraints for table `interest`
--
ALTER TABLE `interest`
  ADD CONSTRAINT `interest_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `modelitem`
--
ALTER TABLE `modelitem`
  ADD CONSTRAINT `modelitem_ibfk_1` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `modelitem` (`ItemID`),
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`ContactID`) REFERENCES `contact` (`ContactID`);

--
-- Constraints for table `storestock`
--
ALTER TABLE `storestock`
  ADD CONSTRAINT `storestock_ibfk_1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`),
  ADD CONSTRAINT `storestock_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `modelitem` (`ItemID`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`ContactID`) REFERENCES `contact` (`ContactID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
