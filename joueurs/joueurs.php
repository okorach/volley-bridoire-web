<?php require_once 'header.html';?>

<body>

<?php include_once 'analytics.html';?>

<?php require_once 'menubar.html';?>

<?php
$id = ($id = filter_input(INPUT_GET, 'id')) ? $id : 'olivier';
$id = filter_var($id, FILTER_SANITIZE_STRING);

$player_bio = 'bio_'.$id.".html";
if (! file_exists($player_bio) ) {
	$id = 'olivier';
	$player_bio = 'bio_'.$id.".html";
}

// FIXME Kad

$player_pic = "".$id.".jpg";
if (! file_exists($player_pic) ) {
	$player_pic = "no_photo.jpg";
}
?>

<section class="mbr-section mbr-parallax-background" id="page4-msg-box7-0" style="background-image: url(../photos/backgrounds/bg_joueurs.jpg); padding-top: 240px; padding-bottom: 240px;">
	<div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);"> </div>
		<div class="container">
			<div class="row"> <div class="mbr-table-md-up"> <div class="mbr-table-cell mbr-right-padding-md-up mbr-valign-top col-md-6">
<?php
   echo '<div class="mbr-figure"><img src="'.$player_pic.'"></div>';
?>
              </div>
              <div class="mbr-table-cell oko-player col-md-6 text-xs-center text-md-left">

<?php
	include_once($player_bio);
	include 'joueurs_liste.html';
?>

                  </div>
              </div>
            </div>
        </div>
    </div>
</section>


<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-0" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">

    <div class="container">
        <p class="text-xs-center"><a href="/index.php">Home</a> |

		<?php include 'joueurs_liste.html';?>
    <p>
    <?php include_once 'footer.html';?>
    </div>
</footer>

	<?php include_once 'jsscripts.html';?>

  <input name="animation" type="hidden">
  </body>
</html>
