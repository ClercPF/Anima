<?php
  /* CLERC.PF 2018-11-03 */

  include '../db.inc.php';
  include '../fonction.inc.php';

  // *** Variables ***
  $html = '';
  $id_mod = false;
  $nom = '';
  $titre = 'Nouveau Personnage';
  $libelle = 'Ajouter';
  $supp = true;

  // *** Récupération de l'id du modele de personnage ***
  if(isset($_POST['id_mod']))
    $id_mod = $_POST['id_mod'];

  // ** Ajout / Modification **
  if($id_mod != 'false')
  {
    $titre = 'Personnage N° '.$id_mod;
    $libelle = 'Modifier';
    $supp = false;

    // ** récupération des infos du modele de personnage **
    $data = execSQL("SELECT nom FROM modele WHERE id_mod = $id_mod");
    $nom = $data[0]['nom'];
  }

  // *** Formulaire HTML ***
  $html .= '<div id="fondModele"><div class="conteneur">';
  $html .= '  <h2>'.$titre.'</h2>';
  $html .= '  <from>';

  // ** Id du modele de personnage **
  $html .= '<input name="id_mod" type="hidden" value="'.$id_mod.'">';

  // *** Infos ***
  $html .= '<div>';
  // ** Nom du modele de personnage**
  $argv = array();
  $argv['libelle'] = 'Nom';
  $argv['name'] = 'nom';
  $argv['value'] = $nom;
  $argv['size'] = 30;
  $html .= displayInput($argv);

  // *** Barre des Boutons ***
  $html .= '    <div class="barreBouton">';

  // ** Bouton nouvelle partie **
  $argv = array();
  $argv['value'] = $libelle;
  $argv['onclick'] = "saveModele()";
  $argv['nodiv'] = true;
  $html .= displayButton($argv);

  // ** Bouton Supprimer **
  $argv = array();
  $argv['value'] = 'Supprimer';
  $argv['onclick'] = "delModele()";
  $argv['nodiv'] = true;
  $argv['disabled'] = $supp;
  $html .= displayButton($argv);

  // ** Bouton annuler **
  $argv = array();
  $argv['value'] = 'Annuler';
  $argv['onclick'] = "closeModele()";
  $argv['nodiv'] = true;
  $html .= displayButton($argv);

  // *** Fin Barre des Boutons ***
  $html .= '    </div>';
  $html .= '  </from>';
  // *** Fin Formulaire HTML ***
  $html .= '</div></div>';

  echo json_encode(array('html'=>$html));

?>
