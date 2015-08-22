<?php 
$id = $_GET['id'];
include("connect.php");
$query = "update news set publish_present = 'f' where id = '$id'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
pg_close($dbconn);
echo "<script>alert('Status has been changed')</script>";
	echo "<script>window.open('index.php','_self')</script>";