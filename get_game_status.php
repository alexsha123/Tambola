<?php
// get_game_status.php — returns current game status and info for player UI
require 'db.php';
session_start();

$game_id = $_SESSION['current_game_id'] ?? 0;
if (!$game_id) {
    echo json_encode(['error' => 'No game selected.']);
    exit;
}

$game = $conn->query("SELECT * FROM games WHERE game_id=$game_id")->fetch_assoc();
if (!$game) {
    echo json_encode(['error' => 'Game not found.']);
    exit;
}

// Optionally, fetch more info (e.g., prizes, status, start_time, etc.)
$response = [
    'game_id'    => $game['game_id'],
    'game_name'  => $game['game_name'],
    'status'     => $game['status'],
    'start_time' => $game['start_time'],
    'prizes'     => $game['prizes'],
    'end_time'   => $game['end_time'] ?? null
];
header('Content-Type: application/json');
echo json_encode($response);
