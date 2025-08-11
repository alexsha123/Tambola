<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require 'db.php';

// Only admin or agent can view
if (!isset($_SESSION['username']) || !in_array($_SESSION['role'], ['admin','agent'])) {
    http_response_code(403);
    exit('Forbidden');
}

$res = $conn->query("
    SELECT * FROM ticket_requests
    WHERE status='pending'
    ORDER BY game_id DESC, id DESC
");

if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        echo "<div class='card'>
                Game #".(int)$row['game_id']." — 
                <b>".htmlspecialchars($row['player_name'])."</b>
                requested ticket(s): ".htmlspecialchars($row['requested_ticket_ids'])."
                <form method='post' action='ticket_requests_common.php' style='display:inline;'>
                    <input type='hidden' name='approve_id' value='{$row['id']}'>
                    <button class='approve'>✅ Approve</button>
                </form>
                <form method='post' action='ticket_requests_common.php' style='display:inline;'>
                    <input type='hidden' name='reject_id' value='{$row['id']}'>
                    <button class='reject'>❌ Reject</button>
                </form>
              </div>";
    }
} else {
    echo "<div style='color:#b05917;font-weight:500;'>No pending requests for any game.</div>";
}
