<?php
// Start the session
session_start();

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
                    <a class="nav-link" href="home.php">Accueil</a>
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


    <h3 style="padding-top:3%;text-decoration:underline;" class="text-center">Mes Rendez-vous avec Medecins :</h3>

    
        <div class="container">
            <div class="row">
                <div class="col">

                <br><br>

                    <?php
                    $Compt = 1;
                    //`rdvmedecin-client`
                    //`rdvlabo-client`
                    // Connexion au serveur
                    $mysqli = new mysqli("localhost:3306", "root", "", "projet piscine 2022");

                    // Check connection
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL" . $mysqli->connect_errno;
                        exit();
                    } else {
                        $result = mysqli_query($mysqli, "SELECT med.Nom , med.Prenom, med.Specialisation , rdv.IDrdv ,rdv.Jour, rdv.horaire  FROM `rdvmedecin-client` rdv INNER JOIN `medecin` med ON rdv.IDmedecin = med.IDpersonne WHERE rdv.IDclient = '$BuffID'");
                        //afficher le resultat
                        echo "<table class='table table-hover' >";
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$Compt."</td>";
                            echo "<td>Avec : &nbsp;&nbsp; Dr " . $data['Prenom'] . " " . $data['Nom'] . " &nbsp;&nbsp;&nbsp; (" . $data['Specialisation'] . ")</td>";
                            echo "<td>" . $data['Specialisation'] . "</td>";
                            echo "<td> Jour : " . $CasesJourHoraire[0][intval($data['Jour'])] . "</td>";
                            echo "<td> Créneau : " .  $CasesJourHoraire[1][intval($data['horaire'])] . "</td>";
                            echo "<td> </td>";
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
    

    <h3 style="padding-top:3%;text-decoration:underline;" class="text-center">Mes Rendez-vous avec des Laboratoires :</h3>

    
<div class="container">
    <div class="row">
        <div class="col">

        <br><br>

            <?php
            $Compt = 1;
            //`rdvmedecin-client`
            //`rdvlabo-client`
            // Connexion au serveur
            $mysqli = new mysqli("localhost:3306", "root", "", "projet piscine 2022");

            // Check connection
            if ($mysqli->connect_errno) {
                echo "Failed to connect to MySQL" . $mysqli->connect_errno;
                exit();
            } else {
                $result = mysqli_query($mysqli, "SELECT med.NomLab , med.Salle, rdv.IDrdv ,rdv.Jour, rdv.horaire , rdv.ServiceSelectionner  FROM `rdvlabo-client` rdv INNER JOIN `laboratoire` med ON rdv.IDlabo = med.IDlabo WHERE rdv.IDclient = '$BuffID'");

                //afficher le resultat
                echo "<table class='table table-hover' >";
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$Compt."</td>";
                    echo "<td>Avec : &nbsp;&nbsp; Laboratoire " . $data['NomLab'] . "&nbsp;&nbsp; Salle : " . $data['Salle'] . "</td>";
                    echo "<td>(" . $data['ServiceSelectionner'] . ")</td>";
                    echo "<td> Jour : " . $CasesJourHoraire[0][intval($data['Jour'])] . "</td>";
                    echo "<td> Créneau : " .  $CasesJourHoraire[1][intval($data['horaire'])] . "</td>";
                    echo "<td> </td>";
                    echo "<td><button onclick='window.location=\"SuppresionRDV.php?md=". $data['IDrdv']."&dd=2\"'  class='btn btn-primary btn-sm'>Annuler RDV</button></td>";
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
                        <li><a href="home.php">Accueil</a></li><br>
                        <li><a href="rdv.html">Rendez-vous</a></li><br>
                        <li><a href="compte.html">Votre Compte</a></li><br>
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
