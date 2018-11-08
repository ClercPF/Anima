<!-- CLERC.PF 2018-10-28 -->
$(document).ready(function(){

    //  *** Double Click sur une partie ***
    $("#partie_tab tbody tr").on("dblclick",function(e)
    {
        //openPartie($(this).attr('idline'))
    });

    //  *** Création d'une partie ***
    openPartie = function(idline)
    {
      // ** Ajax Formulaire Partie **
      $.ajax(
      {
          url : 'ajax/getFormPartie.php',
          type: 'POST',
          data: {id_partie:idline},
          dataType: 'json',
          success: function(rep)
          {
              $(rep.html).appendTo('body');
          },
          error: function(){alert("Erreur : openPartie");}
      });
    };

    // *** Fermeture popup Partie ***
    closePartie = function()
    {
      $('#fondPartie').remove();
    };

    // *** Sauvegarde d'une partie ***
    savePartie = function()
    {
      // ** Ajax Sauvegarde Partie **
      $.ajax(
      {
          url : 'ajax/saveFormPartie.php',
          type: 'POST',
          data: {id_partie: $('#fondPartie input[name="id_partie"]').val()
          , nom: $('#fondPartie input[name="nom"]').val()
          , obs: $('#fondPartie input[name="obs"]').val()},
          dataType: 'json',
          success: function(rep)
          {
            // confirmation a faire
            location.reload();
          },
          error: function(){alert("Erreur : savePartie");}
      });
    };

    // *** Suppression d'une partie ***
    delPartie = function()
    {
      // ** Confirmation de suppression **
      var rep = confirm("Etes-vous certain de vouloir supprimer cette partie ?");
      if (rep == true)
      {
        // ** Ajax Suppression d'une Partie **
        $.ajax(
        {
            url : 'ajax/deleteFormPartie.php',
            type: 'POST',
            data: {id_partie: $('#fondPartie input[name="id_partie"]').val()},
            dataType: 'json',
            success: function(rep)
            {
              // confirmation a faire
              location.reload();
            },
            error: function(){alert("Erreur : delPartie");}
        });
      }

    };

});
