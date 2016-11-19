<?php include 'inc/header.html';?>

<body>

<?php include 'inc/analytics.html';?>

<?php include 'inc/menubar.html';?>

<?php
if (isset($_GET['saison'])) {
   $saison = $_GET['saison'];
} else {
   $saison = 2016;
}
$nextyear = $saison+1;
?>

<style>
div.transbox {
    margin: auto;
    background-color: #ffffff;
    border: 1px solid black;
    opacity: 0.7;
    filter: alpha(opacity=70); /* For IE8 and earlier */
}
</style>

<section class="mbr-section mbr-parallax-background mbr-after-navbar" id="msg-box8-0" style="background-image: url(assets/images/desert.jpg); padding-top: 80px; padding-bottom: 40px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
<?php
               echo "<h3 class=\"mbr-section-title display-2\">Résultats Saison $saison/$nextyear</h3>";
?>           
            </div>
        </div>
    </div>

</section>

<section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background" id="planning_matchs" style="background-image: url(photos/backgrounds/bg_joueur_attack.jpg);">

<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1); 
error_reporting(E_ALL | E_STRICT);

if (! ($link = mysql_connect('sql.free.fr', 'volley.bridoire', 'lhassa73')) ) {
   echo( '3 Unable to connect to database: '.mysql_error().'"'."\n");
}

if ( !  mysql_select_db('volley.bridoire') ) {
   die( 'Unable to select database: "'.mysql_error().'"'."\n");
}
$result=mysql_query('select * from matchs');

$n = mysql_numrows($result);
for ($i = 0; $i < $n; $i++)
{
	$a = preg_split("/-/", mysql_result($result,$i,'date_match'));
   $a[0] = $a[0] % 100;
   $datematch[] = $a[2]."/".$a[1]."/".$a[0];
   $eqdom[] = mysql_result($result,$i,'equipe_domicile');
   $eqvis[] = mysql_result($result,$i,'equipe_visiteur');
   $score[] = mysql_result($result,$i,'score1');
	$sets[] = mysql_result($result,$i,'score2');
}
mysql_close($link);

echo "<div class=\"scoretable transbox\">\n";
for ($i=0; $i<count($score); $i++)
{
	if ($score[$i] == "") {
		$res = 'unknown';
	} else if ($eqdom[$i] == 'VCB') {
		if (preg_match('/3\//', $score[$i])) {
			$res = 'win';
		} else if (preg_match('/2\/3/', $score[$i])) {
			$res = 'tiebreak';
		} else {
			$res = 'loss';
		}
	} else {
		if (preg_match('/\/3/', $score[$i])) {
			$res = 'win';
		} else if (preg_match('/3\/2/', $score[$i])) {
			$res = 'tiebreak';
		} else {
			$res = 'loss';
		}
	}
	echo "<div class=\"gamerow\">\n";
	echo "   <div class=\"scoretablecell gamedate\">$datematch[$i]</div>\n";
	echo "   <div class=\"scoretablecell team vcb-team\">$eqdom[$i]</div>\n";
	echo "   <div class=\"scoretablecell score vcb-score $res\" title=\"$sets[$i]\">$score[$i]</div>\n";
	echo "   <div class=\"scoretablecell team vcb-team\">$eqvis[$i]</div>\n";
	#echo "   <td>$datematch[$i]<br>$sets[$i]</td>";
	echo "</div>\n";

}
echo "</div>\n";

?>
    </div>
</div>

</section>

	<?php include 'inc/footer.html';?>

	<?php include 'inc/jsscripts.html';?>
   <script src="https://platform.twitter.com/widgets.js"></script>
  
  <input name="animation" type="hidden">
  </body>
</html>
