<?php 
require_once('connection.php');
$email = $_GET["email"];

if(isset($_GET["invitebyemail"]))
{
  $invite_email = $_GET["invitebyemail"];
  $result = pg_query($dbconn3, "select id,username from users where email = '$invite_email'");
$num = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
}
else
{
$result = pg_query($dbconn3, "select email from users where email = '$email'");
$num = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows);
}
pg_close($dbconn3);

?>
