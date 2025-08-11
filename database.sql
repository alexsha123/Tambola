CREATE DATABASE IF NOT EXISTS tambola_game;
USE tambola_game;

-- Admin / Agent users
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','agent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Games with prizes
CREATE TABLE games (
    game_id INT AUTO_INCREMENT PRIMARY KEY,
    status ENUM('waiting','selecting','running','finished') DEFAULT 'waiting',
    start_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    prizes TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ticket pool
CREATE TABLE ticket_pool (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    ticket_data TEXT NOT NULL,
    assigned_to VARCHAR(100) DEFAULT NULL,
    assigned_name VARCHAR(100) DEFAULT NULL,
    FOREIGN KEY (game_id) REFERENCES games(game_id) ON DELETE CASCADE,
    INDEX (game_id),
    INDEX (assigned_to)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Ticket requests
CREATE TABLE ticket_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    player_session VARCHAR(100) NOT NULL,
    player_name VARCHAR(100) NOT NULL,
    requested_ticket_ids TEXT NOT NULL,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    FOREIGN KEY (game_id) REFERENCES games(game_id) ON DELETE CASCADE,
    INDEX (game_id),
    INDEX (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Called numbers
CREATE TABLE called_numbers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    number_called INT NOT NULL,
    called_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (game_id) REFERENCES games(game_id) ON DELETE CASCADE,
    INDEX (game_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Claims (for prize checks)
CREATE TABLE claims (
    claim_id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT NOT NULL,
    player_session VARCHAR(100) NOT NULL,
    claim_type VARCHAR(50) NOT NULL,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    FOREIGN KEY (game_id) REFERENCES games(game_id) ON DELETE CASCADE,
    INDEX (game_id),
    INDEX (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample admin user with password "password"
INSERT INTO admin (username,password_hash,role) VALUES
('admin','$2y$10$KIX/zoUlL5yuV9ZujeN1Fu3OcKkDDH6KsJ5pP8VjK7j6N2npvrC2m','admin');
