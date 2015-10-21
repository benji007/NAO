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
$host = 'localhost';
$user = 'root';
$password = 'root';
$bdd = 'tp11';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");
?>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>Entreprises</title>


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
                            Base de données
                        </div></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a class="navbar-brand" href="liste_entreprises.php">Entreprises</a></li>
                    <li><a class="navbar-brand" href="liste_contacts.php">Contacts</a></li>
                    <li><a class="navbar-brand" href="liste_rdv.php">Rendez-vous</a></li>
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
            <p>LISTE DES ENTREPRISES </p>
            <?php
// Compte le nombre d'affichage
            $sql = "SELECT * FROM entreprises";
            $envoi_requete = mysql_query($sql);
            $compt = 0;
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {
                $compt++;
            }
            echo "<small>Nombre de contacts affichés : " . $compt . "</small></blockquote>";
            ?>







            <ul class="pagination">
                <li class="disabled"><a href="#">Option de trie :</a></li>
                <li><a href="liste_entreprises.php?entreprise=ASC" role="button">Afficher tous croissant</a></li>
                <li><a href="liste_entreprises.php?entreprise=DESC" role="button">Afficher tous décroissant</a></li>
            </ul><br>









            <?php
// Selection de la totalitï¿½ de la table "Entreprises"
            if (isset($_GET['entreprise'])) {
                $recherche = $_GET['entreprise'];
                if ($recherche == "ASC") {
                    $choix = "ORDER BY nom ASC";
                } elseif ($recherche == "DESC") {
                    $choix = "ORDER BY nom DESC";
                } else {
                    $choix = "";
                }
            } else {

                $_GET['entreprise'] = "";
                $choix = $_GET['entreprise'];
            }

            $sql = "SELECT * FROM entreprises $choix";
            $envoi_requete = mysql_query($sql);
            $compt = 1;

// Affichage de la table sous forme de tableaux
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {

                echo "<div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>" .
                "<tr><td>N° : </td><td>" . $compt++ . "</td><td ALIGN='right'>" . "<a href='modif_entreprises.php?entreprises=" . $resultats['id'] . "'><span class='glyphicon glyphicon-pencil' ></span> &nbsp;" . "<a href='suppr_entreprises.php?id=" . $resultats['id'] . "'><span class='glyphicon glyphicon-remove-circle red' ></span>" . "</td></tr>" .                "<tr><td>Raison Sociale : </td><td COLSPAN=2><a href='liste_contacts.php?entreprise=" . $resultats['nom'] . "'>" . $resultats['nom'] . "</a></td></tr>" .
                "<tr><td>Adresse : </td><td COLSPAN=2> " . $resultats['adresse'] . "</td></tr>" .
                "<tr><td>Téléphone : </td><td COLSPAN=2>" . $resultats['telephone'] . "</td></tr>" .
                "<tr><td>Fax : </td><td COLSPAN=2>" . $resultats['fax'] . "</td></tr>" .
                "<tr><td>Email : </td><td COLSPAN=2>" . $resultats['email'] . "</td></tr>" .
                "<tr><td>Observations : </td><td COLSPAN=2>" . $resultats['observations'] . "</td></tr>" .
                "</table></div>";
            }
            ?>

            </body>
            </html>
