<?php
// Start the session
session_start();


if($_SESSION["IDconnected"] == "")
{
     // Renvoi à la page de connexion
     header("Location: connexion1.php");
     return;
}


$BuffID = isset($_GET["md"]) ? $_GET["md"] : "";

// Initialisation tableau pour les couleurs des cases
$CaseColor = array_fill(1, 10, array_fill(1,6,"green"));

// Connexion au serveur
$mysqli = new mysqli("localhost:3306", "root", "", "projet piscine 2022");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL" . $mysqli->connect_errno;
    exit();
}
else
{

     // Recupère tout les rendez-vous du docteur selectionner pour avoir les créneaux disponible
     $sql = "SELECT * FROM  `rdvlabo-client` WHERE IDlabo = '$BuffID'";   
     
     if($result = $mysqli->query($sql))
     {
         if($result->num_rows >0)
         {
            while($row = $result->fetch_row())
            {
                $CaseColor[intval($row[3])][intval($row[2])] = "grey";

            }
            
         }
 
         $result->free_result();
     }

     // recupère la services proposé pour ce labo
    $BuffNameTable = "laboratoire";
    $sql = "SELECT * FROM  $BuffNameTable WHERE IDlabo = '$BuffID'"; 
    
    //Initialisation valeur services.
    $Depistage= "";
    $BiologieP= "";
    $BiologieEnceinte= "";
    $BiologieRoutine= "";
    $Cancerologie= "";
    $Gynecologie= "";

    // Execution sql
    if($result = $mysqli->query($sql))
    {
        
        if($result->num_rows >0)
        {
            $row = $result->fetch_row();

            $Services = intval($row[5]);

            if ($Services >= 32)
            {
                $Depistage= "checked";
                $Services = $Services - 32; 
            }

            if ($Services >= 16)
            {
                $BiologieP= "checked";
                $Services = $Services - 16; 
            }

            if ($Services >= 8)
            {
                $BiologieEnceinte= "checked";
                $Services = $Services - 8; 
            }

            if ($Services >= 4)
            {
                $BiologieRoutine= "checked";
                $Services = $Services - 4; 
            }

            if ($Services >= 2)
            {
                $Cancerologie= "checked";
                $Services = $Services - 2; 
            }

            if ($Services >= 1)
            {
                $Gynecologie= "checked";
            }

        }

        $result->free_result();
    }

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
 
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

    <div class="container">

        <?php

          echo '<select style="margin-left:37%;margin-top:3%;" name="service" id="service"  required>';
          echo '<option value="nope" selected disabled hidden>Select service</option>';
        
            if($Depistage == "checked")
            {
                echo '<option value="Depistage-covid-19">Depistage covid 19</option>';
            }

            if($BiologieP == "checked")
            {
                echo '<option value="Biologie-preventive">Biologie preventive</option>';

            }

            if($BiologieEnceinte == "checked")
            {
                echo '<option value="Biologie-de-la-femme-enceinte">Biologie de la femme enceinte</option>';
            }

            if($BiologieRoutine == "checked")
            {
                echo '<option value="Biologie-de-routine">Biologie de routine</option>';
            }

            if($Cancerologie == "checked")
            {
                echo '<option value="Cancerologie">Cancerologie</option>';
            }

            if($Gynecologie == "checked")
            {
                echo '<option value="Gynecologie">Gynecologie</option>';
            }
          

          echo '</select>';


        ?>

       


        <div class="col">
            <div class="row justify-content-center align-items-center">

                <table class="table table-primary table-bordered table-hover table-sm" style="margin-top:3%">

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
                            echo '<td> <div id="'.$j.'-1" onclick="Reserver(\''.$j.'-1\')" style="background-color: '.$CaseColor[$j][1].';">&nbsp;&nbsp;&nbsp;</div> </td>';
                            echo '<td> <div id="'.$j.'-2" onclick="Reserver(\''.$j.'-2\')" style="background-color: '.$CaseColor[$j][2].';">&nbsp;&nbsp;&nbsp;</div> </td>';
                            echo '<td> <div id="'.$j.'-3" onclick="Reserver(\''.$j.'-3\')" style="background-color: '.$CaseColor[$j][3].';">&nbsp;&nbsp;&nbsp;</div> </td>';
                            echo '<td> <div id="'.$j.'-4" onclick="Reserver(\''.$j.'-4\')" style="background-color: '.$CaseColor[$j][4].';">&nbsp;&nbsp;&nbsp;</div> </td>';
                            echo '<td> <div id="'.$j.'-5" onclick="Reserver(\''.$j.'-5\')" style="background-color: '.$CaseColor[$j][5].';">&nbsp;&nbsp;&nbsp;</div> </td>';
                            echo '<td> <div id="'.$j.'-6" onclick="Reserver(\''.$j.'-6\')" style="background-color: '.$CaseColor[$j][6].';">&nbsp;&nbsp;&nbsp;</div> </td>';
                            
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

                </table>   
                <a href="Paiement.html"><button onclick="AccepterRDVlabo('<?php echo $_SESSION['IDconnected']?>','<?php echo $BuffID ?>')" class="btn-sm btn-primary float-right" style="margin-bottom:10%" >Confirmer mon choix de RDV</button></a>
                
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
