
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
    // Recupère toutes les information du docteur selecionner
    $BuffNameTable = "medecin";
    $BuffID = $_SESSION["SelectedDoc"];
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

    //// Recupération des données du CV depuis le fichier XML des CV medecin
    // Variable forcé d'etre présente
    $Langue2 = "";
    $Langue3 = "";
    // Traitement
    $dom = new DOMDocument();

    $dom->validateOnParse = true;
    $dom->load('Mes CV/CVmedecin.xml');
  
    $root = $dom->documentElement;

    $results = $root->getElementsByTagName( 'DocteurCV' );
    foreach( $results  as $result){
      if($result->getAttribute('id') == $BuffID)
      {
        foreach( $result->getElementsByTagName('presentation') as $Biff ){
            $presentation = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('formation') as $Biff ){
            $formation = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Langue1') as $Biff ){
            $Langue1 = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Langue2') as $Biff ){
            $Langue2 = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Langue3') as $Biff ){
            $Langue3 = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('experience') as $Biff ){
            $experience = $Biff->nodeValue;
        }

      }
    }

    // Buffer pour la specialité du medecin pour pas recharger
    $_SESSION["SpeDoc"] = $Specialisation;

  
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

            <img id="TheImage" src="<?php echo "images/medecin/".$BuffID.".jpg?m=" . filemtime('images/medecin/'.$BuffID.'.jpg')  ?>" alt="Photo du medecin" width="400" height="300">

            <label for="image_uploads" style="color:blue;" >  Select a new picture : </label> 
        
        </ul>
    </div>
    <div id="description">
        <br>
        <form action="Modifier_Profil_Doc_Activate.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <div id="DocInfo" style="float:left;width:60%;">
                
                <legend>INFOS MEDECIN :</legend>

                <label for="nom">Nom:</label><br>
                <input type="text" id="nom" name="nom" value="<?php echo $nom ?>" required><br><br>

                <label for="prenom">Prenom:</label><br>
                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>" required><br><br>

                <label for="spe">Specialite:</label><br>
                <select name="spe" id="spe"  required>
                    <option value="none" selected disabled hidden><?php echo $Specialisation ?></option>
                    <option value="Generaliste">Generaliste</option>
                    <option value="Addictologue">Addictologue</option>
                    <option value="Andrologue">Andrologue</option>
                    <option value="Cardiologue">Cardiologue</option>
                    <option value="Dermatologue">Dermatologue</option>
                    <option value="Gastro-Hepato-Enterologue">Gastro-Hepato-Enterologue</option>
                    <option value="Gynecologue">Gynecologue</option>
                    <option value="Specialiste I.S.T">Specialiste I.S.T</option>
                    <option value="Osteopathe">Osteopathe</option>
                </select> <br><br>

               <!-- <input type="text" id="spe" name="spe" value="<?php //echo $Specialisation ?>" required><br><br> -->

                <label for="tel">Tel:</label><br>
                <input type="text" id="tel" name="tel" value="<?php echo $phone ?>" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" value="<?php echo $mail ?>" required>
                <span class="messageError" id="messageErrorEmail"><br> &nbsp;&nbsp;&nbsp;</span><br><br>

                <label>Mot de passe:</label><br>
                <input type="text" id="mdp" name="mdp" value="<?php echo $Password ?>" required><br><br>

                <label>Confirmer le mot de passe:</label><br>
                <input type="text" id="mdp2" name="mdp2" required>
                <span class="messageError" id="messageErrorPassword"><br> &nbsp;&nbsp;&nbsp; Different passwords!</span><br><br>

                <!--Le input pour l'image, qui est rendu invisible dans le script en bas, mais qui est quand meme
                dans le forme pour pouvoir s'activer et prendre les valeurs lorsque l'on appuie sur le bouton 'modifier' -->
                <input type="file" id="image_uploads" name="image_uploads" accept="image/*">

                </div>

                <div id="CVinfo">
                  <legend>CV Informations :</legend>
                  <br>

                  <label for="presentation">Presentation:</label><br>
                  <textarea id="presentation" name="presentation" rows="3" cols="35" name="text" placeholder="Enter text"  required><?php echo $presentation ?></textarea><br><br>

                  <label for="formation">Formation:</label><br>
                  <textarea id="formation" name="formation" rows="5" cols="35" name="text" placeholder="Enter text" required><?php echo $formation ?></textarea><br><br>

                  <label>Langues parlees:</label><br>

                  <input type="text" id="Langue1" name="Langue1" value="<?php echo $Langue1 ?>" required><br><br>
                  <input type="text" id="Langue2" name="Langue2"  value="<?php echo $Langue2 ?>"><br><br>
                  <input type="text" id="Langue3" name="Langue3"  value="<?php echo $Langue3 ?>"><br><br>

                  <label for="experience">Experience:</label><br>
                  <textarea id="experience" name="experience" rows="3" cols="35" name="text" placeholder="Enter text" required><?php echo $experience ?></textarea><br><br>

                  </div>
                
                  <input style="margin-left:40%;"  id="btnco" type="submit" value="Modifier les informations" disabled>
            </fieldset>
         </form>
    </div>


   <!-- Script inspiré d'un code trouvé sur internet pour la gestion et l'affichage automatique des images
   selectionné, lien : https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input/file#accept
    Permet de  d'associer un eventlistener au changement d'image --> 
    <script>
    const input = document.getElementById('image_uploads');

    input.style.opacity = 0;

  
    input.addEventListener('change', updateImageDisplay);

    function updateImageDisplay() {

      const curFiles = input.files;
      if(curFiles.length === 0) {
        
        alert('No file selected for upload');

      } else {
     
        for(const file of curFiles) {
      
          if(validFileType(file)) 
          {
            temporaryUrl =  URL.createObjectURL(file);
            //alert(temporaryUrl);

            document.getElementById("TheImage").src = temporaryUrl;
           
          } 
          else 
          {
            alert('Not a valid file type. Select another one.');
            listItem.appendChild(para);
          }

          break;

        }
      }
    }

// https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types
    const fileTypes = [
        'image/apng',
        'image/bmp',
        'image/gif',
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/svg+xml',
        'image/tiff',
        'image/webp',
        `image/x-icon`
    ];

    function validFileType(file) {
      return fileTypes.includes(file.type);
    }


  </script>
</body>

</html>