-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 09:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phptie`
--

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `msg` text NOT NULL,
  `priority` int(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `assigned_by` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('open','closed','resolved','reopened') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `name`, `msg`, `priority`, `file_name`, `email`, `assigned_by`, `created`, `status`) VALUES
(10, 'test00', '', 'sup!!', 0, '', 'prat@gmail.com', 'u@g.com', '2023-07-10 11:35:50', 'open'),
(11, 'test1', '', '๐·° (⋟﹏⋞)°·๐', 0, '', 'prat@gmail.com', 'u@g.com', '2023-07-10 15:57:10', 'resolved'),
(13, 'email', '', 'test', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-11 15:51:23', 'open'),
(17, 'email', '', 'test1', 0, '', 'na21b038@smail.iitm.ac.in', 'pratyushkhengle@gmail.com', '2023-07-11 16:22:21', 'resolved'),
(18, 'test', '', 'email', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-13 12:35:04', 'open'),
(19, 'test 2', '', 'email', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-13 12:41:20', 'open'),
(20, 'test3 ', '', 'email', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-13 15:05:15', 'open'),
(21, 'retest0', '', 'email', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-13 15:18:49', 'open'),
(22, 'email', '', 'test0', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-13 15:20:06', 'open'),
(23, 'pwd-test', '', 'email', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-13 15:31:29', 'open'),
(24, 'name', 'potHead', 'das', 0, '', 'pratyushkhengle@gmail.com', 'na21b038@smail.iitm.ac.in', '2023-07-17 14:47:40', 'open'),
(25, 'test11', 'Pratyush Khengle', '123', 0, '', '', 'na21b038@smail.iitm.ac.in', '2023-07-17 15:00:13', 'open'),
(26, 'test 000', 'Pratyush Khengle', 'lol', 0, '', '', 'na21b038@smail.iitm.ac.in', '2023-07-17 15:27:01', 'open'),
(27, 'mgom', 'user0', '56', 0, '', '', 'pratyushkhengle@gmail.com', '2023-07-18 13:15:42', 'open'),
(28, 'test1112', 'Pratyush Khengle', 'testing', 0, '', '', 'pratyushkhengle@gmail.com', '2023-07-18 14:54:59', 'open'),
(29, 'file-etst', 'Pratyush Khengle', 'scsac', 0, '', '', 'pratyushkhengle@gmail.com', '2023-07-19 07:51:44', 'open'),
(30, 'casw', 'Pratyush Khengle', 'csac', 0, '', '', 'pratyushkhengle@gmail.com', '2023-07-19 08:21:33', 'open'),
(32, 'nol', 'Pratyush Khengle', ' kn', 0, '', '', 'na21b038@smail.iitm.ac.in', '2023-07-19 11:34:42', 'open'),
(33, 'daw', 'Pratyush Khengle', 'daw', 0, 'idx_embeddings.pt', '', 'na21b038@smail.iitm.ac.in', '2023-07-19 11:51:31', 'open'),
(34, 'leks', 'Pratyush Khengle', ' elja', 0, 'Calendar Jan-May 2023 (Version 1).pdf', '', 'na21b038@smail.iitm.ac.in', '2023-07-19 11:59:30', 'open'),
(35, 'kfpa', 'Pratyush Khengle', 'rmw', 0, 'W1.pt', '', 'na21b038@smail.iitm.ac.in', '2023-07-19 12:10:45', 'open'),
(36, 'acs', 'Pratyush Khengle', 'cac', 0, '', '', 'na21b038@smail.iitm.ac.in', '2023-07-19 12:17:15', 'open'),
(37, 'gfchgv', 'Pratyush Khengle', 'cfhgvh', 1, '', '', 'na21b038@smail.iitm.ac.in', '2023-07-19 12:20:55', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `tickets_comments`
--

CREATE TABLE `tickets_comments` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `by_` varchar(30) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tickets_comments`
--

INSERT INTO `tickets_comments` (`id`, `ticket_id`, `msg`, `by_`, `created`) VALUES
(6, 7, 'test0', 'u@g.com', '2023-07-10 12:54:27'),
(7, 7, 'works\r\n', 'u@g.com', '2023-07-10 16:10:15'),
(8, 11, 'hua kam?\r\n', 'u@g.com', '2023-07-12 11:08:04'),
(9, 23, 'i didn\'t understand what you said in last meet\r\n', 'pratyushkhengle@gmail.com', '2023-07-14 15:36:58'),
(10, 17, 'mkl\r\n', 'na21b038@smail.iitm.ac.in', '2023-07-17 14:48:19'),
(11, 17, 'dwqa', 'na21b038@smail.iitm.ac.in', '2023-07-17 15:34:59'),
(12, 17, 'ni', 'Pratyush', '2023-07-17 15:43:51'),
(13, 7, 'nj\r\n', 'user0', '2023-07-17 15:49:56'),
(14, 23, '456', 'Pratyush Khengle', '2023-07-17 16:04:47'),
(15, 7, '643', 'user0', '2023-07-17 16:57:38'),
(16, 24, 'huih\r\n', 'Pratyush Khengle', '2023-07-17 17:13:23'),
(17, 24, 'fghjk', 'Pratyush Khengle', '2023-07-18 14:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `pass`) VALUES
('Pratyush', 'na21b038@smail.iitm.ac.in', '12345678'),
('Pratyush Khengle', 'pratyushkhengle@gmail.com', '12345678'),
('user0', 'u@g.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_comments`
--
ALTER TABLE `tickets_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tickets_comments`
--
ALTER TABLE `tickets_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
