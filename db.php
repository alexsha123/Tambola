<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$dbname = "tambola_game";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("DB Connection Failed: " . $conn->connect_error);

$conn->set_charset("utf8mb4") or die("Charset Error: " . $conn->error);

// PHP timezone
date_default_timezone_set('Asia/Kolkata');

// MySQL timezone
$conn->query("SET time_zone = '+05:30'");
?>
