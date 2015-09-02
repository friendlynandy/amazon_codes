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

$devicetoken = pg_query($dbconn3,"select b.ios_token_id,b.ios_notification_badge,a.email,a.username from users a left join push_notifiers b on a.id = b.user_id where a.id = '$sent_user_id'");
$value = pg_fetch_row($devicetoken);
$email_confirmation = $value[2];
pg_query($dbconn3, "INSERT INTO chat_notifiers (user_id, duel_games_id,notification_badge) SELECT '$userid', '$duel_games_id','0' WHERE  NOT EXISTS (SELECT id FROM chat_notifiers WHERE user_id = '$userid' and duel_games_id = '$duel_games_id')");
pg_query($dbconn3, "INSERT INTO chat_notifiers (user_id, duel_games_id,notification_badge) SELECT '$sent_user_id', '$duel_games_id','0' WHERE  NOT EXISTS (SELECT id FROM chat_notifiers WHERE user_id = '$sent_user_id' and duel_games_id = '$duel_games_id')");
pg_query($dbconn3, "update chat_notifiers set notification_badge = notification_badge+1 where duel_games_id = '$duel_games_id' and user_id = '$sent_user_id'");

/*
$subject = 'Confirmation email';
$message .= '<div style="background:#f1f4f5;font-family:Arial;margin:0;padding:0 50px" bgcolor="#f1f4f5">
<table align="center" width="600px" style="background:white;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-collapse:collapse;border:0" bgcolor="white">
<tbody><tr><td style="padding:0 50px;text-align:center" align="center"><img alt="SportsLion Logo" src="https://ci6.googleusercontent.com/proxy/vmBK4YRRiESLXHJo9o3nIH3m0F3-9KaRxIljlLwPre86gtvMuWTv_TGH94tnSl0JftcoM8x3MPJlsDNgCCuf727Kn5KJFBOy9HnA28c6oqjuQ_T2jk8YPP3XLBvQHyFftHBK_NWw=s0-d-e1-ft#http://www.sportslion.com/assets/mails/logo-23e9997c521a6b0884891ac5f277d1e9.png" class="CToWUd"></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><h1 style="color:#2c3e50;font-size:24px;font-weight:normal;margin:0px auto 20px">Dear '.$value[3].'</h1></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px">The Sports Lion senses that your Roar is strong. Please press the button below to confirm your e-mail and to begin your Roar.</p></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px"><a  href=http://52.24.178.241/amazon_codes/activate.php?code='.$value[3].'&username='.$value[3].' target="_blank"><img alt="Button confirm email" src="https://ci6.googleusercontent.com/proxy/abXCoiltd1kyWhm8YVe1aHX-4BssyPRTWT1wsRQUoWPRbBD1TauAw1WoBvKvDnsfrcBY99z-x6iiSBE0XSip3IgeUP7HrHrCVcogBAoY5lJE1Td2lVZJLkkBF1ScEbMpUeHZjU2Yx2-caJ2yMf4elMr9GGH97g=s0-d-e1-ft#http://www.sportslion.com/assets/mails/button-confirm-email-3f3cb7b5b522f08ba9e829af612e725b.png" class="CToWUd"></a></p></td></tr>
</tbody></table>
<table align="center" width="600px" style="background:#f1f4f5;border-collapse:collapse;border:0" bgcolor="#f1f4f5"><tbody><tr><td style="color:#7f8c8d;font-size:12px;height:50px;padding-top:20px;text-align:center;vertical-align:top" align="center" valign="top"><p style="color:#7f8c8d;font-size:12px;line-height:140%;margin:0 0 20px">© 2014 Sports Lion, 198 Tremont St, Suite 411, Boston, MA 02116.</p></td></tr></tbody></table>
<img src="https://ci5.googleusercontent.com/proxy/nwwxIhiWADZoTfF-r8Le9Jzmf4mqFcb1V6NgQWkab9vmwnYRRUGqrhXWaYt8_QUsdRML2r4awjYPnwrP5bqBX9qz0Yi2D1RgGt0TqDFY4EH5pEYCD1DhEInGdVmiZ76_CsFxYfEtyip-jASX95oS88MWnVtdZmIqr3NS_Z-toM9LWByE6EJOypkFyfBrs_qMH6MnpEA7JCfvQ8dSW0brfnLiLxIE_Og90RErzWT740kWuBPl6EuTBELpxeYk16um3LWKSAH72TgUAYvuisSHxLFy0U-NkNNYxb1DNHsZNHRkUou9GP2MkutcuP8ECsjF-J-MZ49eeQt7mzX4pxFZL_SghRQfH8CM_qwAMghAvJE_iQxlXkvoIlTj7DgkzYAXiZTsif4g1YJD4XeCkmxosLvNCv42f-fMz89CJT4aoKg=s0-d-e1-ft#https://u1311448.ct.sendgrid.net/wf/open?upn=z5vLPidU7O8UDGHtjcZbWNZXAXQrnBCz0aBK5dlxSR4XEi9Qe1aY0HIRdmHzPld9q7zbOd4KfDP-2BCLwYwR8M6y-2BlGuSVI5B1-2FuM3-2FmgbCiX2VwN2zz98n3VdQdhyDU9q2j5K3eHeb90PvKVQHt41OpuEUaIkmnGdqogdbbc4ySP0UVvBlLO-2Fmuk1ThSlD-2By1M4yve-2FOFukfpGaRAmx2bw2LaAHFQlALAIIfUC0PTE5E-3D" alt="" width="1" height="1" border="0" style="min-height:1px!important;width:1px!important;border-width:0!important;margin-top:0!important;margin-bottom:0!important;margin-right:0!important;margin-left:0!important;padding-top:0!important;padding-bottom:0!important;padding-right:0!important;padding-left:0!important" class="CToWUd">
</div>';
$headers  = 'From:noreply@sportslion.com' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//Mail it
echo $email_confirmation;
mail($email_confirmation, $subject, $message, $headers);
echo 'mail sent';
*/
$result1 = pg_query($dbconn3,"select username from users where id = '$userid'");
// print_r ($value[0]);
$value1 = pg_fetch_row($result1);
// print_r ($value1[0]);
if($value1[0]!="" || $value1[0]!=NULL)
{
$notificationmessage = "$value1[0]".":".$message;
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
if(isset($_GET['duel_games_id']) && isset($_GET['x']) && isset($_GET['y']) && isset($_GET['user_id']))
{

$duel_games_id = $_GET['duel_games_id'];
$x = $_GET["x"];
$y = $_GET["y"];
$userid = $_GET['user_id'];
echo $userid;
var_dump($userid);
pg_query($dbconn3, "update chat_notifiers set notification_badge = 0 where duel_games_id = '$duel_games_id' and user_id = '$userid'");
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
