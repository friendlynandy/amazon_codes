<?php
require_once('connection.php');
$data = pg_query($dbconn3,"select name from competitions where status_tournament = 't'");
echo json_encode($data);
?>
