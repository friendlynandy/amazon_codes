<?php 

require_once('connection.php');
$email = $_GET["email"];
$result = pg_query($dbconn3, "select email from users where email = '$email'");

$num = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
pg_close($dbconn3);
?>