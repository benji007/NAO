<?php
if (isset($_COOKIE['login'])) {
    
} else {
    header('Location: index.php');
}
if (isset($_GET["mailSend"])) {
    echo '<div id="success" class="alert alert-success"> Email envoyer avec succés.</div>';
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

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <script src="js/jquery-2.1.0.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href='css/moncss.css' type='text/javascript'>
        <title>Contacts</title>
        <script>
            $('#success').show(0).delay(2000).hide("slow");
        </script>
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
            <p>LISTE DES CONTACTS </p>


            <?php
            // Recuperation de l'entreprise cliqu�e [Entreprise]

            $choix = 0;
            $recherche = isset($_GET['entreprise']) ? $_GET['entreprise'] : "";
            if ($recherche == "Decathlon") {
                $choix = "WHERE id_entreprise=1";
            } elseif ($recherche == "Zara") {
                $choix = "WHERE id_entreprise=2";
            } elseif ($recherche == "Celio") {
                $choix = "WHERE id_entreprise=3";
            } elseif ($recherche == "Micromania") {
                $choix = "WHERE id_entreprise=4";
            } elseif ($recherche == "ASC") {
                $choix = "ORDER BY nom_prenom ASC";
            } elseif ($recherche == "DESC") {
                $choix = "ORDER BY nom_prenom DESC";
            } else {
                $choix = "";
            }

//        if ($choix != 0) {
            $sql = "SELECT * FROM contacts $choix";
            $envoi_requete = mysql_query($sql);
            $compt = 0;
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {
                $compt++;
            }
            echo "<small>Nombre de contacts affichés : " . $compt . "</small></blockquote>";
            ?>


            <script>
                CKEDITOR.replace("contenu");
            </script>



            <!--Lien de la page contacts-->
            <ul class="pagination">
                <li class="disabled"><a href="#">Option de trie :</a></li>
                <li><a href='liste_contacts.php' role="button">Afficher tous</a></li>
                <li><a href="liste_contacts.php?entreprise=ASC"role="button">Afficher tous croissant</a></li>
                <li><a href="liste_contacts.php?entreprise=DESC" role="button">Afficher tous décroissant</a></li>
            </ul><br>









            <?php
            // Affichage de la table sous forme de tableaux

            $sql = "SELECT * FROM contacts $choix";
            $envoi_requete = mysql_query($sql);
            $compt = 1;
            while ($resultats = mysql_fetch_assoc($envoi_requete)) {

                $sql2 = "SELECT email FROM contacts WHERE id='" . $resultats['id'] . "'";
                $envoi_requete2 = mysql_query($sql2);
                $resultats2 = mysql_fetch_assoc($envoi_requete2);
                
                
                $sql3 = "SELECT mail FROM utilisateurs WHERE login='" . $_COOKIE['login'] . "'";
                $envoi_requete3 = mysql_query($sql3);
                $resultats3 = mysql_fetch_assoc($envoi_requete3);
                
                echo "<div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>" .
                "<tr><td>N° : </td><td>" . $compt . "</td><td align='right'>"
                . '<span  class="glyphicon glyphicon-envelope blue" data-toggle="modal" data-target="#myModal' . $compt . '">&nbsp;</span>
                    
        <div align="left" class="modal fade" id="myModal' . $compt++ . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Envoie d\'un message à un contact</h4>
                    </div>
                    <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="envoi_mail.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="emailExpediteur">Votre adresse mail :</label>
                        <input type="email" class="form-control" id="emailExpediteur" name="emailExpediteur" value="'.$resultats3['mail'].'" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="emailDestinataire">Destinataire : </label>
            <input type="email" class="form-control" id="emailDestinataire" name="emailDestinataire" readonly value="' . $resultats2['email'] . '">
                    </div>
                    
                    <div class="form-group">
                        <label for="titre">Titre du message : </label>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="Saisissez le titre de votre message">
                    </div>
  
                        <textarea name="contenu" id="contenu" rows="10" cols="80" class="ckeditor">
                        </textarea>
                        
                        <br>
                        
                    <div class="form-group">
                        <label for="pieceJointe">Pièce jointe : </label>
                        <input type="file" id="pieceJointe" name="pieceJointe">
                    </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default col-lg-2" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" name="envoyer">Envoyer</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>'
                . "<a href='creationPdf.php?id=" . $resultats['id'] . "'>"
                . "<span class='glyphicon glyphicon-print grey' >&nbsp;</span>" . "<a href='modif_contact.php?id=" . $resultats['id'] . "'>"
                . "<span class='glyphicon glyphicon-pencil' >&nbsp;</span>" . "<a href='suppr_contacts.php?id=" . $resultats['id'] . "'>"
                . "<span class='glyphicon glyphicon-remove-circle red'>&nbsp;</span>" . "</td></tr>" .
                "<tr><td>Nom Prenom : </td><td COLSPAN=2>" . $resultats['nom_prenom'] . "</td></tr>" .
                "<tr><td>Entreprise : </td><td COLSPAN=2>" . $resultats['id_entreprise'] . "</td></tr>" .
                "<tr><td>Téléphone : </td><td COLSPAN=2>" . $resultats['telephone'] . "</td></tr>" .
                "<tr><td>Photo : </td><td COLSPAN=2><img src='" . $resultats['photo'] . "' width='100'></td></tr>" .
                "<tr><td>Email : </td><td COLSPAN=2>" . $resultats['email'] . "</td></tr>" .
                "<tr><td>Observations : </td><td COLSPAN=2>" . $resultats['observation'] . "</td></tr>" .
                "</table></div>";
            }
            ?>





            </body>
            </html>