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
        if (isset($_GET['logout'])){ 
            session_destroy();
            sleep(1);
            header("Location: chat.php"); //Rediriger l'utilisateur
        }

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8" />
        <title>Chatroom</title>
        <link rel="stylesheet" href="chat.css">
    </head>
 
    <body>
        <div id="wrapper">
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

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script type="text/javascript">     
 // jQuery Document
 /*$(document).ready(function () {
    $("#submitmsg").click(function () {
        /*var clientmsg = $("#usermsg").val();
        var idclient = $("#idclient").val();
        var idmedecin = $("#idmedecin").val();
        $.post("post.php", { text: clienmsg, idclient: idclient, idmedecin: idmedecin }); //
        $("#usermsg").val("");
        return false;*/
    //});

    /*function loadLog() {
        var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Hauteur de défilement avant la requête
        $.ajax({
            $("#chatbox").html(html); //Insérez le log de chat dans la #chatbox div
            //Auto-scroll 
            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Hauteur de défilement apres la requête
            if(newscrollHeight > oldscrollHeight) $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Défilement automatique 
        });
    }
    setInterval (loadLog, 2500);*/

 //});*/
 </script>

 </body>
</html>
<?php
}
    
?>