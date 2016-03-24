<?php
require_once('connection.php');
$result = pg_query($dbconn3,"select id from matches where updated_at >= '2016-03-23' and published_result = 't' and published_result_notification = 'f'");
$value = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}


foreach ($rows as $key => $value1) 
{
	if($rows!=NULL)
		{
			var_dump($rows);
		}
}

?>
