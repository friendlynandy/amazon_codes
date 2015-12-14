<?php 
require_once('connection.php');
$row = $_GET["id"];
//$id = pg_query($dbconn3,"select id from users where username = '$username'");
//$row = pg_fetch_row($id);
//echo $row;

//printf ($row[0]);
$result = pg_query($dbconn3, "select a.id as duel_games_id,a.opponent_email,p.publish_status, a.main as competitable_type,a.sec as sec_compet_type, f.full_name,f.username,f.balance,f.id,j.name as competition_name,n.name as compet_name,a.bet_cost,e.name as user_team, 
c.name as opponent_team,a.status,o.notification_badge,g.result,h.name as team_sport,k.name as opponent_player,l.name as user_player,m.name as player_sport,CASE WHEN a.user_id ='$row' THEN 'waiting'   ELSE 'respond'
       END from
       (
select * from (SELECT b.competitable_type as main,a.opponent_email,c.competitable_type as sec,a.id, a.user_id,a.gameable_id, a.opponent_id,a.bet_cost,a.user_competitor_id,a.opponent_competitor_id,a.status FROM
 duel_games a 
 left join competitors b on a.opponent_competitor_id = b.id
 left join competitors c on a.user_competitor_id = c.id where user_id = '$row'
UNION ALL
SELECT b.competitable_type,a.opponent_email,c.competitable_type,a.id, a.user_id,a.gameable_id, a.user_id,a.bet_cost,a.opponent_competitor_id,a.user_competitor_id,a.status FROM duel_games a 
left join competitors b on a.user_competitor_id = b.id 
left join competitors c on a.opponent_competitor_id = c.id 
 where opponent_id = '$row') as list order by list.id desc
) as a
left join competitors b on a.opponent_competitor_id = b.id
left join teams c on b.competitable_id = c.id
left join competitors d on a.user_competitor_id = d.id
left join teams e on d.competitable_id = e.id
left join users f on a.opponent_id = f.id
left join user_duel_games g on a.id = g.duel_game_id and g.user_id = '$row'
left join sports h on c.sport_id = h.id
left join matches i on a.gameable_id = i.id
left join competitions j on i.competition_id = j.id
left join players k on b.competitable_id = k.id
left join players l on d.competitable_id = l.id
left join sports m on l.sport_id = m.id
left join competitions n on a.gameable_id = n.id
left join chat_notifiers o on a.id = o.duel_games_id and o.user_id = '$row'
left join duel_game_status p on a.id = p.duel_game_id and p.user_id = '$row'
where p.publish_status is null 
order by a.id desc
");

$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
foreach ($rows as $key => $value) 
{
		if ($rows[$key][username]==null && $rows[$key][full_name]==null)
		{
		$rows[$key][full_name]=$rows[$key][opponent_email];
		}
		else if ($rows[$key][username]==null && $rows[$key][full_name]!=null)
		{
		$rows[$key][full_name]=$rows[$key][full_name];
		}
		else if ($rows[$key][username]!=null && $rows[$key][full_name]==null)
		{
		$rows[$key][full_name]=$rows[$key][username];
		}
		else
		{
		$rows[$key][full_name]="?";	
		}
		

		if ($rows[$key][competitable_type]=="")
		{
		$rows[$key][competitable_type]="?";
		}
		
		if ($rows[$key][user_player]=="")
		{
		$rows[$key][user_player]="?";
		}
		if ($rows[$key][notification_badge]=="")
		{
		$rows[$key][notification_badge]="0";
		}
		
		if ($rows[$key][opponent_player]=="")
		{
		$rows[$key][opponent_player]="?";
		}
		if ($rows[$key][player_sport]=="")
		{
		$rows[$key][player_sport]="Sport of the Day";
		}
		if ($rows[$key][player_sport]=="" && $rows[$key][team_sport]=="")
		{
		$rows[$key][player_sport]="Sport of the Day";
		}
		
}
echo json_encode($rows);

?>
