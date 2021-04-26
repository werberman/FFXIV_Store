-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 11:09 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `products_all`
--

CREATE TABLE `products_all` (
  `item_index` int(5) NOT NULL,
  `item_name` varchar(40) NOT NULL DEFAULT '0',
  `item_rating` char(1) NOT NULL DEFAULT '0',
  `item_price` decimal(7,2) DEFAULT 0.00,
  `item_img_dir` varchar(80) NOT NULL,
  `item_desc` varchar(120) NOT NULL,
  `item_is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `item_banner_img_dir` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_all`
--

INSERT INTO `products_all` (`item_index`, `item_name`, `item_rating`, `item_price`, `item_img_dir`, `item_desc`, `item_is_featured`, `item_banner_img_dir`) VALUES
(1, 'Eden\'s Promise: Umbra (Savage)', '4', '400.00', '', 'E9S - Cloud of Darkness', 0, ''),
(2, 'Test', '5', '123.00', 'imgs/test.jpg', 'Test testy test test test', 1, ''),
(3, 'Castrum Marinum Mount (10 Runs)', '4', '100.00', 'imgs/castrum_marinum_mount.png', 'Mount from Castrum Marinum. Price includes 10 runs. Can drop any time, but only guaranteed after 100.', 1, ''),
(5, 'Eden\'s Promise: Litany (Savage)', '4', '400.00', 'imgs/e9s-e12s_e10.jpg', 'E10S', 0, ''),
(6, 'Eden\'s Promise: Anamorphosis (Savage)', '4', '400.00', 'imgs/e9s-e12s_e11.jpg', 'E11S', 0, ''),
(7, 'Eden\'s Promise: Eternity (Savage)', '5', '400.00', 'imgs/e9s-e12s_e12.jpg', 'E12S', 0, ''),
(8, 'Bozja (Extreme)', '5', NULL, 'imgs/bozja_bozja_item_img.jpg', 'Change this value later - ask Subbz', 0, ''),
(9, 'Savage Bundle (E5S - E8S)', '5', '200.00', 'imgs/shadowbringers_e5s-e8s.png', 'Shadowbringers Savage Raids (E5S - E8S)', 0, 'imgs/banner_shadowbringers_e5s-e8s.png'),
(10, 'Eden\'s Verse: Fulmination (Savage)', '5', '75.00', 'imgs/shadowbringers_e5s.png', 'E5S - Ramuh', 0, 'imgs/banner_shadowbringers_e5s.png'),
(11, 'Eden\'s Verse: Furor (Savage)', '4', '75.00', 'imgs/shadowbringers_e6s.jpg', 'E6S - Garuda and Ifrit', 0, 'imgs/banner_shadowbringers_e6s.png'),
(12, 'Eden\'s Verse: Iconoclasm (Savage)', '2', '75.00', 'imgs/shadowbringers_e7s.jpg', 'E7S - The Idol of Darkness', 0, 'imgs/banner_shadowbringers_e7s.png'),
(13, 'Eden\'s Verse: Refulgence (Savage)', '5', '75.00', 'imgs/shadowbringers_e8s.jpg', 'E8S - Shiva', 1, 'imgs/banner_shadowbringers_e8s.jpg'),
(14, 'UCOB', '3', '500.00', 'imgs/ultimates_ucob.jpg', 'The Unending Coil of Bahamut (Ultimate)', 0, 'imgs/banner_ultimates_ucob.jpg'),
(15, 'UWU', '4', '500.00', 'imgs/ultimates_UWU.jpg', 'The Weapon\'s Refrain (Ultimate)', 0, 'imgs/banner_ultimates_uwu.jpg'),
(16, 'TEA', '5', '500.00', 'imgs/ultimates_tea.jpg', 'The Epic of Alexander (Ultimate)', 0, 'imgs/banner_ultimates_tea.jpg'),
(17, 'Test2', '1', '99.99', 'imgs/test.jpg', 'Second test', 0, 'test.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_all`
--
ALTER TABLE `products_all`
  ADD PRIMARY KEY (`item_index`),
  ADD UNIQUE KEY `item_index` (`item_index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_all`
--
ALTER TABLE `products_all`
  MODIFY `item_index` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
