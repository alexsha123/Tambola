<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../db.php';
require '../functions.php';

// Only agents can access
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION['username'];
$error = $success = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cur          = trim($_POST['current_password']);
    $newPassword  = trim($_POST['new_password']);
    $conf         = trim($_POST['confirm_password']);
    $newUsername  = trim($_POST['new_username']);

    // Fetch and verify current password
    $q = $conn->prepare("SELECT password_hash FROM agent WHERE username=? AND role='agent'");
    $q->bind_param("s", $username);
    $q->execute();
    $row = $q->get_result()->fetch_assoc();
    $q->close();

    if (!$row || !password_verify($cur, $row['password_hash'])) {
        $error = "Current password is incorrect. ";
    } else {
        $changed = false;

        // Change password if provided
        if (!empty($newPassword)) {
            if ($newPassword !== $conf) {
                $error .= "New passwords do not match. ";
            } elseif (strlen($newPassword) < 6) {
                $error .= "Password must be at least 6 characters. ";
            } else {
                $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                $up = $conn->prepare("UPDATE agent SET password_hash=? WHERE username=? AND role='agent'");
                $up->bind_param("ss", $hash, $username);
                $up->execute();
                $up->close();
                $success .= "✅ Password updated successfully. ";
                $changed = true;
            }
        }

        // Change username if provided
        if (!empty($newUsername) && $newUsername !== $username) {
            $check = $conn->prepare("SELECT 1 FROM agent WHERE username=?");
            $check->bind_param("s", $newUsername);
            $check->execute();
            $check->store_result();
            if ($check->num_rows > 0) {
                $error .= "Username is already taken. ";
            } else {
                $upU = $conn->prepare("UPDATE agent SET username=? WHERE username=? AND role='agent'");
                $upU->bind_param("ss", $newUsername, $username);
                $upU->execute();
                $upU->close();
                $_SESSION['username'] = $newUsername;
                $username = $newUsername;
                $success .= "✅ Username updated successfully. ";
                $changed = true;
            }
            $check->close();
        }

        if (!$changed && empty($error)) {
            $error = "No changes made.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Agent — Change Username & Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<style>
body{margin:0;font-family:"Segoe UI",Arial,sans-serif;background:#f6f8fa;}
.content{padding:20px;margin-left:250px;}
@media(max-width:800px){.content{margin-left:0;padding:14px;}}
.header{background:#1abc9c;color:#fff;font-weight:700;font-size:1.3em;margin-bottom:20px;border-radius:8px;padding:14px;}
.card{background:#fff;border-radius:10px;padding:24px;box-shadow:0 4px 15px rgba(0,0,0,0.06);}
label{display:block;margin-bottom:6px;font-weight:500;}
input[type=password],input[type=text]{
    width:100%;padding:10px;border-radius:6px;border:1px solid #ccc;margin-bottom:14px;
}
input:focus{border-color:#1abc9c;outline:none;box-shadow:0 0 5px rgba(26,188,156,0.5);}
button{padding:10px 16px;background:#1abc9c;color:#fff;border:none;border-radius:6px;font-weight:600;cursor:pointer;}
button:hover{background:#15977b;}
.message{margin-top:10px;padding:10px 14px;border-radius:6px;}
.message.error{color:#b05917;background:#fff3e6;}
.message.success{color:#2777c2;background:#e6f6f9;}
</style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="content">
    <div class="header">Agent — Change Username & Password</div>
    <div class="card">
        <form method="post" autocomplete="off">
            <label>New Username (optional)</label>
            <input type="text" name="new_username" placeholder="Enter new username">

            <label>New Password (optional)</label>
            <input type="password" name="new_password" placeholder="Leave blank if not changing">

            <label>Confirm New Password</label>
            <input type="password" name="confirm_password" placeholder="Leave blank if not changing">

            <label>Current Password</label>
            <input type="password" name="current_password" required>

            <button type="submit">Update</button>
        </form>
        <?php if($error) echo "<div class='message error'>$error</div>"; ?>
        <?php if($success) echo "<div class='message success'>$success</div>"; ?>
    </div>
</div>

<script src="../assets/js/sidebar.js"></script>
</body>
</html>
