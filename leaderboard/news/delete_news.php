<?php 
$id = $_GET['id'];
include("connect.php");
$query = "delete from news where id = '$id'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
pg_close($dbconn);
echo "<script>alert('News post has been deleted')</script>";
	echo "<script>window.open('index.php','_self')</script>";