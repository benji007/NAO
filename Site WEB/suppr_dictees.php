<?php session_start() ?>
<?php

// Connexion � la base de donn�es
$host = 'localhost';
$user = 'root';
$password = '';
$bdd = 'nao';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");

// Recuperation de l'entreprise cliqu�e [Entreprise]

$sql = "DELETE FROM texte WHERE idtexte='" . $_GET['id'] . "'";
$envoi_requete = mysql_query($sql);

header('location: vos_dictees.php');
?>
