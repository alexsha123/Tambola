<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Only clear player-specific session data
unset($_SESSION['username'], $_SESSION['role'], $_SESSION['current_game_id'], $_SESSION['player_id'], $_SESSION['player_session']);

session_write_close();

// If you want to fully destroy the session cookie, also add:
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
    // If you also set a persistent player_id cookie, clear that too:
    if (isset($_COOKIE['player_id'])) {
        setcookie('player_id', '', time() - 3600, '/');
    }
}

// Redirect to the common index page (“Start” page)
header("Location: ../index.php");
exit;
