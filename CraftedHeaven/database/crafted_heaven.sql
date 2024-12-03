-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 08:33 AM
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
-- Database: `crafted_heaven`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindetails`
--

CREATE TABLE `admindetails` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mnumber` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admindetails`
--

INSERT INTO `admindetails` (`fname`, `lname`, `mnumber`, `email`, `password`, `id`, `image`) VALUES
('admin', 'admin1', 5656, 'admin1@gmail.com', '123', 1, 'Premium Vector _ Man profile cartoon.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `productid`, `userid`, `status`) VALUES
(1, 23, 0, ''),
(2, 23, 7, ''),
(3, 22, 7, ''),
(4, 23, 9, 'ordered'),
(5, 22, 9, 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `drafts`
--

CREATE TABLE `drafts` (
  `id` int(11) NOT NULL,
  `sitting` varchar(255) DEFAULT NULL,
  `leg` varchar(255) DEFAULT NULL,
  `frame` varchar(255) DEFAULT NULL,
  `mat` varchar(255) DEFAULT NULL,
  `pillow` varchar(255) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drafts`
--

INSERT INTO `drafts` (`id`, `sitting`, `leg`, `frame`, `mat`, `pillow`, `userid`) VALUES
(40, 'sitting3', 'leg2', 'frame2', 'mat2', 'pillow2', 9),
(42, 'sitting3', 'leg3', 'frame2', 'mat2', 'pillow2', 7),
(43, 'sitting3', 'leg3', 'frame1', 'mat1', 'pillow2', 7);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `requestid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `confirmation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `sellerid`, `userid`, `requestid`, `price`, `confirmation`) VALUES
(2, 1, 7, 8, 1, 'confirmed'),
(4, 1, 9, 10, 29, ''),
(5, 1, 9, 10, 29, ''),
(14, 1, 7, 9, 8, ''),
(15, 1, 7, 9, 1, 'confirmed'),
(18, 1, 9, 10, 1, ''),
(20, 0, 9, 10, 6, ''),
(21, 0, 9, 10, 7, ''),
(22, 2, 9, 10, 12, ''),
(23, 0, 7, 9, 9, ''),
(24, 2, 7, 8, 11, 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` int(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `sellerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `sellerid`) VALUES
(22, 'asd', 'sadss', 12, 'product-3.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `design_id` int(11) NOT NULL,
  `leg` varchar(50) DEFAULT NULL,
  `mat` varchar(50) DEFAULT NULL,
  `sitting` varchar(255) DEFAULT NULL,
  `frame` varchar(50) DEFAULT NULL,
  `pillow` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `design_id`, `leg`, `mat`, `sitting`, `frame`, `pillow`, `created_at`, `userid`) VALUES
(8, 42, 'leg3', 'mat2', 'sitting3', 'frame2', 'pillow2', '2024-11-25 16:52:30', 7),
(9, 43, 'leg3', 'mat1', 'sitting3', 'frame1', 'pillow2', '2024-11-25 16:55:40', 7),
(10, 40, 'leg2', 'mat2', 'sitting3', 'frame2', 'pillow2', '2024-11-25 16:59:22', 9);

-- --------------------------------------------------------

--
-- Table structure for table `sellerdetails`
--

CREATE TABLE `sellerdetails` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mnumber` int(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL,
  `company` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellerdetails`
--

INSERT INTO `sellerdetails` (`id`, `fname`, `lname`, `email`, `mnumber`, `password`, `image`, `company`) VALUES
(1, 'kawi', 'bandara', 'kawiyadesigner@gmail.com', 77773773, '123', 'Premium Vector _ Man profile cartoon.jpeg', 'seetha'),
(2, 'sellers', 'asd', 'seller@gmail.com', 5656, '123', 'default.jpeg', 'arpico');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(30) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mnumber` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `fname`, `lname`, `mnumber`, `email`, `password`, `image`) VALUES
(10, 'kawishka', 'bandara', '5656', 'kawiyadesigner@gmail.com', '123', 'Premium Vector _ Man profile cartoon.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindetails`
--
ALTER TABLE `admindetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drafts`
--
ALTER TABLE `drafts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindetails`
--
ALTER TABLE `admindetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drafts`
--
ALTER TABLE `drafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
