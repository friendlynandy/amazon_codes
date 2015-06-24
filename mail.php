<?php

$full_name = $_GET["full_name"];
$encrypted_password = $_GET["encrypted_password"];
$username = $_GET["username"];
$email = $_GET["email"];
$tos_agreement = $_GET["tos_agreement"];
$balance = $_GET["balance"];
$id = $_GET["id"];

echo $full_name;
echo $email;
echo $id;
echo $username;

/*if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}*/

function str_random($length = 60)
 {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$code = str_random();
$date = new DateTime();
$timestamp = $date->format('Y-m-d H:i:s');
require_once('connection.php');
pg_query($dbconn3, "INSERT INTO users (full_name,encrypted_password,username,email,tos_agreement,balance,confirmation_token,created_at,updated_at) VALUES('$full_name','$encrypted_password','$username','$email','$tos_agreement','$balance','$code','$timestamp','$timestamp')");


//edit profile
//pg_query($dbconn3,"update users set full_name = '$full_name', updated_at='$timestamp',emailid = '$email', username = '$username' where id = '$user_id'");


// connect to database and save this code along with datimestamps
$subject = 'Confirmation email';
// message

$message .= '<div style="background:#f1f4f5;font-family:Arial;margin:0;padding:0 50px" bgcolor="#f1f4f5">
<table align="center" width="600px" style="background:white;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-collapse:collapse;border:0" bgcolor="white">
<tbody><tr><td style="padding:0 50px;text-align:center" align="center"><img alt="SportsLion Logo" src="https://ci6.googleusercontent.com/proxy/vmBK4YRRiESLXHJo9o3nIH3m0F3-9KaRxIljlLwPre86gtvMuWTv_TGH94tnSl0JftcoM8x3MPJlsDNgCCuf727Kn5KJFBOy9HnA28c6oqjuQ_T2jk8YPP3XLBvQHyFftHBK_NWw=s0-d-e1-ft#http://www.sportslion.com/assets/mails/logo-23e9997c521a6b0884891ac5f277d1e9.png" class="CToWUd"></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><h1 style="color:#2c3e50;font-size:24px;font-weight:normal;margin:0px auto 20px">Dear '.$username.'</h1></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px">The Sports Lion senses that your Roar is strong. Please press the button below to confirm your e-mail and to begin your Roar.</p></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px"><a href="https://u1311448.ct.sendgrid.net/wf/click?upn=0uGEct9UpobNftvgDBKJt3VwtwVgbHT3HObfGFD855whspWtIdmlcIUNfwuZulxStTQkHRSaHCmcW0yOMWC4IC37C8uA-2B7MmqfwiPcciSvRJf8rYJlFAdwRz65-2F33dkt_z5vLPidU7O8UDGHtjcZbWNZXAXQrnBCz0aBK5dlxSR4XEi9Qe1aY0HIRdmHzPld9rgGobmy-2Bp-2BAbTf06pno14mIHS85TT0H7-2FfcH6RekHB1rtxvkL3QcnEkWHEJxlp55laTklzWnFpkn8vKiSGfK-2F1nuqdc5aZ7pOWZYxtWeEIc2CsNoA-2BH6ZbvEHvrXvGVFi-2FpuWEGgd-2FxvPHFFCbWDGg-3D-3D" target="_blank"><img alt="Button confirm email" src="https://ci6.googleusercontent.com/proxy/abXCoiltd1kyWhm8YVe1aHX-4BssyPRTWT1wsRQUoWPRbBD1TauAw1WoBvKvDnsfrcBY99z-x6iiSBE0XSip3IgeUP7HrHrCVcogBAoY5lJE1Td2lVZJLkkBF1ScEbMpUeHZjU2Yx2-caJ2yMf4elMr9GGH97g=s0-d-e1-ft#http://www.sportslion.com/assets/mails/button-confirm-email-3f3cb7b5b522f08ba9e829af612e725b.png" class="CToWUd"></a></p></td></tr>
</tbody></table>
<table align="center" width="600px" style="background:#f1f4f5;border-collapse:collapse;border:0" bgcolor="#f1f4f5"><tbody><tr><td style="color:#7f8c8d;font-size:12px;height:50px;padding-top:20px;text-align:center;vertical-align:top" align="center" valign="top"><p style="color:#7f8c8d;font-size:12px;line-height:140%;margin:0 0 20px">© 2014 Sports Lion, 198 Tremont St, Suite 411, Boston, MA 02116.</p></td></tr></tbody></table>

<img src="https://ci5.googleusercontent.com/proxy/nwwxIhiWADZoTfF-r8Le9Jzmf4mqFcb1V6NgQWkab9vmwnYRRUGqrhXWaYt8_QUsdRML2r4awjYPnwrP5bqBX9qz0Yi2D1RgGt0TqDFY4EH5pEYCD1DhEInGdVmiZ76_CsFxYfEtyip-jASX95oS88MWnVtdZmIqr3NS_Z-toM9LWByE6EJOypkFyfBrs_qMH6MnpEA7JCfvQ8dSW0brfnLiLxIE_Og90RErzWT740kWuBPl6EuTBELpxeYk16um3LWKSAH72TgUAYvuisSHxLFy0U-NkNNYxb1DNHsZNHRkUou9GP2MkutcuP8ECsjF-J-MZ49eeQt7mzX4pxFZL_SghRQfH8CM_qwAMghAvJE_iQxlXkvoIlTj7DgkzYAXiZTsif4g1YJD4XeCkmxosLvNCv42f-fMz89CJT4aoKg=s0-d-e1-ft#https://u1311448.ct.sendgrid.net/wf/open?upn=z5vLPidU7O8UDGHtjcZbWNZXAXQrnBCz0aBK5dlxSR4XEi9Qe1aY0HIRdmHzPld9q7zbOd4KfDP-2BCLwYwR8M6y-2BlGuSVI5B1-2FuM3-2FmgbCiX2VwN2zz98n3VdQdhyDU9q2j5K3eHeb90PvKVQHt41OpuEUaIkmnGdqogdbbc4ySP0UVvBlLO-2Fmuk1ThSlD-2By1M4yve-2FOFukfpGaRAmx2bw2LaAHFQlALAIIfUC0PTE5E-3D" alt="" width="1" height="1" border="0" style="min-height:1px!important;width:1px!important;border-width:0!important;margin-top:0!important;margin-bottom:0!important;margin-right:0!important;margin-left:0!important;padding-top:0!important;padding-bottom:0!important;padding-right:0!important;padding-left:0!important" class="CToWUd">
</div>';
$message .= "<tr><td><strong>Please click on this link:</strong> </td><td><a href=http://www.sportslionleaderboard.com/app/activate.php?code=".$code."&username=".$username.">Activate my Account</a></td></tr>";

// To send HTML mail, the Content-type header must be set
$headers  = 'From:noreply@sportslion.com' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


// Mail it
mail($email, $subject, $message, $headers);
$date_new = new DateTime();
$timestamp_new = $date_new->format('Y-m-d H:i:s');
pg_query($dbconn3, "update users set confirmation_sent_at = '$timestamp_new' where username= '$username'");
pg_close($dbconn3);
?>
