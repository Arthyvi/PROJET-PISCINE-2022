<?php
// Start the session
session_start();

$id=$_SESSION['IDconnected']


?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">

  <title>DOcMNES</title>
  <link rel="stylesheet" href="boot.css">
  <link rel="stylesheet" href="carousel.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

</head>

<?php
// Connexion au serveur
$mysqli = new mysqli("localhost:3306", "root", "", "projet piscine 2022");

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
            <a href="Medecin_G.php">Médecine générale</a>
            <a href="Medecin_Spe.php">Médecins spécialistes</a>
            <a href="Labo.php">Laboratoire de biologie médicale</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.html">Rendez-vous</a>
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
  echo   '<a class ="text-blue" href="DeconnexionClient.php?ref=Medecin_Spe.php">Deconnexion</a>';
  echo   '</div>';
  echo   '</li>';

}

?>
      </ul>
    </div> <!-- .navbar-collapse -->

  </nav>

  <br>
  <h1 style='text-align:center'>Mon Profil Client</h1><br><br>
  <?php
    //echo "<img src='./images/client/".$id.".jpg' width=200 height=300 style='position:absolute;left:5%' ></img>";
    $sql="SELECT * from client WHERE IDpersonne='".$id."'";
    $mail="SELECT * FROM identifiant WHERE IDpersonne='".$id."'";
    $mail=$mysqli->query($mail)->fetch_row()[0];
    if($result=$mysqli->query($sql))
    {
        if($result->num_rows>0) 
        {
            $data=$result->fetch_row();
            echo "<table style='margin-left:auto;margin-right:auto'>";
            echo "<tr><td><h3>".$data[2]." ".$data[1]."</h3></td></tr>";
            echo "<tr><td>Adresse : </td><td>".$data[3].", ".$data[6].", ".$data[5].", ".$data[7]."<br>          ".$data[4]."</td></tr>";
            echo "<tr><td>Numero de telephone : </td><td>+33".$data[8]."</td></tr>";
            echo "<tr><td>Adresse mail : </td><td>".$mail."</td></tr>";
            echo "<tr><td>Numero de securite sociale : </td><td>".$data[9]."</td></tr>";
            echo "<tr><td><br><button onclick=window.location.href='modif_profil.php' class='btn btn-primary btn-sm' >Modifier mes informations</button></td></tr>";
            echo "</table></p><br>";
        }
    }

  ?>

  <br><br><br>
  
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