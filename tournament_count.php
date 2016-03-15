<?php
require_once('connection.php');
$result = pg_query($dbconn3,"select count(a.id) from duel_games a 
left join matches b on a.gameable_id = b.id
where a.user_id = 25 and a.status = 'finished' and b.competition_id=125 or a.opponent_id = 25 and a.status = 'finished' and b.competition_id=125 or a.user_id = 25 and a.status = 'accepted' and b.competition_id=125 or a.opponent_id = 25 and a.status = 'accepted' and b.competition_id=125");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
?>
