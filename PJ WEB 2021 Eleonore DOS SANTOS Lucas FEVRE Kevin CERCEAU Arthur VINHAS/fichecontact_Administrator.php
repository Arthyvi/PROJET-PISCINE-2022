<?php
    // Start the session
    session_start();
    $_SESSION["SelectedDoc"] =  $_GET['name'];
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

        <h2 class="font-weight-bold" style="margin-left:27%">Administrateur</h2>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="Administrateur.html">Home</a>
                </li>
                <li class="dropdown1">
                    <button onclick="window.location='CompteAdmin.php'" type="button" class="btn btn-primary btn-sm">Mon
                        compte</button>
                    <div class="dropdown1-content">
                        <a href="Deconnexion.php">Deconnexion</a>
                    </div>
                </li>
            </ul>
        </div> <!-- .navbar-collapse -->
    </nav>

<button onclick="window.location='choix_medecin_Administrator.php'" class="btn btn-primary btn-sm" style="margin: 0.5%;">Retour</button><br><br>

    <?php
        // Connexion au serveur
        $mysqli = new mysqli("localhost:3306","root","","projet piscine 2022");

        // Check connection
        if($mysqli -> connect_errno)
        {
            echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
            exit();
        }
        else
        {
            $data="medecin";
            $mail="identifiant";
            $result = mysqli_query($mysqli, "SELECT * FROM medecin WHERE IDPersonne='" . $_GET['name'] . "'");
            $resultmail = mysqli_query($mysqli, "SELECT * FROM identifiant WHERE IDpersonne='" . $_GET['name'] . "'");
            $mail = mysqli_fetch_assoc($resultmail);
            //afficher le resultat
            echo "<table>";
            if ($data = mysqli_fetch_assoc($result)) {
                echo "<tr><td rowspan='3'><img src='./images/medecin/" . $data['IDpersonne'] . ".jpg?m=" . filemtime('./images/medecin/' . $data['IDpersonne'] . '.jpg')."' height='360' width='300'> </a>";
                echo "<td><h1>Dr. " . $data['Prenom'] . " " . $data['Nom'] . "</h1></td></tr>";
                echo "<tr><td><h2>+33" . $data['NumTelephone'] . "<h2></td></tr>";
                echo "<tr><td><p class='font-weight-bold'>Identifiant :</p><p>" . $mail['Identifiant'] . "</p></td></tr></table>";
            
            }

            echo "<a href='Modifier_Profil_Docteur.php'><span class='btn btn-primary btn-xl' style='margin-right:3%'>Modifier info</span></a>";
            echo "<a href='SupprimerDoc.php'><span class='btn btn-primary btn-xl'>Supprimer</span></a>";
        }
    ?>
    
    
    
</body>
