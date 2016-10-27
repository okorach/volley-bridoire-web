<?php include 'inc/header.html';?>

<body>

<?php include 'inc/analytics.html';?>

<?php include 'inc/menubar.html';?>

<section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-section-with-arrow mbr-after-navbar" id="header1-1" style="background-image: url(assets/images/home_bg.jpg);">

    <div class="mbr-table-cell">

        <div class="container">
            <div class="row">
                <div class="mbr-section col-md-10 col-md-offset-1 text-xs-center">

				<p class="mbr-section-lead lead">
					01 octobre 2016: Après 10 ans de bons et loyaux services de l'ancien site,<br>
					ouverture en grande pompe du nouveau site du...
				</p>
                    <h1 class="mbr-section-title display-1">Volleyball La Bridoire</h1>
                    <p class="mbr-section-lead lead">
					Vous aimez le <strong>volleyball</strong> et vous cherchez un club dans l'avant-pays savoyard ?<br>
					Bienvenue au club de La Bridoire.
					<br>Nous sommes un petit groupe d'une douzaine de joueurs en manque de volley dans la région et nous avons créé ce club il y a 8 ans.
					<br>Nous sommes engagés dans un championnat (FSGT Savoie) pour un peu de compétition, mais l'important reste la bonne humeur et le plaisir du jeu.<br></p>
                    <div class="mbr-section-btn">
					<a class="btn btn-lg btn-primary" href="contacts.php">Contacts</a>
					<a class="btn btn-lg btn-primary" href="news.php">News</a>
					<a class="btn btn-lg btn-primary" href="gymnase.php">Ou jouons nous</a>
					<a class="btn btn-lg btn-primary" href="photos.php">Album photos</a>
					<a class="btn btn-lg btn-primary" href="joueurs.php">Joueurs</a>
					<!--a class="btn btn-lg btn-white btn-white-outline" href="https://mobirise.com">CLICK TO EDIT</a-->
					</div>
                </div>
            </div>
        </div>
    </div>

    <!--div class="mbr-arrow mbr-arrow-floating" aria-hidden="true"><a href="#footer1-2"><i class="mbr-arrow-icon"></i></a></div-->

</section>

<section class="mbr-section article mbr-section__container" id="content1-0" style="background-color: rgb(204, 204, 204); padding-top: 20px; padding-bottom: 20px;">

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
		include($file);
		echo "</div> </div> </div> <p></p>\n";
		$lastNewsDisplayed = true;
	}
}
?>
</section>

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
  
  <input name="animation" type="hidden">
  </body>
</html>