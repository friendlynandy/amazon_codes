<?php
$passcode= $_POST["passcode"];
$username= $_POST["username"];
$email= $_POST["email"];
$full_name= $_POST["full_name"];
if (!isset($_POST['submit'])) {
 ?>
<html>
<head>
<title>Personal INFO</title>
</head>
<body>

<form method="post" action="<?php echo $PHP_SELF;?>">
Accesscode:<input type="password" name="passcode"><br />
Username:<input type="text" name="username"><br />
Email:<input type="email" name="email"><br />
Full Name:<input type="text" name="full_name"><br />
<input type="submit" value="submit" name="submit">
</form>
<?php
} else {
if($passcode == "**##**")
{
include("include/connect.php");
$endtime = date('Y-m-d H:m:s');
$usetime = strtotime("-15 minutes", strtotime($endtime));
$starttime = date('Y-m-d H:m:s', $usetime);
$pass = "$2a$10\$IRMhmAZPmB6C/rERJqjkkehXX2hECl22ANMejxYPsz5G3bx0vkN2e";
$query = "INSERT INTO users (email, encrypted_password,sign_in_count,created_at,updated_at,tos_agreement,confirmed_at,confirmation_sent_at, username, balance, given_points,full_name)
VALUES ('".$email."', '{$pass}','0','".$starttime."','".$endtime."','t','".$endtime."','".$starttime."','".$username."', '20', '20','".$full_name."')";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
echo "Awesome !! User added";
}
}
?>