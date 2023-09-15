-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 15, 2023 at 07:11 AM
-- Server version: 8.0.32
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moduleconnexionb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `firstname`, `lastname`, `password`) VALUES
(3, 'D&d20', 'Douglas', 'Adamss', '$2y$10$2Z7ASUMkeJwfrGZr1kRz/O5RPJyUwpLDbzKQ/y8lCij.uzGr3lWGa'),
(4, 'Noworkin', 'Nono', 'Working', '$2y$10$n1VYSfpw5CZMUffjVKHdveVH7akcDVjPZsvHEqavZShGxV4b5M21G'),
(6, 'admiN1337$', 'admiN1337$', 'admiN1337$', '$2y$10$8zHLXLNWJYpzDTOEoplRoe1k/soXn6uXSJPaiDGlo.BqX9mV0mgIW'),
(7, 'DamnDaniel', 'Daniel', 'Damn', '$2y$10$pBzFKSMBNq1apK0z9HG5tun1oQcU6JqvNQ17SvroN/KmDkappof9a'),
(10, 'NonoSquare', 'Nono', 'Square', '$2y$10$EiHKUnPbuNS.ys6lFgnDrudq/6.vjVZYmrVOMYo223XrVTYRt6iZ6'),
(13, 'App', 'App', 'App', '$2y$10$f0EbPBmeDfmjVYeK.fLK3ecvQ9fRufKblyWxp7gsZvrX6fa4fcGae'),
(14, 'Leeloo5', 'Leeloo', 'Dallas', '$2y$10$xZkmHncIRwv3zwTolU0P2uWD1KyQl2E0f8QwjI0YA7XtyiRiqY5B2'),
(15, 'Help', 'H', 'Elp', '$2y$10$YDC1DICLs8o.vVYHWxjAR.iCw8Q865Lx/XbUm4czrkfeL49/reT0u'),
(16, 'aA', 'aaa', 'a', '$2y$10$qmRxD0as0uKSNKC9CTzHtOEtuHezVKvvl30xuDuRDATkeDbFSOcXW'),
(17, 'Hey', 'Does it', 'Work', '$2y$10$F/d3Z//ERZQg4G50WMMMrOjXjkzg41zTGLWNkGC.jnC7KK.hlSTxC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
