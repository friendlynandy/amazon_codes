<?php

$full_name = $_GET["full_name"];
$encrypted_password = $_GET["encrypted_password"];
$username = $_GET["username"];
$email = $_GET["email"];
$tos_agreement = $_GET["tos_agreement"];
$balance = $_GET["balance"];
$id = $_GET["id"];

echo $full_name;
echo $email;
echo $id;
echo $username;

/*if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}*/

function str_random($length = 60)
 {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$code = str_random();
$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');
require_once('connection.php');
pg_query($dbconn3, "INSERT INTO users (full_name,encrypted_password,username,email,tos_agreement,balance,confirmation_token,created_at,updated_at) VALUES('$full_name','$encrypted_password','$username','$email','$tos_agreement','$balance','$code','$timestamp','$timestamp')");


//edit profile
//pg_query($dbconn3,"update users set full_name = '$full_name', updated_at='$timestamp',emailid = '$email', username = '$username' where id = '$user_id'");


// connect to database and save this code along with datimestamps
$subject = 'Confirmation email';
// message
$message = '
<html>
<head>
  <title>Confirmation Email to join Sports Lion</title>
</head>
<body>
  <p>The Sports Lion senses that your Roar is strong. Please press the button below to confirm your e-mail and to begin your Roar</p>

';

$message .= "<tr><td><strong>Please click on this link:</strong> </td><td><a href=http://www.sportslionleaderboard.com/app/activate.php?code=".$code."&username=".$username.">Activate my Account</a></td></tr>";

// To send HTML mail, the Content-type header must be set
$headers  = 'From:noreply@sportslion.com' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


// Mail it
mail($email, $subject, $message, $headers);
$date_new = new DateTime();
$timestamp_new = $date_new->format('Y-m-d H:i:s');
pg_query($dbconn3, "update users set confirmation_sent_at = '$timestamp_new' where username= '$username'");
pg_close($dbconn3);
?>