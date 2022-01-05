-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 03:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tizo`
--

-- --------------------------------------------------------

--
-- Table structure for table `secrets`
--

CREATE TABLE `secrets` (
  `id` int(25) NOT NULL,
  `key_name` varchar(255) NOT NULL,
  `key_value` longtext DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secrets`
--

INSERT INTO `secrets` (`id`, `key_name`, `key_value`, `status`, `created`) VALUES
(2, 'secret_key', 'secret_value', 0, '2022-01-04 13:30:45'),
(3, 'secret_key_2', 'secret_key_2', 0, '2022-01-04 13:31:54'),
(4, 'MYSECRET', 'MYSECRET', 1, '2022-01-04 14:12:18'),
(5, 'NEWSECRET', 'NEWSECRET', 0, '2022-01-04 14:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `secrets_services`
--

CREATE TABLE `secrets_services` (
  `id` int(25) NOT NULL,
  `secret_id` int(25) NOT NULL DEFAULT 0,
  `service_id` int(25) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secrets_services`
--

INSERT INTO `secrets_services` (`id`, `secret_id`, `service_id`) VALUES
(4, 3, 6),
(5, 3, 8),
(9, 4, 5),
(10, 4, 6),
(16, 5, 2),
(17, 5, 7),
(18, 5, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `secrets`
--
ALTER TABLE `secrets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secrets_services`
--
ALTER TABLE `secrets_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `secrets`
--
ALTER TABLE `secrets`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `secrets_services`
--
ALTER TABLE `secrets_services`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
