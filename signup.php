<?php
require_once('connection.php');
$dbconn3 = pg_connect("host=ec2-79-125-7-27.eu-west-1.compute.amazonaws.com port=5552 dbname=d39ubt6siqrqmf user=u5rve30b5so8gv password=peqhcba53fc1d4qrebs5ok7b22");
$full_name = $_GET["full_name"];
$encrypted_password = $_GET["encrypted_password"];
$username = $_GET["username"];
$email = $_GET["email"];
$tos_agreement = $_GET["tos_agreement"];
$balance = $_GET["balance"];
pg_query($dbconn3, "INSERT INTO users (full_name,encrypted_password,username,email,tos_agreement,balance) VALUES('$full_name','$encrypted_password','$username','$email','$tos_agreement','$balance')");
pg_close($dbconn3);
?>