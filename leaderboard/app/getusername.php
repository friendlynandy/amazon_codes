<?php 
require_once('connection.php');
$username = $_GET["username"];
$id = $_GET["id"];
$result = pg_query($dbconn3, "select username,balance from users where username = '$username'");
if(isset($id))
{
$result = pg_query($dbconn3, "select full_name,username,balance from users where id = '$id'");	
$num = pg_numrows($result);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
foreach ($rows as $key => $value) 
{
if ($rows[$key][full_name]==null)
		{
		$rows[$key][full_name]="?";
		}

}
echo json_encode($rows);
}
else
{
$result = pg_query($dbconn3, "select username,balance from users where username = '$username'");
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
