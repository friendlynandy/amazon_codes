<?php
$dbconn3 = pg_connect("host=ec2-79-125-7-27.eu-west-1.compute.amazonaws.com port=5552 dbname=d39ubt6siqrqmf user=u5rve30b5so8gv password=peqhcba53fc1d4qrebs5ok7b22");
$username = $_GET['username'];
$password = $_GET['password'];


//pgsql get his encrypted_password for the username
$encrypted_password = pg_query($dbconn3,"select id,encrypted_password from users where username = '$username'");

$result = pg_fetch_array($encrypted_password);

$id = $result[0];

if (password_verify($password, $result[1]))
{
   echo '[{"result":'.json_encode('valid',JSON_FORCE_OBJECT).',"id":'.json_encode($id,JSON_FORCE_OBJECT).'}]';
}
 else
{
    echo '[{"result":'.json_encode('invalid',JSON_FORCE_OBJECT).'}]';
}
pg_close($dbconn3);
?>
