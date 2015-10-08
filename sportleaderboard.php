<?php
require_once('connection.php');
$category = $_GET["category"];
if($category==387)
{
$query = "select username,amer_football_won-amer_football_lost as total_pts from 
(
select user_id,username, 
sum(case when sport_id=6 and result = 'won' then bet_cost else 0 end) as amer_football_won,
sum(case when sport_id=6 and result = 'lost' then bet_cost else 0 end) as amer_football_lost,
sum(case when sport_id=6 and result = 'draw' then bet_cost else 0 end) as amer_football_draw

from
(
select a.id,a.user_id,e.username,a.result,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.balance from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id 
left join matches c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id=e.id
where b.status='finished' group by a.id,a.user_id,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.username,e.balance order by a.user_id) 
as game group by username,user_id,balance order by balance desc
) as point where amer_football_won>amer_football_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}
else if($category==389)
{
$query = "select username,basketball_won-basketball_lost as total_pts from 
(
select user_id,username, 
sum(case when sport_id=7 and result = 'won' then bet_cost else 0 end) as basketball_won,
sum(case when sport_id=7 and result = 'lost' then bet_cost else 0 end) as basketball_lost,
sum(case when sport_id=7 and result = 'draw' then bet_cost else 0 end) as basketball_draw

from
(
select a.id,a.user_id,e.username,a.result,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.balance from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id 
left join matches c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id=e.id
where b.status='finished' group by a.id,a.user_id,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.username,e.balance order by a.user_id) 
as game group by username,user_id,balance order by balance desc
) as point where basketball_won>basketball_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}

else if($category==390)
{
$query =  "select username,cricket_won-cricket_lost as 
total_pts from 
(
select user_id,username, 
sum(case when sport_id=8 and result = 'won' then bet_cost else 0 end) as cricket_won,
sum(case when sport_id=8 and result = 'lost' then bet_cost else 0 end) as cricket_lost,
sum(case when sport_id=8 and result = 'draw' then bet_cost else 0 end) as cricket_draw

from
(
select a.id,a.user_id,e.username,a.result,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.balance from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id 
left join matches c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id=e.id
where b.status='finished'  and b.updated_at >= '2015-02-13'group by a.id,a.user_id,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.username,e.balance order by a.user_id) 
as game group by username,user_id,balance order by balance desc
) as point where cricket_won>cricket_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}

else if($category==391)
{
$query = "select username,euro_football_won-euro_football_lost as total_pts from 
(
select user_id,username, 
sum(case when sport_id=5 and result = 'won' then bet_cost else 0 end) as euro_football_won,
sum(case when sport_id=5 and result = 'lost' then bet_cost else 0 end) as euro_football_lost,
sum(case when sport_id=5 and result = 'draw' then bet_cost else 0 end) as euro_football_draw

from
(
select a.id,a.user_id,e.username,a.result,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.balance from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id 
left join matches c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id=e.id
where b.status='finished' group by a.id,a.user_id,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.username,e.balance order by a.user_id) 
as game group by username,user_id,balance order by balance desc
) as point where euro_football_won>euro_football_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}

else if($category==392)
{
$query = "select username,fgr_sktng_won-fgr_sktng_lost as total_pts from 
(
select user_id,username, 
sum(case when sport_id=2 and result = 'won' then bet_cost else 0 end) as fgr_sktng_won,
sum(case when sport_id=2 and result = 'lost' then bet_cost else 0 end) as fgr_sktng_lost,
sum(case when sport_id=2 and result = 'draw' then bet_cost else 0 end) as fgr_sktng_draw

from
(
select a.user_id,e.username,a.duel_game_id,a.result,b.bet_cost,c.sport_id,d.name from user_duel_games a
left join duel_games b on a.duel_game_id = b.id
left join competitions c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id=e.id
where b.gameable_type = 'Competition' and c.sport_id = 2
) 
as game group by username,user_id
) as point where fgr_sktng_won>fgr_sktng_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}

else if($category==393)
{
$query = "select username,golf_won,golf_lost,golf_draw,golf_won-golf_lost as total_pts from 
(
select user_id,username,sport_id,
sum(case when sport_id=3 and result = 'won' then bet_cost else 0 end) as golf_won,
sum(case when sport_id=3 and result = 'lost' then bet_cost else 0 end) as golf_lost,
sum(case when sport_id=3 and result = 'draw' then bet_cost else 0 end) as golf_draw

from
(
select a.id,b.gameable_type,c.name as competition_name,a.user_id,e.username,a.result,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.balance from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id 
left join competitions c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id=e.id
where b.status='finished' and b.gameable_type = 'Competition' and c.sport_id = 3 group by a.id,c.name,a.user_id,b.gameable_type,
b.gameable_id,b.bet_cost,c.sport_id,d.name,e.username,e.balance order by a.user_id) 
as game group by game.sport_id,username,user_id,balance order by balance desc
) as point where golf_won>golf_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}

else if($category==394)
{
$query = "select username,ice_hockey_won-ice_hockey_lost as total_pts from 
(
select user_id,username, 
sum(case when result = 'won' then bet_cost else 0 end) as ice_hockey_won,
sum(case when result = 'lost' then bet_cost else 0 end) as ice_hockey_lost,
sum(case when result = 'draw' then bet_cost else 0 end) as ice_hockey_draw
from
(
select a.user_id,a.duel_game_id,a.result,b.bet_cost,c.sport_id,d.name,e.username from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id
left join matches c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id = e.id
where sport_id = 4 ) 
as game group by username,user_id
) as point where ice_hockey_won>ice_hockey_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}

else if($category==395)
{
$query = "select username,tennis_won-tennis_lost as total_pts from 
(
select user_id,username, 
sum(case when sport_id=1 and result = 'won' then bet_cost else 0 end) as tennis_won,
sum(case when sport_id=1 and result = 'lost' then bet_cost else 0 end) as tennis_lost,
sum(case when sport_id=1 and result = 'draw' then bet_cost else 0 end) as tennis_draw

from
(
select a.id,a.user_id,e.username,a.result,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.balance from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id 
left join matches c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id=e.id
where b.status='finished' group by a.id,a.user_id,b.gameable_id,b.bet_cost,c.sport_id,d.name,e.username,e.balance order by a.user_id) 
as game group by username,user_id,balance order by balance desc
) as point where tennis_won>tennis_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by total_pts desc limit 10";
}

$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$num = pg_numrows($result);

$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
for($i=0;$i<10;$i++)
{
if (strlen($rows[$i][username])>'15')
$rows[$i][username] = substr($rows[$i][username], 0, 15);
}
echo json_encode($rows);
pg_close($dbconn3);
?>
