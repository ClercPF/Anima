<!-- CLERC.PF 2018-10-31 -->
$(document).ready(function(){

    //  *** Création d'un modele ***
    openModele = function(idline)
    {
      // ** Ajax Formulaire Modele **
      $.ajax(
      {
          url : 'ajax/getFormModele.php',
          type: 'POST',
          data: {id_mod:idline},
          dataType: 'json',
          success: function(rep)
          {
              $(rep.html).appendTo('body');
          },
          error: function(){alert("Erreur : openModele");}
      });
    };

    // *** Fermeture popup Modele ***
    closeModele = function()
    {
      $('#fondModele').remove();
    };

    // *** Sauvegarde d'un Modele ***
    saveModele = function()
    {
      // ** Ajax Sauvegarde Modele **
      $.ajax(
      {
          url : 'ajax/saveFormModele.php',
          type: 'POST',
          data: {id_mod: $('#fondModele input[name="id_mod"]').val()
          , nom: $('#fondModele input[name="nom"]').val()
          , obs: $('#fondModele input[name="obs"]').val()},
          dataType: 'json',
          success: function(rep)
          {
            // confirmation a faire
            location.reload();
          },
          error: function(){alert("Erreur : saveModele");}
      });
    };

    // *** Suppression d'un Modele ***
    delModele = function()
    {
      // ** Confirmation de suppression **
      var rep = confirm("Etes-vous certain de vouloir supprimer ce Personnage ?");
      if (rep == true)
      {
        // ** Ajax Suppression d'un Modele **
        $.ajax(
        {
            url : 'ajax/deleteFormModele.php',
            type: 'POST',
            data: {id_mod: $('#fondModele input[name="id_mod"]').val()},
            dataType: 'json',
            success: function(rep)
            {
              // confirmation a faire
              location.reload();
            },
            error: function(){alert("Erreur : delModele");}
        });
      }

    };

});
