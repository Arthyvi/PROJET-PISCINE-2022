<?php
session_start();
if(isset($_SESSION['name'])){
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
        $text = $_GET['usermsg'];
        $idmedecin = $_GET['idmedecin'];
        $idclient = $_GET['idclient'];
        $connected = $_GET['connected'];
        if($text!="") {
            $sql = "SELECT * FROM `chat-clientmedecin`";
            $cpt=0;
            if($result = $mysqli->query($sql))
            {
                while($row = $result->fetch_row())
                {
                    $cpt++;
                }
                $result->free_result();                  
            }

            $IDmessage = $connected . $cpt;
            $sql = "INSERT INTO `chat-clientmedecin` VALUES ('$IDmessage','$idmedecin','$text','$idclient')";
            $result = $mysqli->query($sql);
            header("Location: chat.php?name=" . $_SESSION['name'] . "&idclient=". $idclient . "&idmedecin=" . $idmedecin . "&connected=".$connected);
        }
    }
}
?>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script type="text/javascript">     
 //$(document).ready(function () {
    //});
 </script>