<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'db.php';
require 'functions.php';

if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], ['admin', 'agent'])) {
    header("Location: ../index.php");
    exit;
}

$role = $_SESSION['role'];
$msg  = "";

// Approve request
if (isset($_POST['approve_id'])) {
    $rid = (int)$_POST['approve_id'];
    $req = $conn->query("SELECT * FROM ticket_requests WHERE id=$rid")->fetch_assoc();

    if ($req && $req['status'] === 'pending') {
        foreach (explode(',', $req['requested_ticket_ids']) as $tid) {
            $tid = (int)$tid;
            $chk = $conn->query("SELECT assigned_to FROM ticket_pool WHERE id=$tid")->fetch_assoc();
            if ($chk && !$chk['assigned_to']) {
                $conn->query("
                    UPDATE ticket_pool 
                    SET assigned_to='".$conn->real_escape_string($req['player_name'])."',
                        assigned_name='".$conn->real_escape_string($req['player_name'])."'
                    WHERE id=$tid
                ");
            }
        }
        $conn->query("UPDATE ticket_requests SET status='approved' WHERE id=$rid");
        $msg = "✅ Request approved.";
    }
}

// Reject request
if (isset($_POST['reject_id'])) {
    $rid = (int)$_POST['reject_id'];
    $conn->query("UPDATE ticket_requests SET status='rejected' WHERE id=$rid");
    $msg = "❌ Request rejected.";
}

// AJAX output for pending requests
if (isset($_GET['ajax'])) {
    $data = [];
    $res = $conn->query("SELECT * FROM ticket_requests WHERE status='pending' ORDER BY game_id DESC, id DESC");
    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tambola <?=ucfirst($role)?> — Ticket Requests</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
:root {
    --primary: #1abc9c;
    --approve: #27ae60;
    --approve-hover: #1f8a4d;
    --reject: #c0392b;
    --reject-hover: #992d22;
    --light-bg: #f6f8fa;
    --card-bg: #fff;
}
body { margin:0; font-family:"Segoe UI",Arial,sans-serif; background:var(--light-bg); min-height:100vh; }
.content { padding:20px 30px; margin-left:250px; }
@media(max-width:800px){ .content { margin-left:0; padding:14px; } }
.header { background:var(--primary); padding:15px; color:#fff; font-weight:700; font-size:1.3em; border-radius:8px; margin-bottom:20px; }
.message { background:#e6f6f9; padding:10px 15px; border-radius:6px; color:#2777c2; font-weight:500; margin-bottom:15px; }
.message.error { background:#fff3e6; color:#b05917; }
.card { background:var(--card-bg); border-radius:10px; padding:18px; margin-bottom:15px; box-shadow:0 2px 12px rgba(0,0,0,0.05); }
.card b { color:#2253a9; }
.approve, .reject { border:none; border-radius:6px; padding:7px 14px; color:#fff; cursor:pointer; font-weight:600; }
.approve { background:var(--approve); }
.reject { background:var(--reject); margin-left:10px; }
.approve:hover { background:var(--approve-hover); }
.reject:hover { background:var(--reject-hover); }
</style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="content">
    <div class="header">Tambola <?=ucfirst($role)?> — Ticket Requests</div>
    <?php if($msg): ?>
        <div class="message<?=strstr($msg,'❌') ? ' error' : ''?>"><?=$msg?></div>
    <?php endif; ?>

    <div id="requests-container">Loading requests...</div>
</div>

<script>
async function loadRequests(){
    try {
        const res  = await fetch('?ajax=1');
        const data = await res.json();
        const container = document.getElementById('requests-container');

        if (data.length === 0) {
            container.innerHTML = `<div style='color:#b05917;font-weight:500;'>No pending requests for any game.</div>`;
            return;
        }

        container.innerHTML = data.map(row => `
            <div class="card">
                Game #${row.game_id} — 
                <b>${row.player_name}</b>
                requested ticket(s): ${row.requested_ticket_ids}
                <form method="post" style="display:inline;">
                    <input type="hidden" name="approve_id" value="${row.id}">
                    <button class="approve">✅ Approve</button>
                </form>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="reject_id" value="${row.id}">
                    <button class="reject">❌ Reject</button>
                </form>
            </div>
        `).join('');
    } catch (err) {
        console.error('Error loading requests:', err);
    }
}

loadRequests();
setInterval(loadRequests, 5000);
</script>

</body>
</html>
