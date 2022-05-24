$(document).ready(function () {


    $("#mdp").keyup(function(){

        
        // Verification si la confirmation de mot de passe correspond bien au mot de passe
        
        if( $("#mdp").val() == $("#mdp2").val())
        {
            if($("#mdp").val()  != "")
            {
                 // Active le bouton "s'incrire"
                $("#btnco").prop("disabled", false);
            }
           
        }
        else
        {
            // Desactive le bouton "s'incrire"
            $("#btnco").prop("disabled", true);
        }
       
    });

    $("#mdp2").keyup(function(){

        
        // Verification si la confirmation de mot de passe correspond bien au mot de passe
        
        if( $("#mdp").val() == $("#mdp2").val())
        {
            if($("#mdp").val()  != "")
            {
                // Active le bouton "s'incrire"
                $("#btnco").prop("disabled", false);
            }
            
        }
        else
        {
            // Desactive le bouton "s'incrire"
            $("#btnco").prop("disabled", true);
        }
       
    });

   
    
});

function envoyer() {
    document.getElementById('messagesent').innerText=document.getElementById('messagewritten').value;
    document.getElementById('messagewritten').value="";
}



