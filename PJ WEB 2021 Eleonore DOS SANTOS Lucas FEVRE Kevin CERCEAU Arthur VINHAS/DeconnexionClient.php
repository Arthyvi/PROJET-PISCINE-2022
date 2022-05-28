<?php

    // Start the session
    session_start();

    // On enlève l'ID de connexion
    $_SESSION["IDconnected"] = "";

    // On revient à la page précedente
    header("Location: ".$_GET["ref"]);

?>