<?php
	session_start();
	
	?>


<html>
	<head>
		<title>Admin Login</title>
	</head>
	
<body bgcolor="gray">

	<div id ="login"><a href="login.php">Login</a></div>
	<form method="post" action="login.php">
	
		
		<table width = "400" border="10" align="center" bgcolor="purple">
		
		<tr>
			<td bgcolor="yellow" colspan="4" align="center">
			<h1>Admin Login form</h1>
			</td>
		</tr>
		
	<tr>
			<td align="right">Username:</td>
			<td><input type="text" name="username"></td>
		
		</tr>
		
		<tr>
			<td align="right">Password:</td>
			<td><input type="password" name="userpass"></td>
		
		</tr>
		
		<tr>
			<td align="center" colspan="4"><input type="submit" name="login" value="Login"></td>
		
		</tr>
			
	
	
		</table>
	</form>
</body>
</html>

<?php
if(isset($_POST['login']))
	{
	$username = ($_POST['username']);
	$userpass = ($_POST['userpass']);
	
	if($username=='' or $userpass=='')
	{
	echo"<script>alert('Please complete all the fields')</script>";
	exit();
	}
	
	else
	{
	if($username=='liinus' or $userpass=='liinus')
		{
		$_SESSION['username'] = $username;
		echo "<script>window.open('index.php','_self')</script>";
		}
		
	else
	{
		echo  "<script>alert('Username or password is incorrect')</script>";
	}
		}
		
		}
		
		?>