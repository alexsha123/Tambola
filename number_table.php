<?php
session_start();
require 'db.php';

// --- Role detection (change sidebar/layout below as needed) ---
$role = $_SESSION['role'] ?? 'player';
$username = $_SESSION['username'] ?? '';
$game_id = $_SESSION['current_game_id'] ?? 0;

// --- (Optional) Redirect if not logged in ---
if (!$game_id) die('Game not selected.');

$role_label = ($role == 'admin') ? 'Admin Panel' : (($role=='agent') ? 'Agent Panel' : 'Player');
$sidebar_links = [
    'admin' => [
        ["game_management.php","🎮 Game Management"],
        ["admin_game_view.php","📊 Game View"],
        ["ticket_requests.php","📨 Ticket Requests"],
        ["winners.php","🏆 Winners"],
        ["agent_management.php","👥 Manage Agents"],
        ["admin_change_password.php","🔑 Change Password"],
        ["admin_logout.php","🚪 Logout"]
    ],
    'agent' => [
        ["agent_dashboard.php","📊 Dashboard"],
        ["agent_claim_prize.php","🎯 Claim Prize"],
        ["agent_winners.php","🏆 Winners"],
        ["agent_logout.php","🚪 Logout"]
    ],
    'player' => [
        ["index.php","🏠 Home"],
        ["claim_prize.php","🎯 Claim Prize"],
        ["winner_list.php","🏆 Winners"],
        ["player_logout.php","🚪 Logout"]
    ],
];

// --- Called numbers API ---
function get_called_info($conn, $game_id) {
    $calledNums = [];
    $lastNum=null;
    $res = $conn->query("SELECT number_called FROM called_numbers WHERE game_id=$game_id ORDER BY called_at ASC");
    while($row = $res->fetch_assoc()) {
        $num = (int)$row['number_called'];
        $calledNums[] = $num;
        $lastNum = $num;
    }
    return ['called'=>$calledNums, 'last'=>$lastNum];
}

$game_row = $conn->query("SELECT game_name FROM games WHERE game_id=$game_id")->fetch_assoc();
$game_name = $game_row['game_name'] ?? "Game";

?>
<!DOCTYPE html>
<html>
<head>
    <title><?=ucfirst($role)?> Number Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#f4f6f9; display:flex; min-height:100vh;}
        .sidebar {
            width:220px; background:#2c3e50; color:#ecf0f1;
            padding-top:22px; flex-shrink:0; transition:all .3s;
        }
        .sidebar h2 { text-align:center; font-size:1.2em; margin-bottom:18px;}
        .sidebar a {
            display:block; color:#ecf0f1; padding:10px 18px; text-decoration:none;
            border-left:5px solid transparent;
        }
        .sidebar a:hover { background:#34495e; border-left:5px solid #1abc9c;}
        .content { flex:1; padding:24px;}
        .toggle-btn {
            background:#1abc9c; color:white; border:none;
            padding:8px 14px; border-radius:4px; cursor:pointer;
            margin-bottom:15px;
        }
        .sidebar.collapsed { width:0; overflow:hidden;}
        .content.full { padding:24px;}
        @media(max-width:768px){
            body { flex-direction:column;}
            .sidebar { width:100%; display:flex; overflow-x:auto; padding:0;}
            .sidebar h2 {display:none;}
            .sidebar a {flex:1; text-align:center; padding:10px; border-left:none; border-bottom:3px solid transparent;}
            .sidebar a:hover {border-bottom:3px solid #1abc9c;}
        }

        .called-table {
            display:grid;
            grid-template-columns: repeat(10, 1fr);
            gap:4px;
            max-width:410px;
            margin-top:22px;
            margin-bottom:40px;
        }
        .called-table div {
            aspect-ratio:1/1; display:flex; justify-content:center; align-items:center;
            border:1px solid #bbb; background:#fff; border-radius:4px;
            font-size:1.18em; font-weight:bold;
        }
        .called { background:#1abc9c; color:white; border-color:#16a085;}
        #last-number {
            font-size:2em; color:#c0392b; font-weight:bold;
            margin-left:8px;
        }
        .game-title { font-size:1.20em; color:#2980b9; margin-bottom:8px;}
        .user-bar {margin-bottom:14px; font-size:1.1em; color:#555;}
    </style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <h2><?= $role_label ?></h2>
    <?php foreach ($sidebar_links[$role] as $link) echo "<a href='{$link[0]}'>{$link[1]}</a>"; ?>
</div>
<div class="content">
    <button class="toggle-btn" onclick="toggleSidebar()">☰ Menu</button>
    <div class="game-title"><?=htmlspecialchars($game_name)?> — Number Table</div>
    <div class="user-bar">
        Role: <b><?=ucfirst($role)?></b>
        <?php if ($username) echo "| User: <b>".htmlspecialchars($username)."</b>"; ?>
    </div>
    <h2>Last Number Called: <span id="last-number">--</span></h2>
    <div class="called-table" id="called-grid"></div>
</div>

<script>
// --- Collapsible sidebar ---
function toggleSidebar(){
    document.getElementById('sidebar').classList.toggle('collapsed');
    var content = document.querySelector('.content');
    if(content) content.classList.toggle('full');
}

// -- Called numbers rendering and polling --
function renderCalledNumbers(called, last){
    document.getElementById('last-number').textContent = last || '--';
    const grid = document.getElementById('called-grid');
    grid.innerHTML = '';
    for(let n=1; n<=90; n++){
        const div = document.createElement('div');
        if(called.includes(n)) div.classList.add('called');
        div.textContent = n;
        grid.appendChild(div);
    }
}

function updateCalledGrid(){
    fetch('get_called_numbers.php')
        .then(r => r.json())
        .then(data => {
            renderCalledNumbers(data.called || [], data.last || null);
        });
}
updateCalledGrid();
setInterval(updateCalledGrid, 3000);
</script>
</body>
</html>
