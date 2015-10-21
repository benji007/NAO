<?php

session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$nom = $_POST['nom'];
$adresse = $_POST['adresse'];
$telephone = $_POST['telephone'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$observation = $_POST['observation'];

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$pdo->requeteAction(
        "insert into entreprises values (null, '$nom', '$adresse', $telephone, $fax,'$email', '$observation')");

header('location: liste_entreprises.php');
