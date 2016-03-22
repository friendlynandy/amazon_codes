<?php
require_once('connection.php');
$user_id = $_GET["userid"];
$competition_id = $_GET["competitionid"];
$result = pg_query($dbconn3,"select count(a.id) from duel_games a 
left join matches b on a.gameable_id = b.id
where a.user_id = $user_id and a.status = 'finished' and b.competition_id=$competition_id or a.opponent_id = $user_id and a.status = 'finished' and b.competition_id=$competition_id or a.user_id = $user_id and a.status = 'accepted' and b.competition_id=$competition_id or a.opponent_id = $user_id and a.status = 'accepted' and b.competition_id=$competition_id");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
var_dump($rows);
print_r($rows);
//echo json_encode($rows);
?>
