<?php

$gameable_id = $_GET["user_id"];

//echo $gameable_id;

require_once('connection.php');
$result = pg_query($dbconn3, "select avatar_file_name from users where id=$gameable_id");

$num = pg_numrows($result);

$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
$ar = array("http://sportslion.production.s3-eu-west-1.amazonaws.com/users/avatars/000/000/".$gameable_id ."/large/".$rows[0][avatar_file_name]);
echo json_encode($ar, JSON_FORCE_OBJECT); 
pg_close($dbconn3);
?>