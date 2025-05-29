-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 11:47 AM
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
-- Database: `prodtrack-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailOrUserID` varchar(100) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `emailOrUserID`, `passwordHash`, `createdAt`, `role`) VALUES
(1, 'Andrei Christopher', 'Carillo', 'darkandrei26@gmail.com', '$2y$10$Oc/v/LlaqFaklK/Gp2qepOYkq5Hh5smAdz15GTQnQg2eokWdqIGBy', '2025-05-29 01:15:08', 'user'),
(2, 'Justine James', 'Prades', 'test12@gmail.com', '$2y$10$7jzVGtEentPk9fxSqbWd8uXbV4FT8ODZ8Bft9.edT/vgT64S1Su8O', '2025-05-29 12:51:55', 'user'),
(3, 'Bryan', 'Dagooc', 'test02@gmail.com', '$2y$10$TCdRuh.rmcxTf3ExLEeeMunQmOagOuMR.bAVy3oP57N4q6T/C2yPS', '2025-05-29 14:13:35', 'user'),
(4, 'Andrei Christopher', 'Carillo', 'test123@gmail.com', '$2y$10$SddCH1csHQqg/ptcWd9pBuHidnZcsVCVTML1iXcbl/QvkaxTDaPuW', '2025-05-29 17:39:23', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailOrUserID` (`emailOrUserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
