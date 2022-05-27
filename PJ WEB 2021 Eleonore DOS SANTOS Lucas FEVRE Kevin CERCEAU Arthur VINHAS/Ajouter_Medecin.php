
<?php 

//// Page pour afficher le profil du medecin connecter !!!! ////

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
session_start();

 ?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   
    <script src="scriptAjoutMedecin.js"></script>

    <link rel="stylesheet" href="Modifier_Profil_Docteur.css">
    <link rel="stylesheet" href="Error.css">

    
    
</head>
<body>
    <div id="header">
        <h1 id="Title">Ajouter Medecin</h1>
    </div><br>
    <div id="nav">
        <ul>
            <h2>Photo de profil: </h2>

            <img id="TheImage2" src="" alt="Photo du medecin" width="400" height="300">

            <br>
            <label for="image_uploads" style="color:blue;" >  Select a picture (required) : </label> 
        </ul>
    </div>
    <div id="description">
        <br>
        <form  action="Ajouter_Medecin_Activate.php" method="post" enctype="multipart/form-data">
            <fieldset>

                <div id="DocInfo" style="float:left;width:60%;">
                  <legend >INFOS MEDECIN :</legend>
                  <br>

                  <label   for="nom">Nom:</label><br>
                  <input  type="text" id="nom" name="nom"  required><br><br>

                  <label  for="prenom">Prenom:</label><br>
                  <input  type="text" id="prenom" name="prenom"  required><br><br>

                  <label  for="spe">Specialite:</label><br>
                  <select  name="spe" id="spe" required>
                      <option value="Generaliste">Generaliste</option>
                      <option value="Addictologue">Addictologue</option>
                      <option value="Andrologue">Andrologue</option>
                      <option value="Cardiologue">Cardiologue</option>
                      <option value="Dermatologue">Dermatologue</option>
                      <option value="Gastro-Hépato-Entérologue">Gastro-Hepato-Enterologue</option>
                      <option value="Gynécologue">Gynecologue</option>
                      <option value="Specialiste I.S.T">Specialiste I.S.T</option>
                      <option value="Ostéopathe">Osteopathe</option>
                  </select> <br><br>
                  <!-- <input type="text" id="spe" name="spe" required><br><br> -->

                  <label  for="phone">Tel:</label><br>
                  <input  type="text" id="tel" name="tel"  required><br><br>

                  <label  for="email">Email:</label><br>
                  <input  type="email" id="email" name="email"  required>
                  <span  class="messageError" id="messageErrorEmail"> &nbsp;&nbsp;&nbsp;</span><br><br>

                  <label  >Mot de passe:</label><br>
                  <input  type="text" id="mdp" name="mdp"  required><br><br>

                  <label >Confirmer le mot de passe:</label><br>
                  <input  type="text" id="mdp2" name="mdp2" required>
                  <span  class="messageError" id="messageErrorPassword"><br> &nbsp;&nbsp;&nbsp;  Passwords both empty!</span><br><br>

                  <!--Le input pour l'image, qui est rendu invisible dans le script en bas, mais qui est quand meme
                  dans le forme pour pouvoir s'activer et prendre les valeurs lorsque l'on appuie sur le bouton 'modifier' -->
                  <input  type="file" id="image_uploads" name="image_uploads" accept="image/*">


                </div>

                <div id="CVinfo">
                  <legend>CV Informations :</legend>
                  <br>

                  <label for="presentation">Presentation:</label><br>
                  <textarea id="presentation" name="presentation" rows="3" cols="35" name="text" placeholder="Enter text" required></textarea><br><br>

                  <label for="formation">Formation:</label><br>
                  <textarea id="formation" name="formation" rows="5" cols="35" name="text" placeholder="Enter text" required></textarea><br><br>

                  <label>Langues parlees:</label><br>

                  <input type="text" id="Langue1" name="Langue1"  required><br><br>
                  <input type="text" id="Langue2" name="Langue2"><br><br>
                  <input type="text" id="Langue3" name="Langue3"><br><br>

                  <label for="experience">Experience:</label><br>
                  <textarea id="experience" name="experience" rows="3" cols="35" name="text" placeholder="Enter text" required></textarea><br><br>

                  </div>

                <input style="margin-left:45%;"  id="btnco" type="submit" value="Creer" disabled>
                
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