<?php
session_start();
require '../db.php';
$player_session=$_SESSION['player_session']??session_id();
$player_name=$_SESSION['username']??'';
$game_id=$_SESSION['current_game_id']??0;

$gameRow=$conn->query("SELECT * FROM games WHERE game_id=$game_id")->fetch_assoc();
if(!$gameRow) die("No active game");
$prizes = array_map('trim', explode(',',$gameRow['prizes']));

$msg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $claim_type=$_POST['claim_type'];
    if(in_array($claim_type,$prizes)){
        $exists=$conn->query("SELECT 1 FROM claims WHERE game_id=$game_id AND player_session='$player_session' AND claim_type='$claim_type'");
        if($exists->num_rows==0){
           $conn->query("INSERT INTO claims (game_id,player_session,player_name,claim_type,status,claim_time) 
                         VALUES ($game_id,'$player_session','".$conn->real_escape_string($player_name)."','$claim_type','pending',NOW())");
           $msg="✅ Claim submitted for $claim_type";
        } else $msg="⚠ Already claimed $claim_type";
    } else $msg="⚠ Invalid claim";
}
$myClaims=$conn->query("SELECT * FROM claims WHERE game_id=$game_id AND player_session='$player_session'");
?>
<!DOCTYPE html>
<html><head><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Claim Prize</title></head>
<body>
<h2>Claim Prize - <?=htmlspecialchars($gameRow['game_name'])?></h2>
<?php if($msg) echo "<p>$msg</p>"; ?>
<form method="post">
<select name="claim_type" required>
<option value="">Select prize</option>
<?php foreach($prizes as $p) echo "<option>".htmlspecialchars($p)."</option>"; ?>
</select>
<button type="submit">Submit</button>
</form>
<h3>Your Claims</h3>
<ul>
<?php while($r=$myClaims->fetch_assoc()){echo "<li>{$r['claim_type']} - {$r['status']}</li>";} ?>
</ul>
</body></html>
