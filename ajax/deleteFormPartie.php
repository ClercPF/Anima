<?php
  /* CLERC.PF 2018-10-31 */

  include '../db.inc.php';
  include '../fonction.inc.php';

  // *** Variables ***
  $id_partie = false;

  // *** Test des variables ***
  if(isset($_POST['id_partie']))
    $id_partie = $_POST['id_partie'];

  // *** Suppression ***
  $id_partie = execSQL("SELECT delete_partie($id_partie)");

  // *** Retour status ***
  if($id_partie)
    $t = array('status' => 1);
  else
    $t = array('status' => 0);
  echo json_encode($t);

  ?>
