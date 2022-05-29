<?php
// Start the session
session_start();


$Test = isset($_SESSION["IDconnected"]) ? $_SESSION["IDconnected"] : "nope";

if($Test == "nope")
{
  $_SESSION["IDconnected"] = "";
}

//$_SESSION["IDconnected"] = "";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">

  <title>DOcMNES</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="script.js"></script>
  <link rel="stylesheet" href="boot.css">
  <link rel="stylesheet" href="carousel.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<?php
// Set session variables (variables globales)
$_SESSION["doc"] = "";

$_SESSION["SelectedDoc"]="";

?>

<?php
// Connexion au serveur

$mysqli = new mysqli("localhost", "root", "", "projet piscine 2022");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL" . $mysqli->connect_errno;
  exit();
}
?>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="#"><img src="omnes.png" width="150" alt=""></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <form action="recherche.php" method="post">
      <div class="input-group input-navbar">
        <div class="input-group-prepend">
          <span class="input-group-text" id="icon-addon1"><span class="fa fa-search"></span></span>
        </div>
        <input type="text" class="form-control" placeholder="Recherche.." name="recherche">

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

            <a class ="text-blue" href="Medecin_G.php">Médecine générale</a>
            <a class ="text-blue" href="Medecin_Spe.php">Médecins spécialistes</a>
            <a class ="text-blue" href="Labo.php">Laboratoire de biologie médicale</a>
          </div>
        </li>
        
        <li class="nav-item">
        <a class="nav-link" ></a>
        </li>
        
        <?php

          if( $_SESSION["IDconnected"] == "" )
          {

           echo '<li class="nav-item">';
           echo '<a class="btn btn-primary" href="connexion1.php">Connexion</a>';

           echo  '</li>'; 

          }
          else
          {

            echo  '<li class="dropdown1">';
            echo   '<button onclick="window.location=\'CompteAdmin.php\'" type="button" class="btn btn-primary btn-sm">Mon
                  compte</button>';
            echo   '<div class="dropdown1-content">';
            echo   '<a class ="text-blue" href="MesRendezVous.php">Rendez-vous</a>';
            echo   '<a class ="text-blue" href="DeconnexionClient.php?ref=home.php">Deconnexion</a>';
            echo   '</div>';
            echo   '</li>';

          }

        ?>

      </ul>
    </div> <!-- .navbar-collapse -->

  </nav>

  <div class="page-section pb-0">
    <div class="container">
      <div class="row align-items-left">
        <div class="col-lg-5 py-3 wow fadeInUp">
          <h1>Omnes Santé</h1>
          <p class="text-grey mb-4">Votre plate-forme en ligne d'e-consultation et de prise de RDV. Vous pouvez consulter les informations
            de vos spécialistes et communiquer avec eux. Prendre un RDV avec un médecin ou un laboratoire de biologie n'a jamais été aussi facile !</p>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
          <div class="img-place custom-img-1">
            <img src="logo.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  
  <div class="page-section">
    <div class="container">
      <h1 class="text-center">Nos spécialistes</h1>
      <div id="carrousel">
      <ul class="carousel-items">

      <?php
      $sql="SELECT * from medecin";
      $result = mysqli_query($mysqli, $sql);
            //afficher le resultat


            while ($data = mysqli_fetch_assoc($result)) {



       
          echo"<li>";
            echo"<div class='item'>";

              echo"<div class='card-doctor' style='margin:80px'>";
                echo"<div class='header'>";
                  echo"<img src='./images/medecin/" . $data['IDpersonne'] . ".jpg' style='max-width: 60%' alt=''>";
                echo"</div>";
                echo"<div class='body'>";
                  echo"<p class='text-xl text-blue'>Dr. " . $data['Nom'] . "</p>";
                  echo"<span class='text-sm'>" . $data['Specialisation'] . "</span>";
                echo"</div>";
              echo"</div>";
            echo"</div>";
          echo"</li>";
        }
        ?>
        </ul>
      </div>
    </div>
  </div>
            

  <div class="page-section bg-light">
    <div class="container">
      <h1 class="text-center">Bulletin santé de la semaine</h1>
      <div class="row mt-5">
        <div class="col">
          <div class="card-blog">
            <div class="header">

              <div class="post-thumb">
                <a href="https://www.lemonde.fr/societe/article/2022/05/23/reintegrer-les-soignants-non-vaccines-combien-et-comment_6127332_3224.html" target="_blank"><img src="./images/news.jpg" alt=""></a>
              </div>
            </div>
            <div class="body">
              <h5>Réintégrer les soignants non vaccinés ?</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card-blog">
            <div class="header">
              <div class="post-thumb">
                <a href="https://www.lemonde.fr/societe/article/2022/05/20/au-moins-120-services-d-urgences-en-difficulte-avant-l-ete-du-jamais-vu_6126954_3224.html" target="_blank"><img src="./images/news.jpg" alt=""></a>
              </div>
            </div>
            <div class="body">
              <h5>120 services d'urgences font face à de graves difficultés</h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card-blog">
            <div class="header">
              <div class="post-thumb">
                <a href="https://www.lemonde.fr/planete/article/2022/05/20/variole-du-singe-un-premier-cas-d-infection-confirme-en-france_6126944_3244.html" target="_blank"><img src="./images/news.jpg" alt=""></a>
              </div>
            </div>
            <div class="body">
              <h5>Premier cas de variole du singe</h5>
            </div>
          </div>
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

            <li><a href="home.php">Accueil</a></li><br>
            <li><a href="rdv.html">Rendez-vous</a></li><br>
            <li><a href="connexion1.php">Votre Compte</a></li><br>

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