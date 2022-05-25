<?php

// Declaration des variables
$nom= isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom= isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$adresse1= isset($_POST["adresse1"]) ? $_POST["adresse1"] : "";
$adresse2= isset($_POST["adresse2"]) ? $_POST["adresse2"] : "";
$ville= isset($_POST["ville"]) ? $_POST["ville"] : "";
$codeP= isset($_POST["code"]) ? $_POST["code"] : "";
$pays= isset($_POST["pays"]) ? $_POST["pays"] : "";
$phone= isset($_POST["tel"]) ? $_POST["tel"] : "";
$CarteVitale= isset($_POST["vitale"]) ? $_POST["vitale"] : "";
$mail= isset($_POST["email"]) ? $_POST["email"] : "";
$Password= isset($_POST["mdp"]) ? $_POST["mdp"] : "";
$ConfirmedPassword= isset($_POST["mdp2"]) ? $_POST["mdp2"] : "";

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


        /// Creer un ID cohérent avec les ID deja présent au sein
    //Recupérer l'ID client ayant le numéro le plus élevé

    $sql = "SELECT IDpersonne FROM client WHERE IDpersonne = (SELECT MAX(IDpersonne) FROM client)";   
    
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
        $IDchosen = "CL-00001"; // Premier ID
    }
    else
    {
        //Prendre les nombres à la fin et  les transformé en int
        $NumRecupInt = intval(substr($BuffID,7)); 

        // Ajouter 1 au nombre pour incrementer
        $NumRecupInt = $NumRecupInt + 1;

        // ID chosen for the new client
        $IDchosen = "CL-0000".$NumRecupInt; 
    }
    
    // Transformation en INT des valeurs devant etre en int dans la BDD
    $codeP2 =  intval($codeP);
    $phone2 =  intval($phone);
    $CarteVitale2 = intval($CarteVitale);

    // On rajoute le client dans la table client
    $sql = "INSERT INTO client VALUES ('$IDchosen','$nom','$prenom', '$adresse1','$adresse2','$ville',$codeP2,'$pays',$phone2,$CarteVitale2,'$Password'); ";
    $result = $mysqli->query($sql);

    //On rajoute l'identifiant du client dans la table identifiant
    $sql = "INSERT INTO identifiant VALUES ('$mail','$IDchosen'); ";
    $result = $mysqli->query($sql);
    


    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}



?>