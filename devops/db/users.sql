-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:9999
-- Generation Time: Apr 19, 2023 at 06:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybd`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `fname`, `lname`) VALUES
(7, '11', '$2y$10$ZYRJ.DJMZ4UcC8GR2sMezO3kEyiWhhp8woUdLfe5xG3wHZcw9aEE2', '121@email.com', NULL, NULL),
(8, 'se', '$2y$10$mM/w1KzmrrOvoZNu2uYeg.dJEyI3yNbfF2cifwk5k4ZOOjZwtUgwm', 'aroun@a.com', NULL, NULL),
(9, 'se2', '$2y$10$8Eg7AE5l33OTHW/eE4Xnw.DiBrKUcyM9cvwfW2Pk/S1bP75IXf7LK', 'aroun@a.com11', NULL, NULL),
(10, 'select*from users;', '$2y$10$ZPxMMWeEEDOxc8gQypeM3.PYeqh/Go2a6XC.mdPuSn.4ZhD3kgLgK', 'aroun@a.com1122', NULL, NULL),
(11, 'select*from  users;', '$2y$10$wflxie7kRE05m0rHLdLvZuHYz9GQieyFtzz5BSP7poPXQWlPAOLxG', 'aroun@a.com112212', NULL, NULL),
(12, 'drop table if exists users;', '$2y$10$/zGweC6CwoI9VAkpSQYbKO1q0Oz1B9OwCDmkmWXJNkSaK26zcNgs.', 'aroun@a.com11221212', NULL, NULL),
(13, 'stefan', '$2y$10$LiZhANKmRjeL6QwPQXJHf.ZxAFHn57CcMZl8Dch74zGOXD4Gx3bGa', 'stefan@gmai.com', NULL, NULL),
(14, 'costica123', '$2y$10$EFT04vjGE4qANYj.TOX.KepY3u7BaKN/pzjB2BVpCAe9KqoTHJ0Jy', 'costica@email.com', NULL, NULL),
(15, '', '$2y$10$wKHGWgQxFrNXGlx2TFHN5ewV5FaddIndArzdQiQG4kSN5u55m0tm.', '', NULL, NULL),
(16, 'mihai', '$2y$10$z1DUhQ79X8wVbl5VzjZfNe1iQZeeMdfldeaevLFcNaq/KlEzRhhnO', '123@email.com', NULL, NULL),
(17, 'mihai1', '$2y$10$D64iKrA4W.29XSgeyhVexOGMSywBV.1JV.mIp7hZP9nJ93Dahi74O', '123@email.com1', NULL, NULL),
(18, '1212121', '$2y$10$HuEkvOufvVE3eoiRom/xhuDNwNwqaaodKkDbIRMQBjvsMKPdl7dZu', 'aroun@a.com11221212', '1212', '12121'),
(19, 'mircea', '$2y$10$5f8J3AFINrTJHHy2TbtfhO0RoPCkT0qiv6q7/uEZMjGAmDQIyz1Ku', 'mgeoana@gmail.com', 'Mircea', 'Geona');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
