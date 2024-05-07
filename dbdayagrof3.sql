-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 09:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdayagrof3`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `CartID` int(6) NOT NULL,
  `ProductID` int(6) NOT NULL,
  `UserID` int(6) NOT NULL,
  `ProductName` varchar(30) NOT NULL,
  `PriceperUnit` float NOT NULL,
  `ProductDesc` varchar(700) NOT NULL,
  `Quantity` int(6) NOT NULL,
  `TotalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`CartID`, `ProductID`, `UserID`, `ProductName`, `PriceperUnit`, `ProductDesc`, `Quantity`, `TotalPrice`) VALUES
(41, 1, 18, '', 0, '', 4, 0),
(42, 1, 18, '', 0, '', 1, 0),
(43, 1, 19, '', 0, '', 7, 0),
(44, 3, 19, '', 0, '', 3, 0),
(46, 4, 19, '', 0, '', 1, 0),
(47, 2, 19, '', 0, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `ProductName` varchar(30) NOT NULL,
  `ProductPrice` float NOT NULL,
  `ProductDesc` varchar(10000) NOT NULL,
  `ProductID` int(6) NOT NULL,
  `ProductImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`ProductName`, `ProductPrice`, `ProductDesc`, `ProductID`, `ProductImage`) VALUES
('ArduinoUno', 350, 'The Arduino Uno is a popular microcontroller board based on the ATmega328P. It features 14 digital input/output pins, 6 analog inputs, a 16 MHz quartz crystal, USB connection, power jack, ICSP header, and a reset button. It\'s an excellent choice for beginners and professionals alike for various projects.', 1, '/CircuitFlo/images/uno.webp\r\n'),
('Arduino Nano', 250, 'The Arduino Nano is a compact yet powerful microcontroller board based on the ATmega328. It\'s similar to the Arduino Uno but in a smaller form factor, making it suitable for projects where space is limited. It features 14 digital input/output pins, 8 analog inputs, USB connectivity, and more.', 2, '/CircuitFlo/images/nano.jpg\r\n'),
('Arduino Mega 2560', 1000, 'The Arduino Mega 2560 is a robust microcontroller board based on the ATmega2560. It\'s designed for projects that require more I/O pins and memory. With 54 digital input/output pins, 16 analog inputs, a larger flash memory size, and more, it\'s suitable for complex projects and prototyping.', 3, '/CircuitFlo/images/mega.webp\r\n'),
('DHT22 Temperature and Humidity', 200, 'The DHT22 sensor is capable of measuring both temperature and humidity with high accuracy. It uses a digital signal output, making it easy to interface with microcontrollers like Arduino. Ideal for weather stations, environmental monitoring, and HVAC systems.\r\n\r\n', 4, '/CircuitFlo/images/temp.jpg\r\n'),
('MPU-6050 Gyroscope and Acceler', 300, 'The MPU-6050 sensor combines a gyroscope and accelerometer in a single chip. It provides precise motion sensing capabilities, making it suitable for applications such as motion tracking, gesture recognition, and drone stabilization.', 5, '/CircuitFlo/images/gyro.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `userid` int(11) NOT NULL,
  `emailadd` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`userid`, `emailadd`, `username`, `password`, `usertype`) VALUES
(16, 'zak123@gmail.com', 'wow1234', '123', ''),
(17, 'gdgfggd@gmail.com', 'gypsycrusader', 'fdgdgdfdf', ''),
(18, 'tristan@gmail.com', 'tristan1234', '123', ''),
(19, 'zak123@gmail.com', 'zak123', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserprofile`
--

CREATE TABLE `tbluserprofile` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluserprofile`
--

INSERT INTO `tbluserprofile` (`userid`, `firstname`, `lastname`, `username`, `gender`, `birthday`) VALUES
(16, 'Wow', 'Wow', 'wow1234', 'Male', '2024-05-04'),
(17, 'wow', 'wow', 'gypsycrusader', 'Male', '2024-05-04'),
(18, 'Francis', 'Dayagro', 'tristan1234', 'Male', '2024-05-03'),
(19, 'Zak', 'Floreta', 'zak123', 'Female', '2024-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `tblwishlist`
--

CREATE TABLE `tblwishlist` (
  `WishlistID` int(6) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `UserID` int(6) NOT NULL,
  `ProductName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblwishlist`
--

INSERT INTO `tblwishlist` (`WishlistID`, `UserName`, `UserID`, `ProductName`) VALUES
(677, '', 18, 'sfsdfds'),
(678, '', 18, 'sdfsdfds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`ProductID`),
  ADD UNIQUE KEY `ProductID` (`ProductID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `UserName` (`username`) USING BTREE;

--
-- Indexes for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tblwishlist`
--
ALTER TABLE `tblwishlist`
  ADD PRIMARY KEY (`WishlistID`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `CartID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `ProductID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblwishlist`
--
ALTER TABLE `tblwishlist`
  MODIFY `WishlistID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=679;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `tbluseraccount` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
