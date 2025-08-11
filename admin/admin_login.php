<?php
session_start();
require '../db.php';
require '../functions.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND role='admin' LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = 'admin';
            header("Location: game_management.php");
            exit;
        }
    }
    $error = "Invalid username or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        margin:0;
        font-family:'Segoe UI', Arial, sans-serif;
        display:flex;
        align-items:center;
        justify-content:center;
        height:100vh;
        background: linear-gradient(135deg, #1abc9c, #16a085);
        animation: fadeIn 0.8s ease-in;
    }
    @keyframes fadeIn {
        from { opacity:0; transform: translateY(-10px); }
        to { opacity:1; transform: translateY(0); }
    }
    .login-box {
        background:#fff;
        padding:35px 28px;
        border-radius:12px;
        width:100%;
        max-width:350px;
        box-shadow:0 8px 20px rgba(0,0,0,0.15);
        animation: slideIn 0.6s ease;
    }
    @keyframes slideIn {
        from { opacity:0; transform: translateY(20px); }
        to { opacity:1; transform: translateY(0); }
    }
    h2 {
        text-align:center;
        margin-bottom:25px;
        color:#2c3e50;
    }
    .error {
        background: #ffeaea;
        color: #c0392b;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        text-align:center;
        font-size:0.95em;
    }
    input {
        width:100%;
        padding:12px;
        margin-bottom:15px;
        border:1px solid #ccc;
        border-radius:6px;
        font-size:1em;
        outline:none;
        transition: all 0.3s ease;
    }
    input:focus {
        border-color:#1abc9c;
        box-shadow:0 0 5px rgba(26,188,156,0.5);
        transform: scale(1.02);
    }
    button {
        width:100%;
        padding:12px;
        background:#1abc9c;
        color:#fff;
        border:none;
        font-size:1.05em;
        font-weight:600;
        border-radius:6px;
        cursor:pointer;
        transition: background 0.3s ease, transform 0.2s ease;
    }
    button:hover {
        background:#16a085;
        transform:translateY(-2px);
    }
    .footer-text {
        text-align:center;
        margin-top:12px;
        font-size:0.85em;
        color:#7f8c8d;
    }
</style>
</head>
<body>

<div class="login-box">
    <h2>🔐 Admin Login</h2>
    <?php if($error) echo "<div class='error'>$error</div>"; ?>
    <form method="post" autocomplete="off">
        <input name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <div class="footer-text">&copy; <?=date('Y')?> Tambola Dashboard</div>
</div>

</body>
</html>
