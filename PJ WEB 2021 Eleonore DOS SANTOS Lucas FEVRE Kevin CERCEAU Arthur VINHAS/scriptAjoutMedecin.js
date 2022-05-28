$(document).ready(function () {

    let ImageOk = false;

    $("#mdp").keyup(function(){

        // Active verification de l'email et des mots de passe
        verifButton();
    });

    $("#mdp2").keyup(function(){

        // Active verification de l'email et des mots de passe
        verifButton();
       
    });


    $("#email").keyup(function(){

        // Active verification de l'email et des mots de passe
        verifButton();

    });

    // S'active lorsque l'on choisit une image
    $("#TheImage2").on('load',function(){
        ImageOk = true;

        // Active verification de l'email, des mots de passe et de si il y a une image
         verifButton();

    });


    function verifButton()
    {
        let numberGood = 0;

        //// Partie verifiant si l'email proposer n'est pas deja présent au sein de la base de donné à chaque fois qu'on en propose un

        /// Definition du fichier à utiliser en fonction de la page dans laquelle on se trouve
        switch(document.getElementById("Title").innerText)
        {
            case "Modification compte du Medecin":
            $indication = "2";
            break;

            default:
            $indication = "1";
            break;
    
        }

         // Verifie dans la base de donné si l'email existe deja
         $.get("VerifParamBDD.php",{TheMail:  $("#email").val(),Indication: $indication} ,function(data) {

            if( data != 0)
            {
                document.getElementById("messageErrorEmail").innerHTML = "<br> &nbsp;&nbsp;&nbsp; Mail already used!!";
            }
            else
            {
                document.getElementById("messageErrorEmail").innerHTML = "<br> &nbsp;&nbsp;&nbsp;";
                numberGood = numberGood + 1;
            }

         //// Partie verifiant si le mot de passe et la confirmation de mot de passe sont les même à chaque fois

    
         if( $("#mdp").val() == $("#mdp2").val())
         {
             if($("#mdp").val()  != "")
             {
             
                document.getElementById("messageErrorPassword").innerHTML = "<br> &nbsp;&nbsp;&nbsp;";
                numberGood = numberGood + 1;
             }
             else
             {
                document.getElementById("messageErrorPassword").innerHTML = "<br> &nbsp;&nbsp;&nbsp; Passwords both empty!";
            }
             
         }
         else
         {
             document.getElementById("messageErrorPassword").innerHTML = "<br> &nbsp;&nbsp;&nbsp; Different passwords!";
         }

         // Partie pour verifier si l'image est bien la
         if( ImageOk == true)
         {
            numberGood = numberGood + 1;
         }

        // Activation ou desactivation du bouton final
        if(numberGood == 3)
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
        
    }

    
});

function envoyer() {
    document.getElementById('messagesent').innerText=document.getElementById('messagewritten').value;
    document.getElementById('messagewritten').value="";
}




