<?php
session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();


$nom = $_POST['name']
$prenom = $_POST['prenom']
$login = $_POST['identifiant'];
$mot_passe = $_POST['mot_passe'];

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();
$pdo->requeteAction(
        "insert into utilisateurs values (null, '$nom', '$prenom', '$login', '$mot_passe')");


header('location: index.php?register');

?>