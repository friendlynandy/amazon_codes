<div id="secondary" class="widget-area alignright" role="complementary">
		
				<aside id="text-3" class="widget widget_text"><h1 class="widget-title">Today's Roars</h1>			
				
<div class="textwidget">
<?php
$today = date('Y-m-d H:m:s');
$date1 = str_replace('-', '/', $date);
$tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));

include("connect.php");
$query = "select distinct b.id,b.name from matches a left join competitions b on a.competition_id = b.id where a.start_at >= '".$today."' and a.end_at <= '".$tomorrow."'";


$result = pg_query($query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
while ($row = pg_fetch_row($result)) {
  echo "$row[1]";
$query1 = "select name,start_at from matches where competition_id = '".$row[0]."' and start_at >= '".$today."' and end_at <= '".$tomorrow."'";
$result1 = pg_query($query1) or die('Query failed: ' . pg_last_error());
echo "<table align=\"center\" style=\"border-spacing:10px;\">";
echo "<hr />";

while ($line= pg_fetch_row($result1)) 
{
echo "<b>";
 print_r($line[0]);
echo "</b>";
$now = new DateTime();
$future_date = new DateTime($line[1]);
$interval = $future_date->diff($now);
echo "<br>";
echo $interval->format("Time Left: %h hours and %i minutes");
echo "<br><br>";
    }
echo "</table>\n";
}



// Free resultset
pg_free_result($result);
pg_close($dbconn);
?>				

</div>
		</aside><aside id="facebook-likebox-2" class="widget widget_facebook_likebox"><h1 class="widget-title"><a href="https://www.facebook.com/pages/Sports-Lion/227310750800373">Sports Lion Facebook</a></h1><iframe src="https://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FSports-Lion%2F227310750800373&amp;width=300&amp;height=400&amp;colorscheme=light&amp;show_faces=false&amp;stream=true&amp;show_border=true&amp;header=false&amp;force_wall=false" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 300px;  height: 400px; background: #fff"></iframe></aside></div><!-- #secondary -->
</div><!-- #content -->
</div><!-- #page -->
	<footer id="colophon" class="site-footer" role="contentinfo">
	<hr>
		<div id="footer-menu">
		<div class="menu-footer-menu-container"><ul id="menu-footer-menu" class="menu"><li id="menu-item-159" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-159"><a href="http://www.sportslion.com/about">About</a></li>
<li id="menu-item-160" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-160"><a href="http://www.sportslion.com/faq">FAQ</a></li>
<li id="menu-item-161" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-161"><a href="http://www.sportslion.com/terms_of_service">Terms of Service</a></li>
<li id="menu-item-162" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-162"><a href="http://www.sportslion.com/privacy">Privacy Policy</a></li>
</ul></div>		</div>
		<div class="site-info">
						Copyright © SPORTS LION 2015 		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<div style="display:none">
	</div>
		<script type="text/javascript">
			!function(d,s,id){
				var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
				if(!d.getElementById(id)){
					js=d.createElement(s);
					js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js,fjs);
				}
			}(document,"script","twitter-wjs");
		</script>
		<script type="text/javascript" src="http://s0.wp.com/wp-content/js/devicepx-jetpack.js?ver=201510"></script>
<script type="text/javascript" src="http://s.gravatar.com/js/gprofiles.js?ver=2015Maraa"></script>
<script type="text/javascript">
/* <![CDATA[ */
var WPGroHo = {"my_hash":""};
/* ]]> */
</script>