-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 09:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `week_2_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `recorder_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(7, 'Ellis', 'e@g.c', '$2y$10$1cf36I7pBx2hOMzUJRtWu.N5CiwgV/R2tdCDz7Lab5eK.5oMZlO0a', '2026-02-03 06:31:51'),
(8, 'Ellis', 'ells@g.c', '$2y$10$Wi8.ZrMbq48PvsuohhMBXuhTQCIWJPZKjvPSQpJ7S5IqW3oeiSWIe', '2026-02-04 03:29:55'),
(9, 'jaryl', 'j@g.c', '$2y$10$jNxHIO/QV291uKtL3wajZeuZd3IjHK0nuBWDAxJ7pqE8o6l5cbH0a', '2026-02-04 05:23:39'),
(10, 'Mike', 'm@g.c', '$2y$10$upQfOPmwm2O7O0p3fyplQ.NCZ.d5EfsFRQ4/POnem4NDzdyUSLU6q', '2026-02-04 05:27:01'),
(11, 'John', 'j2@g.c', '$2y$10$.WrtDqYDi/O2bjkiVfoL/u3YibYx3qd1C27sJvlGVs/u6NwuJB04O', '2026-02-04 05:28:34'),
(12, 'ray', 'ray@co', '$2y$10$viMbAAlXIwu7qTn6cpvnSOfQcACRS46JhTKvpzUPtmWI4WQitDAZu', '2026-02-04 07:48:16'),
(13, 'Ray Co', 'rayco@gmail.com', '$2y$10$yzwxxxVT/guR3Z3GzbUv0uUpX09q19lXZSX5tYj8dYAVappx7jzrK', '2026-02-04 08:15:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
