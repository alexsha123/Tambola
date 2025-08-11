<?php
session_start();
require '../db.php';
require '../functions.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM admin WHERE username='".$conn->real_escape_string($username)."' AND role='agent'");
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['current_game_id'] = $conn->query("SELECT game_id FROM games ORDER BY game_id DESC LIMIT 1")->fetch_assoc()['game_id'] ?? 0;

            header("Location: agent/agent_game_info.php"); // Main agent page
            exit;
        }
    }
    $error = "Invalid username or password";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Agent Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { background:#e0e0ec; height:100vh; display:flex; align-items:center; justify-content:center; font-family:Arial,sans-serif; }
.login-box { background:#fff; padding:2em; border-radius:15px; box-shadow:0 3px 12px #b2abe2; max-width:320px; width:100%; }
h2 { color:#44147d; text-align:center; margin-bottom:22px;}
input { width:100%; padding:10px; margin:7px 0; border-radius:7px; border:1px solid #b1a2f6;}
button { width:100%; padding:12px; background:#5c21a8; color:#fff; border:none; border-radius:8px; font-size:1em; cursor:pointer;}
button:hover { background:#2c0d5e;}
.error { color:red; text-align:center; font-weight:bold;}
</style>
</head>
<body>
<div class="login-box">
<h2>Agent Login</h2>
<form method="post" autocomplete="off">
    <input name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<?php if(!empty($error)) echo "<div class='error'>$error</div>"; ?>
</div>
</body>
</html>
