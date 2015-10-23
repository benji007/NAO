<?php
if (isset($_COOKIE['login'])) {
    
} else {
    header('Location: index.php');
}

// Connexion à la base de donn�es
$host = 'localhost';
$user = 'root';
$password = '';
$bdd = 'nao';
$base = mysql_connect($host, $user, $password);
mysql_select_db($bdd) or die("Impossible de se connecter a la base de donnees $bdd");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>Modification Dictées</title>

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
            <p>DICTEES A MODIFIER </p>



            <a href="vos_dictees.php" role="button">Retourner dans la listes des dictées</a> </br></br></br>
            
            
            <?php
            
            $id =$_GET['texte'];
            $sql = "SELECT * FROM texte WHERE idtexte='" . $id . "'";
            $envoi_requete = mysql_query($sql);
            $compt = 1;

            // Affichage de la table sous forme de tableaux
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {

                echo "<form class='form-horizontal' role='form' method='POST' action='modifDictees.php'><input type='text' name='id' hidden value=". $id . " >" . 
                "<div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>" .       
                "<tr><td>Titre : </td><td COLSPAN=2><input type='text' name='titre' value=". $resultats['titre'] . "/></td></tr>" .
                "<tr><td>Texte : </td><td COLSPAN=2><textarea name='texte'>". $resultats['corps'] ."</textarea></td></tr>" .
                "<tr><td>Auteur : </td><td COLSPAN=2><input type='text' name='auteur' value=". $resultats['auteur'] . "></td></tr>" .
				"<tr><td>Niveau : </td><td COLSPAN=2><input type='text' name='niveau' value=". $resultats['niveau'] . "></td></tr>" .
                "</table>".
                "<button type='submit' method='POST' class='btn btn-primary col-lg-5 col-lg-offset-2'>Envoyer</button></div></form>";
            }
            ?>

    </body>
</html>





