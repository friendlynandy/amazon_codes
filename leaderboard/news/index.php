<?php
session_start();

if(!isset($_SESSION['username']))
	{
		header("location: login.php");
		}
		
else
{

?>
<?php
if(isset($_POST['submit']))
{
	$title= $_POST['title'];
	$message= $_POST['message'];
		if($title=='' or $message=='')
	{
	echo"<script>alert('Please complete all the fields')</script>";
	exit();
	}
	else
	{
	$date = new DateTime();
	$timestamp = $date->format('Y-m-d H:i:s'); 
	include("connect.php");
	$query = "insert into news (title,message,created_at,updated_at) values ('$title','$message','$timestamp','$timestamp')";
	$result = pg_query($query) or die('Query failed: ' . pg_last_error());
	pg_close($dbconn);
}
}
?>
<html>
	<head>
	<title>NEWS</title>
	</head>
	<p>Welcome &nbsp;<?php echo strtoupper($_SESSION['username']); ?><br/><a href="logout.php">LogOut</a></p>
	<h2>Add News</h2></align></div>

<body>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
        <p><input type="text" name="title" placeholder="Title"><br></p>
 	
 	   <td class='qtext'>

    <br />
    <textarea 
          onKeyDown="textCounter(this,'q17length',255);"
          onKeyUp="textCounter(this,'q17length',255)" 
          class="scanwid" name="message" id="q17" rows="10" cols="30" placeholder="Message"></textarea>
              <input style="color:red;font-size:12pt;font-style:italic;" readonly="readonly" type="text" id='q17length' name="q17length" size="3" maxlength="3" value="255" /> characters left</i>
</td>
<script>
function textCounter(field, cnt, maxlimit) {         
var cntfield = document.getElementById(cnt) 
 if (field.value.length > maxlimit) // if too long...trim it!
    field.value = field.value.substring(0, maxlimit);
    // otherwise, update 'characters left' counter
    else
    cntfield.value = maxlimit - field.value.length;
 }
 </script>
 	
        <p><input type="submit" name="submit" value="Add"></p>

    </form>
	<?php 
include("connect.php");
$query = "SELECT id, title, message,created_at, publish_present, publish from news order by id desc";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
?>
<table width="1000" border="1" align="center">
	<tr>
		<td colspan="10" align="center" bgcolor="whitesmoke"><h1>View all News</h1></td>
	</tr>
<?php
echo "<TH>Id</TH><TH>Title</TH><TH>Message</TH><TH>created_at</TH><TH>Publish as Notification</TH><TH>Publish in List</TH><TH>Delete</TH>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
{    echo "<tr>";
    	
    echo "\t\t<td>$line[id]</td>\n";
    echo "\t\t<td>$line[title]</td>\n";
    echo "\t\t<td>$line[message]</td>\n";
    echo "\t\t<td>$line[created_at]</td>\n";
    if ($line[publish_present] == 't')
    {
    echo "\t\t<td><a href=\"unpublish_present.php?id=$line[id]\">Unpublish</a></td>\n";
    }
     else
    {
    echo "\t\t<td><a href=\"publish_present.php?id=$line[id]\">Publish</a></td>\n";
    }
    if ($line[publish] == 't')
    {
    echo "\t\t<td><a href=\"unpublish_news.php?id=$line[id]\">Unpublish</a></td>\n";
    }
    else
    {
    echo "\t\t<td><a href=\"publish_news.php?id=$line[id]\">Publish</a></td>\n";
    }
    echo "<td><a href=\"delete_news.php?id=$line[id]\">Delete</a></td>";
    echo "\t</tr>\n";
    }
echo "</table>\n";
	pg_close($dbconn);
?>

<?php } ?>
