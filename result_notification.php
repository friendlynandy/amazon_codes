<?php
require_once('connection.php');
$result = pg_query($dbconn3,"select ios_token_id,ios_notification_badge from push_notifiers where user_id =25 ");
$value = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
var_dump($rows);

// print_r ($value[0]);
// print_r ($value1[0]);
//foreach ($rows as $key => $value3) 
?>
