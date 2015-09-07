
<?php

$name = $_GET['$name'];
$a = array();
$a[0]['name'] = $name;
echo json_encode($a);

?>
