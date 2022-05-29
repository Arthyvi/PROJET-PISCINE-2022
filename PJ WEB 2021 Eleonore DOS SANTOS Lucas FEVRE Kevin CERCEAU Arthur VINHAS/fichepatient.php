<?php
    // Start the session
    session_start();
    $_SESSION["SelectedPatient"] =  $_GET['name'];
?>

<!DOCTYPE html>

<head>
    <title>OMNES SANTE</title>
    <meta charset="uft-8">
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="#"><img src="omnes.png" width="150" alt=""></a>

        <h2 class="font-weight-bold" style="margin-left:27%">Carnet de Santé</h2>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="Medecin_Personnel.php">Accueil</a>
                </li>
                <li class="dropdown1">
                    <button onclick="window.location='Profil_Medecin.php'" type="button" class="btn btn-primary btn-sm">Mon
                        compte</button>
                    <div class="dropdown1-content">
                        <a href="Deconnexion.php">Deconnexion</a>
                    </div>
                </li>
            </ul>
        </div> <!-- .navbar-collapse -->
    </nav>

<button onclick="window.location='EDT.php'" class="btn btn-primary btn-sm" style="margin: 0.5%;">Retour</button><br><br>

    <?php
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
            $data="client";
            $mail="identifiant";
            $result = mysqli_query($mysqli, "SELECT * FROM client WHERE IDPersonne='" . $_GET['name'] . "'");
            $resultmail = mysqli_query($mysqli, "SELECT * FROM identifiant WHERE IDpersonne='" . $_GET['name'] . "'");
            $mail = mysqli_fetch_assoc($resultmail);
            //afficher le resultat
            echo "<table>";
            if ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><h1>Patient : " . $data['Prenom'] . " " . $data['Nom'] . "</h1></td></tr>";
                echo "<tr><td><p class='font-weight-bold'>Adresse :</p><p>" . $data['AdresseLigne1'] . " " . $data['AdresseLigne2'] . "</p></td></tr></table>";
                echo "<tr><td><p class='font-weight-bold'>Tél :</p><p>" . $data['NumTelephone'] . "</p></td></tr></table>";
                echo "<tr><td><p class='font-weight-bold'>Identifiant :</p><p>" . $mail['Identifiant'] . "</p></td></tr></table>";
                echo "<tr><td><p class='font-weight-bold'>Numéro de carte vitale :</p><p>" . $data['NumCarteVital'] . "</p></td></tr></table>";
                
            
            }

        }
    ?>
    
    
    
</body>