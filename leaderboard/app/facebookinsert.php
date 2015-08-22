<?php

$provider = $_GET["provider"];
$uid = $_GET['uid'];
$fbtoken = $_GET["fb_token"];
$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');
$email = $_GET["email"];
$tos_agreement = $_GET["tos_agreement"];
$balance = $_GET["balance"];
$username = $_GET["username"];
$full_name = $_GET["full_name"];
$avatarfilename = $_GET["avatar_file_name"];
$avatarcontenttype = $_GET["avatar_content_type"];


if($fbtokenlength <= 255)
{
    $fbtokenlength = substr($fbtoken, 0,255);
}
require_once('connection.php');
$result = pg_query($dbconn3, "INSERT INTO users (full_name,username,email,tos_agreement,balance,created_at,updated_at,current_sign_in_at,last_sign_in_at,confirmed_at,fb_token,uid,provider,avatar_file_name,avatar_content_type,avatar_updated_at,given_points) VALUES
('$full_name','$username','$email','$tos_agreement','$balance','$timestamp','$timestamp','$timestamp','$timestamp','$timestamp','$fbtoken','$uid','$provider','$avatarfilename','$avatarcontenttype','$timestamp','$balance')");

$cmdtuples = pg_affected_rows($result);
$successful =  $cmdtuples . "rows are affected <br/> ";

echo $successful;
pg_close($dbconn3);

?>