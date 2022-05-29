<?php

//// Page pour afficher le profil du medecin connecter !!!! ////

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();


/// Recupération des données dans la base de donnée en fonction de l'ID enregistré l'ors de la connexion
// Connexion au serveur

$mysqli = new mysqli("localhost:3306", "root", "", "projet piscine 2022");


// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL" . $mysqli->connect_errno;
    exit();
} else {
    // Recupère toutes les information de la personne
    $BuffNameTable = $_SESSION["NameTable"];
    $BuffID = $_SESSION["IDconnected"];
    $sql = "SELECT * FROM  $BuffNameTable WHERE IDpersonne = '$BuffID'";

    if ($result = $mysqli->query($sql)) {

        if ($result->num_rows > 0) {
            $row = $result->fetch_row();

            $nom = $row[1];
            $prenom = $row[2];
            $Password = $row[3];
            $phone = $row[4];
            $Specialisation = $row[5];
        }

        $result->free_result();
    }

    $sql = "SELECT * FROM  identifiant WHERE IDpersonne = '$BuffID'";

    if ($result = $mysqli->query($sql)) {

        if ($result->num_rows > 0) {
            $row = $result->fetch_row();

            $mail = $row[0];
        }

        $result->free_result();
    }

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="boot.css">

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="#"><img src="omnes.png" width="150" alt=""></a>

        <h2 class="font-weight-bold" style="margin-left:27%">Compte du Medecin</h2>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li><a class="nav-link" href="Medecin_Personnel.php">Accueil</a></li>
                <li class="dropdown1">
                    <button onclick="window.location='Profil_Medecin.php'" type="button" class="btn btn-primary btn-sm">Mon compte</button>
                    <div class="dropdown1-content">
                
                        <a href="Deconnexion.php">Deconnexion</a>
                    </div>
                </li>
            </ul>
        </div> <!-- .navbar-collapse -->
    </nav>


    <div class="page-section ">
        <div class="container">
            <div class="row align-items-left">
                <div class="col-lg-5 py-3">
                    <h2 class="font-weight-bold text-center"><?php echo $prenom ?> <?php echo $nom ?></h2>
                    <img src="<?php echo "images/medecin/" . $_SESSION["IDconnected"] . ".jpg?m=" . filemtime('images/medecin/' . $_SESSION["IDconnected"] . '.jpg')  ?>" alt="Photo du medecin" class="text-center" width="400" height="300">
                </div>
                <div class="col-lg-6">
                    <fieldset>
           
                    <br><br><br>
                        <label class="font-weight-bold" for="nom">Nom:</label>
                        <span class="InfoStyle"><?php echo $nom ?></span><br>

                        <label class="font-weight-bold" for="prenom">Prenom:</label>
                        <span class="InfoStyle"><?php echo $prenom ?></span><br>

                        <label class="font-weight-bold" for="spe">Specialite:</label>
                        <span class="InfoStyle"><?php echo $Specialisation ?></span><br>

                        <label class="font-weight-bold" for="email">Email:</label>
                        <span class="InfoStyle"><?php echo $mail ?></span><br>

                        <label class="font-weight-bold">Tél:</label>
                        <span class="InfoStyle"><?php echo $phone ?></span><br>

                        <label class="font-weight-bold" for="mdp">Mot de passe:</label>
                        <span class="InfoStyle"><?php echo $Password ?></span><br>

                    </fieldset>


                </div>
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