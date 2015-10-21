<?php

session_start();
//Connection au serveur
require_once './js/pdoclass.php';
require_once './PHPMailer-master/class.phpmailer.php';
$pdo = PdoSlam1::getPdoSlam1();

if (isset($_POST["envoyer"])) {
    $source = $_FILES["pieceJointe"]["tmp_name"];
    $destination = "fichiers/" . $_FILES["pieceJointe"]["name"];

    $etat_transfert = move_uploaded_file($source, $destination);
}


$from = $_POST['emailExpediteur'];
$to = $_POST['emailDestinataire'];
$titre = $_POST['titre'];
$body = $_POST['contenu'];



$mail = new PHPMailer(); // defaults to using php "mail()"


$mail->From = $from;
$mail->AddAddress($to);
$mail->Subject = $titre;
$mail->Body = $body; // optional, comment out and test


if ($destination != "") {

    $mail->AddAttachment("'" . $destination . "'");      // attachment
};

$mail->Send();


if (!$mail->Send()) {
    echo 'Message was not sent.';
    echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
    header('location: liste_contacts.php');
}
    


