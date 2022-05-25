<?php
session_start();
$nommedecin = mysqli_query($mysqli, "SELECT Prenom FROM medecin WHERE IDpersonne='" . $idmedecin . "'");

$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
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
        <link rel="stylesheet" href="chat.css" />
    </head>
 
    <body>
        <div id="wrapper">
            <div id="menu">
                <p class="welcome">Bienvenue, <b><?php echo $_SESSION['name']; ?></b></p>
            </div>
        <div id="chatbox">

 <?php
    $data="chat-clientmedecin";
    $result = mysqli_query($mysqli, "SELECT * FROM chat-clientmedecin WHERE IDclient='" . $idclient . "' AND IDmedecin='" . $idmedecin . "'");
    $nomclient = mysqli_query($mysqli, "SELECT Prenom FROM client WHERE IDpersonne='" . $idclient . "'");
    while ($data = mysqli_fetch_assoc($result)) {
        echo "<div class='msgln'>";
        if($data['IDmessage'].substr(0,2)=="CL") echo "<b class='username'>" . $nomclient . "</b>" . $data['message'] . "<br>";
        else echo "<b class='username'>" . $nommedecin . "</b>" . $data['message'] . "<br>";
        echo "</div>";
    }
 ?>
 </div>
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" />
        <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer" />
    </form>
 </div>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script type="text/javascript">     
 // jQuery Document
 $(document).ready(function () {
    $("#submitmsg").click(function () {
        var clientmsg = $("#usermsg").val();
        $.post("post.php?connected=" . $connected . "&idclient=" . $idclient . "&idmedecin=" . $idmedecin, { text: clientmsg });
        $("#usermsg").val("");
        return false;
    });
 });
 </script>

 </body>
</html>
<?php
}
    
?>