<?php
  /* CLERC.PF 2018-10-28 */

  function execSQL($qry)
  {
    // *** PostgeSQL ***
    $cnx  = pg_connect("host=".BDD_HOST." port=".BDD_PORT." dbname=".BDD_BASE." user=".BDD_USER." password=".BDD_PASSWORD);
    $result = pg_query($cnx, $qry);
    $data = pg_fetch_all($result);
    return $data;
  }

  /**
   * Fonction qui génère un tableau de donnée
   * @param array $argv (head, data, idtab, update)
   */
  function dataTab($argv)
  {
    $idline = '';
    $str = '<table class="dataTab"';
    // [optionnel]idtab
    if(isset($argv['idtab']) === true)
        $str .= ' id="'.$argv['idtab'].'"';
    $str .= '>';
    // ** Entête **
    $str .= "<thead><tr>";
    foreach($argv['head'] as $v)
      $str .= "<th>$v</th>";
    //  ** Icone de modification **
    if(isset($argv['update']) && $argv['update'] === true)
      $str .= "<th></th>";
    $str .= "</tr></thead>";

    // ** Lignes **
    if($argv['data'])
    {
      $str .= '<tbody>';
      foreach ($argv['data'] as $row)
      {
        foreach ($row as $k => $v)
        {
          if($k == 'idline')
          {
            $str .= '<tr idline="'.$v.'">';
            $idline = $v;
          }
          else
            $str .= "<td>$v</td>";
        }
        //  ** Icone de modification **
        if(isset($argv['update']) && $argv['update'] === true)
          $str .= '<td><img src="./images/pen.png" onClick="openPartie('.$idline.')"></td>';
        $str .= "</tr>";
      }
      $str .= '</tbody>';
    }
    else
    {
      $nb = (isset($argv['update']) && $argv['update'] === true) ? count($argv['head'])+1: count($argv['head']);
      $str .= '<tr><td align="center" colspan="'.$nb.'">Aucunes données</td></tr>';
    }
    $str .= "</table>";
    return $str;
  }

  /**
   * Fonction qui génère un champ
   * @param array $argv (libelle, type, name, value, size, disabled)
   */
  function displayInput($argv)
  {
      $tmp = '<div>';
      if(isset($argv['libelle']) === true)
          $tmp .= '<label>'.$argv['libelle'].'</label>';
      $tmp .= '<input';
      // [optionnel]Type
      if(isset($argv['type']) === true)
          $tmp .= ' type="'.$argv['type'].'"';
      else
          $tmp .= ' type="text"';
      // [optionnel]Name
      if(isset($argv['name']) === true)
          $tmp .= ' name="'.$argv['name'].'"';
      // [optionnel]Value
      if(isset($argv['value']) === true)
          $tmp .= ' value="'.$argv['value'].'"';
      else
          $tmp .= ' value=""';
      // [optionnel]Size
      if(isset($argv['size']) === true)
          $tmp .= ' size="'.$argv['size'].'"';
      // [optionnel]Readonly
      if(isset($argv['disabled']) && $argv['disabled'] === true)
          $tmp .= ' disabled';
      $tmp .= ' /></div>';
      // Affichage
      return $tmp;
  }

  /**
   * Fonction qui génère une liste déroulante
   * @param array $argv (libelle, name, list, value, disabled)
   */
  function displaySelect($argv)
  {
      $tmp = '<div>';
      if(isset($argv['libelle']) === true)
          $tmp .= '<label>'.$argv['libelle'].'</label>';
      $tmp .= '<select';
      // [optionnel]Name
      if(isset($argv['name']) === true)
          $tmp .= ' name="'.$argv['name'].'"';
      // [optionnel]Readonly
      if(isset($argv['disabled']) && $argv['disabled'] === true)
          $tmp .= ' disabled';
      $tmp .= ' />';
      // List
      foreach($argv['list'] as $key => $value)
      {
          $tmp .= '<option value="'.$key.'"';
          if(isset($argv['value']) === true && $argv['value'] == $key)
              $tmp .= 'selected="selected"';
          $tmp .= '>'.$value.'</option>';
      }
      $tmp .= '</select></div>';
      // Affichage
      return $tmp;
  }

  /**
   * Fonction qui génère un bouton
   * @param array $argv (type, name, value, href, onclick, disabled, nodiv)
   */
  function displayButton($argv)
  {
    $tmp = '';
    // [optionnel]nodiv
    if(isset($argv['nodiv']) === false)
      $tmp .= '<div>';
    $tmp .= '<input class="bouton"';
    // [optionnel]Type
    if(isset($argv['type']) === true)
      $tmp .= ' type="'.$argv['type'].'"';
    else
      $tmp .= ' type="button"';
    // [optionnel]Name
    if(isset($argv['name']) === true)
      $tmp .= ' name="'.$argv['name'].'"';
    // [optionnel]Value
    if(isset($argv['value']) === true)
      $tmp .= ' value="'.$argv['value'].'"';
    else
      $tmp .= ' value="Valider"';
    // [optionnel]Href
    if(isset($argv['href']) === true)
      $tmp .= ' onclick="window.location.href=\''.$argv['href'].'\'"';
    // [optionnel]onclick
    if(isset($argv['onclick']) === true)
      $tmp .= ' onclick="'.$argv['onclick'].'"';
    // [optionnel]Disabled
    if(isset($argv['disabled']) && $argv['disabled'] === true)
      $tmp .= ' disabled';
    $tmp .= ' />';
    // [optionnel]nodiv
    if(isset($argv['nodiv']) === false)
      $tmp .= '</div>';
    // Affichage
    return $tmp;
  }
?>
