<?php
require_once('connection.php');
$userid = $_GET["user_id"];
$usercompetitorid = $_GET["user_competitor_id"];
$opponentcompetitorid = $_GET["opponent_competitor_id"];
$choosecompetitionname  = $_GET["competition_name"];
$betcost = $_GET["bet_cost"];
$opponentemail = $_GET["opponent_email"];


$username = pg_query($dbconn3,"select username from users where id = '$userid'");

//$result = pg_fetch_array($email);
$result1 = pg_fetch_array($username);

//image 1
$result2 = pg_query($dbconn3, "select avatar_file_name from users where id= '$userid'");
$rows = array();
while($r = pg_fetch_assoc($result2))
{
	$rows[] = $r;
}

if (strlen($userid)<3)
{
$userid = str_pad($userid, 3, "0", STR_PAD_LEFT);
}
if ($rows[0][avatar_file_name]=="")
{
$ar = array("http://www.sportslion.com/assets/avatar-0b523aaf2f6e9d8aea4d6eb56c4e2db7.png");
}
else
{
$ar = array("http://sportslion.production.s3-eu-west-1.amazonaws.com/users/avatars/000/000/".$userid ."/thumb/".$rows[0][avatar_file_name]);
}

if(isset($opponentemail))
{
echo $opponentemail;
$subject = 'Your friend Roared at you via Sports Lion!';
$body .='<div id=":km" class="ii gt m15166eec3d85d349 adP adO"><div id=":kl" class="a3s" style="overflow: hidden;"><u></u>

<div style="background:#f1f4f5;font-family:Arial;margin:0;padding:0 50px" bgcolor="#f1f4f5">

<table align="center" width="600px" style="background:white;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-collapse:collapse;border:0" bgcolor="white">
<tbody><tr><td style="padding:0 50px;text-align:center" align="center"><img alt="SportsLion Logo" src="https://ci6.googleusercontent.com/proxy/vmBK4YRRiESLXHJo9o3nIH3m0F3-9KaRxIljlLwPre86gtvMuWTv_TGH94tnSl0JftcoM8x3MPJlsDNgCCuf727Kn5KJFBOy9HnA28c6oqjuQ_T2jk8YPP3XLBvQHyFftHBK_NWw=s0-d-e1-ft#http://www.sportslion.com/assets/mails/logo-23e9997c521a6b0884891ac5f277d1e9.png" class="CToWUd"></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><h1 style="color:#2c3e50;font-size:24px;font-weight:normal;margin:0px auto 20px">Grrreetings!</h1></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px">Your friend <b>'.$result1[0].'</b> just Roared at you via Sports Lion.Sports Lion is a social sports gaming platform where you can Roar against other sports lovers and win prizes. To respond to your friend’s Roar, please create an account by following the button below. It’s completely free!</p></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><table align="center" width="500px">
<tbody><tr><td colspan="3" style="color:#3498db;padding:0;text-align:center;vertical-align:bottom" align="center" valign="bottom">'.$choosecompetitionname.'</td></tr>
<tr>
<td style="color:#3498db;font-size:20px;padding:0 0 10px;text-align:center;vertical-align:bottom;width:150px" align="center" valign="bottom">'.$opponentcompetitorid.'</td>
<td style="padding:0;text-align:center;vertical-align:bottom;width:200px" align="center" valign="bottom"></td>
<td style="color:#3498db;font-size:20px;padding:0 0 10px;text-align:center;vertical-align:bottom;width:150px" align="center" valign="bottom">'.$usercompetitorid.'</td>
</tr>
<tr>
<td style="padding:0;text-align:center;vertical-align:middle" align="center" valign="middle"><img alt="avatar" height="60" src="https://ci5.googleusercontent.com/proxy/3o59ArPixdtJIkR-OvcqgxLKNxpykhClEfHmjgIdf6x6pq-DsOjAQXpIGhVDx-6ylDpl6IYg_eYs6UW-J8R7YFIc-EYlLQn7YvWXKQUGZqrOVrkjdvNqsB04XK00ugm1qZQ=s0-d-e1-ft#http://www.sportslion.com/assets/avatar-0b523aaf2f6e9d8aea4d6eb56c4e2db7.png" width="60" style="border-radius:3px;min-height:60px;width:60px" class="CToWUd"></td>
<td style="color:#0fa285;font-size:30px;padding:0;text-align:center;vertical-align:middle" align="center" valign="middle">vs.</td>
<td style="padding:0;text-align:center;vertical-align:middle" align="center" valign="middle"><img alt="avatar" height="60" src="https://ci3.googleusercontent.com/proxy/z0u5F1KC3l0Z7GB9q51p1ZgYp35wrnwRRnl0qS06ch3Ek_oTLcup-Nnf3n2GXbszFJneqGogsDg6NQ28CErWH6v2O_9EM3MNp-AZtBn_zqey8zfEmvr-ELkmqvTKF_DyuXMtUyVeJxGcOj8p0PMig8uTplJCpmZKdoPph4eyQdELrqekd3mQ=s0-d-e1-ft#http://sportslion.production.s3-eu-west-1.amazonaws.com/users/avatars/000/000/270/thumb/Untitled-3.jpg?1426671828" width="60" style="border-radius:3px;min-height:60px;width:60px" class="CToWUd"></td>
</tr>
<tr>
<td style="color:#c1c8cc;font-size:12px;padding:5px 0 0;text-align:center;vertical-align:top" align="center" valign="top">Your Roar</td>
<td style="color:#7f8c8d;padding:0 0 30px;text-align:center;vertical-align:top" align="center" valign="top">
<div style="font-size:18px">'.$betcost.' </div>
<div style="font-size:30px"><b>1</b></div>
<div style="font-size:12px;text-transform:uppercase">lion points</div>
</td>
<td style="color:#c1c8cc;font-size:12px;padding:5px 0 0;text-align:center;vertical-align:top" align="center" valign="top">'.$result1[0].'\'s <span class="il">Roar</span></td>
</tr>
</tbody></table></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px">Do you accept the Roar? Press the button below and...</p></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px"><a href="https://u1311448.ct.sendgrid.net/wf/click?upn=0uGEct9UpobNftvgDBKJt3VwtwVgbHT3HObfGFD855xxW-2BEeGw24k-2FGWsr5XrKvxAVEMpmphiz0xJLbPrJE3MOdnKzOnb9NFEsa2t9BtY1yWw5sajQQDrXd7-2FsZhpy-2BI_MwX99kY-2FYKp7q4PrXgAZbb0KmYv8cBlPwPcI3jMX1Id4mS70LrsS5-2BoHFU-2FIALx1oDK6EbkVxi76M-2BN2vW5l0PaJEX1HzWJg6-2BxIKapEdPMTFNkvQQd1vH-2Fi-2BF9-2Bp4-2BBEKSELJbEk6HmXhz-2Fs-2BS1oa2qriY6wIOTwkBnBzaCnoY4VAFL6aXDCdb6bnCKPDqWgIsSE5EDFUfMgYEEfUKn51y-2FLOft2TYrP4VhbqjQxcc-3D" target="_blank"><img alt="Let\'s go!" src="https://ci6.googleusercontent.com/proxy/B92UEsP2Ja_qk3PP1H6yJAq61Y1DolDF5piEe9FMGnP6t2h2NgRlSUfc2Ep4-WBOKQwwiznhQSnEmGaXnEh_bwrXiz1eForp7RPi7MVWSzsOvO7JvAsskS3WH-hG9HA4AZ-zArE4NnXRFBn5FZKuyw=s0-d-e1-ft#http://www.sportslion.com/assets/mails/button-lets-go-c15142379cab7435ed24ecef1c0393f5.png" class="CToWUd"></a></p></td></tr>
</tbody></table>
<table align="center" width="600px" style="background:#f1f4f5;border-collapse:collapse;border:0" bgcolor="#f1f4f5"><tbody><tr><td style="color:#7f8c8d;font-size:12px;height:50px;padding-top:20px;text-align:center;vertical-align:top" align="center" valign="top"><p style="color:#7f8c8d;font-size:12px;line-height:140%;margin:0 0 20px">© 2014 Sports Lion, 198 Tremont St, Suite 411, Boston, MA 02116.</p></td></tr></tbody></table>

<img src="https://ci4.googleusercontent.com/proxy/wMMCikeZhHaHu8h5sAKNp5ipR9cT5kawftKinCdS7jSGnoJEH0bIuyc7D8r_BE389pnpm7x2BAhBAId7qK511fWtRdCVDgHjKWBBCpECeH6Ec68BlLjCUn2APsY7USgs5Q_fAi_OWla3-Oup6SBoqQk0a7ouOAiBiQjaQLSwJGghQtWzbzk9kVHVSxV_SOrTkL3II6yy4wakF_rOeCKhinx_RHPYVho_JIoEHauCjJuLLathiny1wOd4WoeQkj1J2YVb5pff2Fr5cpEW6xtAeEq4Ka4OuCOgi6VIGcvJu4w07Np3Vdv9YditjPviAjh-upG-b8UouaAS4f41ghqsjVlcLbI56peGwHYUnXUs3kRB9tLtElLiej6fiZY2fUsMA_pM2600EONpAn4kmVCzmizEHJNEzMZOEwCBNT9emwm6YWTi9suMdkmY_Tw=s0-d-e1-ft#https://u1311448.ct.sendgrid.net/wf/open?upn=MwX99kY-2FYKp7q4PrXgAZbb0KmYv8cBlPwPcI3jMX1Id4mS70LrsS5-2BoHFU-2FIALx1jLMoMwdHDxNB0jb-2FqMnzXwVL02OUJA1XvP9CLhEo1o4LUVR-2B-2BTKz-2BK8m4-2FoyUqtEG6nx9hhbo8pjlP4eFEbNygNNHQ3jvtw-2FD8JRjAuIshZqt3-2B351OM4jnMFLv35R2yyx95D6LuZW5pKZRPXL5-2FX9hbJXGauABhBfh-2FXN3G-2BRc-3D" alt="" width="1" height="1" border="0" style="min-height:1px!important;width:1px!important;border-width:0!important;margin-top:0!important;margin-bottom:0!important;margin-right:0!important;margin-left:0!important;padding-top:0!important;padding-bottom:0!important;padding-right:0!important;padding-left:0!important" class="CToWUd"><div class="yj6qo"></div><div class="adL">
</div></div><div class="adL">

</div></div></div>';
$headers  = 'From:noreply@sports_lion.com' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($opponentemail, $subject, $body, $headers);

}
else
{
$opponentid = $_GET["opponent_id"];
$email_confirmation= $result[0];
$opponent_name = '$result1[0]';
$email = pg_query($dbconn3, "select email,username from users where id = '$opponentid'");
$result = pg_fetch_array($email);
//image 2
$result3 = pg_query($dbconn3, "select avatar_file_name from users where id= '$opponentid'");
$rows = array();
while($r = pg_fetch_assoc($result3))
{
	$rows[] = $r;
}

if (strlen($opponentid)<3)
{
$opponentid = str_pad($opponentid, 3, "0", STR_PAD_LEFT);
}
if ($rows[0][avatar_file_name]=="")
{
$ar1 = array("http://www.sportslion.com/assets/avatar-0b523aaf2f6e9d8aea4d6eb56c4e2db7.png");
}
else
{
$ar1 = array("http://sportslion.production.s3-eu-west-1.amazonaws.com/users/avatars/000/000/".$opponentid ."/thumb/".$rows[0][avatar_file_name]);
}

$subject = 'Your friend Roared at you via Sports Lion!';
$body .= '<div style="background:#f1f4f5;font-family:Arial;margin:0;padding:0 50px" bgcolor="#f1f4f5">
<table align="center" width="600px" style="background:white;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-collapse:collapse;border:0" bgcolor="white">
<tbody><tr><td style="padding:0 50px;text-align:center" align="center"><img alt="SportsLion Logo" src="https://ci6.googleusercontent.com/proxy/vmBK4YRRiESLXHJo9o3nIH3m0F3-9KaRxIljlLwPre86gtvMuWTv_TGH94tnSl0JftcoM8x3MPJlsDNgCCuf727Kn5KJFBOy9HnA28c6oqjuQ_T2jk8YPP3XLBvQHyFftHBK_NWw=s0-d-e1-ft#http://www.sportslion.com/assets/mails/logo-23e9997c521a6b0884891ac5f277d1e9.png" class="CToWUd"></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><h1 style="color:#2c3e50;font-size:24px;font-weight:normal;margin:0px auto 20px">Hey there!</h1></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px">Your friend <b>'.$result1[0].'</b> just Roared at you via Sports Lion.</p></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><table align="center" width="500px">
<tbody><tr>
<tr>
<td colspan="3" style="color:#e67e22;padding:0;text-align:center;vertical-align:bottom" align="center" valign="bottom">'.$choosecompetitionname.'</td></tr>
<td style="color:#9b59b6;font-size:20px;padding:0 0 10px;text-align:center;vertical-align:bottom;width:150px" align="center" valign="bottom">'.$opponentcompetitorid.'</td>
<td style="padding:0;text-align:center;vertical-align:bottom;width:200px" align="center" valign="bottom"></td>
<td style="color:#9b59b6;font-size:20px;padding:0 0 10px;text-align:center;vertical-align:bottom;width:150px" align="center" valign="bottom">'.$usercompetitorid.'</td>
</tr>



<tr>
<td style="padding:0;text-align:center;vertical-align:middle" align="center" valign="middle"><img alt="avatar" height="60" src='."$ar1[0]".' width="60" style="border-radius:3px;min-height:60px;width:60px" class="CToWUd"></td>
<td style="color:#0fa285;font-size:30px;padding:0;text-align:center;vertical-align:middle" align="center" valign="middle">vs.</td>
<td style="padding:0;text-align:center;vertical-align:middle" align="center" valign="middle"><img alt="avatar" height="60" src='."$ar[0]".' width="60" style="border-radius:3px;min-height:60px;width:60px" class="CToWUd"></td>
</tr>





<tr>
<td style="color:#c1c8cc;font-size:12px;padding:5px 0 0;text-align:center;vertical-align:top" align="center" valign="top">Your <span class="il">Roar</span></td>
<td style="color:#7f8c8d;padding:0 0 30px;text-align:center;vertical-align:top" align="center" valign="top">
<div style="font-size:18px"><span class="il">Roar</span> fee: </div>
<div style="font-size:30px"><b>'.$betcost.'</b></div>
<div style="font-size:12px;text-transform:uppercase">lion points</div>
</td>
<td style="color:#c1c8cc;font-size:12px;padding:5px 0 0;text-align:center;vertical-align:top" align="center" valign="top">'.$result1[0].'\'s <span class="il">Roar</span></td>
</tr>
</tbody></table></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px">To respond to the <span class="il">Roar</span>, please press the button below.</p></td></tr>
<tr><td style="padding:0 50px;text-align:center" align="center"><p style="color:#7f8c8d;font-size:16px;line-height:140%;margin:0 0 20px"><a href="https://u1311448.ct.sendgrid.net/wf/click?upn=0uGEct9UpobNftvgDBKJt3VwtwVgbHT3HObfGFD855xMITpcb3-2BMKRYQc0U9clBn_OosyQsN5v6JoKe-2FxMcS9EP6WnA4Z5saSEMHmlze-2Ff0-2BvAibEhLh49P2iWjP6MWrRwh-2FidqEazsyxhx7PtYpNrHlrcqVxocJVAp7vfyq-2FnZiVEBL5Jch2Q5-2FRs2SmnSESw8YBk6vs5XLDeLflzanaZujmj5NpyhivR-2B-2BGP3Zz57VMH57pqq9RxxopDUlrEbir1eGWxe5XuNCQNnhu2rPgOQ-3D-3D" target="_blank"><img alt="Let\'s go!" src="https://ci6.googleusercontent.com/proxy/B92UEsP2Ja_qk3PP1H6yJAq61Y1DolDF5piEe9FMGnP6t2h2NgRlSUfc2Ep4-WBOKQwwiznhQSnEmGaXnEh_bwrXiz1eForp7RPi7MVWSzsOvO7JvAsskS3WH-hG9HA4AZ-zArE4NnXRFBn5FZKuyw=s0-d-e1-ft#http://www.sportslion.com/assets/mails/button-lets-go-c15142379cab7435ed24ecef1c0393f5.png" class="CToWUd"></a></p></td></tr>
</tbody></table>
<table align="center" width="600px" style="background:#f1f4f5;border-collapse:collapse;border:0" bgcolor="#f1f4f5"><tbody><tr><td style="color:#7f8c8d;font-size:12px;height:50px;padding-top:20px;text-align:center;vertical-align:top" align="center" valign="top"><p style="color:#7f8c8d;font-size:12px;line-height:140%;margin:0 0 20px">© 2014 Sports Lion, 198 Tremont St, Suite 411, Boston, MA 02116.</p></td></tr></tbody></table>
</div>';
$headers  = 'From:noreply@sports_lion.com' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//Mail it
mail($email_confirmation, $subject, $body, $headers);	
}

?>
