<?php
require_once('connection.php');
$opponentid = $_GET["opponent_id"];
$userid = $_GET["user_id"];
$usercompetitorid = $_GET["user_competitor_id"];
$opponentcompetitorid = $_GET["opponent_competitor_id"];
$choosecompetitionname  = $_GET["competition_name"];
$betcost = $_GET["bet_cost"];

$email = pg_query($dbconn3, "select email,username from users where id = '$opponentid'");
$username = pg_query($dbconn3,"select username from users where id = '$userid'");

$result = pg_fetch_array($email);
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


$email_confirmation= $result[0];
$opponent_name = '$result1[0]';
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
?>