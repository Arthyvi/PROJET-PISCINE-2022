
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
    $BuffNameTable = "laboratoire";
    $BuffID = $_SESSION["SelectedLab"] ;
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

            $nom= $row[1];
            $Salle= $row[2];
            $mail = $row[3];
            $phone= $row[4];

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

 ?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="Modifier_Profil_Docteur.css">
    
</head>
<body>
    <div id="header">
        <h1 id="Title">Modifier Laboratoire</h1>
    </div><br>
    <div id="nav">
        <ul>
            <h2>Photo du Labo : </h2>

            <img id="TheImage2" src="<?php echo "images/Labo/".$BuffID.".jpg?m=" . filemtime('images/Labo/'.$BuffID.'.jpg')  ?>" alt="Photo du Laboratoire" width="400" height="300">

            <br>
            <label for="image_uploads" style="color:blue;" >  Select a new picture : </label> 
        </ul>
    </div>
    <div id="description">
        <br>
        <form  action="Modifier_Profil_Labo_Activate.php" method="post" enctype="multipart/form-data">
            <fieldset>

                  <legend >INFOS LABORATOIRE :</legend>
                  <br>

                  <label   for="nom">Nom:</label><br>
                  <input  type="text" id="nom" name="nom" value="<?php echo $nom ?>" required><br><br>

                  <label  for="Salle">Salle:</label><br>
                  <input  type="text" id="Salle" name="Salle" value="<?php echo $Salle ?>"  required><br><br>

               
                  <label  for="phone">Tel:</label><br>
                  <input  type="text" id="tel" name="tel" value="<?php echo $phone ?>"  required><br><br>

                  <label  for="email">Email:</label><br>
                  <input  type="email" id="email" name="email" value="<?php echo $mail ?>"  required>
                  <span  class="messageError" id="messageErrorEmail"> <br> &nbsp;&nbsp;&nbsp;</span><br><br>

                  <div style="background-color: white;">
                    <table border=1>
                        <tr>
                            <td></td>
                            <td>Depistage covid-19</td>
                            <td>Biologie preventive</td>
                            <td>Biologie de la femme enceinte </td>
                            <td>Biologie de routine</td>
                            <td>Cancerologie</td>
                            <td>Gynecologie</td>
                        </tr>

                        <tr>
                            <td>Services:</td>
                            <td><input type="checkbox" id="Depistage-covid-19" name="Depistage-covid-19" <?php echo $Depistage ?>></td>
                            <td><input type="checkbox"  id="Biologie-preventive" name="Biologie-preventive" <?php echo $BiologieP ?>></td>
                            <td><input type="checkbox"  id="Biologie-de-la-femme-enceinte" name="Biologie-de-la-femme-enceinte" <?php echo $BiologieEnceinte ?>></td>
                            <td><input type="checkbox"  id="Biologie-de-routine" name="Biologie-de-routine" <?php echo $BiologieRoutine ?>></td>
                            <td><input type="checkbox"  id="Cancerologie" name="Cancerologie" <?php echo $Cancerologie ?>></td>
                            <td><input type="checkbox" id="Gynecologie" name="Gynecologie" <?php echo $Gynecologie ?> ></td>

                        </tr>
                    </table>
                  </div>
                  <br><br>
                  

                     <!--Le input pour l'image, qui est rendu invisible dans le script en bas, mais qui est quand meme
                  dans le forme pour pouvoir s'activer et prendre les valeurs lorsque l'on appuie sur le bouton 'modifier' -->
                  <input  type="file" id="image_uploads" name="image_uploads" accept="image/*">

                <input style="margin-left:10%;"  id="btnco" type="submit" value="Modifier les informations">
                
            </fieldset>
         </form>

    </div>

    <div id="footer">
        Branlette Corporation
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

            document.getElementById("TheImage2").src = temporaryUrl;
           
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
