<?php

$user_id = $_GET["user_id"];
if (strlen($user_id)<3)
{
$user_id = str_pad($user_id, 3, "0", STR_PAD_LEFT);
}
require_once('connection.php');
$result = pg_query($dbconn3, "select avatar_file_name from users where id=$user_id");

if($rows[0]==0)
{
$ar = array("http://52.24.178.241/amazon_codes/user.png");	
}
else
{
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
$ar = array("http://sportslion.production.s3-eu-west-1.amazonaws.com/users/avatars/000/000/".$user_id ."/large/".$rows[0][avatar_file_name]);
}
echo json_encode($ar, JSON_FORCE_OBJECT); 
pg_close($dbconn3);
?>
