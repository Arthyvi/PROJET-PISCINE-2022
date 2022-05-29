<?php
    // Start the session
    session_start();

     // Connexion au serveur
     $mysqli = new mysqli("localhost:3309","root","","projet piscine 2022");

     // Check connection
     if($mysqli -> connect_errno)
     {
         echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
         exit();
     }
     else
     {
          // Recupère toutes les information de la personne
        $BuffNameTable = "administrateur";
        $BuffID = $_SESSION["IDconnected"];
        $sql = "SELECT * FROM  $BuffNameTable WHERE IDpersonne = '$BuffID'";   
        
        if($result = $mysqli->query($sql))
        {
            
            if($result->num_rows >0)
            {
                $row = $result->fetch_row();

                $nom= $row[1];
                $prenom= $row[2];
            }

            $result->free_result();
        }

        $sql = "SELECT * FROM  identifiant WHERE IDpersonne = '$BuffID'";   
        
        if($result = $mysqli->query($sql))
        {
            
            if($result->num_rows >0)
            {
                $row = $result->fetch_row();

                $mail= $row[0];
            }

            $result->free_result();
        }
        
        }

?>

<!DOCTYPE html>

<head>
    <title>OMNES SANTE</title>
    <meta charset="uft-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Administrateur.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">

    <div id="barre" style="height:70px">
        <h2 style="float:left;margin-left:42%;  ">  <b> Administrator </b></h2>
        <button onclick="window.location='Administrateur.html'" type="button" class="btn btn-secondary btn-sm" style="margin-top: 1.3%; margin-left: 20%; margin-right: 3%;">Home</button>
        <button onclick="window.location='Deconnexion.php'" type="button" class="btn btn-secondary btn-sm" style="margin-top: 1.3%;">Deconnexion</button>
    </div>

    <div style="background-color:white;height:35px;">
        <span style="padding-left:42%;font-size:large;">(Compte Admin actuel)</span>
    </div>


    </div>
    
        <div id="description">
        <br>
             <fieldset>
                <br>
                <legend>INFOS ADMIN :</legend>
                <label for="nom">Nom: </label>
                <span class="InfoStyle"><?php echo $nom ?></span><br><br><br>

                <label for="prenom">Prenom: </label>
                <span class="InfoStyle"><?php echo $prenom ?></span><br><br><br>

                   <label for="email">Email: </label>
                <span class="InfoStyle"><?php echo $mail ?></span><br><br><br>

              
            </fieldset>

        </div>

        <div id="footer">
            Branlette Corporation
        </div>

    </div>

  
</div>
</body>