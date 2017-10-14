<?php require_once 'header.html';?>

<body>

<?php include_once 'analytics.html';?>

<?php require_once 'menubar.html';?>

<!------------------------------ INTRO ---------------------------------->

<section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-section-with-arrow mbr-after-navbar" id="header1-1" style="background-image: url(../assets/images/home_bg.jpg);">

   <div class="mbr-table-cell">

      <div class="container">
         <div class="row">
            <div class="mbr-section col-md-10 col-md-offset-1 text-xs-center">

            <p class="mbr-section-lead lead">
            Assemblée Générale du Club le 20 septembre à 20h30 au <a href="/gymnase/">Gymnase de Rochassieux</a>
            <br>
            Tous les licenciés sont convoqués.
<!--
               01 octobre 2016: Après 10 ans de bons et loyaux services de l'ancien site,<br>
               ouverture en grande pompe du nouveau site du...
-->
            </p>
                    <h2 class="mbr-section-title display-1">Volleyball La Bridoire</h2>
                    <p class="mbr-section-lead lead">
               Vous aimez le <strong>volleyball</strong> et vous cherchez un club dans l'avant-pays savoyard ?<br>
               Bienvenue au club de La Bridoire.
               <br>Nous sommes un petit groupe d'une douzaine de joueurs en manque de volley dans la région et nous avons créé ce club il y a 8 ans.
               <br>Nous sommes engagés dans un championnat (FSGT Savoie) pour un peu de compétition, mais l'important reste la bonne humeur et le plaisir du jeu.<br></p>
<!--
                    <div class="mbr-section-btn">
               <a class="btn btn-lg btn-primary" href="/contacts/contacts.php">Contacts</a>
               <a class="btn btn-lg btn-primary" href="/news/news.php">News</a>
               <a class="btn btn-lg btn-primary" href="/gymnase/gymnase.php">Ou jouons nous</a>
               <a class="btn btn-lg btn-primary" href="/photos/photos.php">Album photos</a>
               <a class="btn btn-lg btn-primary" href="/joueurs/joueurs.php">Joueurs</a>
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
foreach ($files as $file) {
   if (! $lastNewsDisplayed && preg_match('/^news_(\d\d\d\d)-(\d\d)-\d\d\.html$/', $file, $matches) ) {
      echo ' <div class="container"> <div class="row"> <div class="col-xs-12 lead"><p>';
      include_once("news/".$file);
      echo "</div> </div>\n";
      $lastNewsDisplayed = true;
   }
}
?>
   </div>
</div>
<p align="center"><a href="/news/">Toutes les news</a></p>

<!------------------------------ RESULTATS ---------------------------------->
<div class="container">

<?php

require_once 'matchs/game_object.php';
$gamelist = array_merge(Game::GetLastPlayedGames(2), Game::GetUnplayedGames(1));

echo "<div class=\"scoretable\">\n";

foreach ($gamelist as $game) {
   $w = $game->winner();
   if ($w == '') {
      $res = 'unknown'; 
   } elseif ($w == 'VCB' || $w == 'La Bridoire') {
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
<br>
<p align="center"><a href="/matchs/">Tous les r&eacute;sultats</a></p>

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

   <?php include_once 'footer.html';?>

   <?php include_once 'jsscripts.html';?>
   <script src="https://platform.twitter.com/widgets.js"></script>
  
  <input name="animation" type="hidden">
  </body>
</html>
