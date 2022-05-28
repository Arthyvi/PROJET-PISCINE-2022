<?php
    session_start();

    $_SESSION['name'] = stripslashes(htmlspecialchars($_GET['name']));
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
        $idclient=$_GET['idclient'];
        $idmedecin=$_GET['idmedecin'];
        $connected=$_GET['connected'];
        if($connected=='MD') {
            echo "<div class='leftbar'>";
            echo "<iframe src='chats_deroulants.php?idclient=".$idclient."&idmedecin=".$idmedecin."' height='795px' style='border:none'></iframe>";
            echo "</div>";
        }

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <title>Chatroom</title>
        <link rel="stylesheet" href="chat.css">
        <script src="script.js"></script>
    </head>
 
    <body>
        <div id="wrapper" style="float:left;margin-left:10%;margin-top:3%;">
            <div id="menu">
                <p class="welcome">Bienvenue, <b><?php echo $_SESSION['name']; ?></b></p>
            </div>
        <div id="chatbox">

 <?php
 
    $data="chat-clientmedecin";
    //$result = mysqli_query($mysqli, "SELECT * FROM chat-clientmedecin WHERE IDclient='" . $idclient . "'" . " AND IDmedecin='" . $idmedecin . "'");
    $sql="SELECT * FROM `chat-clientmedecin`  WHERE IDclient='" . $idclient . "'" . " AND IDmedecin='" . $idmedecin . "'";
    $nomclient = mysqli_query($mysqli, "SELECT Prenom FROM client WHERE IDpersonne='" . $idclient . "'");
    $nomclient = mysqli_fetch_assoc($nomclient);
    $nommedecin = mysqli_query($mysqli, "SELECT Prenom FROM medecin WHERE IDpersonne='" . $idmedecin . "'");
    $nommedecin = mysqli_fetch_assoc($nommedecin);
    /*while ($data = mysqli_fetch_assoc($result)) {
        echo "<div class='msgln'>";
        if($data['IDmessage'].substr(0,2)=="CL") echo "<b class='username'>" . $nomclient . "</b>" . $data['message'] . "<br>";
        else echo "<b class='username'>" . $_SESSION['name'] . "</b>" . $data['message'] . "<br>";
        echo "</div>";
    }*/
    if($result = $mysqli->query($sql))
    {
        if($result->num_rows >0)
        {
            while($data = $result->fetch_row())
            {
                echo "<div class='msgln'>";
                if($data[0].substr(0,2)=="CL") echo "<b class='username'>" . $nomclient . " </b>" . $data[2] . "<br>";
                else echo "<b class='username'>" . $_SESSION['name'] . " </b>" . $data[2] . "<br>";
                echo "</div>";
            }
        }
        $result->free_result();
    }
 ?>
 </div>
    <form name="message" action="post.php"> <!--chat.php?-->
        <input name="usermsg" type="text" id="usermsg" />
        <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer"/>
        <input name="connected" type="hidden" id="connected" value="<?php echo $connected;?>"/>
        <input name="idclient" type="hidden" id="idclient" value="<?php echo $idclient;?>"/>
        <input name="idmedecin" type="hidden" id="idmedecin" value="<?php echo $idmedecin;?>"/>
        <input name="name" type="hidden" id="name" value="<?php echo $_SESSION['name'];?>"/>
    </form>
 </div>

 <?php
    if($connected=='CL') echo "<button onclick=window.location='home.php' type='button' class='btn btn-secondary btn-sm' style=' margin-top: 1.3%; margin-left:12%; padding:1%; '>Retour</button>";
    else echo "<button onclick=window.location='Medecin_Personnel.php' type='button' class='btn btn-secondary btn-sm' style=' margin-top: 1.3%; margin-left:12%; padding:1%; '>Retour</button>";
?>
 

 </body>
</html>
<?php
}
    
?>