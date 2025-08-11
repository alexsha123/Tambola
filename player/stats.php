<?php
require '../db.php';
require '../functions.php';
$game_id = $_SESSION['current_game_id'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
<title>Game Stats — Game <?=$game_id?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: Arial, sans-serif;
    background: #f6f8fa;
    margin: 0; padding: 20px;
}
.header {
    background: #2980b9;
    color: #fff;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 15px;
    text-align: center;
}
.stat-box {
    background: #fff;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    font-size: 1.2em;
}
.stat-box b {
    font-weight: 700;
}
</style>
</head>
<body>
<div class="header">📊 Game Stats — Game #<?=$game_id?></div>
<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'player') {
    // Optional session check
    header("Location: player_login.php");
    exit;
}

$totalTickets = $conn->query("SELECT COUNT(*) AS c FROM ticket_pool WHERE game_id=$game_id")->fetch_assoc()['c'];
$calledCount = $conn->query("SELECT COUNT(*) AS c FROM called_numbers WHERE game_id=$game_id")->fetch_assoc()['c'];
$winnerCount = $conn->query("SELECT COUNT(*) AS c FROM claims WHERE game_id=$game_id AND status='approved'")->fetch_assoc()['c'];
?>

<div class="stat-box">🎫 Total Tickets: <b><?=$totalTickets?></b></div>
<div class="stat-box">🔢 Numbers Called: <b><?=$calledCount?></b></div>
<div class="stat-box">🏆 Approved Winners: <b><?=$winnerCount?></b></div>

</body>
</html>
