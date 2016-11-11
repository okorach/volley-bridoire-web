<?php include 'inc/header.html';?>

<body>

<?php include 'inc/analytics.html';?>

<?php include 'inc/menubar.html';?>

<section class="mbr-slider mbr-section mbr-section__container carousel slide mbr-section-nopadding mbr-after-navbar" data-ride="carousel" data-keyboard="false" data-wrap="true" data-pause="false" data-interval="5000" id="page1-slider3-0">
    <div>
        <div>
            <div>
                <ol class="carousel-indicators">

<?php

$fh = fopen("photos.csv", "r");
while (false !== ($line = fgets($fh))) {
	$data = preg_split('/\s*,\s*/', $line, 3);
   $photos[] = $data[0];
   $titles[] = $data[1];
   $descriptions[] = $data[2];
}
fclose($fh);

$last = count($photos)+1;
for ($i = 0; $i <= $last; $i++)
{
	$class = ($i == 0 ? 'class="active"' : ($i == $last ? 'class=""' : ''));
	echo '<li data-app-prevent-settings="" data-target="#page1-slider3-0" data-slide-to="'; echo $i; echo "\" $class></li>\n";
}
?>
                </ol>
                <div class="carousel-inner" role="listbox">

<?php
for ($i = 0; $i < count($photos); $i++)
{
   echo '<div class="mbr-section mbr-section-hero carousel-item dark center mbr-section-full';
   if ($i == 0) { echo ' active'; }
   echo '" data-bg-video-slide="false" style="background-image: url(photos/perso/'.$photos[$i].');">'."\n";
   echo '   <div class="mbr-table-cell">'."\n";
   echo '      <div class="mbr-overlay"></div>'."\n";
   echo '      <div class="container-slide container">'."\n";
   echo '         <div class="row">'."\n";
   echo '            <div class="col-md-8 col-md-offset-1 text-xs-left">'."\n";
   echo '               <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>'."\n";
   echo '               <h2 class="oko-carousel-title oko-display-1">'.$titles[$i].'</h2>'."\n";
   echo '               <p class="oko-carousel-lead oko-lead">'.$descriptions[$i]."</p>\n";
   echo '            </div>'."\n";
   echo '         </div>'."\n";
   echo '      </div>'."\n";
   echo '   </div>'."\n";
   echo '</div>'."\n";
}
?>
                </div>
					
                <a data-app-prevent-settings="" class="left carousel-control" role="button" data-slide="prev" href="#page1-slider3-0">
                    <span class="icon-prev" aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a data-app-prevent-settings="" class="right carousel-control" role="button" data-slide="next" href="#page1-slider3-0">
                    <span class="icon-next" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>
        </div>
    </div>
</section>


	<?php include 'inc/footer.html';?>

	<?php include 'inc/jsscripts.html';?>

  <input name="animation" type="hidden">
  </body>
</html>
