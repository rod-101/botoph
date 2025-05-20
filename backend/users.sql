-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 05:06 PM
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
-- Database: `botoph`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'voter',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(200) NOT NULL,
  `birthdate` datetime NOT NULL,
  `region` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `first_name`, `last_name`, `middle_name`, `email`, `password_hash`, `birthdate`, `region`, `province`, `created_at`) VALUES
(1, 'admin', 'Rodjones', 'Rosalinda', 'Opiña', 'rodjonesrosalinda@gmail.com', '$2y$10$aLlUDp0w4ngMKnNLfUrBJOcXpIeKlI7sPEwnH2fBikfKAmW5E98d2', '2005-01-17 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-18 22:43:18'),
(2, 'voter', 'Allan', 'Esteves', '', 'allan@gmail.com', '$2y$10$IFkJoXs8MPoA28ZdfgYH0OO1byD.8uJjczUVJf4t0rqWKdFBFdrde', '2005-03-21 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-19 22:43:18'),
(3, 'voter', 'Cindy', 'Salazar', '', 'cindy@gmail.com', '$2y$10$A30qweersbUsl7LcFH70GuG94wQjP49yYGRDHLjRnNkyNjxtqK5Wa', '2004-10-13 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-19 22:43:18'),
(4, 'voter', 'Edrich', 'Valera', 'Magdongon', 'edrich@gmail.com', '$2y$10$qtiSvkZtfJ6RFXnDoA8K8eOq7VeejNndRJBTCIUnsM8.w3uqULKaq', '2006-07-27 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-20 22:45:12'),
(5, 'voter', 'Ramon', 'Ramirez', '', 'ramon@gmail.com', '$2y$10$9bJFpaNWfcWdbPR8azrwRe7Ran/v5qDfke5aZ2BcI.SUJhXRRJj/i', '2003-07-15 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-20 22:47:28'),
(6, 'voter', 'James', 'Felicitas', '', 'james@gmail.com', '$2y$10$tYMISm5JV9JN8fHaIa6Fee1I6Vrs3gQAceyO1tISoMfDG.9Ar1FAm', '2005-02-06 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-20 22:49:12'),
(7, 'voter', 'Nicole', 'Belarmino', '', 'nicole@gmail.com', '$2y$10$kP1xwFbLLUz/jUj/8tS6texy7L.KHRjt/vJyEUEzcbdmkoiiSsbA2', '2005-02-22 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-21 22:50:24'),
(8, 'voter', 'Chevy', 'Hernandez', '', 'chevy@gmail.com', '$2y$10$cHBVAm8ZDYfTNx2yas1.LOzTxnklzMDPw8dpd/irBhE8SeR2pyWha', '2005-04-27 00:00:00', 'MIMAROPA', 'Occidental Mindoro', '2025-05-21 22:53:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
