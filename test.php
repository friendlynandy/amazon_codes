$name = $_POST['name'];
$email = $_POST['account'];
$location = $_POST['location'];

foreach( $name as $key => $n ) {
  print "The name is ".$n.", email is ".$email[$key].
        ", and location is ".$location[$key].". Thank you\n";
}
