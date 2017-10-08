<?php require_once '/inc/header.html';?>

<body>

<?php include_once '/inc/analytics.html';?>

<?php require_once '/inc/menubar.html';?>

<?php
$saison = ($saison = filter_input(INPUT_GET, 'saison')) ? $saison : '2016';
$saison = filter_var($saison, FILTER_SANITIZE_STRING);
$nextyear = $saison+1;
?>

<section class="mbr-section mbr-parallax-background mbr-after-navbar" id="msg-box8-0" style="background-image: url(assets/images/desert.jpg); padding-top: 160px; padding-bottom: 120px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);">
    </div>
    <div class="container">
       <div class="row">
          <div class="col-md-8 col-md-offset-2 text-xs-center">
<?php
             echo "<h3 class=\"mbr-section-title display-2\">News Saison $saison/$nextyear</h3>";
?>           
          </div>
       </div>
    </div>

</section>

<section class="mbr-section article mbr-section__container" id="content1-0" style="background-color: rgb(204, 204, 204); padding-top: 20px; padding-bottom: 20px;">

<?php

require_once('news_object.php');

$list = News::ReadFromDB();
$dh  = opendir('.');
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
closedir($dh);
rsort($files);

foreach ($files as $file)
{
   if (preg_match('/^news_(\d\d\d\d)-(\d\d)-\d\d\.html$/', $file, $matches) )
   {
      if (($matches[1] == $saison && $matches[2] >= 8) || ($matches[1] == ($saison+1) && $matches[2] <= 7))
      {
         echo ' <div class="container"> <div class="row"> <div class="col-xs-12 lead"><p>';
         include_once($file);
         echo "</div> </div> </div> <p></p>\n";
      }
   }
}
?>

</section>

<section class="mbr-section article mbr-section__container" id="content1-1" style="background-color: rgb(255, 255, 255); padding-top: 20px; padding-bottom: 20px;">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 lead"><p>
  <a href="news.php?saison=2015">Saison 2015/2016</a>
| <a href="news.php?saison=2014">Saison 2014/2015</a>
| <a href="news.php?saison=2013">Saison 2013/2014</a>
| <a href="news.php?saison=2012">Saison 2012/2013</a>
| <a href="news.php?saison=2011">Saison 2011/2012</a>
| <a href="news.php?saison=2010">Saison 2010/2011</a>
| <a href="news.php?saison=2009">Saison 2009/2010</a>
| <a href="news.php?saison=2008">Saison 2008/2009</a>
</p></div>
        </div>
    </div>

</section>

   <?php include_once '/inc/footer.html';?>

   <?php include_once '/inc/jsscripts.html';?>

  <input name="animation" type="hidden">
  </body>
</html>
