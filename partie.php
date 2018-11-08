<!DOCTYPE html>
<!-- CLERC.PF 2018-10-28 -->

<html>

  <head>
    <title>Anima Calc.</title>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css">
    <?php
        //include
        include 'db.inc.php';
        include 'fonction.inc.php';
    ?>
  </head>

  <body>
    <div class="body">
      <div class="menu">
      </div>
      <div class="page">
        <?php
            //Fonction d'affichage des parties
            listeParties();
        ?>
      </div>
      <div class="sidebar">
        <br>
      </div>
      <div class="footer">
      </div>
    </div>
  </body>

</html>
