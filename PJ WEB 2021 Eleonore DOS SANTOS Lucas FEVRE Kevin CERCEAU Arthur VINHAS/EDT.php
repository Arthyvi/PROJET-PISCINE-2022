<?php
// Start the session
session_start();

// Set session variables (variables globales)
$_SESSION["patient"] = "";

$BuffID =  $_SESSION["IDconnected"];

$CasesJourHoraire = [
    [1 => "Lundi", 2 => "Mardi", 3 => "Mercredi", 4 => "Jeudi", 5 => "Vendredi", 6 => "Samedi"],
    [2 => "9H-10H", 3 => "10H-11H", 4 => "11H-12H", 6 => "14H-15H", 7 => "15H-16H", 8 => "16H-17H", 9 => "17H-18H"]
];

?>

<!DOCTYPE html>

<head>
    <title>OMNES SANTE</title>
    <meta charset="uft-8">
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="script.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="#"><img src="omnes.png" width="150" alt=""></a>

        <h2 class="font-weight-bold" style="margin-left:27%">Mes Rendez-vous</h2>

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


    <h2 style="padding-top:3%;" class="text-center">Emploi du temps :</h2>

    
        <div class="container">
            <div class="row">
                <div class="col">

                <br><br>

                    <?php
                    $Compt = 1;
                    //`rdvmedecin-client`
                    //`rdvlabo-client`
                    // Connexion au serveur
                    $mysqli = new mysqli("localhost", "root", "", "projet piscine 2022");

                    // Check connection
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL" . $mysqli->connect_errno;
                        exit();
                    } else {
                        $result = mysqli_query($mysqli, "SELECT * FROM `rdvmedecin-client` WHERE IDmedecin = '$BuffID'");
                        
                        //$result = mysqli_query($mysqli, "SELECT client.IDpersonne med.Nom , med.Prenom, med.Specialisation , rdv.IDrdv ,rdv.Jour, rdv.horaire FROM `rdvmedecin-client` rdv INNER JOIN `medecin` med ON rdv.IDmedecin = med.IDpersonne WHERE rdv.IDmedecin = '$BuffID'");
                        //afficher le resultat
                        echo "<table class='table table-hover text-center' >";
                        while ($data = mysqli_fetch_assoc($result)) {
                            $result1 = mysqli_query($mysqli, "SELECT * FROM `client` WHERE IDpersonne = '". $data['IDclient'] . "'");
                            $data1 = mysqli_fetch_assoc($result1);

                            echo "<tr onclick=\"window.location='fichepatient.php?name=" . $data['IDclient'] . "'\">";
                            echo "<td>".$Compt."</td>";
                            echo "<td>" . $CasesJourHoraire[0][intval($data['Jour'])] . "</td>";
                            echo "<td>" .  $CasesJourHoraire[1][intval($data['horaire'])] . "</td>";
                            echo "<td>Patient : ".$data1['Nom']." ".$data1['Prenom']."</td>";
                            echo "<td><button onclick='window.location=\"SuppresionRDV.php?md=". $data['IDrdv']."&dd=1\"'  class='btn btn-primary btn-sm'>Annuler RDV</button></td>";
                            echo "</tr>";

                            $Compt =  $Compt +1;
                        }
                        echo "</table>";

                        // Fermeture de notre variable "$mysqli"
                         $mysqli->close();
                    }

                    ?>
                </div>
            </div>
        </div>
    

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Navigation</h5>
                    <ul class="footer-menu">
                        <li><a href="Medecin_Personnel.php">Accueil</a></li><br>
                        <li><a href="Profil_Medecin.php">Votre Compte</a></li><br>
                    </ul>
                </div>
                <div class="col">
                    <h5>Contact</h5>
                    <ul class="footer-menu">
                        <li><span class="fa fa-map-marker"></span>&nbsp<a>37 Quai de Grenelle, 75015 Paris</a></li>
                        <br>
                        <li><span class="fa fa-phone"></span>&nbsp<a>01 44 39 06 00</a></li><br>
                        <li><span class="fa fa-envelope"></span>&nbsp<a>omnes-sante@gmail.fr</a></li><br>
                    </ul>
                </div>
                <div class="col">
                    <div id="map-container-google-2" class="z-depth-1-half map-container" style="height: 30px">
                        <iframe src="https://maps.google.com/maps?q=ECE Paris&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

    </footer>

</body>

</html>
