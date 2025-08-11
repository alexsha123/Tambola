<?php
session_start();
require '../db.php';
require '../functions.php';
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND role='agent' LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'agent';
            header("Location: agent_game_info.php");
            exit;
        }
    }
    $error = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Agent Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{font-family:Arial,sans-serif;background:#f4f6f9;display:flex;align-items:center;justify-content:center;height:100vh;}
.container{background:#fff;padding:32px 28px;border-radius:10px;box-shadow:0 2px 14px #0001;max-width:340px;width:100%;}
h2{margin-bottom:18px;text-align:center;}
input{width:100%;padding:12px;margin-bottom:15px;border-radius:6px;border:1px solid #ccc;}
button{width:100%;padding:12px;background:#2980b9;color:#fff;border:none;font-size:1.05em;border-radius:6px;font-weight:600;}
button:hover{background:#216097;}
.error{color:#c0392b;font-weight:600;text-align:center;margin-bottom:12px;}
</style>
</head>
<body>
<div class="container">
    <h2>Agent Login</h2>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
        <input name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>Login</button>
    </form>
</div>
</body>
</html>
