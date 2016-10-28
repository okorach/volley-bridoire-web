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

<section class="mbr-section mbr-parallax-background mbr-after-navbar" id="msg-box8-0" style="background-image: url(assets/images/desert.jpg); padding-top: 160px; padding-bottom: 120px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(34, 34, 34);">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2">News</h3>
                <div class="lead">Quoi de neuf au club ?</div>
                
            </div>
        </div>
    </div>

</section>

<section class="mbr-section mbr-section__container" id="header3-0" style="background-color: rgb(239, 239, 239); padding-top: 20px; padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
<?php
	echo "<h3 class=\"mbr-section-title display-2\">Saison $saison/$nextyear</h3>";
?>
                
            </div>
        </div>
    </div>
</section>

<section class="mbr-section article mbr-section__container" id="content1-0" style="background-color: rgb(204, 204, 204); padding-top: 20px; padding-bottom: 20px;">

<?php

$dh  = opendir('news');
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
			include("news/".$file);
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

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-0" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <div><a href="http://www.fivb.org" target="_blank"><img src="assets/images/volleyball-128x197-64.png" alt="FIVB" title="FIVB"></a></div>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>Adresse</strong><br><strong><br></strong>Volley La Bridoire<span style="font-size: 0.875rem; line-height: 1.5;">c/o Olivier Korach&nbsp;</span>1010 rte des champs du mont&nbsp;73520 La Bridoire</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><font color="#7c7c7c" face="Montserrat, sans-serif" size="3"><span style="letter-spacing: -1px; line-height: 20px;"><strong>Contacts</strong></span></font><br>
<br>Email: <a href="mailto:volley.bridoire@free.fr" target="_blank">volley.bridoire@free.fr</a><br>
Tel: <a href="tel:+33689555081" target="_blank">06 89 55 50 81</a><br></p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p></p><p>Contacts</p><p><br>
<a href="http://www.fsgt73.fr" target="_blank">FSGT 73</a><br>
<a href="https://www.volley.asso.fr">FFVB</a><br>
<a href="http://www.fivb.org" target="_blank">FIVB</a></p><a href="http://www.fivb.org/EN/Volleyball/Rules/Rules.htm">Regles du Volley</a><p></p>
            </div>

        </div>
    </div>
</section>

	<?php include 'inc/footer.html';?>

	<?php include 'inc/jsscripts.html';?>

  <input name="animation" type="hidden">
  </body>
</html>
