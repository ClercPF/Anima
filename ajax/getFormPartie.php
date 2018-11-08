<?php
  /* CLERC.PF 2018-10-29 */

  include '../db.inc.php';
  include '../fonction.inc.php';

  // *** Variables ***
  $html = '';
  $id_partie = false;
  $nom = '';
  $obs = '';
  $creation = date('d/m/Y');
  $titre = 'Nouvelle Partie';
  $libelle = 'Ajouter';
  $supp = true;

  // *** Récupération de l'id partie ***
  if(isset($_POST['id_partie']))
    $id_partie = $_POST['id_partie'];

  // ** Ajout / Modification **
  if($id_partie != 'false')
  {
    $titre = 'Partie N° '.$id_partie;
    $libelle = 'Modifier';
    $supp = false;

    // ** récupération des infos de la partie **
    $data = execSQL("SELECT nom, TO_CHAR(creation,'DD/MM/YYYY') as crea, obs FROM partie WHERE id_partie = $id_partie");
    $nom = $data[0]['nom'];
    $obs = $data[0]['obs'];
    $creation = $data[0]['crea'];
  }

  // *** Formulaire HTML ***
  $html .= '<div id="fondPartie"><div class="conteneur">';
  $html .= '  <h2>'.$titre.'</h2>';
  $html .= '  <from>';

  // ** Id de la partie **
  $html .= '<input name="id_partie" type="hidden" value="'.$id_partie.'">';

  // ** Date de la partie **
  $argv = array();
  $argv['libelle'] = 'Création';
  $argv['name'] = 'creation';
  $argv['value'] = $creation;
  $argv['size'] = 10;
  $argv['disabled'] = true;
  $html .= displayInput($argv);

  // ** Nom de la partie **
  $argv = array();
  $argv['libelle'] = 'Nom';
  $argv['name'] = 'nom';
  $argv['value'] = $nom;
  $argv['size'] = 30;
  $html .= displayInput($argv);

  // ** Observation de la partie **
  $argv = array();
  $argv['libelle'] = 'Observation';
  $argv['name'] = 'obs';
  $argv['value'] = $obs;
  $argv['size'] = 80;
  $html .= displayInput($argv);

  // *** Barre des Boutons ***
  $html .= '    <div class="barreBouton">';

  // ** Bouton nouvelle partie **
  $argv = array();
  $argv['value'] = $libelle;
  $argv['onclick'] = "savePartie()";
  $argv['nodiv'] = true;
  $html .= displayButton($argv);

  // ** Bouton Supprimer **
  $argv = array();
  $argv['value'] = 'Supprimer';
  $argv['onclick'] = "delPartie()";
  $argv['nodiv'] = true;
  $argv['disabled'] = $supp;
  $html .= displayButton($argv);

  // ** Bouton annuler **
  $argv = array();
  $argv['value'] = 'Annuler';
  $argv['onclick'] = "closePartie()";
  $argv['nodiv'] = true;
  $html .= displayButton($argv);

  // *** Fin Barre des Boutons ***
  $html .= '    </div>';
  $html .= '  </from>';
  // *** Fin Formulaire HTML ***
  $html .= '</div></div>';

  echo json_encode(array('html'=>$html));

?>
