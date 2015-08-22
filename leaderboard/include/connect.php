<?php
// Connecting, selecting database
$conn_string= "host=ec2-79-125-7-27.eu-west-1.compute.amazonaws.com port=5552 dbname=d39ubt6siqrqmf user=u5rve30b5so8gv password=peqhcba53fc1d4qrebs5ok7b22";
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