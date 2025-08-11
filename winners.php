<?php
// Show errors for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';
require 'functions.php';

// Allow only admin, agent, or player
$allowed_roles = ['admin', 'agent', 'player'];
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'];

// Check winners table structure first
// Assuming winners table has: id, game_id, winner_name, won_at
// ✅ If you later add 'prize' column, uncomment it in the query
$sql = "SELECT w.id, w.game_id, w.winner_name, won_at, g.status AS game_status
        FROM winners w
        LEFT JOIN games g ON w.game_id = g.game_id
        ORDER BY w.won_at DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Tambola Winners List</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="assets/css/sidebar.css" />
<style>
body { margin:0; font-family: "Segoe UI", Arial, sans-serif; background:#f6f8fa; }
.content { padding: 20px 30px; margin-left: 250px; }
@media(max-width:800px) { .content { margin-left: 0; padding: 14px; } }
.header {
    background: #1abc9c; padding: 15px; color: white;
    font-weight: 700; font-size: 1.3em; border-radius: 8px;
    margin-bottom: 20px; box-shadow: 0 3px 6px rgba(0,0,0,0.15);
}
.table {
    width: 100%; border-collapse: collapse; background: white;
    border-radius: 8px; overflow: hidden;
    box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
}
.table th, .table td {
    padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd;
}
.table th { background: #2980b9; color: white; }
.table tr:hover { background: #f1f1f1; }
.no-data { font-weight: 600; color: #b05917; margin-top: 20px; }
</style>
</head>
<body>

<!-- Include COMMON SIDEBAR -->
<?php include __DIR__ . '/sidebar.php'; ?>

<div class="content">
    <div class="header">Tambola Winners List</div>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Game ID</th>
                    <th>Winner Name</th>
                    <!-- <th>Prize</th> Uncomment if prize column exists -->
                    <th>Won At</th>
                    <th>Game Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= (int)$row['game_id'] ?></td>
                    <td><?= htmlspecialchars($row['winner_name']) ?></td>
                    <!-- <td><?= htmlspecialchars($row['prize']) ?></td> -->
                    <td><?= htmlspecialchars($row['won_at']) ?></td>
                    <td><?= htmlspecialchars($row['game_status'] ?? 'N/A') ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-data">No winners found yet.</div>
    <?php endif; ?>
</div>

<script src="assets/js/sidebar.js"></script>
</body>
</html>
