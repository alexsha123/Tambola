<?php
require 'db.php';

// Get latest running game
$gid = $conn->query("
    SELECT game_id FROM games
    WHERE status='running'
    ORDER BY game_id DESC LIMIT 1
")->fetch_assoc()['game_id'] ?? 0;

if (!$gid) {
    echo "No active running game.";
    exit;
}

// Fetch numbers already called for this game
$called = [];
$res = $conn->query("SELECT number_called FROM called_numbers WHERE game_id=$gid ORDER BY id ASC");
while ($r = $res->fetch_assoc()) {
    $called[] = (int)$r['number_called'];
}

$remaining = array_diff(range(1,90), $called);

if ($remaining) {
    $next = $remaining[array_rand($remaining)];
    $conn->query("INSERT INTO called_numbers (game_id, number_called) VALUES ($gid, $next)");
    echo "✅ Called number: $next";
} else {
    // No numbers left — finish game
    $conn->query("UPDATE games SET status='finished' WHERE game_id=$gid");
    echo "🏁 Game finished.";
}
