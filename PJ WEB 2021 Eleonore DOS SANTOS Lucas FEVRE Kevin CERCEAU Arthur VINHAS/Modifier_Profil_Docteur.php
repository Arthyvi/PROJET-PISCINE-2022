
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
   
    <script src="script.js"></script>

    <link rel="stylesheet" href="Modifier_Profil_Docteur.css">
    <link rel="stylesheet" href="Error.css">
    
</head>
<body>
    <div id="header">
        <h1 id="Title">Modification compte du Medecin</h1>
    </div><br>
    <div id="nav">
        <ul>
            <h2>Photo de profil: </h2>

            <img src="<?php echo "Photos Doc/".$_SESSION["IDconnected"].".jpg?m=" . filemtime('Photos Doc/'.$_SESSION["IDconnected"].'.jpg')  ?>" alt="Photo du medecin" width="400" height="300">

            <form action="changeImage.php">
                <label for="thePicture">Select a new picture :</label> 
                <input type="file" id="thePicture" accept="image/*">
            </form>
           
        
        </ul>
    </div>
    <div id="description">
        <br>
        <form action="Modifier_Profil_Doc_Activate.php" method="post">
            <fieldset>
                <br>
                <legend>INFOS MEDECIN :</legend>

                <label for="nom">Nom:</label><br>
                <input type="text" id="nom" name="nom" value="<?php echo $nom ?>" required><br><br>

                <label for="prenom">Prenom:</label><br>
                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>" required><br><br>

                <label for="spe">Specialite:</label><br>
                <input type="text" id="spe" name="spe" value="<?php echo $Specialisation ?>" required><br><br>

                <label for="phone">Tel:</label><br>
                <input type="text" id="tel" name="tel" value="<?php echo $phone ?>" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" value="<?php echo $mail ?>" required>
                <span class="messageError" id="messageErrorEmail"> &nbsp;&nbsp;&nbsp;</span><br><br>

                <label>Mot de passe:</label><br>
                <input type="text" id="mdp" name="mdp" value="<?php echo $Password ?>" required><br><br>

                <label>Confirmer le mot de passe:</label><br>
                <input type="text" id="mdp2" name="mdp2" required>
                <span class="messageError" id="messageErrorPassword"> &nbsp;&nbsp;&nbsp; Different passwords!</span><br><br>

                <input  id="btnco" type="submit" value="Modifier les informations" disabled>
            </fieldset>
         </form>
    </div>

    <div id="footer">
        Branlette Corporation
    </div>
</body>

</html>