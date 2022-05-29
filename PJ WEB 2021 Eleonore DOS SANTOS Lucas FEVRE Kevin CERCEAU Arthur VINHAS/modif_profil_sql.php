<?php
    //demarrer la session
    session_start();

    //récupérer toutes les données entrées
    $id=$_SESSION['IDconnected'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $adresse1=$_POST['adresse1'];
    $adresse2=$_POST['adresse2'];
    $ville=$_POST['ville'];
    $codepostal=$_POST['codepostal'];
    $pays=$_POST['pays'];
    $tel=$_POST['tel'];
    $secu=$_POST['secu'];
    $mail=$_POST['email'];

    // Connexion au serveur
    $mysqli = new mysqli("localhost:3306","root","","projet piscine 2022");

    // Check connection
    if($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
        exit();
    }

    //mettre à jour les tables
    $sql="UPDATE client SET Nom='$nom', Prenom='$prenom', AdresseLigne1='$adresse1', AdresseLigne2='$adresse2', Ville='$ville', CodePostal='$codepostal', Pays='$pays', NumTelephone='$tel', NumCarteVital='$secu' WHERE IDpersonne='$id'";
    $result = $mysqli->query($sql);
    $sql="UPDATE identifiant SET Identifiant='$mail' WHERE IDpersonne='$id'";
    $result = $mysqli->query($sql);

    //revenir à la page
    header("Location: Mon_Profil.php");
?>
