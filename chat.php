<?php
require_once('connection.php'); 
//$duel_games_id = $_GET['duel_games_id'];
//$sent_user_id = $_GET['opponent_id'];
//$message = $_GET['message'];
$date_new = new DateTime();
$timestamp = $date_new->format('Y-m-d H:i:s');
//$x = $_GET["x"];
//$y = $_GET["y"];

if(isset($_GET['duel_games_id']) && isset($_GET['opponent_id']) && isset($_GET['message']) && isset($_GET['user_id']))
{
$duel_games_id = $_GET['duel_games_id'];
$sent_user_id = $_GET['opponent_id'];
$message = $_GET['message'];
$result = pg_query($dbconn3, "INSERT INTO  chats (duel_games_id,sent_user_id,message,created_at,updated_at) VALUES('$duel_games_id','$sent_user_id','$message','$timestamp','$timestamp')");
$userid = $_GET["user_id"];
$devicetoken = pg_query($dbconn3,"select ios_token_id,ios_notification_badge from push_notifiers where user_id = '$sent_user_id' ");

$result1 = pg_query($dbconn3,"select username from users where id = '$userid'");
$value = pg_fetch_row($devicetoken);
// print_r ($value[0]);
$value1 = pg_fetch_row($result1);
// print_r ($value1[0]);
echo $value1;

if($value1[0]!="" || $value1[0]!=NULL)
{
$notificationmessage = "'.$value1[0].'".$message;
echo $notificationmessage;
$notification = $value[1]+1;
$payload = '{
                 "aps" :
                 
                        {  "alert" : "'.$notificationmessage.'",
                           "badge" : '.$notification.',
                           "sound" : "default"
                        }
            }';
$ctx = stream_context_create();
stream_context_set_option($ctx,'ssl','local_cert','finalsportslion.pem');
stream_context_set_option($ctx,'ssl','passphrase','');
$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195',$err,$errstr,60,STREAM_CLIENT_CONNECT,$ctx);
if(!$fp)
{
    print "Failed to connect $err $errstrn";
    return;
}
else
{
   print "Notification sent";
}

	$deviceToken = $value[0];
   $msg = chr (0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
   print "sending message :" . $payload . "n";
   fwrite($fp, $msg);

  $result2 = pg_query($dbconn3,"update push_notifiers set ios_notification_badge = '$notification' where ios_token_id = '$deviceToken'");
 }
fclose($fp);
}
if(isset($_GET['duel_games_id']) && isset($_GET['x']) && isset($_GET['y']))
{

$duel_games_id = $_GET['duel_games_id'];
$x = $_GET["x"];
$y = $_GET["y"];
$result1 = pg_query($dbconn3, "select * from chats where duel_games_id = '$duel_games_id' order by id desc limit $y offset $x");
$num = pg_numrows($result1);
$rows = array();
while($r = pg_fetch_assoc($result1))
{
	$rows[] = $r;
}
$input = array_reverse($rows);
$output = json_encode($input);
//$reversed = array_reverse($input);
//$preserved = array_reverse($input, true);

print_r($output);

//print_r($reversed);
//print_r($preserved);
}
pg_close($dbconn3);
?>
