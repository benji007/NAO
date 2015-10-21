<?php
session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

if(isset($_POST["envoi"])) {
    $source = $_FILES["photo"]["tmp_name"];
    $destination = "fichiers/".$_FILES["photo"]["name"];
    
    $etat_transfert = move_uploaded_file($source, $destination);
}



$nom_prenom = $_POST['nom_prenom'];
$id_entreprise = $_POST['entreprise'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$observation = $_POST['observation'];

$pdo->requeteAction(
"insert into contacts values (null, '$nom_prenom', $id_entreprise, $telephone, '$destination','$email', '$observation')");

header('location: liste_contacts.php');