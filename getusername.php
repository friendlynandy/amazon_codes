<?php 
require_once('connection.php');
$id = $_GET["id"];
$result = pg_query($dbconn3, "select username,balance from users where id = '$id'");

$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
?>