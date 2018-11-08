<!DOCTYPE html>
<!-- CLERC.PF 2018-10-28 -->

<html>

  <head>
    <title>Anima Calc.</title>
    <meta charset="UTF-8">
    <!-- Lien CSS -->
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Include PHP -->
    <?php
        include 'db.inc.php';
        include 'fonction.inc.php';
    ?>
  </head>

  <body>
    <div class="body">
      <div class="menu">
        <?php
          // *** Bouton nouvelle partie***
          $argv = array();
          $argv['value'] = 'Nouvelle Partie';
          $argv['onclick'] = "openPartie(false)";
          echo displayButton($argv);

          // *** Bouton personnages ***
          $argv = array();
          $argv['value'] = 'Personnages';
          $argv['href'] = 'modele.php';
          echo displayButton($argv);
        ?>
      </div>
      <div class="page">
        <h1>Les parties</h1>
        <?php
          // *** Fonction d'affichage des parties ***
          $argv = array();
          $argv['data'] = execSQL("SELECT id_partie idline, nom, TO_CHAR(creation,'DD/MM/YYYY'), SUBSTRING(obs,0,70) FROM partie ORDER BY id_partie DESC");
          $argv['head'] = array('Partie', 'Début', 'Déscription');
          $argv['idtab'] = 'partie_tab';
          $argv['update'] = true;
          echo dataTab($argv);
        ?>
      </div>
      <div class="footer">
      </div>
    </div>
    <!-- Lien jQuery -->
    <script src="./js/jquery.js"></script>
    <!-- Lien fonction JavaScript -->
    <script src="./js/partie.js"></script>
  </body>

</html>
