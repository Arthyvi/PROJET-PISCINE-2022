<?php
    session_start();

    $recherche=isset($_POST["recherche"]) ? $_POST["recherche"] : "";
    $connected=substr($_SESSION['IDconnected'],0,2);

    // Connexion au serveur
$mysqli = new mysqli("localhost:3309","root","","projet piscine 2022");

// Check connection
if($mysqli -> connect_errno)
{
    echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
    exit();
}

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
  echo   '<button onclick="window.location=\'CompteAdmin.php\'" type="button" class="btn btn-primary btn-sm">Mon
        compte</button>';
  echo   '<div class="dropdown1-content">';
  echo   '<a class ="text-blue" href="MesRendezVous.php">Rendez-vous</a>';
  echo   '<a class ="text-blue" href="DeconnexionClient.php?ref=recherche.php">Deconnexion</a>';
  echo   '</div>';
  echo   '</li>';

}

?>
      </ul>
    </div> <!-- .navbar-collapse -->

  </nav>

  <div class="page-section">
    <div class="container">
      
    <?php
        $sql="SELECT * FROM medecin WHERE Nom LIKE '%".$recherche."%' OR Prenom LIKE '%".$recherche."%' OR Specialisation LIKE '%".$recherche."%'";
        if($result = $mysqli->query($sql))
        {
            if($result->num_rows >0)
            {
                echo "<h1 class='text-center'>Nos Medecins</h1><br>";
                echo "<table class='table table-hover'>";
                while($data = $result->fetch_row())
                {
                    echo "<tr>";
                    echo "<td><img src='./images/medecin/" . $data[0] . ".jpg' height='120' width='100' id='doc'>   </td>";
                    echo "<td>Dr " . $data[2] . " " . $data[1] . "  </td>";
                    echo "<td>" . $data[5] . "</td>";

                    echo "<td><button onclick='window.location=\"Reservation_Client.php?md=" . $data[0] . "\"' class='btn-sm btn-primary'>RDV</button><br><br>";
                    if($connected!="") echo "<button class='btn-sm btn-primary' onclick=window.location.href='chat.php?name=".$_SESSION['name']."&idclient=".$_SESSION['IDconnected']."&idmedecin=".$data[0]."&connected=".$connected."'>Communiquer</button><br><br>";
                    else echo "<button class='btn-sm btn-primary'>Communiquer</button><br><br>";

                    echo "<button class='btn-sm btn-primary' onclick=window.location.href='AfficherCV.php?SelectedDoc=".$data[0]."'>CV</button></td>";
                    echo "</tr>";
                }
                echo "</table><br><br>";
            }
        }

        $sql="SELECT * FROM laboratoire WHERE NomLab LIKE '%".$recherche."%'";

        if($result = $mysqli->query($sql))
        {
            if($result->num_rows >0)
            {
                echo "<h1 class='text-center'>Nos Laboratoires</h1><br>";
                echo "<table class='table table-hover'>";
                while($data = $result->fetch_row())
                {
                    echo "<tr>";
                    echo "<td><img src='./images/Labo/" . $data[0] . ".jpg' height='120' width='100' id='lab '>   </td>";
                    echo "<td>" . $data[1] . "</td>";
                    $bin=decbin($data[5]);
                    $Buffer = array();

                    if(substr($bin,5,1) == "1") $Buffer[]="Gynecologie";
                    if(substr($bin,4,1) == "1") $Buffer[]="Cancerologie";
                    if(substr($bin,3,1) == "1") $Buffer[]="Biologie de routine";
                    if(substr($bin,2,1) == "1") $Buffer[]="Biologie de la femme enceinte";
                    if(substr($bin,1,1) == "1") $Buffer[]="Biologie preventive";
                    if(substr($bin,0,1) == "1") $Buffer[]="Depistage Covid-19";

                    $services="";
                    if(count($Buffer)>0) {
                      for($i=0;$i<count($Buffer)-1;$i++) $services.=$Buffer[$i].", ";

                      $services.=$Buffer[count($Buffer)-1];
                    }
                    echo "<td>" . $services . "</td>";
                    echo "<td><button class='btn-sm btn-primary'>RDV</button><br><br>";
                    echo "<form action='Infos.php'><br><br>";
                    echo "<button class ='btn-sm btn-primary'>Infos</button></td>";
                    echo "</tr>";
                }
                if($mysqli->query("SELECT * FROM laboratoire")->num_rows>0)
                {
                  while($data = $result->fetch_row())
                  {
                      $bin=decbin($data[5]);
                      $Buffer = array();

                      if(substr($bin,5,1) == "1") $Buffer[]="Gynecologie";
                      if(substr($bin,4,1) == "1") $Buffer[]="Cancerologie";
                      if(substr($bin,3,1) == "1") $Buffer[]="Biologie de routine";
                      if(substr($bin,2,1) == "1") $Buffer[]="Biologie de la femme enceinte";
                      if(substr($bin,1,1) == "1") $Buffer[]="Biologie preventive";
                      if(substr($bin,0,1) == "1") $Buffer[]="Depistage Covid-19";

                      $services="";
                      if(count($Buffer)>0) {
                        for($i=0;$i<count($Buffer)-1;$i++) $services.=$Buffer[$i].", ";
                      }
                      $services.=$Buffer[count($Buffer)-1];
                      if(stripos($services,$recherche)) {
                        echo "<tr>";
                        echo "<td><img src='./images/Labo/" . $data[0] . ".jpg' height='120' width='100' id='lab '>   </td>";
                        echo "<td>" . $data[1] . "</td>";
                        echo "<td>" . $services . "</td>";
                        echo "<td><button class='btn-sm btn-primary'>RDV</button><br><br>";
                        echo "<form action='Infos.php'><br><br>";
                        echo "<button class ='btn-sm btn-primary'>Infos</button></td>";
                        echo "</tr>";
                      }
                    }
                  }
                }
                else {
                  if($mysqli->query("SELECT * FROM laboratoire")->num_rows>0)
                {
                  echo "<h1 class='text-center'>Nos Laboratoires</h1><br>";
                echo "<table class='table table-hover'>";
                $result=$mysqli->query("SELECT * FROM laboratoire");
                  while($data = $result->fetch_row())
                  {
                      $bin=decbin($data[5]);
                      $Buffer = array();

                      if(substr($bin,5,1) == "1") $Buffer[]="Gynecologie";
                      if(substr($bin,4,1) == "1") $Buffer[]="Cancerologie";
                      if(substr($bin,3,1) == "1") $Buffer[]="Biologie de routine";
                      if(substr($bin,2,1) == "1") $Buffer[]="Biologie de la femme enceinte";
                      if(substr($bin,1,1) == "1") $Buffer[]="Biologie preventive";
                      if(substr($bin,0,1) == "1") $Buffer[]="Depistage Covid-19";

                      $services="";
                      if(count($Buffer)>0) {
                        for($i=0;$i<count($Buffer)-1;$i++) $services.=$Buffer[$i].", ";
                        $services.=$Buffer[count($Buffer)-1];
                      }
                      if(stripos($services,$recherche)) {
                        echo "<tr>";
                        echo "<td><img src='./images/Labo/" . $data[0] . ".jpg' height='120' width='100' id='lab '>   </td>";
                        echo "<td>" . $data[1] . "</td>";
                        echo "<td>" . $services . "</td>";
                        echo "<td><button class='btn-sm btn-primary'>RDV</button><br><br>";
                        echo "<form action='Infos.php'><br><br>";
                        echo "<button class ='btn-sm btn-primary'>Infos</button></td>";
                        echo "</tr>";
                      }
                    }
                  }
                }
                echo "</table>";

            
            

            }
             $result->free_result();
        
    ?>
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
