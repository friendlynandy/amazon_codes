<?php
$servername = "143.95.39.130";
$username = "i1241812_wp1";
$password = "I]UkkPRz4x14";
$port = "3306";
$dbname = "i1241812_wp1";
//$x = $_GET["x"];
//$y = $_GET["y"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$category = $_GET["category"];

if($category=="12")
{
$result = mysqli_query($conn, "SELECT wp_posts.id as id,`post_date`, `post_excerpt`,`post_title`,`post_name`,`guid`,wp_users.display_name
FROM  `wp_posts` 
LEFT JOIN wp_users ON wp_posts.post_author = wp_users.id
WHERE  `post_status` =  'publish'
AND  `post_title` !=  ''
AND  `post_content` !=  ''
AND  `post_content_filtered` =  ''
AND  `post_type` =  'post' order by wp_posts.id desc");
}
else
{
$result = mysqli_query($conn, "SELECT a.id,a.`post_date`, a.`post_excerpt`,a.`post_title`,a.`post_name`,a.`guid`,b.display_name
FROM  `wp_posts` a
LEFT JOIN wp_users b ON a.post_author = b.id
LEFT JOIN wp_term_relationships c ON a.id = c.object_id
WHERE  `post_status` =  'publish'
AND  `post_title` !=  ''
AND  `post_content` !=  ''
AND  `post_content_filtered` =  ''
AND  `post_type` =  'post'
AND c.term_taxonomy_id = '$category'
order by a.id desc");
}
if (!$result) {
    echo 'Could not run query: ' . mysqli_error();
    exit;
}
$rows = array();
while($r = mysqli_fetch_assoc($result))
{
	$rows[] = $r;
	
}
foreach ($rows as $key => $value) 
{
$date = $rows[$key][post_date];
$time = strtotime($date);
$newformat = date('F j, Y',$time);

$result1 = mysqli_query($conn, "SELECT meta_value FROM wp_postmeta WHERE post_id = (SELECT meta_value FROM wp_postmeta WHERE post_id =".$rows[$key][id]."
AND meta_key =  \"_thumbnail_id\" ) AND meta_key =  \"_wp_attached_file\"");
if (!$result1) {
    echo 'Could not run query2: ' . mysqli_error();
    exit;
}

$rows1 = array();
while($r1 = mysqli_fetch_assoc($result1))
{
	$rows1[] = $r1;
}
if ($rows1[0][meta_value]=="")
{
$rows[$key][image_url] = "http://savanna.sportslion.com/leaderboard/app/logo.png";
}else{
$pieces = explode("-e",$rows1[0][meta_value]);
if($pieces[1]=="")
{
$piece = explode(".j",$pieces[0]);
$rows[$key][image_url] = "http://savanna.sportslion.com/wp-content/uploads/".$piece[0]."-150x150.jpg";
}
else
{
$rows[$key][image_url] = "http://savanna.sportslion.com/wp-content/uploads/".$pieces[0]."-150x150.jpg";
}
}
if ($rows[$key][post_excerpt]=="null" || $rows[$key][post_excerpt]=="")
$rows[$key][post_excerpt] = "Please click here to read more";
}
unset($value);
echo json_encode($rows);
$conn->close();
?>
