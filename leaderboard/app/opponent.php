<?php
require_once('connection.php');
$id = $_GET["id"];
//$row = pg_fetch_row($id);
$result = pg_query($dbconn3, "select id,username from users where id != '$id' order by username asc");

$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);

?>