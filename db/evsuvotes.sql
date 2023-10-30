-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 09:58 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evsuvotes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `user_role` tinyint(20) NOT NULL DEFAULT 0 COMMENT '1=admin,2=superadmin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `photo`, `created_on`, `user_role`) VALUES
(1, '1', '$2y$10$WIUJk0yXAvTFk5y6A090C.h0JbQVjzNNtAc9j0.So4khoWBTHb1t6', 'Geek', 'Greek', 'Untitled design.png', '2023-03-23', 2),
(39, 'admin3', '$2y$10$I0sbjsBmcS.6KjcJVtdGMOaCK9I8p4SbF8C3v5ZkOLirxFWrJxF8W', 'Maria Christina', 'Martinez', '', '2023-10-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `archive_votes`
--

CREATE TABLE `archive_votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `photo` varchar(150) NOT NULL,
  `party_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `position_id`, `firstname`, `middlename`, `lastname`, `photo`, `party_id`) VALUES
(24, 18, 'Ferdinand', 'Romauldez', 'Marcos Jr.', 'bongbong.jpeg', 16),
(25, 18, 'Leni', 'Kakampay', 'Robredo', 'Leni_Robredo_Portrait.png', 16),
(26, 18, 'Isko', 'ManilaBoy', 'Moreno', 'IskoMorenoOfficialPortrait.jpg', 16),
(27, 18, 'Manny', 'Pacman', 'Pacquiao', '03095417-manny-pacquiao_cover_1201x1800.png', 16),
(28, 19, 'Sara', 'Geronimo', 'Duterte', '114138794_324145445410773_7300310799214989047_n.jpg', 19);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `name`, `status`) VALUES
(1, 'Engineering', 'active'),
(2, 'Technology', 'active'),
(3, 'Education', 'active'),
(4, 'Business, Entrepreneurship, and Marketing', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `party_lists`
--

CREATE TABLE `party_lists` (
  `party_id` int(11) NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `party_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `party_lists`
--

INSERT INTO `party_lists` (`party_id`, `party_name`, `party_description`, `created_at`, `modified_at`) VALUES
(15, 'LABAN Partylist', 'Lumaban ka', '2023-10-17 15:36:46', '2023-10-17 15:36:46'),
(16, 'HELLO WORLD', 'Opo.', '2023-10-19 06:18:24', '2023-10-19 06:18:24'),
(19, 'Example', 'Halimbawa', '2023-10-20 15:48:21', '2023-10-20 15:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `max_vote` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `max_vote`, `priority`) VALUES
(18, 'President', 1, 5),
(19, 'Vice-president', 1, 6),
(20, 'Secretary', 1, 7),
(21, 'Treasurer', 1, 8),
(22, '1st Year Representatives', 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `id` int(11) NOT NULL,
  `studentid` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `course` varchar(15) NOT NULL,
  `year` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `studentid`, `password`, `firstname`, `middlename`, `lastname`, `course`, `year`, `date`, `department_id`) VALUES
(171, '2020-20000', '$2y$10$G.4/A7rmnsC2nZaqXmt2EeVL4ivPNJs2YOe5ix5pdjCwSUHN4iE3.', 'Petter', 'Sanchez', 'Griffin', 'BSEDScience', 4, '2023-10-21', 3),
(172, '2020-20001', '$2y$10$lY/5V.AeS3zEUTsBIx4Qm.wcuqY6ovohMMNO5.TJQyM80UGHPrRdS', 'Lois', 'Sanchez', 'Griffin', 'BSCE', 4, '2023-10-21', 1),
(173, '2020-20002', '$2y$10$8beg1gEZ4fufOn2eHAk4KeJpGlFIl.PgjMZ11ZUgvHgBM3Qy2pG6q', 'Meg', 'Sanchez', 'Griffin', 'BSEE', 2, '2023-10-21', 1),
(174, '2020-35003', '$2y$10$UJSMbF4vNRUwa0MLS6MMkuDyrUTAY8q0FAhCdR5Mnq5dPCcW9/rI.', 'Stewie', 'Sanchez', 'Griffin', 'BSOA', 1, '2023-10-21', 4),
(175, '2020-35004', '$2y$10$3HLEcHwvFfJf2g7Wv6bAc.I/.DrGoTAJLRwUFwW/TMIYLuNnbAWSK', 'Chris', 'Sanchez', 'Griffin', 'BSA', 3, '2023-10-21', 4),
(176, '2020-35007', '$2y$10$WHHVKk.cLErRIup0cG4EBOy2aNKvS9eqw3XoGIP8/0ihGkXvOoxCS', 'Brian', 'Sanchez', 'Griffin', 'BSE', 2, '2023-10-21', 4),
(177, '2020-35008', '$2y$10$zBU.2XyBi0HQVRJHXe8sV.wZU.Ru0K34wKcVEbhQfIKzBbxUctaEW', 'Rick', 'Sanchez', 'Blake', 'BSIT', 4, '2023-10-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voters_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votingtypes`
--

CREATE TABLE `votingtypes` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votingtypes`
--

INSERT INTO `votingtypes` (`id`, `type_name`, `status`) VALUES
(1, 'SSG Voting', 'active'),
(2, 'Department Voting', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_votes`
--
ALTER TABLE `archive_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `candidate_id` (`candidate_id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `party_lists`
--
ALTER TABLE `party_lists`
  ADD PRIMARY KEY (`party_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_voters_department` (`department_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votingtypes`
--
ALTER TABLE `votingtypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `archive_votes`
--
ALTER TABLE `archive_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=584;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `party_lists`
--
ALTER TABLE `party_lists`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `voters`
--
ALTER TABLE `voters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=708;

--
-- AUTO_INCREMENT for table `votingtypes`
--
ALTER TABLE `votingtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archive_votes`
--
ALTER TABLE `archive_votes`
  ADD CONSTRAINT `archive_votes_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `archive_votes_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `archive_votes_ibfk_3` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `archive_votes_ibfk_4` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `voters`
--
ALTER TABLE `voters`
  ADD CONSTRAINT `fk_voters_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
