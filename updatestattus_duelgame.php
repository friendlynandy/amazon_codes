<?php
require_once('connection.php'); 
$user_id = $_POST['user_id'];
$duel_games_id = $_POST['duel_games_id'];
$date_new = new DateTime();
$timestamp = $date_new->format('Y-m-d H:i:s');
$result = pg_query($dbconn3,"INSERT INTO  duel_game_status (duel_game_id,user_id,publish_status,created_at,updated_at) VALUES('$duel_games_id','$user_id','f','$timestamp','$timestamp')");
pg_close($dbconn3);
?>

