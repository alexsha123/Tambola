<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) session_start();
$role = $_SESSION['role'] ?? '';

$menus = [
    'admin' => [
        ['/game/admin/game_management.php',     '🎮 Game Management'],
        ['/game/admin/admin_game_view.php',     '📊 Game View'],
        ['/game/ticket_requests_common.php', '📨 Ticket Requests'],
        ['/game/winners.php',             '🏆 Winners'],
        ['/game/admin/agent_management.php',    '👥 Manage Agents'],
        ['/game/admin/admin_change_password.php','🔑 Change Username/Password'],
        ['/game/logout.php',        '🚪 Logout']
    ],
    'agent' => [
        ['/game/agent/agent_game_info.php',     '🎮 Game Info'],
        ['/game/agent/agent_game_view.php',     '📊 Game View'],
        ['/game/ticket_requests_common.php', '📨 Ticket Requests'],
        ['/game/winners.php',             '🏆 Winners'],
        ['/game/agent/agent_change_password.php','🔑 Change Username/Password'],
        ['/game/logout.php',        '🚪 Logout']
    ],
    'player' => [
        ['/game/player/index.php',               '🏠 My Tickets'],
        ['/game/winners.php',             '🏆 Winners'],
        ['game/logout.php',       '🚪 Logout']
    ],
];
?>
<!-- Sidebar Styles + Button -->
<style>
body { margin:0; }
.sidebar {
    background:#2c3e50;
    color:#ecf0f1;
    height:100vh;
    width:240px;
    position:fixed;
    top:0; left:0;
    box-shadow:0 0 10px rgba(0,0,0,0.13);
    z-index:200;
    overflow-y:auto;
    transition:transform .3s cubic-bezier(.55,0,.55,1);
    transform:translateX(0);
}
@media(max-width:800px){
    .sidebar { width:70vw; min-width:180px; transform:translateX(-100%);}
    .sidebar.open { transform:translateX(0);}
    .hamburger-btn { display:block;}
}
@media(min-width:801px){
    .sidebar { transform:translateX(0);}
    .sidebar.open { transform:translateX(0);}
    .hamburger-btn { display:none;}
}
.sidebar h2 {
    text-align:center;
    font-size:1.3em;
    margin:28px 0 22px 0;
    color:#1abc9c;
    letter-spacing:1px;
}
.sidebar a {
    display:flex; align-items:center; gap:11px;
    color:#ecf0f1; font-weight:500;
    text-decoration:none;
    padding:13px 18px; font-size:1em;
    border-left:5px solid transparent;
    border-radius:0 9px 9px 0;
    transition:all .22s ease;
    margin:0 7px;
}
.sidebar a:hover {
    background:#1abc9c; border-left-color:#148e70; color:#fff;
    transform:translateX(4px);
}
.hamburger-btn {
    position:fixed;
    top:16px; left:16px;
    background:#1abc9c;
    color:#fff;
    border:none; border-radius:4px;
    font-size:1.6em; padding:7px 13px;
    cursor:pointer; z-index:301;
    display:none;
}
</style>

<!-- Hamburger Toggle (shows only on mobile) -->
<button class="hamburger-btn" id="hamburgerBtn">☰</button>
<!-- Sidebar Panel -->
<div class="sidebar" id="sidebar">
    <h2><?= ucfirst($role) ?> Panel</h2>
    <?php foreach($menus[$role] ?? [] as $link): ?>
        <a href="<?= htmlspecialchars($link[0]) ?>"><?= $link[1] ?></a>
    <?php endforeach; ?>
</div>
<script>
// Sidebar toggle (works for all devices)
const sidebar = document.getElementById('sidebar');
const btn = document.getElementById('hamburgerBtn');
if (btn) {
    btn.addEventListener('click', function(){
        sidebar.classList.toggle('open');
    });
    document.addEventListener('click', function(e){
        if (sidebar.classList.contains('open') &&
            !sidebar.contains(e.target) &&
            e.target !== btn) {
            sidebar.classList.remove('open');
        }
    });
}
</script>
