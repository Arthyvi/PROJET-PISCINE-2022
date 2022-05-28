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

//Corrige erreur de specialisation
if($specialisation == "")
{
    $specialisation = $_SESSION["SpeDoc"];
}

/// Partie permettant de changer l'image selectionner dans le repertoire de la base de donnée !!!!!
if($_FILES["image_uploads"]["name"] != "")
{
    $part = explode(".",$_FILES["image_uploads"]["name"]);

    $destination = $_SERVER['DOCUMENT_ROOT']."/PROJET-PISCINE-2022/PJ WEB 2021 Eleonore DOS SANTOS Lucas FEVRE Kevin CERCEAU Arthur VINHAS/images/medecin/".$_SESSION["SelectedDoc"].".".$part[1];

    /*
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    */

    // Copie le fichier temporaire de l'image selectionner présent sur le serveur, directement dans le repertoire du serveur
    copy($_FILES["image_uploads"]["tmp_name"],$destination);

}

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
     $BuffID = $_SESSION["SelectedDoc"];
     $phone2 = intval($phone);

     $sql = "UPDATE medecin SET Nom ='$nom', Prenom = '$prenom', Password1 = '$Password', NumTelephone= ".$phone2." , Specialisation ='$specialisation' WHERE IDpersonne ='$BuffID';";
     $result = $mysqli->query($sql);

     $sql = "UPDATE identifiant SET Identifiant ='$mail' WHERE IDpersonne ='$BuffID';";
     $result = $mysqli->query($sql);


    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}

/// Manipulation du document XML pour modifier un CV
// Recupération des données du CV
$Presentation= isset($_POST["presentation"]) ? $_POST["presentation"] : "";
$formation= isset($_POST["formation"]) ? $_POST["formation"] : "";
$Langue1= isset($_POST["Langue1"]) ? $_POST["Langue1"] : "";
$Langue2 = isset($_POST["Langue2"]) ? $_POST["Langue2"] : "";
$Langue3= isset($_POST["Langue3"]) ? $_POST["Langue3"] : "";
$experience= isset($_POST["experience"]) ? $_POST["experience"] : "";

//Modification document
$dom = new DOMDocument();
  $dom->formatOutput = true;

  $dom->load('Mes CV/CVmedecin.xml', LIBXML_NOBLANKS);

  $root = $dom->documentElement;
  
  // effacement de l'ancien
  $results = $root->getElementsByTagName( 'DocteurCV' );
    foreach( $results  as $result){
      if($result->getAttribute('id') == $BuffID)
      {
        $result->parentNode->removeChild($result); 
       break;

      }
    }


    // ajout du nouveau
    $results = $root->appendChild( $dom->createElement('DocteurCV') );
    $results->setAttribute('id', $BuffID);

    $results->appendChild( $dom->createElement('Nom',$nom) );
    $results->appendChild( $dom->createElement('Prenom',$prenom) );
    $results->appendChild( $dom->createElement('Telephone',$phone) );
    $results->appendChild( $dom->createElement('Mail',$mail) );
    $results->appendChild( $dom->createElement('Specialisation',$specialisation) );

    $results->appendChild( $dom->createElement('presentation',$Presentation) );
    $results->appendChild( $dom->createElement('formation',$formation) );
    $results->appendChild( $dom->createElement('Langue1',$Langue1) );

  if($Langue2 != "")
  {
    $results->appendChild( $dom->createElement('Langue2',$Langue2) );
  }

  if($Langue3 != "")
  {
    $results->appendChild( $dom->createElement('Langue3',$Langue3) );
  }

  $results->appendChild( $dom->createElement('experience',$experience) );


  //echo ''. $dom->saveXML() .'';
  $dom->save('Mes CV/CVmedecin.xml') or die('XML Manipulate Error');


  // Renvoi à la page d'information correspondante du medecin

  $url = "fichecontact_Administrator.php?name=".$_SESSION['SelectedDoc'];
  header("Location: ".$url);

?>