<?php
require_once('connection.php');
$result = pg_query($dbconn3,"select * from matches where updated_at >= '2016-03-23' and published_result = 't' and published_result_notification = 'f'");
$value = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}

echo "<pre>";
var_dump($rows);
echo "</pre>";

// print_r ($value[0]);
// print_r ($value1[0]);
//foreach ($rows as $key => $value3) 
?>
