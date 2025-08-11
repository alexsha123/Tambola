<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../db.php';

$game_id = $_SESSION['current_game_id'] ?? 0;
$nums = [];
$last = null;

$res = $conn->query("SELECT number FROM called_numbers WHERE game_id=$game_id ORDER BY called_at ASC");
while ($row = $res->fetch_assoc()) {
    $nums[] = (int)$row['number'];
}
if (!empty($nums)) $last = end($nums);

header('Content-Type: application/json');
echo json_encode(['called'=>$nums, 'last'=>$last]);
?>
