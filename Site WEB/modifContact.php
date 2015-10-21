<?php

session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

if (isset($_POST["envoi"])) {
    $source = $_FILES["photo"]["tmp_name"];
    $destination = "fichiers/" . $_FILES["photo"]["name"];

    $etat_transfert = move_uploaded_file($source, $destination);
}


$id = $_POST['id'];
$nom = $_POST['nom'];
$entreprise = $_POST['entreprise'];
$telephone = $_POST['tel'];

$email = $_POST['mail'];
$observations = $_POST['observations'];

$pdo->requeteAction(
        "UPDATE contacts SET  nom_prenom='$nom', id_entreprise='$entreprise', telephone=$telephone, photo='$destination', email='$email', observation='$observations' WHERE id=$id ");



header('location: liste_contacts.php');
