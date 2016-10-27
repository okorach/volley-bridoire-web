<?php include 'header.html';?>

<body>

<?php include 'analytics.html';?>

<?php include 'menubar.html';?>

<section class="mbr-section mbr-parallax-background" id="page4-msg-box7-0" style="background-image: url(photos/backgrounds/bg_joueur_fixe.jpg); padding-top: 240px; padding-bottom: 240px;">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(0, 0, 0);">
    </div>
    <div class="container">
        <div class="row">
            <div class="mbr-table-md-up">
              <div class="mbr-table-cell mbr-right-padding-md-up mbr-valign-top col-md-6">
                  <div class="mbr-figure" ><img src="photos/joueurs/no_photo.jpg"></div>
              </div>
              <div class="mbr-table-cell oko-player col-md-6 text-xs-center text-md-left">
                  <h3 class="mbr-section-title display-2">Laurent #3</h3>
                  <div class="lead">
                    <p>Surnom: Kareem Abdul Jabbar<br>
					Poste préféré: Power forward<br>
					Acteur préféré: Michael Jordan - Oui oui il a jou&eacute; dans un film, avec Donald Duck<br>
					Quoi d'autre? Service de s&eacute;curit&eacute; et garde du corps officiel du club</p>

					<?php include 'joueurs_liste.html';?>
	
                  </div>
              </div>
            </div>
        </div>
    </div>
</section>


<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-0" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    
    <div class="container">
        <p class="text-xs-center"><a href="index.php">Home</a> |

					<?php include 'joueurs_liste.html';?>
	
		<br>Copyright (c) 2016 Volley La Bridoire.</p>
    </div>
</footer>

	<?php include 'jsscripts.html';?>

  <input name="animation" type="hidden">
  </body>
</html>