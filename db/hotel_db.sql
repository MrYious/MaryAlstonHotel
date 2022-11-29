-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 07:05 AM
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
  `children` int(2) NOT NULL,
  `adult` int(2) NOT NULL,
  `guests` int(2) NOT NULL,
  `specialRequests` varchar(500) DEFAULT NULL,
  `costFirst` varchar(15) NOT NULL,
  `costSecond` varchar(15) NOT NULL,
  `costTotal` varchar(15) NOT NULL,
  `amountPaid` varchar(15) DEFAULT NULL,
  `bookingStatus` varchar(20) NOT NULL DEFAULT 'Pending',
  `inTime` varchar(50) DEFAULT NULL,
  `outTime` varchar(50) DEFAULT NULL,
  `costAdditional` varchar(15) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_tbl`
--

INSERT INTO `booking_tbl` (`id`, `transactionCode`, `guest_id`, `roomCode`, `inDate`, `outDate`, `nights`, `children`, `adult`, `guests`, `specialRequests`, `costFirst`, `costSecond`, `costTotal`, `amountPaid`, `bookingStatus`, `inTime`, `outTime`, `costAdditional`, `createdAt`) VALUES
(1, '63723580207fa-1', 1, 0, '2022-11-15', '2022-11-19', 4, 0, 2, 2, '', '2,500.00', '6,000.00', '8,500.00', '5,000.00', 'Expired', 'Tue Nov 15 2022 20:27:04 GMT+0800 (Singapore Stand', NULL, NULL, '2022-11-14 12:33:04'),
(2, '63724c1f284d7-2', 2, 1, '2022-11-15', '2022-11-17', 2, 1, 1, 2, '', '1,800.00', '1,200.00', '3,000.00', '3,000.00', 'Completed', 'Tue Nov 15 2022 15:09:57 GMT+0800 (Singapore Stand', 'Wed Nov 16 2022 17:10:22 GMT+0800 (Singapore Stand', NULL, '2022-11-14 14:09:35'),
(3, '63724c914c83a-3', 3, 2, '2022-11-17', '2022-11-20', 3, 0, 2, 2, '', '1,800.00', '2,400.00', '4,200.00', '2,500.00', 'Expired', NULL, NULL, NULL, '2022-11-14 14:11:29'),
(4, '63724d755b10f-4', 4, 3, '2022-11-20', '2022-11-22', 2, 2, 3, 5, '', '2,800.00', '2,500.00', '5,300.00', NULL, 'Declined', NULL, NULL, NULL, '2022-11-14 14:15:17'),
(5, '63725018de3e7-5', 5, 0, '2022-11-29', '2022-12-01', 2, 0, 2, 2, '', '2,500.00', '2,000.00', '4,500.00', '2,500.00', 'Rescheduled', NULL, NULL, NULL, '2022-11-14 14:26:32'),
(6, '637390c2c70e8-6', 6, 0, '2022-11-22', '2022-11-25', 3, 0, 1, 1, '', '2,500.00', '2,000.00', '4,500.00', '4,500.00', 'Completed', 'Wed Nov 23 2022 11:28:00 GMT+0800 (Singapore Stand', 'Wed Nov 23 2022 11:28:09 GMT+0800 (Singapore Stand', NULL, '2022-11-15 13:14:42'),
(7, '6374451f9da4d-7', 7, 0, '2022-11-19', '2022-11-21', 2, 0, 1, 1, '', '2,500.00', '1,000.00', '3,500.00', '1,800.00', 'Expired', NULL, NULL, NULL, '2022-11-16 02:04:15'),
(8, '637445d0d9b6a-8', 8, 4, '2022-11-17', '2022-11-20', 3, 1, 1, 2, '', '2,800.00', '2,000.00', '4,800.00', '2,400.00', 'Expired', NULL, NULL, NULL, '2022-11-16 02:07:12'),
(9, '6374a7342c224-9', 9, 2, '2022-12-13', '2022-12-17', 4, 0, 2, 2, '', '1,800.00', '3,600.00', '5,400.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-16 09:02:44'),
(10, '6374d5237f1ad-10', 10, 1, '2022-11-19', '2022-11-22', 3, 0, 1, 1, '', '1,800.00', '1,200.00', '3,000.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-16 12:18:43'),
(11, '6374fd904c7f1-11', 11, 3, '2022-11-17', '2022-11-22', 5, 3, 2, 5, '', '2,800.00', '10,000.00', '12,800.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-16 15:11:12'),
(12, '63750325462ca-12', 12, 2, '2022-12-01', '2022-12-03', 2, 0, 2, 2, '', '1,800.00', '1,200.00', '3,000.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-16 15:35:01'),
(13, '6375051617440-13', 13, 3, '2022-11-30', '2022-12-03', 3, 0, 4, 4, '', '2,800.00', '4,000.00', '6,800.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-16 15:43:18'),
(14, '637df417d9089-14', 14, 0, '2022-11-24', '2022-11-25', 1, 0, 2, 2, '', '2,500.00', '0.00', '2,500.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-23 10:21:11'),
(15, '637df9a6541c2-15', 15, 1, '2022-11-24', '2022-11-26', 2, 0, 2, 2, '', '1,800.00', '1,200.00', '3,000.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-23 10:44:54'),
(16, '637e002a0be45-16', 16, 2, '2022-11-24', '2022-11-27', 3, 0, 2, 2, '', '1,800.00', '2,400.00', '4,200.00', NULL, 'Expired', NULL, NULL, NULL, '2022-11-23 11:12:42'),
(17, '6384a31f46367-17', 17, 0, '2022-12-09', '2022-12-11', 2, 0, 2, 2, '', '2,500.00', '2,000.00', '4,500.00', '5,000.00', 'Pending', NULL, NULL, NULL, '2022-11-28 12:01:35');

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

--
-- Dumping data for table `guest_tbl`
--

INSERT INTO `guest_tbl` (`id`, `firstname`, `lastname`, `birthdate`, `fromTua`, `email`, `mobileNo`, `createdAt`) VALUES
(1, 'Mark Edison', 'Rosario', '2001-09-30', 'Yes', 'rosariomark37@gmail.com', '09322831860', '2022-11-14'),
(2, 'Arthur', 'Leywin', '1997-07-14', 'No', 'rosariomark37@gmail.com', '09561425142', '2022-11-14'),
(3, 'Tessia', 'Eralith', '1989-10-21', 'No', 'rosariomark37@gmail.com', '09561234587', '2022-11-14'),
(4, 'EDIE', 'ROSARIO', '1999-10-30', 'No', 'rosariomark37@gmail.com', '09651245142', '2022-11-14'),
(5, 'Jeremy', 'Cube', '1998-10-12', 'Yes', 'rosariomark37@gmail.com', '09322845162', '2022-11-14'),
(6, 'Piolo', 'Jizmundo', '1987-06-12', 'Yes', 'rosariomark37@gmail.com', '09321542612', '2022-11-15'),
(7, 'Jec', 'Tacata', '2000-06-18', 'No', 'rosariomark37@gmail.com', '09325142514', '2022-11-16'),
(8, 'John', 'Manicar', '1997-07-07', 'Yes', 'rosariomark37@gmail.com', '09325412545', '2022-11-16'),
(9, 'Arvin', 'Patao', '1996-03-14', 'Yes', 'rosariomark37@gmail.com', '09325412451', '2022-11-16'),
(10, 'Benedict ', 'Barnacle', '2001-03-04', 'Yes', 'rosariomark37@gmail.com', '09265514251', '2022-11-16'),
(11, 'Windson', 'Luther', '2005-05-05', 'No', 'rosariomark37@gmail.com', '09512451241', '2022-11-16'),
(12, 'Angelo', 'Isaac', '2001-01-10', 'No', 'rosariomark37@gmail.com', '09351245124', '2022-11-16'),
(13, 'William', 'Dew', '2000-02-02', 'Yes', 'rosariomark37@gmail.com', '09351245124', '2022-11-16'),
(14, 'Mark Edison', 'Rosario', '2001-09-30', 'Yes', 'rosariomark37@gmail.com', '09322831860', '2022-11-23'),
(15, 'Barnadict', 'Barnacles', '2000-10-10', 'No', 'rosariomark37@gmail.com', '09564125412', '2022-11-23'),
(16, 'Kyle', 'Deinyel', '2002-02-02', 'Yes', 'rosariomark37@gmail.com', '09526415214', '2022-11-23'),
(17, 'Mark Edison', 'Rosario', '2001-09-30', 'Yes', 'rosariomark37@gmail.com', '09322831860', '2022-11-28');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `guest_tbl`
--
ALTER TABLE `guest_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
