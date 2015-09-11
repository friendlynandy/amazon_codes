<?php 
require_once('connection.php');
// $username = $_GET["username"];
// $id = $_GET["id"];
// $result = pg_query($dbconn3, "select username,balance from users where username = '$username'");
// if(isset($id))
// {
// $result = pg_query($dbconn3, "select full_name,username,balance from users where id = '$id'");	
// $num = pg_numrows($result);
// $rows = array();
// while($r = pg_fetch_assoc($result))
// {
// 	$rows[] = $r;
// }
// foreach ($rows as $key => $value) 
// {
// if ($rows[$key][full_name]==null)
// 		{
// 		$rows[$key][full_name]="?";
// 		}

// }
// echo json_encode($rows);
// }
// else
// {
// $result = pg_query($dbconn3, "select username,balance from users where username = '$username'");
// $num = pg_numrows($result);
// $rows = array();
// while($r = pg_fetch_assoc($result))
// {
// 	$rows[] = $r;
// }
// echo json_encode($rows);
// }

$rank_sql = pg_query($dbconn3, "select id,username,full_name,balance from users order by balance desc");
$num_rows = pg_numrows($rank_sql);
$rank_rows = array();
while($r = pg_fetch_assoc($rank_sql))
{
	$rank_rows[] = $r;
}
$i=0;
foreach ($rank_rows as $key => $value)
{
	$rank_rows[$key]['rank'] = $i-50;
	// if ((!empty($_GET["id"])) && ($_GET["id"] == $rank_rows[$key]['id']))
	// {
	// 	if ($rank_rows[$key]['rank'] > $_GET['rank'])
	// 	{
	// 		$rank_rows[$key]['arrow'] = 'down';
	// 	}
	// 	else if ($rank_rows[$key]['rank'] < $_GET['rank'])
	// 	{
	// 		$rank_rows[$key]['arrow'] = 'up';
	// 	}

	// }
	// else
	// {
	// 	$rank_rows[$key]['arrow'] = 'nil';	
	// }
	$i++;

}
echo json_encode($rank_rows);
pg_close($dbconn3);
?>
