<?php
session_start();
require 'db.php';
require 'functions.php'; // if you put check_prizes() there

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error'=>'Not authorized']);
    exit;
}

$game_id = $_SESSION['current_game_id'] ?? 0;
if (!$game_id) {
    echo json_encode(['error'=>'No active game']);
    exit;
}

// Get already called
$called = [];
$cres = $conn->query("SELECT number FROM called_numbers WHERE game_id=$game_id");
while ($row = $cres->fetch_assoc()) $called[] = (int)$row['number'];

// Find next number
$next_number = null;
for ($n=1; $n<=90; $n++) {
    if (!in_array($n, $called)) {
        $next_number = $n;
        break;
    }
}
if (!$next_number) {
    echo json_encode(['error'=>'All numbers called']);
    exit;
}

// Insert into called_numbers
$stmt = $conn->prepare("INSERT INTO called_numbers (game_id, number, called_at) VALUES (?,?,NOW())");
$stmt->bind_param('ii', $game_id, $next_number);
$stmt->execute();

// Run prize check
require 'check_prizes.php';

echo json_encode(['next_number'=>$next_number]);
