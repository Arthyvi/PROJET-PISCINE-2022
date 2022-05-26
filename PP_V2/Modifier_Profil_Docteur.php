<?php

//declaration des variables
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$spe = isset($_POST["spe"]) ? $_POST["spe"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$mdp = isset($_POST["mdp"]) ? $_POST["mdp"] : "";
$cmdp = isset($_POST["cmdp"]) ? $_POST["cmdp"] : "";



echo "Salut";
echo "Nom = ".$nom."<br>";
echo "Prenom = ".$Name."<br>";
echo "Specialite = ".$spe."<br><br>";

echo "Email = ".$email."<br>";
echo "MDP = ".$mdp."<br><br>";
echo "cmdp = ".$cmdp."<br>";



?>