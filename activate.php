<?php
$code = $_GET['code'];
$username = $_GET['username'];
require_once('connection.php');
$codefromdb = pg_query($dbconn3, "select confirmation_token from users where username = '$username'");
$row = pg_fetch_row($codefromdb);
if($row[0] == $code)
{
   pg_query($dbconn3, "update users set confirmation_token = '' where username = '$username'");
   echo 'ACCOUNT ACTIVATION SUCCESSFUL';
$date_new = new DateTime();
$timestamp_new = $date_new->format('Y-m-d H:i:s');
pg_query($dbconn3, "update users set confirmed_at = '$timestamp_new' where username= '$username'");
}
//connect to remote db, and check if $code matches confirmation_token
//if it confirms, update confirmation token and make it blank, also update
?>