$(document).ready(function () {


    $("#mdp2").keyup(function(){

        alert("BBB");
        // Verification si la confirmation de mot de passe correspond bien au mot de passe
        
        if( $("#mdp").val() == $("#mdp2").val())
        {
            // Active le bouton "s'incrire"
            $("#btnco").prop("disabled", false);
            
        }
        else
        {
            // Desactive le bouton "s'incrire"
            $("#btnco").prop("disabled", true);
        }
       
    });

   
    
});

