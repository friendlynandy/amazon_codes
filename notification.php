<?php
if(isset($_POST['message']))
{
$dbconn3 = pg_connect("host=ec2-79-125-7-27.eu-west-1.compute.amazonaws.com port=5552 dbname=d39ubt6siqrqmf user=u5rve30b5so8gv password=peqhcba53fc1d4qrebs5ok7b22");
$result = pg_query($dbconn3,"select ios_token_id,ios_notification_badge from push_notifiers");

$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;

}

$message = stripslashes($_POST['message']);
foreach ($rows as $key => $value)
{
$notificationBadge = $rows[$key]["ios_notification_badge"];
$notification = $notificationBadge+1;

$payload = '{

                 "aps" :
                 
                        {  "alert" : "'.$message.'",
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

	$deviceToken = $rows[$key]["ios_token_id"];
   $msg = chr (0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) . $payload;
   print "sending message :" . $payload . "n";
   fwrite($fp, $msg);

   $result = pg_query($dbconn3,"update push_notifiers set ios_notification_badge = '$notification' where ios_token_id = '$deviceToken'");
 }
fclose($fp);
}
?>
<form action="notification.php" method="post">
    <input type="text" name="message" maxlength="100">
    <input type="submit" value="Send Notification">
</form>





    