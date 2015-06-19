<?php 
require_once('connection.php');
$full_name = $_GET["full_name"];
$result = pg_query($dbconn3, "select full_name from users where full_name = '$full_name'");

$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
?>