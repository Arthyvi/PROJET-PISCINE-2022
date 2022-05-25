<?php
    // Start the session
    session_start();
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
        $mysqli = new mysqli("localhost:3309","root","","projet piscine 2022");

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
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr><td rowspan='3'><img src='./images/medecin/" . $data['IDpersonne'] . ".jpg' height='360' width='300'> </a>";
                echo "<td><h1>Dr. " . $data['Prenom'] . " " . $data['Nom'] . "</h1></td></tr>";
                echo "<tr><td><h2>+33" . $data['NumTelephone'] . "<h2></td></tr>";
                echo "<tr><td><h2>" . $mail['Identifiant(mail)'];
                echo "</h2></td></tr></table>";
            }
        }
    ?>
    <span class="boutton">Prendre RDV</span>
    <a href="chatroom.html"><span class="boutton">Communiquer</button></span></a>
    <span class="boutton">Voir le CV</span>
</body>