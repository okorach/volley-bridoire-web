
<?php include 'inc/header.html';?>

<body>

<?php
include 'inc/analytics.html';
include 'inc/menubar.html';
?>

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

include 'lib/game.php';
$gamelist = Game::ReadFromDB();

echo "<div class=\"scoretable transbox\">\n";
foreach ($gamelist as $game)
{
	$w = $game->winner();
	if ($w == '') {
		$res = 'unknown';
	} elseif ($w == 'VCB') {
		$res = 'win';
	} else {
		if (preg_match('/(3\/2|2\/3)/', $game->getScore())) {
			$res = 'tiebreak';
		} else {
			$res = 'loss';
		}
	} 
	echo "<div class=\"gamerow\">\n";
	echo "   <div class=\"scoretablecell gamedate\">".$game->getDate('%d/%m/%y')."</div>\n";
	echo "   <div class=\"scoretablecell team vcb-team\">".$game->getHomeTeam()."</div>\n";
	echo "   <div class=\"scoretablecell score vcb-score $res\" title=\"".$game->getSets()."\">".$game->getScore()."</div>\n";
	echo "   <div class=\"scoretablecell team vcb-team\">".$game->getAwayTeam()."</div>\n";
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
