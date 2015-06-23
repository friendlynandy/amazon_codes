<?php
require_once('connection.php');
// See the password_hash() example to see where this came from.
$username = $_GET['username'];
$password = $_GET['encrypted_password'];
//pgsql get his encrypted_password for the username
$encrypted_password = pg_query($dbconn3,"select encrypted_password from users where username = '$username'");

$result = pg_fetch_array($encrypted_password);

echo $result[0];

if (password_verify($password, $result[0])) 
{
    echo 'Password is valid!';
}
 else 
{
    echo 'Invalid password.';
}
pg_close($dbconn3);
?>
