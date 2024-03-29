<?php

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();

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
$mysqli = new mysqli("localhost:3306","root","","projet piscine 2022");

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
            $NameNextFile = "home.php";
            break;

        case "MD" : // Si c'est un Medecin...
            $NameTable ="medecin";
            //$NameNextFile = "Medecin_Personnel.html";

            $NameNextFile = "Medecin_Personnel.php";

            break;
    }

    //// Verification si Mot de passe bon

    $sql = "SELECT oth.Password1 FROM $NameTable oth WHERE IDpersonne='$BufferIDperssone'";
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
        $_SESSION["IDconnected"] = $BufferIDperssone;
        $_SESSION["NameTable"] = $NameTable;

        $sql="SELECT * FROM ".$_SESSION['NameTable']." WHERE IDpersonne='".$_SESSION['IDconnected']."'"; 
        if($result = $mysqli->query($sql))
        { 
            if($result->num_rows>0)
            {
                $_SESSION['name']=$result->fetch_row()[2];
            }
        }

        // Connexion à la bonne page en fonction de si c'est un compte administrateur, medecin ou client (initialisé dans le switch plus haut)
        header("Location: ".$NameNextFile);
    }

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
    
}

?>
