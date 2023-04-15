-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:9999
-- Generation Time: Apr 15, 2023 at 06:25 PM
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
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(7, '11', '$2y$10$ZYRJ.DJMZ4UcC8GR2sMezO3kEyiWhhp8woUdLfe5xG3wHZcw9aEE2', '121@email.com'),
(8, 'se', '$2y$10$mM/w1KzmrrOvoZNu2uYeg.dJEyI3yNbfF2cifwk5k4ZOOjZwtUgwm', 'aroun@a.com'),
(9, 'se2', '$2y$10$8Eg7AE5l33OTHW/eE4Xnw.DiBrKUcyM9cvwfW2Pk/S1bP75IXf7LK', 'aroun@a.com11'),
(10, 'select*from users;', '$2y$10$ZPxMMWeEEDOxc8gQypeM3.PYeqh/Go2a6XC.mdPuSn.4ZhD3kgLgK', 'aroun@a.com1122'),
(11, 'select*from  users;', '$2y$10$wflxie7kRE05m0rHLdLvZuHYz9GQieyFtzz5BSP7poPXQWlPAOLxG', 'aroun@a.com112212'),
(12, 'drop table if exists users;', '$2y$10$/zGweC6CwoI9VAkpSQYbKO1q0Oz1B9OwCDmkmWXJNkSaK26zcNgs.', 'aroun@a.com11221212'),
(13, 'stefan', '$2y$10$LiZhANKmRjeL6QwPQXJHf.ZxAFHn57CcMZl8Dch74zGOXD4Gx3bGa', 'stefan@gmai.com');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
