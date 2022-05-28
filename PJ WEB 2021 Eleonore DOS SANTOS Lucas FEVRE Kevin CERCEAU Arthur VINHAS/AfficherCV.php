<?php 

//// Page pour afficher le profil du medecin connecter !!!! ////

// Initialisation en debut de fichier pour avoir accès à la variable global "$_SESSION", qui nous permet de stocker
// de manière global des données, peut importe la page
    session_start();

    //$BuffID = "MD-00004";
    $BuffID = $_SESSION["SelectedDoc"];

    //// Recupération des données du CV depuis le fichier XML des CV medecin
    // Variable forcé d'etre présente
    $Langue2 = "";
    $Langue3 = "";
    // Traitement
    $dom = new DOMDocument();

    $dom->validateOnParse = true;
    $dom->load('Mes CV/CVmedecin.xml');
  
    $root = $dom->documentElement;

    $LangueParler = "";

    $results = $root->getElementsByTagName( 'DocteurCV' );
    foreach( $results  as $result){
      if($result->getAttribute('id') == $BuffID)
      {

        foreach( $result->getElementsByTagName('Nom') as $Biff ){
            $Nom = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Prenom') as $Biff ){
            $Prenom = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Telephone') as $Biff ){
            $Telephone = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Mail') as $Biff ){
            $Mail = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Specialisation') as $Biff ){
            $Specialisation = $Biff->nodeValue;
        }


        foreach( $result->getElementsByTagName('presentation') as $Biff ){
            $presentation = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('formation') as $Biff ){
            $formation = $Biff->nodeValue;
        }

        foreach( $result->getElementsByTagName('Langue1') as $Biff ){
            $Langue1 = $Biff->nodeValue;
            $LangueParler =  $LangueParler.$Langue1;
        }

        foreach( $result->getElementsByTagName('Langue2') as $Biff ){
            $Langue2 = $Biff->nodeValue;
            $LangueParler =  $LangueParler."<br> - ". $Langue2;
        }

        foreach( $result->getElementsByTagName('Langue3') as $Biff ){
            $Langue3 = $Biff->nodeValue;
            $LangueParler =  $LangueParler."<br> - ". $Langue3;
        }

        foreach( $result->getElementsByTagName('experience') as $Biff ){
            $experience = $Biff->nodeValue;
        }

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
<body style="background-color: rgb(114, 147, 168);">
    <div class="container" >

    <!--Boutton retour -->
        <button onclick="window.location='Medecin_Personnel.php'" type="button" class="btn btn-secondary btn-sm" style="float:left; margin-top: 2%; margin-left:4%; padding:1%; ">Retour</button>
        
        <h1 style="margin-right:7%;">CV Medecin :</h1>
        <br>

        <div style="background-color: white; width: 70%; margin-left:15%; margin-bottom:5%;">
            
            <img style=" margin-left:4%; margin-top:4%;margin-bottom:4%;" id="TheImage" src="<?php echo "images/medecin/".$BuffID.".jpg?m=" . filemtime('images/medecin/'.$BuffID.'.jpg')  ?>" alt="Photo du medecin" width="300" height="200">

            <span style="float:right;margin-right:30%; margin-top:4%;">Dr.<?php echo $Prenom?> <?php echo $Nom?> <br> <span style="font-size:large;"><?php echo $Specialisation?></span><br> <span style="font-size:large;">Mail : <?php echo $Mail?></span><br> <span style="font-size:large;">Tel : +33<?php echo $Telephone?></span></span>
  
            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Presentation : </span>
            <p style="margin-left:4%;font-size:medium;"><?php echo $presentation?></p>

            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Formation : </span>
            <p style="margin-left:4%;font-size:medium;"> - <?php echo $formation?></p>

            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Langues parlées : </span>
            <p style="margin-left:4%;font-size:medium;"> - <?php echo $LangueParler?></p>

            <span style="margin-left:4%;font-size:large;text-decoration : underline;">Experience : </span>
            <p style="margin-left:4%;font-size:medium; padding-bottom:5%;"> - <?php echo $experience?></p>



        </div>
    </div>
</body>
