<?php
session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$login = $_POST['login'];
$mot_passe = $_POST['mot_passe'];

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();
$pdo->requeteAction(
        "insert into utilisateurs values (null, '$login', '$mot_passe')");


header('location: index.php?register');