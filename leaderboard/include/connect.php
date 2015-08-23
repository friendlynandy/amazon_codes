<?php
// Connecting, selecting database
$conn_string= "host=ec2-54-217-247-223.eu-west-1.compute.amazonaws.com port=5442 dbname=d39ubt6siqrqmf user=u5rve30b5so8gv password=peqhcba53fc1d4qrebs5ok7b22";
$dbconn = pg_pconnect($conn_string);
if (!$dbconn) 
{
    print("Connection Failed.");
    exit;
}



// Closing connection
//pg_close($dbconn);
?>
</html>
