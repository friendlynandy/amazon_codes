	<?php require_once('include/header.php'); 
		$page = 'tennis';
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
<?php /*

	<header class="page-header">
		<h1 class="page-title" style="font-size:15px;float:right;"><a href="http://sportslionleaderboard.com/tennis.php?numb=10">Top 10</a>  |  <a href="http://sportslionleaderboard.com/tennis.php?numb=20">Top 20</a>  |  <a href="http://sportslionleaderboard.com/tennis.php?numb=30">Top 30</a></h1>
	</header><!-- .page-header -->
	
	*/?>
	<div class="page-content">
		<center>
			<h2>Tennis Top Lions</h2>
			
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
$query = "select username,tennis_won-tennis_lost as net_tennis_points from 
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
) as point where tennis_won>tennis_lost and (user_id != 5 and user_id != 11 and user_id!= 13 and user_id != 8 and user_id != 12 and user_id != 25) order by net_tennis_points desc limit '10'";

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