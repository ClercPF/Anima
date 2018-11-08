<?php
  /* CLERC.PF 2018-10-29 */

  include '../db.inc.php';
  include '../fonction.inc.php';

  // *** Variables ***
  $id_partie = false;
  $nom = '';
  $obs = '';

  // *** Test des variables ***
  if(isset($_POST['id_partie']))
    $id_partie = $_POST['id_partie'];
  if(isset($_POST['nom']))
    $nom = $_POST['nom'];
  if(isset($_POST['obs']))
    $obs = $_POST['obs'];

  // *** Echapement des chaines ***
  $nom = pg_escape_string($nom);
  $obs = pg_escape_string($obs);

  // *** Sauvegarde ***
  if($id_partie == 'false')
  {
    // ** Ajout **
    $id_partie = execSQL("SELECT insert_partie('$nom', '$obs')");
  }
  else
  {
    // ** Modification **
    $id_partie = execSQL("SELECT update_partie($id_partie, '$nom', '$obs')");
  }

  // *** Retour status ***
  if($id_partie)
    $t = array('status' => 1);
  else
    $t = array('status' => 0);
  echo json_encode($t);

?>
