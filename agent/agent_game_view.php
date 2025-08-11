<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../db.php';
require '../functions.php';

// Only allow agents
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'agent') {
    header("Location: agent_login.php");
    exit;
}

// Set current game ID if not already
if (empty($_SESSION['current_game_id'])) {
    $latest = $conn->query(
        "SELECT game_id FROM games WHERE status='running' ORDER BY game_id DESC LIMIT 1"
    )->fetch_assoc();
    $_SESSION['current_game_id'] = $latest['game_id'] ?? 0;
}
$game_id = $_SESSION['current_game_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tambola — Agent Live Numbers</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    margin:0;
    font-family:Arial,sans-serif;
    background:#f6f8fa;
    min-height:100vh;
}
.content {
    flex:1;
    padding:20px 30px;
    margin-left:250px; /* leave space for fixed sidebar on desktop */
}
@media(max-width:800px){
    .content {
        margin-left:0;
        padding:15px;
    }
}
.header {
    background:#2980b9;
    padding:15px;
    color:#fff;
    font-weight:700;
    font-size:1.3em;
    margin-bottom:20px;
    border-radius:8px;
}
.card {
    background:#fff;
    border-radius:10px;
    padding:18px;
    margin-bottom:15px;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
    text-align:center;
}
.lastnum {
    color:#e74c3c;
    font-size:2em;
    font-weight:bold;
    border-bottom:3px solid #e74c3c;
    padding:2px 6px;
    background:#fff5f5;
    border-radius:4px;
}
.called-grid {
    display:grid;
    grid-template-columns:repeat(10, 1fr);
    gap:8px;
    max-width:480px;
    margin:20px auto 0;
}
.num {
    background:white;
    padding:14px 0;
    text-align:center;
    border-radius:8px;
    font-size:1.15em;
    font-weight:bold;
    border:1px solid #ccc;
    color:#333;
    transition:all 0.2s ease;
    box-shadow:0 1px 3px rgba(0,0,0,0.08);
}
.num.called {
    background:linear-gradient(145deg, #27ae60, #2ecc71);
    color:white;
    border-color:#1e8449;
    box-shadow:0 2px 10px rgba(39,174,96,0.4);
}
</style>
</head>
<body>

<?php include '../sidebar.php'; ?>

<div class="content">
    <div class="header">Agent — Live Numbers (Game #<?= $game_id ?>)</div>

    <div class="card">
        <div style="font-size:1.1em; margin-bottom:10px;">
            Last Number Called: <span id="last-number" class="lastnum">--</span>
        </div>
        <div id="called-grid" class="called-grid"></div>
    </div>
</div>

<script>
function renderCalledNumbers(called,last){
    document.getElementById('last-number').textContent = last || "--";
    const grid = document.getElementById('called-grid');
    grid.innerHTML = "";
    for (let n=1; n <= 90; n++) {
        const div = document.createElement('div');
        div.className = 'num' + (called.includes(n) ? ' called' : '');
        div.textContent = n;
        grid.appendChild(div);
    }
}

function updateCalledGrid(){
    fetch('../get_called_numbers.php')
      .then(r => r.json())
      .then(data => {
          renderCalledNumbers(data.called || [], data.last || null);
      })
      .catch(err => console.error('Error fetching numbers:', err));
}

updateCalledGrid();
setInterval(updateCalledGrid,3000);
</script>

</body>
</html>
