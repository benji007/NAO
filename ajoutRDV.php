<?php

session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$nom_prenom = $_POST['nom_prenom'];
$id_entreprise = $_POST['entreprise'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$photo = $_POST['photo'];
$observation = $_POST['observation'];

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();
$pdo->requeteAction(
"insert into contacts values (null, '$nom_prenom', $id_entreprise, $telephone, 'toto','$email', '$observation')");

header('location: liste_contacts.php');