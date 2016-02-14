<?php
require_once('connection.php');
//$result = pg_query($dbconn3,"select ios_token_id,ios_notification_badge from push_notifiers");

$opponentid = $_GET["opponent_id"];
$userid = $_GET["user_id"];

$result = pg_query($dbconn3,"select ios_token_id,ios_notification_badge from push_notifiers where user_id = '$opponentid' ");

$result1 = pg_query($dbconn3,"select username from users where id = '$userid'");


$value = pg_numrows($result);
$value1 = pg_fetch_row($result1);
echo $value;
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo $rows[0][ios_token_id];
print_r ($rows);

// print_r ($value[0]);

// print_r ($value1[0]);
foreach ($rows as $key => $value3) 
{
if($rows[0][ios_token_id]!="" || $rows[0][ios_token_id]!=NULL)
{
$message = "".$value1[0]." just Roared at you!";
$notification = $value[1]+1;
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

   $deviceToken = $rows[0][ios_token_id];
   $msg = chr (0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
   print "sending message :" . $payload . "n";
   fwrite($fp, $msg);

  $result2 = pg_query($dbconn3,"update push_notifiers set ios_notification_badge = '$notification' where ios_token_id = '$deviceToken'");
 }
}
fclose($fp);
pg_close($dbconn3);

?>



    
