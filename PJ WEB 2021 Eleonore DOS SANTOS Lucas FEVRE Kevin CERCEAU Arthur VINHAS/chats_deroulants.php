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
        $idclient=$_GET['idclient'];
        $idmedecin=$_GET['idmedecin'];
        $sql="SELECT * FROM `chat-clientmedecin` WHERE IDmedecin='" . $idmedecin . "'";
?>

<!DOCTYPE html>
<head>
    <meta charset="uft-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/j s/bootstrap.min.js"> </script>
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        
        <?php
        $tab=array();
        $test=false;
            if($result = $mysqli->query($sql))
            {
                if($result->num_rows >0)
                {
                    echo "<table class='table table-hover'>";
                    while($data = $result->fetch_row())
                    {
                        //$nomclient = mysqli_query($mysqli, );
                        $nomclient = $mysqli->query("SELECT * FROM client WHERE IDpersonne='" . $data[3] . "'");
                        $nomclient = $nomclient->fetch_row()[2];
                        for($i=0;$i<count($tab);$i++) {
                            if($tab[$i]==$nomclient) 
                            {
                                $test=true;
                                break;
                            }
                        }
                        if(!$test) {
                            $clique="onclick=newclient('".$_SESSION['name']."','".$data[3]."','".$idmedecin."')";
                            echo "<tr><td>"; //<a href='chat.php?name=" . $_SESSION['name'] . "&idclient=".$data[3]."&idmedecin=" . $idmedecin . "&connected=MD'>
                            echo "<div class='col-sm-12' style='cursor: pointer; height:100px; background-color:lightblue; border-style: solid; border-radius:10px' ";
                            echo $clique.">".$nomclient."</div></td></tr>";//
                            $tab[]=$nomclient;
                        }
                        $test=false;
                    }
                    echo "</table>";
                }
                $result->free_result();
            }
    }
}
        ?>
        
    </div>
</body>

