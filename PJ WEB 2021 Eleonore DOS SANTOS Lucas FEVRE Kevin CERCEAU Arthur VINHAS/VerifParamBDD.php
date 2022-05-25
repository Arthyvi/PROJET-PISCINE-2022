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
    $theMail = $_GET["TheMail"];

    $sql = "SELECT * FROM identifiant WHERE Identifiant = '$theMail'";   

    switch($_GET["Indication"])
    {
        case "2" :
            $buffID = $_SESSION["IDconnected"];
            $sql =  $sql + "AND IDpersonne !='$buffID'";

            break;
    }

    $AlreadyHere = 0;

    if($result = $mysqli->query($sql))
    {
        
        if($result->num_rows > 0)
        {
            $AlreadyHere = $result->num_rows;
        }

        $result->free_result();
    }

   // echo $AlreadyHere;

    // Fermeture de notre variable "$mysqli"
    $mysqli->close();
}
    

?>