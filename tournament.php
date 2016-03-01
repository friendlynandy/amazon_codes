<?php
require_once('connection.php');
$result = pg_query($dbconn3,"select  name,sport_id from competitions where tournament_publish = 't'");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
?>
