<?php
session_start();
require '../db.php';
require '../functions.php';

// Allow only admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get game_id from GET or session
$game_id = 0;
if (isset($_GET['game_id']) && is_numeric($_GET['game_id'])) {
    $game_id = (int)$_GET['game_id'];
    $_SESSION['current_game_id'] = $game_id;
} elseif (!empty($_SESSION['current_game_id'])) {
    $game_id = (int)$_SESSION['current_game_id'];
}

// Fallback to latest game
if ($game_id === 0) {
    $sql_latest = "SELECT game_id FROM games 
                   WHERE status IN ('selecting','running','finished') 
                   ORDER BY game_id DESC LIMIT 1";
    $latest_res = $conn->query($sql_latest);
    if ($latest_res && $latest_res->num_rows > 0) {
        $latest = $latest_res->fetch_assoc();
        $game_id = (int)$latest['game_id'];
        $_SESSION['current_game_id'] = $game_id;
    }
}

// Fetch game details
$game = null;
if ($game_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM games WHERE game_id = ?");
    $stmt->bind_param("i", $game_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $game = $result->fetch_assoc();
    }
    $stmt->close();
}

// Fetch all games for dropdown
$all_games = $conn->query("SELECT game_id, status, start_time FROM games ORDER BY game_id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tambola Admin — Game Info & Number Calling</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{font-family:Arial;margin:0;padding:0;background:#f6f6f6;}
/* Sidebar */
.sidebar {
    background:#2c3e50;
    color:#ecf0f1;
    height:100vh;
    width:240px;
    position:fixed;
    top:0; left:0;
    overflow-y:auto;
    transition:transform 0.3s ease;
    z-index:200;
}
.sidebar.closed { transform:translateX(-240px); }
.sidebar h2 {text-align:center;font-size:1.3em;margin:15px 0;color:#1abc9c;}
.sidebar a {display:block;color:#ecf0f1;padding:12px 20px;text-decoration:none;border-left:5px solid transparent;transition:all .2s ease;}
.sidebar a:hover {background:#1abc9c;border-left-color:#16a085;}
/* Overlay for mobile */
#sidebarOverlay {display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.4);z-index:199;}
#sidebarOverlay.show {display:block;}
/* Toggle button */
.hamburger-btn {
    position:fixed;top:16px;left:16px;
    background:#1abc9c;color:#fff;
    border:none;border-radius:4px;
    font-size:1.6em;padding:7px 13px;
    cursor:pointer;z-index:301;
}
/* Header */
.header{background:#1abc9c;padding:12px;color:#fff;margin:10px 10px 0 10px;font-size:1.3em;display:flex;align-items:center;justify-content:space-between;border-radius:6px;}
select#gameSelect {font-size:1em;padding:6px 10px;border-radius:6px;border:1px solid #ccc;}
/* Content wrapper */
.content {
    transition:margin-left 0.3s ease;
    margin-left:240px;
    padding:20px;
}
.content.full { margin-left:0; }
@media(max-width:800px){
    .sidebar {width:70vw;transform:translateX(-100%);}
    .sidebar.open {transform:translateX(0);}
    .content {margin-left:0;}
    .hamburger-btn {display:block;}
}
/* Sections */
.section{background:#fff;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,0.07);margin:15px 0;padding:18px;}
.label{color:#888;}
/* Number grid */
#numbersTable{margin:20px auto;border-collapse:collapse;max-width:500px;}
#numbersTable td{
    width:40px;height:40px;text-align:center;
    border:1px solid #ddd;border-radius:5px;
    font-weight:bold;font-size:1.1em;
    background:#f8f8f8;color:#222;
    transition:background 0.2s;
}
#numbersTable td.called{background:#27ae60;color:#fff;}
#numbersTable td.last{background:#e74c3c!important;color:#fff;box-shadow:0 0 7px #e74c3c80;}
#lastCalledNumber{text-align:center;font-size:1.4em;margin-top:10px;}
/* Buttons */
.action-btn{
    padding:10px 20px;background:#1abc9c;color:#fff;
    border:none;border-radius:6px;cursor:pointer;
    font-size:1em;margin:5px;
}
.action-btn:disabled{background:#bdc3c7;cursor:not-allowed;}
.action-btn:hover:not(:disabled){background:#16a085;}
.auto-btn{background:#e67e22;}
.auto-btn.active{background:#27ae60;}
.info-warn { color:#e67e22; font-weight:bold; }
.info-ok { color:#27ae60; font-weight:bold; }
</style>
</head>
<body>

<div id="sidebarOverlay"></div>
<button class="hamburger-btn" id="hamburgerBtn">☰</button>
<div class="sidebar" id="sidebar">
    <h2>Admin Panel</h2>
    <a href="game_management.php">🎮 Game Management</a>
    <a href="admin_game_view.php">📊 Game View</a>
    <a href="../ticket_requests_common.php">📨 Ticket Requests</a>
    <a href="../winners.php">🏆 Winners</a>
    <a href="agent_management.php">👥 Manage Agents</a>
    <a href="admin_change_credentials.php">🔑 Change Username/Password</a>
    <a href="../logout.php">🚪 Logout</a>
</div>
<div class="content" id="contentArea">

<div class="header">
    <div>Tambola Admin — Game Info & Number Calling</div>
    <div>
        <label for="gameSelect" style="color:#fff; margin-right:8px;">Select Game:</label>
        <select id="gameSelect">
            <?php if ($all_games && $all_games->num_rows > 0): ?>
                <?php while ($row = $all_games->fetch_assoc()): ?>
                    <option value="<?= (int)$row['game_id'] ?>" <?= $row['game_id'] == $game_id ? 'selected' : '' ?>>
                        Game #<?= (int)$row['game_id'] ?> (<?= htmlspecialchars($row['status']) ?><?= !empty($row['start_time']) ? ', ' . htmlspecialchars($row['start_time']) : '' ?>)
                    </option>
                <?php endwhile; ?>
            <?php else: ?>
                <option disabled>No games found</option>
            <?php endif; ?>
        </select>
    </div>
</div>

<!-- Game Info -->
<div class="section">
    <h3>Game Details</h3>
    <?php if ($game): ?>
        <div><span class="label">Game ID:</span> <b><?= (int)$game['game_id'] ?></b></div>
        <div><span class="label">Status:</span> <b><?= htmlspecialchars($game['status']) ?></b></div>
        <div><span class="label">Start Time:</span> <?= htmlspecialchars($game['start_time'] ?? '--') ?></div>
        <div><span class="label">End Time:</span> <?= htmlspecialchars($game['end_time'] ?? '--') ?></div>
        <?php
        if ($game['status'] !== 'running' && !empty($game['start_time'])) {
            if ($game['start_time'] > date('Y-m-d H:i:s')) {
                echo "<div class='info-warn'>Game will start at ".htmlspecialchars($game['start_time'])."</div>";
            } else {
                echo "<div class='info-warn'>Game scheduled start time passed — ensure backend updates status to running.</div>";
            }
        } elseif ($game['status'] === 'running') {
            echo "<div class='info-ok'>Game is running — controls enabled.</div>";
        }
        ?>
    <?php else: ?>
        <div style="color:#e74c3c;">No game found.</div>
    <?php endif; ?>
</div>

<!-- Number Calling Control -->
<div class="section">
    <h3>Number Calling Control</h3>
    <div style="text-align:center;">
        <button id="callNextNumberBtn" class="action-btn" <?= ($game && $game['status'] === 'running') ? '' : 'disabled' ?>>🎯 Call Next Number</button>
        <button id="autocallBtn" class="action-btn auto-btn" <?= ($game && $game['status'] === 'running') ? '' : 'disabled' ?>>⏱ Enable Auto Call</button>
    </div>
    <div id="lastCalledNumber">Last Number Called: --</div>
    <table id="numbersTable"><tbody id="numbersTableBody"></tbody></table>
</div>

</div><!-- /.content -->

<script>
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
const btn = document.getElementById('hamburgerBtn');
const content = document.getElementById('contentArea');

// Desktop: open by default
window.addEventListener("DOMContentLoaded", () => {
    if (window.innerWidth > 800) {
        sidebar.classList.remove('closed');
        content.classList.remove('full');
    }
});

// Toggle sidebar
btn.addEventListener('click', () => {
    if (window.innerWidth > 800) {
        sidebar.classList.toggle('closed');
        content.classList.toggle('full');
    } else {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('show');
    }
});
overlay.addEventListener('click', () => {
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
});
sidebar.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 800) {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        }
    });
});

// Switch game dropdown
document.getElementById('gameSelect').addEventListener('change', function(){
    window.location.href = '?game_id=' + encodeURIComponent(this.value);
});

// Number grid and controls
let autocallInterval = null;
const AUTO_CALL_DELAY = 15000;
async function fetchCalledNumbers(){
    const resp = await fetch('../get_called_numbers.php');
    const data = await resp.json();
    return data.called_numbers || [];
}

async function updateCalledNumbers(){
    const called = await fetchCalledNumbers();
    const lastNum = called.length ? called[called.length - 1] : null;
    const tb = document.getElementById('numbersTableBody');
    tb.innerHTML='';
    let num=1;
    for(let r=0;r<9;r++){
        let tr=document.createElement('tr');
        for(let c=0;c<10;c++){
            const td=document.createElement('td');
            td.textContent=num;
            if(called.includes(num)){
                td.classList.add('called');
                if(num===lastNum) td.classList.add('last');
            }
            tr.appendChild(td);
            num++;
        }
        tb.appendChild(tr);
    }
    document.getElementById('lastCalledNumber').textContent = lastNum ? "Last Number Called: "+lastNum : "Last Number Called: --";
}
async function callNextNumber(){
    const btn = document.getElementById('callNextNumberBtn');
    if(btn.disabled) return;
    const resp = await fetch('../call_number.php', {method:'POST'});
    const data = await resp.json();
    if(data.next_number){
        await updateCalledNumbers();
        if('speechSynthesis' in window){
            speechSynthesis.speak(new SpeechSynthesisUtterance("Number " + data.next_number));
        }
    } else if(data.error){
        alert(data.error);
        stopAutocall();
    }
}
document.getElementById('callNextNumberBtn').addEventListener('click', callNextNumber);

document.getElementById('autocallBtn').addEventListener('click', function(){
    if(this.disabled) return;
    if(autocallInterval){ stopAutocall(); }
    else { startAutocall(); }
});
function startAutocall(){
    autocallInterval = setInterval(callNextNumber, AUTO_CALL_DELAY);
    callNextNumber();
    const btn = document.getElementById('autocallBtn');
    btn.classList.add('active');
    btn.textContent = "⏹ Stop Auto Call";
}
function stopAutocall(){
    clearInterval(autocallInterval);
    autocallInterval = null;
    const btn = document.getElementById('autocallBtn');
    btn.classList.remove('active');
    btn.textContent = "⏱ Enable Auto Call";
}
updateCalledNumbers();
setInterval(updateCalledNumbers, 5000);
// In the JS section of /admin/game_info.php
await fetch('../call_number.php', {method:'POST'});
await fetch('../get_called_numbers.php');

</script>
</body>
</html>
