<?php
    // Start the session
    session_start();
    $_SESSION["SelectedLab"] =  $_GET['name'];
?>

<!DOCTYPE html>

<head>
    <title>OMNES SANTE</title>
    <meta charset="uft-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<button onclick="window.location='choix_Labo_Administrator.php'" style="margin-top: 2%;"><- Retour</button><br><br>

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
            $data="laboratoire";
            $mail="identifiant";
            $result = mysqli_query($mysqli, "SELECT * FROM laboratoire WHERE IDlabo='" . $_GET['name'] . "'");
  
            //afficher le resultat
            echo "<table>";
            if ($data = mysqli_fetch_assoc($result)) {
                echo "<tr><td rowspan='3'><img src='./images/Labo/" . $data['IDlabo'] . ".jpg?m=" . filemtime('./images/Labo/' . $data['IDlabo'] . '.jpg')."' height='360' width='300'> </a>";
                echo "<td><h1>Laboratoire : " . $data['NomLab'] . "</h1></td></tr>";
                echo "<tr><td><h2>" . $data['Salle'] . "<h2></td>";
                echo "<td><h2>+33" . $data['NumTelephone'] . "<h2></td></tr>";
                echo "<tr><td><h2>" . $data['Mail'];
                echo "</h2></td></tr></table>";
            }

            echo "<a href='Modifier_Profil_Labo.php'><span class='boutton'>Modifier info</span></a>";
            echo "<a href='SupprimerLab.php'><span class='boutton2'>Supprimer</span></a>";
        }
    ?>
    
    
    
</body>