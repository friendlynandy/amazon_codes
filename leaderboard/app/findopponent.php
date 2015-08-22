<?php
require_once('connection.php');
$competition_id = $_GET["competition_id"];
$opponentcompetitor_id = $_GET["opponent_competitor_id"];
//$userselection_id = $_GET[""];
//$row = pg_fetch_row($id);
$result = pg_query($dbconn3, "select list.user_id,users.username, count(list.id) from (
select a.id, user_id,a.status, user_competitor_id as selection from duel_games a
left join matches b on a.gameable_id = b.id
left join competitions c on b.competition_id = c.id
where c.id = '$competition_id' and a.status = 'accepted'
group by user_id,a.id,a.status,selection
union all
select a.id,opponent_id,a.status, opponent_competitor_id as selection from duel_games a
left join matches b on a.gameable_id = b.id
left join competitions c on b.competition_id = c.id
where c.id = '$competition_id' and a.status = 'accepted'
group by opponent_id,a.id,a.status,selection
) as list left join users on list.user_id = users.id group by user_id,users.username order by count desc limit 1");

$num = pg_numrows($result);
pg_close();
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
if ($rows[0] == "" || $rows[0] == "null")
{
	$rows[user_id] =5 ;
	$rows[username] = "Mighty Sports Lion";
}
echo json_encode($rows);
pg_close($dbconn3);
?>