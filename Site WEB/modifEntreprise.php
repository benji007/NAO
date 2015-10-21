<?php

session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$id = $_POST['id'];
$nom = $_POST['raison_social'];
$adresse = $_POST['adresse'];
$telephone = $_POST['tel'];
$fax = $_POST['fax'];
$email = $_POST['mail'];
$observation = $_POST['observations'];

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$pdo->requeteAction(
        "UPDATE entreprises SET  nom='$nom', adresse='$adresse', telephone=$telephone, fax=$fax, email='$email', observations='$observation' WHERE id=$id ");



header('location: liste_entreprises.php');
