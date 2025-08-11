<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../db.php';

$player_username = $_SESSION['username'] ?? '';
$game_id = $_SESSION['current_game_id'] ?? 0;

header('Content-Type: application/json');

if (!$player_username || !$game_id) {
    echo json_encode(['assigned' => false]);
    exit;
}

$res = $conn->query("SELECT COUNT(*) AS cnt FROM ticket_pool 
                     WHERE assigned_to='" . $conn->real_escape_string($player_username) . "' 
                       AND game_id=$game_id");
$row = $res->fetch_assoc();
echo json_encode(['assigned' => $row['cnt'] > 0]);
