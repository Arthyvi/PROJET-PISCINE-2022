<?php

// Declaration des variables
$id= isset($_POST["id"]) ? $_POST["id"] : "";
$mdp= isset($_POST["mdp"]) ? $_POST["mdp"] : "";

// Detection problème
if($id == "")
{
    echo "Probleme avec la valeur de l'identifiant<br>";
    return;
}

if($mdp == "")
{
    echo "Probleme avec la valeur du mot de passe<br>";
    return;
}


// Connexion au serveur
$mysqli = new mysqli("localhost","root","","projet piscine 2022");

// Check connection
if($mysqli -> connect_errno)
{
    echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
    exit();
}
else
{
    // Verification si Identifiant bon
    $sql = "SELECT * FROM identifiant";
    $BufferIDperssone = "";
    

    if($result = $mysqli->query($sql))
    {
        
        if($result->num_rows >0)
        {
            while($row = $result->fetch_row())
            {
                if($row[0] == $id)
                {
                    $BufferIDperssone = $row[1];
                    break;
                }
            }
        }

        $result->free_result();
    }

    if( $BufferIDperssone == "")
    {
        echo "Identifiant ou mot de passe incorect (1)<br>";
        return;
    }

    //Definission si l'IDpersonne trouvé est : un adminisrateur (AD), un client (CL) ou un medecin (MD)

    $NameTable ="";
    $NameNextFile = "";

    switch(substr($BufferIDperssone,0,2))
    {
        case "AD": // Si c'est un administrateur...
            $NameTable ="administrateur";
            $NameNextFile = "Administrateur.html";
            break;

        case "CL" : // Si c'est un client...
            $NameTable ="client";
            $NameNextFile = "home.html";
            break;

        case "MD" : // Si c'est un Medecin...
            $NameTable ="medecin";
            $NameNextFile = "Medecin_Personnel.html";
            break;
    }


    //// Verification si Mot de passe bon

    $sql = "SELECT oth.Password FROM $NameTable oth WHERE IDpersonne='$BufferIDperssone'";
    $Passed = false;

    if($result = $mysqli->query($sql))
    {
        
        if($result->num_rows >0)
        {
            while($row = $result->fetch_row())
            {
                if($row[0] == $mdp)
                {
                    $Passed = true;
                    break;
                }
            }
        }

        $result->free_result();
    }

    if( $Passed == false)
    {
        echo "Identifiant ou mot de passe incorect (2)<br>";
        return;
    }
    else
    {

        // Connexion à la bonne page en fonction de si c'est un compte administrateur, medecin ou client (initialisé dans le switch plus haut)
        header("Location: ".$NameNextFile);
    }

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
    
}

?>