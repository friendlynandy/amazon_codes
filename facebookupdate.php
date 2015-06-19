<?php

$provider = $_GET["provider"];
$uid = $_GET['uid'];
$fbtoken = $_GET["fb_token"];
$id = $_GET['id'];
$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');


if($fbtokenlength <= 255)
{
    $fbtokenlength = substr($fbtoken, 0,255);
}


require_once('connection.php');
$result = pg_query($dbconn3, "update users set uid ='$uid',provider = '$provider', current_sign_in_at='$timestamp',updated_at='$timestamp', fb_token = '$fbtokenlength' where id = '$id' ");

$cmdtuples = pg_affected_rows($result);
//echo $cmdtuples . "rows are affected \n ";
pg_close($dbconn3);
?>