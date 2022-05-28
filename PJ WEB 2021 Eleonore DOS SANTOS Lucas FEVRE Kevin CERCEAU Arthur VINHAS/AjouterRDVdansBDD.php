<?php

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();

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
    $ClientID = $_GET["ClientID"];
    $MedecinID = $_GET["MedecinID"];
    $Jour = $_GET["Jour"];
    $Heure = $_GET["Heure"];

    //$sql = "SELECT IDpersonne FROM medecin WHERE IDpersonne = (SELECT MAX(IDpersonne) FROM medecin)";   
    $sql = "SELECT IDrdv FROM `rdvmedecin-client`";   

    $Maximun = -1;
    
    if($result = $mysqli->query($sql))
    {
        if($result->num_rows >0)
        {
            while($row = $result->fetch_row())
            {
                $BuffBuff = intval($row[0]);
                if($BuffBuff > $Maximun)
                {
                    $Maximun = $BuffBuff;
                }   
            }
           
        }
        $result->free_result();
    }
 
    $IDchosen = 0;

    if($Maximun == -1)
    {
        $IDchosen = 1; // Premier ID
    }
    else
    {
        // Ajouter 1 au nombre pour incrementer
        $NumRecupInt = $Maximun+ 1;

        // ID chosen for the new client
        $IDchosen = $NumRecupInt; 
    }


    // On rajoute le client dans la table client
    $sql = "INSERT INTO `rdvmedecin-client` VALUES ($IDchosen,'$MedecinID','$Jour','$Heure','$ClientID'); ";
    $result = $mysqli->query($sql);


    echo "Yes";

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}
    

?>