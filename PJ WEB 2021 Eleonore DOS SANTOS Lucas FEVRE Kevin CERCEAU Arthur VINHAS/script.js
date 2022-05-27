/*function envoyer() {
    document.getElementById('messagesent').innerText = document.getElementById('messagewritten').value;
    document.getElementById('messagewritten').value = "";
}*/

/*function transfert() {
    var b = document.getElementById('doc').value;
    var url = 'fichecontact.php?name='.b;
    console.log(url);
    document.location.href = url;
}*/

function newclient($name, $client, $medecin) {
    parent.location.href = "chat.php?name=" + $name + "&idclient=" + $client + "&idmedecin=" + $medecin + "&connected=MD";
}

$(document).ready(function () {


    $("#mdp").keyup(function () {


        // Verification si la confirmation de mot de passe correspond bien au mot de passe

        if ($("#mdp").val() == $("#mdp2").val()) {
            if ($("#mdp").val() != "") {
                // Active le bouton "s'incrire"
                $("#btnco").prop("disabled", false);
            }
        }
        else {
            // Desactive le bouton "s'incrire"
            $("#btnco").prop("disabled", true);
        }

    });

    $("#mdp2").keyup(function () {


        // Verification si la confirmation de mot de passe correspond bien au mot de passe

        if ($("#mdp").val() == $("#mdp2").val()) {
            if ($("#mdp").val() != "") {
                // Active le bouton "s'incrire"
                $("#btnco").prop("disabled", false);
            }

        }
        else {
            // Desactive le bouton "s'incrire"
            $("#btnco").prop("disabled", true);
        }

    });



});