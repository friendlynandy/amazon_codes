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
   <li><a href='index.php'><span>Overall</span></a></li>
   <li><a href='tennis.php'><span>Tennis</span></a></li>
   <li><a href='efootball.php'><span>Euro-Football</span></a></li>
   <li><a href='afootball.php'><span>Am-Football</span></a></li>
   <li><a href='figure.php'><span>Fig-Skating</span></a></li>
   <li class='active'><a href='ice.php'><span>Ice Hockey</span></a></li>
   <li><a href='basket.php'><span>Basketball</span></a></li>
   <li class='last'><a href='cricket.php'><span>Cricket</span></a></li>
</ul>
</div>
<div class="box">
<?php
// Performing SQL query
include("includes/connect.php");
$query = 'select username,ice_hockey_won-ice_hockey_lost as net_ice_hockey_points from 
(
select user_id,username, 
sum(case when result = \'won\' then bet_cost else 0 end) as ice_hockey_won,
sum(case when result = \'lost\' then bet_cost else 0 end) as ice_hockey_lost,
sum(case when result = \'draw\' then bet_cost else 0 end) as ice_hockey_draw
from
(
select a.user_id,a.duel_game_id,a.result,b.bet_cost,c.sport_id,d.name,e.username from user_duel_games a 
left join duel_games b on a.duel_game_id = b.id
left join matches c on b.gameable_id = c.id
left join sports d on c.sport_id = d.id
left join users e on a.user_id = e.id
where sport_id = 4 ) 
as game group by username,user_id
) as point where ice_hockey_won>ice_hockey_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by net_ice_hockey_points desc limit 10';

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
                            
                            
                            