<!DOCTYPE html>
<?php

if (isset($_COOKIE['login'])) {
    if(!isset($_COOKIE['temp'])) {
        echo '<div id="succes" class="alert alert-success">Felicitation ! Vous vous êtes correctement connecté.</div> ';
        setcookie("temp", 1, time()+3600);
    }
} else {
    header('Location: index.php');
}

// Connexion à la base de donn�es
ini_set('display_errors','off');
$host = 'localhost';
$user = 'root';
$password = '';
$bdd = 'nao';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");
mysql_query("SET NAMES UTF8");
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>NAO Dictées</title>

        <!--Javascript-->
        <script>
            $('#succes').show(0).delay(2000).hide("slow");
        </script>
		
		
    </head>
    <body class="col-sm-12 background-body">
        <div class="navbar  navbar-inverse navbar-fixed-top">
            <nav class="nav-collapse" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand color">
                        <div class="color">
                            NAO dictée
                        </div></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a class="navbar-brand" href="vos_dictees.php">Vos dictées</a></li>
                    <li><a class="navbar-brand" href="ajout_dictees.php">Ajout dictées</a></li>
                    <li><a class="navbar-brand" href="recherche_dictees.php">Recherche</a></li>
                 </ul>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown"><?php
                            echo $_COOKIE['login'];
                            ?><b class="caret"></b></a>
                        <ul class="dropdown-menu ">
                            <li>
                                <a href="disconnect.php">
                                    <i class="glyphicon glyphicon-off" ></i>
                                    <span> Deconnexion </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav></div>

        <!--         Navbar bottom -->

        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <nav class="nav-collapse" role="navigation">
                <ul class="navbar navbar-right">
                    <p class="navbar-text2">Created by Tic&Tac &nbsp;</p>
                </ul>
            </nav>
        </div>

        <blockquote>
            <p>LISTE DES DICTEES </p>
            <?php
// Compte le nombre d'affichage
            $sql = "SELECT * FROM texte";
            $envoi_requete = mysql_query($sql);
            $compt = 0;
            while ($resultats = mysql_fetch_array($envoi_requete)) {
                $compt++;
				
            }
            echo "<small>Nombre de dictées affichées : " . $compt . "</small></blockquote>";
            ?>


            <ul class="pagination">
                <li class="disabled"><a href="#">Option de trie :</a></li>
                <li><a href="vos_dictees.php?texte=ASC" role="button">Afficher tous croissant</a></li>
                <li><a href="vos_dictees.php?texte=DESC" role="button">Afficher tous décroissant</a></li>
            </ul><br>

            <?php
			
// Selection de la totalitï¿½ de la table "Entreprises"
            if (isset($_GET['texte'])) {
                $recherche = $_GET['texte'];
                if ($recherche == "ASC") {
                    $choix = "ORDER BY nom ASC";
                } elseif ($recherche == "DESC") {
                    $choix = "ORDER BY nom DESC";
                } else {
                    $choix = "";
                }
            } else {

                $_GET['texte'] = "";
                $choix = $_GET['texte'];
            }

            $sql = "SELECT * FROM texte $choix";
            $envoi_requete = mysql_query($sql);
            $compt = 1;

// Affichage de la table sous forme de tableaux
	
	while ($resultats = mysql_fetch_array($envoi_requete))
	{
		$idtexte = $resultats['idtexte'] ;
		$titre =  $resultats['titre'] ;
		$corps = $resultats['corps'];
		$auteur = $resultats['auteur'];
		$idniveau = $resultats['niveau'];
		
		$sql2= "SELECT libelle_niveau FROM niveau WHERE idniveau = (SELECT niveau FROM texte WHERE niveau=".$idniveau.")";
		$envoi_requete2= mysql_query($sql2);
		while ($resultats2=mysql_fetch_array($envoi_requete2))
		{
			$niveau=$resultats2['libelle_niveau'];
			 echo "<div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>" .
               "<tr><td>N° : </td><td>" . $compt++ . "</td><td ALIGN='right'>" . "<a href='modif_dictees.php?texte=" . $resultats['idtexte'] . "'><span class='glyphicon glyphicon-pencil' ></span> &nbsp;" . "<a href ='suppr_dictees.php?id=".$resultats['idtexte']."'><span class='glyphicon glyphicon-remove-circle red' ></span>" . "</td></tr>" . 
               "<tr><td>Titre : </td><td COLSPAN=2> " . $titre. "</td></tr>" .
               "<tr><td>Texte : </td><td COLSPAN=2>" . $corps. "</td></tr>" .
               "<tr><td>Auteur: </td><td COLSPAN=2>" . $auteur. "</td></tr>" .
			   "<tr><td>Niveau: </td><td COLSPAN=2>".$niveau."</td></tr>".
               "</table></div>";		
		}		
	}		
			?>
			

            </body>
            </html>
