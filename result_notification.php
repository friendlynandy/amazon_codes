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
					   echo "Key: $key1;user_id: $value1[user_id]; ios_token: $value1[ios_token_id]<br />\n";
						$message = "Results of ".$value[name]." has been published, Check if you have won!";
						$notification = $value1[ios_notification_badge]+1;
						$payload = '{
						                 "aps" :
						                 
						                        {  "alert" : "'.$message.'",
						                           "badge" : '.$notification.',
						                           "sound" : "default"
						                        }
						            }';
						$ctx = stream_context_create();
						stream_context_set_option($ctx,'ssl','local_cert','finalsportslionproduction.pem');
						stream_context_set_option($ctx,'ssl','passphrase','');
						$fp = stream_socket_client('ssl://gateway.push.apple.com:2195',$err,$errstr,60,STREAM_CLIENT_CONNECT,$ctx);
						if(!$fp)
						{
						    print "Failed to connect $err $errstrn";
						    return;
						}
						else
						{
						   print "Notification sent";
						}
						   $deviceToken = $value1[ios_token_id];
						   $msg = chr (0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
						   print "sending message :" . $payload . "n";
						   fwrite($fp, $msg);
					}
			}
		}
}

?>
