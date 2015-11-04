<?php

session_start();

//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();


// Take var POST
$id = $_POST['idtexte'];

$titre = $_POST['titre'];
$texte = $_POST['texte'];
$auteur = $_POST['auteur'];
$niveau = $_POST['niveau'];


$pdo->requeteAction(
        "UPDATE texte SET  titre='$titre', corps='$texte', auteur='$auteur', niveau='$niveau' WHERE idtexte=$id ");



header('location: vos_dictees.php');
?>