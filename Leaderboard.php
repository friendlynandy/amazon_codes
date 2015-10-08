<?php
require_once('connection.php');
$ranks = $_GET["ranks"];
if(isset($_GET['ranks']))
{
$ranks = $_GET['ranks'];
$query = "select username,balance as total_pts from users order by total_pts desc limit '$ranks'";
}

$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$num = pg_numrows($result);

$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
for($i=0;$i<10;$i++)
{
if (strlen($rows[$i][username])>'15')
$rows[$i][username] = substr($rows[$i][username], 0, 15);
}
echo json_encode($rows);
pg_close($dbconn3);
?>
