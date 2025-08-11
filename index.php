<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';

// Already logged in → redirect to correct dashboard
if (!empty($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'admin':
            header("Location: admin/game_management.php");
            exit;
        case 'agent':
            header("Location: agent/agent_game_view.php");
            exit;
        case 'player':
            header("Location: player/index.php");
            exit;
    }
}

// Handle role selection submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';

    if ($role === 'admin') {
        header("Location: admin/admin_login.php");
        exit;
    } elseif ($role === 'agent') {
        header("Location: agent/agent_login.php");
        exit;
    } elseif ($role === 'player') {
        $_SESSION['role'] = 'player';
        header("Location: player/index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambola Game — Start</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body, html {
    margin: 0; padding: 0; height: 100%;
    font-family: Arial, sans-serif;
    background: url('assets/images/Background.jpeg') no-repeat center center fixed;
    background-size: cover;
}
.overlay {
    background: rgba(255,255,255,0.90);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.landing-box {
    background: rgba(255,255,255,0.96);
    padding: 32px 28px 26px 28px;
    border-radius: 14px;
    box-shadow: 0 6px 28px rgba(0,0,0,0.12);
    max-width:350px; width:100%;
    text-align: center;
    margin:20px;
    color: #2253a9;

}
.landing-box img {
    max-width: 150px;
    margin: 0 auto 12px auto;
    display: block;
}
.landing-box h1 {
    color: #1abc9c;
    margin-bottom: 12px;
}
.landing-box p {
    color: #333;
    margin-bottom: 24px;
    font-size: 1.07em;
}
select, button {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    font-size: 1em;
    border-radius: 6px;
    border: 1px solid #c7d5e7;
    box-sizing: border-box;
}
button {
    background: #1abc9c;
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
    transition: background .2s;
}
button:hover {
    background: #15977b;
}
.whatsapp-join {
    margin-top: 18px;
    display: block;
    color:#25D366;
    font-weight: bold;
    text-decoration:none;
    background:#e6f6ea;
    padding:8px 12px;
    border-radius:7px;
    font-size:1em;
    box-shadow:0 2px 10px #25d36633;
    max-width:220px;
    margin-left:auto; margin-right:auto;
}
@media (max-width: 600px) {
    .landing-box { padding: 18px 8px 16px 8px; }
}
</style>
</head>
<body>
<div class="overlay">
    <div class="landing-box">
        <img src="assets/images/Logo.png" alt="Tambola Logo" />
        <h1>Tambola Online</h1>
        <p>
            Welcome! Select your role below to continue.<br>
            <b>No login required for players!</b>
        </p>
        <form method="post">
            <select name="role" required>
                <option value="">Continue as...</option>
                <option value="player">Player</option>
                <option value="agent">Agent</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Go</button>
        </form>
        <div style="margin-top:24px; color:#337;">
            <b>Stay connected!</b><br>
            Join our WhatsApp group for updates, help, and community <br>
            <a class="whatsapp-join" href="https://chat.whatsapp.com/YourGroupInviteLink" target="_blank" rel="noopener">
                📱 Join WhatsApp Group
            </a>
        </div>
        <div style="margin-top:16px; font-size:0.94em; color:#777;">
            For organizers: Use Agent/Admin role<br>
            For quick play: Just choose Player and jump right in!
        </div>
    </div>
</div>
</body>
</html>
