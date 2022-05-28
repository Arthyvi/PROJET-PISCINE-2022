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

    //$sql = "SELECT IDpersonne FROM medecin WHERE IDpersonne = (SELECT MAX(IDpersonne) FROM medecin)";   
    $sql = "SELECT IDpersonne FROM medecin";   

    $Maximun = -1;
    
    if($result = $mysqli->query($sql))
    {
        if($result->num_rows >0)
        {
            while($row = $result->fetch_row())
            {
                $BuffBuff = intval(substr($row[0],7));
                if($BuffBuff > $Maximun)
                {
                    $Maximun = $BuffBuff;
                }   
            }
           
        }
        $result->free_result();
    }
 
    $IDchosen = "";

    if($Maximun == -1)
    {
        $IDchosen = "MD-00001"; // Premier ID
    }
    else
    {
        // Ajouter 1 au nombre pour incrementer
        $NumRecupInt = $Maximun+ 1;

        //echo  $NumRecupInt."AAAA<br>";

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

    $destination = $_SERVER['DOCUMENT_ROOT']."/PROJET-PISCINE-2022/PJ WEB 2021 Eleonore DOS SANTOS Lucas FEVRE Kevin CERCEAU Arthur VINHAS/images/medecin/".$IDchosen.".".$part[1];

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



//// Partie pour generer le CV sous forme XML du Docteur !!!!!!
// Recupération des données du CV
$Presentation= isset($_POST["presentation"]) ? $_POST["presentation"] : "";
$formation= isset($_POST["formation"]) ? $_POST["formation"] : "";
$Langue1= isset($_POST["Langue1"]) ? $_POST["Langue1"] : "";
$Langue2 = isset($_POST["Langue2"]) ? $_POST["Langue2"] : "";
$Langue3= isset($_POST["Langue3"]) ? $_POST["Langue3"] : "";
$experience= isset($_POST["experience"]) ? $_POST["experience"] : "";

// Manipulation du document XML pour rajouter un CV
$dom = new DOMDocument();
  $dom->formatOutput = true;

  $dom->load('Mes CV/CVmedecin.xml', LIBXML_NOBLANKS);

  $root = $dom->documentElement;
  $newresult = $root->appendChild( $dom->createElement('DocteurCV') );
  $newresult->setAttribute('id', $IDchosen);

  $newresult->appendChild( $dom->createElement('Nom',$nom) );
  $newresult->appendChild( $dom->createElement('Prenom',$prenom) );
  $newresult->appendChild( $dom->createElement('Telephone',$phone) );
  $newresult->appendChild( $dom->createElement('Mail',$mail) );
  $newresult->appendChild( $dom->createElement('Specialisation',$specialisation) );

  $newresult->appendChild( $dom->createElement('presentation',$Presentation) );
  $newresult->appendChild( $dom->createElement('formation',$formation) );
  $newresult->appendChild( $dom->createElement('Langue1',$Langue1) );

  if($Langue2 != "")
  {
    $newresult->appendChild( $dom->createElement('Langue2',$Langue2) );
  }

  if($Langue3 != "")
  {
    $newresult->appendChild( $dom->createElement('Langue3',$Langue3) );
  }

  $newresult->appendChild( $dom->createElement('experience',$experience) );

 // echo ''. $dom->saveXML() .'';
  $dom->save('Mes CV/CVmedecin.xml') or die('XML Manipulate Error');

  // Renvoi à la page de choix du medecin
  header("Location: choix_medecin_Administrator.php");

?>