-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jul 04, 2022 at 03:35 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `rating` int NOT NULL,
  `review` varchar(999) NOT NULL,
  `profilepic` varchar(200) NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `username`, `name`, `email`, `grade`, `rating`, `review`, `profilepic`, `reviewDate`) VALUES
(62, 'hhh', 'Albert Pinto', 'abc@gmail.com', 'standard', 5, 'Very good service', 'default.png', '2022-07-03 03:27:10'),
(60, 'hhh', 'hen hjj', 'abc@gmail.com', 'comfort', 4, 'hello', 'default.png', '2022-07-01 11:31:12'),
(61, 'hhh', 'hen hjj', 'abc@gmail.com', 'standard', 5, 'excellent', 'bd12f0ccc64dcb9ff1758bbc53e336f11656675156jpg', '2022-07-01 11:32:36'),
(59, 'hhh', 'hen hjj', 'abc@gmail.com', 'superior standard', 3, 'very good service', 'default.png', '2022-07-01 11:29:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
