<?php
require_once('connection.php'); 
$id = $_GET[id];
// $date = new DateTime();
// $end_date = date_format($date, 'Y-m-d H:m:s');
// echo $end_date;
$date = new DateTime();
$date->add(new DateInterval('P10D'));
echo $date->format('Y-m-d H:i:s') . "\n";
exit;
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
