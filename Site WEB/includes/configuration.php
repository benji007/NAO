<?php

if (isset($_COOKIE['login'])) {
    if(!isset($_COOKIE['temp'])) {
        echo '<div id="succes" class="alert alert-success">Felicitation ! Vous vous êtes correctement connecté.</div> ';
        setcookie("temp", 1, time()+3600);
    }
} else {
    header('Location: index.php');
}

// Connexion à la base de donn?es
ini_set('display_errors','off');
$host = 'localhost';
$user = 'root';
$password = '';
$bdd = 'nao';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");
mysql_query("SET NAMES UTF8");
?>