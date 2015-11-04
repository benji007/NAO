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
//mysql_query("SET NAMES UTF8");
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
        <title>Ajout Dictées</title>

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
                    <li><a class="navbar-brand" href="vos_dictees.php">Vos dictées</a></li>
                    <li class="active"><a class="navbar-brand" href="ajout_dictees.php">Ajout dictées</a></li>
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


        <blockquote style="margin-top:55px;">
            <p>DICTEES A AJOUTER </p>
            <a href="vos_dictees.php" role="button">Retourner dans la listes des dictées</a>
        </blockquote> 
            
                <!-- write firt part of form -->
                <form class='form-horizontal' role='form' method='POST' action='ajouter_Dictees.php'>
                <div class='table-responsive col-md-3 .col-md-offset-3'><table class='table table-striped'>      
                <tr><td>Titre : </td><td COLSPAN=2><input type='texte' name='titre' value=""></td></tr>
                <tr><td>Texte : </td><td COLSPAN=2><textarea name='texte'></textarea></td></tr>
                <tr><td>Auteur : </td><td COLSPAN=2><input type='text' name='auteur' value=""></td></tr>
                <tr><td>Niveau : </td><td COLSPAN=2><select name= 'niveau'>
                <!-- end -->
                
                <?php
                //* write second part of form *//
               //$idniveau = $resultats['niveau'];

               $sql2= "SELECT * FROM niveau";
                $envoi_requete2= mysql_query($sql2);
                while ($resultats2=mysql_fetch_array($envoi_requete2)){
                    $varid = $resultats2['idniveau'];
                    $niveau=$resultats2['libelle_niveau'];
                    echo "<option value='".$varid."'>".$niveau."</option>";
                } 
                     
                //* end *//
                
                //* write third part of form *//
                echo "</select></td></tr>" .
                "</table>".
                "<button type='submit' method='POST' class='btn btn-primary col-lg-5 col-lg-offset-2'>Ajouter</button></div>";
                //* end *//
            ?>
            </form>

    </body>
</html>