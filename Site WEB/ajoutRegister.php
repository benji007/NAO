<?php
session_start();
//Connection au serveur
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();


$nom = $_POST['nom']
$prenom = $_POST['prenom']
$login = $_POST['identifiant'];
$mot_passe = $_POST['mot_passe'];
$type_compte=$_POST['type'];
$date = date

$sql= "SELECT idtype FROM typecompte WHERE libelle=".$type_compte."";
$req= mysql_query($sql);
while ($res= mysql_fetch_array($req))
	{
		$idtype=$res['idtype'];
	}
	
require_once './js/pdoclass.php';
$pdo = PdoSlam1::getPdoSlam1();
$pdo->requeteAction(
        "INSERT INTO utilisateurs VALUES ('$nom', '$prenom', '$login', '$mot_passe','$idtype',$date)");


header('location: index.php');

?>