<?php 
require_once('connection.php');
$id = $_GET[id];
$result = pg_query($dbconn3, "select a.competitor1_id,c.name from matches a left join competitors b on a.competitor1_id = b.id left join teams c on b.competitable_id = c.id
 where a.id = '$id' union
 select a.competitor2_id,c.name from matches a left join competitors b on a.competitor2_id = b.id left join teams c on b.competitable_id = c.id
 where a.id = '$id'");
$num = pg_numrows($result);
pg_close($dbconn3);
$rows = array();
while($r = pg_fetch_assoc($result))
{
	$rows[] = $r;
}
echo json_encode($rows); 
?>