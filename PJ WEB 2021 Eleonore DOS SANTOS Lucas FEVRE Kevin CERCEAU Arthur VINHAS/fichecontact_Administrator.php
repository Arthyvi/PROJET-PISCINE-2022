<?php
    // Start the session
    session_start();
    $_SESSION["SelectedDoc"] =  $_GET['name'];
?>

<!DOCTYPE html>

<head>
    <title>OMNES SANTE</title>
    <meta charset="uft-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
            $data="medecin";
            $mail="identifiant";
            $result = mysqli_query($mysqli, "SELECT * FROM medecin WHERE IDPersonne='" . $_GET['name'] . "'");
            $resultmail = mysqli_query($mysqli, "SELECT * FROM identifiant WHERE IDpersonne='" . $_GET['name'] . "'");
            $mail = mysqli_fetch_assoc($resultmail);
            //afficher le resultat
            echo "<table>";
            if ($data = mysqli_fetch_assoc($result)) {
                echo "<tr><td rowspan='3'><img src='./images/medecin/" . $data['IDpersonne'] . ".jpg' height='360' width='300'> </a>";
                echo "<td><h1>Dr. " . $data['Prenom'] . " " . $data['Nom'] . "</h1></td></tr>";
                echo "<tr><td><h2>+33" . $data['NumTelephone'] . "<h2></td></tr>";
                echo "<tr><td><h2>" . $mail['Identifiant'];
                echo "</h2></td></tr></table>";
            }

            echo "<a href='Modifier_Profil_Docteur.php'><span class='boutton'>Modifier info</span></a>";
            echo "<span class='boutton2'>Supprimer</span>";
        }
    ?>
    
    
    
</body>