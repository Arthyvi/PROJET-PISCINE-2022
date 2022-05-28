<?php

    // Start the session
    session_start();

    // On enlève l'ID de connexion
    $_SESSION["IDconnected"] = "";

    // On revient à la page de connexion
    header("Location: connexion1.php");

?>