<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
    $connected = $_GET['connected'];
    $idclient= $_GET['idclient'];
    $idmedecin= $_GET['idmedecin'];
    
    $text_message = "<div class='msgln'><b class='username'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    
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
        $sql = "SELECT IDmessage FROM chat-clientmedecin WHERE IDmessage = (SELECT MAX(IDmessage) FROM chat-clientmedecin)";   

        $BuffID = "";
        if($result = $mysqli->query($sql))
        {
            if($result->num_rows >0)
            {
                $row = $result->fetch_row();
                $BuffID = $row[0];
            }
            $result->free_result();
        }

        if($BuffID == "")
        {
            $IDmessage = $connected . "-00001"; // Premier ID
        }
        else
        {
            //Prendre les nombres à la fin et les transformer en int
            $NumRecupInt = intval(substr($BuffID,7))++; 

            // ID chosen for the new client
            $IDmessage = $connected."-0000".$NumRecupInt; 
        }

        $sql = "INSERT INTO chat-clientmedecin VALUES ('$IDmessage','$idmedecin','$text','$idclient')";
        $result = $mysqli->query($sql);

    }
}
?>