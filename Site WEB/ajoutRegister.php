<?php
session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();

	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$login = $_POST['identifiant'];
	$mot_passe = $_POST['mot_passe'];
	$type_compte=$_POST['liste_type'];

	require_once './js/pdoclass.php';
	$pdo = PdoSlam1::getPdoSlam1();
	$pdo->requeteAction(
        "INSERT INTO utilisateurs VALUES ('$nom', '$prenom', '$login', '$mot_passe','$type_compte',now())");

	header('location: index.php');

?>