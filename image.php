<?php
require_once('connection.php');
if(isset($_GET["user_id"]))
{
$user_id = $_GET["user_id"];
if (strlen($user_id)<3)
{
$user_id = str_pad($user_id, 3, "0", STR_PAD_LEFT);
}
$result = pg_query($dbconn3, "select uid,avatar_file_name from users where id=$user_id");
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
if ($rows[0][avatar_file_name]=="")
{
$ar = array("http://www.sportslion.com/assets/avatar-0b523aaf2f6e9d8aea4d6eb56c4e2db7.png");
}
else 
{
$ar = array("http://sportslion.production.s3-eu-west-1.amazonaws.com/users/avatars/000/000/".$user_id ."/large/".$rows[0][avatar_file_name]);
}
if($rows[0][uid]!="")
{
  $uid = $rows[0][uid];
  $ar = array("http://graph.facebook.com/".$uid."/picture?type=large");
}



echo json_encode($ar, JSON_FORCE_OBJECT);
} 
pg_close($dbconn3);
?>
