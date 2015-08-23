<?php
require_once('connection.php');
$result = pg_query($dbconn3, "select id,name from sports where active = 't'");
$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
?>
