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
    <script src="script.js"></script>
</head>

<?php
// Set session variables (variables globales)
$_SESSION["doc"] = "";
?>

<body>
    <div class="container">
<?php
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
        $data="medecin";
        $result = mysqli_query($mysqli, "SELECT * FROM " . $data);
        //afficher le resultat
        echo "<table class='table table-hover' >";
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td> <a href='fichecontact.php?name=" . $data['IDpersonne'] . "'> <img src='./images/medecin/" . $data['IDpersonne'] . ".jpg' height='120' width='100' id='doc'> </a>   </td>";
            echo "<td>Dr " . $data['Nom'] . "  </td>";
            echo "<td>" . $data['Specialisation'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

?>
</div>
</body>