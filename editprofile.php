<?php
require_once('connection.php');
$id = $_GET["id"];
$result = pg_query($dbconn3, "select  full_name,email,username from users where id = '$id'");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
pg_close();
pg_close($dbconn3);
?>