<?php
$dbconn3 = pg_connect("host=ec2-79-125-7-27.eu-west-1.compute.amazonaws.com port=5552 dbname=d39ubt6siqrqmf user=u5rve30b5so8gv password=peqhcba53fc1d4qrebs5ok7b22");
$id = $_GET[id];
$date = new DateTime();
$end_date = date_format($date, 'Y-m-d');
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
