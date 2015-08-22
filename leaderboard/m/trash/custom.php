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
<div id=header1><h1>CUSTOM LEADERBOARD</h1></div>
<div id='menu'>
<ul>
   <li class='active has-sub'><a href='#'><span>Compare Scores</span></a>
      <ul>
         <li class='has-sub'>
    <form action="#" method="post">
        <input type="text" name="usera" placeholder="Username">
        <input type="text" name="userb" placeholder="Username">
        <input type="submit" name="compare" value="Compare">
    </form>
        </li>
	</ul>
	 </li>
	</ul>
</div>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='#'><span>Overall</span></a></li>
   <li><a href='tennis.php'><span>Tennis</span></a></li>
   <li><a href='efootball.php'><span>Euro-Football</span></a></li>
   <li><a href='afootball.php'><span>Am-Football</span></a></li>
   <li class='last'><a href='baseball.php'><span>Baseball</span></a></li>
</ul>
</div>
<div class="box">
<?php
include("includes/connect.php");
$str = pg_escape_string("safeer");
$query = pg_query($dbconn, "SELECT * FROM users WHERE username = '{$str}'");
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
                            
                                            