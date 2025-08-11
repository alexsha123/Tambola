<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../db.php';
require '../functions.php';

$player_username = $_SESSION['username'] ?? null;
if (!$player_username) {
    header('Location: login.php'); // redirect to login if not set
    exit;
}

if (empty($_SESSION['current_game_id'])) {
    $latest = $conn->query("SELECT game_id FROM games WHERE status IN ('selecting','running') ORDER BY game_id DESC LIMIT 1")->fetch_assoc();
    $_SESSION['current_game_id'] = $latest['game_id'] ?? 0;
}
$game_id = $_SESSION['current_game_id'];
$game = $game_id ? $conn->query("SELECT * FROM games WHERE game_id=$game_id")->fetch_assoc() : null;
$status = $game['status'] ?? '';

$msg = '';

// Assigned tickets
$assigned = [];
$res = $conn->query("SELECT * FROM ticket_pool WHERE assigned_to='" . $conn->real_escape_string($player_username) . "' AND game_id=$game_id");
while ($row = $res->fetch_assoc()) $assigned[] = $row;

// Available tickets for selecting phase
$available_tickets = [];
if (!$assigned && $status === 'selecting') {
    $t = $conn->query("SELECT * FROM ticket_pool WHERE game_id=$game_id AND (assigned_to IS NULL OR assigned_to='')");
    while ($row = $t->fetch_assoc()) $available_tickets[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tambola — Player</title>
<style>
body {
  margin: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  background: linear-gradient(120deg, #f6f7fb 60%, #e9f6ec 100%);
  color: #34495e;
}
.sidebar {
  background: #2c3e50;
  color: #ecf0f1;
  height: 100vh;
  width: 240px;
  position: fixed;
  top: 0; left: 0;
  box-shadow: 0 0 10px rgba(0,0,0,0.13);
  z-index: 200;
  overflow-y: auto;
  transition: transform 0.3s cubic-bezier(.55,0,.55,1);
  transform: translateX(0);
}
.sidebar.open {
  transform: translateX(0);
}
@media (max-width: 800px) {
  .sidebar {
    width: 70vw;
    min-width: 180px;
    transform: translateX(-100%);
  }
  .sidebar.open {
    transform: translateX(0);
  }
}

.sidebar h2 {
  text-align: center;
  font-size: 1.3em;
  margin: 28px 0 22px;
  color: #1abc9c;
  letter-spacing: 1px;
}
.sidebar a {
  display: flex;
  align-items: center;
  gap: 11px;
  color: #ecf0f1;
  font-weight: 500;
  text-decoration: none;
  padding: 13px 18px;
  font-size: 1em;
  border-left: 5px solid transparent;
  border-radius: 0 9px 9px 0;
  transition: all 0.22s ease;
  margin: 0 7px;
}
.sidebar a:hover {
  background: #1abc9c;
  border-left-color: #148e70;
  color: #fff;
  transform: translateX(4px);
}

/* Smaller toggle button */
.sidebar-toggle-btn {
  position: fixed;
  top: 16px;
  left: 16px;
  background: #1abc9c;
  color: white;
  border: none;
  border-radius: 3px;
  padding: 4px 8px;
  font-size: 0.75em;
  font-weight: 600;
  cursor: pointer;
  z-index: 301;
  user-select: none;
  transition: background 0.25s ease;
  display: none;
}
.sidebar-toggle-btn:hover {
  background: #148e70;
}
@media (max-width: 800px) {
  .sidebar-toggle-btn {
    display: block;
  }
}

.content {
  margin-left: 240px;
  padding: 18px;
  transition: margin-left 0.3s ease;
  min-height: 100vh;
}
@media (max-width: 800px) {
  .content {
    margin-left: 0;
    padding-left: 70px; /* leave space for toggle button */
    padding-top: 50px;  /* clear toggle button vertical space */
  }
}

/* Ticket and other styles */
.ticket-list { display:flex; flex-wrap:wrap; gap:15px; justify-content:center; }
.ticket-card {
  background: linear-gradient(114deg, #fff 78%, #e8faf8 100%);
  border: 1.7px solid #b0e1d3;
  box-shadow: 0 2px 12px rgba(33,203,178,0.08);
  border-radius: 18px;
  padding: 15px;
  min-width: 180px;
  transition: box-shadow 0.15s;
}
.ticket-card:hover {
  box-shadow: 0 8px 28px rgba(33,203,178,0.13);
  border-color: #19c7b2;
}
.ticket-card > div { font-weight: 600; margin-bottom: 7px; color: #2d7c6f; }
.ticket input[type=checkbox] { accent-color: #19c7b2; margin-bottom: 8px; }
.ticket { border-collapse: collapse; width: 100%; margin-top: 6px; }
.ticket td {
  border: 1px solid #e0e6ed;
  width: 28px; height: 28px;
  color: #19c7b2; background: #f8fefd;
  text-align: center;
  border-radius: 4px;
  font-weight: 500;
}
.ticket td.empty {
  background: #effaf6; color: #b7c4ca; border-style: dotted;
}

.message {
  margin: 13px auto;
  background: linear-gradient(82deg, #e2fff9 80%, #f8e2ff 100%);
  border-radius: 14px;
  max-width: 420px;
  padding: 11px;
  color: #19c7b2;
  font-weight: 600;
  font-size: 1.05em;
  box-shadow: 0 2px 9px rgba(44, 62, 80, 0.06);
  border: 1px solid #b0e1d3;
}

button {
  background: linear-gradient(118deg, #19c7b2 0%, #48af9f 93%);
  color: #fff;
  border: none;
  border-radius: 9px;
  padding: 12px;
  width: 98%;
  font-weight: 600;
  font-size: 1.08em;
  margin-top: 16px;
  cursor: pointer;
}

/* Number board */
#calledNumbersGrid {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
  gap: 7px;
  max-width: 470px;
  margin: 0 auto 15px auto;
}
#calledNumbersGrid div {
  background: #eafaf6;
  color: #57ac85;
  padding: 9px 0;
  border-radius: 10px;
  font-weight: 600;
  font-size: 1.08em;
  border: 1.3px solid #b0e1d3;
}
#calledNumbersGrid div.called {
  background: #19c7b2;
  color: #fff;
  border-color: #13b6a0;
}
#calledNumbersGrid div.last {
  background: #e85e67 !important;
  color: #fff !important;
}
#lastCalledNumber {
  font-size: 1.4em;
  margin-bottom: 16px;
  color: #19c7b2;
  font-weight: 600;
}
</style>
</head>
<body>

<button id="sidebarToggleBtn" class="sidebar-toggle-btn" aria-label="Toggle sidebar">Show Sidebar</button>

<div class="sidebar" id="sidebar">
    <h2>Player Panel</h2>
    <a href="index.php">🏠 My Tickets</a>
    <a href="../winners.php">🏆 Winners</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="content">
    <h2 style="color:#19c7b2;">👋 Welcome, <?=htmlspecialchars($player_username)?></h2>
    <p style="margin-top:-5px;">Game <b>#<?=$game_id?></b> — Status: <b style="color:#19c7b2;"><?=htmlspecialchars($status)?></b></p>
    <?php if ($msg): ?>
        <div class="message"><?=htmlspecialchars($msg)?></div>
    <?php endif; ?>

    <?php if ($assigned): ?>
        <h3>Your Tickets</h3>
        <div class="ticket-list">
            <?php foreach ($assigned as $tkt):
                $grid = json_decode($tkt['ticket_data'], true); ?>
                <div class="ticket-card">
                    <div><b>Ticket #<?=htmlspecialchars($tkt['ticket_no'])?></b></div>
                    <table class="ticket">
                        <?php for ($r = 0; $r < 3; $r++): ?>
                            <tr>
                                <?php for ($c = 0; $c < 9; $c++):
                                    $n = $grid[$r][$c] ?? '';
                                    echo $n ? "<td>$n</td>" : "<td class='empty'></td>";
                                endfor; ?>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
        <form method="post"><button type="submit" name="clear_tickets">Clear My Tickets</button></form>

    <?php elseif ($status === 'selecting'): ?>
        <form method="post">
            <div class="ticket-list">
                <?php foreach ($available_tickets as $tkt):
                    $grid = json_decode($tkt['ticket_data'], true); ?>
                    <label>
                        <div class="ticket-card">
                            <div><b>Ticket #<?=htmlspecialchars($tkt['ticket_no'])?></b></div>
                            <input type="checkbox" name="choose[]" value="<?=intval($tkt['id'])?>">
                            <table class="ticket">
                                <?php for ($r = 0; $r < 3; $r++): ?>
                                    <tr>
                                        <?php for ($c = 0; $c < 9; $c++):
                                            $n = $grid[$r][$c] ?? '';
                                            echo $n ? "<td>$n</td>" : "<td class='empty'></td>";
                                        endfor; ?>
                                    </tr>
                                <?php endfor; ?>
                            </table>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>
            <button type="submit" name="choose">Request Selected Ticket(s)</button>
        </form>
    <?php elseif ($status === 'finished'): ?>
        <p>Game finished.</p>
    <?php endif; ?>

    <?php if ($status === 'running' || $status === 'finished'): ?>
        <hr>
        <h3 style="color:#19c7b2;">Number Calling Board</h3>
        <div id="lastCalledNumber">Last Number Called: --</div>
        <div id="calledNumbersGrid"></div>
    <?php endif; ?>
</div>

<script>
const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('sidebarToggleBtn');

function updateBtnText() {
    toggleBtn.textContent = sidebar.classList.contains('open') ? 'Hide Sidebar' : 'Show Sidebar';
}

if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        updateBtnText();
    });

    updateBtnText();

    document.addEventListener('click', (e) => {
        if (
            sidebar.classList.contains('open') &&
            !sidebar.contains(e.target) &&
            e.target !== toggleBtn &&
            window.innerWidth <= 800
        ) {
            sidebar.classList.remove('open');
            updateBtnText();
        }
    });
}

// Number calling board update
async function fetchCalledNumbers() {
    const resp = await fetch('../get_called_numbers.php');
    if (!resp.ok) return;
    const data = await resp.json();
    const grid = document.getElementById('calledNumbersGrid');
    const lastNum = document.getElementById('lastCalledNumber');
    grid.innerHTML = '';
    let last = null;
    (data.called_numbers || []).forEach((num, idx) => {
        const div = document.createElement('div');
        div.textContent = num;
        div.classList.add('called');
        if (idx === data.called_numbers.length - 1) {
            div.classList.add('last');
            last = num;
        }
        grid.appendChild(div);
    });
    lastNum.textContent = last ? `Last Number Called: ${last}` : 'Last Number Called: --';
}

<?php if ($status === 'running' || $status === 'finished'): ?>
fetchCalledNumbers();
setInterval(fetchCalledNumbers, 8000);
<?php endif; ?>
</script>

</body>
</html>
