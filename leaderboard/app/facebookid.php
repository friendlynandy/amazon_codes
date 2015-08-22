<?php 
require_once('connection.php');
$email = $_GET["email"];
$result = pg_query($dbconn3, "select id,username from users where email = '$email'");

$num = pg_numrows($result);
pg_close();
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
pg_close($dbconn3);
?>