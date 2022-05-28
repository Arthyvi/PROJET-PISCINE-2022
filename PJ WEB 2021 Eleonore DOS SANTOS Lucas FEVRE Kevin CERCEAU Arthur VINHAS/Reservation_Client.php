<?php
// Start the session
session_start();


// Connexion au serveur
$mysqli = new mysqli("localhost", "root", "", "projet piscine 2022");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL" . $mysqli->connect_errno;
    exit();
}

// Initialisation des tableaux

$Cases = [
    ["table-borderless table-secondary font-weight-bold", "font-weight-bold", "font-weight-bold", "font-weight-bold", "table-borderless table-secondary font-weight-bold", "font-weight-bold", "font-weight-bold", "font-weight-bold","font-weight-bold"],
    ["Horaires du matin", "9H-10H", "10H-11H", "11H-12H", "Horaires d'apres-midi", "14H-15H", "15H-16H", "16H-17H","17H-18H"]
];


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <title>DOcMNES</title>
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="carousel.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <script src="Reserve.js"></script>
   
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="#"><img src="omnes.png" width="150" alt=""></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <form action="#">
            <div class="input-group input-navbar">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="icon-addon1"><span class="fa fa-search"></span></span>
                </div>
                <input type="text" class="form-control" placeholder="Recherche..">
            </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Accueil</a>
                </li>
                <li class="dropdown1">
                    <div class="nav-link">Tout Parcourir <i class="fa fa-caret-down"></i></div>
                    <div class="dropdown1-content">
                        <a href="Medecin_G.php">Médecine générale</a>
                        <a href="Medecin_Spe.php">Médecins spécialistes</a>
                        <a href="Labo.php">Laboratoire de biologie médicale</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.html">Rendez-vous</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="connexion1.php">Votre Compte</a>
                </li>
            </ul>
        </div> <!-- .navbar-collapse -->

    </nav>

    <div class="container">
        <div class="col">
            <div class="row justify-content-center align-items-center">
                <form>
                    <table class="table table-primary table-bordered table-hover table-sm" style="margin-top:5%">

                    <tr class="font-weight-bold">
                            <td></td>
                            <td> Lundi </td>
                            <td> Mardi </td>
                            <td> Mercredi </td>
                            <td> Jeudi </td>
                            <td> Vendredi </td>
                            <td> Samedi </td>
                    </tr>

                    <?php

                        for($j = 1; $j<10; $j++) //$j = "Les horaires et titre de période la journée (lignes)"
                        {
                            
                            echo '<tr class="'.$Cases[0][$j-1].'">';
                            echo '<td>'.$Cases[1][$j-1].'</td>';

                            if(($j != 1)&&($j != 5))
                            {
                                echo '<td> <div id="'.$j.'-1" onclick="Reserver(\''.$j.'-1\')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>';
                                echo '<td> <div id="'.$j.'-2" onclick="Reserver(\''.$j.'-2\')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>';
                                echo '<td> <div id="'.$j.'-3" onclick="Reserver(\''.$j.'-3\')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>';
                                echo '<td> <div id="'.$j.'-4" onclick="Reserver(\''.$j.'-4\')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>';
                                echo '<td> <div id="'.$j.'-5" onclick="Reserver(\''.$j.'-5\')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>';
                                echo '<td> <div id="'.$j.'-6" onclick="Reserver(\''.$j.'-6\')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>';
                                
                            }
                            else
                            {
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                            }
                           
                            echo  '</tr>';        

                        }
                    ?>

                      <!--


                        <tr class="table-borderless table-secondary font-weight-bold">
                            <td>Horaires du matin</td>
                            <td></td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>

                        <tr class="font-weight-bold">
                            <td>9H-10H</td>
                            <td> <div onclick="Reserver('1-A')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>
                            <td>  <div onclick="Reserver('2-A')" style="background-color: red;">&nbsp;&nbsp;&nbsp;</div> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                        </tr>


                        <tr class="font-weight-bold">
                            <td>10H-11H</td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                        </tr>

                        <tr class="font-weight-bold">
                            <td>11H-12H</td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>

                        </tr>


                        <tr class="table-borderless table-secondary font-weight-bold">
                            <td>Horaires d'apres-midi</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>

                        <tr class="font-weight-bold">
                            <td>14H-15H</td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                        </tr>

                        <tr class="font-weight-bold">
                            <td>15H-16H</td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                        </tr>

                        <tr class="font-weight-bold">
                            <td>16H-17H</td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                        </tr>

                        <tr class="font-weight-bold">
                            <td>18H-19H</td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>
                            <td> <input type="checkbox" id="reserve" name="reserve"> </td>

                        </tr>

                    -->


                    </table>

                    <input type="submit" class="btn-sm btn-primary float-right" style="margin-bottom:10%" value="Confirmer mon choix de RDV">


                </form>
            </div>
        </div>
    </div>


    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Navigation</h5>
                    <ul class="footer-menu">
                        <li><a href="index.html">Accueil</a></li><br>
                        <li><a href="rdv.html">Rendez-vous</a></li><br>
                        <li><a href="compte.html">Votre Compte</a></li><br>
                    </ul>
                </div>
                <div class="col">
                    <h5>Contact</h5>
                    <ul class="footer-menu">
                        <li><span class="fa fa-map-marker"></span>&nbsp<a>37 Quai de Grenelle, 75015 Paris</a></li><br>
                        <li><span class="fa fa-phone"></span>&nbsp<a>01 44 39 06 00</a></li><br>
                        <li><span class="fa fa-envelope"></span>&nbsp<a>omnes-sante@gmail.fr</a></li><br>
                    </ul>
                </div>
                <div class="col">
                    <div id="map-container-google-2" class="z-depth-1-half map-container" style="height: 30px">
                        <iframe src="https://maps.google.com/maps?q=ECE Paris&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <script src="../carousel.js"></script>

</body>

</html>