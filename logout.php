<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Destroy the session and its data
$_SESSION = [];
session_unset();
session_destroy();

// Optionally, clear cookie (if any)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to the login page (choose a common landing or role-specific)
header("Location: index.php");
exit;
?>
