CREATE TABLE `games` (
  `game_id` int PRIMARY KEY AUTO_INCREMENT,
  `game_name` varchar(255),
  `status` varchar(50),
  `start_time` datetime,
  `end_time` datetime,
  `prizes` text
);

CREATE TABLE `ticket_pool` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `game_id` int,
  `ticket_no` int,
  `ticket_data` text,
  `assigned_to` varchar(255),
  `assigned_name` varchar(255)
);

CREATE TABLE `ticket_requests` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `game_id` int,
  `player_session` varchar(255),
  `player_name` varchar(255),
  `requested_ticket_ids` varchar(255),
  `status` varchar(20)
);

CREATE TABLE `called_numbers` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `game_id` int,
  `number` int,
  `called_at` datetime
);

CREATE TABLE `winners` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `game_id` int,
  `prize_name` varchar(255),
  `winner_name` varchar(255),
  `winner_ticket_no` int
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50),
  `password` varchar(255),
  `role` varchar(20)
);
