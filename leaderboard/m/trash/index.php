                                                                                                <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset='utf-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SportsLion | Leaderboard</title>
  <link rel="icon" type="image/png" href="/tiny_logo.png">
  <link rel="stylesheet" type="text/css" href="design.css" media="all" />
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
  <script src="script.js"></script>
<style>
body{
    
    background-image: url("lion_background.jpg");
    position: center-top;
    background-size: 100% auto;
    background-repeat: no-repeat;
}
</style>
</head>
<body>
<div class="b-header"><div class="back" ><a href='http://www.sportslion.com/users/sign_in'><img src="home-icon-edit.png"></a></div></div>
<div class="logo"><a href="http://www.sportslion.com/users/sign_in"><img src="logo.png" alt="SporsLion Logo" style="margin:0 -106px 0;position:absolute;top:-22px;left:51%;z-index:100px;"></a></div>
<div id=header1><h1>LEADERBOARD</h1></div>

<div id='cssmenu'>
<ul>
   <li class='active'><a href='#'><span>Overall</span></a></li>
   <li><a href='tennis.php'><span>Tennis</span></a></li>
   <li><a href='efootball.php'><span>Euro-Football</span></a></li>
   <li><a href='afootball.php'><span>Am-Football</span></a></li>
   <li><a href='figure.php'><span>Fig-Skating</span></a></li>
   <li><a href='ice.php'><span>Ice Hockey</span></a></li>
   <li><a href='basket.php'><span>Basketball</span></a></li>
   <li class='last'><a href='cricket.php'><span>Cricket</span></a></li>
</ul>
</div>
<div class="box">
<?php
// Performing SQL query
include("includes/connect.php");
$query = 'create temp view duel_games_view as 
select id,username, sum(bet_cost) as frozen_points from ( 
SELECT users.id,users.username,duel_games.bet_cost FROM users,duel_games where 
(duel_games.status = \'accepted\' or duel_games.status = \'pending\') and (users.id=duel_games.user_id) 
UNION ALL 
SELECT users.id,users.username,bet_cost FROM users,duel_games where 
(duel_games.status = \'accepted\')  and 
(users.id=duel_games.opponent_id) ORDER BY username DESC ) as t 
group by id,username order by frozen_points desc;

create temp view profile as select id,username, balance+frozen_points as total_pts from (
select users.id,users.username,users.balance,(case frozen_points
 when frozen_points then frozen_points else cast (0 as numeric) end) as frozen_points
from users left join duel_games_view on users.id = duel_games_view.id
group by users.id,duel_games_view.frozen_points) as tab order by total_pts desc;

create temp view percent_view as
select user_id,total as total_bets, round(cast((won*100.0::float)/total as numeric),2) as won_percentage, 
		round(cast((lost*100.0::float)/total as numeric),2) as lost_percentage,
		round(cast((draw*100.0::float)/total as numeric),2) as draw_percentage
from (
select user_id,
    count(*) total,
    sum(case when result = \'won\' then 1 else 0 end) as won,
    sum(case when result = \'lost\' then 1 else 0 end) as lost,
    sum(case when result = \'draw\' then 1 else 0 end)as draw
from user_duel_games where (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25)
group by user_id order by total desc
) as percen;

select username,total_pts from percent_view, profile where percent_view.user_id=profile.id order by total_pts desc limit 20';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table align=\"center\">";
echo "<TH>Rank</TH><TH>Username</TH><TH>Points</TH>\n";
 $i=0;
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
{
    echo "\t<tr>\n";
        $i++;
      echo "<td>$i</td>";
    foreach ($line as $col_value) 
    {
           echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
    }
echo "</table>\n";

// Free resultset
pg_free_result($result);
pg_close($dbconn);
?>
</div>
</body>
                            
                            
                            