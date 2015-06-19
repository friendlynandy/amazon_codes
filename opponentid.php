<?php
require_once('connection.php');
$id = $_GET["username"];
//$row = pg_fetch_row($id);
$result = pg_query($dbconn3, "select id from users where username = '$id' ");

$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
?>