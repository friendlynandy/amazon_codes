	<?php require_once('include/header.php'); 
		$page = 'overall';
		 require_once('include/nav.php'); ?>
		
				<div id="under-menu-bar"> 

			<div class="social-networks">
																							</div>
		</div>
		<!-- Second Navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	<section id="primary" class="content-area alignleft">
		<main id="main" class="site-main" role="main">

		
			
<section>


	<header class="page-header">
		<h1 class="page-title" style="font-size:15px;float:right;"><a href="http://54.191.199.139/amazon_codes/leaderboard/index.php?numb=10">Top 10</a>  |  <a href="http://54.191.199.139/amazon_codes/leaderboard/index.php?numb=20">Top 20</a>  |  <a href="http://54.191.199.139/amazon_codes/leaderboard/index.php?numb=30">Top 30</a></h1>
	</header><!-- .page-header -->
	<div class="page-content">
		<center>
			<h2>Overall Top Lions</h2>
			
			<style>
				.table tr,th,td
				{
				text-align:center;
				}
			</style>
		<?php
		
if(!$_GET["numb"] || $_GET["numb"] === "" || $_GET["numb"] === "10")
{
	$numb=10;
}
else if ($_GET["numb"] === "20")
{
	$numb=20;
}
else if($_GET["numb"] === "30")
{
	$numb=30;
}
// Performing SQL query
include("include/connect.php");
$query = "create or replace temp view duel_games_view as 
select id,username, sum(bet_cost) as frozen_points from ( 
SELECT users.id,users.username,duel_games.bet_cost FROM users,duel_games where 
(duel_games.status = 'accepted' or duel_games.status = 'pending') and (users.id=duel_games.user_id) 
UNION ALL 
SELECT users.id,users.username,bet_cost FROM users,duel_games where 
(duel_games.status = 'accepted')  and 
(users.id=duel_games.opponent_id) ORDER BY username DESC ) as t 
group by id,username order by frozen_points desc;

create or replace temp view profile as select id,username, balance+frozen_points as total_pts from (
select users.id,users.username,users.balance,(case frozen_points
 when frozen_points then frozen_points else cast (0 as numeric) end) as frozen_points
from users left join duel_games_view on users.id = duel_games_view.id
group by users.id,duel_games_view.frozen_points) as tab order by total_pts desc;

create or replace temp view percent_view as
select user_id,total as total_bets, round(cast((won*100.0::float)/total as numeric),2) as won_percentage, 
		round(cast((lost*100.0::float)/total as numeric),2) as lost_percentage,
		round(cast((draw*100.0::float)/total as numeric),2) as draw_percentage
from (
select user_id,
    count(*) total,
    sum(case when result = 'won' then 1 else 0 end) as won,
    sum(case when result = 'lost' then 1 else 0 end) as lost,
    sum(case when result = 'draw' then 1 else 0 end)as draw
from user_duel_games where (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25)
group by user_id order by total desc
) as percen;

select username,total_pts from percent_view, profile where percent_view.user_id=profile.id order by total_pts desc limit '".$numb."'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML

echo "<table align=\"center\" style=\"border-spacing:10px;\">";
echo "<TH><h1 class=\"page-title\" style=\"font-size:18px;\">Rank</h1></TH><TH><h1 class=\"page-title\" style=\"font-size:18px;\">Username</h1></TH><TH><h1 class=\"page-title\" style=\"font-size:18px;\">Points</h1></TH>\n";
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
			</center>

</div><!-- .page-content -->
</section><!-- .no-results -->

		
		</main><!-- #main -->
	</section><!-- #primary -->

	<?php require_once('include/footer.php'); ?>
