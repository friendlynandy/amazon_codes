<?php
require_once('connection.php');
$competition_id = $_GET["competition_id"];
//$opponentcompetitor_id = $_GET["opponent_competitor_id"];
$user_id = $_GET["user_id"];
//$row = pg_fetch_row($id);
$result = pg_query($dbconn3, "select d.username, user_id,count(user_id) from(
select a.id, user_id,a.status, user_competitor_id as selection from duel_games a
left join matches b on a.gameable_id = b.id
left join competitions c on b.competition_id = c.id
where c.id = '$competition_id' and a.status = 'accepted'
union all
select a.id,opponent_id,a.status, opponent_competitor_id as selection from duel_games a
left join matches b on a.gameable_id = b.id
left join competitions c on b.competition_id = c.id
where c.id = '$competition_id' and a.status = 'accepted') as list left join users d on 
list.user_id = d.id where user_id != '$user_id' group by user_id,d.username order by count desc limit 1");

$num = pg_numrows($result);
pg_close();
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
if(($rows=="" or $rows == NULL) && $user_id != '11')
{
$rows[username] = 'Liinus Hietaniemi';
$rows[user_id] = '11';
}
else if (($rows=="" or $rows == NULL) && $user_id == '11')
{
$rows[username] = 'Mighty Sports Lion';
$rows[user_id] = '5';
}
echo json_encode($rows);
pg_close($dbconn3);
?>
