<?php
require_once('connection.php'); 
$duel_games_id = $_GET['duel_games_id'];
$sent_user_id = $_GET['opponent_id'];
$message = $_GET['message'];
$date_new = new DateTime();
$timestamp = $date_new->format('Y-m-d H:i:s');
if(isset($_GET['duel_games_id']) && isset($_GET['opponent_id']) && isset($_GET['message']))
{
$duel_games_id = $_GET['duel_games_id'];
$sent_user_id = $_GET['opponent_id'];
$message = $_GET['message'];
$result = pg_query($dbconn3, "INSERT INTO  chats (duel_games_id,sent_user_id,message,created_at,updated_at) VALUES('$duel_games_id','$sent_user_id','$message','$timestamp','$timestamp')");
}

$result1 = pg_query($dbconn3, "select * from chats where duel_games_id = '$duel_games_id' order by id desc limit 10");
$num = pg_numrows($result1);
$rows = array();
while($r = pg_fetch_assoc($result1))
{
	$rows[] = $r;
}
echo json_encode($rows);
pg_close($dbconn3);
?>
