<?php
    // Start the session
    session_start();
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

<?php
// Set session variables (variables globales)
$_SESSION["doc"] = "";
?>

<body>
    <div class="container">

    <div id="barre" style="height:70px">
        <h2 style="float:left;margin-left:42%;  ">  <b> Administrator </b></h2>
        <button type="button" class="btn btn-secondary btn-sm" style="margin-top: 1.3%; margin-left: 20%; margin-right: 3%;">Mon compte</button>
        <button type="button" class="btn btn-secondary btn-sm" style="margin-top: 1.3%;">Deconnexion</button>
    </div>

    <div style="background-color:white;height:35px;">
        <span style="padding-left:44%;font-size:large;">Tout les medecins :</span>
    </div>

<?php
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
        $data="medecin";
        $result = mysqli_query($mysqli, "SELECT * FROM " . $data);
        //afficher le resultat
        echo "<table class='table table-hover' >";
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr onclick=\"window.location='fichecontact_Administrator.php?name=" . $data['IDpersonne'] . "'\">";
            echo "<td>  <img src='./images/medecin/" . $data['IDpersonne'] . ".jpg' height='120' width='100' id='doc'>   </td>";
            echo "<td>Dr " . $data['Nom'] . "</td>";
            echo "<td>" . $data['Specialisation'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

?>
</div>
</body>