<?php 

//// Page pour afficher le profil du medecin connecter !!!! ////

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();


/// Recupération des données dans la base de donnée en fonction de l'ID enregistré l'ors de la connexion
// Connexion au serveur
$mysqli = new mysqli("localhost:3306","root","","projet piscine 2022");

// Check connection
if($mysqli -> connect_errno)
{
    echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
    exit();
}
else
{
    // Recupère toutes les information du docteur selecionner
    $BuffNameTable = "medecin";
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


    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}

?>


<!DOCTYPE html>
<html>

<head>
    
    <Title>OMNES (MEDECIN PART)</Title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="Administrateur.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">

        <div id="barre" style="height:70px">
            <h2 style="float:left;margin-left:42%;  ">  <b> DOCTEUR :</b></h2>
            <button onclick="window.location='Profil_Medecin.php'" type="button" class="btn btn-secondary btn-sm" style="margin-top: 1.3%; margin-left: 20%; margin-right: 3%;">Mon compte</button>
            <button onclick="window.location='Deconnexion.php'" type="button" class="btn btn-secondary btn-sm" style="margin-top: 1.3%;">Deconnexion</button>
        </div>

    <div style="background-color:white;height:35px;">
        <span style="padding-left:40%;font-size:large;">(Connected) <?php echo $prenom ?>  <?php echo $nom ?> :</span>
    </div>
    
        <div id="description">
                
            <button onclick="window.location='choix_medecin_Administrator.php'" style="margin-top: 5%;">Dossier Medical</button><br><br><br>
            <button onclick="window.location='chat.php?name=<?php echo $prenom ?>&idclient=CL-00001&idmedecin=<?php echo $BuffID ?>&connected=MD'">Chat</button>

        </div>

    </div>
</body>

</html>