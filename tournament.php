<?php
require_once('connection.php');
$data = pg_query($dbconn3,"select name from competiitons where tournament_status = 't'");
echo json_encode($data);
?>
