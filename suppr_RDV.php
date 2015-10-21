<?php session_start() ?>
<?php

// Connexion � la base de donn�es
$host = 'localhost';
$user = 'root';
$password = 'root';
$bdd = 'tp11';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");

// Recuperation de l'entreprise cliqu�e [Entreprise]

$sql = "DELETE FROM rendez_vous WHERE id='" . $_GET['id'] . "'";
$envoi_requete = mysql_query($sql);

header('location: liste_rdv.php');
?>
