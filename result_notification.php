<?php
require('connection.php');
$result = pg_query($dbconn3,"select id,name from matches where updated_at >= '2016-03-23' and published_result = 't' and published_result_notification = 'f'");
$value = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}

foreach ($rows as $key => $value) 
{
	if($rows!=NULL)
		{
			echo "Key: $key; Value: $value[name]<br />\n";
			$result1 = pg_query($dbconn3,"select a.user_id, b.ios_token_id,b.ios_notification_badge from (
				select user_id from duel_games where gameable_id = '$value[id]' and gameable_type = 'Match' and status = 'finished'
				union
				select opponent_id from duel_games where gameable_id = '$value[id]' and gameable_type = 'Match' and status = 'finished') as a
				left join push_notifiers b on a.user_id = b.user_id");
			$value1 = pg_numrows($result1);
			$rows1 = array();
			while($r = pg_fetch_assoc($result1))
			{
				$rows1[] = $r;
			}
			foreach ($rows1 as $key1 => $value1) 
			{
				if($rows1!=NULL)
					{
					   echo "Key: $key1; Value: $value1[ios_token_id]<br />\n";	
					}
			}
		}
}

    

// foreach ($rows as $key => $value1) 
// {
// 	if($rows!=NULL)
// 		{
// 			echo $rows[$value1][id];
// 		}
// }

?>
