<?php require_once 'inc/header.html';?>

<body>

<?php
include_once 'inc/analytics.html';
require_once 'inc/menubar.html';

require_once 'lib/link.php';
?>

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-0" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <div><img src="assets/images/logo400x400.jpg" width="200" height="200" style="-webkit-border-radius: 20px 20px 20px 20px;-moz-border-radius: 20px 20px 20px 20px;border-radius: 20px 20px 20px 20px;-webkit-box-shadow: #B3B3B3 8px 8px 8px;-moz-box-shadow: #B3B3B3 8px 8px 8px; box-shadow: #B3B3B3 8px 8px 8px;">
                </div>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
               <p><strong>Sites des autres clubs de Volley FSGT Savoie</strong>

               <?php
                  $list = new LinkList('links.csv');
                  $links = $list->getLinksByType('Club');
                  foreach ($links as $link)
                  {
                     echo '<a class="text-primary" href="'.$link->getUrl().'" target="_blank">'.$link->getTitle().'</a><br>'."\n";
                  }

                  echo <<<END
               </p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
               <p><strong>Sites de fédérations</strong><br><br>
END;
                  $links = $list->getLinksByType('Fede');
                  foreach ($links as $link)
                  {
                     echo '<a class="text-primary" href="'.$link->getUrl().'" target="_blank">'.$link->getTitle().'</a><br>'."\n";
                  }
                  echo <<<END
               </p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>Autres liens</strong><br>
END;
                  /* $links = $list->getLinksByType('Autres');
                  foreach ($links as $link)
                  {
                     echo '<a class="text-primary" href="'.$link->getUrl().'" target="_blank">'.$link->getTitle().'</a><br>'."\n";
                  }
                  */
?>
            </div>
        </div>
    </div>
</section>

   <?php include_once 'inc/footer.html';?>

   <?php include_once 'inc/jsscripts.html';?>

  <input name="animation" type="hidden">
  </body>
</html>
