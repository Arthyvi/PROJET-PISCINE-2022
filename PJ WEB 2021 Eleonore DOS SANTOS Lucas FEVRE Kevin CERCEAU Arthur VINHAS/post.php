<?php
session_start();
//if(isset($_SESSION['name'])){
    $text = $_POST['text'];
    $idmedecin = $_GET['idmedecin'];
    $idclient = $_GET['idclient'];
    echo 'test';
    if($text!="") {
        $sql = "SELECT IDmessage FROM `chat-clientmedecin` WHERE IDmessage = (SELECT MAX(IDmessage) FROM `chat-clientmedecin`)";
        $BuffID="";
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
            //Prendre les nombres à la fin et  les transformé en int
            $NumRecupInt = intval(substr($BuffID,7)); 

            // Ajouter 1 au nombre pour incrementer
            $NumRecupInt = $NumRecupInt + 1;

            // ID chosen for the new client
            $IDmessage = $connected."-0000".$NumRecupInt; 
        }
        $sql = "INSERT INTO `chat-clientmedecin` VALUES ('$IDmessage','$idmedecin','$text','$idclient')";
        $result = $mysqli->query($sql);
    }
//}
?>