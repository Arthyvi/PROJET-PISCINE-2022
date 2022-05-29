<?php

// Session start
session_start();


$TheID = $_GET["md"];

////Suppression du RDV dans la BDD
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
        // Effacement depuis la table "rdvmedecin-client"
        $sql = "DELETE FROM `rdvmedecin-client` WHERE IDrdv= '$TheID';";
        $result = $mysqli->query($sql);
        
        // Fermeture de notre variable "$mysqli"
        $mysqli->close();
    }

    // Renvoi à la page de choix du medecin
    header("Location: MesRendezVous.php");

?>