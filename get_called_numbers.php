<?php
session_start();
require 'db.php';
$game_id = $_SESSION['current_game_id'] ?? 0;
$out = ['called_numbers'=>[]];
if ($game_id) {
    $res = $conn->query("SELECT number FROM called_numbers WHERE game_id=$game_id ORDER BY id ASC");
    while ($row = $res->fetch_assoc()) $out['called_numbers'][] = (int)$row['number'];
}
header('Content-Type: application/json');
echo json_encode($out);
