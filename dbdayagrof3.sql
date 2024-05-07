-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 07:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
  `ProductID` int(6) NOT NULL,
  `ProductName` varchar(30) NOT NULL,
  `PriceperUnit` float NOT NULL,
  `ProductDesc` varchar(700) NOT NULL,
  `Quantity` int(6) NOT NULL,
  `TotalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `ProductName` varchar(30) NOT NULL,
  `ProductPrice` float NOT NULL,
  `ProductDesc` varchar(10000) NOT NULL,
  `ProductID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`ProductName`, `ProductPrice`, `ProductDesc`, `ProductID`) VALUES
('ArduinoUno', 350, 'The Arduino Uno is a popular microcontroller board based on the ATmega328P. It features 14 digital input/output pins, 6 analog inputs, a 16 MHz quartz crystal, USB connection, power jack, ICSP header, and a reset button. It\'s an excellent choice for beginners and professionals alike for various projects.', 1),
('Arduino Nano', 250, 'The Arduino Nano is a compact yet powerful microcontroller board based on the ATmega328. It\'s similar to the Arduino Uno but in a smaller form factor, making it suitable for projects where space is limited. It features 14 digital input/output pins, 8 analog inputs, USB connectivity, and more.', 2),
('Arduino Mega 2560', 1000, 'The Arduino Mega 2560 is a robust microcontroller board based on the ATmega2560. It\'s designed for projects that require more I/O pins and memory. With 54 digital input/output pins, 16 analog inputs, a larger flash memory size, and more, it\'s suitable for complex projects and prototyping.', 3),
('DHT22 Temperature and Humidity', 200, 'The DHT22 sensor is capable of measuring both temperature and humidity with high accuracy. It uses a digital signal output, making it easy to interface with microcontrollers like Arduino. Ideal for weather stations, environmental monitoring, and HVAC systems.\r\n\r\n', 4),
('MPU-6050 Gyroscope and Acceler', 300, 'The MPU-6050 sensor combines a gyroscope and accelerometer in a single chip. It provides precise motion sensing capabilities, making it suitable for applications such as motion tracking, gesture recognition, and drone stabilization.', 5);

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
(11, 'kc@gmail.com', 'kc', '123', ''),
(12, 'zak@gmail.com', 'zak', '123', ''),
(13, 'itan@gmail.com', 'tristan', '123', ''),
(14, 'james@gmail.com', 'james', '123', ''),
(15, 'james@gmail.com', 'james1', '123', '');

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
(11, 'KC', 'Ajero', 'kc', 'Male', '2024-06-15'),
(12, 'zak', 'flo', 'zak', 'Female', '2024-03-15'),
(13, 'itan', 'tl', 'tristan', 'Male', '2024-05-28'),
(14, 'james', 'acbl', 'james', 'Female', '2024-05-15'),
(15, 'james', 'acbl', 'james1', 'Male', '2024-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `tblwishlist`
--

CREATE TABLE `tblwishlist` (
  `WishlistID` int(6) NOT NULL,
  `UserID` int(6) NOT NULL,
  `ProductName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblwishlist`
--

INSERT INTO `tblwishlist` (`WishlistID`, `UserID`, `ProductName`) VALUES
(12, 11, 'DHT11/DHT22 Temperature and Humidity Sensor'),
(13, 14, 'HC-SR04 Ultrasonic Distance Sensor'),
(14, 12, 'Arduino Nano 33 IoT'),
(15, 13, 'Arduino LilyPad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`ProductID`);

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
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `ProductID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbluserprofile`
--
ALTER TABLE `tbluserprofile`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblwishlist`
--
ALTER TABLE `tblwishlist`
  MODIFY `WishlistID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD CONSTRAINT `ProductID` FOREIGN KEY (`ProductID`) REFERENCES `tblproducts` (`ProductID`);

--
-- Constraints for table `tblwishlist`
--
ALTER TABLE `tblwishlist`
  ADD CONSTRAINT `UserId` FOREIGN KEY (`UserID`) REFERENCES `tbluseraccount` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
