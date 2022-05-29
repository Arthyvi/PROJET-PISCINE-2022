<?php

    // Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
    // de manière global des données, peut importe la page
    session_start();

    $TheID = $_SESSION["SelectedDoc"];

    ////Supression de l'image dans le repertoire
    $fichier = $_SERVER['DOCUMENT_ROOT']."/PROJET-PISCINE-2022/PJ WEB 2021 Eleonore DOS SANTOS Lucas FEVRE Kevin CERCEAU Arthur VINHAS/images/medecin/".$TheID.".jpg";

    if( file_exists ($fichier))
    {
        unlink($fichier);
    }
      
    ////Suppression de la BDD
    // Connexion au serveur
    $mysqli = new mysqli("localhost:3309","root","","projet piscine 2022");

    // Check connection
    if($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
        exit();
    }
    else
    {
        // Effacement depuis la table "medecin"
        $sql = "DELETE FROM medecin WHERE IDpersonne= '$TheID';";
        $result = $mysqli->query($sql);

        // Effacement depuis la table "identifiant"
        $sql = "DELETE FROM  identifiant WHERE IDpersonne= '$TheID';";
        $result = $mysqli->query($sql);


        // Fermeture de notre variable "$mysqli"
        $mysqli->close();
    }


    //// Suppression de son CV dans le XML
    //Modification document
    $dom = new DOMDocument();
    $dom->formatOutput = true;

    $dom->load('Mes CV/CVmedecin.xml', LIBXML_NOBLANKS);

    $root = $dom->documentElement;

    // effacement de l'element
    $results = $root->getElementsByTagName( 'DocteurCV' );
    foreach( $results  as $result){
        if($result->getAttribute('id') == $TheID)
        {
        $result->parentNode->removeChild($result); 
        break;

        }
    }

     //echo ''. $dom->saveXML() .'';
  $dom->save('Mes CV/CVmedecin.xml') or die('XML Manipulate Error');


  // Renvoi à la page de choix du medecin
  header("Location: choix_medecin_Administrator.php");


?>