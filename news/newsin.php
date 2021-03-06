<?php require_once 'header.html';?>

<body>

<?php include_once 'analytics.html';?>

<?php require_once 'menubar.html';?>

<?php
$saison = ($saison = filter_input(INPUT_GET, 'saison')) ? $saison : '2016';
$saison = filter_var($saison, FILTER_SANITIZE_STRING);
$nextyear = $saison+1;
?>

<section class="mbr-section mbr-parallax-background mbr-after-navbar" id="msg-box8-0" style="background-image: url(../assets/images/desert.jpg); padding-top: 160px; padding-bottom: 120px;">

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

$dh  = opendir('news');
while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
}
closedir($dh);
sort($files);

foreach ($files as $file)
{
	echo "<br><br><br><br>\n";
	var_dump($file); echo "<br>\n";
	$date_news = '';
	$author = '';
	$content = '';
   if (preg_match('/^news_(\d\d\d\d-\d\d-\d\d)\.html$/', $file, $matches) )
   {
		$date_news = $matches[1];
		$handle = fopen('news/'.$file, "r");
		if ($handle) {
			$content = '';
    		while (($buffer = fgets($handle, 4096)) !== false) {
        		if (preg_match('/.div class/', $buffer) || preg_match('/.\/div./', $buffer)) {
					# Do nothing
				} else if (preg_match('/.strong.Par ([A-Za-z]+),/', $buffer, $matches) ) {
					$author = $matches[1];
				} else {
					$content = $content.$buffer;
				}
    		}
    		if (!feof($handle)) {
        		echo "Erreur: fgets() a échoué\n";
    		}
    		fclose($handle);
		}
	}
	if ($date_news != '' && $author != '' && $content != '') {
      $content = preg_replace("/<\/?p>/i", "\n", $content);
      $content = preg_replace("/<br>/i", "\n", $content);
      $content = preg_replace("/^[\s\n]+/", "", $content);
      $content = preg_replace("/[\s\n]+$/", "", $content);
	   $news = new News($date_news, $author, $content);
	   $news->write();
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

   <?php include_once 'footer.html';?>

   <?php include_once 'jsscripts.html';?>

  <input name="animation" type="hidden">
  </body>
</html>
