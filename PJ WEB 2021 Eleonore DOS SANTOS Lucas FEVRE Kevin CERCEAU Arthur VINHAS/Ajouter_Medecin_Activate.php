<?php

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();

// Declaration des variables
$nom= isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom= isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$phone= isset($_POST["tel"]) ? $_POST["tel"] : "";
$specialisation = isset($_POST["spe"]) ? $_POST["spe"] : "";
$mail= isset($_POST["email"]) ? $_POST["email"] : "";
$Password= isset($_POST["mdp"]) ? $_POST["mdp"] : "";

/// Partie sur la base de donnée
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
        /// Creer un ID cohérent avec les ID deja présent au sein de la BDD
    //Recupérer l'ID client ayant le numéro le plus élevé

    $sql = "SELECT IDpersonne FROM medecin WHERE IDpersonne = (SELECT MAX(IDpersonne) FROM medecin)";   
    
    $BuffID = "";
    
    if($result = $mysqli->query($sql))
    {
        
        if($result->num_rows >0)
        {
            $row = $result->fetch_row();

            $BuffID = $row[0];
        }

        $result->free_result();
    }

    $IDchosen = "";

    if($BuffID == "")
    {
        $IDchosen = "MD-00001"; // Premier ID
    }
    else
    {
        //Prendre les nombres à la fin et  les transformé en int
        $NumRecupInt = intval(substr($BuffID,7)); 

        // Ajouter 1 au nombre pour incrementer
        $NumRecupInt = $NumRecupInt + 1;

        // ID chosen for the new client
        $IDchosen = "MD-0000".$NumRecupInt; 
    }
    
    // Transformation en INT des valeurs devant etre en int dans la BDD
    $phone2 =  intval($phone);

    // On rajoute le client dans la table client
    $sql = "INSERT INTO medecin VALUES ('$IDchosen','$nom','$prenom','$Password',$phone2,'$specialisation'); ";
    $result = $mysqli->query($sql);

    //On rajoute l'identifiant du client dans la table identifiant
    $sql = "INSERT INTO identifiant VALUES ('$mail','$IDchosen'); ";
    $result = $mysqli->query($sql);
    

        /// Partie permettant de changer l'image selectionner dans le repertoire de la base de donnée !!!!!
    $part = explode(".",$_FILES["image_uploads"]["name"]);

    $destination = $_SERVER['DOCUMENT_ROOT']."/PROJET-PISCINE-2022/PJ WEB 2021 Eleonore DOS SANTOS Lucas FEVRE Kevin CERCEAU Arthur VINHAS/Photos Doc/".$IDchosen.".".$part[1];

    /*
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    */

    // Copie le fichier temporaire de l'image selectionner présent sur le serveur, directement dans le repertoire du serveur
    copy($_FILES["image_uploads"]["tmp_name"],$destination);

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}

?>