<?php

    // Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
    // de manière global des données, peut importe la page
    session_start();

    $TheID = $_SESSION["SelectedLab"];

    ////Supression de l'image dans le repertoire
    $fichier = $_SERVER['DOCUMENT_ROOT']."/PROJET-PISCINE-2022/PJ WEB 2021 Eleonore DOS SANTOS Lucas FEVRE Kevin CERCEAU Arthur VINHAS/images/Labo/".$TheID.".jpg";

    if( file_exists ($fichier))
    {
        unlink($fichier);
    }
      
    ////Suppression de la BDD
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
        // Effacement depuis la table "laboratoire"
        $sql = "DELETE FROM laboratoire WHERE IDlabo = '$TheID';";
        $result = $mysqli->query($sql);


        // Fermeture de notre variable "$mysqli"
        $mysqli->close();
    }


  // Renvoi à la page de choix du medecin
  header("Location: choix_Labo_Administrator.php");


?>