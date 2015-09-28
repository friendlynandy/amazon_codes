<?php
require_once('connection.php'); 
$id = $_GET[id];
// $end_date = date_format($date, 'Y-m-d H:m:s');
// echo $end_date;
$end_date = new DateTime();
date_add($end_date, date_interval_create_from_date_string('1 days'));
$end_date = date_format($date, 'Y-m-d H:m:s');
$result = pg_query($dbconn3, "select id,name from matches where competition_id = '$id' and end_at >= '$end_date'");
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
