<?php

$to = $_GET['email'];

// subject
$subject = 'Confirmation email';

// message
$message = '
<html>
<head>
  <title>Confirmation Email to join Sports Lion</title>
</head>
<body>
  <p>Please click on the link below</p>
  <table>
    <tr>
      <th>you need to place the link here..</th>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


// Mail it
mail($to, $subject, $message, $headers);
?>