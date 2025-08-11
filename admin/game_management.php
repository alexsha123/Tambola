<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../db.php';
require '../generate_ticket.php';
require '../functions.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php");
    exit;
}

date_default_timezone_set('Asia/Kolkata');
$msg = "";

/* STOP GAME */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stop_game'])) {
    $gid = intval($_POST['stop_game_id'] ?? 0);
    if ($gid) {
        $stmt = $conn->prepare("UPDATE games SET status='finished' WHERE game_id=?");
        $stmt->bind_param("i", $gid);
        $msg = $stmt->execute() ? "🛑 Game stopped successfully." : "❌ Failed to stop game.";
        $stmt->close();
    }
}

/* CREATE GAME */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_game'])) {
    $game_name = trim($_POST['game_name']);
    $prizes = isset($_POST['prizes']) ? implode(',', $_POST['prizes']) : '';
    $ticket_count = intval($_POST['ticket_count'] ?? 0);
    $start_date = $_POST['start_date'] ?? date('Y-m-d');
    $start_time_only = $_POST['start_time_only'] ?? date('H:i');
    $start_time = $start_date . ' ' . $start_time_only . ':00';

    if ($game_name && $ticket_count > 0) {
        $stmt = $conn->prepare("INSERT INTO games (game_name, status, start_time, prizes) 
                                 VALUES (?, 'selecting', ?, ?)");
        $stmt->bind_param("sss", $game_name, $start_time, $prizes);
        $ok = $stmt->execute();
        $gid = $conn->insert_id;
        $stmt->close();

        if ($ok && $gid) {
            for ($i = 1; $i <= $ticket_count; $i++) {
                $ticket_grid = generateTicket();
                $ticket_json = json_encode($ticket_grid);

                $st = $conn->prepare("INSERT INTO ticket_pool (game_id, ticket_no, ticket_data) VALUES (?, ?, ?)");
                $st->bind_param("iis", $gid, $i, $ticket_json);
                $st->execute();
                $st->close();
            }
            $msg = "✅ Game '{$game_name}' created with {$ticket_count} tickets.";
        } else {
            $msg = "❌ Error creating game: " . $conn->error;
        }
    } else {
        $msg = "⚠ Please enter a game name and valid ticket count.";
    }
}

/* UPDATE DATE/TIME */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_start_time'])) {
    $gid = intval($_POST['update_game_id']);
    $new_date = $_POST['new_date'] ?? '';
    $new_time = $_POST['new_time'] ?? '';
    if ($gid && $new_date && $new_time) {
        $new_start_time = $new_date . ' ' . $new_time . ':00';
        $stmt = $conn->prepare("UPDATE games SET start_time=? WHERE game_id=?");
        $stmt->bind_param("si", $new_start_time, $gid);
        $stmt->execute();
        $stmt->close();
        $msg = "⏰ Start date/time updated for game #$gid.";
    }
}

/* AUTO STOP */
$activeGames = $conn->query("SELECT game_id, prizes FROM games WHERE status != 'finished'");
while ($g = $activeGames->fetch_assoc()) {
    $gid = $g['game_id'];
    $selectedPrizes = array_map('trim', explode(',', $g['prizes']));

    $stmt = $conn->prepare("SELECT COUNT(DISTINCT prize_name) AS won_count FROM winners WHERE game_id=?");
    $stmt->bind_param("i", $gid);
    $stmt->execute();
    $res = $stmt->get_result();
    $wonCount = $res->fetch_assoc()['won_count'] ?? 0;
    $stmt->close();

    if ($wonCount >= count($selectedPrizes) && count($selectedPrizes) > 0) {
        $up = $conn->prepare("UPDATE games SET status='finished' WHERE game_id=?");
        $up->bind_param("i", $gid);
        $up->execute();
        $up->close();
    }
}

/* FETCH GAMES */
$games = $conn->query("SELECT * FROM games ORDER BY game_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Game Management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #f4f6f9;
    overflow-x: hidden;
}
.content {
    flex: 1;
    padding: 20px;
    margin-left: 250px;
    max-width: 100%;
    box-sizing: border-box;
    overflow-x: hidden;
}
@media(max-width: 800px) {
    .content {
        margin-left: 0;
        padding: 14px;
    }
}
.container {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.10);
}
h1 {margin-top:0;}

form.game-form {
    display: grid;
    gap: 12px;
    background: #f8f9fa;
    padding: 14px;
    border-radius: 10px;
    margin-bottom: 18px;
}
form.game-form input,form.game-form select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}
form.game-form label {font-weight: 600;}
form.game-form button {
    background: #1abc9c;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 6px;
    cursor: pointer;
}
form.game-form button:hover {background: #15977b}

.games-table {
    width: 100%;
    border-collapse: collapse;
}
.games-table th, .games-table td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}
.games-table th {
    background: #2980b9;
    color: #fff;
}
button[name="stop_game"],button[name="update_start_time"] {
    padding: 6px 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
}
button[name="stop_game"] {background:#e74c3c;}
button[name="update_start_time"] {background:#f39c12;}

form.update-form {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    justify-content: center;
}
form.update-form input {
    padding: 4px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Prize container as a small grid for tidy layout */
.prizes-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(120px, 1fr));
    gap: 6px 12px;
    margin-top: 6px;
    margin-bottom: 6px;
}

/* Prize label: text first, checkbox to the right */
.prize-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;            /* space between text and checkbox */
    justify-content: space-between;
    width: 100%;
    font-weight: 500;
    cursor: pointer;
}

/* make the checkbox a consistent size */
.prize-label input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin: 0;
}

/* Mobile responsive cards */
@media(max-width: 700px) {
    .games-table, .games-table thead, .games-table tbody, 
    .games-table th, .games-table td, .games-table tr {
        display: block;
        width: 100%;
    }
    .games-table tr {
        margin-bottom: 12px;
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        padding: 10px;
    }
    .games-table td {
        border: none;
        text-align: left;
        padding: 6px 0;
        width: 100%;
        word-wrap: break-word;
    }
    .games-table td::before {
        content: attr(data-label);
        font-weight: bold;
        display: block;
        margin-bottom: 2px;
        color: #555;
    }
    form.update-form {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }
    form.update-form input,
    form.update-form button {
        width: 100%;
        box-sizing: border-box;
    }

    /* stack prizes into one column on small screens */
    .prizes-grid {
        grid-template-columns: 1fr;
    }
}
</style>
</head>
<body>
<?php include '../sidebar.php'; ?>

<div class="content">
    <div class="container">
        <h1>Game Management</h1>
        <?php if($msg): ?>
            <div style="background:#e8f5e9;padding:8px;color:#2e7d32;border-radius:6px;margin-bottom:14px;">
                <?=$msg?>
            </div>
        <?php endif; ?>

        <!-- Create Game -->
        <form method="post" class="game-form">
            <input type="text" name="game_name" placeholder="Game Name" required>
            <label>Start Date</label>
            <input type="date" name="start_date" value="<?=date('Y-m-d')?>" required>
            <label>Start Time</label>
            <input type="time" name="start_time_only" value="<?=date('H:i')?>" required>
            <input type="number" name="ticket_count" min="1" max="300" placeholder="Ticket Count" required>

            <div>
                <b>Select Prizes:</b>
                <div class="prizes-grid">
                    <?php foreach(["Early Five","Four Corners","Top Line","Middle Line","Bottom Line","Full House"] as $p): ?>
                        <label class="prize-label">
                            <span class="prize-text"><?=htmlspecialchars($p)?></span>
                            <input type="checkbox" name="prizes[]" value="<?=htmlspecialchars($p)?>">
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="submit" name="create_game">Create Game</button>
        </form>

        <!-- Games Table -->
        <table class="games-table">
            <thead>
                <tr>
                    <th>Game Name</th>
                    <th>Status</th>
                    <th>Start Time</th>
                    <th>Prizes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while($game = $games->fetch_assoc()): ?>
            <tr>
                <td data-label="Game Name"><?=htmlspecialchars($game['game_name'])?></td>
                <td data-label="Status"><?=ucfirst($game['status'])?></td>
                <td data-label="Start Time">
                    <?=!empty($game['start_time']) ? date('d/m/Y H:i',strtotime($game['start_time'])) : '-'?> IST
                </td>
                <td data-label="Prizes"><?=htmlspecialchars($game['prizes'])?></td>
                <td data-label="Actions">
                    <?php if(strtolower($game['status'])!=='finished'): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="stop_game_id" value="<?=$game['game_id']?>">
                            <button type="submit" name="stop_game">Stop</button>
                        </form>
                        <form method="post" class="update-form">
                            <input type="hidden" name="update_game_id" value="<?=$game['game_id']?>">
                            <input type="date" name="new_date" value="<?=date('Y-m-d',strtotime($game['start_time']))?>" required>
                            <input type="time" name="new_time" value="<?=date('H:i',strtotime($game['start_time']))?>" required>
                            <button type="submit" name="update_start_time">Update</button>
                        </form>
                    <?php else: ?>✅ Completed<?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
