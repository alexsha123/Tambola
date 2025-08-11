<?php
session_start();
require '../db.php';
require '../functions.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'agent') {
    header("Location: agent_login.php");
    exit;
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentUsername = $_SESSION['username'];
    $newUsername = trim($_POST['new_username']);
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'] ?? '';

    // Fetch current user record
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND role='agent' LIMIT 1");
    $stmt->bind_param("s", $currentUsername);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($currentPassword, $row['password_hash'])) {
            // Password verified, proceed

            // Check if new username is different and not empty
            if ($newUsername !== $currentUsername && !empty($newUsername)) {
                // Check if new username already exists
                $checkStmt = $conn->prepare("SELECT username FROM admin WHERE username=? LIMIT 1");
                $checkStmt->bind_param("s", $newUsername);
                $checkStmt->execute();
                $checkRes = $checkStmt->get_result();
                if ($checkRes->num_rows > 0) {
                    $error = "Username already taken.";
                } else {
                    // Update username
                    $updateStmt = $conn->prepare("UPDATE admin SET username=? WHERE username=? AND role='agent'");
                    $updateStmt->bind_param("ss", $newUsername, $currentUsername);
                    if ($updateStmt->execute()) {
                        $_SESSION['username'] = $newUsername;
                        $success = "Username updated successfully.";
                        $currentUsername = $newUsername; // for form display
                    } else {
                        $error = "Failed to update username.";
                    }
                }
                $checkStmt->close();
            }

            // If no error so far and new password provided, update password
            if (!$error && !empty($newPassword)) {
                $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $pwStmt = $conn->prepare("UPDATE admin SET password_hash=? WHERE username=? AND role='agent'");
                $pwStmt->bind_param("ss", $newHash, $currentUsername);
                if ($pwStmt->execute()) {
                    $success .= ($success ? " " : "") . "Password updated successfully.";
                } else {
                    $error = "Failed to update password.";
                }
                $pwStmt->close();
            }

        } else {
            $error = "Current password is incorrect.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Agent Profile Update</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
.container {
    background: #fff;
    padding: 32px 28px;
    border-radius: 10px;
    box-shadow: 0 2px 14px #0001;
    max-width: 400px;
    width: 100%;
}
h2 {
    margin-bottom: 18px;
    text-align: center;
}
input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
button {
    width: 100%;
    padding: 12px;
    background: #2980b9;
    color: #fff;
    border: none;
    font-size: 1.05em;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
}
button:hover {
    background: #216097;
}
.error {
    color: #c0392b;
    font-weight: 600;
    text-align: center;
    margin-bottom: 12px;
}
.success {
    color: #27ae60;
    font-weight: 600;
    text-align: center;
    margin-bottom: 12px;
}
label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
}
</style>
</head>
<body>
    <?php include '../sidebar.php'; ?>
<div class="container">
    <h2>Update Profile</h2>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <label>Current Username (not editable)</label>
        <input type="text" value="<?= htmlspecialchars($_SESSION['username']) ?>" disabled>

        <label>New Username</label>
        <input type="text" name="new_username" placeholder="Enter new username" value="<?= htmlspecialchars($_SESSION['username']) ?>" required>

        <label>Current Password</label>
        <input type="password" name="current_password" placeholder="Enter current password" required>

        <label>New Password (optional)</label>
        <input type="password" name="new_password" placeholder="Enter new password">

        <button type="submit">Update Profile</button>
    </form>
</div>
</body>
</html>
