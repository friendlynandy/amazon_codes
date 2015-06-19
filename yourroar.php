<?php 
require_once('connection.php');
$row = $_GET["id"];
//$id = pg_query($dbconn3,"select id from users where username = '$username'");
//$row = pg_fetch_row($id);
//echo $row;

//printf ($row[0]);
$result = pg_query($dbconn3, "select a.id as duel_games_id, f.username,f.balance,f.id,j.name as competition_name,a.bet_cost,e.name as user_team, 
c.name as opponent_team,a.status,g.result,h.name,CASE WHEN a.user_id ='$row' THEN 'waiting'   ELSE 'respond'
       END from
(
SELECT id, user_id,gameable_id, opponent_id,bet_cost,user_competitor_id,opponent_competitor_id,status FROM
 duel_games where user_id = '$row'
UNION ALL
SELECT id, user_id,gameable_id, user_id,bet_cost,opponent_competitor_id,user_competitor_id,status FROM duel_games
 where opponent_id = '$row'
)as a
left join competitors b on a.opponent_competitor_id = b.id
left join teams c on b.competitable_id = c.id
left join competitors d on a.user_competitor_id = d.id
left join teams e on d.competitable_id = e.id
left join users f on a.opponent_id = f.id
left join user_duel_games g on a.id = g.duel_game_id and g.user_id = '$row'
left join sports h on c.sport_id = h.id
left join matches i on a.gameable_id = i.id
left join competitions j on i.competition_id = j.id
 order by a.id desc
");

$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows); 


?>