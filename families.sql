-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2020 at 03:37 PM
-- Server version: 8.0.20-0ubuntu0.19.10.1
-- PHP Version: 7.3.11-0ubuntu0.19.10.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `families`
--

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int NOT NULL,
  `family_members` varchar(150) NOT NULL,
  `age` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `family_members`, `age`) VALUES
(1, 'John Doe', '34'),
(2, 'Mr Brad', '30'),
(3, 'Mr Brian', '27'),
(4, 'Mr Virat Kohli', '32'),
(5, 'Mr Jonathon', '30');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` int NOT NULL,
  `occupation` varchar(150) NOT NULL,
  `work_place` varchar(150) NOT NULL,
  `family_member` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`id`, `occupation`, `work_place`, `family_member`) VALUES
(1, 'Software Developer', 'USA', '1'),
(2, 'Android Developer', 'UK', '2'),
(3, 'Marketing Expert', 'USA', '3'),
(4, 'Cricketer', 'India', '4'),
(5, 'ML Engineer', 'Canada', '5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
