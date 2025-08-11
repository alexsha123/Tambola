<?php
/**
 * Generate a Tambola / Housie ticket.
 * 
 * Rules:
 * - 3 rows x 9 columns grid
 * - Each row contains exactly 5 numbers (4 blanks)
 * - Columns contain 1–3 numbers from specific ranges:
 *   Col 0: 1–10, Col 1: 11–20, ... Col 8: 81–90
 * - Numbers in a column are sorted top to bottom
 * - Returns a 2D array with numbers or null for blanks
 */

function generateTicket() {
    // Number ranges for each column (9 columns)
    $columnRanges = [
        range(1, 10), range(11, 20), range(21, 30), range(31, 40), range(41, 50),
        range(51, 60), range(61, 70), range(71, 80), range(81, 90)
    ];

    // Start with 1 number per column
    $positions = array_fill(0, 9, 1);
    $remaining = 15 - 9; // Total 15 numbers, 9 assigned one each initially

    // Distribute remaining 6 numbers amongst columns, max 3 per column
    while ($remaining > 0) {
        $c = array_rand($positions);
        if ($positions[$c] < 3) {
            $positions[$c]++;
            $remaining--;
        }
    }

    // Pick random numbers for each column according to count in positions
    $ticketCols = [];
    foreach ($positions as $col => $count) {
        $nums = $columnRanges[$col];
        shuffle($nums);
        $picked = array_slice($nums, 0, $count);
        sort($picked);
        $ticketCols[$col] = $picked;
    }

    // Prepare empty 3x9 grid with nulls
    $grid = array_fill(0, 3, array_fill(0, 9, null));
    $rowCounts = array_fill(0, 3, 0);

    // Place numbers in random rows per column, respecting max 5 numbers per row
    foreach ($ticketCols as $col => $nums) {
        $rows = [0, 1, 2];
        shuffle($rows);
        foreach ($nums as $num) {
            foreach ($rows as $i => $r) {
                if ($rowCounts[$r] < 5 && $grid[$r][$col] === null) {
                    $grid[$r][$col] = $num;
                    $rowCounts[$r]++;
                    unset($rows[$i]); // remove row to avoid placing another num in same col for this iteration
                    $rows = array_values($rows);
                    break;
                }
            }
        }
    }

    // Ensure each row has exactly 5 numbers by filling empty spots if needed
    for ($r = 0; $r < 3; $r++) {
        while ($rowCounts[$r] < 5) {
            // Find empty columns in the row
            $emptyCols = [];
            for ($c = 0; $c < 9; $c++) {
                if ($grid[$r][$c] === null) $emptyCols[] = $c;
            }
            if (empty($emptyCols)) break;

            // Try to add a number in an empty column if column count permits
            $c = $emptyCols[array_rand($emptyCols)];
            $possibleNums = array_diff($columnRanges[$c], $ticketCols[$c]);

            if (!empty($possibleNums) && count($ticketCols[$c]) < 3) {
                shuffle($possibleNums);
                $num = array_shift($possibleNums);
                $grid[$r][$c] = $num;
                $ticketCols[$c][] = $num;
                sort($ticketCols[$c]);
                $rowCounts[$r]++;
            } else {
                // No suitable number could be added, break to avoid infinite loop
                break;
            }
        }
    }

    return $grid;
}
?>
