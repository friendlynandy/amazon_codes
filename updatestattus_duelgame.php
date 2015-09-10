<?php
require_once('connection.php'); 
$user_id = $_POST[''];
$duel_game_id = $_POST[''];
$publish_status = 't';
$date_new = new DateTime();
$timestamp = $date_new->format('Y-m-d H:i:s');
$result = pg_query($dbconn3,"INSERT INTO  chats (duel_game_id,user_id,publish_status,created_at,updated_at) VALUES('$duel_game_id','$user_id','$publish_status','$timestamp','$timestamp')");
pg_close($dbconn3);
?>

