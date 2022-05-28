<!DOCTYPE html>

<head>
    <Title>OMNES</Title>
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   
    <link rel="stylesheet" href="boot.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  
    <link rel="stylesheet" href="Error.css">
    <script src="script.js"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      
        <a class="navbar-brand" href="#"><img src="omnes.png" width="150" alt=""></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="fa fa-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Recherche..">
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
                <a href="Medecin_G.php">Médecine générale</a>
                <a href="Medecin_Spe.php">Médecins spécialistes</a>
                <a href="Labo.php">Laboratoire de biologie médicale</a>
        </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">Rendez-vous</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="connexion1.php">Connexion</a>
            </li>
          </ul>
        </div> <!-- .navbar-collapse -->
    </nav>

    <div class="page-section">
    <div class="container">
    <h1 class ="text-center" id="Title">Inscription</h1><br>
    <div class="champ form-inline">
    <form class="main-form" id="SignInForm" action="inscription.php" method="post">
        <table>
            <tr>
                <td>Nom : </td>
                <td><input  class="form-control" type="text" name="nom" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Prenom : </td>
                <td><input class="form-control" type="text" name="prenom" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Adresse : </td>
                <td><input class="form-control" type="text" name="adresse1" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Complement d'adresse : </td>
                <td><input class="form-control" type="text" name="adresse2" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Ville : </td>
                <td><input class="form-control" type="text" name="ville" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Code postal : </td>
                <td><input class="form-control" type="text" name="code" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Pays : </td>
                <td><input class="form-control" type="text" name="pays" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Numero de Telephone : </td>
                <td><input class="form-control" type="text" name="tel" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Numero de Carte Vitale : </td>
                <td><input class="form-control" type="text" name="vitale" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td><br>Adresse mail : </td>
                <td><br><input  class="form-control" type="email" name="email" id="email" required></td>
                
            </tr>
            <tr><td></td><td><span  class="messageError" id="messageErrorEmail"> &nbsp;&nbsp;&nbsp;</span></td></tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Mot de Passe : </td>
                <td><input class="form-control" type="password" name="mdp" id="mdp" required></td>
            </tr>
            <tr><td> </td><td> </td></tr>
            <tr>
                <td>Confirmation Mot de Passe : </td>
                <td><input class="form-control" type="password" name="mdp2" id="mdp2"  required></td>
            </tr>
            <tr><td></td><td><span class="messageError" id="messageErrorPassword"> &nbsp;&nbsp;&nbsp; Passwords both empty!</span></td></tr>

        </table>
        <br>
        
        <input type="submit" style="margin-left:40%;" id="btnco" class="btn-sm btn-primary" value="S'inscrire" disabled>
    </form></div>

    <br>
    <a href="connexion1.php"><div class="text-center" style="font-style:italic">Vous avez deja un compte?</div></a>
</div>
</div>
</body>

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
            <iframe src="https://maps.google.com/maps?q=ECE Paris&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
              style="border:0" allowfullscreen></iframe>
          </div>
          </div>
        </div>
      </div>
    </div>
  </footer>