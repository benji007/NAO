<?php
if (isset($_COOKIE['login'])) {
    
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
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>Modification Contact</title>
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
                    <li><a class="navbar-brand" href="liste_entreprises.php">Entreprises</a></li>
                    <li class="active"><a class="navbar-brand" href="liste_contacts.php">Contacts</a></li>
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
            <p>ENTREPRISES A MODIFIER </p>



            <a href="liste_entreprises.php" role="button">Retourner dans la listes des entreprises</a> </br></br></br>


            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM contacts where id='" . $id . "'";
            $envoi_requete = mysql_query($sql);
            $compt = 1;

            // Affichage de la table sous forme de tableaux
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {

                echo "<form class='form-horizontal' role='form' method='POST' action='modifContact.php' enctype='multipart/form-data'><input type='text' name='id' hidden value=" . $id . " >" .
                "<div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>" .
                "<tr><td>Nom : </td><td COLSPAN=2><input type='text' name='nom' value='" . $resultats['nom_prenom'] . "'></td></tr>" .
                "<tr><td>Entreprise : </td><td COLSPAN=2><select class='form-control' name='entreprise'>";



                $sql2 = "SELECT id, nom FROM entreprises";
                $envoi_requete2 = mysql_query($sql2);
                while ($resultats2 = mysql_fetch_assoc($envoi_requete2)) {


                    echo "<option value = '" . $resultats2['id'] . "'>" . $resultats2['nom'] . "</option > ";
                }


                echo"</select></td></tr>" .
                "<tr><td>Téléphone : </td><td COLSPAN=2><input type='text' name='tel' value=" . $resultats['telephone'] . "></td></tr>" .
                "<tr><td>Photo : </td><td COLSPAN=2><div class='form-group'><img src='".$resultats['photo']."' width='100'></br>".
                "<div class='col-lg-2'><input type='file' id='exampleInputFile' name='photo'></div></div></td></tr>" .
                "<tr><td>Email : </td><td COLSPAN=2><input type='text' name='mail' value=" . $resultats['email'] . "></td></tr>" .
                "<tr><td>Observations : </td><td COLSPAN=2><textarea name='observations'>" . $resultats['observation'] . "</textarea></td></tr>" .
                "</table>" .
                "<button type='submit' method='POST' class='btn btn-primary col-lg-5 col-lg-offset-2' name='envoi'>Envoyer</button></div></form>";
            }
            ?>

    </body>
</html>


