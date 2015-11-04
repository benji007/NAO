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
        "INSERT INTO texte (idtexte, titre, corps, auteur, niveau) VALUES ( '', '$titre', '$texte', '$auteur', '$niveau')" );

header('location: vos_dictees.php');
?>