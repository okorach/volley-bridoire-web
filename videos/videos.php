<?php require_once 'header.html';?>

<body>

<?php include_once 'analytics.html';?>

<?php require_once 'menubar.html';?>

<?php
$id = ($id = filter_input(INPUT_GET, 'id')) ? $id : '1';
$id = filter_var($id, FILTER_SANITIZE_STRING);

$fh = fopen("videos.csv", "r");
while (false !== ($line = fgets($fh))) {
   $data = preg_split('/\s*,\s*/', $line, 3);
   $title[] = $data[0];
   $url[] = $data[1];
   $description[] = $data[2];
}
fclose($fh);

$last = count($title)+1;

?>

<section class="mbr-section mbr-parallax-background mbr-section-hero" id="index-msg-box7-0" style="background-image: url(.../photos/perso/vcb-2014-2.jpg); padding-top: 240px; padding-bottom: 240px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);">
    </div>
    <div class="container">
        <div class="row">
            <div class="mbr-table-md-up">

              

              <div class="mbr-table-cell mbr-right-padding-md-up col-md-5 text-xs-center text-md-right">
<?php
echo '                  <h3 class="oko-carousel-title oko-display-1">'.$title[$id-1]."</h3>\n";
echo '                  <div class="oko-carousel-lead oko-lead">'."\n";
echo '                  <p>'.$description[$id-1]."</p>\n";
echo "                  <p/>\n";
echo '                  </div>'."\n";
echo '                  <div>'."\n";
echo "                  <p>Autres Vid&eacute;os:<br>\n";
$last = count($url);
for ($i = 0; $i <= $last; $i++)
{
   $n = $i+1;
   echo '<a href="videos.php?id='.$n.'">'.$title[$i].'</a><br>'."\n";
}
echo '                  </div>'."\n";
echo '               </div>'."\n";
echo '              <div class="mbr-table-cell mbr-valign-top col-md-7">'."\n";
echo '              <div class="mbr-figure"><iframe class="mbr-embedded-video" src="'.$url[$id-1].'?autoplay=1&amp;loop=0" width="1280" height="720" frameborder="0" allowfullscreen></iframe></div>'."\n";
?>
              </div>

            </div>
        </div>
    </div>

</section>

<?php include_once 'footer.html';?>

<?php include_once 'jsscripts.html';?>
  
<input name="animation" type="hidden">
</body>
</html>
