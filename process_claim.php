<?php
session_start();
require 'db.php';
if (!isset($_SESSION['username']) || $_SESSION['role']!=='admin') die('Unauthorized');

$id=(int)$_GET['id'];
$action=$_GET['action']??'';
$claim=$conn->query("SELECT * FROM claims WHERE claim_id=$id")->fetch_assoc();
if(!$claim) die("Claim not found");

if($action==='approve'){
    $conn->query("UPDATE claims SET status='approved', approved_at=NOW() WHERE claim_id=$id");
    $conn->query("UPDATE claims SET status='rejected' 
                  WHERE game_id={$claim['game_id']} 
                  AND claim_type='{$conn->real_escape_string($claim['claim_type'])}' 
                  AND claim_id<>$id AND status='pending'");
} else {
    $conn->query("UPDATE claims SET status='rejected' WHERE claim_id=$id");
}

// Auto-finish if all prizes claimed
$gameRow=$conn->query("SELECT prizes FROM games WHERE game_id={$claim['game_id']}")->fetch_assoc();
$expectedPrizes=array_map('trim', explode(',',$gameRow['prizes']));
$approved=[];
$res=$conn->query("SELECT DISTINCT claim_type FROM claims WHERE game_id={$claim['game_id']} AND status='approved'");
while($row=$res->fetch_assoc()) $approved[]=$row['claim_type'];
if($expectedPrizes && !array_diff($expectedPrizes,$approved)){
    $conn->query("UPDATE games SET status='finished' WHERE game_id={$claim['game_id']}");
    unset($_SESSION['game_id']);
}
header("Location: admin_dashboard.php");
?>
