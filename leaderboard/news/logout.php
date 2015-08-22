<?php
session_start();
echo"<script>alert('Destroying session')</script>";
header("location: login.php");
session_destroy();


?>