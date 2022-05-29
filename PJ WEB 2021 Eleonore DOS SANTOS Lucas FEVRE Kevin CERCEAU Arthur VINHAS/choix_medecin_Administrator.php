<?php
// Start the session
session_start();
?>

<!DOCTYPE html>

<head>
    <title>OMNES SANTE</title>
    <meta charset="uft-8">
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="script.js"></script>
</head>

<?php
// Set session variables (variables globales)
$_SESSION["doc"] = "";
?>

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


    
        <div class="container">
            <div class="row">
                <div class="col">


                    <button onclick="window.location='Ajouter_Medecin.php'" type="button" class="btn btn-primary btn-xl" style=" margin:1%;">+ Ajouter Medecin</button>




                    <?php
                    // Connexion au serveur
                    $mysqli = new mysqli("localhost:3309", "root", "", "projet piscine 2022");

                    // Check connection
                    if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL" . $mysqli->connect_errno;
                        exit();
                    } else {
                        $data = "medecin";
                        $result = mysqli_query($mysqli, "SELECT * FROM " . $data);
                        //afficher le resultat
                        echo "<table class='table table-hover' >";
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<tr onclick=\"window.location='fichecontact_Administrator.php?name=" . $data['IDpersonne'] . "'\">";
                            echo "<td>  <img src='./images/medecin/" . $data['IDpersonne'] . ".jpg?m=" . filemtime('./images/medecin/' . $data['IDpersonne'] . '.jpg') . "' height='120' width='100' id='doc'>   </td>";
                            echo "<td>Dr " . $data['Nom'] . "</td>";
                            echo "<td>" . $data['Specialisation'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
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