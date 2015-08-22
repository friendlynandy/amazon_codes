<?php
require_once('connection.php');
$id = $_GET["id"];


if(isset($_GET["username"]))
{
$username = $_GET["username"];	
$result = pg_query($dbconn3, "select username from users where username = '$username'");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
}
if(isset($_GET["id"]))
{
$id = $_GET["id"];
$result = pg_query($dbconn3, "select  full_name,username from users where id = '$id'");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
}
if(isset($_GET["full_name"]) && isset($_GET["user_id"]))
{
$fullname = $_GET["full_name"];
$id1 = $_GET["user_id"];
$date_new = new DateTime();
$timestamp = $date_new->format('Y-m-d H:i:s');
//edit profile only if full_name changed
pg_query($dbconn3,"update users set full_name = '$fullname', updated_at = '$timestamp' where id = '$id1'");
}
if(isset($_GET["full_name"]) && isset($_GET["user_id"]) && isset($_GET["updated_username"]))
{
$username = $_GET["updated_username"];
$fullname = $_GET["full_name"];
$id1 = $_GET["user_id"];
$date_new = new DateTime();
$timestamp = $date_new->format('Y-m-d H:i:s');
//edit profile only if full_name changed
pg_query($dbconn3,"update users set username='$username',full_name = '$fullname', updated_at = '$timestamp' where id = '$id1'");
}

pg_close();
pg_close($dbconn3);
?>