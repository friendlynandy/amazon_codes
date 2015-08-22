<table width="1000" border="5" align="center">
	<tr>
		<td colspan="10" align="center" bgcolor="yellow"><h1>View All Sensor Data</h1></td>
	</tr>
	<tr bgcolor="cyan">
		<th>Id</th>
		<th>Var1</th>
		<th>Var2</th>
		<th>Var3</th>
		<th>Date</th>
		<th>Month</th>
		<th>Year</th>
		
	</tr>
<?php
		
	if($_GET['var1'] !=0)
	{
	$var1= $_GET['var1'];
	$var2= $_GET['var2'];
	$var3= $_GET['var3'];
	date_default_timezone_set('America/Indiana/Indianapolis'); 
	$time = date('H:i');
	$month = date(m);
	$date = date(j);
	$year = date(Y);
	$db="sportsl1_sensortest";
	$link = mysql_connect('', 'sportsl1_safeer', 'sportsl1');
	if (! $link) die(mysql_error());
	mysql_select_db($db , $link) or die("Couldn't open $db: ".mysql_error());
	$queryResult = mysql_query("INSERT INTO sensor(var1, time, var2, var3, month, date, year) VALUES ('$var1', '$time', '$var2','$var3','$month', '$date', '$year')");
	}

	
	$db="sportsl1_sensortest";
	$link = mysql_connect('', 'sportsl1_safeer', 'sportsl1');
	if (! $link) die(mysql_error());
	mysql_select_db($db , $link) or die("Couldn't open $db: ".mysql_error());
	$sql    = 'SELECT * FROM sensor';
	$result = mysql_query($sql, $link);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) 
{


	$venue_id = $row['id'];
	$venue_venuename = $row['var1'];
	$venue_capacity = $row['var2'];
	$venue_address_number = $row['var3'];
	$venue_street = $row['date'];
	$venue_city = $row['month'];
	$venue_country = $row['year'];
		?>
	<tr bgcolor="pink">
		<td><?php echo $venue_id; ?></td>
		<td><?php echo $venue_venuename; ?></td>
		<td><?php echo $venue_capacity; ?></td>
		<td><?php echo $venue_address_number; ?></td>
		<td><?php echo $venue_street; ?></td>
		<td><?php echo $venue_city; ?></td>
		<td><?php echo $venue_country; ?></td>
	
	</tr>
<?php } ?>
