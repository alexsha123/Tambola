<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../db.php';

$ticket_id = intval($_POST['ticket_id'] ?? 0);
$prize = $_POST['prize'] ?? '';
$player_session = $_SESSION['player_session'] ?? '';
$game_id = $_SESSION['current_game_id'] ?? 0;

if ($ticket_id && $prize && $player_session && $game_id) {
    $chk = $conn->query("SELECT * FROM winners WHERE game_id=$game_id AND prize_name='$prize'");
    if ($chk->num_rows == 0) {
        $tkt = $conn->query("SELECT assigned_name FROM ticket_pool WHERE id=$ticket_id AND assigned_to='$player_session'")
            ->fetch_assoc();
        $name = $conn->real_escape_string($tkt['assigned_name'] ?? '');
        $conn->query("INSERT INTO winners (game_id, prize_name, winner_name, winner_ticket_no)
                      VALUES ($game_id, '$prize', '$name', $ticket_id)");
        echo json_encode(['success'=>true]);
        exit;
    }
}
echo json_encode(['success'=>false]);
?>
