<?php
    session_start();

    $_SESSION['name'] = stripslashes(htmlspecialchars($_GET['name']));
    // Connexion au serveur
    $mysqli = new mysqli("localhost:3309","root","","projet piscine 2022");

    // Check connection
    if($mysqli -> connect_errno)
    {
        echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
        exit();
    }
        $idclient=$_GET['idclient'];
        $idmedecin=$_GET['idmedecin'];
        $connected=$_GET['connected'];

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <title>Chatroom</title>
        <link rel="stylesheet" href="chat.css">
        <script src="script.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="script.js"></script>
        <link rel="stylesheet" href="boot.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

        <!--Pour ajouter une icone : https://fr.w3docs.com/snippets/css/comment-utiliser-et-styler-des-icones-avec-css-un-guide-ultime.html#:~:text=Afin%20d%27utiliser%20des%20ic%C3%B4nes%20pour%20votre%20site%20web%2C,son%20code%20HTML.%20...%203%20Styler%20Votre%20Ic%C3%B4nes-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>
 
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="#"><img src="omnes.png" width="150" alt=""></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent"
      aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
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
        <li class="dropdown1">
            <button onclick="window.location=\'Mon_Profil.php\'" type="button" class="btn btn-primary btn-sm">Votre Compte</button>
            <div class="dropdown1-content">
                <a class ="text-blue" href="DeconnexionClient.php?ref=Medecin_Ad.php">Deconnexion</a>
            </div>
        </li>
      </ul>
    </div> <!-- .navbar-collapse -->
<?php
if($connected=='MD') {
            echo "<div class='leftbar'>";
            echo "<iframe src='chats_deroulants.php?idclient=".$idclient."&idmedecin=".$idmedecin."' height='795px' style='border:none'></iframe>";
            echo "</div>";
        }
?>
  </nav>
        <div id="wrapper" style="margin-left:auto;margin-right:auto;margin-top:3%;">
            <div id="menu">
                <p class="welcome">Bienvenue, <b><?php echo $_SESSION['name']; ?></b></p>
                <a href="https://teams.microsoft.com/l/meetup-join/19:meeting_ODA2ZjlmMWItZDcyYi00OGNkLWJkYTMtOGM1ZTdkZjNlMzdk@thread.v2/0?context=%7B%22Tid%22:%22a2697119-66c5-4126-9991-b0a8d15d367f%22,%22Oid%22:%22305dbfdf-f491-4249-aca8-288ef4b76bf9%22%7D" target="_blank" rel="noopener noreferrer"><i style="float:right" class="fas fa-phone fa-2x"></i></a>
            </div>
        <div id="chatbox">

 <?php
 
    $data="chat-clientmedecin";
    //$result = mysqli_query($mysqli, "SELECT * FROM chat-clientmedecin WHERE IDclient='" . $idclient . "'" . " AND IDmedecin='" . $idmedecin . "'");
    $sql="SELECT * FROM `chat-clientmedecin`  WHERE IDclient='" . $idclient . "'" . " AND IDmedecin='" . $idmedecin . "'";
    $nomclient = "SELECT * FROM client WHERE IDpersonne='" . $idclient . "'";
    $nomclient = $mysqli->query($nomclient);
    $nomclient = $nomclient->fetch_row()[2];
    //$nomclient = mysqli_fetch_assoc($nomclient);
    $nommedecin = "SELECT * FROM medecin WHERE IDpersonne='" . $idmedecin . "'";
    $nommedecin = $mysqli->query($nommedecin);
    $nommedecin = $nommedecin->fetch_row()[2];
    //echo $nomclient->fetch_row()[2]." ".$nommedecin->fetch_row()[2];
    //$nommedecin = mysqli_fetch_assoc($nommedecin);
    /*while ($data = mysqli_fetch_assoc($result)) {
        echo "<div class='msgln'>";
        if($data['IDmessage'].substr(0,2)=="CL") echo "<b class='username'>" . $nomclient . "</b>" . $data['message'] . "<br>";
        else echo "<b class='username'>" . $_SESSION['name'] . "</b>" . $data['message'] . "<br>";
        echo "</div>";
    }*/
    if($result = $mysqli->query($sql))
    {
        if($result->num_rows >0)
        {
            while($data = $result->fetch_row())
            {
                if(substr($data[0],0,2)==$connected) 
                {
                    $color="blue";
                    $float="right";
                }
                else 
                {
                    $color="black";
                    $float="left";
                }
                echo "<div class='msgln' style='text-align:".$float."'>";
                if(substr($data[0],0,2)=="CL") echo "<b style='color:".$color."' class='username'>" . $nomclient. " </b>" . $data[2] . "<br>";
                else echo "<b style='color:".$color."' class='username'>" . $nommedecin . " </b>" . $data[2] . "<br>";
                echo "</div>";
            }
        }
        $result->free_result();
    }
 ?>
 </div>
    <form name="message" action="post.php"> <!--chat.php?-->
        <input name="usermsg" type="text" id="usermsg" />
        <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer"/>
        <input name="connected" type="hidden" id="connected" value="<?php echo $connected;?>"/>
        <input name="idclient" type="hidden" id="idclient" value="<?php echo $idclient;?>"/>
        <input name="idmedecin" type="hidden" id="idmedecin" value="<?php echo $idmedecin;?>"/>
        <input name="name" type="hidden" id="name" value="<?php echo $_SESSION['name'];?>"/>
    </form>
 </div>

 <?php
 //   if($connected=='CL' || $connected='') echo "<button onclick=window.location='home.php' type='button' class='btn btn-secondary btn-sm' style=' margin-top: 1.3%; margin-left:12%; padding:1%; '>Retour</button>";
 //   else echo "<button onclick=window.location='Medecin_Personnel.php' type='button' class='btn btn-secondary btn-sm' style=' margin-top: 1.3%; margin-left:12%; padding:1%; '>Retour</button>";
?>
 

 </body>
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
