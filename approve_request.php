<?php
session_start();
require 'db.php';
if (!isset($_SESSION['username']) || $_SESSION['role']!='admin'){ header("Location: admin.php"); exit; }
$game_id=$_SESSION['current_game_id'] ?? 0;
$msg="";

if(isset($_POST['approve_id'])){
    $rid=(int)$_POST['approve_id'];
    $req=$conn->query("SELECT * FROM ticket_requests WHERE id=$rid")->fetch_assoc();
    if($req && $req['status']=='pending'){
        foreach(explode(',',$req['requested_ticket_ids']) as $tid){
            $chk=$conn->query("SELECT assigned_to FROM ticket_pool WHERE id=".(int)$tid)->fetch_assoc();
            if($chk && !$chk['assigned_to']){
                $conn->query("UPDATE ticket_pool SET assigned_to='{$req['player_session']}',assigned_name='".$conn->real_escape_string($req['player_name'])."' WHERE id=".(int)$tid);
            }
        }
        $conn->query("UPDATE ticket_requests SET status='approved' WHERE id=$rid");
        $msg="✅ Request approved.";
    }
}
if(isset($_POST['reject_id'])){
    $rid=(int)$_POST['reject_id'];
    $conn->query("UPDATE ticket_requests SET status='rejected' WHERE id=$rid");
    $msg="❌ Request rejected.";
}
?>
<!DOCTYPE html>
<html>
<head><title>Ticket Requests</title></head>
<body>
<?php include 'admin_sidebar.php'; ?>
<div class="content">
<h2>📨 Ticket Requests</h2>
<?php if($msg) echo "<p style='color:blue;'>$msg</p>"; ?>

<?php
$res=$conn->query("SELECT * FROM ticket_requests WHERE game_id=$game_id AND status='pending'");
if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
        echo "<div><b>{$row['player_name']}</b> requested: [{$row['requested_ticket_ids']}]<br>
        <form method='post' style='display:inline'><input type='hidden' name='approve_id' value='{$row['id']}'><button class='approve'>✅ Approve</button></form>
        <form method='post' style='display:inline'><input type='hidden' name='reject_id' value='{$row['id']}'><button class='reject'>❌ Reject</button></form></div><hr>";
    }
} else echo "<p>No pending requests.</p>";
?>
</div>
</body>
</html>
