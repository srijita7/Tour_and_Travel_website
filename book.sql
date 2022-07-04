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
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `location` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `guests` int NOT NULL,
  `departure_date` date NOT NULL,
  `return_date` date NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `username`, `name`, `email`, `phone`, `order_date`, `location`, `grade`, `guests`, `departure_date`, `return_date`, `price`) VALUES
(14, 'sri', 'Shreenandini Patel', 'sri@gmail.com', 2147483647, '2022-07-02 12:57:32', 'Seoul', 'tourist', 2, '2022-07-27', '2022-07-29', 180),
(13, 'hhh', 'Steven Stark', 'ssak@gmail.comm', 2147483647, '2022-07-03 03:28:08', 'Paris', 'standard', 3, '2022-07-27', '2022-07-30', 270),
(3, 'hhh', 'dff', 'sdg@gmail.com', 1234567890, '2022-06-07 12:47:18', 'Mumbai', 'tourist', 2, '2022-06-07', '2022-06-11', 180),
(12, 'hhh', 'Steven Stark', 'ssak@gmail.com', 2147483647, '2022-07-02 12:38:37', 'Mumbai', 'tourist', 2, '2022-07-09', '2022-07-16', 180),
(8, 'sri', 'dff', 'abc@gmail.com', 1234567890, '2022-06-17 23:58:39', 'Mumbai', 'tourist', 1, '2022-06-17', '2022-06-17', 90),
(6, 'hhh', 'Shreyashnandini Harsh Patel dsvbsgbs', 'cassandrajenkins123kgkgkuhkhkhlihli@gmail.com', 1234567890, '2022-06-17 23:49:42', 'Mumbai', 'tourist', 6, '2022-06-17', '2022-06-30', 540),
(15, 'hhh', 'oil', 'abc@gmail.com', 1234567890, '2022-07-03 13:02:15', 'Paris', 'superior tourist', 2, '2022-07-03', '2022-07-22', 180);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
