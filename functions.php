<?php
// ============================
// AUTH HELPERS
// ============================

/**
 * Check if logged-in user is Admin
 * @return bool
 */
function isLoggedInAdmin() {
    return isset($_SESSION['username']) && ($_SESSION['role'] ?? '') === 'admin';
}

/**
 * Check if logged-in user is Agent
 * @return bool
 */
function isLoggedInAgent() {
    return isset($_SESSION['username']) && ($_SESSION['role'] ?? '') === 'agent';
}

// ============================
// NUMBER CALLING HELPERS
// ============================

/**
 * Get all called numbers for a given game
 *
 * @param mysqli $conn  Database connection
 * @param int    $game_id Game ID
 * @return array List of integers (called numbers)
 */
function getCalledNumbers($conn, $game_id) {
    $called = [];
    $game_id = (int)$game_id;
    if ($game_id <= 0) {
        return $called; // No valid game ID
    }

    $sql = "SELECT number 
            FROM called_numbers 
            WHERE game_id = ? 
            ORDER BY called_at";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $game_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $called[] = (int)$row['number'];
        }
    }
    $stmt->close();

    return $called;
}

/**
 * Call the next random number for a game
 *
 * @param mysqli $conn   Database connection
 * @param int    $game_id Current game ID
 * @return int|null The next number called or null if all called
 */
function callNextNumber($conn, $game_id) {
    $called = getCalledNumbers($conn, $game_id);

    $allNumbers = range(1, 90);           // Full Tambola/Housie board
    $available  = array_diff($allNumbers, $called);

    if (empty($available)) {
        return null; // All numbers have been called
    }

    $next = $available[array_rand($available)]; // Pick one random available

    // Insert into called_numbers table, PRIMARY KEY will prevent duplicates
    $stmt = $conn->prepare(
        "INSERT IGNORE INTO called_numbers (game_id, number) VALUES (?, ?)"
    );
    $g_id = (int)$game_id;
    $stmt->bind_param("ii", $g_id, $next);
    $stmt->execute();
    $stmt->close();

    return $next;
}
