-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 02:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `username`, `password`) VALUES
(1, 'admin', 'f5bb0c8de146c67b44babbf4e6584cc0');

-- --------------------------------------------------------

--
-- Table structure for table `booking_tbl`
--

CREATE TABLE `booking_tbl` (
  `id` int(10) NOT NULL,
  `transactionCode` varchar(40) NOT NULL,
  `guest_id` int(10) NOT NULL,
  `roomCode` int(2) NOT NULL,
  `inDate` date NOT NULL,
  `outDate` date NOT NULL,
  `nights` int(3) NOT NULL,
  `guests` int(2) NOT NULL,
  `specialRequests` varchar(500) DEFAULT NULL,
  `costFirst` varchar(15) NOT NULL,
  `costSecond` varchar(15) NOT NULL,
  `costTotal` varchar(15) NOT NULL,
  `amountPaid` varchar(15) DEFAULT NULL,
  `bookingStatus` varchar(20) NOT NULL DEFAULT 'Pending',
  `inTime` varchar(100) DEFAULT NULL,
  `outTime` varchar(100) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guest_tbl`
--

CREATE TABLE `guest_tbl` (
  `id` int(10) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `fromTua` varchar(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileNo` varchar(15) NOT NULL,
  `createdAt` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `id` int(5) NOT NULL,
  `channel1` varchar(500) DEFAULT NULL,
  `channel2` varchar(500) DEFAULT NULL,
  `channel3` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`id`, `channel1`, `channel2`, `channel3`) VALUES
(1, '{\"name\":\"Juan Dela Cruz\",\"number\":\"09325124512\",\"type\":\"GCASH\"}', '{\"name\":\"Juana Dela Cruz\",\"number\":\"1524251512465\",\"type\":\"BDO ACCOUNT\"}', '{\"name\":\"Juan Del Criz\",\"number\":\"1655432135146512\",\"type\":\"UNIONBANK ACCOUNT\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_tbl`
--
ALTER TABLE `guest_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_tbl`
--
ALTER TABLE `booking_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_tbl`
--
ALTER TABLE `guest_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
