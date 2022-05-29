<?php

$subject  = "Confirmation de paiement";

$message='<h1 class="text-center">Confirmation de votre paiement internet</h1>
<br>
<h2>Bonjour, ' . $_POST['name'] . '</h2>
<br>
<p><b>Montant :</b> 25€
<br>
<b>Votre moyen de paiement : </b>' . $_POST['paiement'] . '</p>
<br><br>
<h1>Ticket a conserver!</h1>';

/*
$message  = "Bonjour " . $_POST['name'] .",\n\n";
$message  .= "Nous vous confirmons votre paiement internet :"."\r\n\n";
$message  .= "Montant : 25€\n";
$message  .= "Votre moyen de paiement : " . $_POST['paiement'] . "\r\n";
$message  .= "Votre moyen de paiement : " . $_POST['paiement'] . "\r\n\n";
$message  .= "TICKET A CONSERVER !";
*/

$headers  = 'From: OMNES_SANTE@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
if(mail($_POST['email'], $subject, $message, $headers))
{
    echo "Email sent";
    header("Location: home.php");
}
else{
    echo "Email sending failed";
}
    ?>
