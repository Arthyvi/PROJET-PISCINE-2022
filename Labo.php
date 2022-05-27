<?php
// Start the session
session_start();
?>

<!DOCTYPE html>

<head>
  <Title>OMNES SANTE</Title>
  <meta charset="uft-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="script.js"></script>
  <link rel="stylesheet" href="boot.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<?php
// Set session variables (variables globales)
$_SESSION["doc"] = "";
?>


<?php
// Connexion au serveur
$mysqli = new mysqli("localhost:3306", "root", "", "projet");

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
          <a class="btn btn-primary" href="connexion.html">Votre Compte</a>
        </li>
      </ul>
    </div> <!-- .navbar-collapse -->
  </nav>

 

  <div class="page-section">
    <div class="container">
      <h1 class="text-center">Nos Laboratoires</h1><br>



      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="row">

            <?php

            $sql = "SELECT * from laboratoire";

            $result = mysqli_query($mysqli, $sql);
            //afficher le resultat


            while ($data = mysqli_fetch_assoc($result)) {

              echo "<div class='col-lg-4 py-3 wow zoomIn'>";
              echo "<div class='card-doctor'>";
              echo "<div class='header'>";
              echo "<img src='./images/labo/" . $data['IDlabo'] . ".jpg' style='max-width: fit-content' alt=''>";
              echo "<div class='meta'>";
              echo "<button class='btn-sm btn-primary'>RDV</button>";
              echo"<form action='Infos.php'>";
              echo "<button class ='btn-sm btn-primary'>Infos</button>";
              echo"</form>";
              echo "</div>";
              echo "</div>";

              echo "<div class='body'>";
              echo "<p class='text-xl mb-0 text-blue'>" . $data['NomLab'] . "</p>";
              
              echo "<div><span class='fa fa-phone text-sm text-grey'>&nbsp" . $data['NumTelephone'] . "</span></div>";
              echo "<div><span class='fa fa-envelope text-sm text-grey'>&nbsp" . $data['Mail'] . "</span></div>";
              echo "<div><span class='fa fa-map-marker text-sm text-grey'>&nbsp" . $data['Salle'] . "</span></div>";
              echo "<span class='text-sm text-grey'>" . $data['ServicesProposer'] . "</span>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

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


</footer>


</html>