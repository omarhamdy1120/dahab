-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2020 at 03:38 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 8.1.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sourcecodester_pmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(2, 'Dr.', 'Fady', 'fady@admin.com', '012', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'dr_av.png'),
(3, 'Eng.', 'Amr', 'amr@admin.com', '012', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'eng_av.png'),
(1, 'Eng.', 'Omar', 'omar@admin.com', '012', 'd4466cce49457cfea18222f5a7cd3573', 'admin', 'omar_av.png');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `salesmans`
--

CREATE TABLE `salesmans` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salesmans`
--

INSERT INTO `salesmans` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `avatar`) VALUES
(9, 'Saif', 'Gad', 'saif@gmail.com', '012', '44c099ff522cd529ade21a9c7aa54ebf', 'salesman', 'saif_av.png'),
(8, 'Ruba', 'Ashraf', 'ruba@gmail.com', '012', '7458f96b989285d0eed13b3df9134930', 'salesman', 'ruba_av.png'),
(7, 'Nourhan', 'Hossam', 'nourhan@gmail.com', '012', '11c89af0c56598298c1631659ff61c01', 'salesman', 'nour_av.png'),
(6, 'Hajer', 'Ghoneim', 'hajer@gmail.com', '012', '8fac8283e71111d126c93fe5d33ca7f1', 'salesman', 'hajer_av.png');

-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--
CREATE TABLE `coins` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `qrt` varchar(60) NOT NULL,
  `half` varchar(60) NOT NULL,
  `one` varchar(60) NOT NULL,
  `five` varchar(60) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `coins` (`id`, `qrt`, `half`, `one`, `five`) VALUES
(1, '45', '45', '45', '41');
-- --------------------------------------------------------

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `ingots`
--
CREATE TABLE `ingots` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `qrtgram` varchar(60) NOT NULL,
  `halfgram` varchar(60) NOT NULL,
  `1gram` varchar(60) NOT NULL,
  `2gram` varchar(60) NOT NULL,
  `5gram` varchar(60) NOT NULL,
  `8gram` varchar(60) NOT NULL,
  `10gram` varchar(60) NOT NULL,
  `15gram` varchar(60) NOT NULL,
  `20gram` varchar(60) NOT NULL,
  `31gram` varchar(60) NOT NULL,
  `50gram` varchar(60) NOT NULL,
  `100gram` varchar(60) NOT NULL,
  `250gram` varchar(60) NOT NULL,
  `500gram` varchar(60) NOT NULL,
  `1000gram` varchar(60) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `ingots` (`id`, `qrtgram`, `halfgram`, `1gram`, `2gram`, `5gram`, `8gram`, `10gram`, `15gram`, `20gram`, `31gram`, `50gram`, `100gram`,`250gram`, `500gram`, `1000gram`) VALUES
(1, '80', '80', '60', '55','55','50','55','45','50','50','42.5','42.5','25','25','24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesmans`
--
ALTER TABLE `salesmans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
--
-- AUTO_INCREMENT for table `salesmans`
--
ALTER TABLE `salesmans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
