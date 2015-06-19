<?php

$tToken= $_GET[tokenid];
$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');
require_once('connection.php');
if($_GET[id])
{
  $user_id = $_GET[id]; 
  echo $user_id;
  echo $tToken;
  pg_query($dbconn3, "update push_notifiers set user_id = '$user_id' where ios_token_id = '$tToken'");
}
else
{
if ($tToken !='' || $tToken != null)
{
$ipaddress= $_GET[ipaddress];
$result = pg_query($dbconn3,"select id,ios_notification_badge from push_notifiers where ios_token_id = '$tToken'");

$row = pg_fetch_row($result);

if($row[0] == '')
{
pg_query($dbconn3, "INSERT INTO push_notifiers (last_sign_in_at,last_sign_in_ip,created_at,updated_at,sign_in_status,ios_token_id,ios_notification_badge) VALUES('$timestamp','$ipaddress','$timestamp','$timestamp','f','$tToken',0)");

}

if($row[1] != 0)
{
  pg_query($dbconn3, "update push_notifiers set ios_notification_badge = 0 where ios_token_id = '$tToken'");
}
}
}

/*
pg_query($dbconn3, "INSERT INTO users (full_name,encrypted_password,username,email,tos_agreement,balance,confirmation_token,created_at,updated_at) VALUES('$full_name','$encrypted_password','$username','$email','$tos_agreement','$balance','$code','$timestamp','$timestamp')");
*/

pg_close($dbconn3);
?>