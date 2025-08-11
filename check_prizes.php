<?php
// expects $game_id and $conn to be available
$called_nums = [];
$res = $conn->query("SELECT number FROM called_numbers WHERE game_id=$game_id");
while ($r = $res->fetch_assoc()) $called_nums[] = (int)$r['number'];

$tickets = $conn->query("SELECT id, ticket_data, assigned_name FROM ticket_pool 
                         WHERE game_id=$game_id AND assigned_to IS NOT NULL");

while($t = $tickets->fetch_assoc()) {
    $grid = json_decode($t['ticket_data'], true);

    // First Line example
    foreach ($grid as $row) {
        $nums_in_row = array_filter($row);
        if ($nums_in_row && count(array_intersect($nums_in_row, $called_nums)) === count($nums_in_row)) {
            $conn->query("INSERT IGNORE INTO winners(game_id, ticket_id, winner_name, prize, won_at) 
                          VALUES ($game_id, {$t['id']}, '{$conn->real_escape_string($t['assigned_name'])}', 'First Line', NOW())");
            break;
        }
    }

    // Full House example
    $all_nums = [];
    foreach($grid as $row) $all_nums = array_merge($all_nums, array_filter($row));
    if (count(array_intersect($all_nums, $called_nums)) === count($all_nums)) {
        $conn->query("INSERT IGNORE INTO winners(game_id, ticket_id, winner_name, prize, won_at) 
                      VALUES ($game_id, {$t['id']}, '{$conn->real_escape_string($t['assigned_name'])}', 'Full House', NOW())");
    }
}
