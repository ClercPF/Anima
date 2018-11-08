<!DOCTYPE html>
<!-- CLERC.PF 2018-10-31 -->

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
          // *** Bouton nouveau personnage ***
          $argv = array();
          $argv['value'] = 'Nouveau Personnages';
          $argv['onclick'] = "openModele(false)";
          echo displayButton($argv);

          // *** Bouton retour ***
          $argv = array();
          $argv['value'] = 'Retour';
          $argv['href'] = 'index.php';
          echo displayButton($argv);
        ?>
      </div>
      <div class="page">
        <h1>Les Personnages</h1>
        <?php
            // *** Fonction d'affichage des parties ***
            $argv = array();
            $argv['data'] = execSQL("SELECT id_mod idline, joueur, nom, classe, niveau, race, sexe, pnj FROM modele ORDER BY pnj DESC, joueur, niveau DESC");
            $argv['head'] = array('Joueur', 'Nom', 'Archétype', 'Race', 'Sexe', 'Niveau', 'PNJ');
            $argv['idtab'] = 'perso_tab';
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
    <script src="./js/modele.js"></script>
  </body>

</html>
