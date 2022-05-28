$(document).ready(function () {

    let ImageOk = false;

    // S'active lorsque l'on choisit une image
    $("#TheImage2").on('load',function(){
        ImageOk = true;

        // Active verification de l'email, des mots de passe et de si il y a une image
         verifButton();

    });

    function verifButton()
    {
        let numberGood = 0;

         // Partie pour verifier si l'image est bien la
         if( ImageOk == true)
         {
            numberGood = numberGood + 1;
         }

        // Activation ou desactivation du bouton final
        if(numberGood == 1)
        {
            // Active le bouton "s'incrire"
            $("#btnco").prop("disabled", false);
        }
        else
        {
            // Desactive le bouton "s'incrire"
            $("#btnco").prop("disabled", true);   
        }

        
    }

    
});





