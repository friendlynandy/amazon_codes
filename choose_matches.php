<?php
require_once('connection.php'); 
$id = $_GET[id];
$date = date_create();
$date = $date->format('Y-m-d H:m:s'); 
//echo $date;
$result = pg_query($dbconn3, "select id,name from matches where competition_id = '$id' and start_at >= '$date' and published = 't'");
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
