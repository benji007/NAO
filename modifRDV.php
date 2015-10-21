<?php

session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$id = $_POST['id'];
$nom = $_POST['nom'];
$date = $_POST['date'];
$time = $_POST['time'];
$objet = $_POST['objet'];
$observations = $_POST['observations'];

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$pdo->requeteAction(
        "UPDATE rendez_vous SET objet='$objet', date='$date', heure='$time',id_contact=$nom, observation='$observations' WHERE id=$id ");

header('location: liste_rdv.php');
