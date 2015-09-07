
<?php

$name = $_GET['username'];
$a = array();
$a[0]['name'] = $name;
echo json_encode($a);

?>
