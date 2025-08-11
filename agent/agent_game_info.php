<?php
session_start();
require '../db.php';
require '../functions.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'agent') {
    header("Location: agent_login.php"); exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Agent — Game Info</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { margin:0; font-family:Arial,sans-serif; background:#f6f8fa; min-height:100vh; }
.content {
    flex:1; padding:24px 30px; margin-left:250px; box-sizing:border-box;
}
@media(max-width:800px){
    .content { margin-left:0; padding:15px; }
}
.header {
    background:#2980b9; color:#fff; font-weight:700; font-size:1.3em;
    margin-bottom:20px; border-radius:8px; padding:14px;
}
</style>
</head>
<body>
<?php include '../sidebar.php'; ?>

<div class="content">
    <div class="header">Agent — Game Info</div>
    <p>Welcome, <b><?=htmlspecialchars($username)?></b>. This is your main agent dashboard.</p>
    <!-- Add live game info, numbers, or tickets as needed -->
</div>
</body>
</html>
