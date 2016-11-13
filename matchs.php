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

$fh = fopen("matchs.csv", "r");
while (false !== ($line = fgets($fh))) {
	$data = preg_split('/\s*,\s*/', trim($line));
	#print_r($data);
   $datematch[] = $data[0];
   $eqdom[] = $data[1];
   $eqvis[] = $data[2];
   $score[] = $data[3];
	$sets[] = $data[4];
}
fclose($fh);

echo "<div class=\"scoretable\">\n";
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
