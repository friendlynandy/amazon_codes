<?php
require_once('connection.php');
$data = pg_query($dbconn3,"select a.name,a.id from competitions a left join tournaments b on a.id=b.competition_id where b.publish_tournament=");
echo json_encode($data);
?>
