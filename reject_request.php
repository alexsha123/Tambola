<?php
session_start(); require 'db.php';
$id=(int)$_GET['id'];
$conn->query("UPDATE ticket_requests SET status='rejected' WHERE id=$id");
header("Location: ".($_SESSION['role']=='agent'?'agent_dashboard.php':'admin_dashboard.php'));
?>
