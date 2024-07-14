-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 04:09 PM
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
-- Database: `bbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'Mayesha', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `contact_id` int(11) NOT NULL,
  `contact_address` varchar(100) NOT NULL,
  `contact_mail` varchar(50) NOT NULL,
  `contact_phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`contact_id`, `contact_address`, `contact_mail`, `contact_phone`) VALUES
(1, '12/ Banashree,dhaka', '01718945116', 'mayesha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact_query`
--

CREATE TABLE `contact_query` (
  `query_id` int(11) NOT NULL,
  `query_name` varchar(100) NOT NULL,
  `query_mail` varchar(120) NOT NULL,
  `query_number` char(11) NOT NULL,
  `query_message` longtext NOT NULL,
  `query_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `query_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_query`
--

INSERT INTO `contact_query` (`query_id`, `query_name`, `query_mail`, `query_number`, `query_message`, `query_date`, `query_status`) VALUES
(1, 'Tasmiah', 'tasmiah@gmail.com', 'o1599234710', 'I need O+ Blood.', '2024-07-01 14:00:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `donor_details`
--

CREATE TABLE `donor_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donor_details`
--

INSERT INTO `donor_details` (`id`, `name`, `blood_group`, `contact`, `email`, `address`, `age`) VALUES
(1, 'Aumiya Iqbal', 'A+', '01533616467', 'aumiya69@gmail.com', '23/D ,Mirpur', 26),
(2, 'Tasmiah binte ', 'O+', '01632187774', 'tasmiah@21gmail.com', '273,dhanmondi', 23),
(3, 'Fahad', 'B+', '01234567890', 'shahriahossainarafat+1@gmail.com', 'Mirpur', 28),
(4, 'Shathi', 'B+', '01234567899', 'shahriahossainarafat+3@gmail.com', 'Malibagh', 26),
(5, 'Rahim', 'AB+', '01234567888', 'shahriahossainarafat+4@gmail.com', 'Mirpur 2', 23),
(6, 'Rahim', 'AB+', '01234567888', 'shahriahossainarafat+4@gmail.com', 'Mirpur 2', 23),
(10, 'Rahim', 'AB+', '01234567888', 'shahriahossainarafat+4@gmail.com', 'Mirpur 2', 23),
(11, 'Rahim', 'AB+', '01234567888', 'shahriahossainarafat+4@gmail.com', 'Mirpur 2', 23),
(12, 'Fahad', 'O+', '01956990517', 'shahriahossainarafat+9@gmail.com', 'banasree', 24),
(13, 'ShathiSA', 'A+', '01234567888', 'shahriahossainarafat+30@gmail.com', 'Malibagh Mor', 29),
(14, 'ShathiSA1', 'A+', '01234567890', 'shahriahossainarafat+3@gmail.com', 'Adabor', 33),
(15, 'Shahriar', 'O-', '01999990517', 'shahriahossainarafat+3@gmail.com', 'Siddeshwari Kalimondir', 24);

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query` text NOT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`id`, `user_id`, `query`, `status`) VALUES
(1, 1, 'How to donate blood?', 'pending'),
(2, 2, 'What are the eligibility criteria?', 'resolved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `donor_details`
--
ALTER TABLE `donor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donor_details`
--
ALTER TABLE `donor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
