<?php


session_start();
require '../db.php'; // Adjust if db.php is in a different folder

// Only allow admins
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$stoppedGames = [];

// Get all active games
$activeGames = $conn->query("SELECT game_id, prizes FROM games WHERE status != 'finished'");
if ($activeGames) {
    while ($g = $activeGames->fetch_assoc()) {
        $gid = (int)$g['game_id'];
        $selectedPrizes = array_map('trim', explode(',', $g['prizes']));

        // How many unique prizes have winners
        $stmt = $conn->prepare("SELECT COUNT(DISTINCT prize_name) AS won_count FROM winners WHERE game_id = ?");
        $stmt->bind_param("i", $gid);
        $stmt->execute();
        $res = $stmt->get_result();
        $wonCount = $res->fetch_assoc()['won_count'] ?? 0;
        $stmt->close();

        // If all prizes won, mark the game as finished
        if ($wonCount >= count($selectedPrizes) && count($selectedPrizes) > 0) {
            $up = $conn->prepare("UPDATE games SET status = 'finished' WHERE game_id = ?");
            $up->bind_param("i", $gid);
            if ($up->execute()) {
                $stoppedGames[] = $gid;
            }
            $up->close();
        }
    }
}

// Return JSON to the browser
header('Content-Type: application/json');
echo json_encode(['stoppedGames' => $stoppedGames]);
