<?php
session_start();
require '../db.php';
require '../functions.php';

// ✅ Allow only admin or agent
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'agent'])) {
    header("Location: ../index.php");
    exit;
}

$role = ucfirst($_SESSION['role']);
$game_id = $_SESSION['current_game_id'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tambola <?= $role ?> — Number Calling</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{font-family:Arial;margin:0;padding:20px;background:#f6f6f6;}
.header{background:#1abc9c;padding:12px;color:#fff;border-radius:6px;margin-bottom:15px;font-size:1.3em;}
#calledNumbersGrid{display:grid;grid-template-columns:repeat(10,1fr);gap:6px;max-width:400px;margin:20px auto;}
#calledNumbersGrid div{padding:8px;text-align:center;border-radius:5px;background:#eee;color:#333;font-weight:bold;}
#calledNumbersGrid div.called{background:#27ae60;color:#fff;}
#calledNumbersGrid div.last{background:#e74c3c !important;box-shadow:0 0 6px rgba(231,76,60,0.7);}
#lastCalledNumber{text-align:center;font-size:1.4em;margin-top:10px;}
button{padding:10px 20px;background:#1abc9c;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:1em;}
button:hover{background:#16a085;}
</style>
</head>
<body>

<div class="header">Tambola <?= $role ?> — Number Calling</div>

<div style="text-align:center;">
    <button id="callNextNumberBtn">🎯 Call Next Number</button>
</div>
<div id="lastCalledNumber">Last Number Called: --</div>
<div id="calledNumbersGrid"></div>

<script>
async function fetchCalledNumbers(){
    const resp = await fetch('../get_called_numbers.php');
    const data = await resp.json();
    return data.called_numbers || [];
}

async function updateCalledNumbers(){
    const called = await fetchCalledNumbers();
    const grid = document.getElementById('calledNumbersGrid');
    const lastNum = called.length ? called[called.length - 1] : null;

    document.getElementById('lastCalledNumber').textContent =
        lastNum ? "Last Number Called: " + lastNum : "Last Number Called: --";

    grid.innerHTML = '';

    for(let i=1; i<=90; i++){
        const cell = document.createElement('div');
        cell.textContent = i;
        if(called.includes(i)){
            cell.classList.add('called');
            if(i === lastNum) cell.classList.add('last');
        }
        grid.appendChild(cell);
    }
}

document.getElementById('callNextNumberBtn').addEventListener('click', async ()=>{
    const resp = await fetch('../call_number.php', {method: 'POST'});
    const data = await resp.json();
    if(data.next_number){
        await updateCalledNumbers();
        // Speak the number
        if('speechSynthesis' in window){
            const speakNumber = new SpeechSynthesisUtterance("Number " + data.next_number);
            speechSynthesis.speak(speakNumber);
        }
    } else if(data.error){
        alert(data.error);
    }
});

// Initial load + auto refresh every 5s
updateCalledNumbers();
setInterval(updateCalledNumbers, 5000);
</script>

</body>
</html>
