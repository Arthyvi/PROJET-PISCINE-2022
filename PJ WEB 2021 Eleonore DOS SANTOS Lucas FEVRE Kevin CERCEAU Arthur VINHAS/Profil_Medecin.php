
<?php 

//// Page pour afficher le profil du medecin connecter !!!! ////

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();


/// Recupération des données dans la base de donnée en fonction de l'ID enregistré l'ors de la connexion
// Connexion au serveur
$mysqli = new mysqli("localhost","root","","projet piscine 2022");

// Check connection
if($mysqli -> connect_errno)
{
    echo "Failed to connect to MySQL" . $mysqli -> connect_errno;
    exit();
}
else
{
    // Recupère toutes les information de la personne
    $BuffNameTable = $_SESSION["NameTable"];
    $BuffID = $_SESSION["IDconnected"];
    $sql = "SELECT * FROM  $BuffNameTable WHERE IDpersonne = '$BuffID'";   
    
    if($result = $mysqli->query($sql))
    {
        
        if($result->num_rows >0)
        {
            $row = $result->fetch_row();

            $nom= $row[1];
            $prenom= $row[2];
            $Password= $row[3];
            $phone= $row[4];
            $Specialisation = $row[5];
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

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}

 ?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="Profil_Medecin.css">
    
</head>
<body>
    <div id="header">
        <h1>Compte du Medecin</h1>
    </div><br>
    <div id="nav">
        <ul>
            <h2>Photo de profil: </h2>

            <img src="<?php echo "images/medecin/".$_SESSION["IDconnected"].".jpg?m=" . filemtime('images/medecin/'.$_SESSION["IDconnected"].'.jpg')  ?>" alt="Photo du medecin" width="400" height="300">
        </ul>
    </div>
   
    <div id="description">
        <br>
             <fieldset>
                <br>
                <legend>INFOS MEDECIN :</legend>
                <label for="nom">Nom:</label><br>
                <span class="InfoStyle"><?php echo $nom ?></span><br><br><br>

                <label for="prenom">Prenom:</label><br>
                <span class="InfoStyle"><?php echo $prenom ?></span><br><br><br>

                <label for="spe">Specialite:</label><br>
                <span class="InfoStyle"><?php echo $Specialisation ?></span><br><br><br>
                
                <label for="email">Email:</label><br>
                <span class="InfoStyle"><?php echo $mail ?></span><br><br><br>

                <label>tel:</label><br>
                <span class="InfoStyle"><?php echo $phone ?></span><br><br><br>
            
                <label for="mdp">Mot de passe:</label><br>
                <span class="InfoStyle"><?php echo $Password ?></span><br><br>

            </fieldset>
    </div>

    <div id="footer">
        Branlette Corporation
    </div>
</body>

</html>