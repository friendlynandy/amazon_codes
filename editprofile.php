<?php
require_once('connection.php');
$id = $_GET["id"];

$result = pg_query($dbconn3, "select  full_name,username from users where id = '$id'");
if(isset($_GET["username"]))
{
$username = $_GET["username"];	
$result = pg_query($dbconn3, "select  username from users where username != '$username'");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
}

while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
pg_close();
pg_close($dbconn3);
?>
