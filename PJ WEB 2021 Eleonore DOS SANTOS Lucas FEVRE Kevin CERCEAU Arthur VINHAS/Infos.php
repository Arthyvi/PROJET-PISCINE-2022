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
            <a href="Medecin_G.php">Médecine générale</a>
            <a href="Medecin_Spe.php">Médecins spécialistes</a>
            <a href="Labo.php">Laboratoire de biologie médicale</a>
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
          echo   '<button onclick="window.location=\'Mon_Profil.php\'" type="button" class="btn btn-primary btn-sm">Mon
                compte</button>';
          echo   '<div class="dropdown1-content">';
          echo   '<a class ="text-blue" href="MesRendezVous.php">Rendez-vous</a>';
          echo   '<a class ="text-blue" href="DeconnexionClient.php?ref=infos.php">Deconnexion</a>';
          echo   '</div>';
          echo   '</li>';

        }

        ?>

      </ul>
    </div> <!-- .navbar-collapse -->
  </nav>

 

  <div class="page-section pb-0">
    <div class="container">
      <div class="row">
        <div class="col">
        <h2 class="text-center">Depistage Covid-19</h2><br>
          <p class="text-grey font-weight-bold">Afin de maintenir un accès facilité au dépistage pour les personnes symptomatiques ou contact à risque, continuent à bénéficier d’une prise en charge les personnes :</p>
          <table>
            <tr><p class="text-grey">- ayant un schéma vaccinal complet ou une contre-indication à la vaccination</p></tr>
            <tr><p class="text-grey">- mineures</p></td>
            <tr><p class="text-grey">- présentant une prescription médicale</p></tr>
            <tr><p class="text-grey">- ayant un certificat de rétablissement de moins de six mois</p></tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="page-section pb-0">
    <div class="container">
      <div class="row">
        <div class="col">
        <h2 class="text-center">Biologie Preventive</h2><br>
          <p class="text-grey mb-4">Votre plate-forme en ligne d'e-consultation et de prise de RDV. Vous pouvez consulter les informations
            de vos spécialistes et communiquer avec eux. Prendre un RDV avec un médecin ou un laboratoire de biologie n'a jamais été aussi facile !</p>
        </div>
      </div>
    </div>
  </div>

  <div class="page-section pb-0">
    <div class="container">
      <div class="row">
        <div class="col">
        <h2 class="text-center">Biologie de la femme enceinte</h2><br>
          <p class="text-grey mb-4">Jeûne strict, ne rien absorber pas même un verre d’eau : gastrine, test respiratoire pour la recherche d’Helicobacter pylori (ne pas fumer)</p>
        </div>
      </div>
    </div>
  </div>

  <div class="page-section pb-0">
    <div class="container">
      <div class="row">
        <div class="col">
        <h2 class="text-center">Biologie  de routine</h2><br>
          <p class="text-grey mb-4">Jeûne de 12 heures sans absorber ni aliments solides ni liquides (un verre d’eau est toléré) : bilan lipidique, glycémie, bilan ferrique, cryoglobuline, testostérone biodisponible, cross-laps</p>
        </div>
      </div>
    </div>
  </div>

  <div class="page-section pb-0">
    <div class="container">
      <div class="row">
        <div class="col">
        <h2 class="text-center">Gynecologie</h2><br>
          <p class="text-grey mb-4">Spécialité médicale qui s’occupe de la physiologie et des affections du système génital féminin. Le gynécologue conseille également sur les moyens de contraception, la sexualité et la fertilité. Les pathologies souvent traitées sont les mycoses, les infections urinaires, les douleurs et troubles des règles, les problèmes de fécondité, le suivi de grossesse, les polypes…</p>
        </div>
      </div>
    </div>
  </div>

  <div class="page-section pb-0">
    <div class="container">
      <div class="row">
        <div class="col">
        <h2 class="text-center">Cancerologie</h2><br>
          <p class="text-grey mb-4">Le dépistage, lorsqu'il est possible, consiste en la réalisation d’examens alors que le patient se sent en bonne santé et ne ressent aucun symptôme. Il permet de détecter une lésion dite « précancéreuse » et d’agir préventivement pour éviter son évolution vers un cancer. Nous pouvons ainsi détecter des lésions précancéreuses pour le cancer du col de l'utérus, le cancer colorectal, ou certains cancers cutanés</p>
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
          <li><a href="home.php">Accueil</a></li><br>
            <li><a href="rdv.html">Rendez-vous</a></li><br>
            <li><a href=
            <?php

if( $_SESSION["IDconnected"] == "" ) echo "connexion1.php";
else echo  "Mon_Profil.php";

?>
            >Votre Compte</a></li><br>
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