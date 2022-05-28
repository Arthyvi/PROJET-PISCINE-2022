<?php

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();

// Declaration des variables
$nom= isset($_POST["nom"]) ? $_POST["nom"] : "";
$Salle= isset($_POST["Salle"]) ? $_POST["Salle"] : "";
$phone= isset($_POST["tel"]) ? $_POST["tel"] : "";
$mail= isset($_POST["email"]) ? $_POST["email"] : "";

$Depistage= isset($_POST["Depistage-covid-19"]) ? $_POST["Depistage-covid-19"] : "";
$BiologieP= isset($_POST["Biologie-preventive"]) ? $_POST["Biologie-preventive"] : "";
$BiologieEnceinte= isset($_POST["Biologie-de-la-femme-enceinte"]) ? $_POST["Biologie-de-la-femme-enceinte"] : "";
$BiologieRoutine= isset($_POST["Biologie-de-routine"]) ? $_POST["Biologie-de-routine"] : "";
$Cancerologie= isset($_POST["Cancerologie"]) ? $_POST["Cancerologie"] : "";
$Gynecologie= isset($_POST["Gynecologie"]) ? $_POST["Gynecologie"] : "";

// The ID
$BuffID = $_SESSION["SelectedLab"];

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
    //Partie pour definir les services proposé
    $Services = 0;

    if($Gynecologie != "")
    {
        $Services = $Services + 1;
    }

    if($Cancerologie != "")
    {
        $Services = $Services + 2;
    }

    if($BiologieRoutine != "")
    {
        $Services = $Services + 4;
    }

    if($BiologieEnceinte != "")
    {
        $Services = $Services + 8;
    }

    
    if($BiologieP != "")
    {
        $Services = $Services + 16;
    }

    if($Depistage != "")
    {
        $Services = $Services + 32;
    }
    
    
     // Transformation en INT des valeurs devant etre en int dans la BDD
     $phone2 =  intval($phone);

    // On rajoute le client dans la table client
    $sql = "UPDATE laboratoire SET IDlabo=".$BuffID.",NomLab='$nom',Salle='$Salle',Mail='$mail',NumTelephone=".$phone2.",ServicesProposer=".$Services." WHERE IDlabo='$BuffID'";
    $result = $mysqli->query($sql);


    if($_FILES["image_uploads"]["name"] != "")
    {
            /// Partie permettant de changer l'image selectionner dans le repertoire de la base de donnée !!!!!
        $part = explode(".",$_FILES["image_uploads"]["name"]);

        $destination = $_SERVER['DOCUMENT_ROOT']."/PROJET-PISCINE-2022/PJ WEB 2021 Eleonore DOS SANTOS Lucas FEVRE Kevin CERCEAU Arthur VINHAS/images/Labo/".$BuffID.".".$part[1];


        // Copie le fichier temporaire de l'image selectionner présent sur le serveur, directement dans le repertoire du serveur
        copy($_FILES["image_uploads"]["tmp_name"],$destination);
    }

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}


   // Renvoi à la page d'information correspondante du labo

   $url = "fichecontact_Lab_Administrator.php?name=".$_SESSION['SelectedLab'];
   header("Location: ".$url);

?>