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

/// Partie permettant de changer l'image selectionner dans le repertoire de la base de donnée !!!!!
$part = explode(".",$_FILES["image_uploads"]["name"]);

$destination = $_SERVER['DOCUMENT_ROOT']."/PROJET-PISCINE-2022/PJ WEB 2021 Eleonore DOS SANTOS Lucas FEVRE Kevin CERCEAU Arthur VINHAS/Photos Doc/".$_SESSION["IDconnected"].".".$part[1];

/*
echo "<pre>";
   print_r($_FILES);
   echo "</pre>";
*/

// Copie le fichier temporaire de l'image selectionner présent sur le serveur, directement dans le repertoire du serveur
copy($_FILES["image_uploads"]["tmp_name"],$destination);


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
     // On update les infos du medecin dans la table medecin
     $BuffID = $_SESSION["IDconnected"];
     $phone2 = intval($phone);

     $sql = "UPDATE medecin SET Nom ='$nom', Prenom = '$prenom', Password1 = '$Password', NumTelephone= $phone2, Specialisation ='$specialisation' WHERE IDpersonne ='$BuffID';";
     $result = $mysqli->query($sql);

     $sql = "UPDATE identifiant SET Identifiant ='$mail' WHERE IDpersonne ='$BuffID';";
     $result = $mysqli->query($sql);



    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}

?>