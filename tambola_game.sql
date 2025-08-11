-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2025 at 12:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tambola_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','agent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password_hash`, `role`) VALUES
(1, 'admin', '$2y$10$f149BLBnoTGOQEMlVANcTuln/F9Uc3Xn1B48FL2ufmXg7M7a6Pktu', 'admin'),
(4, 'agent', '$2y$10$DL9or2BYVIYOOWK4BNMLUehhEEvVPRGpQbZbzywN1IfuHJt8ERzlC', 'agent');

-- --------------------------------------------------------

--
-- Table structure for table `called_numbers`
--

CREATE TABLE `called_numbers` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `number_called` int(11) NOT NULL,
  `called_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `claim_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `player_session` varchar(100) NOT NULL,
  `claim_type` varchar(50) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(100) NOT NULL,
  `status` enum('waiting','selecting','running','finished') DEFAULT 'waiting',
  `start_time` datetime DEFAULT current_timestamp(),
  `prizes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `status`, `start_time`, `prizes`) VALUES
(1, '', 'finished', '2025-08-10 02:44:00', 'Early Five'),
(2, '', 'finished', '2025-08-10 03:04:00', 'Early Five'),
(3, '', 'finished', '2025-08-10 03:12:00', 'Early Five'),
(4, '', 'finished', '2025-08-10 03:25:00', 'Early Five'),
(5, '', 'finished', '2025-08-10 14:45:00', 'Early Five'),
(6, '', 'finished', '2025-08-10 14:48:00', 'Early Five'),
(7, '', 'finished', '2025-08-10 14:48:00', 'Early Five'),
(8, '', 'finished', '2025-08-10 15:08:00', 'Early Five'),
(9, '', 'finished', '2025-08-10 15:10:00', 'Early Five'),
(10, 'Test', 'finished', '2025-08-10 16:11:00', 'Early Five'),
(11, 'Test', 'finished', '2025-08-10 16:11:00', 'Early Five'),
(12, 'test', 'finished', '2025-08-10 16:11:00', ''),
(13, 'test', 'finished', '2025-08-10 16:11:00', ''),
(14, 'test', 'finished', '2025-08-10 16:13:00', 'Early Five'),
(15, 'test', 'finished', '2025-08-10 16:13:00', 'Early Five'),
(16, 'test', 'finished', '2025-08-10 16:13:00', 'Early Five'),
(17, 'Game', 'finished', '2025-08-10 16:16:00', 'Early Five'),
(18, '122', 'selecting', '2025-08-10 16:18:00', 'Early Five');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_pool`
--

CREATE TABLE `ticket_pool` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `ticket_data` text NOT NULL,
  `assigned_to` varchar(100) DEFAULT NULL,
  `assigned_name` varchar(100) DEFAULT NULL,
  `ticket_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_pool`
--

INSERT INTO `ticket_pool` (`id`, `game_id`, `ticket_data`, `assigned_to`, `assigned_name`, `ticket_no`) VALUES
(161, 9, '[[3,null,30,37,42,54,null,null,null],[7,13,21,null,null,57,61,null,null],[null,15,23,null,null,null,67,73,83]]', NULL, NULL, 0),
(162, 9, '[[null,14,24,32,null,57,null,null,82],[10,13,28,39,null,null,null,72,null],[5,null,null,37,49,null,68,76,null]]', 'jihidq640m1m1q9ic1rphg48u3', 'admin', 0),
(163, 9, '[[5,null,27,null,50,57,64,null,null],[null,11,null,31,42,null,66,null,81],[null,14,null,null,45,null,63,78,85]]', 'jihidq640m1m1q9ic1rphg48u3', 'admin', 0),
(164, 9, '[[3,17,26,34,44,null,null,null,null],[null,null,24,null,47,57,64,null,84],[null,null,null,35,46,51,61,79,null]]', NULL, NULL, 0),
(165, 9, '[[4,null,29,35,null,null,null,72,82],[6,19,null,null,null,52,67,null,86],[1,15,null,39,43,null,null,74,null]]', NULL, NULL, 0),
(166, 9, '[[6,null,24,32,50,53,null,null,null],[null,20,null,35,48,null,63,71,null],[9,14,null,33,null,null,64,null,84]]', NULL, NULL, 0),
(167, 9, '[[null,null,23,36,null,null,69,78,84],[8,null,29,39,null,53,68,null,null],[7,16,null,33,45,null,null,72,null]]', NULL, NULL, 0),
(168, 9, '[[3,null,28,null,null,null,66,72,86],[2,11,30,33,46,null,null,null,null],[8,19,26,40,null,58,null,null,null]]', NULL, NULL, 0),
(169, 9, '[[null,12,23,33,49,null,null,77,null],[1,20,null,38,null,60,63,null,null],[null,16,null,null,null,57,61,79,87]]', NULL, NULL, 0),
(170, 9, '[[6,null,21,35,42,54,null,null,null],[3,12,29,null,null,null,61,71,null],[null,16,null,36,43,null,65,null,81]]', NULL, NULL, 0),
(171, 9, '[[7,15,null,null,46,58,null,80,null],[2,13,null,36,41,null,66,null,null],[3,18,28,null,45,null,null,null,81]]', NULL, NULL, 0),
(172, 9, '[[null,18,null,34,null,53,null,74,81],[9,null,22,31,43,58,null,null,null],[null,17,25,null,48,56,61,null,null]]', NULL, NULL, 0),
(173, 9, '[[1,15,30,null,47,54,null,null,null],[null,null,null,null,41,53,70,78,88],[null,11,null,35,null,52,69,77,null]]', NULL, NULL, 0),
(174, 9, '[[null,null,26,32,null,53,null,77,89],[null,null,28,31,48,55,69,null,null],[2,15,23,null,null,null,67,75,null]]', NULL, NULL, 0),
(175, 9, '[[3,12,null,null,49,59,null,71,null],[10,15,21,null,50,null,null,null,82],[null,null,29,32,null,null,62,78,83]]', NULL, NULL, 0),
(176, 9, '[[9,14,null,31,50,51,null,null,null],[null,null,21,32,null,60,null,71,82],[null,null,null,40,null,52,68,72,86]]', NULL, NULL, 0),
(177, 9, '[[4,14,null,null,null,57,null,77,87],[null,null,26,38,null,53,63,74,null],[9,16,null,35,48,56,null,null,null]]', NULL, NULL, 0),
(178, 9, '[[1,20,26,36,null,null,null,77,null],[6,null,null,null,50,53,65,null,89],[null,null,null,34,48,57,66,null,81]]', NULL, NULL, 0),
(179, 9, '[[6,null,30,31,43,null,null,null,81],[1,13,25,null,41,null,70,null,null],[9,null,null,34,47,58,null,79,null]]', NULL, NULL, 0),
(180, 9, '[[null,null,24,40,43,null,69,77,null],[null,12,28,32,41,51,null,null,null],[8,20,null,null,null,58,67,null,88]]', NULL, NULL, 0),
(181, 16, '[[5,13,null,null,null,60,null,73,88],[null,18,null,null,null,58,62,75,83],[7,19,22,40,44,null,null,null,null]]', NULL, NULL, 1),
(182, 16, '[[3,11,null,39,null,55,63,null,null],[null,null,26,40,46,null,64,78,null],[null,14,null,null,45,null,66,77,81]]', NULL, NULL, 2),
(183, 16, '[[2,12,28,38,48,null,null,null,null],[null,16,25,null,null,58,68,71,null],[null,17,null,null,45,59,null,74,89]]', NULL, NULL, 3),
(184, 16, '[[9,11,28,37,46,null,null,null,null],[null,17,24,null,44,58,null,79,null],[null,null,null,40,null,56,67,71,88]]', NULL, NULL, 4),
(185, 16, '[[null,18,null,null,48,56,63,null,84],[null,null,23,31,44,54,null,74,null],[2,null,25,null,42,60,67,null,null]]', NULL, NULL, 5),
(186, 16, '[[2,null,null,null,null,54,62,74,88],[1,16,21,null,45,53,null,null,null],[9,null,null,40,null,60,null,79,85]]', NULL, NULL, 6),
(187, 16, '[[5,null,26,null,null,58,63,null,88],[null,null,24,null,null,57,67,72,85],[null,18,25,31,42,55,null,null,null]]', NULL, NULL, 7),
(188, 16, '[[6,13,null,null,null,58,null,71,82],[10,20,22,39,49,null,null,null,null],[null,null,26,null,44,null,67,74,84]]', NULL, NULL, 8),
(189, 16, '[[null,null,null,33,46,null,62,76,85],[3,17,29,null,null,54,69,null,null],[9,null,28,31,41,null,null,77,null]]', NULL, NULL, 9),
(190, 16, '[[null,null,26,null,48,59,69,null,85],[null,17,28,34,46,null,null,77,null],[6,null,null,null,41,null,68,74,82]]', NULL, NULL, 10),
(191, 16, '[[null,19,26,34,null,51,70,null,null],[6,20,28,37,null,null,null,null,84],[null,16,null,null,50,59,null,76,87]]', NULL, NULL, 11),
(192, 16, '[[null,16,null,37,43,52,66,null,null],[6,12,24,35,50,null,null,null,null],[null,null,null,32,null,59,67,80,86]]', NULL, NULL, 12),
(193, 16, '[[3,null,23,null,null,51,70,79,null],[null,null,null,33,50,null,61,73,84],[null,13,27,null,47,null,null,75,81]]', NULL, NULL, 13),
(194, 16, '[[10,13,null,36,null,59,63,null,null],[4,null,24,null,46,null,62,73,null],[3,12,null,null,48,null,null,72,85]]', NULL, NULL, 14),
(195, 16, '[[6,15,null,35,47,null,64,null,null],[null,12,23,33,46,null,null,75,null],[9,13,null,null,49,59,null,null,81]]', NULL, NULL, 15),
(196, 17, '[[null,19,null,null,46,59,65,77,null],[7,null,23,null,45,53,null,73,null],[null,null,null,40,43,null,70,75,87]]', NULL, NULL, 1),
(197, 17, '[[null,11,29,39,50,56,null,null,null],[8,null,30,38,null,59,67,null,null],[null,null,25,null,null,58,68,79,84]]', NULL, NULL, 2),
(198, 17, '[[4,17,null,null,48,59,65,null,null],[6,null,22,39,null,null,null,75,87],[5,null,26,37,null,60,null,73,null]]', NULL, NULL, 3),
(199, 17, '[[null,13,25,null,46,60,61,null,null],[2,11,30,null,48,null,65,null,null],[null,12,null,37,42,null,null,72,81]]', NULL, NULL, 4),
(200, 17, '[[10,null,null,40,49,null,69,72,null],[9,16,null,null,43,60,null,null,88],[null,null,23,34,50,57,null,77,null]]', NULL, NULL, 5),
(201, 17, '[[null,12,24,null,null,null,67,73,82],[null,15,null,37,45,null,66,79,null],[5,19,21,33,null,56,null,null,null]]', NULL, NULL, 6),
(202, 17, '[[7,null,null,31,47,null,null,73,87],[9,null,null,null,49,54,66,null,84],[null,20,25,33,48,53,null,null,null]]', NULL, NULL, 7),
(203, 17, '[[9,null,null,37,47,null,null,76,89],[10,16,25,40,null,51,null,null,null],[4,15,null,null,46,null,66,75,null]]', NULL, NULL, 8),
(204, 17, '[[10,16,30,38,null,null,null,76,null],[null,18,null,33,null,51,70,null,83],[4,15,null,null,44,58,null,null,85]]', NULL, NULL, 9),
(205, 17, '[[null,20,null,null,46,60,62,77,null],[6,17,null,null,41,53,null,null,86],[null,18,21,31,45,null,64,null,null]]', NULL, NULL, 10),
(206, 17, '[[4,null,null,null,50,null,67,76,81],[8,12,null,33,48,60,null,null,null],[null,20,23,32,44,55,null,null,null]]', NULL, NULL, 11),
(207, 17, '[[2,19,null,37,48,58,null,null,null],[null,20,30,null,45,null,68,78,null],[null,15,null,36,43,null,null,79,85]]', NULL, NULL, 12),
(208, 17, '[[10,null,25,38,null,53,null,null,85],[6,12,null,null,47,null,null,73,81],[3,null,null,null,48,null,70,79,83]]', NULL, NULL, 13),
(209, 17, '[[null,null,27,null,46,60,68,74,null],[10,13,null,38,50,54,null,null,null],[null,null,null,37,null,58,64,77,86]]', NULL, NULL, 14),
(210, 17, '[[7,15,29,36,50,null,null,null,null],[null,11,null,39,null,60,null,72,89],[null,12,null,32,null,52,66,null,88]]', NULL, NULL, 15),
(211, 17, '[[6,null,null,null,49,58,67,72,null],[null,15,22,null,41,52,null,null,81],[null,null,23,31,44,59,61,null,null]]', NULL, NULL, 16),
(212, 17, '[[null,16,null,null,44,52,66,null,87],[4,17,null,40,null,54,69,null,null],[null,18,25,36,null,null,61,78,null]]', NULL, NULL, 17),
(213, 17, '[[null,15,29,34,null,null,63,74,null],[3,19,null,37,null,null,null,72,90],[10,null,null,33,47,60,null,76,null]]', NULL, NULL, 18),
(214, 17, '[[10,17,null,31,42,53,null,null,null],[2,14,22,null,null,55,null,76,null],[null,18,null,32,null,null,68,80,85]]', NULL, NULL, 19),
(215, 17, '[[null,12,null,33,49,58,68,null,null],[null,null,22,null,null,53,67,72,85],[4,null,27,36,null,54,65,null,null]]', NULL, NULL, 20),
(216, 18, '[[null,null,28,40,null,52,null,74,83],[null,16,26,39,null,null,70,76,null],[6,18,null,null,47,null,61,78,null]]', NULL, NULL, 1),
(217, 18, '[[null,18,29,null,null,56,65,72,null],[4,null,null,32,49,52,null,null,82],[2,null,null,null,41,54,null,76,88]]', NULL, NULL, 2),
(218, 18, '[[null,null,28,32,50,52,null,78,null],[4,18,null,null,45,58,null,null,86],[9,14,null,33,null,51,68,null,null]]', NULL, NULL, 3),
(219, 18, '[[2,null,25,38,null,null,null,73,89],[3,15,null,31,null,55,70,null,null],[null,null,23,null,43,56,63,null,84]]', NULL, NULL, 4),
(220, 18, '[[8,null,null,40,48,60,68,null,null],[7,null,24,null,47,56,null,78,null],[null,13,null,35,43,null,null,76,84]]', NULL, NULL, 5),
(221, 18, '[[null,19,28,null,null,57,67,71,null],[10,18,30,32,null,null,66,null,null],[null,17,23,null,50,null,65,null,82]]', NULL, NULL, 6),
(222, 18, '[[null,17,28,null,46,51,null,null,90],[null,16,null,null,null,60,65,78,83],[3,18,null,39,null,55,70,null,null]]', NULL, NULL, 7),
(223, 18, '[[4,11,30,null,null,51,null,null,87],[9,null,27,null,null,null,62,73,85],[null,18,23,37,49,56,null,null,null]]', NULL, NULL, 8),
(224, 18, '[[5,null,25,33,null,58,null,null,81],[7,null,22,null,null,54,62,null,86],[null,12,30,null,45,null,65,75,null]]', NULL, NULL, 9),
(225, 18, '[[6,null,28,38,46,58,null,null,null],[null,null,25,31,43,59,67,null,null],[null,16,null,null,47,null,64,77,81]]', NULL, NULL, 10),
(226, 18, '[[null,null,24,null,42,58,65,71,null],[9,17,null,32,null,54,null,null,85],[null,null,null,null,49,53,63,74,82]]', NULL, NULL, 11),
(227, 18, '[[null,null,30,null,42,null,69,79,85],[6,null,22,null,null,55,null,75,84],[4,14,26,36,44,null,null,null,null]]', NULL, NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_requests`
--

CREATE TABLE `ticket_requests` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `player_session` varchar(100) NOT NULL,
  `player_name` varchar(100) NOT NULL,
  `requested_ticket_ids` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_requests`
--

INSERT INTO `ticket_requests` (`id`, `game_id`, `player_session`, `player_name`, `requested_ticket_ids`, `status`) VALUES
(1, 1, '68976cd76cfa4', 'Alex', '1,2', 'approved'),
(2, 2, '32htj7s0nknh79lga8k2cf57gv', 'Player-32htj7', '22,23,26', 'approved'),
(3, 3, '32htj7s0nknh79lga8k2cf57gv', 'admin', '22,23,26', 'approved'),
(4, 3, '32htj7s0nknh79lga8k2cf57gv', 'admin', '22,23,26', 'approved'),
(5, 3, '32htj7s0nknh79lga8k2cf57gv', 'Alex', '122', 'approved'),
(6, 4, '32htj7s0nknh79lga8k2cf57gv', 'Alex', '122', 'approved'),
(7, 4, '32htj7s0nknh79lga8k2cf57gv', 'Alex', '142', 'approved'),
(8, 9, 'jihidq640m1m1q9ic1rphg48u3', 'admin', '162,163', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `prize_name` varchar(255) NOT NULL,
  `winner_name` varchar(255) DEFAULT NULL,
  `winner_ticket_no` int(11) DEFAULT NULL,
  `claimed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `called_numbers`
--
ALTER TABLE `called_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`claim_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `ticket_pool`
--
ALTER TABLE `ticket_pool`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `ticket_requests`
--
ALTER TABLE `ticket_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `called_numbers`
--
ALTER TABLE `called_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ticket_pool`
--
ALTER TABLE `ticket_pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `ticket_requests`
--
ALTER TABLE `ticket_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `called_numbers`
--
ALTER TABLE `called_numbers`
  ADD CONSTRAINT `called_numbers_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_pool`
--
ALTER TABLE `ticket_pool`
  ADD CONSTRAINT `ticket_pool_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_requests`
--
ALTER TABLE `ticket_requests`
  ADD CONSTRAINT `ticket_requests_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `winners`
--
ALTER TABLE `winners`
  ADD CONSTRAINT `winners_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
