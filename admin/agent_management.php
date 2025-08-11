<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../db.php';
require '../functions.php';

// Only admins allowed
if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){ 
    header("Location: admin_login.php"); 
    exit; 
}

$msg = "";

// Add Agent
if(isset($_POST['add_agent'])){
    $user = trim($_POST['agent_username']);
    $pass = $_POST['agent_password'];
    if($user && $pass){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $conn->query("INSERT INTO admin (username, password_hash, role) VALUES ('".$conn->real_escape_string($user)."', '$hash', 'agent')");
        $msg = "✅ Agent '$user' added.";
    }
}

// Remove Agent
if(isset($_POST['remove_agent'])){
    $user = $_POST['agent_user'];
    $conn->query("DELETE FROM admin WHERE username='".$conn->real_escape_string($user)."' AND role='agent'");
    $msg = "🗑 Agent '$user' removed.";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambola Admin — Manage Agents</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    margin:0;
    font-family:"Segoe UI",Arial,sans-serif;
    background:#f6f8fa;
    min-height:100vh;
}
/* Content area */
.content {
    flex:1;
    padding:20px 30px;
    margin-left:250px; /* space for sidebar on desktop */
    box-sizing:border-box;
}
@media(max-width:800px){
    .content {
        margin-left:0;
        padding:15px;
    }
    .card { padding:15px; }
}
.header {
    background: #1abc9c;
    padding:15px;
    color:#fff;
    font-weight:700;
    font-size:1.3em;
    margin-bottom:20px;
    border-radius:8px;
}
.card {
    background:#fff;
    border-radius:10px;
    padding:24px;
    margin-bottom:20px;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
}
.card-title {
    font-size:1.14em;
    font-weight:700;
    margin-bottom:18px;
    color:#2253a9;
}
.message {
    background:#e6f6f9;
    padding:10px 15px;
    border-radius:6px;
    margin-bottom:15px;
    color:#2777c2;
    font-weight:500;
}
.message.error { background:#fff3e6; color:#b05917; }
input, select {
    width:100%;
    margin-bottom:12px;
    padding:10px;
    border-radius:6px;
    border:1px solid #aac8ec;
    font-size:1em;
    box-sizing:border-box;
}
button {
    padding:10px 15px;
    background:#1abc9c;
    color:#fff;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    transition:background .2s;
}
button:hover { background:#137d69; }
.remove-btn { background:#c0392b; }
.remove-btn:hover { background:#992d22; }
</style>
</head>
<body>

<?php include '../sidebar.php'; ?>

<div class="content">
    <div class="header">Tambola Admin — Manage Agents</div>

    <?php if($msg): ?>
        <div class="message<?=strstr($msg,'🗑') ? ' error' : ''?>"><?=$msg?></div>
    <?php endif; ?>

    <!-- Add Agent -->
    <div class="card">
        <div class="card-title">➕ Add New Agent</div>
        <form method="post">
            <input name="agent_username" placeholder="Agent Username" required>
            <input type="password" name="agent_password" placeholder="Agent Password" required>
            <button name="add_agent">Add Agent</button>
        </form>
    </div>

    <!-- Remove Agent -->
    <div class="card">
        <div class="card-title">🗑 Remove Agent</div>
        <form method="post">
            <select name="agent_user" required>
                <option value="">Select Agent to Remove</option>
                <?php
                $agents = $conn->query("SELECT username FROM admin WHERE role='agent'");
                while($a = $agents->fetch_assoc()){
                    echo "<option>".htmlspecialchars($a['username'])."</option>";
                }
                ?>
            </select>
            <button name="remove_agent" class="remove-btn">Remove Agent</button>
        </form>
    </div>
</div>

</body>
</html>
