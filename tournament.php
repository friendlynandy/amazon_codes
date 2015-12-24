<?php
require_once('connection.php');
$result = pg_query($dbconn3,"select a.name,a.id from competitions a left join tournaments b on a.id=b.competition_id where b.publish_tournament=true");
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
?>
