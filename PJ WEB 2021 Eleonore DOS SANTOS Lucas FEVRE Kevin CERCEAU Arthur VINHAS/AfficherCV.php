<?php 

//// Page pour afficher le profil du medecin connecter !!!! ////

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
    session_start();

    //$BuffID = "MD-00004";
    if($_SESSION["SelectedDoc"]!="") 
    {
        $BuffID = $_SESSION["SelectedDoc"];
        $connected = 'MD';
    }
    else {
        $BuffID = $_GET['SelectedDoc'];
        $connected = 'CL';
    }

    //// Recupération des données du CV depuis le fichier XML des CV medecin
    // Variable forcé d'etre présente
    $Langue2 = "";
    $Langue3 = "";
    // Traitement
    $dom = new DOMDocument();

    $dom->validateOnParse = true;
    $dom->load('Mes CV/CVmedecin.xml');
  
    $root = $dom->documentElement;

    $LangueParler = "";

    $results = $root->getElementsByTagName( 'DocteurCV' );
    foreach( $results  as $result){
      if($result->getAttribute('id') == $BuffID)
      {

        foreach( $result->getElementsByTagName('Nom') as $Biff ){
            $Nom = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Prenom') as $Biff ){
            $Prenom = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Telephone') as $Biff ){
            $Telephone = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Mail') as $Biff ){
            $Mail = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Specialisation') as $Biff ){
            $Specialisation = $Biff->nodeValue;
        }


        foreach( $result->getElementsByTagName('presentation') as $Biff ){
            $presentation = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('formation') as $Biff ){
            $formation = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Langue1') as $Biff ){
            $Langue1 = $Biff->nodeValue;
            $LangueParler =  $LangueParler.$Langue1;
        }

        foreach( $result->getElementsByTagName('Langue2') as $Biff ){
            $Langue2 = $Biff->nodeValue;
            $LangueParler =  $LangueParler."<br> - ". $Langue2;
        }

        foreach( $result->getElementsByTagName('Langue3') as $Biff ){
            $Langue3 = $Biff->nodeValue;
            $LangueParler =  $LangueParler."<br> - ". $Langue3;
        }

        foreach( $result->getElementsByTagName('experience') as $Biff ){
            $experience = $Biff->nodeValue;
        }

      }
    }


 ?>


<!DOCTYPE html>

<head>
    <title>OMNES SANTE</title>
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
            echo   '<button onclick="window.location=\'Mon_Profil.php\'" type="button" class="btn btn-primary btn-sm">Mon
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
    <div class="container" >

    <!--Boutton retour -->
        <?php
    //if($connected=='CL' || $connected='') echo "<button onclick=window.location='home.php' type='button' class='btn btn-secondary btn-sm' style=' margin-top: 1.3%; margin-left:12%; padding:1%; '>Retour</button>";
    //else echo "<button onclick=window.location='Medecin_Personnel.php' type='button' class='btn btn-secondary btn-sm' style=' margin-top: 1.3%; margin-left:12%; padding:1%; '>Retour</button>";
?>
        <br>

        <div style="background-color: white; width: 70%; margin-left:15%; margin-bottom:5%;">
            
            <img style=" margin-left:4%; margin-top:4%;margin-bottom:4%;" id="TheImage" src="<?php echo "images/medecin/".$BuffID.".jpg?m=" . filemtime('images/medecin/'.$BuffID.'.jpg')  ?>" alt="Photo du medecin" width="300" height="200">

            <h1 style="float:right;margin-right:30%; margin-top:4%;">Dr.<?php echo $Prenom?> <?php echo $Nom?> <br> <span style="font-size:large;"><?php echo $Specialisation?></span><br> <span style="font-size:large;">Mail : <?php echo $Mail?></span><br> <span style="font-size:large;">Tel : +33<?php echo $Telephone?></span></h1>
  
            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Presentation : </span>
            <p style="margin-left:4%;font-size:medium;"><?php echo $presentation?></p>

            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Formation : </span>
            <p style="margin-left:4%;font-size:medium;"> - <?php echo $formation?></p>

            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Langues parlées : </span>
            <p style="margin-left:4%;font-size:medium;"> - <?php echo $LangueParler?></p>

            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Experience : </span>
            <p style="margin-left:4%;font-size:medium; padding-bottom:5%;"> - <?php echo $experience?></p>

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
    </div>
  </footer>
