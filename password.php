<?php
require_once('connection.php');
//$username=preg_replace('/\s+/', '', $_GET['username']);
//$username = str_replace('', '%20', $_GET['username']);
$username = $_POST['username'];
$password = $_POST['password'];

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
