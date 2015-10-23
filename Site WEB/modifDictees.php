<?php

session_start();

//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$id = $_POST['idtexte'];
$titre = $_POST['titre'];
$corps = $_POST['corps'];
$auteur = $_POST['auteur'];
$niveau = $_POST['niveau'];

require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

$pdo->requeteAction(
        "UPDATE texte SET  titre='$titre', corps='$corps', auteur='$auteur', niveau='$niveau' WHERE idtexte=$id ");



header('location: vos_dictees.php');
?>