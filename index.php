<?php include 'inc/header.html';?>

<body>

<?php include 'inc/analytics.html';?>

<?php include 'inc/menubar.html';?>

<!------------------------------ INTRO ---------------------------------->

<section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-section-with-arrow mbr-after-navbar" id="header1-1" style="background-image: url(assets/images/home_bg.jpg);">

    <div class="mbr-table-cell">

        <div class="container">
            <div class="row">
                <div class="mbr-section col-md-10 col-md-offset-1 text-xs-center">

            <p class="mbr-section-lead lead">
               01 octobre 2016: Après 10 ans de bons et loyaux services de l'ancien site,<br>
               ouverture en grande pompe du nouveau site du...
            </p>
                    <h2 class="mbr-section-title display-1">Volleyball La Bridoire</h2>
                    <p class="mbr-section-lead lead">
               Vous aimez le <strong>volleyball</strong> et vous cherchez un club dans l'avant-pays savoyard ?<br>
               Bienvenue au club de La Bridoire.
               <br>Nous sommes un petit groupe d'une douzaine de joueurs en manque de volley dans la région et nous avons créé ce club il y a 8 ans.
               <br>Nous sommes engagés dans un championnat (FSGT Savoie) pour un peu de compétition, mais l'important reste la bonne humeur et le plaisir du jeu.<br></p>
<!--
                    <div class="mbr-section-btn">
               <a class="btn btn-lg btn-primary" href="contacts.php">Contacts</a>
               <a class="btn btn-lg btn-primary" href="news.php">News</a>
               <a class="btn btn-lg btn-primary" href="gymnase.php">Ou jouons nous</a>
               <a class="btn btn-lg btn-primary" href="photos.php">Album photos</a>
               <a class="btn btn-lg btn-primary" href="joueur.php">Joueurs</a>
               </div>
-->
                </div>
            </div>
        </div>
    </div>

    <!--div class="mbr-arrow mbr-arrow-floating" aria-hidden="true"><a href="#footer1-2"><i class="mbr-arrow-icon"></i></a></div-->

</section>

<!--section class="mbr-section article mbr-section__container" id="content1-0" style="background-color: rgb(204, 204, 204); padding-top: 20px; padding-bottom: 20px;"-->

<section class="mbr-section mbr-section--relative mbr-section--fixed-size" id="twitter-feed-block-1" style="background-color: rgb(255, 255, 255);">
            
<div class="row">

<!------------------------------ LEFT COLUMN ------------------------------>
<div class="col-xs-12 col-md-6 lead">

<!------------------------------ TWITTER ---------------------------------->

<div class="container">
   <div class="mbr-section__container mbr-section__container--isolated">
      <div class="twitterFeed text-center"><a name="twitter"><a class="twitter-timeline" href="https://twitter.com/volleybridoire" data-widget-id="670227744614187012" data-screen-name="volleybridoire" data-theme="light" width="520" height="600">Tweets by @VolleyBridoire</a>
      </div>
   </div>   
</div>

</div>

<!------------------------------ RIGHT COLUMN -------------------------->
<div class="col-xs-12 col-md-6 lead">

<!------------------------------ NEWS ---------------------------------->

<div class="container">
   <div class="mbr-section__container mbr-section__container--isolated">
<?php

$dh  = opendir('news');
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
closedir($dh);
rsort($files);
$lastNewsDisplayed = false;
foreach ($files as $file)
{
   if ($lastNewsDisplayed == false && preg_match('/^news_(\d\d\d\d)-(\d\d)-\d\d\.html$/', $file, $matches) )
   {
      echo ' <div class="container"> <div class="row"> <div class="col-xs-12 lead"><p>';
      include("news/".$file);
      echo "</div> </div>\n";
      $lastNewsDisplayed = true;
   }
}
?>
   </div>
</div>
<p align="center"><a href="news.php">Toutes les news</a></p>

<!------------------------------ RESULTATS ---------------------------------->
<div class="container">

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

$maxGames = 3;
$nbGames = 0;

echo "<div class=\"scoretable\">\n";

for ($i=0; $i<count($score); $i++)
{
   if ($score[$i] == '') {
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
   if ($nbGames < $maxGames && ($i+1==count($score) || ($i+1<count($score) && $score[$i+1] != ''))) {
      $nbGames++;
      echo "<div class=\"gamerow\">\n";
      echo "   <div class=\"scoretablecell gamedate\">$datematch[$i]</div>\n";
      echo "   <div class=\"scoretablecell team vcb-team\">$eqdom[$i]</div>\n";
      echo "   <div class=\"scoretablecell score vcb-score $res\" title=\"$sets[$i]\">$score[$i]</div>\n";
      echo "   <div class=\"scoretablecell team vcb-team\">$eqvis[$i]</div>\n";
      #echo "   <td>$datematch[$i]<br>$sets[$i]</td>";
      echo "</div>\n";
   }
}
echo "</div>\n";

?>
    </div>
</div>
<br>
<p align="center"><a href="matchs.php">Tous les r&eacute;sultats</a></p>

</section>

<!------------------------------ SHARE ---------------------------------->

<section class="mbr-section mbr-section-md-padding mbr-after-navbar" id="page3-social-buttons1-0" style="background-color: rgb(255, 255, 255); padding-top: 90px; padding-bottom: 90px;">
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2">Partagez cette page!</h3>
                <div>

                  <div class="mbr-social-likes" data-counters="false">
                    <span class="btn btn-social facebook" title="Share link on Facebook">
                        <i class="socicon socicon-facebook"></i>
                    </span>
                    <span class="btn btn-social twitter" title="Share link on Twitter">
                        <i class="socicon socicon-twitter"></i>
                    </span>
                    <span class="btn btn-social plusone" title="Share link on Google+">
                        <i class="socicon socicon-google"></i>
                    </span>
                    
                    
                  </div>

                </div>
            </div>
        </div>
    </div>
</section>

   <?php include 'inc/footer.html';?>

   <?php include 'inc/jsscripts.html';?>
   <script src="https://platform.twitter.com/widgets.js"></script>
  
  <input name="animation" type="hidden">
  </body>
</html>
