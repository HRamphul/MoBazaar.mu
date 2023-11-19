-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2023 at 07:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobazaar`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderNo` int(4) NOT NULL,
  `userId` int(4) NOT NULL,
  `orderDateTime` datetime NOT NULL,
  `orderTotal` decimal(8,2) NOT NULL DEFAULT 0.00,
  `reviewed` int(1) NOT NULL DEFAULT 0,
  `despatch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderNo`, `userId`, `orderDateTime`, `orderTotal`, `reviewed`, `despatch`) VALUES
(51, 8, '2023-03-19 12:00:38', 160.00, 1, 1),
(52, 8, '2023-03-19 12:59:57', 65.00, 1, 1),
(53, 8, '2023-03-19 13:01:24', 6.50, 1, 0),
(54, 8, '2023-03-19 13:02:07', 13.00, 1, 1),
(55, 8, '2023-03-21 14:18:03', 20.50, 1, 0),
(56, 8, '2023-03-21 14:19:38', 20.50, 1, 0),
(57, 8, '2023-03-24 00:51:50', 212.00, 1, 1),
(59, 8, '2023-03-24 00:52:50', 10.50, 1, 1),
(60, 8, '2023-03-24 23:36:08', 47.50, 0, 0),
(61, 8, '2023-03-24 23:39:43', 10.00, 0, 0),
(62, 8, '2023-07-24 11:06:47', 8.00, 0, 1),
(63, 8, '2023-08-17 18:39:26', 8.00, 0, 0),
(64, 8, '2023-08-18 20:13:13', 32.00, 1, 0),
(65, 8, '2023-08-18 20:13:24', 32.50, 1, 0),
(66, 8, '2023-08-27 14:32:01', 24.00, 1, 1),
(67, 8, '2023-09-07 21:22:10', 8.00, 0, 1),
(68, 8, '2023-09-07 21:22:40', 8.00, 0, 1),
(69, 8, '2023-09-07 21:25:53', 8.00, 0, 1),
(70, 8, '2023-09-07 21:25:58', 10.00, 0, 1),
(71, 8, '2023-09-07 21:28:54', 10.00, 0, 1),
(72, 8, '2023-09-07 21:29:05', 10.00, 0, 1),
(73, 8, '2023-09-07 21:32:50', 26.50, 0, 0),
(74, 8, '2023-09-07 21:33:13', 34.50, 0, 1),
(75, 8, '2023-09-07 21:33:42', 34.50, 0, 1),
(76, 8, '2023-09-07 21:34:15', 34.50, 0, 1),
(77, 8, '2023-09-07 21:34:26', 8.00, 0, NULL),
(78, 8, '2023-09-07 21:34:34', 10.00, 0, NULL),
(79, 8, '2023-09-07 21:37:19', 20.00, 0, NULL),
(80, 8, '2023-09-07 21:38:24', 20.00, 0, NULL),
(81, 8, '2023-09-07 21:38:30', 0.00, 0, NULL),
(82, 8, '2023-09-07 21:38:37', 8.00, 0, NULL),
(83, 8, '2023-09-07 21:40:28', 6.50, 0, NULL),
(84, 8, '2023-09-07 21:41:13', 18.00, 0, NULL),
(85, 8, '2023-09-07 21:41:44', 14.50, 0, NULL),
(86, 26, '2023-09-08 15:24:59', 18.00, 0, NULL),
(87, 26, '2023-09-11 09:28:46', 18.00, 1, NULL),
(88, 19, '2023-09-15 21:31:02', 28.00, 0, NULL),
(89, 19, '2023-09-15 21:37:10', 0.00, 0, NULL),
(90, 19, '2023-09-15 21:37:29', 0.00, 0, NULL),
(91, 19, '2023-09-15 21:37:49', 16.50, 0, NULL),
(92, 19, '2023-09-16 01:25:26', 16.50, 1, NULL),
(93, 19, '2023-09-16 02:23:07', 16.50, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `orderNo` int(4) NOT NULL,
  `prodId` int(11) NOT NULL,
  `quantityOrdered` int(11) DEFAULT NULL,
  `subTotal` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`orderNo`, `prodId`, `quantityOrdered`, `subTotal`) VALUES
(51, 11, 8, 20),
(52, 9, 10, 7),
(53, 9, 1, 7),
(54, 9, 2, 13),
(55, 8, 1, 11),
(56, 10, 1, 10),
(57, 10, 17, 170),
(59, 8, 1, 11),
(60, 11, 1, 20),
(61, 10, 1, 10),
(62, 8, 1, 8),
(63, 8, 1, 8),
(64, 8, 4, 32),
(65, 9, 5, 33),
(66, 8, 3, 24),
(67, 8, 1, 8),
(68, 8, 1, 8),
(70, 10, 1, 10),
(72, 10, 1, 10),
(73, 10, 2, 20),
(74, 10, 2, 20),
(75, 10, 2, 20),
(76, 10, 2, 20),
(77, 8, 1, 8),
(78, 10, 1, 10),
(79, 11, 1, 20),
(82, 8, 1, 8),
(83, 9, 1, 7),
(84, 10, 1, 10),
(85, 8, 1, 8),
(86, 8, 1, 8),
(87, 8, 1, 8),
(88, 8, 1, 8),
(91, 10, 1, 10),
(92, 9, 1, 7),
(92, 10, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `proId` int(4) NOT NULL,
  `prodName` varchar(30) NOT NULL,
  `prodPicNameSmall` varchar(100) NOT NULL,
  `prodPicNameLarge` varchar(100) NOT NULL,
  `prodDescripShort` varchar(1000) DEFAULT NULL,
  `prodDescripLong` varchar(3000) DEFAULT NULL,
  `prodPrice` decimal(6,2) NOT NULL,
  `prodQuantity` int(4) NOT NULL,
  `prodType` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`proId`, `prodName`, `prodPicNameSmall`, `prodPicNameLarge`, `prodDescripShort`, `prodDescripLong`, `prodPrice`, `prodQuantity`, `prodType`) VALUES
(8, 'Apple', 'apple.jpg', 'apple.jpg', 'The apple is one of the pome (fleshy) fruits. Apples at harvest vary widely in size, shape, colour, and acidity, but most are fairly round and some shade of red or yellow. The thousands of varieties fall into three broad classes: cider, cooking, and dessert varieties.', 'Apple from France\nThe apple is one of the pome (fleshy) fruits. Apples at harvest vary widely in size, shape, colour, and acidity, but most are fairly round and some shade of red or yellow. The thousands of varieties fall into three broad classes: cider, cooking, and dessert varieties.', 8.00, 8, 'f'),
(9, 'Orange', 'orange.jpg', 'orange.jpg', 'Oranges contains vitamin C which helps your body in lots of ways: Protects your cells from damage. Helps your body make collagen, a protein that heals wounds and gives you smoother skin. Makes it easier to absorb iron to fight anemia.', 'The orange are from Mexico.\n\nThe vitamin C in oranges helps your body in lots of ways: Protects your cells from damage. Helps your body make collagen, a protein that heals wounds and gives you smoother skin. Makes it easier to absorb iron to fight anemia.', 6.50, 23, 'f'),
(10, 'Cucumber', 'cucumber.jpg', 'cucumber.jpg', 'They are made up of over 90% water, making them excellent for staying hydrated.', 'Cucumber from South Africa\n\nCucumbers contain multiple B vitamins, including vitamin B1, vitamin B5, and vitamin B7. B vitamins are known to help ease feelings of anxiety and buffer some of the damaging effects of stress. Cucumbers are rich in two of the most basic elements needed for healthy digestion.', 10.00, 6, 'v'),
(11, 'Pumpkin', 'pumpkin.jpg', 'pumpkin.jpg', 'Pumpkins are a type of squash. They are in the gourd family, which means they have a hard skin, or shell, and grow on vines. You might think of them as a vegetable, but pumpkins are a fruit because they develop from a flower and hold the seeds of the plant.', 'Pumpkin from  Port Louis.\n\nPumpkins are a type of squash. They are in the gourd family, which means they have a hard skin, or shell, and grow on vines. You might think of them as a vegetable, but pumpkins are a fruit because they develop from a flower and hold the seeds of the plant.', 20.00, 68, 'v');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(11) NOT NULL,
  `userId` int(4) NOT NULL,
  `orderNo` int(4) NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `ban` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `userId`, `orderNo`, `rating`, `comment`, `ban`) VALUES
(1, 8, 51, 2, 'Average service', 1),
(2, 8, 52, 1, 'bad,waste of money and time', 0),
(3, 8, 53, 4, 'good....very punctual', 0),
(4, 8, 54, 1, 'very bad.donot recommend', 1),
(5, 8, 55, 3, 'Delivery was quite slow but quality products!', -1),
(6, 8, 56, 4, 'Fresh fruits and vegetables!\r\n\r\nHighly recommended!! :)', 0),
(7, 8, 64, 3, 'it was great but did not last long', 0),
(8, 8, 65, 4, 'apple was great!', 0),
(9, 8, 57, 4, 'Good apples, very tasty', 0),
(10, 8, 66, 1, 'very bad apples!', 0),
(11, 8, 59, 5, 'Love it', -1),
(12, 26, 87, 1, 'not satisfied', -1),
(13, 19, 92, 4, 'great!', -1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(4) NOT NULL,
  `userType` varchar(1) NOT NULL DEFAULT 'C',
  `userFName` varchar(50) NOT NULL,
  `userSName` varchar(50) NOT NULL,
  `userAddress` varchar(50) NOT NULL,
  `userPostcode` varchar(50) NOT NULL,
  `userTelNo` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userType`, `userFName`, `userSName`, `userAddress`, `userPostcode`, `userTelNo`, `userEmail`, `userPassword`) VALUES
(8, 'C', 'Shahan', 'Delulu', 'Royal Rod, Simin Greyein', '11020', '0763960868', 'delulu@gmail.com', '$2y$10$RTB9yDJDKd2yx7bZ4h/YNeMF0nAQBc2Yoy1fvLVwD9b'),
(12, 'A', 'Sahan ', 'Dilshan', 'No:149', '11020', '0763960868', 'admin0@gmail.com', '1234'),
(13, 'C', 'a', 'b', 'b', '123', '55555555', 'customer2@gmail.com', '1234'),
(18, 'C', 'Jackie', 'Chan', 'Mauritius', '23332', '51723777', 'jackie@gmail.com', '12345'),
(19, 'C', 'Jean', 'Paulliene', 'surinam', '51122', '57645132', 'customer@gmail.com', '$2y$10$RTB9yDJDKd2yx7bZ4h/YNeMF0nAQBc2Yoy1fvLVwD9b'),
(23, 'C', 'Jeanette', 'Paulliene', 'surinam', '51122', '57645132', 'jeanette@gmail.com', '$2y$10$ZabYNymbYwpNX0Ii13OdI.q2MEOdEHwXtysNg8SV/ej'),
(25, 'C', 'kavish', 'dawtal', 'riv du rempart', '54321', '57645132', 'kavish@gmail.com', '$2y$10$Do0rWHKfX2BHenDXNxEibOMcmX1/z.jZeX4/n/Yg8ob/ROESyHWrS'),
(26, 'C', 'Harikumar', 'Ramphul', ' New Grove', '51222', '57645132', 'ramphul@gmail.com', '$2y$10$YOf/TQ2e6fPxpe//rzlvdOUvtEad3ZCZ8pdv9Va9GZj/Fp43o3D4m'),
(27, 'A', 'admin', 'administer', 'surinam', '51122', '57645132', 'admin@gmail.com', '$2y$10$GkqPj9FyTQCx.IZ1tUpaMOMGyVlwosr/fR7I1JmE7wUioDA9nP1aK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderNo`),
  ADD UNIQUE KEY `orderNo` (`orderNo`),
  ADD KEY `fk_user` (`userId`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`orderNo`,`prodId`),
  ADD KEY `orderNo` (`orderNo`),
  ADD KEY `orderNo_2` (`orderNo`),
  ADD KEY `prodId` (`prodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`proId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `oderNo` (`orderNo`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderNo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `proId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_line_ibfk_1` FOREIGN KEY (`orderNo`) REFERENCES `orders` (`orderNo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_line_ibfk_2` FOREIGN KEY (`prodId`) REFERENCES `product` (`proId`) ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`orderNo`) REFERENCES `orders` (`orderNo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
