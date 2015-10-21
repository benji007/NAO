<?php 

if (isset($_COOKIE['login'])) {
    
} else {
    header('Location: index.php');
}


// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$password = 'root';
$bdd = 'tp11';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">

        <title>Rendez-vous</title>

        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
    </head>
    <body class="col-sm-12 background-body">


        <!-- Lien vers toutes les pages -->
        <div class="navbar  navbar-inverse navbar-fixed-top">
            <nav class="nav-collapse" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand color">
                        <div class="color">
                            Base de données
                        </div></a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a class="navbar-brand" href="liste_entreprises.php">Entreprises</a></li>
                    <li><a class="navbar-brand" href="liste_contacts.php">Contacts</a></li>
                    <li class="active"><a class="navbar-brand" href="liste_rdv.php">Rendez-vous</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown">Ajout<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="ajouter_contact.php">Contact</a></li>
                            <li><a href="ajouter_entreprise.php">Entreprise</a></li>
                            <li><a href="ajouter_rdv.php">Rendez-Vous</a></li>
                        </ul>
                    </li>
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
            <p>LISTE DES RENDEZ-VOUS </p>
            <?php
            // Compte le nombre d'affichage
            $sql = "SELECT * FROM rendez_vous";
            $envoi_requete = mysql_query($sql);
            $compt = 0;
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {
                $compt++;
            }
            echo "<small>Nombre de contacts affichés : " . $compt . "</small></blockquote>";
            ?>






            <ul class="pagination">
                <li class="disabled"><a href="#">Option de trie :</a></li>
                <li><a href="liste_rdv.php?entreprise=ASC" role="button">Afficher tous croissant</a></li>
                <li><a href="liste_rdv.php?entreprise=DESC" role="button">Afficher tous décroissant</a></li>
            </ul> <br>








            <?php
            // Selection de la totalit� de la table "Contacts" 
            if (isset($_GET['entreprise'])) {
                $recherche = $_GET['entreprise'];
                if ($recherche == "ASC") {
                    $choix = "ORDER BY date ASC";
                } elseif ($recherche == "DESC") {
                    $choix = "ORDER BY date DESC";
                } else {
                    $choix = "";
                }
            } else {

                $_GET['entreprise'] = "";
                $choix = $_GET['entreprise'];
            }

            $sql = "SELECT rendez_vous.id, objet, date, heure, rendez_vous.observation, nom_prenom FROM contacts, rendez_vous WHERE rendez_vous.id_contact= contacts.id $choix";
            $envoi_requete = mysql_query($sql);
            $compt = 1;
            // Affichage de la table sous forme de tableaux
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {


                echo "<div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>" .
                "<tr><td>N° : </td><td>" . $compt++ . "</td><td ALIGN='right'>". "<a href='modif_RDV.php?id=" . $resultats['id'] . "'><span class='glyphicon glyphicon-pencil' ></span> &nbsp;" . "<a href='suppr_RDV.php?id=" . $resultats['id'] . "'><span class='glyphicon glyphicon-remove-circle red' ></span>" . "</td></tr>" .
                "<tr><td>Objet : </td><td COLSPAN=2>" . $resultats['objet'] . "</td></tr>" .
                "<tr><td>Date : </td><td COLSPAN=2>" . $resultats['date'] . "</td></tr>" .
                "<tr><td>Heure : </td><td COLSPAN=2>" . $resultats['heure'] . "</td></tr>" .
                "<tr><td>Contact : </td><td COLSPAN=2>" . $resultats['nom_prenom'] . "</td></tr>" .
                "<tr><td>Observations : </td><td COLSPAN=2>" . $resultats['observation'] . "</td></tr>" .
                "</table></div>";
            }
            ?>

    </body>
</html>
