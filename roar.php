<?php
/*
$gameable_id = $_GET["gameable_id"];
$gameable_type = $_GET["gameable_type"];
$bet_cost = $_GET["bet_cost"];
$opponent_id = $_GET["opponent_id"];
$status = $_GET["status"];
$user_id = $_GET["user_id"];
$id = $_GET["id"];
$user_competitor_id = $_GET["user_competitor_id"];
$opponent_competitor_id = $_GET["opponent_competitor_id"];
$publish = $_GET["publish"];
$balance = $_GET["balance"];

$oppbalance = $_GET["oppbalance"];
$opponent_id = $_GET["opponent_id"];
$oppstatus = $_GET["oppstatus"];
$oppid = $_GET["oppid"];

$respond_balance = $_GET["respond_balance"];
$respond_userid = $_GET["respond_userid"];
$respond_status = $_GET["respond_status"];
$respond_gameid =  $_GET["respond_gameid"];
*/


/*
echo $oppbalance . "<br />";
echo $opponent_id . "<br />";
echo $oppstatus . "<br />";
echo $oppid. "<br />";


echo $respond_balance . "<br />";
echo $respond_userid . "<br />";
echo $respond_status . "<br />";
echo $respond_gameid . "<br />";


echo $gameable_id . "<br />";
echo $gameable_type . "<br />";
echo $bet_cost . "<br />"; 
echo $opponent_id . "<br />";
echo $status . "<br />";
echo $user_id . "<br />";
echo $user_competitor_id . "<br />";
echo $opponent_competitor_id . "<br />";
echo $publish . "<br />";
echo $balance . "<br />";
*/

// $t = microtime(true);
// $micro = sprintf("%06d",($t - floor($t)) * 1000000);
// $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
// $timestamp = $d->format("Y-m-d H:i:s.u"); 
// echo $timestamp;

$time = time();
$check = $time+date("Z",$time);
echo strftime("%B %d, %Y @ %H:%M:%S UTC", $check);


//$time = gmmktime();
//echo date("Y-m-d H:i:s", $time); 

/*
require_once('connection.php');
if(isset($_GET["invitebyemail"]))
{
$opponent_invitebyemail = $_GET["invitebyemail"];
$result = pg_query($dbconn3, "INSERT INTO duel_games (gameable_id,gameable_type,bet_cost,opponent_email,created_at,updated_at,status,user_id,user_competitor_id,opponent_competitor_id,publish) VALUES('$gameable_id','$gameable_type','$bet_cost','$opponent_invitebyemail','$timestamp','$timestamp','$status','$user_id','$user_competitor_id','$opponent_competitor_id','$publish')");	
}
else
{
$result = pg_query($dbconn3, "INSERT INTO duel_games (gameable_id,gameable_type,bet_cost,opponent_id,created_at,updated_at,status,user_id,user_competitor_id,opponent_competitor_id,publish) VALUES('$gameable_id','$gameable_type','$bet_cost','$opponent_id','$timestamp','$timestamp','$status','$user_id','$user_competitor_id','$opponent_competitor_id','$publish')");
}


//cancel bet
pg_query($dbconn3,"update users set balance = '$balance', updated_at='$timestamp' where id = '$user_id'");
pg_query($dbconn3,"update duel_games set status = '$status',updated_at='$timestamp' where id = '$id'");

//refused
pg_query($dbconn3,"update users set balance = '$oppbalance', updated_at='$timestamp' where id = '$opponent_id'");
pg_query($dbconn3,"update duel_games set status = '$oppstatus',updated_at='$timestamp' where id = '$oppid'");

//respond
pg_query($dbconn3,"update users set balance = '$respond_balance', updated_at='$timestamp' where id = '$respond_userid'");
pg_query($dbconn3,"update duel_games set status = '$respond_status',updated_at='$timestamp' where id = '$respond_gameid'");

/*
$rows =  pg_affected_rows ($result);
if($rows = 1)
{
    $affected = $rows;
    echo $affected;
}
else
{
    $affected = 0;
}
$rows = array();
while($r = pg_fetch_assoc($affected))
{
	$rows[] = $r;
}
echo json_encode($rows);
pg_close($dbconn3);
*/
?>
